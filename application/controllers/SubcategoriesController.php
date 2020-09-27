<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubcategoriesController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model("SubcategoryModel", "Subcategory");
        $this->load->model("CategoryModel", "Category");
        $this->load->helper("utility");
        $this->load->helper('response');
        $this->categories = 'categories';
        $this->subcategories = 'subcategories';
        $this->products = "products";
    }

    //@desc     show subategories by categoryId
    //@route    GET /categories/:categoryId/subcategories
    public function subcategories($categoryId)
    {
        $data['category'] = $this->Category->catWithProduct($categoryId);
        $data['subcategories'] = $this->Subcategory->subWithProduct($categoryId);
        $this->load->view('admin/categories/subcategories/subcategories', $data);
    }

    //@desc     create subcategories view
    //@route    GET /categories/:categoryId/subcategories/create
    public function create($categoryId)
    {
        $data['categoryId'] = $categoryId;
        $this->load->view('admin/categories/subcategories/create', $data);
    }

    //@desc     create subcategories logic
    //@route    POST /categories/:categoryId/subcategories/add
    public function add($categoryId)
    {
        
        $_POST['category_id'] = $categoryId;
        $subcategory = $this->Subcategory->create($_POST);

        if($_FILES["file"]['name'] && $subcategory) {
            $this->uploadIcon($_FILES['file']['name'], $subcategory);
        }

        if($subcategory) {
            appJson([
                'message' => "Berhasil menambah data subkategori"
            ]);
        }
    }

    //@desc     update subcategories view
    //@route    GET /subcategories/:subcategoryId/edit
    public function edit($id)
    {
        $subcategory = $this->BM->checkById($this->subcategories, $id);
        $data['subcategory'] = $subcategory;
        $data['categoryId'] = $subcategory->category_id;
        $this->load->view("admin/categories/subcategories/edit", $data);
    }

    //@desc     update subcategories logic
    //@route    POST /subcategories/:subcategoryId/update
    public function update($id)
    {
        $icon = $this->BM->getById($this->subcategories, $id)->icon;
        $subcategory = $this->Subcategory->update($id, $_POST);
        
        if($_FILES['file']['name']) {
            $this->uploadIcon($_FILES['file']['name'], $id);
            if($icon) {
                $file = "./assets/images/subcategories/$icon";
                if(file_exists($file)){
                    unlink($file);
                }
            }
        }

        if ($subcategory) {
            appJson([
                "message" => "Berhasil mengubah data Kategori",
            ]);
        }
    }

    //@desc     get subcategories list by submitting categoryId
    //@route    POST /categories/:categoryId/subcategories/list
    public function listSubcategories($categoryId)
    {
        $subcategories = $this->BM->getWhere($this->subcategories, ['category_id' => $categoryId])->result();
        appJson($subcategories);
    }

    //@desc     upload icon configuration
    public function uploadIcon($file, $id)
    {
        $fileExt = pathinfo($file, PATHINFO_EXTENSION);
        $config['upload_path'] = "./assets/images/subcategories";
        $config['allowed_types'] = "jpg|jpeg|png|ico";
        $config['file_name'] = "icon_".$id.".".$fileExt; 
        $this->load->library('upload', $config);
        $this->upload->do_upload("file");
        $uploadData = $this->upload->data();
        $data['icon'] = $uploadData['file_name'];
        $this->Subcategory->update($id, $data);
    }

    //@desc     remove icon from database dan file
    //@route    GET /subcategories/:subcategoryId/removeUpload
    public function removeUpload($id)
    {
        $subcategory = $this->BM->checkById($this->subcategories, $id);
        if (!$subcategory) return false;

        $file = "./assets/images/subcategories/$subcategory->icon";
        if(file_exists($file)){
            unlink($file);  
            $data['icon'] = null;
            $this->BM->updateById($this->subcategories, $id, $data);
            appJson(["message" => "Hapus foto berhasil"]);
        }
    }
}