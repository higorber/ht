<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ht/core/core.php';
include 'includes/header.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verifique se o token é válido no banco de dados
    $result = $db->query("SELECT * FROM users WHERE reset_token = '$token'");

    if ($result->num_rows > 0) {
        // O token é válido, permita que o usuário redefina a senha
        if (isset($_POST['nova_senha']) && isset($_POST['confirmar_senha'])) {
            $novaSenha = sanitize($_POST['nova_senha']);
            $confirmarSenha = sanitize($_POST['confirmar_senha']);

            if ($novaSenha === $confirmarSenha) {
                // Hash da nova senha
                $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

                // Atualize a senha no banco de dados
                $row = $result->fetch_assoc();
                $userId = $row['id'];
                $db->query("UPDATE users SET password = '$senhaHash', reset_token = NULL WHERE id = $userId");

                echo '<div class="w3-text-green text-center">Senha redefinida com sucesso.</div>';
            } else {
                echo '<div class="w3-text-red text-center">As senhas não coincidem.</div>';
            }
        }

        // Formulário para inserir a nova senha
        echo '
        <body style="background-color:#343a4a">
            <div class="container" style="margin-top:15%; max-width: 550px;position: relative;">
                <div class="reset-container w3-card-12 w3-padding-large w3-white" style="border-radius: 15px;">
                    <form role="form" action="redefinir_senha.php?token=' . $token . '" method="post" style="max-width: 300px; margin: 0 auto; margin-top:40px; margin-bottom:30px; ">
                        <div class="form-group">
                            <label for="nova_senha">Nova Senha:</label>
                            <input placeholder="Nova senha aqui" name="nova_senha" type="password" class="form-control" style="width: 100%;" required />
                        </div>

                        <div class="form-group">
                            <label for="confirmar_senha">Confirmar Senha:</label>
                            <input placeholder="Repita a nova senha aqui" name="confirmar_senha" type="password" class="form-control" style="width: 100%;" required />
                        </div>

                        <div class="form-group text-center">
                            <input type="submit" name="redefinir_senha" style="background-color:#df8352; width: 80%; margin-top: 20px;border-radius: 5px" class="w3-btn w3-btn-block w3-ripple" value="Redefinir Senha" />
                        </div>
                    </form>
                </div>
            </div>';
    } else {
        echo '<div class="w3-text-red text-center">Link inválido ou expirado.</div>';
    }
} else {
    echo '<div class="w3-text-red text-center">Token de redefinição de senha ausente.</div></body>';
}

?>
