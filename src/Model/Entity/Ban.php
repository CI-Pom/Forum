<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class Ban extends AbstractEntity{

    private $id;
    private $utilisateur;
    private $dateDebut;
    private $dateFin;

    public function __construct($data){
        parent::hydrate($data, $this);
    }
 
    public function getId(){
        return $this->id;
    }
 
    public function setId($id){
        $this->id = $id;
    }
 
    public function getUtilisateur(){
        return $this->utilisateur;
    }

    public function setUtilisateur($utilisateur){
        $this->utilisateur = $utilisateur;
    }
     
    public function getDateDebut(){
        return parent::formatDate($this->dateDebut);
    }

    public function setDateDebut($dateDebut){
        $this->dateDebut = new \DateTime($dateDebut);
    }

    public function getDateFin(){
        return parent::formatDate($this->dateFin);
    }
    
    public function setDateFin($dateFin){
        $this->dateFin = new \DateTime($dateFin);
    }
}