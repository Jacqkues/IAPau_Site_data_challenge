<?php

namespace Model\Entites;

class projetData{
    protected string $libelle;
    protected string $description;
    protected string $lienImg;
    protected string $libelleDataChallenge;

    public function getLibelle(): string {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): void {
        $this->libelle = $libelle;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getLienImg(): string {
        return $this->lienImg;
    }

    public function setLienImg(string $lienImg): void {
        $this->lienImg = $lienImg;
    }

    public function getLibelleDataChallenge(): string {
        return $this->libelleDataChallenge;
    }

    public function setLibelleDataChallenge(string $libelleDataChallenge): void {
        $this->libelleDataChallenge = $libelleDataChallenge;
    }
}