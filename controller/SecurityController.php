<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register () {
        // on filtre la saisie des champs du formulaire
        $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
        $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        // on vérifie que les filtres fonctionnent
        if($nickname && $email && $pass1 && $pass2) {
            // var_dump("ok");die;
            // on va appeler la méthode findAll pour récupérer l'utilisateur
            // on crée une nouvelle instance de SecurityController
            $securityManager = new SecurityController;
            // récupérer la l'utilisateur grâce à la méthode findAll de Manager.php (triés par nom)
            $register = $securityManager->findAll(["email", "DESC"]);
        }
        
        
        
        
        // le controller communique avec la vue "register" (view) pour lui envoyer le formulaire (data)
        return [
            "view" => VIEW_DIR."security/register.php",
            "meta_description" => "S'inscrire",
            "data" => [
                // "nicknames" => $users  
            ]
        ];
    }
    public function login () {}
    public function logout () {}
}