<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct(){
        parent::connect();
    }

    // récupérer l'utilisateur (par son mail)
    public function findUserByEmail($email) {

        $sql = "SELECT * 
                FROM ".$this->tableName." u 
                WHERE u.email = LOWER(:email)";
       
        // la requête renvoie un enregristrement -> getOneOrNullResult
        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false),
            $this->className
        );

    }

    public function deleteUsers($id){
        // préparer la requête SQL de delete
        $sql = "DELETE FROM ".$this->tableName." u
        WHERE u.id_user = :id";

        // exécuter la requête de delete avec les paramètres
        DAO::delete($sql, ["id" => $id]);
    }
}