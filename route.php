<?php

return [
    'GET /' => 'HomeController@index',
    'GET /login' => 'AuthController@login',
    'POST /login' => 'AuthController@handleLogin',
];