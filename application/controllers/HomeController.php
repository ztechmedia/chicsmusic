<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Auth", "auth");
        $this->auth->private();
    }

	public function dashboard()
	{
        $this->load->view('admin/dashboard/dashboard');
	}
}
