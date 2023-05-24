<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;

use Model\Entites\User;
use Model\UserRepository;
use Lib\DatabaseConnection;

class MainControlleur implements Controlleur
{

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
                case "gesionnaire":
                    header('Location: /gestionnaire');
                    break;
            }
            exit();
        }
        $mainPage = new View("./vue/components/main/main.php");
        $mainPage->show();
    }
}