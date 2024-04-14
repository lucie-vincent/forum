<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\UserManager;
use Model\Managers\PostManager;

class ForumController extends AbstractController implements ControllerInterface{

    // lister toutes les catégories
    public function index() {
        
        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["name", "ASC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    // -------------------------- utilisateurs -----------------------

    // lister les utilisateurs
    public function listUsers() {
        // créer une nouvelle instance de UserManager
        $userManager = new UserManager();
        // récupérer la liste de tous les utilisateurs grâce à la méthode findAll de Manager.php, triés par nickname
        $users = $userManager->findAll(["nickname", "DESC"]);

        // le controller communique avec la vue "listUsers" (view) pour lui envoyer la liste des utilisateurs (data)
        return [
            "view" => VIEW_DIR."forum/listUsers.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [
                "nicknames" => $users   
            ]
        ];
    }

    // ------------------------------ categories ------------------------------

    // faire le lien vers le formulaire
    public function addCategoryForm() {
        // le controller communique avec la vue "addCategory"
        return [
            "view" => VIEW_DIR."forum/addCategory.php",
            "meta_description" => "Ajouter une catégorie",
            "data" => [
                // "name" => $name 
            ]
        ];
    }
    
    // ajouter une catégorie
    public function addCategory() {
        // on crée une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();

        // on filtre les données saisies dans le formulaire
        $categoryName = filter_input(INPUT_POST, "category", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        // si le filtre est validé
        if($categoryName){
            // on utilise la fonction add(), en argument, on précise que le nom de la colonne dans la BDD sera = au résultat de la saisie filtrée
            $categoryManager->add([
                "name" => $categoryName
            ]);
            // on redirige vers l'index des catégories
            $this->redirectTo("forum","index");
        }
        
    }
    
    //----------------------- topics-------------------
    
    // lister les topics
    public function listTopics($id){
        // créer une nouvelle instance de TopicManager + CategoryManager
        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();

        // récupérer la liste des topics grâce à la méthode findAll() de Manager
        $topics = $topicManager->findAll(["title", "DESC"]);
        //  on trouve une catégorie par son id pour pouvoir ensuite utiliser l'id pour ajouter un topic dans une catégorie
        $category = $categoryManager->findOneById($id);

        // le controller communique avec la vue listTopics pour lui communiquer les informations
        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics",
            "data" => [
                "titles" => $topics,
                "category" => $category
            ]
        ];
    }

    // lister les topics par catégories
    public function listTopicsByCategory($id) {
        // créer de nouvelles instances de Topic/CategoryManager
        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();

        // utiliser les méthodes findOneById pour trouver une catégorie par son id 
        $category = $categoryManager->findOneById($id);
        // findTopicByCategory récupérer tous les posts d'un topic spécifique (par son id)
        $topics = $topicManager->findTopicsByCategory($id);

        // var_dump($topics);die;
        // le controller communique avec la vue listTopicsByCategory pour lui communiquer les informations
        return [
            "view" => VIEW_DIR."forum/listTopicsByCategory.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }
        
    // faire le lien vers le formulaire d'ajout de topic
    // on passe en argument l'id qui est l'id de la catégorie : ainsi on peut le récupérer par la suite
    public function addTopicForm($id) {
        // le controller communique avec la vue addTopic
        return [
            "view" => VIEW_DIR."forum/addTopic.php",
            "meta_description" => "Ajouter un topic",
            "data" => [
                // "category" => $category,
                // "topics" => $topics
            ]
        ];
    }
        
    //  ajouter un topic
    public function addTopic($id) {
        // on crée une nouvelle instance de TopicManager
        $topicManager = new TopicManager();

        // on filtre les données saisies dans le formulaire
        $topicTitle = filter_input(INPUT_POST, "topic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // $topicContent = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        // si le filtre est validé
        if($topicTitle){
            // on utilise la fonction add(), en argument, on précise que le nom de la colonne dans la BDD sera = au résultat de la saisie filtrée
            //  on ajoute la colonne category_id et on précise que le résultat est = à $id (l'argument de la méthode addTopic)
            $topicManager->add([
                "title" => $topicTitle,
                "category_id" => $id
                // "content" => $topicContent
            ]);

            //  on redirige vers la liste des topics
            $this->redirectTo("forum","listTopicsByCategory");
        }       
    }


    // ----------------------- posts -----------------------------

    // lister les posts par topic
    public function listPostsByTopic($id) {
        $postManager = new PostManager();
        $posts = $postManager->findPostsByTopics($id);

        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);

        return [
            "view" => VIEW_DIR."forum/listPostsByTopic.php",
            "meta_description" => "Liste des posts par topic : ".$topic,
            "data" => [
                "posts" => $posts,
                "topic" => $topic
            ]
        ];

    }

    // faire le lien vers le formulaire d'ajout de post
    public function addPostForm($id) {

        return [
            "view" => VIEW_DIR."forum/addPost.php",
            "meta_description" => "Ajouter un post ",
            "data" => [
                "topic_id" => $id
            ]
        ];
    }

    public function addPost($id) {
        // on crée une nouvelle instance de PostManager, qui communique avec la base de données
        $postManager = new PostManager();
        
        // on définit la valeur de user_id et de creationDate
        $user_id = 0; // A remplacer par le résultat de $_SESSION['user']['id']
        $creationDate = date("Ymd"); // Date du jour format AAAAMMJJ

        // on filtre les données saisies dans le formulaire
        $postContent = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // si le filtre est validé
        if($postContent){
            // on utilise la fonction add() en préparant les données pour correspondre au contenu attendu par la BDD
            $postManager->add([
                "content" => $postContent,
                "creationDate" => $creationDate,
                "topic_id" => $id,
                "user_id" => $user_id
            ]);

            // on fait la redirection
            $this->redirectTo("forum","listPostsByTopic", $id);

        } 

    }

}