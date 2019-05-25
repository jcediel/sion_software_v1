<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["archivo"])){
				if (is_uploaded_file($_FILES["archivo"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["archivo"]["name"]);
					$archivo=$_POST["id_master_prod"]."_".$_POST["idd"]."_".$_POST["fecha"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["archivo"]["tmp_name"],WEB.SOPLAB.$archivo)){
						$fotoE=",archivo='".SOPLAB.$archivo."'";
						$fotoA1=",archivo";
						$fotoA2=",'".SOPLAB.$archivo."'";
						}
				}
			}
			switch ($_POST["operacion"]) {
			case 'REG':
			$date=date('y-m-d');
				$sql="UPDATE detalle_procedimiento SET estado_prod='".$_POST['estado_prod']."',
				freg_procesa='".$date."',obs_procesa='".$_POST['obs_procesa']."',resp_procesa='".$_SESSION['AUT']['id_user']."'
				WHERE id_d_procedimiento='".$_POST['id_d_procedimiento']."'";
				$subtitulo="El procedimiento fue enviado a procesar con exito";
			break;
			case 'SOPORTE':
				$sql="INSERT INTO soportes_lab (id_master_prod$fotoA1)
				VALUES ('".$_POST["id_master_prod"]."'$fotoA2)";
				$subtitulo="Soporte agregado con exito";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo=" $subtitulo";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="Operación fallida";
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {

			case 'REG':
      $sql="SELECT a.id_master_prod,
									 b.id_d_procedimiento,cod_cups,procedimiento,estado_prod,freg_muestra,resp_muestra,freg_procesa,resp_procesa,
									 c.nombre user_muestra,
									 d.nombre user_procesa
      from master_procedimiento a INNER JOIN detalle_procedimiento b on a.id_master_prod=b.id_master_prod
																	LEFT JOIN user c on b.resp_muestra=c.id_user
																	LEFT JOIN user d on b.resp_procesa=d.id_user
			 where b.id_d_procedimiento =".$_GET['id'] ;
			//echo $sql;
			$boton="Procesar muestra";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['f1'];
			$return1=$_REQUEST['f2'];
			$return2=$_REQUEST['sede'];
			$form1='formulariosHOSP/add_procesado.php';
			$subtitulo='Registro de procesamiento de muestra en laboratorio';
			break;
			case 'SOPORTE':
      $sql="SELECT a.id_master_prod,
									 b.id_d_procedimiento,cod_cups,procedimiento,estado_prod,freg_muestra,resp_muestra,freg_procesa,resp_procesa,
									 c.nombre user_muestra,
									 d.nombre user_procesa
      from master_procedimiento a INNER JOIN detalle_procedimiento b on a.id_master_prod=b.id_master_prod
																	LEFT JOIN user c on b.resp_muestra=c.id_user
																	LEFT JOIN user d on b.resp_procesa=d.id_user
			 where a.id_master_prod =".$_GET['id'] ;
			//echo $sql;
			$boton="Cargar Soporte";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['f1'];
			$return1=$_REQUEST['f2'];
			$return2=$_REQUEST['sede'];
			$form1='formulariosHOSP/soporte_lab.php';
			$subtitulo='Upload de soportes de laboatorio Clínico';
			break;
		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("procedimiento"=>"","observacion"=>"");
			}
		}else{
				$fila=array("procedimiento"=>"","observacion"=>"");
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
		<?php include($form1);?>

<?php
}else{
	echo '<div class="alert alert-success animated bounceInRight">';
	echo $subtitulo;
	echo '</div>';
// nivel 1?>

<section class="panel-default">
<section class="panel-heading">
	<h2>Muestras de laboratorio</h2>
</section>
	<form class="navbar-form navbar-center" role="search" >
		<section class="col-xs-3">
			<label for="">Fecha inicial:</label>
			<article class="input-group">
				<span class="input-group-addon fa fa-calendar" id="basic-addon1"></span>
				<input type="date" class="form-control" name="f1" aria-describedby="basic-addon1">
			</article>
		</section>
		<section class="col-xs-3 ">
			<label for="">Fecha final:</label>
			<article class="input-group">
				<span class="input-group-addon fa fa-calendar" id="basic-addon1"></span>
				<input type="date" class="form-control" name="f2" aria-describedby="basic-addon1">
			</article>
		</section>

		<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
		<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
	</form>
<section class="panel-body">
	<table class="table table-bordered">
		<tr>
			<th>PACIENTE</th>
			<th>
				<article class="col-xs-12">
					<article class="col-xs-6 text-center">PROCEDIMIENTO</article>
					<article class="col-xs-3 text-center">ESTADO<br>MUESTRA</article>
					<article class="col-xs-3 text-center">ESTADO<br>PROCESADO</article>
				</article>
			</th>

			<th>Acciones</th>
		</tr>
		<?php
		$f1=$_REQUEST['f1'];
		$f2=$_REQUEST['f2'];

		$sql="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fnacimiento,TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad,
								 b.id_adm_hosp,estado_adm_hosp,
								 c.id_master_prod,fecha_orden,tipo_atencion

					FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
													 INNER JOIN master_procedimiento c on c.id_adm_hosp=b.id_adm_hosp
													 LEFT JOIN detalle_procedimiento d on d.id_master_prod=c.id_master_prod

					WHERE 	d.estado_prod in ('Muestra','Procesada') and d.freg_muestra between '$f1' and '$f2' and c.estado_orden='Solicitado'

					GROUP BY a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,b.id_adm_hosp,estado_adm_hosp,c.id_master_prod,fecha_orden,tipo_atencion
				 ";
		//echo $sql;
		if ($tabla=$bd1->sub_tuplas($sql)){
			foreach ($tabla as $fila ) {
				$fnac=$fila['fnacimiento'];
				$hoy=date('Y-m-d');
				$d	= (strtotime($hoy)-strtotime($fnac))/86400;
				$dr 	= abs($d);
				$edad = floor($dr);
					echo"<tr >\n";
					echo'<td class="text-center">
								<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
								<p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].'</p>
								<p><strong>Fecha Nacimiento: </strong> '.$fila["fnacimiento"].' -- <strong>Edad: </strong> '.$fila["edad"].'</p>
							 </td>';
					echo'<td class="text-center">';
		 						$idp=$fila['id_master_prod']	;
								$f1=$_REQUEST['f1'];
								$f2=$_REQUEST['f2'];
								$sql1="SELECT a.id_d_procedimiento,cod_cups,procedimiento,estado_prod,freg_muestra,
																resp_muestra,obs_muestra,freg_procesa,resp_procesa,obs_procesa,
														 b.tipo_procedimiento,
														 c.nombre user_muestra,c.especialidad,
														 d.nombre user_procesa
											FROM detalle_procedimiento a INNER JOIN cups b on a.cod_cups=b.codcupsmin
																									 LEFT JOIN user c on a.resp_muestra=c.id_user
										 															 LEFT JOIN user d on a.resp_procesa=d.id_user
								 			WHERE id_master_prod=$idp and freg_muestra between '$f1' and '$f2'
																			and b.tipo_procedimiento='LABORATORIO CLINICO'
																			and a.estado_prod in ('Muestra','Procesada','Fallida')";
																			//echo $sql1;
											$i=1;
								if ($tabla1=$bd1->sub_tuplas($sql1)){
									foreach ($tabla1 as $fila1 ) {

										echo'
										<article class="col-xs-12">
											<article class="col-xs-6">
												<p class="text-primary text-left"><span class="badge">'.$i++.' </span> <strong>'.$fila1["procedimiento"].'</strong>( ('.$fila1["id_d_procedimiento"].') </p>
											</article>
											<article class="col-xs-3">
												<p class=" text-left">
													<strong>'.$fila1["freg_muestra"].'</strong><br>'.$fila1["user_muestra"].' <i>'.$fila1["especialidad"].'</i>
												</p>
												<p class=" text-left">
													<button type="button" class="btn btn-info " data-toggle="modal" data-target="#obs_muestra">Ver observación</button>
													<div id="obs_muestra" class="modal fade" role="dialog">
													  <div class="modal-dialog">
													    <div class="modal-content">
													      <div class="modal-header">
													        <button type="button" class="close" data-dismiss="modal">&times;</button>
													        <h4 class="modal-title">Observación en la muestra</h4>
													      </div>
													      <div class="modal-body">
													        '.$fila1['obs_muestra'].'
													      </div>
													      <div class="modal-footer">
													        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
													      </div>
													    </div>

													  </div>
													</div>
												</p>
											</article>';
											if ($fila1['freg_procesa']=='') {
												echo'<article class="col-xs-3">
													<p class="text-danger text-left fa fa-ban"> NO procesado <br><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=REG&id='.$fila1["id_d_procedimiento"].'&f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&sede='.$_REQUEST["sede"].'"><button type="button" class="btn btn-success " ><span class="fa fa-check"></span> Procesar...</button></a></p>

												</article>';
											}else {
												echo'<article class="col-xs-3">
													<p class="text-primary text-left">'.$fila1["freg_procesa"].'<br>'.$fila1["user_procesa"].'</p>
													<p class="text-primary text-left"><strong>';
													if ($fila1["estado_prod"]=='Procesada') {
														echo'<i class="text-primary">'.$fila1["estado_prod"].'</i>
																 <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SOPORTE&id='.$fila["id_master_prod"].'&idd='.$fila1["id_d_procedimiento"].'&f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&sede='.$_REQUEST["sede"].'">
																 		<button type="button" class="btn btn-info" ><span class="fa fa-upload"></span> </button></a>
														';
													}
													if ($fila1["estado_prod"]=='Fallida') {
														echo'<i class="text-danger">'.$fila1["estado_prod"].'</i>';
													}
													echo'</strong></p>
													<p>
													<button type="button" class="btn btn-info " data-toggle="modal" data-target="#obs_procesa">Ver observación</button>
													<div id="obs_procesa" class="modal fade" role="dialog">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title">Observación en laboratorio</h4>
																</div>
																<div class="modal-body">
																	'.$fila1['obs_muestra'].'
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																</div>
															</div>

														</div>
													</div>
													</p>
												</article>';
											}

										echo'</article>
										';
									}
								}
		 			echo'</td>';
					echo'<th class="text-center">';
								$sqls="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
 					 								 b.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
 					 								 c.nombre,
 					 								 d.archivo

 					 					FROM adm_hospitalario a left join master_procedimiento b on a.id_adm_hosp=b.id_adm_hosp
 					 																	left join user c on c.id_user=b.id_user
 					 																	left join soportes_lab d on d.id_master_prod=b.id_master_prod

 					 					WHERE b.id_master_prod like '%$idp%'  order by fecha_orden DESC";
 										if ($tablas=$bd1->sub_tuplas($sqls)){
 											foreach ($tablas as $filas ) {
												if ($filas['archivo']=='') {
													echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SOPORTE&id='.$fila["id_master_prod"].'&f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&sede='.$_REQUEST["sede"].'"><button type="button" class="btn btn-info" ><span class="fa fa-upload"></span> Cargar<br>Sorporte</button></a></p>';
												}else {
													echo'
													<p>'.$filas['archivo'].'</p>
													<p><a href="'.$filas['archivo'].'" target="_blank">
															<button type="button" class="btn btn-success" >
															<span class="fa fa-eye"></span> Ver soportes</button>
														 </a>
													</p>';
												}
 											}
 										}
					echo'</th>';
					echo "</tr>\n";

			}
		}

		?>

	</table>

	</section>
</section>
	<?php
}
?>
