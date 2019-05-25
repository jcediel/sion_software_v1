<?php

	$id_anuncio=$_POST['id_anuncio'];
	$vista_perfil=$_POST['vista_perfil'];
	$doc=$_POST['doc'];

	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="UPDATE anuncios SET vista_perfil=$vista_perfil WHERE id_anuncio=$id_anuncio";

	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>

<script language = javascript>
alert('Usted ha cambiado la vista de la capacitación a PERFIL')
location.href = "../aplicacion5.php?opcion=196"
</script>
