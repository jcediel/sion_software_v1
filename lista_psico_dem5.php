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

			case 'ING':
				$sql="INSERT INTO psico_ce_sm ( id_adm_hosp, id_user, freg_psicoce_sm, hreg_psicoce_sm,m_consulta,h_personal_familiar,
					evaluacion_psicologica,analisis_caso,recomendaciones,estado_psicoce_sm) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."',
				'".$_POST["motivo_consulta"]."','".$_POST["hfamiliar_personal"]."','".$_POST["evaluacion_psico"]."',
				'".$_POST["analisis_caso"]."','".$_POST["recomendaciones"]."','Realizada')";
				$subtitulo="Valoración Psicologia";
				$subtitulo1="Adicionado";
				$subtitulo2="Consulta externa INDE";
			break;
			case 'EVO':
				$sql="INSERT INTO evo_psico_dem (id_adm_hosp, id_user, freg_evopsico, hreg_evopsico, evolucionpsico, estado_evopsico) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["evoto"]."','Realizada')";
				$subtitulo="Evolución Psicologia";
				$subtitulo1="Adicionado";
				$subtitulo2="Demencias";
			break;
			case 'IM':
			if ($_SESSION["AUT"]["especialidad"]=='ADMINISTRATIVO') {
				$sql="";
				$msg='LA ESPECIELIDAD DE SU PERFIL NO LE PERMITE REALIZAR REGISTROS ASISTENCIALES';
				$subtitulo="Informe Mensual Psicologia";
				$subtitulo1="Adicionado";
				$subtitulo2="Demencias";

			}else {
				$sql="INSERT INTO im_demencias_inde (id_adm_hosp, id_user, freg_im_dem, hreg_im_dem, objetivo_im_dem, actrealizada_im_dem, logros_im_dem, plant_im_dem, servicio, estado_im_dem) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["fregimto"]."','".$_POST["hregimto"]."','".$_POST["obj"]."','".$_POST["act"]."','".$_POST["logro"]."','".$_POST["plant"]."','".$_SESSION["AUT"]["especialidad"]."','Realizada')";
				$subtitulo="Informe Mensual Psicologia";
				$subtitulo1="Adicionado";
				$subtitulo2="Demencias";
			}

			break;
			case 'PTGEN':
			if ($_SESSION["AUT"]["especialidad"]=='ADMINISTRATIVO') {
				$sql="";
				$msg='LA ESPECIELIDAD DE SU PERFIL NO LE PERMITE REALIZAR REGISTROS ASISTENCIALES';
				$subtitulo="Plan Trimestral General";
				$subtitulo1="Adicionado";
				$subtitulo2="Demencias";

			}else {
				$fecha = date('Y-m-j');
				$nuevafecha = strtotime ( '+90 day' , strtotime ( $fecha ) ) ;
				$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
				$sql="INSERT INTO plan_general_dem(id_adm_hosp, id_user, freg_ptgen_dem, fvence_ptgen_dem, modulo,obj_general_dem, estado_ptgen_dem) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','$nuevafecha','".$_POST["modulo"]."','".$_POST["objgen"]."','Realizada')";
				$subtitulo="Plan Trimestral General";
				$subtitulo1="Adicionado";
				$subtitulo2="Demencias";
			}
			break;
			case 'PTINV':
			if ($_SESSION["AUT"]["especialidad"]=='ADMINISTRATIVO') {
				$sql="";
				$msg='LA ESPECIELIDAD DE SU PERFIL NO LE PERMITE REALIZAR REGISTROS ASISTENCIALES';
				$subtitulo="Plan Trimestral Individual Psicologia";
				$subtitulo1="Adicionado";
				$subtitulo2="Demencias";

			}else {
				$sql="INSERT INTO plan_individual_dem (id_ptgen_dem, id_user, servicio, freg_ptinv_dem, obj_dem, act1_dem, atc2_dem, estado_ptinv_dem) VALUES
				('".$_POST["idgen"]."','".$_SESSION["AUT"]["id_user"]."','".$_SESSION["AUT"]["especialidad"]."','".$_POST["freg"]."','".$_POST["obespec"]."','".$_POST["actividad1"]."','".$_POST["actividad2"]."','Realizada')";
				$subtitulo="Plan Trimestral Individual Psicologia";
				$subtitulo1="Adicionado";
				$subtitulo2="Demencias";
			}
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
			$subtitulo="El formato de $subtitulo en $subtitulo2 NO fue $subtitulo1 !!!. $msg";
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
			$boton="Agregar Valoración";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$form1='FormulariosINDE/val_inifisio_dem.php';
			$subtitulo='Valoracion inicial Demencias';
			break;
			case 'ING':
	    $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
	    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
	    j.nom_eps
	    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
	                left join eps j on (j.id_eps=b.id_eps)
	    where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
				$color="green";
				$boton="Agregar Valoracion";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$date=date('Y-m-d');
				$date1=date('H:i');
				$doc=$_REQUEST['doc'];
				$opcion=$_REQUEST['opcion'];
				$doc=$_REQUEST['doc'];
				$form1='formularios/val_psicoce_sm.php';
				$subtitulo='Valoracion de Psicologia';
				break;
			case 'EVO':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,b.id_eps ideps,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps,
      h.nom_sedes,
      i.descripuedad
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                        left join eps j on (j.id_eps=b.id_eps)
                        left join sedes_ips h on (h.id_sedes_ips=b.id_sedes_ips)
                        left join uedad i on (i.coduedad=a.uedad)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Evolución";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
      $return='116';
      $consulta='include ("consulta_rapidaDEM.php")';
			$terapia='Psicologia';
      $servicio='Demencias';
			$opcion=$_REQUEST['opcion'];
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$form1='FormulariosINDE/evo_inde.php';
			$subtitulo='Evolución Diaria '.$terapia.' Demencias';
			break;
			case 'IM':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,b.id_eps ideps,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps,
      h.nom_sedes,
      i.descripuedad
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                        left join eps j on (j.id_eps=b.id_eps)
                        left join sedes_ips h on (h.id_sedes_ips=b.id_sedes_ips)
                        left join uedad i on (i.coduedad=a.uedad)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Informe Mensual";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
      $return='116';
      $consulta='include ("consulta_rapidaDEM.php")';
			$terapia='Psicologia';
      $servicio='Demencias';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$form1='FormulariosINDE/im_inde.php';
			$subtitulo='Informe Mensual '.$terapia.' Demencias';
			break;
			case 'PTGEN':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,b.id_eps ideps,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps,
      h.nom_sedes,
      i.descripuedad
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                        left join eps j on (j.id_eps=b.id_eps)
                        left join sedes_ips h on (h.id_sedes_ips=b.id_sedes_ips)
                        left join uedad i on (i.coduedad=a.uedad)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar plan general";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
      $return='116';
      $consulta='include ("consulta_rapidaDEM.php")';
			$terapia='Psicologia';
      $servicio='Demencias';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$form1='FormulariosINDE/ptgen_inde.php';
			$subtitulo='Plan General Demencias';
			break;

			case 'PTINV':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,b.id_eps ideps,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps,
      h.nom_sedes,
      i.descripuedad,
			max(id_ptgen_dem) id,max(freg_ptgen_dem) fecha, m.fvence_ptgen_dem, max(obj_general_dem) objetivo, m.estado_ptgen_dem
      from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
                        inner join eps j on (j.id_eps=b.id_eps)
                        inner join sedes_ips h on (h.id_sedes_ips=b.id_sedes_ips)
                        left join uedad i on (i.coduedad=a.uedad)
												left join plan_general_dem m on (m.id_adm_hosp=b.id_adm_hosp)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and m.estado_ptgen_dem='Realizada'" ;
			$boton="Agregar plan trimestral";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
      $return='116';
      $consulta='include ("consulta_rapidaDEM.php")';
			$terapia='Psicologia';
      $servicio='Demencias';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$form1='FormulariosINDE/plan_inde.php';
			$subtitulo='Plan Trimestral '.$terapia.' ';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
			$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"",
			"fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"",
			"religion"=>"","fotopac"=>"","id_adm_hosp"=>"","ideps"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"",
			"fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id"=>"","fecha"=>"", "fvence_ptgen_dem"=>"",
			"objetivo"=>"", "estado_ptgen_dem"=>"");
			}
		}else{
			$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"",
			"fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"",
			"religion"=>"","fotopac"=>"","id_adm_hosp"=>"","ideps"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"",
			"fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id"=>"","fecha"=>"", "fvence_ptgen_dem"=>"",
			"objetivo"=>"", "estado_ptgen_dem"=>"");
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
<div class="panel-default">
<section class="panel-heading"><h4>Psicologia INDE Programa Demencias</h4></section>
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
<table class="table table-bordered table-responsive">
	<tr>
		<th class="info">Herramientas</th>
		<th class="info">PACIENTE</th>
		<th class="info">FECHA INGRESO</th>
		<th class="info">FOTO</th>
		<th class="info">SERVICIO</th>
		<th class="info" colspan="3"></th>
	</tr>

	<?php
	if (isset($_REQUEST["doc"])){
	$doc=$_REQUEST["doc"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,s.nom_sedes
				FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
				WHERE p.doc_pac='".$doc."' and a.estado_adm_hosp='Activo' and tipo_servicio in ('Demencias','AVD','Consulta externa INDE')";

	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {
			$fecha=date('Y-m-d');
			if ($fila['tipo_servicio']=='Demencias') {
				echo"<tr >\n";
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ALR&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-bullhorn"></span></button></a></th>';
				echo'<td class="text-center alert-success">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>
							<p><strong>AMD: </strong>'.$fila["id_adm_hosp"].'</p>
						 </td>';
				echo'<td class="text-center alert-success">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-center alert-success"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
				echo'<td class="text-center alert-success">'.$fila["tipo_servicio"].'</td>';
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></th>';
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=IM&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span> Informe</button></a></th>';
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion=132&return=114&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span> Plan trimestral</button></a></th>';
				echo "</tr>\n";
			}
			if ($fila['tipo_servicio']=='Consulta externa INDE') {
				echo"<tr >\n";
				echo'<th class="text-center alert-danger"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ALR&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-bullhorn"></span></button></a></th>';
				echo'<td class="text-center alert-danger">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>
							<p><strong>AMD: </strong>'.$fila["id_adm_hosp"].'</p>
						 </td>';
				echo'<td class="text-center alert-danger">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-center alert-danger"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
				echo'<td class="text-center alert-danger">'.$fila["tipo_servicio"].'</td>';
				echo'<th class="text-center alert-danger">';
				$id=$fila['id_adm_hosp'];
				$f1=date('Y-m-d');
				$f2=date('Y-m-d');
				$sql_ing="SELECT a.id_psicoce_sm,freg_psicoce_sm,b.id_adm_hosp ida,c.nombre
									FROM psico_ce_sm a INNER JOIN adm_hospitalario b on a.id_adm_hosp=b.id_adm_hosp
																		 INNER JOIN user c on c.id_user=a.id_user
									WHERE a.id_adm_hosp=$id";
									//echo $sql_ing;
									if ($tablai=$bd1->sub_tuplas($sql_ing)){
										foreach ($tablai as $filai) {
											echo'<p>Valoración ya realizada:</p>
													<p>'.$filai['freg_psicoce_sm'].'-- Profesional: '.$filai['nombre'].'</p>
													<p><a href="rpt_valpsico_sm.php?idadmhosp='.$filai["ida"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-info" ><span class="fa fa-file-pdf-o"></span> </button></a></p>';
										}
									}else {
										echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ING&servicio=Consulta externa INDE&doc='.$fila["doc_pac"].'&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger" ><span class="fa fa-plus-circle"></span> Valoración</button></a></p>';
									}
				echo'</th>';
				echo'<th class="text-center alert-danger"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></th>';
				echo'<th class="text-center alert-danger"><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Consulta externa INDE&atencion=Ambulatoria&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-flask"></span> Ayuda Dx</button></a></th>';
				echo "</tr>\n";
			}
			if ($fila['tipo_servicio']=='AVD') {
				echo"<tr >\n";
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ALR&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-bullhorn"></span></button></a></th>';
				echo'<td class="text-center alert-info">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>
							<p><strong>AMD: </strong>'.$fila["id_adm_hosp"].'</p>
						 </td>';
				echo'<td class="text-center alert-info">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-center alert-info"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
				echo'<td class="text-center alert-info">'.$fila["tipo_servicio"].'</td>';
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></th>';
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=IM&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-plus-circle"></span> Informe</button></a></th>';
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion=132&return=114&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-plus-circle"></span> Plan trimestral</button></a></th>';
				echo "</tr>\n";
			}
		}
	}
}	if (isset($_REQUEST["nom"])){
	$doc=$_REQUEST["nom"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
							 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,
							 s.nom_sedes
				FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
				WHERE p.nom_completo LIKE '%".$doc."%' and a.estado_adm_hosp='Activo'  and tipo_servicio in ('Demencias','AVD','Consulta externa INDE')";

	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {
			if ($fila['tipo_servicio']=='Demencias') {
				echo"<tr >\n";
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ALR&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-bullhorn"></span></button></a></th>';
				echo'<td class="text-center alert-success">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>
							<p><strong>AMD: </strong>'.$fila["id_adm_hosp"].'</p>
						 </td>';
				echo'<td class="text-center alert-success">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-center alert-success"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
				echo'<td class="text-center alert-success">'.$fila["tipo_servicio"].'</td>';
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></th>';
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=IM&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span> Informe</button></a></th>';
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion=132&return=114&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span> Plan trimestral</button></a></th>';
				echo "</tr>\n";
			}
			$fecha=date('Y-m-d');
			if ($fila['tipo_servicio']=='Consulta externa INDE') {
				echo"<tr >\n";
				echo'<th class="text-center alert-danger"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ALR&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-bullhorn"></span></button></a></th>';
				echo'<td class="text-center alert-danger">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>
							<p><strong>AMD: </strong>'.$fila["id_adm_hosp"].'</p>
						 </td>';
				echo'<td class="text-center alert-danger">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-center alert-danger"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
				echo'<td class="text-center alert-danger">'.$fila["tipo_servicio"].'</td>';
				echo'<th class="text-center alert-danger">';
				$id=$fila['id_adm_hosp'];
				$sql_ing="SELECT a.id_psicoce_sm,freg_psicoce_sm,b.id_adm_hosp ida,c.nombre
									FROM psico_ce_sm a INNER JOIN adm_hospitalario b on a.id_adm_hosp=b.id_adm_hosp
																		 INNER JOIN user c on c.id_user=a.id_user
									WHERE a.id_adm_hosp=$id";
									//echo $sql_ing;
									if ($tablai=$bd1->sub_tuplas($sql_ing)){
										foreach ($tablai as $filai) {
											echo'<p>Valoración ya realizada:</p>
													<p>'.$filai['freg_psicoce_sm'].'-- Profesional: '.$filai['nombre'].'</p>
													<p><a href="rpt_valpsico_sm.php?idadmhosp='.$filai["ida"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-info" ><span class="fa fa-file-pdf-o"></span> </button></a></p>';
										}
									}else {
										echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ING&servicio=Consulta externa INDE&doc='.$fila["doc_pac"].'&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger" ><span class="fa fa-plus-circle"></span> Valoración</button></a></p>';
									}
				echo'</th>';
				echo'<th class="text-center alert-danger"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></th>';
				echo'<th class="text-center alert-danger"><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Consulta externa INDE&atencion=Ambulatoria&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-flask"></span> Ayuda Dx</button></a></th>';
				echo "</tr>\n";
			}
			if ($fila['tipo_servicio']=='AVD') {
				echo"<tr >\n";
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ALR&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-bullhorn"></span></button></a></th>';
				echo'<td class="text-center alert-info">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>
							<p><strong>AMD: </strong>'.$fila["id_adm_hosp"].'</p>
						 </td>';
				echo'<td class="text-center alert-info">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-center alert-info"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
				echo'<td class="text-center alert-info">'.$fila["tipo_servicio"].'</td>';
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></th>';
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=IM&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-plus-circle"></span> Informe</button></a></th>';
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion=132&return=114&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-plus-circle"></span> Plan trimestral</button></a></th>';
				echo "</tr>\n";
			}
		}
	}
}
	?>

</table>

</div>
</div>
	<?php
}
?>
