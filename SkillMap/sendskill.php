<?php
	//Puxa os inputs do usuário.
	include('conn.php');
	
  	$upload_dir = 'uploads/';
	$fullname = $_POST['fullname'];
	$skill = $_POST['skill'];
	$level = $_POST['level'];
	$objective = $_POST['objective'];
	$askcertify = $_POST['askcertify'];
	$imgName = $_FILES['certification']['name'];
	$imgTmp = $_FILES['certification']['tmp_name'];
	$imgSize = $_FILES['certification']['size'];
	$imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
	$allowExt  = array('jpeg', 'jpg', 'png', 'gif', 'pdf');
	$certification = time().'_'.rand(1000,9999).'.'.$imgExt;
	move_uploaded_file($imgTmp ,$upload_dir.$certification);

	//Verifica se todos os campos foram preenchidos corretamente.
	if($fullname == "" || $skill == "" || $level == "" || $objective == "" || $askcertify == "")
	{
		echo "<script>window.alert('Preencha todos os campos requisitados!')</script>";
		echo "<script>window.location.href='profile.php'</script>";
	}
	//Insere os inputs no banco de dados, criando as credenciais de acesso.
	else
    {
        $insert_query = mysqli_query($conn,"insert into `userskills`(fullname,skill,level,objective,askcertify,certification) values ('$fullname','$skill','$level','$objective','$askcertify','$certification')") or die (mysqli_error($conn));
        echo "<script>window.alert('Skill inserida com sucesso!')</script>";
        echo "<script>window.location.href='profile.php'</script>";
	}
?>