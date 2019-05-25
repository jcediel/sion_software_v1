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
				$sql="";
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
				$sql="";
				$subtitulo="Adicionado";
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
			$subtitulo='EdiciÃ³n de datos del VehÃ­culo';
			break;
			case 'X':
			$sql="";
			$color="red";
			$boton="Eliminar";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$subtitulo='ConfirmaciÃ³n para eliminar de datos del VehÃ­culo';
			break;
			case 'A':
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,estadocivil,edad,lateralidad,profesion,religion,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_usuario,tipo_afiliacion,ocupacion,dep_residencia,mun_residencia,zona_residencia,nivel,via_ingreso,
									 s.nom_sedes
						FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
														 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
						WHERE a.id_adm_hosp=".$_GET["idadmhosp"];
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
	<section class="panel-heading"><h4>Reporteador general de consulta externa Salud Mental</h4></section>
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
	  						<input type="date" class="form-control" name="f2" aria-describedby="basic-addon1">
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
	  						<input type="date" class="form-control" name="f2" aria-describedby="basic-addon1">
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
					</div>
				</form>
			</section>
		</section>
	</section>
	<section>
		<table class="table table-bordered table-responsive">
			<tr>
				<th ></th>
				<th ></th>
				<th>IDENTIFICACIÓN</th>
				<th>PACIENTE</th>
				<th>FECHA INGRESO</th>
				<th>PSIQUIATRÍA</th>
				<th>INTERDISCIPLINARIOS</th>
			</tr>
			<?php
			if (isset($_REQUEST["doc"])){
				$doc=$_REQUEST["doc"];
        $f1=$_REQUEST["f1"];
        $f2=$_REQUEST["f2"];
				$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
										 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
										 s.nom_sedes
							FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
															 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
							WHERE p.doc_pac='".$doc."'  and tipo_servicio='Consulta Externa SM' ";
				if ($tabla=$bd1->sub_tuplas($sql)){
				//echo $sql;
					foreach ($tabla as $fila ) {
						echo"<tr >\n";
						echo'<th class="text-left" >
						<a href="docpaciente/'.$fila['id_paciente'].'_Documento Identidad.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Documento</button></a><br><br>
						<a href="docpaciente/'.$fila['id_paciente'].'_Epicrisis.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Epicrisis remisión</button></a><br><br>
						<a href="docpaciente/'.$fila['id_paciente'].'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Consentimiento</button></a></th>';
						echo'<th class="text-left" >
						<a href="rpt_incapa.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_POST["f1"].'&f2='.$_POST["f2"].'"><button type="button" class="btn btn-info  " ><span class="fa fa-blind"></span> Incapacidad</button></a><br><br>
						<a href="rpt_ordenadm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_POST["f1"].'&f2='.$_POST["f2"].'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'
            &eps='.$eps.'"><button type="button" class="btn btn-success  " ><span class="fa fa-flask"></span> Ord. Medica</button></a><br><br>
						<a href=".php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_POST["fecha1"].'"><button type="button" class="btn btn-danger  " ><span class="fa fa-toggle-on"></span> Formula</button></a></th>';
						echo'<td class="text-left"><p><strong>DOC:</strong>'.$fila["doc_pac"].'</p> <p><strong>ADM:</strong>'.$fila["id_adm_hosp"].'</p></td>';
						echo'<td class="text-left">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
						echo'<td class="text-left">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
						echo'<th class="text-left">
						<a href="rpt_hcCESM.php?idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a><br><br>
						<a href="rptceSM.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Contol</button></a></th>';
						echo'<th class="text-left" >
									<a href="rpt_valpsico_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_POST["f1"].'&f2='.$_POST["f2"].'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Psicología</button></a>
									<a href="rpt_valto_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_POST["f1"].'&f2='.$_POST["f2"].'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ocupacional</button></a>
									<a href="rpt_valnutri_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_POST["f1"].'&f2='.$_POST["f2"].'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Nutrición</button></a>
								 </th>';
						echo "</tr>\n";
					}
				}
			}
			if (isset($_REQUEST["nom"])){
				$doc=$_REQUEST["nom"];
				$f1=date;
				$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
										 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
										 s.nom_sedes
							FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
															 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
								WHERE p.nom_completo  LIKE '%".$doc."%'  and tipo_servicio='Consulta Externa SM'";
				if ($tabla=$bd1->sub_tuplas($sql)){
				//echo $sql;
					foreach ($tabla as $fila ) {
            echo"<tr >\n";
						echo'<th class="text-left" >
						<a href="docpaciente/'.$fila['id_paciente'].'_Documento Identidad.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Documento</button></a><br><br>
						<a href="docpaciente/'.$fila['id_paciente'].'_Epicrisis.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Epicrisis remisión</button></a><br><br>
						<a href="docpaciente/'.$fila['id_paciente'].'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info  " ><span class="fa fa-folder"></span> Consentimiento</button></a></th>';
						echo'<th class="text-left" >
						<a href="rpt_incapa.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_POST["f1"].'&f2='.$_POST["f2"].'"><button type="button" class="btn btn-info  " ><span class="fa fa-blind"></span> Incapacidad</button></a><br><br>
						<a href="rpt_ordenadm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_POST["f1"].'&f2='.$_POST["f2"].'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&cie='.$cie.'
            &eps='.$eps.'"><button type="button" class="btn btn-success  " ><span class="fa fa-flask"></span> Ord. Medica</button></a><br><br>
						<a href=".php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_POST["fecha1"].'"><button type="button" class="btn btn-danger  " ><span class="fa fa-toggle-on"></span> Formula</button></a></th>';
						echo'<td class="text-left"><p><strong>DOC:</strong>'.$fila["doc_pac"].'</p> <p><strong>ADM:</strong>'.$fila["id_adm_hosp"].'</p></td>';
						echo'<td class="text-left">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
						echo'<td class="text-left">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
						echo'<th class="text-left">
						<a href="rpt_hcCESM.php?idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-file-pdf-o"></span> HC</button></a><br><br>
						<a href="rptceSM.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> Contol</button></a></th>';
						echo'<th class="text-left" >
									<a href="rpt_valpsico_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_POST["f1"].'&f2='.$_POST["f2"].'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Psicología</button></a>
									<a href="rpt_valto_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_POST["f1"].'&f2='.$_POST["f2"].'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Ocupacional</button></a>
									<a href="rpt_valnutri_sm.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$_POST["f1"].'&f2='.$_POST["f2"].'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span> Nutrición</button></a>
								 </th>';
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
