<?php
	include("conexion.php");
	$idpais = $_POST['idpais'];

	$sqlciudad = "SELECT * FROM proveedores WHERE id_bodega='$idpais'";
	$resultadociudad = $conex->query($sqlciudad);
	if($conex->errno) die($conex->error);

	while ($filaciudad = $resultadociudad ->fetch_assoc()){
?>
	<option value="<?php echo $filaciudad['id_proveedor']; ?>"><?php echo $filaciudad['razon_social']; ?></option>
<?php
	}
?>
