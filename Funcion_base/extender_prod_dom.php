<?php
	$id= $_POST['id'];
	$doc= $_POST['doc'];
	$Justificacion= $_POST['justificacion_ext'];
	$new_fecha= $_POST['new_fecha'];
  $resp= $_POST['resp'];
	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="UPDATE d_aut_dom SET ffinal='$new_fecha',justificacion_ext='$Justificacion',resp_ext=$resp WHERE id_d_aut_dom=$id";
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Usted ha extendido la fecha de finalización del procedimiento")
location.href = "../aplicacion5.php?doc=<?php echo $doc; ?>&buscar=Consultar&opcion=183"
</script>
