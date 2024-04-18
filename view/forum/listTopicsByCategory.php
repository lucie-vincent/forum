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
    <p>
        <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a> 
        par <?= $topic->getUser() ?>

        <?php if(App\Session::getUser() == $topic->getUser()) { ?>

            <a href="index.php?ctrl=forum&action=updateTopicForm&id=<?= $topic->getId() ?>"> - Modifier </a>
            <a href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>"> - Supprimer </a>
            
        <?php } ?>
    </p>
<?php }
} ?>


<br>
<a href="index.php?ctrl=forum&action=addTopicForm&id=<?= $category->getId() ?>">Créer un topic</a>

<br>
<!-- <a href="index.php?ctrl=forum&action=addPost">Ajouter un post</a> -->


