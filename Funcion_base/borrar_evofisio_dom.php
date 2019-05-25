<?php
	$id= $_GET['id'];
	$resp= $_GET['resp'];

	$doc= $_GET['doc'];
	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="UPDATE evo_fisio_dom SET estado_evofisio_dom='Cancelada',f_cancela='$hoy', resp_cancela=$resp WHERE id_evofisio_dom='$id'";
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Evolución de Fisioterapia fue Eliminada")
location.href = "../aplicacion5.php?doc=<?php echo $doc; ?>&servicio=Domiciliarios&buscar=Buscar&opcion=62"
</script>
