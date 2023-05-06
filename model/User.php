<?php

namespace model;

class User extends Model
{

    public function verify($password): bool
    {
        return password_verify($password, $this->password);
    }


}