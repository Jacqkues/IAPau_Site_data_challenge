<?php

namespace Model;

use Lib\DatabaseConnection;
use Model\Entites\Equipe;
use Exception;

class EquipeRepository
{

    protected DatabaseConnection $database;
    private MembreRepository $membreRepository;
    public function __construct(DatabaseConnection $database)
    {
        //construit un objet de type DatabaseConnection
        $this->database = $database;
        $this->membreRepository = new MembreRepository(new DatabaseConnection());
    }

    /*!
     *  \fn function getEquipe(int $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 15:31:36
     *  \brief fonction permettant de récupérer les informations d'une équipe via leur numéro
     *  \param $id int qui représente le numéro d'un équipe
     *  \return les informations d'un équipe
     */
    public function getEquipe(int $id): Equipe
    {
        //requête sql
        $req = "SELECT * FROM Equipe WHERE numero= :numero";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['numero' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if ($statement->rowCount() === 0) {
            throw new Exception("La requête d'ajout d'équipe a échouée.");
        }
        //récupération des informations
        $row = $statement->fetch();
        //création d'un objet Equipe
        $equipe = new Equipe();
        $equipe->setId($row['numero']);
        $equipe->setIdChef($row['chef']);
        if ($row['idProjet'] != null) {
            $equipe->setIdProjet($row['idProjet']);
        }
        if ($row['idData'] != null) {
            $equipe->setIdDataChallenge($row['idData']);
        }
        $equipe->setScore($row['score']);
        $equipe->setNom($row['nom']);
        return $equipe;
    }

    /*!
     *  \fn getEquipes()
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 15:47:22
     *  \brief fonction permettant de récupérer toutes les équipes
     *  \return retourne un tableau de toutes les informations de toutes les équipes
     */
    public function getEquipes(): array
    {
        //requête SQL
        $req = "SELECT * FROM Equipe";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute();
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if ($statement == NULL) {
            throw new Exception("La requête d'ajout de récupération d'équipe a échouée.");
        }
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets Equipe
        $equipes = [];
        foreach ($rows as $row) {
            $equipe = new Equipe();
            $equipe->setId($row['numero']);
            $equipe->setIdChef($row['chef']);
            $equipe->setIdDataChallenge($row['idData']);
            $equipe->setIdProjet($row['idProjet']);
            $equipe->setScore($row['score']);
            $equipe->setNom($row['nom']);
            $equipes[] = $equipe;
        }
        return $equipes;
    }

    /*!
     *  \fn function getEquipeBtChef(string $mailChef)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 20:02:20
     *  \brief fonction permettant de récupérer un équipe via son chef
     *  \param $idChef int correspondant à l'id d'un chef d'équipe
     *  \return $equipe l'équipe correspondante au chef
     */
    public function getEquipeByChef(int $idChef): Equipe
    {
        //requête sql
        $req = "SELECT * FROM Equipe WHERE chef= :idChef";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idChef' => $idChef]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if ($statement == NULL) {
            throw new Exception("La requête de récupération d'équipe par le Chef a échoué.");
        }
        //récupération des informations
        $row = $statement->fetch();
        //création d'un objet Equipe
        $equipe = new Equipe();
        $equipe->setId($row['numero']);
        $equipe->setIdChef($row['chef']);
        $equipe->setIdDataChallenge($row['idData']);
        $equipe->setIdProjet($row['idProjet']);
        $equipe->setScore($row['score']);
        $equipe->setNom($row['nom']);
        return $equipe;
    }

    /*!
     *  \fn function getEquipeBtChef(string $mailChef)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 20:02:20
     *  \brief fonction permettant de récupérer un équipe via un id de data challenge
     *  \param $idDataChallenge id d'un data challenge
     *  \return $equipe l'équipe correspondante au dataChallenge
     */
    public function getEquipeByDataChallenge(int $idDataChallenge): array
    {
        //requête sql
        $req = "SELECT * FROM Equipe WHERE idData = :idDataChallenge";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idDataChallenge' => $idDataChallenge]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if ($statement == NULL) {
            throw new Exception("La requête de récupération d'équipe par idDataChallenge a échoué.");
        }
        //récupération des informations
        $equipes = []; 
        $rows = $statement->fetchAll();
        foreach ($rows as $row) {
            //création d'un objet Equipe
            $equipe = new Equipe();
            $equipe->setId($row['numero']);
            $equipe->setIdChef($row['chef']);
            if ($row['idProjet'] != null) {
                $equipe->setIdProjet($row['idProjet']);
            }
            if ($row['idData'] != null) {
                $equipe->setIdDataChallenge($row['idData']);
            }
            $equipe->setScore($row['score']);
            $equipe->setNom($row['nom']);
            $equipes[] = $equipe;
        }

        return $equipes;
    }

    /*!
     *  \fn changeScore(int $point)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 20:05:28
     *  \brief fonction permettant de changer le score d'une équipe
     *  \param $point int correspondant au nombre de point à rajouter
     *  \param $id int correspondant au numéro d'équipe à modifier
     *  \return true si tout c'est bien passé
     */
    public function changeScore(int $point, int $id): bool
    {
        //On récupère les informations de l'équipe correspondant à l'id
        $equipe = $this->getEquipe($id);
        //On récupère le score de l'équipe
        $score = $equipe->getScore();
        //requête SQL
        $req = "UPDATE Equipe SET score = :score WHERE numero = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['score' => ($score + $point), 'id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if ($statement == NULL) {
            throw new Exception("La requête de modification du score a échouée.");
        }
        return true;
    }


    /*!
     *  \fn function addEquipe(string $chef,int,string $idProjet,string $idData)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 09:15:18
     *  \brief fonction permettant de rajouter une équipe
     *  \param $chef int correspodnant à l'id du chef d'équipe : celui qui créer l'équipe
     *  \return true si tout se passe bien
     */
    public function addEquipe(int $chef,string $nom): int
    {
        //requête d'insertion dans la bdd d'une nouvelle Equipe
        $req = "INSERT INTO Equipe (chef,nom,score,idProjet,idData) VALUES ( :chef, :nom, :score, :idProjet, :idData)";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        
        $statement->execute(['chef' => $chef, 'nom' => $nom,'score' => 0, 'idProjet' => null, 'idData' => null]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if ($statement == NULL) {
            throw new Exception("La requête d'ajout d'équipe a échouée.");
        }
        return $this->database->getConnection()->lastInsertId();
    }


    /*!
     *  \fn function addBattle(int $idProjet, int $idEquipe)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 09:32:02
     *  \brief fonction permettant de mettre à jour une équipe qui choisi un data Projet
     *  \param $idProjet id qui représente l'id d'un data Projet
     *  \param $idEquipe int qui représente le numéro d'un équipe
     *  \return true quand tout se passe bien
     */
    public function addProjet(int $idProjet, int $idEquipe): bool
    {
        //Requête pour mettre à jour l'équipe et choisir le data Battle
        $req = "UPDATE Equipe SET idProjet = :idProjet WHERE numero = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idProjet' => $idProjet, 'id' => $idEquipe]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if ($statement == NULL) {
            throw new Exception("La requête d'ajout d'un data Projet a échouée.");
        }

        return true;
    }

    /*!
     *  \fn function addBattle(int $idChallenge, int $idEquipe)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 09:32:02
     *  \brief fonction permettant de mettre à jour une équipe qui choisi un data Projet
     *  \param $idChallenge int qui représente l'id d'un data Challenge
     *  \param $idEquipe int qui réprésente le numéro d'un équipe
     *  \return true quand tout se passe bien
     */
    public function addChallenge(int $idChallenge, int $idEquipe): bool
    {
        //Requête pour mettre à jour l'équipe et choisir le data Challenge
        $req = "UPDATE Equipe SET idData = :idData WHERE numero = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['idData' => $idChallenge, 'id' => $idEquipe]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if ($statement == NULL) {
            throw new Exception("La requête d'ajout d'un data Challenge a échouée.");
        }

        return true;
    }

    /*!
     *  \fn deleteEquipe(int $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 17:39:51
     *  \brief fonction permettant de supprimer une équipe en fonction de son numéro
     *  \param $id int correspondant au numéro de l'équipe 
     *  \return retourne true si tout se passe bien 
     */
    public function deleteEquipe(int $id)
    {
        //requête de suppression d'une équipe
        $reqs = [
            "DELETE FROM Membre WHERE idEquipe = :id",
            "DELETE FROM rendu WHERE idEquipe = :id",
            "DELETE FROM equipe WHERE numero = :id"
        ];

        foreach ($reqs as $req) {
            $statement = $this->database->getConnection()->prepare($req);
            $statement->execute(['id' => $id]);

            if ($statement == NULL) {
                throw new Exception("La requête de suppression d'une équipe a échoué.");
            }
        }
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        return true;
    }

    /*!
     *  \fn getEquipeByUser(int $idUser)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateWed 24 2023 - 16:17:54
     *  \brief fonction permettant de récupérer toutes les équipes liées à un utilisateur
     *  \param $idUser int correspondant à l'id de l'utilisateur dont on souhaite récupérer ses équipes
     *  \return retourne un tableau d'objet Equipe qui contient toutes les équipes accueillant l'utilisateur 
     */
    public function getEquipeByUser(int $idUser): array
    {
        //création d'un tableau d'objets Equipe
        $equipes = [];
        try {

            $req = "SELECT * FROM Equipe WHERE numero IN (SELECT idEquipe FROM Membre WHERE idUser = :idUser)";

            //préparation de la requête
            $statement = $this->database->getConnection()->prepare($req);
            //exécution de la requête
            $statement->execute(['idUser' => $idUser]);
            //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
            if ($statement->rowCount() === 0) {
                throw new Exception("La requête pour récupérer les id des équipes liées à un utilisateur a échoué.");
            }
            //récupération du résultat
            $rows = $statement->fetchAll();
            foreach ($rows as $row) {
                $equipe = new Equipe();
                $equipe->setId($row['numero']);
                $equipe->setIdChef($row['chef']);
                if ($row['idProjet'] != null) {
                    $equipe->setIdProjet($row['idProjet']);
                } else {
                    $equipe->setIdProjet(-1);
                }
                if ($row['idData'] != null) {
                    $equipe->setIdDataChallenge($row['idData']);
                }
                $equipe->setScore($row['score']);
                $equipe->setNom($row['nom']);
                $equipes[] = $equipe;
            }
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des équipes liées à un utilisateur : " . $e->getMessage());
        }
        return $equipes;
    }

    public function checkEquipeHasProjet(int $idEquipe): bool
    {
        //création d'un tableau d'objets Equipe
        try {

            $req = "SELECT idProjet FROM Equipe WHERE numero = :idEquipe";

            //préparation de la requête
            $statement = $this->database->getConnection()->prepare($req);
            //exécution de la requête
            $statement->execute(['idEquipe' => $idEquipe]);
            //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
            if ($statement->rowCount() === 0) {
                throw new Exception("La requête pour vérifier si une équipe est déjà inscrite à un projet a échoué.");
            }
            //récupération du résultat
            $row = $statement->fetch();
            return $row['idProjet'] != null;
        
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des équipes liées à un utilisateur : " . $e->getMessage());
        }
    }
}