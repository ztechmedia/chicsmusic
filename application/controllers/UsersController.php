<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsersController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model('UserModel', 'User');
        $this->load->library('encryption');
        $this->load->library('Datatables', 'datatables');
        $this->load->helper("utility");
        $this->load->helper('response');
        $this->users = 'users';
        $this->roles = 'roles';
    }

    public function users()
    {
        $this->load->view('admin/users/users');
    }

    public function usersTable()
    {
        $users = $this->datatables->setDatatables(
            //table
            $this->users,
            //columns to show
            ["id", "name", "email", "createdAt"],
            //column searchable
            ['name', 'email'],
            //actions view path
            'admin/actions/edit-delete',
            //others params
            [
                'delete_message' => [
                    'name' => "Yakin ingin menghapus [name] pada data Users",
                ],
                "middleware" => [
                    "createdAt" => "toDateTime"
                ]
            ]
        );
        json($users);
    }

    public function create()
    {
        $data['roles'] = $this->BM->getAll($this->roles);
        $this->load->View('admin/users/create', $data);
    }

    public function add()
    {
        $_POST['password'] = $this->encryption->encrypt($_POST['password']);
        $user = $this->User->create($_POST);
        if ($user) {
            appJson([
                "message" => "Berhasil menambah data User",
            ]);
        }
    }

    public function edit($id)
    {
        $user = $this->BM->getById($this->users, $id);
        $data = [
            'user' => $user,
            'roles' => $this->BM->getAll($this->roles),
        ];

        $this->load->view('admin/users/edit', $data);
    }

    public function update($id)
    {
        $user = $this->BM->getById($this->users, $id);
        if (!$user) {
            appJson(['message' => "User tidak ditemukan"]);
        }
        $updateUser = $this->User->update($id, $_POST, ['name', 'email']);
        if ($updateUser) {
            appJson([
                "message" => "Berhasil mengubah data User",
            ]);
        }
    }

    public function delete($id)
    {
        $this->BM->deleteById($this->users, $id);
        appJson($id);
    }
}
