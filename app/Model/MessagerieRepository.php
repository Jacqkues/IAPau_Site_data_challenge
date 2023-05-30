<?php

namespace Model;

use Lib\DatabaseConnection;
use Model\Entites\messagerie;
use Exception;

class MessagerieRepository
{
    //point d'accés à la base de données
    protected DatabaseConnection $database;


    public function __construct(DatabaseConnection $database)
    {
        //construit un objet de type DatabaseConnection
        $this->database = $database;
    }


    /*!
     *  \fn getMessage(int $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 20:15:03
     *  \brief fonction permettant de récupérer un message en fonction de son id
     *  \param $id int correspondant à l'id du message voulu
     *  \return retourne un objet de type messagerie 
     */
    public function getMessage(int $id): messagerie
    {
        //requête sql
        $req = "SELECT * FROM Messagerie WHERE idMessagerie= :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if ($statement->rowCount() === 0) {
            throw new Exception("La requête de récupération de la messagerie a échouée.");
        }
        //récupération des informations
        $row = $statement->fetch();
        //création d'un objet Equipe
        $message = new messagerie();
        $message->setIdMessagerie($row['idMessagerie']);
        $message->setIdAuteur($row['auteur']);
        $message->setTypes($row['types']);
        $message->setContenu($row['contenu']);
        $message->setDateEnvoi($row['dateEnvoi']);
        $message->setCategorie($row['categorie']);
        $message->setObjet($row['objet']);
        return $message;
    }


    /*!
     *  \fn addMessage(int $idAuteur, string $types, string $contenu, string $dataEnvoi, string $categorie)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 20:19:36
     *  \brief fonction permettant de rajouter un message
     *  \param $idAuteur int représentant l'id de l'utilisateur écrivant le message
     *  \param $types string représentant le type de l'utilisateur
     *  \param $contenu string correspondant au contenu du message
     *  \param $dataEnvoi string correspondant à la date d'envoie du message
     *  \param $categorie string correspondant aux destiantaires du message (dataChallenge, Projet, dataBattle...)
     *  \return retourne true si tout se passe bien  
     */
    public function addMessage(
        int $idAuteur,
        string $types,
        string $objet,
        string $contenu,
        string $dateEnvoi,
        string $categorie
    ): bool {
        //requête d'insertion dans la bdd d'une nouvelle ressource
        $req = "INSERT INTO Messagerie (auteur, types, contenu, dateEnvoi, objet, categorie) VALUES (:auteur, :types, :contenu, :dateEnvoi, :objet, :categorie)";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute([
            'auteur' => $idAuteur,
            'types' => $types,
            'contenu' => $contenu,
            'dateEnvoi' => $dateEnvoi,
            'objet' => $objet,
            'categorie' => $categorie
        ]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if ($statement->rowCount() === 0) {
            throw new Exception("La requête d'ajout d'un message a échouée.");
        }
        return true;
    }


    /*!
     *  \fn getMessageByAuteur(int $idAuteur)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 20:39:11
     *  \brief fonction permettant de récupérer tous les messages d'un utilisateur à l'aide de son id
     *  \param $idAuteur int id correspondant à l'utilisateur dont on veut récupérer les messages
     *  \return un tableau d'objets messagerie contenant tous les messages d'un utilisateur 
     */
    public function getMessageByAuteur(int $idAuteur): array
    {
        //requête permettant de récupérer tous les messages d'un utilisateur
        $req = "SELECT * FROM Messagerie WHERE auteur = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $idAuteur]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if ($statement->rowCount() === 0) {
            throw new Exception("La requête pour récupérer les messages d'un utilisateur a échouée.");
        }
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets messagerie
        $messages = [];
        foreach ($rows as $row) {
            $message = new messagerie();
            $message->setIdMessagerie($row['idMessagerie']);
            $message->setIdAuteur($row['auteur']);
            $message->setTypes($row['types']);
            $message->setContenu($row['contenu']);
            $message->setDateEnvoi($row['dateEnvoi']);
            $message->setCategorie($row['categorie']);
            $message->setObjet($row['objet']);
            $messages[] = $message;
        }
        return $messages;

    }


    /*!
     *  \fn getAllMessage()
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 20:45:23
     *  \brief fonction permettant de récupérer l'intégralité des messages
     *  \return un tableau d'objet messagerie contenant tous les messages
     */
    public function getAllMessage(): array
    {
        //requête SQL
        $sql = "SELECT * FROM Messagerie";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute();
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets messagerie
        $messages = [];
        foreach ($rows as $row) {
            $message = new messagerie();
            $message->setIdMessagerie($row['idMessagerie']);
            $message->setIdAuteur($row['auteur']);
            $message->setTypes($row['types']);
            $message->setContenu($row['contenu']);
            $message->setDateEnvoi($row['dateEnvoi']);
            $message->setCategorie($row['categorie']);
            $message->setObjet($row['objet']);
            $messages[] = $message;
        }
        return $messages;
    }

    /*!
     *  \fn deleteMessagerie(int $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 20:47:36
     *  \brief fonction permettant de supprimer un message grâce à son id
     *  \param $id int correspondant à l'id du message que l'on souhaite supprimer
     *  \return true lorsque tout se passe bien 
     */
    public function deleteMessagerie(int $id): bool
    {
        //requête de suppression d'un message
        $req = "DELETE FROM Messagerie WHERE idMessagerie = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if ($statement->rowCount() === 0) {
            throw new Exception("La requête de suppression d'une ressource a échouée.");
        }
        return true;
    }

    /*!
     *  \fn getMessageByCat(array $categorie)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateWed 24 2023 - 10:13:19
     *  \brief fonction permettant de récupérer tous les messages d'une ou plusieurs catégories
     *  \param $categorie array de string correspondant à toutes les catégories souhaitées
     *  \return un tableau d'objet Messagerie correspondant à tous les messages de toutes les catégories
     */
    public function getMessageByCat(string $categorie): array
    {
        //On vérifie que le tableau est vide et si il l'est on jette une Exception
        if (empty($categorie)) {
            throw new Exception("Le tableau de catégorie est vide");
        }
        $req = "SELECT * FROM Messagerie WHERE categorie = :categorie";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['categorie' => $categorie]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if ($statement->rowCount() === 0) {
            throw new Exception("La requête pour récupérer les messages d'une ou plusieurs catégories a échoué.");
        }
        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets messagerie
        $messages = [];
        foreach ($rows as $row) {
            $message = new messagerie();
            $message->setIdMessagerie($row['idMessagerie']);
            $message->setIdAuteur($row['auteur']);
            $message->setTypes($row['types']);
            $message->setContenu($row['contenu']);
            $message->setDateEnvoi($row['dateEnvoi']);
            $message->setCategorie($row['categorie']);
            $message->setObjet($row['objet']);
            $messages[] = $message;
        }
        return $messages;
    }

    public function getDistinctCat(): array
    {
        $req = "SELECT DISTINCT categorie FROM messagerie";
        $statement = $this->database->getConnection()->prepare($req);
        $statement->execute();

        if ($statement->rowCount() === 0) {
            throw new Exception("La requête pour récupérer les différentes catégories a échoué.");
        }

        //récupération du résultat
        $rows = $statement->fetchAll();
        //création d'un tableau d'objets messagerie
        $categories = [];
        foreach ($rows as $row) {
            $categories[] = $row['categorie'];
        }
        return $categories;
    }
}