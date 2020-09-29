<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth {
    protected $ci;

    public function __construct() {
        parent::__construct();
        $this->ci = &get_instance();
    }

    public function isLogged()
    {
        $user = $this->ci->session->userdata("user");
        if(!isset($user)) {
            redirect(base_url("login"));
        }
    }
}