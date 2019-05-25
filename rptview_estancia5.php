
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
			<h3>Informes de control y/o facturación</h3>
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
							<option value="1">Días de estancia hospitalarios</option>
							<option value="2">Consulta externa realizada</option>
							<option value="3">Resumen de atención hospitalaria</option>
							<option value="7">Resumen de atención hospital dia</option>
							<option value="4">Resumen de control documental</option>
							<option value="5">Resumen Gasto de medicamentos</option>
							<option value="6">Resumen Terapeutas SM</option>
							<option value="8">Ordenes Hospitalarias </option>
							<option value="9">Laboratorios procesados </option>
							<option value="10">Reporte de egresos Hospitalarios </option>
						</select>
					</article>
					<article class="col-xs-3">
		        <label for="">Seleccione SEDE:</label>
		        <select class="form-control input-sm" required="" name="sede">
		          <option value="2,8">Todas</option>
		          <?php
		          $sql="SELECT id_sedes_ips,nom_sedes from sedes_ips where id_sedes_ips in (2,8) and estado_sedes='Activo' ORDER BY id_sedes_ips ASC";
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
									<th>INFORME DE ESTANCIA HOSPITALARIA</th>
									<td class="text-right">
									<a href="rptexcel/SM/rptestanciaHosp.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
									<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
									<a href="rptpdf/SM/rptestanciaHosp.php?f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
									<button type="button" class="btn btn-danger " ><span class="fa fa-file-pdf-o"></span> Exportar pdf</button></a>
									</td>
								</tr>
					</table>';
					echo'<table class="table table-bordered table-responsive table-hover">

						';
						$sql="SELECT p.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
												 a.id_adm_hosp,estado_adm_hosp,fegreso_hosp,IFNULL(a.fegreso_hosp, '".$f2."') fecha_fin,fingreso_hosp,
												 IF(IFNULL(a.fegreso_hosp,0)=0,DATEDIFF(CAST(IFNULL(a.fegreso_hosp, '".$f2."') AS DATE),CAST(IF(fingreso_hosp <= '".$f1."', '".$f1."',a.fingreso_hosp) AS DATE))+1,
												 IF(a.fegreso_hosp>CAST('".$f2."' AS DATE),DATEDIFF(IF(IFNULL(a.fegreso_hosp, '".$f2."')>CAST('".$f2."' AS DATE),CAST('".$f2."' AS DATE),
												 CAST(IFNULL(a.fegreso_hosp, '".$f2."') AS DATE)),IF(a.fingreso_hosp <= '".$f1."',CAST('".$f1."' AS DATE),a.fingreso_hosp))+1,
												 DATEDIFF(IF(IFNULL(a.fegreso_hosp, '".$f2."')>CAST('".$f2."' AS DATE),CAST('".$f2."' AS DATE),CAST(IFNULL(a.fegreso_hosp, '".$f2."') AS DATE)),
												 IF(a.fingreso_hosp <= '".$f1."',CAST('".$f1."' AS DATE),a.fingreso_hosp)))) difer1
												 ,IF(fingreso_hosp <= '".$f1."', '".$f1."',fingreso_hosp) fecha_inicio,
												 ( IF(a.fegreso_hosp > '".$f2."',CAST('".$f2."' AS DATE),CAST(IFNULL(fegreso_hosp, '".$f2."') AS DATE)) -
												 CAST(IF(fingreso_hosp <= '".$f1."', CAST('".$f1."' AS DATE),fingreso_hosp) AS DATE)
  										 	 ) dias,clase_dx_hosp,
												 e.nom_eps,
												 i.nom_sedes,
												 max(j.ddxp) ddxp,
												 max(k.cdxp_epi) cdx_epi
									FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
																	 INNER JOIN eps e on e.id_eps=a.id_eps
																	 INNER JOIN sedes_ips i on i.id_sedes_ips=a.id_sedes_ips
																	 LEFT JOIN hc_hospitalario j on j.id_adm_hosp=a.id_adm_hosp
																	 LEFT JOIN epicrisis k on k.id_adm_hosp=a.id_adm_hosp
									WHERE a.tipo_servicio = 'Hospitalario' and ((fingreso_hosp <= CAST('".$f2."' AS DATE) and fegreso_hosp is null)
									     	or (fegreso_hosp >= CAST('".$f1."' AS DATE) and fingreso_hosp <='".$f2."'))
												and a.id_sedes_ips in ($sede)
									GROUP BY p.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
															 a.id_adm_hosp,estado_adm_hosp,fegreso_hosp,IFNULL(a.fegreso_hosp, '".$f2."') ,fingreso_hosp,
															 IF(IFNULL(a.fegreso_hosp,0)=0,DATEDIFF(CAST(IFNULL(a.fegreso_hosp, '".$f2."') AS DATE),CAST(IF(fingreso_hosp <= '".$f1."', '".$f1."',a.fingreso_hosp) AS DATE))+1,
															 IF(a.fegreso_hosp>CAST('".$f2."' AS DATE),DATEDIFF(IF(IFNULL(a.fegreso_hosp, '".$f2."')>CAST('".$f2."' AS DATE),CAST('".$f2."' AS DATE),
															 CAST(IFNULL(a.fegreso_hosp, '".$f2."') AS DATE)),IF(a.fingreso_hosp <= '".$f1."',CAST('".$f1."' AS DATE),a.fingreso_hosp))+1,
															 DATEDIFF(IF(IFNULL(a.fegreso_hosp, '".$f2."')>CAST('".$f2."' AS DATE),CAST('".$f2."' AS DATE),CAST(IFNULL(a.fegreso_hosp, '".$f2."') AS DATE)),
															 IF(a.fingreso_hosp <= '".$f1."',CAST('".$f1."' AS DATE),a.fingreso_hosp))))
															 ,IF(fingreso_hosp <= '".$f1."', '".$f1."',fingreso_hosp) ,
															 ( IF(a.fegreso_hosp > '".$f2."',CAST('".$f2."' AS DATE),CAST(IFNULL(fegreso_hosp, '".$f2."') AS DATE)) -
															 CAST(IF(fingreso_hosp <= '".$f1."', CAST('".$f1."' AS DATE),fingreso_hosp) AS DATE)
			  										 	 ) ,clase_dx_hosp,
															 e.nom_eps,
															 i.nom_sedes";

						}
						if ($reporte==2) {
							echo'<table class="table table-bordered table-responsive table-hover">
								<tr>
									<th>FECHA</th>
									<th>PACIENTE</th>
									<th>IDENTIFICACION</th>
									<th>MEDICO</th>
									<th>ESPECIALIDAD</th>
									<th>TIPO CONSULTA</th>
									<th>EPS</th>

								</tr>';
								$sql="SELECT a.freg_hcsm_pv   fecha,   doc_pac    doc,concat(nom1,' ',nom2,' ',ape1,' ',ape2) nombre,
								       c.nombre     medico,    c.especialidad      especialidad,'PRIMERA VEZ'     tipo_consulta,
											 d.id_adm_hosp,
								       e.nom_eps  eps,
											 j.nom_sedes sede
								FROM   adm_hospitalario d, hc_sm_pv a, pacientes b, user c, eps e,sedes_ips j
								WHERE   d.tipo_servicio = 'Consulta Externa SM'  AND d.id_adm_hosp = a.id_adm_hosp
																																 AND b.id_paciente = d.id_paciente
																																 AND c.id_user = a.id_user
																																 AND a.freg_hcsm_pv BETWEEN '".$f1."' AND '".$f2."'
																																 AND e.id_eps = d.id_eps
																																 AND j.id_sedes_ips=d.id_sedes_ips

								UNION

								SELECT a.freg_evomed fecha,doc_pac doc,concat(nom1,' ',nom2,' ',ape1,' ',ape2) nombre,
											 c.nombre     medico,    c.especialidad       especialidad,    'CONTROL'   tipo_consulta,
											 d.id_adm_hosp,
											 e.nom_eps  eps,
											 j.nom_sedes sede
								FROM   adm_hospitalario d,evolucion_medica a,pacientes b,user c,eps e,sedes_ips j
								WHERE   d.tipo_servicio = 'Consulta Externa SM'  AND d.id_adm_hosp = a.id_adm_hosp
																																 AND b.id_paciente = d.id_paciente
																																 AND c.id_user = a.id_user
																																 AND a.freg_evomed BETWEEN '".$f1."' AND '".$f2."'
																																 AND e.id_eps = d.id_eps
																																 AND j.id_sedes_ips=d.id_sedes_ips

								UNION

								SELECT a.freg_evomed fecha,doc_pac doc,concat(nom1,' ',nom2,' ',ape1,' ',ape2) nombre,
											 c.nombre medico,c.especialidad especialidad,'CONTROL HOSPITALIZADO' tipo_consulta,
											 d.id_adm_hosp,
											 e.nom_eps  eps,
											 j.nom_sedes sede
								FROM   adm_hospitalario d,evolucion_medica a,pacientes b,user c,eps e,sedes_ips j
								WHERE d.tipo_servicio = 'Hospitalario'  AND d.id_adm_hosp = a.id_adm_hosp
																																 AND b.id_paciente = d.id_paciente
																																 AND c.id_user = a.id_user
																																 AND a.freg_evomed BETWEEN '".$f1."'	AND '".$f2."'
																																 AND c.especialidad = 'PSIQUIATRIA INFANTIL'
																																 AND e.id_eps = d.id_eps
																																 AND j.id_sedes_ips=d.id_sedes_ips
								UNION

								SELECT a.freg_evo_psico fecha,doc_pac doc,concat(nom1,' ',nom2,' ',ape1,' ',ape2) nombre,
											 c.nombre medico,c.especialidad especialidad,'CONTROL PSICOLOGIA' tipo_consulta,
											 d.id_adm_hosp,
											 e.nom_eps  eps,
											 j.nom_sedes sede
							  FROM   adm_hospitalario d,evo_psicologia a,pacientes b,user c,eps e,sedes_ips j
							  WHERE d.tipo_servicio = 'Consulta Externa SM'  AND d.id_adm_hosp = a.id_adm_hosp
																												AND b.id_paciente = d.id_paciente
																												AND c.id_user = a.id_user
																												AND a.freg_evo_psico BETWEEN '".$f1."'	AND '".$f2."'
																												AND c.especialidad = 'PSICOLOGIA'
																												AND e.id_eps = d.id_eps
																												AND j.id_sedes_ips=d.id_sedes_ips
								UNION

								SELECT a.freg_psicoce_sm fecha,doc_pac doc,concat(nom1,' ',nom2,' ',ape1,' ',ape2) nombre,
											 c.nombre medico,c.especialidad especialidad,'PRIMERA VEZ PSICOLOGIA' tipo_consulta,
											 d.id_adm_hosp,
											 e.nom_eps  eps,
											 j.nom_sedes sede
								FROM   adm_hospitalario d,psico_ce_sm a,pacientes b,user c,eps e,sedes_ips j
								WHERE d.tipo_servicio = 'Consulta Externa SM'  AND d.id_adm_hosp = a.id_adm_hosp
																												AND b.id_paciente = d.id_paciente
																												AND c.id_user = a.id_user
																												AND a.freg_psicoce_sm BETWEEN '".$f1."'	AND '".$f2."'
																												AND c.especialidad = 'PSICOLOGIA'
																												AND e.id_eps = d.id_eps
																												AND j.id_sedes_ips=d.id_sedes_ips
							 ORDER BY 1
								";

								}
								if ($reporte==8 && $doc!='') {
									echo'<table class="table table-bordered table-responsive table-hover" id="Exportar_a_Excel">
										<tr>
											<th>IDENTIFICACION</th>
											<th>PACIENTE</th>
											<th></th>
										</tr>';

										$sql="SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
 									 							 b.id_adm_hosp,clase_dx_hosp

 												 FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)

 												WHERE b.id_sedes_ips in (2,8) and b.estado_adm_hosp='Activo'
 																										and b.clase_dx_hosp='Institucionalizado'
 																										and b.id_eps in ($eps)
																										and a.doc_pac=$doc
 												 														and b.tipo_servicio='Hospitalario' order by 2 ASC";
										}
										if ($reporte==8 && $doc=='') {
											echo'<table class="table table-bordered table-responsive table-hover" id="Exportar_a_Excel">
												<tr>
													<th>IDENTIFICACION</th>
													<th>PACIENTE</th>
													<th></th>
												</tr>';
												$sql="SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
		 									 							 b.id_adm_hosp,clase_dx_hosp

		 												 FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)

		 												WHERE b.id_sedes_ips in (2,8) and b.estado_adm_hosp='Activo'
		 																										and b.clase_dx_hosp='Institucionalizado'
		 																										and b.id_eps in ($eps)
		 												 														and b.tipo_servicio='Hospitalario' order by 2 ASC";
												}
								if ($reporte==3) {
									echo'<table class="table table-bordered table-responsive table-hover" id="Exportar_a_Excel">
										<tr>
											<th>IDENTIFICACION</th>
											<th>PACIENTE</th>
											<th>ESPECIALIDAD</th>
											<th>CANTIDADES</th>
										</tr>';
										$sql="SELECT a.doc_pac,nom1,nom2,ape1,ape2,
													 b.id_adm_hosp,
													 count(c.id_evo_psico) cuantos,'PSICOLOGIA' tipo
										FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																		 INNER JOIN evo_psicologia c on b.id_adm_hosp=c.id_adm_hosp
										WHERE a.doc_pac = '".$doc."'  and c.freg_evo_psico BETWEEN '".$f1."'  and '".$f2."'
										group by b.id_adm_hosp
										UNION
										SELECT a.doc_pac,nom1,nom2,ape1,ape2,
													 b.id_adm_hosp,
													 count(c.id_evoto) cuantos,'OCUPACIONAL' tipo
										FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																		 INNER JOIN evo_to c on b.id_adm_hosp=c.id_adm_hosp
										WHERE a.doc_pac = '".$doc."'  and c.freg_evoto BETWEEN '".$f1."'  and '".$f2."'
										group by b.id_adm_hosp

										UNION

										SELECT a.doc_pac,nom1,nom2,ape1,ape2,
													 b.id_adm_hosp,
													 count(c.id_evomed) cuantos,'PSIQUIATRIA' tipo
										FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																		 INNER JOIN evolucion_medica c on b.id_adm_hosp=c.id_adm_hosp
									  WHERE a.doc_pac = '".$doc."'  and c.freg_evomed BETWEEN '".$f1."'  and '".$f2."'
										group by b.id_adm_hosp

										UNION

										SELECT a.doc_pac,nom1,nom2,ape1,ape2,
													 b.id_adm_hosp,
													 count(c.id_evonutri) cuantos,'NUTRICION' tipo
										FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																		 INNER JOIN evo_nutrism c on b.id_adm_hosp=c.id_adm_hosp
									  WHERE a.doc_pac = '".$doc."'  and c.freg_nutrice_sm BETWEEN '".$f1."'  and '".$f2."'
										group by b.id_adm_hosp
										";

										}
										if ($reporte==7 && $doc=='') {
											echo'<table class="table table-bordered table-responsive table-hover" id="Exportar_a_Excel">
												<tr>
													<th>IDENTIFICACION</th>
													<th>PACIENTE</th>
													<th>SEDE</th>
													<th>ESPECIALIDAD</th>
													<th>CANTIDADES</th>
												</tr>';
												$sql="SELECT a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes,
                                		 count(c.id_evohd) cuantos, 'PSICOLOGIA' tipo
														  FROM pacientes a  INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
                                            		INNER JOIN evo_psicohd_sm c on b.id_adm_hosp=c.id_adm_hosp
                    														INNER JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips
															WHERE c.freg_evohd BETWEEN '$f1' and '$f2'
																						AND   b.tipo_servicio = 'Hospital dia'
																						GROUP BY a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes
															UNION

															SELECT a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes,
			                                		 count(c.id_evo_psico) cuantos, 'PSICOLOGIA' tipo
																	  FROM pacientes a  INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
			                                            		INNER JOIN evo_psicologia c on b.id_adm_hosp=c.id_adm_hosp
			                    														INNER JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips
																		WHERE c.freg_evo_psico BETWEEN '$f1' and '$f2'
																									AND   b.tipo_servicio = 'Hospital dia'
																									GROUP BY a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes

															UNION

															SELECT a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes,
                										 count(c.id_evoto) cuantos,'OCUPACIONAL' tipo
															FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																							 INNER JOIN evo_tohd_sm c on b.id_adm_hosp=c.id_adm_hosp
                    													 INNER JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips
															WHERE c.freg_evoto  BETWEEN '$f1' and '$f2'
																																AND b.tipo_servicio = 'Hospital dia'
																																GROUP BY a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes
															UNION

															SELECT a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes,
																			count(c.id_evoto) cuantos,'OCUPACIONAL' tipo
															FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																								INNER JOIN evo_to c on b.id_adm_hosp=c.id_adm_hosp
																							 INNER JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips
															WHERE c.freg_evoto  BETWEEN '$f1' and '$f2'
																																AND b.tipo_servicio = 'Hospital dia'
																																GROUP BY a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes
															UNION

															SELECT a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes,
  																	 count(c.id_evomed) cuantos, 'PSIQUIATRIA' tipo
															FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																					 INNER JOIN evo_medhd c on b.id_adm_hosp=c.id_adm_hosp
                    											 INNER JOIN user d on d.id_user = c.id_user
                    											 INNER JOIN perfil e on e.id_perfil = d.id_perfil
                    	                     INNER JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips
															WHERE c.freg_evomed BETWEEN '$f1' and '$f2'
															AND b.tipo_servicio = 'Hospital dia'
															AND e.id_perfil = 3
															GROUP BY a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes
											UNION
											SELECT a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes,
					  									count(c.id_evomed) cuantos,
					  								'MEDICINA GENERAL' tipo
								    	FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
                                   INNER JOIN evo_medhd c on b.id_adm_hosp=c.id_adm_hosp
                    							 INNER JOIN user d on d.id_user = c.id_user
                    							 INNER JOIN perfil e on e.id_perfil = d.id_perfil
                    	INNER JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips
											WHERE c.freg_evomed BETWEEN '$f1' and '$f2'
											AND b.tipo_servicio = 'Hospital dia'
											AND e.id_perfil = 4
											GROUP BY a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes

											UNION
											SELECT a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes,
  														count(c.id_evoto) cuantos,'NUTRICION' tipo
											FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
                                 	INNER JOIN evo_nthd_sm c on b.id_adm_hosp=c.id_adm_hosp
                 									INNER JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips
											WHERE c.freg_evoto BETWEEN '$f1' and '$f2'
														AND b.tipo_servicio = 'Hospital dia'
														GROUP BY a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes

											UNION
											SELECT a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes,
		  												count(c.id_notahd) cuantos,'ENFERMERIA' tipo
												 FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
		                                 			INNER JOIN nota_hd_sm c on b.id_adm_hosp=c.id_adm_hosp
		                                 			INNER JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips
												WHERE c.freg_notahd BETWEEN '$f1' and '$f2'
																			AND b.tipo_servicio = 'Hospital dia'
																			GROUP BY a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes
																			ORDER BY 1,2
												";

												}
												if ($reporte==7 && $doc!='') {
													echo'<table class="table table-bordered table-responsive table-hover" id="Exportar_a_Excel">
														<tr>
															<th>IDENTIFICACION</th>
															<th>PACIENTE</th>
															<th>SEDE</th>
															<th>ESPECIALIDAD</th>
															<th>CANTIDADES</th>
														</tr>';
														$sql="SELECT a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes,
		                                		 count(c.id_evohd) cuantos, 'PSICOLOGIA' tipo
																  FROM pacientes a  INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
		                                            		INNER JOIN evo_psicohd_sm c on b.id_adm_hosp=c.id_adm_hosp
		                    														INNER JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips
																	WHERE c.freg_evohd BETWEEN '$f1' and '$f2' and a.doc_pac='$doc'
																								AND   b.tipo_servicio = 'Hospital dia'
																								GROUP BY a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes
																	UNION

																	SELECT a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes,
		                										 count(c.id_evoto) cuantos,'OCUPACIONAL' tipo
																	FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																									 INNER JOIN evo_tohd_sm c on b.id_adm_hosp=c.id_adm_hosp
		                    													 INNER JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips
																	WHERE c.freg_evoto  BETWEEN '$f1' and '$f2' and a.doc_pac='$doc'
																																		AND b.tipo_servicio = 'Hospital dia'
																																		GROUP BY a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes
																																		UNION

																																		SELECT a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes,
																																						count(c.id_evoto) cuantos,'OCUPACIONAL' tipo
																																		FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																																											INNER JOIN evo_to c on b.id_adm_hosp=c.id_adm_hosp
																																										 INNER JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips
																																		WHERE c.freg_evoto  BETWEEN '$f1' and '$f2'
																																																			AND b.tipo_servicio = 'Hospital dia'
																																																			GROUP BY a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes
																	UNION

																	SELECT a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes,
		  																	 count(c.id_evomed) cuantos, 'PSIQUIATRIA' tipo
																	FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																							 INNER JOIN evo_medhd c on b.id_adm_hosp=c.id_adm_hosp
		                    											 INNER JOIN user d on d.id_user = c.id_user
		                    											 INNER JOIN perfil e on e.id_perfil = d.id_perfil
		                    	                     INNER JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips
																	WHERE c.freg_evomed BETWEEN '$f1' and '$f2' and a.doc_pac='$doc'
																	AND b.tipo_servicio = 'Hospital dia'
																	AND e.id_perfil = 3
																	GROUP BY a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes
													UNION
													SELECT a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes,
							  									count(c.id_evomed) cuantos,
							  								'MEDICINA GENERAL' tipo
										    	FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
		                                   INNER JOIN evo_medhd c on b.id_adm_hosp=c.id_adm_hosp
		                    							 INNER JOIN user d on d.id_user = c.id_user
		                    							 INNER JOIN perfil e on e.id_perfil = d.id_perfil
		                    	INNER JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips
													WHERE c.freg_evomed BETWEEN '$f1' and '$f2' and a.doc_pac='$doc'
													AND b.tipo_servicio = 'Hospital dia'
													AND e.id_perfil = 4
													GROUP BY a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes

													UNION
													SELECT a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes,
		  														count(c.id_evoto) cuantos,'NUTRICION' tipo
													FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
		                                 	INNER JOIN evo_nthd_sm c on b.id_adm_hosp=c.id_adm_hosp
		                 									INNER JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips
													WHERE c.freg_evoto BETWEEN '$f1' and '$f2' and a.doc_pac='$doc'
																AND b.tipo_servicio = 'Hospital dia'
																GROUP BY a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes

													UNION
													SELECT a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes,
				  												count(c.id_notahd) cuantos,'ENFERMERIA' tipo
														 FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
				                                 			INNER JOIN nota_hd_sm c on b.id_adm_hosp=c.id_adm_hosp
				                                 			INNER JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips
														WHERE c.freg_notahd BETWEEN '$f1' and '$f2' and a.doc_pac='$doc'
																					AND b.tipo_servicio = 'Hospital dia'
																					GROUP BY a.doc_pac,nom1,nom2,ape1,ape2,f.nom_sedes
																					ORDER BY 1,2
														";

														}
										if ($reporte==4) {
											echo'<table class="table table-bordered table-responsive table-hover" >
												<tr>
													<th>CONTROL DOCUMENTAL SALUD MENTAL</th>
														<td class="text-right" colspan="10">
															<a href="rptexcel/SM/rptSMdocumental.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
															<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
														</td>
												</tr>
												<tr>
													<th>SEDE</th>
													<th>EPS</th>
													<th>PACIENTE</th>
													<th>IDENTIFICACION</th>
													<th>INGRESO/<br>EGRESO</th>
													<th>DI</th>
													<th>AUTORIZACION</th>
													<th>CONSENTIMIENTO<br>INFORMADO</th>
													<th>EPICRISIS</th>
													<th>PAGARE</th>
												</tr>';

												$sql="SELECT IF(a.id_sedes_ips=2,'Faca','Bogota') ciudad,
														c.nom_eps,
														b.doc_pac,b.nom1,b.nom2,b.ape1,b.ape2,b.id_paciente,
														a.fingreso_hosp,
														a.fegreso_hosp,
														concat(documentos_paciente(b.id_paciente,'Documento Identidad')) documento,
														concat(documentos_paciente(b.id_paciente,'Autorizacion EPS')) autorizacion,
														concat(documentos_paciente(b.id_paciente,'Consentimiento Informado')) Consentimiento_Inf,
														concat(documentos_paciente(b.id_paciente,'Consentimiento Procedimientos')) Consentimiento_Proc,
														concat(documentos_paciente(b.id_paciente,'Epicrisis')) Epicrisis,
														concat(documentos_paciente(b.id_paciente,'Pagare')) Pagare

														from adm_hospitalario a, pacientes b,eps c
														WHERE  b.id_paciente = a.id_paciente AND a.tipo_servicio = 'Hospitalario'
																																 AND ( IFNULL(a.fegreso_hosp,0) = 0 OR (a.fegreso_hosp between CAST('$f1' AS DATE) AND CAST('$f2' AS DATE) ) )
																																 AND a.id_sedes_ips IN (2,8)
																																 AND c.id_eps = a.id_eps
														ORDER BY 1,2,3 ASC
														";
												}
												if ($reporte==5 && $doc=='') {
													echo'<table class="table table-bordered table-responsive table-hover" >
														<tr>
															<th>EPS</th>
															<th>PACIENTE</th>
															<th>ID PRODUCTO</th>
															<th>COD EPS</th>
															<th>MEDICAMENTO</th>
															<th>CLASIFICACION</th>
															<th>DOSIS ADMINISTRADA</th>
															<th>TOTAL UNIDADES</th>
															<th>VALOR COBRAR</th>
														</tr>';
														$eps1=$_REQUEST['eps'];
														if ($eps1=='T') {
															$eps='1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30';
														}else {
															$eps=$_REQUEST['eps'];
														}
														$sql="SELECT f.nom_eps,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
																				 b.fingreso_hosp,b.fegreso_hosp,
																				 b.id_adm_hosp,
																				 g.id_producto,pos,altocosto,exepcion,dx_formula,dx1_formula,dx2_formula,
																				 d.medicamento,rad_mipres,tipo_mipres,
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
																	WHERE c.tipo_formula in ('Programada','Evento') and c.estado_m_fmedhosp='solicitado' and e.estado_dosi='Dosificado'
																	and freg_farmacia between CAST('$f1' AS DATE) and  CAST('$f2' AS DATE) and f.id_eps in ($eps)
																	GROUP BY f.nom_eps,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,b.fingreso_hosp,b.fegreso_hosp,b.id_adm_hosp,d.medicamento,rad_mipres,tipo_mipres,g.unidad
																	ORDER BY 1,3
																		";
																		 //echo $sql;
														}
														if ($reporte==5 && $doc!='') {
															echo'<table class="table table-bordered table-responsive table-hover" >
																<tr>
																	<th>EPS</th>
																	<th>PACIENTE</th>
																	<th>ID PRODUCTO</th>
																	<th>COD EPS</th>
																	<th>MEDICAMENTO</th>
																	<th>CLASIFICACION</th>
																	<th>DOSIS ADMINISTRADA</th>
																	<th>TOTAL UNIDADES</th>
																	<th>VALOR COBRAR</th>
																</tr>';
																$doc=$_REQUEST['doc'];
																$sql="SELECT f.nom_eps,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
																						 b.fingreso_hosp,b.fegreso_hosp,
																						 b.id_adm_hosp,
																						 g.id_producto,pos,altocosto,exepcion,dx_formula,dx1_formula,dx2_formula,
																						 d.medicamento,rad_mipres,tipo_mipres,
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
																			WHERE c.tipo_formula in ('Programada','Evento') and  c.estado_m_fmedhosp='solicitado' and e.estado_admin='Administrado'  and freg_farmacia between '$f1' and '$f2' and a.doc_pac=$doc
																			GROUP BY f.nom_eps,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,b.fingreso_hosp,b.fegreso_hosp,b.id_adm_hosp,medicamento,rad_mipres,tipo_mipres,g.unidad
																			ORDER BY 1,3
																				";
																}
																if ($reporte==6 && $doc=='') {
																	echo'<table class="table table-bordered table-responsive table-hover" >
																		<tr>
																			<th>PACIENTE</th>
																			<th>IDENTIFICACION</th>
																			<th>TIPO TERAPIA</th>
																			<th>CANTIDAD</th>
																		</tr>';
																		$sql="SELECT a.doc_pac,nom1,nom2,ape1,ape2,
																							   f.nom_sedes,
																							   c.id_evotera,freg_evotera, hreg_evotera, evoluciontera, tterapia, estado_evotera

																						FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																						                 INNER JOIN evo_terapeutica_sm c on b.id_adm_hosp=c.id_adm_hosp

																										 INNER JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips

																						WHERE c.freg_evotera BETWEEN '$f1' and '$f2'
																			AND b.tipo_servicio = 'Hospitalario' ";

																}
																if ($reporte==6 && $doc!='') {
																	echo'<table class="table table-bordered table-responsive table-hover" >
																		<tr>
																			<th>PACIENTE</th>
																			<th>IDENTIFICACION</th>
																			<th>TIPO TERAPIA</th>
																			<th>CANTIDAD</th>
																		</tr>';
																		$doc=$_REQUEST['doc'];
																		$sql="SELECT a.doc_pac,nom1,nom2,ape1,ape2,
																							   f.nom_sedes,
																							   c.id_evotera,freg_evotera, hreg_evotera, evoluciontera, tterapia, estado_evotera

																						FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																						                 INNER JOIN evo_terapeutica_sm c on b.id_adm_hosp=c.id_adm_hosp

																										 INNER JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips

																						WHERE c.freg_evotera BETWEEN '$f1' and '$f2' and a.doc_pac='$doc'
																			AND b.tipo_servicio = 'Hospitalario' ";

																}
																if ($reporte==9 && $doc=='') {
																	echo'<table class="table table-bordered">
																				<tr>
																					<th>INFORME DE GASTO PROCEDIMIENTOS HOSPITALARIOS</th>
																					<td class="text-right">
																					<a href="rptexcel/SM/rptprocedimientos.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
																					<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
																					<a href="rptpdf/SM/rptprocedimientos.php?f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
																					<button type="button" class="btn btn-danger " ><span class="fa fa-file-pdf-o"></span> Exportar pdf</button></a>
																					</td>
																				</tr>
																	</table>';
																	echo'<table class="table table-bordered table-responsive table-hover" >
																		<tr>
																			<th>#</th>
																			<th>EPS</th>
																			<th>PACIENTE</th>
																			<th>INGRESO/<br>EGRESO</th>
																			<th>ORDEN</th>
																			<th>FECHAS</th>
																			<th>PROCEDIMIENTO</th>
																			<th>ESTADO</th>
																		</tr>';
																		$doc=$_REQUEST['doc'];
																		$sql="SELECT a.doc_pac,nom_completo,
																								 b.id_adm_hosp,fingreso_hosp,fegreso_hosp,
       																	 	       c.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
																								 d.id_d_procedimiento, freg, cod_cups, procedimiento, observacion,
																								 estado_prod, freg_muestra, resp_muestra, obs_muestra,freg_procesa, resp_procesa, obs_procesa,
																								 freg_inter, nota_inter, resp_inter,
																								 e.nom_eps,
																								 f.nom_sedes
																				  FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
				 																									 LEFT JOIN master_procedimiento c on c.id_adm_hosp=b.id_adm_hosp
                 												 									 LEFT JOIN detalle_procedimiento d on d.id_master_prod = c.id_master_prod
																													 LEFT JOIN eps e on e.id_eps = b.id_eps
																													 LEFT JOIN sedes_ips f on f.id_sedes_ips = b.id_sedes_ips
																					WHERE d.freg BETWEEN '$f1' and '$f2' and b.id_sedes_ips in ($sede) and b.id_eps in ($eps)
																					ORDER BY d.estado_prod ASC, e.nom_eps ASC, a.doc_pac ASC";
																		}
																		if ($reporte==10 ) {
																			echo'<table class="table table-bordered">
																						<tr>
																							<th>INFORME DE EGRESOS HOSPITALARIOS <strong class="lead text-primary">'.$_REQUEST['doc'].'</strong></th>
																							<td class="text-right">
																							<a href="rptexcel/SM/rptEgreso1.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'&doc='.$_REQUEST["doc"].'">
																							<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
																							<a href="rptpdf/SM/rptEgresos1.php?f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'&doc='.$_REQUEST["doc"].'">
																							<button type="button" class="btn btn-danger " ><span class="fa fa-file-pdf-o"></span> Exportar pdf</button></a>
																							</td>
																						</tr>
																			</table>';
																			echo'<table class="table table-bordered table-responsive table-hover" >
																				<tr>
																					<th>#</th>
																					<th>PACIENTE</th>
																					<th>EPS</th>
																					<th>INGRESO/<br>EGRESO</th>
																					<th>CLASIFICACIÓN DX</th>
																					<th>PLAN TRATAMIENTO Y<br>DX EPICRISIS</th>
																					<th>ORDENES DE SERVICIO</th>
																					<th>ESTADO PACIENTE</th>
																				</tr>';
																				$doc=$_REQUEST['doc'];
																				if ($doc=='') {
																					$sql="SELECT a.doc_pac,nom_completo,
																											 b.id_adm_hosp,fingreso_hosp,fegreso_hosp,estado_adm_hosp,clase_dx_hosp,estado_salida,
																											 h.descrimuni,
																											 e.nom_eps,
																											 c.ddxp_epi,plant_epicrisis,
																											 d.ddxp
																								FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																																 INNER JOIN eps e on e.id_eps = b.id_eps
																																 LEFT JOIN epicrisis c on b.id_adm_hosp=c.id_adm_hosp
																																 LEFT JOIN hc_hospitalario d on b.id_adm_hosp=d.id_adm_hosp
																																 LEFT JOIN municipios h on (h.codmuni=b.mun_residencia)
																								WHERE b.fegreso_hosp BETWEEN '$f1' and '$f2' and b.id_sedes_ips in ($sede) and b.id_eps in ($eps) and estado_adm_hosp<>'Activo' and b.tipo_servicio='Hospitalario'
																								ORDER BY b.estado_adm_hosp ASC, e.nom_eps ASC, a.doc_pac ASC";
																				}else {
																					$sql="SELECT a.doc_pac,nom_completo,
																											 b.id_adm_hosp,fingreso_hosp,fegreso_hosp,estado_adm_hosp,clase_dx_hosp,
																											 h.descrimuni,
																											 e.nom_eps,
																											 c.ddxp_epi,plant_epicrisis,
																											 d.ddxp
																								FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																																 INNER JOIN eps e on e.id_eps = b.id_eps
																																 LEFT JOIN epicrisis c on b.id_adm_hosp=c.id_adm_hosp
																																 LEFT JOIN hc_hospitalario d on b.id_adm_hosp=d.id_adm_hosp
																																 LEFT JOIN municipios h on (h.codmuni=a.mun_residencia)
																								WHERE b.fegreso_hosp BETWEEN '$f1' and '$f2' and b.id_sedes_ips in ($sede) and b.id_eps in ($eps) and a.doc_pac='$doc' and estado_adm_hosp<>'Activo' and b.tipo_servicio='Hospitalario'
																								ORDER BY b.estado_adm_hosp ASC, e.nom_eps ASC, a.doc_pac ASC";
																				}
																			}

								$i=1;
							//echo $sql;
						if ($tabla=$bd1->sub_tuplas($sql)){

							foreach ($tabla as $fila ) {
								if ($reporte==1) {
									echo"<tr >\n";
									echo'<td class="text-left"><strong>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].' <br /><strong> ADM: </strong>'.$fila["id_adm_hosp"].'</td>';
									echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
									echo'<td class="text-center">
												<p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>';
												if ($fila["fegreso_hosp"]=='') {
													echo'<p class="text-danger">SIN EGRESO</p>';
												}else {
													echo'<p><strong>Egreso: </strong> '.$fila["fegreso_hosp"].'</p>';
												}
									echo'</td>';
									echo'<td class="text-center">'.$fila["nom_eps"].'</td>';
									echo'<td class="text-center">'.$fila["difer1"].'</td>';
									echo'<td class="text-center">'.$fila["estado_adm_hosp"].'</td>';
									$edad=$fila["doc_pac"];
									$idpaciente=$fila["id_paciente"];
									$cie=$fila["edad"];
									$eps=$fila["nom_eps"];
									echo "</tr>\n";
								}
								if ($reporte==2) {
									$i=1;
									if ($fila["tipo_consulta"]=='PRIMERA VEZ') {
										echo"<tr >\n";
										echo'<td class="text-center alert-info"><strong>'.$fila["fecha"].' </strong></td>';
										echo'<td class="text-center alert-info">'.$fila["nombre"].' </td>';
										echo'<td class="text-center alert-info">'.$fila["doc"].' </td>';
										echo'<td class="text-center alert-info">'.$fila["medico"].' </td>';
										echo'<td class="text-center alert-info">'.$fila["especialidad"].' </td>';
										echo'<td class="text-center alert-info">'.$fila["tipo_consulta"].' </td>';
										echo'<td class="text-center alert-info">'.$fila["eps"].' </td>';
										echo'<td class="text-center alert-info">'.$fila["id_adm_hosp"].' </td>';

									}
									if ($fila["tipo_consulta"]=='CONTROL') {
										echo"<tr >\n";

										echo'<td class="text-center alert-warning"><strong>'.$fila["fecha"].' </strong></td>';
										echo'<td class="text-center alert-warning">'.$fila["nombre"].' </td>';
										echo'<td class="text-center alert-warning">'.$fila["doc"].' </td>';
										echo'<td class="text-center alert-warning">'.$fila["medico"].' </td>';
										echo'<td class="text-center alert-warning">'.$fila["especialidad"].' </td>';
										echo'<td class="text-center alert-warning">'.$fila["tipo_consulta"].' </td>';
										echo'<td class="text-center alert-warning">'.$fila["eps"].' </td>';
										echo'<td class="text-center alert-warning">'.$fila["id_adm_hosp"].' </td>';

									}
									if ($fila["tipo_consulta"]=='CONTROL HOSPITALIZADO') {
										echo"<tr >\n";

										echo'<td class="text-center alert-success"><strong>'.$fila["fecha"].' </strong></td>';
										echo'<td class="text-center alert-success">'.$fila["nombre"].' </td>';
										echo'<td class="text-center alert-success">'.$fila["doc"].' </td>';
										echo'<td class="text-center alert-success">'.$fila["medico"].' </td>';
										echo'<td class="text-center alert-success">'.$fila["especialidad"].' </td>';
										echo'<td class="text-center alert-success">'.$fila["tipo_consulta"].' </td>';
										echo'<td class="text-center alert-success">'.$fila["eps"].' </td>';
										echo'<td class="text-center alert-success">'.$fila["id_adm_hosp"].' </td>';

									}
									if ($fila["tipo_consulta"]=='CONTROL PSICOLOGIA') {
										echo"<tr >\n";

										echo'<td class="text-center"><strong>'.$fila["fecha"].' </strong></td>';
										echo'<td class="text-center">'.$fila["nombre"].' </td>';
										echo'<td class="text-center">'.$fila["doc"].' </td>';
										echo'<td class="text-center">'.$fila["medico"].' </td>';
										echo'<td class="text-center">'.$fila["especialidad"].' </td>';
										echo'<td class="text-center">'.$fila["tipo_consulta"].' </td>';
										echo'<td class="text-center">'.$fila["eps"].' </td>';
										echo'<td class="text-center">'.$fila["id_adm_hosp"].' </td>';

									}
									if ($fila["tipo_consulta"]=='PRIMERA VEZ PSICOLOGIA') {
										echo"<tr >\n";

										echo'<td class="text-center"><strong>'.$fila["fecha"].' </strong></td>';
										echo'<td class="text-center">'.$fila["nombre"].' </td>';
										echo'<td class="text-center">'.$fila["doc"].' </td>';
										echo'<td class="text-center">'.$fila["medico"].' </td>';
										echo'<td class="text-center">'.$fila["especialidad"].' </td>';
										echo'<td class="text-center">'.$fila["tipo_consulta"].' </td>';
										echo'<td class="text-center">'.$fila["eps"].' </td>';
										echo'<td class="text-center">'.$fila["id_adm_hosp"].' </td>';

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
								if ($reporte==8) {
									echo"<tr >\n";
									echo'<td class="text-center">'.$fila["paciente"].'</td>';
									echo'<td class="text-center"><strong>'.$fila["tdoc_pac"].'</strong> '.$fila["doc_pac"].'</td>';
									echo'<td class="text-center"><a href="rpt_orden_fac.php?doc='.$fila["doc_pac"].'&idadm='.$fila["id_adm_hosp"].'&f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-print"></span></button></a></td>';
									echo"</tr>";
								}
								if ($reporte==7) {

										echo"<tr >\n";
										echo'<td class="text-center"><strong>'.$fila["doc_pac"].'</strong></td>';
										echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
										echo'<td class="text-center">'.$fila["nom_sedes"].' </td>';
										echo'<td class="text-center">'.$fila["tipo"].' </td>';
										echo'<td class="text-center">'.$fila["cuantos"].' </td>';
										echo"</tr>";
								}
								if ($reporte==4) {

										echo"<tr >\n";
										echo'<td class="text-center"><strong>'.$fila["ciudad"].'</strong></td>';
										echo'<td class="text-center"><strong>'.$fila["nom_eps"].'</strong></td>';
										echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
										echo'<td class="text-center">'.$fila["doc_pac"].' </td>';
										echo'<td class="text-center"><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].' /

												 <br> <strong>Egreso: </strong>'.
												 $fe=$fila['fegreso_hosp'];
												 if ($fe=='') {
												 	echo 'Aún esta con nosotros';
												}else {
													$fila["fegreso_hosp"].'</td>';
												}
										if ($fila['documento']=='N0' ) {
											echo'<td class="text-center">
														<span class="fa fa-ban text-danger"></span>
														<p>
															 <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOC&idpac='.$fila["id_paciente"].'&doc='.$fila["doc_pac"].'&fecha1='.$_REQUEST["fecha1"].'&fecha2='.$_REQUEST["fecha2"].'&reporte='.$_REQUEST["reporte"].'">
																<button type="button" class="btn btn-success btn-xs"><span class="fa fa-upload"></span>
																</button>
															 </a>
														</p>
													 </td>';
										}else {
											echo'<td class="text-center"><span class="fa fa-check text-success"></span></td>';
										}
										if ($fila['autorizacion']=='N0' ) {
											echo'<td class="text-center">
														<span class="fa fa-ban text-danger"></span>
														<p>
															 <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOC&idpac='.$fila["id_paciente"].'&doc='.$fila["doc_pac"].'&fecha1='.$_REQUEST["fecha1"].'&fecha2='.$_REQUEST["fecha2"].'&reporte='.$_REQUEST["reporte"].'">
																<button type="button" class="btn btn-success btn-xs"><span class="fa fa-upload"></span>
																</button>
															 </a>
														</p>
													 </td>';
										}else {
											echo'<td class="text-center"><span class="fa fa-check text-success"></span></td>';
										}
										if ($fila['Consentimiento_Inf']=='N0' ) {
											echo'<td class="text-center">
														<span class="fa fa-ban text-danger"></span>
														<p>
															 <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOC&idpac='.$fila["id_paciente"].'&doc='.$fila["doc_pac"].'&fecha1='.$_REQUEST["fecha1"].'&fecha2='.$_REQUEST["fecha2"].'&reporte='.$_REQUEST["reporte"].'">
																<button type="button" class="btn btn-success btn-xs"><span class="fa fa-upload"></span>
																</button>
															 </a>
														</p>
													 </td>';
										}else {
											echo'<td class="text-center"><span class="fa fa-check text-success"></span></td>';
										}
										if ($fila['Epicrisis']=='N0' ) {
											echo'<td class="text-center">
														<span class="fa fa-ban text-danger"></span>
														<p>
															 <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOC&idpac='.$fila["id_paciente"].'&doc='.$fila["doc_pac"].'&fecha1='.$_REQUEST["fecha1"].'&fecha2='.$_REQUEST["fecha2"].'&reporte='.$_REQUEST["reporte"].'">
																<button type="button" class="btn btn-success btn-xs"><span class="fa fa-upload"></span>
																</button>
															 </a>
														</p>
													 </td>';
										}else {
											echo'<td class="text-center"><span class="fa fa-check text-success"></span></td>';
										}
										if ($fila['Pagare']=='N0' ) {
											echo'<td class="text-center">
														<span class="fa fa-ban text-danger"></span>
														<p>
															 <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOC&idpac='.$fila["id_paciente"].'&doc='.$fila["doc_pac"].'&fecha1='.$_REQUEST["fecha1"].'&fecha2='.$_REQUEST["fecha2"].'&reporte='.$_REQUEST["reporte"].'">
																<button type="button" class="btn btn-success btn-xs"><span class="fa fa-upload"></span>
																</button>
															 </a>
														</p>
													 </td>';
										}else {
											echo'<td class="text-center"><span class="fa fa-check text-success"></span></td>';
										}
										echo"</tr>";
								}
								if ($reporte==5) {

										echo"<tr >\n";
										echo'<td class="text-center"><strong>'.$fila["nom_eps"].'</strong></td>';
										echo'<td class="text-center">
													<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
													<p>'.$fila["doc_pac"].'</p>
													<p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].' /

															 <br> <strong>Egreso: </strong>'.
															 $fe=$fila['fegreso_hosp'];
															 if ($fe=='') {
															 	echo 'Aún esta con nosotros';
															}else {
																$fila["fegreso_hosp"].'';
															}
													echo'</p>';
										echo'</td>';
										echo'<td class="text-center">'.$fila["id_producto"].' </td>';
										echo'<td class="text-center">'.$fila["cod_eps_md"].' </td>';
										echo'<td class="text-center"><p>'.$fila["medicamento"].'</p>
										 														 <p class="text-danger">'.$fila["rad_mipres"].'</p></td>';
										echo'<td class="text-center">';
										$dx=$fila['dx_formula'];
										$dx1=$fila['dx1_formula'];
										$dx2=$fila['dx2_formula'];
										if ($fila['pos']==1) {
											echo'<p class="text-danger">NO POS ';
											//excepción para aripiprazol
											if ($dx == 'F321' || $dx == 'F322' || $dx == 'F323' || $dx == 'F331' || $dx == 'F332'|| $dx == 'F333'|| $dx == 'F320') {
												if ($fila['cod_med']==851 || $fila['cod_med']==1525 ) {
													echo'<p class="text-success"><strong>POS por dx</strong> </p>';
												}
											}
											//excepción para memantina
											if ($dx == 'F000' || $dx == 'F001' || $dx == 'F002' || $dx == 'F003' || $dx == 'F004'|| $dx == 'F005'|| $dx == 'F006' || $dx == 'F007' || $dx == 'F008' || $dx == 'F009') {
												if ($fila['cod_med']==1184 || $fila['cod_med']==1185 || $fila['cod_med']==1186 || $fila['cod_med']==1187 || $fila['cod_med']==1188) {
													echo'<p class="text-success"><strong>POS por dx</strong> </p>';
												}
											}
											//excepción para risperidona, olanzapina
											if ($dx == 'F200' || $dx == 'F201' || $dx == 'F202' || $dx == 'F203' || $dx == 'F204' ||
													$dx == 'F205' || $dx == 'F206' || $dx == 'F207' || $dx == 'F208' || $dx == 'F209' ||
													$dx == 'F300' || $dx == 'F301' || $dx == 'F302' || $dx == 'F303' || $dx == 'F304' ||
													$dx == 'F305' || $dx == 'F306' || $dx == 'F307' || $dx == 'F308' || $dx == 'F309' ||
													$dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F313' || $dx == 'F314' ||
													$dx == 'F315' || $dx == 'F316' || $dx == 'F317' || $dx == 'F318' || $dx == 'F319' ||
													$dx == 'F000' || $dx == 'F001' || $dx == 'F002' || $dx == 'F003' || $dx == 'F004' ||
													$dx == 'F005' || $dx == 'F006' || $dx == 'F007' || $dx == 'F008' || $dx == 'F009' ||
													$dx == 'F010' || $dx == 'F011' || $dx == 'F012' || $dx == 'F013' || $dx == 'F014' ||
													$dx == 'F015' || $dx == 'F016' || $dx == 'F017' || $dx == 'F018' || $dx == 'F019' ||
													$dx == 'F020' || $dx == 'F021' || $dx == 'F022' || $dx == 'F023' || $dx == 'F024' ||
													$dx == 'F025' || $dx == 'F026' || $dx == 'F027' || $dx == 'F028' || $dx == 'F029' ||
													$dx == 'F030' || $dx1 == 'F200' || $dx1 == 'F201' || $dx1 == 'F202' || $dx1 == 'F203' || $dx1 == 'F204' ||
													$dx1 == 'F205' || $dx1 == 'F206' || $dx1 == 'F207' || $dx1 == 'F208' || $dx1 == 'F209' ||
													$dx1 == 'F300' || $dx1 == 'F301' || $dx1 == 'F302' || $dx1 == 'F303' || $dx1 == 'F304' ||
													$dx1 == 'F305' || $dx1 == 'F306' || $dx1 == 'F307' || $dx1 == 'F308' || $dx1 == 'F309' ||
													$dx1 == 'F310' || $dx1 == 'F311' || $dx1 == 'F312' || $dx1 == 'F313' || $dx1 == 'F314' ||
													$dx1 == 'F315' || $dx1 == 'F316' || $dx1 == 'F317' || $dx1 == 'F318' || $dx1 == 'F319' ||
													$dx1 == 'F000' || $dx1 == 'F001' || $dx1 == 'F002' || $dx1 == 'F003' || $dx1 == 'F004' ||
													$dx1 == 'F005' || $dx1 == 'F006' || $dx1 == 'F007' || $dx1 == 'F008' || $dx1 == 'F009' ||
													$dx1 == 'F010' || $dx1 == 'F011' || $dx1 == 'F012' || $dx1 == 'F013' || $dx1 == 'F014' ||
													$dx1 == 'F015' || $dx1 == 'F016' || $dx1 == 'F017' || $dx1 == 'F018' || $dx1 == 'F019' ||
													$dx1 == 'F020' || $dx1 == 'F021' || $dx1 == 'F022' || $dx1 == 'F023' || $dx1 == 'F024' ||
													$dx1 == 'F025' || $dx1 == 'F026' || $dx1 == 'F027' || $dx1 == 'F028' || $dx1 == 'F029' ||
													$dx1 == 'F030' || $dx2 == 'F200' || $dx2 == 'F201' || $dx2 == 'F202' || $dx2 == 'F203' || $dx2 == 'F204' ||
													$dx2 == 'F205' || $dx2 == 'F206' || $dx2 == 'F207' || $dx2 == 'F208' || $dx2 == 'F209' ||
													$dx2 == 'F300' || $dx2 == 'F301' || $dx2 == 'F302' || $dx2 == 'F303' || $dx2 == 'F304' ||
													$dx2 == 'F305' || $dx2 == 'F306' || $dx2 == 'F307' || $dx2 == 'F308' || $dx2 == 'F309' ||
													$dx2 == 'F310' || $dx2 == 'F311' || $dx2 == 'F312' || $dx2 == 'F313' || $dx2 == 'F314' ||
													$dx2 == 'F315' || $dx2 == 'F316' || $dx2 == 'F317' || $dx2 == 'F318' || $dx2 == 'F319' ||
													$dx2 == 'F000' || $dx2 == 'F001' || $dx2 == 'F002' || $dx2 == 'F003' || $dx2 == 'F004' ||
													$dx2 == 'F005' || $dx2 == 'F006' || $dx2 == 'F007' || $dx2 == 'F008' || $dx2 == 'F009' ||
													$dx2 == 'F010' || $dx2 == 'F011' || $dx2 == 'F012' || $dx2 == 'F013' || $dx2 == 'F014' ||
													$dx2 == 'F015' || $dx2 == 'F016' || $dx2 == 'F017' || $dx2 == 'F018' || $dx2 == 'F019' ||
													$dx2 == 'F020' || $dx2 == 'F021' || $dx2 == 'F022' || $dx2 == 'F023' || $dx2 == 'F024' ||
													$dx2 == 'F025' || $dx2 == 'F026' || $dx2 == 'F027' || $dx2 == 'F028' || $dx2 == 'F029' ||
													$dx2 == 'F030') {
														if ($fila['id_producto']==1524 || $fila['id_producto']==1525 || $fila['id_producto']==1526 ||
																$fila['id_producto']==1527 || $fila['id_producto']==1528 || $fila['id_producto']==1529 ||
																$fila['id_producto']==1530 || $fila['id_producto']==1531 || $fila['id_producto']==1532 ||
																$fila['id_producto']==1348 || $fila['id_producto']==1349 || $fila['id_producto']==1350 ||
																$fila['id_producto']==1351 || $fila['id_producto']==1498 || $fila['id_producto']==1499 ||
																$fila['id_producto']==1500 || $fila['id_producto']==1501 || $fila['id_producto']==1502 ||
																$fila['id_producto']==1503 || $fila['id_producto']==193 || $fila['id_producto']==194 ||
																$fila['id_producto']==1415 || $fila['id_producto']==1416 ||
																$fila['id_producto']==1417 || $fila['id_producto']==1371 || $fila['id_producto']==1372 ||
																$fila['id_producto']==1542 || $fila['id_producto']==1543 || $fila['id_producto']==1544 ||
																$fila['id_producto']==1544 || $fila['id_producto']==1545 || $fila['id_producto']==1546 ||
																$fila['id_producto']==1547) {
															echo' POS por dx</p>';
														}
											}

										}else {
											echo'<p class="text-success">POS</p>';
										}
										echo'</td>';
										echo'<td class="text-center">'.$fila["dosis"].' </td>';
										$unidad=ceil($fila["unidades"]);
										echo'<td class="text-center">'.$unidad.' </td>';
										$tarifa=$fila['tarifa'];
										$total=$unidad*$tarifa;
										echo'<td class="text-center">$ '.$total.' </td>';
										echo"</tr>";
								}
								if ($reporte==6) {
									echo"<tr>";
									echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
									echo'<td class="text-center">'.$fila["doc_pac"].'</td>';
									echo'<td class="text-center">'.$fila["tterapia"].'</td>';

									echo"</tr>";
								}
								if ($reporte==9) {

									if ($fila["estado_prod"]=='Procesada') {
										echo"<tr >\n";
										echo'<td class="text-center "><strong>'.$i++.' </strong></td>';
										echo'<td class="text-left ">
													<p><strong>'.$fila["nom_eps"].' </strong></p>
													<p><strong>'.$fila["nom_sedes"].' </strong></p>
												 </td>';
										echo'<td class="text-left ">
													<p>'.$fila["nom_completo"].'</p>
													<p>'.$fila["doc_pac"].'</p>
												 </td>';
										echo'<td class="text-left ">
													<p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>';
													if ($fila['fegreso_hosp']=='') {
														echo'<p><strong>No hay egreso</strong></p>';
													}else {
														echo'<p><strong>Egreso: </strong>'.$fila["fegreso_hosp"].'</p>';
													}
										echo'</td>';
										echo'<td class="text-left ">';
													echo'<p>'.$fila["id_master_prod"].'</p>';
										echo'</td>';
										echo'<td class="text-left ">';
													echo'<p><strong>Solicitada: </strong>'.$fila["freg"].'</p>
															 <p><strong>Muestra: </strong>'.$fila["freg_muestra"].'</p>
															 <p><strong>Procesada: </strong>'.$fila["freg_procesa"].'</p>';
										echo'</td>';
										echo'<td class="text-left "><strong>'.$fila["cod_cups"].' </strong> '.$fila["procedimiento"].'</td>';
										echo'<td class="text-left ">
													<p>'.$fila["estado_prod"].'</p>';
													$idp=$fila['id_master_prod'];
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
																		echo'<p>No hay soporte en sistema</p>';
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
										echo'</td>';

										echo"</tr >\n";
									}
								}
								if ($reporte==10) {

									if ($fila["estado_adm_hosp"]=='Parcial' && $fila["estado_salida"]=='Tratamiento finalizado') {
										echo"<tr >\n";
										echo'<td class="text-center alert-info"><strong>'.$i++.' </strong></td>';
										echo'<td class="text-left alert-info">
													<p>'.$fila["nom_completo"].'</p>
													<p>'.$fila["doc_pac"].'</p>
												 </td>';
										echo'<td class="text-left alert-info">
													<p><strong>'.$fila["nom_eps"].' </strong></p>
													<p><strong>Municipio: </strong>'.$fila["descrimuni"].'</p>
												 </td>';
										echo'<td class="text-left alert-info">
													<p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>';
													if ($fila['fegreso_hosp']=='') {
														echo'<p><strong>No hay egreso</strong></p>';
													}else {
														echo'<p><strong>Egreso: </strong>'.$fila["fegreso_hosp"].'</p>';
													}
										echo'</td>';
										echo'<td class="text-left alert-info">';
													echo'<p>'.$fila["clase_dx_hosp"].'</p>';
										echo'</td>';
										echo'<td class="text-left alert-info">';
										echo'<p><strong>Ingreso: </strong>'.$fila["ddxp"].'</p>';
										echo'<p><strong>Egreso: </strong>'.$fila["ddxp_epi"].'<br>'.$fila["plant_epicrisis"].'</p>';
										echo'</td>';

										echo'<td class="text-left alert-info">';
													$idm=$fila['id_adm_hosp'];
													$sqls="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
																				c.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
																				d.id_d_procedimiento, freg, cod_cups, procedimiento, observacion


															FROM adm_hospitalario a LEFT JOIN master_procedimiento c on c.id_adm_hosp=a.id_adm_hosp
																											LEFT JOIN detalle_procedimiento d on d.id_master_prod = c.id_master_prod

															WHERE c.id_adm_hosp = $idm and tipo_atencion='Ambulatoria' and servicio='Hospitalario'
															order by fecha_orden DESC";
															//echo $sqls;
															if ($tablas=$bd1->sub_tuplas($sqls)){
																foreach ($tablas as $filas ) {
																	$ids=$filas['id_master_prod'];
																	if ($ids=='') {
																		echo'<p class="alert alert-info">Sin Ordenes de servicio</p>';
																	}else {
																		echo'<p><strong>'.$filas["cod_cups"].'</strong>'.$filas["procedimiento"].' '.$filas["observacion"].'</p>';
																	}

																}
															}
										echo'</td>';
										echo'<td class="text-left alert-info"><strong>Egreso </strong> '.$fila["estado_salida"].'</td>';
										echo"</tr >\n";
									}
									if ($fila["estado_adm_hosp"]=='Parcial' && $fila["estado_salida"]=='Salida voluntaria') {
										echo"<tr >\n";
										echo'<td class="text-center alert-warning"><strong>'.$i++.' </strong></td>';
										echo'<td class="text-left alert-warning">
													<p>'.$fila["nom_completo"].'</p>
													<p>'.$fila["doc_pac"].'</p>
												 </td>';
										echo'<td class="text-left alert-warning">
													<p><strong>'.$fila["nom_eps"].' </strong></p>
													<p><strong>Municipio: </strong>'.$fila["descrimuni"].'</p>
												 </td>';
										echo'<td class="text-left alert-warning">
													<p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>';
													if ($fila['fegreso_hosp']=='') {
														echo'<p><strong>No hay egreso</strong></p>';
													}else {
														echo'<p><strong>Egreso: </strong>'.$fila["fegreso_hosp"].'</p>';
													}
										echo'</td>';
										echo'<td class="text-left alert-warning">';
													echo'<p>'.$fila["clase_dx_hosp"].'</p>';
										echo'</td>';
										echo'<td class="text-left alert-warning">';
													echo'<p><strong>Ingreso: </strong>'.$fila["ddxp"].'</p>';
													echo'<p><strong>Egreso: </strong>'.$fila["ddxp_epi"].'<br>'.$fila["plant_epicrisis"].'</p>';
										echo'</td>';

										echo'<td class="text-left alert-warning">';
													$idm=$fila['id_adm_hosp'];
													$sqls="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
																				c.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
																				d.id_d_procedimiento, freg, cod_cups, procedimiento, observacion

															FROM adm_hospitalario a LEFT JOIN master_procedimiento c on c.id_adm_hosp=a.id_adm_hosp
																											LEFT JOIN detalle_procedimiento d on d.id_master_prod = c.id_master_prod
															WHERE c.id_adm_hosp = $idm and tipo_atencion='Ambulatoria' and servicio='Hospitalario'
															order by fecha_orden DESC";
															//echo $sqls;
															if ($tablas=$bd1->sub_tuplas($sqls)){
																foreach ($tablas as $filas ) {
																	$ids=$filas['id_master_prod'];
																	if ($ids=='') {
																		echo'<p class="alert alert-warning">Sin Ordenes de servicio</p>';
																	}else {
																		echo'<p><strong>'.$filas["cod_cups"].'</strong>'.$filas["procedimiento"].' '.$filas["observacion"].'</p>';
																	}

																}
															}
										echo'</td>';
										echo'<td class="text-left alert-warning"><strong>Egreso </strong> '.$fila["estado_salida"].'</td>';
										echo"</tr >\n";
									}

									if ($fila["estado_adm_hosp"]=='Parcial' && $fila["estado_salida"]=='Remision') {
										echo"<tr >\n";
										echo'<td class="text-center alert-success"><strong>'.$i++.' </strong></td>';
										echo'<td class="text-left alert-success">
													<p>'.$fila["nom_completo"].'</p>
													<p>'.$fila["doc_pac"].'</p>
												 </td>';
										echo'<td class="text-left alert-success">
													<p><strong>'.$fila["nom_eps"].' </strong></p>
													<p><strong>Municipio: </strong>'.$fila["descrimuni"].'</p>
												 </td>';
										echo'<td class="text-left alert-success">
													<p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>';
													if ($fila['fegreso_hosp']=='') {
														echo'<p><strong>No hay egreso</strong></p>';
													}else {
														echo'<p><strong>Egreso: </strong>'.$fila["fegreso_hosp"].'</p>';
													}
										echo'</td>';
										echo'<td class="text-left alert-success">';
													echo'<p>'.$fila["clase_dx_hosp"].'</p>';
										echo'</td>';
										echo'<td class="text-left alert-success">';
										echo'<p><strong>Ingreso: </strong>'.$fila["ddxp"].'</p>';
										echo'<p><strong>Egreso: </strong>'.$fila["ddxp_epi"].'<br>'.$fila["plant_epicrisis"].'</p>';
										echo'</td>';

										echo'<td class="text-left alert-success">';
													$idm=$fila['id_adm_hosp'];
													$sqls="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
																				c.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
																				d.id_d_procedimiento, freg, cod_cups, procedimiento, observacion

															FROM adm_hospitalario a LEFT JOIN master_procedimiento c on c.id_adm_hosp=a.id_adm_hosp
																											LEFT JOIN detalle_procedimiento d on d.id_master_prod = c.id_master_prod
															WHERE c.id_adm_hosp = $idm and tipo_atencion='Ambulatoria' and servicio='Hospitalario'
															order by fecha_orden DESC";
															//echo $sqls;
															if ($tablas=$bd1->sub_tuplas($sqls)){
																foreach ($tablas as $filas ) {
																	$ids=$filas['id_master_prod'];
																	if ($ids=='') {
																		echo'<p class="alert alert-success">Sin Ordenes de servicio</p>';
																	}else {
																		echo'<p><strong>'.$filas["cod_cups"].'</strong>'.$filas["procedimiento"].' '.$filas["observacion"].'</p>';
																	}

																}
															}
										echo'</td>';
										echo'<td class="text-left alert-success"><strong>Egreso </strong> '.$fila["estado_salida"].'</td>';
										echo"</tr >\n";
									}

									if ($fila["estado_adm_hosp"]=='Parcial' && $fila["estado_salida"]=='Expulsado') {
										echo"<tr >\n";
										echo'<td class="text-center alert-danger"><strong>'.$i++.' </strong></td>';
										echo'<td class="text-left alert-danger">
													<p>'.$fila["nom_completo"].'</p>
													<p>'.$fila["doc_pac"].'</p>
												 </td>';
										echo'<td class="text-left alert-danger">
													<p><strong>'.$fila["nom_eps"].' </strong></p>
													<p><strong>Municipio: </strong>'.$fila["descrimuni"].'</p>
												 </td>';
										echo'<td class="text-left alert-danger">
													<p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>';
													if ($fila['fegreso_hosp']=='') {
														echo'<p><strong>No hay egreso</strong></p>';
													}else {
														echo'<p><strong>Egreso: </strong>'.$fila["fegreso_hosp"].'</p>';
													}
										echo'</td>';
										echo'<td class="text-left alert-danger">';
													echo'<p>'.$fila["clase_dx_hosp"].'</p>';
										echo'</td>';
										echo'<td class="text-left alert-danger">';
										echo'<p><strong>Ingreso: </strong>'.$fila["ddxp"].'</p>';
										echo'<p><strong>Egreso: </strong>'.$fila["ddxp_epi"].'<br>'.$fila["plant_epicrisis"].'</p>';
										echo'</td>';

										echo'<td class="text-left alert-danger">';
													$idm=$fila['id_adm_hosp'];
													$sqls="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
																				c.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
																				d.id_d_procedimiento, freg, cod_cups, procedimiento, observacion

															FROM adm_hospitalario a LEFT JOIN master_procedimiento c on c.id_adm_hosp=a.id_adm_hosp
																											LEFT JOIN detalle_procedimiento d on d.id_master_prod = c.id_master_prod
															WHERE c.id_adm_hosp = $idm and tipo_atencion='Ambulatoria' and servicio='Hospitalario'
															order by fecha_orden DESC";
															//echo $sqls;
															if ($tablas=$bd1->sub_tuplas($sqls)){
																foreach ($tablas as $filas ) {
																	$ids=$filas['id_master_prod'];
																	if ($ids=='') {
																		echo'<p class="alert alert-danger">Sin Ordenes de servicio</p>';
																	}else {
																		echo'<p><strong>'.$filas["cod_cups"].'</strong>'.$filas["procedimiento"].' '.$filas["observacion"].'</p>';
																	}

																}
															}
										echo'</td>';
										echo'<td class="text-left alert-danger"><strong>Egreso </strong> '.$fila["estado_salida"].'</td>';
										echo"</tr >\n";
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
