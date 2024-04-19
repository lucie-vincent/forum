<?php
$userInfos= $result['data']['userInfos'];
$posts= $result['data']['posts'];
$topics = $result['data']['topics'];
?>
<h1>Voir le profil de <?=$userInfos->getNickname()?></h1>

<div>
    <h2>Infos générales</h2>
    <p>
        Pseudo : <?= $userInfos->getNickname()?><br>
        Date d'inscription : <?= $userInfos->getRegisterDate()?><br>
    </p>
</div>

<div>
    <h2>Posts rédigés</h2>
    <?php if($posts == null ) {
        echo "<p>Vous n'avez pas encore rédigé de post.</p>";
    } else {
        foreach ($posts as $post){ ?>
    <p>
        <?=$post?> - <?=$post->getCreationDate()?> dans <strong><?=$post->getTopic()->getTitle()?></strong>
    </p>
    <?php }
} ?>
</div>

<div>
    <h2>Topics créés</h2>
    <?php if($topics == null ) {
        echo "<p>Vous n'avez pas encore créé de topic.</p>";
    } else {
        foreach ($topics as $topic){ ?>
    <p>
        <?=$topic?> - <?=$topic->getCreationDate()?> dans <strong><?=$topic->getCategory()->getName()?></strong>
    </p>
    <?php }
} ?>
</div>