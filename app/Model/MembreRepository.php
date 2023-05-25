<?php

namespace Model;
use Lib\DatabaseConnection;
use Model\Association\Membre;
use Exception;

class MembreRepository{
    //point d'accés à la base de données
    protected DatabaseConnection $database;
    

    public function __construct(DatabaseConnection $database) {
        //construit un objet de type DatabaseConnection
        $this->database = $database;
    }


    /*!
     *  \fn getMembreByTeam(int $idEquipe)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateWed 24 2023 - 14:07:49
     *  \brief fonction permettant de récupérer la liaison entre une equipe et ses membres
     *  \param $idEquipe int correspondant au numéro de l'équipe dont on souhaite connaître les membres
     *  \return retourne un tableau d'objet Membre contenant toutes les liaisons entre une équipe et des utilisateurs
    */
    public function getMembreByTeam(int $idEquipe) : array{
        //requête sql
        $req = "SELECT * FROM Membre WHERE idEquipe= :idE";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idE' => $idEquipe]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de récupération de la liaison Membre a échouée.");
        }
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Membre
        $membreAr = [];
        foreach ($rows as $row) {
            $membre = new Membre();
            $membre->setIdEquipe($row['idEquipe']);
            $membre->setIdUser($row['idUser']);
            $membreAr[] = $membre;
        }
        return $membreAr;
    }


    /*!
     *  \fn addMembre(int $idEquipe, int $idUser)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateWed 24 2023 - 14:27:48
     *  \brief fonction permettant d'ajouter un membre dans une équipe tant que l'équipe a moins de 8 membres
     *  \param $idEquipe int correspondant à l'id de l'équipe où l'on souhaite rajouter des membres
     *  \param $idUser int correspondant à l'id de l'utilisateur que l'on souahite rajouter dans une équipe
     *  \return true si l'équipe possède un nombre valide de membre sinon elle retourne false
    */      
    public function addMembre(int $idEquipe, int $idUser) : bool{
        $reqType = "SELECT types FROM User WHERE idUser = :idU";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($reqType);
        //exécution de la requête
        $statement->execute(['idU' => $idUser]);

        $types = $statement->fetch();
        //requête permettant de vérifier si l'on ne dépasse pas la taille maximale d'un équipe
        $compte = "SELECT COUNT(*) FROM Membre WHERE idEquipe = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($compte);
        //exécution de la requête
        $statement->execute(['id' => $idEquipe]);
        $verif = $statement->fetchAll();
        if (count($verif) > 7){
            throw new Exception("Taille maximale de l'équipe atteinte");
        }elseif($types != 'user'){
            throw new Exception("L'utilisateur doit être un étudiant pour pouvoir rejoindre une équipe");
        }
        else{
            //requête d'insertion dans la bdd d'un membre dnas une équipe
            $req = "INSERT INTO Membre VALUES ( :idE, :idU)";
            //préparation de la requête
            $statement = $this->database->getConnection()->prepare($req);
            //exécution de la requête
            $statement->execute(['idE' => $idEquipe, 'idU' => $idUser]);
            //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
            if($statement->rowCount() === 0){
                throw new Exception("La requête d'ajout d'un membre a échouée.");
            }
        }
        //Si l'équipe possède moins de 3 membres on retourne false sinon on retourne true
        if(count($verif) <3){
            return false;
        }else{
            return true;
        }
    }


    /*!
     *  \fn getMembreByUser(int $idUser)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateWed 24 2023 - 15:05:30
     *  \brief fonction permettant de récupérer les équipes qui accueillent un utilisateur
     *  \param $idUser int qui correspond à l'id d'un étudiant où l'on souhaite récupérer toutes les équipes où il appartient
     *  \return retourne un tableau d'objet Membre contenant l'id des équipes qui acueillent l'id de notre utilisateur 
    */
    public function getMembreByUser(int $idUser) : array{
        //requête permettant de récupérer les équipes accueillant notre utilisateur
        $req = "SELECT * FROM Membre WHERE idUser = :idU";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idU' => $idUser]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête pour récupérer les équipes qui accueillent l'utilisateur a échouée.");
        }   
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Membre
        $membreAr = [];
        foreach ($rows as $row) {
            $membre = new Membre();
            $membre->setIdEquipe($row['idEquipe']);
            $membre->setIdUser($row['idUser']);
            $membreAr[] = $membre;
        }
        return $membreAr;
        
    }


    /*!
     *  \fn getAllMembre()
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateWed 24 2023 - 15:09:15
     *  \brief fonction permettant de récupérer toutes les liaisons entre les utilisateurs et les équipes
     *  \return retourne un tableau d'objets Membre contenant chaque liaison entre les équipes et les étudiants 
    */
    public function getAllMembre():array {
        //requête SQL
        $sql = "SELECT * FROM Membre";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute();
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Membre
        $membreAr = [];
        foreach ($rows as $row) {
            $membre = new Membre();
            $membre->setIdEquipe($row['idEquipe']);
            $membre->setIdUser($row['idUser']);
            $membreAr[] = $membre;
        }
        return $membreAr;
    }

    /*!
     *  \fn deleteMembre(int $idEuqipe, int $idUser)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateWed 24 2023 - 15:14:44
     *  \brief fonction permettant de supprimer un membre d'une équipe
     *  \param $idEquipe int correspondant à l'id d'une équipe dont on souhaite supprimer un membre
     *  \param $idUser int correspondant à l'id du membre qui doit être supprimé de l'équipe
     *  \return true si tout c'est bien passé
    */
    public function deleteMembre(int $idEquipe, int $idUser) :bool{
        //requête de suppression d'un Membre
        $req = "DELETE FROM Membre WHERE idEquipe = :idE AND idUser = :idU";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idE' => $idEquipe, 'idU' => $idUser]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de suppression d'un membre d'une équipe a échouée.");
        }   
        return true;
    }

    /*!
     *  \fn deleteMembreByIdUser(int $idUser)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateWed 24 2023 - 15:38:41
     *  \brief fonction permettant de supprimer un mebre de toutes ses équipes
     *  \param $idUser int correspondant à l'étudiant que l'on souhaite supprimer de toutes ses équipes
     *  \return true si tout se passe bien 
    */
    public function deleteMembreByIdUser(int $idUser):bool{
        //requête de suppression d'un Membre
        $req = "DELETE FROM Membre WHERE idUser = :idU";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idU' => $idUser]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête pour supprimer un mebre de toues ses équipes a échouée.");
        }   
        return true;
    }

}