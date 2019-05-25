
<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

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
		<script type="text/javascript" src="/js/jquery.js"></script>
		<style>
		b{color:blue;}
		#resultado{width:600px;border:solid 1px #dadada;text-align:justify;padding:5px;}
		</style>
		<script src="ajax.js"></script>


<?php
}else{
	echo $subtitulo;
// nivel 1?>
<section class="panel panel-default">
	<section class="panel-body">
		<?php
			include("consulta_rapida1.php");
		?>
	</section>
	<section class="panel-heading"><h4>Reporteador general de Hospitalario Salud Mental</h4></section>
	<section class="panel panel-body">
		<section class="col-md-6">
			<section class="col-md-12">
				<form>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
	  						<input type="date" class="form-control" name="f1" aria-describedby="basic-addon1">
							</div><!-- /input-group -->
							<br>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
	  						<input type="date" class="form-control" name="f2" vlaue="<?php echo date('Y-m-d')?>" aria-describedby="basic-addon1">
							</div>
						</div><!-- /.col-lg-6 -->
						<div class="col-md-6">
							<div class="input-group">
								<input type="text" class="form-control" name="doc" placeholder="Documento">
								<span class="input-group-btn">
										<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
										<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
								</span>
							</div><!-- /input-group -->
						</div>

						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><span class="fa fa-user-md"></span></span>
								<select class="form-control" name="tipo_terapia">
									<option value="7">Todo</option>
									<option value="1">Evoluciones Medico</option>
									<option value="2">Notas enfermería</option>
									<option value="3">Terapia ocupacional</option>
									<option value="4">Psicologia</option>
									<option value="5">Medicamentos</option>
									<option value="6">Nutrición</option>
									<option value="8">Procedimientos</option>
									<option value="9">Post hospitalizacion</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</section>
		</section>
		<section class="col-md-6">
			<section class="col-md-12">
				<form>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
	  						<input type="date" class="form-control" name="f1" aria-describedby="basic-addon1">
							</div><!-- /input-group -->
							<br>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
	  						<input type="date" class="form-control" name="f2" vlaue="<?php echo date('Y-m-d')?>" aria-describedby="basic-addon1">
							</div>
						</div><!-- /.col-lg-6 -->
						<div class="col-md-6">
							<div class="input-group">
								<input type="text" class="form-control" name="nom" placeholder="Nombre">
								<span class="input-group-btn">
										<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
										<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
								</span>
							</div><!-- /input-group -->
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><span class="fa fa-user-md"></span></span>
								<select class="form-control" name="tipo_terapia">
									<option value="7">Todo</option>
									<option value="1">Evoluciones Medico</option>
									<option value="2">Notas enfermería</option>
									<option value="3">Terapia ocupacional</option>
									<option value="4">Psicologia</option>
									<option value="5">Medicamentos</option>
									<option value="6">Nutrición</option>
									<option value="8">Procedimientos</option>
									<option value="9">Post hospitalizacion</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</section>
		</section>
	</section>

	<section class="panel-body">
		<table class="table table-responsive table-bordered">
		<tr>
			<th class="text-center info">ADMINISTRATIVO</th>
			<th class="text-center info">PACIENTE</th>
			<th class="text-center info">INGRESO</th>
			<th class="text-center info">ASISTENCIAL</th>
			<th class="text-center info">TERAPUTICO</th>
			<th class="text-center info" colspan="2">ORDENES</th>
		</tr>

			<?php
			if (isset($_REQUEST["doc"])){
			$doc=$_REQUEST["doc"];
			$filtro1=$_REQUEST["f1"];
			$filtro2=$_REQUEST["f2"];
				if ($filtro1=='' && $filtro2=='') {

					$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,descricie,fotopac,
				               a.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,tipo_servicio,
				               s.nom_sedes,
				               e.nom_eps
				        FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
				                         LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
				                         left join eps e on a.id_eps=e.id_eps
				        WHERE p.doc_pac='".$doc."'  and tipo_servicio='Hospitalario' ";

				  if ($tabla=$bd1->sub_tuplas($sql)){
				    foreach ($tabla as $fila ) {
				      $f1=$fila['fingreso_hosp'];
				      $f2=$fila['fegreso_hosp'];
							if ($f2=='') {
								$f2=date('Y-m-d');
								echo"<tr >\n";
					      $idpaciente=$fila["id_paciente"];
								$idadm=$fila['id_adm_hosp'];
					      echo'<th class="text-left" >
					      <p><a href="/docpaciente/'.$idpaciente.'_Documento Identidad.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Identificación</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Autorizacion EPS.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Autorizacion</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Ingreso.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento ingreso</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento informado</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Traslado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento Traslado</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Epicrisis.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Epicrisis</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Pagare.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Pagare</button></a></p>
								';
								$sqlR="SELECT count(id_remision) remi FROM remision where id_adm_hosp='".$fila['id_adm_hosp']."'";
								if ($tablaR=$bd1->sub_tuplas($sqlR)){
									foreach ($tablaR as $filaR ) {
										if ($filaR['remi'] > 0) {
											echo'<p><span class="badge">'.$filaR['remi'].'</span></p>';
											echo'<p><a href="rpt_remision.php?idadmhosp='.$fila["id_adm_hosp"].'" target="_blank"><button type="button" class="btn btn-danger" > Remisión <span class="fa fa-print"></span></button></a></p>';
										}else {
											echo'<span class="badge">'.$filaR['remi'].' No hay remisión</span>';
										}

									}
								}
					      echo'</th>';
					      echo'<td class="text-center">
					            <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
					            <strong><p>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].' <br /><strong> ADM: </strong>'.$fila["id_adm_hosp"].'</p>
					           </td>';
					      echo'<td class="text-center">
					            <p><strong class="text-info">Ingreso: </strong>'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
					            <p><strong class="text-danger">SIN EGRESO HOSPITALARIO</strong></p>
					           </td>';
					      $edad=$fila["doc_pac"];
					      $idpaciente=$fila["id_paciente"];
								$idadm=$fila['id_adm_hosp'];
					      $cie=$fila["edad"];
					      $eps=$fila["nom_eps"];
					      echo'<th class="text-center" >
					              <p><a href="rpt_hcingreso.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC ingreso</button></a></p>
					              <p><a href="rpt1.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'&tipo_terapia='.$_REQUEST['tipo_terapia'].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evoluciones</button></a></p>
					              <p><a href="rptepicrisis.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Epicrisis</button></a></p></th>';
					              echo'<th class="text-center" >
					                      <p><a href="rpt_valfisio_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Fisioterapia</button></a></p>
					                      <p><a href="rpt_valfono_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Fonoaudiologia</button></a></p>
					                      <p><a href="rpt_valter_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Respiratoria</button></a></p>
					                      <p><a href="rpt_evoter_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p></th>';
					      echo'<th class="text-center">
					      <p><a href="rpt_incapa.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Incapacidad</button></a></p>
					      <p><a href="rpt_ordenadm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ayudas DX</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=98&idpac='.$fila["id_paciente"].'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-flask"></span> Ayudas DX HOSP</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=189&idadm='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Ambulatoria&tformula=Ambulatoria"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-pills"></span> Formulas<br>Ambulatorias</button></a></p></th>';
					      echo "</tr>\n";
							}else {

								echo"<tr >\n";
					      $idpaciente=$fila["id_paciente"];
								$idadm=$fila['id_adm_hosp'];
					      echo'<th class="text-left" >
					      <p><a href="/docpaciente/'.$idpaciente.'_Documento Identidad.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Identificación</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Autorizacion EPS.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Autorizacion</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Ingreso.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento ingreso</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento informado</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Traslado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento Traslado</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Epicrisis.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Epicrisis</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Pagare.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Pagare</button></a></p>
								';
								$sqlR="SELECT count(id_remision) remi FROM remision where id_adm_hosp='".$fila['id_adm_hosp']."'";
								if ($tablaR=$bd1->sub_tuplas($sqlR)){
									foreach ($tablaR as $filaR ) {
										if ($filaR['remi'] > 0) {
											echo'<p><span class="badge">'.$filaR['remi'].'</span></p>';
											echo'<p><a href="rpt_remision.php?idadmhosp='.$fila["id_adm_hosp"].'" target="_blank"><button type="button" class="btn btn-danger" > Remisión <span class="fa fa-print"></span></button></a></p>';
										}else {
											echo'<span class="badge">'.$filaR['remi'].' No hay remisión</span>';
										}

									}
								}
					      echo'</th>';
					      echo'<td class="text-center">
					            <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
					            <strong><p>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].' <br /><strong> ADM: </strong>'.$fila["id_adm_hosp"].'</p>
					           </td>';
					      echo'<td class="text-center">
					            <p><strong class="text-info">Ingreso: </strong>'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
					            <p><strong class="text-danger">Egreso: </strong>'.$fila["fegreso_hosp"].' | '.$fila["hegreso_hosp"].'</strong></p>
					           </td>';
					      $edad=$fila["doc_pac"];
					      $idpaciente=$fila["id_paciente"];
								$idadm=$fila['id_adm_hosp'];
					      $cie=$fila["edad"];
					      $eps=$fila["nom_eps"];
					      echo'<th class="text-center" >
					              <p><a href="rpt_hcingreso.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC ingreso</button></a></p>
					              <p><a href="rpt1.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'&tipo_terapia='.$_REQUEST['tipo_terapia'].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evoluciones</button></a></p>
					              <p><a href="rptepicrisis.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Epicrisis</button></a></p></th>';
					              echo'<th class="text-center" >
					                      <p><a href="rpt_valfisio_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Fisioterapia</button></a></p>
					                      <p><a href="rpt_valfono_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Fonoaudiologia</button></a></p>
					                      <p><a href="rpt_valter_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Respiratoria</button></a></p>
					                      <p><a href="rpt_evoter_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p></th>';
					      echo'<th class="text-center">
					      <p><a href="rpt_incapa.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Incapacidad</button></a></p>
					      <p><a href="rpt_ordenadm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ayudas DX</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=98&idpac='.$fila["id_paciente"].'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-flask"></span> Ayudas DX HOSP</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=189&idadm='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Ambulatoria&tformula=Ambulatoria"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-pills"></span> Formulas<br>Ambulatorias</button></a></p></th>';

					      echo "</tr>\n";
							}

				    }
				  }
				}else {
					$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,descricie,fotopac,
				               a.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,tipo_servicio,
				               s.nom_sedes,
				               e.nom_eps
				        FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
				                         LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
				                         left join eps e on a.id_eps=e.id_eps
				        WHERE p.doc_pac='".$doc."'  and tipo_servicio='Hospitalario' ";

				  if ($tabla=$bd1->sub_tuplas($sql)){
				    foreach ($tabla as $fila ) {
				      $f1=$_REQUEST['f1'];
				      $f2=$_REQUEST['f2'];
							if ($f2=='') {
								$f2=date('Y-m-d');
								echo"<tr >\n";
					      $idpaciente=$fila["id_paciente"];
								$idadm=$fila['id_adm_hosp'];
					      echo'<th class="text-left" >
					      <p><a href="/docpaciente/'.$idpaciente.'_Documento Identidad.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Identificación</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Autorizacion EPS.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Autorizacion</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Ingreso.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento ingreso</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento informado</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Traslado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento Traslado</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Epicrisis.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Epicrisis</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Pagare.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Pagare</button></a></p>
								';
								$sqlR="SELECT count(id_remision) remi FROM remision where id_adm_hosp='".$fila['id_adm_hosp']."'";
								if ($tablaR=$bd1->sub_tuplas($sqlR)){
									foreach ($tablaR as $filaR ) {
										if ($filaR['remi'] > 0) {
											echo'<p><span class="badge">'.$filaR['remi'].'</span></p>';
											echo'<p><a href="rpt_remision.php?idadmhosp='.$fila["id_adm_hosp"].'" target="_blank"><button type="button" class="btn btn-danger" > Remisión <span class="fa fa-print"></span></button></a></p>';
										}else {
											echo'<span class="badge">'.$filaR['remi'].' No hay remisión</span>';
										}

									}
								}
					      echo'</th>';
					      echo'<td class="text-center">
					            <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
					            <strong><p>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].' <br /><strong> ADM: </strong>'.$fila["id_adm_hosp"].'</p>
					           </td>';
					      echo'<td class="text-center">
					            <p><strong class="text-info">Ingreso: </strong>'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
					            <p><strong class="text-danger">SIN EGRESO HOSPITALARIO</strong></p>
					           </td>';
					      $edad=$fila["doc_pac"];
					      $idpaciente=$fila["id_paciente"];
								$idadm=$fila['id_adm_hosp'];
					      $cie=$fila["edad"];
					      $eps=$fila["nom_eps"];
					      echo'<th class="text-center" >
					              <p><a href="rpt_hcingreso.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC ingreso</button></a></p>
					              <p><a href="rpt1.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'&tipo_terapia='.$_REQUEST['tipo_terapia'].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evoluciones</button></a></p>
					              <p><a href="rptepicrisis.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Epicrisis</button></a></p></th>';
					              echo'<th class="text-center" >
					                      <p><a href="rpt_valfisio_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Fisioterapia</button></a></p>
					                      <p><a href="rpt_valfono_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Fonoaudiologia</button></a></p>
					                      <p><a href="rpt_valter_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Respiratoria</button></a></p>
					                      <p><a href="rpt_evoter_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p></th>';
					      echo'<th class="text-center">
					      <p><a href="rpt_incapa.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Incapacidad</button></a></p>
					      <p><a href="rpt_ordenadm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ayudas DX</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=98&idpac='.$fila["id_paciente"].'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-flask"></span> Ayudas DX HOSP</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=189&idadm='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Ambulatoria&tformula=Ambulatoria"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-pills"></span> Formulas<br>Ambulatorias</button></a></p></th>';

					      echo "</tr>\n";
							}else {
								echo"<tr >\n";
					      $idpaciente=$fila["id_paciente"];
								$idadm=$fila['id_adm_hosp'];
					      echo'<th class="text-left" >
					      <p><a href="/docpaciente/'.$idpaciente.'_Documento Identidad.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Identificación</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Autorizacion EPS.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Autorizacion</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Ingreso.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento ingreso</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento informado</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Traslado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento Traslado</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Epicrisis.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Epicrisis</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Pagare.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Pagare</button></a></p>
								';
								$sqlR="SELECT count(id_remision) remi FROM remision where id_adm_hosp='".$fila['id_adm_hosp']."'";
								if ($tablaR=$bd1->sub_tuplas($sqlR)){
									foreach ($tablaR as $filaR ) {
										if ($filaR['remi'] > 0) {
											echo'<p><span class="badge">'.$filaR['remi'].'</span></p>';
											echo'<p><a href="rpt_remision.php?idadmhosp='.$fila["id_adm_hosp"].'" target="_blank"><button type="button" class="btn btn-danger" > Remisión <span class="fa fa-print"></span></button></a></p>';
										}else {
											echo'<span class="badge">'.$filaR['remi'].' No hay remisión</span>';
										}

									}
								}
					      echo'</th>';
					      echo'<td class="text-center">
					            <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
					            <strong><p>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].' <br /><strong> ADM: </strong>'.$fila["id_adm_hosp"].'</p>
					           </td>';
					      echo'<td class="text-center">
					            <p><strong class="text-info">Ingreso: </strong>'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
					            <p><strong class="text-danger">Egreso: </strong>'.$fila["fegreso_hosp"].' | '.$fila["hegreso_hosp"].'</strong></p>
					           </td>';
					      $edad=$fila["doc_pac"];
					      $idpaciente=$fila["id_paciente"];
								$idadm=$fila['id_adm_hosp'];
					      $cie=$fila["edad"];
					      $eps=$fila["nom_eps"];
					      echo'<th class="text-center" >
					              <p><a href="rpt_hcingreso.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC ingreso</button></a></p>
					              <p><a href="rpt1.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'&tipo_terapia='.$_REQUEST['tipo_terapia'].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evoluciones</button></a></p>
					              <p><a href="rptepicrisis.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Epicrisis</button></a></p></th>';
					              echo'<th class="text-center" >
					                      <p><a href="rpt_valfisio_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Fisioterapia</button></a></p>
					                      <p><a href="rpt_valfono_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Fonoaudiologia</button></a></p>
					                      <p><a href="rpt_valter_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Respiratoria</button></a></p>
					                      <p><a href="rpt_evoter_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p></th>';
					      echo'<th class="text-center">
					      <p><a href="rpt_incapa.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Incapacidad</button></a></p>
					      <p><a href="rpt_ordenadm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ayudas DX</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=98&idpac='.$fila["id_paciente"].'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-flask"></span> Ayudas DX HOSP</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=189&idadm='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Ambulatoria&tformula=Ambulatoria"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-pills"></span> Formulas<br>Ambulatorias</button></a></p></th>';

					      echo "</tr>\n";
							}

				    }
				  }
				}

			}

		if (isset($_REQUEST["nom"])){
			$doc=$_REQUEST["nom"];
			$filtro1=$_REQUEST["f1"];
			$filtro2=$_REQUEST["f2"];
				if ($filtro1=='' && $filtro2=='') {

					$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,descricie,fotopac,
					             a.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
					             s.nom_sedes,
					             e.nom_eps
					      FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
					                       LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
					                       LEFT JOIN eps e on a.id_eps=e.id_eps
					      WHERE p.nom_completo  LIKE '%".$doc."%'  and tipo_servicio='Hospitalario'";

				  if ($tabla=$bd1->sub_tuplas($sql)){
				    foreach ($tabla as $fila ) {
				      $f1=$fila['fingreso_hosp'];
				      $f2=$fila['fegreso_hosp'];
							if ($f2=='') {
								$f2=date('Y-m-d');
								echo"<tr >\n";
					      $idpaciente=$fila["id_paciente"];
								$idadm=$fila['id_adm_hosp'];
					      echo'<th class="text-left" >
					      <p><a href="/docpaciente/'.$idpaciente.'_Documento Identidad.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Identificación</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Autorizacion EPS.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Autorizacion</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Ingreso.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento ingreso</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento informado</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Traslado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento Traslado</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Epicrisis.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Epicrisis</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Pagare.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Pagare</button></a></p>
								';
								$sqlR="SELECT count(id_remision) remi FROM remision where id_adm_hosp='".$fila['id_adm_hosp']."'";
								if ($tablaR=$bd1->sub_tuplas($sqlR)){
									foreach ($tablaR as $filaR ) {
										if ($filaR['remi'] > 0) {
											echo'<p><span class="badge">'.$filaR['remi'].'</span></p>';
											echo'<p><a href="rpt_remision.php?idadmhosp='.$fila["id_adm_hosp"].'" target="_blank"><button type="button" class="btn btn-danger" > Remisión <span class="fa fa-print"></span></button></a></p>';
										}else {
											echo'<span class="badge">'.$filaR['remi'].' No hay remisión</span>';
										}

									}
								}
					      echo'</th>';
					      echo'<td class="text-center">
					            <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
					            <strong><p>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].' <br /><strong> ADM: </strong>'.$fila["id_adm_hosp"].'</p>
					           </td>';
					      echo'<td class="text-center">
					            <p><strong class="text-info">Ingreso: </strong>'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
					            <p><strong class="text-danger">SIN EGRESO HOSPITALARIO</strong></p>
					           </td>';
					      $edad=$fila["doc_pac"];
					      $idpaciente=$fila["id_paciente"];
								$idadm=$fila['id_adm_hosp'];
					      $cie=$fila["edad"];
					      $eps=$fila["nom_eps"];
					      echo'<th class="text-center" >
					              <p><a href="rpt_hcingreso.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC ingreso</button></a></p>
					              <p><a href="rpt1.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'&tipo_terapia='.$_REQUEST['tipo_terapia'].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evoluciones</button></a></p>
					              <p><a href="rptepicrisis.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Epicrisis</button></a></p></th>';
					              echo'<th class="text-center" >
					                      <p><a href="rpt_valfisio_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Fisioterapia</button></a></p>
					                      <p><a href="rpt_valfono_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Fonoaudiologia</button></a></p>
					                      <p><a href="rpt_valter_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Respiratoria</button></a></p>
					                      <p><a href="rpt_evoter_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p></th>';
					      echo'<th class="text-center">
					      <p><a href="rpt_incapa.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Incapacidad</button></a></p>
					      <p><a href="rpt_ordenadm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ayudas DX</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=98&idpac='.$fila["id_paciente"].'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-flask"></span> Ayudas DX HOSP</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=189&idadm='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Ambulatoria&tformula=Ambulatoria"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-pills"></span> Formulas<br>Ambulatorias</button></a></p></th>';

					      echo "</tr>\n";
							}else {

								echo"<tr >\n";
					      $idpaciente=$fila["id_paciente"];
								$idadm=$fila['id_adm_hosp'];
					      echo'<th class="text-left" >
					      <p><a href="/docpaciente/'.$idpaciente.'_Documento Identidad.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Identificación</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Autorizacion EPS.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Autorizacion</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Ingreso.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento ingreso</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento informado</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Traslado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento Traslado</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Epicrisis.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Epicrisis</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Pagare.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Pagare</button></a></p>
								';
								$sqlR="SELECT count(id_remision) remi FROM remision where id_adm_hosp='".$fila['id_adm_hosp']."'";
								if ($tablaR=$bd1->sub_tuplas($sqlR)){
									foreach ($tablaR as $filaR ) {
										if ($filaR['remi'] > 0) {
											echo'<p><span class="badge">'.$filaR['remi'].'</span></p>';
											echo'<p><a href="rpt_remision.php?idadmhosp='.$fila["id_adm_hosp"].'" target="_blank"><button type="button" class="btn btn-danger" > Remisión <span class="fa fa-print"></span></button></a></p>';
										}else {
											echo'<span class="badge">'.$filaR['remi'].' No hay remisión</span>';
										}

									}
								}
					      echo'</th>';
					      echo'<td class="text-center">
					            <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
					            <strong><p>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].' <br /><strong> ADM: </strong>'.$fila["id_adm_hosp"].'</p>
					           </td>';
					      echo'<td class="text-center">
					            <p><strong class="text-info">Ingreso: </strong>'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
					            <p><strong class="text-danger">Egreso: </strong>'.$fila["fegreso_hosp"].' | '.$fila["hegreso_hosp"].'</strong></p>
					           </td>';
					      $edad=$fila["doc_pac"];
					      $idpaciente=$fila["id_paciente"];
								$idadm=$fila['id_adm_hosp'];
					      $cie=$fila["edad"];
					      $eps=$fila["nom_eps"];
					      echo'<th class="text-center" >
					              <p><a href="rpt_hcingreso.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC ingreso</button></a></p>
					              <p><a href="rpt1.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'&tipo_terapia='.$_REQUEST['tipo_terapia'].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evoluciones</button></a></p>
					              <p><a href="rptepicrisis.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Epicrisis</button></a></p></th>';
					              echo'<th class="text-center" >
					                      <p><a href="rpt_valfisio_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Fisioterapia</button></a></p>
					                      <p><a href="rpt_valfono_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Fonoaudiologia</button></a></p>
					                      <p><a href="rpt_valter_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Respiratoria</button></a></p>
					                      <p><a href="rpt_evoter_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p></th>';
					      echo'<th class="text-center">
					      <p><a href="rpt_incapa.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Incapacidad</button></a></p>
					      <p><a href="rpt_ordenadm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ayudas DX</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=98&idpac='.$fila["id_paciente"].'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-flask"></span> Ayudas DX HOSP</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=189&idadm='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Ambulatoria&tformula=Ambulatoria"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-pills"></span> Formulas<br>Ambulatorias</button></a></p></th>';

					      echo "</tr>\n";
							}

				    }
				  }
				}else {
					$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,descricie,fotopac,
					             a.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
					             s.nom_sedes,
					             e.nom_eps
					      FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
					                       LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
					                       LEFT JOIN eps e on a.id_eps=e.id_eps
					      WHERE p.nom_completo  LIKE '%".$doc."%'  and tipo_servicio='Hospitalario'";

				  if ($tabla=$bd1->sub_tuplas($sql)){
				    foreach ($tabla as $fila ) {
				      $f1=$_REQUEST['f1'];
				      $f2=$_REQUEST['f2'];
							if ($f2=='') {
								$f2=date('Y-m-d');
								echo"<tr >\n";
					      $idpaciente=$fila["id_paciente"];
								$idadm=$fila['id_adm_hosp'];
					      echo'<th class="text-left" >
					      <p><a href="/docpaciente/'.$idpaciente.'_Documento Identidad.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Identificación</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Autorizacion EPS.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Autorizacion</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Ingreso.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento ingreso</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento informado</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Traslado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento Traslado</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Epicrisis.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Epicrisis</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Pagare.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Pagare</button></a></p>
								';
								$sqlR="SELECT count(id_remision) remi FROM remision where id_adm_hosp='".$fila['id_adm_hosp']."'";
								if ($tablaR=$bd1->sub_tuplas($sqlR)){
									foreach ($tablaR as $filaR ) {
										if ($filaR['remi'] > 0) {
											echo'<p><span class="badge">'.$filaR['remi'].'</span></p>';
											echo'<p><a href="rpt_remision.php?idadmhosp='.$fila["id_adm_hosp"].'" target="_blank"><button type="button" class="btn btn-danger" > Remisión <span class="fa fa-print"></span></button></a></p>';
										}else {
											echo'<span class="badge">'.$filaR['remi'].' No hay remisión</span>';
										}

									}
								}
					      echo'</th>';
					      echo'<td class="text-center">
					            <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
					            <strong><p>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].' <br /><strong> ADM: </strong>'.$fila["id_adm_hosp"].'</p>
					           </td>';
					      echo'<td class="text-center">
					            <p><strong class="text-info">Ingreso: </strong>'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
					            <p><strong class="text-danger">SIN EGRESO HOSPITALARIO</strong></p>
					           </td>';
					      $edad=$fila["doc_pac"];
					      $idpaciente=$fila["id_paciente"];
								$idadm=$fila['id_adm_hosp'];
					      $cie=$fila["edad"];
					      $eps=$fila["nom_eps"];
					      echo'<th class="text-center" >
					              <p><a href="rpt_hcingreso.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC ingreso</button></a></p>
					              <p><a href="rpt1.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'&tipo_terapia='.$_REQUEST['tipo_terapia'].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evoluciones</button></a></p>
					              <p><a href="rptepicrisis.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Epicrisis</button></a></p></th>';
					              echo'<th class="text-center" >
					                      <p><a href="rpt_valfisio_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Fisioterapia</button></a></p>
					                      <p><a href="rpt_valfono_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Fonoaudiologia</button></a></p>
					                      <p><a href="rpt_valter_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Respiratoria</button></a></p>
					                      <p><a href="rpt_evoter_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p></th>';
					      echo'<th class="text-center">
					      <p><a href="rpt_incapa.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Incapacidad</button></a></p>
					      <p><a href="rpt_ordenadm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ayudas DX</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=98&idpac='.$fila["id_paciente"].'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-flask"></span> Ayudas DX HOSP</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=189&idadm='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Ambulatoria&tformula=Ambulatoria"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-pills"></span> Formulas<br>Ambulatorias</button></a></p></th>';

					      echo "</tr>\n";
							}else {
								echo"<tr >\n";
					      $idpaciente=$fila["id_paciente"];
								$idadm=$fila['id_adm_hosp'];
								$idadm=$fila["id_adm_hosp"];
					      echo'<th class="text-left" >
					      <p><a href="/docpaciente/'.$idpaciente.'_Documento Identidad.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Identificación</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Autorizacion EPS.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Autorizacion</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Ingreso.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento ingreso</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento informado</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Consentimiento Traslado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Consentimiento Traslado</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Epicrisis.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Epicrisis</button></a></p>
					      <p><a href="/docpaciente/'.$idadm.'_Pagare.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Pagare</button></a></p>
								';
								$sqlR="SELECT count(id_remision) remi FROM remision where id_adm_hosp='".$fila['id_adm_hosp']."'";
								if ($tablaR=$bd1->sub_tuplas($sqlR)){
									foreach ($tablaR as $filaR ) {
										if ($filaR['remi'] > 0) {
											echo'<p><span class="badge">'.$filaR['remi'].'</span></p>';
											echo'<p><a href="rpt_remision.php?idadmhosp='.$fila["id_adm_hosp"].'" target="_blank"><button type="button" class="btn btn-danger" > Remisión <span class="fa fa-print"></span></button></a></p>';
										}else {
											echo'<span class="badge">'.$filaR['remi'].' No hay remisión</span>';
										}

									}
								}
					      echo'</th>';
					      echo'<td class="text-center">
					            <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
					            <strong><p>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].' <br /><strong> ADM: </strong>'.$fila["id_adm_hosp"].'</p>
					           </td>';
					      echo'<td class="text-center">
					            <p><strong class="text-info">Ingreso: </strong>'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
					            <p><strong class="text-danger">Egreso: </strong>'.$fila["fegreso_hosp"].' | '.$fila["hegreso_hosp"].'</strong></p>
					           </td>';
					      $edad=$fila["doc_pac"];
					      $idpaciente=$fila["id_paciente"];
								$idadm=$fila['id_adm_hosp'];
					      $cie=$fila["edad"];
					      $eps=$fila["nom_eps"];
					      echo'<th class="text-center" >
					              <p><a href="rpt_hcingreso.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC ingreso</button></a></p>
					              <p><a href="rpt1.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'&tipo_terapia='.$_REQUEST['tipo_terapia'].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evoluciones</button></a></p>
					              <p><a href="rptepicrisis.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-file-pdf-o"></span> Epicrisis</button></a></p></th>';
					              echo'<th class="text-center" >
					                      <p><a href="rpt_valfisio_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Fisioterapia</button></a></p>
					                      <p><a href="rpt_valfono_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Fonoaudiologia</button></a></p>
					                      <p><a href="rpt_valter_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Val. Respiratoria</button></a></p>
					                      <p><a href="rpt_evoter_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Evolución</button></a></p></th>';
					      echo'<th class="text-center">
					      <p><a href="rpt_incapa.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Incapacidad</button></a></p>
					      <p><a href="rpt_ordenadm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ayudas DX</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=98&idpac='.$fila["id_paciente"].'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-flask"></span> Ayudas DX HOSP</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=189&idadm='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Ambulatoria&tformula=Ambulatoria"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-pills"></span> Formulas<br>Ambulatorias</button></a></p></th>';

					      echo "</tr>\n";
							}

				    }
				  }
				}


		}
			?>

	</table>
</section>
	<?php
}
?>
