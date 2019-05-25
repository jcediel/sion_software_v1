<?php

require_once 'config.php';
if($_POST['type'] == 'country_table'){
	$row_num = $_POST['row_num'];
	$name = $_POST['name_startsWith'];
	$query = "SELECT id_user, nombre,especialidad FROM user where nombre LIKE '%".$name."%' and estado='Activo'";
	$result = mysqli_query($con, $query);
	$data = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$name = $row['nombre'].'|'.$row['id_user'].'|'.$row['especialidad'].'|'.$row_num;
		array_push($data, $name);
	}
	echo json_encode($data);
}
