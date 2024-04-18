<?php
    $users = $result["data"]['nicknames'];
    // var_dump($users);
?>

<h1>Liste des utilisateurs</h1>

<?php
if($users == NULL) {
    echo "<p>Il n'y a pas d'utilisateurs.</p>";
} else {
    foreach($users as $user){ ?>
    <p><?= $user->getNickname()?></p>
<?php }
}
