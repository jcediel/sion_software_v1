<!DOCTYPE html>
<html>
<head>
	<title>Usuarios</title>
	<script src="js/jquery.js"></script>
	<script>
			function mostrar(){
				var usuarios = $("#usuarios").val();
				$.ajax({
					url: "datosusuario.php",
					data: {idusuario:usuarios},
					type: "POST", 
					success: function(resultado){
	        			$("#datos").html(resultado);
	    			}
	    		});
	    	}

	</script>
</head>
<body>
	<?php include('conexion.php'); ?>
	<form>
		<select name="usuarios" id="usuarios" onchange="mostrar()">
			<option value="0">Seleccionar usuario</option>
			<?php 
				$sql_pais = "SELECT * FROM usuario";
				$resultado = $conex->query($sql_pais);
				if($conex->errno) die($conex->error);

				while ($fila = $resultado ->fetch_assoc()){
			?>
				<option value="<?php echo $fila['id'] ?>"><?php echo $fila['nombre']; ?></option>
			<?php 
				} 
			?>
		</select>
	</form>
	<div id="datos">
		
	</div>
	<?php mysqli_close($conex); ?>
</body>
</html>