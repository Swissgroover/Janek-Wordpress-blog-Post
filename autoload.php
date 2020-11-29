<?php

define("IS_LOGGED_IN", 'is_logged_in');

$config = require_once 'config.php';
$routes = require_once 'routes.php';

require_once 'include' . DIRECTORY_SEPARATOR . 'functions.php';
require_once 'model' . DIRECTORY_SEPARATOR . 'Database.php';

$db = (new Database($config))->connection();

require_once 'model' . DIRECTORY_SEPARATOR . 'DatabaseQuery.php';
require_once 'model' . DIRECTORY_SEPARATOR . 'User.php';
require_once 'model' . DIRECTORY_SEPARATOR . 'Post.php';