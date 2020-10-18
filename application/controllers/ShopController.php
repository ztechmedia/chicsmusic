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
        $this->load->model("ProductModel", "Product");
        $this->load->model("CategoryModel", "Category");
        $this->load->helper("response");
        $this->categories = 'categories';
        $this->subcategories = 'subcategories';
        $this->store_categories = 'store_categories';
        $this->products = 'products';
        $this->comments = 'comments';
        $this->reviews = 'reviews';
        $this->validate = ['name', 'email', 'comment', 'star'];
    }

    public function home()
    {
        $data['view'] = "web/home";
        $data['banners'] = $this->Product->getBanners();
        $data['categories'] = $this->BM->getAll($this->store_categories)->result();
        $data['latest'] = $this->Product->latest(6);
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
            "avg" => number_format($average, 2, '.', '')
        ];
        $this->load->view("web/review/review_list", $data);
    }

    public function postReview($productId)
    {
        $validator = $this->inputValidator(["name", "email", "comment", "star"]);
        if($validator) {
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
        }else{
            appJson(['errors' => $this->form_validation->error_array()]);
        }
    }

    public function addCart()
    {
        $post = fileGetContent();
        $cart = $this->cart->contents();
        $stock = $this->BM->getById($this->products, $post->product_id)->stock;
        $key = array_search_key($cart, $post->product_id, 'id');
        if ($key !== null) {
            if($post->qty <= $stock) {
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
            if($post->qty <= $stock) {
                $data = array(
                    "id" => $post->product_id,
                    "name" => $post->name,
                    "qty" => $post->qty,
                    "price" => $post->price,
                );
                $this->cart->insert($data);
            }
        }

        appJson([
            "success" => true,
            "message" => "Berhasil menambahkan barang ke keranjang",
        ]);
    }

    public function checkCart()
    {
        echo count($this->cart->contents());
    }

    public function postComment($productId)
    {
        $validator = $this->inputValidator(["name", "email", "comment"]);
        if($validator) {
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
        }else{
            appJson(['errors' => $this->form_validation->error_array()]);
        }
    }

    public function postReplyComment($commentId, $productId)
    {
        $validator = $this->inputValidator(["name", "email", "comment"]);
        if($validator) {
            $data['name'] = $this->input->post("name");;
            $data['email'] = $this->input->post("email");;
            $data['comment'] =  $this->input->post("comment");;
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
        }else{
            appJson(['errors' => $this->form_validation->error_array()]);
        }
    }

    public function commentBox($commentId)
    {
        $comment = $this->BM->checkById($this->comments, $commentId);
        $data['comment_id'] = $comment->id;
        $data['product_id'] = $comment->product_id;
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
        $carts = $this->cart->contents();
        
        $id = [];
        $qty = [];
        foreach ($carts as $cart) {
            $id[] = $cart['id'];
            $qty[$cart['id']] = $cart['qty'];
            $rowid[$cart['id']] = $cart['rowid'];
        }

        $newCart = [];

        if(count($id) > 0) {
            $products = $this->BM->whereIn($this->products, 'id', $id)->result();

            foreach ($products as $product) {
                $covers = unserialize($product->cover);
                $newCart[] = [
                    "rowid" => $rowid[$product->id],
                    "product_id" => $product->id,
                    "name" => $product->name,
                    "qty" => $qty[$product->id],
                    "price" => $product->price,
                    "subtotal" => $product->price * $qty[$product->id],
                    "stock" => $product->stock,
                    "cover" => $covers[0]
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
        $stock = $this->BM->getById($this->products, $productId)->stock;
        $carts = $this->cart->contents();

        $key = array_search_key($carts, $productId, 'id');
       
        $subtotal = $carts[$key]['price'] * $qty;

        $data = array(
            'rowid' => $key,
            'qty' => $qty,
        );

        if(($carts[$key]['qty'] + $qty) <= $stock) {
            $this->cart->update($data);
        }

        $newCart = $this->cart->contents();

        foreach ($newCart as $cart) {
            $total += $cart['subtotal'];
        }
        
        appJson([
            "success" => true,
            "subtotal" => toRp($subtotal),
            "product_id" => $productId,
            "total" => toRp($total)
        ]);
    }

    public function checkout()
    {
        $data['view'] = 'web/checkout';
        $this->load->view("template/web/app",$data);
    }
}
