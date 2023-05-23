<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;

use Model\Entites\User;
use Model\UserRepository;
use Lib\DatabaseConnection;

class MainControlleur implements Controlleur
{

    public function Test(){
        $rep = new UserRepository(new DatabaseConnection());
        $tes = $rep->getUsers();
        var_dump($tes);
    }

    public function allChallenges(){

    }
    public function index()
    {

        $mainPage = new View("./vue/components/main/main.php");
        $mainPage->show();

    }
}