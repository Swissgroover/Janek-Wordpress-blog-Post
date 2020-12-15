<?php

$post = Post::findById($ID);

if (!is_object($post)) {
    echo message('Post is missing', 'danger');
}

?>
<div class="card">
    <img src="https://via.placeholder.com/150/0000FF/808080?text=<?php echo $post->title; ?>" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title"><?php echo $post->title; ?></h5>
        <p class="card-text"><?php echo $post->body; ?></p>
    </div>
</div>