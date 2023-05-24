<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;
use Model\Entites\User;
use Model\MessagerieRepository;
use Model\UserRepository;
use Model\DataChallengeRepository;
use AuthControlleur;
use Lib\DatabaseConnection;

class AdminControlleur implements Controlleur
{

    private $userRepo;
    private $challengerepo;
    private $messagerierepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository(new DatabaseConnection());
        $this->challengerepo = new DataChallengeRepository(new DatabaseConnection());
        $this->messagerierepo = new MessagerieRepository(new DatabaseConnection());
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
        if (isset($_POST)) {
            $user = new User();
            $user->setId($_POST['id']);
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
            $this->userRepo->updateAll($user);
            header('Location: /admin?onglet=Manage User');
        }

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
        $fonctionnalite = [
            "Manage User" => "./vue/components/admin/manage-user.php",
            "Manage Data Challenge" => "./vue/components/admin/manage-challenge.php",
            "Manage Ressource" => "./vue/components/admin/manage-ressources.php",
            "Messagerie" => "./vue/components/messagerie/messagerie.php"
        ];
        $type = "admin";
        if (isset($_GET['onglet'])) {
            $ongletcourant = $_GET['onglet'];
        } else {
            $ongletcourant = "Manage User";
        }

        $page = $fonctionnalite[$ongletcourant];

        if (isset($_GET['form'])) {
            $page = "./vue/components/admin/form.php";
        } else if (isset($_GET['config'])) {
            $page = "./vue/components/admin/challenge.config.php";
        }

        $content = new View($page);
        $content->assign('type', $type);
        
        if (isset($_GET['form']) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $content->assign("user", $this->userRepo->getUser($id));
        } else if (isset($_GET['config']) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $content->assign("challenge", $this->challengerepo->getDataChallenge($id));
        }

        switch ($ongletcourant) {
            case "Manage User":
                $content->assign("users", $this->userRepo->getUsers());
                break;
            case "Manage Data Challenge":
                $content->assign("dataChallenges", $this->challengerepo->getAllChallenges());
                break;
            case "Messagerie":
                $content->assign("messages", $this->messagerierepo->getAllMessage());
                break;
            default:
                break;
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