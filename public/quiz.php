<?php
include_once '../utils/autoloader.php';

require_once './partials/header.php';

$qcmManager = new QcmManager;
$qcmController = new QuizController;
$qcmController->initializeQuizSession($_GET['quiz_id']);
?>




<?=$qcmManager->generateQcm($_GET['quiz_id']) ?>




<?php
require_once './partials/footer.php'
?>