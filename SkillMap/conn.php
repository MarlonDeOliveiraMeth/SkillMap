<?php
    //Padrão de data e hora.
    date_default_timezone_set("America/Sao_Paulo");
    $date=date('d/m/Y H:i:s');

    //Conexão com o MySQL.
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "skillmap";
    $conn=mysqli_connect($db_host, $db_username, $db_password, $db_name);
    if(!$conn)
    {
    	die("Houve uma falha na conexão com o banco de dados: " . mysqli_connect_error());
    }
?>