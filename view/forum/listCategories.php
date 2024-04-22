<?php
    $categories = $result["data"]['categories']; 
?>

<h1>Liste des catégories</h1>

<?php

if($categories == NULL) {
    echo " <p> Il n'y a pas de catégories. </p>";
} else {
    foreach($categories as $category){ ?>
    <div class="category">
        <p>
            <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getName() ?></a>
            
            <?php if(App\Session::isAdmin()) { ?>
                <a class="delete" href="index.php?ctrl=forum&action=deleteCategory&id=<?=$category->getId() ?>"> - Supprimer</a>
            <?php } ?>
        </p>
    </div><hr>
    <?php } 
} ?>



<br>
<a href="index.php?ctrl=forum&action=addCategoryForm">Ajouter une catégorie</a>
<!-- <a href="index.php?ctrl=forum&action=updateCategoryForm">Modifier une catégorie</a> -->


  
