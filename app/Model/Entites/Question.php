<?php

namespace Model\Entites;

class Question{
   protected int $idQuestion;
   protected string $question;
   protected int $idQuestionnaire;

    public function getIdQuestion(): int {
         return $this->idQuestion;
    }

    public function setIdQuestion(int $id): void {
         $this->idQuestion = $id;
    }

    public function getQuestion(): string {
         return $this->question;
    }

    public function setQuestion(string $question): void {
         $this->question = $question;
    }

    public function getIdQuestionnaire(): int {
         return $this->idQuestionnaire;
    }

    public function setIdQuestionnaire(int $idQuestionnaire): void {
         $this->idQuestionnaire = $idQuestionnaire;
    }
}