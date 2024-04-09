<?php
    $topics = $result["data"]['titles'];
    // var_dump($users);
?>

<h1>Liste des topics</h1>

<?php
foreach($topics as $topic){ ?>
    <p><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle()?></a></p>
<?php }