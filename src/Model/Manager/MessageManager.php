<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;

class MessageManager extends AbstractManager{
    public function __construct(){
        parent::getPDO();
    }

    public function findAll(){
        return $this->getResults(
            "App\Model\Entity\Message",
            "SELECT id, titre, createdAt, utilisateur_id, sujet_id
            FROM message"
        );
    }

    public function findOneById($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Sujet",
            "SELECT id, titre, createdAt, utilisateur_id, sujet_id
            FROM message
            WHERE id = :id",
            ["id" => $id]
        );
    }
}