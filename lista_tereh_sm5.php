
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
			case 'VALFISIO':
			$sql="INSERT INTO fisio_sm ( id_adm_hosp,id_user,freg_fisio_ce, hreg_fisio_ce, motivo_consulta, ant_patologico, ant_traumaticos, ant_toxicologico, ant_quirurgico,
				ant_farmacologico, ant_ocupacional, ant_familiar, apoyo_dx, dolor, pf, sencibilidad, fosteomuscular, postura, marcha, dx_fisioterapeutico, pron_fisioterapeutico, plan_intervencion,
				obj_terapeutico, estado_fisio_ce ) VALUES
				('".$_POST["idadmhosp"]."',
					'".$_SESSION["AUT"]["id_user"]."',
					'".$_POST["freg"]."',
					'".$_POST["hreg"]."',
					'".$_POST["motivo_consulta"]."',
					'".$_POST["ant_patologico"]."',
					'".$_POST["ant_traumaticos"]."',
					'".$_POST["ant_toxicologico"]."',
					'".$_POST["ant_quirurgico"]."',
					'".$_POST["ant_farmacologico"]."',
					'".$_POST["ant_ocupacional"]."',
					'".$_POST["ant_familiar"]."',
					'".$_POST["apoyo_dx"]."',
					'".$_POST["dolor"]."',
					'".$_POST["pf"]."',
					'".$_POST["sencibilidad"]."',
					'".$_POST["fosteomuscular"]."',
					'".$_POST["postura"]."',
					'".$_POST["marcha"]."',
					'".$_POST["dx_fisioterapeutico"]."',
					'".$_POST["pron_fisioterapeutico"]."',
					'".$_POST["plan_intervencion"]."',
					'".$_POST["obj_terapeutico"]."',
					'Realizada')";
			$subtitulo="Valoracion inicial";
			$subtitulo1="Adicionado";
		break;
		case 'VALFONO':
			$sql="INSERT INTO fono_sm (id_adm_hosp, id_user, freg_valini_reh, hreg_valini_reh, tmuscular_i, sencibilidad_i, sfacial_i, labios_i, lengua_i, maxilar_i, paladar_i, sialorrea_i, resp_i, toclusion_i, praxia1,
				praxia2, praxia3, praxia4, praxia5, praxia6, praxia7, praxia8, praxia9, praxia10, praxia11, desa_lingue, test_arti, f_alimenticias, nseman1, nseman2, nseman3, nseman4, nseman5, nseman6, nsintac1, nsintac2,
				nsintac3, nsintac4, nsintac5, nsintac6, nprag1, nprag2, nprag3, nprag4, nprag5, nprag6, nprag7, nprag8, senso1, senso2, senso3, senso4, senso5, senso6, senso7, senso8, codlectoescrito, dxcomunicativo,
				estado_valini_fono) VALUES
			('".$_POST["id_adm_hosp"]."',
				'".$_SESSION["AUT"]["id_user"]."',
				'".$_POST["freg"]."',
				'".$_POST["hreg"]."',
				'".$_POST["tmuscular_i"]."',
				'".$_POST["sencibilidad_i"]."',
				'".$_POST["sfacial_i"]."',
				'".$_POST["labios_i"]."',
				'".$_POST["maxilar_i"]."',
				'".$_POST["paladar_i"]."',
				'".$_POST["sialorrea_i"]."',
				'".$_POST["resp_i"]."',
				'".$_POST["toclusion_i"]."',
				'".$_POST["praxia1"]."',
				'".$_POST["praxia2"]."',
				'".$_POST["praxia3"]."',
				'".$_POST["praxia4"]."',
				'".$_POST["praxia5"]."',
				'".$_POST["praxia6"]."',
				'".$_POST["praxia7"]."',
				'".$_POST["praxia8"]."',
				'".$_POST["praxia9"]."',
				'".$_POST["praxia10"]."',
				'".$_POST["praxia11"]."',
				'".$_POST["desa_lingue"]."',
				'".$_POST["test_arti"]."',
				'".$_POST["f_alimenticias"]."',
				'".$_POST["nseman1"]."',
				'".$_POST["nseman2"]."',
				'".$_POST["nseman3"]."',
				'".$_POST["nseman4"]."',
				'".$_POST["nseman5"]."',
				'".$_POST["nseman6"]."',
				'".$_POST["nsintac1"]."',
				'".$_POST["nsintac2"]."',
				'".$_POST["nsintac3"]."',
				'".$_POST["nsintac4"]."',
				'".$_POST["nsintac5"]."',
				'".$_POST["nsintac6"]."',
				'".$_POST["nprag1"]."',
				'".$_POST["nprag2"]."',
				'".$_POST["nprag3"]."',
				'".$_POST["nprag4"]."',
				'".$_POST["nprag5"]."',
				'".$_POST["nprag6"]."',
				'".$_POST["nprag7"]."',
				'".$_POST["nprag8"]."',
				'".$_POST["senso1"]."',
				'".$_POST["senso2"]."',
				'".$_POST["senso3"]."',
				'".$_POST["senso4"]."',
				'".$_POST["senso5"]."',
				'".$_POST["senso6"]."',
				'".$_POST["senso7"]."',
				'".$_POST["senso8"]."',
				'".$_POST["codlectoescrito"]."',
				'".$_POST["dxcomunicativo"]."','Realizada')";
			$subtitulo="Valoracion inicial";
			$subtitulo1="Adicionado";
		break;
		case 'VALTR':
			$sql="INSERT INTO tr_sm (  id_adm_hosp, id_user, freg_tr_ce, hreg_tr_ce, motivo_consulta, ant_per_fumador, ant_per_leña, ant_per_ambiental, ant_patologico, ant_quirurgicos, ant_traumatologico, ant_terapeutico, ant_toxicologicos, ant_alergicos, ant_farmacologico, ascultacion, fr, fc, so2, petibucal, distal, toracica, abdominal, amplitud, tintercostal, sis_oxigenoterapia, obs_sisoxigeno, obj_general, obj_especifico, pronostico, recomendaciones, estado_tr_ce) VALUES
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
			$subtitulo="Valoracion inicial";
			$subtitulo1="Adicionado";
		break;
		case'EVO':
			$sql="INSERT INTO evo_terapeutica_sm (id_adm_hosp, id_user, freg_evotera, hreg_evotera, evoluciontera,tterapia, estado_evotera ) VALUES
			('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["evoto"]."',
			'".$_POST['tterapia']."','Realizada')";
			$subtitulo="Evolucion";
			$subtitulo1="Adicionado";
		break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El formato de $subtitulo fue $subtitulo1 con exito!";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="El formato de $subtitulo NO fue $subtitulo !!! .";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'VALFISIO':
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,estadocivil,edad,lateralidad,profesion,religion,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_usuario,tipo_afiliacion,ocupacion,dep_residencia,mun_residencia,zona_residencia,nivel,via_ingreso,
									 s.nom_sedes
									 FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
									 									LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
									WHERE a.id_adm_hosp=".$_GET["idadmhosp"];
			$color="yellow";
			$boton="Agregar Valoración inicial".$_SESSION['AUT']['especialidad'] ;
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['doc'];
			$form1='formulariosHOSP/val_fisio_sm.php';
			$subtitulo='';
		break;
		case 'VALTR':
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,estadocivil,edad,lateralidad,profesion,religion,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_usuario,tipo_afiliacion,ocupacion,dep_residencia,mun_residencia,zona_residencia,nivel,via_ingreso,
									 s.nom_sedes
									 FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
									 									LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
									WHERE a.id_adm_hosp=".$_GET["idadmhosp"];
			$color="yellow";
			$boton="Agregar Valoración inicial Terapia respiratoria";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['doc'];
			$form1='formulariosHOSP/val_tr_sm.php';
			$subtitulo='';
		break;
		case 'VALFONO':
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,estadocivil,edad,lateralidad,profesion,religion,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_usuario,tipo_afiliacion,ocupacion,dep_residencia,mun_residencia,zona_residencia,nivel,via_ingreso,
									 s.nom_sedes
									 FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
									 									LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
									WHERE a.id_adm_hosp=".$_GET["idadmhosp"];
			$color="yellow";
			$boton="Agregar Valoración inicial".$_SESSION['AUT']['especialidad'] ;
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['doc'];
			$form1='formulariosHOSP/val_fono_sm.php';
			$subtitulo='';
		break;
		case 'EVO':
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,estadocivil,edad,lateralidad,profesion,religion,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_usuario,tipo_afiliacion,ocupacion,dep_residencia,mun_residencia,zona_residencia,nivel,via_ingreso,
									 s.nom_sedes
									 FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
									 									LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
									WHERE a.id_adm_hosp=".$_GET["idadmhosp"];
			$color="yellow";
			$boton="Agregar Evolución";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['doc'];
			$form1='formulariosHOSP/evo_tera_sm.php';
			$subtitulo='';
		break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fotopac"=>"","estadocivil"=>"","edad"=>"","lateralidad"=>"","profesion"=>"","religion"=>"",
				"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","tipo_usuario"=>"","tipo_afiliacion"=>"","ocupacion"=>"","dep_residencia"=>"","mun_residencia"=>"","zona_residencia"=>"","nivel"=>"","via_ingreso"=>"");
			}
		}else{
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fotopac"=>"","estadocivil"=>"","edad"=>"","lateralidad"=>"","profesion"=>"","religion"=>"",
				"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","tipo_usuario"=>"","tipo_afiliacion"=>"","ocupacion"=>"","dep_residencia"=>"","mun_residencia"=>"","zona_residencia"=>"","nivel"=>"","via_ingreso"=>"");
			}

		?>
		<script src = "js/sha3.js"></script>
				<script>

				function validar(){
					if (document.forms[0].hreg.value > document.forms[0].fecha.value){
						alert("Profesional: <?php echo $_SESSION["AUT"]["nombre"]?>, USTED NO puede adelantar el tiempo.");
						document.forms[0].hreg.focus();				// Ubicar el cursor
						return(false);
					}
				}
				</script>
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script src="ajax.js"></script>
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
	<section class="panel-heading"><h4>Rehabilitación terapéutica intrahospitalaria en Salud Mental</h4></section>
	<section class="col-xs-6">
		<label for="" class="alert alert-info text-center col-xs-12">Filtro por documento</label>
		<form>
			<section class="panel-body">
				<article class="col-xs-12 input-group">
					<span class="input-group-addon fa fa-user" id="basic-addon1"></span>
					<input type="text" class="form-control" placeholder="Digite documento de identidad" name="doc" aria-describedby="basic-addon1">
					<input type="hidden" class="form-control"  name="terapia" aria-describedby="basic-addon1" value="<?php echo $_SESSION["AUT"]["especialidad"];?>">
				</article>

				<br>
				<div>
					<input type="submit" name="buscar" class="btn btn-warning" value="Buscar">
					<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
				</div>
			</section>
		</form>
	</section>
	<section class="col-xs-6">
		<label for="" class="alert alert-info text-center col-xs-12">Filtro por Nombre</label>
		<form>
			<section class="panel-body">
				<article class="col-xs-12 input-group">
					<span class="input-group-addon fa fa-user" id="basic-addon1"></span>
					<input type="text" class="form-control" placeholder="Digite nombre o apellido " name="nom" aria-describedby="basic-addon1">
					<input type="hidden" class="form-control"  name="terapia" aria-describedby="basic-addon1" value="<?php echo $_SESSION["AUT"]["especialidad"];?>">
				</article>

				<br>
				<div>
					<input type="submit" name="buscar" class="btn btn-warning" value="Buscar">
					<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
				</div>
			</section>
		</form>
	</section>
	<section class="panel-body">
		<table class="table table-responsive table-bordered">
		<tr>
			<th class="text-center info">IDENTIFICACIÓN</th>
			<th class="text-center info">NOMBRE COMPLETO</th>
			<th class="text-center info">FECHA INGRESO</th>
			<th class="text-center info">EPS</th>
			<th class="text-center info" colspan="3">ACCION</th>
		</tr>

			<?php
			if (isset($_REQUEST["doc"])){
			$doc=$_REQUEST["doc"];
			$ter=$_REQUEST['terapia'];
				if ($ter=='FISIOTERAPIA') {
					$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,descricie,fotopac,
											 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,tipo_servicio,
											 s.nom_sedes,
											 e.nom_eps
								FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
															   LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
																 left join eps e on a.id_eps=e.id_eps
								WHERE p.doc_pac='".$doc."'  and tipo_servicio='Hospitalario'  and estado_adm_hosp='Activo'";

					if ($tabla=$bd1->sub_tuplas($sql)){
						//echo $sql;
						foreach ($tabla as $fila ) {

							echo"<tr >\n";
							$idpaciente=$fila["id_paciente"];
							echo'<td class="text-center"><strong>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].' <br /><strong> ADM: </strong>'.$fila["id_adm_hosp"].'</td>';
							echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
							echo'<td class="text-center">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
							echo'<td class="text-center">'.$fila["nom_eps"].'</td>';
							$edad=$fila["doc_pac"];
							$idpaciente=$fila["id_paciente"];
							$cie=$fila["edad"];
							$eps=$fila["nom_eps"];
							echo'<th class="text-center">
										<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VALFISIO&idadmhosp='.$fila["id_adm_hosp"].'&tterapia=FISIOTERAPIA&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Valoración<br> Fisioterapia</button></a>
										<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VALTR&idadmhosp='.$fila["id_adm_hosp"].'&tterapia=RESPIRATORIA&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Valoración<br> Respiratoria</button></a></th>';
							echo'<th class="text-center">
										<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&tterapia=FISIOTERAPIA&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución<br>Fisioterapia </button></a>
										<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&tterapia=RESPIRATORIA&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución<br>Respiratoria</button></a></th>';
							echo "</tr>\n";
						}
					}
				}//cierre de fisioterapia
				if ($ter=='FONOAUDIOLOGIA') {
					$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,descricie,fotopac,
											 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,tipo_servicio,
											 s.nom_sedes,
											 e.nom_eps
								FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
															   LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
																 left join eps e on a.id_eps=e.id_eps
								WHERE p.doc_pac='".$doc."'  and tipo_servicio='Hospitalario'  and estado_adm_hosp='Activo'";

					if ($tabla=$bd1->sub_tuplas($sql)){
						//echo $sql;
						foreach ($tabla as $fila ) {

							echo"<tr >\n";
							$idpaciente=$fila["id_paciente"];
							echo'<td class="text-center"><strong>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].' <br /><strong> ADM: </strong>'.$fila["id_adm_hosp"].'</td>';
							echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
							echo'<td class="text-center">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
							echo'<td class="text-center">'.$fila["nom_eps"].'</td>';
							$edad=$fila["doc_pac"];
							$idpaciente=$fila["id_paciente"];
							$cie=$fila["edad"];
							$eps=$fila["nom_eps"];
							echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VALFONO&idadmhosp='.$fila["id_adm_hosp"].'&tterapia=FONOAUDIOLOGIA&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Valoración fonoaudiologia</button></a></th>';
							echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&tterapia=FONOAUDIOLOGIA&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></th>';
							echo "</tr>\n";
						}
					}
				}//cierre de FONOAUDIOLOGIA
		}
		//filtro por nombre en listado de terapeutas rehabiklitacion en servicio de salud mental
		if (isset($_REQUEST["nom"])){
			$doc=$_REQUEST["nom"];
			$ter=$_REQUEST['terapia'];
				if ($ter=='FISIOTERAPIA') {
					$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,descricie,fotopac,
											 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,tipo_servicio,
											 s.nom_sedes,
											 e.nom_eps
								FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
															   LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
																 left join eps e on a.id_eps=e.id_eps
								WHERE p.nom_completo LIKE '%".$doc."%'  and tipo_servicio='Hospitalario'  and estado_adm_hosp='Activo'";

					if ($tabla=$bd1->sub_tuplas($sql)){
						//echo $sql;
						foreach ($tabla as $fila ) {

							echo"<tr >\n";
							$idpaciente=$fila["id_paciente"];
							echo'<td class="text-center"><strong>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].' <br /><strong> ADM: </strong>'.$fila["id_adm_hosp"].'</td>';
							echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
							echo'<td class="text-center">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
							echo'<td class="text-center">'.$fila["nom_eps"].'</td>';
							$edad=$fila["doc_pac"];
							$idpaciente=$fila["id_paciente"];
							$cie=$fila["edad"];
							$eps=$fila["nom_eps"];
							echo'<th class="text-center">
										<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VALFISIO&idadmhosp='.$fila["id_adm_hosp"].'&tterapia=FISIOTERAPIA&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Valoración<br> Fisioterapia</button></a>
										<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VALTR&idadmhosp='.$fila["id_adm_hosp"].'&tterapia=RESPIRATORIA&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Valoración<br> Respiratoria</button></a></th>';
							echo'<th class="text-center">
										<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&tterapia=FISIOTERAPIA&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución<br>Fisioterapia </button></a>
										<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&tterapia=RESPIRATORIA&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución<br>Respiratoria</button></a></th>';
							echo "</tr>\n";
						}
					}
				}//cierre de fisioterapia
				if ($ter=='FONOAUDIOLOGIA') {
					$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,descricie,fotopac,
											 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,tipo_servicio,
											 s.nom_sedes,
											 e.nom_eps
								FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
															   LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
																 left join eps e on a.id_eps=e.id_eps
								WHERE p.nom_completo='".$doc."'  and tipo_servicio='Hospitalario' and estado_adm_hosp='Activo'";

					if ($tabla=$bd1->sub_tuplas($sql)){
						//echo $sql;
						foreach ($tabla as $fila ) {

							echo"<tr >\n";
							$idpaciente=$fila["id_paciente"];
							echo'<td class="text-center"><strong>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].' <br /><strong> ADM: </strong>'.$fila["id_adm_hosp"].'</td>';
							echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
							echo'<td class="text-center">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
							echo'<td class="text-center">'.$fila["nom_eps"].'</td>';
							$edad=$fila["doc_pac"];
							$idpaciente=$fila["id_paciente"];
							$cie=$fila["edad"];
							$eps=$fila["nom_eps"];
							echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VALFONO&idadmhosp='.$fila["id_adm_hosp"].'&tterapia=FONOAUDIOLOGIA&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Valoración fonoaudiologia</button></a></th>';
							echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&tterapia=FONOAUDIOLOGIA&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></th>';
							echo "</tr>\n";
						}
					}
				}//cierre de FONOAUDIOLOGIA
		}
			?>

	</table>
</section>
	<?php
}
?>
