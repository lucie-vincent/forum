<?php
$userInfos= $result['data']['userInfos'];
?>

<form action="index.php?ctrl=security&action=deleteUser&id=<?=$userInfos->getId()?>" method="post">
    <p>Êtes-vous sûr de vouloir supprimer votre compte ?</p>
    <input type="submit" name="confirmDelete" value="Supprimer le compte">   
</form>