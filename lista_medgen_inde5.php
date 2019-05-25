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
			$sql="INSERT INTO hc_hospitalario (id_adm_hosp,id_user,freg_hchosp,hreg_hchosp,motivo_consulta,enfer_actual,his_personal,his_familiar,
				perso_premorbida,ant_alergicos,ant_patologico,ant_quirurgico,ant_toxicologico,ant_farmaco,ant_gineco,
				ant_psiquiatrico,ant_hospitalario,ant_traumatologico,ant_familiar,otros_ant,estado_general,tad,tas,tam,
				fr,fc,so,peso,talla,temperatura,imc,cabcuello,torax,ext,abdomen,neurologico,genitourinario,examen_mental,
				analisis,finalidad,causa_externa,dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,dx3,ddx3,tdx3,
				plantratamiento,tipo_atencion,especialidad,estado_hchosp) VALUES
			('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["motivoconsulta"]."',
			'".$_POST["enferactual"]."','".$_POST["hpersonal"]."','".$_POST["hfamiliar"]."','".$_POST["ppremorbida"]."','".$_POST["antalergico"]."',
			'".$_POST["antpatologico"]."','".$_POST["antquirurgico"]."','".$_POST["anttoxicologicos"]."','".$_POST["antfarmacologico"]."','".$_POST["antgineco"]."',
			'".$_POST["antpsiquiatrico"]."','".$_POST["anthospitalario"]."','".$_POST["anttrauma"]."','".$_POST["antfami"]."','".$_POST["antotros"]."',
			'".$_POST["estadogen"]."','".$_POST["tad"]."','".$_POST["tas"]."','$tamt','".$_POST["fr"]."','".$_POST["fc"]."','".$_POST["sao2"]."','".$_POST["peso"]."',
			'".$_POST["talla"]."','".$_POST["temperatura"]."','$imc','".$_POST["cabezacuello"]."','".$_POST["torax"]."','".$_POST["extsup"]."','".$_POST["abdomen"]."',
			'".$_POST["neurologico"]."','".$_POST["genitourinario"]."','".$_POST["exmental"]."','".$_POST["analisis"]."','".$_POST["finconsulta"]."',
			'".$_POST["causaexterna"]."','".$_POST["dx"]."','".$_POST["dx"]."','".$_POST["tdx"]."','".$_POST["dx1"]."',
			'".$_POST["dx1"]."','".$_POST["tdx1"]."','".$_POST["dx2"]."','".$_POST["dx2"]."','".$_POST["tdx2"]."','".$_POST["dx3"]."','".$_POST["dx3"]."',
			'".$_POST["tdx3"]."','".$_POST["plant"]."','Medicina General INDE','".$_SESSION["AUT"]["especialidad"]."','Realizada')";
				$subtitulo="Historia Clinica de ingreso";
				$subtitulo1="Adicionado";

			break;
			case 'EVO':
				$sql="INSERT INTO evo_medgen_inde (id_adm_hosp,id_user,freg_evomed,hreg_evomed,objetivo,
					subjetivo,analisis_evomed,plan_tratamiento,ddxp,tdxp,ddx1,tdx1,ddx2,tdx2,resp_evomed,estado_evomed) VALUES
				('".$_POST["id"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."',
				'".$_POST["hreg"]."','".$_POST["objetivo"]."','".$_POST["subjetivo"]."','".$_POST["analisis"]."',
				'".$_POST["plantratamiento"]."','".$_POST["dx"]."','".$_POST["tdx"]."','".$_POST["dx1"]."','".$_POST["tdx1"]."',
				'".$_POST["dx2"]."','".$_POST["tdx2"]."','".$_SESSION["AUT"]["nombre"]."','Realizada')";
				$subtitulo="Evolución Medica (medicina general)";
				$subtitulo1="Adicionado";
			break;
			case 'ADX':
				$sql="INSERT INTO ord_med_hosp (id_adm_hosp, id_user, freg_ord_med_hosp, hreg_ord_med_hosp,
					ts_ord_med_hosp,dx,tdx, procedimiento, obs_proc, estado_ord_med_hosp) VALUES
				('".$_POST["id"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."',
				'".$_POST["tiposervicio"]."','".$_POST["dx"]."','".$_POST["tdx"]."','".$_POST["cups"]."','".$_POST["obs_proc"]."'
				,'Realizada')";
				$subtitulo="Ordenes Medicas";
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
			('".$_POST["id"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg_incapa_hosp"]."','".$_POST["tipo_atencion"]."',
			'".$_POST["origen_atencion"]."','0','".$_POST["dx"]."','".$_POST["tdx"]."','".$_POST["fini_incapa"]."',
			'".$_POST["ffin_incapa"]."','$diast ','".$_POST["obs_incapa_med"]."','Realizada')";
			$subtitulo1="Generación de INCAPACIDAD";
			$subtitulo="Realizada";

			break;

			case 'ORDVER':
				$sql="INSERT INTO orden_verbal( id_adm_hosp, id_user, freg_ord_verbal, hreg_ord_verbal, orden_verbal, estado_orden_verbal) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["ordverb"]."','Realizada')";
				$subtitulo="Orden Verbal";
				$subtitulo1="Adicionada";
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
			$form1='FormulariosINDE/hc_medgen.php';
			$subtitulo='Historia Clinica medicina general';
			break;
			case 'EVO':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,
			email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			//echo $sql;
			$boton="Agregar Evolución Medica";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$return=149;
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='FormulariosINDE/evo_medgen_inde.php';
			$subtitulo='Evolución Medica';
			break;
			case 'ADX':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,
			email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Ayuda Diagnostica";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/ord_med_hosp.php';
			$subtitulo='Solicitud de Ordenes Medicas Hospitalarias (Procedimientos y laboratorios)';
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
			case 'ORDVER':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,
			tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
									left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Orden Verbal";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/ordenverbal.php';
			$subtitulo='Orden verbal';
			break;

		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"",
				"fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"",
				"religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"",
				"hegreso_hosp"=>"", "nom_eps"=>"","id_sedes_ips"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"",
				"fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"",
				"religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"",
				"hegreso_hosp"=>"", "nom_eps"=>"","id_sedes_ips"=>"");
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
	<section class="panel-heading"><h4>Medicina General INDE</h4></section>
	<div class="panel-body">

		<section class="panel panel-default" class="col-xs-7">
			<form class="navbar-form navbar-center" role="search" >
	        	<section class="form-group col-xs-3">
	          		<input type="text" class="form-control" name="doc" placeholder="Digite Identificacion">
	        	</section>
	        	<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
	        	<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
	    </form>
			<form class="navbar-form navbar-center" role="search">
						<section class="form-group col-xs-3">
								<input type="text" class="form-control" name="nom" placeholder="Digite Nombre paciente">
						</section>
						<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
						<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			</form>
		</section>
		<table class="table table-responsive table-bordered">
			<tr>
				<th class="success">PACIENTE</th>
				<th class="success">INGRESO</th>
				<th class="success">Acciones</th>

			</tr>

			<?php
			$f=date('Y-m-d');
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,
									 s.id_sedes_ips,nom_sedes,
									 e.nom_eps
						FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
														 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
														 LEFT JOIN eps e on a.id_eps=e.id_eps
						WHERE a.estado_adm_hosp='Activo' and fingreso_hosp='$f'
																			 and tipo_servicio in ('Medicina General INDE')
			      ORDER BY hingreso_hosp ASC";

			if ($tabla=$bd1->sub_tuplas($sql)){
				foreach ($tabla as $fila ) {
					echo"<tr >	\n";
					echo'<td class="text-left">
								<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
								<p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>
								<p><strong>ADM: </strong>'.$fila["id_adm_hosp"].'</p>
							 </td>';
					echo'<td class="text-left">
								<p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
								<p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].'</p>
								<p><strong>SERVICIO: </strong>'.$fila["tipo_servicio"].'</p>
							 </td>';
					echo'<th class="text-right">
								<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Valoración inicial</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Consulta externa INDE"><button type="button" class="btn btn-success" ><span class="fa fa-flask"></span> Apoyo DX</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=INCAPA&idhc='.$fila["id_hchosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila["tipo_servicio"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-info" ><span class="fa fa-blind"></span> Incapacidad</button></a></p>
								</th>';
					echo "</tr>\n";
				}
			}

		if (isset($_REQUEST["doc"])){
			$doc=$_REQUEST["doc"];
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,
									 s.nom_sedes
						FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
														 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
						WHERE p.doc_pac='$doc' and a.estado_adm_hosp='Activo'
						and tipo_servicio in ('Demencias','AVD')";

			if ($tabla=$bd1->sub_tuplas($sql)){
				//echo $sql;
				foreach ($tabla as $fila ) {
					if ($fila['tipo_servicio']=='Demencias') {
						echo"<tr >	\n";
						echo'<td class="text-left alert alert-success">
									<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
									<p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>
									<p><strong>ADM: </strong>'.$fila["id_adm_hosp"].'</p>
								 </td>';
						echo'<td class="text-left alert alert-success">
									<p><strong>EPS: </strong>'.$fila["nom_eps"].' '.$fila["hingreso_hosp"].'</p>
									<p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].'</p>
									<p><strong>SERVICIO: </strong>'.$fila["tipo_servicio"].'</p>
								 </td>';
						echo'<th class="text-right alert alert-success">
									<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Valoración Inicial</button></a></p>
									<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>
									<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Consulta externa INDE"><button type="button" class="btn btn-success" ><span class="fa fa-flask"></span> Ayudas DX</button></a></p>
								 </th>';
						echo "</tr>\n";
					}
					if ($fila['tipo_servicio']=='AVD') {
						echo"<tr >	\n";
						echo'<td class="text-left alert alert-warning">
									<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
									<p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>
									<p><strong>ADM: </strong>'.$fila["id_adm_hosp"].'</p>
								 </td>';
						echo'<td class="text-left alert alert-warning">
									<p><strong>EPS: </strong>'.$fila["nom_eps"].' '.$fila["hingreso_hosp"].'</p>
									<p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].'</p>
									<p><strong>SERVICIO: </strong>'.$fila["tipo_servicio"].'</p>
								 </td>';
						echo'<th class="text-right alert alert-warning">
									<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Valoración Inicial</button></a></p>
									<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>
									<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Consulta externa INDE"><button type="button" class="btn btn-success" ><span class="fa fa-flask"></span> Ayudas DX</button></a></p>
								 </th>';
						echo "</tr>\n";
					}

				}
			}
		}
		if (isset($_REQUEST["nom"])){
			$doc=$_REQUEST["nom"];
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,
									 s.nom_sedes,
									 e.nom_eps
						FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
														 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
														 LEFT JOIN eps e on a.id_eps=e.id_eps
						WHERE p.nom_completo LIKE '%".$doc."%' and a.estado_adm_hosp='Activo'
						and tipo_servicio in ('Consulta externa INDE','Demencias','AVD')";

			if ($tabla=$bd1->sub_tuplas($sql)){
				//echo $sql;
				foreach ($tabla as $fila ) {
					if ($fila['tipo_servicio']=='Demencias') {
						echo"<tr >	\n";
						echo'<td class="text-left alert alert-success">
									<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
									<p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>
									<p><strong>ADM: </strong>'.$fila["id_adm_hosp"].'</p>
								 </td>';
						echo'<td class="text-left alert alert-success">
									<p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
									<p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].'</p>
									<p><strong>SERVICIO: </strong>'.$fila["tipo_servicio"].'</p>
								 </td>';
						echo'<th class="text-right alert alert-success">
									<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Valoración Inicial</button></a></p>
									<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>
									<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Consulta externa INDE"><button type="button" class="btn btn-success" ><span class="fa fa-flask"></span> Ayudas DX</button></a></p>
								 </th>';
						echo "</tr>\n";
					}
					if ($fila['tipo_servicio']=='AVD') {
						echo"<tr >	\n";
						echo'<td class="text-left alert alert-warning">
									<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
									<p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>
									<p><strong>ADM: </strong>'.$fila["id_adm_hosp"].'</p>
								 </td>';
						echo'<td class="text-left alert alert-warning">
									<p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
									<p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].'</p>
									<p><strong>SERVICIO: </strong>'.$fila["tipo_servicio"].'</p>
								 </td>';
						echo'<th class="text-right alert alert-warning">
									<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Valoración Inicial</button></a></p>
									<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>
									<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Consulta externa INDE"><button type="button" class="btn btn-success" ><span class="fa fa-flask"></span> Ayudas DX</button></a></p>
								 </th>';
						echo "</tr>\n";
					}

				}
			}
		}
			?>

		</table>

		</div>
</section>
		<?php
	}
	?>
