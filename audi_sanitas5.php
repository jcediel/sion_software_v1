
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
				$tam1=$_POST["tad"] * 2;
				$tam2=$tam1 + $_POST["tds"];
				$tamt=$tam2/3;
				$sql="INSERT INTO hc_hospitalario (id_adm_hosp,id_user,freg_hchosp,hreg_hchosp,motivo_consulta,enfer_actual,his_personal,his_familiar,perso_premorbida,ant_alergicos,
													ant_patologico,ant_quirurgico,ant_toxicologico,ant_farmaco,ant_gineco,ant_psiquiatrico,ant_hospitalario,ant_traumatologico,ant_familiar,otros_ant,
													estado_general,tad,tas,tam,fr,fc,so,peso,talla,temperatura,imc,cabcuello,torax,ext,abdomen,neurologico,genitourinario,examen_mental,analisis,finalidad,causa_externa,plantratamiento,Resp_hchosp,especialidad,estado_hchosp) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["motivoconsulta"]."','".$_POST["enferactual"]."','".$_POST["hpersonal"]."','".$_POST["hfamiliar"]."','".$_POST["ppremorbida"]."','".$_POST["antalergico"]."','".$_POST["antpatologico"]."','".$_POST["antquirurgico"]."','".$_POST["anttoxicologicos"]."','".$_POST["antfarmacologico"]."','".$_POST["antgineco"]."','".$_POST["antpsiquiatrico"]."','".$_POST["anthospitalario"]."','".$_POST["anttrauma"]."','".$_POST["antfami"]."','".$_POST["antotros"]."','".$_POST["estadogen"]."','".$_POST["tad"]."','".$_POST["tas"]."','$tamt','".$_POST["fr"]."','".$_POST["fc"]."','".$_POST["sao2"]."','".$_POST["peso"]."','".$_POST["talla"]."','".$_POST["temperatura"]."','$imc2','".$_POST["cabezacuello"]."','".$_POST["torax"]."','".$_POST["extsup"]."','".$_POST["abdomen"]."','".$_POST["neurologico"]."','".$_POST["genitourinario"]."','".$_POST["exmental"]."','".$_POST["analisis"]."','".$_POST["finconsulta"]."','".$_POST["causaexterna"]."','".$_POST["plant"]."','".$_SESSION["AUT"]["nombre"]."','".$_SESSION["AUT"]["especialidad"]."','Realizada')";
				$subtitulo="Adicionado";

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
		<script src="ajax.js"></script>


<?php
}else{
	echo $subtitulo;
// nivel 1?>

<section class="panel panel-default">
	<section class="panel-heading"><h4>Reporteador Auditoria externa Sanitas EPS</h4></section>
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
					<label>Filtro Tipo de servicio:</label>
					<select name="tservicio" class="form-control" <?php echo atributo3; ?>>
						<?php
						$sql="SELECT id_serv,nomserv from tipo_servicio where id_serv in (1,2) ORDER BY id_serv ASC";
						if($tabla=$bd1->sub_tuplas($sql)){
							foreach ($tabla as $fila2) {
								if ($fila["nomserv"]==$fila2["nomserv"]){
									$sw=' selected="selected"';
								}else{
									$sw="";
								}
							echo '<option value="'.$fila2["nomserv"].'"'.$sw.'>'.$fila2["nomserv"].'</option>';
							}
						}
						?>
				</select>
				</article>
				<div>
					<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
					<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
				</div>
			</section>
		</form>
	</section>
		<?php
			$f1=$_REQUEST["fecha1"];
			$f2=$_REQUEST["fecha2"];
			$tserv=$_REQUEST["tservicio"];
			$tr1='
			<td class="text-center"><strong>INTRHOSPITALARIO</strong></td>
			<td class="text-center"><strong>DATOS PACIENTE</strong></td>
			<td class="text-center"><strong>EGRESO</strong></td>';
			$tr2='
			<td  class="text-center"><strong>PSIQUIATRIA</strong></td>
			<td class="text-center"><strong>DATOS PACIENTE</strong></td>
			<td class="text-center"><strong>INTERDISCIPLINARIOS</strong></td>';

		 ?>
		<table class="table table-bordered table-responsive">

			<tr>
				<?php
					if ($tserv=='Hospitalario') {
						echo $tr1;
					}
					if ($tserv=='Consulta Externa SM') {
						echo $tr2;
					}
				?>
			</tr>

			<section>
				<h3 class="alert alert-danger animated bounceInLeft">Se esta realizando filtro desde la fecha<strong> <?php echo $f1 ?> </strong> hasta la fecha <strong><?php echo $f2 ?></strong> en el servicio de <strong><?php echo $tserv ?></strong></h3>
			</section>
			<?php

			$f1=$_REQUEST["fecha1"];
			$f2=$_REQUEST["fecha2"];
			$tserv=$_REQUEST["tservicio"];
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,descricie,fotopac,
			a.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,tipo_servicio,estado_adm_hosp,
			s.nom_sedes,
			e.nom_eps
			FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
			                 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
			                 LEFT JOIN eps e on a.id_eps=e.id_eps
			WHERE a.id_eps in (13) and tipo_servicio='$tserv' Group by id_adm_hosp order by a.fingreso_hosp DESC";

			if ($tabla=$bd1->sub_tuplas($sql)){

			  foreach ($tabla as $fila ) {
					if ($tserv=='Hospitalario') {
						if ($fila['estado_adm_hosp']=='Activo') {
							echo"<tr >\n";
							$f1=$_REQUEST["fecha1"];
							$f2=$_REQUEST["fecha2"];
							$eps=$fila["nom_eps"];
					    $doc=$fila["doc_pac"];
					    $cie=$fila["descricie"];
							echo'<th class="text-left  alert-warning" >
										<p><a href="rpt_hcingreso.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-primary " ><span class="fa fa-file-pdf-o"></span> Historia Ingreso</button></a></p>
					    			<p><a href="rpt1.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'&tipo_terapia=7"><button type="button" class="btn btn-primary" ><span class="fa fa-file-pdf-o"></span> Evoluciones</button></a></p>
					    			<p><a href="rpt_ordenhosp.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-primary" ><span class="fa fa-file-pdf-o"></span> Ayudas DX</button></a></p>
									 </th>';
					    echo'<td class="text-center  alert-warning">
										<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
										<p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].' <br> <strong>AMD:</strong> '.$fila["id_adm_hosp"].'</p>
										<p><strong>Ingreso: </strong> '.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
										<p><strong>Egreso: </strong>';
										if ($fila["fegreso_hosp"]=='') {
											echo'<strong>SIN EGRESO</strong>';
										}else {
											echo''.$fila["fegreso_hosp"].' | '.$fila["hegreso_hosp"].'';
										}
							echo'</p>
									 <p><strong>'.$fila["nom_sedes"].'</strong></p>
								   </td>';
							$eps=$fila["nom_eps"];
					    $doc=$fila["doc_pac"];
					    $cie=$fila["descricie"];
							echo'<th class="text-center  alert-warning" ><span class="fa fa-ban fa-3x"></span></button></a></th>';
					    echo "</tr>\n";
						}else {
							echo"<tr >\n";
							$eps=$fila["nom_eps"];
					    $doc=$fila["doc_pac"];
					    $cie=$fila["descricie"];
							echo'<th class="text-left  alert-warning" >
										<p><a href="rpt_hcingreso.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-primary " ><span class="fa fa-file-pdf-o"></span> Historia Ingreso</button></a></p>
					    			<p><a href="rpt1.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'&tipo_terapia=7"><button type="button" class="btn btn-primary" ><span class="fa fa-file-pdf-o"></span> Evoluciones</button></a></p>
					    			<p><a href="rpt_ordenhosp.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&cie='.$cie.'&eps='.$eps.'&doc='.$doc.'"><button type="button" class="btn btn-primary" ><span class="fa fa-file-pdf-o"></span> Ayudas DX</button></a></p>
									 </th>';
					    echo'<td class="text-center  alert-warning">
										<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
										<p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].' <br> <strong>AMD:</strong> '.$fila["id_adm_hosp"].'</p>
										<p><strong>Ingreso: </strong> '.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
										<p><strong>Egreso: </strong>';
										if ($fila["fegreso_hosp"]=='') {
											echo'<strong>SIN EGRESO</strong>';
										}else {
											echo''.$fila["fegreso_hosp"].' | '.$fila["hegreso_hosp"].'';
										}
							echo'</p>
									 <p><strong>'.$fila["nom_sedes"].'</strong></p>
								   </td>';
							$eps=$fila["nom_eps"];
					    $doc=$fila["doc_pac"];
					    $cie=$fila["descricie"];
							echo'<th class="text-right alert-warning" >
										<p><a href="rpt_incapa.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-success  " ><span class="fa fa-file-pdf-o"></span> Incapacidades</button></a></p>
					    			<p><a href="rpt_ordenmedica.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-success  " ><span class="fa fa-file-pdf-o"></span> Ordenes medicas</button></a></p>
					    			<p><a href="rptepicrisis.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-success  " ><span class="fa fa-file-pdf-o"></span> Epicrisis</button></a></p>
									 </th>';
					    echo "</tr>\n";
						}

					}
					if ($tserv=='Consulta Externa SM') {
						echo"<tr >\n";
						$eps=$fila["nom_eps"];
				    $doc=$fila["doc_pac"];
				    $cie=$fila["descricie"];
						echo'<th class="text-center alert-info">
									<p><a href="rpt_hcCESM.php?idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span></button></a></p>
								  <p><a href="rptceSM.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_POST["fecha1"].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span></button></a></p>
								  <p><a href="rpt_ordenmedica.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> </button></a></p>
								  <p><a href="rpt_incapa.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'&eps='.$eps.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span></button></a></p>
								 </th>';
						echo'<td class="text-center  alert-warning">
									<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
									<p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].' <br> <strong>AMD:</strong> '.$fila["id_adm_hosp"].'</p>
									<p><strong>Ingreso: </strong> '.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
									<p><strong>Egreso: </strong>';
									if ($fila["fegreso_hosp"]=='') {
										echo'<strong>SIN EGRESO</strong>';
									}else {
										echo''.$fila["fegreso_hosp"].' | '.$fila["hegreso_hosp"].'';
									}
						echo'</p>
								 <p><strong>'.$fila["nom_sedes"].'</strong></p>
								 </td>';
						 $eps=$fila["nom_eps"];
	 					 $doc=$fila["doc_pac"];
	 					 $cie=$fila["descricie"];
						echo'<th class="text-center alert-info">
									<p><a href="rpt_valpsico_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_POST["fecha1"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-file-pdf-o"></span> Valoración Psicologia</button></a></p>
									<p><a href="rpt_valnutri_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_POST["fecha1"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-file-pdf-o"></span> Valoración Nutrición</button></a></p>
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
