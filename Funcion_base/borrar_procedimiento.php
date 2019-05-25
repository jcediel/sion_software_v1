<?php
	$id= $_GET['id'];
	$doc= $_GET['docc'];
  $resp= $_GET['resp'];
	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="UPDATE d_aut_dom SET estado_d_aut_dom=5,f_cancela='$hoy',resp_cancela=$resp WHERE id_d_aut_dom=$id";
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Procedimiento cancelado con exito !!!")
location.href = "../aplicacion5.php?doc=<?php echo $doc; ?>&buscar=Consultar&opcion=183"
</script>
