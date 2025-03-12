<?php

// Ignorar erro de sessão
ini_set('error_reporting', E_ALL & ~E_NOTICE);


// Inicia a sessão para obter o ID do usuário
session_start();

// Obtém o ID do usuário e atribui à variável
if (isset($_SESSION['casf_user'])) {
    $userID = $_SESSION['casf_user'];

    // Obtém os dados do usuário do banco de dados
    require_once 'core/core.php';  // Certifique-se de que este arquivo está no caminho correto
    $queryUser = $db->query("SELECT * FROM users WHERE id = '{$userID}' ");
    $usuario = mysqli_fetch_assoc($queryUser);
}

require_once 'core/core.php';  // Certifique-se de que este arquivo está no caminho correto
include 'includes/header.php';
include 'includes/navigation.php';

if (isset($_GET['room'])) {
    $roomID = $_GET['room'];

    $select = $db->query("SELECT * FROM rooms WHERE id = '{$roomID}' ");

    ####################################################################################

    if (isset($_POST['checkin'])) {
        if (empty($_SESSION['casf_user'])) {
            $_SESSION['room_erro'] = 'Efetue login para realizar reserva!';
            header("Location: admin/login.php");
        }

        $checkin = $_POST['in_date'];
        $checkout = $_POST['out_date'];

        $selectReservation = $db->query("SELECT * FROM reservations WHERE rooms_id = '{$roomID}' and checkout between '{$checkin}' and '{$checkout}'");
        $selectPermission = $db->query("SELECT permissions FROM users WHERE id = '{$userID}' ");
        $permissionData = mysqli_fetch_assoc($selectPermission);

        $people = $_POST['people'];

        $r_number = mysqli_fetch_assoc($select);
        $r = $r_number['room_number'];
        $host = $r_number['host'];

        if (!empty($_POST['in_date']) && !empty($_POST['out_date']) && !empty($_POST['people'])) {


            $current_date = date("Y-m-d");


            // var_dump($people);
            // var_dump($r_number['host']);



            if ($permissionData['permissions'] === 'admin') {
                echo '<p style="margin-top:19px"  class="w3-red w3-center">Apenas hóspedes podem para realizar reservas</p>';
            } elseif (strtotime($checkin) < strtotime($current_date)) {
                echo '<p style="margin-top:19px"  class="w3-red w3-center">Data inválida fornecida. Evite usar uma data passada.</p>';
            } elseif (strtotime($checkout) < strtotime($checkin)) {
                echo '<p style="margin-top:19px"  class="w3-red w3-center">Data inválida fornecida. Evite usar uma data checkout maior  .</p>';
            } elseif ($people > $host) {
                echo '<p style="margin-top:19px" class="w3-red w3-center">Número de hóspedes informado é maior do que o permitido.</p>';
            } elseif (mysqli_num_rows($selectReservation) > 0) {
                echo '<p style="margin-top:19px" class="w3-red w3-center">Já existem reservas para este quarto no período selecionado.</p>';
            } else 
            {
                $roomsID = $roomID;
                $aprovacao = $_POST['aprovacao'];
                $price = $_POST['price'];
                $phone = $_POST['phone'];
                
                // Verifica se o ID do usuário está disponível na sessão
                if (!empty($_SESSION['casf_user'])) {
                    $userID = $_SESSION['casf_user'];
                }

                $insert = "INSERT INTO `reservations` (
                                `name`, 
                                `checkin`, 
                                `checkout`, 
                                `phone`, 
                                `people`, 
                                `email`, 
                                `room`, 
                                `user_id`, 
                                `aprovacao`, 
                                `price`, 
                                `rooms_id`) 
                                VALUES (
                                    '$name', 
                                    '$checkin', 
                                    '$checkout', 
                                    '$phone', 
                                    '$people', 
                                    '$email', 
                                    '$r', 
                                    '$userID', 
                                    '$aprovacao', 
                                    '$price', 
                                    '$roomsID')";

                if (!empty($_SESSION['casf_user'])) {
                    $_SESSION['room_success'] = 'Reserva efetuada com sucesso!';
                }
                $save = $db->query($insert);
                if ($save) {
                    // Outras operações, se houver
                    header("Location: admin/reservations.php");
                }

                echo "<br /> <br />";
            }

        } else {
            echo '<p style="margin-top:19px" class="w3-red w3-center">Preencha todos os dados!</p>';
        }
    }
} elseif (!(isset($_GET['room'])) || $_GET['room'] == '') {
    header("Location: rooms.php");
}
?>

<!-- Room details -->
<div class="container">
    <?php
    mysqli_data_seek($select, 0);

    while ($room = mysqli_fetch_assoc($select)): ?>
        <div class="page-header">
            <h2 class="text-center">
                <?= $room['room_number']; ?>
            </h2>
        </div>

        <div class="row">
            <div class="col-md-6">
                <img class="" style="width:100%; height:400px; border-radius: 7px" src="<?= $room['photo']; ?>">
            </div>

            <!-- Right column for details -->
            <div class="col-md-6">
                <hr />
                <p><b>Categoria:</b>
                    <?= $room['type']; ?>
                </p>
                <p><b>Preço da Diária:</b> R$
                    <?= $room['price']; ?>
                </p>
                <p><b>Endereço:</b>
                    <?= $room['endereco']; ?>
                </p>
                <p><b>Quantidade máxima de hospedes:</b>
                    <?= $room['host']; ?>
                </p>
                <p style="text-align: justify;"><b>Detalhes:</b>
                    <?= $room['details']; ?>
                </p>
            </div>
        </div>
        <!-- Row for Booking form -->
        <div class="page-header">
            <h2 class="text-center">Detalhes da reserva</h2>
        </div>

        <form action="details.php?room=<?= $roomID ?>" method="POST">

            <div class="row">

                <input type="hidden" name="user_id" value="<?= $userID; ?>">

                <input type="hidden" name="name" value="<?= $usuario['full_name']; ?>">

                <input type="hidden" name="phone" value="<?= $usuario['telefone']; ?>">

                <input type="hidden" name="email" value="<?= $usuario['email']; ?>">


                <div class="col">
                    <label class="form-control-label">Data de check-in:</label>
                    <input type="date" class="form-control" name="in_date">
                </div>

                <div class="col">
                    <label class="form-control-label">Data de check-out:</label>
                    <input type="date" class="form-control" name="out_date">
                </div>

                <div class="col">
                    <label class="form-control-label">Quantidade de hóspedes:</label>
                    <input type="number" class="form-control" name="people" min="1">
                </div>

                <div class="col-md-12">
                    <input style="background-color:#343a4a;border-radius: 4px" type="submit"
                        class="form-control btn btn-primary" value="Fazer reserva" name="checkin">
                </div>

                <input type="hidden" name="aprovacao" value="pendente">
                <input type="hidden" name="price" value="<?= $room['price']; ?>">
            </div>
        </form>

    <?php endwhile; ?>
</div>

<br /><br /><br /><br />