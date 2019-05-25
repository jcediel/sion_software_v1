<?php

	$id_anuncio=$_POST['id_anuncio'];
	$grupo_vista=$_POST['grupo_vista'];
	$doc=$_POST['doc'];

	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="UPDATE anuncios SET grupo_vista=$grupo_vista WHERE id_anuncio=$id_anuncio";

	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>

<script language = javascript>
alert('Usted ha cambiado la vista de la capacitación a GRUPAL')
location.href = "../aplicacion5.php?opcion=196"
</script>
