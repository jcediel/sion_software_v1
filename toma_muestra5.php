<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

			switch ($_POST["operacion"]) {
			case 'REG':
			$fa=date('Y-m-d');
				$sql="UPDATE detalle_procedimiento SET estado_prod='".$_POST['estado']."',freg_muestra='".$fa."',resp_muestra='".$_SESSION['AUT']['id_user']."',obs_muestra='".$_POST['obs_muestra']."'
				WHERE id_d_procedimiento='".$_POST['idd']."'";
				$subtitulo="procesar";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El procedimiento fue enviado a $subtitulo con exito!";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="El procedimiento NO fue enviado a $subtitulo !!! .";
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {

			case 'REG':
      $sql="SELECT procedimiento,observacion
      from detalle_procedimiento where id_d_procedimiento =".$_GET['id'] ;
			//echo $sql;
			$boton="Agregar Toma de muestra";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['f1'];
			$return1=$_REQUEST['f2'];
			$return2=$_REQUEST['sede'];
			$form1='formulariosHOSP/muestras.php';
			$subtitulo='Registro de toma de muestra';
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
		<h4>Registro de toma de muestras</h4>
	</section>
	<section class="panel-body">
		<form>
			<div class="row">
				<div class="col-lg-3 col-xs-3 col-md-3" >
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
						<input type="date" class="form-control" name="f1" aria-describedby="basic-addon1">
					</div>
				</div>
				<div class="col-lg-3 col-xs-3 col-md-3" >
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
						<input type="date" class="form-control" name="f2" aria-describedby="basic-addon1">
					</div>
				</div>
				<div class="col-lg-6 col-xs-6 col-md-6" >
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><span class="fa fa-hospital-o"></span></span>
						<select class="form-control" required="" name="sede" aria-describedby="basic-addon1">
	  					<?php
	  					$sql="SELECT id_sedes_ips,nom_sedes from sedes_ips where estado_sedes='Activo' and id_sedes_ips in (2,8) ORDER BY id_sedes_ips ASC";
	  					if($tabla=$bd1->sub_tuplas($sql)){
	  						foreach ($tabla as $fila2) {
	  							if ($fila["id_sedes_ips"]==$fila2["id_sedes_ips"]){
	  								$sw=' selected="selected"';
	  							}else{
	  								$sw="";
	  							}
	  						echo '<option value="'.$fila2["id_sedes_ips"].'"'.$sw.'>'.$fila2["nom_sedes"].'</option>';
	  						}
	  					}
	  					?>
	  				</select>
						<span class="input-group-btn">
							<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
							<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
						</span>
					</div>
				</div>
			</div>
		</form>
	</section>
<section class="panel-body">
	<table class="table table-bordered">
		<tr>
			<th>PACIENTE</th>
			<th></th>
		</tr>
		<?php
		$f1=$_REQUEST['f1'];
		$f2=$_REQUEST['f2'];
		$sede=$_REQUEST['sede'];
		$sql="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
								 b.id_adm_hosp,fingreso_hosp,fegreso_hosp,estado_adm_hosp,
								 c.id_master_prod,fecha_orden,tipo_atencion

					FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
													 INNER JOIN master_procedimiento c on c.id_adm_hosp=b.id_adm_hosp
													 LEFT JOIN detalle_procedimiento d on d.id_master_prod=c.id_master_prod
													 LEFT JOIN cups e on e.codcupsmin=d.cod_cups

					WHERE 	d.estado_prod in ('Solicitado','Muestra','Procesada') and d.freg between '$f1' and '$f2'
																														and b.id_sedes_ips=$sede
																														and b.tipo_servicio='Hospitalario'
																														and e.tipo_procedimiento='LABORATORIO CLINICO'
																														and b.estado_adm_hosp='Activo'

					GROUP BY a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,b.id_adm_hosp,fingreso_hosp,fegreso_hosp,estado_adm_hosp,c.id_master_prod,fecha_orden,tipo_atencion
				 ";
		//echo $sql;
		if ($tabla=$bd1->sub_tuplas($sql)){
			foreach ($tabla as $fila ) {

					echo"<tr >\n";
					echo'<td class="text-center">
								<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
								<p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].'</p>
								<p><strong>Ingreso: </strong> '.$fila["fingreso_hosp"].'</p>
								<p><strong>Egreso: </strong> '.$fila["fegreso_hosp"].'</p>
								<p>
									<button type="button" class="btn btn-info" data-toggle="modal" data-target="#evoOrd">Evolución<br> de la orden</button>
									<div id="evoOrd" class="modal fade" role="dialog">
									  <div class="modal-dialog modal-lg">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal">&times;</button>
									        <h4 class="modal-title">Evolución del día en que se realizo la orden</h4>
									      </div>
									      <div class="modal-body">';
												$id=$fila["id_adm_hosp"];
												$fecha=$fila['fecha_orden'];
												$sql1="SELECT e.id_adm_hosp,freg_evomed,hreg_evomed,objetivo,subjetivo,analisis_evomed,plan_tratamiento,dxp,ddxp,tdxp,
												u.cuenta,nombre,doc,rm_profesional,especialidad,firma
												FROM evolucion_medica e LEFT JOIN user u on e.id_user=u.id_user
												where e.id_adm_hosp=$id and freg_evomed=DATE('$fecha')
												ORDER BY id_evomed DESC LIMIT 1";
												//echo $sql1;
												if ($tabla1=$bd1->sub_tuplas($sql1)){
													//echo $sql;
													foreach ($tabla1 as $fila1 ) {
														echo'
															<table class="table-bordered">
																<tr>
																	<td>PLAN TRATAMIENTO</td>
																	<td>DIAGNOSTICO</td>

																</tr>
																<tr>
																	<td>'.$fila1['plan_tratamiento'].'</td>
																	<td>
																		<p>'.$fila1['dxp'].'--'.$fila1['ddxp'].'</p>
																	</td>
																</tr>
																<tr>
																	<td colspan="3">'.$fila1['nombre'].' '.$fila1['especialidad'].'</td>
																</tr>
															</table>
														';
													}
												}

									     echo'</div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									      </div>
									    </div>

									  </div>
									</div>
								</p>
							 </td>';
					echo'<td class="text-center">';
		 						$idp=$fila['id_master_prod']	;
								$f1=$_REQUEST['f1'];
								$f2=$_REQUEST['f2'];
								$sql1="SELECT a.id_d_procedimiento,freg,cod_cups,procedimiento,estado_prod,freg_muestra,obs_muestra,resp_muestra,freg_procesa,resp_procesa,
														 b.tipo_procedimiento,
														 c.nombre user_muestra,c.especialidad,
														 d.nombre user_procesa

											FROM detalle_procedimiento a INNER JOIN cups b on a.cod_cups=b.codcupsmin
																									 LEFT JOIN user c on a.resp_muestra=c.id_user
										 															 LEFT JOIN user d on a.resp_procesa=d.id_user

								 			WHERE id_master_prod=$idp and freg between '$f1' and '$f2'
																			and b.tipo_procedimiento='LABORATORIO CLINICO'
																			and a.estado_prod in ('Muestra','Solicitado','Procesada')";
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
												<p class=" text-left"><strong>Fecha Solicitud: </strong>'.$fila1["freg"].'</p>
											</article>';
											if ($fila1['freg_muestra']=='') {
												echo'<article class="col-xs-3">
													<p>
														<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=REG&id='.$fila1["id_d_procedimiento"].'&f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&sede='.$_REQUEST["sede"].'">
														<button type="button" class="btn btn-warning" ><span class="fa fa-plus-circle"></span> Registar<br>Muestra</button></a></p>
												</article>';
											}else {
												echo'<article class="col-xs-3">
													<p class="text-primary text-left">'.$fila1["freg_muestra"].'<br>'.$fila1["user_muestra"].'</p>
													<p class="text-primary text-justify"><strong>'.$fila1["obs_muestra"].'</strong></p>
													<p class="text-primary text-left">'.$fila1["freg_procesa"].'<br>'.$fila1["user_procesa"].'</p>
													<p class="text-primary text-justify"><strong>'.$fila1["obs_procesa"].'</strong></p>
												</article>';
											}
										echo'</article>
										';
									}
								}
		 			echo'</td>
							 <td>';
							 $sqls="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
					 								 b.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
					 								 c.nombre,
					 								 d.archivo

					 					FROM adm_hospitalario a left join master_procedimiento b on a.id_adm_hosp=b.id_adm_hosp
					 																	left join user c on c.id_user=b.id_user
					 																	left join soportes_lab d on d.id_master_prod=b.id_master_prod

					 					WHERE b.id_master_prod=$idp  order by fecha_orden DESC";
										if ($tablas=$bd1->sub_tuplas($sqls)){
											foreach ($tablas as $filas ) {
												echo'<p><a href="'.$filas['archivo'].'" target="_blank"><button type="button" class="btn btn-success" ><span class="fa fa-eye"></span> Ver soportes</button></a></p>';
											}
										}
					echo'</td>';
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
