<?php
//if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $error = false;
    $mdp = $_POST['mdp'];
    $mdpConfirm = $_POST["confirm"];
    if( $mdp != $mdpConfirm){
        $verif  ="⚠️ Vous n'avez pas rentrez le même mot de passe ⚠️";
        $mdpclass ="error";
        $error = true;
    }

    if(!$error){
        $envoie = "Le mot de passe a été changé avec succès";
    }
//}