<?php


class QuizController
{
    public function handlePlayButton(array $request): void
    {
        if ($request['method'] === 'POST' && isset($request['post']['jouer'])) {
            $userId = intval($request['get']['id'] ?? 0);
            $quizId = intval($request['post']['quiz_id'] ?? 0);

            if ($quizId > 0) {
                header("Location: ../../public/quiz.php?user_id={$userId}&quiz_id={$quizId}");
                exit;
            }

            throw new \InvalidArgumentException('ID du quiz manquant ou invalide.');
        }
    }
}
