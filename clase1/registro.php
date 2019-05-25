<!DOCTYPE html>
<html>
<head>
	<title>Formulario de Registro</title>
</head>
<body>
	<h1>Formulario de Registro</h1>
	<form action="guarda.php" method="post">
		Nombre: <input type="text" name="nombre" required><br>
		Email: <input type="email" name="email" required><br>
		Genero: 
			<input type="radio" name="genero" value="mujer"> Mujer
			<input type="radio" name="genero" value="hombre"> Hombre<br>
		Pais: 
		<select name="pais">
			<?php 
				include('conexion.php');
				$sql_pais = "SELECT * FROM pais";
				$resultado = $conex->query($sql_pais);
				if($conex->errno) die($conex->error);

				while ($fila = $resultado ->fetch_assoc()){
			?>
				<option value="<?php echo $fila['id'] ?>"><?php echo $fila['nombre']; ?></option>
			<?php 
				} 
				mysqli_close($conex);
			?>

		</select><br>
		Comentarios:<br>
			<textarea name="comentario"></textarea><br>
			<input type="submit" value="Guardar Datos">

	</form>

</body>
</html>