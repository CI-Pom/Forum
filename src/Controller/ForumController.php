<?php
namespace App\Controller;

use App\Model\Manager\MessageManager;
use App\Model\Manager\SujetManager;
use App\Service\AbstractController;

class ForumController extends AbstractController{

    public function __construct(){
        $this->messageManager = new MessageManager;
        $this->sujetManager = new SujetManager;
    }

    public function index(): array
    {
        return $this->render("home/home.php");
    }

    public function nouveauSujet(){ //créer un nouveau sujet dans la catégorie
        if(!empty($_POST)){
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_STRING);
            $idCategorie = $_GET["id"];
            $utilisateur = $_SESSION["user"];
            $userId = $utilisateur->getId();

            if ($titre && $idCategorie && $userId) {
                if ($this->sujetManager->insertSujet($titre, $idCategorie, $userId)) {
                    $this->addFlash("success", "Sujet créé ! ");
                    $this->redirectTo("?ctrl=home&action=detailsCategorie&id=$idCategorie");
                }
            }
            else {
                $this->addFlash("error", "Les champs sont obligatoires !");
            }
        }
        return $this->render("home/sujet.php");
    }

    public function nouveauMessage(){ //créer un nouveau message dans le sujet
        if(!empty($_POST)){
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);
            $idSujet = $_GET["id"];
            $utilisateur = $_SESSION["user"];
            $userId = $utilisateur->getId();

            if ($text && $idSujet && $userId) {
                if($this->messageManager->insertMessage($text, $idSujet, $userId)){
                    $this->addFlash("success", "Message posté ! ");
                    $this->redirectTo("?ctrl=home&action=detailsSujet&id=$idSujet");
                }
            }
            else {
                $this->addFlash("error", "Les champs sont obligatoires !");
            }
        }
        return $this->render("home/sujet.php");
    }

}