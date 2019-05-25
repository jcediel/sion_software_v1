<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

			switch ($_POST["operacion"]) {
			case 'E':
			$servicio=$_REQUEST['servicio'];
			$adm=$_POST['adm'];
			$sql_epi="SELECT * FROM evolucion_medica WHERE id_adm_hosp=$adm and tipo_evo='Epicrisis'";
			//echo $sql_epi;
			if ($tabla_epi=$bd1->sub_tuplas($sql_epi)){
				foreach ($tabla_epi as $fila_epi) {
					$sql="INSERT INTO evolucion_medica ( id_adm_hosp, id_user, freg_evomed, hreg_evomed, objetivo, subjetivo, analisis_evomed,
																							plan_tratamiento, dxp, ddxp, tdxp, dx1, ddx1, tdx1, dx2, ddx2, tdx2,dx3, ddx3, tdx3, resp_evomed, estado_evomed,
																							justificacion_hosp) VALUES
					('".$_POST["adm"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','Epicrisis','Epicrisis','Epicrisis',
					 'Epicrisis','$dxp','".$_POST["dx"]."','".$_POST["tdx"]."','$dx1','".$_POST["dx1"]."','".$_POST["tdx1"]."','$dx2',
		 			'".$_POST["dx2"]."','".$_POST["tdx2"]."','".$_SESSION["AUT"]["nombre"]."','Realizada',
					'".$_POST["analisis"]."','$servicio','Epicrisis')";
					$subtitulo1="No se puede registrar EPICRISIS porque ya existe un registro de esta admisión.";
				}
			}else {
				$dxp=substr($_POST['dx'], 0,4);
				$dx1=substr($_POST['dx1'], 0,4);
				$dx2=substr($_POST['dx2'], 0,4);
				$dx3=substr($_POST['dx3'], 0,4);
				$sql="INSERT INTO evolucion_medica (id_adm_hosp, id_user, freg_evomed, hreg_evomed, objetivo, subjetivo, analisis_evomed,
																						plan_tratamiento, dxp, ddxp, tdxp, dx1, ddx1, tdx1, dx2, ddx2, tdx2, resp_evomed, estado_evomed,
																						justificacion_hosp,servicio,tipo_evo) VALUES
				('".$_POST["adm"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','Epicrisis','Epicrisis','Epicrisis',
				 'Epicrisis','$dxp','".$_POST["dx"]."','".$_POST["tdx"]."','$dx1','".$_POST["dx1"]."','".$_POST["tdx1"]."','$dx2',
	 			'".$_POST["dx2"]."','".$_POST["tdx2"]."','".$_SESSION["AUT"]["nombre"]."','Realizada',
				'".$_POST["analisis"]."','$servicio','Epicrisis')";
				$subtitulo1="Registro de EPICRISIS con exito";
			}
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
			$subtitulo="$subtitulo1";
			$check="si";
		}else{
			$subtitulo="$subtitulo1";
			$check="no";
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'E':
			$sql="SELECT id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fnacimiento,edad,uedad,dir_pac,tel_pac,email_pac,estadocivil,etnia,
									 lateralidad,profesion,religion,fotopac
						FROM pacientes where id_paciente=".$_GET["id_pac"];

			$color="green";
			$boton="Agregar Epicrisis";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$servicio=$_REQUEST['servicio'];
			$admision=$_REQUEST['idadmhosp'];
			$form1='egresoMED/reg_epicrisis.php';
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
		}
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fnacimiento"=>"","edad"=>"",
				"uedad"=>"","dir_pac"=>"","tel_pac"=>"","email_pac="=>"","estadocivil="=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"",
				"hingreso_hosp"=>"");
			}
		}else{
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fnacimiento"=>"",
										"edad"=>"","uedad"=>"","dir_pac"=>"","tel_pac"=>"","email_pac="=>"","estadocivil="=>"","fotopac"=>"",
										"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"");
			}
		?>
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
		<section class="panel-heading">
			<h3>Egreso de pacientes en servicio <?php echo $_REQUEST['servicio'] ?></h3>
		</section>
		<section class="panel-body">
			<?php
			$opcion=$_REQUEST['servicio'];
			$atencion=$_REQUEST['atencion'];
				if ($opcion=='Hospital dia') {
					echo'<a href="'.PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion='.$opcion.'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-reply"></span> Regresar a pacientes <strong>'.$opcion.'</strong></button></a>';
				}
				if ($opcion=='Hospitalario'){
					if ($atencion=='Ambulatoria') {
						echo'<a href="'.PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion=37&servicio=Hospitalario&idadmhosp='.$_REQUEST['idadmhosp'].'&doc='.$_REQUEST['doc'].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-reply"></span> Regresar a pacientes <strong>'.$opcion.'</strong></button></a>';
					}else {
						echo'<a href="'.PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion=19&buscar=Consultar&doc='.$_REQUEST['doc'].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-reply"></span> Regresar a pacientes <strong>'.$opcion.'</strong></button></a>';
					}
				}
				if ($opcion=='Consulta Externa SM'){
					echo'<a href="'.PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion=66"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-reply"></span> Regresar a pacientes <strong>'.$opcion.'</strong></button></a>';
				}
			 ?>
			<br>
		</section>
		<section class="panel-body">
			<table class="table table-bordered">
				<tr>
					<th>PACIENTE</th>
					<th colspan="3">Acción</th>
				</tr>
				<?php
				if (isset($_REQUEST["idadmhosp"])){
				$idpaciente=$_GET["idadmhosp"];
				$sql="SELECT p.doc_pac,nom1,nom2,ape1,ape2,fotopac,
										 a.id_adm_hosp,id_sedes_ips,fingreso_hosp,hingreso_hosp,tipo_servicio,
										 e.tipo_evo
				FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
												 LEFT JOIN evolucion_medica e on e.id_adm_hosp=a.id_adm_hosp
				WHERE a.id_adm_hosp='".$idpaciente."' and a.tipo_servicio='".$_REQUEST['servicio']."' and e.tipo_evo='Epicrisis'";
					//echo $sql;
				if ($tabla=$bd1->sub_tuplas($sql)){
					foreach ($tabla as $fila) {
						echo"<tr >\n";
						echo'<td class="text-center">
									<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'<p>
									<p><strong>ADM: </strong>'.$fila["id_adm_hosp"].'<p>
									<p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].'<p>
								 </td>';
						echo'<th class="text-center" >
									<p><span class="fa fa-ban"></span> Epicrisis YA fue registrada </p>
									<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$_REQUEST["servicio"].'&atencion=Ambulatoria&doc='.$fila["doc_pac"].'&sede='.$fila['id_sedes_ips'].'"><button type="button" class="btn btn-success" ><span class="fa fa-flask"></span> AyudasDX Ambulatorias</button></a></p>
									<p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$_REQUEST["servicio"].'&atencion=Ambulatoria&doc='.$fila["doc_pac"].'&sede='.$fila['id_sedes_ips'].'&tf=A"><button type="button" class="btn btn-danger" ><span class="fa fa-pills"></span> Formula Ambulatoria</button></a></p>
									<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=INCAPA&idhc='.$fila["id_hchosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&atencion=Ambulatorio&servicio='.$_REQUEST["servicio"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-info" ><span class="fa fa-blind"></span> Incapacidad</button></a></p>
								 </td>';
						echo "</tr>\n";
					}
				}else {
					echo"<tr >\n";
					echo'<td class="text-left">';
							$sql_pac="SELECT p.doc_pac,nom1,nom2,ape1,ape2,fotopac,
													 a.id_adm_hosp,id_sedes_ips,fingreso_hosp,hingreso_hosp,tipo_servicio

							FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente

							WHERE a.id_adm_hosp='".$idpaciente."' and a.tipo_servicio='".$_REQUEST['servicio']."'";
//echo $sql_pac;
							if ($tabla_pac=$bd1->sub_tuplas($sql_pac)){
								foreach ($tabla_pac as $fila_pac) {
								echo'<p>'.$fila_pac["nom1"].' '.$fila_pac["nom2"].' '.$fila_pac["ape1"].' '.$fila_pac["ape2"].'<p>
											<p><strong>ADM: </strong>'.$fila_pac["id_adm_hosp"].'<p>
											<p><strong>Ingreso: </strong>'.$fila_pac["fingreso_hosp"].' '.$fila_pac["hingreso_hosp"].'<p>
										 </td>';
								//$sql_interpretación="SELECT ";
								echo'<th class="text-left" >
											<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idhc='.$_REQUEST["idadmhosp"].'&servicio='.$_REQUEST["servicio"].'&doc='.$_REQUEST["doc_pac"].'&idadmhosp='.$_REQUEST["idadmhosp"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus"></span> Epicrisis</button></a></p>
											<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$_REQUEST["idadmhosp"].'&servicio='.$_REQUEST["servicio"].'&atencion=Ambulatoria&doc='.$_REQUEST["doc"].'&sede='.$fila_pac['id_sedes_ips'].'"><button type="button" class="btn btn-success" ><span class="fa fa-flask"></span> AyudasDX Ambulatorias</button></a></p>
											<p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$_REQUEST["idadmhosp"].'&servicio='.$_REQUEST["servicio"].'&atencion=Ambulatoria&doc='.$_REQUEST["doc"].'&sede='.$fila_pac['id_sedes_ips'].'&tf=A"><button type="button" class="btn btn-danger" ><span class="fa fa-pills"></span> Formula Ambulatoria</button></a></p>
											<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=INCAPA&idhc='.$_REQUEST["id_hchosp"].'&idadmhosp='.$fila_pac["id_adm_hosp"].'&atencion=Ambulatorio&servicio='.$_REQUEST["servicio"].'&doc='.$fila_pac["doc_pac"].'"><button type="button" class="btn btn-info" ><span class="fa fa-blind"></span> Incapacidad</button></a></p>
										 </th>';
								echo "</tr>\n";
						}
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
