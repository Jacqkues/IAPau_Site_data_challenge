<?php

namespace Model\Association;

class Lier{
    private int $idUser;
    private int $idProjet;

    public function getIdUser(): int {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): void {
        $this->idUser = $idUser;
    }

    public function getIdProjet(): int {
        return $this->idProjet;
    }

    public function setIdProjet(int $idProjet): void {
        $this->idProjet = $idProjet;
    }
}