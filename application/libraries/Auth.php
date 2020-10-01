<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth {
    protected $ci;

    var $userId;
    var $name;
    var $email;
    var $role;

    public function __construct() {
        $this->ci = &get_instance();
        $this->me();
    }

    public function private()
    {
        if(!$this->ci->session->userdata(SESSION_KEY)) {
            redirect("login");
        }
    }

    public function public()
    {
        if($this->ci->session->userdata(SESSION_KEY)) {
            redirect("admin");
        }
    }

    public function me()
    {
        if($this->ci->session->userdata(SESSION_KEY)) {
           $this->userId = $_SESSION[SESSION_KEY]["userId"];
           $this->name = $_SESSION[SESSION_KEY]["name"];
           $this->email = $_SESSION[SESSION_KEY]["email"];
           $this->role = $_SESSION[SESSION_KEY]["role"];
        }
    }

    public function sendEmail($subject, $message, $to)
    {
        $this->ci->load->library("email");
        $config = array(
            'protocol' =>  EMAIL_PROTOCOL,
            'smtp_host' => SMTP_HOST,
            'smtp_port' => SMTP_PORT,
            'smtp_user' => SYSTEM_MAIL,
            'smtp_pass' => SYSTEM_MAILPASS,
            'mailtype' => 'html',
            'charset' => 'utf-8',
        );
        $this->ci->email->initialize($config);
        $this->ci->email->set_mailtype("html");
        $this->ci->email->set_newline("\r\n");
        $this->ci->email->to($to);
        $this->ci->email->from(SYSTEM_MAIL, SYSTEM_MAIL_ADMIN);
        $this->ci->email->subject($subject);
        $this->ci->email->message($message);
        return $this->ci->email->send();
    }
    
}