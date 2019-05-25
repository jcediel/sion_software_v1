
<table border="1">
		<tr bgcolor="yellow">
			<td>Nombres</td>
			<td>Email</td>
			<td>Genero</td>
			<td>Editar</td>
			<td>Borrar</td>
</tr>
<?php 
	include("conexion.php");
	$idusuario = $_POST['idusuario'];

	$sqlusuario = "SELECT * FROM usuario WHERE id='$idusuario'";
	$resultadousuario = $conex->query($sqlusuario);
	if($conex->errno) die($conex->error);

	while ($filausuario = $resultadousuario ->fetch_assoc()){
?>
		<tr>
			<td><?php echo $filausuario['nombre'] ?></td>
			<td><?php echo $filausuario['email'] ?></td>
			<td><?php echo $filausuario['genero'] ?></td>
			<td><a href="editar.php?id=<?php echo $filausuario['id']; ?>">Editar</a></td>
			<td><a href="borrar.php?id=<?php echo $filausuario['id']; ?>">Borrar</a></td>
		</tr>
		<?php 
			}
		?>
	</table>