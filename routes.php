<?php

return [
    'users' => [
        'title' => 'User list',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'list.php'
    ],
    'users/add' => [
        'title' => 'Add user',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'add.php'
    ],
    'users/edit' => [
        'title' => 'Edit list',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'edit.php'
    ],
    '404' => [
        'title' => '404',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . '404.php'
    ],
    'blog' => [
        'title' => 'Blog',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'blog' . DIRECTORY_SEPARATOR . 'list.php'
    ],
    'post' => [
        'title' => '',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'blog' . DIRECTORY_SEPARATOR . 'post.php'
    ],
    'login' => [
        'title' => 'Login',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'login.php'
    ],
    'logout' => [
        'title' => '',
        'file_location' => __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'logout.php'
    ],
];