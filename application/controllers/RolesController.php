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
        $this->roles = 'roles';
        $this->auth->private();
    }

    //@desc     show roles tables
    //@route    GET /roles
    public function roles()
    {
        $this->load->view('admin/roles/roles');
    }

    //@desc     show data roles tables
    //@route    GET /roles/roles-table
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

    //@desc     update roles view
    //@route    GET /roles/:roleId/edit
    public function edit($id)
    {
        $role = $this->BM->checkById($this->roles, $id);
        if(!$role) return false;

        $data['role'] = $this->BM->getById($this->roles, $id);
        $this->load->view('admin/roles/edit', $data);
    }

    //@desc     update roles logic
    //@route    GET /roles/:roleId/update
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
