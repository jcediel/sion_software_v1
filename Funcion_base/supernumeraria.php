<?php
	$id=$_POST['id_user'];
	$doc=$_POST['doc'];
  $supernum=$_POST['super'];
	include('conexion.php');

	$sql_borrar="UPDATE user SET supernum=$supernum WHERE id_user=$id";

	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Usuario asignado como supernumerario!!!")
location.href = "../aplicacion5.php?ident=<?php echo $doc ?>&buscar=Consultar&opcion=1"
</script>
