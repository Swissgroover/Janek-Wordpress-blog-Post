<?php

print_r($_SESSION);
var_dump(isLoggedIn());

if (isLoggedIn()) {
    redirect('/');
}

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

if (isset($action) && $action === 'login') {
    $errors = [];

    //kontroll
    if (empty($email)) {
        $errors['email'] = 'error_email_is_empty';
    }

    //password match
    if (empty($password)) {
        $errors['password'] = 'error_password_is_empty';
    }

    if (empty($errors)) {
        //login
        //get by email
        $user = User::findByEmail($email);

        if (is_object($user)) {

            //validate password
            if (password_verify($password, $user->password)) {
                $_SESSION[IS_LOGGED_IN] = true;
                $_SESSION['user_id'] = $user->id;
                $_SESSION['role'] = $user->role;
                redirect('/');
            }
        }

        echo message('Username and password did not match', 'warning');
    }
}
echo empty($errors)
    ? ""
    : '<div class="alert alert-danger"><ul><li>' . join("</li><li>", $errors) . '</li></ul></div>';
?>
<form method="post">

    <div class="form-group">
        <label for="email">Email address</label>
        <input
            type="email"
            class="form-control"
            id="email" name="email"
            value=""
        >
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input
            type="password"
            class="form-control"
            id="password"
            name="password">
    </div>

    <button type="submit" name="action" value="login" class="btn btn-success">Login</button>
</form>