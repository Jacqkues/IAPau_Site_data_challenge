<?php

namespace Model\Entites;

class Questionnaire{
    protected int $id;
    protected string $debut;
    protected string $fin;
    protected string $lien;
    protected int $idBattle;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdBattle() {
        return $this->idBattle;
    }

    public function setIdBattle($idBattle) {
        $this->idBattle = $idBattle;
    }

    public function getDebut() {
        return $this->debut;
    }

    public function setDebut($debut) {
        $this->debut = $debut;
    }

    public function getFin() {
        return $this->fin;
    }

    public function setFin($fin) {
        $this->fin = $fin;
    }

    public function getLien() {
        return $this->lien;
    }

    public function setLien($lien) {
        $this->lien = $lien;
    }
}