<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BankController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model("BankModel", "Bank");
        $this->load->library('Datatables', 'datatables');
        $this->load->helper("utility");
        $this->banks = "banks";
        $this->auth->private();
    }

    //@desc     show bank table
    //@route    GET admin/bank
    public function index()
    {
        $this->load->view("admin/bank/bank");
    }

    //@desc     show data categories table
    //@route    GET /categories/categories-table
    public function bankTable()
    {
        $categories = $this->datatables->setDatatables(
            $this->banks,
            ["id", "owner", "account", "bank_name"],
            ['owner', 'bank_name'],
            'admin/actions/edit-delete',
            [
                'delete_message' => [
                    'name' => "Yakin ingin menghapus bank [bank_name] pada data Rekening",
                ],
            ]
        );
        json($categories);
    }

    //@desc     show data categories table
    //@route    GET /categories/categories-table
    public function add()
    {
        $bank = $this->Bank->create($_POST);
        if($_FILES["file"]['name'] && $bank) {
            $this->uploadIcon($_FILES['file']['name'], $bank);
        }

        if($bank) {
            appJson([
                "message" => "Berhasil menambah data Rekening",
            ]);
        }
    }

    public function create()
    {
        $this->load->view('admin/bank/create');
    }

    public function edit($id)
    {
        $bank = $this->BM->checkById($this->banks, $id);
        $data['bank'] = $bank;
        $this->load->view('admin/bank/edit', $data);
    }

    public function update($id)
    {
        $icon = $this->BM->getById($this->banks, $id)->icon;
        $bank = $this->Bank->update($id, $_POST);
        
        if($_FILES['file']['name']) {
            $this->uploadIcon($_FILES['file']['name'], $id);
            if($icon) {
                $file = "./assets/images/banks/$icon";
                if(file_exists($file)){
                    unlink($file);
                }
            }
        }

        if ($bank) {
            appJson([
                "message" => "Berhasil mengubah data Rekening",
            ]);
        }
    }

    public function delete($id)
    {
        $icon = $this->BM->checkById($this->banks, $id)->icon;

        $file = "./assets/images/banks/$icon";
        if (file_exists($file)) {
            unlink($file);
        }

        $this->BM->deleteById($this->banks, $id);
        appJson($id);
    }

    //@desc     upload icon configuration
    public function uploadIcon($file, $id)
    {
        $fileExt = pathinfo($file, PATHINFO_EXTENSION);
        $config['upload_path'] = "./assets/images/banks";
        $config['allowed_types'] = "jpg|jpeg|png|ico";
        $config['file_name'] = "icon_".$id.".".$fileExt; 
        $this->load->library('upload', $config);
        $this->upload->do_upload("file");
        $uploadData = $this->upload->data();
        $data['icon'] = $uploadData['file_name'];
        $this->Bank->update($id, $data);
    }

    //@desc     remove icon from database and file
    //@route    GET /categories/:categoryId/removeUpload
    public function removeUpload($id)
    {
        $category = $this->BM->checkById($this->banks, $id);
        $file = "./assets/images/banks/$category->icon";
        if(file_exists($file)){
            unlink($file);  
            $data['icon'] = null;
            $this->BM->updateById($this->banks, $id, $data);
            appJson(["message" => "Hapus foto berhasil"]);
        }
    }
}