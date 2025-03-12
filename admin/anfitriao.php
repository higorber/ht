<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/ht/core/core.php';

include 'includes/header.php';
//include 'includes/navigation.php';

// Detalhes dos campos
$name = '';
$email = '';
$telefone = '';
$documento = '';
$role = '';
$password = '';
$password2 = '';
$joinDate = date("Y-m-d H:i:s");

// Código para registrar um novo administrador
if (isset($_POST['add'])) {
    // Verificar se todos os campos obrigatórios foram preenchidos
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['role']) && !empty($_POST['password'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $documento = $_POST['documento'];
        $role = $_POST['role'];

        if ($_POST['password'] == $_POST['password2']) {
            // Hashing da senha para segurança
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            // Inserir novo administrador no banco de dados
            $sql = "INSERT INTO users (full_name, email, telefone, documento, password, join_date, permissions) VALUES ('$name', '$email', '$telefone', '$documento', '$password', '$joinDate', '$role')";

            $insert = $db->query($sql);
            if ($insert) {
                $_SESSION['add_admin'] = 'Novo usuário adicionado com sucesso!';
                header("Location: users.php");
                exit;
            } else {
                echo '<div class="w3-red w3-center">Erro ao adicionar novo usuário</div>';
            }
        } else {
            echo '<div class="w3-red w3-center">As senhas não coincidem!</div>';
        }
    } else {
        echo '<div class="w3-red w3-center">Todos os campos com asterisco são obrigatórios!</div>';
    }
}

?>

<style>
  body {
    background-color: #343a4a;
  }

    .container {
            background-color: white;
            padding: 30px;
            margin: 125px auto;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
        }
    </style>

<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-6" style="text-align: center; margin-left:25%">
                <h2>Cadastro de Anfitrião</h2>
                <hr>
                <form action="anfitriao.php" method="POST" class="form" id="add_user">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" value="<?= $name; ?>" name="name" class="form-control" placeholder="Nome completo*">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="email" value="<?= $email; ?>" name="email" class="form-control" placeholder="E-mail do usuário*">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" value="<?= $telefone; ?>" name="telefone" class="form-control" placeholder="Telefone*">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" value="<?= $documento; ?>" name="documento" class="form-control" placeholder="Documento*"    >
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="role">Tipo de usuário:</label>
                            <select id="permission" name="role" class="form-control">
                                <!-- <option value="" selected>Selecione um tipo de usuário</option> -->
                                <option value="admin" <?php if ($role == 'admin') echo 'selected'; ?>>Anfitrião</option>
                                <!-- <option value="editor" <?php if ($role == 'editor') echo 'selected'; ?>>Hóspede</option> -->
                                <!-- <option value="editor,admin" <?php if ($role == 'editor,admin') echo 'selected'; ?>>Editor & Admin</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <input type="password" name="password" class="form-control" placeholder="Senha*">
                    </div>
                    <div class="col-sm-6 form-group">
                        <input type="password" name="password2" class="form-control" placeholder="Confirmar senha*">
                    </div>
                    <div class="col-sm-12">
                    <br>
                        <input style="background-color:#df8352; border: white; padding: 10px 20px;" type="submit" class="btn btn-info" name="<?= (isset($_GET['edit'])) ? 'edit' : 'add'; ?>" value="<?= (isset($_GET['edit'])) ? 'Editar usuário' : 'Cadastrar'; ?>">
                        <a href="./login.php" class="btn btn-info" style="background-color:#df8352; border: white; padding: 10px 20px;">⠀Voltar⠀</a>
                    </div>
                </form>
            </div>
        </div>
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