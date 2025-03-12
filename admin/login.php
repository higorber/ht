<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ht/core/core.php';
include 'includes/header.php';
$email = (isset($_POST['email'])) ? sanitize($_POST['email']) : '';
$password = (isset($_POST['password'])) ? sanitize($_POST['password']) : '';
//Removing blank spaces from both ends of the Password or email
$email = trim($email);
$password = trim($password);
//$hashed = password_hash($password, PASSWORD_DEFAULT);
?>
<style>
  body {
    background-color: #343a4a;
  }

  img.center {
            display: block;
            margin: 0 auto;
        }
</style>
<div class="container">
  <div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
      <a class="navbar-brand" href="../index.php"><img src="../img/logo.png" class="center" style="width: 100px; height: auto; margin-top: -6px;  margin-left: 220%;"></a><br><br><br><br>
      <div id="admin_login" style="margin: 0 auto; margin-top: 60px; border-radius: 15px; width: 90%; height: 390px;" class="w3-card-12 w3-padding-large w3-white">
 <?php
        if (isset($_POST['login'])) {
          if (empty($_POST['email']) || empty($_POST['password'])) {
            echo '<div class="w3-text-red text-center" style="margin-top: -40px;">E-mail e senha são necessários para prosseguir.</div>';
          } else {
            //Ensuring password is 6 or more characters long
            if (strlen($password) < 6) {
              echo '<div class="w3-text-red text-center" style="margin-top: -40px;">a senha deve ter pelo menos 6 caracteres</div>';
            } else {
              //Check if Email exists in database
              $sql = $db->query("SELECT * FROM users WHERE email = '$email' ");
              $user = mysqli_fetch_assoc($sql);
              $count = mysqli_num_rows($sql);

              if ($count < 1) {
                echo '<div class="w3-text-red text-center" style="margin-top: -40px;">E-mail não encontrado no banco de dados.</div>';
              } else {
                // Certifique-se de que a coluna 'password' no banco de dados armazena hashes de senha
                $hashed_password_from_database = $user['password'];

                if (password_verify($password, $hashed_password_from_database)) {
                  // A senha está correta, permita o login
                  $userID = $user['id'];
                  echo '<script>console.log("' . $userID . '");</script>';
                  login($userID);
                } else {
                  // A senha que você digitou estava incorreta, exiba uma mensagem de erro
                  echo '<div class="w3-text-red text-center" style="margin-top: -40px;" >A senha que você digitou estava incorreta, tente novamente.</div>';
                }
              }
            }
          }
        }

        ?>
<h3 class="text-center" style="width: 100px;"></h3>
<form role="form" action="login.php" method="post" style="max-width: 300px; margin: 0 auto; margin-top:40px; margin-bottom:-40px">
  <div class="form-group">
    <label for="email">Email:</label>
    <input placeholder="@email.com" value="<?= $email; ?>" name="email" type="email" class="form-control" style="width: 100%;" />
  </div>

  <div class="form-group" style="margin-top:25px;">
    <label for="password">Senha:</label>
    <input type="password" name="password" class="form-control" placeholder="Senha" style="width: 100%;" />
  </div>
  <div class="form-group text-center">
  <input type="submit" name="login" style="background-color:#df8352; width: 80%; margin-top: 20px;border-radius: 5px" class="w3-btn w3-btn-block w3-ripple" value="Entrar" />

  <div class="form-group" style="display: flex; margin: 15px auto; margin-left:25%;">
    <a href="esqueceu_senha.php" class="w3-a">Esqueceu a senha?</a>
</div>


  </div>
</form>
<div class="form-group" style="display: flex; justify-content: space-between;margin-top:65px">
    <a href="./hospede.php" class="w3-a">Cadastre-se como Hóspede</a>
    <a href="./anfitriao.php" class="w3-a">Cadastre-se como Anfitrião</a>
  </div>

      </div>

    </div>
    <div class="col-md-3"></div>

  </div>
</div>
<div class="breaks">

  <footer class="container-fluid text-center w3-text-white">
  <a href="../index.php" title="To Top">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4z"/>
</svg>
                
    </a>

    <p>&copy; Copyright 2023-<?php echo date("Y"); ?> Glúten-free</a></p>
  </footer>

</div>

</body>

</html>