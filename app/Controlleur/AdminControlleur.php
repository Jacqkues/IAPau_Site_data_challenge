<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;
use Model\User;
use Model\UserRepository;
use AuthControlleur;
use Lib\DatabaseConnection;

class AdminControlleur implements Controlleur
{
    //ajout suppresion et modification d'un utilisateur
    public function addUser(){

    }

    public function deleteUser(){

    }

    public function updateUser(){

    }

    //ajout suppression et modification d'un Data Challenge

    public function addDataChallenge(){

    }

    public function deleteDataChallenge(){

    }

    public function updateDataChallenge(){

    }

    //ajout suppression et modification des ressources
    public function addRessource(){

    }
    public function deleteRessource(){

    }
    public function updateRessource(){

    }

    public function index()
    {
       echo "hello admin";
    }


}