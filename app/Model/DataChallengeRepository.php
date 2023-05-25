<?php

namespace Model;
use Lib\DatabaseConnection;
use Model\Entites\dataChallenge;
use Model\Entites\projetData;
use Exception;

class DataChallengeRepository{
    //point d'accés à la base de données
    protected DatabaseConnection $database;
    

    public function __construct(DatabaseConnection $database) {
        //construit un objet de type DatabaseConnection
        $this->database = $database;
    }


    /*!
     *  \fn function getDataChallenge(string $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 10:03:56
     *  \brief fonction permettant de récupérer les inforations d'un data Challenge
     *  \param $id int représentant l'id d'un data challenge
     *  \return les informations d'un data Challenge
    */
    public function getDataChallenge(int $id){
        //requête sql
        $req = "SELECT * FROM dataChallenge WHERE idChallenge= :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de récupération du data Challenge a échouée.");
        }
        //récupération des informations
        $row = $statement->fetch();
        //création d'un objet Equipe
        $challenge = new dataChallenge();
        $challenge->setIdChallenge($row['idChallenge']);
        $challenge->setLibelle($row['libelle']);
        $challenge->setTempsDebut($row['tempsDebut']);
        $challenge->setTempsFin($row['tempsFin']);
        return $challenge;
    }


    /*!
     *  \fn function addChallenge(string $debut, string $fin)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 10:11:51
     *  \brief fonction permettant de rajouter une équipe
     *  \param $libelle string correspondant au libellé de data Challenge
     *  \param $debut string correspodnant à la date de début 
     *  \param $fin string correspondant ) la date de fin
     *  \return true si tout se passe bien
    */
    public function addChallenge(dataChallenge $challenge){
        //requête d'insertion dans la bdd d'un nouveau data Challenge
        $req = "INSERT INTO dataChallenge (libelle,tempsDebut,tempsFin) VALUES ( :libelle, :debut, :fin)";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['libelle' => $challenge->getLibelle(), 'debut' => $challenge->getTempsDebut(), 'fin' => $challenge->getTempsFin()]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement == NULL){
            throw new Exception("La requête d'ajout de data Challenge a échouée.");
        }   
        return true;
    }

    /*!
     *  \fn getAllChallenges()
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 14:02:42
     *  \brief fonction permettant de récupérer tous les challenges
     *  \return un tableau contenant tous les challenges
    */
    public function getAllChallenges():array {
        //requête SQL
        $sql = "SELECT * FROM dataChallenge";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute();
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets User
        $challenges = [];
        foreach ($rows as $row) {
            $challenge = new dataChallenge();
            $challenge->setIdChallenge($row['idChallenge']);
            $challenge->setLibelle($row['libelle']);
            $challenge->setTempsDebut($row['tempsDebut']);
            $challenge->setTempsFin($row['tempsFin']);   
            $challenges[] = $challenge;
        }
        return $challenges;
    }

    /*!
     *  \fn deleteChallenge(int $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 17:33:20
     *  \brief fonction permettant de supprimer un challenge via son id
     *  \param $id int qui correspond à l'id du challenge que l'on souhaite supprimer
     *  \return tretourne rue si tout c'est bien passé
    */
    public function deleteChallenge(int $id){
        //requête de suppression d'un data Challenge
        $req = "DELETE FROM dataChallenge WHERE idChallenge = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de suppression d'un challenge a échouée.");
        }   
        return true;
    }

    public function getProjets(int $id){
        //requête sql
        $req = "SELECT * FROM projetData WHERE idChallenge= :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("Aucun projet pour ce datachallenge");
        }
        //récupération des informations
        $rows = $statement->fetchAll();
        //création d'un objet Equipe
        $projets = [];
        foreach ($rows as $row) {
            $projet = new projetData();
            $projet->setIdProjet($row['idProjet']);
            $projet->setLibelle($row['libelleData']);
            $projet->setDescription($row['descrip']);
            $projet->setIdDataChallenge($row['idChallenge']);
            $projet->setLienImg($row['lienImg']);
            $projets[] = $projet;
        }
        return $projets;
    }

    /*!
     *  \fn getchallengeByRessources(int $idRessource)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateWed 24 2023 - 13:39:07
     *  \brief fonction permettant de récupérer les data Challenge lié à une Ressource
     *  \param $idRessource int correspondant à l'id de la ressource qui permet de récupérer les data challenge
     *  \return un tableau d'objet dataChallenge correspondant aux challenges liés à la ressource
    */
    public function getChallengeByRessources(int $idRessource) : array{
        //requête SQL
        $sql = "SELECT * FROM dataChallenge WHERE idChallenge IN (SELECT idChallenge FROM Detenir WHERE idRessources = :idR";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute(['idR' => $idRessource]);
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets dataChallenge
        $challenges = [];
        foreach ($rows as $row) {
            $challenge = new dataChallenge();
            $challenge->setIdChallenge($row['idChallenge']);
            $challenge->setLibelle($row['libelle']);
            $challenge->setTempsDebut($row['tempsDebut']);
            $challenge->setTempsFin($row['tempsFin']);   
            $challenges[] = $challenge;
        }
        return $challenges;
    }

}