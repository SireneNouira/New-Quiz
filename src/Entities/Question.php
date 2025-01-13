<?php


final class Question
{
    private string $wording;
    private array $answers;
    private string $explanation;

    public function __construct(string $wording, string $explanation)
    {
        $this->wording = $wording;
        $this->answers = [];
        $this->explanation = $explanation;
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


    public function addAnswer(Answer $answer): self
    {
        $this->answers[] = $answer;
        return $this;
    }

    public function removeAnswer(Answer $removeAnswer)
    {
        foreach ($this->answers as $key => $questionAnswer) {
            if ($questionAnswer === $removeAnswer) {
                unset($this->answers[$key]);
            }
        }

        // Puis on ré-index le tableau
        $this->answers = array_values($this->answers);
    }
}