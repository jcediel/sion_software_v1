<?php
	$id= $_GET['id'];
	$resp= $_GET['resp'];

	$doc= $_GET['doc'];
	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="UPDATE evo_tr_dom SET estado_evotr_dom='Cancelada',f_cancela='$hoy', resp_cancela=$resp WHERE id_evotr_dom='$id'";
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Evolución de Terapia Respiratoria fue Eliminada")
location.href = "../aplicacion5.php?doc=<?php echo $doc; ?>&servicio=Domiciliarios&buscar=Buscar&opcion=63"
</script>
