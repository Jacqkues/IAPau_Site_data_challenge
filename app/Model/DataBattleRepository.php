<?php


namespace Model;
use Lib\DatabaseConnection;
use Model\Entites\dataBattle;
use Exception;

class DataBattleRepository{
    //point d'accés à la base de données
    protected DatabaseConnection $database;
    

    public function __construct(DatabaseConnection $database) {
        //construit un objet de type DatabaseConnection
        $this->database = $database;
    }



    /*!
     *  \fn function getDataBattle(int $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 15:31:36
     *  \brief fonction permettant de récupérer les informations d'un data Battle
     *  \param $id int qui représente l'id d'un data Battle
     *  \return les informations d'un data Battle
    */
    public function getDataBattle($id){
        //requête sql
        $req = "SELECT * FROM dataBattle WHERE idBattle= :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de récupération du data Battle a échouée.");
        }
        //récupération des informations
        $row = $statement->fetch();
        //création d'un objet Equipe
        $battle = new dataBattle();
        $battle->setIdBattle($row['idBattle']);
        $battle->setDebut($row['debut']);
        $battle->setFin($row['fin']);
        return $battle;
    }


    /*!
     *  \fn function addBattle(string $debut, string $fin)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 09:15:18
     *  \brief fonction permettant de rajouter une équipe
     *  \param $debut string correspodnant à la date de début 
     *  \param $fin string correspondant ) la date de fin
     *  \return true si tout se passe bien
    */
    public function addBattle(string $debut, string $fin){
        //requête d'insertion dans la bdd d'un nouveau data Battle
        $req = "INSERT INTO dataBattle (debut,fin) VALUES ( :debut, :fin)";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['debut' => $debut, 'fin' => $fin]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête d'ajout dun data Challenge a échouée.");
        }   
        return true;
    }
    

    /*!
     *  \fn function getAllBattles()
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 14:13:43
     *  \brief fonction permettant de récupérer toutes les data Battle
     *  \return un tableau contenant toutes les data battles
    */
    public function getAllBattles():array {
        //requête SQL
        $sql = "SELECT * FROM dataBattle";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute();
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets User
        $battles = [];
        foreach ($rows as $row) {
            $battle = new dataBattle();
            $battle->setIdBattle($row['idBattle']);
            $battle->setDebut($row['debut']);
            $battle->setFin($row['fin']);   
            $battles[] = $battle;
        }
        return $battles;
    }

    /*!
     *  \fn deleteBattle(int $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 17:36:54
     *  \brief fonction permettant de supprimer une data Battle via son id
     *  \param $id int correspondant à l'id de la data Battle que l'on souhaite supprimer
     *  \return retourne true si tout c'est bien passé 
    */
    public function deleteBattle(int $id){
        //requête de suppression d'un data Battle
        $req = "DELETE FROM dataBattle WHERE idBattle = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de suppression d'une battle a échouée.");
        }   
        return true;
    }
}