<?php

namespace controller;

use lib\Request;
use model\Comment;
use model\Music;
use model\Podcast;
use model\User;

class MusicController
{

    public function index(Request $request)
    {
        $categories =array_map(function ($music) {
            return $music->category;
        }, Music::raw("SELECT distinct category FROM musics"));

        $query = 'SELECT * FROM musics ';
        if (($q = $request->get('q')) !== null) {
            $query .= "WHERE (name LIKE '%$q%' OR
                singer LIKE '%$q%' OR
                lyrics LIKE '%$q%' OR
                category LIKE '%$q%' OR
                length LIKE '%$q%'
            ) ";
        }


        if (($category = $request->get('category')) !== null) {
            $query .= $q === null ?
                " WHERE category = '$category' " :
                " AND category = '$category'";
        }
        $sort = $request->get('sort') === null ? 'released_at' : 'views';
        $musics = Music::raw("$query ORDER BY $sort DESC");


        return view('music', [
            'categories' => $categories,
            'musics' => $musics,
        ]);
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $music = Music::raw("SELECT * FROM musics WHERE id = $id")[0] ?? null;
        if (empty($music)) {
            die(404);
        }
        $comments = Comment::raw("
            SELECT users.name, comments.* FROM comments
            LEFT JOIN users ON comments.user_id = users.id
            WHERE music_id = $id
        ");

        return view('detail', [
            'music' => $music,
            'comments' => $comments,
        ]);
    }

}