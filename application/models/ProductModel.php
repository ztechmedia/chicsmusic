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
        $this->validate = ['name','brand', 'price', 'weight', 'stock', 'description', 'category_id', 'subcategory_id'];
    }

    public function update($id, $data, $validate = [], $bypass = [])
    {
        $validate = $validate ? $validate : $this->validate;
        $validator = $this->validator($validate, $bypass, $data, $id);
        if ($validator) {
            return $this->BM->updateById($this->table, $id, $data);
        } else {
            appJson(['errors' => $this->form_validation->error_array()]);
            return false;
        }
    }

    public function productWithCategories()
    {
       return $this
                ->db
                ->select('a.id, a.name, a.price, a.weight, a.createdAt, b.name as category, c.name as subcategory')
                ->from('products as a')
                ->join('categories as b', 'a.category_id = b.id')
                ->join('subcategories as c', 'a.subcategory_id = c.id');
    }

    public function productCat($productId)
    {
       return $this
                ->db
                ->select('a.*, b.name as category, c.id as subcategory')
                ->from('products as a')
                ->join('categories as b', 'a.category_id = b.id')
                ->join('subcategories as c', 'a.subcategory_id = c.id')
                ->where('a.id', $productId)
                ->get()->row();
    }

    public function getBanners()
    {
        $banners = $this
                    ->db
                    ->select('a.*,b.id as product_id, b.name as product_name, b.price, b.cover')
                    ->from('banners as a')
                    ->join('products as b', 'a.product_id = b.id')
                    ->get()
                    ->result();
        return $banners;
    }

    public function getBannerById($bannerId)
    {
        $banners = $this
                    ->db
                    ->select('a.*, b.name as product_name, b.price, b.stock, b.cover')
                    ->from('banners as a')
                    ->join('products as b', 'a.product_id = b.id')
                    ->where('a.id', $bannerId)
                    ->get()
                    ->row();
        return $banners;
    }

    public function cartProduct($memberId)
    {
        $carts = $this
                    ->db
                    ->select('a.*, b.price')
                    ->from('carts a')
                    ->join('products b', 'a.product_id = b.id')
                    ->where('a.member_id', $memberId)
                    ->get()
                    ->result_array();
        return $carts;
    }

    public function getCartWithProduct($memberId)
    {
        return $this->db->query("
            SELECT a.member_id, a.qty, b.id AS product_id, b.price, b.name, (b.weight * a.qty) as total_weight, (a.qty * b.price) AS subtotal
            FROM carts AS a
            JOIN products AS b ON a.product_id = b.id
            WHERE a.member_id = '$memberId'
        ")->result();
    }

    public function getLimit($limit, $start, $search, $max, $min, $sort, $brand, $subcategories)
    {
        $this->db->limit($limit, $start);
        $this->db->where("name IS NOT NULL", NULL);

        if($search) {
            $this->db->like("name", $search);
            $this->db->or_like("description", $search);
        }

        if($brand) {
            $this->db->where("brand", $brand);
        }

        if($max) {
            $this->db->where("price <=", $max);
        }

        if($min) {
            $this->db->where("price >=", $min);
        }

        if($subcategories !== "" && $subcategories !== "all") {
            $this->db->where("subcategory_id", $subcategories);
        }

        if($sort) {
            if($sort === "min-price") {
                $this->db->order_by("price", "asc");
            }else if($sort === "max-price") {
                $this->db->order_by("price", "desc");
            }else if($sort === "latest"){
                $this->db->order_by("createdAt", "desc");
            }else if($sort === "oldest"){
                $this->db->order_by("createdAt", "asc");
            }
        }

        return $this->db->get($this->table)->result();
    }

    public function getTotal($search, $max, $min, $sort, $brand, $subcategories)
    {
        $this->db->where("name IS NOT NULL", NULL);

        if($search) {
            $this->db->like("name", $search);
            $this->db->or_like("description", $search);
        }

        if($brand) {
            $this->db->where("brand", $brand);
        }

        if($max) {
            $this->db->where("price <=", $max);
        }

        if($min) {
            $this->db->where("price >=", $min);
        }

        if($subcategories !== "" && $subcategories !== "all") {
            $this->db->where("subcategory_id", $subcategories);
        }

        if($sort) {
            if($sort === "min-price") {
                $this->db->order_by("price", "desc");
            }else if($sort === "max-price") {
                $this->db->order_by("price", "asc");
            }else if($sort === "latest"){
                $this->db->order_by("createdAt", "desc");
            }else if($sort === "oldest"){
                $this->db->order_by("createdAt", "asc");
            }
        }

        return $this->db->get($this->table)->num_rows();
    }

    public function latest($limit)
    {
        return $this->db
                ->limit($limit)
                ->order_by("createdAt", 'desc')
                ->get($this->table)->result();
    }

    public function sold($limit)
    {
        return $this->db
                ->limit($limit)
                ->order_by("sold", 'desc')
                ->get($this->table)->result();
    }

    public function brands()
    {
        return $this->db
                ->select('brand, count(brand) as total_product')
                ->group_by('brand')
                ->get($this->table)->result();
    }

    public function getChartWeight()
    {
      return $this->db->query("
        SELECT sum(a.qty * b.weight) AS berat
        FROM carts AS a
        JOIN products AS b ON a.product_id = b.id
        WHERE member_id = '{$this->auth->userId}'  
      ")->row();
    }

    public function validator($validate, $bypass, $data, $id = null)
    {
        $isUnique = $id ? "products.name.$id" : "products.name";

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
            "brand" => [
                'field' => 'brand',
                'label' => 'Brand',
                'rules' => "required",
                'errors' => [
                    'required' => '* Merek tidak boleh kosong',
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
            "weight" => [
                'field' => 'weight',
                'label' => 'Weight',
                'rules' => "required",
                'errors' => [
                    'required' => '* Berat tidak boleh kosong',
                ],
            ],
            "stock" => [
                'field' => 'stock',
                'label' => 'Product Stock',
                'rules' => "required",
                'errors' => [
                    'required' => '* Stock produk tidak boleh kosong',
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
            if(!in_array($v, $bypass)) {
                $filterRules[] = $rules[$v];
            }
        }

        $this->form_validation->set_rules($filterRules);
        return $this->form_validation->run();
    }
}
