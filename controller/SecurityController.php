<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use App\Session;


class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register() {
        // on crée une nouvelle instance de UserManager
        $userManager = new UserManager();

        // permet la vérification de la soumission du formulaire
        // le paramètre a prendre en compte et l'attribut name dans l'input
        // if($_POST["submit"]){
            // filtrer la saisie des champs du formulaire d'inscription
            $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


            if($nickname && $email && $pass1 && $pass2){
                // on récupère l'email pour vérifier l'existance en BDD de l'utilisateur
                $user = $userManager->findUserByEmail($email);
                // si l'utilisateur existe
                if($user){
                    // on indique à l'utilisateur que son compte existe déjà
                    Session::addFlash("error", "Utilisateur déjà existant");
                    // on le redirige vers la connexion
                    $this->redirectTo("security","login");
                } else {
                    // si les mots de passe sont identiques et sup/= à 5
                    if($pass1 == $pass2 && strlen($pass1 >= 5)){
                        // insertion de l'utilisateur en BDD
                        $userManager->add([
                            "nickname" => $nickname,
                            "email" => $email,
                            "password" => password_hash($pass1, PASSWORD_DEFAULT)
                        ]);
                    
                        // on indique à l'utilisateur que son compte a bien été créé
                        Session::addFlash("success", "Le compte a bien été créé !");
                        // on le redirige vers la connexion
                        $this->redirectTo("security","login");
                    } else {
                        // message d'erreur : "Les mots de passe ne correspondent pas ou mot de passe trop court"
                        Session::addFlash("error", "Les mots de passe ne correspondent pas ou mot de passe trop court");
                    } 
                }
            } else {
                // message d'erreur : problème de saisie dans les champs du formulaire
                Session::addFlash("error", "problème de saisie dans les champs du formulaire");
            }

            // le controller communique avec la vue register
            return [
                "view" => VIEW_DIR."security/register.php",
                "meta_description" => "S'inscrire",
                "data" => [
                    // "categories" => $categories
                ]
            ];
        // } // suite du if($_post["submit"])
        // // par défaut j'affiche le formulaire de register
        // return [
        //     "view" => VIEW_DIR."security/register.php",
        //     "meta_description" => "S'inscrire",
        //     "data" => [
        //         // "categories" => $categories
        //     ]
        // ];

    }

    public function login() {
        // if($_POST["submit"]) {
            // on crée une nouvelle instance de userManager
            $userManager = new UserManager();

            //  on filtre les champs du formulaire
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // on vérifie si les filtres sont valides
            if($email && $password){
                // on récupère les infos de l'utilisateur qui veut se connecter
                $user = $userManager->findUserByEmail($email);
                // var_dump($user);die;
                
                // si l'utilisateur existe
                if($user){
                    // on récupère le mot de passe dans l'objet user
                    $hash = $user->getPassword();
                    //  on vérifie le mot de passe saisi par rapport au mdp de la bdd
                    if(password_verify($password, $hash)){
                        // on stocke en session l'intégralité des infos du user
                        $_SESSION["user"] = $user;
                        // var_dump($_SESSION["user"]);die;
                        
                        // on redirige l'utilisateur vers la page d'acceuil
                        $this->redirectTo("home", "index");
                    } else {
                        //  on redirige vers le login
                        $this->redirectTo("security", "login");
                        Session::addFlash("error", "Utilisateur inconnu ou mot de passe incorrect");
                    }
                } else {
                    $this->redirectTo("security", "login");
                    Session::addFlash("error", "Utilisateur inconnu ou mot de passe incorrect");
                }
            }
        // }

        // le controller communique avec la vue login
        return [
            "view" => VIEW_DIR."security/login.php",
            "meta_description" => "Se connecter",
            "data" => [
                // "categories" => $categories
            ]
        ];
    }


    public function logout() {
        // on supprime le tableau user qui est dans $_SESSION et on le déconnecte
        unset($_session["user"]);
        $this->redirectTo("security", "login");

    }
}