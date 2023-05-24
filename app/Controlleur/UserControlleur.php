<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;

class UserControlleur implements Controlleur
{
    public function index()
    {
       $fonctionnalite = ["Mon compte" => "./vue/components/admin/manage-user.php" ,"Mes challenges" => "./vue/components/admin/manage-challenge.php","Challenges disponibles" => "./vue/components/admin/manage-ressources.php", "Mes equipes" => "./vue/components/admin/manage-ressources.php","Mon profil" => "./vue/components/admin/manage-ressources.php"];
       $type = "user";
       if(isset($_GET['onglet'])){
           $ongletcourant = $_GET['onglet'];
       }
       else{
           $ongletcourant = "Mon compte";
          
       }

        $content = new View($fonctionnalite[$ongletcourant]);
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