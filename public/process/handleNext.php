<?php

require_once  '../../utils/autoloader.php';


try {
    $controller = new QuizController();
    $controller->nextQuestion([
        'method' => $_SERVER['REQUEST_METHOD'],
        'post' => $_POST,
        'get' => $_GET,
    ]);
} catch (\Exception $e) {
    echo '<p>Erreur : ' . htmlspecialchars($e->getMessage()) . '</p>';
}
