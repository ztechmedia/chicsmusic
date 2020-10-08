<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("utility");
        $this->load->model("BaseModel", "BM");
        $this->users = "users";
        $this->roles = "roles";
        $this->auth->auth();
    }

    //@desc     load login view
    //@route    GET /login
    public function login()
    {
        $data["view"] = "auth/login";
        $this->load->view("template/auth/app", $data);
    }

    //@desc     login logic to verify users
    //@route    GET auth/login
    public function authLogin()
    {
        $email = $this->input->post("email");
        $password = $this->input->post("password");

        if (strlen($email) <= 0) {
            appJson(["errors" => ["email" => "Email tidak boleh kosong"]]);
        }

        if (strlen($password) <= 0) {
            appJson(["errors" => ["password" => "Password tidak boleh kosong"]]);
        }

        $user = $this->BM->getWhere($this->users, ["email" => $email])->row();
        if (!$user) {
            appJson(["errors" => [
                "email" => "Email tidak terdaftar",
            ]]);
        }

        if (!password_verify($password, $user->password)) {
            appJson(["errors" => [
                "password" => "Password tidak cocok",
            ]]);
        }

        $role = $this->BM->getById($this->roles, $user->role);

        $session = array(
            "userId" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "role" => $role->name,
        );

        $this->session->set_userdata(SESSION_KEY, $session);

        if ($role->name === "member") {
            appJson([
                "success" => true,
                "type" => "login",
                "redirect" => base_url("home"),
            ]);
        } else {
            appJson([
                "success" => true,
                "type" => "login",
                "redirect" => base_url("admin"),
                "currentUrl" => base_url("admin/dashboard"),
            ]);
        }
    }

    //@desc     load register view
    //@route    GET /register
    public function register()
    {
        $data["view"] = "auth/register";
        $this->load->view("template/auth/app", $data);
    }

    //@desc     register logic to create new member
    //@route    GET auth/register
    public function authRegister()
    {
        $name = $this->input->post("name");
        $email = $this->input->post("email");
        $password = $this->input->post("password");
        $confirm = $this->input->post("confirm");

        if (strlen($name) <= 0) {
            appJson(["errors" => ["name" => "Nama tidak boleh kosong"]]);
        }

        if (strlen($email) <= 0) {
            appJson(["errors" => ["email" => "Email tidak boleh kosong"]]);
        }

        if (strlen($password) <= 0) {
            appJson(["errors" => ["password" => "Password tidak boleh kosong"]]);
        }

        if (strlen($confirm) <= 0) {
            appJson(["errors" => ["confirm" => "Konfirmasi password tidak boleh kosong"]]);
        }

        $checkEmail = $this->BM->getWhere($this->users, ["email" => $email])->row();
        if ($checkEmail) {
            appJson(["errors" => [
                "email" => "Email sudah terdaftar",
            ]]);
        }

        if ($password !== $confirm) {
            appJson(["errors" => [
                "confirm" => "Konfirmasi password tidak sama",
            ]]);
        }

        $data = [
            "name" => $name,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_BCRYPT),
            "role" => "l2Pa9vedG4CvFZsz7qZO",
        ];

        $role = $this->BM->getById($this->roles, "l2Pa9vedG4CvFZsz7qZO");
        $user = $this->BM->createForId($this->users, $data);

        $session = array(
            "userId" => $user,
            "name" => $name,
            "email" => $email,
            "role" => $role->name,
        );

        $this->session->set_userdata(SESSION_KEY, $session);

        appJson([
            "success" => true,
            "type" => "register",
            "redirect" => base_url("home"),
        ]);
    }

    //@desc     load forgot password view
    //@route    GET /forgot-password
    public function forgotPassword()
    {
        $data["view"] = "auth/forgot-password";
        $this->load->view("template/auth/app", $data);
    }

    //@desc     send link reset password
    //@route    GET /send-link-forgot
    public function sendLinkForgot()
    {
        $email = $this->input->post("email");
        if (strlen($email) <= 0) {
            appJson(["errors" => ["email" => "Email masih kosong"]]);
        }

        $user = $this->BM->getWhere($this->users, ["email" => $email])->row();
        if(!$user) {
            appJson(["errors" => ["email" => "Email tidak terdaftar"]]);
        }

        $token = genUnique(62);
        $link = base_url("reset-password/$token");

        $sendEmail = $this->auth->sendEmail("Reset Password", $link, $email);
        if ($sendEmail) {
            $data['token_password'] = $token;
            $updateEmail = $this->BM->updateById($this->users, $user->id, $data);
            if ($updateEmail) {
                appJson([
                    "success" => true,
                    "type" => "send-link-forgot",
                    "message" => "Berhasil mengirim link reset password kepada $email",
                    "redirect" => base_url("login")
                ]);
            }
        }else{
            appJson(["errors" => ["email" => $sendEmail]]);
        }
    }

    //@desc     reset password view
    //@route    GET /auth/reset-password/:token_password
    public function resetPassword($token_password)
    {
        $user = $this->BM->getWhere($this->users, ["token_password" => $token_password])->row();
        if(!$user) {
            $data['message'] = "$token_password tidak ada di database kami";
            $this->load->view("errors/custom/page_not_found", $data);
        }else{
            $data["token_password"] = $token_password;
            $data['view'] = "auth/reset-password";
            $this->load->view("template/auth/app", $data);
        }
    }

    public function reset($token_password)
    {
        $password = $this->input->post("password");
        $confirm = $this->input->post("confirm");

        $user = $this->BM->getWhere($this->users, ["token_password" => $token_password])->row();

        if(!$user) {
            appJson(["errors" => ["token" => "Invalid TOKEN"]]);
        }

        if(strlen($password) <= 0) {
            appJson(["errors" => ["password" => "Password masih kosong"]]);
        }

        if(strlen($confirm) <= 0) {
            appJson(["errors" => ["confirm" => "Konfirmasi password masih kosong"]]);
        }

        if($password !== $confirm) {
            appJson(["errors" => ["confirm" => "Konfirmasi password tidak cocok"]]);
        }
        
        $data["password"] = password_hash($password, PASSWORD_BCRYPT);
        $data["token_password"] = null;
        $this->BM->updateById($this->users, $user->id, $data);
        $role = $this->BM->getById($this->roles, $user->role);
        $session = array(
            "userId" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "role" => $role,
        );

        $this->session->set_userdata(SESSION_KEY, $session);

        $redirect = $role->name === "member" ? base_url("home") : base_url("admin");

        appJson([
            "success" => true,
            "type" => "reset-password",
            "redirect" => $redirect,
            "currentUrl" => base_url("admin/dashboard"),
        ]);
    }
}
