<?php
	$id= $_POST['id'];
	$fecha=$_POST['fecha_responde'];
	$respuesta=$_POST['respuesta'];
  $resp= $_POST['resp_responde'];
	$estado= $_POST['estado'];
	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="UPDATE bitacora_procedimiento SET fecha_responde='$fecha',respuesta='$respuesta',resp_responde=$resp,estado_bitacora=$estado WHERE id_bit_pro=$id";
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Se ha realizado la respuesta a la notificacion !!!")
location.href = "../aplicacion5.php?opcion=197"
</script>
