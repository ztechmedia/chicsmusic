<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductsController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model('ProductModel', 'Product');
        $this->load->helper("utility");
        $this->products = 'products';
        $this->auth->private();
    }
}