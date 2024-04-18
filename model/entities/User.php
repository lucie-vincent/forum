<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class User extends Entity{

    private $id;
    private $nickname;
    private $email;
    private $password;
    private $role;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id
     */ 
    public function getId(){
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of nickName
     */ 
    public function getNickname(){
        return $this->nickname;
    }

    /**
     * Set the value of nickname
     *
     * @return  self
     */ 
    public function setNickname($nickname){
        $this->nickname = $nickname;

        return $this;
    }


    /**
     * Get the value of email
     */ 
    public function getEmail(){
        return $this->email;
    }

    /**
     * Set the value of Email
     *
     * @return  self
     */ 
    public function setEmail($email){
        $this->email = $email;

        return $this;
    }


    /**
     * Get the value of password
     */ 
    public function getPassword(){
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password){
        $this->password = $password;

        return $this;
    }


    /**
     * Get the value of role
     */ 
    public function getRole(){
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role){
        $this->role = $role;

        return $this;
    }


    public function hasRole($role){
        // $userRole = json_decode($this->getRole());
        // $role = in_array("ROLE_ADMIN", $userRole) ? true : false;
        // var_dump($this->getRole());die;

        // Récupérer les rôles de l'utilisateur depuis la base de données (stockés en format JSON)
        $roles = json_decode($this->getRole(), true);
    
        // Vérifier si le rôle spécifié est présent dans le tableau des rôles
        return in_array($role, $roles);
        
    }

    public function __toString() {
        return $this->nickname;
    }
}