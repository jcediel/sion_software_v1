<?php
	include("conexion.php");
	$idpais = $_POST['idpais'];

	$sqlciudad = "SELECT * FROM bodega WHERE id_sedes_ips='$idpais'";
	$resultadociudad = $conex->query($sqlciudad);
	if($conex->errno) die($conex->error);

	while ($filaciudad = $resultadociudad ->fetch_assoc()){
?>
	<option value="<?php echo $filaciudad['id_bodega']; ?>"><?php echo $filaciudad['nom_bodega']; ?></option>
<?php
	}
?>
