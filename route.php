<?php

return [
    'GET /' => 'HomeController@index',

    'GET /login' => 'AuthController@login',
    'POST /login' => 'AuthController@handleLogin',
    'GET /signup' => 'AuthController@signup',
    'POST /signup' => 'AuthController@handleSignup',

    'GET /music' => 'MusicController@index',
    'GET /podcast' => 'PodcastController@index',

    'GET /detail' => 'MusicController@detail',
];