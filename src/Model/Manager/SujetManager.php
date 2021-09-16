<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;

class SujetManager extends AbstractManager{
    public function __construct(){
        parent::getPDO();
    }

    public function findAll(){
        return $this->getResults(
            "App\Model\Entity\Sujet",
            "SELECT id, titre, createdAt, utilisateur_id, categorie_id, locked
            FROM sujet
            ORDER BY createdAt DESC"
        );
    }

    public function findOneById($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Sujet",
            "SELECT id, titre, createdAt, utilisateur_id, categorie_id, locked
            FROM sujet
            WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findSujetsByCategorie($id){
        return $this->getResults(
            "App\Model\Entity\Sujet",
            "SELECT s.id, s.titre, s.createdAt, s.utilisateur_id, s.categorie_id, COUNT(m.id) AS nbMessages
            FROM sujet s
            LEFT JOIN message m 
            ON m.sujet_id = s.id
            WHERE s.categorie_id = :id
            GROUP BY s.id
            ORDER BY s.createdAt DESC",
            [":id" => $id]
        );
    }

    public function insertSujet($titre, $id, $utilisateur){
        $this->executeQuery(
            "INSERT INTO sujet (titre, categorie_id, utilisateur_id)
            VALUES (:titre, :categorie, :utilisateur)",
            [
                ":titre" => $titre,
                ":categorie" => $id,
                ":utilisateur" => $utilisateur
            ]
        );
        return self::$pdo->lastInsertId();
    }

    public function lockSujet($id, $lock){
        $this->executeQuery(
            "UPDATE sujet
            SET locked = :lock
            WHERE id = :id",
            [
                ":lock" => $lock,
                ":id" => $id
            ]
        );
    }
    
    public function deleteSujet($id){
        $this->executeQuery(
            "DELETE FROM sujet
            WHERE id = :id",
            [":id" => $id]
        );
    }

    public function moveSujet($id, $catId){
        $this->executeQuery(
            "UPDATE sujet
            SET categorie_id = :catId
            WHERE id = :id",
            [
                ":id" => $id,
                ":catId" => $catId
            ]
        );
    }
}