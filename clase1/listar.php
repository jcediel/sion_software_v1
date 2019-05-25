<!DOCTYPE html>
<html>
<head>
	<title>Listar Usuarios</title>
</head>
<body>
	<h1>Listado de Usuarios</h1>
	<table border="1">
		<tr bgcolor="yellow">
			<td>Nombres</td>
			<td>Email</td>
			<td>Genero</td>
			<td>Editar</td>
			<td>Borrar</td>
		</tr>
		<?php 
			include('conexion.php');
			$resultado = $conex->query("SELECT * FROM usuario");
			if($conex->errno) die($conex->error);
			while ($fila = $resultado ->fetch_assoc()){
		?>
		<tr>
			<td><?php echo $fila['nombre'] ?></td>
			<td><?php echo $fila['email'] ?></td>
			<td><?php echo $fila['genero'] ?></td>
			<td><a href="editar.php?id=<?php echo $fila['id']; ?>">Editar</a></td>
			<td><a href="borrar.php?id=<?php echo $fila['id']; ?>">Borrar</a></td>
		</tr>
		<?php 
			}
			mysqli_close($conex);
		?>
	</table>

</body>
</html>