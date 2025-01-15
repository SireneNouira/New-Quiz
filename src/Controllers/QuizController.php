<?php
include_once '../../utils/autoloader.php';

class QuizController
{ // fonction pour choixquiz.php
 
    public function handlePlayButton(array $request): void
    {
        if ($request['method'] === 'POST' && isset($request['post']['jouer'])) {
            // $userId = intval($request['get']['id'] ?? 0);
            $quizId = intval($request['post']['quiz_id'] ?? 0);

            if ($quizId > 0) {
                header("Location: ../../public/quiz.php?quiz_id={$quizId}");
                exit;
            }

            throw new \InvalidArgumentException('ID du quiz manquant ou invalide.');
        }
    }
//pour quiz.php

    // Vérifie si les paramètres sont présents dans la requête
    public function validateRequestParams(array $request): void
    {
        if ( !isset($request['get']['quiz_id'])) {
            die('ID manquant');
        }
    }

    // Gère l'initialisation de la session pour un quiz
    public function initializeQuizSession(int $quizId): void
    {
        // Si le quiz est terminé ou que l'ID du quiz est différent, on réinitialise la session
        if (!isset($_SESSION['current_quiz_id']) || $_SESSION['current_quiz_id'] != $quizId || isset($_SESSION['quiz_finished'])) {
            $_SESSION['current_quiz_id'] = $quizId;  // Stocke l'ID du quiz en session
            $_SESSION['current_question'] = 0;       // Démarre à la première question
            $_SESSION['score'] = 0;                  // Réinitialise le score
            unset($_SESSION['quiz_finished']);       // Supprime l'indicateur de fin de quiz
        }
    }

    // Vérifie si le quiz est terminé
    public function isQuizFinished(int $currentIndex, int $totalQuestions): bool
    {
        if ($currentIndex >= $totalQuestions) {
            $_SESSION['quiz_finished'] = true;
            return true;
        }
        return false;
    }

    // Gère le passage à la question suivante
    public function nextQuestion(): void
    {
        $currentIndex = $_SESSION['current_question'];


if ($currentIndex >= count($questions)) {
    $finished = true; 
    $_SESSION['quiz_finished'] = true;
} else {
    $finished = false;
    $currentQuestion = $questions[$currentIndex];

  
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['suivant'])) {

    $_SESSION['current_question']++;
}



        session_start();
        $quizId = $_SESSION[$_GET['quiz_id']];

        var_dump($_SESSION);
        header("Location: ../../public/quiz.php?quiz_id={$quizId}");
       
    }
}
}