<?php
$id=$_GET['id_food'];
$id_perfil=$_GET['resp'];
$freg_entrega=date('Y-m-d');
include('conexion.php');
$hoy=date('Y-m-d');
$sql_entrega="UPDATE food SET freg_entrega='$freg_entrega', estado_food=2,resp_entrega=$id_perfil WHERE id_food=$id";

$conex->query($sql_entrega);
if($conex->errno) die($conex->error);

mysqli_close($conex);

?>
<script language = javascript>
alert("Usted acaba de realizar una entrega")
location.href = "../aplicacion5.php?opcion=206"
</script>
