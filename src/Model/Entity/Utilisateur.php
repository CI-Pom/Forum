<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class Utilisateur extends AbstractEntity{

    private $id;
    private $username;
    private $email;
    private $createdAt;
    private $role;
    private $biographie;
    private $avatar;

    
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

    public function getCreatedAt(){
        return parent::formatDate($this->createdAt);
    }

    public function setCreatedAt($createdAt){
        $this->createdAt = new \DateTime($createdAt);
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

    public function __toString(){
        return $this->username;
    }

    public function getBiographie(){
        return $this->biographie;
    }

    public function setBiographie($biographie){
        $this->biographie = $biographie;
        return $this;
    }

    public function getAvatar(){
        return $this->avatar;
    }

    public function setAvatar($avatar){
        $this->avatar = $avatar;
        return $this;
    }
}