<?php
    $post = $result["data"]['post']; 
    // var_dump($post->getId());die;
?>


<h1>Modifier un post</h1>

<!-- Pour utilisation d'un utilisateur connecté ?
    $_SESSION['user']
-->
<form action="index.php?ctrl=forum&action=updatePost&id=<?=$id?>" method="POST">
    <textarea class="post" name="content" id="content" cols="30" rows="10"><?= $post->getContent()?></textarea>

    <input type="submit" value="Modifier">
</form>