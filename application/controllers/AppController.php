<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $this->load->view('template/admin/app');
    }
    
    public function pageNotFound()
    {
        $this->load->view("errors/custom/page_not_found");
    }
}
