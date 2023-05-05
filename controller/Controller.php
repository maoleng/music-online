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
        return view('home');
    }

}