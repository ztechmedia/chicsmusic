<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Auth", "auth");
        $this->load->helper("response");
        $this->load->model("BaseModel", "BM");
        $this->users = "users";
        $this->roles = "roles";
        $this->auth->public();
    }

    public function login()
    {
        $data["view"] = "auth/login";
        $this->load->view("template/auth/app", $data);
    }

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
            "role" => $role->name
        );

        $this->session->set_userdata(SESSION_KEY, $session);

        if ($user->role === "member") {
            appJson([
                "success" => true,
                "redirect" => base_url("home"),
            ]);
        } else {
            appJson([
                "success" => true,
                "redirect" => base_url("admin"),
                "currentUrl" => base_url("admin/dashboard"),
            ]);
        }
    }

    public function register()
    {
        $data["view"] = "auth/register";
        $this->load->view("template/auth/app", $data);
    }

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
            "role" => $role->name
        );

        $this->session->set_userdata(SESSION_KEY, $session);

        appJson([
            "success" => true,
            "redirect" => base_url("home"),
        ]);
    }
}
