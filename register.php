<?php
    //Obtém todos os inputs do usuário.
    include("conn.php");

    $fullname = mysqli_real_escape_string($conn,$_POST['fullname']);
    $jobtitle = mysqli_real_escape_string($conn,$_POST['jobtitle']);
    $graduation = mysqli_real_escape_string($conn,$_POST['graduation']);
    $hobbies = mysqli_real_escape_string($conn,implode(", ",$_POST['hobbies']));
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $checkemail = mysqli_query($conn, "SELECT email FROM `users` WHERE email = '$email'");

    //Verifica se todos os campos foram preenchidos corretamente.
    if($fullname == "" || $jobtitle == "" || $graduation == "" || $hobbies == "" || $email == "" || $password == "")
    {
        echo "<script>window.alert('Preencha todos os campos requisitados!')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
    //Verifica se o e-mail já foi cadastrado anteriormente.
    else if(mysqli_num_rows($checkemail) > 0)
    {
        echo "<script>window.alert('E-mail já cadastrado!')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
    //Insere os inputs no banco de dados, criando as credenciais de acesso.
    else
    {
        $insert_query = mysqli_query($conn,"insert into users(fullname,jobtitle,graduation,hobbies,email,password) values ('$fullname','$jobtitle','$graduation','$hobbies','$email','$password')") or die (mysqli_error($conn));
        echo "<script>window.alert('Conta criada com sucesso! Realize o seu login.')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
?>