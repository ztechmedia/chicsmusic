<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CategoriesController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model("CategoryModel", "Category");
        $this->load->library('Datatables', 'datatables');
        $this->load->helper("utility");
        $this->load->helper('response');
        $this->categories = 'categories';
    }

    public function categories()
    {
        $this->load->view('admin/categories/categories');
    }

    public function categoriesTable()
    {
        $categories = $this->datatables->setDatatables(
            //table
            $this->categories,
            //columns to show
            ["id", "name", "createdAt"],
            //column searchable
            ['name'],
            //actions view path
            'admin/actions/subcategories',
            //others params
            [
                'delete_message' => [
                    'name' => "Yakin ingin menghapus kategori [name] pada data Kategori",
                ],
            ]
        );
        json($categories);
    }

    public function create()
    {
        $this->load->View('admin/categories/create');
    }

    public function add()
    {
        $category = $this->Category->create($_POST);
        if ($category) {
            appJson([
                "message" => "Berhasil menambah data Kategori",
            ]);
        }
    }

    public function edit($id)
    {
        $data['category'] = $this->BM->getById($this->categories, $id);
        $this->load->view('admin/categories/edit', $data);
    }

    public function update($id)
    {
        $category = $this->BM->getById($this->categories, $id);
        if (!$category) {
            appJson(['message' => "Kategori tidak ditemukan"]);
        }
        $updateCategory = $this->Category->update($id, $_POST);
        if ($updateCategory) {
            appJson([
                "message" => "Berhasil mengubah data Kategori",
            ]);
        }
    }

    public function delete($id)
    {
        $this->BM->deleteById($this->categories, $id);
        appJson($id);
    }
}