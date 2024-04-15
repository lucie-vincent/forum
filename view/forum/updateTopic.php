<?php
$topic = $result["data"]['topic'];
// var_dump($topic);

?>

<h1><?= $topic->getTitle()?> >> Modifier le topic</h1>

<form action="index.php?ctrl=forum&action=updateTopic&id=<?=$id?>" method="POST">
<label for="topic">Titre du topic :</label>    
<input type="text" name="topic" id="topic" value="<?=$topic->getTitle()?>">

<br>
<input type="submit" value="Modifier le topic">
</form>