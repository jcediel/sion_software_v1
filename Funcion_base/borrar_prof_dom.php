<?php
	$id= $_GET['id'];
	$doc= $_GET['docc'];
  $resp= $_GET['resp'];
	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="UPDATE profesional_d_dom SET estado_profesional=2,f_cancela='$hoy',user_cancela=$resp WHERE id_prof_d_dom=$id";
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Profesional inactivado para este procedimiento")
location.href = "../aplicacion5.php?doc=<?php echo $doc; ?>&buscar=Consultar&opcion=183"
</script>
