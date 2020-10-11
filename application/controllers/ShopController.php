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
        $this->store_categories = 'store_categories';
    }

    public function home()
    {
        $data['view'] = "web/home";
        $data['banners'] = $this->Product->getBanners();
        $data['categories'] = $this->BM->getAll($this->store_categories)->result();
        $this->load->view("template/web/app", $data);
    }
}