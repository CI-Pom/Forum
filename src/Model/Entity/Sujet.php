<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class Sujet extends AbstractEntity{

    private $id;
    private $titre;
    private $createdAt;
    private $categorie;
    private $utilisateur;

    public function __construct($data){
        parent::hydrate($data, $this);
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getTitre(){
        return $this->titre;
    }

    public function setTitre($titre){
        $this->titre = $titre;
    }

    public function getCreatedAt(){
        return parent::formatDate($this->createdAt);
    }

    public function setCreatedAt($createdAt){
        $this->createdAt = $createdAt;
    }
    
 
    public function getCategorie(){
        return $this->categorie;
    }

    public function setCategorie($categorie){
        $this->categorie = $categorie;
    }

    public function getUtilisateur(){
        if ($this->utilisateur != null) {
            return $this->utilisateur;
        }
        else{
            return "Utilisateur inconnu";
        }
    }
 
    public function setUtilisateur($utilisateur){
        $this->utilisateur = $utilisateur;
    }
}