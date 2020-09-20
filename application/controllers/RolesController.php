<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RolesController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model("RoleModel", "Role");
        $this->load->library('Datatables', 'datatables');
        $this->load->helper("utility");
        $this->load->helper('response');
        $this->roles = 'roles';
    }

    public function roles()
    {
        $this->load->view('admin/roles/roles');
    }

    public function rolesTable()
    {
        $users = $this->datatables->setDatatables(
            //table
            $this->roles,
            //columns to show
            ["id", "name", "display_name"],
            //column searchable
            ['name', 'display_name'],
            //actions view path
            'admin/actions/edit'
        );
        json($users);
    }

    public function edit($id)
    {
        $data['role'] = $this->BM->getById($this->roles, $id);
        $this->load->view('admin/roles/edit', $data);
    }

    public function update($id)
    {
        $role = $this->BM->getById($this->roles, $id);
        if (!$role) {
            appJson(['message' => "Role tidak ditemukan"]);
        }
        $updateRole = $this->Role->update($id, $_POST);
        if ($updateRole) {
            appJson([
                "message" => "Berhasil mengubah data Role",
            ]);
        }
    }
}
