<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    protected $userModel;
    protected $session;
    protected $validation;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
        $this->validation = \Config\Services::validation();
    }

    public function register()
    {
        return view('auth/register');
    }

    public function register_ac()
    {
        helper(['form']);

        $rules = [
            'fullname' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'fullname' => $this->request->getPost('fullname'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role' => 'user',
        ];

        $this->userModel->save($data);

        return redirect()->to('/login')->with('success', 'Registration successful! You can now log in.');
    }

    public function login()
    {
        // Redirect if already logged in
    // if (!$this->session->get('logged_in')) {
    //     return redirect()->to('/auth/login')->with('error', 'Please login first.');
    // }
    return view('auth/login');

    }

    public function login_ac()
    {
        helper(['form']);

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = $this->userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Set session
            $this->session->set([
                'logged_in' => true,
                'user_id' => $user['id'],
                'role' => $user['role'],
            ]);

            return redirect()->to('/public/index')->with('success', 'Login successful!');

        }

        return redirect()->back()->withInput()->with('error', 'Invalid email or password');
    }
public function portal()
{
    return view('auth/portal');  // This loads views/auth/portal.php
}

public function logout()
{
    $this->session->destroy();
    return redirect()->to('auth/portal')->with('success', 'Logged out successfully.');
}

}
