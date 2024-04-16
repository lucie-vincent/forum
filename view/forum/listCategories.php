<?php
    $categories = $result["data"]['categories']; 
?>

<h1>Liste des catégories</h1>

<?php
foreach($categories as $category){ ?>
    <p>
        <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getName() ?></a>
        <a href="index.php?ctrl=forum&action=deleteCategory&id=<?=$category->getId() ?>"> - Supprimer</a>
    </p>
<?php } ?>

<br>
<a href="index.php?ctrl=forum&action=addCategoryForm">Ajouter une catégorie</a>
<!-- <a href="index.php?ctrl=forum&action=updateCategoryForm">Modifier une catégorie</a> -->


  
