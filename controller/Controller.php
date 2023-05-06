<?php

namespace controller;

abstract class Controller
{

    public function returnBackError($error): void
    {
        session()->flash('error', $error);

        redirect()->back();
    }

    public function returnBackSuccess($success): void
    {
        session()->flash('success', $success);

        redirect()->back();
    }


}