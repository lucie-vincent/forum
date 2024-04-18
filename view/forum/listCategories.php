<?php
    $categories = $result["data"]['categories']; 
?>

<h1>Liste des catégories</h1>

<?php

if($categories == NULL) {
    echo " <p> Il n'y a pas de catégories. </p>";
} else {
    foreach($categories as $category){ ?>
    <p>
        <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getName() ?></a>

    <?php if(App\Session::isAdmin()) { ?>
        <a href="index.php?ctrl=forum&action=deleteCategory&id=<?=$category->getId() ?>"> - Supprimer</a>
    <?php } ?>
    </p>
<?php } 
} ?>



<br>
<a href="index.php?ctrl=forum&action=addCategoryForm">Ajouter une catégorie</a>
<!-- <a href="index.php?ctrl=forum&action=updateCategoryForm">Modifier une catégorie</a> -->


  
