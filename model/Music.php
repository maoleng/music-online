<?php

namespace model;

class Music extends Model
{

    public function limitName(): string
    {
        return substr($this->name, 0, 15).(strlen($this->name) > 15 ? '...' : '');
    }

}