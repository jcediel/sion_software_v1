<?php
	$id= $_GET['id'];
	$doc= $_GET['docc'];
  $resp= $_GET['resp'];
	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="UPDATE user SET estado='Inactivo',f_elimina='$hoy',resp_elimina=$resp WHERE id_user=$id";
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Usuario eliminado correctamente !!!")
location.href = "../aplicacion5.php?opcion=1"
</script>
