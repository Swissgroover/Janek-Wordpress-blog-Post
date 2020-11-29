<?php

$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

if (isset($action) && $action === 'save') {

    $errors = [];

    //kontroll
    if (empty($title)) {
        $errors['title'] = 'error_title_is_empty';
    }

    if (empty($body)) {
        $errors['body'] = 'error_body_is_empty';
    }

    if (empty($errors)) {
        //save new post
        $post = new Post();
        $post->title = $title;
        $post->body = $body;
        $post->status = 'active';
        $post->added = date("Y-m-d H:i:s");
        $post->added_by = 0;
        $post->edited = date("Y-m-d H:i:s");;
        $post->edited_by = 0;

        $result = Post::save($post);

        if ($result['status']) {
            redirect('/');
        } else {
            echo message('Problem creating post', 'danger');
        }

    }
}
echo empty($errors)
    ? ""
    : '<div class="alert alert-danger"><ul><li>' . join("</li><li>", $errors) . '</li></ul></div>';
?>

<form method="post">

    <div class="form-group">
        <label for="title">Title</label>
        <input
                type="text"
                class="form-control"
                id="title" name="title"
        >
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea class="form-control" id="body" name="body" rows="8"></textarea>
    </div>

    <button type="submit" name="action" value="save" class="btn btn-success">Save</button>
</form>