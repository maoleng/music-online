<?php

namespace controller;

use lib\Request;
use model\Comment;
use model\Music;
use model\Podcast;
use model\User;
use model\UserMusic;

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

    public function playlist()
    {
        $user_id = c()->id;
        $musics = Music::raw("
            SELECT * FROM musics
            WHERE id IN (
                SELECT music_id FROM users_musics WHERE user_id = $user_id
            )
        ");

        return view('playlist', [
            'musics' => $musics,
        ]);
    }

    public function addToPlaylist(Request $request): void
    {
        $user_id = c()->id;
        $id = $request->get('id');
        $user_music = UserMusic::raw("
            SELECT * FROM users_musics WHERE user_id = $user_id AND music_id = $id
        ")[0] ?? null;
        if ($user_music !== null) {
            die('Added to playlist successfully');
        }
        $added_at = now()->toDateTimeString();
        UserMusic::raw("
            INSERT INTO users_musics (user_id, music_id, added_at) 
            VALUES ($user_id, $id, '$added_at')
        ");

        echo 'Added to playlist successfully';
    }

    public function removeFromPlaylist(Request $request): void
    {
        $user_id = c()->id;
        $id = $request->get('id');
        $user_music = UserMusic::raw("
            SELECT * FROM users_musics WHERE user_id = $user_id AND music_id = $id
        ")[0] ?? null;
        if ($user_music === null) {
            session()->flash('success', 'Removed successfully');

            return;
        }
        UserMusic::raw("DELETE FROM users_musics WHERE user_id = $user_id AND music_id = $id");

        session()->flash('success', 'Removed successfully');
    }

}