<?php
	include("conexion.php");
	$idpais = $_POST['pabellon'];

	$sqlciudad = "SELECT * FROM pabellon WHERE id_piso='$idpais'";
	$resultadociudad = $conex->query($sqlciudad);
	if($conex->errno) die($conex->error);

	while ($filaciudad = $resultadociudad ->fetch_assoc()){
?>
	<option value="<?php echo $filaciudad['id_pabellon']; ?>"><?php echo $filaciudad['nom_pabellon']; ?></option>
<?php
	}
?>
