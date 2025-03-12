<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ht/core/core.php';

// Verificar se o usuário está logado
if (!is_logged_in()) {
  login_error_check();
}

include 'includes/header.php';
include 'includes/navigation.php';
?>

<div class="w3-container w3-main" style="width: 1600px;">
  <header class="w3-container" style="background-color:#343a4a;">
    <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
    <h2 class="text-center" style="color:#fff;">Início</h2>
  </header>

  <?php if (permission()) : ?>
    <!-- Seção de boas-vindas -->
    <?php header("Location: solicitacoes.php"); ?>
  <?php endif; ?>

  <?php if (!permission()) : ?>
    <!-- Seção de boas-vindas -->
    <?php header("Location: reservations.php"); ?>
  <?php endif; ?>
</div>

<script>
  function w3_open() {
    document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
  }

  function w3_close() {
    document.getElementsByClassName("w3-sidenav")[0].style.display = "none";
  }
</script>

<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>

</html>