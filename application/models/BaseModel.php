<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BaseModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('utility');
        $this->id = genUnique(30);
    }

    public function getAll($table)
    {
        return $this->db->get($table)->result();
    }

    public function getWhere($table, $data)
    {
        return $this->db->get_where($table, $data)->result();
    }

    public function getById($table, $id)
    {
        $query = $this->db->get_where($table, array("id" => $id))->result();
        return $query ? $query[0] : false;
    }

    public function updateById($table, $id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($table, $data);
    }

    public function deleteById($table, $id)
    {
        return $this->db->delete($table, array('id' => $id));

    }

    public function create($table, $data)
    {
        $data['id'] = $this->id;
        return $this->db->insert($table, $data);
    }
}
