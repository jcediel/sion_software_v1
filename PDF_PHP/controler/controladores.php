<?php 
include '../bd/DSaIiConexion.php';
$obj = new MySQL();
$sql = "SELECT * FROM usuario";
$data = $obj->consulta($sql);
echo  json_encode($obj->respondeData($data));
 ?>