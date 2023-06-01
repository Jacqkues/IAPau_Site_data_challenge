<?php

namespace Model;
use Lib\DatabaseConnection;
use Model\Entites\Question;
use Exception;
use Model\QuestionException;

class QuestionRepository{
    //point d'accés à la base de données
    protected DatabaseConnection $database;
    

    public function __construct(DatabaseConnection $database) {
        //construit un objet de type DatabaseConnection
        $this->database = $database;
    }


    
    public function getQuestion(int $id): Question{
        //requête sql
        $req = "SELECT * FROM Question WHERE idQuestion= :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new QuestionException("La requête de récupération de la question a échouée.");
        }
        //récupération des informations
        $row = $statement->fetch();
        //création d'un objet question
        $questionn = new Question();
        $questionn->setIdQuestion($row['idQuestion']);
        $questionn->setQuestion($row['question']);
        $questionn->setIdQuestionnaire($row['idQuestionnaire']);
        return $questionn;
    }


    public function addQuestion(string $question, int $idQuest): bool{
        //requête d'insertion dans la bdd d'une nouvelle question
        $req = "INSERT INTO Question (question, idQuestionnaire) VALUES ( :question, :idQ)";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['question' => $question,'idQ' => $idQuest]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new QuestionException("La requête d'ajout d'un question a échouée.");
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
    public function getAllQuestions() : array{
        //requête SQL
        $sql = "SELECT * FROM Question";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute();
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new QuestionException("La requête de récupération de toutes les questions a échouée.");
        }
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Question
        $questions = [];
        foreach ($rows as $row) {
            //création d'un objet questionn
            $questionn = new Question();
            $questionn->setIdQuestion($row['idQuestion']);
            $questionn->setQuestion($row['question']);
            $questionn->setIdQuestionnaire($row['idQuestionnaire']);
            $questions[] = $questionn;
        }
        return $questions;
    }


    public function updateQuestion(int $idQuestion, string $question ): bool{
        //requête d'insertion dans la bdd d'un nouveau data Challenge
        $req = "UPDATE Question SET question = :question WHERE idQuestion = :idQ";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['question' => $question,'idQ' => $idQuestion]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new QuestionException("La requête de modification d'une question a échouée.");
        }
        return true;
    }

    
    public function getQuestionByQuestionnaire(int $idQuestionnaire) : array{
        //requête SQL
        $sql = "SELECT * FROM Question WHERE idQuestionnaire = :idQ";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute(['idQ' => $idQuestionnaire]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new QuestionException("La requête de récupération des questions liées à un Questionnaire a échouée.");
        }
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Question
        $questions = [];
        foreach ($rows as $row) {
            //création d'un objet questionn
            $questionn = new Question();
            $questionn->setIdQuestion($row['idQuestion']);
            $questionn->setQuestion($row['question']);
            $questionn->setIdQuestionnaire($row['idQuestionnaire']);
            $questions[] = $questionn;
        }
        return $questions;
    }

    public function deleteQuestion(int $idQuestion) : bool{
        //requête sql
        $req = "DELETE FROM Question WHERE idQuestion =:id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $idQuestion]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new QuestionException("La requête de suppression d'une question a échouée.");
        }   
        return true;
    }
}