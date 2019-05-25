
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
	<section class="panel-heading"><h4>Reporteador Servicios Consulta externa REH</h4></section>
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
				<article class="col-xs-3">
					<label>Filtro por identificacion:</label>
					<input type="text" class="form-control" name="doc" placeholder="Digite Identificacion">
				</article>
				<div>
					<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
					<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
				</div>
			</section>
		</form>
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
				<article class="col-xs-3">
					<label>Filtro por identificacion:</label>
					<input type="text" class="form-control" name="doc" placeholder="Digite Identificacion">
				</article>
				<div>
					<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
					<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
				</div>
			</section>
		</form>
		<form>
			<section class="col-xs-5">
				<article class="col-xs-12">
					<label>Consolidado para evoluciones y valoraciones :</label>
					<a href="reporteexcel/rptexcel_ce1.php?f1=<?php echo $_REQUEST["fecha1"];?>&f2=<?php echo $_REQUEST["fecha2"];?>"> Haz clic para descargar el reporte</a>
				</article>
			</section>
		</form>
	</section>
	<section class="panel-body">

		<table class="table table-bordered table-responsive">
			<tr>
				<th class="info">PACIENTE</th>
				<th class="info">INGRESO</th>
				<th class="info">SOPORTES</th>
			</tr>

			<?php
			if (isset($_REQUEST["doc"])){
			$doc=$_REQUEST["doc"];
			$f1=$_REQUEST["fecha1"];
			$f2=$_REQUEST["fecha2"];
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,descricie,fotopac,
			a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
			s.nom_sedes,
			e.nom_eps
			FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
			                 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
			                 LEFT JOIN eps e on a.id_eps=e.id_eps
			WHERE p.doc_pac='".$doc."'  and tipo_servicio='Consulta externa REH' ";

			if ($tabla=$bd1->sub_tuplas($sql)){
			  //echo $sql;
			  foreach ($tabla as $fila ) {

			    echo"<tr >\n";
			    echo'<td class="text-left">
								<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
								<p><strong>'.$fila["tdoc_pac"].': '.$fila["doc_pac"].' -- AMD:'.$fila["id_adm_hosp"].'</strong></p>
							 </td>';
			    echo'<td class="text-left">
								<p>'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
								<p><strong>SEDE:</strong> '.$fila["nom_sedes"].' <br><strong>EPS:</strong> '.$fila["nom_eps"].'</p>
							 </td>';
			    $eps=$fila["nom_eps"];
			    $doc=$fila["doc_pac"];
			    $cie=$fila["descricie"];
					echo'<th class="text-left" >';
								$adm=$fila['id_adm_hosp'];
								$sql_v_fi="SELECT id_valini_ce,freg,dxp FROM val_ini_ce WHERE id_adm_hosp=$adm and tterapia='FISIOTERAPIA'
								LIMIT 1";
								if ($tabla_v_fi=$bd1->sub_tuplas($sql_v_fi)){
									foreach ($tabla_v_fi as $fila_v_fi ) {
										echo'<article class="alert alert-info">
													<label>FISIOTERAPIA: </label>';
										echo'<p><a href="rpt_valinifisio_ce.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning  " ><span class="fa fa-file-pdf-o"></span> Valoracion</button></a></p>';
										echo'<p><a href="rpt_fisioce.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$fila_v_fi['dxp'].'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success  " ><span class="fa fa-file-pdf-o"></span>  Evoluciones</button></a></p>';
										echo'</article>';
									}
								}
								$adm=$fila['id_adm_hosp'];
								$sql_v_fo="SELECT id_valini_ce,freg,dxp FROM val_ini_ce WHERE id_adm_hosp=$adm and tterapia='FONOAUDIOLOGIA'
								LIMIT 1";
								if ($tabla_v_fo=$bd1->sub_tuplas($sql_v_fo)){
									foreach ($tabla_v_fo as $fila_v_fo ) {
										echo'<article class="alert alert-info">
													<label>FONOAUDIOLOGIA: </label>';
										echo'<p><a href="rpt_valinifono_ce.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning  " ><span class="fa fa-file-pdf-o"></span> Valoracion</button></a></p>';
										echo'<p><a href="rpt_fonoce.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$fila_v_fo['dxp'].'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success  " ><span class="fa fa-file-pdf-o"></span> Evoluciones</button></a></p>';
										echo'</article>';
									}
								}
								$adm=$fila['id_adm_hosp'];
								$sql_v_to="SELECT id_valini_ce,freg,dxp FROM val_ini_ce WHERE id_adm_hosp=$adm and tterapia='TERAPIA OCUPACIONAL'
								LIMIT 1";
								if ($tabla_v_to=$bd1->sub_tuplas($sql_v_to)){
									foreach ($tabla_v_to as $fila_v_to ) {
										echo'<article class="alert alert-info">
													<label>TERAPIA OCUPACIONAL: </label>';
										echo'<p><a href="rpt_valinito_ce.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning  " ><span class="fa fa-file-pdf-o"></span> Valoracion</button></a></p>';
										echo'<p><a href="rpt_toce.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$fila_v_to['dxp'].'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success  " ><span class="fa fa-file-pdf-o"></span> Evoluciones</button></a></p>';
										echo'</article>';
									}
								}
								$adm=$fila['id_adm_hosp'];
								$sql_v_tr="SELECT id_valini_ce,freg,dxp FROM val_ini_ce WHERE id_adm_hosp=$adm and tterapia='TERAPIA RESPIRATORIA'
								LIMIT 1";
								if ($tabla_v_tr=$bd1->sub_tuplas($sql_v_tr)){
									foreach ($tabla_v_tr as $fila_v_tr ) {
										echo'<article class="alert alert-info">
													<label>TERAPIA RESPIRATORIA: </label>';
										echo'<p><a href="rpt_valinitr_ce.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning  " ><span class="fa fa-file-pdf-o"></span> Valoracion</button></a></p>';
										echo'<p><a href="rpt_trce.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$fila_v_tr['dxp'].'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success  " ><span class="fa fa-file-pdf-o"></span> Evoluciones</button></a></p>';
										echo'</article>';
									}
								}
					echo'</th>';

			    echo "</tr>\n";
			  }
			}
			}
			if (isset($_REQUEST["nom"])){
			$doc=$_REQUEST["nom"];
			$f1=$_REQUEST["fecha1"];
			$f2=$_REQUEST["fecha2"];
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,descricie,fotopac,a.id_adm_hosp,fingreso_hosp,hingreso_hosp,s.nom_sedes
			FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
			WHERE p.nom1  LIKE '%".$doc."%'  and tipo_servicio='Consulta externa REH'";

			if ($tabla=$bd1->sub_tuplas($sql)){
			  //echo $sql;
			  foreach ($tabla as $fila ) {


								    echo"<tr >\n";
								    echo'<td class="text-left">
													<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
													<p><strong>'.$fila["tdoc_pac"].': '.$fila["doc_pac"].' -- AMD:'.$fila["id_adm_hosp"].'</strong></p>
												 </td>';
								    echo'<td class="text-left">
													<p>'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
													<p><strong>SEDE:</strong> '.$fila["nom_sedes"].' <br><strong>EPS:</strong> '.$fila["nom_eps"].'</p>
												 </td>';
								    $eps=$fila["nom_eps"];
								    $doc=$fila["doc_pac"];
								    $cie=$fila["descricie"];
										echo'<th class="text-left" >';
													$adm=$fila['id_adm_hosp'];
													$sql_v_fi="SELECT id_valini_ce,freg,dxp FROM val_ini_ce WHERE id_adm_hosp=$adm and tterapia='FISIOTERAPIA'
													LIMIT 1";
													if ($tabla_v_fi=$bd1->sub_tuplas($sql_v_fi)){
														foreach ($tabla_v_fi as $fila_v_fi ) {
															echo'<article class="alert alert-info">
																		<label>FISIOTERAPIA: </label>';
															echo'<p><a href="rpt_valinifisio_ce.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning  " ><span class="fa fa-file-pdf-o"></span> Valoracion</button></a></p>';
															echo'<p><a href="rpt_fisioce.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$fila_v_fi['dxp'].'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success  " ><span class="fa fa-file-pdf-o"></span>  Evoluciones</button></a></p>';
															echo'</article>';
														}
													}
													$adm=$fila['id_adm_hosp'];
													$sql_v_fo="SELECT id_valini_ce,freg,dxp FROM val_ini_ce WHERE id_adm_hosp=$adm and tterapia='FONOAUDIOLOGIA'
													LIMIT 1";
													if ($tabla_v_fo=$bd1->sub_tuplas($sql_v_fo)){
														foreach ($tabla_v_fo as $fila_v_fo ) {
															echo'<article class="alert alert-info">
																		<label>FONOAUDIOLOGIA: </label>';
															echo'<p><a href="rpt_valinifono_ce.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning  " ><span class="fa fa-file-pdf-o"></span> Valoracion</button></a></p>';
															echo'<p><a href="rpt_fonoce.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$fila_v_fo['dxp'].'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success  " ><span class="fa fa-file-pdf-o"></span> Evoluciones</button></a></p>';
															echo'</article>';
														}
													}
													$adm=$fila['id_adm_hosp'];
													$sql_v_to="SELECT id_valini_ce,freg,dxp FROM val_ini_ce WHERE id_adm_hosp=$adm and tterapia='TERAPIA OCUPACIONAL'
													LIMIT 1";
													if ($tabla_v_to=$bd1->sub_tuplas($sql_v_to)){
														foreach ($tabla_v_to as $fila_v_to ) {
															echo'<article class="alert alert-info">
																		<label>TERAPIA OCUPACIONAL: </label>';
															echo'<p><a href="rpt_valinito_ce.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning  " ><span class="fa fa-file-pdf-o"></span> Valoracion</button></a></p>';
															echo'<p><a href="rpt_toce.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$fila_v_to['dxp'].'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success  " ><span class="fa fa-file-pdf-o"></span> Evoluciones</button></a></p>';
															echo'</article>';
														}
													}
													$adm=$fila['id_adm_hosp'];
													$sql_v_tr="SELECT id_valini_ce,freg,dxp FROM val_ini_ce WHERE id_adm_hosp=$adm and tterapia='TERAPIA RESPIRATORIA'
													LIMIT 1";
													if ($tabla_v_tr=$bd1->sub_tuplas($sql_v_tr)){
														foreach ($tabla_v_tr as $fila_v_tr ) {
															echo'<article class="alert alert-info">
																		<label>TERAPIA RESPIRATORIA: </label>';
															echo'<p><a href="rpt_valinitr_ce.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-warning  " ><span class="fa fa-file-pdf-o"></span> Valoracion</button></a></p>';
															echo'<p><a href="rpt_trce.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$fila_v_tr['dxp'].'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-success  " ><span class="fa fa-file-pdf-o"></span> Evoluciones</button></a></p>';
															echo'</article>';
														}
													}
										echo'</th>';

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
