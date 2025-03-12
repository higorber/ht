<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ht/core/core.php';
ini_set('error_reporting', E_ALL & ~E_NOTICE);

//inicia o session para pegar o id do usuário
session_start();

$tamanhoMaximo = 70;

//pega o id do usuário e atribui para variável
if (isset($_SESSION['casf_user'])) {
    $userID = $_SESSION['casf_user'];
}

if (!is_logged_in()) {
    login_error_check();
}

include 'includes/header.php';
include 'includes/navigation.php';
#header("Location: events.php");

$reservados = "SELECT rooms.*, COUNT(reservations.id) AS reservation_count
        FROM rooms
        LEFT JOIN hotel_db.reservations ON rooms.id = reservations.rooms_id
        WHERE rooms.usuario_id = {$userID}
        GROUP BY rooms.id";

$result = $db->query($reservados);

$sql = $db->query("SELECT * FROM rooms WHERE usuario_id = {$userID}");

if (isset($_GET['delete'])) {
    $toDeleteRoom = $_GET['delete'];
    $sql1 = $db->query("SELECT * FROM rooms WHERE id = '$toDeleteRoom' LIMIT 1");
    $fetch = mysqli_fetch_assoc($sql1);
    $imageURL = $_SERVER['DOCUMENT_ROOT'] . '/' . $fetch['photo'];
    unlink($imageURL);
    ##################################################################
    $sql = "DELETE FROM rooms WHERE id = '$toDeleteRoom' ";
    $db->query($sql);
    header("Location: rooms.php");
}
?>

<div class="w3-container w3-main" style="margin-left:200px">
    <header class="w3-container" style="background-color:#343a4a; width:1330px">
        <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
        <h2 class="text-center" style="color:white">Hospedagens</h2>
    </header>
    <div class="row"><br />
    <div class="col-md-12">
        <a href="add_room.php" class="btn btn-primary pull-right" style="margin-right:60px">Adicionar uma nova hospedagem</a>
    </div>

    <?php $count = 0; ?>
    <?php while ($room = mysqli_fetch_assoc($result)) : ?>
        <div class="col-md-3" style="margin-left:60px">
       <h3 class="text-center"><?= $room['room_number']; ?></h3>
                <img src="../<?= $room['photo']; ?>" class="img-thumbnail" style="width:100%; height:200px" alt="pic">
                <div class="section">
                    <section>
                        <p>
                        <?php
                            $details = $room['details'];

                            if (strlen($details) > $tamanhoMaximo) {
                                $details = substr($details, 0, $tamanhoMaximo) . '...';
                            }

                            echo $details;
                            ?></p>
                    </section>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="add_room.php?edit=<?= $room['id']; ?>" class="btn btn-primary btn-block">Editar</a>
                    </div>
                    <div class="col-md-6">
                        <?php if ($room['reservation_count'] == 0) : ?>
                            <a href="rooms.php?delete=<?= $room['id']; ?>" class="btn btn-danger btn-block">Deletar</a>
                        <?php endif; ?>

                    </div>
                </div>
                      <!-- Adicione o seguinte bloco PHP para limpar floats a cada 4 hospedagens -->
                      <?php
$count++;
?>
<div class="clearfix <?php if ($count % 4 == 0) echo 'visible-md visible-lg'; ?>"></div>

                    </div>
    <?php endwhile; ?>
</div>
    <br /><br />
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