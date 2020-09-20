<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubcategoriesController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model("SubcategoryModel", "Subcategory");
        $this->load->helper("utility");
        $this->load->helper('response');
        $this->categories = 'categories';
        $this->subcategories = 'subcategories';
    }

    public function subcategories($categoryId)
    {
        $data['category'] = $this->BM->getById($this->categories, $categoryId);
        $data['subcategories'] = $this->BM->getWhere($this->subcategories, ['category_id' => $categoryId]);
        $data['totalSub'] = count($data['subcategories']);
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
        if($subcategory) {
            appJson([
                'message' => "Berhasil menambah data subkategori"
            ]);
        }
    }

    public function listSubcategories($categoryId)
    {
        $subcategories = $this->BM->getWhere($this->subcategories, ['category_id' => $categoryId]);
        appJson($subcategories);
    }
}