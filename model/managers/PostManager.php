<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les posts d'un topic spécifique (par son id)
    public function findPostsByTopics($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." p
                WHERE p.topic_id = :id";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    // récupérer tous les posts d'un utilisateur
    public function findPostsByUser($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." p
                    INNER JOIN topic t ON p.user_id = t.user_id
                WHERE p.user_id = :id";

        // la requête renvoie plusieurs enregistrements --> getMultippleResults
        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );

    }

    // modifier un post
    public function updatePosts($data){
        
        // Préparer la requête SQL d'update
        $sql = "UPDATE ".$this->tableName." p
        SET content = :content
        WHERE p.id_post = :id";

        // Exécuter la requête d'update avec les paramètres
        DAO::update($sql, [
            'content' => $data["content"],
            'id' => $data["id_post"]
        ]);
    }

    // supprimer un post
    public function deletePosts($id){
        // préparer la requête SQL de delete
        $sql = "DELETE FROM ".$this->tableName." p
        WHERE p.id_post = :id";

        // exécuter la requête de delete avec les paramètres
        DAO::delete($sql, ["id" => $id]);
    }
}