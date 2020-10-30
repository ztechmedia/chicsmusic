<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ShopController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Search", "search");
        $this->load->library('cart');
        $this->load->library("form_validation");
        $this->load->library("Request", "request");
        $this->load->model("BaseModel", "BM");
        $this->load->model("ProductModel", "Product");
        $this->load->model("CategoryModel", "Category");
        $this->load->helper("response");
        $this->categories = 'categories';
        $this->subcategories = 'subcategories';
        $this->store_categories = 'store_categories';
        $this->products = 'products';
        $this->comments = 'comments';
        $this->reviews = 'reviews';
        $this->carts = 'carts';
        $this->address = 'address';
        $this->banks = 'banks';
        $this->brands = 'brands';
        $this->orders = "orders";
        $this->store_address = 'store_address';
    }

    public function home()
    {
        $data['view'] = "web/home";
        $data['banners'] = $this->Product->getBanners();
        $data['categories'] = $this->BM->getAll($this->store_categories)->result();
        $data['latest'] = $this->Product->latest(8);
        $data['sold'] = $this->Product->sold(8);
        $data['favorites'] = $this->BM->getWhere($this->products, ["fav" => 1])->result();
        $data['brands'] = $this->BM->getAll($this->brands)->result();
        $this->load->view("template/web/app", $data);
    }

    public function products()
    {
        $data['view'] = 'web/products';
        $data['categories'] = $this->Category->catWithSub();
        $data['brands'] = $this->Product->brands();
        $data['data'] = $this->search->advanceSearch($this->Product, $_GET);

        $this->load->view('template/web/app', $data);
    }

    public function productDetail($productId)
    {
        $product = $this->Product->productCat($productId);
        $data['view'] = 'web/product_detail';
        $data['script'] = 'web/script/product_detail_js';
        $data['product'] = $product;
        if ($this->auth->role === "member") {
            $data['name'] = $this->auth->name;
            $data['email'] = $this->auth->email;
        }
        $this->load->view("template/web/app", $data);
    }

    public function commentList($productId)
    {
        $comments = $this->BM->getWhere($this->comments, ['product_id' => $productId])->result();

        $newComments = [];
        foreach ($comments as $comment) {
            if ($comment->parent === null) {
                $newComments[] = $comment;
            }

            foreach ($comments as $comm) {
                if ($comm->parent === $comment->id) {
                    $newComments[] = $comm;
                }
            }
        }
        $data['comments'] = $newComments;
        $this->load->view("web/comment/comment_list", $data);
    }

    public function reviewList($productId)
    {
        $reviews = $this->BM->getWhere($this->reviews, ["product_id" => $productId])->result();
        $five = 0;
        $four = 0;
        $three = 0;
        $two = 0;
        $one = 0;
        $totalStar = 0;
        foreach ($reviews as $review) {
            if ($review->star == 5) {
                $five++;
            } else if ($review->star == 4) {
                $four++;
            } else if ($review->star == 3) {
                $three++;
            } else if ($review->star == 2) {
                $two++;
            } else if ($review->star == 1) {
                $one++;
            }
            $totalStar += $review->star;
        }

        $average = count($reviews) > 0 ? ($totalStar / count($reviews)) : 0;

        $data = [
            "reviews" => $reviews,
            "five" => $five,
            "four" => $four,
            "three" => $three,
            "two" => $two,
            "one" => $one,
            "avg" => number_format($average, 2, '.', ''),
        ];
        $this->load->view("web/review/review_list", $data);
    }

    public function postReview($productId)
    {
        $validator = $this->inputValidator(["name", "email", "comment", "star"]);
        if ($validator) {
            $data['star'] = $this->input->post("star");
            $data['name'] = $this->input->post("name");
            $data['email'] = $this->input->post("email");
            $data['comment'] = $this->input->post("comment");
            $data['product_id'] = $productId;

            $create = $this->BM->create($this->reviews, $data);

            if ($create) {
                appJson([
                    "success" => true,
                    "message" => "Berhasil mengirim ulasan",
                ]);
            }
        } else {
            appJson(['errors' => $this->form_validation->error_array()]);
        }
    }

    public function addCart()
    {
        $post = fileGetContent();
        if ($this->auth->role === "member") {
            $stock = $this->BM->getById($this->products, $post->product_id)->stock;
            $prodCart = $this->BM->getWhere($this->carts, ['product_id' => $post->product_id])->row();
            if($prodCart) {
                if($post->qty < $stock) {
                    $data['qty'] = $post->qty;
                    $this->BM->updateById($this->carts, $prodCart->id, $data);
                }
            }else{
                if($post->qty < $stock) {
                    $data['product_id'] = $post->product_id;
                    $data['qty'] = $post->qty;
                    $data['member_id'] = $this->auth->userId;
                    $this->BM->create($this->carts, $data);
                }
            }
        } else {
            $cart = $this->cart->contents();
            $stock = $this->BM->getById($this->products, $post->product_id)->stock;
            $key = array_search_key($cart, $post->product_id, 'id');
            if ($key !== null) {
                if ($post->qty <= $stock) {
                    $data = array(
                        'rowid' => $key,
                        "name" => $post->name,
                        'qty' => $post->qty,
                        "price" => $post->price,
                        "rowid" => $rowid[$product->id],
                    );
                    $this->cart->update($data);
                }
            } else {
                if ($post->qty <= $stock) {
                    $data = array(
                        "id" => $post->product_id,
                        "name" => $post->name,
                        "qty" => $post->qty,
                        "price" => $post->price,
                    );
                    $this->cart->insert($data);
                }
            }
        }

        appJson([
            "success" => true,
            "message" => "Berhasil menambahkan barang ke keranjang",
        ]);
    }

    public function checkCart()
    {
        if($this->auth->role === "member") {
            $carts = $this->BM->getWhere($this->carts, ['member_id' => $this->auth->userId])->num_rows();
            echo $carts;
        }else{
            echo count($this->cart->contents());
        }
        
    }

    public function postComment($productId)
    {
        $validator = $this->inputValidator(["name", "email", "comment"]);
        if ($validator) {
            $data['name'] = $this->input->post("name");
            $data['email'] = $this->input->post("email");
            $data['comment'] = $this->input->post("comment");
            $data['status'] = $this->input->post("status");
            $data['product_id'] = $productId;

            $create = $this->BM->create($this->comments, $data);

            if ($create) {
                appJson([
                    "success" => true,
                    "message" => "Berhasil mengirim komentar",
                ]);
            }
        } else {
            appJson(['errors' => $this->form_validation->error_array()]);
        }
    }

    public function postReplyComment($commentId, $productId)
    {
        $validator = $this->inputValidator(["name", "email", "comment"]);
        if ($validator) {
            $data['name'] = $this->input->post("name");
            $data['email'] = $this->input->post("email");
            $data['comment'] = $this->input->post("comment");
            $data['status'] = $this->input->post("status");
            $data['parent'] = $commentId;
            $data['product_id'] = $productId;

            $create = $this->BM->create($this->comments, $data);

            if ($create) {
                appJson([
                    "success" => true,
                    "message" => "Berhasil mengirim komentar",
                    "comment_id" => $commentId,
                ]);
            }
        } else {
            appJson(['errors' => $this->form_validation->error_array()]);
        }
    }

    public function commentBox($commentId)
    {
        $comment = $this->BM->checkById($this->comments, $commentId);
        $data['comment_id'] = $comment->id;
        $data['product_id'] = $comment->product_id;
        if ($this->auth->role === "member") {
            $data['name'] = $this->auth->name;
            $data['email'] = $this->auth->email;
        }
        $this->load->view("web/comment/comment_box", $data);
    }

    public function inputValidator($validate)
    {
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
                'rules' => "required|trim|valid_email",
                'errors' => [
                    'required' => '* Email tidak boleh kosong',
                    'valid_email' => 'Format email tidak benar',
                ],
            ],
            "comment" => [
                'field' => 'comment',
                'label' => 'Comment',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Komentar tidak boleh kosong',
                ],
            ],
            "star" => [
                'field' => 'star',
                'label' => 'Star',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Anda belum memberikan ratings',
                ],
            ],
            "store_name" => [
                'field' => 'store_name',
                'label' => 'Store Name',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Nama toko tidak boleh kosong',
                ],
            ],
            "address" => [
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Alamat toko tidak boleh kosong',
                ],
            ],
            "province_id" => [
                'field' => 'province_id',
                'label' => 'Province ID',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Provinsi tidak boleh kosong',
                ],
            ],
            "city_id" => [
                'field' => 'city_id',
                'label' => 'City ID',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Kota tidak boleh kosong',
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

    public function carts()
    {
        $data['view'] = 'web/carts';
        $data['script'] = 'web/script/carts_js';
        $id = [];
        $qty = [];

        if($this->auth->role === "member") {
            $carts = $this->BM->getWhere($this->carts, ['member_id' => $this->auth->userId])->result_array();
            foreach ($carts as $cart) {
                $id[] = $cart['product_id'];
                $qty[$cart['product_id']] = $cart['qty'];
            }
        }else{
            $carts = $this->cart->contents();
            foreach ($carts as $cart) {
                $id[] = $cart['id'];
                $qty[$cart['id']] = $cart['qty'];
            }
        }

        $newCart = [];

        if (count($id) > 0) {
            $products = $this->BM->whereIn($this->products, 'id', $id)->result();

            foreach ($products as $product) {
                $covers = unserialize($product->cover);
                $newCart[] = [
                    "product_id" => $product->id,
                    "name" => $product->name,
                    "qty" => $qty[$product->id],
                    "price" => $product->price,
                    "weight" => $product->weight,
                    "subtotal" => $product->price * $qty[$product->id],
                    "stock" => $product->stock,
                    "cover" => $covers[0],
                ];
            }
        }

        $data['carts'] = $newCart;
        $this->load->view("template/web/app", $data);
    }

    public function addQty()
    {
        $obj = fileGetContent();
        $productId = $obj->product_id;
        $qty = $obj->qty;
        $total = 0;
        $subtotal = 0;

        if($this->auth->role === "member") {
            $data['qty'] = $qty;
            $this->BM->update($this->carts, $productId, 'product_id', $data);
            $newCart = $this->Product->cartProduct($this->auth->userId);
            foreach ($newCart as $cart) {
                $total += ($cart['price'] * $cart['qty']);
                if($cart['product_id'] === $productId) {
                    $subtotal = ($cart['price'] * $cart['qty']);
                }
            }
        }else{
            $carts = $this->cart->contents();
            $key = array_search_key($carts, $productId, 'id');
            $subtotal = $carts[$key]['price'] * $qty;
            $data = array(
                'rowid' => $key,
                'qty' => $qty,
            );
    
            $this->cart->update($data);
    
            $newCart = $this->cart->contents();
            foreach ($newCart as $cart) {
                $total += $cart['subtotal'];
            }
        }

        appJson([
            "success" => true,
            "subtotal" => toRp($subtotal),
            "product_id" => $productId,
            "total" => toRp($total),
        ]);
    }

    public function checkout()
    {
        $data['view'] = 'web/checkout';
        $data['script'] = 'web/script/checkout_js';
        $data['address'] = $this->BM->getWhere($this->address, ['member_id' => $this->auth->userId])->result();
        $data['banks'] = $this->BM->getAll($this->banks)->result();
        $data['carts'] = $this->Product->getCartWithProduct($this->auth->userId);
        $this->load->view("template/web/app", $data);
    }

    public function storeAddress()
    {
        $data['address'] = $this->BM->getById($this->store_address, 1);
        $province_id = $data['address']->province_id;
        $data['provinces'] = $this->request->apiRequest("https://api.rajaongkir.com/starter/province", "GET")->rajaongkir->results;
        $data['cities'] = $this->request->apiRequest("https://api.rajaongkir.com/starter/city?province=$province_id", "GET")->rajaongkir->results;
        $this->load->view("admin/store_address/address", $data);
    }

    public function storeAddressUpdate()
    {
        $validator = $this->inputValidator(["store_name", "address", "province_id", "city_id"]);
        if($validator) {
            $data = [
                "store_name" => $this->input->post('store_name'),
                "address" => $this->input->post('address'),
                "province_id" => $this->input->post('province_id'),
                "city_id" => $this->input->post('city_id')
            ];

            $this->BM->updateById($this->store_address, 1, $data);
            appJson(["message" => "Berhasil mengubah alamat toko"]);
        }else{
            appJson(['errors' => $this->form_validation->error_array()]);
        }
    }

    public function ongkir($addressId, $total, $code = "jne")
    {
        $address = $this->BM->getById($this->address, $addressId);
        $storeAddress = $this->BM->getById($this->store_address, 1);
        $cityDestination = $address->regency_id;
        $cityOrigin = $storeAddress->city_id;
        $weight = $this->Product->getChartWeight()->berat;
        if($code === "jne") {
            $params = "origin=$cityOrigin&destination=$cityDestination&weight=$weight&courier=jne";
            $rajaongkir = $this->request->apiRequest("https://api.rajaongkir.com/starter/cost", "POST", $params)->rajaongkir;
            $data['couriers'] = $rajaongkir->results[0]->costs;
            $data['couriername'] = $rajaongkir->results[0]->name;
        } else {
            $data['couriers'] = [];
        }

        $data['total'] = $total;
        $this->load->view("web/ongkir", $data);
    }

    public function logout()
    {
        $this->session->unset_userdata(SESSION_KEY);
        redirect("/");
    }

    public function pay()
    {
        $member_id = $this->auth->userId;
        $obj = fileGetContent();
        $products = $this->Product->getCartWithProduct($member_id);
        $newProducts = [];
        foreach ($products as $product) {
            $newProducts[] = [
                'name' => $product->name,
                'product_id' => $product->product_id,
                'price' => $product->price,
                'qty' => $product->qty,
                'total_weight' => $product->total_weight,
                'subtital' => $product->subtotal
            ];
        }
        $costs = explode(":", $obj->total_cost);
        $courier = explode("-", $costs[0]);
        $data['products'] = serialize($newProducts);
        $data['total'] = str_replace(".", "", str_replace("Rp ", "", $costs[2]));
        $data['delivery_cost'] = $costs[1];
        $data['courier'] = $courier[0];
        $data['service'] = $courier[1];
        $data['member_id'] = $member_id;
        $data['address_id'] = $obj->addressId;
        $data['bank_id'] = $obj->bankId;

        $save = $this->BM->create($this->orders, $data);
        if($save) {
            $this->BM->delete($this->carts, ['member_id' => $member_id]);
            appJson([
                "success" => true,
                "message" => "Berhasil membuat pesanan"
            ]);
        }
    }
}
