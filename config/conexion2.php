<?php
	$mysqli=new mysqli("localhost","root","515t3m45","emmanuelips"); //servidor, usuario de base de datos, contraseÃ±a del usuario, nombre de base de datos

	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>
