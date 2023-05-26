DROP DATABASE IF EXISTS Challenge;
CREATE DATABASE Challenge;
USE Challenge;

CREATE TABLE User(
    idUser INT PRIMARY KEY AUTO_INCREMENT,
    types VARCHAR(20) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    etablissement VARCHAR(50) NOT NULL,
    nivEtude VARCHAR(20),
    numTel INT NOT NULL,
    mail VARCHAR(200) NOT NULL,
    dateDeb DATE,
    dateFin DATE,
    mdp VARCHAR(64) NOT NULL
);



CREATE TABLE dataChallenge(
    idChallenge INT PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(200) NOT NULL,
    tempsDebut DATE,
    tempsFin DATE
);

CREATE TABLE projetData(
    idProjet INT PRIMARY KEY AUTO_INCREMENT,
    idChallenge INT,
    descrip VARCHAR(200),
    lienImg VARCHAR(200),
    libelleData VARCHAR(200),
    FOREIGN KEY fk_idData(idChallenge) REFERENCES dataChallenge(idChallenge) ON DELETE CASCADE
);

CREATE TABLE Lier(
    idUser INT,
    idProjet INT,
    CONSTRAINT pk_lier PRIMARY KEY(idUser, idProjet),
    FOREIGN KEY fk_User(idUser) REFERENCES User(idUser) ON DELETE CASCADE,
    FOREIGN KEY fk_projet(idProjet) REFERENCES projetData(idProjet) ON DELETE CASCADE
);

CREATE TABLE Ressources(
    idRessources INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50),
    types VARCHAR(50),
    lien VARCHAR(200)
);

CREATE TABLE Detenir(
    idChallenge INT,
    idRessources INT,
    CONSTRAINT pk_Detenir PRIMARY KEY (idChallenge, idRessources),
    FOREIGN KEY fk_idChallenge(idChallenge) REFERENCES dataChallenge(idChallenge) ON DELETE CASCADE ,
    FOREIGN KEY fk_idRessources(idRessources) REFERENCES Ressources(idRessources) ON DELETE CASCADE
);

CREATE TABLE Posseder(
    idProjet INT,
    idRessources INT,
    CONSTRAINT pk_Posseder PRIMARY KEY (idProjet, idRessources),
    FOREIGN KEY fk_libelleProjet(idProjet) REFERENCES projetData(idProjet) ON DELETE CASCADE,
    FOREIGN KEY fk_idRessources(idRessources) REFERENCES Ressources(idRessources) ON DELETE CASCADE
);

CREATE TABLE dataBattle(
    idBattle INT PRIMARY KEY NOT NULL,
    debut DATE,
    fin DATE
);

CREATE TABLE Questionnaire(
    idQuestionnaire INT PRIMARY KEY AUTO_INCREMENT,
    question VARCHAR(250),
    reponse VARCHAR(250),
    debut DATE,
    fin DATE,
    lien VARCHAR(200),
    idBattle INT,
    FOREIGN KEY fk_idBattle(idBattle) REFERENCES dataBattle(idBattle) ON DELETE CASCADE
);

CREATE TABLE Equipe(
    numero INT PRIMARY KEY AUTO_INCREMENT,
    chef INT NOT NULL,
    score INT,
    idBattle INT,
    idProjet INT,
    idData INT,
    FOREIGN KEY fk_Chef(chef) REFERENCES User(idUser) ON DELETE CASCADE,
    FOREIGN KEY fk_battle(idBattle) REFERENCES dataBattle(idBattle) ON DELETE CASCADE,
    FOREIGN KEY fk_projet(idProjet) REFERENCES projetData(idProjet) ON DELETE CASCADE,
    FOREIGN KEY fk_data(idData) REFERENCES dataChallenge(idChallenge) ON DELETE CASCADE
);

CREATE TABLE Membre(
    idEquipe INT,
    idUser INT,
    CONSTRAINT pk_Membre PRIMARY KEY(idEquipe, idUser),
    FOREIGN KEY fk_equipe(idEquipe) REFERENCES Equipe(numero) ON DELETE CASCADE,
    FOREIGN KEY fk_user(idUser) REFERENCES User(idUser) ON DELETE CASCADE
);

CREATE TABLE Rendu(
    lien VARCHAR(200) PRIMARY KEY,
    dateRendu DATE NOT NULL,
    idEquipe INT NOT NULL,
    FOREIGN KEY fk_equipe(idEquipe) REFERENCES Equipe(numero)
);

CREATE TABLE Messagerie(
    idMessagerie INT PRIMARY KEY AUTO_INCREMENT,
    auteur INT NOT NULL,
    types VARCHAR(20) NOT NULL CHECK (types != "etudiant"),
    contenu VARCHAR(10000) NOT NULL,
    dateEnvoi DATE NOT NULL,
    categorie VARCHAR(200) DEFAULT 'GENERAL',
    objet VARCHAR(1000),
    FOREIGN KEY fk_auteur(auteur) REFERENCES User(idUser)
);