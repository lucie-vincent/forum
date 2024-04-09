<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics'];
?>

<h1>Liste des topics de <?= $category->getName() ?></h1>

<?php
foreach($topics as $topic ){ ?>
    <p><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic ?></a> par <?= $topic->getUser() ?></p>
<?php } ?>

<br>
<a href="index.php?ctrl=forum&action=addTopicForm">Ajouter un topic</a>

<br>
<a href="index.php?ctrl=forum&action=addPost">Ajouter un post</a>


