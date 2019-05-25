<?php

	$perfil=$_POST['id_perfil'];
	$menu=$_POST['id_menu'];

	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="INSERT INTO aux_perfiles_menus (id_perfil,id_menu) VALUES ($perfil,$menu)";
	
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Menu asignado")
location.href = "../aplicacion5.php?opcion=1"
</script>
