<?php
	$id= $_GET['id'];
	$doc= $_GET['docc'];
  $resp= $_GET['resp'];
	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="UPDATE anuncios SET estado=0,f_elimina='$hoy',resp_elimina=$resp WHERE id_anuncio=$id";
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Dile adios a este anuncio !!!")
location.href = "../aplicacion5.php?opcion=196"
</script>
