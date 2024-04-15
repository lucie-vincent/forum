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

    // pour modifier un post
    public function updatePosts($data){
        
        // Préparer la requête SQL d'update
        $sql = "UPDATE ".$this->tableName." p
        SET content = :content
        WHERE P.id_post = :id";

        // Exécuter la requête d'update avec les paramètres
        DAO::update($sql, [
            'content' => $data["content"],
            'id' => $data["id_post"]
        ]);
    }
}