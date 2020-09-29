<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $data["view"] = "auth/login";
        $this->load->view("template/auth/app", $data);
    }

    public function logout()
    {
        echo "Logout OK";
    }
}
