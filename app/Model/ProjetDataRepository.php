<?php

namespace Model;
use Lib\DatabaseConnection;
use Model\Entites\projetData;
use Exception;

class ProjetDataRepository extends LierRepository{
    //point d'accés à la base de données
    protected DatabaseConnection $database;
    

    public function __construct(DatabaseConnection $database) {
        //construit un objet de type DatabaseConnection
        $this->database = $database;
    }


    /*!
     *  \fn getProjetData(int $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 11:02:02
     *  \brief fonction permettant de récupérer les informations d'un data projet
     *  \param $id int représentant l'id du Projet
     *  \return retourne les informations du projet 
    */
    public function getProjetData(int $id){
        //requête sql
        $req = "SELECT * FROM projetData WHERE idProjet= :id";
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
        $projet = new projetData();
        $projet->setIdProjet($row['idProjet']);
        $projet->setLibelle($row['libelleData']);
        $projet->setDescription($row['descrip']);
        $projet->setLienImg($row['lienImg']);
        $projet->setIdDataChallenge($row['idChallenge']);
        return $projet;
    }


    /*!
     *  \fn function addProjet(int $idChallenge, string $descrip, string $lienImg, string $libelle)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 11:07:31
     *  \brief fonction permettant d'ajouter un projet
     *  \param $idChallenge int correspondant à l'id d'un data challenge
     *  \param $descrip string correspondant à la description du Projet
     *  \param $lienImg string représentant le lien de l'image permettant d'illuster le projet
     *  \param $libelle string correspondant au libelle du Projet
    */
    public function addProjet(projetData $projet) : bool{
        //requête d'insertion dans la bdd d'un nouveau data Projet
        $req = "INSERT INTO projetData (idChallenge,descrip,lienImg,libelleData) VALUES ( :idChallenge, :descrip, :lienImg, :libelle)";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idChallenge' => $projet->getIdDataChallenge() , 'descrip' => $projet->getDescription(), 'lienImg' => $projet->getLienImg(), 'libelle' => $projet->getLibelle()]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête d'ajout d'équipe a échouée.");
        }   
        return true;
    }


    /*!
     *  \fn function changeDescripP(string $descrip, int $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 12:59:32
     *  \brief fonction permettant de modifier la description d'un projet
     *  \param $descrip string correspondant à la nouvelle description
     *  \param $id int représentant l'id du projet à modifier
     *  \return true si tout se passe bien
    */
    public function changeDescripP(string $descrip, int $id) : bool{
        //requête permettant de modifier la description d'un projet
        $req = "UPDATE projetData SET descrip = :descrip WHERE idProjet = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['descrip' => $descrip, 'id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête d'ajout d'équipe a échouée.");
        }   
        return true;
    }


    /*!
     *  \fn functiongetAllProject()
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 13:24:06
     *  \brief fonction permettant de récupérer tous les data projets dans un tableau
     *  \return un tableau contenant tous les data projets
    */
    public function getAllProject():array {
        //requête SQL
        $sql = "SELECT * FROM projetData";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute();
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets User
        $projets = [];
        foreach ($rows as $row) {
            $projet = new projetData();
            $projet->setIdProjet($row['idProjet']);
            $projet->setLibelle($row['libelle']);
            $projet->setDescription($row['description']);
            $projet->setLienImg($row['lienImg']);
            $projet->setIdDataChallenge($row['idDataChallenge']);   
            $projets[] = $projet;
        }
        return $projets;
    }

    public function deleteProjet(int $id){
        //requête SQL
        $sql = "DELETE FROM projetData WHERE idProjet = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute(['id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de suppression du projet a échouée.");
        }   
        return true;
    }

    
    /*!
     *  \fn getProjetByRessource(int $idRessource)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateThu 25 2023 - 10:11:31
     *  \brief fonction permettant de récupérer tous les Projets liés à une Ressource
     *  \param $idRessource int correspondant à l'id de la Ressource dont on souhaite récupérer les projets dant lesquels elle est utilisées
     *  \return un tableau d'objet projetData récupérant tous les projets liés à une ressource
    */
    public function getProjetByRessource(int $idRessource) : array{
        //requête SQL
        $sql = "SELECT * FROM projetData WHERE idProjet IN (SELECT idProjet FROM Posseder WHERE idRessources = :idR";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute(['idR' => $idRessource]);
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets User
        $projets = [];
        foreach ($rows as $row) {
            $projet = new projetData();
            $projet->setIdProjet($row['idProjet']);
            $projet->setLibelle($row['libelle']);
            $projet->setDescription($row['description']);
            $projet->setLienImg($row['lienImg']);
            $projet->setIdDataChallenge($row['idDataChallenge']);   
            $projets[] = $projet;
        }
        return $projets;
    }


    /*!
     *  \fn getProjetByGest(int idUse)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateThu 25 2023 - 18:24:29
     *  \brief fonction permettant de récupérer les projets liés à un gestionnaire
     *  \param $idUser int correspondant à l'id d'un gestionnaire dont on souhaite récupérer les projets qu'il gère
     *  \return un tableau d'objet projetData contenant les projets liés à un contact
    */
    public function getProjetByGest(int $idUser) : array{
        try{
            //On récupère les id des utilisateurs liés à l'id d'un projet
            $recContact = $this->getLierByContact($idUser);
            //Si Mon tableau est vide c'est qu'il n'y a pas de contact lié au projet
            if(empty($recContact)){
                throw new Exception("Le tableau d'utilisateur est vide");
            }
            $contacts = implode(',',array_fill(0, count($recContact), '?'));
            $req = "SELECT * FROM User WHERE idUser IN ($contacts)";
            //préparation de la requête
            $statement = $this->database->getConnection()->prepare($req);
            //exécution de la requête
            $statement->execute($recContact);
            //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
            if($statement->rowCount() === 0){
                throw new Exception("La requête pour récupérer les id des contactes liés à un projet a échouée.");
            }
            $rows = $statement->fetchAll();
            //création d'un tableau d'objets projetData
            $projets = [];
            foreach ($rows as $row) {
                $projet = new projetData();
                $projet->setIdProjet($row['idProjet']);
                $projet->setLibelle($row['libelle']);
                $projet->setDescription($row['description']);
                $projet->setLienImg($row['lienImg']);
                $projet->setIdDataChallenge($row['idDataChallenge']);   
                $projets[] = $projet;
            }
        } catch (Exception $e){
            throw new Exception("Erreur lors de la récupération des projet liés à un gestionnaire : " . $e->getMessage());
        }
        return $projets;
    }

}