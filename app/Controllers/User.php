<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /*
    |--------------------------------------------------------------------------
    | LIST USER
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        if (!session()->get('isLogin')) {

            return redirect()->to('/');
        }

        $data = [
            'title' => 'Manajemen User',
            'users' => $this->userModel->findAll()
        ];

        return view('user/index', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN USER
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        $this->userModel->save([

            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'role'     => $this->request->getPost('role')

        ]);
        return redirect()->to('/user')->with(
            'success',
            'User berhasil ditambahkan'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE USER
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        $data = [

            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'role'     => $this->request->getPost('role')

        ];

        /*
        |--------------------------------------------------------------------------
        | UPDATE PASSWORD JIKA DIISI
        |--------------------------------------------------------------------------
        */

        if ($this->request->getPost('password')) {

            $data['password'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );
        }

        $this->userModel->update($id, $data);

        return redirect()->to('/user')->with(
            'success',
            'User berhasil diupdate'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE USER
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $this->userModel->delete($id);

        return redirect()->to('/user')->with(
            'success',
            'User berhasil dihapus'
        );
    }
}
