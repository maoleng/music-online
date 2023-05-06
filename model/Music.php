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

    public function bannerPath(): string
    {
        return str_starts_with($this->banner, 'http') ? $this->banner : url($this->banner);
    }

    public function musicPath(): string
    {
        return str_starts_with($this->music_path, 'http') ? $this->music_path : url($this->music_path);
    }



}