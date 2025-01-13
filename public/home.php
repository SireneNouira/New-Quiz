<?php
include_once '../utils/autoloader.php';
session_start();

// require './utils/connect_db.php';

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
     

$qcm = new Qcm('musique');
$question = new Question('quel est la capitale de la France', 'La cap est Paris');
$answer1 = new Answer('rome');
$answer2 = new Answer('paris', true);
$question2 = new Question("quel est la capitale de l'italie", 'La cap est Rome');
$answer3 = new Answer('rome', true);
$answer4 = new Answer('paris');

$qcm->addQuestion($question)->addQuestion($question2);
$question2->addAnswer($answer3)->addAnswer($answer4);
$question->addAnswer($answer1)->addAnswer($answer2);





$qcmManager = new QcmManager();
echo $qcmManager->generateDisplay($qcm);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="./assets/styles/style.css">
</head>
<body>
    <header>
      <div class="logo">
        <img src="assets/imgs/quizzlogo.png" alt="logo">
      </div>
      <nav>
        <ul>
          <li><a href="#">A propos</a></li>
          <li><a href="#">Scores</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </nav>
    </header>
    
    <main>
      <div class="login-container">
        <div class="logo-container">
       <img src="assets/imgs/quizzlogo.png" alt="logo" class="logomain">
        </div>
     <form class="input-field" method="POST" action="">
        <label for="pseudo" >Pseudo :</label>
        <input type="text" name="pseudo" placeholder="PSEUDO..." class="input-field" id="pseudo" required>
       <button type="submit" name='connexion' class="login-btn" >Se connecter</button>
    </form>
        <!-- <input type="text" placeholder="PSEUDO..." class="input-field">
        <div class="divloginbutton">      
          <a href="choixquizz.html" class="login-btn">CONNEXION</a>
        </div>   -->
      </div>
    </main>
  
    <footer>
      <div class="footer-text">JOUEZ - APPRENEZ - PROGRESSEZ</div>
    </footer>
  </body>
  </html>
