<?php

namespace Model\Entites;

class Ressources{
    protected int $id;
    protected string $nom;
    protected string $lien;

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function getLien(): string {
        return $this->lien;
    }

    public function setLien(string $lien): void {
        $this->lien = $lien;
    }
}