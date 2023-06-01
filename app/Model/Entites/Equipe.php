<?php

namespace Model\Entites;

class Equipe
{
    protected int $id;

    protected string $nom;
    protected int $idChef; #foreign key vers la table user
    protected int $score;
    protected int $idBattle; #foreign key vers la table dataBattle
    protected int $idProjet; #foreign key vers la table projetData
    protected int $idDataChallenge; #foreign key vers la table projetData

    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdChef()
    {
        return $this->idChef;
    }

    public function setIdChef($idChef)
    {
        $this->idChef = $idChef;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function setScore($score)
    {
        $this->score = $score;
    }

    public function getIdBattle()
    {
        return $this->idBattle;
    }

    public function setIdBattle($idBattle)
    {
        $this->idBattle = $idBattle;
    }

    public function getIdProjet(): int
    {
        return $this->idProjet;
    }

    public function setIdProjet($idProjet)
    {
        $this->idProjet = $idProjet;
    }

    public function getIdDataChallenge()
    {
        return $this->idDataChallenge;
    }

    public function setIdDataChallenge($idDataChallenge)
    {
        $this->idDataChallenge = $idDataChallenge;
    }
}