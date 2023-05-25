<?php

namespace Model;
use Lib\DatabaseConnection;
use Model\Association\Detenir;
use Exception;

class DetenirRepository{
    //point d'accés à la base de données
    protected DatabaseConnection $database;
    

    public function __construct(DatabaseConnection $database) {
        //construit un objet de type DatabaseConnection
        $this->database = $database;
    }


    /*!
     *  \fn getDetenirByChallenge(int $idChal)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateWed 24 2023 - 10:37:08
     *  \brief fonction permettant de récupérer les liaison de Detenir via l'id d'un data Challenge
     *  \param $idChal int correpondant à l'id d'un data Challenge détenant des ressources
     *  \return retourne un objet Detenir contenant l'id du data challenge et les id de ses ressources 
    */
    public function getDetenirByChallenge(int $idChal) : array{
        //requête sql
        $req = "SELECT * FROM Detenir WHERE id= :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $idChal]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de récupération de la liaison 'Detenir' a échouée.");
        }
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Detenir
        $detenirAr = [];
        foreach ($rows as $row) {
            $detenir = new Detenir();
            $detenir->setIdData($row['idChallenge']);
            $detenir->setIdRessource($row['idRessources']);
            $detenirAr[] = $detenir;
        }
        return $detenirAr;
    }


    /*!
     *  \fn addDetenir(int $idChallenge, int $idRessources)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateWed 24 2023 - 10:43:44
     *  \brief fonction permettant de créer un liaison de type "Détenir" permettant de lier une ressource à un data Challenge
     *  \param $idChallenge int correspondant à l'id du data Challenge qui détient les ressources
     *  \param $idRessources int correspondant à l'id de la ressource à rajouter
     *  \return retourne true si tout se passe bien
    */      
    public function addDetenir(int $idChallenge, int $idRessources) : bool{
        //requête d'insertion dans la bdd d'une nouvelle liaison "Détenir"
        $req = "INSERT INTO Detenir VALUES ( :idChallenge, :idRessources)";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idChallenge' => $idChallenge, 'idRessources' => $idRessources]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête d'ajout d'un message a échouée.");
        }   
        return true;
    }


    /*!
     *  \fn getDetenirByRessource(int $idRessource)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateWed 24 2023 - 11:00:12
     *  \brief fonction permettant de récupérer les liaisons 'Détenir' d'une ressource pour voir à quel data Challenge elle est liée
     *  \param $idRessource int correspondant à l'id de la Ressource lié à un data challenge
     *  \return retourne un tableau d'objet Detenir contenant les liaisons entre un ressource et ses data challenge 
    */
    public function getDetenirByRessource(int $idRessource) : array{
        //requête permettant de récupérer les liaisons via une ressource
        $req = "SELECT * FROM Detenir WHERE idRessources = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $idRessource]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête pour récupérer la liaison 'Detenir' a échouée.");
        }   
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Detenir
        $detenirAr = [];
        foreach ($rows as $row) {
            $detenir = new Detenir();
            $detenir->setIdData($row['idChallenge']);
            $detenir->setIdRessource($row['idResosurces']);
            $detenirAr[] = $detenir;
        }
        return $detenirAr;
        
    }


    /*!
     *  \fn getAllDetenir()
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateWed 24 2023 - 11:07:48
     *  \brief fonction permettant de récupérer toutes les liaisons 'Detenir' correspondant aux liaisons entre les data Challenges et les Ressources
     *  \return un tableau d'objet Detenir contenant les liaisons entre les data Challenges et des ressources
    */
    public function getAllDetenir():array {
        //requête SQL
        $sql = "SELECT * FROM Detenir";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute();
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Detenir
        $detenirAr = [];
        foreach ($rows as $row) {
            $detenir = new Detenir();
            $detenir->setIdData($row['idData']);
            $detenir->setIdRessource($row['idRessources']);
            $detenirAr[] = $detenir;
        }
        return $detenirAr;
    }

    /*!
     *  \fn deleteDetenir(int $idChallenge, int $idRessource)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateWed 24 2023 - 13:17:20
     *  \brief fonction permettant de supprimer une liaison entre une ressource et un data Challenge
     *  \param $idChallenge int correspodnant à l'id du Challenge détenant des ressources
     *  \param $idRessource int correspondant à l'id de la Ressource que l'on souhaite délier du challenge
     *  \retrun true si tout c'est bien passé
    */
    public function deleteDetenir(int $idChallenge, int $idRessource) :bool{
        //requête de suppression d'une Liaison Detenir
        $req = "DELETE FROM Detenir WHERE idChallenge = :idC AND idRessources = :idR";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idC' => $idChallenge, 'idR' => $idRessource]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de suppression d'une liaison Detenir a échouée.");
        }   
        return true;
    }

}