<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;

use Model\DataBattleRepository;
use Model\Entites\dataBattle;
use Model\Entites\Questionnaire;
use Model\EquipeRepository;
use Model\MembreRepository;
use Model\QuestionnaireRepository;
use Model\RessourceRepository;
use Model\UserRepository;
use Model\DataChallengeRepository;
use Model\MessagerieRepository;
use Lib\DatabaseConnection;
use Model\AssociationRepository;

class GestionnaireControlleur implements Controlleur
{
    private $userRepo;
    private $challengerepo;
    private $messagerierepo;
    private $equipesRepo;
    private $membreRepo;
    private $ressourceRepository;

    private $battleRepo;
    private $questionnaireRepo;
    private $associationRepo;

    public function __construct()
    {
        $db = new DatabaseConnection();
        $this->userRepo = new UserRepository($db);
        $this->challengerepo = new DataChallengeRepository($db);
        $this->messagerierepo = new MessagerieRepository($db);
        $this->equipesRepo = new EquipeRepository($db);
        $this->membreRepo = new MembreRepository($db);
        $this->associationRepo = new AssociationRepository($db);
        $this->ressourceRepository = new RessourceRepository($db);
        $this->battleRepo = new DataBattleRepository($db);
        $this->questionnaireRepo = new QuestionnaireRepository($db);
    }

    public function updateBattle(){
        if(isset($_POST)){
            $battle = new dataBattle();
            $battle->setIdBattle($_POST['id']);
            $battle->setLibelleBattle($_POST['libelle']);
            $battle->setDebut($_POST['debut']);
            $battle->setFin($_POST['fin']);
            $this->battleRepo->updateDebBattle($battle->getIdBattle(), $battle->getDebut());
            $this->battleRepo->updateFinBattle($battle->getIdBattle(), $battle->getFin());
            $this->battleRepo->updateLibelleBattle($battle->getIdBattle(), $battle->getLibelleBattle());
            header('Location: /gestionnaire?onglet=Manage Data Battle');
        }
    }

    public function addQuestionnaire(){
        if(isset($_POST)){
            $questionnaire = new Questionnaire();
            $questionnaire->setDebut($_POST['debut']);
            $questionnaire->setFin($_POST['fin']);
            $questionnaire->setLien($_POST['lien']);
            $questionnaire->setIdBattle($_POST['idBattle']);
            $this->questionnaireRepo->addQuestionnaire($questionnaire->getDebut(), $questionnaire->getFin(), $questionnaire->getLien(), $questionnaire->getIdBattle());
            header('Location: /gestionnaire?onglet=Manage Data Battle');
        }
    }

    // tableau de bord du gestionnaire
    public function index()
    {
        $fonctionnalite = [
            "Manage Defis" => "./vue/components/gestionnaire/data-challenge.php",
            "Manage Data Battle" => "./vue/components/gestionnaire/data-battle.php",
            "Vos projets" => "./vue/components/gestionnaire/projet.php",
            "Messagerie" => "./vue/components/messagerie/messagerie.php"
        ];
        $type = $_SESSION['user']->getType();
        if (isset($_GET['onglet']) && $fonctionnalite[$_GET['onglet']]) {
            $ongletcourant = $_GET['onglet'];
        } else {
            $ongletcourant = "Manage Defis";
        }

        $page = $fonctionnalite[$ongletcourant];

        if (isset($_GET['details-challenge'])) {
            $page = "./vue/components/gestionnaire/challenge-details.php";
        }
        elseif(isset($_GET['updateBattle'])){
            $page ="./vue/components/gestionnaire/battle/updateBattle.php";
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
            case "Manage Defis":
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
            case "Vos projets":
                $content->assign("projets", $this->associationRepo->getProjetByContact($_SESSION['user']->getId()));
                break;
            case "Manage Data Battle":
                $content->assign("dataBattle", $this->challengerepo->getAllBattles());
                break;
            default:
                break;
        }

        $content = $content->render();


        $dashboard = new View("./vue/components/dashboard/dashboard-global.php");
        $dashboard->assign("title", "Gestionnaire Dashboard");
        $dashboard->assign("type", $_SESSION['user']->getType());
        $dashboard->assign("onglet_courant", $ongletcourant);
        $dashboard->assign("onglets", array_keys($fonctionnalite));
        $dashboard->assign("nom", $_SESSION['user']->getNom());
        $dashboard->assign("prenom", $_SESSION['user']->getPrenom());
        $dashboard->assign("content", $content);

        $dashboard->show();
    }
}