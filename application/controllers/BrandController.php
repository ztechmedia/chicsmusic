<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BrandController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->library('Datatables', 'datatables');
        $this->load->helper("utility");
        $this->brands = "brands";
        $this->auth->private();
    }

    //@desc     show brands table
    //@route    GET admin/brands
    public function index()
    {
        $this->load->view("admin/brand/brand");
    }

    //@desc     show data brands table
    //@route    GET /brands/brands-table
    public function brandsTable()
    {
        $brands = $this->datatables->setDatatables(
            $this->brands,
            ["id", "brand_name"],
            ['brand_name'],
            'admin/actions/edit-delete',
            [
                'delete_message' => [
                    'name' => "Yakin ingin menghapus logo merk [bank_name] pada data Merek",
                ],
            ]
        );
        json($brands);
    }

    //@desc     show data brands table
    //@route    GET /brands/brands-table
    public function add()
    {
        $brand = $this->BM->createForId($this->brands, $_POST);
        if($_FILES["file"]['name'] && $brand) {
            $this->uploadIcon($_FILES['file']['name'], $brand);
        }

        if($brand) {
            appJson([
                "message" => "Berhasil menambah data Merek",
            ]);
        }
    }

    public function create()
    {
        $this->load->view('admin/brand/create');
    }

    public function edit($id)
    {
        $brand = $this->BM->checkById($this->brands, $id);
        $data['brand'] = $brand;
        $this->load->view('admin/brand/edit', $data);
    }

    public function update($id)
    {
        $icon = $this->BM->getById($this->brands, $id)->icon;
        $brand = $this->BM->updateById($this->brands, $id, $_POST);
        
        if($_FILES['file']['name']) {
            $this->uploadIcon($_FILES['file']['name'], $id);
            if($icon) {
                $file = "./assets/images/brands/$icon";
                if(file_exists($file)){
                    unlink($file);
                }
            }
        }

        if ($brand) {
            appJson([
                "message" => "Berhasil mengubah data Merek",
            ]);
        }
    }

    public function delete($id)
    {
        $icon = $this->BM->checkById($this->brands, $id)->icon;

        $file = "./assets/images/brands/$icon";
        if (file_exists($file)) {
            unlink($file);
        }

        $this->BM->deleteById($this->brands, $id);
        appJson($id);
    }

    //@desc     upload icon configuration
    public function uploadIcon($file, $id)
    {
        $fileExt = pathinfo($file, PATHINFO_EXTENSION);
        $config['upload_path'] = "./assets/images/brands";
        $config['allowed_types'] = "jpg|jpeg|png|ico";
        $config['file_name'] = "icon_".$id.".".$fileExt; 
        $this->load->library('upload', $config);
        $this->upload->do_upload("file");
        $uploadData = $this->upload->data();
        $data['icon'] = $uploadData['file_name'];
        $this->BM->updateById($this->brands, $id, $data);
    }

    //@desc     remove icon from database and file
    //@route    GET /categories/:categoryId/removeUpload
    public function removeUpload($id)
    {
        $category = $this->BM->checkById($this->brands, $id);
        $file = "./assets/images/brands/$category->icon";
        if(file_exists($file)){
            unlink($file);  
            $data['icon'] = null;
            $this->BM->updateById($this->brands, $id, $data);
            appJson(["message" => "Hapus foto berhasil"]);
        }
    }
}