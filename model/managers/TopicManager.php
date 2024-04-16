<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findTopicsByCategory($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.category_id = :id";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    // modifier un topic
    public function updateTopics($data){
        // Préparer la requête SQL d'update
        $sql = "UPDATE ".$this->tableName." t
        SET title = :title
        WHERE t.id_topic = :id";

        // Exécuter la requête d'update avec les paramètres
        DAO::update($sql, [
            'title' => $data["title"],
            'id' => $data["id_topic"]
        ]);
    }

    public function deleteTopics($id){
        // préparer la requête SQL de delete
        $sql = "DELETE FROM ".$this->tableName." t
        WHERE t.id_topic = :id";

        // exécuter la requête de delete avec les paramètres
        DAO::delete($sql, ["id" => $id]);
    }
}