<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;

use Model\DataChallengeRepository;
use Model\RessourceRepository;
use Lib\DatabaseConnection;

class MainControlleur implements Controlleur
{
    private $dataChallengeRepo;

    private $ressource;

    public function __construct()
    {
        $this->dataChallengeRepo = new DataChallengeRepository(new DatabaseConnection());
        $this->ressource = new RessourceRepository(new DatabaseConnection());
    }

    public function showdatachallenge()
    {
        $descriptionChallenge = new View("./vue/components/description-challenge/description-challenge.php");
        $descriptionChallenge->show();
    }

    public function showClassement()
    {

    }

    public function showSubject()
    {

    }
    public function index()
    {
        if (isset($_SESSION['user'])) {
            switch (strtolower($_SESSION['user']->getType())) {
                case "admin":
                    header('Location: /admin');
                    break;
                case "user":
                    header('Location: /user');
                    break;
                case "gestionnaire":
                    header('Location: /gestionnaire');
                    break;
            }
            exit();
        }
        $challengesDispo = new View("./vue/components/challenges-dispo/challenges-dispo.php");
        $challengesDispo->assign("challengesDispo", $this->dataChallengeRepo->getAllChallenges());
        $challengesDispo->assign("ressourceRepo", $this->ressource);

        $mainPage = new View("./vue/components/main/main.php");
        $mainPage->assign("challengesDispoPage", $challengesDispo->render());
        $mainPage->show();
    }
}