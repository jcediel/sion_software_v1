<?php
	//Recibimos datos
	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$genero = $_POST['genero'];
	$pais = $_POST['pais'];
	$comentario = $_POST['comentario'];

	include("conexion.php");

	if(isset($email)){



		$sql_insertar="INSERT INTO usuario SET nombre='$nombre',email='$email',
		pais='$pais',genero='$genero',comentario='$comentario'";
		$conex->query($sql_insertar);
		if($conex->errno) die($conex->error);

		mysqli_close($conex);


?>
		<script language = javascript>
		alert("Los datos han sido guardados correctamente")
		self.location = "lista_formulas.php"
		</script>

<?php } else { ?>

		<script language = javascript>
		self.location = "registro.php"
		</script>

<?php } ?>
