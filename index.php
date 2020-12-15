<?php
session_start();
require_once 'autoload.php';

$p = trim($_SERVER['REQUEST_URI'], '/');
$currentPage = 0;

if (is_numeric($p)) {
    $currentPage = $p;
    $p = 'blog';
}

$pos = strpos($p, '?search');

if ($pos !== false) {

    $explode = explode("=", $p);
    $search = $explode[1];
    $p = 'blog';
}

checkAccess($p);

?>

<!doctype html>
<html lang="en">
<head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<div class="container">

    <div class="row">
        <div class="col"><h1>AMETIKOOL CMD</h1></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-4">
            <h3><?php t('menu'); ?></h3>

            <ul>
                <li><a href="/"><?php t('home'); ?></a></li>
                <?php if (isLoggedIn()) : ?>
                    <?php if ($_SESSION['role'] === 'admin') : ?>
                    <li>
                        <a href="/users"><?php t('users'); ?></a>
                        <ul>
                            <li><a href="/users/add"><?php t('add'); ?></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <li>
                        <a href="/posts">Posts</a>
                        <ul>
                            <li><a href="/posts/add">add</a></li>
                        </ul>
                    </li>

                    <li><a href="/logout">Logout</a></li>
                <?php else: ?>
                    <li><a href="/login">Login</a></li>
                <?php endif; ?>
            </ul>

        </div>
        <div class="col-8">

            <?php
            if (empty($p)) {
                echo '<h3>' . t($routes['blog']['title']) . '</h3>' ;
                require_once $routes['blog']['file_location'];
            } elseif (isset($routes[$p])) {
                echo '<h3>' . t($routes[$p]['title']) . '</h3>' ;
                require_once $routes[$p]['file_location'];
            } else {

                $explode = explode("/", $p);

                if (!empty($explode) && count($explode) > 1) {

                    $ID = $explode[count($explode)-1];

                    unset($explode[count($explode)-1]);

                    $p = join("/", $explode);
                    if (isset($routes[$p])) {
                        echo '<h3>' . t($routes[$p]['title']) . '</h3>' ;
                        require_once $routes[$p]['file_location'];
                    } else {
                        require_once $routes[404]['file_location'];
                    }
                } else {
                    require_once $routes[404]['file_location'];
                }
            }

            ?>
        </div>
    </div>
</div>

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<
</body>
</html>

<?php