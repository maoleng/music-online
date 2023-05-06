<?php

namespace controller;

use lib\Request;
use model\Comment;
use model\Music;
use model\Podcast;
use model\User;

class PodcastController
{

    public function index(Request $request)
    {
        $query = 'SELECT * FROM podcasts ';
        if (($q = $request->get('q')) !== null) {
            $query .= "WHERE name LIKE '%$q%' ";
        }
        $podcasts = Podcast::raw("$query ORDER BY released_at DESC");

        return view('podcast', [
            'podcasts' => $podcasts,
        ]);
    }

}