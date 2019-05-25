<?php
	$id= $_GET['id'];
	$doc= $_GET['docc'];
  $resp= $_GET['resp'];
  $f=date('Y-m-d');
  $h=date('H:i');
	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="INSERT INTO leido_anuncio (id_s_anuncio, resp_leido, freg_leido, hreg_leido) VALUES ('$id','$resp','$f','$h')";
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Mensaje Leido  !!!")
location.href = "../aplicacion5.php"
</script>
