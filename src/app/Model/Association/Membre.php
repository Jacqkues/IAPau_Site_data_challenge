<?php

namespace Model\Association;

class Membre{
    private int $idEquipe;
    private int $idUser;

    public function getIdEquipe(): int {
        return $this->idEquipe;
    }

    public function setIdEquipe(int $idEquipe): void {
        $this->idEquipe = $idEquipe;
    }

    public function getIdUser(): int {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): void {
        $this->idUser = $idUser;
    }
}