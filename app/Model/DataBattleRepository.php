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
        $battle->setLibelleBattle($row['libelleBattle']);
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
    public function addBattle(string $debut, string $fin, string $libelle){
        //requête d'insertion dans la bdd d'un nouveau data Battle
        $req = "INSERT INTO dataBattle (libelleBattle,debut,fin) VALUES ( :libB, :debut, :fin)";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['libB'=> $libelle,'debut' => $debut, 'fin' => $fin]);
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
            $battle->setLibelleBattle($row['libelleBattle']); 
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
    public function deleteBattle(int $id): bool{
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

    public function updateDebBattle(int $id, string $debut):bool{
        //requête de modification
        $req = "UPDATE dataBattle SET debut = :deb WHERE idBattle = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(["deb" => $debut, 'id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement == NULL){
            throw new Exception("La requête de modication de la date de début d'une battle a échouée.");
        }
        return true;
    }

    public function updateFinBattle(int $id, string $fin):bool{
        //requête de modification
        $req = "UPDATE dataBattle SET fin = :fin WHERE idBattle = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(["fin" => $fin, 'id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement == NULL){
            throw new Exception("La requête de modication de la date de fin d'une battle a échouée.");
        }
        return true;
    }

    public function updateLibelleBattle(int $id, string $libelle):bool{
        //requête de modification
        $req = "UPDATE dataBattle SET libelleBattle = :lib WHERE idBattle = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(["lib" => $libelle, 'id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement == NULL){
            throw new Exception("La requête de modication du libelle d'une battle a échouée.");
        }
        return true;
    }
}