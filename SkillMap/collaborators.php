<?php
  //Inicia a sessão.
  include('conn.php');
  session_start();
  if (!isset($_SESSION['userid']) || (trim ($_SESSION['userid']) == ''))
  {
	header('location:index.php');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SkillMap</title>
  <link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://unpkg.com/@jarstone/dselect/dist/css/dselect.css">
  <script src="https://unpkg.com/@jarstone/dselect/dist/js/dselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href='https://fonts.googleapis.com/css?family=Luckiest Guy' rel='stylesheet'>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
</head>
<body style="background: rgb(0,83,255); background: linear-gradient(90deg, rgba(0,83,255,1) 0%, rgba(118,215,215,1) 50%, rgba(0,197,77,1) 100%);">
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <img src="img/kronlogo.png" class="responsive navbar-brand" style="max-width:14% !important; height:auto;">
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="./profile.php"><i class="fa-solid fa-user"></i> Perfil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./collaborators.php"><i class="fa-solid fa-users"></i> Colaboradores</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./ranking.php"><i class="fa-solid fa-ranking-star"></i> Ranking</a>
        </li>
      </ul>
      <form action="logout.php">
        <button class="btn btn-primary" onclick="return confirm('Você tem certeza que deseja sair da sua conta?')"><i class="fas fa-sign-out-alt"></i> Sair</button>
      </form>
    </div>
  </div>
</nav>
<main>
  <div class="container">
    </br></br></br>
    <img src="img/bot3.jpg" class="shadow responsive" style="max-width:13% !important; height:auto; display:block; margin: 0 auto; border-radius: 100%;">
    </br>
    <div class="input-group input-group-lg">
      <span class="input-group-text text-primary shadow" id="inputGroup-sizing-lg" style="border-top-left-radius:50px; border-bottom-left-radius:50px;"><i class="fa-solid fa-magnifying-glass"></i></span>
      <input class="form-control input-lg shadow" type="text" name="search" id="search" placeholder="Pesquise por usuário, skill, hobby ou o que você preferir! " autocomplete="off" style="border-top-right-radius:50px; border-bottom-right-radius:50px; font-family: Luckiest Guy;"/>
    </div>
    </br>
    <div class="row">
      <div id="searchfor">
        <!-- Obtém todos os usuários, criando um card para cada um deles. -->
        <?php
          $sql = "SELECT * FROM `users` ORDER BY fullname ASC";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result))
          {
            while($row = mysqli_fetch_assoc($result))
            {
              foreach ($result as $row)
              {
                $fullname = $row['fullname'];
        ?>
        <div class="col-lg-15">
            <div class="shadow card" style="border-radius: 25px; margin-bottom: 10px;">
              <h5 class="card-header text-primary fw-bold" style="border-radius: 25px;"><i class="fa-solid fa-circle-user"></i> <?php echo $row['fullname']; ?></h5>
                <div class="card-body">
                  <p><b class="text-success"><i class="fa-solid fa-envelope"></i> E-mail: </b><?php echo $row['email']; ?></p>
                  <p><b class="text-success"><i class="fa-solid fa-briefcase"></i> Cargo atual: </b><?php echo $row['jobtitle']; ?></p>
                  <p><b class="text-success"><i class="fa-solid fa-graduation-cap"></i> Formação: </b><?php echo $row['graduation']; ?></p>
                  <p><b class="text-success"><i class="fa-solid fa-face-laugh-beam"></i> Hobbies: </b><?php echo $row['hobbies']; ?></p>
                  <div class="row">
                  <div style="overflow-y:scroll; display:flex;">
                  <!-- Obtém todas as skills de seus respectivos usuários, criando um card para cada um delas. -->
                  <?php
                    $sql = "SELECT * FROM `userskills` WHERE fullname = '$fullname' ORDER BY skill ASC";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result))
                    {
                      while($row = mysqli_fetch_assoc($result))
                      {
                    ?>
                  <div class="col-xl-4">
                  <div class="shadow card text-white bg-primary" style="border-radius: 15px; margin-right:10px;">
                  <div class="card-header fw-bold"><i class="fa-solid fa-star text-warning"></i> <?php echo $row['skill']; ?></div>
                  <div class="card-body">
                  <p><b class="text">Level: </b><?php echo $row['level']; ?></p>
                  <p><b class="text">Trabalha com a skill? </b><?php echo $row['objective']; ?></p>
                  <?php if($row['askcertify'] == "Sim")
                  {
                  ?>
                  <p><b class="text">Possui certificado? </b><a class="text-white" href="./uploads/<?php echo $row['certification']; ?>" target="_blank" rel="noopener noreferrer">Sim, clique para abrir</a></p>
                  <?php
                  }
                  else
                  {
                  ?>
                  <p><b class="text">Possui certificado? </b><?php echo $row['askcertify']; ?>
                  <?php
                  }
                  ?>
                  </div>
                  </div>
                  </div>
                  <?php
                      }
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
              }
            }
          }
        ?>
      <p class="nonefound" style="display: none; text-align: center; font-family: Luckiest Guy;">Não encontrei nenhum resultado! <i class="fa-solid fa-face-frown"></i></p>
	    </div>
    </div>
  </div>
</main>
</br>
<footer class="bg-primary py-1">
  <p class="text-white" style="font-family: Luckiest Guy; text-align: center;">Kron Digital © 2022</p>
</footer>
<!-- Função que permite pesquisar por usuários, skills, hobbies, etc. -->
<script>
$(document).ready(function() {
  $("#search").on("keyup", function() {
    let found = false;
    var value = $(this).val().toLowerCase();
    $("#searchfor > *").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      if ($(this).text().toLowerCase().indexOf(value) > -1) {
        $('.nonefound').hide();
        found = true;
      }
      if (!found) {
        $('.nonefound').show();
      }
    });
  });
});
</script>
</body>
</html>