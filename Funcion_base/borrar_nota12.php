
<script language = javascript>

if (confirm("DESEA REALMENTE INVALIDAR LA NOTA/ Recuerde que la nota se invalida y no puede ser recuprada, adicional no la va a poder ver en la consulta de notas")) {
	<?php
		$id= $_GET['id'];
		$resp= $_GET['resp'];
		$doc= $_GET['doc'];
		include('conexion.php');
	$hoy=date('Y-m-d');
		$sql_borrar="UPDATE enferdom12 SET estado_nota='Cancelada',f_cancela='$hoy', resp_cancela=$resp WHERE id_enf_dom12='$id'";
		$conex->query($sql_borrar);
		if($conex->errno) die($conex->error);
		mysqli_close($conex);
	?>
	alert("LA NOTA FUE INVALIDADA ")
	location.href = "../aplicacion5.php?doc=<?php echo $doc; ?>&servicio=Domiciliarios&buscar=Buscar&opcion=159"
}else {
	alert("LA NOTA NO FUE CANCELADA ")
	location.href = "../aplicacion5.php?doc=<?php echo $doc; ?>&servicio=Domiciliarios&buscar=Buscar&opcion=159"
}

</script>
