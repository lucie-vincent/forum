<?php
    $users = $result["data"]['users'];
?>

<h1>Liste des utilisateurs</h1>

<?php
if($users == NULL) {
    echo "<p>Il n'y a pas d'utilisateurs.</p>";
} else {
    foreach($users as $user){ ?>
    <p><a href="index.php?ctrl=security&action=userInfos&id=<?=$user->getId()?>"><?= $user->getNickname()?></a></p>
<?php }
}