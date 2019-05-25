<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["evidencias"])){
				if (is_uploaded_file($_FILES["evidencias"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["evidencias"]["name"]);
					$archivo=$_POST["id_pqr"].'_evidencia_'.$_POST["frespuesta"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["evidencias"]["tmp_name"],PQ.PQRS.$archivo)){
						$fotoE=",evidencias='".PQRS.$archivo."'";
						$fotoA1=",evidencias";
						$fotoA2=",'".PQRS.$archivo."'";
						}
				}
			}
			switch ($_POST["operacion"]) {
			case 'REG':
			$idpqr=$_GET['idpqr'];
			$f=date('Y-m-d');
			$sql="UPDATE pqr SET servicio='".$_POST["servicio"]."', frespuesta='".$_POST["frespuesta"]."', respuesta='".$_POST["respuesta"]."'$fotoE, plan_accion='".$_POST["plan_accion"]."', fplan_accion='".$_POST["fplan_accion"]."', estado_pqr='resuelta'
							WHERE id_pqr=".$_POST['id_pqr'];
				$subtitulo="PQRS";
				$subtitulo1="Adicionada";

			break;
			case 'UPT':
				$sql="UPDATE pqr SET(id_paciente,id_sedes_ips, id_eps, id_user, fcreacion, num_radicado_eps, linea_negocio, tipo_solicitud, categoria, medio_registro, tipo_cliente, fradicado, descripcion_pqr, resp_respuesta, estado_pqr$fotoA1) VALUES
				('".$_POST["idpac"]."','".$_POST["sede"]."','".$_POST["eps"]."','".$_SESSION["AUT"]["id_user"]."','$f','".$_POST["num_radocado_eps"]."','".$_POST["linea_negocio"]."','".$_POST["tipo_solicitud"]."','".$_POST["categoria"]."','".$_POST["medio_registro"]."','".$_POST["tipo_cliente"]."','".$_POST["fradicado"]."','".$_POST["descripcion_pqr"]."','".$_POST["resp_respuesta"]."','En tramite'$fotoA2)";
				$subtitulo="Evolución Medica";
				$subtitulo1="Adicionado";
			break;
			case 'ADX':
				$sql="INSERT INTO ord_med_hosp (id_adm_hosp, id_user, freg_ord_med_hosp, hreg_ord_med_hosp, ts_ord_med_hosp,dx,tdx, procedimiento, obs_proc, estado_ord_med_hosp) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["tiposervicio"]."','".$_POST["dx"]."','".$_POST["tdx"]."','".$_POST["cups"]."','".$_POST["obs_proc"]."','Realizada')";
				$subtitulo="Ordenes Medicas";
				$subtitulo1="Adicionado";
			break;
			case 'MED':
				$d1='';
				$f=date('Y-m-d');
				$sql="";
				$subtitulo="Formula medica hospitalaria";
				$subtitulo1="Adicionado";
			break;
			case 'ORDVER':
				$sql="INSERT INTO orden_verbal( id_adm_hosp, id_user, freg_ord_verbal, hreg_ord_verbal, orden_verbal, estado_orden_verbal) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["ordverb"]."','Realizada')";
				$subtitulo="Orden Verbal";
				$subtitulo1="Adicionada";
			break;
		}
		echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="Gracias por la respuesta a la  $subtitulo, fue $subtitulo1 con exito!";
		$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="Gracias por la respuesta a la  $subtitulo,  NO fue $subtitulo1 !!! .";
		$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'REG':
    $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
		b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
		j.nom_eps
		from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
								left join eps j on (j.id_eps=b.id_eps)
		where a.id_paciente ='".$_GET["idpaciente"]."' GROUP BY id_pqr" ;
    	$boton="Responder PQRS";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/add_resp_pqr.php';
			$plan='<article class="col-md-3">
        <label for="">Defina fecha de accion:</label>
        <input type="date" class="form-control" name="fplan_accion" value="">
      </article>
      <article class="col-md-12">
        <label for="">Defina Plan de accion:</label>
        <textarea name="plan_accion" class="form-control" rows="5" ></textarea>
      </article>';
			$subtitulo='Respuesta PQRS ';
			break;
			case 'UPT':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			c.id_pqr,id_sedes_ips,id_eps,id_user,fcreacion,num_radicado_eps, linea_negocio, tipo_solicitud, categoria, medio_registro, tipo_cliente, fradicado, descripcion_pqr, resp_respuesta, frespuesta, respuesta, tiempo_respuesta, nivel_satisfaccion, evidencias, plan_accion, fplan_accion, estado_pqr, soporte_pqr
	    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
	                 		 left join pqr c on c.id_paciente=a.id_paciente
	    where a.id_paciente ='".$_GET["idpaciente"]."' GROUP BY id_pqr" ;
			$boton="Actualizacion Registro PQR";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/add_pqr.php';
			$subtitulo='Edicion de PQRS';
			break;

		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"","id_eps"=>"", "nom_eps"=>"","id_sedes_ips"=>"","id_eps"=>"","num_radicado_eps"=>"","id_pqr"=>"" ,"linea_negocio"=>"", "servicio"=>"", "tipo_solicitud"=>"", "categoria"=>"", "medio_registro"=>"", "tipo_cliente"=>"", "fradicado"=>"", "descripcion_pqr"=>"", "resp_respuesta"=>"", "frespuesta"=>"", "respuesta"=>"", "tiempo_respuesta"=>"", "nivel_satisfaccion"=>"", "evidencias"=>"", "plan_accion"=>"", "fplan_accion"=>"", "estado_pqr"=>"","soporte_pqr"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"","id_eps"=>"", "nom_eps"=>"","id_sedes_ips"=>"","id_eps"=>"","num_radicado_eps"=>"","id_pqr"=>"" ,"linea_negocio"=>"", "servicio"=>"", "tipo_solicitud"=>"", "categoria"=>"", "medio_registro"=>"", "tipo_cliente"=>"", "fradicado"=>"", "descripcion_pqr"=>"", "resp_respuesta"=>"", "frespuesta"=>"", "respuesta"=>"", "tiempo_respuesta"=>"", "nivel_satisfaccion"=>"", "evidencias"=>"", "plan_accion"=>"", "fplan_accion"=>"", "estado_pqr"=>"","soporte_pqr"=>"");
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
<div class="panel-body">
	<div class="panel-body">
		<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=REG&idpaciente='.$fila["id_paciente"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-search"></span> Consulta general de PQRS</button></a>
	</div>

	<table class="table table-responsive table-bordered">
		<tr>
			<th id="th-estilo4">Historial</th>
			<th id="th-estilo1">ID</th>
			<th id="th-estilo1">IDENTIFICACIÓN</th>
			<th id="th-estilo2">NOMBRES Y APELLIDOS</th>
			<th id="th-estilo3">FECHA INGRESO</th>
      <th id="th-estilo3">SEDE</th>
			<th id="th-estilo3">EPS</th>
			<th id="th-estilo3">FECHA RADICACION</th>
			<th id="th-estilo3">CATEGORIA</th>
			<th id="th-estilo3">ESTADO PQRS</th>
			<th colspan="2" id="th-estilo4">Accion</th>

		</tr>

		<?php
		if (isset($_SESSION["AUT"]["id_perfil"])){
		$perfil=$_SESSION["AUT"]["id_perfil"];
		$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
								 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,
								 s.id_sedes_ips,nom_sedes,
								 e.nom_eps,
								 c.id_pqr, id_user, fcreacion, num_radicado_eps, linea_negocio, servicio, tipo_solicitud, categoria, medio_registro, tipo_cliente, fradicado, descripcion_pqr, resp_respuesta, frespuesta, respuesta, tiempo_respuesta, nivel_satisfaccion, evidencias, plan_accion, fplan_accion, estado_pqr, soporte_pqr
				  FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
													 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
													 INNER JOIN eps e on e.id_eps=a.id_eps
													 Left join pqr c on c.id_paciente=p.id_paciente
					WHERE c.resp_respuesta='".$perfil."' and estado_pqr='En tramite'  GROUP by id_pqr";
					//echo $sql;
		if ($tabla=$bd1->sub_tuplas($sql)){
			//echo $sql;
			foreach ($tabla as $fila ) {
				if ($fila["categoria"]=='A' && $fila["soporte_pqr"]!='') {
					echo"<tr >	\n";
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HIS&idpaciente='.$fila["id_paciente"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-binoculars"></span> Consultar</button></a></th>';
					echo'<td class="text-center alert-info">PAC='.$fila["id_paciente"].' ID:'.$fila["id_pqr"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["doc_pac"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["nom_sedes"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["nom_eps"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["fradicado"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["categoria"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["estado_pqr"].'</td>';
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=REG&idpaciente='.$fila["id_paciente"].'&idpqr='.$fila["id_pqr"].'&cat='.$fila["categoria"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Agregar</button></a></th>';
					echo'<th class="text-center" ><a href="pqrssoportes/'.$fila["id_paciente"].'_soporte_'.$fila["fradicadoevidencias"].'.pdf"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Soporte</button></a></th>';
					echo "</tr>\n";
				}
				if ($fila["categoria"]=='A' && $fila["soporte_pqr"]=='') {
					echo"<tr >	\n";
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HIS&idpaciente='.$fila["id_paciente"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-binoculars"></span> Consultar</button></a></th>';
					echo'<td class="text-center alert-info">PAC='.$fila["id_paciente"].' ID:'.$fila["id_pqr"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["doc_pac"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["nom_sedes"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["nom_eps"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["fradicado"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["categoria"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["estado_pqr"].'</td>';
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=REG&idpaciente='.$fila["id_paciente"].'&idpqr='.$fila["id_pqr"].'&cat='.$fila["categoria"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Agregar</button></a></th>';
					echo'<th class="text-center" ><span class="fa fa-ban"></span> No hay soporte</th>';
					echo "</tr>\n";
				}
				if ($fila['categoria']=='B' && $fila["soporte_pqr"]!='') {
					echo"<tr >	\n";
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HIS&idpaciente='.$fila["id_paciente"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-binoculars"></span> Consultar</button></a></th>';
					echo'<td class="text-center alert-warning">PAC='.$fila["id_paciente"].' ID:'.$fila["id_pqr"].'</td>';
					echo'<td class="text-center alert-warning">'.$fila["doc_pac"].'</td>';
					echo'<td class="text-center alert-warning">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
					echo'<td class="text-center alert-warning">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
					echo'<td class="text-center alert-warning">'.$fila["nom_sedes"].'</td>';
					echo'<td class="text-center alert-warning">'.$fila["nom_eps"].'</td>';
					echo'<td class="text-center alert-warning">'.$fila["fradicado"].'</td>';
					echo'<td class="text-center alert-warning">'.$fila["categoria"].'</td>';
					echo'<td class="text-center alert-warning">'.$fila["estado_pqr"].'</td>';
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=REG&idpaciente='.$fila["id_paciente"].'&idpqr='.$fila["id_pqr"].'&cat='.$fila["categoria"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Agregar</button></a></th>';
					echo'<th class="text-center" ><a href="pqrssoportes/'.$fila["id_paciente"].'_soporte_'.$fila["evidencias"].'.pdf"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Soporte</button></a></th>';
					echo "</tr>\n";
				}
				if ($fila['categoria']=='B' && $fila["soporte_pqr"]=='') {
					echo"<tr >	\n";
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HIS&idpaciente='.$fila["id_paciente"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-binoculars"></span> Consultar</button></a></th>';
					echo'<td class="text-center alert-warning">PAC='.$fila["id_paciente"].' ID:'.$fila["id_pqr"].'</td>';
					echo'<td class="text-center alert-warning">'.$fila["doc_pac"].'</td>';
					echo'<td class="text-center alert-warning">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
					echo'<td class="text-center alert-warning">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
					echo'<td class="text-center alert-warning">'.$fila["nom_sedes"].'</td>';
					echo'<td class="text-center alert-warning">'.$fila["nom_eps"].'</td>';
					echo'<td class="text-center alert-warning">'.$fila["fradicado"].'</td>';
					echo'<td class="text-center alert-warning">'.$fila["categoria"].'</td>';
					echo'<td class="text-center alert-warning">'.$fila["estado_pqr"].'</td>';
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=REG&idpaciente='.$fila["id_paciente"].'&idpqr='.$fila["id_pqr"].'&cat='.$fila["categoria"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Agregar</button></a></th>';
					echo'<th class="text-center" ><span class="fa fa-ban"></span> No hay soporte</th>';
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
