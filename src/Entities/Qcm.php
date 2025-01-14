<?php

final class Qcm
{
    private int $id;
    private string $theme;
    private array $questions;

    public function __construct(int $id, string $theme )
    {
        $this->id = $id;
        $this->theme = $theme;
        $this->questions = [];
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getTheme(): string
    {
        return $this->theme;
    }

    public function getQuestions(): array
    {
        return $this->questions;
    }

    public function setQuestions(array $questions): self
    {
        foreach ($questions as $question) {
            if (!$question instanceof Question) {
                throw new Exception("Il faut que le tableau soit composé de Question uniquement");
            }
        }

        $this->questions = $questions;

        return $this;
    }

    public function addQuestion(Question $question): self
    {
        $this->questions[] = $question;
        return $this;
    }

    public function removeQuestion(Question $removeQuestion)
    {
        foreach ($this->questions as $key => $qcmQuestion) {
            if ($qcmQuestion === $removeQuestion) {
                unset($this->questions[$key]);
            }
        }

        // Puis on ré-index le tableau
        $this->questions = array_values($this->questions);
    }
}