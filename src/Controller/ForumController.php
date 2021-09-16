<?php
namespace App\Controller;

use App\Model\Manager\CategorieManager;
use App\Model\Manager\MessageManager;
use App\Model\Manager\SujetManager;
use App\Service\AbstractController;
use App\Service\Session;

class ForumController extends AbstractController{

    public function __construct(){
        $this->messageManager = new MessageManager;
        $this->sujetManager = new SujetManager;
        $this->categorieManager = new CategorieManager;
    }

    public function index(): array
    {
        return $this->render("home/home.php");
    }

    public function nouvelleCategorie(){
        if (!empty($_POST)) {
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_STRING);

            if ($titre) {
                if ($this->categorieManager->insertCategorie($titre)) {
                    $this->addFlash("success", "Sujet créé ! ");
                    $this->redirectTo("?ctrl=home&action=listCategories");
                }
            }
            else {
                $this->addFlash("error", "Les champs sont obligatoires !");
            }
        }
        return $this->render("home/categorie.php");
    }

    public function nouveauSujet($id){ //créer un nouveau sujet dans la catégorie
        if(!empty($_POST)){
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_STRING);
            $idCategorie = $id;
            $utilisateur = Session::getUser();
            $userId = $utilisateur->getId();

            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);

            if ($titre && $idCategorie && $userId && $text) {
                if ($idSujet = $this->sujetManager->insertSujet($titre, $idCategorie, $userId)) {
                    if ($this->messageManager->insertMessage($text, $idSujet, $userId)) {
                        $this->addFlash("success", "Sujet créé ! ");
                        $this->redirectTo("?ctrl=home&action=detailsSujet&id=$idSujet");
                    }
                }
            }
            else {
                $this->addFlash("error", "Les champs sont obligatoires !");
            }
        }
        return $this->render("home/sujet.php");
    }

    public function cloreSujet($id){
        $sujet = $this->sujetManager->findOneById($id);
        $locked = $sujet->getLocked();

        if ($locked == "yes") {
            $lock = "no";
            $this->sujetManager->lockSujet($id, $lock);
        } else {
            $lock = "yes";
            $this->sujetManager->lockSujet($id, $lock);
        }  

        return $this->redirectTo("?ctrl=home&action=detailsSujet&id=$id");
    }

    public function supprimerSujet($id){
        $this->sujetManager->deleteSujet($id);
        $this->addFlash("success", "Le sujet a bien été supprimé !");

        return $this->redirectTo("index.php");
    }

    public function nouveauMessage($id){ //créer un nouveau message dans le sujet
        if(!empty($_POST)){
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);
            $idSujet = $id;
            $utilisateur = Session::getUser();
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

    public function modifierMessage($id){
        if (!empty($_POST)) {
            $text =  filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);
            $message = $this->messageManager->findOneById($id);
            $idSujet = $message->getSujet()->getId();

            if ($text && $id) {
                if ($this->messageManager->updateMessage($id, $text)) {
                    $this->addFlash("success", "Le message a bien été modifié ! ");
                    $this->redirectTo("?ctrl=home&action=detailsSujet&id=$idSujet");
                }
            }
            else {
                $this->addFlash("error", "Les champs sont obligatoires !");
            }
        }
        return $this->render("home/sujet.php");
    }

    public function supprimerMessage($id){
        $this->messageManager->deleteMessage($id);
        $this->addFlash("success", "Le message a bien été supprimé ! ");

        return $this->redirectTo("index.php");
    }
}