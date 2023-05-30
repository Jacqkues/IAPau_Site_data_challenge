<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;

use Model\EquipeRepository;
use Model\MembreRepository;
use Model\UserRepository;
use Model\DataChallengeRepository;
use Model\MessagerieRepository;
use Lib\DatabaseConnection;

class GestionnaireControlleur implements Controlleur
{
    private $userRepo;
    private $challengerepo;
    private $messagerierepo;
    private $equipesRepo;
    private $membreRepo;

    public function __construct()
    {
        $db = new DatabaseConnection();
        $this->userRepo = new UserRepository($db);
        $this->challengerepo = new DataChallengeRepository($db);
        $this->messagerierepo = new MessagerieRepository($db);
        $this->equipesRepo = new EquipeRepository($db);
        $this->membreRepo = new MembreRepository($db);
    }

    // tableau de bord du gestionnaire
    public function index()
    {
        $fonctionnalite = [
            "Manage Data Challenge" => "./vue/components/gestionnaire/data-challenge.php",
            "Manage Ressource" => "./vue/components/admin/manage-ressources.php",
            "Messagerie" => "./vue/components/messagerie/messagerie.php"
        ];
        $type = $_SESSION['user']->getType();
        if (isset($_GET['onglet'])) {
            $ongletcourant = $_GET['onglet'];
        } else {
            $ongletcourant = "Manage Data Challenge";
        }

        $page = $fonctionnalite[$ongletcourant];

        if (isset($_GET['details-challenge'])) {
            $page = "./vue/components/gestionnaire/challenge-details.php";
        }
        // } else if (isset($_GET['config'])) {

        //     $page = "./vue/components/admin/challenge.config.php";
        //     $ongletcourant = "Manage Data Challenge";
        // } else if (isset($_GET['addP'])) {

        //     $page = "./vue/components/admin/projet.ajout.php";
        //     $ongletcourant = "Manage Data Challenge";
        // } else if (isset($_GET["newData"])) {

        //     $page = "./vue/components/admin/challenge.ajout.php";
        //     $ongletcourant = "Manage Data Challenge";

        // } else if (isset($_GET["addR"])) {

        //     $page = "./vue/components/admin/ressource.ajout.php";
        //     $ongletcourant = "Manage Ressource";
        // } elseif (isset($_GET["projetConf"])) {

        //     $page = "./vue/components/admin/projet.modif.php";
        //     $ongletcourant = "Manage Data Challenge";
        // }

        $content = new View($page);
        $content->assign('type', $type);

        if (
            isset($_GET['details-challenge'])
        ) {
            $content->assign("equipes", $this->equipesRepo->getEquipeByDataChallenge($_GET['challenge']));
            $content->assign("membres", $this->membreRepo);
            $content->assign("users", $this->userRepo);
        }
        // } else if (
        //     isset($_GET['config'])
        //     && isset($_GET['id'])
        // ) {
        //     $content->assign("challenge", $this->challengerepo->getDataChallenge($_GET['id']));

        //     try {
        //         $content->assign("projets", $this->challengerepo->getProjets($_GET['id']));
        //     } catch (\Exception $e) {
        //         $content->assign("projets", null);
        //     }
        //     try {
        //         $content->assign("ressources", $this->associationRepository->getResourceByChallenge($_GET['id']));
        //     } catch (\Exception $e) {
        //         $content->assign("ressources", null);
        //     }

        // }
        // } else if (isset($_GET['addP']) && isset($_GET['id'])) {
        //     $id = $_GET['id'];
        //     $content->assign("challenge", $this->challengerepo->getDataChallenge($id));
        // } else if (isset($_GET['addR']) && isset($_GET['id'])) {
        //     $id = $_GET['id'];
        //     $content->assign("challenge", $this->challengerepo->getDataChallenge($id));
        // } else if (isset($_GET['projetConf']) && isset($_GET['id']) && isset($_GET['idChallenge'])) {
        //     $id = $_GET['id'];
        //     $content->assign("projet", $this->projetRepo->getProjetData($id));
        //     $content->assign("ressources", $this->associationRepository->getResourceByChallenge($_GET['idChallenge']));
        //     try {
        //         $content->assign("projetressources", $this->associationRepository->getRessourceByProjet($id));
        //     } catch (\Exception $e) {
        //         $content->assign("projetressources", null);
        //     }
        // }

        switch ($ongletcourant) {
            case "Manage Data Challenge":
                $content->assign("dataChallenges", $this->challengerepo->getAllChallenges());
                break;
            case "Messagerie":
                $content->assign("messages", $this->messagerierepo->getAllMessage());
                $content->assign("categories", $this->challengerepo->getAllChallenges());
                $content->assign("users", $this->userRepo);
                break;
            case "Manage Ressource":
                $content->assign("ressources", $this->ressourceRepository->getAllRessources());
                $content->assign("dataChallenges", $this->challengerepo->getAllChallenges());
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