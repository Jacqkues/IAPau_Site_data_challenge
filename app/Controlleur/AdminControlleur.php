<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;
use Model\Entites\User;
use Model\UserRepository;
use AuthControlleur;
use Lib\DatabaseConnection;

class AdminControlleur implements Controlleur
{

    private $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository(new DatabaseConnection());
    }
    //ajout suppresion et modification d'un utilisateur
    public function addUser()
    {
        if (isset($_POST)) {
            $user = new User();
            $user->setNom($_POST['nom']);
            $user->setPrenom($_POST['prenom']);
            $user->setMail($_POST['mail']);
            $user->setMdp(password_hash($_POST['nom'], PASSWORD_DEFAULT));
            $user->setType($_POST['type']);
            $user->setEtablissement($_POST['etablissement']);
            $user->setNivEtude($_POST['nivEtude']);
            $user->setNumTel($_POST['numTel']);
            $user->setDateDeb($_POST['dateDeb']);
            $user->setDateFin($_POST['dateFin']);
            $this->userRepo->addUser($user);
            header('Location: /admin?onglet=Manage User');
        }

    }

    public function deleteUser()
    {
        $userId = $_GET['id'];
        $this->userRepo->deleteUser($userId);
        header('Location: /admin?onglet=Manage User');
    }

    public function updateUser()
    {

    }

    //ajout suppression et modification d'un Data Challenge

    public function addDataChallenge()
    {

    }

    public function deleteDataChallenge()
    {

    }

    public function updateDataChallenge()
    {

    }

    //ajout suppression et modification des ressources
    public function addRessource()
    {

    }
    public function deleteRessource()
    {

    }
    public function updateRessource()
    {

    }

    public function index()
    {
        $fonctionnalite = ["Manage User" => "./vue/components/admin/manage-user.php", "Manage Data Challenge" => "./vue/components/admin/manage-challenge.php", "Manage Ressource" => "./vue/components/admin/manage-ressources.php"];
        $type = "admin";
        if (isset($_GET['onglet'])) {
            $ongletcourant = $_GET['onglet'];
        } else {
            $ongletcourant = "Manage User";
        }

        $page = $fonctionnalite[$ongletcourant];

        if (isset($_GET['form'])) {
            $page = "./vue/components/admin/form.php";
        }

        $content = new View($page);


        if (isset($_GET['form']) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $content->assign("user", $this->userRepo->getUser($id));
        }

        if ($ongletcourant == "Manage User") {
            $content->assign("users", $this->userRepo->getUsers());
        }

        $content = $content->render();




        $dashboard = new View("./vue/components/dashboard/dashboard-global.php");
        $dashboard->assign("title", "Admin Dashboard");
        $dashboard->assign("type", $_SESSION['user']->getType());
        $dashboard->assign("onglet_courant", $ongletcourant);
        $dashboard->assign("onglets", array_keys($fonctionnalite));
        $dashboard->assign("nom", $_SESSION['user']->getNom());
        $dashboard->assign("prenom", $_SESSION['user']->getPrenom());
        $dashboard->assign("content", $content);

        $dashboard->show();

    }


}