<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ShopController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Search", "search");
        $this->load->library('cart');
        $this->load->model("ProductModel", "Product");
        $this->load->model("CategoryModel", "Category");
        $this->load->helper("response");
        $this->categories = 'categories';
        $this->subcategories = 'subcategories';
        $this->store_categories = 'store_categories';
        $this->products = 'products';
        $this->comments = 'comments';
        $this->reviews = 'reviews';
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
        $product = $this->BM->checkById($this->products, $productId);
        $data['view'] = 'web/product_detail';
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

        $average = ($totalStar / count($reviews));

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
    }

    public function addCart()
    {
        $post = fileGetContent();
        $cart = $this->cart->contents();

        $key = array_search_key($cart, $post->product_id, 'id');
        if ($key !== null) {
            $data = array(
                'rowid' => $key,
                "name" => $post->name,
                'qty' => $cart[$key]['qty'] + $post->qty,
                "price" => $post->price,
            );
            $this->cart->update($data);
        } else {
            $data = array(
                "id" => $post->product_id,
                "name" => $post->name,
                "qty" => $post->qty,
                "price" => $post->price,
            );
            $this->cart->insert($data);
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
    }

    public function postReplyComment($commentId, $productId)
    {
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
    }

    public function commentBox($commentId)
    {
        $comment = $this->BM->checkById($this->comments, $commentId);
        $data['comment_id'] = $comment->id;
        $data['product_id'] = $comment->product_id;
        $this->load->view("web/comment/comment_box", $data);
    }
}
