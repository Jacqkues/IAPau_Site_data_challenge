<?php

namespace Model\Entites;

class dataBattle{
    protected int $idBattle;
    protected string $debut;
    protected string $fin;
    protected string $libelleBattle;

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

    public function setLibelleBattle(string $libelleBattle) {
        $this->libelleBattle = $libelleBattle;
    }

    public function getLibelleBattle() {
        return $this->libelleBattle;
    }


}