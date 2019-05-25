<?php
//Conexion con la base de datos
	$servidor="localhost";
	$dbusuario="root";
	$dbpass="";
	$dbnombre="clase1";

	$conex= new mysqli($servidor,$dbusuario,$dbpass,$dbnombre);
	if($conex->connect_errno>0){
		die("Imposible conectarse con la base de datos".$conex->connect_error);
	}

?>