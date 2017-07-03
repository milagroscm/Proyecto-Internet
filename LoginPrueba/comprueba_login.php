<?php

session_start();
	require("connect_db.php");
	$username=$_POST['Usuario'];
	$pass=$_POST['Contraseña'];

	$sql2=mysqli_query($mysqli,"SELECT * FROM usuarios WHERE Usuario='$username'");
	if($f2=mysqli_fetch_assoc($sql2)){
		if($pass==$f2['Contraseña_admin']){
			$_SESSION['Usuario']=$f2['Usuario'];
			header("Location: Ingreso_Administrador.html");
		}
	}
	$sql=mysqli_query($mysqli,"SELECT * FROM usuarios WHERE Usuario='$username'");
	if($f=mysqli_fetch_assoc($sql)){
		if($pass==$f['Contraseña']){
			$_SESSION['Usuario']=$f['Usuario'];
			header("Location: Ingreso_Usuario.html");
		}
	}
	else{
		echo '<script>alert("El usuario o contraseña es incorrecto, inténtelo nuevamente.")</script> ';
	}
	mysqli_free_result($resultado);
	mysqli_close($conexion);
?>