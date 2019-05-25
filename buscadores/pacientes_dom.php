
<table border="1">
		<tr bgcolor="yellow">
			<td>IDENTIFICACION</td>
			<td>NOMBRES Y APELLIDOS</td>
			<td>GENERO</td>
			<td>Editar</td>
			<td>Borrar</td>
</tr>
<?php
	include("conexion.php");
	$idusuario = $_POST['idusuario'];

	$sqlusuario = "SELECT * FROM pacientes WHERE doc_pac='222'";
	$resultadousuario = $conex->query($sqlusuario);
	if($conex->errno) die($conex->error);

	while ($filausuario = $resultadousuario ->fetch_assoc()){
?>
		<tr>
			<td><?php echo $filausuario['tdoc_pac'] .' '.$filausuario['doc_pac'] ?></td>
			<td><?php echo $filausuario['nom1'].' '.$filausuario['nom2'].' '.$filausuario['ape1'].' '.$filausuario['ape1'] ?></td>
			<td><?php echo $filausuario['genero'] ?></td>
			<td><a href="editar.php?id=<?php echo $filausuario['id']; ?>">Editar</a></td>
			<td><a href="borrar.php?id=<?php echo $filausuario['id']; ?>">Borrar</a></td>
		</tr>
		<?php
			}
		?>
	</table>
