<?php

namespace model;

class Music extends Model
{

    public static function getCategories(): array
    {
        return array_map(static function ($music) {
            return $music->category;
        }, self::raw("SELECT distinct category FROM musics"));
    }

    public function limitName(): string
    {
        return substr($this->name, 0, 15).(strlen($this->name) > 15 ? '...' : '');
    }

}