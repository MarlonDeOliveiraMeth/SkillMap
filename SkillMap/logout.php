<?php
	//Finaliza a sessão e retorna para o index.
	session_start();
	session_destroy();
	header('location:index.php');
?>