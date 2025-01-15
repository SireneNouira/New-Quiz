<?php
include_once '../utils/autoloader.php';
require '../utils/connect_db.php';
session_start();

$qcmManager = new QcmManager();

require_once './partials/header.php'
?>

  <?= $qcmManager->generateQcm(1) ?>

<?php
require_once './partials/footer.php'
?>