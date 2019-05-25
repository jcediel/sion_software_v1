<?php
	$id= $_GET['id'];
	$resp= $_GET['resp'];
	$doc= $_GET['doc'];
	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="UPDATE signos_vitales SET estado_sv='Cancelada',f_cancela='$hoy', resp_cancela=$resp WHERE id_signos_vitales='$id'";
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Signos vitales invalidados")
location.href = "../aplicacion5.php?doc=<?php echo $doc; ?>&servicio=Domiciliarios&buscar=Buscar&opcion=159"
</script>
