<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StoreController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Search", "search");
        $this->load->model("ProductModel", "Product");
        $this->load->helper("response");
        $this->store_categories = 'store_categories';
        $this->categories = 'categories';
        $this->subcategories = 'subcategories';
        $this->products = 'products';
        $this->banners = "banners";
    }

    //@desc     show banner list
    //@route    GET admin/banners
    public function banner()
    {
        $data['banners'] = $this->Product->getBanners();
        $this->load->view("admin/stores/banner/banner", $data);
    }

    //@desc     show product list on banner
    //@route    GET admin/products-banner-list
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
    //@route    GET admin/set-banner/:productId
    public function setBanner($productId)
    {
        $product = $this->BM->checkById($this->products, $productId);
        $data['product'] = $product;
        $data["covers"] = unserialize($product->cover);
        $this->load->view("admin/stores/banner/set_banner", $data);
    }

    //@desc     set banner modal
    //@route    GET admin/set-banner/:productId
    public function editBanner($bannerId)
    {
        $banner = $this->Product->getBannerById($bannerId);
        $data['banner'] = $banner;
        $data["covers"] = unserialize($banner->cover);
        $this->load->view("admin/stores/banner/edit_banner", $data);
    }

    //@desc     add banner
    //@route    POST admin/add-banner/:productId
    public function addBanner($productId)
    {
        $obj = fileGetContent();

        if($obj->name === "") {
            appJson(['errors' => ['name' => "Title banner masih kosong"]]);
        };

        if($obj->description === "") {
            appJson(['errors' => ['description' => "Deskripsi banner masih kosong"]]);
        };

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
    //@route    POST admin/edit-banner/:bannerId
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
    //@route    DELETE admin/delete-banner/:bannerId
    public function deleteBanner($bannerId)
    {
        $this->BM->deleteById($this->banners, $bannerId);
        appJson([
            "message" => "Berhasil menghapus data banner",
        ]);
    }

    //@desc     category list
    //@route    GET admin/shop-category
    public function categories()
    {
        $store_categories = $this->BM->getAll($this->store_categories)->result();
        $data['store_categories'] = $store_categories;
        $this->load->view("admin/stores/categories/categories", $data);
    }

    //@desc     set store categories modal
    //@route    GET admin/set-shop-category/:id
    public function setCategories($id)
    {
        $data['storeCategory'] = $this->BM->checkById($this->store_categories, $id);
        $data['id'] = $id;
        $data['subcategories'] = $this->BM->getAll($this->subcategories)->result();
        $this->load->view("admin/stores/categories/set_categories", $data);
    }

    //@desc     update store categories
    //@route    GET admin/update-shop-category/:id
    public function updateCategories($id)
    {
        $storeCategory = $this->BM->getById($this->store_categories, $id);

        if($_FILES['file']['name']) {
            $file = $_FILES['file']['name'];
            $fileExt = pathinfo($file, PATHINFO_EXTENSION);
            $config['upload_path'] = "./assets/images/store_categories";
            $config['allowed_types'] = "jpg|jpeg|png|ico";
            $config['file_name'] = "icon_".$id.".".$fileExt; 
    
            $this->load->library('upload', $config);
            $this->upload->do_upload("file");
            $uploadData = $this->upload->data();
          
            $_POST['icon'] = $uploadData['file_name'];

            $file = "./assets/images/store_categories/$storeCategory->icon";
            if(file_exists($file)){
                unlink($file);
            }
        }

        $update = $this->BM->updateById($this->store_categories, $id, $_POST);
        if($update) {
            appJson(["message" => "Update kategori produk berhasil"]);
        }
    }


}
