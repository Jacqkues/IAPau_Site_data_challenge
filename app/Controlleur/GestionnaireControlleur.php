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
        if (isset($_GET['onglet']) && $fonctionnalite[$_GET['onglet']]) {
            $ongletcourant = $_GET['onglet'];
        } else {
            $ongletcourant = "Manage Data Challenge";
        }

        $page = $fonctionnalite[$ongletcourant];

        if (isset($_GET['details-challenge'])) {
            $page = "./vue/components/gestionnaire/challenge-details.php";
        }

        $content = new View($page);
        $content->assign('type', $type);

        if (
            isset($_GET['details-challenge'])
        ) {
            $content->assign("equipes", $this->equipesRepo->getEquipeByDataChallenge($_GET['challenge']));
            $content->assign("membres", $this->membreRepo);
            $content->assign("users", $this->userRepo);
        }

        switch ($ongletcourant) {
            case "Manage Data Challenge":
                $content->assign("dataChallenges", $this->challengerepo->getAllChallenges());
                break;
            case "Messagerie":
                $categorie = isset($_GET['categorie'])?$_GET['categorie']:"GÉNÉRAL";
                try {
                    $content->assign("messages", $this->messagerierepo->getMessageByCat($categorie));
                } catch (\Exception $e) {
                    $content->assign("messages", []);
                }
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