<?php
$category = $result["data"]['category']; 

?>

<h1><?= $category->getName()?> >> Créer un topic</h1>

<form action="index.php?ctrl=forum&action=addTopic&id=<?=$id?>" method="POST">
<label for="topic">Titre du topic :</label>    
<input type="text" name="topic" id="topic">

<br>
<label for="post">Message :</label>
<textarea name="post" id="post" cols="30" rows="10"></textarea>


<br>
<input type="submit" value="Créer le topic">
</form>