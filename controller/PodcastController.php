<?php

namespace controller;

use lib\Request;
use model\Comment;
use model\Music;
use model\Podcast;
use model\User;

class PodcastController extends Controller
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

    public function increaseView(Request $request): void
    {
        $id = $request->get('id');
        Podcast::raw("UPDATE podcasts SET views = views + 1 WHERE id = $id");
    }

    public function create(Request $request): void
    {
        $this->mustBeAdmin();

        $data = $request->all();
        if (empty($data['name']) || empty($data['path']) || $data['banner']['error'] === 4) {
            $this->returnBackError('Field must not be empty');
        }

        $released_at = now()->toDateTimeString();
        Podcast::raw("
            INSERT INTO podcasts (name, path, banner, released_at)
            VALUES ('{$data['name']}', '{$data['path']}', '', '$released_at')
        ");
        $id = Podcast::database()->insert_id;

        $dir = 'public/upload/podcast';
        if (! is_dir($dir)) {
            mkdir($dir);
        }
        $extension = pathinfo(basename($data['banner']['name']),PATHINFO_EXTENSION);
        $banner = "$dir/$id.$extension";
        move_uploaded_file($data['banner']['tmp_name'], $banner);
        Podcast::raw("UPDATE podcasts SET banner = '$banner' WHERE id = $id");

        $this->returnBackSuccess('Create podcast successfully');
    }

    public function update(Request $request): void
    {
        $this->mustBeAdmin();

        $data = $request->all();
        $id = (int) $data['id'];
        if (empty($data['name']) || empty($data['path'])) {
            $this->returnBackError('Field must not be empty');
        }
        Podcast::raw("UPDATE podcasts SET name = '{$data['name']}', path = '{$data['path']}' WHERE id = $id");

        if ($data['banner']['error'] !== 4) {
            $podcast = Podcast::raw("SELECT * FROM podcasts WHERE id = $id")[0];
            if (str_starts_with($podcast->banner, 'public')) {
                unlink($podcast->banner);
            }
            $dir = 'public/upload/podcast';
            if (! is_dir($dir)) {
                mkdir($dir);
            }
            $extension = pathinfo(basename($data['banner']['name']),PATHINFO_EXTENSION);
            $banner = "$dir/$id.$extension";
            move_uploaded_file($data['banner']['tmp_name'], $banner);
            Podcast::raw("UPDATE podcasts SET banner = '$banner' WHERE id = $id");
        }

        $this->returnBackSuccess('Update podcast successfully');
    }

    public function delete(Request $request): void
    {
        $this->mustBeAdmin();

        $id = $request->get('id');
        Podcast::raw("DELETE FROM podcasts WHERE id = $id");
        $podcast = Music::raw("SELECT * FROM podcasts WHERE id = $id")[0];
        if (! str_starts_with($podcast->banner, 'http')) {
            unlink($podcast->banner);
        }
        $this->returnBackSuccess('Delete podcast successfully');
    }

}