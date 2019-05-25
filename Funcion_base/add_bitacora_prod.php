<?php

	$id=$_POST['id_d_aut_dom'];
	$id_user=$_POST['id_user'];
	$fecha_dinvasivo=$_POST['freg'];
	$descripcion=$_POST['descripcion'];
	$calificacion=$_POST['calificacion'];
	$tpac=$_POST['tpac'];
	$eps=$_POST['eps'];

	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="INSERT INTO bitacora_prod_call (id_d_aut_dom, resp_bitacora, freg, calificacion, descripcion)
							 VALUES ('$id','$id_user','$fecha_dinvasivo','$calificacion','$descripcion')";

	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Bitacora de procedimiento agregada correctamente")
location.href = "../aplicacion5.php?tpac=<?php echo $tpac; ?>&eps=<?php echo $tpac; ?>&buscar=Consultar&opcion=202"
</script>
