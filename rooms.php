<?php
require_once 'core/core.php';
include 'includes/header.php';
include 'includes/navigation.php';

$tamanhoMaximo = 45; // Tamanho máximo em bytes (ajuste conforme necessário)

$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

// Construa a consulta SQL com base na categoria selecionada
$sql = "SELECT * FROM rooms";
if (!empty($categoryFilter) && $categoryFilter != 'selecao') {
    $sql .= " WHERE type = '$categoryFilter'";
}

$result = $db->query($sql);

?>

<!-- END NAV SECTION -->

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

    .room-card {
        border: none;
        padding: 10px;
        transition: transform 0.2s;
        margin-bottom: 20px;
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

<div class="container"><br />

<div class="row mb-3" style="margin-top:10px">
    <label for="search"></label>
    <div class="input-group">
        <input type="text" class="form-control" id="search" placeholder="Pesquise por hospedagem">
        <div class="input-group-append">
            <span class="input-group-text">
                <svg style="margin-left:-30px; margin-top: 15px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </span>
            
        </div>
        <select class="custom-select" id="category" style="margin-top:10px; margin-left:20px">
            <option value="selecao">Selecione por categoria</option>
            <option value="Apartamento Inteiro">Apartamento Inteiro</option>
            <option value="Casa">Casa</option>
            <option value="Casa de Campo">Casa de Campo</option>
            <option value="Casa com Piscina">Casa com Piscina</option>
            <option value="Chalé">Chalé</option>
            <option value="Chácara">Chácara</option>
            <option value="Sítio">Sítio</option>
        </select>
        </div>

</div>

    <div class="row">
    <?php while ($room = mysqli_fetch_assoc($result)): ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
             <div class="room-card" data-room-id="<?= $room['id']; ?>" data-room-name="<?= $room['room_number']; ?>" data-room-category="<?= $room['type']; ?>" onclick="redirectToDetails(this)">
                     <h4 class="text-center"><?= $room['room_number']; ?></h4>
                    <div class="room-image">
                        <img src="<?= $room['photo']; ?>" class="img-responsive" alt="room" width="100%" height="200px">
                    </div>
                    <section class="text-justify">
                        <p>
                            <?php
                            $details = $room['details'];

                            if (strlen($details) > $tamanhoMaximo) {
                                $details = substr($details, 0, $tamanhoMaximo) . '...';
                            }

                            echo $details;
                            ?>
                        </p>
                        <a href="details.php?room=<?= $room['id']; ?>" style="background-color: #343a4a;border-radius: 4px" class="btn btn-block btn-primary">Mais Detalhes</a>
                    </section>
                </div>
            </div>
        <?php endwhile; ?>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>

$(document).ready(function () {
    var allRoomCards = $('.room-card');

    // Lógica de filtragem por nome
    $('#search').keyup(function () {
        var query = $(this).val().toLowerCase();

        allRoomCards.each(function () {
            var roomName = $(this).data('room-name').toLowerCase();
            var isVisible = roomName.includes(query);
            $(this).closest('.col-lg-3, .col-md-4, .col-sm-6').toggle(isVisible);
        });

        // Mostra todos os elementos quando a caixa de pesquisa está vazia
        if (query === "") {
            allRoomCards.show();
        }
    });

// Lógica de filtragem por categoria
$('#category').change(function () {
    var selectedCategory = $(this).val();

    allRoomCards.each(function () {
        var roomCategory = $(this).data('room-category');

        if (selectedCategory === 'selecao' || roomCategory === selectedCategory) {
            $(this).closest('.col-lg-3, .col-md-4, .col-sm-6').show();
        } else {
            $(this).closest('.col-lg-3, .col-md-4, .col-sm-6').hide();
        }
    });
});

});

// ...

function aplicarFiltros() {
    // Lógica para aplicar filtros aqui
    var categoria = $('#category').val();
    // Resto do código...
}

// ...

function redirectToDetails(card) {
    const roomId = card.getAttribute("data-room-id");
    window.location.href = "details.php?room=" + roomId;
}


</script>
