<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrdersController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model('OrderModel', 'Order');
        $this->load->library('Datatables', 'datatables');
        $this->load->helper("utility");
        $this->products = 'orders';
        $this->user_id = $this->auth->userId;
        $this->auth->private();
    }

    public function orders()
    {
        $this->load->view("admin/orders/orders");
    }

    public function ordersTable()
    {
        $orders = $this->datatables->setDatatables(
            $this->orders,
            ["id", "member_name", "courier", "service", "delivery_cost","bank_name", "total", "account", "owner", "createdAt"],
            //column searchable (a = products, b = categories(name), c = subcategories(name))
            ['a.courier', 'a.service', "a.delivery_cost", "a.total, b.member_name, c.bank_name, c.owner"],
            'admin/actions/edit-delete',
            [
                'delete_message' => [
                    'name' => "Yakin ingin menghapus order dari [member_name] pada data Pemesanan",
                ],
                'middleware' => [
                    "total" => "toRp",
                    "createdAt" => "toDateTime",
                ],
            ],
            //querySelector
            'ordersTable'
        );
        json($products);
    }
}