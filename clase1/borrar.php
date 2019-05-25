<?php 
	$id = $_GET['id'];
	include('conexion.php');

	$sql_borrar="DELETE FROM usuario WHERE id='$id'";
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("El usuario ha sido borrado correctamente")
self.location = "listar.php"
</script>
