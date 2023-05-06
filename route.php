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
    'GET /podcast' => 'PodcastController@index',

    'GET /detail' => 'MusicController@detail',

];