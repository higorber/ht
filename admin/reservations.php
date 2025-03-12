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
$sql = "SELECT * FROM reservations WHERE user_id = '$userID'";
$result = $db->query($sql);
$row_count = 1;

$roomNumbers = array();

if (isset($_GET['delete'])) {
  $toReject = $_GET['delete'];
  $sql = "UPDATE reservations SET aprovacao = 'cancelado' WHERE id = '$toReject'";
  $db->query($sql);
  header("Location: reservations.php");
}

if (isset($_GET['whatsapp'])) {
  $id = $_GET['whatsapp'];

  // Consulta o banco de dados para obter os detalhes do registro
  $sql = "SELECT * FROM reservations WHERE id = '$id' AND aprovacao = 'aprovado'";
  $result = $db->query($sql);

  if ($result && $result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    
    // Calcula a diferença de dias entre o Check-in e o Check-out
    $checkin = new DateTime($row['checkin']);
    $checkout = new DateTime($row['checkout']);
    $diff = $checkin->diff($checkout);
    $num_days = $diff->days;

    // Calcula o total com base na quantidade de dias e no preço
    $total = $num_days * (float)$row['price'];
    echo $total;
    
    // Componha a mensagem do WhatsApp com os dados do registro
    $message = "Olá, {$row['name']}! Minha reserva foi aprovada:\n\n" .
    "Nome da hospedagem: {$row['room']}\n" .
    "Check-in: {$row['checkin']}\n" .
    "Check-out: {$row['checkout']}\n" .
    "Telefone de contato: {$row['phone']}\n" .
    "Número de hóspedes: {$row['people']}\n" .
    "E-mail de contato: {$row['email']}\n" .
    "Preço da diária: {$row['price']} \n" .
    "Valor total estimado: {$total}\n\n" .
    "Estou entrando em contato sobre o pedido!";

// Codifique a mensagem para que ela seja uma URL válida para o WhatsApp
$encodedMessage = urlencode($message);

    // Codifique a mensagem para que ela seja uma URL válida para o WhatsApp
    $encodedMessage = urlencode($message);

    // Número de telefone para o qual você deseja enviar a mensagem (substitua pelo número desejado)

    // Crie o link do WhatsApp com a mensagem
    $whatsappLink = "whatsapp://send?phone=55{$row['phone']}&text={$encodedMessage}";

    // Redirecione para o link do WhatsApp
    header("Location: {$whatsappLink}");
    exit;
  }
  
  header("Location: reservations.php");
}


?>

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

<div class="w3-container w3-main" style="margin-left:200px">
  <header class="w3-container" style="background-color:#343a4a; width:1330px">
    <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
    <h2 class="text-center" style="color:#fff">Minhas Reservas</h2>

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
    color: #fde910; /* Substitua #amarelo pela cor desejada para o status 'pendente' */
    font-weight: bold;
}

.verde {
    color: green; /* Substitua #amarelo pela cor desejada para o status 'pendente' */
    font-weight: bold;
}

</style>
  </header>
  <div class="col-md-12">
    <br><br>
  </div>
  <div class="table-container">
    <table class="table table-striped table-condensed table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Nome do hóspede</th>
          <th>Nome da Hospedagem</th>
          <th>Check-in⠀</th>
          <th>Check-out</th>
          <th>Telefone</th>
          <th>Qtde de hóspedes</th>
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
            <td style="text-align: center;" class="text-center">
              <?php if ($rows['aprovacao'] === 'pendente') : ?>
                <a href="reservations.php?delete=<?= $rows['id']; ?>" style="text-ali" class="w3-btn w3-small w3-red"><span class="glyphicon glyphicon-trash"></span></a>
              <?php endif; ?>
              <?php if ($rows['aprovacao'] === 'aprovado') : ?>
                <a href="reservations.php?whatsapp=<?= $rows['id']; ?>" class="w3-btn w3-small w3-green"><span class="glyphicon glyphicon-whatsapp"></span> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
  <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
</svg> WhatsApp</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>



</div>