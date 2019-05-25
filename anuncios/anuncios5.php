<?php
$subtitulo="";
if(isset($_POST["operacion"])){	//nivel3
	if($_POST["aceptar"]!="Descartar"){
		//print_r($_FILES);
		$fotoE="";$fotoA1="";$fotoA2="";
		if (isset($_FILES["foto"])){
			if (is_uploaded_file($_FILES["foto"]["tmp_name"])){

				$cfoto=explode(".",$_FILES["foto"]["name"]);
				$archivo=$_POST["username"].".".$cfoto[count($cfoto)-1];

				if(move_uploaded_file($_FILES["foto"]["tmp_name"],WEB.FOTOS.$archivo)){
					$fotoE=",foto='".FOTOS.$archivo."'";
					$fotoA1=",foto";
					$fotoA2=",'".FOTOS.$archivo."'";
					}
			}
		}
		$docE="";$docA1="";$docA2="";
		if (isset($_FILES["soporte_anuncio"])){
			if (is_uploaded_file($_FILES["soporte_anuncio"]["tmp_name"])){
				$cfoto=explode(".",$_FILES["soporte_anuncio"]["name"]);
				$archivo=$_POST["nombre_soporte"].".".$cfoto[count($cfoto)-1];
				if(move_uploaded_file($_FILES["soporte_anuncio"]["tmp_name"],WEBE.SANUNCIO.$archivo)){
					$docE=",soporte_anuncio='".SANUNCIO.$archivo."'";
					$docA=',soporte_anuncio';
					$docb=",'".SANUNCIO.$archivo."'";
					}
			}
		}
		$firmaE="";$firmaA1="";$firmaA2="";
		if (isset($_FILES["firma"])){
			if (is_uploaded_file($_FILES["firma"]["tmp_name"])){

				$cfoto=explode(".",$_FILES["firma"]["name"]);
				$archivo=$_POST["username"].".".$cfoto[count($cfoto)-1];

				if(move_uploaded_file($_FILES["firma"]["tmp_name"],WEB.FIRMAS.$archivo)){
					$firmaE=",firma='".FIRMAS.$archivo."'";
					$firmaA1=",firma";
					$firmaA2=",'".FIRMAS.$archivo."'";
					}
			}
		}
		$claveE="";$claveA1="";$claveA2="";
		if ($_POST["clave1"]==$_POST["clave2"]){
			if ($_POST["clave1"]!=""){
				$claveE=",clave='".$_POST["clave1"]."'";
				$claveA1=",clave";
				$claveA2=",'".$_POST["clave1"]."'";
			}
		}
		switch ($_POST["operacion"]) {
		case 'E':

		break;
		case 'X':

		break;
		case 'ADDANUNCIO':
			$sql="INSERT INTO anuncios (id_user,servicio,tipo_anuncio,freg,hreg,titulo,anuncio,estado)
			VALUES ('".$_SESSION["AUT"]["id_user"]."','".$_POST["servicio"]."','".$_POST["tipo_anuncio"]."','".$_POST["freg"]."',
							'".$_POST["hreg"]."','".$_POST["titulo"]."','".$_POST["anuncio"]."',1)";
			$subtitulo="Anuncio " ;
			$subtitulo1="Guardado " ;
		break;
		case 'EVIDENCIA':
			$sql="INSERT INTO soporte_anuncio (id_anuncio,id_user,freg_anuncio,hreg_anuncio,nombre_soporte$docA)
			VALUES ('".$_POST["id_anuncio"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg_anuncio"]."','".$_POST["hreg_anuncio"]."',
				'".$_POST["nombre_soporte"]."'$docb)";
			$subtitulo="Soporte de anuncio cargado con exito";
			$subtitulo1="los documentos cargados no deben superar las 2MB . Revise nuevamente el cargue.";
		break;
		case 'EVALUACION':
			$freg=date('Y-m-d');
			$hreg=date('H:i');

			$sql="INSERT INTO cuestionario (id_anuncio, resp_crea, freg_crea, hreg_crea,
																			pregunta1, rta11, estado11, rta12, estado12, rta13, estado13, rta14, estado14,
																			pregunta2, rta21, estado21, rta22, estado22, rta23, estado23, rta24, estado24,
																			pregunta3, rta31, estado31, rta32, estado32, rta33, estado33, rta34, estado34,
																			pregunta4, rta41, estado41, rta42, estado42, rta43, estado43, rta44, estado44,
																			pregunta5, rta51, estado51, rta52, estado52, rta53, estado53, rta54, estado54, vencimiento_cuestionario)
			VALUES ('".$_POST["id_anuncio"]."','".$_SESSION["AUT"]["id_user"]."','".$freg."','".$hreg."',
							'".$_POST["pregunta1"]."','".$_POST["rta11"]."','".$_POST["estado11"]."','".$_POST["rta12"]."','".$_POST["estado12"]."','".$_POST["rta13"]."','".$_POST["estado13"]."','".$_POST["rta14"]."','".$_POST["estado14"]."',
							'".$_POST["pregunta2"]."','".$_POST["rta21"]."','".$_POST["estado21"]."','".$_POST["rta22"]."','".$_POST["estado22"]."','".$_POST["rta23"]."','".$_POST["estado23"]."','".$_POST["rta24"]."','".$_POST["estado24"]."',
							'".$_POST["pregunta3"]."','".$_POST["rta31"]."','".$_POST["estado31"]."','".$_POST["rta32"]."','".$_POST["estado32"]."','".$_POST["rta33"]."','".$_POST["estado33"]."','".$_POST["rta34"]."','".$_POST["estado34"]."',
							'".$_POST["pregunta4"]."','".$_POST["rta41"]."','".$_POST["estado41"]."','".$_POST["rta42"]."','".$_POST["estado42"]."','".$_POST["rta43"]."','".$_POST["estado43"]."','".$_POST["rta44"]."','".$_POST["estado44"]."',
							'".$_POST["pregunta5"]."','".$_POST["rta51"]."','".$_POST["estado51"]."','".$_POST["rta52"]."','".$_POST["estado52"]."','".$_POST["rta53"]."','".$_POST["estado53"]."','".$_POST["rta54"]."','".$_POST["estado54"]."',
							'".$_POST["vencimiento_cuestionario"]."'
						 )";
			$subtitulo="Cuestionario ";
			$subtitulo1="guardado";
		break;

	}
//echo $sql;
	if ($bd1->consulta($sql)){
		$subtitulo="$subtitulo $subtitulo1 con exito";
		$check='si';
		if($_POST["operacion"]=="X"){
		if(is_file($fila["foto"])){
			unlink($fila["foto"]);
		}
		}
	}else{
		$subtitulo="$subtitulo NO fue $subtitulo1";
		$check='no';
	}
}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'ADDANUNCIO':
      $sql="";
    //echo $sql;
      $boton="Guardar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
      $doc=$_REQUEST['doc'];
      $servicio=$_REQUEST['servicio'];
			$form1='anuncios/vista/add_anuncio.php';
			$subtitulo='Creación de anuncio';
			break;
			case 'E':
			$idu=$_REQUEST['idu'];
	    $sql="SELECT id_user, id_perfil, nombre, cuenta, clave, foto, email, tdoc,
									 doc, dir_user, tel_user, rm_profesional, especialidad, firma,
									 estado
						FROM user WHERE id_user=$idu";
	    //echo $sql;
	      $boton="Actualizar";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$date=date('Y-m-d');
				$date1=date('H:i');
	      $doc=$_REQUEST['doc'];
	      $servicio=$_REQUEST['servicio'];
				$form1='formulariosADM/usuarios/usuarios/add_user.php';
				$subtitulo='Edición de usuarios';
				break;
				case 'X':
		    $sql="SELECT id_user, id_perfil, nombre, cuenta, clave, foto, email, tdoc,
										 doc, dir_user, tel_user, rm_profesional, especialidad, firma,
										 estado, freg_user, resp_reg
							FROM user WHERE id_user=$idu";
		    //echo $sql;
		      $boton="Eliminar ";
					$atributo1=' readonly="readonly"';
					$atributo2='';
					$atributo3='';
					$date=date('Y-m-d');
					$date1=date('H:i');
		      $doc=$_REQUEST['doc'];
		      $servicio=$_REQUEST['servicio'];
					$form1='vista_configuracion/usuarios/add_user.php';
					$subtitulo='Eliminación de usuarios';
					break;
					case 'EVIDENCIA':
					$sql="";
					//echo $sql;
						$boton="Agregar";
						$atributo1=' readonly="readonly"';
						$atributo2='';
						$atributo3='';
						$date=date('Y-m-d');
						$date1=date('H:i');
						$doc=$_REQUEST['doc'];
						$servicio=$_REQUEST['servicio'];
						$form1='anuncios/vista/soporte_anuncio.php';
						$subtitulo='Cargue de soportes para anuncio o Capacitacion';
					break;
					case 'EVALUACION':
					$sql="";
					//echo $sql;
						$boton="Agregar";
						$atributo1=' readonly="readonly"';
						$atributo2='';
						$atributo3='';
						$date=date('Y-m-d');
						$date1=date('H:i');
						$doc=$_REQUEST['doc'];
						$servicio=$_REQUEST['servicio'];
						$form1='anuncios/vista/evaluacion.php';
						$subtitulo='Evaluacion de Adherencia ';
					break;

		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_user"=>"", "id_perfil"=>"", "nombre"=>"", "cuenta"=>"", "clave"=>"", "foto"=>"", "email"=>"", "tdoc"=>"",
										 "doc"=>"", "dir_user"=>"", "tel_user"=>"", "rm_profesional"=>"", "especialidad"=>"", "firma"=>"",
										 "estado"=>"", "freg_user"=>"", "resp_reg"=>"");
			}
		}else{
				$fila=array("id_user"=>"", "id_perfil"=>"", "nombre"=>"", "cuenta"=>"", "clave"=>"", "foto"=>"", "email"=>"", "tdoc"=>"",
										 "doc"=>"", "dir_user"=>"", "tel_user"=>"", "rm_profesional"=>"", "especialidad"=>"", "firma"=>"",
										 "estado"=>"", "freg_user"=>"", "resp_reg"=>"");
			}

		?>

		<?php include($form1);?>

<?php
}else{
  if ($check=='si') {
		echo'<section>';
		echo '<script>swal("EXCELENTE !!! '.$subtitulo.'","","success")</script>';
		echo'</section>';
	}if ($check=='no') {
		echo'<section>';
		echo '<script>swal("DEBES REVISAR EL PROCESO !!! '.$subtitulo.'","","error")</script>';
		echo'</section>';
	}
// nivel 1?>
<section class="panel panel-default">
	<section class="panel-heading animated slideInLeft">
		<h3>Gestión de anuncios y capacitaciones</h3>
  </section>
		<section class="col-md-12">
			<section class="row panel-body">

				 <table class="table table-bordered">
					 <tr>
					 	<td colspan="3">
							<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDANUNCIO'?>" align="center" ><button type="button" class="btn btn-primary" >Nuevo Anuncio</button></a>
						</td>
					 </tr>
					 <tr class="fuente_titulo_tabla">
            <th class="text-center text-primary">#</th>
		 		    <th class="text-center text-primary">ANUNCIO</th>
						<th class="text-center text-primary"></th>
		 			</tr>
					<?php
					$yo=$_SESSION['AUT']['id_user'];
					$sql_anuncio="SELECT a.id_anuncio,a.servicio,a.tipo_anuncio,a.freg,a.hreg,a.titulo,a.anuncio,a.estado,a.f_elimina,a.resp_elimina ,
                               b.nombre
											  FROM anuncios a inner join user b on a.id_user=b.id_user
												WHERE a.estado=1 and a.id_user=$yo ORDER BY a.freg DESC";
												//echo $sql_usuario;
					$i=1;
					if ($tabla_anuncio=$bd1->sub_tuplas($sql_anuncio)){
						foreach ($tabla_anuncio as $fila_anuncio ) {
							echo'<tr>';
              $tipo_anuncio=$fila_anuncio['tipo_anuncio'];
              if ($tipo_anuncio==1) { // anunncio general

								echo'<td class="alert alert-info">
                      <p><strong>'.$i++.'</strong></p>
                     </td>';
                echo'<td class="alert alert-info">
                      <p><strong>Fecha registro: </strong>'.$fila_anuncio['freg'].'</p>
                      <p><strong>TITULO: </strong>'.utf8_encode($fila_anuncio['titulo']).'</p>
                      <p><strong>CONTENIDO: </strong>'.utf8_encode($fila_anuncio['anuncio']).'</p>
                     </td>';
                echo'<td class="alert alert-info">
											<article class="col-md-12">
                      	<p><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit_anuncio_'.$fila_anuncio["id_anuncio"].'">Editar Anuncio</button></p>
											</article>
											<article class="col-md-12">
												<p><a href="Funcion_base/eliminar_anuncio.php?id='.$fila_anuncio["id_anuncio"].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar Anuncio</button></a></p>
											</article>
                     </td>';
              }

              if ($tipo_anuncio==3) {// anunncio capacitaciones
								echo'<td class="alert alert-warning">
											<p><strong>'.$i++.'</strong></p>
										 </td>';
                echo'<td class="alert alert-warning">
                      <p><strong>Fecha registro: </strong>'.$fila_anuncio['freg'].'</p>
                      <p><strong>TITULO: </strong>'.$fila_anuncio['titulo'].' # '.$fila_anuncio['id_anuncio'].'</p>
                      <p><strong>CONTENIDO: </strong>'.utf8_encode($fila_anuncio['anuncio']).'</p>
                    	<p>
												<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#soporte_anuncio_'.$fila_anuncio["id_anuncio"].'"><span class="fa fa-upload"></span> Adjuntar Archivos</button>
												<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#link_'.$fila_anuncio["id_anuncio"].'"><span class="fa fa-link"></span> Adjuntar LINK</button>';
												$anuncio=$fila_anuncio['id_anuncio'];
												$sql_validar_cuestionario="SELECT id_cuestionario, id_anuncio, resp_crea, freg_crea, hreg_crea,
																													pregunta1, rta11, estado11, rta12, estado12, rta13, estado13, rta14, estado14,
																													pregunta2, rta21, estado21, rta22, estado22, rta23, estado23, rta24, estado24,
																													pregunta3, rta31, estado31, rta32, estado32, rta33, estado33, rta34, estado34,
																													pregunta4, rta41, estado41, rta42, estado42, rta43, estado43, rta44, estado44,
																													pregunta5, rta51, estado51, rta52, estado52, rta53, estado53, rta54, estado54,vencimiento_cuestionario
																									FROM cuestionario WHERE id_anuncio=$anuncio";
												if ($tabla_validar_cuestionario=$bd1->sub_tuplas($sql_validar_cuestionario)){
													foreach ($tabla_validar_cuestionario as $fila_validar_cuestionario) {
														echo'<strong class="text-danger"> Vencio el '.$fila_validar_cuestionario['vencimiento_cuestionario'].'</strong>';
														echo' <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#result_'.$fila_validar_cuestionario["id_cuestionario"].'"> Resultados<br>Capacitacion</button>';
														echo'
														<div id="result_'.$fila_validar_cuestionario["id_cuestionario"].'" class="modal fade" role="dialog">
															<div class="modal-dialog modal-lg">
																<div class="modal-content">
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal">&times;</button>
																		<h4 class="modal-title">Resultados de capacitación: '.$fila_anuncio["titulo"].'</h4>
																	</div>
																	<div class="modal-body">
																	<section class="panel-body">
																	';
																	include('graficos_dom/graf_capacitacion.php');
														echo'</section>
																	<section class="panel-body">
																	<table class="table table-bordered">
																	<tr>
																	<th></th>
																	<th><small>'.$fila_validar_cuestionario['pregunta1'].'</small></th>
																	<th><small>'.$fila_validar_cuestionario['pregunta2'].'</small></th>
																	<th><small>'.$fila_validar_cuestionario['pregunta3'].'</small></th>
																	<th><small>'.$fila_validar_cuestionario['pregunta4'].'</small></th>
																	<th><small>'.$fila_validar_cuestionario['pregunta5'].'</small></th>
																	<th>CALIFICACION</th>
																	</tr>';
																		$cuestionario=$fila_validar_cuestionario["id_cuestionario"];
																		$sql_respuesta="SELECT a.id_rta_cuestionario, id_cuestionario, freg_rta, hreg_rta, resp_contesta, rta1, rta2, rta3, rta4, rta5,
																		 											 b.nombre,id_perfil,especialidad
																										FROM respuesta_cuestionario a INNER JOIN user b on a.resp_contesta=b.id_user
																										WHERE a.id_cuestionario=$cuestionario ORDER BY id_perfil ASC";
																										//echo $sql_respuesta;
																		if ($tabla_respuesta=$bd1->sub_tuplas($sql_respuesta)){
																			foreach ($tabla_respuesta as $fila_respuesta) {
																				$especialidad=$fila_respuesta['especialidad'];
																				$perfil=$fila_respuesta['id_perfil'];
																				$cuantificacion=($fila_respuesta['rta1'] + $fila_respuesta['rta2'] + $fila_respuesta['rta3'] + $fila_respuesta['rta4'] + $fila_respuesta['rta5']);
																				if ($cuantificacion==0) {
																					$cualificacion='MALO';
																				}
																				if ($cuantificacion==1) {
																					$cualificacion='INSUFICIENTE';
																				}
																				if ($cuantificacion==2) {
																					$cualificacion='REGULAR';
																				}
																				if ($cuantificacion==3) {
																					$cualificacion='BUENO';
																				}
																				if ($cuantificacion==4) {
																					$cualificacion='<strong class="text-primary">MUY BUENO</strong>';
																				}
																				if ($cuantificacion==5) {
																					$cualificacion='<strong class="text-primary">EXCELENTE</strong>';
																				}
																			if ($perfil==21 ||  $perfil==22 ||  $perfil==25 ||  $perfil==23 ||  $perfil==24 ||  $perfil==26 ||  $perfil==27 ||  $perfil==28 ||  $perfil==31 ||  $perfil==32 ||  $perfil==33 ||  $perfil==34 ||  $perfil==48) {
																				echo'<tr class=="alert alert-primary">';
																				echo'
																				<td>
																					<p>'.$fila_respuesta['nombre'].'</p>
																					<p>'.$fila_respuesta['especialidad'].'</p>
																				</td>
																				<td>'.$fila_respuesta['rta1'].'</td>
																				<td>'.$fila_respuesta['rta2'].'</td>
																				<td>'.$fila_respuesta['rta3'].'</td>
																				<td>'.$fila_respuesta['rta4'].'</td>
																				<td>'.$fila_respuesta['rta5'].'</td>
																				<td>
																					<p class="text-center">'.$cuantificacion.'</p>
																					<p class="text-center">'.$cualificacion.'</p>
																				</td>
																				';
																				echo'</tr>';

																			}
																			if ($perfil==70) {
																				echo'<tr class="alert alert-danger">';
																				echo'
																				<td><p>'.$fila_respuesta['nombre'].'</p><p>'.$fila_respuesta['especialidad'].'</p></td>
																				<td>'.$fila_respuesta['rta1'].'</td>
																				<td>'.$fila_respuesta['rta2'].'</td>
																				<td>'.$fila_respuesta['rta3'].'</td>
																				<td>'.$fila_respuesta['rta4'].'</td>
																				<td>'.$fila_respuesta['rta5'].'</td>
																				<td>
																					<p class="text-center">'.$cuantificacion.'</p>
																					<p class="text-center">'.$cualificacion.'</p>
																				</td>
																				';
																				echo'</tr>';
																			}

																			}
																		}
														 echo'</table></section></div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																	</div>
																</div>
															</div>
														</div>';
													}
												}else {
													echo'
													<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVALUACION&ida='.$fila_anuncio["id_anuncio"].'&titu='.$fila_anuncio["titulo"].'">
														<button type="button" class="btn btn-success" >
														<span class="fa fa-file-alt"></span> Crear Adherencia</button>
													</a>';
												}

										echo'</p>
											<div id="soporte_anuncio_'.$fila_anuncio["id_anuncio"].'" class="modal fade" role="dialog">
											 <div class="modal-dialog modal-lg">
												 <!-- Modal content-->
												 <div class="modal-content">
													 <div class="modal-header">
														 <button type="button" class="close" data-dismiss="modal">&times;</button>
														 <h4 class="modal-title">Soportes de anuncio # '.$fila_anuncio["id_anuncio"].'</h4>
														<p class="text-right"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVIDENCIA&id='.$fila_anuncio["id_anuncio"].'">
														<button type="button" class="btn btn-success"><span class="fa fa-file-text"></span>Cargar Soportes</button></a></p>
													 </div>
													 <div class="modal-body">';
													 $id=$fila_anuncio["id_anuncio"];
															$sql_doc="SELECT id_s_anuncio,id_anuncio,id_user,freg_anuncio,hreg_anuncio,nombre_soporte,soporte_anuncio
																				FROM soporte_anuncio
																				WHERE id_anuncio=$id";
														 //echo $sql_doc;
															if ($tabla_doc=$bd1->sub_tuplas($sql_doc)){
																foreach ($tabla_doc as $fila_doc) {
																	echo'<section class="panel-body">';
																		echo'<article class="col-md-6">';
																		echo'<p><strong>Fecha Registro: </strong>'.$fila_doc['freg_anuncio'].'</p>';
																		echo'<p><strong>Nombre: </strong>'.$fila_doc['soporte_anuncio'].'</p>';
																		echo'</article>';
																		echo'<article class="col-md-6">';
																			echo'<p>';
																			$soporte=$fila_doc['soporte_anuncio'];
																			$sop=substr($soporte, -3);

																						 if ($sop=='jpg' || $sop=='JPG' || $sop=='png') {
																							 echo'
																								 <a href="/'.$fila_doc['soporte_anuncio'].'"  target="_blank">
																									 <button type="button" class="btn btn-info btn-md" ><span class="fa fa-file-image"></span> Ver imagen</button>
																								 </a>';
																						 }
																						 if ($sop=='pdf') {
																							 echo'
																								 <a href="/'.$fila_doc['soporte_anuncio'].'"  target="_blank">
																									 <button type="button" class="btn btn-info btn-md" ><span class="fa fa-file-pdf"></span> Ver PDF</button>
																								 </a>';
																						 }
																						 if ($sop=='ppt' || $sop=='pptx' || $sop=='PPT' || $sop=='PPTX' ) {
																							 echo'
																								 <a href="/'.$fila_doc['soporte_anuncio'].'"  target="_blank">
																									 <button type="button" class="btn btn-info btn-md" ><span class="fa fa-file-powerpoint"></span> Ver Power Point</button>
																								 </a>';
																						 }
																						 if ($sop=='mp4') {
																							 echo'
																								 <a href="/'.$fila_doc['soporte_anuncio'].'"  target="_blank">
																									 <button type="button" class="btn btn-info btn-md" ><span class="fa fa-file-video"></span> Ver Video</button>
																								 </a>';
																						 }

																		 echo'</p>
																		 			<p>
																						<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=XDOC&idadm='.$fila_adm["id_adm_hosp"].'&docc='.$filap["doc_pac"].'&pac='.$filap["id_paciente"].'">
		 																				 <button type="button" class="btn btn-danger" ><span class="fa fa-times-circle"></span>	Eliminar Soporte</button>
		 																				</a>
																					</p>';
																		echo'</article>';
																	echo'</section>';
																}
															}else {
															 echo'<p>No existen soporte para este anuncio de CAPACITACION</p>';
															}
													 echo'</div>
													 <div class="modal-footer">
														 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													 </div>
												 </div>

											 </div>
										 </div>
                     </td>';

                echo'<td class="alert alert-warning">
											<section class="panel-body">';
								echo'<article class="col-md-12">';
											$d=$fila_anuncio['id_anuncio'];
											$sql_vista="SELECT a.grupo_vista,a.vista_perfil,b.descrip_grupo_vista,c.nombre_perfil
																	FROM anuncios a left join grupo_vista b on a.grupo_vista=b.cod_grupo_vista
																									left join perfil c on a.vista_perfil=c.id_perfil
																	WHERE a.id_anuncio=$d";
																	//echo $sql_vista;
											if ($tabla_vista=$bd1->sub_tuplas($sql_vista)){
												foreach ($tabla_vista as $fila_vista) {
													$val1=$fila_vista['grupo_vista'];
													$val2=$fila_vista['vista_perfil'];
													if ($val1 == '' && $val2 == '') {
														echo'
															<p><button type="button" class="btn btn-priamry" data-toggle="modal" data-target="#vista_grupal_'.$fila_anuncio['id_anuncio'].'"><span class="fa fa-users"></span> Vista Grupal</button></p>
															<p><button type="button" class="btn btn-priamry" data-toggle="modal" data-target="#vista_perfil_'.$fila_anuncio['id_anuncio'].'"><span class="fa fa-user"></span> Vista por perfil</button></p>';
													}
													if($val1 != '' && $val2 == '') {
														echo'<p>'.$fila_vista['descrip_grupo_vista'].'</p>';
														echo'<p>'.$fila_vista['nombre_perfil'].'</p>';
													}
													if($val1 == '' && $val2 != '') {
														echo'<p>'.$fila_vista['descrip_grupo_vista'].'</p>';
														echo'<p>'.$fila_vista['nombre_perfil'].'</p>';
													}
											  }
											}else {
												echo'
													<p><button type="button" class="btn btn-priamry" data-toggle="modal" data-target="#vista_grupal_'.$fila_anuncio['id_anuncio'].'"><span class="fa fa-users"></span> Vista Grupal</button></p>
													<p><button type="button" class="btn btn-priamry" data-toggle="modal" data-target="#vista_perfil_'.$fila_anuncio['id_anuncio'].'"><span class="fa fa-user"></span> Vista por perfil</button></p>';
											}
								echo'<p><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit_anuncio_'.$fila_anuncio["id_anuncio"].'">Editar Anuncio</button></p>
											<p><a href="Funcion_base/eliminar_anuncio.php?id='.$fila_anuncio["id_anuncio"].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btndanger" ><span class="fa fa-trash"></span> Eliminar Anuncio</button></a></p>

                     </section>
										 </td>';

              }
							echo'	<article class="col-md-12">
								<div id="edit_anuncio_'.$fila_anuncio['id_anuncio'].'" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Editar anuncio</h4>
											</div>
											<div class="modal-body">
											<form action="Funcion_base/editar_anuncio.php" method="POST">
												<section class="panel-body">
													<article class="col-md-12">
														<label>titulo</label>
														<input type="text" class="form-control" name="titulo" value="'.$fila_anuncio["titulo"].'">
														<input type="hidden" name="id_anuncio" value="'.$fila_anuncio["id_anuncio"].'">
														<input type="hidden" name="resp" value="'.$_SESSION['AUT']['id_user'].'">
													</article>
													<article class="col-md-12">
														<label>Anuncio</label>
														<textarea class="form-control" name="anuncio" rows="6">'.$fila_anuncio["anuncio"].'</textarea>
													</article>

												</section>
												<section class="panel-body">
													<article class="col-md-12">
														<input type="submit" value="Editar">
													</article>
												</section>
											</form>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								<div id="link_'.$fila_anuncio["id_anuncio"].'" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Agregar Link al anuncio</h4>
											</div>
											<div class="modal-body">
											<form action="Funcion_base/add_link_anuncio.php" method="POST">
												<section class="panel-body">
													<article class="col-md-12">
														<label>Escriba AQUI el link Ej. https://www.youtube.com/watch?v=tim6vcC1fU</label>
														<input type="text" class="form-control" name="link" value="">
														<input type="hidden" name="id_anuncio" value="'.$fila_anuncio["id_anuncio"].'">
														<input type="hidden" name="resp" value="'.$_SESSION['AUT']['id_user'].'">
													</article>
												</section>
												<section class="panel-body">
													<article class="col-md-12">
														<input type="submit" value="Registrar">
													</article>
												</section>
											</form>
											<section class="">';
											$d=$fila_anuncio['id_anuncio'];
											$sql_link="SELECT a.id_link_anuncio, id_anuncio, freg, hreg, resp, link,
																				b.nombre
																	FROM link_anuncio a left join user b on a.resp=b.id_user

																	WHERE a.id_anuncio=$d and estado_link=1";
																	//echo $sql_vista;
											if ($tabla_link=$bd1->sub_tuplas($sql_link)){
												foreach ($tabla_link as $fila_link) {
													echo'<p>'.$fila_link['freg'].' '.$fila_link['hreg'].' <a href="'.$fila_link['link'].'" target="_blank">'.$fila_link['link'].'</a></p>';
													echo'<p></p>';
												}
											}
								echo'</section>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								<div id="vista_grupal_'.$fila_anuncio['id_anuncio'].'" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Qué grupo desea que vea el anuncio?</h4>
											</div>
											<div class="modal-body">
											<form action="Funcion_base/vista_grupo.php" method="POST">
												<section class="panel-body">
													<article class="col-md-12">
														<label>Elija el grupo que va a ver el anuncio?</label>';
														?>
														<select class="form-control" name="grupo_vista">
															<option value=""></option>
															<?php
										          $sql="SELECT cod_grupo_vista,descrip_grupo_vista from grupo_vista ORDER BY cod_grupo_vista DESC";
										          if($tabla=$bd1->sub_tuplas($sql)){
										            foreach ($tabla as $fila2) {
										              if ($fila["cod_grupo_vista"]==$fila2["cod_grupo_vista"]){
										                $sw=' selected="selected"';
										              }else{
										                $sw="";
										              }
										            echo '<option value="'.$fila2["cod_grupo_vista"].'"'.$sw.'>'.$fila2["descrip_grupo_vista"].'</option>';
										            }
										          }
										          ?>
														</select>
														<?php
												echo'<input type="hidden" name="id_anuncio" value="'.$fila_anuncio["id_anuncio"].'">
													</article>
												</section>
												<section class="panel-body">
													<article class="col-md-12">
														<input type="submit" value="Guardar">
													</article>
												</section>
											</form>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>

								<div id="vista_perfil_'.$fila_anuncio['id_anuncio'].'" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Qué perfil desea que vea el anuncio?</h4>
											</div>
											<div class="modal-body">
											<form action="Funcion_base/vista_perfil.php" method="POST">
												<section class="panel-body">
													<article class="col-md-12">
														<label>Elija el perfil que va a ver el anuncio?</label>';
														?>
														<select class="form-control" name="vista_perfil">
															<option value=""></option>
															<?php
															$sql="SELECT id_perfil,nombre_perfil from perfil ORDER BY nombre_perfil DESC";
															if($tabla=$bd1->sub_tuplas($sql)){
																foreach ($tabla as $fila2) {
																	if ($fila["id_perfil"]==$fila2["id_perfil"]){
																		$sw=' selected="selected"';
																	}else{
																		$sw="";
																	}
																echo '<option value="'.$fila2["id_perfil"].'"'.$sw.'>'.$fila2["nombre_perfil"].'</option>';
																}
															}
															?>
														</select>
														<?php
												echo'<input type="hidden" name="id_anuncio" value="'.$fila_anuncio["id_anuncio"].'">
													</article>
												</section>
												<section class="panel-body">
													<article class="col-md-12">
														<input type="submit" value="Guardar">
													</article>
												</section>
											</form>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								</article>';
							echo'</tr>';

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
