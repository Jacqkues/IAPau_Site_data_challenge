<?php

namespace Model\Entites;

class dataChallenge{
    protected string $libelle;
    protected date $tempsDebut;
    protected date $tempsFin;

    public function getLibelle(): string {
        return $this->libelle;
    }
    public function setLibelle(string $libelle): void {
        $this->libelle = $libelle;
    }

    public function getTempsDebut(): date {
        return $this->tempsDebut;
    }

    public function setTempsDebut(date $tempsDebut): void {
        $this->tempsDebut = $tempsDebut;
    }

    public function getTempsFin(): date {
        return $this->tempsFin;
    }

    public function setTempsFin(date $tempsFin): void {
        $this->tempsFin = $tempsFin;
    }
}