<?php


namespace Model;
use Lib\DatabaseConnection;
use Model\Entites\Ressources;
use Model\Entites\User;
use Model\Entites\projetData;
use Exception;


class AssociationRepository{
    //point d'accés à la base de données
    protected DatabaseConnection $database;
    

    public function __construct(DatabaseConnection $database) {
        //construit un objet de type DatabaseConnection
        $this->database = $database;
    }

    public function addResourceDataChallenge(int $idDataChallenge, int $idRessource){
        //requête sql
        $req = "INSERT INTO Detenir (idChallenge, idRessources) VALUES (:idDataChallenge, :idRessource)";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idDataChallenge' => $idDataChallenge, 'idRessource' => $idRessource]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête d'ajout de ressource a échouée.");
        }
    }

    public function getResourceByChallenge(int $id):array{
        $req = "SELECT * FROM Ressources WHERE idRessources IN (SELECT idRessources FROM Detenir WHERE idChallenge = :id)";
        $statement = $this->database->getConnection()->prepare($req);
        $statement->execute(['id' => $id]);
        $result = $statement->fetchAll();
        $results = [];
        foreach($result as $row){
            $res = new Ressources();
            $res->setId($row['idRessources']);
            $res->setNom($row['nom']);
            $res->setLien($row['lien']);
            $res->setTypes($row['types']);
            $results[] = $res;

        }
        return $results;
    }

    public function lierContactProjet(int $idContact, int $idProjet){
        $req = "INSERT INTO Lier (idUser, idProjet) VALUES (:idContact, :idProjet)";
        $statement = $this->database->getConnection()->prepare($req);
        $statement->execute(['idContact' => $idContact, 'idProjet' => $idProjet]);
        if($statement->rowCount() === 0){
            throw new Exception("La requête d'ajout de contact a échouée.");
        }
    }

    public function getContactByProjet(int $id):array{
        $req = "SELECT * FROM User WHERE idUser IN (SELECT idUser FROM Lier WHERE idProjet = :id)";
        $statement = $this->database->getConnection()->prepare($req);
        $statement->execute(['id' => $id]);
        $result = $statement->fetchAll();
        $results = [];
        foreach($result as $row){
            $res = new User();
            $res->setId($row['idUser']);
            $res->setNom($row['nom']);
            $res->setPrenom($row['prenom']);
            $res->setMail($row['mail']);
            $res->setNumTel($row['numTel']);
            $res->setEtablissement($row['etablissement']);
            $results[] = $res;

        }
        return $results;
    }

    public function getProjetByContact(int $userId){
        $req = "SELECT * FROM projetData WHERE idProjet IN (SELECT idProjet FROM Lier WHERE idUser = :id)";
        $statement = $this->database->getConnection()->prepare($req);
        $statement->execute(['id' => $userId]);
        $result = $statement->fetchAll();
        $results = [];
        foreach($result as $row){
            $projet = new projetData();
            $projet->setIdProjet($row['idProjet']);
            $projet->setLibelle($row['libelleData']);
            $projet->setDescription($row['descrip']);
            $projet->setIdDataChallenge($row['idChallenge']);
            $projet->setLienImg($row['lienImg']);
            $results[] = $projet;

        }
        return $results;
    }

    public function removePartenaire(int $id, int $idProjet){
        $req = "DELETE FROM Lier WHERE idUser = :id AND idProjet = :idProjet";
        $statement = $this->database->getConnection()->prepare($req);
        $statement->execute(['id' => $id, 'idProjet' => $idProjet]);
        if($statement->rowCount() === 0){
            throw new Exception("La requête de suppression de contact a échouée.");
        }
        return true;
    }
    public function addResourceProjet(int $idProjet , int $idRessource){
        $req = "INSERT INTO Posseder (idProjet, idRessources) VALUES (:idProjet, :idRessource)";
        $statement = $this->database->getConnection()->prepare($req);
        $statement->execute(['idProjet' => $idProjet, 'idRessource' => $idRessource]);
        if($statement->rowCount() === 0){
            throw new Exception("La requête d'ajout de ressource a échouée.");
        }
    }

    public function getRessourceByProjet(int $id){
        $req = "SELECT * FROM Ressources WHERE idRessources IN (SELECT idRessources FROM Posseder WHERE idProjet = :id)";
        $statement = $this->database->getConnection()->prepare($req);
        $statement->execute(['id' => $id]);
        $result = $statement->fetchAll();
        $results = [];
        foreach($result as $row){
            $res = new Ressources();
            $res->setId($row['idRessources']);
            $res->setNom($row['nom']);
            $res->setLien($row['lien']);
            $res->setTypes($row['types']);
            $results[] = $res;

        }
        return $results;
    }
}