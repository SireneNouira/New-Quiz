<?php
include_once '../utils/autoloader.php';
require '../utils/connect_db.php';
session_start();

$qcmManager = new QcmManager();

require_once './partials/header.php'
?>

<main>
  <section>
  <?= $qcmManager->generateQcm(1) ?>
  </section>
</main>

<?php
require_once './partials/footer.php'
?>