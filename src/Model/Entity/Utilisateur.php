<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class Utilisateur extends AbstractEntity{

    private $id;
    private $username;
    private $email;
    private $password;
    private $createdAt;
    private $role;

    
    public function __construct($data){
        parent::hydrate($data, $this);
    }
 
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username){
        $this->username = strtolower($username);
    }
 
    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getCreatedAt(){
        return parent::formatDate($this->createdAt);
    }

    public function setCreatedAt($createdAt){
        $this->createdAt = $createdAt;
    }

    public function getRole(){
        return $this->role;
    }

    public function setRole($role){
        if (!$role) {
            $role = "ROLE_USER";
        }
        $this->role = $role;
    }
}