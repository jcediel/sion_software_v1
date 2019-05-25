<!DOCTYPE html>
<html>
<head>
	<title>Formulario de Registro</title>
</head>
<body>
	<?php 
		$id = $_GET['id'];
		include('conexion.php');
		$sqlusuario = "SELECT * FROM usuario WHERE id='$id'";
		$resultado = $conex->query($sqlusuario);
		if($conex->errno) die($conex->error);

		$usuario = $resultado ->fetch_assoc();
	?>
	<h1>Edicion de <?php echo $usuario['nombre']; ?></h1>
	<form action="actualiza.php" method="post">
		Nombre: <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required><br>
		Email: <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required><br>
		Genero: 
			<input type="radio" name="genero" value="mujer" 
			<?php if($usuario['genero']=="mujer"){ ?> checked="checked" <?php } ?>> Mujer
			<input type="radio" name="genero" value="hombre"
			<?php if($usuario['genero']=="hombre"){ ?> checked="checked" <?php } ?>> Hombre<br>
		Pais: 
		<select name="pais">
			<?php 
				include('conexion.php');
				$sql_pais = "SELECT * FROM pais ORDER BY nombre ASC";
				$resultado = $conex->query($sql_pais);
				if($conex->errno) die($conex->error);

				while ($fila = $resultado ->fetch_assoc()){
			?>
				<option 
				<?php if($fila['id']==$usuario['pais']){ ?> selected="selected" <?php } ?> value="<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></option>
			<?php 
				} 
				mysqli_close($conex);
			?>

		</select><br>
		Comentarios:<br>
			<textarea name="comentario"><?php echo $usuario['comentario']; ?></textarea><br>
			<input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
			<input type="submit" value="Guardar Datos">

	</form>

</body>
</html>