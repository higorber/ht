<style>
  .navbar {
    margin-bottom: 0;
    border-radius: 0;
    border: none;
}
</style>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<body>
  <!-- <div id="headerWrapper">
    class="navbar navbar-inverse w3-purple"

  </div> -->
  <nav class="w3-sidenav w3-collapse w3-waves-light w3-card-2 w3-animate-left" style="width:216px; background-color:#343a4a;">
    
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#Navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button><br>
           <img src="../img/logo.png" alt="Grúten-free Logo" width="75" height="75" style="margin-left: 60px; margin-top:-15px">

      </div>

      <ul class="nav navbar-nav collapse navbar-collapse" id="Navigation" style="text-align: center;margin-top:15px">
        
        <?php if (hospede()) : ?>

            
          <li><a class="w3-text-white" href="reservations.php">
             <img src="../img/icon2.png" alt="Ícone de Reservas" width="20" height="20" style="vertical-align: 3px;"> Reservas
          </a></li>
        <?php endif; ?>
        <?php if (permission()) : ?>
          <li><a class="w3-text-white" href="rooms.php">
             <img src="../img/icon1.png" alt="Ícone de Hospedagens" width="20" height="20" style="vertical-align: 3px;"> Hospedagens
          </a></li>

          <li><a class="w3-text-white" href="solicitacoes.php">
             <img src="../img/icon2.png" alt="Ícone de Solicitações" width="20" height="20" style="vertical-align: 3px;"> Solicitações
          </a></li>

  
          
        <?php endif; ?>
        <!-- <li><a class="w3-text-white" href="videos.php">Videos</a></li> -->
        <!-- <?php if (hospede()) : ?>
          <li> <a class="w3-text-white" href="users.php" class=" w3-hover-red"><span class="glyphicon glyphicon-user"></span> Usuários</a> </li>
        <?php endif; ?> -->

<li><a class="w3-text-white" href="../index.php" class="w3-text-white w3-hover-red">
    <img src="../img/icon3.png" alt="Ícone de Início" width="22" height="22" style="vertical-align: 3px;"> Início
</a></li>
<li><a class="w3-text-white" href="logout.php">
    <img src="../img/icon4.png" alt="Ícone de Logout" width="20" height="20" style="vertical-align: 3px;"> Logout
</a></li>

      </ul>

      <ul class="nav navbar-nav">


        <li class="dropdown">

          <!-- <ul class="dropdown-menu w3-purple" role="menu">

            <li><a class="w3-text-white" href="#">Alterar a senha</a></li>
          </ul> -->
        </li>

      </ul>
    </div>
  </nav>