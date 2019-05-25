<?php
	include("conexion.php");
	$idpais = $_POST['habitacion'];

	$sqlciudad = "SELECT a.nom_hab,b.id_cama,nom_cama FROM habitacion a INNER JOIN cama b on a.id_habitacion=b.id_habitacion WHERE a.id_pabellon='$idpais'";
	$resultadociudad = $conex->query($sqlciudad);
	if($conex->errno) die($conex->error);

	while ($filaciudad = $resultadociudad ->fetch_assoc()){
?>
	<option value="<?php echo $filaciudad['id_cama']; ?>"><?php echo $filaciudad['nom_hab'].'--'.$filaciudad['nom_cama']; ?></option>
<?php
	}
?>
