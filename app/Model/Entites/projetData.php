<?php

namespace Model\Entites;

class projetData{
    protected int $idProjet;
    protected string $libelle;
    protected string $description;
    protected string $lienImg;
    protected int $idDataChallenge;

    public function getIdProjet(): int {
        return $this->idProjet;
    }

    public function setIdProjet(int $idProjet): void {
        $this->idProjet = $idProjet;
    }
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

    public function getIdDataChallenge(): int {
        return $this->idDataChallenge;
    }

    public function setIdDataChallenge(int $idDataChallenge): void {
        $this->idDataChallenge = $idDataChallenge;
    }
}