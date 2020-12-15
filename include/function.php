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

function checkAccess ($p) {
    if (in_array($p, ['users', 'users/add', 'users/edit', 'posts', 'posts/add', 'posts/edit']) && !isLoggedIn()) {
        redirect("/");
    } elseif (isLoggedIn()) {
        if ($_SESSION['role'] === 'user' && in_array($p, ['users', 'users/add', 'users/edit'])) {
            redirect("/posts");
        } elseif ($_SESSION['role'] === 'moderator' && in_array($p, ['users', 'users/add', 'users/edit'])) {
            redirect("/posts");
        }
    }
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

function strLimit($value, $limit = 100, $end = '...') {
    $limit = $limit - mb_strlen($end); // Take into account $end string into the limit
    $valuelen = mb_strlen($value);
    return $limit < $valuelen ? mb_substr($value, 0, mb_strrpos($value, ' ', $limit - $valuelen)) . $end : $value;
}

function t($string, $return = false) {

    global $translations;

    //1. string
    //2. language
    //3.

    if (isset($translations[$string])) {
        $out = $translations[$string];
    } else {
        $out = 'translation_missing("' . $string . '")';
    }

    if ($return) {
        return $out;
    }

    echo $out;

}

function validateInput ($data, $inputName, $errors = []) {

    if (!empty($data[$inputName])) : foreach ($data[$inputName] as $language => $row) {
        if (empty($row)) {
            $errors[$inputName][] = t('error_' . $inputName .'_empty', true) . " (" .  t($language, true) . ")";
        }
    } endif;

    return $errors;
}

function startQuery ($currentPage) {

    if (empty($currentPage) || $currentPage === 1) {
        $start = 0;
    } else {
        $start = ($currentPage - 1) * MAX_ON_PAGE;
    }

    return $start;
}