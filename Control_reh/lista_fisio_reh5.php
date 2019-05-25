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
			$freg=date('Y-m-d');
			$hreg=date('H:m');
				$sql="INSERT INTO valini_fisio_reh (id_adm_hosp, id_user, freg_valinifisio_reh, hreg_valinifisio_reh, tmuscular1, tmuscular2, ccorporal, amv, act_refleja1, act_refleja2, act_refleja3, act_refleja4, act_refleja5, act_refleja6, act_refleja7, act_refleja8, act_refleja9, act_refleja10, act_refleja11, act_refleja12, ntallocerebral1, ntallocerebral2, ntallocerebral3, ntallocerebral4, ntallocerebral5, nmesencefalo1, nmesencefalo2, nmesencefalo3, nmesencefalo4, nmesencefalo5, nmesencefalo6, ncorteza, endere_supino, endere_prono, endere_cuadrupedo, endere_sedente, endere_rodillas, endere_bipedo, equilibrio_supino, equilibrio_prono, equilibrio_cuadrupedo, equilibrio_sedente, equilibrio_rodillas, equilibrio_bipedo, platerales_supino, platerales_prono, platerales_cuadrupedo, platerales_sedente, platerales_rodillas, platerales_bipedo, panteriores_supino, panteriores_prono, panteriores_cuadrupedo, panteriores_sedente, panteriores_rodillas, panteriores_bipedo, pposteriores_supino, pposteriores_prono, pposteriores_cuadrupedo, pposteriores_sedente, pposteriores_rodillas, pposteriores_bipedo, vma, vme1, vme2, vme3, vme4, vme5, vme6i, vme6d, vme7i, vme7d, vme8i, vme8d, vme9i, vme9d, vme10i, vme10d, vme11i, vme11d, vme12i, vme12d, vme13i, vme13d, vme14i, vme14d, vme15i, vme15d, vme16i, vme16d, retracciones, mr_msd, mr_msi, mr_mid, mr_mii, map_msd, map_msi, map_mid, map_mii, mat_msd, mat_msi, mat_mid, mat_mii, pfcarrera_ini1, pfcarrera_ini2, pfcarrera_ini3, pfcarrera_ini4, pfcarrera_ini5, pfcarrera_ini6, pfcarrera_ini7, pfcarrera_ini8, pfcarrera_ini9, pfcarrera_ini10, pfcarrera_ini11, pfcarrera_ele1, pfcarrera_ele2, pfcarrera_ele3, pfcarrera_ele4, pfcarrera_ele5, pfcarrera_ele6, pfcarrera_ele7, pfcarrera_mad1, pfcarrera_mad2, pfcarrera_mad3, pfcarrera_mad4, pfcarrera_mad5, pfcarrera_mad6, pfcarrera_mad7, pfcarrera_mad8, pfsalto_ini1, pfsalto_ini2, pfsalto_ini3, pfsalto_ini4, pfsalto_ini5, pfsalto_ini6, pfsalto_ele1, pfsalto_ele2, pfsalto_ele3, pfsalto_ele4, pfsalto_ele5, pfsalto_ele6, pfsalto_mad1, pfsalto_mad2, pfsalto_mad3, pfsalto_mad4, pfsalto_mad5, pfsalto_mad6, pfsalto_mad7, pfpatear_ini1, pfpatear_ini2, pfpatear_ini3, pfpatear_ini4, pfpatear_ini5, pfpatear_ini6, pfpatear_ele1, pfpatear_ele2, pfpatear_ele3, pfpatear_mad1, pfpatear_mad2, pfpatear_mad3, pfpatear_mad4, pfpatear_mad5, pfpatear_mad6, pfpatear_mad7, pfpatear_mad8, pfatajar_ini1, pfatajar_ini2, pfatajar_ini3, pfatajar_ini4, pfatajar_ini5, pfatajar_ini6, pfatajar_ini7, pfatajar_ini8, pfatajar_ele1, pfatajar_ele2, pfatajar_ele3, pfatajar_ele4, pfatajar_ele5, pflanzar_ini1, pflanzar_ini2, pflanzar_ini3, pflanzar_ini4, pflanzar_ini5, pflanzar_ini6, pflanzar_ini7, pflanzar_ini8, pflanzar_ele1, pflanzar_ele2, pflanzar_ele3, pflanzar_ele4, pflanzar_ele5, pflanzar_ele6, pflanzar_ele7, pflanzar_ele8, pflanzar_mad1, pflanzar_mad2, pflanzar_mad3, pflanzar_mad4, pflanzar_mad5, pflanzar_mad6, pflanzar_mad7, pflanzar_mad8, pflanzar_mad9, cdg1, cdg2, cdg3, cos1, cos2, cos3, ee1, ee2, ee3, ee4, ee5, ed1, actpostura, marcha, obs_valoracion, estado_valini_fisio_reh ) VALUES
				('".$_POST["idadmhosp"]."',
'".$_SESSION["AUT"]["id_user"]."',
'$freg',
'$hreg',
'".$_POST["tmuscular1"]."',
'".$_POST["tmuscular2"]."',
'".$_POST["ccorporal"]."',
'".$_POST["amv"]."',
'".$_POST["act_refleja1"]."',
'".$_POST["act_refleja2"]."',
'".$_POST["act_refleja3"]."',
'".$_POST["act_refleja4"]."',
'".$_POST["act_refleja5"]."',
'".$_POST["act_refleja6"]."',
'".$_POST["act_refleja7"]."',
'".$_POST["act_refleja8"]."',
'".$_POST["act_refleja9"]."',
'".$_POST["act_refleja10"]."',
'".$_POST["act_refleja11"]."',
'".$_POST["act_refleja12"]."',
'".$_POST["ntallocerebral1"]."',
'".$_POST["ntallocerebral2"]."',
'".$_POST["ntallocerebral3"]."',
'".$_POST["ntallocerebral4"]."',
'".$_POST["ntallocerebral5"]."',
'".$_POST["nmesencefalo1"]."',
'".$_POST["nmesencefalo2"]."',
'".$_POST["nmesencefalo3"]."',
'".$_POST["nmesencefalo4"]."',
'".$_POST["nmesencefalo5"]."',
'".$_POST["nmesencefalo6"]."',
'".$_POST["ncorteza"]."',
'".$_POST["endere_supino"]."',
'".$_POST["endere_prono"]."',
'".$_POST["endere_cuadrupedo"]."',
'".$_POST["endere_sedente"]."',
'".$_POST["endere_rodillas"]."',
'".$_POST["endere_bipedo"]."',
'".$_POST["equilibrio_supino"]."',
'".$_POST["equilibrio_prono"]."',
'".$_POST["equilibrio_cuadrupedo"]."',
'".$_POST["equilibrio_sedente"]."',
'".$_POST["equilibrio_rodillas"]."',
'".$_POST["equilibrio_bipedo"]."',
'".$_POST["platerales_supino"]."',
'".$_POST["platerales_prono"]."',
'".$_POST["platerales_cuadrupedo"]."',
'".$_POST["platerales_sedente"]."',
'".$_POST["platerales_rodillas"]."',
'".$_POST["platerales_bipedo"]."',
'".$_POST["panteriores_supino"]."',
'".$_POST["panteriores_prono"]."',
'".$_POST["panteriores_cuadrupedo"]."',
'".$_POST["panteriores_sedente"]."',
'".$_POST["panteriores_rodillas"]."',
'".$_POST["panteriores_bipedo"]."',
'".$_POST["pposteriores_supino"]."',
'".$_POST["pposteriores_prono"]."',
'".$_POST["pposteriores_cuadrupedo"]."',
'".$_POST["pposteriores_sedente"]."',
'".$_POST["pposteriores_rodillas"]."',
'".$_POST["pposteriores_bipedo"]."',
'".$_POST["vma"]."',
'".$_POST["vme1"]."',
'".$_POST["vme2"]."',
'".$_POST["vme3"]."',
'".$_POST["vme4"]."',
'".$_POST["vme5"]."',
'".$_POST["vme6i"]."',
'".$_POST["vme6d"]."',
'".$_POST["vme7i"]."',
'".$_POST["vme7d"]."',
'".$_POST["vme8i"]."',
'".$_POST["vme8d"]."',
'".$_POST["vme9i"]."',
'".$_POST["vme9d"]."',
'".$_POST["vme10i"]."',
'".$_POST["vme10d"]."',
'".$_POST["vme11i"]."',
'".$_POST["vme11d"]."',
'".$_POST["vme12i"]."',
'".$_POST["vme12d"]."',
'".$_POST["vme13i"]."',
'".$_POST["vme13d"]."',
'".$_POST["vme14i"]."',
'".$_POST["vme14d"]."',
'".$_POST["vme15i"]."',
'".$_POST["vme15d"]."',
'".$_POST["vme16i"]."',
'".$_POST["vme16d"]."',
'".$_POST["retracciones"]."',
'".$_POST["mr_msd"]."',
'".$_POST["mr_msi"]."',
'".$_POST["mr_mid"]."',
'".$_POST["mr_mii"]."',
'".$_POST["map_msd"]."',
'".$_POST["map_msi"]."',
'".$_POST["map_mid"]."',
'".$_POST["map_mii"]."',
'".$_POST["mat_msd"]."',
'".$_POST["mat_msi"]."',
'".$_POST["mat_mid"]."',
'".$_POST["mat_mii"]."',
'".$_POST["pfcarrera_ini1"]."',
'".$_POST["pfcarrera_ini2"]."',
'".$_POST["pfcarrera_ini3"]."',
'".$_POST["pfcarrera_ini4"]."',
'".$_POST["pfcarrera_ini5"]."',
'".$_POST["pfcarrera_ini6"]."',
'".$_POST["pfcarrera_ini7"]."',
'".$_POST["pfcarrera_ini8"]."',
'".$_POST["pfcarrera_ini9"]."',
'".$_POST["pfcarrera_ini10"]."',
'".$_POST["pfcarrera_ini11"]."',
'".$_POST["pfcarrera_ele1"]."',
'".$_POST["pfcarrera_ele2"]."',
'".$_POST["pfcarrera_ele3"]."',
'".$_POST["pfcarrera_ele4"]."',
'".$_POST["pfcarrera_ele5"]."',
'".$_POST["pfcarrera_ele6"]."',
'".$_POST["pfcarrera_ele7"]."',
'".$_POST["pfcarrera_mad1"]."',
'".$_POST["pfcarrera_mad2"]."',
'".$_POST["pfcarrera_mad3"]."',
'".$_POST["pfcarrera_mad4"]."',
'".$_POST["pfcarrera_mad5"]."',
'".$_POST["pfcarrera_mad6"]."',
'".$_POST["pfcarrera_mad7"]."',
'".$_POST["pfcarrera_mad8"]."',
'".$_POST["pfsalto_ini1"]."',
'".$_POST["pfsalto_ini2"]."',
'".$_POST["pfsalto_ini3"]."',
'".$_POST["pfsalto_ini4"]."',
'".$_POST["pfsalto_ini5"]."',
'".$_POST["pfsalto_ini6"]."',
'".$_POST["pfsalto_ele1"]."',
'".$_POST["pfsalto_ele2"]."',
'".$_POST["pfsalto_ele3"]."',
'".$_POST["pfsalto_ele4"]."',
'".$_POST["pfsalto_ele5"]."',
'".$_POST["pfsalto_ele6"]."',
'".$_POST["pfsalto_mad1"]."',
'".$_POST["pfsalto_mad2"]."',
'".$_POST["pfsalto_mad3"]."',
'".$_POST["pfsalto_mad4"]."',
'".$_POST["pfsalto_mad5"]."',
'".$_POST["pfsalto_mad6"]."',
'".$_POST["pfsalto_mad7"]."',
'".$_POST["pfpatear_ini1"]."',
'".$_POST["pfpatear_ini2"]."',
'".$_POST["pfpatear_ini3"]."',
'".$_POST["pfpatear_ini4"]."',
'".$_POST["pfpatear_ini5"]."',
'".$_POST["pfpatear_ini6"]."',
'".$_POST["pfpatear_ele1"]."',
'".$_POST["pfpatear_ele2"]."',
'".$_POST["pfpatear_ele3"]."',
'".$_POST["pfpatear_mad1"]."',
'".$_POST["pfpatear_mad2"]."',
'".$_POST["pfpatear_mad3"]."',
'".$_POST["pfpatear_mad4"]."',
'".$_POST["pfpatear_mad5"]."',
'".$_POST["pfpatear_mad6"]."',
'".$_POST["pfpatear_mad7"]."',
'".$_POST["pfpatear_mad8"]."',
'".$_POST["pfatajar_ini1"]."',
'".$_POST["pfatajar_ini2"]."',
'".$_POST["pfatajar_ini3"]."',
'".$_POST["pfatajar_ini4"]."',
'".$_POST["pfatajar_ini5"]."',
'".$_POST["pfatajar_ini6"]."',
'".$_POST["pfatajar_ini7"]."',
'".$_POST["pfatajar_ini8"]."',
'".$_POST["pfatajar_ele1"]."',
'".$_POST["pfatajar_ele2"]."',
'".$_POST["pfatajar_ele3"]."',
'".$_POST["pfatajar_ele4"]."',
'".$_POST["pfatajar_ele5"]."',
'".$_POST["pflanzar_ini1"]."',
'".$_POST["pflanzar_ini2"]."',
'".$_POST["pflanzar_ini3"]."',
'".$_POST["pflanzar_ini4"]."',
'".$_POST["pflanzar_ini5"]."',
'".$_POST["pflanzar_ini6"]."',
'".$_POST["pflanzar_ini7"]."',
'".$_POST["pflanzar_ini8"]."',
'".$_POST["pflanzar_ele1"]."',
'".$_POST["pflanzar_ele2"]."',
'".$_POST["pflanzar_ele3"]."',
'".$_POST["pflanzar_ele4"]."',
'".$_POST["pflanzar_ele5"]."',
'".$_POST["pflanzar_ele6"]."',
'".$_POST["pflanzar_ele7"]."',
'".$_POST["pflanzar_ele8"]."',
'".$_POST["pflanzar_mad1"]."',
'".$_POST["pflanzar_mad2"]."',
'".$_POST["pflanzar_mad3"]."',
'".$_POST["pflanzar_mad4"]."',
'".$_POST["pflanzar_mad5"]."',
'".$_POST["pflanzar_mad6"]."',
'".$_POST["pflanzar_mad7"]."',
'".$_POST["pflanzar_mad8"]."',
'".$_POST["pflanzar_mad9"]."',
'".$_POST["cdg1"]."',
'".$_POST["cdg2"]."',
'".$_POST["cdg3"]."',
'".$_POST["cos1"]."',
'".$_POST["cos2"]."',
'".$_POST["cos3"]."',
'".$_POST["ee1"]."',
'".$_POST["ee2"]."',
'".$_POST["ee3"]."',
'".$_POST["ee4"]."',
'".$_POST["ee5"]."',
'".$_POST["ed1"]."',
'".$_POST["actpostura"]."',
'".$_POST["marcha"]."',
'".$_POST["obs_valoracion"]."',
'Realizada')";
			$subtitulo="Valoración inicial";
				$subtitulo1="Adicionado";
				$subtitulo2="Fisioterapia";
			break;
			case 'EVO':
				$sql="INSERT INTO evo_fisio_reh(id_adm_hosp,id_user,freg_evofisio_reh,hreg_evofisio_reh,evolucionfisio_reh,estado_evofisio_reh)VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["evoto"]."','Realizada')";
				$subtitulo="EVolución";
				$subtitulo1="Adicionado";
				$subtitulo2="Fisioterapia";
			break;
			case 'IM':
				$sql="INSERT INTO im_fisio_reh (id_adm_hosp, id_user, freg_imfisio_reh, hreg_imfisio_reh, objetivo_imfisio_reh, actrealizada_imfisio_reh, logros_imfisio_reh, plant_imfisio_reh, estado_imfisio_reh) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["fregimto"]."','".$_POST["hregimto"]."','".$_POST["obj"]."','".$_POST["act"]."','".$_POST["logro"]."','".$_POST["plant"]."','Realizada')";
				$subtitulo="Informe Mensual";
				$subtitulo1="Adicionado";
				$subtitulo2="Fisioterapia";
			break;
			case 'PT':
				$sql="INSERT INTO plantrimestral_fisio_reh(id_adm_hosp, id_user, freg_ptfisio_reh, hreg_ptfisio_reh, obgen_fisio_reh, obespec1_fisio_reh, obespec2_fisio_reh, obespec3_fisio_reh, estado_ptfisio_reh) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["fregptto"]."','".$_POST["hregptto"]."','".$_POST["obgen_reh"]."','".$_POST["obespec1_reh"]."','".$_POST["obespec2_reh"]."','".$_POST["obespec3_reh"]."','Realizada')";
				$subtitulo="Plan Trimestral";
				$subtitulo1="Adicionado";
				$subtitulo2="Fisioterapia";
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
			$subtitulo="El formato de $subtitulo en $subtitulo2 NO fue $subtitulo1 !!!";
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
			$form1='formularios/valinifisio__reh.php';
			$subtitulo='Valoracion inicial Fisioterapia Rehabilitación';
			break;
			case 'EVO':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Evolución";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/evo_fisio_reh5.php';
			$subtitulo='Evolución Diaria Fisioterapia Rehabilitación';
			break;
			case 'IM':
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
			$form1='formularios/imfisio_reh5.php';
			$subtitulo='Informe Mensual Fisioterapia Rehabilitación';
			break;
			case 'PT':
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
			$form1='formularios/planfisio_reh.php';
			$subtitulo='Plan Trimestral Fisioterapia Rehabilitación';
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
<section class="panel-default">
	<section class="panel-heading">
		<h2>Rehabilitación infantil Fisioterapia</h2>
	</section>
<section class="panel-body">
	<section class="col-xs-12">
		<form  role="search" >
      <article class="form-group col-xs-6">
        <input type="text" class="form-control" name="doc" placeholder="Digite Identificacion del paciente">
      </article>
			<div class="col-xs-6">
				<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
				<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			</div>
    </form>
	</section>
	<section class="col-xs-12">
		<form  role="search">
			<article class="form-group col-xs-6">
				<input type="text" class="form-control" name="nom" placeholder="Digite nombre o apellido del paciente">
			</article>
			<div class="col-xs-6">
				<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
				<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			</div>
		</form>
	</section>
<table class="table table-bordered">
	<tr>
		<th class="info">PACIENTE</th>
		<th class="info">IDENTIFICACION</th>
		<th class="info">INGRESO</th>
		<th class="info">FOTO</th>
		<th class="info">Registro Asistencial</th>
		<th class="info">Plan Intervención</th>
	</tr>
	<?php
	if (isset($_REQUEST["doc"])){
	$doc=$_REQUEST["doc"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
							 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
							 s.nom_sedes,
							 d.id_valinifisio_reh
				FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
												 INNER JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
												 LEFT JOIN valini_fisio_reh d on a.id_adm_hosp=d.id_adm_hosp
				WHERE p.doc_pac='".$doc."' and a.estado_adm_hosp='Activo' and tipo_servicio='Rehabilitacion'";
				//echo $sql;
	if ($tabla=$bd1->sub_tuplas($sql)){

		foreach ($tabla as $fila ) {
			if ($fila['id_valinifisio_reh']!='') {
				echo"<tr >\n";
				echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
				echo'<td class="text-center"><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</td>';
				echo'<td class="text-left"><strong>Fecha Ingreso:</strong> '.$fila["fingreso_hosp"].' <br> <strong>Hora Ingreso:</strong> '.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-center">
							<figure class="col-xs-12"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login_table" data-toggle="modal" data-target="#modalpac"></figure> </td>';
				echo'<th class="text-left">
							<p>Ya tiene registrada valoración.</p>
							<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success" ><span class="fa fa-plus-circle"></span> Evolución</button></a></p>
							<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=IM&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success" ><span class="fa fa-plus-circle"></span> Informe Mensual</button></a></p>
							<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PT&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success" ><span class="fa fa-plus-circle"></span> Plan Trimestral</button></a></p>
				</th>';
				echo'<td class="text-center"></td>';
				echo "</tr>\n";

			}else {
				echo"<tr >\n";
				echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
				echo'<td class="text-center"><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</td>';
				echo'<td class="text-left"><strong>Fecha Ingreso:</strong> '.$fila["fingreso_hosp"].' <br> <strong>Hora Ingreso:</strong> '.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-center">
							<figure class="col-xs-12"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login_table" data-toggle="modal" data-target="#modalpac"></figure> </td>';
				echo'<th class="text-left">
							<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VI&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success" ><span class="fa fa-plus-circle"></span> Valoración</button></a></p>
							<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success" ><span class="fa fa-plus-circle"></span> Evolución</button></a></p>
							<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=IM&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success" ><span class="fa fa-plus-circle"></span> Informe Mensual</button></a></p>
							<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PT&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success" ><span class="fa fa-plus-circle"></span> Plan Trimestral</button></a></p>
				</th>';
				echo'<td class="text-center"></td>';
				echo "</tr>\n";

			}
		}
	}
}
if (isset($_REQUEST["nom"])){
	$doc=$_REQUEST["nom"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
							 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
							 s.nom_sedes
			  FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
												 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
				WHERE p.nom_completo LIKE '%".$doc."%' and a.estado_adm_hosp='Activo'  and tipo_servicio='Rehabilitacion'";

	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {

			echo"<tr >\n";
			echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
			echo'<td class="text-center"><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</td>';
			echo'<td class="text-left"><strong>Fecha Ingreso:</strong> '.$fila["fingreso_hosp"].' <br> <strong>Hora Ingreso:</strong> '.$fila["hingreso_hosp"].'</td>';
			echo'<td class="text-center">
						<figure class="col-xs-12"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login_table" data-toggle="modal" data-target="#modalpac"></figure> </td>';
			echo'<th class="text-left">
						<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VI&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success" ><span class="fa fa-plus-circle"></span> Valoración</button></a></p>
						<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success" ><span class="fa fa-plus-circle"></span> Evolución</button></a></p>
						<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=IM&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success" ><span class="fa fa-plus-circle"></span> Informe Mensual</button></a></p>
						<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PT&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success" ><span class="fa fa-plus-circle"></span> Plan Trimestral</button></a></p>
			</th>';
			echo'<td class="text-center"></td>';
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
