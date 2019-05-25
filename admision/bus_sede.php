<?php
if (isset($_GET['term'])){
	# conectare la base de datos
    $con=@mysqli_connect("localhost", "root", "515t3m45", "emmanuelips");

$return_arr = array();
/* Si la conexión a la base de datos , ejecuta instrucción SQL. */
if ($con)
{
	$fetch = mysqli_query($con,"SELECT id_sedes_ips,nom_sedes FROM sedes_ips
    where id_sedes_ips in (2,8)  nom_sedes like '%".mysqli_real_escape_string($con,($_GET['term']))."%'  LIMIT 0 ,50");

	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$id_sede=$row['id_sedes_ips'];
		$row_array['value'] = $row['nom_sedes'];
		$row_array['id']=$row['id_sedes_ips'];
		$row_array['sede']=$row['nom_sedes'];
		array_push($return_arr,$row_array);
    }
}

/* Cierra la conexión. */
mysqli_close($con);

/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);

}
?>
