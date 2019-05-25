
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

			case 'ADD':

				$id_producto=$_POST['detalle_despacho'];
				$descuento=$_POST['cant_dosi'];
				$sql_producto="SELECT id_dproducto,nom_completa,laboratorio,cantidad,fvencimiento,lote,ffarmaceutica,total_fraccion
											 FROM d_producto
											 WHERE id_dproducto = $id_producto";
				//echo $sql_producto;

				if($tabla_producto=$bd1->sub_tuplas($sql_producto)){
					foreach ($tabla_producto as $fila_producto) {
						$forma=$fila_producto['ffarmaceutica'];
						if ($forma=='GOTAS' || $forma=='SOLUCION ORAL' || $forma=='JARABE' || $forma=='SUSPENSION'
																|| $forma=='SOLUCION OFTALMICA'  || $forma=='LOCION'  || $forma=='AEROSOL'
																|| $forma=='POLVO PARA RECONTITUIR' || $forma=='SHAMPOO'  || $forma=='JALEA') {
							$tf=$fila_producto['total_fraccion'];
							if ($tf > 0) {
								$id_producto=$_POST['detalle_despacho'];
								$descuento=$_POST['cant_dosi'];
								$total=$fila_producto['total_fraccion'];
								$descuento_total=$total-$descuento;

								if ($descuento<$total) {
									$sql="INSERT INTO dosificacion_med (id_d_fmedhosp, id_user, freg_farmacia, nom_dosi, cant_dosi, estado_dosi,d_producto)
									VALUES ('".$_POST['idd']."','".$_SESSION['AUT']['id_user']."','".$_POST['freg_farmacia']."','".$_POST['nom_dosi']."',
									'".$_POST['cant_dosi']."','Dosificado','".$_POST['detalle_despacho']."')";
									$subtitulo="Dosificacion del medicamento se realizo con exito. ";
									$cant=$fila_producto['cantidad'];
									$sql1="UPDATE d_producto SET total_fraccion=$descuento_total,user_mod='".$_SESSION['AUT']['id_user']."',accion=3 WHERE id_dproducto=$id_producto";
									$subtitulo2="Descuento realizado en inventario.";
								}else {
									$sql="INSERT INTO dosificacion_med ( id_user, freg_farmacia, nom_dosi, cant_dosi, estado_dosi)
									VALUES ('".$_POST['idd']."','".$_SESSION['AUT']['id_user']."','".$_POST['freg_farmacia']."','".$_POST['nom_dosi']."',
									'".$_POST['cant_dosi']."','Dosificado')";
									$subtitulo1="La dosificación del medicamento no se puede realizar.";
								}
							}else {
								// en caso de no descontar fraccion por menor
									$sql="INSERT INTO dosificacion_med (id__fmedhosp, id_user, freg_farmacia, nom_dosi, cant_dosi, estado_dosi,)
									VALUES ('".$_POST['idd']."','".$_SESSION['AUT']['id_user']."','".$_POST['freg_farmacia']."','".$_POST['nom_dosi']."',
									'".$_POST['cant_dosi']."','Dosificado')";
									$subtitulo1="No se puede realizar dosificación ni actualización en inventario debido a no hay facción de descuento ";
							}
						}
						//dispensacion por unidad
						if ($forma=='TABLETA' || $forma=='CAPSULA' || $forma=='SOLUCION INYECTABLE'  || $forma=='GRAGEA'
						|| $forma=='COMPRIMIDO' || $forma=='OVULO' || $forma=='PERLAS'  || $forma=='UNIDAD') {
							$id_producto=$_POST['detalle_despacho'];
							$descuento=$_POST['cant_dosi'];
							$total=$fila_producto['cantidad'];
							$descuento_total=$total-$descuento;

							if ($descuento<$total) {
								$sql="INSERT INTO dosificacion_med (id_d_fmedhosp, id_user, freg_farmacia, nom_dosi, cant_dosi, estado_dosi,d_producto)
								VALUES ('".$_POST['idd']."','".$_SESSION['AUT']['id_user']."','".$_POST['freg_farmacia']."','".$_POST['nom_dosi']."',
								'".$_POST['cant_dosi']."','Dosificado','".$_POST['detalle_despacho']."')";
								$subtitulo="Dosificacion del medicamento se realizo con exito. ";
								$sql1="UPDATE d_producto SET cantidad=$descuento_total,user_mod='".$_SESSION['AUT']['id_user']."',accion=3 WHERE id_dproducto=$id_producto";
								$subtitulo2="Descuento realizado en inventario.";
							}else {
								$sql="INSERT INTO dosificacion_med ( id_user, freg_farmacia, nom_dosi, cant_dosi, estado_dosi)
								VALUES ('".$_POST['idd']."','".$_SESSION['AUT']['id_user']."','".$_POST['freg_farmacia']."','".$_POST['nom_dosi']."',
								'".$_POST['cant_dosi']."','Dosificado')";
								$subtitulo1="La dosificación del medicamento no se puede realizar.";
							}
						}


					}
				}


			break;
		}
		//echo $sql;
		//echo $sql1;
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo";
			$check='si';
			if ($bd1->consulta($sql1)) {
				$subtitulo="$subtitulo2";
				$check='si';
			}
		}else{
			$subtitulo="$subtitulo1";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {

			case 'A':
				$sql="SELECT a.id_m_fmedhosp,id_bodega,
										 b.id_d_fmedhosp,freg,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4
							FROM m_fmedhosp a LEFT JOIN d_fmedhosp b on a.id_m_fmedhosp=b.id_m_fmedhosp
							WHERE id_d_fmedhosp='".$_REQUEST['idd']."'";
							//echo $sql;
				$boton="Dosificar";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='disabled';
				$date=date('Y-m-d');
				$return2=152;
				$return=$_REQUEST['doc'];
				$return1=$_REQUEST['fbus'];
				$form1='formulariosMED/dosificar_med.php';
				$form2='';
				$subtitulo='Dosificación de medicamentos ';
			break;
			case 'ADD':
				$sql="SELECT a.id_m_fmedhosp,id_bodega,
										 b.id_d_fmedhosp,freg,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4
							FROM m_fmedhosp a LEFT JOIN d_fmedhosp b on a.id_m_fmedhosp=b.id_m_fmedhosp
							WHERE id_d_fmedhosp='".$_REQUEST['idd']."'";
							//echo $sql;
				$boton="Dosificar";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='disabled';
				$date=date('Y-m-d');
				$return2=152;
				$return=$_REQUEST['doc'];
				$return1=$_REQUEST['fbus'];
				$return2=$_REQUEST['idadmhosp'];
				$return3=$_REQUEST['sede'];
				$return4=$_REQUEST['bod'];
				$mipres=$_REQUEST['m'];
				$form1='formulariosMED/dosificar_med_indv.php';
				$form2='';
				$subtitulo='Dosificación de medicamentos individual';
			break;

	}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_m_fmedhosp"=>"", "id_d_fmedhosp"=>"", "freg"=>"", "medicamento"=>"", "via"=>"", "frecuencia"=>"", "dosis1"=>"", "dosis2"=>"",
				"dosis3"=>"","dosis4"=>"","id_bodega"=>"");

			}
		}else{
				$fila=array("id_m_fmedhosp"=>"", "id_d_fmedhosp"=>"", "freg"=>"", "medicamento"=>"", "via"=>"", "frecuencia"=>"", "dosis1"=>"", "dosis2"=>"",
				"dosis3"=>"","dosis4"=>"","id_bodega"=>"");
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].ddosi.value > document.forms[0].d.value){
					alert("La cantidad dosificada NO puede superar la solicitada");
					document.forms[0].ddosi.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].nom1.value == ""){
					alert("El primer nombre del paciente es obligatorio!");
					document.forms[0].nom1.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].ape1.value == ""){
					alert("El primer apellido del paciente es obligatorio!");
					document.forms[0].ape1.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
			<section>
				<?php include($form1);?>
			</section>

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
			<a class="btn btn-success" href="<?php echo PROGRAMA.'?sede='.$sede.'&f='.$fecha.'&buscar=Buscar&opcion=163';?>"><span class="fa fa-arrow-circle-left">Regresar a consultar paciente</span></a>
	</section>
	<section class="panel-heading">
		<h4>Dosificación de medicamentos en servicio hospitalario</h4>
	</section>
	<?php
		$sede=$_REQUEST['sede'];
		$fecha=$_REQUEST['f'];
	 ?>
<section class="panel-body ">
	<section class="col-xs-12">
		<section class="col-xs-6">
			<?php include('pacienteIDV.php');?>
		</section>
		<section class="col-xs-6">
			<button data-toggle="collapse" class="btn btn-primary text-center" data-target="#demo"><h4>Ver historico de dosificaciones en la fecha  <strong><?php echo $_REQUEST['f']; ?></strong><h4><span class="glyphicon glyphicon-arrow-down"></span> </button>
		</section>
	</section>
	<section class="col-xs-12">
			<section id="demo" class="collapse">
			<table class="table table-bordered table-responsive">
				<thead class="thead-inverse ">
					<tr>
						<th class="text-center alert-info">ID</th>
						<th class="text-center alert-info">MEDICAMENTO</th>
			      <th class="text-center alert-info">CANTIDAD SOLICITADA</th>
						<th class="text-center alert-info">FRANJA DOSIFICACIÓN</th>
						<th class="text-center alert-info">CANTIDAD DOSIFICADA</th>
						<th class="text-center alert-info">FECHA DOSIFICACION</th>
					</tr>
				</thead>
				<?php
				if (isset($_REQUEST["doc"])){
				$fa=date('Y-m-d');
				$doc=$_REQUEST["filtro"];
				$fbus=$_REQUEST["f"];
				$sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
										 b.id_adm_hosp,
		        			 	 c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,
		        			 	 d.id_d_fmedhosp,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4,obsfmedhosp,
									 	 e.id_dosi_med, freg_farmacia, nom_dosi, cant_dosi, estado_dosi, obs_dosi
						FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
		                         INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
		            						 INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
		            						 LEFT JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
					  WHERE a.doc_pac='".$_REQUEST['doc']."' and c.estado_m_fmedhosp='Solicitado'
																									 and b.estado_adm_hosp='Activo'
																									 and c.tipo_formula in ('Programada','Evento')
																									 and freg_farmacia='$fbus'";
						//echo $sql;

			if ($tabla=$bd1->sub_tuplas($sql)){
				foreach ($tabla as $fila1 ) {
					if ($fila1["id_dosi_med"]!='') {
						if ($fila1['nom_dosi']=='6am-8am') {
							echo"<tr >\n";
							echo'<td class="text-center">'.$fila1["id_d_fmedhosp"].'</td>';
							echo'<td class="text-center">'.$fila1["medicamento"].' | '.$fila1["via"].' | '.$fila1["frecuencia"].' Horas</td>';
							echo'<td class="text-center">'.$fila1["dosis1"].'</td>';
							echo'<td class="text-center">'.$fila1["nom_dosi"].'</td>';
							echo'<td class="text-center">'.$fila1["cant_dosi"].'</td>';
							echo'<td class="text-center">'.$fila1["freg_farmacia"].'</td>';
							echo"</tr >\n";
						}
						if ($fila1['nom_dosi']=='12m-2pm') {
							echo"<tr >\n";
							echo'<td class="text-center">'.$fila1["id_d_fmedhosp"].'</td>';
							echo'<td class="text-center">'.$fila1["medicamento"].' | '.$fila1["via"].' | '.$fila1["frecuencia"].' Horas</td>';
							echo'<td class="text-center">'.$fila1["dosis2"].'</td>';
							echo'<td class="text-center">'.$fila1["nom_dosi"].'</td>';
							echo'<td class="text-center">'.$fila1["cant_dosi"].'</td>';
							echo'<td class="text-center">'.$fila1["freg_farmacia"].'</td>';
							echo"</tr >\n";
						}
						if ($fila1['nom_dosi']=='6pm-8pm') {
							echo"<tr >\n";
							echo'<td class="text-center">'.$fila1["id_d_fmedhosp"].'</td>';
							echo'<td class="text-center">'.$fila1["medicamento"].' | '.$fila1["via"].' | '.$fila1["frecuencia"].' Horas</td>';
							echo'<td class="text-center">'.$fila1["dosis3"].'</td>';
							echo'<td class="text-center">'.$fila1["nom_dosi"].'</td>';
							echo'<td class="text-center">'.$fila1["cant_dosi"].'</td>';
							echo'<td class="text-center">'.$fila1["freg_farmacia"].'</td>';
							echo"</tr >\n";
						}
						if ($fila1['nom_dosi']=='10pm-12pm') {
							echo"<tr >\n";
							echo'<td class="text-center">'.$fila1["id_d_fmedhosp"].'</td>';
							echo'<td class="text-center">'.$fila1["medicamento"].' | '.$fila1["via"].' | '.$fila1["frecuencia"].' Horas</td>';
							echo'<td class="text-center">'.$fila1["dosis4"].'</td>';
							echo'<td class="text-center">'.$fila1["nom_dosi"].'</td>';
							echo'<td class="text-center">'.$fila1["cant_dosi"].'</td>';
							echo'<td class="text-center">'.$fila1["freg_farmacia"].'</td>';
							echo"</tr >\n";
						}
					}else {
						echo'<tr><td><h2>hol mundo</h2></td></tr>';
					}

				}
			}
		}
			?>
		</table>
		</section>
	</section>

<table class="table table-bordered">
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
	$fbus=$_REQUEST["f"];
	$sede=$_REQUEST['sede'];
	if ($sede==2) {
		$bodega=2;
	}
	if ($sede==8) {
		$bodega=3;
	}
	$sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
							 b.id_adm_hosp,
							 c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,dx_formula,dx1_formula,dx2_formula,
							 d.id_d_fmedhosp,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4,obsfmedhosp,tipo_mipres,rad_mipres,cod_med,
							 e.pos,
							 f.nombre formulador
			FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
											 INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
											 INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
											 left join m_producto e on d.cod_med=e.id_producto
											 INNER JOIN user f on (c.id_user=f.id_user)

			WHERE a.doc_pac='".$_REQUEST['doc']."' and c.estado_m_fmedhosp='Solicitado'
																						 and d.estado_med='Solicitado'
																						 and c.tipo_formula in ('Programada','Evento')
																						 and b.estado_adm_hosp='Activo'
																						 and fejecucion_final >='$fa'  ";
			//echo $sql;
if ($tabla=$bd1->sub_tuplas($sql)){
	foreach ($tabla as $fila ) {

		if ($fila["id_d_fmedhosp"]!='') {
				echo"<tr >\n";
				echo'<td class="text-center">'.$fila["id_d_fmedhosp"].'';
				$dx=$fila['dx_formula'];
				$dx1=$fila['dx1_formula'];
				$dx2=$fila['dx2_formula'];
				$pos=$fila['pos'];
				$cod=$fila['cod_med'];
				if ($pos==1) {
					include('formulariosMED/exepcionDxDispensar.php');
				}else {
					echo'<p class="text-success">POS </p>';
					$mipres1=0;
				}
				echo'</td>';
				if ($fila['tipo_formula']=='Programada') {
					echo'<th class="text-center">
								<p>'.$fila["medicamento"].' <br> '.$fila["via"].' <br> '.$fila["frecuencia"].' Horas</p>
								<p class="alert alert-success">'.$fila["tipo_formula"].'</p>
							 </th>';
				}
				if ($fila['tipo_formula']=='Evento') {
					echo'<th class="text-center">
								<p>'.$fila["medicamento"].' <br> '.$fila["via"].' <br> '.$fila["frecuencia"].' Horas</p>
								<p class="alert alert-danger">'.$fila["tipo_formula"].'</p>
							 </th>';
				}

					if ($fila['dosis1']==0) {
						echo'<td class="text-center"><h5><u>'.$fila["dosis1"].'</u></h5></td>';
					}
					if ($fila['dosis1']>0) {
							echo'<td class="text-center col-xs-3">';
								echo'
									<article class="col-md-12 alert alert-info">
										<p><strong><small>Solicitado</small></strong></p>
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
																																			 and e.nom_dosi='6am-8am' and b.estado_adm_hosp='Activo'
																																			 and freg_farmacia='$fbus'";
										//echo $sql2;
										if ($tabla2=$bd1->sub_tuplas($sql2)){
											foreach ($tabla2 as $fila2 ) {
												if ($fila2['cant_dosi']=='') {
													# code...
												}
													echo'
													<article class="col-md-12 alert alert-danger">
														<p><strong><small>Dosificado</small></strong></p>
														<span class="badge">'.$fila2["cant_dosi"].'</span>
													</article>';
											}
										}else {
											echo'
											<article class="col-xs-12 ">
											<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADD&dosis=6am-8am&idadmhosp='.$_REQUEST['idadmhosp'].'&idd='.$fila["id_d_fmedhosp"].'&fbus='.$fbus.'&doc='.$_REQUEST["doc"].'&sede='.$_REQUEST["sede"].'&m='.$mipres1.'&bod='.$_REQUEST['bod'].'">
											<button type="button" class="btn btn-success" > <small>Dosificar</small></button></a>
											</article>';
										}
							echo'</td>';
					}
					if ($fila['dosis2']==0) {
						echo'<td class="text-center"><h5><u>'.$fila["dosis2"].'</u></h5></td>';
					}else {
						echo'<td class="text-center col-xs-3">';
							echo'
								<article class="col-xs-12 alert alert-info">
									<p><strong><small>Solicitado</small></strong></p>
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
																																		 and b.estado_adm_hosp='Activo'
																																		 and e.nom_dosi='12m-2pm'
																																		 and freg_farmacia='$fbus'";
									//echo $sql2;
									if ($tabla2=$bd1->sub_tuplas($sql2)){
										foreach ($tabla2 as $fila2 ) {
											if ($fila2['cant_dosi']=='') {
												# code...
											}
											echo'
											<article class="col-xs-12 alert alert-danger">
												<p><strong><small>Dosificado</small></strong></p>
												<span class="badge">'.$fila2["cant_dosi"].'</span>
											</article>';
										}
									}else {
										echo'
										<article class="col-xs-12">
											<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADD&dosis=12m-2pm&idadmhosp='.$_REQUEST['idadmhosp'].'&idd='.$fila["id_d_fmedhosp"].'&fbus='.$fbus.'&doc='.$_REQUEST["doc"].'&sede='.$_REQUEST["sede"].'&m='.$mipres1.'&bod='.$_REQUEST['bod'].'">
											<button type="button" class="btn btn-success"> <small>Dosificar</small></button></a>
										</article>';
									}
						echo'</td>';
					}
					if ($fila['dosis3']==0) {
						echo'<td class="text-center"><h5><u>'.$fila["dosis3"].'</u></h5></td>';
					}else {
						echo'<td class="text-center col-xs-3">';
									echo'
										<article class="col-xs-12 alert alert-info">
											<p><strong><small>Solicitado</small></strong></p>
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
									WHERE e.id_d_fmedhosp='".$fila['id_d_fmedhosp']."' and b.estado_adm_hosp='Activo'
																																		 and c.estado_m_fmedhosp='solicitado'
																																		 and e.nom_dosi='6pm-8pm'
																																		 and freg_farmacia='$fbus'";
									//echo $sql2;
									if ($tabla2=$bd1->sub_tuplas($sql2)){
										foreach ($tabla2 as $fila2 ) {
											if ($fila2['cant_dosi']=='') {

											}
											echo'
											<article class="col-xs-12 alert alert-danger">
												<p><strong><small>Dosificado</small></strong></p>
												<span class="badge">'.$fila2["cant_dosi"].'</span>
											</article>';
										}
									}else {
										echo'
										<article class="col-xs-12 ">
										<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADD&dosis=6pm-8pm&idadmhosp='.$_REQUEST['idadmhosp'].'&idd='.$fila["id_d_fmedhosp"].'&fbus='.$fbus.'&doc='.$_REQUEST["doc"].'&sede='.$_REQUEST["sede"].'&m='.$mipres1.'&bod='.$_REQUEST['bod'].'">
										<button type="button" class="btn btn-success" > <small>Dosificar</small></button></a>
										</article>';
									}
						echo'</td>';
					}
					if ($fila['dosis4']==0) {
						echo'<td class="text-center"><h5><u>'.$fila["dosis4"].'</u></h5></td>';
					}else {
						echo'<td class="text-center col-xs-3">';
							echo'
								<article class="col-xs-12 alert alert-info text-left">
									<p><strong><small>Solicitado</small></strong></p>
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
									WHERE e.id_d_fmedhosp='".$fila['id_d_fmedhosp']."' and b.estado_adm_hosp='Activo'
																																		 and c.estado_m_fmedhosp='solicitado'
																																		 and e.nom_dosi='10pm-12pm'
																																		 and freg_farmacia='$fbus'";
									//echo $sql2;
									if ($tabla2=$bd1->sub_tuplas($sql2)){
										foreach ($tabla2 as $fila2 ) {
											echo'
											<article class="col-xs-12 alert alert-danger">
												<p><strong><small>Dosificado</small></strong></p>
												<span class="badge">'.$fila2["cant_dosi"].'</span>
											</article>';
										}
									}else {
										echo'
										<article class="col-xs-12 ">
										<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADD&dosis=10pm-12pm&idadmhosp='.$_REQUEST['idadmhosp'].'&idd='.$fila["id_d_fmedhosp"].'&fbus='.$fbus.'&doc='.$_REQUEST["doc"].'&sede='.$_REQUEST["sede"].'&m='.$mipres1.'&bod='.$_REQUEST['bod'].'">
										<button type="button" class="btn btn-success" > <small>Dosificar</small></button></a>
										</article>';
									}
						echo'</td>';
					}
				echo'<td class="text-center"><p>'.$fila["obsfmedhosp"].'</p><p class="text-danger">'.$fila["formulador"].'</p></td>';

				echo"</tr >\n";
		}

	}
}
}
?>
	<!--<tr>
		<td colspan="7" class="text-right">
			<a href="<?php //echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&doc='.$doc.'&idadmhosp='.$_REQUEST['idadmhosp'].'&sede='.$_REQUEST['sede'].'&f='.$_REQUEST['f'].'&bod='.$_REQUEST['bod']?>" align="center" >
				<button type="button" class="btn btn-success btn-lg " ><span class="fa fa-capsules fa-2x"></span> Dosificar medicamentos Masivo</button>
			</a>
		</td>
	</tr>-->
</table>

</section>
</section>
</section>

	<?php
}
?>
