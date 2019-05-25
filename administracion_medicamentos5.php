<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["fotopac"])){
				if (is_uploaded_file($_FILES["fotopac"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["fotopac"]["name"]);
					$archivo=$_POST["docpac"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["fotopac"]["tmp_name"],LOG.PACIENTES.$archivo)){
						$fotoE=",fotopac='".PACIENTES.$archivo."'";
						$fotoA1=",fotopac";
						$fotoA2=",'".PACIENTES.$archivo."'";
						}
				}
			}
			switch ($_POST["operacion"]) {
			case 'ADMMED':
			$sql="UPDATE dosificacion_med SET fadmin='".$_POST["fadmin"]."', nom_admin='".$_POST["nom_dosi"]."',
			cant_admin='".$_POST["cant_admin"]."',hora_admin='".$_POST["hora_admin"]."', estado_admin='Administrado', obs_admin='".$_POST["obs_admin"]."',
			resp_adm='".$_SESSION["AUT"]["id_user"]."' WHERE id_dosi_med='".$_POST["idd"]."'";
				$subtitulo="administrado";
			break;

			case 'DEVMED':
			$sql="UPDATE dosificacion_med SET fadmin='".$_POST["fadmin"]."', nom_admin='".$_POST["nom_dosi"]."',
			cant_admin='".$_POST["cant_admin"]."',hora_admin='".$_POST["hora_admin"]."', estado_admin='Devuelto', obs_admin='".$_POST["obs_admin"]."',
			resp_adm='".$_SESSION["AUT"]["id_user"]."' WHERE id_dosi_med='".$_POST["idd"]."'";
				$subtitulo="devuelto";
			break;

		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El medicamento fue $subtitulo con exito!";
		$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="El medicamento NO fue $subtitulo !!!!";
		$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {

			case 'ADMMED':
      $sql="SELECT * FROM dosificacion_med WHERE id_dosi_med=".$_GET['iddosi'] ;
			$boton="Administrar Medicamento";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['adm'];
			$return1=$_REQUEST['doc'];
			$return2=$_REQUEST['sede'];
			$form1='formulariosMED/administrar_medicamento.php';
			$subtitulo='';
			break;
			case 'DEVMED':
			$sql="SELECT * FROM dosificacion_med WHERE id_dosi_med=".$_GET['iddosi'] ;
			$boton="Devolver medicamento";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['adm'];
			$return=$_REQUEST['adm'];
			$return1=$_REQUEST['doc'];
			$return2=$_REQUEST['sede'];
			$form1='formulariosMED/administrar_medicamento.php';
			$subtitulo='';
			break;

		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_dosi_med"=>"","freg_farmacia"=>"","nom_dosi"=>"","cant_dosi"=>"","obs_dosi"=>"");
			}
		}else{
				$fila=array("id_dosi_med"=>"","freg_farmacia"=>"","nom_dosi"=>"","cant_dosi"=>"","obs_dosi"=>"");
			}

		?>

		<script type="text/javascript" src="/js/jquery.js"></script>

		<div class="alert alert-info animated bounceInRight">		</div>

		<?php include($form1);?>

<?php
}else{
	if ($check=='si') {
		echo '<div class="alert alert-success animated bounceInRight">';
		echo $subtitulo;
		echo '</div>';
	}else {
		echo '<div class="alert alert-danger animated bounceInRight">';
		echo $subtitulo;
		echo '</div>';
	}
// nivel 1?>
<section class="panel panel-default">
	<section class="panel-body">
		<section class="col-xs-9">
			<?php include('pacienteIDV.php');?>
		</section>
		<section class="col-xs-3 text-right">
				<button data-toggle="collapse" class="btn btn-primary text-center" data-target="#demo"><h4>Ver formula medica<strong><?php echo $_REQUEST['f']; ?></strong><h4><span class="glyphicon glyphicon-arrow-down"></span> </button>
		</section>
	</section>
	<section id="demo" class="collapse">
	<table class="table table-bordered table-responsive">
		<thead class="thead-inverse ">
			<tr>
				<th class="text-center danger">ID</th>
				<th class="text-center danger">MEDICAMENTO</th>
				<th class="text-center danger">6am-8am</th>
				<th class="text-center danger">12m-2pm</th>
				<th class="text-center danger">6pm-8pm</th>
				<th class="text-center danger">10pm-12pm</th>
				<th class="text-center danger">OBSERVACION</th>
			</tr>
		</thead>
		<?php
		if (isset($_REQUEST["doc"])){
			$fa=date('Y-m-d');
			$doc=$_REQUEST["doc"];
			$fbus=$fa;
			$sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
									 b.id_adm_hosp,
									 c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,
									 d.id_d_fmedhosp,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4,obsfmedhosp
					FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
													 INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
													 INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)

					WHERE a.doc_pac='".$_REQUEST['doc']."' and c.id_bodega in (2,3)
																								 and b.estado_adm_hosp='Activo'
																								 and c.estado_m_fmedhosp='Solicitado'
																								 and d.estado_med='Solicitado'
																								 and fejecucion_final >='$fa'  ";

					//echo $sql;
					if ($fila2['cant_dosi']=='') {
						# code...
					}

		if ($tabla=$bd1->sub_tuplas($sql)){
			foreach ($tabla as $fila ) {

				if ($fila["id_d_fmedhosp"]!='') {
						echo"<tr >\n";
						echo'<td class="text-center">'.$fila["id_d_fmedhosp"].'</td>';
						echo'<th class="text-center">'.$fila["medicamento"].' <br> '.$fila["via"].' <br> '.$fila["frecuencia"].' Horas</th>';
							if ($fila['dosis1']==0) {
								echo'<td class="text-center"><h5><u>'.$fila["dosis1"].'</u></h5></td>';
							}
							if ($fila['dosis1']>0) {
									echo'<td class="text-center">';
										echo'
											<article class="col-xs-12 alert alert-info">
												<label>Solicitado</label>
												<span class="badge"> '.$fila["dosis1"].'</span>
											</article>';

										$sql2="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
																 b.id_adm_hosp,
								        			 	 c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,
								        			 	 d.id_d_fmedhosp,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4,obsfmedhosp,
															 	 e.id_dosi_med, freg_farmacia, nom_dosi, cant_dosi, estado_dosi, obs_dosi
												FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
								                         INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
								            						 INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
								            						 LEFT JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
											  WHERE e.id_d_fmedhosp='".$fila['id_d_fmedhosp']."' and c.estado_m_fmedhosp='solicitado'
												and e.nom_dosi='6am-8am' and freg_farmacia='$fbus'";
												//echo $sql2;
												if ($tabla2=$bd1->sub_tuplas($sql2)){
													foreach ($tabla2 as $fila2 ) {

															echo'
															<article class="col-xs-12 alert alert-danger">
																<label>Dispensado</label>
																<span class="badge">'.$fila2["cant_dosi"].'</span>
															</article>';

													}
												}
									echo'</td>';
							}
							if ($fila['dosis2']==0) {
								echo'<td class="text-center"><h5><u>'.$fila["dosis2"].'</u></h5></td>';
							}else {
								echo'<td class="text-center">';
									echo'
										<article class="col-xs-12 alert alert-info">
											<label>Solicitado</label>
											<span class="badge"> '.$fila["dosis2"].'</span>
										</article>';

									$sql2="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
															 b.id_adm_hosp,
															 c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,
															 d.id_d_fmedhosp,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4,obsfmedhosp,
															 e.id_dosi_med, freg_farmacia, nom_dosi, cant_dosi, estado_dosi, obs_dosi
											FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
																			 INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
																			 INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
																			 LEFT JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
											WHERE e.id_d_fmedhosp='".$fila['id_d_fmedhosp']."' and c.estado_m_fmedhosp='solicitado'
											and e.nom_dosi='12m-2pm' and freg_farmacia='$fbus'";
											//echo $sql2;
											if ($tabla2=$bd1->sub_tuplas($sql2)){
												foreach ($tabla2 as $fila2 ) {
													if ($fila2['cant_dosi']=='') {
														# code...
													}
													echo'
													<article class="col-xs-12 alert alert-danger">
														<label>Dispensado</label>
														<span class="badge">'.$fila2["cant_dosi"].'</span>
													</article>';
												}
											}
								echo'</td>';
							}
							if ($fila['dosis3']==0) {
								echo'<td class="text-center"><h5><u>'.$fila["dosis3"].'</u></h5></td>';
							}else {
								echo'<td class="text-center">';
									echo'
										<article class="col-xs-12 alert alert-info">
											<label>Solicitado</label>
											<span class="badge"> '.$fila["dosis3"].'</span>
										</article>';

									$sql2="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
															 b.id_adm_hosp,
															 c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,
															 d.id_d_fmedhosp,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4,obsfmedhosp,
															 e.id_dosi_med, freg_farmacia, nom_dosi, cant_dosi, estado_dosi, obs_dosi
											FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
																			 INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
																			 INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
																			 LEFT JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
											WHERE e.id_d_fmedhosp='".$fila['id_d_fmedhosp']."' and c.estado_m_fmedhosp='solicitado'
											and e.nom_dosi='6pm-8pm' and freg_farmacia='$fbus'";
											//echo $sql2;
											if ($tabla2=$bd1->sub_tuplas($sql2)){
												foreach ($tabla2 as $fila2 ) {
													if ($fila2['cant_dosi']=='') {
														# code...
													}
													echo'
													<article class="col-xs-12 alert alert-danger">
														<label>Dispensado</label>
														<span class="badge">'.$fila2["cant_dosi"].'</span>
													</article>';
												}
											}
								echo'</td>';
							}
							if ($fila['dosis4']==0) {
								echo'<td class="text-center"><h5><u>'.$fila["dosis4"].'</u></h5></td>';
							}else {
								echo'<td class="text-center">';
									echo'
										<article class="col-xs-12 alert alert-info text-left">
											<label>Solicitado</label>
											<span class="badge"> '.$fila["dosis4"].'</span>
										</article>';

									$sql2="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
															 b.id_adm_hosp,
															 c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,
															 d.id_d_fmedhosp,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4,obsfmedhosp,
															 e.id_dosi_med, freg_farmacia, nom_dosi, cant_dosi, estado_dosi, obs_dosi
											FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
																			 INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
																			 INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
																			 LEFT JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
											WHERE e.id_d_fmedhosp='".$fila['id_d_fmedhosp']."' and c.estado_m_fmedhosp='solicitado' and e.nom_dosi='10pm-12pm and freg_farmacia='$fbus'";
											//echo $sql2;
											if ($tabla2=$bd1->sub_tuplas($sql2)){
												foreach ($tabla2 as $fila2 ) {
													echo'
													<article class="col-xs-12 alert alert-danger">
														<label>Dispensado</label>
														<span class="badge">'.$fila2["cant_dosi"].'</span>
													</article>';
												}
											}
								echo'</td>';
							}
						echo'<td class="text-center">'.$fila["obsfmedhosp"].'</td>';

						echo"</tr >\n";
				}

			}
		}
		}
		?>
		</table>
</section>
	<section class="panel-heading"><h2>Administración de medicamentos</h2></section>
	<section class="panel-body">
		<section class="panel-body col-xs-12">
			<?php
				$sede=$_REQUEST['sede'];
				$fecha=$_REQUEST['f'];
			 ?>
				<article class="col-md-6">
					<a class="btn btn-success" href="<?php echo PROGRAMA.'?sede='.$sede.'&f='.$fecha.'&buscar=Buscar&opcion=162';?>"><span class="glyphicon glyphicon-triangle-left">Regresar a consultar paciente</span></a>
				</article>
				<?php
				date_default_timezone_set('America/Bogota');
				$hora=date('H:i');
				$fecha=date('Y-m-d');
				echo '<article class="col-md-6">
								<strong>Hora actual:</strong>'.$hora.'  <strong>Fecha actual:</strong>'.$fecha.'
							</article>';
				 ?>
		</section>
		<?php
		////////////////// CONEXION A LA BASE DE DATOS //////////////////

		$host = 'localhost';
		$basededatos = 'emmanuelips';
		$usuario = 'root';
		$contraseña = '515t3m45';



		$conexion = new mysqli($host, $usuario,$contraseña, $basededatos);
		if ($conexion -> connect_errno) {
		die( "Fallo la conexión : (" . $conexion -> mysqli_connect_errno()
		. ") " . $conexion -> mysqli_connect_error());
		}
		?>
		<form  method='post'>
		<table class="table table-sm table-bordered">
		<tr>

			<th class="text-center"><ins>MEDICAMENTO</ins></th>
      <th class="text-center"><ins>DETALLES</ins></th>
			<th class="text-center"><ins>ADMINISTRACION</ins></th>
			<th class="text-center"><ins>ACCION</ins></th>
		</tr>

			<?php
			if (isset($_REQUEST["idadmhosp"])){
        $fecha=date('Y-m-d');

				//FRANJA DE ADMINISTRACION MEDICAMENTOS DE 6am-8am
				if ($hora > '05:00' && $hora < '9:00') {
					$sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
											 b.id_adm_hosp,
											 c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,
											 d.id_d_fmedhosp, medicamento, via,frecuencia, obsfmedhosp,
											 e.id_dosi_med, freg_farmacia, nom_dosi, cant_dosi, estado_dosi, obs_dosi, fadmin, hora_admin ,nom_admin, cant_admin, estado_admin, obs_admin,
											 f.nombre
								FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
																 LEFT JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
																 LEFT JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
																 LEFT  JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
																 LEFT  JOIN user f on (f.id_user=e.resp_adm)

								WHERE b.id_adm_hosp='".$_REQUEST['idadmhosp']."' and  nom_dosi='6am-8am' and freg_farmacia='".$fecha."' and cant_dosi > 0 ";
			//echo $sql;
					if ($tabla=$bd1->sub_tuplas($sql)){

						foreach ($tabla as $fila ) {
							$hoy=date('Y-m-d');
							$ahora=date('H:i');
							if ($fila['estado_admin']=='') {
								echo"<tr >	\n";
								echo'<td class="text-center alert warning">'.$fila["medicamento"].' | '.$fila["via"].' | '.$fila["frecuencia"].' Horas</td>';
								echo'<td class="text-center alert warning">
											<p><strong>Franja: </strong>'.$fila["nom_dosi"].'</p>
											<p><strong>Cantidad: </strong>'.$fila["cant_dosi"].'</p>
											<p><strong>Observación: </strong>'.$fila["obsfmedhosp"].'</p>
										 </td>';
								echo'<td class="text-center alert-warning animated zoomIn text-danger">
											<section class="col-md-12 col-xs-12">
												<article class="col-xs-6">
													<label>Fecha: </label>
													<input type="date" class="form-control" required name="fadmin[]" value="'.$hoy.'">
												</article>
												<article class="col-xs-6">
													<label>Hora: </label>
													<input type="time" class="form-control" required name="hora_admin[]" value="'.$ahora.'">
												</article>
												<article class="col-xs-4">
													<label>Franja: </label>
													<input type="text" class="form-control" required name="nom_admin[]" value="'.$fila["nom_dosi"].'" readonly="readonly"">
												</article>
												<article class="col-xs-3">
													<label>Cant: </label>
													<input type="number" class="form-control" required name="cant_admin[]" value="'.$fila["cant_dosi"].'">
												</article>
												<article class="col-xs-5">
													<label>Estado: </label>
													<select class="form-control" required name="estado_admin[]">
														<option value=""></option>
														<option value="Administrado">Administrado</option>
														<option value="Devuelto">Devuelto</option>
													</select>
													<input type="hidden" class="form-control" required name="id_dosi_med[]" value="'.$fila["id_dosi_med"].'">
													<input type="hidden" class="form-control" required name="resp_admin[]" value="'.$_SESSION['AUT']["id_user"].'">
												</article>
												<article class="col-xs-12">
													<label>Observación: </label>
													<textarea class="form-control" required name="obs_admin[]"></textarea>
												</article>
											</section>
	 			 						 </td>';
		 						echo'<td class="text-center alert-warning animated zoomIn text-danger">
		 									<p><span class="fa fa-stop-circle fa-2x animated shake ">  </span> <strong>Medicamento Pendiente por administración<strong></p>
		 									<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADMMED&iddosi='.$fila["id_dosi_med"].'&adm='.$_REQUEST['idadmhosp'].'&doc='.$_REQUEST['doc'].'&sede='.$_REQUEST['sede'].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-check"></span> Administrar </button></a></p>
		 									<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DEVMED&iddosi='.$fila["id_dosi_med"].'&adm='.$_REQUEST['idadmhosp'].'&doc='.$_REQUEST['doc'].'&sede='.$_REQUEST['sede'].'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-minus"></span> Devolver</button></a></p>
		 								 </td>';
								echo "</tr>\n";
							}
							if ($fila['estado_admin']=='Administrado') {
								echo"<tr >	\n";
								echo'<td class="text-center alert-success">'.$fila["medicamento"].' | '.$fila["via"].' | '.$fila["frecuencia"].' Horas</td>';
								echo'<td class="text-center alert success">
											<p><strong>Franja: </strong>'.$fila["nom_dosi"].'</p>
											<p><strong>Cantidad: </strong>'.$fila["cant_dosi"].'</p>
											<p><strong>Observación: </strong>'.$fila["obsfmedhosp"].'</p>
										 </td>';
								echo'<td class="text-center alert-success">
											<p><strong>Fecha: </strong>'.$fila["fadmin"].'-'.$fila["nom_dosi"].'</p>
											<p><strong>Franja: </strong>'.$fila["nom_admin"].'</p>
											<p><strong>Cantidad Administrada: </strong>'.$fila["cant_admin"].'</p>
											<p><strong>Observación: </strong>'.$fila["obs_admin"].'</p>
										 </td>';
								echo'<td class="text-center alert-success animated zoomIn text-success">
		 		 							<p><span class="fa fa-check-circle fa-2x animated shake ">  </span> <strong>Medicamento '.$fila['estado_admin'].'<strong></p>
											<p>Administró: <strong>'.$fila['nombre'].'<strong></p>
		 		 						 </td>';
								echo "</tr>\n";
							}
							if ($fila['estado_admin']=='Devuelto') {
								echo"<tr >	\n";
								echo'<td class="text-center alert-danger">'.$fila["medicamento"].' | '.$fila["via"].' | '.$fila["frecuencia"].' Horas</td>';
								echo'<td class="text-center alert danger">
											<p><strong>Franja: </strong>'.$fila["nom_dosi"].'</p>
											<p><strong>Cantidad: </strong>'.$fila["cant_dosi"].'</p>
											<p><strong>Observación: </strong>'.$fila["obsfmedhosp"].'</p>
										 </td>';
								echo'<td class="text-center alert-danger">
											<p><strong>Fecha: </strong>'.$fila["fadmin"].'-'.$fila["nom_dosi"].'</p>
											<p><strong>Franja: </strong>'.$fila["nom_admin"].'</p>
											<p><strong>Cantidad Devuelta: </strong>'.$fila["cant_admin"].'</p>
											<p><strong>Observación: </strong>'.$fila["obs_admin"].'</p>
										 </td>';
								echo'<td class="text-center alert-danger animated zoomIn text-danger">
		 		 							<p><span class="fa fa-undo fa-2x animated shake ">  </span> <strong>Medicamento '.$fila['estado_admin'].'<strong></p>
											<p>Devolvio: <strong>'.$fila['nombre'].'<strong></p>
		 		 						 </td>';
								echo "</tr>\n";
							}

						}
					}
				}
//FRANJA DE ADMINISTRACION MEDICAMENTOS DE 12m-2pm
				if ($hora > '11:00' && $hora < '14:00') {
				  $sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
				               b.id_adm_hosp,
				               c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,
				               d.id_d_fmedhosp, medicamento, via,frecuencia, obsfmedhosp,
				               e.id_dosi_med, freg_farmacia, nom_dosi, cant_dosi, estado_dosi, obs_dosi, fadmin, hora_admin , nom_admin, cant_admin, estado_admin, obs_admin,
											 f.nombre
				        FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
				                         LEFT JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
				                         LEFT JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
				                         LEFT  JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
																 LEFT  JOIN user f on (f.id_user=e.resp_adm)

				        WHERE b.id_adm_hosp='".$_REQUEST['idadmhosp']."' and  nom_dosi in ('6am-8am','12m-2pm') and freg_farmacia='".$fecha."'  and cant_dosi > 0";
				 //echo $sql;
				  if ($tabla=$bd1->sub_tuplas($sql)){

				    foreach ($tabla as $fila ) {
							$hoy=date('Y-m-d');
							$ahora=date('H:i');
							if ($fila['estado_admin']=='') {
								echo"<tr >	\n";
								echo'<td class="text-center alert warning">'.$fila["medicamento"].' | '.$fila["via"].' | '.$fila["frecuencia"].' Horas</td>';
								echo'<td class="text-center alert warning">
											<p><strong>Franja: </strong>'.$fila["nom_dosi"].'</p>
											<p><strong>Cantidad: </strong>'.$fila["cant_dosi"].'</p>
											<p><strong>Observación: </strong>'.$fila["obsfmedhosp"].'</p>
										 </td>';
								echo'<td class="text-center alert-warning animated zoomIn text-danger">
											<section class="col-md-12 col-xs-12">
												<article class="col-xs-6">
													<label>Fecha: </label>
													<input type="date" class="form-control" required name="fadmin[]" value="'.$hoy.'">
												</article>
												<article class="col-xs-6">
													<label>Hora: </label>
													<input type="time" class="form-control" required name="hora_admin[]" value="'.$ahora.'">
												</article>
												<article class="col-xs-4">
													<label>Franja: </label>
													<input type="text" class="form-control" required name="nom_admin[]" value="'.$fila["nom_dosi"].'" readonly="readonly"">
												</article>
												<article class="col-xs-3">
													<label>Cant: </label>
													<input type="number" class="form-control" required name="cant_admin[]" value="'.$fila["cant_dosi"].'">
												</article>
												<article class="col-xs-5">
													<label>Estado: </label>
													<select class="form-control" required name="estado_admin[]">
														<option value=""></option>
														<option value="Administrado">Administrado</option>
														<option value="Devuelto">Devuelto</option>
													</select>
												</article>

												<article class="col-xs-12">
													<label>Observación: </label>
													<textarea class="form-control" required name="obs_admin[]"></textarea>
													<input type="hidden" class="form-control" required name="id_dosi_med[]" value="'.$fila["id_dosi_med"].'">
													<input type="hidden" class="form-control" required name="resp_admin[]" value="'.$_SESSION['AUT']["id_user"].'">
												</article>
											</section>
	 			 						 </td>';
		 						echo'<td class="text-center alert-warning animated zoomIn text-danger">
		 									<p><span class="fa fa-stop-circle fa-2x animated shake ">  </span> <strong>Medicamento Pendiente por administración<strong></p>
		 									<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADMMED&iddosi='.$fila["id_dosi_med"].'&adm='.$_REQUEST['idadmhosp'].'&doc='.$_REQUEST['doc'].'&sede='.$_REQUEST['sede'].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-check"></span> Administrar </button></a></p>
		 									<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DEVMED&iddosi='.$fila["id_dosi_med"].'&adm='.$_REQUEST['idadmhosp'].'&doc='.$_REQUEST['doc'].'&sede='.$_REQUEST['sede'].'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-minus"></span> Devolver</button></a></p>
		 								 </td>';
								echo "</tr>\n";
							}
							if ($fila['estado_admin']=='Administrado') {
								echo"<tr >	\n";
								echo'<td class="text-center alert-success">'.$fila["medicamento"].' | '.$fila["via"].' | '.$fila["frecuencia"].' Horas</td>';
								echo'<td class="text-center alert success">
											<p><strong>Franja: </strong>'.$fila["nom_dosi"].'</p>
											<p><strong>Cantidad: </strong>'.$fila["cant_dosi"].'</p>
											<p><strong>Observación: </strong>'.$fila["obsfmedhosp"].'</p>
										 </td>';
								echo'<td class="text-center alert-success">
											<p><strong>Fecha: </strong>'.$fila["fadmin"].'-'.$fila["nom_dosi"].'</p>
											<p><strong>Franja: </strong>'.$fila["nom_admin"].'</p>
											<p><strong>Cantidad Administrada: </strong>'.$fila["cant_admin"].'</p>
											<p><strong>Observación: </strong>'.$fila["obs_admin"].'</p>
										 </td>';
								echo'<td class="text-center alert-success animated zoomIn text-success">
		 		 							<p><span class="fa fa-check-circle fa-2x animated shake ">  </span> <strong>Medicamento '.$fila['estado_admin'].'<strong></p>
											<p>Administró: <strong>'.$fila['nombre'].'<strong></p>
		 		 						 </td>';
								echo "</tr>\n";
							}
							if ($fila['estado_admin']=='Devuelto') {
								echo"<tr >	\n";
								echo'<td class="text-center alert-danger">'.$fila["medicamento"].' | '.$fila["via"].' | '.$fila["frecuencia"].' Horas</td>';
								echo'<td class="text-center alert danger">
											<p><strong>Franja: </strong>'.$fila["nom_dosi"].'</p>
											<p><strong>Cantidad: </strong>'.$fila["cant_dosi"].'</p>
											<p><strong>Observación: </strong>'.$fila["obsfmedhosp"].'</p>
										 </td>';
								echo'<td class="text-center alert-danger">
											<p><strong>Fecha: </strong>'.$fila["fadmin"].'-'.$fila["nom_dosi"].'</p>
											<p><strong>Franja: </strong>'.$fila["nom_admin"].'</p>
											<p><strong>Cantidad Devuelta: </strong>'.$fila["cant_admin"].'</p>
											<p><strong>Observación: </strong>'.$fila["obs_admin"].'</p>
										 </td>';
								echo'<td class="text-center alert-danger animated zoomIn text-danger">
		 		 							<p><span class="fa fa-undo fa-2x animated shake ">  </span> <strong>Medicamento '.$fila['estado_admin'].'<strong></p>
											<p>Devolvio: <strong>'.$fila['nombre'].'<strong></p>
		 		 						 </td>';
								echo "</tr>\n";
							}
				    }
				  }
				}
//FRANJA DE ADMINISTRACION MEDICAMENTOS DE 6pm-8pm
				if ($hora > '17:00' && $hora < '22:00') {
				  $sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
				               b.id_adm_hosp,
				               c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,
				               d.id_d_fmedhosp, medicamento, via,frecuencia, obsfmedhosp,
				               e.id_dosi_med, freg_farmacia, nom_dosi, cant_dosi, estado_dosi, obs_dosi, fadmin, hora_admin , nom_admin, cant_admin, estado_admin, obs_admin,
											 f.nombre
				        FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
				                         LEFT JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
				                         LEFT JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
				                         LEFT  JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
																 LEFT  JOIN user f on (f.id_user=e.resp_adm)

				        WHERE b.id_adm_hosp='".$_REQUEST['idadmhosp']."' and  nom_dosi  in ('6am-8am','12m-2pm','6pm-8pm') and freg_farmacia='".$fecha."'  and cant_dosi > 0";
				  //echo $sql;
				  if ($tabla=$bd1->sub_tuplas($sql)){

				    foreach ($tabla as $fila ) {
							$hoy=date('Y-m-d');
							$ahora=date('H:i');
							if ($fila['estado_admin']=='') {
								echo"<tr >	\n";
								echo'<td class="text-center alert warning">'.$fila["medicamento"].' | '.$fila["via"].' | '.$fila["frecuencia"].' Horas</td>';
								echo'<td class="text-center alert warning">
											<p><strong>Franja: </strong>'.$fila["nom_dosi"].'</p>
											<p><strong>Cantidad: </strong>'.$fila["cant_dosi"].'</p>
											<p><strong>Observación: </strong>'.$fila["obsfmedhosp"].'</p>
										 </td>';
								echo'<td class="text-center alert-warning animated zoomIn text-danger">
											<section class="col-md-12 col-xs-12">
												<article class="col-xs-6">
													<label>Fecha: </label>
													<input type="date" class="form-control" required name="fadmin[]" value="'.$hoy.'">
												</article>
												<article class="col-xs-6">
													<label>Hora: </label>
													<input type="time" class="form-control" required name="hora_admin[]" value="'.$ahora.'">
												</article>
												<article class="col-xs-4">
													<label>Franja: </label>
													<input type="text" class="form-control" required name="nom_admin[]" value="'.$fila["nom_dosi"].'" readonly="readonly"">
												</article>
												<article class="col-xs-3">
													<label>Cant: </label>
													<input type="number" class="form-control" required name="cant_admin[]" value="'.$fila["cant_dosi"].'">
												</article>
												<article class="col-xs-5">
													<label>Estado: </label>
													<select class="form-control" required name="estado_admin[]">
														<option value=""></option>
														<option value="Administrado">Administrado</option>
														<option value="Devuelto">Devuelto</option>
													</select>
												</article>

												<article class="col-xs-12">
													<label>Observación: </label>
													<textarea class="form-control" required name="obs_admin[]"></textarea>
													<input type="hidden" class="form-control" required name="id_dosi_med[]" value="'.$fila["id_dosi_med"].'">
													<input type="hidden" class="form-control" required name="resp_admin[]" value="'.$_SESSION['AUT']["id_user"].'">
												</article>
											</section>

											<p></p>
										 </td>';
								echo'<td class="text-center alert-warning animated zoomIn text-danger">
											<p><span class="fa fa-stop-circle fa-2x animated shake ">  </span> <strong>Medicamento Pendiente por administración<strong></p>
											<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADMMED&iddosi='.$fila["id_dosi_med"].'&adm='.$_REQUEST['idadmhosp'].'&doc='.$_REQUEST['doc'].'&sede='.$_REQUEST['sede'].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-check"></span> Administrar </button></a></p>
											<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DEVMED&iddosi='.$fila["id_dosi_med"].'&adm='.$_REQUEST['idadmhosp'].'&doc='.$_REQUEST['doc'].'&sede='.$_REQUEST['sede'].'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-minus"></span> Devolver</button></a></p>
										 </td>';
								echo "</tr>\n";
							}
							if ($fila['estado_admin']=='Administrado') {
								echo"<tr >	\n";
								echo'<td class="text-center alert-success">'.$fila["medicamento"].' | '.$fila["via"].' | '.$fila["frecuencia"].' Horas</td>';
								echo'<td class="text-center alert success">
											<p><strong>Franja: </strong>'.$fila["nom_dosi"].'</p>
											<p><strong>Cantidad: </strong>'.$fila["cant_dosi"].'</p>
											<p><strong>Observación: </strong>'.$fila["obsfmedhosp"].'</p>
										 </td>';
								echo'<td class="text-center alert-success">
											<p><strong>Fecha: </strong>'.$fila["fadmin"].'-'.$fila["nom_dosi"].'</p>
											<p><strong>Franja: </strong>'.$fila["nom_admin"].'</p>
											<p><strong>Cantidad Administrada: </strong>'.$fila["cant_admin"].'</p>
											<p><strong>Observación: </strong>'.$fila["obs_admin"].'</p>
										 </td>';
								echo'<td class="text-center alert-success animated zoomIn text-success">
											<p><span class="fa fa-check-circle fa-2x animated shake ">  </span> <strong>Medicamento '.$fila['estado_admin'].'<strong></p>
											<p>Administró: <strong>'.$fila['nombre'].'<strong></p>
										 </td>';
								echo "</tr>\n";
							}
							if ($fila['estado_admin']=='Devuelto') {
								echo"<tr >	\n";
								echo'<td class="text-center alert-danger">'.$fila["medicamento"].' | '.$fila["via"].' | '.$fila["frecuencia"].' Horas</td>';
								echo'<td class="text-center alert danger">
											<p><strong>Franja: </strong>'.$fila["nom_dosi"].'</p>
											<p><strong>Cantidad: </strong>'.$fila["cant_dosi"].'</p>
											<p><strong>Observación: </strong>'.$fila["obsfmedhosp"].'</p>
										 </td>';
								echo'<td class="text-center alert-danger">
											<p><strong>Fecha: </strong>'.$fila["fadmin"].'-'.$fila["nom_dosi"].'</p>
											<p><strong>Franja: </strong>'.$fila["nom_admin"].'</p>
											<p><strong>Cantidad Devuelta: </strong>'.$fila["cant_admin"].'</p>
											<p><strong>Observación: </strong>'.$fila["obs_admin"].'</p>
										 </td>';
								echo'<td class="text-center alert-danger animated zoomIn text-danger">
											<p><span class="fa fa-undo fa-2x animated shake ">  </span> <strong>Medicamento '.$fila['estado_admin'].'<strong></p>
											<p>Devolvio: <strong>'.$fila['nombre'].'<strong></p>
										 </td>';
								echo "</tr>\n";
							}
				    }
				  }
				}
//FRANJA DE ADMINISTRACION MEDICAMENTOS DE 10pm-12pm
				if ($hora > '23:00' && $hora < '23:55') {
				  $sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
				               b.id_adm_hosp,
				               c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,
				               d.id_d_fmedhosp, medicamento, via,frecuencia, obsfmedhosp,
				               e.id_dosi_med, freg_farmacia, nom_dosi, cant_dosi, estado_dosi, obs_dosi, fadmin, hora_admin , nom_admin, cant_admin, estado_admin, obs_admin,
											 f.nombre
				        FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
				                         LEFT JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
				                         LEFT JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
				                         LEFT  JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
																 LEFT  JOIN user f on (f.id_user=e.resp_adm)

				        WHERE b.id_adm_hosp='".$_REQUEST['idadmhosp']."' and  nom_dosi in ('6am-8am','12m-2pm','6pm-8pm','10pm-12pm') and freg_farmacia='".$fecha."'  and cant_dosi > 0";
				  //echo $sql;
				  if ($tabla=$bd1->sub_tuplas($sql)){

				    foreach ($tabla as $fila ) {
							$hoy=date('Y-m-d');
							$ahora=date('H:i');
							if ($fila['estado_admin']=='') {
								echo"<tr >	\n";
								echo'<td class="text-center alert warning">'.$fila["medicamento"].' | '.$fila["via"].' | '.$fila["frecuencia"].' Horas</td>';
								echo'<td class="text-center alert warning">
											<p><strong>Franja: </strong>'.$fila["nom_dosi"].'</p>
											<p><strong>Cantidad: </strong>'.$fila["cant_dosi"].'</p>
											<p><strong>Observación: </strong>'.$fila["obsfmedhosp"].'</p>
										 </td>';
								echo'<td class="text-center alert-warning animated zoomIn text-danger">
											<section class="col-md-12 col-xs-12">
												<article class="col-xs-6">
													<label>Fecha: </label>
													<input type="date" class="form-control" required name="fadmin[]" value="'.$hoy.'">
												</article>
												<article class="col-xs-6">
													<label>Hora: </label>
													<input type="time" class="form-control" required name="hora_admin[]" value="'.$ahora.'">
												</article>
												<article class="col-xs-4">
													<label>Franja: </label>
													<input type="text" class="form-control" required name="nom_admin[]" value="'.$fila["nom_dosi"].'" readonly="readonly"">
												</article>
												<article class="col-xs-3">
													<label>Cant: </label>
													<input type="number" class="form-control" required name="cant_admin[]" value="'.$fila["cant_dosi"].'">
												</article>
												<article class="col-xs-5">
													<label>Estado: </label>
													<select class="form-control" required name="estado_admin[]">
														<option value=""></option>
														<option value="Administrado">Administrado</option>
														<option value="Devuelto">Devuelto</option>
													</select>
												</article>

												<article class="col-xs-12">
													<label>Observación: </label>
													<textarea class="form-control" required name="obs_admin[]"></textarea>
													<input type="hidden" class="form-control" required name="id_dosi_med[]" value="'.$fila["id_dosi_med"].'">
													<input type="hidden" class="form-control" required name="resp_admin[]" value="'.$_SESSION['AUT']["id_user"].'">
												</article>
											</section>

											<p></p>
										 </td>';
								echo'<td class="text-center alert-warning animated zoomIn text-danger">
											<p><span class="fa fa-stop-circle fa-2x animated shake ">  </span> <strong>Medicamento Pendiente por administración<strong></p>
											<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADMMED&iddosi='.$fila["id_dosi_med"].'&adm='.$_REQUEST['idadmhosp'].'&doc='.$_REQUEST['doc'].'&sede='.$_REQUEST['sede'].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-check"></span> Administrar </button></a></p>
											<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DEVMED&iddosi='.$fila["id_dosi_med"].'&adm='.$_REQUEST['idadmhosp'].'&doc='.$_REQUEST['doc'].'&sede='.$_REQUEST['sede'].'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-minus"></span> Devolver</button></a></p>
										 </td>';
								echo "</tr>\n";
							}
							if ($fila['estado_admin']=='Administrado') {
								echo"<tr >	\n";
								echo'<td class="text-center alert-success">'.$fila["medicamento"].' | '.$fila["via"].' | '.$fila["frecuencia"].' Horas</td>';
								echo'<td class="text-center alert success">
											<p><strong>Franja: </strong>'.$fila["nom_dosi"].'</p>
											<p><strong>Cantidad: </strong>'.$fila["cant_dosi"].'</p>
											<p><strong>Observación: </strong>'.$fila["obsfmedhosp"].'</p>
										 </td>';
								echo'<td class="text-center alert-success">
											<p><strong>Fecha: </strong>'.$fila["fadmin"].'-'.$fila["nom_dosi"].'</p>
											<p><strong>Franja: </strong>'.$fila["nom_admin"].'</p>
											<p><strong>Cantidad Administrada: </strong>'.$fila["cant_admin"].'</p>
											<p><strong>Observación: </strong>'.$fila["obs_admin"].'</p>
										 </td>';
								echo'<td class="text-center alert-success animated zoomIn text-success">
											<p><span class="fa fa-check-circle fa-2x animated shake ">  </span> <strong>Medicamento '.$fila['estado_admin'].'<strong></p>
											<p>Administró: <strong>'.$fila['nombre'].'<strong></p>
										 </td>';
								echo "</tr>\n";
							}
							if ($fila['estado_admin']=='Devuelto') {
								echo"<tr >	\n";
								echo'<td class="text-center alert-danger">'.$fila["medicamento"].' | '.$fila["via"].' | '.$fila["frecuencia"].' Horas</td>';
								echo'<td class="text-center alert danger">
											<p><strong>Franja: </strong>'.$fila["nom_dosi"].'</p>
											<p><strong>Cantidad: </strong>'.$fila["cant_dosi"].'</p>
											<p><strong>Observación: </strong>'.$fila["obsfmedhosp"].'</p>
										 </td>';
								echo'<td class="text-center alert-danger">
											<p><strong>Fecha: </strong>'.$fila["fadmin"].'-'.$fila["nom_dosi"].'</p>
											<p><strong>Franja: </strong>'.$fila["nom_admin"].'</p>
											<p><strong>Cantidad Devuelta: </strong>'.$fila["cant_admin"].'</p>
											<p><strong>Observación: </strong>'.$fila["obs_admin"].'</p>
										 </td>';
								echo'<td class="text-center alert-danger animated zoomIn text-danger">
											<p><span class="fa fa-undo fa-2x animated shake ">  </span> <strong>Medicamento '.$fila['estado_admin'].'<strong></p>
											<p>Devolvio: <strong>'.$fila['nombre'].'<strong></p>
										 </td>';
								echo "</tr>\n";
							}
				    }
				  }
				}

      }
			?>
		<table>
			<div class="row text-center">
			  <input type="submit" name="insertar" value="Administrar Medicamentos" class="btn btn-success btn-lg"/>
			</div>
		</form>
		<?php

		  //////////////////////// PRESIONAR EL BOTÓN //////////////////////////
		  if(isset($_POST['insertar']))

		  {

		  $items1 = ($_POST['id_dosi_med']);
		  $items2 = ($_POST['fadmin']);
		  $items3 = ($_POST['nom_admin']);
		  $items4 = ($_POST['cant_admin']);
		  $items5 = ($_POST['hora_admin']);
		  $items6 = ($_POST['estado_admin']);
			$items7 = ($_POST['resp_admin']);
			$items8 = ($_POST['obs_admin']);


		  while(true) {

		      //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
		      $item1 = current($items1);
		      $item2 = current($items2);
		      $item3 = current($items3);
		      $item4 = current($items4);
		      $item5 = current($items5);
		      $item6 = current($items6);
					$item7 = current($items7);
					$item8 = current($items8);

		      ////// ASIGNARLOS A VARIABLES ///////////////////
		      $id_dosi_med=(( $item1 !== false) ? $item1 : ", &nbsp;");
		      $fadmin=(( $item2 !== false) ? $item2 : ", &nbsp;");
		      $nom_admin=(( $item3 !== false) ? $item3 : ", &nbsp;");
		      $cant_admin=(( $item4 !== false) ? $item4 : ", &nbsp;");
		      $hora_admin=(( $item5 !== false) ? $item5 : ", &nbsp;");
		      $estado_admin=(( $item6 !== false) ? $item6 : ", &nbsp;");
					$resp_admin=(( $item7 !== false) ? $item7 : ", &nbsp;");
					$obs_admin=(( $item8 !== false) ? $item8 : ", &nbsp;");


		      ///////// QUERY DE INSERCIÓN ////////////////////////////
		      $sql = "UPDATE dosificacion_med SET fadmin='$fadmin',nom_admin='$nom_admin',cant_admin='$cant_admin',
												 hora_admin='$hora_admin',estado_admin='$estado_admin',obs_admin='$obs_admin',resp_adm='$resp_admin'
												 WHERE id_dosi_med=$id_dosi_med ;";
		      //echo $sql;

		    $sqlRes=$conexion->query($sql) or mysql_error();

		      // Up! Next Value
		      $item1 = next( $items1);
		      $item2 = next( $items2);
		      $item3 = next( $items3);
		      $item4 = next( $items4);
		      $item5 = next( $items5);
		      $item6 = next( $items6);
					$item7 = next( $items7);
					$item8 = next( $items8);

		      // Check terminator
		      if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false && $item7 === false && $item8 === false) break;

		  }
			echo'
			<section class="panel-body col-md-12">
				<a href="'.PROGRAMA.'?sede='.$_REQUEST['sede'].'&f='.$_REQUEST['f'].'&buscar=Buscar&opcion=162">
				<button type="button" class="btn btn-success btn-lg sombra_movil" ><span class="fa fa-arrow-circle-o-left"></span>
				Estos medicamentos ya fueron ADMINISTRADOS haga click aqui y continue con otro paciente</button></a>
			</section>';
		  }

		?>
	</section>
</section>
		<?php
	}
	?>
