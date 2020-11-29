<table class="table">
    <tr>
        <th>Email</th>
        <th>Added</th>
        <th>Edited</th>
        <th></th>
        <th></th>
    </tr>
<?php

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

$oUser = User::findById ($id);

if (isset($action) && $action === 'delete') {
    USER::delete($oUser);
    redirect('/');
}

$users = User::all();

if (!empty($users)) : foreach ($users as $user) { ?>
    <tr>
        <td><?php echo $user->email; ?></td>
        <td><?php echo $user->added; ?></td>
        <td><?php echo $user->edited; ?></td>
        <td><form method="post">
            <input type="hidden" name='id' id='id' value="<?php echo $user->id;?>">
            <a class="btn btn-success" href="users/edit/<?php echo $user->id; ?>">Edit</a>
            <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
        </form></td>
    </tr>
<?php } endif; ?>


</table>