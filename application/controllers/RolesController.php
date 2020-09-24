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
            $this->roles,
            ["id", "name", "display_name"],
            ['name', 'display_name'],
            'admin/actions/edit'
        );
        json($users);
    }

    public function edit($id)
    {
        $role = $this->BM->checkById($this->roles, $id);
        if(!$role) return false;

        $data['role'] = $this->BM->getById($this->roles, $id);
        $this->load->view('admin/roles/edit', $data);
    }

    public function update($id)
    {
        $role = $this->Role->update($id, $_POST);
        
        if ($role) {
            appJson([
                "message" => "Berhasil mengubah data Role",
            ]);
        }
    }
}
