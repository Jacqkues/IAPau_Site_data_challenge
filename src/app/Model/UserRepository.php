<?php
namespace Model;

use Lib\DatabaseConnection;
use Model\Entites\User;
use Exception;

class UserRepository {
    //point d'accés à la base de données
    protected DatabaseConnection $database;
    

    public function __construct(DatabaseConnection $database) {
        //construit un objet de type DatabaseConnection
        $this->database = $database;
    }

    public function getUser(int $id): User {
        //requête SQL
        $sql = "SELECT * FROM user WHERE id = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute(['id' => $id]);
        //récupération du résultat
        $row = $statement->fetch();
        //création d'un objet User
        $user = new User();
        $user->setId($row['id']);
        $user->setType($row['type']);
        $user->setNom($row['nom']);
        $user->setPrenom($row['prenom']);
        $user->setEtablissement($row['etablissement']);
        $user->setNivEtude($row['nivEtude']);
        $user->setNumTel($row['numTel']);
        $user->setMail($row['mail']);
        $user->setDateDeb($row['dateDeb']);
        $user->setDateFin($row['dateFin']);
        $user->setMdp($row['mdp']);
        return $user;
    }

    public function getUsers():array {
        //requête SQL
        $sql = "SELECT * FROM user";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute();
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets User
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user->setId($row['id']);
            $user->setType($row['type']);
            $user->setNom($row['nom']);
            $user->setPrenom($row['prenom']);
            $user->setEtablissement($row['etablissement']);
            $user->setNivEtude($row['nivEtude']);
            $user->setNumTel($row['numTel']);
            $user->setMail($row['mail']);
            $user->setDateDeb($row['dateDeb']);
            $user->setDateFin($row['dateFin']);
            $user->setMdp($row['mdp']);
            $users[] = $user;
        }
        return $users;

    }

    public function findByEmail(string $email): User{
        //requête SQL
        $sql = "SELECT * FROM user WHERE mail = :mail";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute(['mail' => $email]);
        //récupération du résultat
        $row = $statement->fetch();
        if(empty($row)){
            throw new Exception("L'utilisateur n'existe pas");
        }        //création d'un objet User
        $user = new User();
        $user->setId($row['id']);
        $user->setType($row['type']);
        $user->setNom($row['nom']);
        $user->setPrenom($row['prenom']);
        $user->setEtablissement($row['etablissement']);
        $user->setNivEtude($row['nivEtude']);
        $user->setNumTel($row['numTel']);
        $user->setMail($row['mail']);
        $user->setDateDeb($row['dateDeb']);
        $user->setDateFin($row['dateFin']);
        $user->setMdp($row['mdp']);
        return $user;
    }

}