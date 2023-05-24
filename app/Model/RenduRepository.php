<?php

namespace Model;
use Lib\DatabaseConnection;
use Model\Entites\Rendu;
use Exception;

class RenduRepository{
    //point d'accés à la base de données
    protected DatabaseConnection $database;
    

    public function __construct(DatabaseConnection $database) {
        //construit un objet de type DatabaseConnection
        $this->database = $database;
    }


    /*!
     *  \fn getRendu(string $lien)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 15:37:19
     *  \brief fonction permettant de récupérer les informations d'un rendu via son lien
     *  \param $lien string correspondant au lien menant au rendu
     *  \return un objet de type Rendu
    */
    public function getRendu(string $lien) : Rendu{
        //requête sql
        $req = "SELECT * FROM Rendu WHERE lien= :lien";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['lien' => $lien]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement == NULL){
            throw new Exception("La requête de récupération du Rendu a échouée.");
        }
        //récupération des informations
        $row = $statement->fetch();
        //création d'un objet Equipe
        $rendu = new Rendu();
        $rendu->setLien($row['lien']);
        $rendu->setDateRendu($row['dateRendu']);
        $rendu->setIdEquipe($row['idEquipe']);
        return $rendu;
    }


    /*!
     *  \fn addRendu(string $lien, string $dateRendu, int $idEquipe)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 15:46:09
     *  \brief fonction permettant de rajouter un rendu
     *  \param $lien string correspondant au lien amenant au rendu de l'équipe
     *  \param $dateRendu string correspondant à la date au le rendu est remis
     *  \param $idEquipe int correspondant à l'id de l'équipe possédant le rendu 
    */
    public function addRendu(string $lien, string $dateRendu, int $idEquipe) : bool{
        //requête d'insertion dans la bdd d'un nouveau rendu
        $req = "INSERT INTO Rendu VALUES ( :lien, :dateRendu, :numEquipe)";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['lien' => $lien, 'dateRendu' => $dateRendu, 'numEquipe' => $idEquipe]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement == NULL){
            throw new Exception("La requête d'ajout d'un rendu a échouée.");
        }   
        return true;
    }


    /*!
     *  \fn getRenduByTeam(int $idEquipe)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 15:51:59
     *  \brief focntion permettant de récupérer les info d'un rendu via l'id d'une équipe
     *  \param $idEquipe int correspondant à l'id de l'équipe possédant le rendu
     *  \return un objet de type Rendu 
    */
    public function getRenduByTeam(int $idEquipe) : Rendu{
        //requête permettant de choisir un rendu en fonction de l'id de l'équipe
        $req = "SELECT * FROM Rendu WHERE idEquipe = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $idEquipe]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement == NULL){
            throw new Exception("La requête pour récupérer un rendu via son équipe a échouée.");
        }   
        //récupération des informations
        $row = $statement->fetch();
        //création d'un objet Equipe
        $rendu = new Rendu();
        $rendu->setLien($row['lien']);
        $rendu->setDateRendu($row['dateRendu']);
        $rendu->setIdEquipe($row['idEquipe']);
        return $rendu;
        
    }


    /*!
     *  \fn getAllRendus()
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 15:54:54
     *  \brief fonction permettant de récupérer tous les rendus
     *  \return un tableau d'objet Rendu contenant tous les rendus de la BDD
    */
    public function getAllRendus():array {
        //requête SQL
        $sql = "SELECT * FROM Rendu";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute();
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Rendu
        $projets = [];
        foreach ($rows as $row) {
            $rendu = new Rendu();
            $rendu->setLien($row['lien']);
            $rendu->setDateRendu($row['dateRendu']);
            $rendu->setIdEquipe($row['idEquipe']);
            $projets[] = $rendu;
        }
        return $projets;
    }

    /*!
     *  \fn deleteRendu(string $lien)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 17:22:55
     *  \brief fonction permettant de supprimer un rendu via son lien
     *  \param $lien string correspondant au lien menant au Rendu que l'on souhaite supprimer
     *  \return retourne true si tout c'est bien passé 
    */
    public function deleteRendu(string $lien) :bool{
        //requête de supression d'un rendu
        $req = "DELETE FROM Rendus WHERE lien = :lien";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['lien' => $lien]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement == NULL){
            throw new Exception("La requête de suppression d'un rendu a échouée.");
        }   
        return true;
    }

}