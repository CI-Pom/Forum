<?php
namespace App\Controller;

use App\Model\Manager\CategorieManager;
use App\Model\Manager\MessageManager;
use App\Model\Manager\SujetManager;
use App\Service\AbstractController;

class HomeController extends AbstractController
{
    public function __construct(){
        $this->categorieManager = new CategorieManager();
        $this->sujetManager = new SujetManager();
        $this->messageManager = new MessageManager;
    }
    
    public function index(): array
    {
        return $this->render("home/home.php");
    }

    public function listCategories(){
        $categories = $this->categorieManager->findAll();

        return $this->render("home/forum.php",
            ["categories" => $categories]
        );
    }

    public function detailsCategorie($id){
        $categorie = $this->categorieManager->findOneById($id);
        $sujets = $this->sujetManager->findSujetsByCategorie($id);

        return $this->render("home/categorie.php",
            ["categorie" => $categorie,   
            "sujets" => $sujets]
        );
    }

    public function detailsSujet($id){
        $sujet = $this->sujetManager->findOneById($id);
        $messages = $this->messageManager->findMessagesBySujet($id);

        return $this->render("home/sujet.php",
            ["sujet" => $sujet,
            "messages" => $messages]
        );
    }

    public function newSujet($id){
        $categorie = $this->categorieManager->findOneById($id);

        return $this->render("home/newSujet.php",
            ["categorie" => $categorie]
        );
    }

    public function formModifMessage($id){
        $message = $this->messageManager->findOneById($id);

        return $this->render("home/modifMessage.php",
            ["message" => $message]
        );
    }

}