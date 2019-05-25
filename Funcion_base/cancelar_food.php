<?php
	$id=$_GET['id_food'];
	$id_user=$_GET['resp'];
	$freg_cancelado=date('Y-m-d');
	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="UPDATE food SET freg_cancelado='$freg_cancelado', estado_food=3,resp_cancelado=$id_user WHERE id_food=$id";

	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Usted acaba de cancelar el almuerzo")
location.href = "../aplicacion5.php?opcion=206"
</script>
