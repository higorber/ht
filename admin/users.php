<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/ht/core/core.php';

if (!is_logged_in()) {
    login_error_check();
}
if (!permission()) {
    permission_error();
}

include 'includes/header.php';
include 'includes/navigation.php';
$sql = "SELECT * FROM users";
$result = $db->query($sql);
$row_count = 1; // Contador de linhas

// Detalhes dos campos
$name = '';
$email = '';
$role = '';
$password = '';
$password2 = '';
$joinDate = date("Y-m-d H:i:s");

// Código para registrar um novo administrador
if (isset($_POST['add'])) {
    // Verificar se todos os campos obrigatórios foram preenchidos
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['role']) && !empty($_POST['password'])) {
        if ($_POST['password'] == $_POST['password2']) {
            // Hashing da senha para segurança
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            // Inserir novo administrador no banco de dados
            $sql = "INSERT INTO users (full_name, email, password, join_date, permissions) VALUES ('$name', '$email', '$password', '$joinDate', '$role')";

            $insert = $db->query($sql);
            if ($insert) {
                $_SESSION['add_admin'] = 'New user successfully added!';
                header("Location: users.php");
                exit;
            } else {
                echo '<div class="w3-red w3-center">Error adding new user</div>';
            }
        } else {
            echo '<div class="w3-red w3-center">Passwords do not match!</div>';
        }
    } else {
        echo '<div class="w3-red w3-center">All fields with an asterisks are required!</div>';
    }
}

// Código para excluir um usuário do banco de dados
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $toDeleteID = $_GET['delete'];
    $delete = $db->query("DELETE FROM users WHERE id = '$toDeleteID'");
    $_SESSION['add_admin'] = 'Usuário excluído com sucesso!';
    header("Location: users.php");
    exit;
}

// Código para editar um usuário (atualizar no banco de dados)
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $toEditID = $_GET['edit'];
    $myedit = $db->query("SELECT * FROM users WHERE id = '$toEditID'");
    $edit = mysqli_fetch_assoc($myedit);
    $name = $edit['full_name'];
    $email = $edit['email'];
    $role = $edit['permissions'];
}

?>
<div class="w3-container w3-main" style="margin-left:200px">
    <header class="w3-container" style="background-color:#343a4a;">
        <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
        <h2 class="text-center" style="color:white">Usuário</h2>
    </header>

    <div class="row">
        <div class="col-md-6">
            <h3 class="">Novo formulário de usuário</h3>
            <hr>
            <form action="users.php" method="POST" class="form" id="add_user">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" value="<?= $name; ?>" name="name" class="form-control" placeholder="Nome completo*">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="email" value="<?= $email; ?>" name="email" class="form-control" placeholder="E-mail do usuário*">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="role">Função do usuário*:</label>
                        <select id="permission" name="role" class="form-control">
                            <option value="" selected>Selecione uma função de usuário</option>
                            <option value="admin" <?php if ($role == 'admin') echo 'selected'; ?>>Admin</option>
                            <option value="editor" <?php if ($role == 'editor') echo 'selected'; ?>>Editor</option>
                            <option value="editor,admin" <?php if ($role == 'editor,admin') echo 'selected'; ?>>Editor & Admin</option>
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
                    <input type="submit" class="btn btn-info" name="<?= (isset($_GET['edit'])) ? 'edit' : 'add'; ?>" value="<?= (isset($_GET['edit'])) ? 'Editar usuário' : 'Adicionar usuário'; ?>">
                    <?php if (isset($_GET['edit'])): ?>
                        <a href="users.php" class="btn btn-info">Cancelar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <h3>Tabela de usuários</h3>
            <table class="table table-striped table-condensed table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Funções</th>
                        <th>Último login</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rows = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row_count++; ?></td>
                            <td><?= $rows['full_name']; ?></td>
                            <td><?= $rows['permissions']; ?></td>
                            <td><?= $rows['last_login']; ?></td>
                            <td>
                                <a href="users.php?delete=<?= $rows['id']; ?>" class="w3-btn w3-small w3-red"><span class="glyphicon glyphicon-trash"></span></a>
                                <a href="users.php?edit=<?= $rows['id']; ?>" class="w3-btn w3-small w3-blue"><span class="glyphicon glyphicon-edit"></span></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
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

