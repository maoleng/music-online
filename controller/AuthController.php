<?php

namespace controller;

use lib\Request;
use model\Music;
use model\Podcast;
use model\User;

class AuthController extends Controller
{

    public function login()
    {
        $this->mustNotLoginBefore();

        return view('auth.login');
    }

    public function signup()
    {
        $this->mustNotLoginBefore();

        return view('auth.signup');
    }

    public function handleLogin(Request $request): void
    {
        $this->mustNotLoginBefore();

        $data = $request->all();
        if (empty($data['email']) || empty($data['password'])) {
            $this->returnBackError('Please fill your email address');
        }
        $user = User::raw("SELECT * FROM users WHERE email = '{$data['email']}'")[0] ?? null;
        if (! $user) {
            $this->returnBackError('Wrong email or password');
        }
        if (! $user->verify($data['password'])) {
            $this->returnBackError('Wrong email or password');
        }
        session()->put('c', $user);

        redirect()->route('/');
    }

    public function handleSignup(Request $request): void
    {
        $this->mustNotLoginBefore();

        $data = $request->all();
        if (empty($data['name'])|| empty($data['email']) || empty($data['password']) || empty($data['password2'])) {
            $this->returnBackError('Please fill the input');
        }
        if ($data['password'] !== $data['password2']) {
            $this->returnBackError('Password not match');
        }
        $registered_at = now()->toDateTimeString();
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        User::raw("
            INSERT INTO users (name, email, password, registered_at) 
            VALUES ('{$data['name']}', '{$data['email']}', '$password', '{$registered_at}')
        ");

        session()->flash('success', 'Registered successfully');

        redirect()->route('/');
    }

    public function logout(): void
    {
        $this->mustLogin();
        session()->forget('c');

        redirect()->route('/');
    }

}