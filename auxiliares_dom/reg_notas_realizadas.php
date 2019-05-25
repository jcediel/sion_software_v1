<?php

	$id=$_POST['id_profesional'];
	$resp_radica=$_POST['resp_radica'];
	$cant_radica=$_POST['cradica'];
	$fecha_radica=$_POST['fecha_radica'];
	$f1=$_POST['f1'];
	$f2=$_POST['f2'];
	$t=$_POST['t'];
	$doc=$_POST['doc '];

	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="UPDATE profesional_d_dom SET resp_radica=$resp_radica, cant_radica=$cant_radica, fecha_radica='$fecha_radica' WHERE id_prof_d_dom=$id";

	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("cantidad de firmas registrada con exito")
location.href = "../aplicacion5.php?f1=<?php echo $f1 ?>&f2=<?php echo $f2 ?>&doc=<?php echo $doc ?>&buscar=Consultar&opcion=205&tprofesional=<?php echo $t ?>"
</script>
