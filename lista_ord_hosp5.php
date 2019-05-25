<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

			switch ($_POST["operacion"]) {
        case 'DELETES':
          $sql="UPDATE master_procedimiento set estado_orden='Cancelado' where id_master_prod=".$_POST['idm'];
          $subtitulo='Cancelada';
          break;
      case 'E':
			$sql="INSERT INTO ord_med_ambu (id_adm_hosp, id_user, freg_ord_med_ambu, hreg_ord_med_ambu, ts_ord_med_ambu, procedimiento, estado_ord_med_ambu, obs_proc ) VALUES
			('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["tiposervicio"]."','".$_POST["cups"]."','Realizada','".$_POST["obs_proc"]."')";
			$subtitulo="Generada";
			break;
			case 'A':
        $sql="INSERT INTO master_procedimiento (id_adm_hosp,id_user, servicio, tipo_atencion, dx, tdx, estado_orden) VALUES
        ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["servicio"]."','".$_POST["tipo_atencion"]."','".$_POST["dx"]."','".$_POST["tdx"]."','Solicitado')";
				$subtitulo="Orden de servicio ";
				$subtitulo1="Generada";
      break;
			case 'INTER':
        $sql="UPDATE detalle_procedimiento SET freg_inter='".$_POST["freg"]."',nota_inter='".$_POST["interpretacion"]."',estado_prod='Interpretado' WHERE id_d_procedimiento='".$_POST["idd"]."' ";
				$subtitulo="Interpretación ";
				$subtitulo1="Generada";
      break;
		}
		//echo $sql;
    if ($bd1->consulta($sql)){
			$subtitulo="La $subtitulo ha sido $subtitulo1 con EXITO.";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logoips"])){
				unlink($fila["logoips"]);
			}
			}
		}else{
			$subtitulo="La  NO se ha $subtitulo !!!";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
    case 'DELETES':
      $sql="SELECT * from m_fmedhosp where id_master_prod=".$_GET['idm'];
      $boton="Cancelar Formula";
      $atributo1=' readonly="readonly"';
      $atributo2='readonly="readonly"';
      $atributo3='';
      $return=133;
      $return1=$_REQUEST['idadmhosp'];
      $return2=$_REQUEST['servicio'];
      $return3=$_REQUEST['doc'];
			$return4=$_REQUEST['atencion'];
      $date=date('Y-m-d');
      $date1=date('H:i');
      $form1='formulariosADX/del_orden.php';
      $subtitulo='Cancelación de formula';
    break;
    case 'ADDDETALLE':
      $sql="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
									 b.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
									 c.id_d_procedimiento,freg,procedimiento,observacion,estado_prod

						FROM adm_hospitalario a left join master_procedimiento b on a.id_adm_hosp=b.id_adm_hosp
																		left join detalle_procedimiento c on b.id_master_prod=c.id_master_prod
						WHERE b.id_master_prod='".$_GET['idm']."' order by freg DESC";
      $boton="Crear Formula";
      $atributo1=' readonly="readonly"';
      $atributo2='';
      $atributo3='';
      $return=133;
      $return1=$_REQUEST['id'];
      $return2=$_REQUEST['servicio'];
      $return3=$_REQUEST['doc'];
			$return4=$_REQUEST['atencion'];
      $date=date('Y-m-d');
      $date1=date('H:i');
      $form1='procedimientos/add_procedimiento.php';
    break;
		case 'CONSULTARDETALLE':
      $sql="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
									 b.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
									 c.id_d_procedimiento,freg,procedimiento,observacion,estado_prod

						FROM adm_hospitalario a left join master_procedimiento b on a.id_adm_hosp=b.id_adm_hosp
																		left join detalle_procedimiento c on b.id_master_prod=c.id_master_prod
						WHERE b.id_master_prod='".$_GET['idm']."' order by freg DESC";
      $boton="Crear Formula";
      $atributo1=' readonly="readonly"';
      $atributo2='';
      $atributo3='';
      $return=133;
      $return1=$_REQUEST['id'];
      $return2=$_REQUEST['servicio'];
      $return3=$_REQUEST['doc'];
			$return4=$_REQUEST['atencion'];
      $date=date('Y-m-d');
      $date1=date('H:i');
      $form1='formulariosADX/consultar_adx.php';
    break;
		case 'EDITDETALLE':
      $sql="";
      $boton="Editar Formula";
      $atributo1=' readonly="readonly"';
      $atributo2='';
      $atributo3='';
      $return=133;
      $return1=$_REQUEST['id'];
      $return2=$_REQUEST['servicio'];
      $return3=$_REQUEST['doc'];
			$return4=$_REQUEST['atencion'];
      $date=date('Y-m-d');
      $date1=date('H:i');
      $form1='formulariosMED/editar_formula.php';
    break;
		case 'INTER':
      $sql="SELECT procedimiento,observacion FROM detalle_procedimiento where id_d_procedimiento=".$_GET['idd'];
      $boton="Adicionar Interpretacíon";
      $atributo1=' readonly="readonly"';
      $atributo2='';
      $atributo3='';
      $return=133;
      $return1=$_REQUEST['idm'];
      $return2=$_REQUEST['idadmhosp'];
      $return3=$_REQUEST['doc'];
			$return4=$_REQUEST['servicio'];
			$return4=$_REQUEST['atencion'];
      $date=date('Y-m-d');
      $date1=date('H:i');
      $form1='formulariosADX/interpretacion.php';
    break;
			case 'A':
  			$sql="";
  			$color="yellow";
  			$boton="Crear Orden de servicio";
  			$atributo1=' readonly="readonly"';
  			$atributo2='';
  			$atributo3='';
        $return=133;
        $return1=$_REQUEST['idadmhosp'];
        $return2=$_REQUEST['servicio'];
        $return3=$_REQUEST['doc'];
				$return4=$_REQUEST['atencion'];
  			$date=date('Y-m-d');
  			$date1=date('H:i');
        $form1='formulariosADX/add_master_prod.php';
        $subtitulo='Creación de ayuda diagnóstica  en servicio '.$return2;
			break;
		}
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("id_master_prod"=>"","fecha_orden"=>"","servicio"=>"","tipo_atencion"=>"","dx"=>"","tdx"=>"","estado_orden"=>"",
					"id_d_procedimiento"=>"","freg,procedimiento"=>"","observacion"=>"","estado_prod"=>"");
			}
		}else{
					$fila=array("id_master_prod"=>"","fecha_orden"=>"","servicio"=>"","tipo_atencion"=>"","dx"=>"","tdx"=>"","estado_orden"=>"",
					"id_d_procedimiento"=>"","freg,procedimiento"=>"","observacion"=>"","estado_prod"=>"");
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
<section class="col-xs-7">
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
</section>
<br>
<section class="panel panel-default">
  <section class="panel-heading"><h4>Datos del paciente</h4></section>
  <section class="panel-body">
    <table class="table table-bordered">
  	<?php
  	$doc=$_GET["doc"];
		$adm=$_GET["idadmhosp"];
  	$sql="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,b.id_adm_hosp, b.id_sedes_ips sedes,b.id_eps eps,fingreso_hosp,hingreso_hosp,c.nom_sedes,d.nom_eps FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente INNER join sedes_ips c on b.id_sedes_ips=c.id_sedes_ips INNER join eps d on b.id_eps=d.id_eps WHERE a.doc_pac='".$doc."' and b.id_adm_hosp='".$adm."' ";
  	if ($tabla=$bd1->sub_tuplas($sql)){
  		//echo $sql;
  		foreach ($tabla as $fila ) {
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
  		}
  	}
  	?>
  	</table>
  </section>
  <section class="panel-heading"><h4>Generación de ordenes de servicio en el servicio <?php echo $_GET['servicio']; ?></h4></section>
  <section class="panel-body">
  <table class="table table-responsive table-bordered">

  	<tr>
      <th class="text-center"></th>
  		<th class="text-center info">ID</th>
      <th class="text-center info">FECHA REGISTRO</th>
      <th class="text-center info">ESTADO ORDEN</th>
  		<th colspan="2" class="text-center"></th>
  	</tr>
  	<?php
  	if (isset($_REQUEST["idadmhosp"])){
  	$idpaciente=$_GET["idadmhosp"];
		$atencion=$_GET["atencion"];
		$servicio=$_GET["servicio"];
  	$sql="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
								 b.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
								 c.nombre,
								 d.archivo

					FROM adm_hospitalario a left join master_procedimiento b on a.id_adm_hosp=b.id_adm_hosp
																	left join user c on c.id_user=b.id_user
																	left join soportes_lab d on d.id_master_prod=b.id_master_prod

					WHERE a.id_adm_hosp='".$idpaciente."' and b.tipo_atencion='$atencion' and b.servicio='$servicio'  ORDER BY fecha_orden DESC";
				//echo $sql;
  	if ($tabla=$bd1->sub_tuplas($sql)){
  		foreach ($tabla as $fila ) {
					if ($fila['estado_orden']=='Solicitado') {
							echo"<tr >\n";
		          echo'<th class="text-left" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DELETES&idm='.$fila["id_master_prod"].'&servicio='.$_REQUEST['servicio'].'&atencion='.$_REQUEST['atencion'].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-trash"></span> </button></a></th>';
		          echo'<td class="text-left"><strong>ADM: </strong>'.$fila["id_adm_hosp"].'<br> <strong>M: </strong>'.$fila["id_master_prod"].'</td>';
		          $id=$fila["id_master_prod"];
		    			echo'<td class="text-left">
										<p><strong>Fecha: </strong>'.$fila["fecha_orden"].'</p>
										<p><strong>Servicio: </strong>'.$fila["servicio"].'</p>
										<p><strong>Atención: </strong>'.$fila["tipo_atencion"].'</p>
										<p class="alert alert-info"><strong >Estado: </strong>'.$fila["estado_orden"].'</p>
									 </td>';
							echo'<th class="text-left">
										<button data-toggle="collapse" class="btn btn-primary text-center" data-target="#vh'.$fila['id_master_prod'].'">Ver procedimientos agregados<span class="glyphicon glyphicon-arrow-down"></span> </button>
										<section id="vh'.$fila['id_master_prod'].'" class="collapse">
										<table class="table table-bordered">
										<tr>
											<td>PROCEDIMIENTO</td>
											<td>ESTADO</td>
										</tr>
											';
											$sqld = "SELECT id_d_procedimiento, id_master_prod, freg, cod_cups, procedimiento, observacion, estado_prod, freg_muestra, resp_muestra, obs_muestra,
											               freg_procesa, resp_procesa, obs_procesa, freg_inter, nota_inter, resp_inter
											        FROM detalle_procedimiento
											        WHERE id_master_prod=$id";
											if ($tablad=$bd1->sub_tuplas($sqld)){
											    foreach ($tablad as $filad ) {
														if ($filad['estado_prod']=='Solicitado') {
															echo '<tr>';
															echo '<td class="fuente_proced info">'.$filad['procedimiento'].'</td>';
															echo '<td class="fuente_proced info"><span class="fa fa-spinner fa-pulse fa-2x text-danger"></span>Pendiente por TOMA DE MUESTRA</td>';
															echo'<th class="text-center info" ><a href="rpt_ordenhosp.php?idadmhosp='.$idadm.'&idm='.$id.'&idd='.$filad["id_d_procedimiento"].'" target="_blank"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-print"></span></button></a></th>';
															echo '</tr>';
														}
														if ($filad['estado_prod']=='Muestra') {
															echo '<tr>';
															echo '<td class="fuente_proced danger">'.$filad['procedimiento'].'</td>';
															echo '<td class="fuente_proced danger"><span class="fa fa-spinner fa-pulse fa-2x text-danger"></span>Pendiente por PROCESAR</td>';
															echo'<th class="text-center danger" ><a href="rpt_ordenhosp.php?idadmhosp='.$idadm.'&idm='.$id.'&idd='.$filad["id_d_procedimiento"].'" target="_blank"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-print"></span></button></a></th>';
															echo '</tr>';
														}
														if ($filad['estado_prod']=='Procesada') {
															echo '<tr>';
															echo '<td class="fuente_proced success">'.$filad['procedimiento'].'</td>';
															echo '<td class="fuente_proced success">
																		 <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=INTER&idd='.$filad['id_d_procedimiento'].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'"><button type="button" class="btn btn-success" ><span class="fa fa-plus-circle"></span> Interpretación</button></a>
																		</td>';
																		echo'<th class="text-center success" ><a href="rpt_ordenhosp.php?idadmhosp='.$idadm.'&idm='.$id.'&idd='.$filad["id_d_procedimiento"].'" target="_blank" data-toggle="popover" title="Impresión de orden médica" data-content="Some content inside the popover"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-print"></span></button></a></th>';
																		$prod=$filad['id_d_procedimiento'];
																		$sqls="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
										 					 								 b.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
										 					 								 c.nombre,
										 					 								 d.archivo

										 					 					FROM adm_hospitalario a left join master_procedimiento b on a.id_adm_hosp=b.id_adm_hosp
										 					 																	left join user c on c.id_user=b.id_user
										 					 																	left join soportes_lab d on d.id_master_prod=b.id_master_prod

										 					 					WHERE d.archivo like '%$prod%'  order by fecha_orden DESC";
																				if ($tablas=$bd1->sub_tuplas($sqls)){
																				   foreach ($tablas as $filas ) {
																						echo'<th class="text-center success" ><a href="'.$filas['archivo'].'" data-toggle="popover" title="Soporte individual de laboratorio" data-content="Some content inside the popover" target="_blank"><button type="button" class="btn btn-primary" ><span class="fa fa-flask"></span></button></a></th>';
																					}
																				}
															echo '</tr>';
														}
														if ($filad['estado_prod']=='Interpretado') {
															echo '<tr>';
															echo '<td class="fuente_proced success">'.$filad['procedimiento'].'</td>';
															echo '<td class="fuente_proced success">
																		 <p>INTERPRETADO</p>
																		</td>';
																		echo'<th class="text-center success" ><a href="rpt_ordenhosp.php?idadmhosp='.$idadm.'&idm='.$id.'&idd='.$filad["id_d_procedimiento"].'" target="_blank" data-toggle="popover" title="Impresión de orden médica" data-content="Some content inside the popover"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-print"></span></button></a></th>';
																		$prod=$filad['id_d_procedimiento'];
																		$sqls="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
										 					 								 b.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
										 					 								 c.nombre,
										 					 								 d.archivo

										 					 					FROM adm_hospitalario a left join master_procedimiento b on a.id_adm_hosp=b.id_adm_hosp
										 					 																	left join user c on c.id_user=b.id_user
										 					 																	left join soportes_lab d on d.id_master_prod=b.id_master_prod

										 					 					WHERE d.archivo like '%$prod%'  order by fecha_orden DESC";
																				if ($tablas=$bd1->sub_tuplas($sqls)){
																				   foreach ($tablas as $filas ) {
																						echo'<th class="text-center success" ><a href="'.$filas['archivo'].'" data-toggle="popover" title="Soporte individual de laboratorio" data-content="Some content inside the popover" target="_blank"><button type="button" class="btn btn-primary" ><span class="fa fa-flask"></span></button></a></th>';
																					}
																				}
															echo '</tr>';
														}
											    }
											}
							echo'</table></section>
										</th>';
										$fecha=date('Y-m-d');
		    			echo'<th class="text-center" >
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDDETALLE&idm='.$id.'&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$_REQUEST['servicio'].'&atencion='.$_REQUEST['atencion'].'&doc='.$doc.'&fecha='.$fecha.'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-square-o"></span> Agregar Procedimientos</button></a></p>
										<p><a href="'.$fila['archivo'].'" target="_blank"><button type="button" class="btn btn-success" ><span class="fa fa-eye"></span> Ver soportes</button></a></p>
									 </th>';
		    			echo "</tr>\n";
					}
        }
  		}else {
				$doc=$_REQUEST['doc'];
				echo"<tr >\n";
				echo'<td colspan="8" class="text-center"><h2 class="alert alert-danger text-center">No existen Ordenes de servicio creadas en admisión '.$fila['id_adm_hosp'].'</h2></th>';
				echo "</tr>\n";
	  	}
  	}

  	?>

  	</table>
		<tr>
      <td>
        <th colspan="5" class="text-left"><a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$fila['id_adm_hosp'].'&servicio='.$_REQUEST['servicio'].'&atencion='.$_REQUEST['atencion'].'&sede='.$fila['id_sedes_ips'].'&doc='.$_REQUEST['doc'];?>">
																					 <button type="button" class="btn btn-primary"> <span class="fa fa-plus"></span> Generar Orden de servicio</button>
      </td>
    </tr>
  	<br>
  </section>
</section>
	<?php
}
?>
