<?php
	$id= $_POST['idadmhosp'];
	$resp= $_POST['resp'];
	$obs=$_POST['observacion'];
	$doc= $_POST['doc'];
	include('conexion.php');
$hoy=date('Y-m-d');
	$sql_borrar="INSERT INTO visita_dom_enfermeria ( id_adm_hosp, id_user, freg, criterio1, criterio2, criterio3, criterio4, criterio5, criterio6, criterio7,
    criterio8, criterio9, obs_visita,fallida) VALUES
  ('$id','$resp','$hoy','Fallida','Fallida',
    'Fallida','Fallida',
    'Fallida','Fallida','Fallida','Fallida','Fallida',
    '$obs',1)";
	$conex->query($sql_borrar);
	if($conex->errno) die($conex->error);

	mysqli_close($conex);

?>
<script language = javascript>
alert("Buuuuu, Visita fallida")
location.href = "../aplicacion5.php?doc=<?php echo $doc; ?>&buscar=Buscar&opcion=192"
</script>
