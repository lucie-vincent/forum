<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics'];
?>

<h1>Liste des topics de <?= $category->getName() ?></h1>

<?php
if($topics == NULL){
    echo "Il n'y a pas de topics dans cette catégorie";
} else {
    foreach($topics as $topic ){ ?>
    <div class="topic">
        <p>
            <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a> 
            par <strong>
                <?php if($topic->getUser() == NULL) { ?>
                    Anonyme
                    <?php } else {?>
                        <?= $topic->getUser() ?>
                        <?php } ?>
                    </strong>
                    
                    <?php if(App\Session::getUser() == $topic->getUser() || App\Session::isAdmin()) { ?>
                        
                        <a class="modify" href="index.php?ctrl=forum&action=updateTopicForm&id=<?= $topic->getId() ?>"> - Modifier </a>
                        <a  class="delete" href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>"> - Supprimer </a>
                        
                        <?php } ?>
        </p>
    </div><hr>
<?php }
} ?>


<br>
<a href="index.php?ctrl=forum&action=addTopicForm&id=<?= $category->getId() ?>">Créer un topic</a>

<br>
<!-- <a href="index.php?ctrl=forum&action=addPost">Ajouter un post</a> -->


