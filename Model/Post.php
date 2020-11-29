<?php

class Post extends DatabaseQuery {

    public $id;
    public $title;
    public $body;
    public $status;
    public static $tableName = 'posts';
    public static $className = 'Post';

}