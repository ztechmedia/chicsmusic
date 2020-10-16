<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShopController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Search", "search");
        $this->load->library('cart');
        $this->load->model("ProductModel", "Product");
        $this->load->model("CategoryModel", "Category");
        $this->load->helper("response");
        $this->categories = 'categories';
        $this->subcategories = 'subcategories';
        $this->store_categories = 'store_categories';
        $this->products = 'products';
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
        $product = $this->BM->checkById($this->products, $productId);
        $data['view'] = 'web/product_detail';
        $data['product'] = $product;
        $this->load->view("template/web/app", $data);
    }

    public function addCart()
    {   
        $post = fileGetContent();
        $cart = $this->cart->contents();

        $key = array_search_key($cart, $post->product_id, 'id');
        if($key !== NULL) {
            $data = array(
                'rowid' => $key,
                "name" => $post->name,
                'qty'   => $cart[$key]['qty'] + $post->qty,
                "price" => $post->price
            );
            $this->cart->update($data);
        }else{
            $data = array(
                "id" => $post->product_id,
                "name" => $post->name,
                "qty" => $post->qty,
                "price" => $post->price
            );
            $this->cart->insert($data);
        }
        
        appJson([
            "success" => true,
            "message" => "Berhasil menambahkan barang ke keranjang"
        ]);
    }

    public function checkCart()
    {
        echo count($this->cart->contents());
    }
}