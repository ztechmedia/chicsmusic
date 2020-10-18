<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BankModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //load dependencise
        $this->load->model("BaseModel", "BM");
        $this->load->library('form_validation');
        $this->load->helper('utility');
        //local variabel
        $this->table = 'banks';
        $this->validate = ['owner', 'account', 'bank_name'];
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

    public function validator($validate, $data, $id = null)
    {
        $isUnique = $id ? "categories.name.$id" : "categories.name";

        $rules = [
            "owner" => [
                'field' => 'owner',
                'label' => 'Owner',
                'rules' => "required|trim",
                'errors' => [
                    'required' => '* Nama pemilik rekening tidak boleh kosong',
                ],
            ],
            "account" => [
                'field' => 'account',
                'label' => 'Account Name',
                'rules' => "required|trim|isUnique[$isUnique]",
                'errors' => [
                    'required' => '* Nomor Rekening tidak boleh kosong',
                    'isUnique' => 'Nomor Rekening sudah digunakan',
                ],
            ],
            "bank_name" => [
                'field' => 'bank_name',
                'label' => 'Bank Name',
                'rules' => "required|trim",
                'errors' => [
                    'required' => '* Nama bank tidak boleh kosong',
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
