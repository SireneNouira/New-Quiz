<?php


final class Question
{
    private int $id;
    private string $wording;
    private array $answers;
    private string $explanation;

    public function __construct(int $id, string $wording, string $explanation)
    {
        $this->id = $id;        
        $this->wording = $wording;

        $this->answers = [];
        $this->explanation = $explanation;
    }


    public function getId(): int
    {
        return $this->id;
    } 

    public function getWording(): string
    {
        return $this->wording;
    }

    public function getAnswers(): array
    {
        return $this->answers;
    }

    public function getExplanation(): string
    {
        return $this->explanation;
    }

    public function setAnswers(array $answers): self
    {
        foreach ($answers as $answer) {
            if (!$answer instanceof Answer) {
                throw new Exception("Il faut que le tableau soit composé de Answer uniquement");
            }
        }

        $this->answers = $answers;

        return $this;
    }

}