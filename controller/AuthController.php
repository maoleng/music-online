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
        return view('auth.login');
    }

    public function handleLogin(Request $request): void
    {
        $data = $request->all();
        if (! isset($data['email'], $data['password'])) {
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



}