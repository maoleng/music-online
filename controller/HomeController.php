<?php

namespace controller;

use model\Music;
use model\Podcast;
use model\User;

class HomeController
{

    public function index()
    {
        $new_musics = Music::raw('SELECT * FROM musics ORDER BY released_at DESC LIMIT 12');
        $top_musics = Music::raw('SELECT * FROM musics ORDER BY views DESC LIMIT 5');
        $podcasts = Podcast::raw('SELECT * FROM podcasts ORDER BY released_at DESC LIMIT 5');

        return view('index', [
            'new_musics' => $new_musics,
            'top_musics' => $top_musics,
            'podcasts' => $podcasts,
        ]);
    }

}