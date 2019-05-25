<?php

	$id=$_POST['id_anuncio'];
	$id_user=$_POST['resp'];
	$fecha=date('Y-m-d');
  $hora=date('Y-m-d');
	$link=$_POST['link'];

	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="INSERT INTO link_anuncio (id_anuncio, freg, hreg, resp, link,estado_link)
							 VALUES ('$id','$fecha','$hora','$id_user','$link',1)";

	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Link agregado correctamente")
location.href = "../aplicacion5.php?opcion=196"
</script>
