<?php
	include('conn.php');
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
  <!-- Configurações do toggle -->
  <style>
  .form-module .toggle .tooltip {
    position: absolute;
    display: block;
    width: auto;
  }
  .form-module .toggle .tooltip:before {
    position: absolute;
    display: block;
  }
  .form-module .form {
    display: none;
    padding: 40px;
  }
  .form-module .form:nth-child(2) {
    display: block;
  }
  </style>
</head>
<body style="background: rgb(0,83,255); background: linear-gradient(90deg, rgba(0,83,255,1) 0%, rgba(118,215,215,1) 50%, rgba(0,197,77,1) 100%);">
</br></br></br>
<div class="module form-module" style="max-width: 650px; background-color: #fff; border-radius: 30px; transition: 0.3s ease; position: relative; margin: 0 auto;">
  <div class="toggle" style="border-top-right-radius: 10px;border-bottom-left-radius: 10px; width:325px; text-align: center; cursor: pointer; position: absolute; top: -0; right: -0; background: #0d6efd; margin: -5px 0 0; color: #ffffff; line-height: 30px;">
    <b>Cadastre-se</b>
  </div>
  <!-- Formulário de login -->
  <div class="form">
    <form name="form_login" method="post" action="login.php" autocomplete="off">
      <img src="img/kronlogo2.png" class="responsive" style="max-width:50% !important; height:auto; display: block; margin-left: auto; margin-right: auto;">
      </br>
      <h4 class="text-primary" style="font-family: Luckiest Guy;">Entre na sua conta</h4>
      <label for="email">E-mail</label>
      <input class="form-control" type="email" name="email" id="email" required/>
      </br>
      <label for="password">Senha</label>
      <input class="form-control" type="password" name="password" id="password" required/>
      </br>
      <button class="btn btn-success btn-lg shadow" id="btnLogin" style="border-radius: 100px; display:block; margin: 0 auto; font-family: Luckiest Guy;">Entrar</button>
    </form>
  </div>
  <!-- Formulário de criação de conta -->
  <div class="form">
    <form name="form_register" method="post" action="register.php" autocomplete="off">
      <h4 class="text-primary" style="font-family: Luckiest Guy;">Crie a sua conta</h4>
      <label for="fullname">Nome completo*</label>
      <input class="form-control" type="text" name="fullname" id="fullname" required/>
      </br>
      <label for="jobtitle">Cargo atual*</label>
      <input class="form-control" type="text" name="jobtitle" id="jobtitle" required/>
      </br>
      <label for="graduation">Formação*</label>
      <input class="form-control" type="text" name="graduation" id="graduation" required/>
      </br>
      <label for="hobbies">Hobbies*</label>
      <!-- Obtém todos os hobbies do banco de dados. -->
      <select class="form-select" type="text" name="hobbies[]" id="hobbies" multiple required>
        <?php
          $sql = mysqli_query($conn, "SELECT * FROM `hobby` ORDER BY hobbyid");
          while ($row = mysqli_fetch_array($sql)) 
          {
            $allhobbies = $row['allhobbies'];
        ?>
        <option value="<?php echo $allhobbies; ?>"><?php echo $allhobbies; ?></option>
        <?php 
          } 
        ?>
      </select>
      </br>
      <label for="email">E-mail*</label>
      <input class="form-control" type="email" name="email" id="email" required/>
      </br>
      <label for="password">Senha*</label>
      <input class="form-control" type="password" name="password" id="senha" required/>
      </br>
      <button class="btn btn-success btn-lg shadow" id="btnLogin" style="border-radius: 100px; display:block; margin: 0 auto; font-family: Luckiest Guy;">Cadastrar</button>
    </form>
  </div>
  <!-- Select de hobbies. -->
  <script>
    var select_box_element = document.querySelector('#hobbies');
    dselect(select_box_element, {
        search: true,
        maxHeight: '200px',
    });
  </script>
  <!-- Função do toggle para alternar entre logar e cadastrar. -->
  <script>
    $('.toggle').click(function()
    {
    $(this).children('i').toggleClass('fa-pencil');
    $('.form').animate
    ({
      height: "toggle",
      'padding-top': 'toggle',
      'padding-bottom': 'toggle',
      opacity: "toggle"
    }, "slow");
    });
  </script>
</body>
</html>