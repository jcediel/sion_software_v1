
<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$docE="";$docA1="";$docA2="";
			if (isset($_FILES["foto"])){
				if (is_uploaded_file($_FILES["foto"]["tmp_name"])){
					$cfoto=explode(".",$_FILES["foto"]["name"]);
					$archivo=$_POST["nomdoc"].".".$cfoto[count($cfoto)-1];
					if(move_uploaded_file($_FILES["foto"]["tmp_name"],WEB.DOCPAC.$archivo)){
						$docE=",foto='".DOCPAC.$archivo."'";
						$docA=',foto';
						$docb=",'".DOCPAC.$archivo."'";
						}
				}
			}
			switch ($_POST["operacion"]) {

				case 'DOC':
					$sql="INSERT INTO info_documentacion (id_paciente,nombre_doc$docA)
					VALUES ('".$_POST["idpac"]."','".$_POST["nomdoc"]."'$docb)";
					$subtitulo="El soporte documental ";
					$subtitulo1="Cargado";
				break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo $subtitulo1 con exito!";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="$subtitulo NO fue $subtitulo1 !!! .";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'DOC':
			$sql="SELECT a.id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento, edad, uedad, dir_pac, tel_pac, email_pac, estadocivil,
									 genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac, cie, descricie, zonapac, ipsordena,
									 b.id_adm_hosp
						FROM pacientes a LEFT JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
						WHERE a.id_paciente=".$_GET["idpac"];
						//echo $sql;
			$color="green";
			$boton="Cargar Documento";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$option=187;
			$doc=$_REQUEST['doc'];
			$servicio=$_REQUEST['servicio'];
			$form1='formulariosDOM/presentacion/add_documentos.php';
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
			<h3>INFORME DE CONTROL SERVICIO DOMICILIARIO</h3>
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
							<option value="1">Consolidado terapias X pacientes</option>
							<option value="2">Consolidado Valoraciones</option>
							<option value="3">Consolidado DOWNTON</option>
							<option value="4">Consolidado BARTHEL</option>
							<option value="5">Consolidado NORTON</option>
							<option value="6">Consolidado Encuesta</option>
							<option value="7">Plan de intervencion medicina general</option>
							<option value="8">Control Documental</option>
							<option value="9">Consolidado Ronda</option>
							<option value="10">Consolidado Visita de enfermeria</option>
							<option value="11">Capacidad instalada sanitas</option>
							<option value="12">Que triana sea feliz</option>
							<option value="13">pacientes vs evoluciones</option>

						</select>
					</article>
					<article class="col-xs-3">
		        <label for="">Seleccione TIPO PACIENTE:</label>
		        <select class="form-control input-sm" required="" name="tpac">
		          <option value="1,2,3,4">Todas</option>
		          <?php
		          $sql="SELECT id_cusuario,nomclaseusuario from clase_usuario ORDER BY id_cusuario ASC";
		          if($tabla=$bd1->sub_tuplas($sql)){
		            foreach ($tabla as $fila2) {
		              if ($fila["id_cusuario"]==$fila2["id_cusuario"]){
		                $sw=' selected="selected"';
		              }else{
		                $sw="";
		              }
		            echo '<option value="'.$fila2["id_cusuario"].'"'.$sw.'>'.$fila2["nomclaseusuario"].'</option>';
		            }
		          }
		          ?>
		        </select>
		      </article>
					<article class="col-xs-3">
		        <label for="">Seleccione SEDE:</label>
		        <select class="form-control input-sm" required="" name="sede">
		          <option value="9,10">Todas</option>
		          <?php
		          $sql="SELECT id_sedes_ips,nom_sedes from sedes_ips where id_sedes_ips in (9,10) and estado_sedes='Activo' ORDER BY id_sedes_ips ASC";
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
			$sede=$_REQUEST['sede'];
				if ($reporte==1) {
					echo'<table class="table table-bordered">
								<tr>
									<th>INFORME DE CONSOLIDADO TERAPIAS</th>
									<td class="text-right">
									<a href="rptexcel/DOM/rptDom1.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
									<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>

									</td>
								</tr>
					</table>';
					echo'<table class="table table-bordered table-responsive table-hover">
          <tr>
            <th>PACIENTE</th>
            <th>ADMISION</th>
            <th>PROCEDIMIENTO</th>
            <th>SESIONES</th>
            <th>PROFEISONAL</th>
          </tr>
						';
						$f1=$_REQUEST['fecha1'];
						$f2=$_REQUEST['fecha2'];
						if ($f1=='') {
							$doc=$_REQUEST['doc'];
							if ($doc=='') {
								$sql="SELECT month(current_date),h.nom_eps,b.doc_pac, b.nom_completo,b.tel_pac,b.dir_pac,
																				c.tipo_usuario,c.mun_residencia,c.dep_residencia,i.descrimuni,c.zona_residencia,
					    													IFNULL(c.id_adm_hosp,0),
																				d.id_m_aut_dom,d.dx_presentacion,
																				IFNULL(e.id_d_aut_dom,0),e.freg, e.cups, e.procedimiento, e.cantidad, e.finicio, e.ffinal,
					       												e.num_aut_externa, e.estado_d_aut_dom, e.intervalo,
					       												e.temporalidad,
																				h.nom_eps,
																				j.nom_sedes,
																				k.nomclaseusuario,
					    													cantidad_sesion_dom(e.cups,c.id_adm_hosp,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones
																FROM adm_hospitalario c  INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
					    																					 INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom)
					     																					 INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
					    																			 		 INNER JOIN eps h on (h.id_eps = c.id_eps)
																												  INNER JOIN sedes_ips j on (j.id_sedes_ips = c.id_sedes_ips)
																													INNER JOIN clase_usuario k on (k.id_cusuario = d.tipo_paciente)
					    																			 	   LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)

																WHERE c.tipo_servicio= 'Domiciliarios' and c.id_eps in ($eps)
																																			 and c.id_sedes_ips in ($sede)
																																			 and c.estado_adm_hosp = 'Activo'
																																			 and estado_d_aut_dom in (1,2,3)
																ORDER BY sesiones ASC,doc_pac ASC ";
							}else {
								$sql="SELECT month(current_date),h.nom_eps,b.doc_pac, b.nom_completo,b.tel_pac,b.dir_pac,
																				c.tipo_usuario,c.mun_residencia,c.dep_residencia,i.descrimuni,c.zona_residencia,
					    													IFNULL(c.id_adm_hosp,0),
																				d.id_m_aut_dom,d.dx_presentacion,
																				IFNULL(e.id_d_aut_dom,0),e.freg, e.cups, e.procedimiento, e.cantidad, e.finicio, e.ffinal,
					       												e.num_aut_externa, e.estado_d_aut_dom, e.intervalo,
					       												e.temporalidad,
																				h.nom_eps,
																				j.nom_sedes,
																				k.nomclaseusuario,
					    													cantidad_sesion_dom(e.cups,c.id_adm_hosp,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones
																FROM adm_hospitalario c  INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
					    																					 INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom)
					     																					 INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
					    																			 		 INNER JOIN eps h on (h.id_eps = c.id_eps)
																												  INNER JOIN sedes_ips j on (j.id_sedes_ips = c.id_sedes_ips)
																													INNER JOIN clase_usuario k on (k.id_cusuario = d.tipo_paciente)
					    																			 	   LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)

																WHERE  b.doc_pac='$doc' and c.tipo_servicio= 'Domiciliarios' and c.id_eps in ($eps) and c.id_sedes_ips in ($sede)
																																			 and c.estado_adm_hosp = 'Activo'
																																			 and estado_d_aut_dom in (1,2,3)
																ORDER BY sesiones ASC,doc_pac ASC ";
							}

						}else {
							$doc=$_REQUEST['doc'];
							if ($doc=='') {
								$sql="SELECT month(current_date),h.nom_eps,b.tdoc_pac,b.doc_pac, b.nom_completo,b.tel_pac,b.dir_pac,
																				c.tipo_usuario,c.mun_residencia,c.dep_residencia,i.descrimuni,c.zona_residencia,
																				IFNULL(c.id_adm_hosp,0),
																				d.id_m_aut_dom,d.dx_presentacion,
																				IFNULL(e.id_d_aut_dom,0),e.freg, e.cups, e.procedimiento, e.cantidad, e.finicio, e.ffinal,
																				e.num_aut_externa, e.estado_d_aut_dom, e.intervalo,
																				e.temporalidad,
																				h.nom_eps,
																				j.nom_sedes,
																				k.nomclaseusuario,
																				cantidad_sesion_dom(e.cups,c.id_adm_hosp,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones
																FROM adm_hospitalario c  INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
																												 INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom)
																												 INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
																												 INNER JOIN eps h on (h.id_eps = c.id_eps)
																												 INNER JOIN sedes_ips j on (j.id_sedes_ips = c.id_sedes_ips)
																												 INNER JOIN clase_usuario k on (k.id_cusuario = d.tipo_paciente)
																												 LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)

																WHERE c.tipo_servicio= 'Domiciliarios' and c.id_eps in ($eps) and c.id_sedes_ips in ($sede)
																																			 and c.estado_adm_hosp = 'Activo'
																																			 and e.ffinal BETWEEN '$f1' and  '$f2'
																																			 and estado_d_aut_dom in (1,2,3)
																ORDER BY sesiones ASC,doc_pac ASC ";
							}else {
								$sql="SELECT month(current_date),h.nom_eps,b.tdoc_pac,b.doc_pac, b.nom_completo,b.tel_pac,b.dir_pac,
																				c.tipo_usuario,c.mun_residencia,c.dep_residencia,i.descrimuni,c.zona_residencia,
																				IFNULL(c.id_adm_hosp,0),
																				d.id_m_aut_dom,d.dx_presentacion,
																				IFNULL(e.id_d_aut_dom,0),e.freg, e.cups, e.procedimiento, e.cantidad, e.finicio, e.ffinal,
																				e.num_aut_externa, e.estado_d_aut_dom, e.intervalo,
																				e.temporalidad,
																				h.nom_eps,
																				j.nom_sedes,
																				k.nomclaseusuario,
																				cantidad_sesion_dom(e.cups,c.id_adm_hosp,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones
																FROM adm_hospitalario c  INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
																												 INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom)
																												 INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
																												 INNER JOIN eps h on (h.id_eps = c.id_eps)
																												  INNER JOIN sedes_ips j on (j.id_sedes_ips = c.id_sedes_ips)
																													INNER JOIN clase_usuario k on (k.id_cusuario = d.tipo_paciente)
																												 LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)

																WHERE  b.doc_pac='$doc' and c.tipo_servicio= 'Domiciliarios' and c.id_eps in ($eps) and c.id_sedes_ips in ($sede)
																																			 and c.estado_adm_hosp = 'Activo'
																																			 and e.ffinal BETWEEN '$f1' and  '$f2'
																																			 and estado_d_aut_dom in (1,2,3)
																ORDER BY sesiones ASC,doc_pac ASC ";
							}
						}
					}


							if ($reporte==2) {
								echo'<table class="table table-bordered">
											<tr>
												<th>INFORME DE CONSOLIDADO VALORACIONES</th>
												<td class="text-right">
												<a href="rptexcel/DOM/rptDom2.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
												<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
												<a href="rptpdf/DOM/rptDom2.php?f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
												<button type="button" class="btn btn-danger " ><span class="fa fa-file-pdf-o"></span> Exportar pdf</button></a>
												</td>
											</tr>
								</table>';
								echo'<table class="table table-bordered table-responsive table-hover">
			          <tr>
			            <th>PACIENTE</th>
			            <th>FECHA</th>
			            <th>MEDICO</th>
			            <th>DX</th>
			            <th></th>
			          </tr>
									';
									$sql="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
			                         b.id_adm_hosp,
			                         c.freg_hchosp,dxp,tdxp,dx1,tdx1,dx2,tdx2,dx3,tdx3,
			                         d.nombre,
			                         h.nom_sedes,
			                         g.nom_eps
			                  FROM pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
			                                   left join hcini_dom c on c.id_adm_hosp=b.id_adm_hosp
			                                   left join user d on d.id_user=c.id_user
			                                   left join sedes_ips h on h.id_sedes_ips=b.id_sedes_ips
			                                   left join eps g on g.id_eps=b.id_eps

			                  WHERE b.id_eps in ($eps) and b.id_sedes_ips in ($sede)
			                                           and c.freg_hchosp BETWEEN '$f1' and '$f2'
			                                           and b.estado_adm_hosp='Activo'
			                                           and b.tipo_servicio='Domiciliarios' ";

									}
									if ($reporte==3) {
										echo'<table class="table table-bordered">
													<tr>
														<th>CONSOLIDADO DE ESCALA DOWNTON</th>
														<td class="text-right">
														<a href="rptexcel/DOM/rptDom3.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
														<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
														<a href="rptpdf/DOM/rptDom3.php?f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
														<button type="button" class="btn btn-danger " ><span class="fa fa-file-pdf-o"></span> Exportar pdf</button></a>
														</td>
													</tr>
										</table>';
										echo'<table class="table table-bordered">
													<tr>
														<th>
															<button type="button" class="btn btn-info btn-priamry" data-toggle="modal" data-target="#graficosdownton">Consulte Gráficos</button>';
															include('graficos_dom/rptDom3.php');
											 echo'</th>
													</tr>
										</table>';

										echo'<table class="table table-bordered table-responsive table-hover">
					          <tr>
											<th>#</th>
					            <th>PACIENTE</th>
					            <th>DETALLES</th>
					            <th>OBSERVACION</th>
					            <th>RESPONSABLE</th>
					          </tr>
											';
											if ($doc=='') {
												$sql="SELECT a.tdoc_pac,doc_pac,nom_completo,fnacimiento,
																		 b.id_adm_hosp,
																	   c.freg fescala,hreg,total,criterio_total,sugerencia,c.estado ,
																     d.nombre

																FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																			     		   INNER JOIN escala_downton c on c.id_adm_hosp=b.id_adm_hosp
																                 INNER JOIN user d on d.id_user=c.id_user

																WHERE b.id_eps in ($eps) and b.id_sedes_ips in ($sede) and
																			c.freg BETWEEN '$f1' and '$f2' and c.estado is null
																ORDER BY total DESC ";
											}else {
												$sql="SELECT a.tdoc_pac,doc_pac,nom_completo,fnacimiento,
																		 b.id_adm_hosp,
																	   c.freg fescala,hreg,total,criterio_total,sugerencia,c.estado ,
																     d.nombre,
																		 e.dx_presentacion
																FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																			     			 INNER JOIN escala_downton c on c.id_adm_hosp=b.id_adm_hosp
																                 INNER JOIN user d on d.id_user=c.id_user

																WHERE a.doc_pac='$doc' and b.id_eps in ($eps) and b.id_sedes_ips in ($sede) and
																			c.freg BETWEEN '$f1' and '$f2' and c.estado is null
																ORDER BY total DESC ";
											}


									}
									if ($reporte==4) {
										echo'<table class="table table-bordered">
													<tr>
														<th>CONSOLIDADO DE ESCALA BARTHEL</th>
														<td class="text-right">
														<a href="rptexcel/DOM/rptDom4.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
														<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
														<a href="rptpdf/DOM/rptDom4.php?f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
														<button type="button" class="btn btn-danger " ><span class="fa fa-file-pdf-o"></span> Exportar pdf</button></a>
														</td>
													</tr>
										</table>';
										echo'<table class="table table-bordered">
													<tr>
														<th>
															<button type="button" class="btn btn-info btn-priamry" data-toggle="modal" data-target="#graficosbarthel">Consulte Gráficos</button>';
															include('graficos_dom/rptDom4.php');
											 echo'</th>
													</tr>
										</table>';
										echo'<table class="table table-bordered table-responsive table-hover">
					          <tr>
											<th>#</th>
					            <th>PACIENTE</th>
					            <th>DETALLES</th>
					            <th>OBSERVACION</th>
					            <th>RESPONSABLE</th>
					          </tr>
											';
											if ($doc=='') {
												$sql="SELECT a.tdoc_pac,doc_pac,nom_completo,fnacimiento,
																		 b.id_adm_hosp,
																	   c.freg fescala,hreg,total,calificacion_total,observacion,c.estado ,
																     d.nombre
																FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																			     INNER JOIN escala_barthel c on c.id_adm_hosp=b.id_adm_hosp
																                 INNER JOIN user d on d.id_user=c.id_user
																WHERE b.id_eps in ($eps) and b.id_sedes_ips in ($sede) and
																			c.freg BETWEEN '$f1' and '$f2' and c.estado is null
																ORDER BY total ASC ";
											}else {
												$sql="SELECT a.tdoc_pac,doc_pac,nom_completo,fnacimiento,
																		 b.id_adm_hosp,
																	   c.freg fescala,hreg,total,calificacion_total,observacion,c.estado ,
																     d.nombre
																FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																			     INNER JOIN escala_barthel c on c.id_adm_hosp=b.id_adm_hosp
																                 INNER JOIN user d on d.id_user=c.id_user

																WHERE a.doc_pac='$doc' and b.id_eps in ($eps) and b.id_sedes_ips in ($sede) and
																			c.freg BETWEEN '$f1' and '$f2' and c.estado is null
																ORDER BY total ASC ";
											}


											}
											if ($reporte==5) {
												echo'<table class="table table-bordered">
															<tr>
																<th>CONSOLIDADO DE ESCALA NORTON</th>
																<td class="text-right">
																<a href="rptexcel/DOM/rptDom5.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
																<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
																<a href="rptpdf/DOM/rptDom3.php?f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
																<button type="button" class="btn btn-danger " ><span class="fa fa-file-pdf-o"></span> Exportar pdf</button></a>
																</td>
															</tr>
												</table>';
												echo'<table class="table table-bordered">
															<tr>
																<th>
																	<button type="button" class="btn btn-info btn-priamry" data-toggle="modal" data-target="#graficosnorton">Consulte Gráficos</button>';
																	include('graficos_dom/rptDom5.php');
													 echo'</th>
															</tr>
												</table>';
												echo'<table class="table table-bordered table-responsive table-hover">
							          <tr>
													<th>#</th>
							            <th>PACIENTE</th>
							            <th>DETALLES</th>
							            <th>OBSERVACION</th>
							            <th>RESPONSABLE</th>
							          </tr>
													';
													if ($doc=='') {
														$sql="SELECT a.tdoc_pac,doc_pac,nom_completo,fnacimiento,
																				 b.id_adm_hosp,
																			   c.freg fescala,hreg,total,riesgo,observacion,c.estado ,
																		     d.nombre
																		FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																					     INNER JOIN escala_norton c on c.id_adm_hosp=b.id_adm_hosp
																		                 INNER JOIN user d on d.id_user=c.id_user
																		WHERE b.id_eps in ($eps) and b.id_sedes_ips in ($sede) and
																					c.freg BETWEEN '$f1' and '$f2' and c.estado is null
																		ORDER BY total ASC ";
													}else {
														$sql="SELECT a.tdoc_pac,doc_pac,nom_completo,fnacimiento,
																				 b.id_adm_hosp,
																			   c.freg fescala,hreg,total,riesgo,observacion,c.estado ,
																		     d.nombre
																		FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																					     INNER JOIN escala_norton c on c.id_adm_hosp=b.id_adm_hosp
																		                 INNER JOIN user d on d.id_user=c.id_user

																		WHERE a.doc_pac='$doc' and b.id_eps in ($eps) and b.id_sedes_ips in ($sede) and
																					c.freg BETWEEN '$f1' and '$f2' and c.estado is null
																		ORDER BY total ASC ";
													}


													}
													if ($reporte==6) {
														echo'<table class="table table-bordered">
																	<tr>
																		<th>CONSOLIDADO ENCUESTA DE SATISFACCION</th>
																		<td class="text-right">
																		<a href="rptexcel/DOM/rptDom6.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
																		<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
																		<a href="rptpdf/DOM/rptDom6.php?f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
																		<button type="button" class="btn btn-danger " ><span class="fa fa-file-pdf-o"></span> Exportar pdf</button></a>
																		</td>
																	</tr>
														</table>';
														echo'<table class="table table-bordered">
																	<tr>
																		<th>
																			<button type="button" class="btn btn-info btn-priamry" data-toggle="modal" data-target="#graficosnorton">Consulte Gráficos</button>';
																			include('graficos_dom/rptDom6.php');
															 echo'</th>
																	</tr>
														</table>';
														echo'<table class="table table-bordered table-responsive table-hover">
									          <tr>
															<th>#</th>
									            <th>PACIENTE</th>
									            <th>DETALLES</th>
									            <th>OBSERVACION</th>
									            <th>RESPONSABLE</th>
									          </tr>
															';
															if ($doc=='') {
																$sql="SELECT d.nom_eps,b.tipo_servicio,a.freg_encuesta,c.tdoc_pac,c.doc_pac,c.nom_completo,c.fnacimiento,
															              TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad,
															               e.nombre usuario,
															                a.pregunta1,a.valor1,a.pregunta2,a.valor2,a.pregunta3,a.valor3,a.pregunta4,a.valor4,
															                a.pregunta5,a.valor5,a.pregunta6,a.valor6,a.pregunta7,a.valor7,a.pregunta8,a.valor8,a.pregunta9,
															                a.valor9,a.pregunta10,a.valor10,a.pregunta11,a.valor11,a.pregunta12,a.valor12,a.pregunta13,
															                a.valor13,a.pregunta14,a.valor14,a.pregunta15,a.valor15,a.pregunta16,a.valor16,a.pregunta17,
															                a.valor17,a.pregunta18,a.valor18,a.pregunta19,a.valor19,a.pregunta20,a.valor20,a.pregunta21,
															                a.valor21,a.pregunta22,a.valor22,a.pregunta23,a.valor23,a.pregunta24,a.valor24,a.pregunta25,
															                a.valor25,a.pregunta26,a.valor26,a.pregunta27,a.valor27,a.pregunta28,a.valor28,a.pregunta29,
															              a.valor29,a.pregunta30,a.valor30,a.pregunta31,a.valor31,a.pregunta32,a.valor32,a.pregunta33,
															              a.valor33,a.obs33,a.pregunta34,valor34
															      FROM encuesta_dom a,adm_hospitalario b,pacientes c,eps d,user e
															      WHERE b.id_eps =d.id_eps and
															            a.freg_encuesta BETWEEN '$f1' and '$f2'
															            and b.tipo_servicio = 'Domiciliarios'
															            and b.id_adm_hosp = a.id_adm_hosp
															            and c.id_paciente = b.id_paciente
															            and e.id_user = a.id_user";
															}else {
																$sql="SELECT d.nom_eps,b.tipo_servicio,a.freg_encuesta,c.tdoc_pac,c.doc_pac,c.nom_completo,c.fnacimiento,
															              TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad,
															               e.nombre usuario,
															                a.pregunta1,a.valor1,a.pregunta2,a.valor2,a.pregunta3,a.valor3,a.pregunta4,a.valor4,
															                a.pregunta5,a.valor5,a.pregunta6,a.valor6,a.pregunta7,a.valor7,a.pregunta8,a.valor8,a.pregunta9,
															                a.valor9,a.pregunta10,a.valor10,a.pregunta11,a.valor11,a.pregunta12,a.valor12,a.pregunta13,
															                a.valor13,a.pregunta14,a.valor14,a.pregunta15,a.valor15,a.pregunta16,a.valor16,a.pregunta17,
															                a.valor17,a.pregunta18,a.valor18,a.pregunta19,a.valor19,a.pregunta20,a.valor20,a.pregunta21,
															                a.valor21,a.pregunta22,a.valor22,a.pregunta23,a.valor23,a.pregunta24,a.valor24,a.pregunta25,
															                a.valor25,a.pregunta26,a.valor26,a.pregunta27,a.valor27,a.pregunta28,a.valor28,a.pregunta29,
															              a.valor29,a.pregunta30,a.valor30,a.pregunta31,a.valor31,a.pregunta32,a.valor32,a.pregunta33,
															              a.valor33,a.obs33,a.pregunta34,valor34
															      FROM encuesta_dom a,adm_hospitalario b,pacientes c,eps d,user e
															      WHERE b.id_eps =d.id_eps and
															            a.freg_encuesta BETWEEN '$f1' and '$f2'
															            and b.tipo_servicio = 'Domiciliarios'
															            and b.id_adm_hosp = a.id_adm_hosp
															            and c.id_paciente = b.id_paciente
															            and e.id_user = a.id_user";
															}


															}
															if ($reporte==7) {
																echo'<table class="table table-bordered">
																			<tr>
																				<th>PLAN TRATAMIENTO MEDICINA GENERAL DOMICILIARIOS</th>
																				<td class="text-right">
																				<a href="rptexcel/DOM/rptDom7.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
																				<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
																				<a href="rptpdf/DOM/rptDom7.php?f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
																				<button type="button" class="btn btn-danger " ><span class="fa fa-file-pdf-o"></span> Exportar pdf</button></a>
																				</td>
																			</tr>
																</table>';

																echo'<table class="table table-bordered table-responsive table-hover">
																<tr>
																	<th>#</th>
																	<th>PACIENTE</th>
																	<th>PLAN</th>
																	<th>DETALLES</th>
																	<th>RESPONSABLE</th>
																</tr>
																	';
																	if ($doc=='') {
																		$sql="SELECT a.tdoc_pac,doc_pac,nom_completo,fnacimiento,
																								 b.id_adm_hosp,
																								 c.freg_hchosp,plan_manejo,cant_valmed,periodo_valmed,cant_enfer,temp_valenf,periodo_valenf,cant_fisio,cant_fono,cant_to,cant_resp,
																								 d.nombre
																						FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																											 			 INNER JOIN hcini_dom c on c.id_adm_hosp=b.id_adm_hosp
																														 INNER JOIN user d on d.id_user=c.id_user
																						WHERE b.id_eps in ($eps) and b.id_sedes_ips in ($sede) and
																									c.freg_hchosp BETWEEN '$f1' and '$f2'
																						ORDER BY freg_hchosp DESC ";
																	}else {
																		$sql="SELECT a.tdoc_pac,doc_pac,nom_completo,fnacimiento,
																								 b.id_adm_hosp,
																								 c.freg_hchosp,plan_manejo,cant_valmed,periodo_valmed,cant_enfer,temp_valenf,periodo_valenf,cant_fisio,cant_fono,cant_to,cant_resp,
																								 d.nombre
																						FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																											 			 INNER JOIN hcini_dom c on c.id_adm_hosp=b.id_adm_hosp
																														 INNER JOIN user d on d.id_user=c.id_user
																						WHERE a.doc_pac='$doc' and b.id_eps in ($eps) and b.id_sedes_ips in ($sede) and
																									c.freg_hchosp BETWEEN '$f1' and '$f2'
																						ORDER BY freg_hchosp DESC  ";
																	}
																}
																if ($reporte==8) {
																	echo'<table class="table table-bordered table-responsive table-hover" >
																		<tr>
																			<th>#</th>
																			<th>PACIENTE</th>
																			<th>IDENTIFICACION</th>
																			<th>INGRESO</th>
																			<th colspan="3">DOCUMENTACION</th>
																			<th></th>
																		</tr>';

																		$sql="SELECT 	c.nom_eps,
																									b.doc_pac,b.nom1,b.nom2,b.ape1,b.ape2,b.id_paciente,b.nom_completo,
																									a.fingreso_hosp, a.fegreso_hosp,a.id_adm_hosp

																					FROM pacientes b inner join adm_hospitalario a on a.id_paciente=b.id_paciente
																													 inner join eps c on c.id_eps=a.id_eps
																				  WHERE  b.id_paciente = a.id_paciente AND a.tipo_servicio = 'Domiciliarios'
																																						   AND c.id_eps = a.id_eps
																					ORDER BY 2 DESC
																				";
																		$i=1;
																		}
																		if ($reporte==9) {
																			echo'<table class="table table-bordered">
																						<tr>
																							<th>CONSOLIDADO RONDA DE SEGURIDAD</th>
																							<td class="text-right">
																							<a href="rptexcel/DOM/rptDom8.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
																							<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
																							<a href="rptpdf/DOM/rptDom8.php?f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
																							<button type="button" class="btn btn-danger " ><span class="fa fa-file-pdf-o"></span> Exportar pdf</button></a>
																							</td>
																						</tr>
																			</table>';

																			echo'<table class="table table-bordered table-responsive table-hover">
														          <tr>
																				<th>#</th>
														            <th>PACIENTE</th>
														            <th>DETALLES</th>
														            <th>OBSERVACION</th>
														            <th>RESPONSABLE</th>
														          </tr>
																				';
																				if ($doc=='') {
																					$sql="SELECT d.nom_eps,b.tipo_servicio,a.freg_ronda,c.tdoc_pac,c.doc_pac,c.nom_completo,c.fnacimiento,
																				              TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad,
																				               e.nombre usuario,
																				                a.id_ronseg_dom, a.criterio1, a.valor1, a.obs1, a.criterio2, a.valor2, a.obs2, a.criterio3,
																				                a.valor3, a.obs3, a.criterio4, a.valor4, a.obs4, a.criterio5, a.valor5, a.obs5, a.criterio6,
																				                a.valor6, a.obs6, a.criterio7, a.valor7, a.obs7, a.criterio8, a.valor8, a.obs8,
																				                a.criterio9, a.valor9, a.obs9, a.criterio10, a.valor10, a.obs10, a.criterio11, a.valor11,
																				                a.obs11, a.criterio12, a.valor12, a.obs12, a.criterio13, a.valor13, a.obs13, a.criterio14,
																				                a.valor14, a.obs14, a.criterio15, a.valor15, a.obs15, a.criterio16, a.valor16, a.obs16,
																				                a.criterio17, a.valor17, a.obs17, a.criterio18, a.valor18, a.obs18, a.criterio19, a.valor19,
																				                a.obs19, a.criterio20, a.valor20, a.obs20, a.criterio21, a.valor21, a.obs21, a.criterio22,
																				                a.valor22, a.obs22, a.criterio23, a.valor23, a.obs23, a.criterio24, a.valor24, a.obs24,
																				                a.criterio25, a.valor25, a.obs25, a.criterio26, a.valor26, a.obs26, a.criterio27, a.valor27,
																				                a.obs27, a.criterio28, a.valor28, a.obs28, a.criterio29, a.valor29, a.obs29, a.criterio30, a.valor30, a.obs30
																				      FROM ronda_seguridad a,adm_hospitalario b,pacientes c,eps d,user e
																				      WHERE b.id_eps =d.id_eps and
																				            a.freg_ronda BETWEEN '$f1' and '$f2'
																				            and b.tipo_servicio = 'Domiciliarios'
																				            and b.id_adm_hosp = a.id_adm_hosp
																				            and c.id_paciente = b.id_paciente
																				            and e.id_user = a.id_user";
																				}else {
																					$sql="SELECT d.nom_eps,b.tipo_servicio,a.freg_ronda,c.tdoc_pac,c.doc_pac,c.nom_completo,c.fnacimiento,
																				              TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad,
																				               e.nombre usuario,
																				                a.id_ronseg_dom, a.criterio1, a.valor1, a.obs1, a.criterio2, a.valor2, a.obs2, a.criterio3,
																				                a.valor3, a.obs3, a.criterio4, a.valor4, a.obs4, a.criterio5, a.valor5, a.obs5, a.criterio6,
																				                a.valor6, a.obs6, a.criterio7, a.valor7, a.obs7, a.criterio8, a.valor8, a.obs8,
																				                a.criterio9, a.valor9, a.obs9, a.criterio10, a.valor10, a.obs10, a.criterio11, a.valor11,
																				                a.obs11, a.criterio12, a.valor12, a.obs12, a.criterio13, a.valor13, a.obs13, a.criterio14,
																				                a.valor14, a.obs14, a.criterio15, a.valor15, a.obs15, a.criterio16, a.valor16, a.obs16,
																				                a.criterio17, a.valor17, a.obs17, a.criterio18, a.valor18, a.obs18, a.criterio19, a.valor19,
																				                a.obs19, a.criterio20, a.valor20, a.obs20, a.criterio21, a.valor21, a.obs21, a.criterio22,
																				                a.valor22, a.obs22, a.criterio23, a.valor23, a.obs23, a.criterio24, a.valor24, a.obs24,
																				                a.criterio25, a.valor25, a.obs25, a.criterio26, a.valor26, a.obs26, a.criterio27, a.valor27,
																				                a.obs27, a.criterio28, a.valor28, a.obs28, a.criterio29, a.valor29, a.obs29, a.criterio30, a.valor30, a.obs30
																				      FROM ronda_seguridad a,adm_hospitalario b,pacientes c,eps d,user e
																				      WHERE b.id_eps =d.id_eps and c.doc_pac='$doc'
																				            a.freg_ronda BETWEEN '$f1' and '$f2'
																				            and b.tipo_servicio = 'Domiciliarios'
																				            and b.id_adm_hosp = a.id_adm_hosp
																				            and c.id_paciente = b.id_paciente
																				            and e.id_user = a.id_user";
																				}


																				}
																				if ($reporte==10) {
																					echo'<table class="table table-bordered">
																								<tr>
																									<th>CONSOLIDADO VISITA DE ENFERMERIA</th>
																									<td class="text-right">
																									<a href="rptexcel/DOM/rptDom10.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
																									<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
																									<a href="rptpdf/DOM/rptDom10.php?f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
																									<button type="button" class="btn btn-danger " ><span class="fa fa-file-pdf-o"></span> Exportar pdf</button></a>
																									</td>
																								</tr>
																					</table>';

																					echo'<table class="table table-bordered table-responsive table-hover">
																					<tr>
																						<th>#</th>
																						<th>PACIENTE</th>
																						<th>DETALLES</th>
																						<th>OBSERVACION</th>
																						<th>RESPONSABLE</th>
																					</tr>
																						';
																						if ($doc=='') {
																							$sql="SELECT d.nom_eps,b.tipo_servicio,a.freg,c.tdoc_pac,c.doc_pac,c.nom_completo,c.fnacimiento,
																													TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad,
																													 e.nombre usuario,
																														a.id_visita_dom,criterio1, criterio2, criterio3,
																														criterio4, criterio5, criterio6, criterio7, criterio8, criterio9, obs_visita
																									FROM visita_dom_enfermeria a,adm_hospitalario b,pacientes c,eps d,user e
																									WHERE b.id_eps =d.id_eps and
																												a.freg BETWEEN '$f1' and '$f2'
																												and b.tipo_servicio = 'Domiciliarios'
																												and b.id_adm_hosp = a.id_adm_hosp
																												and c.id_paciente = b.id_paciente
																												and e.id_user = a.id_user";
																						}else {
																							$sql="SELECT d.nom_eps,b.tipo_servicio,a.freg,c.tdoc_pac,c.doc_pac,c.nom_completo,c.fnacimiento,
																													TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad,
																													 e.nombre usuario,
																													 a.id_visita_dom, criterio1, criterio2, criterio3,
																													 criterio4, criterio5, criterio6, criterio7, criterio8, criterio9, obs_visita
																									FROM visita_dom_enfermeria a,adm_hospitalario b,pacientes c,eps d,user e
																									WHERE b.id_eps =d.id_eps and c.doc_pac='$doc'
																												a.freg BETWEEN '$f1' and '$f2'
																												and b.tipo_servicio = 'Domiciliarios'
																												and b.id_adm_hosp = a.id_adm_hosp
																												and c.id_paciente = b.id_paciente
																												and e.id_user = a.id_user";
																						}


																					}
																					if ($reporte==11) {
																						echo'<table class="table table-bordered">
																									<tr>
																										<th>CAPACIDAD INSTALADA (SANITAS)</th>
																										<td class="text-right">
																										<a href="rptexcel/DOM/rptDom11.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
																										<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
																										<a href="rptpdf/DOM/rptDom11.php?f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
																										<button type="button" class="btn btn-danger " ><span class="fa fa-file-pdf-o"></span> Exportar pdf</button></a>
																										</td>
																									</tr>
																						</table>';

																						echo'<table class="table table-bordered table-responsive table-hover">
																						<tr>
																							<th>#</th>
																							<th>PACIENTE</th>
																							<th>DETALLES</th>
																							<th>OBSERVACION</th>
																							<th>RESPONSABLE</th>
																						</tr>
																							';
																							if ($doc=='') {
																								$sql="SELECT c.tdoc_pac,c.doc_pac,c.nom_completo,a.dx_presentacion,c.fnacimiento,
																														TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad,c.dir_pac,f.nom_sedes,
																														a.zona_paciente,d.nom_eps

																										FROM m_aut_dom a,adm_hospitalario b,pacientes c,eps d
																										WHERE b.id_eps =d.id_eps and
																													a.freg BETWEEN '$f1' and '$f2'
																													and b.tipo_servicio = 'Domiciliarios'
																													and b.id_adm_hosp = a.id_adm_hosp
																													and c.id_paciente = b.id_paciente
																													and e.id_user = a.id_user";
																							}else {
																								$sql="SELECT d.nom_eps,b.tipo_servicio,a.freg,c.tdoc_pac,c.doc_pac,c.nom_completo,c.fnacimiento,
																														TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad,
																														 e.nombre usuario,
																														 a.id_visita_dom, criterio1, criterio2, criterio3,
																														 criterio4, criterio5, criterio6, criterio7, criterio8, criterio9, obs_visita,
																														 traqueostomia, gastrostomia, colostomia, esofagostomia, yeyunostomia, nefrostomia,
																														 urostomia, sonda_nasogastrica, sonda_orogastrica, sonda_vesical, cateter_subcutaneo, ileostomia
																										FROM visita_dom_enfermeria a,adm_hospitalario b,pacientes c,eps d,user e
																										WHERE b.id_eps =d.id_eps and c.doc_pac='$doc'
																													a.freg BETWEEN '$f1' and '$f2'
																													and b.tipo_servicio = 'Domiciliarios'
																													and b.id_adm_hosp = a.id_adm_hosp
																													and c.id_paciente = b.id_paciente
																													and e.id_user = a.id_user";
																							}


																						}
																						if ($reporte==12) {
																							echo'<table class="table table-bordered">
																										<tr>
																											<th>REPORTE HAGA A HUGO FELIZ</th>
																											<td class="text-right">
																											<a href="rptexcel/DOM/rptDom12.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
																											<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
																											<a href="rptpdf/DOM/rptDom11.php?f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
																											<button type="button" class="btn btn-danger " ><span class="fa fa-file-pdf-o"></span> Exportar pdf</button></a>
																											</td>
																										</tr>
																							</table>';

																							echo'<table class="table table-bordered table-responsive table-hover">
																							<tr>
																								<th>#</th>
																								<th>PACIENTE</th>
																								<th>DETALLES</th>
																								<th>OBSERVACION</th>
																								<th>RESPONSABLE</th>
																							</tr>
																								';
																								$sql="SELECT h.nom_eps,
																								b.doc_pac,
																								b.nom_completo,
																								b.tel_pac,
																								b.dir_pac,
																								l.nom_barrio,
																								i.descrimuni,
																								k.descripdep,
																								m.descritusuario,
																								n.descriafiliado,
																								b.genero,
																								b.rh,
																								b.fnacimiento,
																								b.edad,
																								c.estado_salida     estado,
																								c.fegreso_hosp        fecha_estado,
																								j.nomclaseusuario   tipo_paciente,
																								IFNULL(c.id_adm_hosp,0),
																								d.id_m_aut_dom,
																								IFNULL(e.id_d_aut_dom,0),
																								e.freg,
																								d.nom_paquete,
																								e.cups,
																								e.procedimiento,
																								e.cantidad,
																								e.finicio,
																								e.ffinal,
																								e.num_aut_externa,
																								e.estado_d_aut_dom,
																								e.intervalo,
																								e.temporalidad,
																								g.doc,
																								g.nombre profesional,
																								IF(f.estado_profesional=1,'Activo','Inactivo') estado_profesional,
																								g.tel_user,
																								sesiones_dom(e.cups,e.id_d_aut_dom,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones,
																								sesiones_dom_det(e.id_d_aut_dom,e.cups,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE),f.profesional) sesiones_det

																								  FROM

																								  adm_hospitalario c INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
																								                     INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom and cast('2019-04-01' as date ) BETWEEN CAST(e.finicio AS DATE) AND CAST(e.ffinal  AS DATE))
																								                     INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
																								                     INNER JOIN eps h on (h.id_eps = c.id_eps)
																								                     LEFT  JOIN profesional_d_dom f on (f.id_d_aut_dom = e.id_d_aut_dom)
																								                     LEFT  JOIN user g on (g.id_user = f.profesional)
																								                     LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)
																								                     LEFT  JOIN clase_usuario j on (j.id_cusuario = d.tipo_paciente)
																								                     LEFT  JOIN departamento k on (k.coddep = c.dep_residencia)
																								                     LEFT  JOIN barrio l on (l.id_barrio = b.zonificacion)
																								                     LEFT  JOIN tusuario m on (m.codtusuario = c.tipo_usuario)
																								                    LEFT  JOIN tafiliado n on (n.codafiliado = c.tipo_afiliacion)

																								  WHERE c.tipo_servicio = 'Domiciliarios' and c.estado_adm_hosp= 'Activo'";

																							}
																							if ($reporte==13) {
																								echo'<table class="table table-bordered">
																											<tr>
																												<th>PACIENTES VS EVOLUCIONES</th>
																												<td class="text-right">
																												<a href="rptexcel/DOM/rptDom13.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
																												<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>

																												</td>
																											</tr>
																								</table>';
																								echo'<table class="table table-bordered table-responsive table-hover">
																			          <tr>
																			            <th>PACIENTE</th>
																			            <th>ADMISION</th>
																			            <th>PROCEDIMIENTO</th>
																			            <th>SESIONES</th>
																			            <th>PROFEISONAL</th>
																			          </tr>
																									';
																									$f1=$_REQUEST['fecha1'];
																									$f2=$_REQUEST['fecha2'];
																									$tpac=$_GET['tpac'];
																									if ($f1=='') {
																										$doc=$_REQUEST['doc'];
																										if ($doc=='') {
																											$sql="SELECT month(current_date),h.nom_eps,b.doc_pac, b.nom_completo,b.tel_pac,b.dir_pac,
																																							c.tipo_usuario,c.mun_residencia,c.dep_residencia,i.descrimuni,c.zona_residencia,
																								    													IFNULL(c.id_adm_hosp,0),
																																							d.id_m_aut_dom,d.dx_presentacion,
																																							IFNULL(e.id_d_aut_dom,0),e.freg, e.cups, e.procedimiento, e.cantidad, e.finicio, e.ffinal,
																								       												e.num_aut_externa, e.estado_d_aut_dom, e.intervalo,
																								       												e.temporalidad,
																																							h.nom_eps,
																																							j.nom_sedes,
																																							k.nomclaseusuario,
																																							m.id_prof_d_dom,
																								    													cantidad_sesion_dom(e.cups,c.id_adm_hosp,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones
																																			FROM adm_hospitalario c  INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
																								    																					 INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom)
																								     																					 INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
																								    																			 		 INNER JOIN eps h on (h.id_eps = c.id_eps)
																																															 INNER JOIN sedes_ips j on (j.id_sedes_ips = c.id_sedes_ips)
																																															 INNER JOIN clase_usuario k on (k.id_cusuario = d.tipo_paciente)
																								    																			 	   LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)
																																															 LEFT JOIN profesional_d_dom m on m.id_d_aut_dom=e.id_d_aut_dom

																																			WHERE c.tipo_servicio= 'Domiciliarios' and c.id_eps in ($eps)
																																																						 and c.id_sedes_ips in ($sede)
																																																						 and d.tipo_paciente in ($tpac)
																																																						 and c.estado_adm_hosp = 'Activo'
																																																						 and estado_d_aut_dom in (1,2,3)
																																			ORDER BY sesiones ASC,doc_pac ASC ";
																										}else {
																											$sql="SELECT month(current_date),h.nom_eps,b.doc_pac, b.nom_completo,b.tel_pac,b.dir_pac,
																																							c.tipo_usuario,c.mun_residencia,c.dep_residencia,i.descrimuni,c.zona_residencia,
																								    													IFNULL(c.id_adm_hosp,0),
																																							d.id_m_aut_dom,d.dx_presentacion,
																																							IFNULL(e.id_d_aut_dom,0),e.freg, e.cups, e.procedimiento, e.cantidad, e.finicio, e.ffinal,
																								       												e.num_aut_externa, e.estado_d_aut_dom, e.intervalo,
																								       												e.temporalidad,
																																							h.nom_eps,
																																							j.nom_sedes,
																																							k.nomclaseusuario,
																																							m.id_prof_d_dom,
																								    													cantidad_sesion_dom(e.cups,c.id_adm_hosp,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones
																																			FROM adm_hospitalario c  INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
																								    																					 INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom)
																								     																					 INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
																								    																			 		 INNER JOIN eps h on (h.id_eps = c.id_eps)
																																															 INNER JOIN sedes_ips j on (j.id_sedes_ips = c.id_sedes_ips)
																																															 INNER JOIN clase_usuario k on (k.id_cusuario = d.tipo_paciente)
																								    																			 	   LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)
																																															 LEFT JOIN profesional_d_dom m on m.id_d_aut_dom=e.id_d_aut_dom

																																			WHERE  b.doc_pac='$doc' and c.tipo_servicio= 'Domiciliarios' and c.id_eps in ($eps) and c.id_sedes_ips in ($sede) and d.tipo_paciente in ($tpac)
																																																						 and c.estado_adm_hosp = 'Activo'
																																																						 and estado_d_aut_dom in (1,2,3)
																																			ORDER BY sesiones ASC,doc_pac ASC ";
																										}

																									}else {
																										$doc=$_REQUEST['doc'];
																										if ($doc=='') {
																											$sql="SELECT month(current_date),h.nom_eps,b.doc_pac, b.nom_completo,b.tel_pac,b.dir_pac,
																																							c.tipo_usuario,c.mun_residencia,c.dep_residencia,i.descrimuni,c.zona_residencia,
																								    													IFNULL(c.id_adm_hosp,0),
																																							d.id_m_aut_dom,d.dx_presentacion,
																																							IFNULL(e.id_d_aut_dom,0),e.freg, e.cups, e.procedimiento, e.cantidad, e.finicio, e.ffinal,
																								       												e.num_aut_externa, e.estado_d_aut_dom, e.intervalo,
																								       												e.temporalidad,
																																							h.nom_eps,
																																							j.nom_sedes,
																																							k.nomclaseusuario,
																																							m.id_prof_d_dom,
																								    													cantidad_sesion_dom(e.cups,c.id_adm_hosp,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones
																																			FROM adm_hospitalario c  INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
																								    																					 INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom)
																								     																					 INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
																								    																			 		 INNER JOIN eps h on (h.id_eps = c.id_eps)
																																															 INNER JOIN sedes_ips j on (j.id_sedes_ips = c.id_sedes_ips)
																																															 INNER JOIN clase_usuario k on (k.id_cusuario = d.tipo_paciente)
																								    																			 	   LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)
																																															 LEFT JOIN profesional_d_dom m on m.id_d_aut_dom=e.id_d_aut_dom

																																			WHERE c.tipo_servicio= 'Domiciliarios' and c.id_eps in ($eps) and c.id_sedes_ips in ($sede)
																																																						 and c.estado_adm_hosp = 'Activo'
																																																						 and d.tipo_paciente in ($tpac)
																																																						 and e.ffinal BETWEEN '$f1' and  '$f2'
																																																						 and estado_d_aut_dom in (1,2,3)
																																			ORDER BY sesiones ASC,doc_pac ASC ";
																										}else {
																											$sql="SELECT month(current_date),h.nom_eps,b.doc_pac, b.nom_completo,b.tel_pac,b.dir_pac,
																																							c.tipo_usuario,c.mun_residencia,c.dep_residencia,i.descrimuni,c.zona_residencia,
																								    													IFNULL(c.id_adm_hosp,0),
																																							d.id_m_aut_dom,d.dx_presentacion,
																																							IFNULL(e.id_d_aut_dom,0),e.freg, e.cups, e.procedimiento, e.cantidad, e.finicio, e.ffinal,
																								       												e.num_aut_externa, e.estado_d_aut_dom, e.intervalo,
																								       												e.temporalidad,
																																							h.nom_eps,
																																							j.nom_sedes,
																																							k.nomclaseusuario,
																																							m.id_prof_d_dom,
																								    													cantidad_sesion_dom(e.cups,c.id_adm_hosp,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones
																																			FROM adm_hospitalario c  INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
																								    																					 INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom)
																								     																					 INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
																								    																			 		 INNER JOIN eps h on (h.id_eps = c.id_eps)
																																															 INNER JOIN sedes_ips j on (j.id_sedes_ips = c.id_sedes_ips)
																																															 INNER JOIN clase_usuario k on (k.id_cusuario = d.tipo_paciente)
																								    																			 	   LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)
																																															 LEFT JOIN profesional_d_dom m on m.id_d_aut_dom=e.id_d_aut_dom

																																			WHERE  b.doc_pac='$doc' and c.tipo_servicio= 'Domiciliarios' and c.id_eps in ($eps)
																																																						 and c.id_sedes_ips in ($sede)
																																																						 and d.tipo_paciente in ($tpac)
																																																						 and c.estado_adm_hosp = 'Activo'
																																																						 and e.ffinal BETWEEN '$f1' and  '$f2'
																																																						 and estado_d_aut_dom in (1,2,3)
																																			ORDER BY sesiones ASC,doc_pac ASC ";
																										}
																									}
																								}
						$i=1;
							//echo $sql;
						if ($tabla=$bd1->sub_tuplas($sql)){
							foreach ($tabla as $fila ) {
								if ($reporte==1) {
									echo"<tr >\n";
									echo'<td class="text-left">
												<p>'.$fila["nom_completo"].'<p>
									 			<p><strong>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].'</p>
												<p><strong>Tel: </strong>: '.$fila["tel_pac"].'</p>
												<p><strong>Dirección: </strong>: '.$fila["dir_pac"].'</p>
											 </td>';
									echo'<td class="text-left">
												<p><strong>ADM: </strong>'.$fila["IFNULL(c.id_adm_hosp,0)"].'</p>
												<p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
												<p><strong>SEDE: </strong>'.$fila["nom_sedes"].'</p>';
									echo'</td>';
									echo'<td class="text-left">
												<p><strong>ID M: </strong>'.$fila["id_m_aut_dom"].'</p>
												<p><strong>ID D: </strong>'.$fila["IFNULL(e.id_d_aut_dom,0)"].'</p>
												<p><strong>Intervalo/turno: </strong>'.$fila["intervalo"].'</p>
												<p><strong>Tipo Paciente: </strong>'.$fila["nomclaseusuario"].'</p>
												<p><strong>'.$fila["cups"].' </strong>'.$fila["procedimiento"].'</p>
												<p><strong>Vigencia: </strong>'.$fila["finicio"].' -- '.$fila["ffinal"].'</p>
											 </td>';
									echo'<td class="text-center">
												<p><strong>Autorizado: </strong>'.$fila["cantidad"].'</p>
												<p><strong>Realizado: </strong>'.$fila["sesiones"].'</p>
											 </td>';
									echo'<td class="text-left">';
												$detalle=$fila["IFNULL(e.id_d_aut_dom,0)"];
												$sql_profesional="SELECT a.freg,a.profesional,b.nombre
																					FROM profesional_d_dom a inner join user b on a.profesional=b.id_user
																					WHERE id_d_aut_dom=$detalle and estado_profesional=1";
											  if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
													foreach ($tabla_profesional as $fila_profesional) {
														echo'<p><strong>Fecha Asignación: </strong>'.$fila_profesional["freg"].'</p>';
														echo'<p><strong>Profesional: </strong>'.$fila_profesional["nombre"].'</p>';
														echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#dregistro_'.$fila["IFNULL(e.id_d_aut_dom,0)"].'">Detalle Registros</button></p>';
														echo'<div id="dregistro_'.$fila["IFNULL(e.id_d_aut_dom,0)"].'" class="modal fade" role="dialog">
																  <div class="modal-dialog">
																    <div class="modal-content">
																      <div class="modal-header">
																        <button type="button" class="close" data-dismiss="modal">&times;</button>
																        <h4 class="modal-title">Detalle de registros</h4>
																      </div>
																      <div class="modal-body">';
																        $resp=$fila_profesional['profesional'];
																				$cups_prod=$fila['cups'];
																				$idadm=$fila['IFNULL(c.id_adm_hosp,0)'];
																				$f1=$fila['finicio'];
																				$f2=$fila['ffinal'];
																				if ($cups_prod=='890105') {
																					$turno=$fila['intervalo'];
																					if ($turno==3) {
																						$sql_historia="SELECT a.freg3,CONCAT('Hora1: ',a.hnota1,' ',a.nota1, ' \nHora2: ' ,a.hnota2,'  ',a.nota2, '\nHora3: ' ,a.hnota3,'  ',a.nota3) nota
																															FROM enferdom3 a inner join user b on a.id_user=b.id_user
																															WHERE freg3 BETWEEN '$f1' and '$f2' and estado_nota ='Realizada'
																																																	and a.id_user=$resp
																																																	and id_d_aut_dom=$detalle";
																						if ($tabla_historia=$bd1->sub_tuplas($sql_historia)){
																							foreach ($tabla_historia as $fila_historia) {
																								echo'<article class]="col-md-4">
																											<p>'.$fila_historia["freg3"].'</p>
																										 </article>
																										 <article class]="col-md-8">
																											<p>'.$fila_historia["nota"].'</p>
																										 </article>';
																							}
																						}
																					}
																					if ($turno==6) {
																						$sql_historia="SELECT a.freg6,CONCAT('Hora1: ',a.hnota1,' - ',a.nota1, ' \nHora2: ' ,a.hnota2,' - ',a.nota2, '\nHora3: ' ,a.hnota3,' - ',a.nota3,
																																								 '\nHora4: ',a.hnota4,' - ',a.nota4, '\nHora5: ',a.hnota5,' - ',a.nota5,   '\nHora6: ',a.hnota6,' - ',a.nota6) nota
																															FROM enferdom6 a inner join user b on a.id_user=b.id_user
																															WHERE freg6 BETWEEN '$f1' and '$f2' and estado_nota ='Realizada'
																																																	and a.id_user=$resp
																																																	and id_d_aut_dom=$detalle";
																						if ($tabla_historia=$bd1->sub_tuplas($sql_historia)){
																							foreach ($tabla_historia as $fila_historia) {
																								echo'<article class]="col-md-4">
																											<p>'.$fila_historia["freg6"].'</p>
																										 </article>
																										 <article class]="col-md-8">
																											<p>'.$fila_historia["nota"].'</p>
																										 </article>';
																							}
																						}
																					}
																					if ($turno==8) {
																						$sql_historia="SELECT a.freg8,CONCAT('Hora1: ',a.hnota1,' - ',a.nota1, ' \nHora2: ' ,a.hnota2,' - ',a.nota2, '\nHora3: ' ,a.hnota3,' - ',a.nota3,
																																								 '\nHora4: ',a.hnota4,' - ',a.nota4, '\nHora5: ',a.hnota5,' - ',a.nota5,   '\nHora6: ',a.hnota6,' - ',a.nota6,
																																								 '\nHora7: ',a.hnota7,' - ',a.nota7, ' \nHora8: ' ,a.hnota8,' - ',a.nota8) nota
																															FROM enferdom8 a inner join user b on a.id_user=b.id_user
																															WHERE freg8 BETWEEN '$f1' and '$f2' and estado_nota ='Realizada'
																																																	and a.id_user=$resp
																																																	and id_d_aut_dom=$detalle";
																						if ($tabla_historia=$bd1->sub_tuplas($sql_historia)){
																							foreach ($tabla_historia as $fila_historia) {
																								echo'<article class]="col-md-4">
																											<p>'.$fila_historia["freg8"].'</p>
																										 </article>
																										 <article class]="col-md-8">
																											<p>'.$fila_historia["nota"].'</p>
																										 </article>';
																							}
																						}
																					}
																					if ($turno==12) {
																						$sql_historia="SELECT a.freg12,CONCAT('Hora1: ',a.hnota1,' - ',a.nota1, ' \nHora2: ' ,a.hnota2,' - ',a.nota2, '\nHora3: ' ,a.hnota3,' - ',a.nota3,
																																								 '\nHora4: ',a.hnota4,' - ',a.nota4, '\nHora5: ',a.hnota5,' - ',a.nota5,   '\nHora6: ',a.hnota6,' - ',a.nota6,
																																								 '\nHora7: ',a.hnota7,' - ',a.nota7, ' \nHora8: ' ,a.hnota8,' - ',a.nota8, '\nHora9: ' ,a.hnota9,' - ',a.nota9,
																		 																						 '\nHora10: ',a.hnota10,' - ',a.nota10, '\nHora11: ',a.hnota11,' - ',a.nota11,   '\nHora12: ',a.hnota12,' - ',a.nota12) nota
																															FROM enferdom12 a inner join user b on a.id_user=b.id_user
																															WHERE freg12 BETWEEN '$f1' and '$f2' and estado_nota ='Realizada'
																																																	and a.id_user=$resp
																																																	and id_d_aut_dom=$detalle";

																						if ($tabla_historia=$bd1->sub_tuplas($sql_historia)){
																							foreach ($tabla_historia as $fila_historia) {
																								echo'<article class]="col-md-4">
																											<p>'.$fila_historia["freg12"].'</p>
																										 </article>
																										 <article class]="col-md-8">
																											<p>'.$fila_historia["nota"].'</p>
																										 </article>';
																							}
																						}
																					}
																					if ($turno==24) {
																						$sql_historia="SELECT a.freg12,CONCAT('Hora1: ',a.hnota1,' - ',a.nota1, ' \nHora2: ' ,a.hnota2,' - ',a.nota2, '\nHora3: ' ,a.hnota3,' - ',a.nota3,
																																								 '\nHora4: ',a.hnota4,' - ',a.nota4, '\nHora5: ',a.hnota5,' - ',a.nota5,'\nHora6: ',a.hnota6,' - ',a.nota6,
																																								 '\nHora7: ',a.hnota7,' - ',a.nota7, ' \nHora8: ' ,a.hnota8,' - ',a.nota8, '\nHora9: ' ,a.hnota9,' - ',a.nota9,
																		 																						 '\nHora10: ',a.hnota10,' - ',a.nota10, '\nHora11: ',a.hnota11,' - ',a.nota11,   '\nHora12: ',a.hnota12,' - ',a.nota12) nota
																															FROM enferdom12 a inner join user b on a.id_user=b.id_user
																															WHERE freg12 BETWEEN '$f1' and '$f2' and estado_nota ='Realizada' and a.intervalo_nota=24
																																																	and a.id_user=$resp
																																																	and id_d_aut_dom=$detalle";
																						if ($tabla_historia=$bd1->sub_tuplas($sql_historia)){
																							foreach ($tabla_historia as $fila_historia) {
																								echo'<article class]="col-md-4">
																											<p>'.$fila_historia["freg12"].'</p>
																										 </article>
																										 <article class]="col-md-8">
																											<p>'.$fila_historia["nota"].'</p>
																										 </article>';
																							}
																						}
																					}

																				}
																				if ($cups_prod=='890101') {
																					$sql_historia="SELECT a.freg_hchosp,id_adm_hosp,
																														FROM hcini_dom a inner join user b on a.id_user=b.id_user
																														WHERE freg_hchosp BETWEEN '$f1' and '$f2' and estado_hchosp ='Realizado'
																																																			and a.id_user=$resp
																																																	 and id_d_aut_dom=$detalle";
																					if ($tabla_historia=$bd1->sub_tuplas($sql_historia)){
																						foreach ($tabla_historia as $fila_historia) {
																							echo'<article class="col-md-4">
																										<p>'.$fila_historia["freg_hchosp"].'</p>
																									 </article>';
																						}
																					}
																				}
																				if ($cups_prod=='890110') {
																					$sql_historia="SELECT a.freg_evofono_dom,evolucionfono_dom
																														FROM evo_fono_dom a inner join user b on a.id_user=b.id_user
																														WHERE freg_evofono_dom BETWEEN '$f1' and '$f2' and estado_evofono_dom ='Realizada'
																																																			     and a.id_user=$resp
																																																				 and id_d_aut_dom=$detalle";
																					if ($tabla_historia=$bd1->sub_tuplas($sql_historia)){
																						foreach ($tabla_historia as $fila_historia) {
																							echo'<article class]="col-md-4">
																										<p>'.$fila_historia["freg_evofono_dom"].'</p>
																									 </article>
																									 <article class]="col-md-8">
		 																								<p>'.$fila_historia["evolucionfono_dom"].'</p>
		 																							 </article>';
																						}
																					}
																				}
																				if ($cups_prod=='890111') {
																					$sql_fisio="SELECT a.freg_evofisio_dom,evolucionfisio_dom
																														FROM evo_fisio_dom a inner join user b on a.id_user=b.id_user
																														WHERE freg_evofisio_dom BETWEEN '$f1' and '$f2' and estado_evofisio_dom ='Realizada'
																																																					 and a.id_user=$resp
																																																				 and id_d_aut_dom=$detalle";
																					if ($tabla_fisio=$bd1->sub_tuplas($sql_fisio)){
																						foreach ($tabla_fisio as $fila_fisio) {
																							echo'<article class]="col-md-4">
																										<p>'.$fila_fisio["freg_evofisio_dom"].'</p>
																									 </article>
																									 <article class]="col-md-8">
																										<p>'.$fila_fisio["evolucionfisio_dom"].'</p>
																									 </article>';
																						}
																					}
																				}
																				if ($cups_prod=='890113') {
																					$sql_historia="SELECT a.freg_evoto_dom,evolucionto_dom
																														FROM evo_to_dom a inner join user b on a.id_user=b.id_user
																														WHERE freg_evoto_dom BETWEEN '$f1' and '$f2' and estado_evoto_dom ='Realizada'
																																																					 and a.id_user=$resp
																																																				 and id_d_aut_dom=$detalle";
																					if ($tabla_historia=$bd1->sub_tuplas($sql_historia)){
																						foreach ($tabla_historia as $fila_historia) {
																							echo'<article class]="col-md-4">
																										<p>'.$fila_historia["freg_evoto_dom"].'</p>
																									 </article>
																									 <article class]="col-md-8">
																										<p>'.$fila_historia["evolucionto_dom"].'</p>
																									 </article>';
																						}
																					}
																				}
																				if ($cups_prod=='890112') {
																					$sql_historia="SELECT a.freg_evotr_dom,evoluciontr_dom
																														FROM evo_tr_dom a inner join user b on a.id_user=b.id_user
																														WHERE freg_evotr_dom BETWEEN '$f1' and '$f2' and estado_evotr_dom ='Realizada'
																																																					 and a.id_user=$resp
																																																				 and id_d_aut_dom=$detalle";
																					if ($tabla_historia=$bd1->sub_tuplas($sql_historia)){
																						foreach ($tabla_historia as $fila_historia) {
																							echo'<article class]="col-md-4">
																										<p>'.$fila_historia["freg_evotr_dom"].'</p>
																									 </article>
																									 <article class]="col-md-8">
																										<p>'.$fila_historia["evoluciontr_dom"].'</p>
																									 </article>';
																						}
																					}
																				}

																 echo'</div>
																      <div class="modal-footer">
																        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																      </div>
																    </div>

																  </div>
																</div>';
													}
												}else {
													echo'<p class="alert alert-danger animated zoomIn">No ha realizado asignación del profesional.</p>';
												}
									echo'</td>';
									echo "</tr>\n";
								}
								if ($reporte==2) {
									echo"<tr >\n";

									echo'<td class="text-left"><p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'<p>
																							 <p><strong>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].' <br /><strong> ADM: </strong>'.$fila["id_adm_hosp"].'</p></td>';
									echo'<td class="text-left">
												<p><strong>Inicio: </strong>'.$fila["freg_hchosp"].'</p>
												<p><strong>SEDE: </strong>'.$fila["nom_sedes"].'</p>
												<p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>';
									echo'</td>';
									echo'<td class="text-left">'.$fila["nombre"].'</td>';
									echo'<td class="text-left">
												<p><strong>DXP: </strong>'.$fila["dxp"].' | '.$fila["tdxp"].'</p>
												<p><strong>DX1: </strong>'.$fila["dx1"].' | '.$fila["tdx1"].'</p>
												<p><strong>DX2: </strong>'.$fila["dx2"].' | '.$fila["tdx2"].'</p>
												<p><strong>DX3: </strong>'.$fila["dx3"].' | '.$fila["tdx3"].'</p>
											 </td>';
									echo'<td class="text-left">';
												echo'<a href="rpt_hcmed_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC Medicina</button></a>';
									echo'</td>';
									echo "</tr>\n";
								}
								if ($reporte==3) {
									$fecha=$fila["fnacimiento"];
									$segundos= strtotime('now') - strtotime($fecha);
									$diferencia_dias=intval($segundos /60/60/24);
									$dias=ceil($diferencia_dias/365);
									echo"<tr >\n";
									echo'<td>'.$i++.'</td>';
									echo'<td class="text-left">
												<p>'.$fila["nom_completo"].'<p>
												<p><strong>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].'</p>
												<p><strong>Fecha Nacimiento </strong>: '.$fila["fnacimiento"].'</p>
												<p><strong>EDAD </strong>: '.$dias.'</p>
											 </td>';
									echo'<td class="text-left">
												<p><strong class="text-danger">RESULTADO: </strong>'.$fila["criterio_total"].'</p>
												<p><strong class="text-danger">TOTAL: </strong>'.$fila["total"].'</p>';
												$adm=$fila['id_adm_hosp'];
												$sql_dx="SELECT max(dx_presentacion) dx FROM m_aut_dom WHERE id_adm_hosp=$adm ";
												if ($tabla_dx=$bd1->sub_tuplas($sql_dx)){
													foreach ($tabla_dx as $fila_dx) {
														echo'<p><strong>DX </strong>: '.$fila_dx['dx'].'</p>';
													}
												}
									echo'</td>';
									echo'<td class="text-left">'.$fila["sugerencia"].'</td>';
									echo'<td class="text-left">
												<p>'.$fila["nombre"].'</p>
												<p><strong class="text-primary">Fecha Registro:</strong>'.$fila["fescala"].'</p>
											 </td>';
									echo "</tr>\n";
								}
								if ($reporte==4) {
									$fecha=$fila["fnacimiento"];
									$segundos= strtotime('now') - strtotime($fecha);
									$diferencia_dias=intval($segundos /60/60/24);
									$dias=ceil($diferencia_dias/365);
									echo"<tr >\n";
									echo'<td>'.$i++.'</td>';
									echo'<td class="text-left">
												<p>'.$fila["nom_completo"].'<p>
												<p><strong>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].'</p>
												<p><strong>Fecha Nacimiento </strong>: '.$fila["fnacimiento"].'</p>
												<p><strong>EDAD </strong>: '.$dias.'</p>
											 </td>';
									echo'<td class="text-left">
												<p><strong class="text-danger">RESULTADO: </strong>'.$fila["calificacion_total"].'</p>
												<p><strong class="text-danger">TOTAL: </strong>'.$fila["total"].'</p>';
												$adm=$fila['id_adm_hosp'];
												$sql_dx="SELECT max(dx_presentacion) dx FROM m_aut_dom WHERE id_adm_hosp=$adm ";
												if ($tabla_dx=$bd1->sub_tuplas($sql_dx)){
													foreach ($tabla_dx as $fila_dx) {
														echo'<p><strong>DX </strong>: '.$fila_dx['dx'].'</p>';
													}
												}
									echo'</td>';
									echo'<td class="text-left">'.$fila["observacion"].'</td>';
									echo'<td class="text-left">
												<p>'.$fila["nombre"].'</p>
												<p><strong class="text-primary">Fecha Registro:</strong>'.$fila["fescala"].'</p>
											 </td>';
									echo "</tr>\n";
								}
								if ($reporte==5) {
									$fecha=$fila["fnacimiento"];
									$segundos= strtotime('now') - strtotime($fecha);
									$diferencia_dias=intval($segundos /60/60/24);
									$dias=ceil($diferencia_dias/365);
									echo"<tr >\n";
									echo'<td>'.$i++.'</td>';
									echo'<td class="text-left">
												<p>'.$fila["nom_completo"].'<p>
												<p><strong>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].'</p>
												<p><strong>Fecha Nacimiento </strong>: '.$fila["fnacimiento"].'</p>
												<p><strong>EDAD </strong>: '.$dias.'</p>
											 </td>';
									echo'<td class="text-left">
												<p><strong class="text-danger">RESULTADO: </strong>'.$fila["riesgo"].'</p>
												<p><strong class="text-danger">TOTAL: </strong>'.$fila["total"].'</p>';
												$adm=$fila['id_adm_hosp'];
												$sql_dx="SELECT max(dx_presentacion) dx FROM m_aut_dom WHERE id_adm_hosp=$adm ";
												if ($tabla_dx=$bd1->sub_tuplas($sql_dx)){
													foreach ($tabla_dx as $fila_dx) {
														echo'<p><strong>DX </strong>: '.$fila_dx['dx'].'</p>';
													}
												}
									echo'</td>';
									echo'<td class="text-left">'.$fila["observacion"].'</td>';
									echo'<td class="text-left">
												<p>'.$fila["nombre"].'</p>
												<p><strong class="text-primary">Fecha Registro:</strong>'.$fila["fescala"].'</p>
											 </td>';
									echo "</tr>\n";
								}
								if ($reporte==6) {
									$fecha=$fila["fnacimiento"];
									$segundos= strtotime('now') - strtotime($fecha);
									$diferencia_dias=intval($segundos /60/60/24);
									$dias=ceil($diferencia_dias/365);
									echo"<tr >\n";
									echo'<td>'.$i++.'</td>';
									echo'<td class="text-left">
												<p>'.$fila["nom_completo"].'<p>
												<p><strong>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].'</p>
												<p><strong>Fecha Nacimiento </strong>: '.$fila["fnacimiento"].'</p>
												<p><strong>EDAD </strong>: '.$dias.'</p>
											 </td>';
									echo'<td class="text-left">
												<p><strong class="text-danger">Fecha Registro: </strong>'.$fila["freg_encuesta"].'</p>';
									echo'</td>';
									echo'<td class="text-left">';
									include('formulariosDOM/FormularioApoyo/visorEncuesta.php');
									echo'</td>';
									echo'<td class="text-left">
												<p>'.$fila["usuario"].'</p>
											 </td>';
									echo "</tr>\n";
								}
								if ($reporte==7) {

									echo"<tr >\n";
									echo'<td>'.$i++.'</td>';
									echo'<td class="text-left">
												<p>'.$fila["nom_completo"].'<p>
												<p><strong>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].'</p>
											 </td>';
									echo'<td class="text-left">
												<p><strong class="text-danger">Plan de manejo: </strong>'.$fila["plan_manejo"].'</p>';
									echo'</td>';
									echo'<td class="text-left">';
									echo'<article class="col-md-12 alert alert-info">
												<p><strong class="text-danger">Cantidad Valoracion medica: </strong>'.$fila["cant_valmed"].'</p>
												<p><strong class="text-danger">Periodicidad Valoracion medica: </strong>'.$fila["periodo_valmed"].'</p>
											 </article>';
									echo'<article class="col-md-12 alert alert-success">
		 									<p><strong class="text-danger">Cantidad enfermeria: </strong>'.$fila["cant_enfer"].'</p>
											<p><strong class="text-danger">Temporalidad enfermeria: </strong>'.$fila["temp_valenf"].'</p>
		 									<p><strong class="text-danger">Periodicidad Valoracion medica: </strong>'.$fila["periodo_valenf"].'</p>
		 									</article>';
									echo'<article class="col-md-12 alert alert-warning">
												<p><strong class="text-danger">Cantidad Fisioterapia: </strong>'.$fila["cant_fisio"].'</p>
												<p><strong class="text-danger">Cantidad Fonoaudiologia: </strong>'.$fila["cant_fono"].'</p>
												<p><strong class="text-danger">Cantidad ocupacional: </strong>'.$fila["cant_to"].'</p>
												<p><strong class="text-danger">Cantidad Respiratoria: </strong>'.$fila["cant_resp"].'</p>
								  		 </article>';
									echo'</td>';
									echo'<td class="text-left">
												<p>'.$fila["usuario"].'</p>
											 </td>';
									echo "</tr>\n";
								}
								if ($reporte==8) {
									echo"<tr >\n";
									echo'<td class="text-center">'.$i++.'</td>';
									echo'<td class="text-center">'.$fila["nom_completo"].'</td>';
									echo'<td class="text-center">'.$fila["doc_pac"].' </td>';
									echo'<td class="text-center"><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].' -- '.$fila["id_paciente"].'</td>';
									echo'<td class="text-left">';
									echo'<p class="text-right"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOC&idpac='.$fila["id_paciente"].'&idadm='.$fila['id_adm_hosp'].'&doc='.$fila["doc_pac"].'&servicio=Domiciliarios"><button type="button" class="btn btn-success"><span class="fa fa-file-text"></span>Cargar documento Nuevo</button></a></p>';
									$doc=$fila['id_paciente'];
									$sql_documentos="SELECT nombre_doc,id_paciente,foto,fcargue
																	 FROM info_documentacion
																	 WHERE id_paciente=$doc";

									if($tabla_documentos=$bd1->sub_tuplas($sql_documentos)){
								 		foreach ($tabla_documentos as $fila_documentos) {

											echo'<p><strong>Documento: </strong>'.$fila_documentos["nombre_doc"].'</p>
													 <p><strong>Fecha Cargue: </strong>'.$fila_documentos["fcargue"].'</p>';
										}
									}else {
										echo'<p>No tiene documentos</p>';
									}
									echo'</td>';
									echo"</tr>";
								}

								if ($reporte==9) {
									$fecha=$fila["fnacimiento"];
									$segundos= strtotime('now') - strtotime($fecha);
									$diferencia_dias=intval($segundos /60/60/24);
									$dias=ceil($diferencia_dias/365);
									echo"<tr >\n";
									echo'<td>'.$i++.'</td>';
									echo'<td class="text-left">
												<p>'.$fila["nom_completo"].'<p>
												<p><strong>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].'</p>
												<p><strong>Fecha Nacimiento </strong>: '.$fila["fnacimiento"].'</p>
												<p><strong>EDAD </strong>: '.$dias.'</p>
											 </td>';
									echo'<td class="text-left">
												<p><strong class="text-danger">Fecha Registro: </strong>'.$fila["freg_ronda"].'</p>';
									echo'</td>';
									echo'<td class="text-left">';
									include('formulariosDOM/FormularioApoyo/visorRonda.php');
									echo'</td>';
									echo'<td class="text-left">
												<p>'.$fila["usuario"].'</p>
											 </td>';
									echo "</tr>\n";
								}
								if ($reporte==10) {
									$fecha=$fila["fnacimiento"];
									$segundos= strtotime('now') - strtotime($fecha);
									$diferencia_dias=intval($segundos /60/60/24);
									$dias=ceil($diferencia_dias/365);
									echo"<tr >\n";
									echo'<td>'.$i++.'</td>';
									echo'<td class="text-left">
												<p>'.$fila["nom_completo"].'<p>
												<p><strong>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].'</p>
												<p><strong>Fecha Nacimiento </strong>: '.$fila["fnacimiento"].'</p>
												<p><strong>EDAD </strong>: '.$dias.'</p>
											 </td>';
									echo'<td class="text-left">
												<p><strong class="text-danger">Fecha Registro: </strong>'.$fila["freg"].'</p>';
									echo'</td>';
									echo'<td class="text-left">';
									include('formulariosDOM/FormularioApoyo/visorVisita.php');
									echo'</td>';
									echo'<td class="text-left">
												<p>'.$fila["usuario"].'</p>
											 </td>';
									echo "</tr>\n";
								}
								if ($reporte==12) {
									echo"<tr >\n";
									echo'<td>'.$i++.'</td>';
									echo'<td class="text-left">
												<p>'.$fila["nom_completo"].'<p>
												<p>'.$fila["doc_pac"].'</p>
												<p><strong>Fecha Nacimiento </strong>: '.$fila["fnacimiento"].'</p>
											 </td>';
									echo'<td class="text-left">';
									echo'<p>'.$fila["procedimiento"].'</p>
											 <p><strong>Cantidad: </strong>'.$fila["cantidad"].'</p>
											 <p><strong>Vigencia: </strong>'.$fila["finicio"].' - '.$fila["ffinal"].'</p>
											 <p><strong>Intervalo: </strong>'.$fila["intervalo"].'</p>
											 <p><strong>Temporalidad: </strong>'.$fila["temporalidad"].'</p>';
									echo'</td>';
									echo'<td class="text-left">
											 <p><strong>Sesiones Autorizadas: </strong>'.$fila["sesiones"].'</p>
											 <p><strong>Sesiones Realizadas: </strong>'.$fila["sesiones_det"].'</p>';
									echo'</td>';
									echo'<td class="text-left">
												<p><strong>Profesional: </strong>'.$fila["profesional"].'</p>
								 				<p><strong>TEL: </strong>'.$fila["tel_user"].'</p>
											 </td>';
									echo "</tr>\n";
								}
								if ($reporte==13) {
									$id_prof=$fila['id_prof_d_dom'];
									if ($id_prof=='') {
										echo"<tr >\n";
										echo'<td class="text-left">
													<p>'.$fila["nom_completo"].'<p>
										 			<p><strong>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].'</p>
													<p><strong>Tel: </strong>: '.$fila["tel_pac"].'</p>
													<p><strong>Dirección: </strong>: '.$fila["dir_pac"].'</p>
												 </td>';
										echo'<td class="text-left">
													<p><strong>ADM: </strong>'.$fila["IFNULL(c.id_adm_hosp,0)"].'</p>
													<p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
													<p><strong>SEDE: </strong>'.$fila["nom_sedes"].'</p>';
										echo'</td>';
										echo'<td class="text-left">
													<p><strong>ID M: </strong>'.$fila["id_m_aut_dom"].'</p>
													<p><strong>ID D: </strong>'.$fila["IFNULL(e.id_d_aut_dom,0)"].'</p>
													<p><strong>Intervalo/turno: </strong>'.$fila["intervalo"].'</p>
													<p><strong>Tipo Paciente: </strong>'.$fila["nomclaseusuario"].'</p>
													<p><strong>'.$fila["cups"].' </strong>'.$fila["procedimiento"].'</p>
													<p><strong>Vigencia: </strong>'.$fila["finicio"].' -- '.$fila["ffinal"].'</p>
												 </td>';
										echo'<td class="text-center">
													<p><strong>Autorizado: </strong>'.$fila["cantidad"].'</p>
													<p><strong>Realizado: </strong>'.$fila["sesiones"].'</p>
												 </td>';
										echo'<td class="text-left">
													<p>Procedimiento sin Profesional asignado.</p>
													<button type="button" class="btn btn-info" data-toggle="modal" data-target="#bitacora_call_'.$fila["IFNULL(e.id_d_aut_dom,0)"].'">Ver seguimiento Bitacora</button>';
													echo'
													<div id="bitacora_call_'.$fila["IFNULL(e.id_d_aut_dom,0)"].'" class="modal fade" role="dialog">
													  <div class="modal-dialog">
													    <div class="modal-content">
													      <div class="modal-header">
													        <button type="button" class="close" data-dismiss="modal">&times;</button>
													        <h4 class="modal-title">Seguimiento de bitacora domiciliarios</h4>
													      </div>
													      <div class="modal-body">';
													        $prod=$fila["IFNULL(e.id_d_aut_dom,0)"];
																	$sql_bitacora="SELECT a.freg,calificacion,descripcion,b.nombre
																								 FROM bitacora_prod_call a inner join user b on a.resp_bitacora=b.id_user
																								 WHERE a.id_d_aut_dom=$prod";
																								// echo $sql_bitacora;
																	if ($tabla_bitacora=$bd1->sub_tuplas($sql_bitacora)){
																		foreach ($tabla_bitacora as $fila_bitacora) {
																			echo '<section class="panel-body">';
																			echo '<article class="col-md-3">
																							<p><strong>Fecha: </strong>'.$fila_bitacora['freg'].'</p>
																						</article>
																						<article class="col-md-3">
																							<p><strong>Calificacion: </strong>'.$fila_bitacora['calificacion'].'</p>
																						</article>
																						<article class="col-md-6">
																							<p><strong>Descripción: </strong>'.$fila_bitacora['descripcion'].'</p>
																						</article>
																						<article class="col-md-12">
																							<p><strong>Quien registro: </strong>'.$fila_bitacora['nombre'].'</p>
																						</article>
																						</section>';
																		}
																	}
													      echo'</div>
													      <div class="modal-footer">
													        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													      </div>
													    </div>

													  </div>
													</dv>';
										echo'</td>';
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
