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
    // public function findUserEmail($email) {

    //     $sql = "SELECT * 
    //             FROM ".$this->tableName." u 
    //             WHERE u.email = :email";
       
    //     // la requête renvoie plusieurs enregistrements --> getMultipleResults
    //     return  $this->getMultipleResults(
    //         DAO::select($sql, ['id' => $id]), 
    //         $this->className
    //     );

    //     // la requête renvoie un enregristrement -> getOneOrNullResult
    //     return $this->getOneOrNullResult(
    //         DAO::select($sql, ['email' => $email]),
    //         $this->className
    //     );

    // }
}