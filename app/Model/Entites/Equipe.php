<?php

namespace Model\Entites;

class Equipe{
    protected int $id;
    protected string $idChef; #foreign key vers la table user
    protected int $score;
    protected int $idBattle; #foreign key vers la table dataBattle
    protected string $libelleProjet; #foreign key vers la table projetData
    protected string $libelleDataChallenge; #foreign key vers la table projetData

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id; 
    }

    public function getIdChef() {
        return $this->idChef;
    }

    public function setIdChef($idChef) {
        $this->idChef = $idChef;
    }

    public function getScore() {
        return $this->score;
    }

    public function setScore($score) {
        $this->score = $score; 
    }

    public function getIdBattle() {
        return $this->idBattle;
    }

    public function setIdBattle($idBattle) {
        $this->idBattle = $idBattle;
    }

    public function getLibelleProjet() {
        return $this->libelleProjet;
    }

    public function setLibelleProjet($libelleProjet) {
        $this->libelleProjet = $libelleProjet;
    }

    public function getLibelleDataChallenge() {
        return $this->libelleDataChallenge;
    }

    public function setLibelleDataChallenge($libelleDataChallenge) {
        $this->libelleDataChallenge = $libelleDataChallenge;
    }

    

}