<?php

namespace Model\Association;

class Posseder {
    private string $libelleProjet ; # foreign key vers la table projetData
    private int $idRessource ; # foreign key vers la table ressources


    public function getLibelleProjet(): string {
        return $this->libelleProjet;
    }

    public function setLibelleProjet(string $libelleProjet): void {
        $this->libelleProjet = $libelleProjet;
    }

    public function getIdRessource(): int {
        return $this->idRessource;
    }

    public function setIdRessource(int $idRessource): void {
        $this->idRessource = $idRessource;
    }
    
}