<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ht/core/core.php';
include 'includes/header.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Caminho para o autoload do Composer
$composerAutoload = $_SERVER['DOCUMENT_ROOT'] . '/ht/vendor/autoload.php';

// Verifique se o arquivo de autoload do Composer existe
if (file_exists($composerAutoload)) {
    require $composerAutoload;
} else {
    echo 'Erro: Autoload do Composer não encontrado. Certifique-se de ter executado "composer install" no seu projeto.';
    exit;
}

// Configurações de e-mail do Mailtrap
$mailtrap_host = 'sandbox.smtp.mailtrap.io';
$mailtrap_port = 2525;
$mailtrap_username = 'b36d9f582eaae0'; // Substitua pelo seu nome de usuário Mailtrap
$mailtrap_password = 'ae28d95883e5c2'; // Substitua pela sua senha Mailtrap

if (isset($_POST['reset_password'])) {
    $email = isset($_POST['email']) ? sanitize($_POST['email']) : '';

    // Validar o e-mail aqui...

    // Gerar um token de redefinição de senha
    $token = bin2hex(random_bytes(32));

    // Salvar o token no banco de dados junto com o e-mail do usuário
    $sql = $db->query("UPDATE users SET reset_token = '$token' WHERE email = '$email'");

    // Configuração do PHPMailer
    $phpmailer = new PHPMailer(true);

    $phpmailer->isSMTP();
    $phpmailer->Host = $mailtrap_host;
    $phpmailer->Port = $mailtrap_port;
    $phpmailer->SMTPAuth = true;
    $phpmailer->Username = $mailtrap_username;
    $phpmailer->Password = $mailtrap_password;
    $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // ou ENCRYPTION_SMTPS para SSL

    $phpmailer->setFrom('silvahigor52@yahoo.com.br', 'Glutén-Free');
    $phpmailer->addAddress($email);
    $phpmailer->Subject = 'Redefinir senha';
    $phpmailer->Body = "Clique no seguinte link para redefinir sua senha: http://localhost/ht/admin/redefinir_senha.php?token=$token";

    try {
        // Envia o e-mail
        $phpmailer->send();
        echo '<div class="w3-text-green text-center">Um link de redefinição de senha foi enviado para o seu e-mail.</div>';
    } catch (Exception $e) {
        echo '<div class="w3-text-red text-center">Erro ao enviar e-mail: ' . $phpmailer->ErrorInfo . '</div>';
    }
}
?>

<style>
  body {
    background-color: #343a4a; /* Altere para a cor desejada */
  }

  img.center {
    display: block;
    margin: 0 auto;
  }

  .reset-container {
    background-color: #fff; /* Cor de fundo branca */
    border-radius: 15px;
    padding: 20px;
    margin-top: 60px;
    width: 40%;
    height: 250px;
    margin: 0 auto;
  }
</style>

<div class="container" style="margin-top:15%">
  <div class="reset-container w3-card-12 w3-padding-large w3-white">
    <!-- Restante do seu código... -->

    <form role="form" action="esqueceu_senha.php" method="post" style="max-width: 300px; margin: 0 auto; margin-top:40px; margin-bottom:-40px">
        <div class="form-group">
            <label for="email">Email:</label>
            <input placeholder="@email.com" name="email" type="email" class="form-control" style="width: 100%;" />
        </div>

        <div class="form-group text-center">
            <input type="submit" name="reset_password" style="background-color:#df8352; width: 80%; margin-top: 20px;border-radius: 5px" class="w3-btn w3-btn-block w3-ripple" value="Redefinir Senha" />
        </div>
    </form>

    <!-- Restante do seu código... -->
  </div>
</div>

<footer class="container-fluid text-center w3-text-white">
    <a href="./login.php" title="To Top">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4z"/>
</svg>
                Voltar
    </a>
  </footer>

</body>
</html>
