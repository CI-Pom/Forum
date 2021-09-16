<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class Categorie extends AbstractEntity{

    private $id;
    private $titre;
    private $nbSujets;

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

    public function getNbSujets(){
        return $this->nbSujets;
    }

    public function setNbSujets($nbSujets){
        $this->nbSujets = $nbSujets;
        return $this;
    }
}