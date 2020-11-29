<?php

$oPost = Post::findById ($ID);

if (!is_object($oPost)) {
    echo message('Post missing', 'danger');
}

$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);
$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

if (isset($action) && $action === 'update') {
    $errors = [];

    //kontroll
    /*
    if (empty($title)) {
        $errors['title'] = 'error_title_is_empty';
    }*/

    //password match

    if (empty($errors)) {
        //save new post
        $post = $oPost;
        $post->title = $title;
        $post->body = $body;
        $post->status = $status;
        $post->edited = date("Y-m-d H:i:s");;
        $post->edited_by = 1;

        $result = Post::save($post);

        if ($result['status']) {
            redirect('/');
        } else {
            $message = $result['message'];
        }
    }
} elseif (isset($action) && $action === 'delete') {
    Post::delete($oPost);
    redirect('/');
}

echo message($message, 'danger');

?>

<form method="post">

    <div class="form-group">
        <label for="title">Title</label>
        <input
            type="text"
            class="form-control"
            id="title" name="title"
            value="<?php echo is_object($oPost) ? $oPost->title : ""; ?>"
        >
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea 
            class="form-control" 
            id="body" 
            name="body" 
            rows="8"><?php echo is_object($oPost) ? $oPost->body : ""; ?>
        </textarea>
    </div> 
    <div class="form-group">
        <label for="status">Status</label>
        <input
            type="text"
            class="form-control"
            id="status" name="status"
            value="<?php echo is_object($oPost) ? $oPost->status : ""; ?>"
        >
    </div>
    

    <button type="submit" name="action" value="update" class="btn btn-success">Update</button>
    <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
</form>