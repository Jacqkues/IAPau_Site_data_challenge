<?php
namespace Model\Entites;

class messagerie
{
    protected int $idMessagerie;
    protected int $idAuteur;
    protected string $types;
    protected string $contenu;
    protected string $dateEnvoi;
    protected string $categorie = "GENERAL";
    protected string $objet;

    public function getIdMessagerie(): int
    {
        return $this->idMessagerie;
    }
    public function setIdMessagerie(int $idMessagerie): void
    {
        $this->idMessagerie = $idMessagerie;
    }

    public function getIdAuteur(): int
    {
        return $this->idAuteur;
    }
    public function setIdAuteur(int $idAuteur): void
    {
        $this->idAuteur = $idAuteur;
    }
    public function getTypes(): string
    {
        return $this->types;
    }
    public function setTypes(string $types): void
    {
        $this->types = $types;
    }
    public function getContenu(): string
    {
        return $this->contenu;
    }
    public function getObjet(): string
    {
        return $this->objet;
    }
    public function setContenu(string $contenu): void
    {
        $this->contenu = $contenu;
    }
    public function getDateEnvoi(): string
    {
        return $this->dateEnvoi;
    }
    public function setDateEnvoi(string $dataEnvoi): void
    {
        $this->dateEnvoi = $dataEnvoi;
    }
    public function getCategorie(): string
    {
        return $this->categorie;
    }
    public function setCategorie(string $categorie): void
    {
        $this->categorie = $categorie;
    }
    public function setObjet(string $objet): void
    {
        $this->objet = $objet;
    }
}