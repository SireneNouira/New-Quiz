<?php
include_once '../utils/autoloader.php';
session_start();

require '../utils/connect_db.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connexion'])) {
//     $pseudo = trim($_POST['pseudo']);
//     if (!empty($pseudo)) {
//         $stmt = $pdo->prepare("SELECT id FROM user WHERE pseudo = :pseudo");
//         $stmt->execute(['pseudo' => $pseudo]);
//         $user = $stmt->fetch();

//         if ($user) {
//             $_SESSION['user_id'] = $user['id'];
//         } else {
//             $stmt = $pdo->prepare("INSERT INTO user (pseudo) VALUES (:pseudo)");
//             $stmt->execute(['pseudo' => $pseudo]);
//             $_SESSION['user_id'] = $pdo->lastInsertId();
//         }

//     } 

//     header("Location: choixquizz.php?id={$_SESSION['user_id']}");
// }


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