<table class="table">
    <tr>
        <th>Email</th>
        <th>Added</th>
        <th>Edited</th>
        <th></th>
        <th></th>
    </tr>
<?php

$users = User::all();

if (!empty($users)) : foreach ($users as $user) { ?>
    <tr>
        <td><?php echo $user->email; ?></td>
        <td><?php echo $user->added; ?></td>
        <td><?php echo $user->edited; ?></td>
        <td><a href="users/edit/<?php echo $user->id; ?>">Edit</a></td>
        <td><a href="users/delete/<?php echo $user->id; ?>">Delete</a></td>
    </tr>
<?php } endif; ?>


</table>