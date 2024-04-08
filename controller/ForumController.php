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

    public function index() {
        
        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["name", "DESC"]);

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

    public function addCategoryForm() {
        // on prépare les données à insérer ?
        // $data =["name" => ];

        // on ajoute les données dans la base de données grâce à la méthode add du Manager
        // $category = $categoryManager->add($data);
        
        // le controller communique avec la vue "addCategory"
        return [
            "view" => VIEW_DIR."forum/addCategory.php",
            "meta_description" => "Ajouter une catégorie",
            "data" => [
                // "name" => $name 
                ]
            ];
        }
        
    public function addCategory() {
    
        // on crée une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();

        $categoryName = filter_input(INPUT_POST, "category", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($categoryName){
            $categoryManager->add(["name" => $categoryName]);
            
            $this->redirectTo("forum","index");
        }

    }

    //----------------------- topics-------------------

    public function listTopicsByCategory($id) {

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);

        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }

    public function addTopic () {

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


    // ----------------------- posts -----------------------------

    public function listPostsByTopic($id) {
        $postManager = new PostManager();
        $posts = $postManager->findPostsByTopics($id);

        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);

        return [
            "view" => VIEW_DIR."forum/listPosts.php",
            "meta_description" => "Liste des posts par topic : ".$topic,
            "data" => [
                "posts" => $posts,
                "topic" => $topic
            ]
        ];

    }

    public function addPost() {

        return [
            "view" => VIEW_DIR."forum/addPost.php",
            "meta_description" => "Ajouter un post ",
            "data" => [
                // "posts" => $posts,
                // "topic" => $topic
            ]
        ];
    }

}