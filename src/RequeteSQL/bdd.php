<?php
    require_once('credentials.php');

    $bdd = NULL;


    /*!
     *  \fn Connexion()
     *  \author Serres Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 09:26:29
     *  \brief fonction permettant de se connecter à la base de données
    */
    function Connexion(){
        global $bdd;

        $bdd = mysqli_connect(HOST,USER,PASSWORD,BASE);

        if(!$bdd){
            throw new Exception(mysqli_connect_error());
        }

        return true;
    }

    /*!
     *  \fn Deconnexion()
     *  \author Serres Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 09:29:10
     *  \brief fonction permettant de se déconnecter de la base de données
    */

    function Deconnexion(){
        global $bdd;
        if($bdd == NULL){
            throw new mysqli_sql_exception("Attention, la BDD n'est pas connectée!");
        }
        mysqli_close($bdd);
        return true;
    }

    /*!
     *  \fn bddConnecter()
     *  \author Serres Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 09:31:48
     *  \brief fonction permettant de vérifier que la base de données est bien connectée
    */
    function bddConnecter(){
        global $bdd;

        return($bdd != NULL);
    }

    /*!
     *  \fn function getUserById($id)
     *  \author Serres Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 09:23:01
     *  \brief fonction permettant de récupérer l'utilisateur dasn la base de données via son ID
     *  \param $id numéro correspondant à un utilisateur
    */
    function getUserById($id){
        global $bdd;

        if($bdd == NULL){
            throw new Exception("La Base de Données n'est pas connectée");
        }
        $req = "SELECT * FROM User WHERE idUser =".$id;
        $result = mysqli_query($bdd, $req);
        if(!$result){
            throw new Exception("La requête a échouée");
        }

        $user = array();
        while($row = mysqli_fetch_array($result)){
            $user[] = $row;
        }
        return $user;
    }

?>