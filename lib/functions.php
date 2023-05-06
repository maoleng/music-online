<?php


use lib\Redirect;
use lib\Request;

if (! function_exists('asset')) {
    function asset($path = ''): string
    {
        if (str_contains($path, '\\')) {
            $path = str_replace('\\', '/', $path);
        }
        if (!in_array($path[0], ['\\', '/'])) {
            $path = '/'.$path;
        }

        return dirname(__DIR__).$path;
    }
}

if (! function_exists('url')) {
    function url($to = ''): string
    {
        $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].'/';
        if (!str_starts_with($_SERVER['PHP_SELF'], '/index.php')) {
            $root .= substr($_SERVER['PHP_SELF'], 1, -10).'/';
        }
        if (str_starts_with($to, '/')) {
            $to = substr($to, 1);
        }

        return $root.$to;
    }
}

if (! function_exists('view')) {
    function view($view_name, $data = [])
    {
        $path = str_replace('.', '/', $view_name);
        $file_path = asset('view/'.$path.'.php');
        if (!file_exists($file_path)) {
            ob_get_clean();
            die('NOT FOUND VIEW');
        }
        foreach ($data as $key => $each) {
            ${$key} = $each;
        }

        return require($file_path);
    }
}

if (! function_exists('request')) {
    function request(): Request
    {
        require_once asset('lib/Request.php');

        return new Request;
    }
}

if (! function_exists('session')) {
    function session($key = null)
    {
        return isset($key) ? Session::get($key) : (new Session);
    }
}

if (! function_exists('redirect')) {
    function redirect(): Redirect
    {
        return new Redirect;
    }
}

if (! function_exists('c')) {
    function c()
    {
        return session()->get('c');
    }
}

