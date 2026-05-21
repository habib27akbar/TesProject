<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }



    public function index()
    {
        return view('auth/login', [
            'title' => 'Login'
        ]);
    }



    public function process()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->userModel
            ->where('username', $username)
            ->first();

        if (!$user) {

            return redirect()->back()->with(
                'error',
                'Username tidak ditemukan'
            );
        }
        // var_dump($password);
        // var_dump($user['password']);
        // var_dump(password_verify($password, $user['password']));
        // die;
        if (!password_verify($password, $user['password'])) {

            return redirect()->back()->with(
                'error',
                'Password salah'
            );
        }

        session()->set([
            'id_user'   => $user['id'],
            'nama'      => $user['nama'],
            'username'  => $user['username'],
            'role'      => $user['role'],
            'isLogin'   => true
        ]);

        return redirect()->to('/dashboard');
    }



    public function logout()
    {
        session()->destroy();

        return redirect()->to('/');
    }
}
