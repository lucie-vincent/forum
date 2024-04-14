<h1>Ajouter un topic</h1>

<form action="index.php?ctrl=forum&action=addTopic&id=<?=$id?>" method="POST">
<label for="topic">Nom du topic :</label>    
<input type="text" name="topic" id="topic">

<!-- <br>
<label for="content">Message :</label>
<textarea name="content" id="content" cols="30" rows="10"></textarea> -->


<br>
<input type="submit" value="Créer le topic">
</form>