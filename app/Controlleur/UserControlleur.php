<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;
use Lib\DatabaseConnection;
use Model\UserRepository;
use Model\Entites\User;

class UserControlleur implements Controlleur
{
    private UserRepository $userRepo;
    public function __construct(){
        $this->userRepo =new UserRepository(new DatabaseConnection());
    }

    public function updateUserPSW(){
        if (
            isset($_POST["mdp"])
            && isset($_POST["confirm"])
            && $_POST["mdp"] == $_POST["confirm"]
        ){
            $user = new User();
            $user->setId($_POST['id']);
            $user->setMdp(password_hash($_POST['mdp'], PASSWORD_DEFAULT));
            $this->userRepo->changeMDP($user->getMdp(), $user->getId());
            header('Location: /user?onglet=Mon compte');
        } else {
            header('Location: /user?updateMDP&error=diff');

        }
    }
    public function updateUser(){
        if (isset($_POST)) {
            $user = new User();
            $user->setId($_POST['id']);
            $user->setNom($_POST['nom']);
            $user->setPrenom($_POST['prenom']);
            $user->setMail($_POST['mail']);
            $user->setEtablissement($_POST['etablissement']);
            $user->setNivEtude($_POST['nivEtude']);
            $user->setNumTel($_POST['numTel']);
            $this->userRepo->changeNom($user->getNom(), $user->getId());
            $this->userRepo->changePrenom($user->getPrenom(), $user->getId());
            $this->userRepo->changeEtab($user->getEtablissement(), $user->getId());
            $this->userRepo->changeNiveau($user->getNivEtude(), $user->getId());
            $this->userRepo->changeTel($user->getNumTel(), $user->getId());
            $this->userRepo->changeMail($user->getMail(), $user->getId());
            header('Location: /user?onglet=Mon compte');
        }
    }
    public function index()
    {
        $fonctionnalite = [
            "Mon compte" => "./vue/components/monCompte/monCompte.php", 
            "Mes challenges" => "./vue/components/admin/manage-challenge.php",
            "Challenges disponibles" => "./vue/components/admin/manage-ressources.php", 
            "Mes equipes" => "./vue/components/admin/manage-ressources.php"
        ];
        $type = "user";
        if(isset($_GET['onglet'])){
            $ongletcourant = $_GET['onglet'];
        }
        else{
            $ongletcourant = "Mon compte";
            
        }
        $page =$fonctionnalite[$ongletcourant];
        if (isset($_GET['updateMDP'])){
            $page = "./vue/components/updateMDP/updateMDP.php";
        }
        $content = new View($page);
        $content->assign('type', $type);
        $id = $_SESSION['user']->getId();
        $content->assign("user", $this->userRepo->getUser($id));
        $content = $content->render();

        $dashboard = new View("./vue/components/dashboard/dashboard-global.php");
        $dashboard->assign("title", "Dashboard");
        $dashboard->assign("type", $_SESSION['user']->getType());
        $dashboard->assign("onglet_courant", $ongletcourant);
        $dashboard->assign("onglets", array_keys($fonctionnalite));
        $dashboard->assign("nom", $_SESSION['user']->getNom());
        $dashboard->assign("prenom", $_SESSION['user']->getPrenom());
        $dashboard->assign("content", $content);

        $dashboard->show();
    }
}