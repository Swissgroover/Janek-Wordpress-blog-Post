<?php

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

$oPost = Post::findById ($ID);

if (!is_object($oPost)) {
    echo message('Post missing', 'danger');
}

if (isset($action) && $action === 'delete') {
    POST::delete($oPost);
    redirect('/');
}

?>

<div>
    <h2 class="m-5"><?php echo $oPost->title?></h2>
    <div>
        <?php echo $oPost->body?>
    </div>
    <div class="m-3">
        Added: <?php echo $oPost->added?>
    </div>
    <div class="m-3">
        Edited: <?php echo $oPost->edited?>
    </div>
    <?php if (isLoggedIn()) : ?>
    <form method="post">
        <input type="hidden" name='id' id='id' value="<?php echo $oPost->id;?>">
        <a class="btn btn-success" href="edit/<?php echo $oPost->id; ?>">Edit</a>
        <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
    </form>
    <?php endif; ?>
</div>