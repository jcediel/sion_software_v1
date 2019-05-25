<?php
/*
Site : http:www.smarttutorials.net
Author :muni
*/
require_once 'config.php';
if($_POST['type'] == 'country_table'){
	$row_num = $_POST['row_num'];
	$name = $_POST['name_startsWith'];
	$b=$_POST['b'];
	$query = "SELECT a.id_producto,a.nom_producto, a.pos, a.altocosto
						FROM m_producto a INNER JOIN d_producto b on a.id_producto=b.id_producto
						where nom_producto LIKE '%".strtoupper($name)."%' and b.cantidad > 0
																															and b.id_bodega=$b
						GROUP BY a.id_producto,nom_producto,pos,altocosto";

	$result = mysqli_query($con, $query);
	$data = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$name = $row['nom_producto'].'|'.$row['id_producto'].'|'.$row['pos'].'|'.$row['altocosto'];
		array_push($data, $name);
	}
	echo json_encode($data);
}
