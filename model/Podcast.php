<?php

namespace model;

class Podcast extends Model
{

    public function prettyViews(): string
    {
        if ($this->views === 0) {
            $views = 'No views';
        } elseif ($this->views <= 999) {
            $views = $this->views.' views';
        } elseif ($this->views < 1000000) {
            $views = round($this->views/1000, 2).'K views';
        } elseif ($this->views < 1000000000) {
            $views =  round($this->views/1000000, 2).'M views';
        } else {
            $views = round($this->views / 1000000000, 2) . 'B views';
        }

        return $views;
    }

    public function bannerPath(): string
    {
        return str_starts_with($this->banner, 'http') ? $this->banner : url($this->banner);
    }


}