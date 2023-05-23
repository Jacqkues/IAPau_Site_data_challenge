<?php

namespace Model\Entites;

class Rendu{
   protected string $lien;
   protected string $dateRendu;
   protected int $idEquipe;

    public function getLien(): string {
         return $this->lien;
    }

    public function setLien(string $lien): void {
         $this->lien = $lien;
    }

    public function getDateRendu(): string {
         return $this->dateRendu;
    }

    public function setDateRendu(string $dateRendu): void {
         $this->dateRendu = $dateRendu;
    }

    public function getIdEquipe(): int {
         return $this->idEquipe;
    }

    public function setIdEquipe(int $idEquipe): void {
         $this->idEquipe = $idEquipe;
    }
}