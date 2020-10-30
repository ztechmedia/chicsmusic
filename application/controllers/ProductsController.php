<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductsController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model('ProductModel', 'Product');
        $this->load->library('Datatables', 'datatables');
        $this->load->library("Search", "search");
        $this->load->helper("utility");
        $this->products = 'products';
        $this->categories = 'categories';
        $this->subcategories = 'subcategories';
        $this->user_id = $this->auth->userId;
        $this->auth->private();
    }

    //@desc     show products table
    //@route    GET /products
    public function products()
    {
        $this->load->view('admin/products/products');
    }

    //@desc     show data products table
    //@route    GET /products/products-table
    public function productsTable()
    {
        $products = $this->datatables->setDatatables(
            $this->products,
            ["id", "name", "price", "weight", "category", "subcategory", "createdAt"],
            //column searchable (a = products, b = categories(name), c = subcategories(name))
            ['a.name', 'a.price', "b.name", "c.name"],
            'admin/actions/edit-delete',
            [
                'delete_message' => [
                    'name' => "Yakin ingin menghapus [name] pada data Produk",
                ],
                'middleware' => [
                    "price" => "toRp",
                    "createdAt" => "toDateTime",
                ],
            ],
            //querySelector
            'productWithCategories'
        );
        json($products);
    }

    //@desc     create products view
    //@route    GET /products/create
    public function create()
    {
        $data['id'] = genUnique(20);
        $data['categories'] = $this->BM->getAll($this->categories)->result();
        $product = $this->BM->getWhere($this->products, ['name' => null, "user_id" => $this->user_id])->result();
        if (!$product) {
            $this->load->view('admin/products/create', $data);
        } else {
            $data['product'] = $product[0];
            $this->load->view('admin/products/edit', $data);
        }
    }

    //@desc     create products logic
    //@route    POST /products/add
    public function add($id)
    {
        $product = $this->BM->getById($this->products, $id);
        if (!$product) {
            appJson(['errors' => [
                "products" => "Foto produk tidak boleh kosong",
            ]]);
        }
    
        $_POST['price'] = cleanRp($_POST['price']);
        $product = $this->Product->update($id, $_POST);
        if ($product) {
            appJson(["message" => "Berhasil menambah data Produk"]);
        }
    }

    //@desc     update products view
    //@route    GET /products/:productId/edit
    public function edit($id)
    {
        $product = $this->BM->checkById($this->products, $id);
        $cover = [];
        $productCover = unserialize($product->cover);
        foreach ($productCover as $cvr) {
            $cover[] = $cvr;
        }

        $data['categories'] = $this->BM->getAll($this->categories)->result();
        $data['product'] = $product;
        $data['cover'] = $cover;

        $this->load->view('admin/products/edit', $data);
    }

    //@desc     update products logic
    //@route    POST /products/:productId/update
    public function update($id)
    {
        $_POST['price'] = cleanRp($_POST['price']);
        $product = $this->Product->update($id, $_POST, null, ['stock']);

        if ($product) {
            appJson(["message" => "Berhasil mengubah data Produk"]);
        }
    }

    //@desc     delete products logic
    //@route    GET /products/:productId/delete
    public function delete($id)
    {
        $product = $this->BM->checkById($this->products, $id);

        $covers = unserialize($product->cover);
        if (count($covers) > 0) {
            foreach ($covers as $cover) {
                $file = "./assets/images/products/$cover";
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }

        $this->BM->deleteById($this->products, $id);
        appJson($id);
    }

    //@desc     upload cover products logic
    //@route    POST /products/:productId/uploads
    public function uploads($id)
    {
        $photoId = $this->input->post('id');

        $file = $_FILES['file']['name'];
        $fileExt = pathinfo($file, PATHINFO_EXTENSION);
        $config['upload_path'] = "./assets/images/products";
        $config['allowed_types'] = "jpg|jpeg|png|ico";
        $config['file_name'] = $photoId . "." . $fileExt;

        $this->load->library('upload', $config);
        $this->upload->do_upload("file");
        $uploadData = $this->upload->data();

        $products = $this->BM->getById($this->products, $id);

        if ($products) {
            if ($products->cover) {
                $cover = unserialize($products->cover);
                array_push($cover, $uploadData['file_name']);
                $data['cover'] = serialize($cover);
                $this->BM->updateById($this->products, $id, $data);
            }
        } else {
            $cover[] = $uploadData['file_name'];
            $data = [
                "id" => $id,
                "cover" => serialize($cover),
                "user_id" => $this->user_id,
            ];
            $this->BM->create($this->products, $data);
        }
    }

    //@desc     remove cover from database and file
    //@route    POST /products/:productId/removeUpload
    public function removeUpload($id)
    {
        $photoId = $this->input->post('id');
        $product = $this->BM->getById($this->products, $id);
        if (!$product) {
            appJson(["message" => "Produk tidak ditemukan"]);
            return;
        }

        $covers = unserialize($product->cover);
        $selectCover = "";

        foreach ($covers as $cover) {
            if(strpos($cover, $photoId) !== false) {
                $selectCover = $cover;
            }
        }

        $filteredImage = array_delete_by_value($covers, $selectCover);
        $data['cover'] = serialize($filteredImage);

        $file = "./assets/images/products/$selectCover";
        if (file_exists($file)) {
            unlink($file);
        }

        if(count($filteredImage) === 0 && !$product->name) {
            $this->BM->deleteById($this->products, $id);
        }else{
            $this->BM->updateById($this->products, $id, $data);
        }
        
        appJson(["message" => "Hapus foto berhasil"]);
    }

    //@desc     delete multiple products cover logic
    //@route    POST /products/:productId/delete-covers
    public function deleteCovers($id)
    {
        $obj = fileGetContent();
        $product = $this->BM->checkById($this->products, $id);

        $cover = unserialize($product->cover);
        foreach ($obj->cover as $cvr) {
            $cover = array_delete_by_value($cover, $cvr);
            $file = "./assets/images/products/$cvr";
            if (file_exists($file)) {
                unlink($file);
            }
        }

        $data['cover'] = serialize($cover);
        $newProduct = $this->BM->updateById($this->products, $id, $data);
        if ($newProduct) {
            appJson([
                "message" => "Berhasil menghapus cover produk",
            ]);
        }
    }

    //@desc     show product grid
    //@route    GET /products-grid
    public function productsGrid(Type $var = null)
    {
        $this->load->view('admin/products/grid/products');
    }

    //@desc     show data of product grid
    //@route    GET /products-grid-list
    public function productsGridList()
    {
        $data = $this->search->advanceSearch($this->Product, $_GET);
        if($data) {
            $this->load->view("admin/products/grid/product_list", $data);
        }else{
            $this->load->view("admin/products/grid/product_empty");
        }
    }

    //@desc     product stock view
    //@route    POST admin/products/:productId/stock
    public function stock($productId)
    {
        $product = $this->BM->checkById($this->products, $productId);
        $data['product'] = $product;
        $this->load->view("admin/products/stock", $data);
    }

    //@desc     updte stock from product
    //@route    POST admin/products/:productId/stock-update
    public function updateStock($productId)
    {
        $obj = fileGetContent();
        $stock = $obj->stock;

        $product = $this->BM->checkById($this->products, $productId);
        $data["stock"] = $stock;
        $this->BM->updateById($this->products, $productId, $data);
    }

    public function productFav()
    {
       $obj = fileGetContent();
       $data["fav"] = $obj->fav;
       $this->BM->updateById($this->products, $obj->productId, $data);
       appJson(["message" => "Berhasil mengubah status unggulan"]);
    }

}
