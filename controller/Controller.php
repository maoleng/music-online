<?php

namespace controller;

use model\User;

class Controller
{

    public function index()
    {
        redirect()->route('home');
    }

    public function home()
    {
        $a =(new User)->rawPaginate('SELECT * FROM users', 3);
        dd($a);

        return view('home');
    }

}