<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //load dependencise
        $this->load->model("BaseModel", "BM");
        $this->load->library('form_validation');
        $this->load->helper('utility');
        //local variabel
        $this->table = 'products';
        $this->validate = ['name', 'price', 'description', 'category_id', 'subcategory_id'];
    }

    public function update($id, $data, $validate = [])
    {
        $validator = $this->validator($validate ? $validate : $this->validate, $data, $id);
        if ($validator) {
            return $this->BM->updateById($this->table, $id, $data);
        } else {
            appJson(['errors' => $this->form_validation->error_array()]);
            return false;
        }
    }

    public function validator($validate, $data, $id = null)
    {
        $isUnique = $id ? "categories.name.$id" : "categories.name";

        $rules = [
            "name" => [
                'field' => 'name',
                'label' => 'Product Name',
                'rules' => "required|trim|isUnique[$isUnique]",
                'errors' => [
                    'required' => '* Nama produk tidak boleh kosong',
                    'isUnique' => 'Nama produk sudah digunakan',
                ],
            ],
            "price" => [
                'field' => 'price',
                'label' => 'Price',
                'rules' => "required",
                'errors' => [
                    'required' => '* Harga tidak boleh kosong',
                ],
            ],
            "description" => [
                'field' => 'description',
                'label' => 'Description',
                'rules' => "required",
                'errors' => [
                    'required' => '* Deskripsi tidak boleh kosong',
                ],
            ],
            "category_id" => [
                'field' => 'category_id',
                'label' => 'Category ID',
                'rules' => "required",
                'errors' => [
                    'required' => '* Kategori tidak boleh kosong',
                ],
            ],
            "subcategory_id" => [
                'field' => 'subcategory_id',
                'label' => 'Subcategory ID',
                'rules' => "required",
                'errors' => [
                    'required' => '* Subkategori tidak boleh kosong',
                ],
            ],
        ];

        $filterRules = [];

        foreach ($validate as $v) {
            $filterRules[] = $rules[$v];
        }

        $this->form_validation->set_rules($filterRules);
        return $this->form_validation->run();
    }
}
