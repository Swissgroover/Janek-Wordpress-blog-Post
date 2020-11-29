<?php

$oUser = User::findById ($ID);

if (!is_object($oUser)) {
    echo message('User missing', 'danger');
}

//print_r($ID);
//print_r($oUser);

print_r($_POST);
//print_r($_GET);

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

if (isset($action) && $action === 'update') {
    $errors = [];

    //kontroll
    if (empty($email)) {
        $errors['email'] = 'error_email_is_empty';
    }

    //password match

    if (empty($errors)) {
        //save new user
        $user = $oUser;
        $user->email = $email;
        $user->password = $password;
        $user->edited = date("Y-m-d H:i:s");;
        $user->edited_by = 1;

        $result = User::save($user);

        if ($result['status']) {
            redirect('/');
        } else {
            $message = $result['message'];
        }
    }
} elseif (isset($action) && $action === 'delete') {
    USER::delete($oUser);
    redirect('/users');
}

echo message($message, 'danger');

?>

<form method="post">

    <div class="form-group">
        <label for="email">Email address</label>
        <input
            type="email"
            class="form-control"
            id="email" name="email"
            value="<?php echo is_object($oUser) ? $oUser->email : ""; ?>"
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

    <button type="submit" name="action" value="update" class="btn btn-success">Update</button>
    <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
</form>