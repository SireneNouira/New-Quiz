<?php
include_once '../utils/autoloader.php';

session_start();

require_once './partials/header.php'
?>




<body>
<main>
      <div class="login-container">
        <div class="logo-container">
       <img src="./assets/imgs/quizzlogo.png" alt="logo" class="logomain">
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
</body>

<?php
require_once './partials/footer.php'
?>

