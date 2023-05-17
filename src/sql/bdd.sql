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

CREATE TABLE Contact(
    idContact INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    mail VARCHAR(100),
    numTel INT
);


CREATE TABLE dataChallenge(
    libelle VARCHAR(200) PRIMARY KEY NOT NULL,
    tempsDebut DATE,
    tempsFin DATE
);

CREATE TABLE projetData(
    libelle VARCHAR(200) PRIMARY KEY NOT NULL,
    descrip VARCHAR(200),
    lienImg VARCHAR(200),
    coordonnées INT,
    libelleData VARCHAR(200),
    FOREIGN KEY fk_coordonnées(coordonnées) REFERENCES Contact(idContact),
    FOREIGN KEY fk_libelleData(libelleData) REFERENCES dataChallenge(libelle)
);

CREATE TABLE Ressources(
    idRessources INT PRIMARY KEY NOT NULL,
    nom VARCHAR(50),
    lien VARCHAR(200)
);

CREATE TABLE Detenir(
    libelleData VARCHAR(200),
    idRessources INT,
    CONSTRAINT pk_Detenir PRIMARY KEY (libelleData, idRessources),
    FOREIGN KEY fk_libelleData(libelleData) REFERENCES dataChallenge(libelle),
    FOREIGN KEY fk_idRessources(idRessources) REFERENCES Ressources(idRessources)
);

CREATE TABLE Posseder(
    libelleProjet VARCHAR(200),
    idRessources INT,
    CONSTRAINT pk_Posseder PRIMARY KEY (libelleProjet, idRessources),
    FOREIGN KEY fk_libelleProjet(libelleProjet) REFERENCES projetData(libelle),
    FOREIGN KEY fk_idRessources(idRessources) REFERENCES Ressources(idRessources)
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
    FOREIGN KEY fk_idBattle(idBattle) REFERENCES dataBattle(idBattle)
);

CREATE TABLE Equipe(
    numero INT PRIMARY KEY AUTO_INCREMENT,
    chef VARCHAR(50) NOT NULL,
    score INT,
    idBattle INT,
    idProjet VARCHAR(200),
    idData VARCHAR(200),
    FOREIGN KEY fk_battle(idBattle) REFERENCES dataBattle(idBattle),
    FOREIGN KEY fk_projet(idProjet) REFERENCES projetData(libelle),
    FOREIGN KEY fk_data(idData) REFERENCES dataChallenge(libelle)
);

CREATE TABLE Membre(
    idEquipe INT,
    idUser INT,
    CONSTRAINT pk_Membre PRIMARY KEY(idEquipe, idUser),
    FOREIGN KEY fk_equipe(idEquipe) REFERENCES Equipe(numero),
    FOREIGN KEY fk_user(idUser) REFERENCES User(idUser)
);

CREATE TABLE Rendu(
    lien VARCHAR(200) PRIMARY KEY,
    dateRendu DATE NOT NULL,
    idEquipe INT NOT NULL,
    FOREIGN KEY fk_equipe(idEquipe) REFERENCES Equipe(numero)
);
