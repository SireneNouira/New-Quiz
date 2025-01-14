<?php


class AnswerMapper implements MapperInterface
{
    public static function mapToObject(array $data): Answer
    {
        return new Answer(
            $data['id'],
            $data['answer'],
            $data['isCorrect']
        );
    }
}
