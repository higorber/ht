<?php

ini_set('error_reporting', E_ALL & ~E_NOTICE);

//inicia o session para pegar o id do usuário
session_start();

//pega o id do usuário e atribui para variável
if (isset($_SESSION['casf_user'])) {
  $userID = $_SESSION['casf_user'];
}

// Obtém o nome da página atual
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="icon" type="imagem/png" href="./img/logo.png"/>
</head>

<body>  
 <!-- Navigation -->
 <nav class="navbar navbar-expand-xl navbar-dark fixed-top" style="background-color: #343a4a;height: 75px; ">
  <div class="container nav-wrapper">
    <a class="navbar-brand" href="index.php"><img src="./img/logo.png" style="width: 70px; height: auto; margin-top: -8px; margin-left: -150px;" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item <?php echo ($current_page === 'index.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="index.php">Início
            <span class="sr-only">(atual)</span>
          </a>
        </li>
        <li class="nav-item <?php echo ($current_page === 'rooms.php') ? 'active' : ''; ?>">
          <a class="nav-link" href="rooms.php">Hospedagens</a>
        </li>


        <?php if (!empty($userID)) : ?>
          <!-- Mostrar a opção "Painel" quando o userID tem valor -->
          <li class="nav-item">
            <a class="nav-link" href="./admin">Reservas</a>
          </li>
        <?php else : ?>
          <!-- Mostrar o div de login quando o userID está nulo -->
          <div id="login-div">
            <!-- Aqui você pode adicionar seu formulário de login -->
            <!-- Por exemplo, um botão para abrir o formulário de login em um modal -->
            <li class="nav-item">
            <a class="nav-link" href="../../ht/admin/login.php">Login</a>
            </li>
          </div>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
        </body>
      
        </htlm>

