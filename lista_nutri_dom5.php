
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
			$ant=$_POST['id_hc_principal'];
			if ($ant=='') {
				$sql="INSERT INTO val_nutri_dom (id_adm_hosp, id_user, freg_nutri, hreg_nutri, motivo_nutri, val_nutricional, dx_nutricional, plan_nutricional, estado_nutri) VALUES
											('".$_POST["idadmhosp"]."',
							'".$_SESSION["AUT"]["id_user"]."',
							'".$_POST["freg"]."',
							'".$_POST["hreg"]."',
							'".$_POST["motivonutri"]."',
							'".$_POST["val_nutri"]."',
							'".$_POST["dxnutri"]."',
							'".$_POST["plan_nutri"]."',
							'Realizada') ;";
						$sql1="INSERT INTO hc_principal (id_paciente, ant_alergicos, ant_patologicos, ant_quirurgico, ant_toxicologico, ant_farmaco,
							ant_gineco, ant_psiquiatrico, ant_hospitalario, ant_traumatologico, ant_familiar, otros_ant)
							VALUES ('".$_POST["paciente"]."','".$_POST["ant_alergicos"]."','".$_POST["ant_patologicos"]."','".$_POST["ant_quirurgico"]."','".$_POST["ant_toxicologico"]."',
								'".$_POST["ant_farmaco"]."','".$_POST["ant_gineco"]."','".$_POST["ant_psiquiatrico"]."','".$_POST["ant_hospitalario"]."','".$_POST["ant_traumatologico"]."',
								'".$_POST["ant_familiar"]."','".$_POST["otros_ant"]."')";
				$subtitulo="Valoracion inicial Adicionada con exito";

			}
			if ($ant!='') {
				$sql="INSERT INTO val_nutri_dom (id_adm_hosp, id_user, freg_nutri, hreg_nutri, motivo_nutri, val_nutricional, dx_nutricional, plan_nutricional, estado_nutri) VALUES
											('".$_POST["idadmhosp"]."',
							'".$_SESSION["AUT"]["id_user"]."',
							'".$_POST["freg"]."',
							'".$_POST["hreg"]."',
							'".$_POST["motivonutri"]."',
							'".$_POST["val_nutri"]."',
							'".$_POST["dxnutri"]."',
							'".$_POST["plan_nutri"]."',
							'Realizada') ;";
						$sql1="UPDATE hc_principal SET ant_alergicos='".$_POST["ant_alergicos"]."', ant_patologicos='".$_POST["ant_patologicos"]."', ant_quirurgico='".$_POST["ant_quirurgico"]."',
						 															 ant_toxicologico='".$_POST["ant_toxicologico"]."', ant_farmaco='".$_POST["ant_farmaco"]."',ant_gineco='".$_POST["ant_gineco"]."',
																					 ant_psiquiatrico='".$_POST["ant_psiquiatrico"]."', ant_hospitalario='".$_POST["ant_hospitalario"]."', ant_traumatologico='".$_POST["ant_traumatologico"]."',
																					 ant_familiar='".$_POST["ant_familiar"]."', otros_ant='".$_POST["otros_ant"]."' WHERE id_paciente='".$_POST["paciente"]."' ";

				$subtitulo="Valoracion inicial Adicionada con exito";
			}
			break;
			case 'EVO':
					$intervalo=$_POST['intervalo'];
					$horaInicial=$_POST["hregevo"];
					$horat= strtotime ( '+'.$intervalo.' minute' , strtotime ( $horaInicial ) ) ;
					$ht=date('H:i',$horat);
					$sql="INSERT INTO evo_nutri_dom (id_adm_hosp, id_user, id_d_aut_dom, freg_reg, freg_evonutri_dom, hreg_evonutri_dom, hreg_regnutri_dom,
																						hfin_evonutri_dom, evolucionnutri_dom, estado_evonutri_dom) VALUES
					('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["idd"]."','".$_POST["fregreg"]."','".$_POST["freg"]."',
					 '".$_POST["hregevo"]."','".$_POST["hreg"]."','$ht','".$_POST["evoto"]."','Realizada')";
					$subtitulo="Evolucion adicionada con exito";

			break;
			case 'EVOP':
			$horaInicial=$_POST["hregevo"];
			$horat= strtotime ( '+40 minute' , strtotime ( $horaInicial ) ) ;
			$ht=date('H:i',$horat);
			$fecha =date('Y-m-d');
			$sql="INSERT INTO evo_fisio_dom (id_adm_hosp, id_user,freg_reg,freg_evofisio_dom, hreg_evofisio_dom, hreg_regfisio_dom, hfin_evofisio_dom, evolucionfisio_dom, estado_evofisio_dom) VALUES
			('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','$fecha','".$_POST["freg"]."','".$_POST["hregevo"]."','".$_POST["hreg"]."','$ht','".$_POST["evoto"]."','Realizada')";
			$subtitulo="Evolucion";
			$subtitulo1="Adicionado";
			$subtitulo2="Terapia Fisica";
			break;

		}
		//echo $sql;
		//echo $sql1;
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo fue $subtitulo1 con exito!";
			$check='si';
			if ($bd1->consulta($sql1)) {
					$subtitulo="$subtitulo fue $subtitulo1 con exito!";
					$check='si';
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
			$ida=$_GET['idadmhosp'];
	    $sql="SELECT a.id_paciente,tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
	    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
	    j.nom_eps
	    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
	                left join eps j on (j.id_eps=b.id_eps)
	    where b.id_adm_hosp =$ida" ;

      $boton="Agregar Valoracion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$form1='formulariosDOM/NUTRICION/val_nutri_dom.php';
			$subtitulo='Valoracion inicial nutricion domiciliarios';
		break;
		case 'EVO':
			$ida=$_GET['idadmhosp'];
      $sql="SELECT a.id_paciente,tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp =$ida" ;
      $boton="Agregar Evolucion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$form1='formulariosDOM/NUTRICION/evo_nutri_dom.php';
			$subtitulo='Evolucion de nutricion domiciliarios';
		break;

		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"",
				"fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"",
				"religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"");
			}
		}else{
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"",
				"fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"",
				"religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"");
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
	<section class="panel-heading"><h4>Nutrición y dietetica Servicios Domiciliarios</h4></section>
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
				foreach ($tabla as $fila) {


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
															WHERE a.id_adm_hosp=$adm and b.estado_d_aut_dom in (1,2) and b.cups='890106'";
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
												<p>El paciente no tiene servicios autorizados para nutricion</p>
											 </th>';
								}

							}
					echo "</tr>\n";
				}
			}
		}
		if (isset($_REQUEST["nom"])){
			$doc=$_REQUEST["nom"];
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
									 s.nom_sedes,
									 e.nom_eps,e.id_eps ide
						FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
														 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
														 INNER JOIN eps e on a.id_eps=e.id_eps
			WHERE p.nom_completo LIKE '%".$doc."%' and a.estado_adm_hosp='Activo'  and tipo_servicio='Domiciliarios' ";
//echo $sql;
			if ($tabla=$bd1->sub_tuplas($sql)){

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
							 							 WHERE a.id_adm_hosp=$adm and b.estado_d_aut_dom in (1,2) and b.cups='890106'";
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
							 				 <p>El paciente no tiene servicios autorizados para nutricion</p>
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
	<?php
}
?>
