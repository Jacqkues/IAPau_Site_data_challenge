<?php

namespace Controlleur;

use jmvc\Controlleur;

class GestionnaireControlleur implements Controlleur
{
    //envoi un message aux participants d'un datachallenge
    public function sendMsgDataChallenge(){

    }

    //accéder aux échanges entre participants
    public function getMsgDataChallenge(){

    }

    //lire les infos d'un projet 
    public function readProject(){

    }

    //;crée un questionnaire
    public function createQuestionnaire(){

    }

    //lire les réponses d'un questionnaire
    public function readQuestionnaire(){

    }



    //tableau de bord du gestionnaire
    public function index()
    {
        echo "hello gestionnaire";
        echo '<a href="/logout">deconnexion</a>';
    }
}