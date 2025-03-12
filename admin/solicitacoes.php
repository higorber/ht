<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ht/core/core.php';

ini_set('error_reporting', E_ALL & ~E_NOTICE);

//inicia o session para pegar o id do usuário
session_start();

//pega o id do usuário e atribui para variável
if (isset($_SESSION['casf_user'])) {
  $userID = $_SESSION['casf_user'];
}

//LOGGED IN CHECK
if (!is_logged_in()) {
  login_error_check();
}

include 'includes/header.php';
include 'includes/navigation.php';
$sql = "SELECT r.* FROM hotel_db.rooms q
                   INNER JOIN hotel_db.reservations r ON q.id = r.rooms_id
        WHERE q.usuario_id = '$userID'";
$result = $db->query($sql);
$row_count = 1;

if (isset($_GET['reject'])) {
  $toReject = $_GET['reject'];
  $sql = "UPDATE reservations SET aprovacao = 'reprovado' WHERE id = '$toReject'";
  $db->query($sql);
  header("Location: solicitacoes.php");
}


if (isset($_GET['approve'])) {
  $toApprove = $_GET['approve'];
  $sql = "UPDATE reservations SET aprovacao = 'aprovado' WHERE id = '$toApprove'";
  $db->query($sql);
  header("Location: solicitacoes.php");
}


?>

<style>
    .link-destacado {
  color: #2160de; /* Cor do texto do link com a classe 'link-destacado' */
  text-decoration: none; /* Remove o sublinhado */
  cursor: pointer; /* Muda o cursor ao passar sobre o link para indicar que é clicável */
  text-decoration: underline;
}

.link-destacado:hover {
  color: #2160de; /* Cor do texto do link ao passar o mouse sobre ele com a classe 'link-destacado' */
  font-weight: bold; /* Torna o texto em negrito */

}

.table-container {
    margin-left: 30px; 
  }
  .table-container table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }

  .table-container th, .table-container td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }

  .table-container th {
    background-color: #f2f2f2;
  }

  .w3-btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid transparent;
    border-radius: 4px;
  }

  .w3-btn.w3-small {
    padding: 5px 10px;
    font-size: 12px;
  }

  .w3-btn.w3-red {
    color: #fff;
    background-color: #d9534f;
    border-color: #d9534f;
  }

  .w3-btn.w3-green {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
  }

  .laranja {
    color: orange; /* Substitua #vinho pela cor desejada para o status 'cancelado' */
    font-weight: bold;
     
}

.vermelho {
    color: red; /* Substitua #vermelho pela cor desejada para o status 'recusado' */
    font-weight: bold;

}

.amarelo {
    color: #f0be00; /* Substitua #amarelo pela cor desejada para o status 'pendente' */
    font-weight: bold;
}

.verde {
    color: green; /* Substitua #amarelo pela cor desejada para o status 'pendente' */
    font-weight: bold;
}


</style>

<?php

// ... (código anterior)

// Adiciona a função getApprovalClass abaixo do código anterior
function getApprovalClass($approvalStatus) {
    switch ($approvalStatus) {
        case 'aprovado':
            return 'verde';
        case 'cancelado':
            return 'laranja'; // Adicione a classe 'vinho' ao seu estilo
        case 'reprovado':
            return 'vermelho'; // Adicione a classe 'vermelho' ao seu estilo
        case 'pendente':
            return 'amarelo'; // Adicione a classe 'amarelo' ao seu estilo
        default:
            return '';
    }
}
?>


<div class="w3-container w3-main" style="margin-left:200px;">
  <header class="w3-container" style="background-color:#343a4a; width:1330px">
    <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
    <h2 class="text-center" style="color:#fff">Solicitações de reserva</h2>
  </header>
  <div class="col-md-12">
    <br>
  </div>
  <div class="col-md-12">
    <table class="table table-striped table-condensed table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Nome do Hóspede</th>
          <th>Nome da Hospedagem</th>
          <th>Check-in</th>
          <th>Check-out</th>
          <th>Telefone</th>
          <th>Quantidade de hóspedes</th>
          <th>E-mail</th>
          <th>Aprovação</th>
          <th>Preço da diária</th>
          <th>Total estimado</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
      <?php while ($rows = mysqli_fetch_assoc($result)) :
          $rooms_id = $rows['rooms_id'];

          $roomQuery = "SELECT rm.room_number FROM reservations AS rs
          INNER JOIN rooms AS rm ON rs.rooms_id = rm.id
          WHERE rs.rooms_id = $rooms_id";

          $roomResult = $db->query($roomQuery);

          // Verifique se a consulta foi bem-sucedida
          if ($roomResult && $roomResult->num_rows > 0) {
          $roomRow = mysqli_fetch_assoc($roomResult);
          $room_number = $roomRow['room_number'];
          } else {
          $room_number = 'N/A';
          }
        ?>
         <tr>
            <td><?= $row_count++; ?></td>
            <td><?= $rows['name']; ?></td>
            <td><a class="link-destacado" href="../details.php?room=<?= $rooms_id; ?>"><?= $room_number; ?></a></td>
            <td><?= $rows['checkin']; ?></td>
            <td><?= $rows['checkout']; ?></td>
            <td><?= $rows['phone']; ?></td>
            <td><?= $rows['people']; ?></td>
            <td><?= $rows['email']; ?></td>
            <td class="<?php echo getApprovalClass($rows['aprovacao']); ?>"><?php echo $rows['aprovacao']; ?></td>
            <td><?= $rows['price']; ?></td>
            <td>
              <?php
              // Calcula a diferença de dias entre o Check-in e o Check-out
              $checkin = new DateTime($rows['checkin']);
              $checkout = new DateTime($rows['checkout']);
              $diff = $checkin->diff($checkout);
              $num_days = $diff->days;

              // Calcula o total com base na quantidade de dias e no preço
              $total = $num_days * (float)$rows['price'];
              echo $total;
              ?>

            </td>
            
            <td>
              <?php if ($rows['aprovacao'] === 'pendente') : ?>
                <a href="solicitacoes.php?approve=<?= $rows['id']; ?>" class="w3-btn w3-green"><span class="glyphicon glyphicon-ok"></span> Aprovar</a>
                <a href="solicitacoes.php?reject=<?= $rows['id']; ?>" class="w3-btn w3-red"><span class="glyphicon glyphicon-remove"></span> Reprovar</a>
              <?php endif; ?>
            </td>
          
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>



</div>