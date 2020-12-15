<?php

return [
    'users' => [
        'title' => 'user_list',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'list.php',
        'auth' => true
    ],
    'users/add' => [
        'title' => 'Add user',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'add.php',
        'auth' => true
    ],
    'users/edit' => [
        'title' => 'Edit list',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'edit.php',
        'auth' => true
    ],
    '404' => [
        'title' => '404',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . '404.php'
    ],
    'blog' => [
        'title' => 'Blog',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'blog' . DIRECTORY_SEPARATOR . 'list.php',
        'auth' => false
    ],
    'post' => [
        'title' => '',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'blog' . DIRECTORY_SEPARATOR . 'post.php',
        'auth' => false
    ],
    'login' => [
        'title' => 'Login',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'login.php'
    ],
    'logout' => [
        'title' => '',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'logout.php'
    ],
    'posts' => [
        'title' => 'Post list',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR . 'list.php',
        'auth' => true
    ],
    'posts/add' => [
        'title' => 'Add post',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR . 'add.php',
        'auth' => true
    ],
    'posts/edit' => [
        'title' => 'Edit list',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR . 'edit.php',
        'auth' => true
    ],
];