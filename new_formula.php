<!DOCTYPE html>
<html>
<head>
	<title>Formulario de Registro</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.js"></script>
</head>
<body>
	<?php include('config/conexion_new.php'); ?>
	<?php include('config/config5.php'); ?>
	<h1>Registro de formulas</h1>
	<form action="add_formula.php" method="post">

		<article class="col-md-3">
			<label for="">Seleccion de bodega:</label>
			<input type="hidden" name="idadmhosp" value="<?php echo $_GET['idadmhosp'] ;?>">
			<input type="hidden" name="id_user" value="<?php echo $_GET['user'] ;?>">
			<input type="hidden" name="idsede" value="<?php echo $_GET['idsede'] ;?>">
			<select name="idbodega" class="form-control" id="bodega" onchange="mostrar()">
				<option value="0">Seleccionar Bodega</option>
				<?php
					$sql_pais = "SELECT * FROM bodega where id_sedes_ips=".$_GET['idsede'];
					$resultado = $conex->query($sql_pais);
					if($conex->errno) die($conex->error);

					while ($fila = $resultado ->fetch_assoc()){
				?>
					<option value="<?php echo $fila['id_bodega'] ?>"><?php echo $fila['nom_bodega']; ?></option>
				<?php
					}

				?>
			</select>
		</article>
		<article class="col-md-3">
			<label for="">Fecha Ejecucion:</label>
			<input type="date" class="form-control" name="fejecucion" value="" required="">
		</article>
		<article class="col-md-4">
			<label for="">Tipo formula:</label>
			<select class="form-control" name="tipo_formula" required="">
				<option value=""></option>
				<option value="Inmediata">Inmediata</option>
				<option value="Diaria">Diaria</option>
			</select>
		</article>
		<div class="row text-center">
			<input type="submit" class="btn btn-primary" value="Guardar Formula">
		</div>
	</form>

</body>
</html>
