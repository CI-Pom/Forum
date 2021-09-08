<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class Utilisateur extends AbstractEntity{

    private $id;
    private $username;
    private $email;
    private $password;
    private $createdAt;
    private $role;

    public function __construct($data){
        parent::hydrate($data, $this);
    }

}