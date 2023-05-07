<?php

namespace controller;

use lib\Request;
use model\Comment;
use model\Music;
use model\Podcast;
use model\User;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $this->mustLogin();

        return view('profile');
    }

    public function update(Request $request): void
    {
        $this->mustLogin();

        $name = $request->get('name');
        if (empty($name)) {
            $this->returnBackError('Field can not be empty');
        }
        $user_id = c()->id;
        User::raw("UPDATE users SET name = '$name' WHERE id = $user_id");
        c()->name = $name;

        $this->returnBackSuccess('Change name successfully');
    }

    public function changePassword(Request $request): void
    {
        $this->mustLogin();

        $data = $request->all();
        $email = c()->email;
        $user = User::raw("SELECT * FROM users WHERE email = '$email'")[0] ?? null;
        if (! $user->verify($data['old_password'])) {
            session()->flash('error2', 'Wrong password');

            redirect()->back();
        }
        if ($data['password'] !== $data['password2']) {
            session()->flash('error2', 'Password not match');

            redirect()->back();
        }
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        User::raw("UPDATE users SET password = '$password' WHERE email = '$email'");

        session()->flash('success2', 'Change password successfully');

        redirect()->back();
    }

}