
<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["foto"])){
				if (is_uploaded_file($_FILES["foto"]["tmp_name"])){
					$cfoto=explode(".",$_FILES["foto"]["name"]);
					$archivo=$_POST["idpac"].'_'.$_POST["nomdoc"].".".$cfoto[count($cfoto)-1];
					if(move_uploaded_file($_FILES["foto"]["tmp_name"],WEB.DOCPAC.$archivo)){
						$fotoE=",foto='".DOCPAC.$archivo."'";
						$fotoA=',foto';
						$fotob=",'".DOCPAC.$archivo."'";
						}
				}
			}
			switch ($_POST["operacion"]) {

				case 'DOC':
					$sql="INSERT INTO info_documentacion (id_paciente,nombre_doc$fotoA)
					VALUES ('".$_POST["idpac"]."','".$_POST["nomdoc"]."'$fotob)";
					$subtitulo="El soporte documental ";
					$subtitulo1="Cargado";
				break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El registro fue $subtitulo con exito!";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="El registro NO fue $subtitulo !!! .";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'DOC':
			$sql="SELECT a.id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento, edad, uedad, dir_pac, tel_pac, email_pac, estadocivil,
									 genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac, cie, descricie, zonapac, ipsordena,
									 b.tipo,descri_tipo
						FROM pacientes a LEFT JOIN tdocumentos b on a.tdoc_pac=b.tipo
						WHERE id_paciente=".$_GET["idpac"];
						//echo $sql;
			$color="green";
			$boton="Cargar Documento";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$option=102;
			$doc=$_REQUEST['doc1'];
			$fecha1=$_REQUEST['fecha1'];
			$fecha2=$_REQUEST['fecha2'];
			$reporte=$_REQUEST['reporte'];
			$form1='admision/add_documentos.php';
			$subtitulo='Cargar documentos del paciente';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fotopac"=>"","estadocivil"=>"","edad"=>"","lateralidad"=>"","profesion"=>"","religion"=>"",
				"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","tipo_usuario"=>"","tipo_afiliacion"=>"","ocupacion"=>"","dep_residencia"=>"","mun_residencia"=>"","zona_residencia"=>"","nivel"=>"","via_ingreso"=>"");
			}
		}else{
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fotopac"=>"","estadocivil"=>"","edad"=>"","lateralidad"=>"","profesion"=>"","religion"=>"",
				"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","tipo_usuario"=>"","tipo_afiliacion"=>"","ocupacion"=>"","dep_residencia"=>"","mun_residencia"=>"","zona_residencia"=>"","nivel"=>"","via_ingreso"=>"");
			}
?>
			<?php include($form1); ?>
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
			<h3>Informes de control Farmacia Hospitalaria</h3>
		</section>
		<section class="panel-body">
			<form>
			<section class="col-xs-12">
					<article class="col-xs-3">
						<label>Fecha inicial:</label>
						<input type="date" class="form-control" name="fecha1">
					</article>
					<article class="col-xs-3">
						<label>Fecha Final:</label>
						<input type="date" class="form-control" name="fecha2">
					</article>
					<article class="col-xs-4">
						<label>Seleccione reporte:</label>
						<select class="form-control" required name="reporte">
						<option value=""></option>
							<option value="1">Promedio de gasto Medicamentos</option>
							<option value="2">Medicamentos devueltos</option>
							<option value="3">Reporte de MIPRES</option>
						</select>
					</article>

					<article class="col-xs-3">
		        <label for="">Seleccione EPS:</label>
		        <select class="form-control input-sm" required="" name="eps">
		          <option value="12,13,14,15,16,17,18,19,20,21,22,23,24,25">Todas</option>
		          <?php
		          $sql="SELECT id_eps,nom_eps from eps where estado_eps='Activo' ORDER BY id_eps ASC";
		          if($tabla=$bd1->sub_tuplas($sql)){
		            foreach ($tabla as $fila2) {
		              if ($fila["id_eps"]==$fila2["id_eps"]){
		                $sw=' selected="selected"';
		              }else{
		                $sw="";
		              }
		            echo '<option value="'.$fila2["id_eps"].'"'.$sw.'>'.$fila2["nom_eps"].'</option>';
		            }
		          }
		          ?>
		        </select>
		      </article>
					<article class="col-xs-3">
						<label for="">Seleccione bodega:</label>
						<select class="form-control input-sm" required="" name="bodega">
							<option value="2,3,5,6,7,8,9,10,11,12,14,15,16">Todas</option>
							<?php
							$sql="SELECT id_bodega,nom_bodega from bodega where estado_bodega='Activo' ORDER BY id_bodega ASC";
							if($tabla=$bd1->sub_tuplas($sql)){
								foreach ($tabla as $fila2) {
									if ($fila["id_bodega"]==$fila2["id_bodega"]){
										$sw=' selected="selected"';
									}else{
										$sw="";
									}
								echo '<option value="'.$fila2["id_bodega"].'"'.$sw.'>'.$fila2["nom_bodega"].'</option>';
								}
							}
							?>
						</select>
					</article>
					<article class="col-xs-2">
						<label>Identificación:</label>
						<input type="text" class="form-control" name="doc">
					</article>
					<div class="row col-md-2">
						<br>
						<input type="submit" name="buscar" class="btn btn-primary " value="Buscar">
						<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
					</div>
			</section>
			</form>
		</section>
		<section class="panel-body">
			<?php
			$doc=$_REQUEST['doc'];
			$f1=$_REQUEST['fecha1'];
			$f2=$_REQUEST['fecha2'];
			$reporte=$_REQUEST['reporte'];
			$eps=$_REQUEST['eps'];
			$bodega=$_REQUEST['bodega'];
				if ($reporte==1) {

					echo'<table class="table table-bordered">
								<tr>
									<th>INFORME PROMEDIO DE GASTO MEDICAMENTOS</th>
									<td class="text-right">
									<a href="rptexcel/SM/rptFarma1.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
									<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
									<a href="rptpdf/SM/rptFarma1.php?f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
									<button type="button" class="btn btn-danger " ><span class="fa fa-file-pdf-o"></span> Exportar pdf</button></a>
									</td>
								</tr>
					</table>';
					echo'<table class="table table-bordered table-responsive table-hover">
								<tr>
									<td>DISPENSADOR</td>
									<td>MES</td>
									<td>MEDICAMENTO</td>
									<td>DOSIS DISPENSADAS</td>
									<td>UNIDADES DISPENSADAS</td>
								</tr>
						';
						$sql_rp="SELECT h.nombre ,month(e.freg_farmacia) mes
							    ,d.medicamento
							    ,sum(cant_dosi) dosis
							    ,round(sum(cant_dosi)/g.unidad) unidades
							FROM
							pacientes	a
							INNER JOIN 	adm_hospitalario b on (a.id_paciente=b.id_paciente)
							INNER JOIN 	eps f on (f.id_eps = b.id_eps)
							INNER JOIN 	m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
							INNER JOIN 	d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
							INNER JOIN 	dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
							INNER JOIN m_producto g on (g.id_producto = d.cod_med and g.estado_propio =
							2)
							LEFT JOIN user h on (h.id_user = e.id_user)
							WHERE
								c.estado_m_fmedhosp='solicitado'
							and e.estado_dosi='Dosificado'
							and e.freg_farmacia between CAST('$f1' AS DATE) and CAST('$f2' AS DATE)
							and f.id_eps in ($eps)
							GROUP BY
							    h.nombre
								,month(e.freg_farmacia)
							    ,d.medicamento
							ORDER BY 1,3,2";

						}
						if ($reporte==2) {

							echo'<table class="table table-bordered">
										<tr>
											<th>INFORME DEVOLUCIONES MEDICAMENTOS</th>
											<td class="text-right">
											<a href="rptexcel/SM/rptFarma2.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&bodega='.$_REQUEST["bodega"].'">
											<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
											<a href="rptpdf/SM/rptFarma2.php?f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&eps='.$_REQUEST["eps"].'&bodega='.$_REQUEST["bodega"].'">
											<button type="button" class="btn btn-danger " ><span class="fa fa-file-pdf-o"></span> Exportar pdf</button></a>
											</td>
										</tr>
							</table>';
							echo'<table class="table table-bordered table-responsive table-hover">
										<tr>
											<td>PACIENTE</td>
											<td>MEDICAMENTO</td>
											<td>DESPACHO</td>
											<td>DEVOLUCION</td>
											<td>OBSERVACION <br> DEVOLUCION</td>
										</tr>
								';
								$sql_rp="SELECT a.id_m_fmedhosp,a.id_adm_hosp,a.id_user,a.id_bodega,a.freg_m_fmedhosp,a.fejecucion_inicial,a.fejecucion_final
													     ,a.tipo_formula,a.estado_m_fmedhosp,a.servicio,a.dx_formula,a.dx1_formula,a.dx2_formula,a.user_upt,
															 b.freg,b.medicamento,b.via,b.frecuencia,b.estado_med,b.rad_mipres,b.tipo_mipres,b.soporte,b.cod_med,
															 b.user_actualiza,(b.dosis1 + b.dosis2 + b.dosis3 + b.dosis4) dosis,
															 c.freg_farmacia,c.nom_dosi,c.cant_dosi,c.estado_dosi,c.obs_dosi,c.fadmin,c.cant_admin,
															 c.hora_admin,c.estado_admin,c.obs_admin,c.resp_adm,
															 e.nom_completo,
															 m.nombre despacho,
															 n.nombre devulve

												 FROM m_fmedhosp a INNER JOIN d_fmedhosp b on (b.id_m_fmedhosp = a.id_m_fmedhosp)
 				  					 											 INNER JOIN dosificacion_med c on (c.id_d_fmedhosp = b.id_d_fmedhosp )
                  			 									 INNER JOIN adm_hospitalario d on d.id_adm_hosp=a.id_adm_hosp
                  										     INNER JOIN pacientes e on e.id_paciente=d.id_paciente
																					 LEFT JOIN user m on m.id_user=c.id_user
																					 LEFT JOIN user n on n.id_user=c.resp_adm

												 WHERE c.freg_farmacia BETWEEN CAST('$f1' as DATE)  AND CAST('$f2' as DATE)
												 			 and a.id_bodega in($bodega)
												 			 and c.estado_admin = 'Devuelto'
												 ORDER BY c.fadmin DESC,e.nom_completo ASC";

								}
								if ($reporte==3) {

									echo'<table class="table table-bordered">
												<tr>
													<th>INFORME DE MIPRES</th>
													<td class="text-right">

													</td>
												</tr>
									</table>';
									echo'<table class="table table-bordered table-responsive table-hover">
												<tr>
													<td>PACIENTE</td>
													<td>MEDICAMENTO</td>
													<td>RADICADO</td>
													<td>TIPO MIPRES</td>
													<td>SOPORTE</td>
												</tr>
										';
										$sql_rp="SELECT f.nom_eps,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
																 b.fingreso_hosp,b.fegreso_hosp,
																 b.id_adm_hosp,
																 g.id_producto,pos,altocosto,exepcion,dx_formula,dx1_formula,dx2_formula,
																 d.medicamento,rad_mipres,tipo_mipres,soporte,
																 h.tarifa_v tarifa,cod_eps_md,
																 n.dxp,
																 sum(cant_dosi) dosis,
																 sum(cant_dosi)/g.unidad unidades
													FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
																					 INNER JOIN eps f on (f.id_eps = b.id_eps)
																					 LEFT JOIN hc_hospitalario n on (n.id_adm_hosp = b.id_adm_hosp)
																					 INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
																					 INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
																					 INNER JOIN m_producto g on (g.id_producto = d.cod_med  and g.estado_propio = 2)
																					 LEFT  JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
																					 LEFT  JOIN convenio_medicamento h on (h.id_eps = b.id_eps and h.id_producto = g.id_producto )
													WHERE c.estado_m_fmedhosp='solicitado' and e.estado_admin='Administrado' and freg_farmacia between '$f1' and '$f2'
																and d.rad_mipres is not null
													GROUP BY f.nom_eps,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,b.fingreso_hosp,b.fegreso_hosp,b.id_adm_hosp,
																		 medicamento,rad_mipres,tipo_mipres,soporte,g.unidad
													ORDER BY 1,3";

										}
				//	echo $sql_rp;
								$i=1;
						if ($tabla_rp=$bd1->sub_tuplas($sql_rp)){
							foreach ($tabla_rp as $fila_rp) {
								if ($reporte==1) {
									echo"<tr >\n";
									echo'<td class="text-left"><strong>'.$fila_rp["nombre"].' </strong></td>';
									echo'<td class="text-center">'.$fila_rp["mes"].'</td>';
									echo'<td class="text-center">'.$fila_rp["medicamento"].'</td>';
									echo'<td class="text-center">'.$fila_rp["dosis"].'</td>';
									echo'<td class="text-center">'.$fila_rp["unidades"].'</td>';
									echo "</tr>\n";
								}
								if ($reporte==2) {
									echo"<tr >\n";
									echo'<td class="text-left"><strong>'.$fila_rp["nom_completo"].' </strong></td>';
									echo'<td class="text-center">'.$fila_rp["medicamento"].'</td>';
									echo'<td class="text-left">
												<p><strong>Fecha Despacho:</strong> '.$fila_rp["freg_farmacia"].'</p>
												<p><strong>Franja Despacho:</strong> '.$fila_rp["nom_dosi"].'</p>
												<p><strong>Cantidad Despacho:</strong> '.$fila_rp["cant_dosi"].'</p>
												<p><strong>Responsable Despacho:</strong> '.$fila_rp["despacho"].'</p>
											 </td>';

									echo'<td class="text-left">
												<p><strong>Fecha Devolución:</strong> '.$fila_rp["fadmin"].'  '.$fila_rp["hora_admin"].'</p>
												<p><strong>Franja Devolución:</strong> '.$fila_rp["nom_dosi"].'</p>
												<p><strong>Cantidad Devolución:</strong> '.$fila_rp["cant_admin"].'</p>
												<p><strong>Responsable Devolución:</strong> '.$fila_rp["devulve"].'</p>
											 </td>';
									echo'<td class="text-center">'.$fila_rp["obs_admin"].'</td>';
									echo "</tr>\n";
								}
								if ($reporte==3) {
									echo"<tr >\n";
									echo'<td class="text-left"><strong>'.$fila_rp["nom1"].' '.$fila_rp["nom2"].' '.$fila_rp["ape1"].' '.$fila_rp["ape2"].' </strong></td>';
									echo'<td class="text-center">'.$fila_rp["medicamento"].'</td>';
									echo'<td class="text-left">
												<p>'.$fila_rp["rad_mipres"].'</p>
											 </td>';
									echo'<td class="text-left">
												<p>'.$fila_rp["tipo_mipres"].'</p>
											 </td>';
									echo'<td class="text-center">
												<a href="'.$fila_rp['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>
										   </td>';
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
