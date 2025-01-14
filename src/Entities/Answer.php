<?php


final class Answer
{
    private int $id;
    private string $answer;
    private bool $isCorrect;

    public function __construct(int $id,string $answer, bool $isCorrect = false )
    {
        $this->id = $id;
        $this->answer = $answer;
        $this->isCorrect = $isCorrect;
    }
    public function getId(): int
    {
        return $this->id;
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