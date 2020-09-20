<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RoleModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //load dependencise
        $this->load->model("BaseModel", "BM");
        $this->load->library('form_validation');
        $this->load->helper('utility');
        //local variabel
        $this->table = 'roles';
        $this->validate = ['name', 'display_name'];
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
        $isUnique = $id ? "roles.name.$id" : "roles.name";
        $isUnique2 = $id ? "roles.display_name.$id" : "roles.display_name";

        $rules = [
            "name" => [
                'field' => 'name',
                'label' => 'Role Name',
                'rules' => "required|trim|isUnique[$isUnique]",
                'errors' => [
                    'required' => '* Nama role tidak boleh kosong',
                    'isUnique' => 'Nama role sudah digunakan',
                ],
            ],
            "display_name" => [
                'field' => 'display_name',
                'label' => 'Display Name',
                'rules' => "required|trim|isUnique[$isUnique2]",
                'errors' => [
                    'required' => '* Nama tampilan tidak boleh kosong',
                    'isUnique' => 'Nama tampilan sudah digunakan',
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
