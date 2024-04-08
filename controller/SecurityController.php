<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    // public function register () {
    //     // on filtre la saisie des champs du formulaire
    //     $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
    //     $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
    //     // on vérifie que les filtres soient valides
    //     if($nickname && $email && $pass1 && $pass2) {
    //         // var_dump("ok");die;
    //         // on récupère les données en BDD pour vérifier si l'utilisateur existe déjà
    //         // pour cela on fait appelle à un Manager UserManager qui va retrouver les infos 
    //         // ...
    //         // si l'utilisateur existe
    //         if($user) {
    //             // on précise que l'utilisateur est déjà présent en BDD
    //             echo "Utilisateur déjà existant";
    //         } else {
    //             // sinon on l'insère dans la BDD
    //             // on vérifie que les mots de passe soient identiques
    //             // et que la longueur du pass soit suffisante
    //             if($pass1 == $pass2 && strlen($pass1) >= 12) {
    //                 // on effectue la requête d'insertion avec la méthode du Manager add($data)
    //                 // on hash le mot de pass password_hash($mdp, PASSWORD_DEFAULT)
    //                 // on fait la redirection vers la page de connexion
    //                 // ...

    //             } else {
    //                 // on indique un message d'erreur si les mdp ne sont pas indentiques
    //                 echo "Les mots de passe ne correspondent pas";
    //             }
    //         }
    //     // si les filtres ne sont pas validés, on indique un message d'erreur
    //     } else {
    //         echo "Problème de saisie dans les champs du formulaire";
    //     }
      
    // }

    public function login () {}
    public function logout () {}
}