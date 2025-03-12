<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ht/core/core.php';
ini_set('error_reporting', E_ALL & ~E_NOTICE);

// Inicia a sessão para pegar o ID do usuário
session_start();

// Pega o ID do usuário e atribui para variável
if (isset($_SESSION['casf_user'])) {
  $userID = $_SESSION['casf_user'];
}

if (!is_logged_in()) {
  login_error_check();
}

include 'includes/header.php';
include 'includes/navigation.php';

if (@$_GET['edit'] && !empty(@$_GET['edit'])) {
  $id = $_GET['edit'];
  $get = $db->query("SELECT * FROM rooms WHERE id = '$id' ");
  $edit = mysqli_fetch_assoc($get);
}

// Pasta de destino das imagens
$location = $_SERVER['DOCUMENT_ROOT'] . '/ht/images/';

// VALIDANDO E MOVENDO O ARQUIVO DA LOCALIZAÇÃO TEMPORÁRIA PARA A LOCALIZAÇÃO DESTINADA
if (!empty($_FILES)) {
  $fileName = @$_FILES['file']['name'];
  $ext = strtolower(substr($fileName, strrpos($fileName, '.') + 1));
  $fileName = md5(microtime()) . '.' . $ext;
  $type = @$_FILES['file']['type'];
  $tmp_name = @$_FILES['file']['tmp_name'];

  if (($ext == 'jpg') || ($ext == 'jpeg') || ($ext == 'png') || ($ext == 'gif')) {
    $destination = $location . $fileName;
    if (move_uploaded_file($tmp_name, $destination)) {
      // Imagem movida com sucesso, você pode continuar o processamento aqui
    } else {
      echo '<div class="w3-center w3-red">Erro ao mover a imagem.</div></br>';
    }
  } else {
    echo '<div class="w3-center w3-red">O tipo de imagem deve ser jpg, jpeg, gif ou png.</div></br>';
  }
}

?>

<div class="w3-container w3-main" style="margin-left:200px">
  <header class="w3-container" style="background-color:#343a4a;">
    <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
    <h2 class="text-center" style="color:white">Adicionar hospedagem</h2>
  </header>
  <br />
  <form class="form" action="#" method="post" enctype="multipart/form-data">

    <div class="form-group col-md-4">
      <label> Título:</label>
      <input type="text" class="form-control" value="<?= (isset($_GET['edit'])) ? '' . $edit['room_number'] . '' : ''; ?>" name="number">
    </div>

    <div class="form-group col-md-4">
      <label>Categoria:</label>
      <input type="text" class="form-control" value="<?= (isset($_GET['edit'])) ? '' . $edit['type'] . '' : ''; ?>" name="type">
    </div>

    <div class="form-group col-md-2">
      <label>Preço da Diária:</label>
      <input type="text" class="form-control" value="<?= (isset($_GET['edit'])) ? '' . $edit['price'] . '' : ''; ?>" name="price">
    </div>

    <div class="form-group col-md-4">
      <?php if (isset($_GET['edit']) && !$edit['photo'] != ' ') : ?>
        <figure>
          <h3>Imagem</h3>
          <img src="../<?= $edit['photo']; ?>" alt="event image" class="img-responsive">
          <figcaption>
            <a href="add_room.php?delete_image=<?= $id; ?>" class="w3-text-red">Deletar imagem</a>
          </figcaption>
        </figure>
      <?php else : ?>
        <label>Imagem:</label>
        <input type="file" class="form-control" name="file">
      <?php endif; ?>
    </div>

    <div class="form-group col-md-4">
      <label>Descrição:</label>
      <textarea type="text" class="form-control" rows="6" name="description"> <?= (isset($_GET['edit'])) ? '' . $edit['details'] . '' : ''; ?> </textarea>
    </div>

    <div class="form-group col-md-4">
      <label></label>
      <input type="submit" class="btn btn-block btn-lg btn-success" value="<?= (isset($_GET['edit'])) ? 'Atualizar hospedagem' : 'Adicionar hospedagem'; ?>" name="<?= (isset($_GET['edit'])) ? 'update' : 'submit'; ?>">
    </div>

    <?php if (isset($_GET['edit']) && !empty($_GET['edit'])) : ?>
      <div class="form-group col-md-4">
        <label></label>
        <a class="btn btn-block btn-danger btn-lg" href="rooms.php">Cancelar edição</a>
      </div>
    <?php endif; ?>

  </form>
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

