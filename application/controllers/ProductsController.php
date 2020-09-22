<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductsController extends CI_Controller
{

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
        $this->user_id = "HjffMkdrUiacMXAM3VVX";
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
                    "createdAt" => "toDateTime",
                ],
            ],
            //querySelector
            'productWithCategories'
        );
        json($products);
    }

    public function create()
    {
        $data['id'] = genUnique(20);
        $data['categories'] = $this->BM->getAll($this->categories);
        $product = $this->BM->getWhere($this->products, ['name' => null, "user_id" => $this->user_id]);
        if ($product) {
            if (count(unserialize($product[0]->cover)) > 0) {
                $cover = unserialize($product[0]->cover);
                foreach ($cover as $cvr) {
                    $file = "./assets/images/products/$cvr";
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
                $this->BM->deleteById($this->products, $product[0]->id);
            }
        }
        $this->load->view('admin/products/create', $data);
    }

    public function add($id)
    {
        $product = $this->BM->getById($this->products, $id);
        if (!$product) {
            appJson(['errors' => [
                "products" => "Foto produk tidak boleh kosong",
            ]]);
            return;
        }
        $product = $this->Product->update($id, $_POST);
        if ($product) {
            appJson(["message" => "Berhasil menambah data Produk"]);
        }
    }

    public function edit($id)
    {
        $product = $this->BM->getById($this->products, $id);
        if (!$product) {
            appJson(['errors' => [
                "products" => "Produk tidak ditemukan",
            ]]);
            return;
        }
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
            return;
        }
        $updateProduct = $this->Product->update($id, $_POST);
        if ($updateProduct) {
            appJson(["message" => "Berhasil mengubah data Produk"]);
        }
    }

    public function delete($id)
    {
        $this->BM->deleteById($this->products, $id);
        appJson($id);
    }

    public function uploads($id)
    {
        $photoId = $this->input->post('id');

        $file = $_FILES['file']['name'];
        $fileExt = pathinfo($file, PATHINFO_EXTENSION);

        $config['upload_path'] = "./assets/images/products";
        $config['allowed_types'] = "jpg|jpeg|png|ico";
        $config['file_name'] = $photoId . $fileExt;

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

    public function removeUpload($id)
    {
        $photoId = $this->input->post('id');

        $product = $this->BM->getById($this->products, $id);
        if (!$product) {
            appJson(["message" => "Produk tidak ditemukan"]);
            return;
        }

        $cover = unserialize($product->cover);
        $filteredImage = array_delete_by_value($cover, $photoId);
        $data['cover'] = serialize($filteredImage);
        $this->BM->updateById($this->products, $id, $data);
        appJson(["message" => "Hapus foto berhasil"]);
    }
}
