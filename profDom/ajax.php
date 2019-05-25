<?php

require_once 'config.php';
if($_POST['type'] == 'country_table'){
	$row_num = $_POST['row_num'];
	$name = $_POST['name_startsWith'];
	$query = "SELECT codcupsmin, descupsmin,tipo_procedimiento FROM cups where descupsmin LIKE '%".$name."%'";
	$result = mysqli_query($con, $query);
	$data = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$name = $row['descupsmin'].'|'.$row['codcupsmin'].'|'.$row['tipo_procedimiento'].'|'.$row_num;
		array_push($data, $name);
	}
	echo json_encode($data);
}
