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
			<h1>Listado de formulas medicas hospitalarias</h1>
		</section>
	<?php
		$adm=$_REQUEST['idadmhosp'];
		$sede=$_REQUEST['idsede'];
	 ?>

	 <section class="panel-body">
	 	<div class="col-md-12 text-right panel-body">
	 		<a class="btn btn-primary" href="new_formula.php?idadmhosp=<?php echo $_GET['idadmhosp']; ?>&idsede=<?php echo $_GET['idsede']; ?>&user=<?php echo $_GET['user']; ?>">Nueva Formula</a>
	 	</div>

		 <table class="table table-bordered table-hover">
			 <tr >
				 <th class="text-center alert alert-info">ID</th>
				 <th class="text-center alert alert-info">Fecha ejecucion</th>
				 <th class="text-center alert alert-info">Tipo formula</th>
				 <th class="text-center alert alert-info">Estado formula</th>
				 <th class="text-center alert alert-info">Consultar Detalle</th>
				 <th class="text-center alert alert-info">Agregar Medicamentos</th>
			 </tr>

			 <?php
				 include('config/conexion_new.php');
				 $resultado = $conex->query("SELECT * FROM maestro_formula_hosp order by fejecucion DESC");
				 if($conex->errno) die($conex->error);
				 while ($fila = $resultado ->fetch_assoc()){
			 ?>
			 <tr>
				 <td><?php echo $fila['id_mformula_hosp'] ?></td>
				 <td><?php echo $fila['fejecucion'] ?></td>
				 <td><?php echo $fila['tipo_formula'] ?></td>
				 <td><?php echo $fila['estado_mformula_hosp'] ?></td>
				 <td class="text-center"><a class="btn btn-success" href="editar.php?id=<?php echo $fila['id']; ?>"><span class="fa fa-eye"></span></a></td>
				 <td class="text-center"><a class="btn btn-warning" href="lista_medicamentos.php?idmformula=<?php echo $fila['id_mformula_hosp']; ?>"><span class="fa fa-plus"></span></a></td>
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
