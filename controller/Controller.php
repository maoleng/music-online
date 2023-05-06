<?php

namespace controller;

abstract class Controller
{

    public function returnBackError($error): void
    {
        session()->flash('error', $error);

        redirect()->back();
    }

}