
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

			case 'A':

			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El registro fue $subtitulo con exito!";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="El registro NO fue $subtitulo !!! .";
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {

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
<?php
}else{
	echo $subtitulo;
// nivel 1?>
	<section class="panel panel-default">
		<section class="panel-heading"><h4>Informes de control y/o FARMACIA (Formulación - Dispensación - Administración/Devolución)</h4></section>
		<section class="panel-body">
			<form>
			<section class="col-xs-12">
					<article class="col-xs-2">
						<label>Fecha inicial:</label>
						<input type="date" class="form-control" name="fecha1">
					</article>
					<article class="col-xs-2">
						<label>Fecha Final:</label>
						<input type="date" class="form-control" name="fecha2">
					</article>
					<article class="col-xs-2">
						<label>Identificación:</label>
						<input type="text" class="form-control" name="doc">
					</article>
					<article class="col-xs-2">
						<label>Seleccione reporte:</label>
						<select class="form-control" name="reporte">
						<option value="0"></option>
							<option value="1">Reporte de formulación existente</option>
							<option value="2">Consolidado de farmacia</option>
						</select>
					</article>
          <article class="col-xs-2">
						<label>Seleccione Sede:</label>
						<select class="form-control" name="sede">
						<option value="0"></option>
							<option value="2,8">Todas</option>
							<option value="2">Clínica Facatativá</option>
              <option value="8">Clínica Bogotá</option>
						</select>
					</article>

					<input type="submit" name="buscar" class="btn btn-primary btn-lg" value="Consultar">
					<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			</section>
			</form>
		</section>

		<section class="panel-body">
			<?php
			$doc=$_REQUEST['doc'];
      $sede=$_REQUEST['sede'];
			$f1=$_REQUEST['fecha1'];
			$f2=$_REQUEST['fecha2'];
			$reporte=$_REQUEST['reporte'];
				if ($reporte==1) {
          if ($doc=='') {
						echo'<table class="table table-bordered table-responsive table-hover">
							<tr>
								<th>PACIENTE</th>
								<th>INGRESO</th>
								<th>UBICACION</th>
								<th>FORMULA</th>
								<th>MEDICAMENTOS</th>
							</tr>';
							$sql="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac doc_pac,tdoc_pac,concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,b.fingreso_hosp,
															concat(j.nom_piso,' <br>',i.nom_pabellon,'<br> ',h.nom_hab,' - ',g.nom_cama) habi,e.nombre quien_formula,
															c.id_m_fmedhosp,c.fejecucion_inicial formula_desde,c.fejecucion_final formula_hasta,
															c.tipo_formula tipo_formula,c.estado_m_fmedhosp estado_formula,d.medicamento,
															d.via,d.frecuencia,d.dosis1,d.dosis2,d.dosis3,d.dosis4

										FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
																						left join m_fmedhosp c on (c.id_adm_hosp = b.id_adm_hosp and (CURRENT_DATE between c.fejecucion_inicial and c.fejecucion_final ))
																						left join d_fmedhosp d on (d.id_m_fmedhosp = c.id_m_fmedhosp)
																						left join user e on (e.id_user = c.id_user)
																						left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
																						left join cama g on (g.id_cama = f.id_cama )
																						left join habitacion h on (h.id_habitacion = g.id_habitacion )
																						left join pabellon i on ( i.id_pabellon = h.id_pabellon )
																						left join piso j on (j.id_piso = i.id_piso )
																						left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )

									 WHERE b.id_sedes_ips in ($sede) and b.estado_adm_hosp='Activo' and b.tipo_servicio='Hospitalario'
									 and estado_m_fmedhosp='Solicitado'";

          }else {
						echo'<table class="table table-bordered table-responsive table-hover">
							<tr>
								<th>PACIENTE</th>
								<th>INGRESO</th>
								<th>UBICACION</th>
								<th>FORMULA</th>
								<th>MEDICAMENTOS</th>
							</tr>';
							$sql="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac doc_pac,tdoc_pac,concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,b.fingreso_hosp,
															concat(j.nom_piso,' <br>',i.nom_pabellon,'<br> ',h.nom_hab,' - ',g.nom_cama) habi,e.nombre quien_formula,
															c.id_m_fmedhosp,c.fejecucion_inicial formula_desde,c.fejecucion_final formula_hasta,
															c.tipo_formula tipo_formula,c.estado_m_fmedhosp estado_formula,d.medicamento,
															d.via,d.frecuencia,d.dosis1,d.dosis2,d.dosis3,d.dosis4

										FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
																						left join m_fmedhosp c on (c.id_adm_hosp = b.id_adm_hosp and (CURRENT_DATE between c.fejecucion_inicial and c.fejecucion_final ))
																						left join d_fmedhosp d on (d.id_m_fmedhosp = c.id_m_fmedhosp)
																						left join user e on (e.id_user = c.id_user)
																						left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
																						left join cama g on (g.id_cama = f.id_cama )
																						left join habitacion h on (h.id_habitacion = g.id_habitacion )
																						left join pabellon i on ( i.id_pabellon = h.id_pabellon )
																						left join piso j on (j.id_piso = i.id_piso )
																						left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )

									 WHERE a.doc_pac='$doc' and b.estado_adm_hosp='Activo' and b.tipo_servicio='Hospitalario'
									 and estado_m_fmedhosp='Solicitado'";

          }

				}
						if ($reporte==2) {
							echo'<table class="table table-bordered table-responsive table-hover">
								<tr>
									<th>SEDE</th>
									<th>PACIENTE</th>
									<th>MEDICAMENTO</th>
									<th colspan="3" class="text-center">6am-8am</th>
									<th colspan="3" class="text-center">12m-2pm</th>
									<th colspan="3" class="text-center">6pm-8pm</th>
									<th colspan="3" class="text-center">10pm-12pm</th>
								</tr>
								<tr>
									<th colspan="3"></th>
									<th class="text-center"><span class="label label-primary">F</span></th>
									<th class="text-center"><span class="label label-info">D</span></th>
									<th class="text-center"><span class="label label-success">A</span></th>

									<th class="text-center"><span class="label label-primary">F</span></th>
									<th class="text-center"><span class="label label-info">D</span></th>
									<th class="text-center"><span class="label label-success">A</span></th>

									<th class="text-center"><span class="label label-primary">F</span></th>
									<th class="text-center"><span class="label label-info">D</span></th>
									<th class="text-center"><span class="label label-success">A</span></th>

									<th class="text-center"><span class="label label-primary">F</span></th>
									<th class="text-center"><span class="label label-info">D</span></th>
									<th class="text-center"><span class="label label-success">A</span></th>
								</tr>';
								$sede=$_REQUEST['sede'];
								$sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
														 b.id_adm_hosp,estado_adm_hosp,tipo_servicio,
														 c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,
														 d.id_d_fmedhosp,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4,obsfmedhosp,
														 e.id_sedes_ips id,nom_sedes
											FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
																			 INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
																			 INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
																			 INNER JOIN sedes_ips e on (e.id_sedes_ips=b.id_sedes_ips)

											WHERE  c.estado_m_fmedhosp='solicitado' and b.estado_adm_hosp='Activo'
																															and b.tipo_servicio='Hospitalario'
																															and d.estado_med='Solicitado'
																															and b.id_sedes_ips in ($sede)
																															and fejecucion_final >='$f1'
											ORDER BY e.nom_sedes";

								}


									//echo $sql;
						if ($tabla=$bd1->sub_tuplas($sql)){
							//echo $sql;
							foreach ($tabla as $fila ) {
								if ($reporte==1) {

										echo"<tr >\n";
										echo'<td class="text-left">'.$fila["paciente"].' <br><strong>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].'</td>';
										echo'<td class="text-center">'.$fila["fingreso_hosp"].'</td>';
										if ($fila['habi']=='') {
											echo'<td class="text-center alert-danger">Paciente sin ubicación</td>';
										}else {
											echo'<td class="text-left "><strong>'.$fila["habi"].'</strong></td>';
										}
										if ($fila['tipo_formula']=='Programada') {
											echo'<td class="text-center ">
															<p class="alert alert-success"><strong>Formula: </strong>'.$fila["tipo_formula"].'</p>
															<p><strong>Desde:</strong>'.$fila["formula_desde"].'</p>
															<p><strong>Hasta:</strong>'.$fila["formula_hasta"].'</p>
												   </td>';
										}
										if ($fila['tipo_formula']=='Evento') {
											echo'<td class="text-center ">
															<p class="alert alert-danger"><strong>Formula: </strong>'.$fila["tipo_formula"].'</p>
															<p><strong>Desde:</strong>'.$fila["formula_desde"].'</p>
															<p><strong>Hasta:</strong>'.$fila["formula_hasta"].'</p>
												   </td>';
										}

										echo'<td class="text-center">
													<article class="col-xs-12">'.$fila["medicamento"].'<br> '.$fila["via"].'<br> '.$fila["frecuencia"].'</article>
														<article class="col-xs-3 borde_p"><strong>6am-8am</strong>: '.$fila["dosis1"].'</article>
														<article class="col-xs-3 borde_p"><strong>12m-2pm</strong>: '.$fila["dosis2"].'</article>
														<article class="col-xs-3 borde_p"><strong>6pm-8pm</strong>: '.$fila["dosis3"].'</article>
														<article class="col-xs-3 borde_p"><strong>10pm-12pm</strong>: '.$fila["dosis4"].'</article>
												 </td>';
										echo "</tr>\n";
										echo "<tr>\n";
										echo "</tr>\n";
								}
								if ($reporte==2) {

									if ($fila["id_d_fmedhosp"]!='') {
						  			echo"<tr >\n";
						        echo'<td class="text-center"><strong>'.$fila["nom_sedes"].'</strong></td>';
						          echo'<td class="text-center">
						                <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
						                <p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>';
						          echo'</td>';
						  				echo'<th class="text-center">'.$fila["id_d_fmedhosp"].' '.$fila["medicamento"].' <br> '.$fila["via"].' <br> '.$fila["frecuencia"].' Horas</th>';
						  			if ($fila['dosis1']==0) {
						  						echo'<td colspan="3" class="text-center"><h5><u>'.$fila["dosis1"].'</u></h5></td>';
						  					}
						  			if ($fila['dosis1']>0) {
						  					echo'<td class="text-center alert-info col-xs-3"><span class="badge"> '.$fila["dosis1"].'</span></td>';

						  			       $sql2="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
						  														 b.id_adm_hosp,
						  						        			 	 c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,
						  						        			 	 d.id_d_fmedhosp,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4,obsfmedhosp,
						  													 	 e.id_dosi_med, freg_farmacia, nom_dosi, cant_dosi, estado_dosi, obs_dosi,cant_admin,hora_admin,estado_admin
						  							FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
						  						                         INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
						  						            						 INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
						  						            						 LEFT JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
						  							WHERE e.id_d_fmedhosp='".$fila['id_d_fmedhosp']."'
														and c.estado_m_fmedhosp='solicitado'
														and e.nom_dosi='6am-8am' and freg_farmacia='$f1'";
						  										//echo $sql2;

						  						if ($tabla2=$bd1->sub_tuplas($sql2)){
						  							foreach ($tabla2 as $fila2 ) {
															//print_r($sql2);
															$estado1=$fila2['estado_dosi'];
															$estado2=$fila2['estado_admin'];
															echo $estado2;
															if ($estado1=='Dosificado') {
						                    echo'<td class="text-center  col-xs-3">
						                          <p><span class="badge">'.$fila2["cant_dosi"].'</span></p>
																			<p><span class="fa fa-check fa-2x text-success animated zoomIn"></span></p>
						                         </td>';
						                  }else {
																echo'<td class="text-center col-xs-3">
						                          <p><span class="fa fa-ban"></p>
						                         </td>';
						                  }

						                  if ($estado2=='Administrado') {
						                    echo'<td class="text-center  col-xs-3">
						                          <p><span class="badge">'.$fila2["cant_admin"].'</span></p>
						                          <p><span class="fa fa-check fa-2x text-success animated zoomIn"></span></p>
						                         </td>';
						                  }
						                  if ($estado2=='Devuelto') {
						                    echo'<td class="text-center  col-xs-3">
						                          <p><span class="badge">'.$fila2["cant_admin"].'</span></p>
						                          <p><span class="fa fa-mail-reply fa-2x text-danger animated zoomIn"></span></p>
						                         </td>';
						                  }
						                  if ($estado2=='') {
						                    echo'<td class="text-center  col-xs-3">
						                          <p><span class="fa fa-ban"></p>
						                         </td>';
						                  }
						  							}
						  						}
						  					}
						    if ($fila['dosis2']==0) {
											echo'<td colspan="3" class="text-center"><h5><u>'.$fila["dosis2"].'</u></h5></td>';
										}
								if ($fila['dosis2']>0) {
										echo'<td class="text-center alert-info col-xs-3"><span class="badge"> '.$fila["dosis2"].'</span></td>';
								       $sql2="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
																			 b.id_adm_hosp,
											        			 	 c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,
											        			 	 d.id_d_fmedhosp,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4,obsfmedhosp,
																		 	 e.id_dosi_med, freg_farmacia, nom_dosi, cant_dosi, estado_dosi, obs_dosi,cant_admin,hora_admin,estado_admin
												FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
											                         INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
											            						 INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
											            						 LEFT JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
												WHERE e.id_d_fmedhosp='".$fila['id_d_fmedhosp']."' and c.estado_m_fmedhosp='solicitado'
												and e.nom_dosi='12m-2pm' and freg_farmacia='$f1'";
															//echo $sql2;
											if ($tabla2=$bd1->sub_tuplas($sql2)){
												foreach ($tabla2 as $fila2 ) {
													$estado1=$fila2['estado_dosi'];
													$estado2=$fila2['estado_admin'];
													if ($estado1!='') {
														echo'<td class="text-center  col-xs-3">
																	<p><span class="badge">'.$fila2["cant_dosi"].'</span></p>
																	<p><span class="fa fa-check fa-2x text-success animated zoomIn"></span></p>
																 </td>';
													}else {
														echo'<td class="text-center  col-xs-3">
																	<p><span class="fa fa-ban"></p>
																 </td>';
													}

													if ($estado2=='Administrado') {
														echo'<td class="text-center  col-xs-3">
																	<p><span class="badge">'.$fila2["cant_admin"].'</span></p>
																	<p><span class="fa fa-check fa-2x text-success animated zoomIn"></span></p>
																 </td>';
													}
													if ($estado2=='Devuelto') {
														echo'<td class="text-center  col-xs-3">
																	<p><span class="badge">'.$fila2["cant_admin"].'</span></p>
																	<p><span class="fa fa-mail-reply fa-2x text-danger animated zoomIn"></span></p>
																 </td>';
													}
													if ($estado2=='') {
														echo'<td class="text-center  col-xs-3">
																	<p><span class="fa fa-ban"></p>
																 </td>';
													}
												}
											}
										}
						        if ($fila['dosis3']==0) {
						    					echo'<td colspan="3" class="text-center"><h5><u>'.$fila["dosis3"].'</u></h5></td>';
						    				}
						    		if ($fila['dosis3']>0) {
						    				echo'<td class="text-center alert-info col-xs-3"><span class="badge"> '.$fila["dosis3"].'</span></td>';
						    		       $sql2="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
						    													 b.id_adm_hosp,
						    					        			 	 c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,
						    					        			 	 d.id_d_fmedhosp,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4,obsfmedhosp,
						    												 	 e.id_dosi_med, freg_farmacia, nom_dosi, cant_dosi, estado_dosi, obs_dosi,cant_admin,hora_admin,estado_admin
						    						FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
						    					                         INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
						    					            						 INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
						    					            						 LEFT JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
						    						WHERE e.id_d_fmedhosp='".$fila['id_d_fmedhosp']."' and c.estado_m_fmedhosp='solicitado'
														and e.nom_dosi='6pm-8pm' and freg_farmacia='$f1'";
						    									//echo $sql2;
						    					if ($tabla2=$bd1->sub_tuplas($sql2)){
						    						foreach ($tabla2 as $fila2 ) {
															$estado1=$fila2['estado_dosi'];
															$estado2=$fila2['estado_admin'];
															if ($estado1!='') {
						                    echo'<td class="text-center  col-xs-3">
						                          <p><span class="badge">'.$fila2["cant_dosi"].'</span></p>
						                          <p><span class="fa fa-check fa-2x text-success animated zoomIn"></span></p>
						                         </td>';
						                  }else {
																echo'<td class="text-center  col-xs-3">
						                          <p><span class="fa fa-ban"></p>
						                         </td>';
						                  }

						                  if ($estado2=='Administrado') {
						                    echo'<td class="text-center  col-xs-3">
						                          <p><span class="badge">'.$fila2["cant_admin"].'</span></p>
						                          <p><span class="fa fa-check fa-2x text-success animated zoomIn"></span></p>
						                         </td>';
						                  }
						                  if ($estado2=='Devuelto') {
						                    echo'<td class="text-center  col-xs-3">
						                          <p><span class="badge">'.$fila2["cant_admin"].'</span></p>
						                          <p><span class="fa fa-mail-reply fa-2x text-danger animated zoomIn"></span></p>
						                         </td>';
						                  }
						                  if ($estado2=='') {
						                    echo'<td class="text-center  col-xs-3">
						                          <p><span class="fa fa-ban"></p>
						                         </td>';
						                  }
						    						}
						    					}
						    				}
						            if ($fila['dosis4']==0) {
						                  echo'<td colspan="3" class="text-center"><h5><u>'.$fila["dosis4"].'</u></h5></td>';
						                }
						            if ($fila['dosis4']>0) {
						                echo'<td class="text-center alert-info col-xs-3"><span class="badge"> '.$fila["dosis4"].'</span></td>';
						                   $sql2="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
						                                   b.id_adm_hosp,
						                                   c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,
						                                   d.id_d_fmedhosp,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4,obsfmedhosp,
						                                   e.id_dosi_med, freg_farmacia, nom_dosi, cant_dosi, estado_dosi, obs_dosi,cant_admin,hora_admin,estado_admin
						                    FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
						                                           INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
						                                           INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
						                                           LEFT JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
						                    WHERE e.id_d_fmedhosp='".$fila['id_d_fmedhosp']."' and c.estado_m_fmedhosp='solicitado'
																and e.nom_dosi='10pm-12pm' and freg_farmacia='$f1'";
						                          //echo $sql2;
						                  if ($tabla2=$bd1->sub_tuplas($sql2)){
						                    foreach ($tabla2 as $fila2 ) {
																	$estado1=$fila2['estado_dosi'];
																	$estado2=$fila2['estado_admin'];
																	if ($estado1=='Dosificado') {
								                    echo'<td class="text-center  col-xs-3">
								                          <p><span class="badge">'.$fila2["cant_dosi"].'</span></p>
								                          <p><span class="fa fa-check fa-2x text-success animated zoomIn"></span></p>
								                         </td>';
								                  }else {
																		echo'<td class="text-center  col-xs-3">
								                          <p><span class="fa fa-ban"></p>
								                         </td>';
								                  }

								                  if ($estado2=='Administrado') {
								                    echo'<td class="text-center  col-xs-3">
								                          <p><span class="badge">'.$fila2["cant_admin"].'</span></p>
								                          <p><span class="fa fa-check fa-2x text-success animated zoomIn"></span></p>
								                         </td>';
								                  }
								                  if ($estado2=='Devuelto') {
								                    echo'<td class="text-center  col-xs-3">
								                          <p><span class="badge">'.$fila2["cant_admin"].'</span></p>
								                          <p><span class="fa fa-mail-reply fa-2x text-danger animated zoomIn"></span></p>
								                         </td>';
								                  }
								                  if ($estado2=='') {
								                    echo'<td class="text-center  col-xs-3">
								                          <p><span class="fa fa-ban"></p>
								                         </td>';
								                  }
						                    }
						                  }
						                }
						  		 echo"</tr >\n";
						  		}
								}
								if ($reporte==3) {

										echo"<tr >\n";
										echo'<td class="text-center"><strong>'.$fila["doc_pac"].'</strong></td>';
										echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
										echo'<td class="text-center">'.$fila["tipo"].' </td>';
										echo'<td class="text-center">'.$fila["cuantos"].' </td>';
										echo"</tr>";
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
