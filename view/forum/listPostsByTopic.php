<?php
    $posts = $result["data"]['posts']; 
    $topic = $result["data"]['topic'];
    // var_dump($posts);
?>

<h1>Posts de <?= $topic->getTitle() ?></h1>

<p><?= $topic->getContent() ?></p>

<?php

if($posts == NULL) {
    echo " <p> Il n'y a pas de post associé à " .  $topic->getTitle() . "  </p> ";
} else {
    foreach($posts as $post){ ?>
        <div>
            <span>
                <strong><?= $post->getUser() ?></strong> - Date : <?= $post->getCreationDate() ?>
            </span>

            <p><?= $post ?></p> 
        </div>
<?php 
    } 
}
?>
<br>
<a href="index.php?ctrl=forum&action=addPostForm">Rédiger un post</a>