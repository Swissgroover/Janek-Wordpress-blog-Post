<?php

/*$_POST = [
    'email2' => 'heli.kopter@ametikool.ee',
    'password' => '12345',
    'password_again' => '12345',
    'action' => 'save'
];*/

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
//$email = 'heli.kopter@ametikool.ee';
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
//$password = '12345';
$passwordAgain = filter_input(INPUT_POST, 'password_again', FILTER_SANITIZE_STRING);
//$passwordAgain = '12345';
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
//$action = 'save';

print_r($_SESSION);

if (isset($action) && $action === 'save') {

    $errors = [];

    //kontroll
    if (empty($email)) {
        $errors['email'] = 'error_email_is_empty';
    }

    //password match

    if (empty($errors)) {
        //save new user
        $user = new User();
        $user->email = $email;
        $user->password = createPassword($password);
        $user->added = date("Y-m-d H:i:s");
        $user->added_by = $_SESSION['user_id'];
        $user->edited = date("Y-m-d H:i:s");;
        $user->edited_by = $_SESSION['user_id'];

        $result = User::save($user);

        if ($result['status']) {
            redirect('users');
        } else {
            echo message('Problem creating user', 'danger');
        }

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

    <div class="form-group">
        <label for="password_again">Password Again</label>
        <input
                type="password"
                class="form-control"
                id="password_again"
                name="password_again">
    </div>

    <button type="submit" name="action" value="save" class="btn btn-success">Save</button>
</form>