<?php

namespace Model\Association;

class Posseder {
    private int $idProjet ; # foreign key vers la table projetData
    private int $idRessource ; # foreign key vers la table ressources


    public function getIdProjet(): int {
        return $this->idProjet;
    }

    public function setIdProjet(int $idProjet): void {
        $this->idProjet = $idProjet;
    }

    public function getIdRessource(): int {
        return $this->idRessource;
    }

    public function setIdRessource(int $idRessource): void {
        $this->idRessource = $idRessource;
    }
    
}