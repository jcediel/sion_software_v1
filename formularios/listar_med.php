<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>

	<h1>Formula medica</h1>
	<table class="table table-responsive table-hover table-bordered">
		<tr>
			<th class="text-center">Medicamento</th>
			<th class="text-center">Dosis1</th>
			<th class="text-center">Dosis2</th>
			<th class="text-center">Dosis3</th>
			<th class="text-center">Dosis4</th>
			<th class="text-center">Dosis diaria</th>
			<th class="text-center"></th>
			<th class="text-center">Observacion</th>
			<th class="text-center">Editar</th>
			<th class="text-center">Dispensar</th>
		</tr>

		<?php
			include('conexion_new.php');
			$nombre=$_POST['nom1'];
			$idformula=$_GET['idformula'];
			$resultado = $conex->query("SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
	                 b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
	                 j.nom_eps,
	                 k.id_formula_hosp, tipo_formula, finicial, ffinal, med, via, frec, dosis1, dosis2, dosis3, dosis4, obs_formula, med1, via1, frec1, dosis11, dosis21, dosis31, dosis41, obs_formula1, med2, via2, frec2, dosis12, dosis22, dosis32, dosis42, obs_formula2, med3, via3, frec3, dosis13, dosis23, dosis33, dosis43, obs_formula3, med4, via4, frec4, dosis14, dosis24, dosis34, dosis44, obs_formula4, estado_formula_hosp
	          from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
	                           inner join eps j on (j.id_eps=b.id_eps)
	                           inner join formula_hospitalaria k on (k.id_adm_hosp=b.id_adm_hosp)

	          where k.id_formula_hosp='$idformula'");
						echo $sql;
			if($conex->errno) die($conex->error);
			while ($fila = $resultado ->fetch_assoc()){
		?>
		<tr>
			<td><?php echo $fila['med'] ?></td>
			<td><?php echo $fila['dosis1'] ?></td>
			<td><?php echo $fila['dosis2'] ?></td>
			<td><?php echo $fila['dosis3'] ?></td>
			<td><?php echo $fila['dosis4'] ?></td>
			<td class="text-center"><?php
			$d1=$fila['dosis1'];
			$d2=$fila['dosis2'];
			$d3=$fila['dosis3'];
			$d4=$fila['dosis4'];
			$c=$d1 + $d2 + $d3 + $d4;
			echo $c ?></td>
			<td><?php echo $fila['obs_formula'] ?></td>
			<td><a  class="btn btn-warning" href="editar.php?id=<?php echo $fila['id']; ?>">Editar</a></td>
			<td><a  class="btn btn-primary" href="borrar.php?id=<?php echo $fila['id']; ?>">Dispensar</a></td>
		</tr>
		<tr>
			<td><?php echo $fila['med1'] ?></td>
			<td><?php echo $fila['dosis11'] ?></td>
			<td><?php echo $fila['dosis21'] ?></td>
			<td><?php echo $fila['dosis31'] ?></td>
			<td><?php echo $fila['dosis41'] ?></td>
			<td class="text-center"><?php
			$d1=$fila['dosis11'];
			$d2=$fila['dosis21'];
			$d3=$fila['dosis31'];
			$d4=$fila['dosis41'];
			$c=$d1 + $d2 + $d3 + $d4;
			echo $c ?></td>
			<td><?php echo $fila['obs_formula1'] ?></td>
			<td><a  class="btn btn-warning" href="editar.php?id=<?php echo $fila['id']; ?>">Editar</a></td>
			<td><a  class="btn btn-primary" href="borrar.php?id=<?php echo $fila['id']; ?>">Dispensar</a></td>
		</tr>
		<tr>
			<td><?php echo $fila['med2'] ?></td>
			<td><?php echo $fila['dosis12'] ?></td>
			<td><?php echo $fila['dosis22'] ?></td>
			<td><?php echo $fila['dosis32'] ?></td>
			<td><?php echo $fila['dosis42'] ?></td>
			<td class="text-center"><?php
			$d1=$fila['dosis12'];
			$d2=$fila['dosis22'];
			$d3=$fila['dosis32'];
			$d4=$fila['dosis42'];
			$c=$d1 + $d2 + $d3 + $d4;
			echo $c ?></td>
			<td><?php echo $fila['obs_formula2'] ?></td>
			<td><a  class="btn btn-warning" href="editar.php?id=<?php echo $fila['id']; ?>">Editar</a></td>
			<td><a  class="btn btn-primary" href="borrar.php?id=<?php echo $fila['id']; ?>">Dispensar</a></td>
		</tr>
		<tr>
			<td><?php echo $fila['med3'] ?></td>
			<td><?php echo $fila['dosis13'] ?></td>
			<td><?php echo $fila['dosis23'] ?></td>
			<td><?php echo $fila['dosis33'] ?></td>
			<td><?php echo $fila['dosis43'] ?></td>
			<td class="text-center"><?php
			$d1=$fila['dosis13'];
			$d2=$fila['dosis23'];
			$d3=$fila['dosis33'];
			$d4=$fila['dosis43'];
			$c=$d1 + $d2 + $d3 + $d4;
			echo $c ?></td>
			<td><?php echo $fila['obs_formula3'] ?></td>
			<td><a  class="btn btn-warning" href="editar.php?id=<?php echo $fila['id']; ?>">Editar</a></td>
			<td><a  class="btn btn-primary" href="borrar.php?id=<?php echo $fila['id']; ?>">Dispensar</a></td>
		</tr>
		<tr>
			<td><?php echo $fila['med4'] ?></td>
			<td><?php echo $fila['dosis14'] ?></td>
			<td><?php echo $fila['dosis24'] ?></td>
			<td><?php echo $fila['dosis34'] ?></td>
			<td><?php echo $fila['dosis44'] ?></td>
			<td class="text-center"><?php
			$d1=$fila['dosis14'];
			$d2=$fila['dosis24'];
			$d3=$fila['dosis34'];
			$d4=$fila['dosis44'];
			$c=$d1 + $d2 + $d3 + $d4;
			echo $c ?></td>
			<td><?php echo $fila['obs_formula4'] ?></td>
			<td><a  class="btn btn-warning" href="editar.php?id=<?php echo $fila['id']; ?>">Editar</a></td>
			<td><a  class="btn btn-primary" href="borrar.php?id=<?php echo $fila['id']; ?>">Dispensar</a></td>
		</tr>
		<?php
			}
			mysqli_close($conex);
		?>
	</table>

</body>
</html>
