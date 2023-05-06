<?php

namespace model;

use mysqli;

#[\AllowStaticProperties]
abstract class Model
{
    private static $db;

    public int $id;

    public static function database(): mysqli
    {
        if (empty(self::$db)) {
            self::$db = new mysqli(
                '127.0.0.1',
                'maoleng',
                '',
                'music_online',
            );
            self::$db->set_charset('utf8');
            return self::$db;
        }

        return self::$db;
    }

    public function __destruct()
    {
        if ((! isset(self::$db)) && self::database()->connect_errno) {
            self::database()->close();
        }
    }

    public static function raw($sql): array|bool
    {
        $sql = trim($sql);
        if (str_starts_with($sql, 'SELECT')) {
            $result = [];
            $rows = self::database()->query($sql)->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row) {
                $model = new static();

                self::setAttributes($model, $row);
                $result[] = $model;
            }

            return $result;
        }

        return self::database()->query($sql);
    }

    public static function setAttributes($model, $data): void
    {
        foreach ($data as $key => $value) {
            $model->$key = $value;
        }
    }

    public static function rawPaginate($sql, $per_page = 10): array
    {
        return self::getPagination($sql, $per_page);
    }

    private static function getPagination($query, $per_page): array
    {
        $page = (int) request()->get('page');
        if ($page === 0) {
            $page = 1;
        } elseif ($page <= 0) {
            $page = 1;
        }
        $query .= ' LIMIT '.$per_page.' OFFSET '.($page - 1) * $per_page;
        $query_count = preg_replace('/SELECT .* FROM/', 'SELECT count(*) FROM', $query);
        $query_count = preg_replace('/OFFSET \d+/', '', $query_count);

        $total = (int) self::database()->query($query_count)->fetch_row()[0];
        $rows = self::database()->query($query)->fetch_all(MYSQLI_ASSOC);

        $result = [];
        foreach ($rows as $row) {
            $model = new static();
            self::setAttributes($model, $row);
            $result[] = $model;
        }
        $last_page = (int) ceil($total / $per_page);

        return [
            'meta' => [
                'current_page' => $page,
                'per_page' => count($result),
                'last_page' => $last_page,
                'first_page_url' => request()->url,
                'last_page_url' => request()->url.'?page='.$last_page,
                'next_page_url' => request()->url.'?page='.($page + 1),
                'prev_page_url' => request()->url.'?page='.($page - 1),
                'total' => $total,
            ],
            'data' => $result,
        ];
    }
}
