<?php

namespace Model\Entites;

class Reponse{
   protected int $idQuestion;
   protected string $reponse;
   protected int $idReponse;
   protected int $idEquipe;
   protected bool $note;


     public function getNote(): bool {
          return $this->note;
     }

     public function setNote(bool $note): void {
          $this->note = $note;
     }
    public function getIdQuestion(): int {
         return $this->idQuestion;
    }

    public function setIdQuestion(int $id): void {
         $this->idQuestion = $id;
    }

    public function getReponse(): string {
         return $this->reponse;
    }

    public function setReponse(string $reponse): void {
         $this->reponse = $reponse;
    }

    public function getIdReponse(): int {
         return $this->idReponse;
    }

    public function setIdReponse(int $idReponse): void {
         $this->idReponse = $idReponse;
    }

    public function getIdEquipe(): int {
        return $this->idEquipe;
   }

   public function setIdEquipe(int $idEquipe): void {
        $this->idEquipe = $idEquipe;
   }
}