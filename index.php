<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';
$sql = $db->query("SELECT * FROM rooms LIMIT 4");
$tourSQL = $db->query("SELECT * FROM tourism LIMIT 4");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Glúten-free</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="icon" type="imagem/png" href="/img/icon.png"/>


  <!-- Fonte -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Alex+Brush&display=swap" rel="stylesheet">


  <!-- Slick Carousel -->
  <link rel="stylesheet" type="text/css" href="caminho-para/slick/slick.css">
<link rel="stylesheet" type="text/css" href="caminho-para/slick/slick-theme.css">
<script type="text/javascript" src="caminho-para/slick/slick.min.js"></script>

  <!--Bootstrap   -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

  
  <style>
@font-face {
    font-family: 'MinhaFonte';
    src: url('/fonts/Breathe-Regular.woff') format('woff');
        }
        
        
    .custom-button {
        display: inline-block;
    }

    .custom-button a {
        text-decoration: none; /* Remove o sublinhado do link */
        color: White; /* Use a cor padrão do texto do pai */
    }

    .custom-button a:hover {
        text-decoration: none; /* Mantenha o sublinhado removido quando o mouse estiver sobre ele */
        color: #0f5753; /* Mantenha a cor padrão do texto quando o mouse estiver sobre ele */
        cursor: default; /* Altera o cursor para padrão (não-link) quando o mouse estiver sobre ele */
    }

    .custom-button {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
    }

    .custom-button a {
      margin-top: 200px;
      border-radius: 6px;
      transition: background-color 0.3s;
    }

    .custom-parallax {
      position: relative;
      overflow: hidden;
      width: 100%;
    }

    .custom-parallax-image {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 0;
      transition: opacity 0.5s;
    }

    .btn-large:hover {
      transform: scale(1.1);
    }

    .custom-button a.btn-large:hover {
      background-color: #0097a7;
      color: #fff;
      content: "Clique para reservar";
    }

    /* Adicione esta seção ao seu código CSS existente */
    #welcome-text {
     font-family: 'Alex Brush', cursive;
     font-size: 130px;
     text-shadow: 2px 2px 4px rgba(0, 0, 0, 2);
      color: #556fab;
      font-weight: bold;
      text-align: center;
      overflow: hidden;
      white-space: nowrap;
      margin: 0;
      letter-spacing: 2px;
    }
</style>
</head>
<body style="background-color: #343a4a; color:white">

  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br />
        <br />
        <!-- Adicione o texto "Bem-Vindo" dentro de uma div com o id "welcome-text" -->
        <h1 id="welcome-text"></h1>
        <div class="row center">
        </div>
      
        </h5>
        <div class="row" style="display: flex; justify-content: center;">

          <div class="custom-button">
            <b><a style="margin-top: 280px;" href="rooms.php"  class="btn-large waves-effect waves-light cyan darken-4 center-vertically" onmouseover="changeText(this, 'Reserve já!')" onmouseout="changeText(this, 'Reserve já!')">
                Reserve já!
              </a></b>
          </div>

          <script>
            function changeText(button, newText) {
              button.innerText = newText;
            }
          </script>

        </div>
      </div>
    </div>

    <div class="parallax custom-parallax">
      <img src="img/gluten.jpg" alt="" class="custom-parallax-image" style="max-width: 1%;">
      <img src="img/gluten2.jpg" alt="" class="custom-parallax-image" style="max-width: 1%;">
      <img src="img/gluten3.jpg" alt="" class="custom-parallax-image" style="max-width: 1%;">
      <img src="img/gluten4.jpg" alt="" class="custom-parallax-image" style="max-width: 1%;">
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function () {
        let currentIndex = 0;
        const images = $('.custom-parallax-image');
        const totalImages = images.length;

        function showNextImage() {
          images.eq(currentIndex).css('opacity', 0);
          currentIndex = (currentIndex + 1) % totalImages;
          images.eq(currentIndex).css('opacity', 1);
        }

        images.eq(0).css('opacity', 1);

        setInterval(showNextImage, 4000);
      });
    </script>

  </div>

	</div>
	<div class="container">
    <div class="section">
        <div class="row">
            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center brown-text">
                        <i style="color: white" class="material-icons">
                            local_hotel
                        </i>
                    </h2>
                    <h5 class="center">
                       <b>Melhores Hospedagens</b>
                    </h5><br>
                    <p class="light">
                        Aqui no <u><a style="color: white; font-weight: bold" href="index.php">Glúten-free</a></u>, você encontra as melhores estadias, pensadas ex- cluivamente para você. Desfrute já dessa experiência!
                    </p>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center brown-text">
                        <i style="color: white" class="material-icons">
                            star
                        </i>
                    </h2>
                    <h5 class="center">
                        <b> Acomodações 5 Estrelas</b>
                    </h5><br>
                    <p class="light">
                    Oferecemos uma variedade de aco- modações de alta qualidade, de acor- do com as suas preferências e que cabem no seu bolso.
                    </p>
                </div>
            </div>
        
     <div class="col s12 m4">
        <div class="icon-block">
        <h2 class="center brown-text">
            <i style="color: white" class="material-icons">
                local_cafe
            </i>
        </h2>
        <h5 class="center">
           <b>Opções Sem Glúten</b>
        </h5><br>
        <div class="valign-wrapper"> <!-- Adicione a classe valign-wrapper aqui -->
            <p class="light">
                Satisfaça seu paladar com opções cui- dadosamente selecionadas que ofere- cem atenção especial às necessidades dos celíacos.
            </p>
        </div>
    </div>
</div>

        </div>
    </div>
</div>


	
<div class="parallax-container valign-wrapper">
		<div class="section no-pad-bot">
			<div class="container">
				<div class="row center">
				</div>
			</div>
		</div>
		<div class="parallax">
			<img src="img/quarto1.jpg" alt="" style="max-width: 0.5%;">
		</div>
	</div>	
	
    <!-- Content section -->
    <?php
require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';

$sql = $db->query("SELECT * FROM rooms");
$tamanhoMaximo = 49; // Tamanho máximo em bytes (ajuste conforme necessário)
?>

<style>
    .img-responsive {
        transition: transform 0.3s; /* Adiciona uma transição suave */
    }

    .img-responsive:hover {
        transform: scale(1.1); /* Aumenta a imagem em 10% quando o mouse está sobre ela */
    }
</style>

<script>
    // Adicione JavaScript para alternar a classe quando o mouse entra e sai da imagem
    document.addEventListener("DOMContentLoaded", function() {
        const images = document.querySelectorAll(".img-responsive");
        
        images.forEach(function(image) {
            image.addEventListener("mouseenter", function() {
                image.classList.add("hovered");
            });

            image.addEventListener("mouseleave", function() {
                image.classList.remove("hovered");
            });
        });
    });
</script>
<?php
require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';

$sql = $db->query("SELECT * FROM rooms");
$tamanhoMaximo = 49; // Tamanho máximo em bytes (ajuste conforme necessário)
?>

<style>
    .img-responsive {
        transition: transform 0.3s; /* Adiciona uma transição suave para o efeito de aumento */
    }

    .img-responsive:hover {
        transform: scale(1.1); /* Aumenta a imagem em 10% quando o mouse está sobre ela */
    }

    .btn-primary {
        transition: transform 0.3s; /* Adiciona uma transição suave */
    }

    .btn-primary:hover {
        transform: scale(1.1); /* Aumenta o botão em 10% quando o mouse está sobre ele */
    }
</style>

<script>
    // Adicione JavaScript para alternar a classe quando o mouse entra e sai da imagem
    document.addEventListener("DOMContentLoaded", function() {
        const images = document.querySelectorAll(".img-responsive");
        
        images.forEach(function(image) {
            image.addEventListener("mouseenter", function() {
                image.classList.add("hovered");
            });

            image.addEventListener("mouseleave", function() {
                image.classList.remove("hovered");
            });
        });
    });
</script>

<?php
require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';

$sql = $db->query("SELECT * FROM rooms");
$tamanhoMaximo = 49; // Tamanho máximo em bytes (ajuste conforme necessário)
?>

<style>
    .img-responsive {
        transition: transform 0.3s; /* Adiciona uma transição suave para o efeito de aumento */
    }

    .img-responsive:hover {
        transform: scale(1.1); /* Aumenta a imagem em 10% quando o mouse está sobre ela */
    }

    .btn-primary {
        transition: transform 0.3s; /* Adiciona uma transição suave */
    }

    .btn-primary:hover {
        transform: scale(1.05); /* Aplica um efeito de zoom suave (5% de aumento) no hover */
    }
</style>

<script>
    // Adicione JavaScript para alternar a classe quando o mouse entra e sai da imagem
    document.addEventListener("DOMContentLoaded", function() {
        const images = document.querySelectorAll(".img-responsive");
        
        images.forEach(function(image) {
            image.addEventListener("mouseenter", function() {
                image.classList.add("hovered");
            });

            image.addEventListener("mouseleave", function() {
                image.classList remove("hovered");
            });
        });
    });
</script>

<?php
require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';

$sql = $db->query("SELECT * FROM rooms");
$tamanhoMaximo = 49; // Tamanho máximo em bytes (ajuste conforme necessário)
?>

<style>
    .img-responsive {
        transition: transform 0.3s; /* Adiciona uma transição suave para o efeito de aumento */
    }

    .img-responsive:hover {
        transform: scale(1.1); /* Aumenta a imagem em 10% quando o mouse está sobre ela */
    }

    .btn-primary {
        transition: transform 0.3s; /* Adiciona uma transição suave */
    }

    .btn-primary:hover {
        transform: scale(1.1); /* Aumenta o botão em 10% quando o mouse está sobre ele */
    }
</style>

<script>
    // Adicione JavaScript para alternar a classe quando o mouse entra e sai da imagem
    document.addEventListener("DOMContentLoaded", function() {
        const images = document.querySelectorAll(".img-responsive");
        
        images.forEach(function(image) {
            image.addEventListener("mouseenter", function() {
                image.classList.add("hovered");
            });

            image.addEventListener("mouseleave", function() {
                image.classList.remove("hovered");
            });
        });
    });
</script>

<section class="py-5">
    <div class="container">
        <h1><center>Hospedagens</center></h1>
        <hr />
        <style>
            .room-card {
                border: none;
                padding: 10px;
                transition: transform 0.2s;
            }

            .room-card:hover {
                transform: scale(1.05);
            }

            .room-image {
                overflow: hidden;
            }

            .room-image img {
                transition: transform 0.2s;
                object-fit: cover;
                width: 100%;
                height: 200px;
            }

            .room-card:hover .room-image img {
                transform: scale(1.1);
            }
        </style>
        <div class="row">
            <?php 
            $rooms = array(); // Crie um array para armazenar as hospedagens

            // Consulta para buscar todas as hospedagens
            while ($room = mysqli_fetch_assoc($sql)) {
                $rooms[] = $room;
            }

            // Exiba apenas as primeiras 4 hospedagens
            for ($i = 0; $i < 4 && $i < count($rooms); $i++) {
                $room = $rooms[$i];
            ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="room-card" data-room-id="<?= $room['id']; ?>" onclick="redirectToDetails(this)">
                        <h4 class="text-center"><?= $room['room_number']; ?></h4>
                        <div class="room-image">
                            <img src="<?= $room['photo']; ?>" class="img-responsive" alt="room">
                        </div>
                        <section class="text-justify">
                            <p>
                                <?php
                                $details = $room['details'];
                                $tamanhoMaximo = 48 ;

                                if (strlen($details) > $tamanhoMaximo) {
                                    $lastSpace = strrpos(substr($details, 0, $tamanhoMaximo), ' ');
                                    $details = substr($details, 0, $lastSpace) . '...';
                                }

                                echo $details;
                                ?>
                            </p>
                            <a href="details.php?room=<?= $room['id']; ?>" style="background-color:#df8352;border-radius: 4px" class="btn btn-primary btn-block">Mais Detalhes</a>
                        </section>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<script>
    function redirectToDetails(card) {
        const roomId = card.getAttribute("data-room-id");
        window.location.href = "details.php?room=" + roomId;
    }

</script>

    
    	<div class="parallax-container valign-wrapper">
		<div class="section no-pad-bot">
			<div class="container">
				<div class="row center">
				</div>
			</div>
		</div>
		<div class="parallax">
			<img src="img/comida2.jpg" alt="" style="max-width: 1%;">
		</div>
	</div>	
		

	<footer style="background-color: #343a4a;" class="page-footer">
		<div class="contaimer">
			<div class="row">
				<div class="col l6 s12" style="margin-left:80px">
					<a href="index.php" class="brand-logo"><img src="img/logo.png" height="140px" style="margin-bottom: -130px; margin-left: 100px;"></a>
					<p class="grey-text text-lighten-4" style="margin-left: 280px">
						<b style="font-size:22px;">Glúten-free</b> <br>
                        Av. União dos Ferroviários, 17600, Centro, Jundiaí - SP<br />
						Cel: (11) 99642-6254
					</p>
				</div>
				<div class="col l3 s12">
				
				</div>
				<div class="col l3 s12" style="margin-left:-100px">
					<p class="white-text" style="margin-left:-20px;font-size:22px;margin-top:25px">
						<b>Mídias Sociais</b>
                    </p>

					<ul>
    <li style="margin-top: -5px">
        <a href="https://www.facebook.com/" class="white-text" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
            </svg>
        </a>
        <a href="https://www.facebook.com/" class="white-text" target="_blank">Facebook</a>
    </li>
    <li style="margin-top: 5px">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s.444-.01.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
        </svg>
        <a href="https://www.instagram.com/" class="white-text" target="_blank">Instagram</a>
    </li>
    <li style="margin-top: 5px">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
        </svg>
        <a href="https://api.whatsapp.com/send?phone=5511996426254&text=" class="white-text" target="_blank">WhatsApp</a>
    </li>
</ul>

				</div>
			</div>
		</div>
		<div class="footer-copyright" style="background-color: #df8352 "> 
			<div class="container center">
				Todos os direitos reservados a
				<a class="text text-align-3" style="color: #343a4a;">
                <b>Glúten-free 2023 ©</b>
				</a>
			</div>
		</div>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
      <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="js/materialize.js"></script>
      <script src="js/init.js"></script>

  </body>
</html>
