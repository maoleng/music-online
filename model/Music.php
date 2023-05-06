<?php

namespace model;

class Music extends Model
{

    public function limitName(): string
    {
        return substr($this->name, 0, 20).(strlen($this->name) > 20 ? '...' : '');
    }

}