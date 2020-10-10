<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShopController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("ProductModel", "Product");
        $this->load->helper("response");
        $this->categories = 'categories';
        $this->subcategories = 'subcategories';
        $this->products = 'products';
        $this->banners = "banners";
    }

    public function home()
    {
        $data['view'] = "web/home";
        $data['banners'] = $this->Product->getBanners();
        $data['subcategories'] = $this->BM->getAll($this->subcategories)->result();
        $data['categories'] = $this->BM->getOne($this->categories, 1)->row();
        $this->load->view("template/web/app", $data);
    }
}