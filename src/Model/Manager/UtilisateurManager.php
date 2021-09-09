<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;

class UtilisateurManager extends AbstractManager{
    public function __construct(){
        parent::getPDO();
    }

    public function findAll(){
        return $this->getResults(
            "App\Model\Entity\Utilisateur",
            "SELECT id, username, createdAt
            FROM utilisateur"
        );
    }

    public function findOneById($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Utilisateur",
            "SELECT id, username, createdAt, role
            FROM utilisateur
            WHERE id = :id",
            ["id" => $id]
        );
    }

    public function findUtilisateurByEmail($email){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Utilisateur",
            "SELECT id, username, email, createdAt, role
            FROM utilisateur
            WHERE email = :email",
            [":email" => $email]
        );
    }

    public function findPasswordById($id){
        return $this->getOneOrNullValue(
            "SELECT password 
            FROM utilisateur 
            WHERE id = :id",
            [":id" => $id]
        );
    }

    public function verifyUser($email, $username){
        $email = strtolower($email);
        $username = strtolower($username);

        return $this->getOneOrNullValue(
            "SELECT id 
            FROM utilisateur 
            WHERE LOWER(email) = :email 
            OR LOWER(username) = :username",
            [":email" => $email, 
            ":username" => $username]
        );
    }

    public function insertUser($email, $username, $password)
    {
        return $this->executeQuery(
            "INSERT INTO utilisateur (username, email, password)
            VALUES (:username, :email, :password)",
            [
                ":email"    => $email, 
                ":username"   => $username, 
                ":password" => $password
            ]
        );
    }
}