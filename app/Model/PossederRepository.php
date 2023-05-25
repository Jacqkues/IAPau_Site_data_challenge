<?php

namespace Model;
use Lib\DatabaseConnection;
use Model\Association\Posseder;
use Exception;

class PossederRepository{
    //point d'accés à la base de données
    protected DatabaseConnection $database;
    

    public function __construct(DatabaseConnection $database) {
        //construit un objet de type DatabaseConnection
        $this->database = $database;
    }


    /*!
     *  \fn getPossederByProjet(int $idProjet)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateThu 25 2023 - 09:11:42
     *  \brief fonction permettant de récupérer les id des ressources possédées par un projet
     *  \param $idProjet int représentant l'id du projet dotn on souhaite récupérer l'id des ressources
     *  \return un tableau d'objet Posseder contenant les id d'un projet et de une ou plusieurs ressources possédées par ce projet 
    */
    public function getPossederByProjet(int $idProjet) : array{
        //requête sql
        $req = "SELECT * FROM Posseder WHERE idProjet= :idP";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idP' => $idProjet]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de récupération des id des ressources que possède un Projet a échouée.");
        }
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Posseder
        $possederAr = [];
        foreach ($rows as $row) {
            $posseder = new Posseder();
            $posseder->setIdProjet($row['idProjet']);
            $posseder->setIdRessource($row['idRessource']);
            $possederAr[] = $posseder;
        }
        return $possederAr;
    }

    /*!
     *  \fn getPossederByRessource(int $idRessource)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateThu 25 2023 - 09:21:15
     *  \brief fonction permettant de récupérer les id des Projet qui possèdent une ressource
     *  \param $idRessource int correspondant à l'id de la ressource dont on veut connaitre ses projets
     *  \return un tableau d'objet Posseder possédant les id des projets qui contiennent l'id de la ressource que l'on souhaite
    */
    public function getPossederByRessource(int $idRessource) : array{
        //requête sql
        $req = "SELECT * FROM Posseder WHERE idRessource= :idR";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idR' => $idRessource]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de récupération des id des idProjet possédant l'id d'une ressource a échouée.");
        }
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Posseder
        $possederAr = [];
        foreach ($rows as $row) {
            $posseder = new Posseder();
            $posseder->setIdProjet($row['idProjet']);
            $posseder->setIdRessource($row['idRessource']);
            $possederAr[] = $posseder;
        }
        return $possederAr;
    }



    /*!
     *  \fn addPosseder(int $idProjet, int $idRessource)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateThu 25 2023 - 09:44:55
     *  \brief fonction permettant de lier une ressource à un Projet
     *  \param $idProjet int correspondant à l'id du projet où l'on souhaite rajouter des ressources
     *  \param $idRessource int correspondant à l'id de la ressource que l'on souhaite rajouter
     *  \return true si tout c'est bien passé 
    */
    public function addPosseder(int $idProjet, int $idRessource) : bool{
            //requête d'insertion dans la bdd d'une liaison Posseder
            $req = "INSERT INTO Posseder VALUES ( :idP, :idR)";
            //préparation de la requête
            $statement = $this->database->getConnection()->prepare($req);
            //exécution de la requête
            $statement->execute(['idP' => $idProjet, 'idR' => $idRessource]);
            //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
            if($statement->rowCount() === 0){
                throw new Exception("La requête d'ajout d'une liaison 'Posseder' a échouée.");
            }
            return true;
       }


    /*!
     *  \fn getallPosseder()
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateThu 25 2023 - 09:55:00
     *  \brief fonction permettant de récupérer toutes les liaisons Posseder
     *  \return retourne un tableau d'objet Posseder contenant toutes les liaisons entre les data Projets et les Ressources
    */
    public function getAllPosseder():array {
        //requête SQL
        $sql = "SELECT * FROM Posseder";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute();
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Posseder
        $possederAr = [];
        foreach ($rows as $row) {
            $posseder = new Posseder();
            $posseder->setIdProjet($row['idProjet']);
            $posseder->setIdRessource($row['idRessource']);
            $possederAr[] = $posseder;
        }
        return $possederAr;
    }

    /*!
     *  \fn deletePosseder(int $idProjet, int $idRessource)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateThu 25 2023 - 10:04:16
     *  \brief fonction permettant de supprimer une liaison entre un projet et une ressource
     *  \param $idProjet int représentant l'id du projet dont on souhaite supprimer une ressource
     *  \param $idRessource int représentant l'id d'une ressource dont on souhaite retirer d'un projet
     *  \return true si tout se passe bien 
    */
    public function deletePosseder(int $idProjet, int $idRessource) :bool{
        //requête de suppression d'une liaison Posséder
        $req = "DELETE FROM Posseder WHERE idProjet = :idP AND idRessource = :idR";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idP' => $idProjet, 'idR' => $idRessource]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de suppression d'une liaison Posseder entre un projet et une ressource a échouée.");
        }   
        return true;
    }

}