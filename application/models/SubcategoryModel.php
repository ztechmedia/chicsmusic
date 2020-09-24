<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubcategoryModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //load dependencise
        $this->load->model("BaseModel", "BM");
        $this->load->library('form_validation');
        $this->load->helper('utility');
        //local variabel
        $this->table = 'subcategories';
        $this->validate = ['name'];
    }

    public function create($data, $validate = [])
    {
        $validator = $this->validator($validate ? $validate : $this->validate, $data);
        if ($validator) {
            return $this->BM->createForId($this->table, $data);
        } else {
            appJson(['errors' => $this->form_validation->error_array()]);
            return false;
        }
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

    public function subWithProduct($categoryId)
    {
        
        $query = $this->db->query(
            "SELECT 
                subcategories.*, 
                COUNT(products.id) as total_product
            FROM subcategories
            LEFT JOIN products ON subcategories.id = products.subcategory_id
            WHERE subcategories.category_id = '$categoryId'
            GROUP BY subcategories.id"
        );
        return $query->result();
    }

    public function validator($validate, $data, $id = null)
    {
        $isUnique = $id ? "subcategories.name.$id" : "subcategories.name";

        $rules = [
            "name" => [
                'field' => 'name',
                'label' => 'Category Name',
                'rules' => "required|trim|isUnique[$isUnique]",
                'errors' => [
                    'required' => '* Kategori tidak boleh kosong',
                    'isUnique' => 'Kategori sudah digunakan',
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
