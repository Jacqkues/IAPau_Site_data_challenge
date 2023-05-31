<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;
use Model\Entites\User;
use Model\MessagerieRepository;
use Model\Entites\projetData;
use Model\UserRepository;
use Model\DataChallengeRepository;
use Model\ProjetDataRepository;
use Model\Entites\dataChallenge;
use Model\Entites\Ressources;
use Model\RessourceRepository;
use Model\AssociationRepository;
use AuthControlleur;
use Lib\DatabaseConnection;

class AdminControlleur implements Controlleur
{

    private $userRepo;
    private $challengerepo;
    private $messagerierepo;

    private $projetRepo;

    private $ressourceRepository;

    private $associationRepository;


    public function __construct()
    {
        $this->userRepo = new UserRepository(new DatabaseConnection());
        $this->challengerepo = new DataChallengeRepository(new DatabaseConnection());
        $this->messagerierepo = new MessagerieRepository(new DatabaseConnection());
        $this->projetRepo = new ProjetDataRepository(new DatabaseConnection());
        $this->ressourceRepository = new RessourceRepository(new DatabaseConnection());
        $this->associationRepository = new AssociationRepository(new DatabaseConnection());
    }

    public function addPartenaire()
    {
        if (isset($_POST)) {
            $idProjet = $_POST['idProjet'];
            $id = $_POST['id'];
            $this->associationRepository->lierContactProjet($id, $idProjet);
            header('Location: /admin?projetConf&id=' . $idProjet . '&idChallenge=' . $_POST['idChallenge']);
        }
    }

    public function removePartenaire()
    {
        if (isset($_POST)) {
            $idProjet = $_GET['idProjet'];
            $id = $_GET['id'];
            $this->associationRepository->removePartenaire($id, $idProjet);
            header('Location: /admin?projetConf&id=' . $idProjet . '&idChallenge=' . $_GET['idChallenge']);
        }
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
            header('Location: /admin?onglet=User');
        }

    }

    public function deleteUser()
    {
        $userId = $_GET['id'];
        $this->userRepo->deleteUser($userId);
        header('Location: /admin?onglet=User');
    }

    public function postDefi(){
        if(isset($_GET)){
            $idChallenge = $_GET['id'];
            $this->challengerepo->publierDefi($idChallenge);
            header('Location: /admin?config&id=' . $idChallenge );
        }
    }

    public function masqDefi(){
        if(isset($_GET)){
            $idChallenge = $_GET['id'];
            $this->challengerepo->masquerDefi($idChallenge);
            header('Location: /admin?config&id=' . $idChallenge );
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
            $user->setType($_POST['type']);
            $this->userRepo->changeNom($user->getNom(), $user->getId());
            $this->userRepo->changePrenom($user->getPrenom(), $user->getId());
            $this->userRepo->changeEtab($user->getEtablissement(), $user->getId());
            $this->userRepo->changeNiveau($user->getNivEtude(), $user->getId());
            $this->userRepo->changeTel($user->getNumTel(), $user->getId());
            $this->userRepo->changeMail($user->getMail(), $user->getId());
            $this->userRepo->changeType($user->getType(), $user->getId());
            header('Location: /admin?onglet=Manage User');
        }

    }

    public function addProjet()
    {
        if (isset($_POST)) {
            $projet = new projetData();
            $projet->setLibelle($_POST['titre']);
            $projet->setDescription($_POST['description']);
            $projet->setLienImg($_POST['lienimg']);
            $projet->setIdDataChallenge($_POST['id']);
            $this->projetRepo->addProjet($projet);
            header('Location: /admin?config&id=' . $_POST['id']);
        }
    }

    public function deleteProjet()
    {
        $projetId = $_GET['id'];
        $this->projetRepo->deleteProjet($projetId);
        header('Location: /admin?config&id=' . $_GET['idChallenge']);
    }

    //ajout suppression et modification d'un Data Challenge
    public function addDataChallenge()
    {
        if (isset($_POST)) {
            $challenge = new dataChallenge();
            $challenge->setLibelle($_POST['titre']);
            $challenge->setTempsDebut($_POST['debut']);
            $challenge->setTempsFin($_POST['fin']);
            $challenge->setType($_POST['type']);
            $challenge->setIsPublied("0");

            $this->challengerepo->addChallenge($challenge);

            if($challenge->getType() == "battle"){
                $projet = new projetData();
                $projet->setLibelle($_POST['titreProjet']);
                $projet->setDescription($_POST['descriptionProjet']);
                $projet->setLienImg($_POST['lienProjet']);
                $id = $this->challengerepo->getId($challenge);
                $projet->setIdDataChallenge($id);
                $this->projetRepo->addProjet($projet);   
            }
            header('Location: /admin?onglet=Data Defis');
        }
    }

    public function deleteDataChallenge()
    {
        $id = $_GET['id'];
        echo $id;
        $this->challengerepo->deleteChallenge($id);
        header('Location: /admin?onglet=Data Defis');
    }

    public function updateDataChallenge()
    {

    }

    //ajout suppression et modification des ressources
    public function addRessource()
    {
        if (isset($_POST) && isset($_POST['titre']) && isset($_POST['lien']) && isset($_POST['type']) && !isset($_POST['id'])) {
            $ressource = new Ressources();
            $ressource->setNom($_POST['titre']);
            $ressource->setLien($_POST['lien']);
            $ressource->setTypes($_POST['type']);
            $id = $this->ressourceRepository->addRessources($ressource);
            if (isset($_POST['challenge'])) {
                $this->associationRepository->addResourceDataChallenge($_POST['challenge'], $id);
                if (isset($_POST['mnr'])) {
                    header('Location: /admin?onglet=Ressource&idChallenge=' . $_POST['challenge']);
                } else {
                    header('Location: /admin?config&id=' . $_POST['challenge']);
                }

            } else if (isset($_POST['projetId'])) {
                $this->associationRepository->addResourceProjet($_POST['projetId'], $id);
                if (isset($_POST['mnr'])) {
                    header('Location: /admin?onglet=Ressource&idChallenge=' . $_POST['idChallenge'] . "&idProjet=" . $_POST['projetId']);
                } else {
                    header('Location: /admin?projetConf&id=' . $_POST['projetId'] . "&idChallenge=" . $_POST['idChallenge']);
                }
            }



        } else if (isset($_POST) && isset($_POST['id'])) {
            $ressource = new Ressources();
            $ressource->setId($_POST['id']);
            $ressource->setNom($_POST['titre']);
            $ressource->setLien($_POST['lien']);
            $ressource->setTypes($_POST['type']);
            $this->ressourceRepository->updateRessources($ressource);
            header('Location: /admin?onglet=Ressource');
        } else {
            header('Location: /admin?config&id=' . $_POST['idChallenge']);
        }

    }
    public function deleteRessource()
    {

        if (isset($_GET['id'])) {
            $this->ressourceRepository->deleteRessource($_GET['id']);
            if (isset($_GET['idChallenge']) && isset($_GET['mnr'])) {
                header('Location: /admin?onglet=Ressource&idChallenge=' . $_GET['idChallenge']);
            } else {
                header('Location: /admin?config&id=' . $_GET['idChallenge']);
            }

        }

    }

    public function index()
    {
        $fonctionnalite = [
            "User" => "./vue/components/admin/manage-user.php",
            "Data Defis" => "./vue/components/admin/manage-challenge.php",
            "Ressource" => "./vue/components/admin/manage-ressources.php",
            "Messagerie" => "./vue/components/messagerie/messagerie.php"
        ];
        $type = "admin";
        if (isset($_GET['onglet'])) {
            $ongletcourant = $_GET['onglet'];
        } else {
            $ongletcourant = "User";
        }

        $page = $fonctionnalite[$ongletcourant];

        if (isset($_GET['form'])) {

            $page = "./vue/components/admin/form.php";
        } else if (isset($_GET['config'])) {

            $page = "./vue/components/admin/challenge.config.php";
            $ongletcourant = "Data Defis";
        } else if (isset($_GET['addP'])) {

            $page = "./vue/components/admin/projet.ajout.php";
            $ongletcourant = "Manage Data Challenge";
        } else if (isset($_GET["newData"])) {

            $page = "./vue/components/admin/challenge.ajout.php";
            $ongletcourant = "Data Defis";

        } else if (isset($_GET["addR"])) {
            $page = "./vue/components/admin/ressource.ajout.php";
            $ongletcourant = "Ressource";
        } elseif (isset($_GET["projetConf"])) {
            $page = "./vue/components/admin/projet.modif.php";
            $ongletcourant = "Data Defis";

        }

        $content = new View($page);
        $content->assign('type', $type);

        if (isset($_GET['form']) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $content->assign("user", $this->userRepo->getUser($id));
        } else if (isset($_GET['config']) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $content->assign("challenge", $this->challengerepo->getDataChallenge($id));
            try {
                $content->assign("projets", $this->projetRepo->getProjetByChallenge($id));
            } catch (\Exception $e) {
                $content->assign("projets", []);
            }
            try {
                $content->assign("ressources", $this->associationRepository->getResourceByChallenge($id));
            } catch (\Exception $e) {
                $content->assign("ressources", []);
            }




        } else if (isset($_GET['addP']) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $content->assign("challenge", $this->challengerepo->getDataChallenge($id));
        } else if (isset($_GET['addR']) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $content->assign("challenge", $this->challengerepo->getDataChallenge($id));
        } else if (isset($_GET['projetConf']) && isset($_GET['id']) && isset($_GET['idChallenge'])) {
            $id = $_GET['id'];
            $content->assign("projet", $this->projetRepo->getProjetData($id));
            $content->assign("ressources", $this->associationRepository->getResourceByChallenge($_GET['idChallenge']));
            $content->assign("partenaires", $this->associationRepository->getContactByProjet($id));
            try{
                $content->assign("gestionnaires", $this->userRepo->getGestionnaire());
            }catch (\Exception $e){
                $content->assign("gestionnaires", null);
            }
            
            try {
                $content->assign("projetressources", $this->associationRepository->getRessourceByProjet($id));
            } catch (\Exception $e) {
                $content->assign("projetressources", null);
            }
        } else if (isset($_GET['addR']) && isset($_GET['idRes'])) {
            $id = $_GET['idRes'];
            $content->assign("ressource", $this->ressourceRepository->getRessources($id));
        }

        switch ($ongletcourant) {
            case "User":
                $content->assign("users", $this->userRepo->getUsers());
                break;
            case "Data Defis":
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
            case "Ressource":

                $content->assign("dataChallenges", $this->challengerepo->getAllChallenges());
                if (isset($_GET['idChallenge'])) {
                    try {
                        $content->assign("challenge", $this->challengerepo->getDataChallenge($_GET['idChallenge']));
                    } catch (\Exception $e) {
                        $content->assign("challenge", null);
                    }
                    try {
                        $content->assign("ressources", $this->associationRepository->getResourceByChallenge($_GET['idChallenge']));
                    } catch (\Exception $e) {
                        $content->assign("ressources", null);
                    }
                    try {
                        $content->assign("projetList", $this->projetRepo->getProjetByChallenge($_GET['idChallenge']));
                    } catch (\Exception $e) {
                        $content->assign("projetList", []);
                    }
                }
                if (isset($_GET['idProjet'])) {
                    try {
                        $content->assign("projetSelected", $this->projetRepo->getProjetData($_GET['idProjet']));
                        $content->assign("projetressources", $this->associationRepository->getRessourceByProjet($_GET['idProjet']));
                        $content->assign("idProjet", $_GET['idProjet']);
                    } catch (\Exception $e) {
                        $content->assign("projet", []);
                        $content->assign("projetressources", []);
                    }
                }
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