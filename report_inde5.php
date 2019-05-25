
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
			case 'E':
				$sql="UPDATE vehiculos SET id_rutas='".$_POST["idruta"]."',id_provexpreso='".$_POST["idprove"]."',tipo_vehiculo='".$_POST["doc_cliente"]."',placa='".$_POST["mail_cliente"]."',num_interno='".$_POST["tel_cliente"]."',modelo='".$_POST["dir_cliente"]."',capacidad='".$_POST["estado_cliente"]."',conductor='".$_POST["porciento_tiquetes"]."',contacto_conductor='".$_POST["porciento_expresos"]."',estado_vehiculo='".$_POST["porciento_alimentacion"]."' WHERE id_vehiculo=".$_POST["idveh"];
				$subtitulo="Actualizado";
			break;
			case 'X':
				$sql="SELECT logo from cliente where id=".$_POST["idcli"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="DELETE FROM cliente WHERE id_cliente=".$_POST["idcli"];
				$subtitulo="Eliminado";
			break;
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
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,estadocivil,edad,lateralidad,profesion,religion,a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_usuario,tipo_afiliacion,ocupacion,dep_residencia,mun_residencia,zona_residencia,nivel,via_ingreso,s.nom_sedes FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips  WHERE a.id_adm_hosp=".$_GET["idadmhosp"];
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
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fotopac"=>"","estadocivil"=>"","edad"=>"","lateralidad"=>"","profesion"=>"","religion"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","tipo_usuario"=>"","tipo_afiliacion"=>"","ocupacion"=>"","dep_residencia"=>"","mun_residencia"=>"","zona_residencia"=>"","nivel"=>"","via_ingreso"=>"");
			}
		}else{
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fotopac"=>"","estadocivil"=>"","edad"=>"","lateralidad"=>"","profesion"=>"","religion"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","tipo_usuario"=>"","tipo_afiliacion"=>"","ocupacion"=>"","dep_residencia"=>"","mun_residencia"=>"","zona_residencia"=>"","nivel"=>"","via_ingreso"=>"");
			}


}else{
	echo $subtitulo;
// nivel 1?>
<div class="panel panel-default">
<section class="panel-heading">Reporteador general modulo INDE</section>
<div class="panel-body">
	<section class="panel panel-default" class="col-xs-10" >
		<section >
			<form >
	        	<section class="col-xs-12">
								<article class="col-xs-2">
									<label>Fecha inicial:</label>
									<input type="date" class="form-control" name="fecha1">
								</article>
								<article class="col-xs-2">
									<label>Fecha Final:</label>
									<input type="date" class="form-control" name="fecha2">
								</article>
								<article class="col-xs-3">
								  <label>Filtro por Documento:</label>
			          	<input type="text" class="form-control" name="doc" placeholder="Digite Identificacion">
								</article>
								<article class="col-xs-3">
									<label>Seleccione tipo terapia:</label>
									<select name="tterapia" class="form-control" <?php echo atributo3; ?>>
										<option value="TODAS">TODAS</option>
										<option value="FISIOTERAPIA">FISIOTERAPIA</option>
										<option value="TERAPIA OCUPACIONAL">TERAPIA OCUPACIONAL</option>
										<option value="FONOAUDIOLOGIA">FONOAUDIOLOGIA</option>
										<option value="NEUROPSICOLOGIA">NEUROPSICOLOGIA</option>
										<option value="PSICOLOGIA">PSICOLOGIA</option>
									</select>
								</article>
								<div class="col-xs-2">
									<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
									<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
								</div>
	        	</section>
	    		</form>
			</section>
			<section>

			<form>
				<section class="panel-body">
				<br />
						<article class="col-xs-2">
							<label>Fecha inicial:</label>
							<input type="date" class="form-control" name="fecha1">
						</article>
						<article class="col-xs-2">
							<label>Fecha Final:</label>
							<input type="date" class="form-control" name="fecha2">
						</article>
						<article class="col-xs-3">
							<label>Filtro por Nombre paciente:</label>
							<input type="text" class="form-control" name="nom" placeholder="Digite Nombre de paciente">
						</article>
						<article class="col-xs-3">
							<label>Seleccione tipo terapia:</label>
							<select name="tterapia" class="form-control" <?php echo atributo3; ?>>
							<option value="TODAS">TODAS</option>
							<option value="FISIOTERAPIA">FISIOTERAPIA</option>
							<option value="TERAPIA OCUPACIONAL">TERAPIA OCUPACIONAL</option>
							<option value="FONOAUDIOLOGIA">FONOAUDIOLOGIA</option>
							<option value="NEUROPSICOLOGIA">NEUROPSICOLOGIA</option>
							<option value="PSICOLOGIA">PSICOLOGIA</option>
							</select>
						</article>
						<div class="col-xs-2">
							<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
							<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
						</div>
				</section>
			</form>
		</section>
		<section class="panel-body">

	<table class="table table-responsive table-bordered">
		<tr>
			<th class="info">PACIENTE</th>
			<th class="info">MEDICINA</th>
			<th class="info">SOPORTES INDE</th>
			<th class="info">SOPORTES RED SERVICIOS</th>
			<th class="info">DOCUMENTACION</th>
		</tr>

	<?php
	if (isset($_REQUEST["doc"])){
	$doc=$_REQUEST["doc"];
	$f1=$_REQUEST["fecha1"];
	$f2=$_REQUEST["fecha2"];
	$tterapia=$_REQUEST["tterapia"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,dir_pac,tel_pac,estadocivil,fnacimiento,descricie,fotopac,genero,
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

				WHERE p.doc_pac='".$doc."'  and tipo_servicio in ('Demencias','AVD','Medicina General INDE','Consulta externa INDE','Salud Empresarial','Psiquiatria Consulta Externa') ";
//echo $sql;
	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {
			if ($fila['eps']==15 || $fila['eps']==25) {
				echo"<tr >\n";
				echo'<td class="text-left">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>'.$fila["tdoc_pac"].':</strong> '.$fila["doc_pac"].' -- '.$fila["id_adm_hosp"].'</p>
							<p><strong>Ingreso:</strong> '.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
							<p><strong>Egreso:</strong> '.$fila["fegreso_hosp"].' | '.$fila["hegreso_hosp"].'</p>
							<p><strong>EPS:</strong> '.$fila["nom_eps"].' </p>
							<p><strong>SEDE:</strong> '.$fila["nom_sedes"].' </p>
						 </td>';
						 echo'<th class="text-left" >
									 <label>NEUROLOGIA</label>
									 <p><a href="rpt_neuro_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
									 <p><a href="rpt_evoneuro_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
									 <label>GERIATRIA</label>
									 <p><a href="rpt_gtria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
									 <p><a href="rpt_evogtria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
									 <label>PSIQUIATRIA</label>
									 <p><a href="rpt_psiqui_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
									 <p><a href="rpt_evopsiqui_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
									 <p><a href="rpt_medgen_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Medicina<br>General</button></a></p>
									 <p><a href="rpt_salud_empresarial.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Salud Empresarial</button></a></p>
									</th>';
				echo'<th class="text-center" >
							<p><a href="rpt_hc_reh.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span>HC ingreso</button></a></p>
							<p><a href="rpt_pt.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Plan Trimestral</button></a></p>
						 </th>';
				echo'<th class="text-center" >
							<p><a href="rpt_evolucion_redservicios_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'&fnacimiento='.$fila['fnacimiento'].'&regimen='.$fila["descritusuario"].'
							&afiliacion='.$fila["descriafiliado"].'&estadocivil='.$fila["estadocivil"].'&ocupacion='.$fila["descriocu"].'&ocupacion='.$fila["descriocu"].'&dep='.$fila["descripdep"].'&mun='.$fila["descrimuni"].'
							&zona='.$fila["zona_residencia"].'&nombre_acu='.$fila["nombre_acu"].'&dir_acu='.$fila["dir_acu"].'&tel_acu='.$fila["tel_acu"].'&parentesco_acu='.$fila["parentesco_acu"].'">
							<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>

							<p><a href="rpt_im_redservicios_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&eps='.$fila['eps'].'">
							<button type="button" class="btn btn-success sombra_movil "><span class="fa fa-file-pdf-o"></span> Informe Mensual</button></a></p>
							<p><a href="rpt_enfermeria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Enfermeria</button></a></p>
							<p><a href="rpt_psicoCE_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'&servicio=REDSERVICIO"><button type="button" class="btn btn-info" ><span class="fa fa-file-pdf-o"></span> PSICOLOGIA</button></a></p>
						 </th>';
						 echo'<th class="text-center" >
									 <p><a href="docpaciente/'.$fila['id_paciente'].'_Documento Identidad.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Documento</button></a></p>
									 <p><a href="docpaciente/'.$fila['id_paciente'].'_Hoja Firmas.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Hoja Firmas</button></a></p>
									 <p><a href="docpaciente/'.$fila['id_paciente'].'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Consentimiento</button></a></p>
									</th>';
				$fila["doc_pac"]=$fila["doc_pac"];
				$cie=$fila["descricie"];
				echo "</tr>\n";
			}
			if ($fila['eps']==13 || $fila['eps']==16  || $fila['eps']==21) {
				echo"<tr >\n";
				echo'<td class="text-left">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>'.$fila["tdoc_pac"].':</strong> '.$fila["doc_pac"].' -- '.$fila["id_adm_hosp"].'</p>
							<p><strong>Ingreso:</strong> '.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
							<p><strong>Egreso:</strong> '.$fila["fegreso_hosp"].' | '.$fila["hegreso_hosp"].'</p>
							<p><strong>EPS:</strong> '.$fila["nom_eps"].' </p>
							<p><strong>SEDE:</strong> '.$fila["nom_sedes"].' </p>
						 </td>';
						 echo'<th class="text-left" >
									 <label>NEUROLOGIA</label>
									 <p><a href="rpt_neuro_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
									 <p><a href="rpt_evoneuro_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
									 <label>GERIATRIA</label>
									 <p><a href="rpt_gtria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
									 <p><a href="rpt_evogtria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
									 <label>PSIQUIATRIA</label>
									 <p><a href="rpt_psiqui_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
									 <p><a href="rpt_evopsiqui_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
									 <p><a href="rpt_medgen_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Medicina<br>General</button></a></p>
									 <p><a href="rpt_salud_empresarial.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Salud Empresarial</button></a></p>
									</th>';
				echo'<th class="text-center" >
							<p><a href="rpt_hc_reh.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span>HC ingreso</button></a></p>
							<p><a href="rpt_pt.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Plan Trimestral</button></a></p>
						 </th>';
				echo'<th class="text-center" >
							<p><a href="rpt_evolucion_redservicios_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
							<p><a href="rpt_im_redservicios_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&eps='.$fila['eps'].'">
							<button type="button" class="btn btn-success sombra_movil "><span class="fa fa-file-pdf-o"></span> Informe Mensual</button></a></p>
							<p><a href="rpt_enfermeria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Enfermeria</button></a></p>
							<p><a href="rpt_psicoCE_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'&servicio=CONSORCIO"><button type="button" class="btn btn-info" ><span class="fa fa-file-pdf-o"></span> PSICOLOGIA</button></a></p>
						 </th>';
						 echo'<th class="text-center" >
									 <p><a href="docpaciente/'.$fila['id_paciente'].'_Documento Identidad.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Documento</button></a></p>
									 <p><a href="docpaciente/'.$fila['id_paciente'].'_Hoja Firmas.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Hoja Firmas</button></a></p>
									 <p><a href="docpaciente/'.$fila['id_paciente'].'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Consentimiento</button></a></p>
									</th>';
				$fila["doc_pac"]=$fila["doc_pac"];
				$cie=$fila["descricie"];
				echo "</tr>\n";
			}
			if($fila['eps']==12 || $fila['eps']==14  || $fila['eps']==19 || $fila['eps']==20  || $fila['eps']==22  || $fila['eps']==23  || $fila['eps']==24 ) {
				echo"<tr >\n";
				echo'<td class="text-left">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>'.$fila["tdoc_pac"].':</strong> '.$fila["doc_pac"].' -- '.$fila["id_adm_hosp"].'</p>
							<p><strong>Ingreso:</strong> '.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
							<p><strong>Egreso:</strong> '.$fila["fegreso_hosp"].' | '.$fila["hegreso_hosp"].'</p>
							<p><strong>EPS:</strong> '.$fila["nom_eps"].' </p>
							<p><strong>SEDE:</strong> '.$fila["nom_sedes"].' </p>
						 </td>';
				echo'<th class="text-left" >
							<label>NEUROLOGIA</label>
							<p><a href="rpt_neuro_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
							<p><a href="rpt_evoneuro_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
							<label>GERIATRIA</label>
							<p><a href="rpt_gtria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
							<p><a href="rpt_evogtria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
							<label>PSIQUIATRIA</label>
							<p><a href="rpt_psiqui_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
							<p><a href="rpt_evopsiqui_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
							<p><a href="rpt_medgen_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Medicina<br>General</button></a></p>
							<p><a href="rpt_salud_empresarial.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Salud Empresarial</button></a></p>
						 </th>';
				$fila["doc_pac"]=$fila["doc_pac"];
				$cie=$fila["descricie"];

				echo'<th class="text-center" >
							<p><a href="rpt_hc_reh.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'&genero='.$fila["genero"].'&nomeps='.$fila["nom_eps"].'
							&eps='.$fila['eps'].'&fnacimiento='.$fila['fnacimiento'].'&regimen='.$fila["descritusuario"].'&dir_pac='.$fila['dir_pac'].'&tel_pac='.$fila["tel_pac"].'
							&afiliacion='.$fila["descriafiliado"].'&estadocivil='.$fila["estadocivil"].'&ocupacion='.$fila["descriocu"].'&ocupacion='.$fila["descriocu"].'&dep='.$fila["descripdep"].'&mun='.$fila["descrimuni"].'
							&zona='.$fila["zona_residencia"].'&nombre_acu='.$fila["nombre_acu"].'&dir_acu='.$fila["dir_acu"].'&tel_acu='.$fila["tel_acu"].'&parentesco_acu='.$fila["parentesco_acu"].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span>HC ingreso</button></a></p>

							<p><a href="rpt_pt.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Plan Trimestral</button></a></p>

							<p><a href="rpt_evo_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&tterapia='.$tterapia.'&genero='.$fila["genero"].'&nomeps='.$fila["nom_eps"].'
							&eps='.$fila['eps'].'&fnacimiento='.$fila['fnacimiento'].'&regimen='.$fila["descritusuario"].'&dir_pac='.$fila['dir_pac'].'&tel_pac='.$fila["tel_pac"].'
							&afiliacion='.$fila["descriafiliado"].'&estadocivil='.$fila["estadocivil"].'&ocupacion='.$fila["descriocu"].'&dep='.$fila["descripdep"].'&mun='.$fila["descrimuni"].'
							&zona='.$fila["zona_residencia"].'&nombre_acu='.$fila["nombre_acu"].'&dir_acu='.$fila["dir_acu"].'&tel_acu='.$fila["tel_acu"].'&parentesco_acu='.$fila["parentesco_acu"].'">

							<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>

							<p><a href="rpt_im_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&eps='.$fila['eps'].'">
							<button type="button" class="btn btn-success sombra_movil "><span class="fa fa-file-pdf-o"></span> Informe Mensual</button></a></p>
							<p><a href="rpt_enfermeria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Enfermeria</button></a></p>
							<p><a href="rpt_psicoCE_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'&servicio=INDE"><button type="button" class="btn btn-info" ><span class="fa fa-file-pdf-o"></span> PSICOLOGIA</button></a></p>
						 </th>';
				echo'<th class="text-center" >
							 <p><a href="rpt_evolucion_redservicios_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							 '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'&genero='.$fila["genero"].'&nomeps='.$fila["nom_eps"].'
 							&eps='.$fila['eps'].'&fnacimiento='.$fila['fnacimiento'].'&regimen='.$fila["descritusuario"].'&dir_pac='.$fila['dir_pac'].'&tel_pac='.$fila["tel_pac"].'
 							&afiliacion='.$fila["descriafiliado"].'&estadocivil='.$fila["estadocivil"].'&ocupacion='.$fila["descriocu"].'&ocupacion='.$fila["descriocu"].'&dep='.$fila["descripdep"].'&mun='.$fila["descrimuni"].'
 							&zona='.$fila["zona_residencia"].'&nombre_acu='.$fila["nombre_acu"].'&dir_acu='.$fila["dir_acu"].'&tel_acu='.$fila["tel_acu"].'&parentesco_acu='.$fila["parentesco_acu"].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
							 <p><a href="rpt_im_redservicios_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							 '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&eps='.$fila['eps'].'&genero='.$fila["genero"].'&nomeps='.$fila["nom_eps"].'
 							&eps='.$fila['eps'].'&fnacimiento='.$fila['fnacimiento'].'&regimen='.$fila["descritusuario"].'&dir_pac='.$fila['dir_pac'].'&tel_pac='.$fila["tel_pac"].'
 							&afiliacion='.$fila["descriafiliado"].'&estadocivil='.$fila["estadocivil"].'&ocupacion='.$fila["descriocu"].'&ocupacion='.$fila["descriocu"].'&dep='.$fila["descripdep"].'&mun='.$fila["descrimuni"].'
 							&zona='.$fila["zona_residencia"].'&nombre_acu='.$fila["nombre_acu"].'&dir_acu='.$fila["dir_acu"].'&tel_acu='.$fila["tel_acu"].'&parentesco_acu='.$fila["parentesco_acu"].'">
							 <button type="button" class="btn btn-success sombra_movil "><span class="fa fa-file-pdf-o"></span> Informe Mensual</button></a></p>
						 </th>';
						 echo'<th class="text-center" >
									<p><a href="docpaciente/'.$fila['id_paciente'].'_Documento Identidad.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Documento</button></a></p>
									<p><a href="docpaciente/'.$fila['id_paciente'].'_Hoja Firmas.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Hoja Firmas</button></a></p>
									<p><a href="docpaciente/'.$fila['id_paciente'].'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Consentimiento</button></a></p>
								 </th>';
				echo "</tr>\n";
			}
		}
	}
}
if (isset($_REQUEST["nom"])){
	$doc=$_REQUEST["nom"];
	$f1=$_REQUEST["fecha1"];
	$f2=$_REQUEST["fecha2"];
	$tterapia=$_REQUEST["tterapia"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,dir_pac,tel_pac,estadocivil,fnacimiento,descricie,fotopac,genero,
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

				WHERE p.nom1  LIKE '%".$doc."%'  and tipo_servicio in ('Demencias','AVD','Medicina General INDE','Consulta externa INDE','Salud Empresarial','Psiquiatria Consulta Externa')";

	if ($tabla=$bd1->sub_tuplas($sql)){
		foreach ($tabla as $fila ) {
			if ($fila['eps']==15 || $fila['eps']==25) {
				echo"<tr >\n";
				echo'<td class="text-left">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>'.$fila["tdoc_pac"].':</strong> '.$fila["doc_pac"].' -- '.$fila["id_adm_hosp"].'</p>
							<p><strong>Ingreso:</strong> '.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
							<p><strong>Egreso:</strong> '.$fila["fegreso_hosp"].' | '.$fila["hegreso_hosp"].'</p>
							<p><strong>EPS:</strong> '.$fila["nom_eps"].' </p>
							<p><strong>SEDE:</strong> '.$fila["nom_sedes"].' </p>
						 </td>';
						 echo'<th class="text-left" >
									 <label>NEUROLOGIA</label>
									 <p><a href="rpt_neuro_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
									 <p><a href="rpt_evoneuro_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
									 <label>GERIATRIA</label>
									 <p><a href="rpt_gtria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
									 <p><a href="rpt_evogtria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
									 <label>PSIQUIATRIA</label>
									 <p><a href="rpt_psiqui_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
									 <p><a href="rpt_evopsiqui_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
									 <p><a href="rpt_medgen_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Medicina<br>General</button></a></p>
									 <p><a href="rpt_salud_empresarial.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Salud Empresarial</button></a></p>
									</th>';
				echo'<th class="text-center" >
							<p><a href="rpt_hc_reh.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span>HC ingreso</button></a></p>
							<p><a href="rpt_pt.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Plan Trimestral</button></a></p>
						 </th>';
				echo'<th class="text-center" >
							<p><a href="rpt_evolucion_redservicios_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'&fnacimiento='.$fila['fnacimiento'].'&regimen='.$fila["descritusuario"].'
							&afiliacion='.$fila["descriafiliado"].'&estadocivil='.$fila["estadocivil"].'&ocupacion='.$fila["descriocu"].'&ocupacion='.$fila["descriocu"].'&dep='.$fila["descripdep"].'&mun='.$fila["descrimuni"].'
							&zona='.$fila["zona_residencia"].'&nombre_acu='.$fila["nombre_acu"].'&dir_acu='.$fila["dir_acu"].'&tel_acu='.$fila["tel_acu"].'&parentesco_acu='.$fila["parentesco_acu"].'">
							<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>

							<p><a href="rpt_im_redservicios_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&eps='.$fila['eps'].'">
							<button type="button" class="btn btn-success sombra_movil "><span class="fa fa-file-pdf-o"></span> Informe Mensual</button></a></p>
							<p><a href="rpt_enfermeria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Enfermeria</button></a></p>
							<p><a href="rpt_psicoCE_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'&servicio=REDSERVICIO"><button type="button" class="btn btn-info" ><span class="fa fa-file-pdf-o"></span> PSICOLOGIA</button></a></p>
						 </th>';
						 echo'<th class="text-center" >
									 <p><a href="docpaciente/'.$fila['id_paciente'].'_Documento Identidad.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Documento</button></a></p>
									 <p><a href="docpaciente/'.$fila['id_paciente'].'_Hoja Firmas.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Hoja Firmas</button></a></p>
									 <p><a href="docpaciente/'.$fila['id_paciente'].'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Consentimiento</button></a></p>
									</th>';
				$fila["doc_pac"]=$fila["doc_pac"];
				$cie=$fila["descricie"];
				echo "</tr>\n";
			}
			if ($fila['eps']==13 || $fila['eps']==16  || $fila['eps']==21) {
				echo"<tr >\n";
				echo'<td class="text-left">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>'.$fila["tdoc_pac"].':</strong> '.$fila["doc_pac"].' -- '.$fila["id_adm_hosp"].'</p>
							<p><strong>Ingreso:</strong> '.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
							<p><strong>Egreso:</strong> '.$fila["fegreso_hosp"].' | '.$fila["hegreso_hosp"].'</p>
							<p><strong>EPS:</strong> '.$fila["nom_eps"].' </p>
							<p><strong>SEDE:</strong> '.$fila["nom_sedes"].' </p>
						 </td>';
						 echo'<th class="text-left" >
									 <label>NEUROLOGIA</label>
									 <p><a href="rpt_neuro_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
									 <p><a href="rpt_evoneuro_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
									 <label>GERIATRIA</label>
									 <p><a href="rpt_gtria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
									 <p><a href="rpt_evogtria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
									 <label>PSIQUIATRIA</label>
									 <p><a href="rpt_psiqui_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
									 <p><a href="rpt_evopsiqui_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
									 <p><a href="rpt_medgen_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Medicina<br>General</button></a></p>
									 <p><a href="rpt_salud_empresarial.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Salud Empresarial</button></a></p>
									</th>';
				echo'<th class="text-center" >
							<p><a href="rpt_hc_reh.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span>HC ingreso</button></a></p>
							<p><a href="rpt_pt.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Plan Trimestral</button></a></p>
						 </th>';
				echo'<th class="text-center" >
							<p><a href="rpt_evolucion_redservicios_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
							<p><a href="rpt_im_redservicios_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&eps='.$fila['eps'].'">
							<button type="button" class="btn btn-success sombra_movil "><span class="fa fa-file-pdf-o"></span> Informe Mensual</button></a></p>
							<p><a href="rpt_enfermeria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Enfermeria</button></a></p>
							<p><a href="rpt_psicoCE_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'&servicio=INDE"><button type="button" class="btn btn-info" ><span class="fa fa-file-pdf-o"></span> PSICOLOGIA</button></a></p>
						 </th>';
						 echo'<th class="text-center" >
									 <p><a href="docpaciente/'.$fila['id_paciente'].'_Documento Identidad.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Documento</button></a></p>
									 <p><a href="docpaciente/'.$fila['id_paciente'].'_Hoja Firmas.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Hoja Firmas</button></a></p>
									 <p><a href="docpaciente/'.$fila['id_paciente'].'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Consentimiento</button></a></p>
									</th>';
				$fila["doc_pac"]=$fila["doc_pac"];
				$cie=$fila["descricie"];
				echo "</tr>\n";
			}
			if($fila['eps']==12 || $fila['eps']==14  || $fila['eps']==19 || $fila['eps']==20  || $fila['eps']==22  || $fila['eps']==23  || $fila['eps']==24 ) {
				echo"<tr >\n";
				echo'<td class="text-left">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>'.$fila["tdoc_pac"].':</strong> '.$fila["doc_pac"].' -- '.$fila["id_adm_hosp"].'</p>
							<p><strong>Ingreso:</strong> '.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
							<p><strong>Egreso:</strong> '.$fila["fegreso_hosp"].' | '.$fila["hegreso_hosp"].'</p>
							<p><strong>EPS:</strong> '.$fila["nom_eps"].' </p>
							<p><strong>SEDE:</strong> '.$fila["nom_sedes"].' </p>
						 </td>';
				echo'<th class="text-left" >
							<label>NEUROLOGIA</label>
							<p><a href="rpt_neuro_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
							<p><a href="rpt_evoneuro_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
							<label>GERIATRIA</label>
							<p><a href="rpt_gtria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
							<p><a href="rpt_evogtria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
							<label>PSIQUIATRIA</label>
							<p><a href="rpt_psiqui_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a></p>
							<p><a href="rpt_evopsiqui_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
							<p><a href="rpt_medgen_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Medicina<br>General</button></a></p>
							<p><a href="rpt_salud_empresarial.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> Salud Empresarial</button></a></p>
						 </th>';
				$fila["doc_pac"]=$fila["doc_pac"];
				$cie=$fila["descricie"];

				echo'<th class="text-center" >
							<p><a href="rpt_hc_reh.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&tterapia='.$tterapia.'&genero='.$fila["genero"].'&nomeps='.$fila["nom_eps"].'
							&eps='.$fila['eps'].'&fnacimiento='.$fila['fnacimiento'].'&regimen='.$fila["descritusuario"].'&dir_pac='.$fila['dir_pac'].'&tel_pac='.$fila["tel_pac"].'
							&afiliacion='.$fila["descriafiliado"].'&estadocivil='.$fila["estadocivil"].'&ocupacion='.$fila["descriocu"].'&ocupacion='.$fila["descriocu"].'&dep='.$fila["descripdep"].'&mun='.$fila["descrimuni"].'
							&zona='.$fila["zona_residencia"].'&nombre_acu='.$fila["nombre_acu"].'&dir_acu='.$fila["dir_acu"].'&tel_acu='.$fila["tel_acu"].'&parentesco_acu='.$fila["parentesco_acu"].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span>HC ingreso</button></a></p>
							<p><a href="rpt_pt.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Plan Trimestral</button></a></p>
							<p><a href="rpt_evo_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&genero='.$fila["genero"].'&nomeps='.$fila["nom_eps"].'
							&eps='.$fila['eps'].'&fnacimiento='.$fila['fnacimiento'].'&regimen='.$fila["descritusuario"].'&dir_pac='.$fila['dir_pac'].'&tel_pac='.$fila["tel_pac"].'
							&afiliacion='.$fila["descriafiliado"].'&estadocivil='.$fila["estadocivil"].'&ocupacion='.$fila["descriocu"].'&ocupacion='.$fila["descriocu"].'&dep='.$fila["descripdep"].'&mun='.$fila["descrimuni"].'
							&zona='.$fila["zona_residencia"].'&nombre_acu='.$fila["nombre_acu"].'&dir_acu='.$fila["dir_acu"].'&tel_acu='.$fila["tel_acu"].'&parentesco_acu='.$fila["parentesco_acu"].'">

							<button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>

							<p><a href="rpt_im_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&eps='.$fila['eps'].'">
							<button type="button" class="btn btn-success sombra_movil "><span class="fa fa-file-pdf-o"></span> Informe Mensual</button></a></p>
							<p><a href="rpt_enfermeria_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Enfermeria</button></a></p>
							<p><a href="rpt_psicoCE_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							'.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'&servicio=INDE"><button type="button" class="btn btn-info" ><span class="fa fa-file-pdf-o"></span> PSICOLOGIA</button></a></p>
						 </th>';
				echo'<th class="text-center" >
							 <p><a href="rpt_evolucion_redservicios_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							 '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&cie='.$cie.'&eps='.$fila['eps'].'&genero='.$fila["genero"].'&nomeps='.$fila["nom_eps"].'
							&eps='.$fila['eps'].'&fnacimiento='.$fila['fnacimiento'].'&regimen='.$fila["descritusuario"].'&dir_pac='.$fila['dir_pac'].'&tel_pac='.$fila["tel_pac"].'
							&afiliacion='.$fila["descriafiliado"].'&estadocivil='.$fila["estadocivil"].'&ocupacion='.$fila["descriocu"].'&ocupacion='.$fila["descriocu"].'&dep='.$fila["descripdep"].'&mun='.$fila["descrimuni"].'
							&zona='.$fila["zona_residencia"].'&nombre_acu='.$fila["nombre_acu"].'&dir_acu='.$fila["dir_acu"].'&tel_acu='.$fila["tel_acu"].'&parentesco_acu='.$fila["parentesco_acu"].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p>
							 <p><a href="rpt_im_redservicios_inde.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].'
							 '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$fila["doc_pac"].'&cie='.$cie.'&tterapia='.$tterapia.'&eps='.$fila['eps'].'&genero='.$fila["genero"].'&nomeps='.$fila["nom_eps"].'
							&eps='.$fila['eps'].'&fnacimiento='.$fila['fnacimiento'].'&regimen='.$fila["descritusuario"].'&dir_pac='.$fila['dir_pac'].'&tel_pac='.$fila["tel_pac"].'
							&afiliacion='.$fila["descriafiliado"].'&estadocivil='.$fila["estadocivil"].'&ocupacion='.$fila["descriocu"].'&ocupacion='.$fila["descriocu"].'&dep='.$fila["descripdep"].'&mun='.$fila["descrimuni"].'
							&zona='.$fila["zona_residencia"].'&nombre_acu='.$fila["nombre_acu"].'&dir_acu='.$fila["dir_acu"].'&tel_acu='.$fila["tel_acu"].'&parentesco_acu='.$fila["parentesco_acu"].'">
							 <button type="button" class="btn btn-success sombra_movil "><span class="fa fa-file-pdf-o"></span> Informe Mensual</button></a></p>
						 </th>';
						 echo'<th class="text-center" >
									<p><a href="docpaciente/'.$fila['id_paciente'].'_Documento Identidad.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Documento</button></a></p>
									<p><a href="docpaciente/'.$fila['id_paciente'].'_Hoja Firmas.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Hoja Firmas</button></a></p>
									<p><a href="docpaciente/'.$fila['id_paciente'].'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Consentimiento</button></a></p>
								 </th>';
				echo "</tr>\n";
			}
		}
	}
}
	?>

</table>

</div>
</div>
</section>
	<?php
}
?>
