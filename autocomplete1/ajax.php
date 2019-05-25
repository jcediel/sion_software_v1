<?php
require_once 'config.php';
if($_POST['type'] == 'country_table'){
	$row_num = $_POST['row_num'];
	$name = $_POST['name_startsWith'];
	$query = "SELECT id_producto,nom_producto,pos FROM m_producto where nom_producto LIKE '%".$name."%'";
	$result = mysqli_query($con, $query);
	$data = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$name = $row['nom_producto'].' | '.$row['id_producto'];
		array_push($data, $name);
	}
	echo json_encode($data);
}
