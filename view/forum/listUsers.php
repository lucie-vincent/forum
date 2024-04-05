<?php
    $users = $result["data"]['nicknames'];
    // var_dump($users);
?>

<h1>Liste des utilisateurs</h1>

<?php
foreach($users as $user){ ?>
    <p><?= $user->getNickname()?></p>
<?php }
