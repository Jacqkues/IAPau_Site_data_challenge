<?php

namespace Model;
use Lib\DatabaseConnection;
use Model\Entites\Questionnaire;
use Exception;

class QuestionnaireRepository{
    //point d'accés à la base de données
    protected DatabaseConnection $database;
    

    public function __construct(DatabaseConnection $database) {
        //construit un objet de type DatabaseConnection
        $this->database = $database;
    }


    /*!
     *  \fn function getQuestionnaire($id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 14:23:18
     *  \brief fonction permettant de récupérer les informations d'un questionnaire à l'aide de so nid
     *  \param $id int représentant l'id d'un questionnaire
     *  \return un objet questionnaire contenant les infos du questionnaire correspondant à l'id
    */
    public function getQuestionnare(int $id): Questionnaire{
        //requête sql
        $req = "SELECT * FROM Questionnaire WHERE idQuestionnaire= :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de récupération du questionnaire a échouée.");
        }
        //récupération des informations
        $row = $statement->fetch();
        //création d'un objet questionnaire
        $questionnaire = new Questionnaire();
        $questionnaire->setId($row['id']);
        $questionnaire->setDebut($row['debut']);
        $questionnaire->setFin($row['fin']);
        $questionnaire->setLien($row['lien']);
        $questionnaire->setIdBattle($row['idBattle']);
        return $questionnaire;
    }


    /*!
     *  \fn addQuestionnaire()
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 14:29:29
     *  \brief fonction permettant d'insérer un nouveau questionnaire dnas la bdd
     *  \param $debut string correspondant à la date de début de questionnaire
     *  \param $fin string correspondant à la date de fin du questionnaire
     *  \param $lien string représentant le lien pour accéder au questionnaire
     *  \param $idBattle int correspondant à l'id du data Battle auquel appartient le questionnaire 
    */
    public function addQuestionnaire(string $debut, string $fin, string $lien, int $idBattle): bool{
        //requête d'insertion dans la bdd d'un nouveau data Challenge
        $req = "INSERT INTO Questionnaire (debut,fin,lien,idBattle) VALUES ( :debut, :fin, :lien, :idBattle)";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['debut' => $debut, 'fin' => $fin, 'lien' => $lien, 'idBattle' => $idBattle]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête d'ajout d'un questionnaire a échouée.");
        }   
        return true;
    }


    /*!
     *  \fn function getAllQuestionnaire()
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 14:39:47
     *  \brief fonction permettant de récupérer l'intégraité des questionnaires
     *  \return un tableau contenant tous les questionnaires
    */
    public function getAllQuestionnaire() : array{
        //requête SQL
        $sql = "SELECT * FROM Questionnaire";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute();
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de récupération de tous les questionnaires a échouée.");
        }
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets User
        $questionnaires = [];
        foreach ($rows as $row) {
            $questionnaire = new Questionnaire();
            $questionnaire->setId($row['id']);
            $questionnaire->setDebut($row['debut']);
            $questionnaire->setFin($row['fin']);
            $questionnaire->setLien($row['lien']);
            $questionnaire->setIdBattle($row['idBattle']);   
            $questionnaires[] = $questionnaire;
        }
        return $questionnaires;
    }


    /*!
     *  \fn getQuestionnaireByBattle(int $idBattle)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateFri 26 2023 - 10:34:08
     *  \brief fonction permettant de récupérer les questionnaires liés à une data battle
     *  \param $idBattle int correspodant à l'id de la data Battle dont on souhaite connaitre la liste des questionnaires
     *  \return retourne un tbaleau d'objet Questionnaire contenant tous les quiestionnaires liés à une data battle
    */
    public function getQuestionnaireByBattle(int $idBattle) : array{
        //requête SQL
        $sql = "SELECT * FROM Questionnaire WHERE idBattle = :idB";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute(['idB' => $idBattle]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de récupération des questionnaires liés à une data battle a échouée.");
        }
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Questionnaire
        $questionnaires = [];
        foreach ($rows as $row) {
            $questionnaire = new Questionnaire();
            $questionnaire->setId($row['idQuestionnaire']);
            $questionnaire->setDebut($row['debut']);
            $questionnaire->setFin($row['fin']);
            $questionnaire->setLien($row['lien']);
            $questionnaire->setIdBattle($row['idBattle']);   
            $questionnaires[] = $questionnaire;
        }
        return $questionnaires;
    }

    public function deleteQuestionnaire(int $idQuestionnaire) : bool{
        //requête sql
        $req = "DELETE FROM Questionnnaire WHERE idQuestionnnaire =:id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $idQuestionnaire]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête de suppression d'un questionnaire a échouée.");
        }   
        return true;
    }
}