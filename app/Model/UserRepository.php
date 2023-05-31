<?php
namespace Model;

use Lib\DatabaseConnection;
use Model\Entites\User;
use Exception;
use PDO;

class UserRepository{
    //point d'accés à la base de données
    protected DatabaseConnection $database;
    
    private MembreRepository $membreRepository;
    private LierRepository $lierRepository;
    public function __construct(DatabaseConnection $database) {
        //construit un objet de type DatabaseConnection
        $this->database = $database;
        $this->membreRepository = new MembreRepository(new DatabaseConnection());
        $this->lierRepository = new LierRepository(new DatabaseConnection());
    }

   
    public function getUser(int $id): User {
        //requête SQL
        $sql = "SELECT * FROM User WHERE idUser = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($sql);
        //exécution de la requête
        $statement->execute(['id' => $id]);
        //récupération du résultat
        $row = $statement->fetch();
        if(empty($row)){
            throw new Exception("L'utilisateur n'existe pas");
        }  
        //création d'un objet User
        $user = new User();
        $user->setId($row['idUser']);
        $user->setType($row['types']);
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
        $sql = "SELECT * FROM User";
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
            $user->setId($row['idUser']);
            $user->setType($row['types']);
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
        $sql = "SELECT * FROM User WHERE mail = :mail";
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
        $user->setId($row['idUser']);
        $user->setType($row['types']);
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

    /*!
     *  \fn function addUser(string $type, string $nom, string $prenom, string $etab, string $nivEtude, int $numTel, string $mail, date $dateDeb, date $ dateFin, string $mdp)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 14:17:05
     *  \brief fonction permettant de rajouter un utilisateur   
     *  \param $type string permettant de préciser le type d'utilisateur (admin, gestionnaire ,étudiant)
     *  \param $nom string correspondant au nom de l'utilisateur
     *  \param $prenom string correspondant au prénom de l'utilisateur
     *  \param $etab string représentant le nom de l'école si l'utilisateur est un étudiant ou le nom de l'entreprise si l'utilisateur est un gestionnaire
     *  \param $numTel entier correspondant au numéro de téléphone de l'utilisateur
     *  \param $mail string correspondant à l'adresse mail de l'utilisateur
     *  \param $dateDeb string correspondant à la date du début d'activation pour un gestionnaire
     *  \param $dateFin string correspondant à la date de fin d'activation pour un gestionnaire
     *  \param $mdp string correspondant au mot de passe de l'utilisateur
     *  \return true quand tout se passe bien
    */
    public function addUser(User $user): bool {

        //requête d'insertion dans la bdd du nouvel utilisateur
        $req = "INSERT INTO User (types,nom,prenom,etablissement,nivEtude,numTel,mail,dateDeb,dateFin,mdp) VALUES ( :types, :nom, :prenom, :etablissement, :nivEtude, :numTel, :mail, :dateDeb, :dateFin, :mdp)";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['types' => $user->getType(), 'nom' => $user->getNom(), 'prenom' => $user->getPrenom(), 'etablissement' => $user->getEtablissement(), 'nivEtude' => $user->getNivEtude(), "numTel" => $user->getNumTel(), "mail" => $user->getMail(), "dateDeb" => $user->getDateDeb(), "dateFin" => $user->getDateFin(), 'mdp' => $user->getMdp()]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement->rowCount() === 0){
            throw new Exception("La requête d'ajout d'utilisateur a échouée.");
        }
        //Si l'utilisateur est un administrateur alors on l'écit dans le fichier data      
        if($user->getType() == 'admin'){
            $fichier = fopen('../sql/data.sql','a+');
            $ecrit = $req."; \n";
            fwrite($fichier, $ecrit);
            fclose($fichier);
        }
        return true;
    }

    public function updateAll(User $user){
        // Requête d'update dans la base de données pour le nouvel utilisateur
        $req = "UPDATE User SET types=:types, nom=:nom, prenom=:prenom, etablissement=:etablissement, nivEtude=:nivEtude, numTel=:numTel, mail=:mail, dateDeb=:dateDeb, dateFin=:dateFin, mdp=:mdp  WHERE idUser=:idUser";
      
        // Préparation de la requête
        
        $statement = $this->database->getConnection()->prepare($req);
        $statement->bindValue(':types', $user->getType(), PDO::PARAM_STR);
        $statement->bindValue(':nom', $user->getNom(), PDO::PARAM_STR);
        $statement->bindValue(':prenom', $user->getPrenom(), PDO::PARAM_STR);
        $statement->bindValue(':etablissement', $user->getEtablissement(), PDO::PARAM_STR);
        $statement->bindValue(':nivEtude', $user->getNivEtude(), PDO::PARAM_STR);
        $statement->bindValue(':numTel', $user->getNumTel(), PDO::PARAM_INT);
        $statement->bindValue(':mail', $user->getMail(), PDO::PARAM_STR);
        $statement->bindValue(':dateDeb', $user->getDateDeb(), PDO::PARAM_STR);
        $statement->bindValue(':dateFin', $user->getDateFin(), PDO::PARAM_STR);
        $statement->bindValue(':mdp', $user->getMdp(), PDO::PARAM_STR);
        $statement->bindValue(':idUser', $user->getId(), PDO::PARAM_INT);
        // Exécution de la requête
        $statement->execute();
        
        
        
      
        // On vérifie que tout s'est bien passé, sinon on lance une nouvelle exception
        if($statement == NULL){
            throw new Exception("La requête de modification d'utilisateur a échoué.");
        }
      
        return true;
    }

    /*!
     *  \fn function changeNom($nom)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 14:59:12
     *  \brief fonction permettant de modifier le nom de l'utilisateur
     *  \param $nom string représentant le nouveau nom de l'utilisateur
     *  \param $id int représentant l'id de l'utilisateur à modifier
     *  \return true quand tout se passe bien
    */
    public function changeNom(string $nom, int $id) : bool{
        //requête de modification du nom de l'utilisateur
        $req = "UPDATE User SET nom = :nom WHERE idUser = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(["nom" => $nom, 'id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement == NULL){
            throw new Exception("La requête de modication du nom de l'utilisateur a échouée.");
        }
        return true;
    }

    /*!
     *  \fn function changePrenom($prenom)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 14:59:12
     *  \brief fonction permettant de modifier le prénom de l'utilisateur
     *  \param $prenom string représentant le nouveau prénom de l'utilisateur
     *  \param $id int représentant l'id de l'utilisateur à modifier
     *  \return true quand tout se passe bien
    */
    public function changePrenom(string $prenom, int $id) : bool{
        //requête de modification du prenom de l'utilisateur
        $req = "UPDATE User SET prenom = :prenom WHERE idUser = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(["prenom" => $prenom, "id" => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement == NULL){
            throw new Exception("La requête de modification du prénom de l'utilisateur a échouée.");
        }
        return true;
    }
    /*!
     *  \fn function changeEtab(string $etab, int $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 14:59:12
     *  \brief fonction permettant de modifier l'établissement de l'utilisateur
     *  \param $etab string représentant le nouvel etablissement de l'utilisateur
     *  \param $id int représentant l'id de l'utilisateur à modifier
     *  \return true quand tout se passe bien
    */
    public function changeEtab(string $etab, int $id) : bool{
        //requête de modification du nom de l'utilisateur
        $req = "UPDATE User SET etablissement = :etablissement WHERE idUser = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(["etablissement" => $etab, "id" => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement == NULL){
            throw new Exception("La requête de modification de l'établissement de l'utilisateur a échouée.");
        }
        return true;
    }

    /*!
     *  \fn function changeNiveau(string $niveau, int $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 14:59:12
     *  \brief fonction permettant de modifier le niveau d'étude d'un étudiant
     *  \param $niveau string représentant le nouveau niveau d'étude d'un étudiant
     *  \param $id int représentant l'id de l'utilisateur à modifier
     *  \return true quand tout se passe bien
    */
    public function changeNiveau(string $niveau, int $id) : bool{
        //requête de modification du niveau d'étude de l'utilisateur
        $req = "UPDATE User SET nivEtude = :nivEtude WHERE idUser = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(["nivEtude" => $niveau, "id" => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement == NULL){
            throw new Exception("La requête de modification du niveau d'étude de l'utilisateur a échouée.");
        }
        return true;
    }
    
    
    /*!
     *  \fn function changeTel(string $tel, int $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 14:59:12
     *  \brief fonction permettant de modifier le numéro de téléphone d'un utilisateur
     *  \param $tel int représentant le nouveau numéro de téléphone d'un utilisateur
     *  \param $id int représentant l'id de l'utilisateur à modifier
     *  \return true quand tout se passe bien
    */
    public function changeTel(int $tel, int $id) : bool{
        //requête de modification du niveau d'étude de l'utilisateur
        $req = "UPDATE User SET numTel = :numTel WHERE idUser = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(["numTel" => $tel, "id" => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement == NULL){
            throw new Exception("La requête de modification du numéro de téléphone de l'utilisateur a échouée.");
        }
        return true;
    }

    /*!
     *  \fn function changeMail(string $mail, int $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 14:59:12
     *  \brief fonction permettant de modifier le mail d'un utilisateur
     *  \param $mail string représentant la nouvelle addresse mail d'un utilisateur
     *  \param $id int représentant l'id de l'utilisateur à modifier
     *  \return true quand tout se passe bien
    */
    public function changeMail(string $mail, int $id) : bool{
        //requête de modification du niveau d'étude de l'utilisateur
        $req = "UPDATE User SET mail = :mail WHERE idUser = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(["mail" => $mail, "id" => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement == NULL){
            throw new Exception("La requête de modification de l'adresse mail de l'utilisateur a échouée.");
        }
        return true;
    }
    
    /*!
     *  \fn function changeMdp(string $mdp, int $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateMon 22 2023 - 14:59:12
     *  \brief fonction permettant de modifier le mot de passe d'un utilisateur
     *  \param $mdp string représentant le nouveau mot de passe d'un utilisateur
     *  \param $id int représentant l'id de l'utilisateur à modifier
     *  \return true quand tout se passe bien
    */
    public function changeMDP(string $mdp, int $id) : bool{
        //requête de modification du niveau d'étude de l'utilisateur
        $req = "UPDATE User SET mdp = :mdp WHERE idUser = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(["mdp" => $mdp, "id" => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement == NULL){
            throw new Exception("La requête de modification du mot de passe de l'utilisateur a échoué.");
        }
        return true;
    }

    /*!
     *  \fn deleteUser(int $id)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateTue 23 2023 - 17:50:41
     *  \brief fonction permettant de supprimer un utilisateur en onction de son id
     *  \param $id int correspondant à l'id de l'utilisateur
     *  \return true si tout c'ets bien passé 
    */
    public function deleteUser(int $id) : bool{
        //requête de suppression d'un data Challenge
        $req = "DELETE FROM User WHERE idUser = :id";
        //préparation de la requête
        $statement = $this->database->getConnection()->prepare($req);
        //exécution de la requête
        $statement->execute(['id' => $id]);
        //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
        if($statement == NULL){
            throw new Exception("La requête de suppression d'un utilisateur a échoué.");
        }
        return true;
    }

    /*!
     *  \fn getUserByEquipe(int $idEquipe)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateWed 24 2023 - 16:06:59
     *  \brief fonction permettant de récupére tous les utilisateurs appartenant à une équipe
     *  \param $idEquipe int correspondant à l'id de l'équipe dont on souhaite connaitre les membres
     *  \return un tableau d'objet User contenant tous les étudiants appartenant à une équipe
    */
    public function getUserByEquipe(int $idEquipe) : array{
        //création d'un tableau d'objets User
        $users = [];
        try{
            $membre = $this->membreRepository->getMembreByTeam($idEquipe);
            if(empty($membre)){
                throw new Exception("Le tableau des membres d'équipes est vide");
            }
            
            $membres = implode(',',array_fill(0, count($membre), '?'));
            $req = "SELECT * FROM User WHERE idUser IN ($membres)";
            //préparation de la requête
            $statement = $this->database->getConnection()->prepare($req);
            //exécution de la requête
            $statement->execute($membre);
            //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
            if($statement->rowCount() === 0){
                throw new Exception("La requête pour récupérer les id des membres d'une équipe a échoué.");
            }
            //récupération du résultat
            $rows = $statement->fetchAll();
            foreach ($rows as $row) {
                $user = new User();
                $user->setId($row['idUser']);
                $user->setType($row['types']);
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
        }catch(Exception $e){
            throw new Exception("Erreur lors de la récupération des membres liés à une équipe : " . $e->getMessage());
        }

        return $users;
    }


    /*!
     *  \fn getGestByProjet(int idProjet)
     *  \author DUMORA-DANEZAN Jacques, BRIOLLET Florian, MARTINEZ Hugo, TRAVAUX Louis, SERRES Valentin 
     *  \version 0.1 Premier jet
     *  \dateThu 25 2023 - 17:59:59
     *  \brief fonction permettant de récupérer les gestionnaires liés à un projet
     *  \param $idProjet int correspondant à l'id du projet dont on souhaite récupérer les contacts
     *  \return retourne un tableau d'objet User correspondant aux contacts liés à un Projet
    */
    public function getGestByProjet(int $idProjet) : array{
        try{
            //On récupère les id des utilisateurs liés à l'id d'un projet
            $recUsers = $this->lierRepository->getLierByProjet($idProjet);
            //Si Mon tableau est vide c'est qu'il n'y a pas de contact lié au projet
            if(empty($recUsers)){
                throw new Exception("Le tableau d'utilisateur est vide");
            }
            
            $users = implode(',',array_fill(0, count($recUsers), '?'));
            $req = "SELECT * FROM User WHERE idUser IN ($users)";
            //préparation de la requête
            $statement = $this->database->getConnection()->prepare($req);
            //exécution de la requête
            $statement->execute($recUsers);
            //On vérifie que tout se passe bien, sinon on jette une nouvelle exception
            if($statement->rowCount() === 0){
                throw new Exception("La requête pour récupérer les id des contactes liés à un projet a échouée.");
            }
            //récupération du résultat
            $rows = $statement->fetchAll();
            //création d'un tableau d'objets User
            $users = [];
            foreach ($rows as $row) {
                $user = new User();
                $user->setId($row['idUser']);
                $user->setType($row['types']);
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
        } catch (Exception $e){
            throw new Exception("Erreur lors de la récupération des utilisateurs liés au projet : " . $e->getMessage());
        }
        return $users;
    }

    public function getGestionnaire(){
        $req = "SELECT * FROM User WHERE Types = 'Gestionnaire'";

        $statement = $this->database->getConnection()->prepare($req);
        $statement->execute();
        if($statement->rowCount() === 0){
            throw new Exception("La requête pour récupérer les gestionnaires a échouée.");
        }
        $rows = $statement->fetchAll();
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user->setId($row['idUser']);
            $user->setType($row['types']);
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
}