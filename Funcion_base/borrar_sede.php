<?php
$doc=$_GET['ident'];
	$id=$_GET['id_aux_us'];
	$id_user=$_GET['resp'];
	$freg_cancelado=date('Y-m-d');
	include('conexion.php');
	$hoy=date('Y-m-d');
	$sql_borrar="DELETE FROM aux_user_sedes where id_aux_us=$id";
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Usted acaba de borrar una sede")
location.href = "../aplicacion5.php?opcion=1"
</script>
