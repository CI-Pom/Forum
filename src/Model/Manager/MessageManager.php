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
            "App\Model\Entity\Message",
            "SELECT id, titre, createdAt, utilisateur_id, sujet_id
            FROM message
            WHERE id = :id",
            ["id" => $id]
        );
    }

    public function findMessagesBySujet($id){
        return $this->getResults(
            "App\Model\Entity\Message",
            "SELECT id, text, createdAt, utilisateur_id, sujet_id
            FROM message
            WHERE sujet_id = :id
            ORDER BY createdAt ASC",
            ["id" => $id]
        );
    }

    public function insertMessage($text, $id, $utilisateur){
        return $this->executeQuery(
            "INSERT INTO message (text, sujet_id, utilisateur_id)
            VALUES (:text, :sujet, :utilisateur)",
            [
                ":text" => $text,
                ":sujet" => $id,
                ":utilisateur" => $utilisateur
            ]
        );
    }
}