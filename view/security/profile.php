<?php
$userInfos= $result['data']['userInfos'];
?>

<h1>Voir mon profil</h1>

<div>
    <h2>Infos générales</h2>
    <p>
        Pseudo : <?= $userInfos->getNickname()?><br>
        Email : <?= $userInfos->getEmail()?><br>
    </p>
    <p>
        <a href="index.php?ctrl=security&action=deleteUserConfirm&id=<?= $userInfos->getId()?>">Supprimer son profil</a>
    </p>
</div>
