<?php
namespace Model\Entites;
date_default_timezone_set('UTC');

class User
{
    protected int $id;
    protected string $type;
    protected string $nom;
    protected string $prenom;
    protected string $etablissement;
    protected string $nivEtude;
    protected string $numTel;
    protected string $mail;
    protected string $dateDeb;
    protected string $dateFin;
    protected string $mdp;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function getEtablissement(): string
    {
        return $this->etablissement;
    }

    public function setEtablissement(string $etablissement): void
    {
        $this->etablissement = $etablissement;
    }

    public function getNivEtude(): string
    {
        return $this->nivEtude;
    }

    public function setNivEtude(string $nivEtude): void
    {
        $this->nivEtude = $nivEtude;
    }

    public function getNumTel(): string
    {
        return $this->numTel;
    }

    public function setNumTel(string $numTel): void
    {
        $this->numTel = $numTel;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    public function getDateDeb(): string
    {
        return $this->dateDeb;
    }

    public function setDateDeb(string $dateDeb): void
    {
        $this->dateDeb = $dateDeb;
    }

    public function getDateFin(): string
    {
        return $this->dateFin;
    }

    public function setDateFin(string $dateFin): void
    {
        $this->dateFin = $dateFin;
    }

    public function getMdp(): string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): void
    {
        $this->mdp = $mdp;
    }
}