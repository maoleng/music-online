<?php


class Session
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function put(string $key, $value = null): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(?string $key = null): mixed
    {
        if (empty($key)) {
            return self::all();
        }
        $value = $_SESSION[$key] ?? null;
        if (in_array($key, $_SESSION['_flash'] ?? [], true)) {
            $flash_key = array_search($key, $_SESSION['_flash'], true);
            unset($_SESSION[$key], $_SESSION['_flash'][$flash_key]);
        }

        return $value;
    }

    public static function all(): array
    {
        unset($_SESSION['_flash']);
        $session = $_SESSION;
        foreach ($_SESSION['_flash'] ?? [] as $each) {
            unset($_SESSION[$each]);
        }

        return $session;
    }

    public static function forget(string $key): void
    {
        $flash_key = array_search($key, $_SESSION['_flash'] ?? [], true);
        unset($_SESSION[$key], $_SESSION['_flash'][$flash_key]);
    }

    public static function flush(): void
    {
        $_SESSION = [];
    }

    public static function flash(string $key, $value = null): void
    {
        $_SESSION[$key] = $value;
        $_SESSION['_flash'][] = $key;
    }

}