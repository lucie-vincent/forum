<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class CategoryManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Category";
    protected $tableName = "category";

    public function __construct(){
        parent::connect();
    }

    // supprimer une catégorie
    public function deleteCategories($id){
        // préparer la requête SQL de delete
        $sql = "DELETE FROM " .$this->tableName. " c
        WHERE id_category = :id";

        // exécuter la requête de delete avec les paramètres
        DAO::delete($sql, ["id" => $id]);
    }

}