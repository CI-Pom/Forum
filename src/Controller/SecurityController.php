<?php
namespace App\Controller;

use App\Model\Manager\UtilisateurManager;
use App\Service\AbstractController;

class SecurityController extends AbstractController{
    
    public function __construct(){
        $this->utilisateurManager = new UtilisateurManager;
    }

    public function index(){
        return $this->login();
    }

    public function login(){
        if(!empty($_POST)){
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "/^[A-Za-z0-9]{4,}/"
                ]
            ]);

            if($email && $password){
                
                $user = $this->utilisateurManager->findUtilisateurByEmail($email);
                if($user != false && 
                    password_verify(
                        $password, 
                        $this->utilisateurManager->findPasswordById($user->getId())
                    )){
                    
                    $this->logUser($user);
                    $this->addFlash("success", $user->getUsername()." est connecté !");
                    $this->redirectTo("index.php");
                }
                else $this->addFlash("error", "Mauvais e-mail ou mot de passe !");
            }
            else $this->addFlash("error", "Les champs sont obligatoires !");
        }

        return $this->render("security/login.php"); 
    }

    public function register(){
        if(!empty($_POST)){
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "/^[A-Za-z0-9]{4,}/"
                ]
            ]);
            $password_r = filter_input(INPUT_POST, "password_repeat", FILTER_DEFAULT);

            if($username && $email && $password && $password_r){
                
                if($password === $password_r){
                   
                    if(!$this->utilisateurManager->verifyUser($email, $username)){
                        $hash = password_hash($password, PASSWORD_ARGON2I);

                        if($this->utilisateurManager->insertUser($email, $username, $hash)){
                            $this->addFlash("success", "Inscription réussie !!!");
                            $this->redirectTo("?ctrl=security&action=login");
                        }
                        else $this->addFlash("error", "Erreur 500, réessayez ultérieurement !");
                    }
                    else $this->addFlash("error", "Cet email ou ce pseudo sont déjà utilisés, choisissez en un autre");
                }
                else $this->addFlash("error", "Les mots de passe ne correspondent pas !");
            }
            else $this->addFlash("error", "Les champs sont obligatoires");
        }

        return $this->render("security/register.php"); 
    }

    public function logout(){
        $this->logoutUser();
        $this->addFlash("success", "A bientôt !");
        $this->redirectTo('index.php');
    }

    public function supprimerUtilisateur($id){
        $this->utilisateurManager->deleteUtilisateur($id);
        $this->logoutUser();
        $this->addFlash("success", "le compte a bien été supprimé");
        
        return $this->redirectTo("index.php");
    }

    public function profil($id){
        $user =  $this->utilisateurManager->findOneById($id);

        return $this->render("security/profil.php",
            ["user" => $user]
        );
        
    }

    public function modifierProfil($id){
        $user =  $this->utilisateurManager->findOneById($id);

        return $this->render("security/modifUtilisateur.php",
            ["user" => $user]
        );
    }

    public function updateProfil($id){
        if(!empty($_POST)){
            $biographie = filter_input(INPUT_POST, "biographie", FILTER_SANITIZE_STRING);
            // importé la donnée de l'image?

            if ($biographie) {
                if ($this->utilisateurManager->updateUtilisateur($id, $biographie)) {
                    $this->addFlash("success", "Inscription réussie !!!");
                    $this->redirectTo("?ctrl=security&action=profil&id=$id");
                } 
            }
            else $this->addFlash("error", "Les champs sont obligatoires");
        }
    }
}

