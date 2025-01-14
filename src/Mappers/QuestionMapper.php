<?php


class QuestionMapper
{
    public function mapToObject(array $data): Question
    {
        return new Question(
            $data['id'],
            $data['wording'],
            $data['explanation']
        );
    }
}
