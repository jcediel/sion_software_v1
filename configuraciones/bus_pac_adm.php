<?php
if (isset($_GET['term'])){
	# conectare la base de datos
    $con=@mysqli_connect("localhost", "root", "515t3m45", "emmanuelips");

$return_arr = array();
/* Si la conexión a la base de datos , ejecuta instrucción SQL. */
if ($con)
{
	$fetch = mysqli_query($con,"SELECT a.id_paciente,nom_completo,doc_pac,b.estado_adm_hosp FROM pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
    where  doc_pac like '%".mysqli_real_escape_string($con,($_GET['term']))."%' and estado_adm_hosp='Activo' and tipo_servicio='Hospitalario'");

	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$id_producto=$row['id_paciente'];
		$row_array['value'] = utf8_encode($row['nom_completo']).' -- '.$row['doc_pac'];
		$row_array['id_producto']=$row['nivel_arl'];
		$row_array['codigo']=$row['id_paciente'];
		$row_array['descripcion']=utf8_encode($row['nom_completo']) .' -- '.$row['doc_pac'];
    $row_array['documento']=$row['doc_pac'];
		array_push($return_arr,$row_array);
    }
}

/* Cierra la conexión. */
mysqli_close($con);

/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);

}
?>
