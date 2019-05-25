<?php

	$id_paciente=$_POST['id_paciente'];
	$id_user=$_POST['id_user'];
	$fecha_dinvasivo=$_POST['fecha_dinvasivo'];
	$hora_dinvasivo=$_POST['hora_dinvasivo'];
	$dispositivo_invasivo=$_POST['dispositivo_invasivo'];
	$obs_dinvasivo=$_POST['obs_dinvasivo'];
	$doc=$_POST['doc'];

	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="INSERT INTO dispositivos_invasivos (id_paciente, id_user,fecha_dinvasivo, hora_dinvasivo,
																								 dispositivo_invasivo, obs_dinvasivo, estado_dinvasivo)
							 VALUES ('$id_paciente','$id_user','$fecha_dinvasivo','$hora_dinvasivo','$dispositivo_invasivo','$obs_dinvasivo',1)";

	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Dispositivo invasivo agregado correctamente")
location.href = "../aplicacion5.php?doc=<?php echo $doc; ?>&buscar=Consultar&opcion=192"
</script>
