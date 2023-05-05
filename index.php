<?php

$folders = ['model'];
require 'lib/functions.php';
require 'lib/Request.php';
require 'lib/Redirect.php';
require 'lib/Session.php';
$path = asset('vendor/autoload.php');
if (file_exists($path)) {
    require_once $path;
}
foreach ($folders as $folder) {
    foreach (scandir(__DIR__.'\model') as $filename) {
        $path = __DIR__.'\model\\'.$filename;
        if (is_file($path)) {
            require $path;
        }
    }
}

(new lib\Request)->executeAction();