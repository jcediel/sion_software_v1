<?php
if (isset($_GET['term'])){
	# conectare la base de datos
    $con=@mysqli_connect("localhost", "root", "515t3m45", "emmanuelips");

$return_arr = array();
/* Si la conexión a la base de datos , ejecuta instrucción SQL. */
if ($con)
{
	$fetch = mysqli_query($con,"SELECT id_user,nombre,doc,tel_user,especialidad FROM user
    where estado='Activo' and nombre like '%".mysqli_real_escape_string($con,($_GET['term']))."%' ");

	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$id_producto=$row['id_user'];
		$row_array['value'] = utf8_encode($row['nombre']).' | '.utf8_encode($row['especialidad']);
		$row_array['codigo']=$row['id_user'];
		$row_array['descripcion']=utf8_encode($row['nombre']);
		array_push($return_arr,$row_array);
    }
}

/* Cierra la conexión. */
mysqli_close($con);

/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);

}
?>
