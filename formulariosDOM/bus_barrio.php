<?php
if (isset($_GET['term'])){
	# conectare la base de datos
    $con=@mysqli_connect("localhost", "root", "515t3m45", "emmanuelips");

$return_arr = array();
/* Si la conexión a la base de datos , ejecuta instrucción SQL. */
if ($con)
{

	$fetch = mysqli_query($con,"SELECT a.id_barrio,a.nom_barrio,b.nom_upz,c.nom_localidad
    FROM localidades c LEFT JOIN upz b on c.id_localidad=b.id_localidad left join barrio a on b.id_upz=a.id_upz
    where a.nom_barrio like '%".mysqli_real_escape_string($con,($_GET['term']))."%' or c.nom_localidad like '%".mysqli_real_escape_string($con,($_GET['term']))."%' order by nom_barrio ASC");

	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$id_producto=$row['id_barrio'];
		$row_array['value'] = utf8_encode($row['nom_barrio']).' ---- '.$row['nom_localidad'];
		$row_array['id_producto']=$row['id_barrio'];
		$row_array['codigo']=$row['id_barrio'];
		$row_array['descripcion']=$row['nom_barrio'];
		array_push($return_arr,$row_array);
    }
}

/* Cierra la conexión. */
mysqli_close($con);

/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);

}
?>
