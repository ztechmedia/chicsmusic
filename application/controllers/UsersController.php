<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsersController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model('UserModel', 'User');
        $this->load->library('Datatables', 'datatables');
        $this->load->library("Auth", "auth");
        $this->load->helper("utility");
        $this->load->helper('response');
        $this->users = 'users';
        $this->roles = 'roles';
        $this->auth->private();
    }

    //@desc     show users table
    //@route    GET /users
    public function users()
    {
        $this->load->view('admin/users/users');
    }

    //@desc     show data users table
    //@route    GET /users/users-table
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

    //@desc     create user view
    //@route    GET /users/users/create
    public function create()
    {
        $data['roles'] = $this->BM->getAll($this->roles)->result();
        $this->load->View('admin/users/create', $data);
    }

    //@desc     create user logic
    //@route    POST /users/add
    public function add()
    {
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $user = $this->User->create($_POST);
        if ($user) {
            appJson([
                "message" => "Berhasil menambah data User",
            ]);
        }
    }

    //@desc     update user view
    //@route    GET /users/:userId/edit
    public function edit($id)
    {
        $user = $this->BM->checkById($this->users, $id);
        $data = [
            'user' => $user,
            'roles' => $this->BM->getAll($this->roles)->result(),
        ];
        $this->load->view('admin/users/edit', $data);
    }

    //@desc     update user logic
    //@route    POST /users/:userId/update
    public function update($id)
    {
        $user = $this->User->update($id, $_POST, ['name', 'email']);
        if ($user) {
            appJson([
                "message" => "Berhasil mengubah data User",
            ]);
        }
    }

    //@desc     delete user logic
    //@route    GET /users/:userId/delete
    public function delete($id)
    {
        $this->BM->deleteById($this->users, $id);
        appJson($id);
    }
}
