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
				$sql="INSERT INTO valini_to_reh (id_adm_hosp, id_user, freg_valinito_reh, hreg_valinito_reh, pintegral1i, pintegral1d, pintegral2i, pintegral2d, pintegral3i, pintegra3d, pintegral4i, pintegral4d, pintegral5i, pintegral5d, pintegral6i, pintegral6d, pintegral7i, pintegral7d, pintegral8i, pintegral8d, pintegral9i, pintegral9d, pfuncional1i, pfuncional1d, pfuncional2i, pfuncional2d, pfuncional3i, pfuncional3d, pfuncional4i, pfuncional4d, pfuncional5i, pfuncional5d, pfuncional6i, pfuncional6d, pfuncional7i, pfuncional7d, palcance1i, palcance1d, palcance2i, palcance2d, palcance3i, palcance3d, palcance4i, palcance4d, palcance5i, palcance5d, pglobales1i, pglobales1d, pglobales2i, pglobales2d, pglobales3i, pglobales3d, pglobales4i, pglobales4d, pglobales5i, pglobales5d, pfund1i, pfund1d, pfund2i, pfund2d, pfund3i, pfund3d, pfund4i, pfund4d, pfund5i, pfund5d, pcoord1i, pcoord1d, pcoord2i, pcoord2d, pcoord3i, pcoord3d, pcoord4i, pcoord4d, pcoord5i, pcoord5d, ccp_orien1, ccp_orien2, ccp_atenc1, ccp_atenc2, ccp_atenc3, ccp_atenc4, ccp_atenc5, ccp_atenc6, ccp_atenc7, ccp_atenc8, ccp_graf1, ccp_graf2, ccp_graf3, ccp_graf4, ccp_graf5, ccp_percep1, ccp_percep2, ccp_percep3, ccp_percep4, ccp_percep5, ccp_percep6, ccp_percep7, ccp_memo1, ccp_memo2, ccp_memo3, ccp_memo4, ccp_memo5, ccp_instru1, ccp_instru2, ccp_instru3, ccp_instru4, ccp_instru5, ccp_instru6, ccp_supe1, ccp_supe2, ccp_supe3, ccp_supe4, ccp_supe5, cp1, cp2, cp3, cp4, cp5, cp6, cp7, juego1, juego2, juego3, juego4, juego5, juego6, juego7, juego8, avd_alimen1, avd_alimen2, avd_alimen3, avd_alimen4, avd_vestido1, avd_vestido2, avd_vestido3, avd_vestido4, avd_vestido5, avd_vestido6, avd_vestido7, avd_vestido8, avd_vestido9, avd_vestido10, avd_vestido11, avd_higiene1, avd_higiene2, avd_higiene3, avd_higiene4, avd_higiene5, avd_traslado1, avd_traslado2, avd_traslado3, avd_traslado4, abc_1, abc_2, abc_3, abc_4, abc_5, abc_6, abc_7, abc_8, abc_9, abc_10, is_auditivo1, is_auditivo2, is_auditivo3, is_auditivo4, obs_isauditivo, is_visual1, is_visual2, is_visual3, obs_isvisual, is_gusolf1, is_gusolf2, is_gusolf3, is_gusolf4, obs_isgusolf, is_vestibular1, is_vestibular2, is_vestibular3, is_vestibular4, obs_isvestibular, is_propio1, is_propio2, is_propio3, obs_ispropio, is_tactil1, is_tactil2, is_tactil3, is_tactil4, is_tactil5, obs_istactil,estado_valinito_reh) VALUES
				('".$_POST["idadmhosp"]."',
'".$_SESSION["AUT"]["id_user"]."',
'".$_POST["freg"]."'	,
'".$_POST["hreg"]."'	,
'".$_POST["pintegral1i"]."'	,
'".$_POST["pintegral1d"]."'	,
'".$_POST["pintegral2i"]."'	,
'".$_POST["pintegral2d"]."'	,
'".$_POST["pintegral3i"]."',
'".$_POST["pintegra3d"]."',
'".$_POST["pintegral4i"]."',
'".$_POST["pintegral4d"]."',
'".$_POST["pintegral5i"]."',
'".$_POST["pintegral5d"]."',
'".$_POST["pintegral6i"]."',
'".$_POST["pintegral6d"]."',
'".$_POST["pintegral7i"]."',
'".$_POST["pintegral7d"]."',
'".$_POST["pintegral8i"]."',
'".$_POST["pintegral8d"]."',
'".$_POST["pintegral9i"]."',
'".$_POST["pintegral9d"]."',
'".$_POST["pfuncional1i"]."',
'".$_POST["pfuncional1d"]."',
'".$_POST["pfuncional2i"]."',
'".$_POST["pfuncional2d"]."',
'".$_POST["pfuncional3i"]."',
'".$_POST["pfuncional3d"]."',
'".$_POST["pfuncional4i"]."',
'".$_POST["pfuncional4d"]."',
'".$_POST["pfuncional5i"]."',
'".$_POST["pfuncional5d"]."',
'".$_POST["pfuncional6i"]."',
'".$_POST["pfuncional6d"]."',
'".$_POST["pfuncional7i"]."',
'".$_POST["pfuncional7d"]."',
'".$_POST["palcance1i"]."',
'".$_POST["palcance1d"]."',
'".$_POST["palcance2i"]."',
'".$_POST["palcance2d"]."',
'".$_POST["palcance3i"]."',
'".$_POST["palcance3d"]."',
'".$_POST["palcance4i"]."',
'".$_POST["palcance4d"]."',
'".$_POST["palcance5i"]."',
'".$_POST["palcance5d"]."',
'".$_POST["pglobales1i"]."',
'".$_POST["pglobales1d"]."',
'".$_POST["pglobales2i"]."',
'".$_POST["pglobales2d"]."',
'".$_POST["pglobales3i"]."',
'".$_POST["pglobales3d"]."',
'".$_POST["pglobales4i"]."',
'".$_POST["pglobales4d"]."',
'".$_POST["pglobales5i"]."',
'".$_POST["pglobales5d"]."',
'".$_POST["pfund1i"]."',
'".$_POST["pfund1d"]."',
'".$_POST["pfund2i"]."',
'".$_POST["pfund2d"]."',
'".$_POST["pfund3i"]."',
'".$_POST["pfund3d"]."',
'".$_POST["pfund4i"]."',
'".$_POST["pfund4d"]."',
'".$_POST["pfund5i"]."',
'".$_POST["pfund5d"]."',
'".$_POST["pcoord1i"]."',
'".$_POST["pcoord1d"]."',
'".$_POST["pcoord2i"]."',
'".$_POST["pcoord2d"]."',
'".$_POST["pcoord3i"]."',
'".$_POST["pcoord3d"]."',
'".$_POST["pcoord4i"]."',
'".$_POST["pcoord4d"]."',
'".$_POST["pcoord5i"]."',
'".$_POST["pcoord5d"]."',
'".$_POST["ccp_orien1"]."',
'".$_POST["ccp_orien2"]."',
'".$_POST["ccp_atenc1"]."',
'".$_POST["ccp_atenc2"]."',
'".$_POST["ccp_atenc3"]."',
'".$_POST["ccp_atenc4"]."',
'".$_POST["ccp_atenc5"]."',
'".$_POST["ccp_atenc6"]."',
'".$_POST["ccp_atenc7"]."',
'".$_POST["ccp_atenc8"]."',
'".$_POST["ccp_graf1"]."',
'".$_POST["ccp_graf2"]."',
'".$_POST["ccp_graf3"]."',
'".$_POST["ccp_graf4"]."',
'".$_POST["ccp_graf5"]."',
'".$_POST["ccp_percep1"]."',
'".$_POST["ccp_percep2"]."',
'".$_POST["ccp_percep3"]."',
'".$_POST["ccp_percep4"]."',
'".$_POST["ccp_percep5"]."',
'".$_POST["ccp_percep6"]."',
'".$_POST["ccp_percep7"]."',
'".$_POST["ccp_memo1"]."',
'".$_POST["ccp_memo2"]."',
'".$_POST["ccp_memo3"]."',
'".$_POST["ccp_memo4"]."',
'".$_POST["ccp_memo5"]."',
'".$_POST["ccp_instru1"]."',
'".$_POST["ccp_instru2"]."',
'".$_POST["ccp_instru3"]."',
'".$_POST["ccp_instru4"]."',
'".$_POST["ccp_instru5"]."',
'".$_POST["ccp_instru6"]."',
'".$_POST["ccp_supe1"]."',
'".$_POST["ccp_supe2"]."',
'".$_POST["ccp_supe3"]."',
'".$_POST["ccp_supe4"]."',
'".$_POST["ccp_supe5"]."',
'".$_POST["cp1"]."',
'".$_POST["cp2"]."',
'".$_POST["cp3"]."',
'".$_POST["cp4"]."',
'".$_POST["cp5"]."',
'".$_POST["cp6"]."',
'".$_POST["cp7"]."',
'".$_POST["juego1"]."',
'".$_POST["juego2"]."',
'".$_POST["juego3"]."',
'".$_POST["juego4"]."',
'".$_POST["juego5"]."',
'".$_POST["juego6"]."',
'".$_POST["juego7"]."',
'".$_POST["juego8"]."',
'".$_POST["avd_alimen1"]."',
'".$_POST["avd_alimen2"]."',
'".$_POST["avd_alimen3"]."',
'".$_POST["avd_alimen4"]."',
'".$_POST["avd_vestido1"]."',
'".$_POST["avd_vestido2"]."',
'".$_POST["avd_vestido3"]."',
'".$_POST["avd_vestido4"]."',
'".$_POST["avd_vestido5"]."',
'".$_POST["avd_vestido6"]."',
'".$_POST["avd_vestido7"]."',
'".$_POST["avd_vestido8"]."',
'".$_POST["avd_vestido9"]."',
'".$_POST["avd_vestido10"]."',
'".$_POST["avd_vestido11"]."',
'".$_POST["avd_higiene1"]."',
'".$_POST["avd_higiene2"]."',
'".$_POST["avd_higiene3"]."',
'".$_POST["avd_higiene4"]."',
'".$_POST["avd_higiene5"]."',
'".$_POST["avd_traslado1"]."',
'".$_POST["avd_traslado2"]."',
'".$_POST["avd_traslado3"]."',
'".$_POST["avd_traslado4"]."',
'".$_POST["abc_1"]."',
'".$_POST["abc_2"]."',
'".$_POST["abc_3"]."',
'".$_POST["abc_4"]."',
'".$_POST["abc_5"]."',
'".$_POST["abc_6"]."',
'".$_POST["abc_7"]."',
'".$_POST["abc_8"]."',
'".$_POST["abc_9"]."',
'".$_POST["abc_10"]."',
'".$_POST["is_auditivo1"]."',
'".$_POST["is_auditivo2"]."',
'".$_POST["is_auditivo3"]."',
'".$_POST["is_auditivo4"]."',
'".$_POST["obs_isauditivo"]."',
'".$_POST["is_visual1"]."',
'".$_POST["is_visual2"]."',
'".$_POST["is_visual3"]."',
'".$_POST["obs_isvisual"]."',
'".$_POST["is_gusolf1"]."',
'".$_POST["is_gusolf2"]."',
'".$_POST["is_gusolf3"]."',
'".$_POST["is_gusolf4"]."',
'".$_POST["obs_isgusolf"]."',
'".$_POST["is_vestibular1"]."',
'".$_POST["is_vestibular2"]."',
'".$_POST["is_vestibular3"]."',
'".$_POST["is_vestibular4"]."',
'".$_POST["obs_isvestibular"]."',
'".$_POST["is_propio1"]."',
'".$_POST["is_propio2"]."',
'".$_POST["is_propio3"]."',
'".$_POST["obs_ispropio"]."',
'".$_POST["is_tactil1"]."',
'".$_POST["is_tactil2"]."',
'".$_POST["is_tactil3"]."',
'".$_POST["is_tactil4"]."',
'".$_POST["is_tactil5"]."',
'".$_POST["obs_istactil"]."'	,'Realizada'
)";
				$subtitulo="Valoración inicial";
				$subtitulo1="Adicionado";
				$subtitulo2="Terapia Ocupacional";
			break;
			case 'EVO':
				$sql="INSERT INTO evo_to_reh (id_adm_hosp, id_user, freg_evoto_reh, hreg_evoto_reh, evolucionto_reh, estado_evoto_reh) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["evoto"]."','Realizada')";
				$subtitulo="Evolución";
				$subtitulo1="Adicionado";
				$subtitulo2="Terapia Ocupacional";
			break;
			case 'IM':
				$sql="INSERT INTO im_to_reh ( id_adm_hosp, id_user, freg_imto_reh, hreg_imto_reh, objetivo_imto_reh, actrealizada_imto_reh, logros_imto_reh, plant_imto_reh, estado_imto_reh) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["fregimto"]."','".$_POST["hregimto"]."','".$_POST["obj"]."','".$_POST["act"]."','".$_POST["logro"]."','".$_POST["plant"]."','Realizada')";
				$subtitulo="Informe Mensual";
				$subtitulo1="Adicionado";
				$subtitulo2="Terapia Ocupacional";
			break;
			case 'PT':
				$sql="INSERT INTO plantrimestral_to_reh( id_adm_hosp, id_user, freg_ptto_reh, hreg_ptto_reh, obgen_to_reh, obespec1_to_reh, obespec2_to_reh, obespec3_to_reh, estado_ptto_reh) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["fregptto"]."','".$_POST["hregptto"]."','".$_POST["obgen_reh"]."','".$_POST["obespec1_reh"]."','".$_POST["obespec2_reh"]."','".$_POST["obespec3_reh"]."','Realizada')";
				$subtitulo="Plan Trimestral";
				$subtitulo1="Adicionado";
				$subtitulo2="Terapia Ocupacional";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El formato de $subtitulo en $subtitulo2 fue $subtitulo1 con exito!";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="El formato de $subtitulo en $subtitulo2 NO fue $subtitulo1 !!! .";
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
			$boton="Agregar HC ingreso";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/hc_hospitalario.php';
			$subtitulo='Historia Clinica de ingreso';
			break;
			case 'EVO':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Evolución Medica";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/evo_medhosp.php';
			$subtitulo='Evolución Diaria  Terapia Ocupacional';
			break;
			case 'ADX':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Informe Mensual";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/imto_reh5.php';
			$subtitulo='Informe Mensual  Terapia Ocupacional';
			break;
			case 'MED':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Plan tratamiento";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/planto_reh.php';
			$subtitulo='Plan Trimestral Terapia Ocupacional';
			break;
			case 'RES':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Plan tratamiento";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/planto_reh.php';
			$subtitulo='Plan Trimestral Terapia Ocupacional';
			break;
			case 'EPI':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Epicrisis";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/epicrisis.php';
			$subtitulo='Plan Trimestral Terapia Ocupacional';
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
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].hreg.value > document.forms[0].fecha.value){
					alert("Enfermero (a) <?php echo $_SESSION["AUT"]["nombre"]?>, NO puede adelantar el tiempo.");
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
	echo '<div class="alert alert-success animated bounceInRight">';
	echo $subtitulo;
	echo '</div>';
// nivel 1?>
<div class="panel-default">
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
	<table class="table table-responsive">
		<tr>
			<th id="th-estilo1">ADMISIÓN</th>
			<th id="th-estilo1">IDENTIFICACIÓN</th>
			<th id="th-estilo2">NOMBRES Y APELLIDOS</th>
			<th id="th-estilo3">FECHA INGRESO</th>
			<th id="th-estilo3">HORA INGRESO</th>
			<th id="th-estilo3">SERVICIO</th>
			<th id="th-estilo3">FOTO</th>
			<th id="th-estilo4">HC Ingreso</th>
			<th id="th-estilo4">Evolución</th>
			<th id="th-estilo4">Ayudas DX</th>
			<th id="th-estilo4">Formulacion</th>
			<th id="th-estilo4">Resumen HC</th>
			<th id="th-estilo4">Epicrisis</th>
		</tr>

		<?php
		if (isset($_REQUEST["doc"])){
		$doc=$_REQUEST["doc"];
		$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,s.nom_sedes FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips  WHERE p.doc_pac='".$doc."' and a.estado_adm_hosp='Activo' and tipo_servicio='Hospitalario'";

		if ($tabla=$bd1->sub_tuplas($sql)){
			//echo $sql;
			foreach ($tabla as $fila ) {
				echo"<tr >	\n";
				echo'<td class="text-center">'.$fila["id_adm_hosp"].'</td>';
				echo'<td class="text-center">'.$fila["doc_pac"].'</td>';
				echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
				echo'<td class="text-center">'.$fila["fingreso_hosp"].'</td>';
				echo'<td class="text-center">'.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-center">'.$fila["tipo_servicio"].'</td>';
				echo'<td class="text-center"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
				echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
				echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion=21&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-stethoscope"></span></button></a></th>';
				echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion=20&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-flask"></span></button></a></th>';
				echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion=20&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-toggle-on"></span></button></a></th>';
				echo'<th class="text-center" ><a href="rpt_hcingreso.php?idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span></button></a></th>';
				echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion=37&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-share"></span></button></a></th>';
				echo "</tr>\n";
			}
		}
	}
	if (isset($_REQUEST["nom"])){
		$doc=$_REQUEST["nom"];
		$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,s.nom_sedes FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips  WHERE p.nom1 LIKE '%".$doc."%' and a.estado_adm_hosp='Activo' and tipo_servicio='Hospitalario'";

		if ($tabla=$bd1->sub_tuplas($sql)){
			//echo $sql;
			foreach ($tabla as $fila ) {

				echo"<tr >	\n";
				echo'<td class="text-center">'.$fila["id_adm_hosp"].'</td>';
				echo'<td class="text-center">'.$fila["doc_pac"].'</td>';
				echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
				echo'<td class="text-center">'.$fila["fingreso_hosp"].'</td>';
				echo'<td class="text-center">'.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-center">'.$fila["tipo_servicio"].'</td>';
				echo'<td class="text-center"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
				echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
				echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion=21&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-stethoscope"></span></button></a></th>';
				echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion=20&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-flask"></span></button></a></th>';
				echo'<th class="text-center" ><a href="rptgeneral.php?idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span></button></a></th>';
				echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion=37&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-share"></span></button></a></th>';
				echo "</tr>\n";
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
