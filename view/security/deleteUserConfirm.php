<?php
$userInfos= $result['data']['userInfos'];
?>

<form action="index.php?ctrl=security&action=deleteUser&id=<?=$userInfos->getId()?>" method="post">
    <p>Êtes-vous sûr de vouloir supprimer votre compte ?</p>
    <button type="submit" name="confirmDelete">Supprimer le compte</button>
</form>