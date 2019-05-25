<?php
	$id= $_GET['idadmhosp'];
	$idd= $_GET['idd'];
  $turno=$_GET['turno'];
	$doc= $_GET['doc'];
	include('conexion.php');
  $hoy=date('Y-m-d');
  if ($turno==24) {
    $sql_borrar="UPDATE enferdom12 SET id_d_aut_dom=$idd  WHERE id_adm_hosp='$id'";
  }
  if ($turno==12) {
    $sql_borrar="UPDATE enferdom12 SET id_d_aut_dom=$idd  WHERE id_adm_hosp='$id'";
  }
  if ($turno==8) {
    $sql_borrar="UPDATE enferdom8 SET id_d_aut_dom=$idd  WHERE id_adm_hosp='$id'";
  }
  if ($turno==6) {
    $sql_borrar="UPDATE enferdom6 SET id_d_aut_dom=$idd  WHERE id_adm_hosp='$id'";
  }
  if ($turno==3) {
    $sql_borrar="UPDATE enferdom3 SET id_d_aut_dom=$idd  WHERE id_adm_hosp='$id'";
  }
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Actualización de registro satisfactorio")
location.href = "../aplicacion5.php?opcion=183"
</script>
