<?php
    //Puxa os inputs do usuário.
    include("conn.php");
    session_start();
	if (!isset($_SESSION['userid']) || (trim ($_SESSION['userid']) == ''))
    {
	  header('location:index.php');
    exit();
	}

    $jobtitle = mysqli_real_escape_string($conn,$_POST['jobtitle']);
    $graduation = mysqli_real_escape_string($conn,$_POST['graduation']);
    $hobbies = mysqli_real_escape_string($conn,implode(", ",$_POST['hobbies']));

    //Verifica se todos os campos foram preenchidos corretamente.
    if($jobtitle == "" || $graduation == "" || $hobbies == "")
    {
        echo "<script>window.alert('Preencha todos os campos requisitados!')</script>";
        echo "<script>window.location.href='profile.php'</script>";
    }
    //Insere os inputs no banco de dados, atualizando os dados do usuário.
    else
    {
        $update_query = mysqli_query($conn,"update `users` set jobtitle='$jobtitle', graduation='$graduation', hobbies='$hobbies' where userid=$_SESSION[userid]") or die (mysqli_error($conn));
        echo "<script>window.alert('Dados atualizados com sucesso!')</script>";
        echo "<script>window.location.href='profile.php'</script>";
    }
?>