<?php
    $posts = $result["data"]['posts']; 
    $topic = $result["data"]['topic'];
?>
    <h1>Posts de <?= $topic->getTitle() ?></h1>
    
    <?php

if($posts == NULL) {
    echo " <p> Il n'y a pas de post associé à " .  $topic->getTitle() . "  </p> ";
} else {
    foreach($posts as $post){ ?>
        <div class="text">
            <span>
                <strong>
                    <?php if($post->getUser() == NULL) { ?>
                        Anonyme
                    <?php } else { ?> 
                    <?= $post->getUser()?>
                    <?php } ?>
                </strong> - Date : <?= $post->getCreationDate() ?>
            </span>
            
            <p>
                <?= $post ?> 

                
                <?php  if(App\Session::getUser() == $post->getUser()) { ?>
                    
                    <a class="modify" href="index.php?ctrl=forum&action=updatePostForm&id=<?=$post->getId()?>"> - Modifier</a>
                    
                    <a class="delete" href="index.php?ctrl=forum&action=deletePost&id=<?=$post->getId()?>"> - Supprimer</a>

                <?php } ?>

            </p> 
        </div><hr>
<?php 
    } 
}
?>
<br>
<a href="index.php?ctrl=forum&action=addPostForm&id=<?=$topic->getId()?>">Répondre</a>