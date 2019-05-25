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
				$sql="";
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
		<h2>Asistencia de pacientes Rehabilitación Infantil</h2>
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
	?>

</table>

</section>
</section>
	<?php
}
?>
