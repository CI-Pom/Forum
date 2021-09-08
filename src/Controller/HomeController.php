<?php
namespace App\Controller;

use App\Model\Manager\CategorieManager;
use App\Model\Manager\SujetManager;
use App\Service\AbstractController;

class HomeController extends AbstractController
{
    public function __construct(){
        $this->categorieManager = new CategorieManager();
        $this->sujetManager = new SujetManager();
    }
    
    public function index(): array
    {
        return $this->render("home/home.php");
    }

    public function listCategories(){
        $categories = $this->categorieManager->findAll();

        return $this->render("home/home.php",
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
}