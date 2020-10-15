<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShopController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Search", "search");
        $this->load->model("ProductModel", "Product");
        $this->load->model("CategoryModel", "Category");
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
        $data['latest'] = $this->Product->latest(6);
        $this->load->view("template/web/app", $data);
    }

    public function products()
    {
        $data['view'] = 'web/products';
        $data['categories'] = $this->Category->catWithSub();
        $data['brands'] = $this->Product->brands();
        $data['data'] = $this->search->advanceSearch($this->Product, $_GET);
   
        $this->load->view('template/web/app', $data);
    }

    public function productDetail($productId)
    {
        $product = $this->BM->checkById($this->Product, $productId);
        $data['view'] = 'web/product_detail';
        $this->load->view("template/web/app", $data);
    }
}