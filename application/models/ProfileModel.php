<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //load dependencise
        $this->load->model("BaseModel", "BM");
        $this->load->helper('utility');
    }

    public function getFullAddress($memberId)
    {
        $address = $this->db->query("
            SELECT a.*, d.name as district_name,
            e.name as village_name
            FROM address as a
            LEFT JOIN districts as d ON a.district_id = d.id
            LEFT JOIN villages as e ON a.village_id = e.id
            WHERE a.member_id = '$memberId'
        ")->result();
        
        return $address;
    }

    public function getAddressById($addressId)
    {
        $address = $this->db->query("
            SELECT a.*, d.name as district_name,
            e.name as village_name
            FROM address as a
            LEFT JOIN districts as d ON a.district_id = d.id
            LEFT JOIN villages as e ON a.village_id = e.id
            WHERE a.id = '$addressId'
        ")->row();
        
        return $address;
    }
}