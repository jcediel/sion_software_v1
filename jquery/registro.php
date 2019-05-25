<!DOCTYPE html>
<html>
<head>
	<title>Formulario de Registro</title>
	<script src="js/jquery.js"></script>
	<script>
			function mostrar(){
				var pais = $("#pais").val();
				$.ajax({
					url: "ciudades.php",
					data: {idpais:pais},
					type: "POST",
					success: function(resultado){
	        			$("#ciudad").html(resultado);
	    			}
	    		});
	    	}

	</script>

</head>
<body>
	<?php include('conexion.php'); ?>
	<h1>Formulario de Registro</h1>
	<form action="guarda.php" method="post">
		Nombre: <input type="text" name="nombre" required><br>
		Email: <input type="email" name="email" required><br>
		Genero:
			<input type="radio" name="genero" value="mujer"> Mujer
			<input type="radio" name="genero" value="hombre"> Hombre<br>
		Pais:
		<select name="pais" id="pais" onchange="mostrar()">
			<option value="0">Seleccionar pais</option>
			<?php
				$sql_pais = "SELECT * FROM sedes_ips";
				$resultado = $conex->query($sql_pais);
				if($conex->errno) die($conex->error);

				while ($fila = $resultado ->fetch_assoc()){
			?>
				<option value="<?php echo $fila['id_sedes_ips'] ?>"><?php echo $fila['nom_sedes']; ?></option>
			<?php
				}
				mysqli_close($conex);
			?>

		</select><br>
		Ciudad: <select name="ciudad" id="ciudad">

		</select><br>
		Comentarios:<br>
			<textarea name="comentario"></textarea><br>
			<input type="submit" value="Guardar Datos">

	</form>

</body>
</html>
