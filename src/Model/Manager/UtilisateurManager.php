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
}