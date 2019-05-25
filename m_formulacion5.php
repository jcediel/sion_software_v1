<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

			switch ($_POST["operacion"]) {
      case 'DELETES':
          $sql="UPDATE m_fmedhosp set estado_m_fmedhosp='Cancelado',user_upt='".$_SESSION["AUT"]["id_user"]."' where id_m_fmedhosp=".$_POST['idm'];
          $subtitulo1='Formula cancelada con exito';
      break;
			case 'EXTENDER':
          $sql="UPDATE m_fmedhosp set fejecucion_final='".$_POST["fejecucion_final"]."',user_upt='".$_SESSION["AUT"]["id_user"]."'
					where id_m_fmedhosp=".$_POST['idm'];
          $subtitulo1='Formula Extendida hasta el '.$_POST['fejecucion_final'];
      break;
      case 'E':
			$sql="INSERT INTO ord_med_ambu (id_adm_hosp, id_user, freg_ord_med_ambu, hreg_ord_med_ambu, ts_ord_med_ambu, procedimiento, estado_ord_med_ambu, obs_proc ) VALUES
			('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["tiposervicio"]."','".$_POST["cups"]."','Realizada','".$_POST["obs_proc"]."')";
			$subtitulo="Generada";
			break;
			case 'A':
			$tipo_formula=$_POST['tipo_formula'];
			$dxp=$_POST['dx_formula'];
			$dx1=$_POST['dx1_formula'];
			$dx2=$_POST['dx2_formula'];
			$dx3=$_POST['dx3_formula'];

			if ($tipo_formula=='Evento') {
				$fecha1=$_POST['fejecucion_inicial'];
				$fecha2=$_POST['fejecucion_final'];
				if ($fecha2==$fecha1) {

		          $sql="INSERT INTO m_fmedhosp (id_adm_hosp,id_user,id_bodega,fejecucion_inicial,fejecucion_final,tipo_formula,
																					  estado_m_fmedhosp,servicio,dx_formula,dx1_formula,dx2_formula) VALUES
		          ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["idbodega"]."','".$_POST["fejecucion_inicial"]."','".$_POST["fejecucion_final"]."',
							'".$_POST["tipo_formula"]."','Solicitado','".$_POST["servicio"]."','".$_POST["dx_formula"]."','".$_POST["dx1_formula"]."','".$_POST["dx2_formula"]."')";
		          $subtitulo1="Formula generada con exito; Ahora debe proceder a registrar los medicamentos. ";

				}else {
					$sql="INSERT INTO m_fmedhosp (,id_user,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,servicio,dx_formula) VALUES
					('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["fejecucion_inicial"]."','".$_POST["fejecucion_final"]."','".$_POST["tipo_formula"]."','Solicitado','".$_POST["servicio"]."')";
					$subtitulo1="No puedes generar una formula de EVENTO con mas de un día de vigencia.";
					$subtitulo2="Recuerde que este tipo de formulación es para 24 horas";
				}
			}

			if ($tipo_formula=='Programada') {
				$fecha =date('Y-m-d');
				$nuevafecha = strtotime ( '+31 day' , strtotime ( $fecha ) ) ;
				$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
				$f1=$nuevafecha;
				$f2=$_POST['fejecucion_final'];

				if ($f1 <= $f2) {
				  $sql="INSERT INTO m_fmedhosp (,id_user,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,servicio,dx_formula) VALUES
				  ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["fejecucion_inicial"]."','".$_POST["fejecucion_final"]."','".$_POST["tipo_formula"]."','Solicitado','".$_POST["servicio"]."')";
				  $subtitulo1="No se puede generar formula";
				  $subtitulo2="Doctor (a): No puede realizar formulas médicas con vigencia superior a 30 días.";
				}
				if ($f1 > $f2) {
				    $sql="INSERT INTO m_fmedhosp (id_adm_hosp,id_user,id_bodega,fejecucion_inicial,fejecucion_final,tipo_formula,
				                                  estado_m_fmedhosp,servicio,dx_formula,dx1_formula,dx2_formula) VALUES
				    ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["idbodega"]."','".$_POST["fejecucion_inicial"]."','".$_POST["fejecucion_final"]."',
				    '".$_POST["tipo_formula"]."','Solicitado','".$_POST["servicio"]."','".$_POST["dx_formula"]."','".$_POST["dx1_formula"]."','".$_POST["dx2_formula"]."')";
				    $subtitulo1="Formula generada con exito; Ahora debe proceder a registrar los medicamentos. ";
				}
			}
			if ($tipo_formula=='Ambulatoria') {
				$fecha =date('Y-m-d');
				$nuevafecha = strtotime ( '+31 day' , strtotime ( $fecha ) ) ;
				$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
				$f1=$nuevafecha;
				$f2=$_POST['fejecucion_final'];

				if ($f1 <= $f2) {
				  $sql="INSERT INTO m_fmedhosp (,id_user,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,servicio,dx_formula) VALUES
				  ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["fejecucion_inicial"]."','".$_POST["fejecucion_final"]."','".$_POST["tipo_formula"]."','Solicitado','".$_POST["servicio"]."')";
				  $subtitulo1="No se puede generar formula";
				  $subtitulo2="Doctor (a): No puede realizar formulas médicas con vigencia superior a 30 días.";
				}
				if ($f1 > $f2) {
				    $sql="INSERT INTO m_fmedhosp (id_adm_hosp,id_user,id_bodega,fejecucion_inicial,fejecucion_final,tipo_formula,
				                                  estado_m_fmedhosp,servicio,dx_formula,dx1_formula,dx2_formula) VALUES
				    ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["idbodega"]."','".$_POST["fejecucion_inicial"]."','".$_POST["fejecucion_final"]."',
				    '".$_POST["tipo_formula"]."','Solicitado','".$_POST["servicio"]."','".$_POST["dx_formula"]."','".$_POST["dx1_formula"]."','".$_POST["dx2_formula"]."')";
				    $subtitulo1="Formula generada con exito; Ahora debe realizar registro de los medicamentos. ";
				}
			}


			break;
		}
	//echo $sql;
    if ($bd1->consulta($sql)){
			$subtitulo=$subtitulo1;
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logoips"])){
				unlink($fila["logoips"]);
			}
			}
		}else{
			$subtitulo=$subtitulo1.' '.$subtitulo2;
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'EXTENDER':
      $sql="SELECT a.id_m_fmedhosp,tipo_formula,b.nom_bodega
						from m_fmedhosp a inner JOIN bodega b on a.id_bodega=b.id_bodega
						where id_m_fmedhosp=".$_GET['idm'];
			//echo $sql;
      $boton="Extender Formula";
      $atributo1=' readonly="readonly"';
      $atributo2='readonly="readonly"';
      $atributo3='';
      $return=151;
      $return1=$_REQUEST['idadmhosp'];
      $return2=$_REQUEST['servicio'];
      $return3=$_REQUEST['doc'];
			$return4=$_REQUEST['tf'];
			$return5=$_REQUEST['atencion'];
			$return6=$_REQUEST['sede'];
      $date=date('Y/m/d');
      $date1=date('H:i');
      $form1='formulariosMED/extender_formula.php';
      $subtitulo='Extender formula';
    break;
    case 'DELETES':
      $sql="SELECT a.id_m_fmedhosp,tipo_formula,b.nom_bodega
						from m_fmedhosp a inner JOIN bodega b on a.id_bodega=b.id_bodega
						where id_m_fmedhosp=".$_GET['idm'];
			//echo $sql;
      $boton="Cancelar Formula";
      $atributo1=' readonly="readonly"';
      $atributo2='readonly="readonly"';
      $atributo3='';
      $return=151;
      $return1=$_REQUEST['idadmhosp'];
      $return2=$_REQUEST['servicio'];
      $return3=$_REQUEST['doc'];
			$return4=$_REQUEST['tf'];
			$return5=$_REQUEST['atencion'];
			$return6=$_REQUEST['sede'];
      $date=date('Y/m/d');
      $date1=date('H:i');
      $form1='formulariosMED/add_m_fmedhosp.php';
      $subtitulo='Cancelación de formula';
    break;
    case 'ADDDETALLE':
      $sql="";
      $boton="Crear Formula";
      $atributo1=' readonly="readonly"';
      $atributo2='';
      $atributo3='';
      $return=151;
      $return1=$_REQUEST['id'];
      $return2=$_REQUEST['servicio'];
      $return3=$_REQUEST['doc'];
			$return4=$_REQUEST['tf'];
			$return5=$_REQUEST['atencion'];
			$return6=$_REQUEST['sede'];
      $date=date('Y/m/d');
      $date1=date('H:i');
      $form1='medicacion/add_fmedhosp.php';
    break;
		case 'EDITDETALLE':
      $sql="";
      $boton="Editar Formula";
      $atributo1=' readonly="readonly"';
      $atributo2='';
      $atributo3='';
      $return=151;
      $return1=$_REQUEST['id'];
      $return2=$_REQUEST['servicio'];
      $return3=$_REQUEST['doc'];
			$return4=$_REQUEST['tf'];
			$return5=$_REQUEST['atencion'];
			$return6=$_REQUEST['sede'];
      $date=date('Y/m/d');
      $date1=date('H:i');
      $form1='formulariosMED/editar_formula.php';
    break;

			case 'A':
  			$sql="";
  			$color="yellow";
  			$boton="Crear Formula";
  			$atributo1=' readonly="readonly"';
  			$atributo2='';
  			$atributo3='';
        $return=151;
        $return1=$_REQUEST['idadmhosp'];
        $return2=$_REQUEST['servicio'];
        $return3=$_REQUEST['doc'];
				$return4=$_REQUEST['tf'];
				$return5=$_REQUEST['atencion'];
				$return6=$_REQUEST['sede'];
  			$date=date('Y/m/d');
  			$date1=date('H:i');
        $form1='formulariosMED/add_m_fmedhosp.php';
        $subtitulo='Creación de formula';
			break;
		}
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("id_m_fmedhosp"=>"","fejecucion_final"=>"","fejecucion_inicial"=>"",
					"tipo_formula"=>"","nom_bodega"=>"");
			}
		}else{
					$fila=array("id_m_fmedhosp"=>"","fejecucion_final"=>"","fejecucion_inicial"=>"",
					"tipo_formula"=>"","nom_bodega"=>"");
			}
		?>
    <script src = "js/sha3.js"></script>
    		<script>
    			function validar(){
    				if (document.forms[0].fejecucion_final.value < document.forms[0].fejecucion_inicial.value){
    					alert("Doctor(a): la fecha final de la formula no puede ser menor a la fecha inicial.");
    					document.forms[0].fejecucion_final.focus();				// Ubicar el cursor
    					return(false);
    				}
    			}
    		</script>
    <div class="alert alert-info animated bounceInRight"></div>
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
<?php $doc=$_REQUEST['doc']; ?>
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
			echo'<a href="'.PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion=19"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-reply"></span> Regresar a pacientes <strong>'.$opcion.'</strong></button></a>';
		}
	}
	if ($opcion=='Consulta Externa SM'){
		echo'<a href="'.PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion=66"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-reply"></span> Regresar a pacientes <strong>'.$opcion.'</strong></button></a>';
	}
 ?>
<br>
<section class="panel panel-default">
  <section class="panel-heading"><h4>Datos del paciente</h4></section>
  <section class="panel-body">
    <table class="table table-bordered">
  	<?php
  	$doc=$_GET["doc"];
		$adm=$_GET["idadmhosp"];
  	$sql="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
								b.id_adm_hosp, b.id_sedes_ips sedes,b.id_eps eps,fingreso_hosp,hingreso_hosp,c.nom_sedes,d.nom_eps
								FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																 INNER join sedes_ips c on b.id_sedes_ips=c.id_sedes_ips
																 INNER join eps d on b.id_eps=d.id_eps
					WHERE a.doc_pac='".$doc."' and b.id_adm_hosp='".$adm."' ";

  	if ($tabla=$bd1->sub_tuplas($sql)){

  		foreach ($tabla as $fila ) {
				$tf=$_REQUEST['tf'];
				if ($tf=='N') {
					echo"<tr >\n";
	  			echo'<td colspan="10" class="text-center alert alert-success"><h3>FORMULA PARA DESCARGUE EN FARMACIA O CARRO AUXILIAR DE MEDICAMENTOS</h3></td>';
					$atencion='"Programada","evento"';
	  			echo "</tr>\n";
				}
				if ($tf=='E') {
					echo"<tr >\n";
	  			echo'<td colspan="10" class="text-center alert alert-info"><h3>FORMULA PARA DESCARGUE EN CARRO DE PARO</h3></td>';
					$atencion='"Programada","evento"';
	  			echo "</tr>\n";
				}
				if ($tf=='A') {
					echo"<tr >\n";
	  			echo'<td colspan="10" class="text-center alert alert-info"><h3>FORMULA AMBULATORIA</h3></td>';
					$atencion='"Ambulatoria"';
	  			echo "</tr>\n";
				}
  			echo"<tr >\n";
  			echo'<td class="text-center alert alert-info"><strong>Identificación:</strong></td>';
  			echo'<td class="text-center">'.$fila["tdoc_pac"].' '.$fila["doc_pac"].'</td>';
				echo'<td class="text-center alert alert-info"><strong>Paciente:</strong></td>';
  			echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
				echo'<td class="text-center alert alert-info"><strong>Fecha ingreso:</strong></td>';
				echo'<td class="text-center">'.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-center alert alert-info"><strong>Sede Actual:</strong></td>';
				echo'<td class="text-center">'.$fila["nom_sedes"].'</td>';
				echo'<td class="text-center hidden">'.$fila["id_sedes_ips"].'</td>';
				echo'<td class="text-center alert alert-info"><strong>EPS:</strong></td>';
				echo'<td class="text-center">'.$fila["nom_eps"].'</td>';
  			echo "</tr>\n";
				echo "<tr>";
				echo'<td class="text-right" colspan="10">
								<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#historia_medicacion">Historial de formulación</button>
						 </td>';
				echo "</tr>";
  		}
  	}
  	?>
  	</table>
		<div id="historia_medicacion" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Historico de formulación</h4>
		      </div>
		      <div class="modal-body">
		        <section class="panel-body">
							<table class="table table-bordered">
								<tr>
									<td>FORMULA</td>
									<td>HISTORICO<br>FORMULA</td>
								</tr>
								<?php
							 $idpaciente=$_GET["idadmhosp"];
							 $servicio=$_GET["servicio"];

							 $sql_master="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
														b.id_m_fmedhosp,freg_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,
														estado_m_fmedhosp,servicio,
														c.nombre,especialidad

										 FROM adm_hospitalario a LEFT JOIN m_fmedhosp b on a.id_adm_hosp=b.id_adm_hosp
																						 LEFT JOIN user c on b.id_user=c.id_user

										 WHERE a.id_adm_hosp='".$idpaciente."' and b.servicio='$servicio'
										ORDER BY fejecucion_final DESC";
								 // echo $sql_master;
							 if ($tablasql_master=$bd1->sub_tuplas($sql_master)){
								 foreach ($tablasql_master as $fila_sql_master) {
									 echo '<tr>
									 				<td>
														<p><strong>Fecha Registro:</strong> '.$fila_sql_master["freg_m_fmedhosp"].'</p>
														<p><strong>Fecha Ejecución:</strong> '.$fila_sql_master["fejecucion_inicial"].' - '.$fila_sql_master["fejecucion_final"].'</p>
														<p><strong>Tipo Formula:</strong> '.$fila_sql_master["tipo_formula"].'</p>
														<p><strong>Responsable:</strong> '.$fila_sql_master["nombre"].' '.$fila_sql_master["especialidad"].'</p>
													</td>';
													$idm=$fila_sql_master["id_m_fmedhosp"];// consulta de quien extendio la formula
													$sql_master_his="SELECT a.id_m_fmedhosp,
																									b.new_fecha,
					 																				c.nombre

					 										 FROM m_fmedhosp a LEFT JOIN log_extension_formula b on a.id_m_fmedhosp=b.formula_ext
					 																						 LEFT JOIN user c on b.user_ext=c.id_user

					 										 WHERE formula_ext=$idm ";
					 								 //echo $sql_master_his;
					 							 if ($tablasql_master_his=$bd1->sub_tuplas($sql_master_his)){
					 								 foreach ($tablasql_master_his as $fila_sql_master_his) {
														 echo '<td>
														 				 <p class="text-success"><strong>EXTENSIÓN DE FECHA</strong></p>
														 				 <p><strong>Nueva Fecha:</strong> '.$fila_sql_master_his["new_fecha"].'</p>
														 				 <p><strong>Medico que extendio:</strong> '.$fila_sql_master_his["nombre"].'</p>
														 			 ';
													 }
												 }else {
													 echo '<td>
 																	<p class="text-success"><strong>No se realizo extensión de esta Formula</strong></p>
 																';
												 }
												 $idm=$fila_sql_master["id_m_fmedhosp"];
												 $sql_master1="SELECT a.id_m_fmedhosp,
																								 b.fecha, usuario, formula,
																								 c.nombre

															FROM m_fmedhosp a LEFT JOIN log_master_formula b on a.id_m_fmedhosp=b.formula
																											LEFT JOIN user c on b.usuario=c.id_user

															WHERE formula=$idm ";
													//echo $sql_master1;
												if ($tablasql_master1=$bd1->sub_tuplas($sql_master1)){
													foreach ($tablasql_master1 as $fila_sql_master1) {
														echo '
																		<p class="text-danger"><strong>CANCELACION DE FORMULA</strong></p>
																		<p><strong>Fecha Cancelación:</strong> '.$fila_sql_master1["fecha"].'</p>
																		<p><strong>Medico responsable:</strong> '.$fila_sql_master1["nombre"].'</p>
																	</td>';
													}
												}else {
													echo '
																	 <p class="text-danger"><strong>Formula no fue canceladaa</strong></p>
																 </td>';
												}
												echo'<td>';
												$idm=$fila_sql_master["id_m_fmedhosp"];
												$sqldetalle="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
																		 b.id_m_fmedhosp,id_user,freg_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,servicio,dx_formula,dx1_formula,dx2_formula,
																		 c.id_d_fmedhosp, freg, medicamento, via, frecuencia, dosis1, dosis2, dosis3, dosis4, obsfmedhosp,rad_mipres,tipo_mipres,soporte,cod_med,estado_med,
																		 d.pos

															FROM adm_hospitalario a left join m_fmedhosp b on a.id_adm_hosp=b.id_adm_hosp
																											left join d_fmedhosp c on b.id_m_fmedhosp=c.id_m_fmedhosp
																											left join m_producto d on c.cod_med=d.id_producto

															WHERE b.id_m_fmedhosp='".$idm."'";
												 //echo $sqldetalle;
											 if ($tablasqldetalle=$bd1->sub_tuplas($sqldetalle)){
												 foreach ($tablasqldetalle as $fila_sqldetalle) {
													 $estado_detalle=$fila_sqldetalle['estado_med'];
													 if ($estado_detalle=='Solicitado') {
														 echo '<article class="alert alert-info">
 																	 	<p>'.$fila_sqldetalle["medicamento"].'</p>
 																	 	<p>'.$fila_sqldetalle["via"].' - '.$fila_sqldetalle["via"].'</p>
 																	 	<p><strong>D1: </strong>'.$fila_sqldetalle["dosis1"].' - <strong>D2: </strong>'.$fila_sqldetalle["dosis2"].' - <strong>D3: </strong>'.$fila_sqldetalle["dosis3"].' - <strong>D4: </strong>'.$fila_sqldetalle["dosis4"].'</p>
																	 </article>
 																 ';
													 }else {
														 echo '<article class="alert alert-danger">
 																		<p>'.$fila_sqldetalle["medicamento"].'</p>
 																		<p>'.$fila_sqldetalle["via"].' - '.$fila_sqldetalle["via"].'</p>
 																		<p><strong>D1: </strong>'.$fila_sqldetalle["dosis1"].' - <strong>D2: </strong>'.$fila_sqldetalle["dosis2"].' - <strong>D3: </strong>'.$fila_sqldetalle["dosis3"].' - <strong>D4: </strong>'.$fila_sqldetalle["dosis4"].'</p>';
																		$det=$fila_sqldetalle["id_d_fmedhosp"];
																		$sql_logdetalle="SELECT a.fecha,b.nombre
																										 FROM log_detalle_formula a left join user b on a.usuario=b.id_user
																										 														left join d_fmedhosp c on c.id_d_fmedhosp=a.medicamento
																										 WHERE a.medicamento = $det";
																										 if ($tabla_logdetalle=$bd1->sub_tuplas($sql_logdetalle)){
																											 foreach ($tabla_logdetalle as $fila_logdetalle) {
																												 echo'<p><strong>Responsable Cancelación: </strong>'.$fila_logdetalle["nombre"].' - '.$fila_logdetalle["fecha"].'</p>';
																											 }
																										 }
														 echo'</article>';
													 }


												 }
											 }
											 echo'</td>';
										echo'</tr>';
								 }
							 }
							 ?>
							</table>
		        </section>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
		</div>

  </section>
  <section class="panel-heading"><h4>Creación de formula médica en el servicio <?php echo $_GET['servicio']; ?></h4></section>
  <section class="panel-body">
  <table class="table table-responsive table-bordered">
  	<tr>
      <th class="text-center"></th>
  		<th class="text-center success">ID ADM</th>
      <th class="text-center success">FECHA DE EJECUCION</th>
  		<th class="text-center success">FORMULA</th>
  		<th class="text-center success">SERVICIO</th>
  		<th colspan="2" class="text-center"></th>
  	</tr>
  	<?php
  	if (isset($_REQUEST["idadmhosp"])){
  	$idpaciente=$_GET["idadmhosp"];
		$servicio=$_GET["servicio"];
  	$sql="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
								 b.id_m_fmedhosp,freg_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,
								 estado_m_fmedhosp,servicio,id_bodega,
								 c.nombre,especialidad

					FROM adm_hospitalario a LEFT JOIN m_fmedhosp b on a.id_adm_hosp=b.id_adm_hosp
																	LEFT JOIN user c on b.id_user=c.id_user

					WHERE a.id_adm_hosp='".$idpaciente."' and b.servicio='$servicio' and b.tipo_formula in ($atencion) order by fejecucion_final DESC";
				//		echo $sql;
  	if ($tabla=$bd1->sub_tuplas($sql)){
  		foreach ($tabla as $fila) {
        if ($fila['id_m_fmedhosp']=='') {
          $doc=$_REQUEST['doc'];
          echo"<tr >\n";
    			echo'<td colspan="8" class="text-center"><h2 class="alert alert-danger text-center">No existen formulas creadas en admisión '.$fila['id_adm_hosp'].'</h2></th>';
    			echo "</tr>\n";
        }else {
					$factual=date('Y-m-d');

						if ($fila['estado_m_fmedhosp']=='Solicitado' and $fila['fejecucion_final']>=$factual) {
								echo"<tr >\n";
			          echo'<th class="text-center info" >
											<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DELETES&idm='.$fila["id_m_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&atencion='.$_REQUEST['atencion'].'&sede='.$fila['id_sedes_ips'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-trash"></span> Cancelar Formula</button></a>
										  </p>';
								$tipo=$fila['tipo_formula'];
								if ($tipo=='Programada') {
									echo'<p>

											 </p>
												</th>';
								}
			          echo'<td class="text-center info"><strong>ADM: </strong>'.$fila["id_adm_hosp"].' <strong>M: </strong>'.$fila["id_m_fmedhosp"].'</td>';
			          $id=$fila["id_m_fmedhosp"];
			          echo'<td class="text-center info"><strong class="text-primary">Fecha Inicial:</strong><br>'.$fila["fejecucion_inicial"].' <strong class="text-danger"><br>Fecha Final:</strong><br>'.$fila["fejecucion_final"].'</td>';
			    			echo'<td class="text-center info">
												<p><strong class="text-primary">Tipo formula: </strong>'.$fila["tipo_formula"].'</p>
												<p><strong class="text-primary">Estado formula: </strong>'.$fila["estado_m_fmedhosp"].'</p>
												<p><strong class="text-danger">Servicio: </strong>'.$fila["tipo_servicio"].'</p>
										 </td>';
			          echo'<td class="text-center info">
											<p><strong class="text-danger">Profesional: </strong>'.$fila["nombre"].'</p>
											<p><strong class="text-success">'.$fila["especialidad"].'</strong></p>
										 </td>';
								echo'<th class="text-center info">
											<p><a href="'.PROGRAMA.'?opcion=153&idm='.$id.'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&bod='.$fila['id_bodega'].'&atencion='.$_REQUEST['atencion'].'&sede='.$fila['id_sedes_ips'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus"></span> Agregar<br>MEDICAMENTOS</button></a></p>
											<p><button type="button" class="btn btn-success" data-toggle="modal" data-target="#ver_detalle'.$id.'">Ver Detalle</button></p>
										 </th>';

			    			echo "</tr>\n";

						}

        }
  		}
  	}
  }
  	?>
    <tr>
      <td>
        <th colspan="8" class="text-center">
					<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$fila['id_adm_hosp'].'&linea='.$fila['tipo_servicio'].'&servicio='.$_REQUEST['servicio'].'&atencion='.$_REQUEST['atencion'].'&sede='.$_REQUEST['sede'].'&doc='.$_REQUEST['doc'].'&tf='.$_REQUEST['tf'];?>">
					<button type="button" class="btn btn-primary"> <span class="fa fa-plus"></span> Crear formula médica</button>
      </td>
    </tr>
  	</table>
<!--Modal para mostrar el detalle de medicamentos que hay en esta formula--->

		<div id="ver_detalle<?php echo $fila["id_m_fmedhosp"]?>" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">DETALLE CORRESPONDIENTE A FORMULA <strong class="text-danger"># <?php echo $fila['id_m_fmedhosp'] ?></strong></h4>
					</div>
					<div class="modal-body">
						<section class="panel-body">
							<table class="table table-bordered">
								<tr>

									<th class="text-center success">MEDICAMENTO</th>
						  		<th class="text-center success">6am-8am</th>
									<th class="text-center success">12m-2pm</th>
									<th class="text-center success">6pm-8pm</th>
									<th class="text-center success">10pm-12pm</th>
									<th class="text-center success">OBSERVACIÓN</th>
								</tr>
							<?php
							$idm=$fila['id_m_fmedhosp'] ;
							$sql_detalleUno="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
													 b.id_m_fmedhosp,id_user,freg_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,servicio,dx_formula,dx1_formula,dx2_formula,
													 c.id_d_fmedhosp, freg, medicamento, via, frecuencia, dosis1, dosis2, dosis3, dosis4, obsfmedhosp,rad_mipres,tipo_mipres,soporte,cod_med,
													 d.pos

										FROM adm_hospitalario a left join m_fmedhosp b on a.id_adm_hosp=b.id_adm_hosp
																						left join d_fmedhosp c on b.id_m_fmedhosp=c.id_m_fmedhosp
																						left join m_producto d on c.cod_med=d.id_producto

										WHERE b.id_m_fmedhosp='".$idm."' and c.estado_med='Solicitado'";
							//echo $sql;
							if ($tabla_detalleUno=$bd1->sub_tuplas($sql_detalleUno)){
								foreach ($tabla_detalleUno as $fila_detalleUno ) {
									echo"<tr >\n";

				    			echo'<td class="text-left info">
												<p><strong class="text-primary">'.$fila_detalleUno["medicamento"].'</strong></p>
												<p><strong>Vía: </strong> '.$fila_detalleUno["via"].'</p>
												<p><strong>Frecuencia: </strong> '.$fila_detalleUno["frecuencia"].'</p>
												<p><strong>Fecha registro:</strong> '.$fila_detalleUno["freg"].'</p>
												<p><strong>ID:</strong> '.$fila_detalleUno["id_d_fmedhosp"].'</p>
											 </td>';
									echo'<td class="text-center info">'.$fila_detalleUno["dosis1"].'</td>';
									echo'<td class="text-center info">'.$fila_detalleUno["dosis2"].'</td>';
									echo'<td class="text-center info">'.$fila_detalleUno["dosis3"].'</td>';
									echo'<td class="text-center info">'.$fila_detalleUno["dosis4"].'</td>';
									echo'<td class="text-center info">
												<p>'.$fila_detalleUno["obsfmedhosp"].'</p>
											 </td>';
								 	echo"</tr >\n";
								}
							}
							 ?>
							</table>

						</section>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div>

  	<br>
  </section>
</section>
	<?php
}
?>
