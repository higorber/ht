<?php
session_start();

// Cria a conexão com o banco de dados
$db = new mysqli('localhost', 'root', '', 'hotel_db');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/ht/config.php';
require_once BASEURL . 'helpers/helpers.php';
include BASEURL . 'fpdf/fpdf.php';

if (isset($_SESSION['casf_user'])) {
    $userID = $_SESSION['casf_user'];
    $sql = $db->query("SELECT * FROM users WHERE id = '$userID' ");
    $user_info = mysqli_fetch_assoc($sql);
    $fn = explode(' ', $user_info['full_name']);
    @$user_info['first'] = $fn[0];
    @$user_info['last'] = $fn[1];
}

if (isset($_SESSION['error_flash'])) {
    echo '<div class="w3-black w3-center">' . $_SESSION['error_flash'] . '</div> ';
    unset($_SESSION['error_flash']);
}

if (isset($_SESSION['user_adding_error'])) {
    echo '<div class="w3-red w3-center">' . $_SESSION['user_adding_error'] . '</div> ';
    unset($_SESSION['user_adding_error']);
}

if (isset($_SESSION['logged_in'])) {
    echo '<div class="w3-green w3-center">' . $_SESSION['logged_in'] . '</div> ';
    unset($_SESSION['logged_in']);
}

if (isset($_SESSION['tour_success'])) {
    echo '<div class="w3-green w3-center">' . $_SESSION['tour_success'] . '</div> ';
    unset($_SESSION['tour_success']);
}

if (isset($_SESSION['room_success'])) {
    echo '<div class="w3-green w3-center">' . $_SESSION['room_success'] . '</div> ';
    unset($_SESSION['room_success']);
}

if (isset($_SESSION['room_erro'])) {
    echo '<div class="w3-red w3-center">' . $_SESSION['room_erro'] . '</div> ';
    unset($_SESSION['room_erro']);
}

if (isset($_SESSION['add_admin'])) {
    echo '<div class="w3-green w3-center">' . $_SESSION['add_admin'] . '</div> ';
    unset($_SESSION['add_admin']);
}

if (isset($_SESSION['permission_error'])) {
    echo '<div class="w3-red w3-center">' . $_SESSION['permission_error'] . '</div> ';
    unset($_SESSION['permission_error']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    @$name = sanitize($_POST['name']);
    @$email = sanitize($_POST['email']);
    @$telefone = sanitize($_POST['telefone']);
    @$documento = sanitize($_POST['documento']);
    @$endereco = sanitize($_POST['endereco']);
    @$observacao = sanitize($_POST['observacao']);
    @$celiaco = sanitize($_POST['celiaco']);
    @$role = sanitize($_POST['role']);
    @$password = sanitize($_POST['password']);
    @$password2 = sanitize($_POST['password2']);
    @$joinDate = date("Y-m-d H:i:s");

    if (isset($_POST['add'])) {
        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['role']) && !empty($_POST['password'])) {
            if ($_POST['password'] == $_POST['password2']) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (full_name, email, telefone, documento, password, join_date, permissions, last_login, endereco, observacao, celiaco) VALUES ('$name', '$email', '$telefone','$documento','$password', '$joinDate', '$role', NOW(), '$endereco', '$observacao', '$celiaco')";
                $insert = $db->query($sql);
                if ($insert) {
                    $_SESSION['add_admin'] = 'Novo usuário adicionado com sucesso!';
                    header("Location: users.php");
                    exit;
                } else {
                    echo '<div class="w3-red w3-center">Erro ao adicionar novo usuário</div>';
                }
            } else {
                echo '<div class="w3-red w3-center">Senhas não coincidem</div>';
            }
        } else {
            echo '<div class="w3-red w3-center">Todos os campos são obrigatórios</div>';
        }
    } elseif (isset($_POST['edit'])) {
        $toEditID = $_POST['edit'];
        $name = sanitize($_POST['name']);
        $email = sanitize($_POST['email']);
        $telefone = sanitize($_POST['telefone']);
        $documento = sanitize($_POST['documento']);
        $endereco = sanitize($_POST['endereco']);
        $observacao = sanitize($_POST['observacao']);
        $celiaco = sanitize($_POST['celiaco']);
        $role = sanitize($_POST['role']);
        
        $sql = "UPDATE users SET full_name='$name', email='$email', telefone='$telefone', documento='$documento', permissions='$role' , endereco='$endereco', observacao='$observacao', celiaco='$celiaco' WHERE id='$toEditID'";
        $update = $db->query($sql);
        if ($update) {
            $_SESSION['add_admin'] = 'Usuário atualizado com sucesso!';
            header("Location: users.php");
            exit;
        } else {
            echo '<div class="w3-red w3-center">Erro ao atualizar o usuário</div>';
        }
    }
}

if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $toEditID = $_GET['edit'];
    $myedit = $db->query("SELECT * FROM users WHERE id = '$toEditID' ");
    $edit = mysqli_fetch_assoc($myedit);
}
?>
