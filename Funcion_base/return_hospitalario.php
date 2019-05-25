<?php
	$id=$_GET['idadmhosp'];
	$resp= $_GET['resp'];
	$doc= $_GET['doc'];
	include('conexion.php');
  $hoy=date('Y-m-d');
	$sql_borrar="UPDATE adm_hospitalario SET estado_salida= NULL,fegreso_hosp= NULL,hegreso_hosp= NULL WHERE id_adm_hosp='$id'";
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("No estaba muerto andaba hospitalizado")
location.href = "../aplicacion5.php?doc=<?php echo $doc; ?>&servicio=Domiciliarios&buscar=Buscar&opcion=183"
</script>
