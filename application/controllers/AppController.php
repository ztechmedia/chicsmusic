<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->auth->private();
    }

	public function index()
	{
        $this->load->view('template/admin/app');
    }
    
    public function pageNotFound()
    {
        $this->load->view("errors/custom/page_not_found");
    }

    public function home()
    {
        $this->load->view("template/web/app");
    }

    public function logout()
    {
        $this->session->unset_userdata(SESSION_KEY);
        appJson([
            "success" => true,
            "redirect" => base_url("login"),
        ]);
    }
}
