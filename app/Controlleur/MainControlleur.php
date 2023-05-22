<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;
use Model\User;
use Model\UserRepository;
use Lib\DatabaseConnection;

class MainControlleur implements Controlleur
{


    public function index()
    {

        $mainPage = new View("./vue/components/main/main.php");
        $mainPage->show();

    }


}