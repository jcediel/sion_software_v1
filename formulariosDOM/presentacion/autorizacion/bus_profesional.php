<?php
if (isset($_GET['term'])){
	# conectare la base de datos
    $con=@mysqli_connect("localhost", "root", "515t3m45", "kg");

$return_arr = array();
/* Si la conexión a la base de datos , ejecuta instrucción SQL. */
if ($con)
{
	$fetch = mysqli_query($con,"SELECT id_user,nombre FROM user
    where nombre like '%".mysqli_real_escape_string($con,($_GET['term']))."%' LIMIT 0 ,20");

	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$id_producto=$row['id_user'];
		$row_array['value'] = $row['nombre'];
		$row_array['id_producto']=$row['nivel_arl'];
		$row_array['codigo']=$row['id_user'];
		$row_array['descripcion']=$row['nombre'];
    $row_array['porcentaje']=$row['porcen_nivel'];
		array_push($return_arr,$row_array);
    }
}

/* Cierra la conexión. */
mysqli_close($con);

/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);

}
?>
