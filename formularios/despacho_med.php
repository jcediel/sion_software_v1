<?php
	//Recibimos datos
	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$genero = $_POST['genero'];
	$pais = $_POST['pais'];
	$comentario = $_POST['comentario'];
	$id = $_POST['id'];

	include("conexion.php");

	$sql_actualizar="UPDATE usuario SET nombre='$nombre',email='$email',
	pais='$pais',genero='$genero',comentario='$comentario' WHERE id='$id'";
	$conex->query($sql_actualizar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Los datos han sido guardados correctamente")
self.location = "listar.php"
</script>
