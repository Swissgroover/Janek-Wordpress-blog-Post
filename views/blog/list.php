<?php

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

$oPost = Post::findById ($id);

if (isset($action) && $action === 'delete') {
    POST::delete($oPost);
    redirect('/');
}

$posts = Post::all();

if (!empty($posts)) : foreach ($posts as $post) { ?>

    <div class="mt-5">
        <div class="m-3">
            <a href="<?php echo "/blog/post/" . $post->id;?>" class="h2 text-dark m-3"><?php echo $post->title?></a>
        </div>
        <div class="text-truncate">
            <?php echo $post->body?>
        </div>
        <div class="m-3">
            Added: <?php echo $post->added?>
        </div>
    </div>
<?php } endif; ?>