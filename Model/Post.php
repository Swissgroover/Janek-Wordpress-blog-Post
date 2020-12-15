<?php


class Post extends DatabaseQuery {

    public $id; public $title; public $body; public $status; public $added; public $added_by; public $edited; public $edited_by;
    public static $tableName = 'posts';
    public static $className = 'Post';

    public static function all($start = 5, $end = 5, $search = "", $auth = "") {
        global $db;

        //select * from table where title LIKE '%search%' LIMIT 5, 5
        //select * from table where LIMIT 5, 5
        $sql = 'SELECT * FROM ' . static::$tableName;

        $execute = [];
        if (!empty($search)) {
            $search = "%{$search}%";
            $sql.= ' where title LIKE ?';
            $execute[] = $search;
        }

        if (!empty($auth) && $auth == 'auth') {

            if (in_array($_SESSION['role'], ['admin', 'moderator'])) {
                //allow access
            } else {
                $sql.= !empty($search) ? ' AND' : ' WHERE';
                $sql.= ' added_by = ?';
                $execute[] = $_SESSION['user_id'];
            }
        }

        if ($start === 0 && $end === 0) {
            $sql.= ' ORDER BY id DESC LIMIT 10';
        } else {
            $sql.= ' ORDER BY id DESC LIMIT ?, ?';
            $execute[] = $start;
            $execute[] = $end;
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($execute);
        return $stmt->fetchAll();

    }

}