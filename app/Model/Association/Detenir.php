<?php

namespace Model\Association;

class Detenir {
    private string $libelleData ; # foreign key vers la table projetData
    private int $idRessource ; # foreign key vers la table ressources


    public function getLibelleData(): string {
        return $this->libelleData;
    }

    public function setLibelleData(string $libelleData): void {
        $this->libelleData = $libelleData;
    }

    public function getIdRessource(): int {
        return $this->idRessource;
    }

    public function setIdRessource(int $idRessource): void {
        $this->idRessource = $idRessource;
    }
    
}