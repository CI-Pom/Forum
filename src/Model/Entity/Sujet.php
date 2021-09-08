<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class Sujet extends AbstractEntity{

    private $id;
    private $titre;
    private $createdAt;
    private $categorie;
    private $utilisateur;

}