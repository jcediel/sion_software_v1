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
				case 'ADM':
				$return1=$_POST['docpac'];
				$sql="INSERT INTO adm_hospitalario (id_eps,id_paciente,id_sedes_ips,fingreso_hosp,hingreso_hosp,tipo_usuario,tipo_afiliacion,ocupacion,dep_residencia,mun_residencia,zona_residencia,nivel,via_ingreso,tipo_servicio,resp_admhosp,estado_adm_hosp) VALUES
				('".$_POST["ideps"]."','".$_POST["idpaci"]."','".$_POST["sedes"]."','".$_POST["fingreso"]."','".$_POST["hingreso"]."','".$_POST["tusuario"]."','".$_POST["tafiliacion"]."','".$_POST["ocupacion"]."','01','0111','".$_POST["zona"]."','".$_POST["nivel"]."','".$_POST["viaingreso"]."','".$_POST["tservicio"]."','".$_SESSION["AUT"]["nombre"]."','Activo')";
				$subtitulo="Proceso de Admisión";
				$subtitulo1="Agregado";
			break;
			case 'EGRESO':
				$return1=$_POST['docpac'];
				$sql="INSERT INTO egreso_dom (id_presentacion_dom,id_user,freg_egreso, dir_egreso, dx_egreso,obs_egreso, realizada) VALUES
				('".$_POST["idpresentacion"]."','".$_POST["id_user"]."','".$_POST["freg_egreso"]."','".$_POST["dir_egreso"]."','".$_POST["dx"]."','".$_POST["obs_egreso"]."','".$_SESSION["AUT"]["nombre"]."')";
				$subtitulo="El fegreso del paciente";
				$subtitulo1="Agregado";
			break;
			case 'BARRIO':
				$sql="UPDATE pacientes SET zonificacion='".$_POST["zonificacion"]."', dir_pac='".$_POST["dir_pac"]."' WHERE id_paciente=".$_REQUEST['idpac'];
				$subtitulo="La ubicacion del paciente";
				$subtitulo1="Actualizada";
				break;
			case 'PRES':
				$return1=$_POST['docpac'];
				$sql="INSERT INTO presentacion_dom (id_paciente,id_eps,id_user,fpresentacion, tipo_paciente, ips_ordena,zona_pac, medico_ordena, dx_presentacion, estado_presentacion) VALUES
				('".$_POST["idpaci"]."','".$_POST["eps"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["fpresentacion"]."','".$_POST["tipo_paciente"]."','".$_POST["ips_ordena"]."','".$_POST["zona_pac"]."','".$_POST["medico_ordena"]."','".$_POST["dx"]."','Presentado')";
				$subtitulo="El formato de presentación al servicio domiciliario";
				$subtitulo1="Agregado";
			break;
			case 'PAC':
				$nom_completo=$_POST['nom1'].' '.$_POST['nom2'].' '.$_POST['ape1'].' '.$_POST['ape2'];
				$sql="INSERT INTO pacientes (tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,dir_pac,zonificacion,tel_pac,estado_pac,nom_completo) VALUES
				('".$_POST["tdocpac"]."','".$_POST["docpac"]."','".$_POST["nom1"]."','".$_POST["nom2"]."','".$_POST["ape1"]."','".$_POST["ape2"]."','".$_POST["dirpac"]."','".$_POST["zonificacion"]."','".$_POST["telpac"]."','Activo','$nom_completo')";
				$subtitulo="El paciente";
				$subtitulo1="Agregado";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo fue $subtitulo1 con exito!";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="$subtitulo NO fue $subtitulo1 con exito! !!! .";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
			case 'ADM':
			$sql="SELECT id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento, edad, uedad, dir_pac, tel_pac, email_pac, estadocivil, genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac, cie, descricie, zonapac, ipsordena FROM pacientes where id_paciente=".$_GET["idpac"];
			$boton="Agregar Admisión";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$return=138;
			$doc=$_GET['idpac'];
			$return1=$_GET['docc'];
			echo $return1;
			$form1='formulariosDOM/adm_domiciliarios.php';
			$form2='consulta_paciente.php';
			$subtitulo='Admisión en servicios domiciliarios ';
			break;
			case 'PRES':
			$sql="SELECT id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento, edad, uedad, dir_pac, tel_pac, email_pac, estadocivil, genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac, cie, descricie, zonapac, ipsordena FROM pacientes where id_paciente=".$_GET["idpac"];
			$boton="Agregar Presentacion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$return=138;
			$doc=$_GET['idpac'];
			$return1=$_REQUEST['docc'];
			$form1='formulariosDOM/add_presentacion.php';
			$form2='consulta_paciente.php';
			$subtitulo='Registro presentacion del paciente a servicio domiciliario ';
			break;
			case 'BARRIO':
			$sql="SELECT id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento, edad, uedad, dir_pac, tel_pac, email_pac, estadocivil, genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac, cie, descricie, zonapac, ipsordena FROM pacientes where id_paciente=".$_GET["idpac"];
			$boton="Actualizar Barrio";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$return=138;
			$doc=$_GET['idpac'];
			$return1=$_REQUEST['docc'];
			$form1='formulariosDOM/upt_barrio.php';
			$form2='consulta_paciente.php';
			$subtitulo='Actualización de ubicación del paciente ';
			break;
			case 'EGRESO':
			$sql="SELECT id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento, edad, uedad, dir_pac, tel_pac, email_pac, estadocivil, genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac, cie, descricie, zonapac, ipsordena FROM pacientes where id_paciente=".$_GET["idpac"];
			$boton="Agregar egreso";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$return=138;
			$doc=$_GET['idpac'];
			$return1=$_GET['docc'];
			echo $return1;
			$form1='formulariosDOM/add_Egreso.php';
			$form2='consulta_paciente.php';
			$subtitulo='Registro proceso de egreso en servicio domiciliario ';
			break;
			case 'PAC':
			$sql="";
			$boton="Agregar Paciente";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$return=138;
			$form1='formulariosDOM/add_paciente_dom.php';
			$form2='';
			$subtitulo='Registro datos básicos paciente ';
			break;
			case 'PROC':
			$sql="";
			$boton="Agregar Paciente";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$return=138;
			$form1='formulariosDOM/add_paciente_dom.php';
			$form2='';
			$subtitulo='Registro datos básicos paciente ';
			break;
			case 'BUS':
			$sql="";
			$boton="Regresar a";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$return=138;
			$form1='formulariosDOM/consulta_prod.php';
			$form2='';
			$subtitulo='Resumén de presentación ';
			break;

		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_paciente"=>"", "tdoc_pac"=>"", "doc_pac"=>"", "nom1"=>"", "nom2"=>"", "ape1"=>"", "ape2"=>"", "fnacimiento"=>"", "edad"=>"", "uedad"=>"", "dir_pac"=>"", "tel_pac"=>"", "email_pac"=>"", "estadocivil"=>"", "genero"=>"", "rh"=>"", "etnia"=>"", "lateralidad"=>"", "profesion"=>"", "religion"=>"", "fotopac"=>"", "estado_pac"=>"", "cie"=>"", "descricie"=>"", "zonapac"=>"", "ipsordena"=>"");

			}
		}else{
				$fila=array("id_paciente"=>"", "tdoc_pac"=>"", "doc_pac"=>"", "nom1"=>"", "nom2"=>"", "ape1"=>"", "ape2"=>"", "fnacimiento"=>"", "edad"=>"", "uedad"=>"", "dir_pac"=>"", "tel_pac"=>"", "email_pac"=>"", "estadocivil"=>"", "genero"=>"", "rh"=>"", "etnia"=>"", "lateralidad"=>"", "profesion"=>"", "religion"=>"", "fotopac"=>"", "estado_pac"=>"", "cie"=>"", "descricie"=>"", "zonapac"=>"", "ipsordena"=>"");
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].docpac.value == ""){
					alert("Sin numero de identificacion NO es posible realizar el registro!");
					document.forms[0].docpac.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].nom1.value == ""){
					alert("El primer nombre del paciente es obligatorio!");
					document.forms[0].nom1.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].ape1.value == ""){
					alert("El primer apellido del paciente es obligatorio!");
					document.forms[0].ape1.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
		<section class="panel panel-default">
			<section class="panel-heading"><h4><?php echo $subtitulo;?></h4></section>
			<section>
				<?php include($form2);?>
			</section>
			<?php include($form1);?>
		</section>

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
		<h3>Dosificación de medicamentos en servicio hospitalario</h3>
	</section>
<section class="panel-body">

<table class="table table-bordered">
	<thead class="thead-inverse ">
		<tr>
			<th class="text-center info">ID</th>
			<th class="text-center info">TIPO FORMULA</th>
			<th class="text-center info">VIGENCIA DE FORMULA</th>
			<th class="text-center info">MEDICAMENTO</th>
      <th class="text-center info">VÍA ADMINISTRACIÓN</th>
      <th class="text-center info">FRECUENCIA</th>
      <th class="text-center info">DOSIS1</th>
      <th class="text-center info">DOSIS2</th>
      <th class="text-center info">DOSIS3</th>
      <th class="text-center info">DOSIS4</th>
      <th class="text-center info">OBSERVACIÓN</th>
			<th colspan="2" class="text-center info">ACCION</th>
		</tr>
	</thead>
	<?php
	if (isset($_REQUEST["placa"])){
	$doc=$_REQUEST["placa"];
	$sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,b.id_adm_hosp,c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,d.id_d_fmedhosp,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4,obsfmedhosp
        FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente INNER JOIN m_fmedhosp c on b.id_adm_hosp=c.id_adm_hosp INNER JOIN d_fmedhosp d on c.id_m_fmedhosp=d.id_m_fmedhosp
        WHERE a.doc_pac='".$doc."' and c.estado_m_fmedhosp='solicitado' order by fejecucion_final DESC";

	if ($tabla=$bd1->sub_tuplas($sql)){
		foreach ($tabla as $fila ) {
      $fechaactual=date('Y-m-d');
      if ($fechaactual<$fila['fejecucion_final']) {
        if ($fila['tipo_formula']=='Programada') {
          echo"<tr >\n";
          echo'<td class="text-center">'.$fila["id_m_fmedhosp"].'</td>';
          echo'<td class="text-center">'.$fila["tipo_formula"].'</td>';
          echo'<td class="text-center">Fecha Inicial: '.$fila["fejecucion_inicial"].' Fecha Final: <strong><u>'.$fila["fejecucion_final"].'</u></strong></td>';
          echo'<td class="text-center">'.$fila["medicamento"].'</td>';
          echo'<td class="text-center">'.$fila["via"].'</td>';
          echo'<td class="text-center">'.$fila["frecuencia"].' Horas</td>';
          echo'<td class="text-center">'.$fila["dosis1"].'</td>';
          echo'<td class="text-center">'.$fila["dosis2"].'</td>';
          echo'<td class="text-center">'.$fila["dosis3"].'</td>';
          echo'<td class="text-center">'.$fila["dosis4"].'</td>';
          echo'<td class="text-center">'.$fila["obsfmedhosp"].'</td>';
          echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion=152&idpresentacion='.$idpresentacion.'&zona='.$zonificacion.'&idpac='.$fila['id_paciente'].'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-play"></span> Administración</button></a></th>';
					echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion=152&idpresentacion='.$idpresentacion.'&zona='.$zonificacion.'&idpac='.$fila['id_paciente'].'&doc='.$doc.'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-undo"></span> Devolución</button></a></th>';
          echo "</tr>\n";
        }
        if ($fila['tipo_formula']=='Evento') {
          echo"<tr >\n";
          echo'<td class="text-center alert-danger">'.$fila["id_m_fmedhosp"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["tipo_formula"].'</td>';
          echo'<td class="text-center alert-danger">Fecha Inicial: '.$fila["fejecucion_inicial"].' Fecha Final: <strong><u>'.$fila["fejecucion_final"].'</u></strong></td>';
          echo'<td class="text-center alert-danger">'.$fila["medicamento"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["via"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["frecuencia"].' Horas</td>';
          echo'<td class="text-center alert-danger">'.$fila["dosis1"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["dosis2"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["dosis3"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["dosis4"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["obsfmedhosp"].'</td>';
					echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion=152&idpresentacion='.$idpresentacion.'&zona='.$zonificacion.'&idpac='.$fila['id_paciente'].'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-play"></span> Administración</button></a></th>';
					echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion=152&idpresentacion='.$idpresentacion.'&zona='.$zonificacion.'&idpac='.$fila['id_paciente'].'&doc='.$doc.'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-undo"></span> Devolución</button></a></th>';
          echo "</tr>\n";
        }
      }
      if ($fechaactual==$fila['fejecucion_final']) {
        if ($fila['tipo_formula']=='Programada') {
          echo"<tr >\n";
          echo'<td class="text-center">'.$fila["id_m_fmedhosp"].'</td>';
          echo'<td class="text-center">'.$fila["tipo_formula"].'</td>';
          echo'<td class="text-center">Fecha Inicial: '.$fila["fejecucion_inicial"].' Fecha Final: <strong><u>'.$fila["fejecucion_final"].'</u></strong></td>';
          echo'<td class="text-center">'.$fila["medicamento"].'</td>';
          echo'<td class="text-center">'.$fila["via"].'</td>';
          echo'<td class="text-center">'.$fila["frecuencia"].' Horas</td>';
          echo'<td class="text-center">'.$fila["dosis1"].'</td>';
          echo'<td class="text-center">'.$fila["dosis2"].'</td>';
          echo'<td class="text-center">'.$fila["dosis3"].'</td>';
          echo'<td class="text-center">'.$fila["dosis4"].'</td>';
          echo'<td class="text-center">'.$fila["obsfmedhosp"].'</td>';
          echo'<th colspan="2" class="text-center">Formula vencida, Solicite reformulación medica</th>';
          echo "</tr>\n";
        }
        if ($fila['tipo_formula']=='Evento') {
          echo"<tr >\n";
          echo'<td class="text-center alert-danger">'.$fila["id_m_fmedhosp"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["tipo_formula"].'</td>';
          echo'<td class="text-center alert-danger">Fecha Inicial: '.$fila["fejecucion_inicial"].' Fecha Final: <strong><u>'.$fila["fejecucion_final"].'</u></strong></td>';
          echo'<td class="text-center alert-danger">'.$fila["medicamento"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["via"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["frecuencia"].' Horas</td>';
          echo'<td class="text-center alert-danger">'.$fila["dosis1"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["dosis2"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["dosis3"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["dosis4"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["obsfmedhosp"].'</td>';
          echo'<th colspan="2" class="text-center alert-danger">Formula vencida, Solicite reformulación medica</th>';
          echo "</tr>\n";
        }
      }
		}
	}
}
if (isset($_REQUEST["nom"])){
$fecha=$_REQUEST["nom"];
$sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,b.id_adm_hosp,c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,d.id_d_fmedhosp,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4,obsfmedhosp
      FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente INNER JOIN m_fmedhosp c on b.id_adm_hosp=c.id_adm_hosp INNER JOIN d_fmedhosp d on c.id_m_fmedhosp=d.id_m_fmedhosp
      WHERE a.nom_completo LIKE '%".$fecha."%' and c.estado_m_fmedhosp='solicitado' order by fejecucion_final DESC";

  if ($tabla=$bd1->sub_tuplas($sql)){
  	//echo $sql;
  	foreach ($tabla as $fila ) {
      $fechaactual=date('Y-m-d');
      if ($fechaactual<$fila['fejecucion_final']) {
        if ($fila['tipo_formula']=='Programada') {
          echo"<tr >\n";
          echo'<td class="text-center">'.$fila["id_m_fmedhosp"].'</td>';
          echo'<td class="text-center">'.$fila["tipo_formula"].'</td>';
          echo'<td class="text-center">Fecha Inicial: '.$fila["fejecucion_inicial"].' Fecha Final: <strong><u>'.$fila["fejecucion_final"].'</u></strong></td>';
          echo'<td class="text-center">'.$fila["medicamento"].'</td>';
          echo'<td class="text-center">'.$fila["via"].'</td>';
          echo'<td class="text-center">'.$fila["frecuencia"].' Horas</td>';
          echo'<td class="text-center">'.$fila["dosis1"].'</td>';
          echo'<td class="text-center">'.$fila["dosis2"].'</td>';
          echo'<td class="text-center">'.$fila["dosis3"].'</td>';
          echo'<td class="text-center">'.$fila["dosis4"].'</td>';
          echo'<td class="text-center">'.$fila["obsfmedhosp"].'</td>';
					echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion=152&idpresentacion='.$idpresentacion.'&zona='.$zonificacion.'&idpac='.$fila['id_paciente'].'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-play"></span> Administración</button></a></th>';
					echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion=152&idpresentacion='.$idpresentacion.'&zona='.$zonificacion.'&idpac='.$fila['id_paciente'].'&doc='.$doc.'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-undo"></span> Devolución</button></a></th>';
          echo "</tr>\n";
        }
        if ($fila['tipo_formula']=='Evento') {
          echo"<tr >\n";
          echo'<td class="text-center alert-danger">'.$fila["id_m_fmedhosp"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["tipo_formula"].'</td>';
          echo'<td class="text-center alert-danger">Fecha Inicial: '.$fila["fejecucion_inicial"].' Fecha Final: <strong><u>'.$fila["fejecucion_final"].'</u></strong></td>';
          echo'<td class="text-center alert-danger">'.$fila["medicamento"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["via"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["frecuencia"].' Horas</td>';
          echo'<td class="text-center alert-danger">'.$fila["dosis1"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["dosis2"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["dosis3"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["dosis4"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["obsfmedhosp"].'</td>';
					echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion=152&idpresentacion='.$idpresentacion.'&zona='.$zonificacion.'&idpac='.$fila['id_paciente'].'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-play"></span> Administración</button></a></th>';
					echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion=152&idpresentacion='.$idpresentacion.'&zona='.$zonificacion.'&idpac='.$fila['id_paciente'].'&doc='.$doc.'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-undo"></span> Devolución</button></a></th>';
          echo "</tr>\n";
        }
      }
      if ($fechaactual==$fila['fejecucion_final']) {
        if ($fila['tipo_formula']=='Programada') {
          echo"<tr >\n";
          echo'<td class="text-center">'.$fila["id_m_fmedhosp"].'</td>';
          echo'<td class="text-center">'.$fila["tipo_formula"].'</td>';
          echo'<td class="text-center">Fecha Inicial: '.$fila["fejecucion_inicial"].' Fecha Final: <strong><u>'.$fila["fejecucion_final"].'</u></strong></td>';
          echo'<td class="text-center">'.$fila["medicamento"].'</td>';
          echo'<td class="text-center">'.$fila["via"].'</td>';
          echo'<td class="text-center">'.$fila["frecuencia"].' Horas</td>';
          echo'<td class="text-center">'.$fila["dosis1"].'</td>';
          echo'<td class="text-center">'.$fila["dosis2"].'</td>';
          echo'<td class="text-center">'.$fila["dosis3"].'</td>';
          echo'<td class="text-center">'.$fila["dosis4"].'</td>';
          echo'<td class="text-center">'.$fila["obsfmedhosp"].'</td>';
          echo'<th colspan="2" class="text-center">Formula vencida, Solicite reformulación medica</th>';
          echo "</tr>\n";
        }
        if ($fila['tipo_formula']=='Evento') {
          echo"<tr >\n";
          echo'<td class="text-center alert-danger">'.$fila["id_m_fmedhosp"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["tipo_formula"].'</td>';
          echo'<td class="text-center alert-danger">Fecha Inicial: '.$fila["fejecucion_inicial"].' Fecha Final: <strong><u>'.$fila["fejecucion_final"].'</u></strong></td>';
          echo'<td class="text-center alert-danger">'.$fila["medicamento"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["via"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["frecuencia"].' Horas</td>';
          echo'<td class="text-center alert-danger">'.$fila["dosis1"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["dosis2"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["dosis3"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["dosis4"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["obsfmedhosp"].'</td>';
          echo'<th colspan="2" class="text-center alert-danger">Formula vencida, Solicite reformulación medica</th>';
          echo "</tr>\n";
        }
      }
  	}
  }
}
	?>
</table>
</section>

</section>
</section>

	<?php
}
?>
