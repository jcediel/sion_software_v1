
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
		case 'E':
			$sql="SELECT s.".$_GET["idveh"];
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de datos del Vehículo';
			break;
			case 'X':
			$sql="";
			$color="red";
			$boton="Eliminar";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$subtitulo='Confirmación para eliminar de datos del Vehículo';
			break;
			case 'A':
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,estadocivil,edad,lateralidad,profesion,religion,
			a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_usuario,tipo_afiliacion,ocupacion,dep_residencia,mun_residencia,zona_residencia,nivel,via_ingreso,s.nom_sedes
			FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips  WHERE a.id_adm_hosp=".$_GET["idadmhosp"];
			$color="yellow";
			$boton="Agregar HC";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y/m/d');
			$date1=date('H:i');
			$subtitulo='';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fotopac"=>"","estadocivil"=>"","edad"=>"","lateralidad"=>"","profesion"=>"",
				"religion"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","tipo_usuario"=>"","tipo_afiliacion"=>"","ocupacion"=>"","dep_residencia"=>"","mun_residencia"=>"",
				"zona_residencia"=>"","nivel"=>"","via_ingreso"=>"");
			}
		}else{
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fotopac"=>"","estadocivil"=>"","edad"=>"","lateralidad"=>"","profesion"=>"",
				"religion"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","tipo_usuario"=>"","tipo_afiliacion"=>"","ocupacion"=>"","dep_residencia"=>"","mun_residencia"=>"",
				"zona_residencia"=>"","nivel"=>"","via_ingreso"=>"");
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nom_cliente.value == ""){
					alert("Se requiere el nombre del cliente!");
					document.forms[0].nom_cliente.focus();				// Ubicar el cursor
					return(false);
				}

			}
		</script>
		<script src="ajax.js"></script>


<?php
}else{
	echo $subtitulo;
// nivel 1?>

<section class="panel panel-default">
	<section class="panel-heading"><h4>Reporteador Servicios Domiciliarios</h4></section>
	<section class="panel-body">
		<form>
			<section class="col-md-6">
				<article class="col-md-6">
					<label>Fecha inicial:</label>
					<input type="date" class="form-control" name="fecha1">
				</article>
				<article class="col-md-6">
					<label>Fecha Final:</label>
					<input type="date" class="form-control" name="fecha2">
				</article>
				<article class="col-md-12">
					<label>Filtro por identificacion:</label>
					<input type="text" class="form-control" name="doc" placeholder="Digite Identificacion">
				</article>
				<div class="col-md-12">
					<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
					<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
				</div>
			</section>
		</form>
		<form>
			<section class="col-md-6">
				<article class="col-md-6">
					<label>Fecha inicial:</label>
					<input type="date" class="form-control" name="fecha1">
				</article>
				<article class="col-md-6">
					<label>Fecha Final:</label>
					<input type="date" class="form-control" name="fecha2">
				</article>
				<article class="col-md-12">
					<label>Filtro por identificacion:</label>
					<input type="text" class="form-control" name="doc" placeholder="Digite Identificacion">
				</article>
				<div class="col-md-12">
					<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
					<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
				</div>
			</section>
		</form>
	</section>
	<section class="panel-body">
		<?php
		if (isset($_REQUEST['doc'])) {
			?>

			<table class="table table-bordered">
				<tr>
					<th colspan="5"> <h2>Consulte AQUI el reporte por autorizaciones</h2></th>
				</tr>

				<tr>
					<th>#</th>
					<th>PACIENTE</th>
					<th colspan="2">AUTORIZACION</th>
					<th></th>
				</tr>
				<?php
				$ident=$_REQUEST['doc'];
				$f1=$_REQUEST["fecha1"];
				$f2=$_REQUEST["fecha2"];
				if ($f1=='') {
					$sql_profesional="SELECT month(current_date),h.nom_eps,b.doc_pac, b.nom_completo,b.tel_pac,b.dir_pac,
																	c.tipo_usuario,c.mun_residencia,c.dep_residencia,i.descrimuni,c.zona_residencia,
		    													IFNULL(c.id_adm_hosp,0),
																	d.id_m_aut_dom,d.dx_presentacion,
																	IFNULL(e.id_d_aut_dom,0),e.freg, e.cups, e.procedimiento, e.cantidad, e.finicio, e.ffinal,
		       												e.num_aut_externa, e.estado_d_aut_dom, e.intervalo,
		       												e.temporalidad,
		    													cantidad_sesion_dom(e.cups,c.id_adm_hosp,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones
													FROM adm_hospitalario c  INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
		    																					 INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom)
		     																					 INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
		    																			 		 INNER JOIN eps h on (h.id_eps = c.id_eps)
		    																			 	   LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)

													WHERE c.tipo_servicio= 'Domiciliarios' and b.doc_pac='$ident'
																																 and c.estado_adm_hosp = 'Activo'
																																 and estado_d_aut_dom in (1,2,3)
																																 and e.cups in ('890101','890105','890106','890108','890110','890111','890112','890113')
													ORDER BY sesiones ASC ";
				}else {
					$sql_profesional="SELECT month(current_date),h.nom_eps,b.doc_pac, b.nom_completo,b.tel_pac,b.dir_pac,
																	c.tipo_usuario,c.mun_residencia,c.dep_residencia,i.descrimuni,c.zona_residencia,
		    													IFNULL(c.id_adm_hosp,0),
																	d.id_m_aut_dom,d.dx_presentacion,
																	IFNULL(e.id_d_aut_dom,0),e.freg, e.cups, e.procedimiento, e.cantidad, e.finicio, e.ffinal,
		       												e.num_aut_externa, e.estado_d_aut_dom, e.intervalo,
		       												e.temporalidad,
		    													cantidad_sesion_dom(e.cups,c.id_adm_hosp,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones
													FROM adm_hospitalario c  INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
		    																					 INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom)
		     																					 INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
		    																			 		 INNER JOIN eps h on (h.id_eps = c.id_eps)
		    																			 	   LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)

													WHERE c.tipo_servicio= 'Domiciliarios' and b.doc_pac='$ident'
																																 and c.estado_adm_hosp = 'Activo'
																																 and estado_d_aut_dom in (1,2,3)
																																 and e.cups in ('890101','890105','890106','890108','890110','890111','890112','890113')
																																 and e.finicio BETWEEN '$f1' and  '$f2'
													ORDER BY sesiones ASC ";
				}

												$i=1;
									if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
										foreach ($tabla_profesional as $fila_profesional) {
											?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td>
													<p><?php echo $fila_profesional['nom_completo'] ?></p>
													<p><?php echo $fila_profesional['doc_pac'] ?> </p>
												</td>
												<td>
													<p><strong class="text-primary"><?php echo $fila_profesional['IFNULL(e.id_d_aut_dom,0)'] ?></strong> <strong><?php echo $fila_profesional['procedimiento'] ?></strong></p>
													<p> <strong>Intervalo</strong>:  <?php echo $fila_profesional['intervalo'] ?> </p>
													<p> <strong>Fecha inicial</strong>: <?php echo $fila_profesional['finicio'] ?></p>
													<p> <strong>Fecha Final</strong>: <?php echo $fila_profesional['ffinal'] ?></p>
												</td>
												<td>
													<p>Autorizado: <h3 class="text-primary"><strong><?php echo $fila_profesional['cantidad'] ?></strong></h3></p>
													<p>Realizado: <h3 class="text-danger"><strong><?php echo $fila_profesional['sesiones'] ?></strong></h3> </p>
												</td>
												<td>
													<?php
													$cups=$fila_profesional['cups'];
													$turno=$fila_profesional['intervalo'];
													if ($cups=='890105' && $turno==24) {
														echo'<p><a href="rpt_enfermeria_dom24.php?idadmhosp='.$fila_profesional["IFNULL(c.id_adm_hosp,0)"].'&f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'
														&idd='.$fila_profesional["IFNULL(e.id_d_aut_dom,0)"].'&nom='.$fila_profesional["nom_completo"].' &doc='.$fila_profesional["doc_pac"].'
														&dx='.$fila_profesional["dx_presentacion"].'&turno='.$fila_profesional["intervalo"].' " target="_blank">
																		<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ver Reporte</button></a></p> ';
													}
													if ($cups=='890105' && $turno==12) {
														echo'<p><a href="rpt_enfermeria_dom12.php?idadmhosp='.$fila_profesional["IFNULL(c.id_adm_hosp,0)"].'&f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'
														&idd='.$fila_profesional["IFNULL(e.id_d_aut_dom,0)"].'&nom='.$fila_profesional["nom_completo"].' &doc='.$fila_profesional["doc_pac"].'
														&dx='.$fila_profesional["dx_presentacion"].'&turno='.$fila_profesional["intervalo"].'" target="_blank">
																		<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ver Reporte</button></a></p> ';
													}
													if ($cups=='890105' && $turno==8) {
														echo'<p><a href="rpt_enfermeria_dom8.php?idadmhosp='.$fila_profesional["IFNULL(c.id_adm_hosp,0)"].'&f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'
														&idd='.$fila_profesional["IFNULL(e.id_d_aut_dom,0)"].'&nom='.$fila_profesional["nom_completo"].' &doc='.$fila_profesional["doc_pac"].'
														&dx='.$fila_profesional["dx_presentacion"].'&turno='.$fila_profesional["intervalo"].'" target="_blank">
																		<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ver Reporte</button></a></p> ';
													}
													if ($cups=='890105' && $turno==6) {
														echo'<p><a href="rpt_enfermeria_dom6.php?idadmhosp='.$fila_profesional["IFNULL(c.id_adm_hosp,0)"].'&f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'
														&idd='.$fila_profesional["IFNULL(e.id_d_aut_dom,0)"].'&nom='.$fila_profesional["nom_completo"].' &doc='.$fila_profesional["doc_pac"].'
														&dx='.$fila_profesional["dx_presentacion"].'&turno='.$fila_profesional["intervalo"].'" target="_blank">
																		<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ver Reporte</button></a></p> ';
													}
													if ($cups=='890105' && $turno==3) {
														echo'<p><a href="rpt_enfermeria_dom3.php?idadmhosp='.$fila_profesional["IFNULL(c.id_adm_hosp,0)"].'&f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'
														&idd='.$fila_profesional["IFNULL(e.id_d_aut_dom,0)"].'&nom='.$fila_profesional["nom_completo"].' &doc='.$fila_profesional["doc_pac"].'
														&dx='.$fila_profesional["dx_presentacion"].'&turno='.$fila_profesional["intervalo"].'" target="_blank">
																		<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ver Reporte</button></a></p> ';
													}
													if ($cups=='890101') {
														echo'<p><a href="rpt_enfermeria_dom24.php?idadmhosp='.$fila_profesional["IFNULL(c.id_adm_hosp,0)"].'&f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'
														&nom='.$fila_profesional["nom_completo"].' &doc='.$fila_profesional["doc_pac"].'&dx='.$fila_profesional["dx_presentacion"].'&turno='.$fila_profesional["intervalo"].'" target="_blank">
																		<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ver Reporte</button></a></p> ';
													}
													if ($cups=='890111') {
														echo'<p><a href="rpt_fisio_dom1.php?idadmhosp='.$fila_profesional["IFNULL(c.id_adm_hosp,0)"].'&f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'
														&nom='.$fila_profesional["nom_completo"].' &doc='.$fila_profesional["doc_pac"].'&dx='.$fila_profesional["dx_presentacion"].'&turno='.$fila_profesional["intervalo"].'" target="_blank">
																		<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ver Reporte</button></a></p> ';
													}
													if ($cups=='890110') {
														echo'<p><a href="rpt_fono_dom1.php?idadmhosp='.$fila_profesional["IFNULL(c.id_adm_hosp,0)"].'&f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'
														&nom='.$fila_profesional["nom_completo"].' &doc='.$fila_profesional["doc_pac"].'&dx='.$fila_profesional["dx_presentacion"].'&turno='.$fila_profesional["intervalo"].'" target="_blank">
																		<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ver Reporte</button></a></p> ';
													}
													if ($cups=='890112') {
														echo'<p><a href="rpt_tr_dom1.php?idadmhosp='.$fila_profesional["IFNULL(c.id_adm_hosp,0)"].'&f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'
														&nom='.$fila_profesional["nom_completo"].' &doc='.$fila_profesional["doc_pac"].'&dx='.$fila_profesional["dx_presentacion"].'&turno='.$fila_profesional["intervalo"].'" target="_blank">
																		<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ver Reporte</button></a></p> ';
													}
													if ($cups=='890113') {
														echo'<p><a href="rpt_to_dom1.php?idadmhosp='.$fila_profesional["IFNULL(c.id_adm_hosp,0)"].'&f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'
														&nom='.$fila_profesional["nom_completo"].' &doc='.$fila_profesional["doc_pac"].'&dx='.$fila_profesional["dx_presentacion"].'&turno='.$fila_profesional["intervalo"].'" target="_blank">
																		<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ver Reporte</button></a></p> ';
													}
													if ($cups=='890106') {
														echo'<p><a href="rpt_nutri_dom1.php?idadmhosp='.$fila_profesional["IFNULL(c.id_adm_hosp,0)"].'&f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'
														&nom='.$fila_profesional["nom_completo"].' &doc='.$fila_profesional["doc_pac"].'&dx='.$fila_profesional["dx_presentacion"].'&turno='.$fila_profesional["intervalo"].'" target="_blank">
																		<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ver Reporte</button></a></p> ';
													}
													if ($cups=='890108') {
														echo'<p><a href="rpt_psico_dom1.php?idadmhosp='.$fila_profesional["IFNULL(c.id_adm_hosp,0)"].'&f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'
														&nom='.$fila_profesional["nom_completo"].' &doc='.$fila_profesional["doc_pac"].'&dx='.$fila_profesional["dx_presentacion"].'&turno='.$fila_profesional["intervalo"].'" target="_blank">
																		<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ver Reporte</button></a></p> ';
													}
													 ?>
												</td>
											</tr>
											<?php
										}
									}
				 ?>


			</table>

			<?php
		}else {
			echo'<h2 class="text-danger">El reporte por autorizaciones solo puedes ser visto si realiza el filtro por documento</h2>';
		}
		?>

	</section>
	<section class="panel-body">

		<table class="table table-bordered table-responsive">
			<tr>
				<th colspan="8"> <h2>Consulta historica del paciente</h2> </th>
			</tr>
			<tr>
				<th colspan="2"  class="danger">MEDICINA</th>
				<th class="danger">IDENTIFICACION</th>
				<th class="danger">NOMBRES Y APELLIDOS</th>
				<th class="danger">FECHA INGRESO</th>
				<th class="danger">SEDE - EPS</th>
				<th class="danger">VALORACIONES</th>
				<th class="danger">EVOLUCIONES</th>
			</tr>

			<?php
			if (isset($_REQUEST["doc"])){
			$doc=$_REQUEST["doc"];
			$f1=$_REQUEST["fecha1"];
			$f2=$_REQUEST["fecha2"];

			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,dir_pac,tel_pac,estadocivil,fnacimiento,descricie,fotopac,genero,nom_completo,
									 a.id_adm_hosp,a.id_eps eps,fingreso_hosp,hingreso_hosp,zona_residencia,
									 s.nom_sedes,
									 e.nom_eps,
									 c.descripestadoc,
									 d.descriafiliado,
									 j.descritusuario,
									 f.descriocu,
									 g.descripdep,
									 h.descrimuni,
									 m.nombre_acu, dir_acu, tel_acu, parentesco_acu

						FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
														 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
														 LEFT JOIN eps e on a.id_eps=e.id_eps
														 left join estado_civil c on (c.codestadoc = p.estadocivil)
														 left join tusuario j on (j.codtusuario=a.tipo_usuario)
														 left join tafiliado d on (d.codafiliado=a.tipo_afiliacion)
														 left join ocupacion f on (f.codocu=a.ocupacion)
														 left join departamento g on (g.coddep=a.dep_residencia)
														 left join municipios h on (h.codmuni=a.mun_residencia)
														 left join info_acudiente m on (m.id_adm_hosp=a.id_adm_hosp)
			WHERE p.doc_pac='".$doc."'  and tipo_servicio='Domiciliarios' ";

			if ($tabla=$bd1->sub_tuplas($sql)){
			  //echo $sql;
			  foreach ($tabla as $fila ) {
				$eps=$fila['nom_eps'];
				$cie=$fila['edad'];

			    echo"<tr >\n";
					echo'<th class="text-left" >
			    			<p><a href="rpt_hcmed_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.
								$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC Medicina</button></a>
								</p>
								<p><a href="rpt_hcdom_completa.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
								'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&tterapia='.$tterapia.'&cie='.$cie.'&genero='.$fila["genero"].'&nomeps='.$fila["nom_eps"].'
								&eps='.$fila['eps'].'&fnacimiento='.$fila['fnacimiento'].'&regimen='.$fila["descritusuario"].'&tel_pac='.$fila["tel_pac"].'
								&afiliacion='.$fila["descriafiliado"].'&estadocivil='.$fila["estadocivil"].'&ocupacion='.$fila["descriocu"].'&dep='.$fila["descripdep"].'&mun='.$fila["descrimuni"].'
								&zona='.$fila["zona_residencia"].'&nombre_acu='.$fila["nombre_acu"].'&tel_acu='.$fila["tel_acu"].'&parentesco_acu='.$fila["parentesco_acu"].'&dir='.$fila["dir_pac"].'">
								<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC Completa</button></a>
								</p>
								<p><a href="rpt_hcmaternas_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC Maternas</button></a></p>
								<p><a href="rpt_enfermeria_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'
								&idd='.$fila["IFNULL(e.id_d_aut_dom,0)"].'&nom='.$fila["nom_completo"].' &doc='.$fila["doc_pac"].'
								&dx='.$fila["dx_presentacion"].'&turno='.$fila["intervalo"].'" target="_blank">
												<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Enfermeria</button></a></p>
							 </th>';
					echo'<th class="text-center" >
		 						<p><a href="docpaciente/'.$fila["id_paciente"].'_Documento Identidad.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Identificación </button></a></p>
								<p><a href="docpaciente/'.$fila["id_adm_hosp"].'_listaChequeo.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Lista Chequeo </button></a></p>
								<p><a href="docpaciente/'.$fila["id_adm_hosp"].'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento </button></a></p>
		 					 </th>';
			    echo'<td class="text-center"><strong>'.$fila["tdoc_pac"].': '.$fila["doc_pac"].' -- AMD:'.$fila["id_adm_hosp"].'</strong></td>';
			    echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
			    echo'<td class="text-center">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
			    $eps=$fila["nom_eps"];
			    $doc=$fila["doc_pac"];
			    $cie=$fila["descricie"];
			    echo'<td class="text-center">'.$fila["nom_sedes"].' // '.$fila["nom_eps"].'</td>';
			    echo'<th class="text-LEFT" >
									<p><a href="rpt_valinifisio_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Fisioterapia</button></a></p>
			    				<p><a href="rpt_valinito_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ocupacional</button></a></p>
			    				<p><a href="rpt_valinifono_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Fonoaudiología</button></a></p>
			    				<p><a href="rpt_valinipsico_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Psicología</button></a></p>
			    				<p><a href="rpt_valinitr_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Respiratoría</button></a></p>
									<p><a href="rpt_valininutri_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Nutrición</button></a></p>
								</th>';
					echo'<th class="text-left" >
									<p><a href="rpt_fisiodom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span>  Fisioterapia</button></a></p>
									<p><a href="rpt_todom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ocupacional</button></a></p>
									<p><a href="rpt_fonodom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Fonoaudiología</button></a></p>
									<p><a href="rpt_psicodom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Psicología</button></a></p>
									<p><a href="rpt_trdom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Respiratoría</button></a></p>
									<p><a href="rpt_nutri_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Nutrición</button></a></p>
							 </th>';

			    echo "</tr>\n";
			  }
			}
			}
			if (isset($_REQUEST["nom"])){
			$doc=$_REQUEST["nom"];
			$f1=$_REQUEST["fecha1"];
			$f2=$_REQUEST["fecha2"];
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,descricie,fotopac,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
									 s.nom_sedes
					  FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
														 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
						WHERE p.nom1  LIKE '%".$doc."%'  and tipo_servicio='Domiciliarios'";

			if ($tabla=$bd1->sub_tuplas($sql)){
			  //echo $sql;
			  foreach ($tabla as $fila ) {
					$eps=$fila['nom_eps'];
					$cie=$fila['edad'];
					echo"<tr >\n";
					echo'<th class="text-left" >
					<p><a href="rpt_hcmed_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC Medicina</button></a></p>
					<p><a href="rpt_hcdom_completa.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC Completa</button></a></p>
					<p><a href="rpt_hcmaternas_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC Maternas</button></a
							 </th>';
					echo'<th class="text-center" >
					<p><a href="docpaciente/'.$fila["id_paciente"].'_Documento Identidad.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Identificación </button></a></p>
					<p><a href="docpaciente/'.$fila["id_adm_hosp"].'_listaChequeo.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Lista Chequeo </button></a></p>
					<p><a href="docpaciente/'.$fila["id_adm_hosp"].'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento </button></a></p>
		 					 </th>';
			    echo'<td class="text-center"><strong>'.$fila["tdoc_pac"].': '.$fila["doc_pac"].' -- AMD:'.$fila["id_adm_hosp"].'</strong></td>';
			    echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
			    echo'<td class="text-center">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
			    $eps=$fila["nom_eps"];
			    $doc=$fila["doc_pac"];
			    $cie=$fila["descricie"];
			    echo'<td class="text-center">'.$fila["nom_sedes"].' // '.$fila["nom_eps"].'</td>';
			    echo'<th class="text-left" >
									<p><a href="rpt_valinifisio_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Fisioterapia</button></a></p>
			    				<p><a href="rpt_valinito_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ocupacional</button></a></p>
			    				<p><a href="rpt_valinifono_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Fonoaudiología</button></a></p>
			    				<p><a href="rpt_valinipsico_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Psicología</button></a></p>
			    				<p><a href="rpt_valinitr_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Respiratoría</button></a></p>
									<p><a href="rpt_valininutri_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Nutrición</button></a></p>
								</th>';
					echo'<th class="text-left" >
									<p><a href="rpt_fisiodom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span>  Fisioterapia</button></a></p>
									<p><a href="rpt_todom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ocupacional</button></a></p>
									<p><a href="rpt_fonodom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Fonoaudiología</button></a></p>
									<p><a href="rpt_psicodom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Psicología</button></a></p>
									<p><a href="rpt_trdom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Respiratoría</button></a></p>
									<p><a href="rpt_nutri_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Nutrición</button></a></p>
							 </th>';

			    echo "</tr>\n";
			  }
			}
			}
			?>
		<table>
	</section>
</section>
	<?php
}
?>
