<?php

namespace App\Controllers;

use App\Models\ShelterModel;

class AuthController extends BaseController
{
    protected $shelterModel;

    public function __construct()
    {
        $this->shelterModel = new ShelterModel();
    }

    public function register()
    {
        return view('auth/register');
    }

    public function saveRegister()
    {
        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'email' => 'required|valid_email|is_unique[shelters.email]',
            'password' => 'required|min_length[6]',
            'phone' => 'required',
            'address' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->shelterModel->insert([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address')
        ]);

        return redirect()->to('/login')
            ->with('success', 'Registration successful. Please login.');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function checkLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $shelter = $this->shelterModel
            ->where('email', $email)
            ->first();

        if (!$shelter || !password_verify($password, $shelter['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid email or password.');
        }

        session()->set([
            'isLoggedIn' => true,
            'shelter_id' => $shelter['id'],
            'shelter_name' => $shelter['name'],
            'shelter_email' => $shelter['email']
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')
            ->with('success', 'You have been logged out.');
    }
}