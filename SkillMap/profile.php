<?php
  //Inicia a sessão.
  include('conn.php');
	session_start();
	if (!isset($_SESSION['userid']) || (trim ($_SESSION['userid']) == ''))
  {
	  header('location:index.php');
    exit();
	}
  //Obtém os dados de registro do usuário.
  $query = mysqli_query($conn,"SELECT * FROM `users` WHERE userid='$_SESSION[userid]' ")or die(mysqli_error($conn));
	$row = mysqli_fetch_array($query);
	$email = $row['email'];
	$fullname = $row['fullname'];
  $email = $row['email'];
  $graduation = $row['graduation'];
  $jobtitle = $row['jobtitle'];
  $hobbies = $row['hobbies'];
  $upload_dir = 'uploads/';

  //Função de deletar skills.
  if(isset($_GET['delete']))
  {
    $skillid = $_GET['delete'];
    $sql = "SELECT * FROM `userskills` WHERE skillid = $skillid";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0)
    {
      $row = mysqli_fetch_assoc($result);
      $certification = $row['certification'];
      unlink($upload_dir.$certification);
      $sql = "DELETE FROM `userskills` WHERE skillid = $skillid";
      if(mysqli_query($conn, $sql))
      {
        header('location:profile.php');
      }
    }
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
    </br></br></br></br></br></br></br>
      <div class="col-lg-15">
        <div class="shadow card" style="border-radius: 25px; margin-bottom: 10px; color: #333; text-align: center;">
            <div class="card-body" style="width: 70%; margin: auto; margin-top: -100px;">
              <img src="img/bot1.jpg" style="width: 150px; height: 150px; border-radius: 50%; margin-bottom: 20px; border: 5px solid #fff;">
              <h3 class="text-primary" style="font-family: Luckiest Guy;"><?php echo "Olá, $fullname!"; ?></h3>
              <h5 style="font-family: Luckiest Guy;">Esses são os seus dados visíveis para a Kron:</h5>
              <p><?php echo "<b class='text-success'><i class='fa-solid fa-envelope'></i> E-mail:</b> $email"; ?></p>
              <p><?php echo "<b class='text-success'><i class='fa-solid fa-briefcase'></i> Cargo atual:</b> $jobtitle"; ?></p>
              <p><?php echo "<b class='text-success'><i class='fa-solid fa-graduation-cap'></i> Formação:</b> $graduation"; ?></p>
              <p><?php echo "<b class='text-success'><i class='fa-solid fa-face-laugh-beam'></i> Meus hobbies:</b> $hobbies"; ?></p>
              <button class="btn btn-primary shadow" data-bs-toggle="modal" data-bs-target="#edituser" style="border-radius: 100px;"><i class="fa-solid fa-user-pen"></i><b> Atualizar dados</b></button>
            </div>
          </div>
        </div>
            <div class="col-lg-15">
                <div class="shadow card" style="border-radius: 25px;">
                    <div class="card-body">
                    <h5 class="text-primary" style="font-family: Luckiest Guy; text-align: center;">Minhas skills</h5>
                    <div style="display: inline-block;">
                      <img src="img/bot2.jpg" class="responsive" style="max-width:25% !important; height:auto;">
                      <button type="button" class="btn btn-primary shadow" data-bs-toggle="modal" data-bs-target="#addskill" style="border-radius: 100px;"><i class="fa-solid fa-star"></i><b> Inserir uma nova skill</b></button>
                    </div>
                    </div>
                      <div class="table-responsive">
                        <table class="table" style="text-align: center;">
                        <thead class="bg-primary text-white">
                          <tr>
                            <th>Skill</th>
                            <th>Level</th>
                            <th>Trabalha com a skill?</th>
                            <th>Possui certificado?</th>
                            <th>Arquivo</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="table-light">
                        <?php
                            $sql = "SELECT * FROM `userskills` WHERE fullname = '$fullname'";
                            $result = mysqli_query($conn, $sql);
                    				if(mysqli_num_rows($result))
                            {
                    					while($row = mysqli_fetch_assoc($result))
                              {
                          ?>
                          <tr>
                            <td>
                              <?php echo $row['skill']; ?>
                            </td>
                            <td>
                              <?php echo $row['level']; ?>
                            </td>
                            <td>
                              <?php echo $row['objective']; ?>
                            </td>
                            <td>
                              <?php echo $row['askcertify']; ?>
                            </td>
                            <td>
                              <?php if($row['askcertify'] == "Sim")
                              {
                              ?>
                              <a href="./uploads/<?php echo $row['certification']; ?>" target="_blank" rel="noopener noreferrer">Clique para abrir</a>
                              <?php
                              }
                              else
                              {
                                echo "";
                              }
                              ?>
                            </td>
                            <td>
                              <a class="btn btn-danger shadow" href="profile.php?delete=<?php echo $row['skillid']; ?>" onclick="return confirm('Você tem certeza que deseja deletar essa skill? Essa ação não pode ser revertida.')" style="border-radius: 100px; font-family: Luckiest Guy; font-size: 14px;"><i class="fa-solid fa-trash"></i> Deletar</a>
                            </td>
                          </tr>
                          <?php
                                }
                              }
                          ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</main>
</br>
<footer class="bg-primary py-1">
  <p class="text-white" style="font-family: Luckiest Guy; text-align: center;">Kron Digital © 2022</p>
</footer>
<?php include('addskill.php'); ?>
<?php include('edituser.php'); ?>
</body>
</html>