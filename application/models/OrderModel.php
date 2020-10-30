<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrderModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //load dependencise
        $this->load->model("BaseModel", "BM");
        $this->load->library('form_validation');
        $this->load->helper('utility');
        //local variabel
        $this->table = 'orders';
    }

    public function productWithCategories($member_id)
    {
       return $this
                ->db
                ->select('a.id, a.courier, a.service, a.delivery_cost, a.total, b.name AS member_name, c.bank_name, c.account, c.owner')
                ->from('orders as a')
                ->join('users as b', 'a.member_id = b.id')
                ->join('banks as c', 'a.bank_id = c.id');
    }
}