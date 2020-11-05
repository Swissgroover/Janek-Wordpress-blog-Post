<?php
session_start();
require_once 'autoload.php';

$p = trim($_SERVER['REQUEST_URI'], '/');

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
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
            <h3>Menu</h3>

            <ul>
                <li><a href="/">Home</a></li>
                <?php if (isLoggedIn()) : ?>
                    <li>
                        <a href="/users">Users</a>
                        <ul>
                            <li><a href="/users/add">add</a></li>
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
                echo '<h3>' . $routes['blog']['title'] . '</h3>' ;
                require_once $routes['blog']['file_location'];
            } elseif (isset($routes[$p])) {
                echo '<h3>' . $routes[$p]['title'] . '</h3>' ;
                require_once $routes[$p]['file_location'];
            } else {

                $explode = explode("/", $p);

                if (!empty($explode) && count($explode) > 1) {

                    $ID = $explode[count($explode)-1];

                    unset($explode[count($explode)-1]);

                    $p = join("/", $explode);
                    if (isset($routes[$p])) {
                        echo '<h3>' . $routes[$p]['title'] . '</h3>' ;
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

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<!-- Option 2: jQuery, Popper.js, and Bootstrap JS
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
-->
</body>
</html>

<?php

//id
//email
//password
// 
//added_by
//edited
//edited_by