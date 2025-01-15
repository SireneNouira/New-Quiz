<?php
include_once '../utils/autoloader.php';

session_start();

require_once './partials/header.php';

$qcmManager = new QcmManager;


?>




<?= $qcmManager->generateQcm($_GET['quiz_id']) ?>




<?php
require_once './partials/footer.php'
?>
