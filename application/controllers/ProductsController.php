<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductsController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model('ProductModel', 'Product');
        $this->load->library('encryption');
        $this->load->library('Datatables', 'datatables');
        $this->load->helper("utility");
        $this->load->helper('response');
        $this->products = 'products';
        $this->categories = 'categories';
        $this->subcategories = 'subcategories';
    }

	public function products()
	{
        $this->load->view('admin/products/products');
    }
    
    public function productsTable()
    {
        $products = $this->datatables->setDatatables(
            //table
            $this->products,
            //columns to show
            ["id", "name", "price", "category", "subcategory", "createdAt"],
            //column searchable (a = products, b = categories(name), c = subcategories(name))
            ['a.name', 'a.price', "b.name", "c.name"],
            //actions view path
            'admin/actions/edit-delete',
            //others params
            [
                'delete_message' => [
                    'name' => "Yakin ingin menghapus [name] pada data Produk",
                ],
                'middleware' => [
                    "price" => "toRp",
                    "createdAt" => "toDateTime"
                ]
            ],
            //querySelector
            'productWithCategories'
        );
        json($products);
    }

    public function create()
    {
        $data['categories'] = $this->BM->getAll($this->categories);
        $this->load->view('admin/products/create', $data);
    }

    public function add()
    {
        $_POST['price'] = cleanRp($_POST['price']);
        $product = $this->Product->create($_POST);
        if ($product) {
            appJson([
                "message" => "Berhasil menambah data Produk",
            ]);
        }
    }

    public function edit($id)
    {
        $data['categories'] = $this->BM->getAll($this->categories);
        $data['product'] = $this->BM->getById($this->products, $id);
        $this->load->view('admin/products/edit', $data);
    }

    public function update($id)
    {
        $_POST['price'] = cleanRp($_POST['price']);
        $product = $this->BM->getById($this->products, $id);
        if (!$product) {
            appJson(['message' => "Produk tidak ditemukan"]);
        }
        $updateProduct = $this->Product->update($id, $_POST);
        if ($updateProduct) {
            appJson([
                "message" => "Berhasil mengubah data Produk",
            ]);
        }
    }

    public function delete($id)
    {
        $this->BM->deleteById($this->products, $id);
        appJson($id);
    }
}
