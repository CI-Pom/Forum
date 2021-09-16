<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;

class CategorieManager extends AbstractManager{
    public function __construct(){
        parent::getPDO();
    }

    public function findAll(){
        return $this->getResults(
            "App\Model\Entity\Categorie",
            "SELECT c.id, c.titre, COUNT(s.id) AS nbsujets
            FROM categorie c
            LEFT JOIN sujet s
            ON s.categorie_id = c.id
            GROUP BY c.id"
        );
    }

    public function findOneById($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Categorie",
            "SELECT id, titre
            FROM categorie
            WHERE id = :id",
            ["id" => $id]
        );
    }

    public function insertCategorie($titre){
        return $this->executeQuery(
            "INSERT INTO categorie (titre)
            VALUES (:titre)",
            [":titre" => $titre]
        );
    }
}