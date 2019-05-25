<?php
/*
Site : http:www.smarttutorials.net
Author :muni
*/
require_once 'config.php';
if($_POST['type'] == 'country_table'){
	$row_num = $_POST['row_num'];
	$name = $_POST['name_startsWith'];
	$query = "SELECT codcupsmin, descupsmin FROM cups where descupsmin LIKE '%".$name."%' || codcupsmin LIKE '%".$name."%'";
	$result = mysqli_query($con, $query);
	$data = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$name = $row['descupsmin'].' | '.$row['codcupsmin'];
		array_push($data, $name);
	}
	echo json_encode($data);
}
