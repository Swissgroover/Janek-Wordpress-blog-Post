<?php

define("IS_LOGGED_IN", 'is_logged_in');
define("MAX_ON_PAGE", 5);

$lang = isset($_SESSION['language']) ? $_SESSION['language'] : 'en'; //Session
$translations = require 'include/translations/' . $lang . '.php';

$config = require_once 'config.php';
$routes = require_once 'routes.php';

require_once 'include' . DIRECTORY_SEPARATOR . 'functions.php';
require_once 'Model' . DIRECTORY_SEPARATOR . 'Database.php';

$db = (new Database($config))->connection();

require_once 'Model' . DIRECTORY_SEPARATOR . 'DatabaseQuery.php';
require_once 'Model' . DIRECTORY_SEPARATOR . 'User.php';
require_once 'Model' . DIRECTORY_SEPARATOR . 'Post.php';
require_once 'Model' . DIRECTORY_SEPARATOR . 'Translation.php';