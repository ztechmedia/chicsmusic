<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DatatablesModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ProductModel", "PM");
        $this->load->model("OrderModel", "Order");
    }

    public function totalDocument($table, $querySelector)
    {
        if ($querySelector) {
            $query = $this->querySelector($querySelector)->get();
        } else {
            $query = $this->db->get($table);
        }
        return $query->num_rows();
    }

    public function getAll($table, $limit, $start, $col, $dir, $querySelector)
    {
        if ($querySelector) {
            $query = $this->querySelector($querySelector)->get();
        } else {
            $query = $this
                ->db
                ->limit($limit, $start)
                ->order_by($col, $dir)
                ->get($table);
        }

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function dataSearch($table, $limit, $start, $search, $col, $dir, $searchAble, $querySelector)
    {
        if ($querySelector) {
            $query = $this->querySelector($querySelector);
            $like = 0;
            foreach ($searchAble as $sc) {
                if ($like === 0) {
                    $query->like($sc, $search);
                } else {
                    $query->or_like($sc, $search);
                }
                $like++;
            }
            return $query->limit($limit, $start)->order_by($col, $dir)->get()->result();
        } else {
            $like = 0;
            foreach ($searchAble as $sc) {
                if ($like === 0) {
                    $this->db->like($sc, $search);
                } else {
                    $this->db->or_like($sc, $search);
                }
                $like++;
            }
            return $this->db->limit($limit, $start)->order_by($col, $dir)->get($table)->result();
        }
    }

    public function dataSearchCount($table, $search, $searchAble, $querySelector)
    {
        if ($querySelector) {
            $query = $this->querySelector($querySelector);
            $like = 0;
            foreach ($searchAble as $sc) {
                if ($like === 0) {
                    $query->like($sc, $search);
                } else {
                    $query->or_like($sc, $search);
                }
                $like++;
            }
            return $this->db->get()->result();
        } else {
            $like = 0;
            foreach ($searchAble as $sc) {
                if ($like === 0) {
                    $this->db->like($sc, $search);
                } else {
                    $this->db->or_like($sc, $search);
                }
                $like++;
            }
            return $this->db->get($table)->result();
        }
    }

    public function querySelector($type)
    {
        switch ($type) {
            case "productWithCategories":
                return $this->PM->productWithCategories();
            case "ordersTable":
                return $this->Order->ordersTable();
        }
    }

}
