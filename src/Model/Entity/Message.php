<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class Message extends AbstractEntity{

    private $id;
    private $text;
    private $createdAt;
    private $sujet;
    private $utilisateur;
    

    public function __construct($data){
        parent::hydrate($data, $this);
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getText(){
        return $this->text;
    }

    public function setText($text){
        $this->text = $text;
    }

    public function getCreatedAt(){
        return parent::formatDate($this->createdAt);
    }

    public function setCreatedAt($createdAt){
        $this->createdAt = new \DateTime($createdAt);
    }
    
    public function getSujet(){
        return $this->sujet;
    }

    public function setSujet($sujet){
        $this->sujet = $sujet;
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