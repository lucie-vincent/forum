<h1>Ajouter un post</h1>

<!-- Pour utilisation d'un utilisateur connecté ?
    $_SESSION['user']
-->
<form action="index.php?ctrl=forum&action=addPost&id=<?=$result["data"]["topic_id"]?>" method="POST">
    <textarea name="content" id="content" cols="30" rows="10"></textarea>

    <input type="submit" value="Envoyer">
</form>