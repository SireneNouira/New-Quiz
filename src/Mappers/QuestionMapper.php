<?php


class QuestionMapper implements MapperInterface
{
    public static function mapToObject(array $data): Question
    {
        return new Question(
            $data['id'],
            $data['wording'],
            $data['explanation']
        );
    }
}
