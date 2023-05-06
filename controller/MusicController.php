<?php

namespace controller;

use lib\Request;
use model\Comment;
use model\Music;
use model\Podcast;
use model\User;

class MusicController
{

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