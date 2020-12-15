<?php

$oPost = Post::findById ($ID);

if (!is_object($oPost)) {
    echo message('User missing', 'danger');
}

$titleTranslations = Translation::findForModel('Post', $oPost->id, 'title', 'et');
$titleTranslation = reset($titleTranslations);
$bodyTranslations = Translation::findForModel('Post', $oPost->id, 'body', 'et');
$bodyTranslation = reset($bodyTranslations);


$args = array(
    'title'    => array(
        'filter' => FILTER_SANITIZE_STRING,
        'flags'  => FILTER_REQUIRE_ARRAY,
    ),
    'body'    => array(
        'filter' => FILTER_SANITIZE_STRING,
        'flags'  => FILTER_REQUIRE_ARRAY,
    )
);

$data = filter_input_array(INPUT_POST, $args);
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

if (isset($action) && $action === 'update') {

    $errors = validateInput($data, 'title');
    $errors = validateInput($data, 'body', $errors);

    if (empty($errors)) {

        $post = $oPost;
        $post->title = $data['title']['en'];
        $post->body= $data['body']['en'];
        $post->edited = date("Y-m-d H:i:s");;
        $post->edited_by = $_SESSION['user_id'];

        $result = Post::save($post);

        if (!is_object($titleTranslation)) {
            $titleTranslation = new Translation();
        }
        $titleTranslation->create('title', $data['title']['et'], 'et', $post->id, 'Post');

        if (!is_object($bodyTranslation)) {
            $bodyTranslation = new Translation();
        }
        $bodyTranslation->create('body', $data['body']['et'], 'et', $post->id, 'Post');

        if ($result['status']) {
            redirect('/posts/edit/' . $post->id);
        } else {
            $message = $result['message'];
        }

    }
}

echo message($message, 'danger');

?>

<form method="post">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="en-tab" data-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="true"><?php t('en'); ?></a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#et" role="tab" aria-controls="et" aria-selected="false"><?php t('et'); ?></a>
        </li>
    </ul>
    <br>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="en" role="tabpanel" aria-labelledby="en-tab">
            <div class="form-group">
                <label for="title">Title</label>
                <input
                        type="text"
                        class="form-control"
                        id="title" name="title[en]"
                        value="<?php echo is_object($oPost) ? $oPost->title : ""; ?>"
                >
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body[en]" rows="5" class="form-control"><?php echo $oPost->body; ?></textarea>
            </div>
        </div>
        <div class="tab-pane fade" id="et" role="tabpanel" aria-labelledby="et-tab">
            <div class="form-group">
                <label for="title">Pealkiri</label>
                <input
                        type="text"
                        class="form-control"
                        id="title" name="title[et]"
                        value="<?php echo is_object($titleTranslation) ? $titleTranslation->translation : ""; ?>"
                >
            </div>
            <div class="form-group">
                <label for="body">Sisu</label>
                <textarea name="body[et]" rows="5" class="form-control"><?php echo $bodyTranslation->translation; ?></textarea>
            </div>
        </div>
    </div>


    <button type="submit" name="action" value="update" class="btn btn-success">Update</button>
    <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
</form>