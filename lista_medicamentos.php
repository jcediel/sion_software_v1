<!DOCTYPE html>
<html>
<head>
	<title>SIEMM</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.css">
</head>
<body>
	<section class="panel panel-default">
		<section class="panel-heading panel-primary">
			<h1>Listado de medicamentos hospitalarias</h1>
		</section>
	<?php
		include('config/conexion_new.php');
		$idformula=$_REQUEST['idmformula'];
		$sede=$_REQUEST['idsede'];
		$max = $conex->query("SELECT * FROM detalle_formula_hosp where id_mformula_hosp=".$idformula);

	 ?>

	 <section class="panel-body">
	 	<div class="col-md-12 text-right panel-body">
			<a class="btn btn-success" href="aplicacion5.php?opcion=19">Regresar a paciente</a>
			<a class="btn btn-primary" href="new_medicamento.php?idmformula=<?php echo $_GET['idmformula']; ?>"><span class="fa fa-plus"></span> Agregar medicamento</a>
	 	</div>

		 <table class="table table-bordered table-hover">
			 <tr >
				 <th class="text-center alert alert-info">Medicamento</th>
				 <th class="text-center alert alert-info">Via administracion</th>
				 <th class="text-center alert alert-info">Frecuencia</th>
				 <th class="text-center alert alert-info">Dosis1</th>
				 <th class="text-center alert alert-info">Dosis2</th>
				 <th class="text-center alert alert-info">Dosis3</th>
				 <th class="text-center alert alert-info">Dosis4</th>
				 <th class="text-center alert alert-info">Cantidad total</th>
				 <th class="text-center alert alert-info">Observacion</th>
				 <th colspan="3" class="text-center alert alert-info">Acciones</th>
			 </tr>

			 <?php
				 $resultado = $conex->query("SELECT * FROM detalle_formula_hosp where id_mformula_hosp in (select max(a.id_mformula_hosp) from maestro_formula_hosp a inner join detalle_formula_hosp b on a.id_mformula_hosp=b.id_mformula_hosp)");
				 if($conex->errno) die($conex->error);
				 while ($fila = $resultado ->fetch_assoc()){
			 ?>
			 <tr>
				 <td><?php echo $fila['med'] ?></td>
				 <td><?php echo $fila['via'] ?></td>
				 <td><?php echo $fila['frec'] ?></td>
				 <td><?php echo $fila['dosis1'] ?></td>
				 <td><?php echo $fila['dosis2'] ?></td>
				 <td><?php echo $fila['dosis3'] ?></td>
				 <td><?php echo $fila['dosis4'] ?></td>
				 <td><?php echo $fila['cant_dosis'] ?></td>
				 <td><?php echo $fila['obs_formula'] ?></td>
				 <td class="text-center"><a class="btn btn-warning" href="editar.php?id=<?php echo $fila['id']; ?>"><span class="fa fa-edit"> </span></a></td>
				 <td class="text-center"><a class="btn btn-danger" href="lista_medicamentos.php?idmformula=<?php echo $fila['id_mformula_hosp']; ?>"><span class="fa fa-minus"></span></a></td>
			 </tr>

			 <?php
				 }
				 mysqli_close($conex);
			 ?>
		 </table>
	 </section>
	</section>
</body>
</html>
