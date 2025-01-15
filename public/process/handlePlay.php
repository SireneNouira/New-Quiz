<?php

require_once  '../../utils/autoloader.php';


try {
    $controller = new QuizController();
    var_dump($controller);
    $controller->handlePlayButton([
        'method' => $_SERVER['REQUEST_METHOD'],
        'post' => $_POST,
        'get' => $_GET,
    ]);
} catch (\Exception $e) {
    echo '<p>Erreur : ' . htmlspecialchars($e->getMessage()) . '</p>';
}
