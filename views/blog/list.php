<?php

//default && first = 0,5
//second -> 5,5
//third -> 10,5
//forth -> 15,5

// max posts
// pages count = max post / max on page
// current page

/*
 *
 *
 */

$start = startQuery($currentPage);

if (isset($search) && strlen($search) > 2) {
    $posts = Post::all($start, MAX_ON_PAGE, $search);
} else {
    $posts = Post::all($start, MAX_ON_PAGE);
}

$maxPosts = count($posts);
$maxPages = ceil($maxPosts / MAX_ON_PAGE);

?>

<div class="row">
    <div class="col">
        <form>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="search" value="<?php echo isset($search) ? $search : ""; ?>">
                <div class="input-group-prepend">
                    <button type="submit" class="btn btn-success">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
<div class="row">
<?php if (!empty($posts)) : ?>
    <?php foreach ($posts as $post) { ?>
    <div class="col-4">
        <div class="card">
            <img src="https://via.placeholder.com/150/0000FF/808080?text=<?php echo $post->title; ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php echo $post->title; ?>(<?php echo $post->id; ?>)</h5>
                <p class="card-text"><?php echo strLimit($post->body); ?></p>
                <a href="/post/<?php echo $post->id; ?>" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        <hr>
    </div>
    <?php } ?>
<?php else: ?>
    <div class="col">
        <div class="alert alert-info"><?php echo isset($search) ? 'No results or search to short' : 'No posts'; ?></div>
    </div>
<?php endif; ?>
</div>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item <?php echo $currentPage == 1 ? 'disabled' : ''; ?>">
            <a class="page-link" href="/<?php echo $currentPage-1; ?>">Previous</a>
        </li>
        <?php for ($i = 1; $i <= $maxPages; $i++) : ?>
            <li class="page-item"><a class="page-link" href="/<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php endfor; ?>
        <li class="page-item <?php echo $currentPage+1 > $maxPages ? 'disabled' : ''; ?>">
            <a class="page-link" href="/<?php echo $currentPage+1; ?>">Next</a>
        </li>
    </ul>
</nav>