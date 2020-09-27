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
        $this->subcategories = "subcategories";
        $this->products = 'products';
    }

    //@desc     show categories table
    //@route    GET /categories
    public function categories()
    {
        $this->load->view('admin/categories/categories');
    }

    //@desc     show data categories table
    //@route    GET /categories/categories-table
    public function categoriesTable()
    {
        $categories = $this->datatables->setDatatables(
            $this->categories,
            ["id", "name", "createdAt"],
            ['name'],
            'admin/actions/subcategories',
            [
                'delete_message' => [
                    'name' => "Yakin ingin menghapus kategori [name] pada data Kategori",
                ],
            ]
        );
        json($categories);
    }

    //@desc     create categories view
    //@route    GET /categories/create
    public function create()
    {
        $this->load->View('admin/categories/create');
    }

    //@desc     create categories logic
    //@route    POST /categories/add
    public function add()
    {
        $category = $this->Category->create($_POST);
        if($_FILES["file"]['name'] && $category) {
            $this->uploadIcon($_FILES['file']['name'], $category);
        }

        if($category) {
            appJson([
                "message" => "Berhasil menambah data Kategori",
            ]);
        }
    }

    //@desc     update categories view
    //@route    GET /categories/:categoryId/edit
    public function edit($id)
    {   
        $category = $this->BM->checkById($this->categories, $id);
        $data['category'] = $category;
        $this->load->view('admin/categories/edit', $data);
    }

    //@desc     update categories logic
    //@route    POST /categories/:categoryId/update
    public function update($id)
    {
        $icon = $this->BM->getById($this->categories, $id)->icon;
        $category = $this->Category->update($id, $_POST);
        
        if($_FILES['file']['name']) {
            $this->uploadIcon($_FILES['file']['name'], $id);
            if($icon) {
                $file = "./assets/images/categories/$icon";
                if(file_exists($file)){
                    unlink($file);
                }
            }
        }

        if ($category) {
            appJson([
                "message" => "Berhasil mengubah data Kategori",
            ]);
        }
    }

    //@desc     delete categories logic
    //@route    GET /categories/:categoryId/delete
    public function delete($id)
    {
        $product = $this->BM->getWhere($this->products, ['category_id' => $id])->result();
        if($product){
            appJson(["errors" => "Kategori ini sudah memiliki produk, tidak dapat dihapus"]);
            return;
        }
        
        $icon = $this->BM->getById($this->categories, $id)->icon;
        if($icon) {
            $file = "./assets/images/categories/$icon";
            if(file_exists($file)){
                unlink($file);
            }
        }

        $this->BM->deleteById($this->categories, $id);
        
        $subcategories = $this->BM->getWhere($this->subcategories, ['category_id' => $id]);
        foreach ($subcategories as $sub) {
            if($sub->icon) {
                $file = "./assets/images/subcategories/$sub->icon";
                if(file_exists($file)){
                    unlink($file);
                }
            }
        }

        $this->BM->delete($this->subcategories, ['category_id' => $id]);
        appJson($id);
    }

    //@desc     upload icon configuration
    public function uploadIcon($file, $id)
    {
        $fileExt = pathinfo($file, PATHINFO_EXTENSION);
        $config['upload_path'] = "./assets/images/categories";
        $config['allowed_types'] = "jpg|jpeg|png|ico";
        $config['file_name'] = "icon_".$id.".".$fileExt; 
        $this->load->library('upload', $config);
        $this->upload->do_upload("file");
        $uploadData = $this->upload->data();
        $data['icon'] = $uploadData['file_name'];
        $this->Category->update($id, $data);
    }

    //@desc     remove icon from database and file
    //@route    GET /categories/:categoryId/removeUpload
    public function removeUpload($id)
    {
        $category = $this->BM->checkById($this->categories, $id);
        $file = "./assets/images/categories/$category->icon";
        if(file_exists($file)){
            unlink($file);  
            $data['icon'] = null;
            $this->BM->updateById($this->categories, $id, $data);
            appJson(["message" => "Hapus foto berhasil"]);
        }
    }
}