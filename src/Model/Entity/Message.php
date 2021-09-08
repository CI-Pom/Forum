<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class Message extends AbstractEntity{

    private $id;
    private $text;
    private $createdAt;
    private $sujet;
    private $utilisateur;

}