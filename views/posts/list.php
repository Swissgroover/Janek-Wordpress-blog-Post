<table class="table">
    <tr>
        <th>Title</th>
        <th>Body</th>
        <th>Added</th>
        <th>Edited</th>
        <th>Edited by</th>
        <th></th>
        <th></th>
    </tr>
<?php

$posts = Post::all(0,0, "", 'auth');

if (!empty($posts)) : foreach ($posts as $post) { ?>
    <tr>
        <td><?php echo $post->title; ?></td>
        <td><?php echo strLimit($post->body, 30); ?></td>
        <td><?php echo $post->edited; ?></td>
        <td><?php echo $post->edited_by; ?></td>
        <td><a href="posts/edit/<?php echo $post->id; ?>">Edit</a></td>
        <td><a href="posts/delete/<?php echo $post->id; ?>">Delete</a></td>
    </tr>
<?php } endif; ?>


</table>