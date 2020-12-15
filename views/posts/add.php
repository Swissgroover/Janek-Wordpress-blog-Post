<?php

/*$_POST = [
    'email2' => 'heli.kopter@ametikool.ee',
    'password' => '12345',
    'password_again' => '12345',
    'action' => 'save'
];*/

$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

if (isset($action) && $action === 'save') {

    $errors = [];

    //kontroll
    if (empty($title)) {
        $errors['title'] = 'error_title_is_empty';
    }

    //kontroll
    if (empty($body)) {
        $errors['body'] = 'error_body_is_empty';
    }

    //password match

    if (empty($errors)) {

        $post = new Post();
        $post->title = $title;
        $post->body= $body;
        $post->status= 'draft';
        $post->added = date("Y-m-d H:i:s");
        $post->added_by = $_SESSION['user_id'];
        $post->edited = date("Y-m-d H:i:s");;
        $post->edited_by = $_SESSION['user_id'];

        $result = Post::save($post);

        print_r($result);

        if ($result['status']) {

            $post->id = $result['id'];
            redirect('/posts/edit/' . $post->id);

            //redirect('posts');
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
                value=""
        >
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea name="body" rows="5" class="form-control"></textarea>
    </div>

    <button type="submit" name="action" value="save" class="btn btn-success">Save</button>
</form>