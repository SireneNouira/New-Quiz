<?php


class AnswerMapper
{
    public function mapToObject(array $data): Answer
    {
        return new Answer(
            $data['id'],
            $data['answer'],
            $data['id_question'],
            $data['isCorrect']
        );
    }
}
