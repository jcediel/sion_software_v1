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
			case 'HC':
			$tallat=$_POST["talla"] * $_POST["talla"];
			$imc=$_POST["peso"] / $tallat;
			$tam1=$_POST["tad"] * 2;
			$tam2=$tam1 + $_POST["tds"];
			$tamt=$tam2/3;
			$sql="INSERT INTO hc_sm_pv (id_adm_hosp, id_user, freg_hcsm_pv, hreg_hcsm_pv, motivo_consulta, enfer_actual,
				his_personal, his_familiar, perso_premorbida, ant_alergicos, ant_patologico, ant_quirurgico, ant_toxicologico, ant_farmaco,
				ant_gineco, ant_psiquiatrico, ant_hospitalario, ant_traumatologico, ant_familiar, otros_ant, estado_general, tad, tas, tam,
				fr, fc, so, peso, talla, temperatura, imc, cabcuello, torax, ext, abdomen, neurologico, genitourinario, examen_mental, analisis,
				finalidad, causa_externa, dxp, ddxp, tdxp, dx1, ddx1, tdx1, dx2, ddx2, tdx2, dx3, ddx3, tdx3, plantratamiento, tipo_atencion,
				especialidad, estado_hcsm_pv) VALUES
			('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["motivoconsulta"]."',
			'".$_POST["enferactual"]."','".$_POST["hpersonal"]."','".$_POST["hfamiliar"]."','".$_POST["ppremorbida"]."','".$_POST["antalergico"]."',
			'".$_POST["antpatologico"]."','".$_POST["antquirurgico"]."','".$_POST["anttoxicologicos"]."','".$_POST["antfarmacologico"]."',
			'".$_POST["antgineco"]."','".$_POST["antpsiquiatrico"]."','".$_POST["anthospitalario"]."','".$_POST["anttrauma"]."','".$_POST["antfami"]."',
			'".$_POST["antotros"]."','".$_POST["estadogen"]."','".$_POST["tad"]."','".$_POST["tas"]."','$tamt','".$_POST["fr"]."','".$_POST["fc"]."',
			'".$_POST["sao2"]."','".$_POST["peso"]."','".$_POST["talla"]."','".$_POST["temperatura"]."','$imc','".$_POST["cabezacuello"]."',
			'".$_POST["torax"]."','".$_POST["extsup"]."','".$_POST["abdomen"]."','".$_POST["neurologico"]."','".$_POST["genitourinario"]."',
			'".$_POST["exmental"]."','".$_POST["analisis"]."','".$_POST["finconsulta"]."','".$_POST["causaexterna"]."',
			'','".$_POST["dx"]."','".$_POST["tdx"]."','','".$_POST["dx1"]."','".$_POST["tdx1"]."','".$_POST["dx2"]."',
			'".$_POST["dx2"]."','".$_POST["tdx2"]."','','".$_POST["dx3"]."','".$_POST["tdx3"]."','".$_POST["plant"]."','Consulta Externa SM',
			'".$_SESSION["AUT"]["especialidad"]."','Realizada')";
				$subtitulo="Historia Clinica primera vez";
				$subtitulo1="Adicionado";
			break;
			case 'HCINS':
				$sql="INSERT INTO evolucion_medica (id_adm_hosp,id_user,freg_evomed,hreg_evomed,objetivo,subjetivo,analisis_evomed,plan_tratamiento,
					dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,resp_evomed,estado_evomed) VALUES
				('".$_POST["id"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."',
				'".$_POST["hreg"]."','NO ASISTENCIA A CONSULTA O NO RESPONDE DESPUES DE TRES LLAMADOS',
				'NO ASISTENCIA A CONSULTA O NO RESPONDE DESPUES DE TRES LLAMADOS','".$_POST["inasistencia"]."','NO ASISTENCIA A CONSULTA O NO RESPONDE DESPUES DE TRES LLAMADOS',
				'NO',
				'NO','NO','dxp',
				'0000--paciente no asiste a la consulta','no asiste',
				'dx1','0000--paciente no asiste a la consulta','no asiste','dx2','0000--paciente no asiste a la consulta','no asiste',
				'".$_SESSION["AUT"]["nombre"]."','Inasistencia')";
				$subtitulo="Inasistencia a la consulta";
				$subtitulo1="Adicionado";
			break;
			case 'EVO':
			$dxp=substr($_POST['dx'], 0,4);
			$dx1=substr($_POST['dx1'], 0,4);
			$dx2=substr($_POST['dx2'], 0,4);
			$dx3=substr($_POST['dx3'], 0,4);
				$sql="INSERT INTO evolucion_medica (id_adm_hosp,id_user,freg_evomed,hreg_evomed,objetivo,subjetivo,analisis_evomed,plan_tratamiento
					,dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,resp_evomed,estado_evomed,justificacion_hosp,servicio,tipo_evo) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["objetivo"]."',
				'".$_POST["subjetivo"]."','".$_POST["analisis"]."','".$_POST["plantratamiento"]."','$dxp','".$_POST["dx"]."','".$_POST["tdx"]."',
				'$dx1','".$_POST["dx1"]."','".$_POST["tdx1"]."','$dx2','".$_POST["dx2"]."','".$_POST["tdx2"]."',
				'".$_SESSION["AUT"]["nombre"]."','Realizada','Consulta externa','Consulta externa SM','Control')";
				$subtitulo="La evolución Medica de control";
				$subtitulo1="Adicionado";
			break;
			case 'INCAPA':
			$fecha=$_POST["fini_incapa"];
			$fecha2=$_POST["ffin_incapa"];
			$fechaini=strtotime($fecha);
			$fechafin=strtotime($fecha2);
			$min=60;
			$hora=60*$min;
			$dia=24*$hora;
			$diast=floor($fechafin/$dia)-floor($fechaini/$dia) +1;

			$sql="INSERT INTO incapacidad_medica (id_adm_hosp, id_user, freg_incapa_med, tipo_atencion, origen_atencion, coddx_incapa_med, ddx_incapa_med, tdx_incapa_med, fini_incapa_med, ffin_incapa_med, total_dias_incapa, obs_incapa_med, estado_incapa) VALUES
			('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg_incapa_hosp"]."','".$_POST["tipo_atencion"]."',
			'".$_POST["origen_atencion"]."','0','".$_POST["dx"]."','".$_POST["tdx"]."','".$_POST["fini_incapa"]."',
			'".$_POST["ffin_incapa"]."','$diast ','".$_POST["obs_incapa_med"]."','Realizada')";
			$subtitulo1="Generación de INCAPACIDAD";
			$subtitulo="Realizada";
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
			$subtitulo="El formato de $subtitulo en $subtitulo2 NO fue $subtitulo1 !!! .";
		$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'HC':
    $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
    j.nom_eps
    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                left join eps j on (j.id_eps=b.id_eps)
    where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar HC";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$form1='formulariosHOSP/hc_hospdia.php';
			$subtitulo='Historia Clinica de primera vez';
			break;
			case 'EVO':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Evolución control";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$form1='formulariosHOSP/MEDICOS/evomed_ce_sm.php';
			$subtitulo='Evolución de control';
			break;
			case 'INCAPA':
			$sql="SELECT p.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,a.id_adm_hosp,fingreso_hosp,hingreso_hosp
			FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
			 WHERE a.id_adm_hosp=".$_REQUEST["idadmhosp"];

			$color="yellow";
			$boton="Registrar Incapacidad";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='GENERACIÓN DE INCAPACIDAD MEDICA';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$valor='visible';
			$valor1='hidden';
			$freg1='hidden';
			$freg='text';
			$ext='date';
			$return=$_REQUEST['idadmhosp'];
			$return1=$_REQUEST['doc'];
			$form1='egresoMED/incapacidad.php';
			break;
			case 'HCINS':
			$sql="SELECT p.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp
			FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
			 WHERE a.id_adm_hosp=".$_REQUEST["idadmhosp"];
			 //echo $sql;
			$color="yellow";
			$boton="Registrar inasistencia";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$valor='visible';
			$valor1='hidden';
			$freg1='hidden';
			$freg='text';
			$ext='date';
			$return=$_REQUEST['idadmhosp'];
			$return1=$_REQUEST['doc'];
			$form1='formulariosHOSP/inasistencia.php';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"",
				"dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"",
				"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id_sedes_ips"=>"",
			"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"",
				"dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"",
				"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id_sedes_ips"=>"",
			"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"");
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

	<section class="panel-heading"><h4>Consulta externa PSIQUIATRIA</h4></section>

	<section class="panel-body">
		<form>
			<article class="col-md-6">
				<label for="">Selección de IPS:</label>
				<select class="form-control" name="ips">
					<option value="1">Consorcio Emmanuel</option>
					<option value="2">INDE</option>
				</select>
			</article>
			<article class="col-md-6">
					<label for=""> </label>
					<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
					<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			</article>
		</form>
	</section>
	<section class="panel-body">
		<table class="table table-sm table-bordered">
		<tr>
			<th class="text-center success">IDENTIFICACIÓN</th>
			<th class="text-center success">PACIENTE</th>
			<th class="text-center success">FECHA INGRESO</th>
			<th class="text-center success">HORA INGRESO</th>
			<th colspan="6" class="text-center success">Acciones</th>
		</tr>

			<?php

			    $doc=$_REQUEST["doc"];
					$f=date('Y-m-d');
					$ips=$_REQUEST['ips'];
					if ($ips=='1') {
						$servicio='Consulta Externa SM';
					}
					if ($ips=='2') {
						$servicio='Salud Empresarial';
					}
			    $sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
			                 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,
			                 s.id_sedes_ips,nom_sedes,
			                 h.id_hcsm_pv

			          FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
			                           INNER JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
			                           LEFT JOIN hc_sm_pv h on a.id_adm_hosp=h.id_adm_hosp

			          WHERE  a.estado_adm_hosp='Activo' and a.tipo_servicio in ('$servicio') and a.fingreso_hosp='$f'
								ORDER BY hingreso_hosp ASC
			          ";
			      //echo $sql;
			      if ($tabla=$bd1->sub_tuplas($sql)){

			        foreach ($tabla as $fila ) {
			          if ($fila['id_hcsm_pv']=='') {
			            echo"<tr >	\n";
			            echo'<td class="text-center">
			                  <p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].' </p>
			                  <p><strong>ADM:</strong>'.$fila["id_adm_hosp"].'</p>';
			            echo'</td>';
			            echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
			            echo'<td class="text-center">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
									echo'<td class="text-center lead">'.$fila["hingreso_hosp"].'</td>';
			            echo'<th class="text-center">
												<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-plus-circle"></span> HC Primera vez </button></a></p>
												<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HCINS&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-plus-circle"></span> Inasistencia </button></a></p>
											 </th>';
									echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-plus-circle"></span> Control </button></a>';
									$ida=$fila['id_adm_hosp'];
									$sql1="SELECT count(id_evomed) cuanto, max(freg_evomed) f FROM evolucion_medica WHERE id_adm_hosp=$ida";
									//echo $sql1;
									if ($tabla1=$bd1->sub_tuplas($sql1)){
										foreach ($tabla1 as $fila1 ) {
											echo'<p><span class="badge">'.$fila1['cuanto'].'</span> '.$fila1['f'].'</p>';
										}
									}
									echo'</th>';
									echo'<th class="text-center">
												<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$servicio.'&atencion=Ambulatoria&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success " ><span class="fa fa-flask"></span> Ayuda Dx</button></a></p>
												<p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$servicio.'&atencion=Ambulatoria&doc='.$fila["doc_pac"].'&sede='.$fila['id_sedes_ips'].'&tf=A"><button type="button" class="btn btn-danger" ><span class="fa fa-pills"></span> Formula Ambulatoria</button></a></p>
											 </th>';
									echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=INCAPA&idhc='.$fila["id_hchosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$_REQUEST["servicio"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-info " ><span class="fa fa-blind"></span> Incapacidad</button></a></th>';
									echo "</tr>\n";

			          }else {
									echo"<tr >	\n";
			            echo'<td class="text-center">
			                  <p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].' </p>
			                  <p><strong>ADM:</strong>'.$fila["id_adm_hosp"].'</p>';
			            echo'</td>';
			            echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
			            echo'<td class="text-center">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
									echo'<td class="text-center lead">'.$fila["hingreso_hosp"].'</td>';
			            echo'<th class="text-center">
												<p><span class="fa fa-ban fa-2x"></span></p>
												<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HCINS&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-plus-circle"></span> Inasistencia </button></a></p>
											 </th>';
									echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-plus-circle"></span> Control </button></a>';
									$ida=$fila['id_adm_hosp'];
									$sql1="SELECT count(id_evomed) cuanto,max(freg_evomed) f FROM evolucion_medica WHERE id_adm_hosp=$ida";
									//echo $sql1;
									if ($tabla1=$bd1->sub_tuplas($sql1)){
										foreach ($tabla1 as $fila1 ) {
											echo'<p><span class="badge">'.$fila1['cuanto'].'</span> '.$fila1['f'].'</p>';
										}
									}
									echo'</th>';
									echo'<th class="text-center">
									<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$servicio.'&atencion=Ambulatoria&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success " ><span class="fa fa-flask"></span> Ayuda Dx</button></a></p>
									<p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$servicio.'&atencion=Ambulatoria&doc='.$fila["doc_pac"].'&sede='.$fila['id_sedes_ips'].'&tf=A"><button type="button" class="btn btn-danger" ><span class="fa fa-pills"></span> Formula Ambulatoria</button></a></p>
											 </th>';
									echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=INCAPA&idhc='.$fila["id_hchosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$_REQUEST["servicio"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-info " ><span class="fa fa-blind"></span> Incapacidad</button></a></th>';
									echo "</tr>\n";
			          }
			        }
			      }

			?>
		<table>
	</section>
</section>
		<?php
	}
	?>
