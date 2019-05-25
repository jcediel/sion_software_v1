<?php
if (isset($_GET['term'])){
	# conectare la base de datos
    $con=@mysqli_connect("localhost", "root", "515t3m45", "emmanuelips");

$return_arr = array();
/* Si la conexión a la base de datos , ejecuta instrucción SQL. */
if ($con)
{
	$fetch = mysqli_query($con,"SELECT codcupsmin,descupsmin
                              FROM cups
                              WHERE tipo_procedimiento='MEDICINA DOMICILIARIA'  and
                              descupsmin like '%".mysqli_real_escape_string($con,($_GET['term']))."%'

                              LIMIT 0 ,50");

	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$id_producto=$row['codcupsmin'];
		$row_array['value'] = utf8_encode($row['descupsmin']);
		$row_array['id_producto']=$row['nivel_arl'];
		$row_array['codigo']=$row['codcupsmin'];
		$row_array['descripcion']=utf8_encode($row['codcupsmin']) .' -- '.$row['descupsmin'];

		array_push($return_arr,$row_array);
    }
}

/* Cierra la conexión. */
mysqli_close($con);

/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);

}
?>
