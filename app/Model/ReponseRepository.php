<?php

namespace Model;
use Lib\DatabaseConnection;
use Model\Entites\Reponse;
use Exception;
use Model\ReponseException;

class ReponseRepository{
    //point d'accés à la base de données
    protected DatabaseConnection $database;
    

    public function __construct(DatabaseConnection $database) {
        //construit un objet de type DatabaseConnection
        $this->database = $database;
    }


    
    public function getReponse(int $id): Reponse{
        //requête sql
        $req = "SELECT * FROM Reponse WHERE idReponse= :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new ReponseException("La requête de récupération de la réponse a échouée.");
        }
        //récupération des informations
        $row = $statement->fetch();
        //création d'un objet reponse
        $reponse = new Reponse();
        $reponse->setIdQuestion($row['idQuestion']);
        $reponse->setReponse($row['reponse']);
        $reponse->setIdReponse($row['idReponse']);
        $reponse->setIdEquipe($row['idEquipe']);
        $reponse->setNote($row['note']);
        return $reponse;
    }


    public function addReponse(int $idQuestion, string $reponse, int $idEquipe): bool{
        //requête d'insertion dans la bdd d'une nouvelle reponse
        $req = "INSERT INTO Reponse (reponse, idQuestion, idEquipe) VALUES ( :reponse, :idQ, idE)";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['reponse' => $reponse,'idQ' => $idQuestion, 'idE' => $idEquipe]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new ReponseException("La requête d'ajout d'une réponse a échouée.");
        }   
        return true;
    }


    
    public function getAllReponses() : array{
        //requête SQL
        $sql = "SELECT * FROM Reponse";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute();
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new ReponseException("La requête de récupération de toutes les reponses a échouée.");
        }
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Question
        $reponses = [];
        foreach ($rows as $row) {
            //création d'un objet reponse
            $reponse = new Reponse();
            $reponse->setIdQuestion($row['idQuestion']);
            $reponse->setReponse($row['reponse']);
            $reponse->setIdReponse($row['idReponse']);
            $reponse->setIdEquipe($row['idEquipe']);
            $reponse->setNote($row['note']);
            $reponses[] = $reponse;
        }
        return $reponses;
    }


    public function updateReponse(int $idReponse,string $reponse): bool{
        //requête sql
        $req = "UPDATE Reponse SET reponse = :reponse WHERE idReponse = :idReponse";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['reponse' => $reponse,'idReponse' => $idReponse]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new ReponseException("La requête de modification d'une reponse a échouée.");
        }
        return true;
    }

    
    public function getReponseByEquipe(int $idEquipe) : array{
        //requête SQL
        $sql = "SELECT * FROM Reponse WHERE idEquipe = :idE";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute(['idE' => $idEquipe]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new ReponseException("La requête de récupération des réponses liées à une équipe a échouée.");
        }
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Question
        $reponses = [];
        foreach ($rows as $row) {
            //création d'un objet reponse
            $reponse = new Reponse();
            $reponse->setIdQuestion($row['idQuestion']);
            $reponse->setReponse($row['reponse']);
            $reponse->setIdReponse($row['idReponse']);
            $reponse->setIdEquipe($row['idEquipe']);
            $reponse->setNote($row['note']);
            $reponses[] = $reponse;
        }
        return $reponses;
    }

    public function getReponseByQuestion(int $idQuestion) : array{
        //requête SQL
        $sql = "SELECT * FROM Reponse WHERE idQuestion = :idQ";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute(['idQ' => $idQuestion]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new ReponseException("La requête de récupération des réponses liées à une question a échouée.");
        }
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Question
        $reponses = [];
        foreach ($rows as $row) {
            //création d'un objet reponse
            $reponse = new Reponse();
            $reponse->setIdQuestion($row['idQuestion']);
            $reponse->setReponse($row['reponse']);
            $reponse->setIdReponse($row['idReponse']);
            $reponse->setIdEquipe($row['idEquipe']);
            $reponse->setNote($row['note']);
            $reponses[] = $reponse;
        }
        return $reponses;
    }

    public function deleteReponse(int $idReponse) : bool{
        //requête sql
        $req = "DELETE FROM Reponse WHERE idReponse =:id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $idReponse]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new ReponseException("La requête de suppression d'une reponse a échouée.");
        }   
        return true;
    }

    public function updateEstNote(int $idReponse,bool $note) : bool{
        //requête sql
        $req = "UPDATE Reponse SET note = :note WHERE idReponse = :idReponse";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['note' => $note,'idReponse' => $idReponse]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new ReponseException("La requête de modification d'une reponse a échouée.");
        }
        return true;
    }
}