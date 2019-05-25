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

			break;
			case 'EVO':
				$sql="INSERT INTO evo_fono_dem (id_adm_hosp, id_user, freg_evofono, hreg_evofono, evolucionfono, estado_evofono) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["evoto"]."','Realizada')";
				$subtitulo="Evolución Fonoaudiologia";
				$subtitulo1="Adicionado";
				$subtitulo2="Demencias";
			break;
			case 'IM':
			if ($_SESSION["AUT"]["especialidad"]=='ADMINISTRATIVO') {
				$sql="";
				$msg='LA ESPECIELIDAD DE SU PERFIL NO LE PERMITE REALIZAR REGISTROS ASISTENCIALES';
				$subtitulo="Informe Mensual Fonoaudiologia";
				$subtitulo1="Adicionado";
				$subtitulo2="Demencias";

			}else {
				$sql="INSERT INTO im_demencias_inde (id_adm_hosp, id_user, freg_im_dem, hreg_im_dem, objetivo_im_dem, actrealizada_im_dem, logros_im_dem, plant_im_dem, servicio, estado_im_dem) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["fregimto"]."','".$_POST["hregimto"]."','".$_POST["obj"]."','".$_POST["act"]."','".$_POST["logro"]."','".$_POST["plant"]."','".$_SESSION["AUT"]["especialidad"]."','Realizada')";
				$subtitulo="Informe Mensual Fonoaudiologia";
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
				$subtitulo="Plan Trimestral Individual Fonoaudiologia";
				$subtitulo1="Adicionado";
				$subtitulo2="Demencias";

			}else {
				$sql="INSERT INTO plan_individual_dem (id_ptgen_dem, id_user, servicio, freg_ptinv_dem, obj_dem, act1_dem, atc2_dem, estado_ptinv_dem) VALUES
				('".$_POST["idgen"]."','".$_SESSION["AUT"]["id_user"]."','".$_SESSION["AUT"]["especialidad"]."','".$_POST["freg"]."','".$_POST["obespec"]."','".$_POST["actividad1"]."','".$_POST["actividad2"]."','Realizada')";
				$subtitulo="Plan Trimestral Individual Fonoaudiologia";
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
      $return='115';
      $consulta='include ("consulta_rapidaDEM.php")';
			$terapia='Fonoaudiologia';
      $servicio='Demencias';
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
      $return='115';
      $consulta='include ("consulta_rapidaDEM.php")';
			$terapia='Fonoaudiologia';
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
      $return='115';
      $consulta='include ("consulta_rapidaDEM.php")';
			$terapia='Fonoaudiologia';
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
      $return='115';
      $consulta='include ("consulta_rapidaDEM.php")';
			$terapia='Fonoaudiologia';
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
			$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","ideps"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id"=>"","fecha"=>"", "fvence_ptgen_dem"=>"", "objetivo"=>"", "estado_ptgen_dem"=>"");
			print_r($fila);
			}
		}else{
			$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","ideps"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id"=>"","fecha"=>"", "fvence_ptgen_dem"=>"", "objetivo"=>"", "estado_ptgen_dem"=>"");
			print_r($fila);
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].hreg.value > document.forms[0].fecha.value){
					alert("Neuropsicologo(a) <?php echo $_SESSION["AUT"]["nombre"]?>, NO puede adelantar el tiempo.");
					document.forms[0].hreg.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
		<script type="text/javascript" src="/js/jquery.js"></script>
		<div class="alert alert-info animated bounceInRight">
			<?php echo $subtitulo;?>
		</div>
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
<section class="panel-heading"><h4>Fonoaudiologia INDE Programa Demencias</h4></section>
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
<table class="table table-bordered">
	<tr>
		<th id="th-estilo4">Herramientas</th>
		<th id="th-estilo1">ADMISION</th>
		<th id="th-estilo1">IDENTIFICACION</th>
		<th id="th-estilo2">NOMBRES Y APELLIDOS</th>
		<th id="th-estilo3">FECHA INGRESO</th>
		<th id="th-estilo3">FOTO</th>
		<th id="th-estilo3">SERVICIO</th>
		<th id="th-estilo4">Valoracion inicial</th>
		<th id="th-estilo4">Evolucion</th>
		<th id="th-estilo4">Informe Mensual</th>
		<th id="th-estilo4">Plan trimestral</th>
	</tr>

	<?php
	if (isset($_REQUEST["doc"])){
	$doc=$_REQUEST["doc"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,s.nom_sedes FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips  WHERE p.doc_pac='".$doc."' and a.estado_adm_hosp='Activo' and tipo_servicio in ('Demencias','AVD')";

	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {

			if ($fila['tipo_servicio']=='Demencias') {
				echo"<tr >\n";
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ALR&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-bullhorn"></span></button></a></th>';
				echo'<td class="text-center alert-success">'.$fila["id_adm_hosp"].'</td>';
				echo'<td class="text-center alert-success">'.$fila["doc_pac"].'</td>';
				echo'<td class="text-center alert-success">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
				echo'<td class="text-center alert-success">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-center alert-success"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
				echo'<td class="text-center alert-success">'.$fila["tipo_servicio"].'</td>';
				echo'<th class="text-center alert-success"><span class="fa fa-ban"></span></th>';
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=IM&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion=132&return=114&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
				echo "</tr>\n";
			}
			if ($fila['tipo_servicio']=='AVD') {
				echo"<tr >\n";
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ALR&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-bullhorn"></span></button></a></th>';
				echo'<td class="text-center alert-info">'.$fila["id_adm_hosp"].'</td>';
				echo'<td class="text-center alert-info">'.$fila["doc_pac"].'</td>';
				echo'<td class="text-center alert-info">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
				echo'<td class="text-center alert-info">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-center alert-info"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
				echo'<td class="text-center alert-info">'.$fila["tipo_servicio"].'</td>';
				echo'<th class="text-center alert-info"><span class="fa fa-ban"></span></th>';
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=IM&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion=132&return=114&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
				echo "</tr>\n";
			}
		}
	}
}	if (isset($_REQUEST["nom"])){
	$doc=$_REQUEST["nom"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,s.nom_sedes FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips  WHERE p.nom_completo LIKE '%".$doc."%' and a.estado_adm_hosp='Activo'  and tipo_servicio in ('Demencias','AVD')";

	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {
			if ($fila['tipo_servicio']=='Demencias') {
				echo"<tr >\n";
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ALR&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-bullhorn"></span></button></a></th>';
				echo'<td class="text-center alert-success">'.$fila["id_adm_hosp"].'</td>';
				echo'<td class="text-center alert-success">'.$fila["doc_pac"].'</td>';
				echo'<td class="text-center alert-success">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
				echo'<td class="text-center alert-success">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-center alert-success"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
				echo'<td class="text-center alert-success">'.$fila["tipo_servicio"].'</td>';
				echo'<th class="text-center alert-success"><span class="fa fa-ban"></span></th>';
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=IM&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion=132&return=114&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
				echo "</tr>\n";
			}
			if ($fila['tipo_servicio']=='AVD') {
				echo"<tr >\n";
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ALR&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-bullhorn"></span></button></a></th>';
				echo'<td class="text-center alert-info">'.$fila["id_adm_hosp"].'</td>';
				echo'<td class="text-center alert-info">'.$fila["doc_pac"].'</td>';
				echo'<td class="text-center alert-info">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
				echo'<td class="text-center alert-info">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-center alert-info"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
				echo'<td class="text-center alert-info">'.$fila["tipo_servicio"].'</td>';
				echo'<th class="text-center alert-info"><span class="fa fa-ban"></span></th>';
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=IM&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion=132&return=114&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
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
