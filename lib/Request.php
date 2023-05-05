<?php

namespace lib;

use Exception;
use Throwable;

class Request
{
    public string $url = '/';
    public string $method = '';


    public function all(): array
    {
        return $this->method === 'GET' ? $_GET : array_merge($_POST, $_FILES);
    }

    public function get($key): mixed
    {
        return $this->method === 'GET' ?
            ($_GET[$key] ?? null) :
            (array_merge($_POST, $_FILES)[$key] ?? null);
    }

    public function __construct()
    {
        $url = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
        if (!str_starts_with($_SERVER['PHP_SELF'], '/index.php')) {
            $url = str_replace(substr($_SERVER['PHP_SELF'], 0, -10), '', $url);
        }
        $this->url = $url;
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function executeAction()
    {
        $route_groups = require('route.php');
        $routes = [];
        foreach ($route_groups as $key => $route_group) {
            $routes[$key] = explode('@', $route_group);
        }
        $key = "$this->method $this->url";
        $action = $routes[$key] ?? null;
        if ($action === null) {
            ob_get_clean();
            die('NOT FOUND');
        }

        $controller_name = str_replace('controller\\', '', $action[0]);
        $method_name = $action[1];
        $controller_path = asset('controller/' . $controller_name . '.php');
        if (!file_exists($controller_path)) {
            ob_get_clean();
            die('NOT FOUND');
        }

        $class_name = 'controller\\' . $controller_name;
        require asset($class_name . '.php');
        $class = new $class_name();
        if (!method_exists($class, $method_name)) {
            ob_get_clean();
            die('method not allow');
        }

        try {
            return $class->$method_name($this);
        } catch (Throwable | Exception $e) {
            ob_get_clean();
            $message = $e->getMessage();
            $file = $e->getFile();
            $line = $e->getLine();
            $errors = $e->getTrace();
            require asset('lib/debug.php');

            return false;
        }
    }

}