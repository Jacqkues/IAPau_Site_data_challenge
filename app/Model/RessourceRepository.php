<?php

namespace Model;
use Lib\DatabaseConnection;
use Model\Entites\Ressources;
use Exception;

class RenduRepository{
    //point d'accés à la base de données
    protected DatabaseConnection $database;
    

    public function __construct(DatabaseConnection $database) {
        //construit un objet de type DatabaseConnection
        $this->database = $database;
    }


    /*!
     *  \fn getRessources(int $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 16:03:56
     *  \brief fonction permettant de récupérer les informations d'un ressouces via son id
     *  \param $id int correspondant à l'id de la ressource que l'on souhaite récupérer
     *  \return un objet de type Ressources 
    */
    public function getRessources(int $id) : Ressources{
        //requête sql
        $req = "SELECT * FROM Ressources WHERE idRessources= :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idRessources' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de récupération des ressources a échouée.");
        }
        //récupération des informations
        $row = $statement->fetch();
        //création d'un objet Equipe
        $ressource = new Ressources();
        $ressource->setLien($row['lien']);
        $ressource->setId($row['idRessources']);
        $ressource->setNom($row['nom']);
        $ressource->setTypes($row['types']);
        return $ressource;
    }


    /*!
     *  \fn addRessources(string $nom,string $lien, string $type)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 16:07:33
     *  \brief fonction permettant de rajouter une ressource
     *  \param $nom string correspondant au nom de la ressource
     *  \param $lien string correspondant au lien menant à la ressource
     *  \param $type string correspondant au type de ressource (image, texte...)
     *  \return true si tout c'est bien passé 
    */
    public function addRessources(string $nom, string $lien, string $type) : bool{
        //requête d'insertion dans la bdd d'une nouvelle ressource
        $req = "INSERT INTO Ressources (nom,types,lien) VALUES ( :nom, :types, :lien)";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['nom' => $nom,'types' => $type ,'lien' => $lien]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête d'ajout d'une ressource a échouée.");
        }   
        return true;
    }


    /*!
     *  \fn getRenduByLink(string $lien)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 16:11:03
     *  \brief fonction permettant de récupérer une ressource grâce à son lien
     *  \param $lien string correspondant au lien pour accéder à une ressource
     *  \return un objet de type ressource contenant les informations de la ressource souhaitée 
    */
    public function getRenduByLink(string $lien) : Ressources{
        //requête permettant de choisir un ressource en fonction de l'id de l'équipe
        $req = "SELECT * FROM Ressources WHERE lien = :lien";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['lien' => $lien]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête pour récupérer un ressource via son lien a échouée.");
        }   
        //récupération des informations
        $row = $statement->fetch();
        //création d'un objet Equipe
        $ressource = new Ressources();
        $ressource->setLien($row['lien']);
        $ressource->setId($row['idRessources']);
        $ressource->setNom($row['nom']);
        $ressource->setTypes($row['types']);
        return $ressource;
        
    }


    /*!
     *  \fn getAllRessources()
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 16:13:27
     *  \brief fonction permettant de récupérer toutes les ressources contenues dans la bdd
     *  \return un tableau de type Ressources
    */
    public function getAllRessources():array {
        //requête SQL
        $sql = "SELECT * FROM Ressources";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute();
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Rendu
        $ressources = [];
        foreach ($rows as $row) {
            $ressource = new Ressources();
            $ressource->setLien($row['lien']);
            $ressource->setId($row['idRessources']);
            $ressource->setNom($row['nom']);
            $ressource->setTypes($row['types']);
            $ressources[] = $ressource;
        }
        return $ressources;
    }

    /*!
     *  \fn deleteRessource(int $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 17:21:49
     *  \brief fonction permettant de supprimer une ressource via son id
     *  \param $id int correspondant à l'id de la ressource que l'on souhaie supprimer
     *  \return true si tout c'est bien passé 
    */
    public function deleteRessource(int $id) :bool{
        //requête de suppression d'une ressource
        $req = "DELETE FROM Ressources WHERE idRessources = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de suppression d'une ressource a échouée.");
        }   
        return true;
    }


}