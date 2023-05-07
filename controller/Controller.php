<?php

namespace controller;

abstract class Controller
{

    protected function mustLogin(): void
    {
        if (empty(c())) {
            redirect()->route('/');
        }
    }

    protected function mustNotLoginBefore(): void
    {
        if (c() !== null) {
            redirect()->route('/');
        }
    }

    protected function mustBeAdmin(): void
    {
        $user = c();
        if (empty($user) || ! (int) $user->is_admin) {
            redirect()->route('/');
        }
    }

    protected function returnBackError($error): void
    {
        session()->flash('error', $error);

        redirect()->back();
    }

    protected function returnBackSuccess($success): void
    {
        session()->flash('success', $success);

        redirect()->back();
    }


}