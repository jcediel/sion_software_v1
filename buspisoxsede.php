<?php
	include("conexion.php");
	$idpais = $_POST['sedes'];

	$sqlciudad = "SELECT * FROM piso WHERE id_sedes_ips='$idpais'";
	$resultadociudad = $conex->query($sqlciudad);
	if($conex->errno) die($conex->error);

	while ($filaciudad = $resultadociudad ->fetch_assoc()){
?>
	<option value="<?php echo $filaciudad['id_piso']; ?>"><?php echo $filaciudad['nom_piso']; ?></option>
<?php
	}
?>
