<?php
    //Realiza o processo de validação de e-mail e senha cadastrados, comparando os inputs com os dados armazenados no banco de dados.
	session_start();
	include('conn.php');
	$email = $_POST['email'];
	$password = $_POST['password'];
	$query = mysqli_query($conn,"select * from `users` where email='$email' and password='$password'");
	
	if (mysqli_num_rows($query)<1)
    {
		echo "<script>window.alert('E-mail ou senha incorretos!')</script>";
		echo "<script>window.location.href='index.php?attempt=failed'</script>";
	}
	else
    {
		$row=mysqli_fetch_array($query);
		$_SESSION['userid'] = $row['userid'];
		header('location:profile.php');
	}
?>