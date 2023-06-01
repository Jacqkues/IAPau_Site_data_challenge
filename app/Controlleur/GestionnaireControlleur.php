<?php

namespace Controlleur;

use Exception;
use jmvc\Controlleur;
use jmvc\View;

use Model\DataBattleRepository;
use Model\Entites\dataBattle;
use Model\Entites\dataChallenge;
use Model\Entites\Equipe;
use Model\Entites\Questionnaire;
use Model\Entites\Question;
use Model\Entites\Reponse;
use Model\EquipeRepository;
use Model\MembreRepository;
use Model\QuestionnaireRepository;
use Model\QuestionRepository;
use Model\ReponseRepository;
use Model\RessourceRepository;
use Model\UserRepository;
use Model\DataChallengeRepository;
use Model\MessagerieRepository;
use Lib\DatabaseConnection;
use Model\AssociationRepository;
use Model\QuestionException;
use Model\ReponseException;

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
    private $questionRepo;
    private $reponseRepo;

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
        $this->questionRepo = new QuestionRepository($db);
        $this->reponseRepo = new ReponseRepository($db);
    }

    public function updateBattle(){
        if(isset($_POST) && $_POST['types'] == "battle"){
            $battle = new dataChallenge();
            $battle->setIdChallenge($_POST['id']);
            $battle->setLibelle($_POST['libelle']);
            $battle->setTempsDebut($_POST['debut']);
            $battle->setTempsFin($_POST['fin']);
            $battle->setType($_POST['types']);
            $this->challengerepo->updateDebBattle($battle->getIdChallenge(), $battle->getTempsDebut());
            $this->challengerepo->updateFinBattle($battle->getIdChallenge(), $battle->getTempsFin());
            $this->challengerepo->updateLibelleBattle($battle->getIdChallenge(), $battle->getLibelle());
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
            header('Location: /gestionnaire?detail-battle&id='.$_POST['idBattle']);
        }
    }


    public function ajoutQuestion(){
        if(isset($_POST)){
            $question = new Question();
            $question->setQuestion($_POST['question']);
            $question->setIdQuestionnaire($_POST['idQuestionnaire']);
            try{
                $this->questionRepo->addQuestion($question->getQuestion(), $question->getIdQuestionnaire());
            }catch(QuestionException $e){
                $this->questionRepo->addQuestion($question->getQuestion(), '');
            }
            header('Location: /gestionnaire?modifQuestion&id='.$question->getIdQuestionnaire());
        }
    }

    public function updateQuestion(){
        if(isset($_POST)){
            $question = new Question();
            $question->setQuestion($_POST['question']);
            $question->setIdQuestion($_POST['id']);
            $question->setIdQuestionnaire($_POST['idQuest']);
            try{
                $this->questionRepo->updateQuestion($question->getIdQuestion(), $question->getQuestion());
            }catch(QuestionException $e){
                $this->questionRepo->updateQuestion($question->getIdQuestion(), '');
            }
            header('Location: /gestionnaire?modifQuestion&id='.$question->getIdQuestionnaire());
        }
    }

    public function deleteQuestion(){
    
        $question= $_GET['id'];
        $this->questionRepo->deleteQuestion($question);
        header('Location: /gestionnaire?modifQuestion&id='.$_GET['idQ']);
    }

    public function addPoint(){
        if(isset($_POST)){
            $this->equipesRepo->changeScore($_POST['score'], $_POST['id']);
            header('Location: /gestionnaire?Reponse&id='.$_POST['idQ']);
        }
    }
    // tableau de bord du gestionnaire
    public function index()
    {
        $fonctionnalite = [
            "Manage Defis" => "./vue/components/gestionnaire/data-challenge.php",
            "Vos projets" => "./vue/components/gestionnaire/projet.php",
            "Messagerie" => "./vue/components/messagerie/messagerie.php",
            "Manage Data Battle" => "./vue/components/gestionnaire/data-battle.php"
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
        elseif(isset($_GET['detail-battle'])){
            $page = "./vue/components/gestionnaire/battle/detail-battle.php";
        }elseif (isset($_GET['modifQuestion'])) {
            $page = "./vue/components/gestionnaire/battle/modifQuestion.php";
        }elseif (isset($_GET['Reponse'])){
            $page = "./vue/components/gestionnaire/battle/reponse.php";
        }elseif(isset($_GET['addQuestionnaire'])){
            $page= "./vue/components/gestionnaire/battle/addQuestionnaire.php";
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
        elseif(isset($_GET['detail-battle'])){
            try{
                $content->assign("questionnaires", $this->questionnaireRepo->getQuestionnaireByBattle($_GET['id']));
                $content->assign('battle', $this->challengerepo->getDataChallenge($_GET['id']));
            } catch(Exception $e){
                $content->assign("questionnaires", []);
                $content->assign('battle', $this->challengerepo->getDataChallenge($_GET['id']));
            }
        }elseif(isset($_GET['modifQuestion'])){
            try{
                $content->assign('questions', $this->questionRepo->getQuestionByQuestionnaire($_GET['id']));
            }catch(QuestionException $e){
                $content->assign('questions', []);
            }
        }elseif(isset($_GET['Reponse'])){
            try{
                $content->assign('reponses', $this->reponseRepo->getAllReponses());
                $content->assign('questions', $this->questionRepo->getQuestionByQuestionnaire($_GET['id']));  
            }
            catch(ReponseException $e){
                try {
                    $content->assign('reponses', []);
                    $content->assign('questions', $this->questionRepo->getQuestionByQuestionnaire($_GET['id']));
                } catch (QuestionException $e) {
                    $content->assign('reponses', []);
                    $content->assign('questions', []);
                }
            }
            catch(QuestionException $e){
                $content->assign('reponses', []);  
                $content->assign('questions', []);
            }
        }

        switch ($ongletcourant) {
            case "Manage Defis":
                $content->assign("dataChallenges", $this->challengerepo->getAllChallenges());
                break;
            case "Messagerie":
                $categorie = isset($_GET['categorie'])?$_GET['categorie']:"GÉNÉRAL";
                try {
                    $content->assign("messages", $this->messagerierepo->getMessageByCat($categorie));
                } catch (Exception $e) {
                    $content->assign("messages", []);
                }
                $content->assign("categories", $this->challengerepo->getAllChallenges());
                $content->assign("users", $this->userRepo);
                break;
            case "Vos projets":
                $content->assign("projets", $this->associationRepo->getProjetByContact($_SESSION['user']->getId()));
                break;
            case "Manage Data Battle":
                $content->assign("dataBattle", $this->challengerepo->getChallengeByType("battle"));
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