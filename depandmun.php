<?php
	include("conexion.php");
	$idpais = $_POST['idpais'];

	$sqlciudad = "SELECT * FROM municipios WHERE coddep='$idpais'";
	$resultadociudad = $conex->query($sqlciudad);
	if($conex->errno) die($conex->error);

	while ($filaciudad = $resultadociudad ->fetch_assoc()){
?>
	<option value="<?php echo $filaciudad['codmuni']; ?>"><?php echo $filaciudad['descrimuni']; ?></option>
<?php
	}
?>
