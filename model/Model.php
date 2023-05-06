<?php

namespace model;

use mysqli;

#[\AllowDynamicProperties]
abstract class Model
{

    private $db;
    public int $id;

    public function database(): mysqli
    {
        if (empty($this->db)) {
            $this->db = new mysqli
            (
                'localhost',
                'root',
                '',
                'music_online',
            );
            $this->db->set_charset('utf8');
            return $this->db;
        }

        return $this->db;
    }

    public function __destruct()
    {
        if ((! isset($this->db)) && $this->database()->connect_errno) {
            $this->database()->close();
        }
    }

    public function raw($sql): array|bool
    {
        $sql = trim($sql);
        if (str_starts_with($sql, 'SELECT')) {
            $result = [];
            $rows = $this->database()->query($sql)->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row) {
                $model = clone $this;
                $model->setAttributes($model, $row);
                $result[] = $model;
            }

            return $result;
        }

        return $this->database()->query($sql);
    }

    public function setAttributes($model, $data): void
    {
        foreach ($data as $key => $value) {
            $model->$key = $value;
        }
    }

    public function rawPaginate($sql, $per_page = 10): array
    {
        return $this->getPagination($sql, $per_page);
    }

    private function getPagination($query, $per_page): array
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

        $total = (int) $this->database()->query($query_count)->fetch_row()[0];
        $rows = $this->database()->query($query)->fetch_all(MYSQLI_ASSOC);

        $result = [];
        foreach ($rows as $row) {
            $model = clone $this;
            $model->setAttributes($model, $row);
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