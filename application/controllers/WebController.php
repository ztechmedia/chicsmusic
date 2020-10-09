<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Search", "search");
        $this->load->model("ProductModel", "Product");
        $this->load->helper("response");
        $this->categories = 'categories';
        $this->subcategories = 'subcategories';
        $this->products = 'products';
        $this->banners = "banners";
    }

    public function index()
    {
        $data['view'] = "web/home";
        $data['banners'] = $this->Product->getBanners();
        $data['subcategories'] = $this->BM->getAll($this->subcategories)->result();
        $data['categories'] = $this->BM->getOne($this->categories, 1)->row();
        $this->load->view("template/web/app", $data);
    }

    public function banner()
    {
        $data['banners'] = $this->Product->getBanners();
        $this->load->view("admin/stores/banner/banner", $data);
    }

    //@desc     show product list on banner
    //@route    GET /products-banner-list
    public function productBanner()
    {
        $data = $this->search->advanceSearch($this->Product, $_GET);
        if($data) {
            $this->load->view("admin/stores/banner/banner_product_list", $data);
        }else{
            $this->load->view("admin/products/grid/product_empty");
        }
    }

    //@desc     set banner modal
    //@route    GET /set-banner/:productId
    public function setBanner($productId)
    {
        $product = $this->BM->checkById($this->products, $productId);
        $data['product'] = $product;
        $data["covers"] = unserialize($product->cover);
        $this->load->view("admin/stores/banner/set_banner", $data);
    }

    //@desc     set banner modal
    //@route    GET /set-banner/:productId
    public function editBanner($bannerId)
    {
        $banner = $this->Product->getBannerById($bannerId);
        $data['banner'] = $banner;
        $data["covers"] = unserialize($banner->cover);
        $this->load->view("admin/stores/banner/edit_banner", $data);
    }

    //@desc     add banner
    //@route    POST /add-banner/:productId
    public function addBanner($productId)
    {
        $obj = fileGetContent();
        $data = [
            "id" => genUnique(20),
            "product_id" => $productId,
            "name" => $obj->name,
            "description" => $obj->description
        ];
        
        $this->BM->create($this->banners, $data);
        appJson([
            "message" => "Berhasil menambah data banner",
        ]);
    }

    //@desc     edit banner
    //@route    POST /edit-banner/:bannerId
    public function updateBanner($bannerId)
    {
        $obj = fileGetContent();
        $data = [
            "name" => $obj->name,
            "description" => $obj->description
        ];
        
        $this->BM->updateById($this->banners, $bannerId, $data);
        appJson([
            "message" => "Berhasil mengubah data banner",
        ]);
    }

    //@desc     delete banner
    //@route    DELETE /delete-banner/:bannerId
    public function deleteBanner($bannerId)
    {
        $this->BM->deleteById($this->banners, $bannerId);
        appJson([
            "message" => "Berhasil menghapus data banner",
        ]);
    }
}
