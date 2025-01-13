<?php


final class Answer
{
    private string $answer;
    private bool $isCorrect;

    public function __construct(string $answer, bool $isCorrect = false )
    {
        $this->answer = $answer;
        $this->isCorrect = $isCorrect;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function getIsCorrect() : bool 
    {
        return $this->isCorrect;
    }
}