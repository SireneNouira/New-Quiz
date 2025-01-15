<?php
include_once '../utils/autoloader.php';

session_start();

$qcmManager = new QcmManager();

require_once './partials/header.php'
?>



<?= $qcmManager->displayAllQcm()?>







 


  <?php
require_once './partials/footer.php'
?>
