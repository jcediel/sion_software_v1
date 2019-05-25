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
			case 'HC':
			$tallat=$_POST["talla"] * $_POST["talla"];
			$imc=$_POST["peso"] / $tallat;
			$tam1=$_POST["tad"] * 2;
			$tam2=$tam1 + $_POST["tds"];
			$tamt=$tam2/3;
			$dxp=substr($_POST['dx'], 0,4);
			$dx1=substr($_POST['dx1'], 0,4);
			$dx2=substr($_POST['dx2'], 0,4);
			$dx3=substr($_POST['dx3'], 0,4);

			$sql="INSERT INTO hc_hospdia (id_adm_hosp, id_user, freg_hchosp, hreg_hchosp, motivo_consulta, enfer_actual, his_personal, his_familiar,
				perso_premorbida, ant_alergicos, ant_patologico, ant_quirurgico, ant_toxicologico, ant_farmaco, ant_gineco, ant_psiquiatrico, ant_hospitalario,
				 ant_traumatologico, ant_familiar, otros_ant, estado_general, tad, tas, tam, fr, fc, so, peso, talla, temperatura, imc, cabcuello, torax, ext,
				 abdomen, neurologico, genitourinario, examen_mental, analisis, finalidad, causa_externa, dxp, ddxp, tdxp, dx1, ddx1, tdx1, dx2, ddx2, tdx2,
				 dx3, ddx3, tdx3, plantratamiento, tipo_atencion, especialidad, estado_hchosp) VALUES
			('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["motivoconsulta"]."',
			'".$_POST["enferactual"]."','".$_POST["hpersonal"]."','".$_POST["hfamiliar"]."','".$_POST["ppremorbida"]."','".$_POST["antalergico"]."',
			'".$_POST["antpatologico"]."','".$_POST["antquirurgico"]."','".$_POST["anttoxicologicos"]."','".$_POST["antfarmacologico"]."',
			'".$_POST["antgineco"]."','".$_POST["antpsiquiatrico"]."','".$_POST["anthospitalario"]."','".$_POST["anttrauma"]."','".$_POST["antfami"]."',
			'".$_POST["antotros"]."','".$_POST["estadogen"]."','".$_POST["tad"]."','".$_POST["tas"]."','$tamt','".$_POST["fr"]."','".$_POST["fc"]."',
			'".$_POST["sao2"]."','".$_POST["peso"]."','".$_POST["talla"]."','".$_POST["temperatura"]."','$imc','".$_POST["cabezacuello"]."',
			'".$_POST["torax"]."','".$_POST["extsup"]."','".$_POST["abdomen"]."','".$_POST["neurologico"]."','".$_POST["genitourinario"]."',
			'".$_POST["exmental"]."','".$_POST["analisis"]."','".$_POST["finconsulta"]."','".$_POST["causaexterna"]."','$dxp',
			'".$_POST["dx"]."','".$_POST["tdx"]."','$dxp','".$_POST["dx1"]."','".$_POST["tdx1"]."','$dx2','".$_POST["dx2"]."',
			'".$_POST["tdx2"]."','$dx3','".$_POST["dx3"]."','".$_POST["tdx3"]."','".$_POST["plant"]."','Hospital dia',
			'".$_SESSION["AUT"]["especialidad"]."','Realizada')";
				$subtitulo="Historia Clinica Hospital dia";
				$subtitulo1="Adicionado";

			break;
			case 'EVO':
			$dxp=substr($_POST['dx'], 0,4);
			$dx1=substr($_POST['dx1'], 0,4);
			$dx2=substr($_POST['dx2'], 0,4);
			$dx3=substr($_POST['dx3'], 0,4);
				$sql="INSERT INTO evo_medhd (id_adm_hosp,id_user,freg_evomed,hreg_evomed,objetivo,subjetivo,analisis_evomed,plan_tratamiento,dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,resp_evomed,estado_evomed) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["objetivo"]."',
				'".$_POST["subjetivo"]."','".$_POST["analisis"]."','".$_POST["plantratamiento"]."','$dxp','".$_POST["dx"]."','".$_POST["tdx"]."',
				'$dx1','".$_POST["dx1"]."','".$_POST["tdx1"]."','$dx2','".$_POST["dx2"]."','".$_POST["tdx2"]."',
				'".$_SESSION["AUT"]["nombre"]."','Realizada')";
				$subtitulo="Evolución Medica";
				$subtitulo1="Adicionado";
			break;
			case 'ORDVER':
				$sql="INSERT INTO orden_verbal( id_adm_hosp, id_user, freg_ord_verbal, hreg_ord_verbal, orden_verbal, estado_orden_verbal) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["ordverb"]."','Realizada')";
				$subtitulo="Orden Verbal";
				$subtitulo1="Adicionada";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El formato de $subtitulo fue $subtitulo1 con exito!";
		$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="El formato de $subtitulo en $subtitulo2 NO fue $subtitulo1 !!! .";
		$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'HC':
    $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
    j.nom_eps
    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                left join eps j on (j.id_eps=b.id_eps)
    where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar HC";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$form1='formulariosHOSP/hc_hospdia.php';
			$subtitulo='Historia Clinica Hospital dia';
			break;
			case 'EVO':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Evolución Medica";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$form1='formularios/evo_hospdia.php';
			$subtitulo='Evolución Medica Hospital dia';
			break;
			case 'ADX':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Ayuda Diagnostica";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/ord_med_hd.php';
			$subtitulo='Solicitud de Ordenes Medicas Hospital dia (Procedimientos y laboratorios)';
			break;
			case 'MED':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps,
			k.id_sedes_ips,nom_sedes
      from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
                  inner join eps j on (j.id_eps=b.id_eps)
									inner join sedes_ips k on (k.id_sedes_ips=b.id_sedes_ips)

      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Formula Hospitalaria";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$sede=$fila["id_sedes_ips"];
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/formula_hosp.php';
			$subtitulo='Solicitud de Medicamentos y/o insumos';
			break;

			case 'EPI':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Epicrisis";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/epicrisis.php';
			$subtitulo='Plan Trimestral Terapia Ocupacional';
			break;
			case 'ORDVER':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
									left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Orden Verbal";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/ordenverbal.php';
			$subtitulo='Orden verbal';
			break;

		}
		//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id_sedes_ips"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id_sedes_ips"=>"");
			}

		?>

		<script type="text/javascript" src="/js/jquery.js"></script>

		<div class="alert alert-info animated bounceInRight">

		</div>

		<?php include($form1);?>

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
<section class="panel-body">
	<?php
		include("consulta_rapida1.php");
	?>
</section>
<section class="panel panel-default">
	<section class="panel-heading"><h4>Modulo psiquiatría Hospital Día Salud Mental</h4></section>
	<section class="panel-body">

	<section class="panel panel-default" class="col-xs-7">
		<form class="navbar-form navbar-center" role="search" >
        	<section class="form-group col-xs-3">
          		<input type="text" class="form-control" name="doc" placeholder="Digite Identificacion">
        	</section>
        	<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
        	<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
    </form>
		<form class="navbar-form navbar-center" role="search">
					<section class="form-group col-xs-3">
							<input type="text" class="form-control" name="nom" placeholder="Digite Nombre paciente">
					</section>
					<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
					<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		</form>
	</section>
	<table class="table table-responsive table-bordered">
		<tr>
			<th class="info">PACIENTE</th>
			<th class="info">INGRESO</th>
			<th class="info">Accion</th>

		</tr>

		<?php
		if (isset($_REQUEST["doc"])){
		$doc=$_REQUEST["doc"];
		$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
		a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,s.id_sedes_ips,nom_sedes
		FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
										 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
		WHERE p.doc_pac='".$doc."' and a.estado_adm_hosp='Activo'
															 and tipo_servicio='Hospital dia'";

		if ($tabla=$bd1->sub_tuplas($sql)){
			foreach ($tabla as $fila ) {
				echo"<tr >\n";
				echo'<td class="text-center">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>
							<p><strong>ADMISIÓN: </strong>'.$fila["id_adm_hosp"].'</p>
						 </td>';
				echo'<td class="text-center">
							<p>'.$fila["fingreso_hosp"].'</p>
							<p>'.$fila["tipo_servicio"].'</p>
						 </td>';
				echo'<th class="text-right">';
							$adm=$fila['id_adm_hosp'];
							$sql_hc="SELECT * FROM hc_hospdia WHERE id_adm_hosp=$adm LIMIT 1";
							if ($tabla_hc=$bd1->sub_tuplas($sql_hc)){
								foreach ($tabla_hc as $fila_hc) {
									echo'<p>Ya tiene hc de ingreso en servicio</p>';
								}
							}else {
								echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospital dia&atencion=Ambulatoria"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> HC Ingreso</button></a></p>';
							}

				echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospital dia&atencion=Ambulatoria"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-stethoscope"></span> Evoluciones</button></a></p>
							<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospital dia&atencion=Ambulatoria&doc='.$fila["doc_pac"].'&opc=101"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-flask"></span> Ayuda Dx</button></a></p>
							<p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospital dia&atencion=Ambulatoria&doc='.$fila["doc_pac"].'&opc=101"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-toggle-on"></span> Formulación</button></a></p>
							<p><a href="'.PROGRAMA.'?opcion=37&idadmhosp='.$fila["id_adm_hosp"].'&opc=101&servicio=Hospital dia"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-share"></span> Egreso</button></a></p>
						 </th>';
				echo "</tr>\n";
			}
		}
	}
	if (isset($_REQUEST["nom"])){
		$doc=$_REQUEST["nom"];
		$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
								 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,
								 s.nom_sedes
					FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
													 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips

					WHERE p.nom_completo LIKE '%".$doc."%' and a.estado_adm_hosp='Activo'
																								 and tipo_servicio='Hospital dia'";

		if ($tabla=$bd1->sub_tuplas($sql)){
			//echo $sql;
			foreach ($tabla as $fila ) {
				echo"<tr >\n";
				echo'<td class="text-center">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>
							<p><strong>ADMISIÓN: </strong>'.$fila["id_adm_hosp"].'</p>
						 </td>';
				echo'<td class="text-center">
		 					<p>'.$fila["fingreso_hosp"].'</p>
		 					<p>'.$fila["tipo_servicio"].'</p>
		 				</td>';
						echo'<th class="text-right">';
									$adm=$fila['id_adm_hosp'];
									$sql_hc="SELECT * FROM hc_hospdia WHERE id_adm_hosp=$adm LIMIT 1";
									if ($tabla_hc=$bd1->sub_tuplas($sql_hc)){
										foreach ($tabla_hc as $fila_hc) {
											echo'<p>Ya tiene hc de ingreso en servicio</p>';
										}
									}else {
										echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospital dia&atencion=Ambulatoria"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> HC Ingreso</button></a></p>';
									}

						echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospital dia&atencion=Ambulatoria"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-stethoscope"></span> Evoluciones</button></a></p>
									<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospital dia&atencion=Ambulatoria&doc='.$fila["doc_pac"].'&opc=101"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-flask"></span> Ayuda Dx</button></a></p>
									<p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospital dia&atencion=Ambulatoria&doc='.$fila["doc_pac"].'&opc=101"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-toggle-on"></span> Formulación</button></a></p>
									<p><a href="'.PROGRAMA.'?opcion=37&idadmhosp='.$fila["id_adm_hosp"].'&opc=101&servicio=Hospital dia"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-share"></span> Egreso</button></a></p>
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
