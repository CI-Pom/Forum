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
            "SELECT id, titre, createdAt, utilisateur_id, categorie_id
            FROM sujet
            ORDER BY createdAt DESC"
        );
    }

    public function findOneById($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Sujet",
            "SELECT id, titre, createdAt, utilisateur_id, categorie_id
            FROM sujet
            WHERE id = :id",
            ["id" => $id]
        );
    }

    public function findSujetsByCategorie($id){
        return $this->getResults(
            "App\Model\Entity\Sujet",
            "SELECT id, titre, createdAt, utilisateur_id, categorie_id
            FROM sujet
            WHERE categorie_id = :id
            ORDER BY createdAt ASC",
            ["id" => $id]
        );
    }

    public function insertSujet($titre, $id, $utilisateur){
        return $this->executeQuery(
            "INSERT INTO sujet (titre, categorie_id, utilisateur_id)
            VALUES (:titre, :categorie, :utilisateur)",
            [
                ":titre" => $titre,
                ":categorie" => $id,
                ":utilisateur" => $utilisateur
            ]
        );
    }
}