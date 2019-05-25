<?php
	$id= $_GET['id'];
	$tabla= $_GET['tabla'];
	$doc= $_GET['docc'];
	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="UPDATE escala_$tabla SET estado=0,f_trash='$hoy' WHERE id_esc_$tabla='$id'";
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Registro de escala Eliminado")
location.href = "../aplicacion5.php?doc=<?php echo $doc; ?>&buscar=Consultar&opcion=192"
</script>
