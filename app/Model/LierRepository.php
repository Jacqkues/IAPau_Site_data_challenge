<?php

namespace Model;
use Lib\DatabaseConnection;
use Model\Association\Lier;
use Exception;
use Model\Entites\User;

class LierRepository extends UserRepository{
    //point d'accés à la base de données
    protected DatabaseConnection $database;
    

    public function __construct(DatabaseConnection $database) {
        //construit un objet de type DatabaseConnection
        $this->database = $database;
    }


    /*!
     *  \fn getLierByProjet(int $idProjet)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateThu 25 2023 - 10:31:47
     *  \brief fonction permettant de récupérer les liaisons 'lier' d'un projet
     *  \param $idProjet int correspondant à l'id d'un projet dont on souhaite récupérer les id de ses contacts
     *  \return un tableau d'objet Lier contenant l'id d'un projet et les id de ses contacts
    */
    public function getLierByProjet(int $idProjet) : array{
        //requête sql
        $req = "SELECT * FROM Lier WHERE idProjet= :idP";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idP' => $idProjet]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de récupération des id des user liés à un Projet a échouée.");
        }
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Lier
        $possederAr = [];
        foreach ($rows as $row) {
            $posseder = new Lier();
            $posseder->setIdProjet($row['idProjet']);
            $posseder->setIdUser($row['idUser']);
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
    public function getLierByContact(int $idContact) : array{
        //requête sql
        $req = "SELECT * FROM Lier WHERE idUser= :idC";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idC' => $idContact]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de récupération des id des Projet liés à l'id d'un user a échouée.");
        }
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Lier
        $possederAr = [];
        foreach ($rows as $row) {
            $posseder = new Lier();
            $posseder->setIdProjet($row['idProjet']);
            $posseder->setIdUser($row['idUser']);
            $possederAr[] = $posseder;
        }
        return $possederAr;
    }



    /*!
     *  \fn addLier(int $idProjet, int $idUser)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateThu 25 2023 - 10:48:17
     *  \brief fonction permettant de lier un gestionnaire à un projet
     *  \param $idProjet int correspondant à l'id du projet dont on souhaite rajouter un gestionnaire (contact)
     *  \param $idUser int correspondant au gestionnaire que l'on souhaite rajouter  à un projet
     *  \return retourne true si tout se passe bie net si l'utilisateur est bien un gestionnaire sinon on retourne false
    */
    public function addLier(int $idProjet, int $idUser) : bool{
            //On créer une nouvelle variable utilisateur
            $recUser = new User();
            //On récupère les données de l'utilisateur qui correspond à l'id en paramètre
            $recUser = $this->getUser($idUser);
            //On vérifie que l'utilisateur est bel et bien un gestionnaire
            if($recUser->getType() === 'gestionnaire'){
                //requête d'insertion dans la bdd d'une liaison Lier
                $req = "INSERT INTO Lier VALUES ( :idP, :idU)";
                //préparation de la requête
                $statement = $this->database->getConnection()->prepare($req);
                //exécution de la requête
                $statement->execute(['idP' => $idProjet, 'idU' => $idUser]);
                //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
                if($statement->rowCount() === 0){
                    throw new Exception("La requête d'ajout d'une liaison 'Lier' a échouée.");
                }
                return true;
            }else{
                return false;
            }
       }


    /*!
     *  \fn getAllLier()
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateThu 25 2023 - 10:52:25
     *  \brief fonction permettant de récupérer toutes les liaisons entre les porjets et les gestionnaires 
     *  \return un tableau d'objet Lier contenant toutes les associations Lier
    */
    public function getAllLier():array {
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
            $posseder = new Lier();
            $posseder->setIdProjet($row['idProjet']);
            $posseder->setIdUser($row['idUser']);
            $possederAr[] = $posseder;
        }
        return $possederAr;
    }

    /*!
     *  \fn deleteLier(int $idProjet, int $idUser)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateThu 25 2023 - 10:58:02
     *  \brief fonction permettant de supprimer une liaison Lier
     *  \param $idProjet int correspondant à l'id du projet dont on souhaite délier un gestionnaire
     *  \param $idUser int correspondant à l'id du gestionnaire dont on souhaite délier un projet
     *  \return true si tout c'est bien passé
    */
    public function deleteLier(int $idProjet, int $idUser) :bool{
        //requête de suppression d'une liaison Lier
        $req = "DELETE FROM Lier WHERE dProjet = :idP AND idUser = :idU";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idP' => $idProjet, 'idU' => $idUser]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de suppression d'une liaison Lier entre un projet et un gestionnaire a échouée.");
        }   
        return true;
    }

}