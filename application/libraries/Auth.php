<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth {
    protected $ci;

    public function __construct() {
        $this->ci = &get_instance();
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
}