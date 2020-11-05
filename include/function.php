<?php

function message ($msg, $alert) {

    if (empty($msg)) {
        return;
    }

    return '<div class="alert alert-' . $alert . '">' . $msg . '</div>';
}

function isLoggedIn () {

    if (isset($_SESSION) && $_SESSION[IS_LOGGED_IN] == 1) {
        return true;
    }

    return false;
}

function redirect ($url = "") {

    if (empty($url)) {
        return;
    }

//    header('Location: ' . $url);
    ?><meta http-equiv="refresh" content="0;url=<?php echo $url; ?>" /><?php

    exit();
}

function createPassword ($password) {
    $options = [
        'cost' => 12,
    ];
    return password_hash($password, PASSWORD_BCRYPT, $options);
}