<?php
	$id= $_POST['id_anuncio'];
	$titulo=$_POST['titulo'];
	$anuncio=$_POST['anuncio'];
  $resp= $_POST['resp'];
	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="UPDATE anuncios SET titulo='$titulo',anuncio='$anuncio',resp_elimina=$resp WHERE id_anuncio=$id";
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Usted ha realizado edición del anuncio !!!")
location.href = "../aplicacion5.php?opcion=196"
</script>
