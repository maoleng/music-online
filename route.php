<?php

return [
    'GET /' => 'HomeController@index',

    'GET /login' => 'AuthController@login',
    'POST /login' => 'AuthController@handleLogin',
    'GET /signup' => 'AuthController@signup',
    'POST /signup' => 'AuthController@handleSignup',
    'GET /logout' => 'AuthController@logout',

    'GET /profile' => 'UserController@index',
    'POST /profile' => 'UserController@update',
    'POST /change-password' => 'UserController@changePassword',

    'GET /music' => 'MusicController@index',
    'POST /music/comment' => 'MusicController@comment',
    'POST /music/create' => 'MusicController@create',
    'POST /music/update' => 'MusicController@update',
    'POST /music/delete' => 'MusicController@delete',

    'GET /podcast' => 'PodcastController@index',
    'POST /podcast/increase-view' => 'PodcastController@increaseView',
    'POST /podcast/create' => 'PodcastController@create',
    'POST /podcast/update' => 'PodcastController@update',
    'POST /podcast/delete' => 'PodcastController@delete',

    'GET /detail' => 'MusicController@detail',
    'GET /playlist' => 'MusicController@playlist',
    'POST /add-to-playlist' => 'MusicController@addToPlaylist',
    'POST /remove-from-playlist' => 'MusicController@removeFromPlaylist',
];