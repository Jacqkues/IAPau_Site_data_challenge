<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;

use Model\Entites\User;
use Model\UserRepository;
use Lib\DatabaseConnection;

class MainControlleur implements Controlleur
{

    public function showdatachallenge(){

    }

    public function showClassement(){

    }

    public function showSubject(){
        
    }
    public function index()
    {
        $mainPage = new View("./vue/components/main/main.php");
        $mainPage->show();
    }

    public function dash_tmp()
    {
        $dash_tmpPage = new View("./vue/components/dashboard/dashboard-global.php");
        $dash_tmpPage->show();
    }
}