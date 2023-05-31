<?php

namespace Model\Entites;

class dataChallenge{
    protected int $idChallenge;
    protected string $libelle;
    protected string $tempsDebut;
    protected string $tempsFin;

    protected string $isPublied;

    protected string $type;

    public function getType(): string {
        return $this->type;
    }

    public function setType(string $type): void {
        $this->type = $type;
    }

    public function getIsPublied(): string {
        return $this->isPublied;
    }

    public function setIsPublied(string $isPublied): void {
        $this->isPublied = $isPublied;
    }

    public function getIdChallenge() : int{
        return $this->idChallenge;
    }
    public function setIdChallenge(int $idChallenge) : void{
        $this->idChallenge = $idChallenge;
    }
    public function getLibelle(): string {
        return $this->libelle;
    }
    public function setLibelle(string $libelle): void {
        $this->libelle = $libelle;
    }

    public function getTempsDebut(): string {
        return $this->tempsDebut;
    }

    public function setTempsDebut(string $tempsDebut): void {
        $this->tempsDebut = $tempsDebut;
    }

    public function getTempsFin(): string {
        return $this->tempsFin;
    }

    public function setTempsFin(string $tempsFin): void {
        $this->tempsFin = $tempsFin;
    }
}