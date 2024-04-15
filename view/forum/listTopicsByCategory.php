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
        <a href="index.php?ctrl=forum&action=updateTopicForm"> - Modifier </a>
    </p>
<?php }
} ?>


<br>
<a href="index.php?ctrl=forum&action=addTopicForm&id=<?= $category->getId() ?>">Créer un topic</a>

<br>
<!-- <a href="index.php?ctrl=forum&action=addPost">Ajouter un post</a> -->


