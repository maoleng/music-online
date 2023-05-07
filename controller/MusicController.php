<?php

namespace controller;

use lib\Request;
use model\Comment;
use model\Music;
use model\Podcast;
use model\User;
use model\UserMusic;

class MusicController extends Controller
{

    public function index(Request $request)
    {
        $query = 'SELECT * FROM musics ';
        if (($q = $request->get('q')) !== null) {
            $query .= "WHERE (name LIKE '%$q%' OR
                singer LIKE '%$q%' OR
                lyrics LIKE '%$q%' OR
                category LIKE '%$q%'
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
            'categories' => Music::getCategories(),
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
            'categories' => Music::getCategories(),
        ]);
    }

    public function playlist()
    {
        $this->mustLogin();

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

    public function comment(Request $request): void
    {
        $this->mustLogin();

        $data = $request->all();
        if (empty($data['content'])) {
            $this->returnBackError('Field must not be empty');
        }
        $user_id = c()->id;
        $commented_at = now()->toDateTimeString();
        Comment::raw("
            INSERT INTO comments (content, user_id, music_id, commented_at)
            VALUES ('{$data['content']}', '$user_id', '{$data['id']}', '$commented_at')
        ");
        $this->returnBackSuccess('Commented successfully');
    }

    public function create(Request $request): void
    {
        $this->mustBeAdmin();

        $data = $request->all();
        if (empty($data['name']) || empty($data['singer']) || empty($data['category']) || empty($data['lyrics']) ||
            $data['banner']['error'] === 4 || $data['audio']['error'] === 4) {
            $this->returnBackError('Field must not be empty');
        }

        $released_at = now()->toDateTimeString();
        Music::raw("
            INSERT INTO musics (name, singer, lyrics, category, music_path, banner, released_at)
            VALUES ('{$data['name']}', '{$data['singer']}', '{$data['lyrics']}', '{$data['category']}', '', '', '$released_at')
        ");
        $id = Music::database()->insert_id;

        $dir = "public/upload/music";
        if (! is_dir($dir)) {
            mkdir($dir);
        }
        $extension = pathinfo(basename($data['banner']['name']),PATHINFO_EXTENSION);
        $banner = "$dir/$id.$extension";
        move_uploaded_file($data['banner']['tmp_name'], $banner);

        $extension = pathinfo(basename($data['audio']['name']),PATHINFO_EXTENSION);
        $music_path = "$dir/$id.$extension";
        move_uploaded_file($data['audio']['tmp_name'], $music_path);

        Music::raw("UPDATE musics SET banner = '$banner', music_path = '$music_path' WHERE id = $id");

        $this->returnBackSuccess('Create music successfully');
    }

    public function update(Request $request): void
    {
        $this->mustBeAdmin();

        $data = $request->all();
        $id = (int) $data['id'];
        if (empty($data['name']) || empty($data['singer']) || empty($data['category']) || empty($data['lyrics'])) {
            $this->returnBackError('Field must not be empty');
        }
        Music::raw("
            UPDATE musics SET 
                name = '{$data['name']}', singer = '{$data['singer']}',
                category = '{$data['category']}', lyrics = '{$data['lyrics']}' 
            WHERE id = $id
        ");

        $music = Music::raw("SELECT * FROM musics WHERE id = $id")[0];
        $dir = "public/upload/music";
        if ($data['banner']['error'] !== 4) {
            if (str_starts_with($music->banner, 'public')) {
                unlink($music->banner);
            }
            if (! is_dir($dir)) {
                mkdir($dir);
            }
            $extension = pathinfo(basename($data['banner']['name']),PATHINFO_EXTENSION);
            $banner = "$dir/$id.$extension";
            move_uploaded_file($data['banner']['tmp_name'], $banner);
        }
        if ($data['audio']['error'] !== 4) {
            if (str_starts_with($music->music_path, 'public')) {
                unlink($music->music_path);
            }
            if (! is_dir($dir)) {
                mkdir($dir);
            }
            $extension = pathinfo(basename($data['audio']['name']),PATHINFO_EXTENSION);
            $music_path = "$dir/$id.$extension";
            move_uploaded_file($data['audio']['tmp_name'], $music_path);
        }
        $banner = $banner ?? $music->banner;
        $music_path = $music_path ?? $music->music_path;
        Music::raw("UPDATE musics SET banner = '$banner', music_path = '$music_path' WHERE id = $id");

        $this->returnBackSuccess('Update music successfully');
    }

    public function delete(Request $request): void
    {
        $this->mustBeAdmin();

        $id = $request->get('id');

        try {
            Music::raw("DELETE FROM musics WHERE id = $id");
        } catch (\Exception $e) {
            $this->returnBackError('Can not delete movie because it has relation');
        }
        $music = Music::raw("SELECT * FROM musics WHERE id = $id")[0];
        if (! str_starts_with($music->banner, 'http')) {
            unlink($music->banner);
        }
        if (! str_starts_with($music->music_path, 'http')) {
            unlink($music->music_path);
        }

        session()->flash('success', 'Delete music successfully');

        redirect()->route('music');
    }

}