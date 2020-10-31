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

    public function ordersTable()
    {
       return $this
                ->db
                ->select('a.*, b.name AS member_name, c.bank_name, c.account, c.owner, d.regency_name')
                ->from('orders as a')
                ->join('users as b', 'a.member_id = b.id')
                ->join('banks as c', 'a.bank_id = c.id')
                ->join('address as d', 'a.address_id = d.id');
    }

    public function detailOrder($orderId)
    {
       return $this
                ->db
                ->select('a.*, b.name AS member_name, c.bank_name, c.account, c.owner, d.regency_name')
                ->from('orders as a')
                ->join('users as b', 'a.member_id = b.id')
                ->join('banks as c', 'a.bank_id = c.id')
                ->join('address as d', 'a.address_id = d.id')
                ->where("a.id" , $orderId)
                ->get()->row();
    }
}