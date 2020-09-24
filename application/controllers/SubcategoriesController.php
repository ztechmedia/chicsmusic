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

    public function subcategories($categoryId)
    {
        $data['category'] = $this->Category->catWithProduct($categoryId);
        $data['subcategories'] = $this->Subcategory->subWithProduct($categoryId);
        $this->load->view('admin/categories/subcategories/subcategories', $data);
    }

    public function create($categoryId)
    {
        $data['categoryId'] = $categoryId;
        $this->load->view('admin/categories/subcategories/create', $data);
    }

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

    public function edit($id)
    {
        $subcategory = $this->BM->checkById($this->subcategories, $id);
        if(!$subcategory) return false;

        $data['subcategory'] = $subcategory;
        $data['categoryId'] = $subcategory->category_id;
        $this->load->view("admin/categories/subcategories/edit", $data);
    }

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

    public function listSubcategories($categoryId)
    {
        $subcategories = $this->BM->getWhere($this->subcategories, ['category_id' => $categoryId])->result();
        appJson($subcategories);
    }

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