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
			case 'VI':
				$sql="INSERT INTO val_initr_dom (id_adm_hosp, id_user, freg_tr_dom, hreg_tr_dom, motivo_consulta, ant_per_fumador, ant_per_lena, ant_per_ambiental, ant_patologico, ant_quirurgicos, ant_traumatologico, ant_terapeutico, ant_toxicologicos, ant_alergicos, ant_farmacologico, ascultacion, fr, fc, so2, petibucal, distal, toracica, abdominal, amplitud, tintercostal, sis_oxigenoterapia, obs_sisoxigeno, obj_general, obj_especifico, pronostico, recomendaciones, estado_tr_dom) VALUES
				('".$_POST["idadmhosp"]."',
'".$_SESSION["AUT"]["id_user"]."',
'".$_POST["freg"]."',
'".$_POST["hreg"]."',
'".$_POST["motivo_consulta"]."',
'".$_POST["ant_per_fumador"]."',
'".$_POST["ant_per_leña"]."',
'".$_POST["ant_per_ambiental"]."',
'".$_POST["ant_patologico"]."',
'".$_POST["ant_quirurgicos"]."',
'".$_POST["ant_traumatologico"]."',
'".$_POST["ant_terapeutico"]."',
'".$_POST["ant_toxicologicos"]."',
'".$_POST["ant_alergicos"]."',
'".$_POST["ant_farmacologico"]."',
'".$_POST["ascultacion"]."',
'".$_POST["fr"]."',
'".$_POST["fc"]."',
'".$_POST["so2"]."',
'".$_POST["petibucal"]."',
'".$_POST["distal"]."',
'".$_POST["toracica"]."',
'".$_POST["abdominal"]."',
'".$_POST["amplitud"]."',
'".$_POST["tintercostal"]."',
'".$_POST["sis_oxigenoterapia"]."',
'".$_POST["obs_sisoxigeno"]."',
'".$_POST["obj_general"]."',
'".$_POST["obj_especifico"]."',
'".$_POST["pronostico"]."',
'".$_POST["recomendaciones"]."',
'Realizada')";
				$subtitulo="Valoracion inicial Adicionada con exito";
			break;
			case 'EVO':

				$horaInicial=$_POST["hregevo"];
				$horat= strtotime ( '+40 minute' , strtotime ( $horaInicial ) ) ;
				$ht=date('H:i',$horat);
			$sql="INSERT INTO evo_tr_dom(  id_adm_hosp, id_user, id_d_aut_dom,freg_reg, freg_evotr_dom, hreg_evotr_dom, hreg_regtr_dom, hfin_evotr_dom, evoluciontr_dom, estado_evotr_dom) VALUES
			('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["idd"]."','".$_POST["fregreg"]."','".$_POST["freg"]."','".$_POST["hregevo"]."','".$_POST["hreg"]."','$ht','".$_POST["evoto"]."','Realizada')";
			$subtitulo="Evolucion adicionada con exito";

			break;
			case 'EVOP':
			$horaInicial=$_POST["hregevo"];
			$horat= strtotime ( '+40 minute' , strtotime ( $horaInicial ) ) ;
			$ht=date('H:i',$horat);
			$fecha =date('Y-m-d');
			$sql="INSERT INTO evo_tr_dom(  id_adm_hosp, id_user, freg_reg, freg_evotr_dom, hreg_evotr_dom, hreg_regtr_dom, hfin_evotr_dom, evoluciontr_dom, estado_evotr_dom) VALUES
			('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','$fecha','".$_POST["freg"]."','".$_POST["hregevo"]."','".$_POST["hreg"]."','$ht','".$_POST["evoto"]."','Realizada')";
			$subtitulo="EVolucion";
			$subtitulo1="Adicionado";
			$subtitulo2="Terapia Ocupacional
			";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El formato de $subtitulo en $subtitulo2 fue $subtitulo1 con exito!";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="$subtitulo NO fue $subtitulo1 !!! .$subtitulo2";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'VI':
    $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
    j.nom_eps
    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                left join eps j on (j.id_eps=b.id_eps)
    where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Valoracion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formulariosDOM/RESPIRATORIA/val_initr_dom.php';
			$subtitulo='Valoracion inicial Terapia Respiratoria';
			break;
			case 'EVO':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Evolucion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$form1='formulariosDOM/RESPIRATORIA/evo_tr_dom5.php';
			$subtitulo='Evolucion Diaria Terapia Respiratoria';
			break;
			case 'EVOP':
			$sql="SELECT a.id_paciente,tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
									left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Evolucion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$opcion=$_REQUEST['opcion'];
			$form1='formulariosDOM/evo_pendiente_dom.php';
			$subtitulo='Evolucion pendiente';
			break;

		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"");
			}

		?>

		<?php include($form1);?>

<?php
}else{
if ($check=='si') {
	echo'<section>';
	echo '<script>swal("EXCELENTE !!! '.$subtitulo.'","","success")</script>';
	echo'</section>';
}if ($check=='no') {
	echo'<section>';
	echo '<script>swal("DEBES REVISAR EL PROCESO !!! '.$subtitulo.'","","error")</script>';
	echo'</section>';
}
// nivel 1?>
<section class="panel-default">
	<section class="panel-heading"><h4>Terapia Respiratoria Servicios Domiciliarios</h4></section>
<section class="panel-body">
	<section class="col-md-4">
		<form>
			<div class="row">
				<div class="col-lg-12">
					<div class="input-group">
						<input type="text" class="form-control" name="doc" placeholder="Digite identificación">
						<span class="input-group-btn">
								<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
								<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
						</span>
					</div><!-- /input-group -->
				</div><!-- /.col-lg-6 -->
			</div>
		</form>
		<br>
		<form>
			<div class="row">
				<div class="col-lg-12">
					<div class="input-group">
						<input type="text" class="form-control" name="nom" placeholder="Digite nombre o apellidos">
						<span class="input-group-btn">
								<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
								<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
						</span>
					</div><!-- /input-group -->
				</div><!-- /.col-lg-6 -->
			</div>
		</form>
	</section>
	<section class="panel-body">
		<table class="table table-bordered">
			<tr>
				<th class="info">PACIENTE</th>
				<th class="info">INGRESO</th>
				<th class="info">SERVICIOS <br> AUTORIZADOS</th>
				<th class="info">Registro asistencial</th>
			</tr>

			<?php
			if (isset($_REQUEST["doc"])){
			$doc=$_REQUEST["doc"];
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
									 s.nom_sedes,
									 e.nom_eps,e.id_eps ide
						FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
														 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
														 INNER JOIN eps e on a.id_eps=e.id_eps
					  WHERE p.doc_pac='".$doc."' and a.estado_adm_hosp='Activo' and tipo_servicio='Domiciliarios' ";

			if ($tabla=$bd1->sub_tuplas($sql)){
				//echo $sql;
				foreach ($tabla as $fila ) {
					echo"<tr>	\n";
					echo'<td class="text-center">
								<p><strong>NOMBRE: </strong> '.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
								<p><strong>IDENTIFICACIÓN: </strong> '.$fila["tdoc_pac"].' '.$fila["doc_pac"].'</p>
								<p><strong>AMD: </strong> '.$fila["id_adm_hosp"].'</p>
							 </td>';
					echo'<td class="text-left">
								<p><strong>FECHA INGRESO: </strong> '.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].' </p>
								<p><strong>SEDE: </strong> '.$fila["nom_sedes"].'</p>
								<p><strong>EPS: </strong> '.$fila["nom_eps"].'</p>
							 </td>';
							 $estado_salida=$fila['estado_salida'];
							 if ($estado_salida=='Fallecimiento') {
								echo '<td><p class="alert alert-dom"><span class="fa fa-skull-crossbones"></span>Paciente Fallecido</p></td>';
							 }
							 if ($estado_salida=='Hospitalizado') {
								echo '<td><p class="alert alert-dom"><span class="fa fa-procedures"></span>Paciente Hospitalizado</p></td>';
							 }
							 if ($estado_salida=='') {
								 $adm=$fila['id_adm_hosp'];
								 $hoy=date('Y-m-d');
								 $profesional=$_SESSION['AUT']['id_user'];
								 $sql_detalle="SELECT a.id_m_aut_dom, id_adm_hosp, zona_paciente,cdx_presentacion,dx_presentacion,
																			b.id_d_aut_dom, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa, estado_d_aut_dom, intervalo, temporalidad, profesional, f_prof,
																			c.nomclaseusuario
															 FROM m_aut_dom a INNER JOIN d_aut_dom b on a.id_m_aut_dom=b.id_m_aut_dom
																								INNER JOIN clase_usuario c on a.tipo_paciente=c.id_cusuario
															 WHERE a.id_adm_hosp=$adm and b.estado_d_aut_dom in (1,2) and b.cups='890112'";
								 //echo $sql_detalle;
								 if ($tabla_detalle=$bd1->sub_tuplas($sql_detalle)){
									 foreach ($tabla_detalle as $fila_detalle) {
										 $hoy=date('Y-m-d');
										 $fini=$fila_detalle['finicio'];
										 $ffin=$fila_detalle['ffinal'];
										 //validar si ya completo la orden por cantidades
										 $id_vcant=$fila_detalle['id_d_aut_dom'];
										 $tterapia=$fila_detalle['cups'];
										 include('formulariosDOM/autorizacion/validar_terapia_intervalo.php');

									 }
								 }else {
									 echo'<th class="text-center">
												 <p>El paciente no tiene servicios autorizados para Terapia Respiratoria</p>
												</th>';
								 }

							 }
					echo "</tr>\n";

				}
			}
		}	if (isset($_REQUEST["nom"])){
			$doc=$_REQUEST["nom"];
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
									 s.nom_sedes,
									 e.nom_eps,e.id_eps ide
						FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
														 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
														 INNER JOIN eps e on a.id_eps=e.id_eps
						 WHERE p.nom_completo LIKE '%".$doc."%' and a.estado_adm_hosp='Activo'  and tipo_servicio='Domiciliarios' ";

			if ($tabla=$bd1->sub_tuplas($sql)){
				//echo $sql;
				foreach ($tabla as $fila ) {
					echo"<tr>	\n";
					echo'<td class="text-center">
								<p><strong>NOMBRE: </strong> '.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
								<p><strong>IDENTIFICACIÓN: </strong> '.$fila["tdoc_pac"].' '.$fila["doc_pac"].'</p>
								<p><strong>AMD: </strong> '.$fila["id_adm_hosp"].'</p>
							 </td>';
					echo'<td class="text-left">
								<p><strong>FECHA INGRESO: </strong> '.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].' </p>
								<p><strong>SEDE: </strong> '.$fila["nom_sedes"].'</p>
								<p><strong>EPS: </strong> '.$fila["nom_eps"].'</p>
							 </td>';
							 $estado_salida=$fila['estado_salida'];
							if ($estado_salida=='Fallecimiento') {
							 echo '<td><p class="alert alert-dom"><span class="fa fa-skull-crossbones"></span>Paciente Fallecido</p></td>';
							}
							if ($estado_salida=='Hospitalizado') {
							 echo '<td><p class="alert alert-dom"><span class="fa fa-procedures"></span>Paciente Hospitalizado</p></td>';
							}
							if ($estado_salida=='') {
								$adm=$fila['id_adm_hosp'];
								$hoy=date('Y-m-d');
								$profesional=$_SESSION['AUT']['id_user'];
								$sql_detalle="SELECT a.id_m_aut_dom, id_adm_hosp, zona_paciente,cdx_presentacion,dx_presentacion,
																		 b.id_d_aut_dom, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa, estado_d_aut_dom, intervalo, temporalidad, profesional, f_prof,
																		 c.nomclaseusuario
															FROM m_aut_dom a INNER JOIN d_aut_dom b on a.id_m_aut_dom=b.id_m_aut_dom
																							 INNER JOIN clase_usuario c on a.tipo_paciente=c.id_cusuario
															WHERE a.id_adm_hosp=$adm and b.estado_d_aut_dom in (1,2) and b.cups='890112'";
								//echo $sql_detalle;
								if ($tabla_detalle=$bd1->sub_tuplas($sql_detalle)){
									foreach ($tabla_detalle as $fila_detalle) {
										$hoy=date('Y-m-d');
										$fini=$fila_detalle['finicio'];
										$ffin=$fila_detalle['ffinal'];
										//validar si ya completo la orden por cantidades
										$id_vcant=$fila_detalle['id_d_aut_dom'];
										$tterapia=$fila_detalle['cups'];
										include('formulariosDOM/autorizacion/validar_terapia_intervalo.php');

									}
								}else {
									echo'<th class="text-center">
												<p>El paciente no tiene servicios autorizados para Terapia Respiratoria</p>
											 </th>';
								}

							}
					echo "</tr>\n";

				}
			}
		}
			?>

		</table>
	</section>

</section>
</section>
	<?php
}
?>
