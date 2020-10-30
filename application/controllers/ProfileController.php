<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model("ProfileModel", "Profile");
        $this->load->library("form_validation");
        $this->load->library("Request", "request");
        $this->load->helper("utility");
        $this->users = "users";
        $this->provinces = "provinces";
        $this->regencies = "regencies";
        $this->districts = "districts";
        $this->villages = "villages";
        $this->address = "address";
        $this->banks = "banks";
    }

    public function profile($active)
    {
        $data['active'] = $active;
        $data['view'] = "web/profile/profile";
        $data['member'] = $this->BM->getById($this->users, $this->auth->userId);
        $data['address'] = $this->Profile->getFullAddress($this->auth->userId);
        $this->load->view("template/web/app", $data);
    }

    public function editProfile()
    {
        $data['view'] = "web/profile/profile-edit";
        $data['script'] = "web/script/profile_js";
        $data['member'] = $this->BM->getById($this->users, $this->auth->userId);
        $this->load->view("template/web/app", $data);
    }

    public function updateProfile()
    {
        $validator = $this->inputValidator(["name", "email"]);
        if ($validator) {
            $data['name'] = $this->input->post("name");
            $data['email'] = $this->input->post("email");

            $create = $this->BM->updateById($this->users, $this->auth->userId, $data);

            if ($create) {
                appJson([
                    "success" => true,
                    "message" => "Berhasil mengupdate profile",
                ]);
            }
        } else {
            appJson(['errors' => $this->form_validation->error_array()]);
        }
    }

    public function createAddress()
    {
        $data['view'] = "web/profile/address-create";
        $data['script'] = "web/script/address_js";
        $data['provinces'] = $this->request->apiRequest("https://api.rajaongkir.com/starter/province", "GET")->rajaongkir->results;
        $this->load->view("template/web/app", $data);
    }

    public function editAddress($addressId)
    {
        $address = $this->BM->getById($this->address, $addressId);
        $province_id = $address->province_id;
        $data['provinces'] = $this->request->apiRequest("https://api.rajaongkir.com/starter/province", "GET")->rajaongkir->results;
        $data['regencies'] = $this->request->apiRequest("https://api.rajaongkir.com/starter/city?province=$province_id", "GET")->rajaongkir->results;
        $regency_id = $this->BM->getWhere($this->regencies, ['name LIKE' => "%$address->regency_name%"])->row()->id;
        $data['districts'] = $this->BM->getWhere($this->districts, ['regency_id' => $regency_id])->result();
        $data['villages'] = $this->BM->getWhere($this->villages, ['district_id' => $address->district_id])->result();
        $data['address'] = $address;
        $data['view'] ="web/profile/address-edit";
        $data['script'] = 'web/script/address_js';
        $this->load->view("template/web/app", $data);
    }

    public function updateAddress($addressId)
    {
        $validator = $this->inputValidator([
            'address_name', 'name', 'phone', 'address',
            'province_id', 'regency_id', 'district_id',
            'village_id', 'zipcode'
        ]);

        $province = explode(':', $this->input->post('province_id'));
        $regency = explode(':', $this->input->post('regency_id'));

        if($validator) {
            $data = [
                "address_name" => $this->input->post('address_name'),
                "name" => $this->input->post('name'),
                "phone" => $this->input->post('phone'),
                "address" => $this->input->post('address'),
                "province_id" => $province[1],
                "regency_id" => $regency[1],
                "province_name" => $province[0],
                "regency_name" => $regency[0],
                "district_id" => $this->input->post('district_id'),
                "village_id" => $this->input->post('village_id'),
                "zipcode" => $this->input->post('zipcode'),
            ];

            $this->BM->updateById($this->address, $addressId, $data);
        }else{
            appJson(['errors' => $this->form_validation->error_array()]);
        }

        appJson([
            "success" => true,
            "update" => true,
            "message" => "Berhasil mengupdate alamat",
        ]);
    }

    public function getCity()
    {
        $obj = fileGetContent();
        $province = explode(':', $obj->provinceId);
        $regencies = $this->request->apiRequest("https://api.rajaongkir.com/starter/city?province=$province[1]", "GET")->rajaongkir->results;
        $option = "<option value=''>Pilih Kota</option>";
        foreach ($regencies as $regency) {
            $value = $regency->city_name.":".$regency->city_id;
            $option .= "<option value='$value'>$regency->type $regency->city_name</option>";
        }
        appJson(["view" => $option]);
    }

    public function getDistrict()
    {
        $obj = fileGetContent();
        $regency = explode(':', $obj->regencyId);
        $city = $this->request->apiRequest("https://api.rajaongkir.com/starter/city?id=$regency[1]", "GET")->rajaongkir->results;
        $city_name = $city->type." ".$city->city_name;
        $regencyId = $this->BM->getLike($this->regencies, "name", $city_name)->row()->id;
        $districts = $this->BM->getWhere($this->districts, ['regency_id' => $regencyId])->result();
        $option = "<option value=''>Pilih Kecamatan</option>";
        foreach ($districts as $district) {
            $name = ucwords(strtolower($district->name));
            $option .= "<option value='$district->id'>$name</option>";
        }
       appJson(["view" => $option]);
    }

    public function getVillage($districtId)
    {
        $villages = $this->BM->getWhere($this->villages, ['district_id' => $districtId])->result();
        $option = "<option value=''>Pilih Kelurahan</option>";
        foreach ($villages as $village) {
            $name = ucwords(strtolower($village->name));
            $option .= "<option value='$village->id'>$name</option>";
        }
        echo $option;
    }

    public function addAddress()
    {
        $validator = $this->inputValidator([
            'address_name', 'name', 'phone', 'address',
            'province_id', 'regency_id', 'district_id',
            'village_id', 'zipcode'
        ]);

        $province = explode(':', $this->input->post('province_id'));
        $regency = explode(':', $this->input->post('regency_id'));

        if($validator) {
            $data = [
                'member_id' => $this->auth->userId,
                "address_name" => $this->input->post('address_name'),
                "name" => $this->input->post('name'),
                "phone" => $this->input->post('phone'),
                "address" => $this->input->post('address'),
                "province_id" => $province[1],
                "regency_id" => $regency[1],
                "province_name" => $province[0],
                "regency_name" => $regency[0],
                "district_id" => $this->input->post('district_id'),
                "village_id" => $this->input->post('village_id'),
                "zipcode" => $this->input->post('zipcode'),
            ];

            $this->BM->create($this->address, $data);
        }else{
            appJson(['errors' => $this->form_validation->error_array()]);
        }

        appJson([
            "success" => true,
            "message" => "Berhasil menambah alamat",
        ]);
    }

    public function detailAddress($addressId)
    {
        $data['address'] =  $this->Profile->getAddressById($addressId);
        $regency_id = $data['address']->regency_id;
        $province_id = $data['address']->province_id;
        $this->load->view("web/profile/address_detail", $data);
    }

    public function detailBank($bankId)
    {
        $bank = $this->BM->getById($this->banks, $bankId);
        echo "<h5>$bank->bank_name No. Rek: $bank->account <br> a/n $bank->owner</h5>";
    }

    public function inputValidator($validate)
    {
        // $isUnique = $id ? "users.email.$id" : "users.email";
        $rules = [
            "name" => [
                'field' => 'name',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Nama tidak boleh kosong',
                ],
            ],
            "email" => [
                'field' => 'email',
                'label' => 'Email',
                'rules' => "required|trim|isUnique[users.email.{$this->auth->userId}]",
                'errors' => [
                    'required' => '* Email tidak boleh kosong',
                    'isUnique' => 'Email sudah digunakan',
                ],
            ],
            "address_name" => [
                'field' => 'address_name',
                'label' => 'Address Name',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Nama alamat tidak boleh kosong',
                ],
            ],
            "phone" => [
                'field' => 'phone',
                'label' => 'Phone',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Nomor telpon tidak boleh kosong',
                ],
            ],
            "address" => [
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Alamat telpon tidak boleh kosong',
                ],
            ],
            "province_id" => [
                'field' => 'province_id',
                'label' => 'Province',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Provinsi tidak boleh kosong',
                ],
            ],
            "regency_id" => [
                'field' => 'regency_id',
                'label' => 'Regency',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Kota tidak boleh kosong',
                ],
            ],
            "district_id" => [
                'field' => 'district_id',
                'label' => 'District',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Kecamatan tidak boleh kosong',
                ],
            ],
            "village_id" => [
                'field' => 'village_id',
                'label' => 'Village',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Kelurahan tidak boleh kosong',
                ],
            ],
            "zipcode" => [
                'field' => 'zipcode',
                'label' => 'Zipcode',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Kode pos tidak boleh kosong',
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