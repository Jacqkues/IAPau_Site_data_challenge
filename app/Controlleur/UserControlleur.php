<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;
use Lib\DatabaseConnection;
use Model\DataChallengeRepository;
use Model\EquipeRepository;
use Model\MembreRepository;
use Model\MessagerieRepository;
use Model\ProjetDataRepository;
use Model\RenduRepository;
use Model\UserRepository;
use Model\Entites\User;
use Model\QuestionnaireRepository;
use Model\QuestionRepository;
use Model\ReponseRepository;
use Model\Entites\Reponse;

class UserControlleur implements Controlleur
{
    private UserRepository $userRepo;
    private MessagerieRepository $messagerierepo;
    private DataChallengeRepository $challengerepo;
    private EquipeRepository $equiperepo;

    private MembreRepository $membreRepo;

    private ProjetDataRepository $projetDataRepo;

    private RenduRepository $renduRepo;

    private QuestionnaireRepository $questionnaireRepo;

    private QuestionRepository $questionRepo;

    private ReponseRepository $reponseRepo;
    
    public function __construct()
    {
        $db = new DatabaseConnection();
        $this->userRepo = new UserRepository($db);
        $this->challengerepo = new DataChallengeRepository($db);
        $this->messagerierepo = new MessagerieRepository($db);
        $this->equiperepo = new EquipeRepository($db);
        $this->membreRepo = new MembreRepository($db);
        $this->projetDataRepo = new ProjetDataRepository($db);
        $this->renduRepo = new RenduRepository($db);
        $this->questionnaireRepo = new QuestionnaireRepository($db);
        $this->questionRepo = new QuestionRepository($db);
        $this->reponseRepo = new ReponseRepository($db);
    }

    public function saveResponse(){
        if(isset($_POST)){
            $this->reponseRepo->addReponse($_POST['idQuestion'], $_POST['reponse'], $_POST['idEquipe']);
            header('Location: /user/answer?id='.$_POST['idBattle'] .'&idEquipe='.$_POST['idEquipe']);
        }
    }
    public function answer(){
        $id = $_GET['id'];
        $view = new View("./vue/components/user/questionnaire.php");
        $view->assign('questionnaire', $this->questionnaireRepo);
        try{
            $view->assign('questions', $this->questionRepo->getQuestionByQuestionnaire($id));
        }catch(\Exception $e){
            $view->assign('questions', []);
        }
       
        $view->assign('reponses', $this->reponseRepo);
        $view->assign('idEquipe', $_GET['idEquipe']);
        $view->show();
    }

    public function autocomplete()
    {
        $query = $_GET['query'];

        // Generate autocomplete suggestions based on the query
        $suggestions = $this->userRepo->getPrenomNom();

        $filteredSuggestions = array();
        foreach ($suggestions as $suggestion) {
            if (strpos(strtolower($suggestion), strtolower($query)) !== false) {
                $filteredSuggestions[] = $suggestion;
            }
        }

        // Return the suggestions as a JSON response
        echo json_encode($filteredSuggestions);
    }
    public function updateUserPSW()
    {
        if (
            isset($_POST["mdp"])
            && isset($_POST["confirm"])
            && $_POST["mdp"] == $_POST["confirm"]
        ) {
            $user = new User();
            $user->setId($_POST['id']);
            $user->setMdp(password_hash($_POST['mdp'], PASSWORD_DEFAULT));
            $this->userRepo->changeMDP($user->getMdp(), $user->getId());
            header('Location: /user?onglet=Mon compte');
        } else {
            header('Location: /user?updateMDP&error=diff');

        }
    }
    public function updateUser()
    {
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

            $_SESSION['user'] = $this->userRepo->getUser($user->getId());

            header('Location: /user?onglet=Mon compte');
            exit();
        }
    }

    public function newequipe()
    {
        if (isset($_POST)) {

            $equipe = $this->equiperepo->addEquipe($_SESSION['user']->getId(), $_POST['nom']);
            echo $equipe;

            $this->membreRepo->addMembre($equipe, $_SESSION['user']->getId());
            $Today = date('Y-m-d');
            $this->renduRepo->addRendu("empty",$Today, $equipe);
            header('Location: /user?onglet=Mes equipes');
        }
    }

    public function deleteEquipe()
    {
        if (isset($_POST)) {
            $equipe = $this->equiperepo->getEquipe($_GET['id']);
            if ($equipe->getIdChef() == $_SESSION['user']->getId()) {
                $this->equiperepo->deleteEquipe($_GET['id']);
                header('Location: /user?onglet=Mes equipes');
            } else {
                header('Location: /user?onglet=Mes equipes&error=notchef');
            }
        }
    }

    public function Updaterendu(){
        if(isset($_POST)){
            $id = $_POST['id'];

            $equipe = $this->equiperepo->getEquipe($_POST['id']);
            if($equipe->getIdChef() == $_SESSION['user']->getId()){
                $today = date('Y-m-d');
                $this->renduRepo->updateRendu($id, $_POST['lien'],$today);
                header('Location: /user?onglet=Mes%20projets');
            }else{
                header('Location: /user?onglet=Mes%20projetss&error=notchef');
            }
        }
    }

    public function addToEquipe(){
        if(isset($_POST)){
            list($prenom, $nom) = explode(' ', $_POST['nom']);
            try{
                $user = $this->userRepo->getUserByNomPrenom($nom, $prenom);
            }catch(\Exception $e){
                header('Location: /user?onglet=Mes equipes&error='.$e->getMessage());
            }
            try{
                $res = $this->membreRepo->addMembre($_POST['id'] ,$user->getId());
                
            }catch(\Exception $e){
                
                header('Location: /user?onglet=Mes equipes&error='.$e->getMessage());
                    
                
            }

            if ($res) {
                header('Location: /user?onglet=Mes equipes');
                exit();
            }

        }
    }

    public function inscrireEquipe()
    {
        if (
            !isset($_GET['equipe'])
            || !isset($_GET['projet'])
            || !isset($_GET['challenge'])
        ) {
            header('Location: /');
            exit();
        }

        $idEquipe = $_GET['equipe'];
        $idProjet = $_GET['projet'];
        $idChallenge = $_GET['challenge'];

        try {
            if ($this->equiperepo->checkEquipeHasProjet($idEquipe)) {
                header('Location: /dataChallenge?challenge=' . $idChallenge . '&error=Cette équipe est déjà inscrite à un projet.');
                exit();
            }
            $this->equiperepo->addProjet($idProjet, $idEquipe);
            header('Location: /user?onglet=Mes projets');
            exit();
        } catch (\Exception $e) {
            header('Location: /dataChallenge?challenge=' . $idChallenge . '&error=Une erreur s\'est produite.');
            exit();
        }
    }


    public function index()
    {
        $fonctionnalite = [
            "Challenges disponibles" => "./vue/components/challenges-dispo/challenge_user.php",
            "Mes projets" => "./vue/components/user/projet.php",
            "Mes equipes" => "./vue/components/user/equipe.php",
            "Code Analyse" => "./vue/components/gestionnaire/code-analyse.php",
            "Mon compte" => "./vue/components/monCompte/monCompte.php",
            "Messagerie" => "./vue/components/messagerie/messagerie.php",

        ];
        $type = "user";
        if (isset($_GET['onglet']) && $fonctionnalite[$_GET['onglet']]) {
            $ongletcourant = $_GET['onglet'];
        } else {
            $ongletcourant = "Challenges disponibles";
        }
        $page = $fonctionnalite[$ongletcourant];

        if (isset($_GET['updateMDP'])) {
            $page = "./vue/components/updateMDP/updateMDP.php";
        }
        $content = new View($page);
        $content->assign('type', $type);
        switch ($ongletcourant) {
            case "Challenges disponibles":
                try {
                    $content->assign("challengesDispo", $this->challengerepo->getdispo());
                } catch (\Exception $e) {
                    $content->assign("challengesDispo", []);
                }
                break;
            case "Mes projets":
                try {
                    /* $content->assign("projets", $this->projetDataRepo->getProjetFromUser($_SESSION['user']->getId()));
                    $content->assign("rendus",$this->renduRepo);*/
                    //recup list equipe de l'user
                    //pour chaque equipe recupere le projet associé et l'afficher
                    //du coup passé le projetRepository en paras
                    $content->assign("equipes", $this->equiperepo->getEquipeByUser($_SESSION['user']->getId()));
                    $content->assign("p",$this->projetDataRepo);
                    $content->assign("rendus",$this->renduRepo);
                    $content->assign("q",$this->questionnaireRepo);
                } catch (\Exception $e) {
                    $content->assign("projets", []);
                    $content->assign("p",null);
                    $content->assign("rendus",null);
                }
                break;
            case "Messagerie":
                $categorie = isset($_GET['categorie']) ? $_GET['categorie'] : "GÉNÉRAL";
                try {
                    $content->assign("messages", $this->messagerierepo->getMessageByCat($categorie));
                } catch (\Exception $e) {
                    $content->assign("messages", []);
                }
                try {
                    $content->assign("equipes", $this->equiperepo->getEquipeByUser($_SESSION['user']->getId()));
                } catch (\Exception $e) {
                    $content->assign("equipes", []);
                }
                $content->assign("challengerepo", $this->challengerepo);
                break;
            case "Mes equipes":
                try {

                    $content->assign("equipes", $this->equiperepo->getEquipeByUser($_SESSION['user']->getId()));
                    $content->assign("u", $this->userRepo);
                    $content->assign("eq", $this->equiperepo);
                    $content->assign("p", $this->projetDataRepo);
                } catch (\Exception $e) {
                    $content->assign("equipes", []);
                }
                break;
            default:
                break;
        }


        $id = $_SESSION['user']->getId();
        $content->assign("user", $this->userRepo->getUser($id));
        $content->assign("users", $this->userRepo);
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