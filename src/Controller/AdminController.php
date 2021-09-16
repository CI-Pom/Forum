<?php
namespace App\Controller;

use App\Model\Manager\CategorieManager;
use App\Model\Manager\SujetManager;
use App\Model\Manager\UtilisateurManager;
use App\Service\AbstractController;

class AdminController extends AbstractController{

    public function __construct(){
        $this->utilisateurManager = new UtilisateurManager;
        $this->sujetManager = new SujetManager;
        $this->categorieManager = new CategorieManager;
    }

    public function index(){
        return $this->render("admin/admin.php");
    }

    public function listUtilisateurs(){
        $utilisateurs = $this->utilisateurManager->findAll();

        return $this->render("admin/listUtilisateurs.php",
            ["utilisateurs" => $utilisateurs]
        );
    }

    public function modifierRole($id){
        $utilisateur = $this->utilisateurManager->findOneByID($id);

        if ($utilisateur->getRole() == "ROLE_USER") {
            $role = "ROLE_MODO";
            $this->utilisateurManager->updateRole($id, $role);
        } else if ($utilisateur->getRole() == "ROLE_MODO") {
            $role = "ROLE_USER";
            $this->utilisateurManager->updateRole($id, $role);
        }

        return $this->redirectTo("?ctrl=admin&action=listUtilisateurs");
    }

    public function formBan(){
        $utilisateurs = $this->utilisateurManager->findAll();

        return $this->render("admin/formBan.php",
            ["utilisateurs" => $utilisateurs]
        );
    }

    public function listSujets(){
        $sujets = $this->sujetManager->findAll();

        return $this->render("admin/listSujets.php",
            ["sujets" => $sujets]
        );
    }

    public function modifSujet($id){
        $sujet = $this->sujetManager->findOneById($id);
        $categories = $this->categorieManager->findAll();

        return $this->render("admin/modifSujet.php",
            ["sujet" => $sujet,
            "categories" => $categories]
        );
    }

    public function deplacerSujet($id){
        if (!empty($_POST)) {
            $catId = filter_input(INPUT_POST, "categorie", FILTER_SANITIZE_NUMBER_INT);

            if ($catId) {
                if ($this->sujetManager->moveSujet($id, $catId)) {
                    $this->addFlash("success", "Le sujet a bien été déplacé !");
                    $this->redirectTo("?ctrl=admin&action=listSujets");
                }
            }
            else $this->addFlash("error", "Les champs sont obligatoires");
        }

        return $this->redirectTo("?ctrl=admin&action=listSujets");
    }
}