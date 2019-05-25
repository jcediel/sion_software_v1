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
			$adm=$_POST['idadmhosp'];
			$sql_hcingreso="SELECT id_hchosp FROM hc_hospitalario WHERE id_adm_hosp=$adm";
			if ($tabla_hcingreso=$bd1->sub_tuplas($sql_hcingreso)){
				foreach ($tabla_hcingreso as $fila_hcingreso) {
					$tallat=$_POST["talla"] * $_POST["talla"];
					$imc=$_POST["peso"] / $tallat;
					$tam1=$_POST["tad"] * 2;
					$tam2=$tam1 + $_POST["tds"];
					$tamt=$tam2/3;
					$dxp=substr($_POST['dx'], 0,4);
					$dx1=substr($_POST['dx1'], 0,4);
					$dx2=substr($_POST['dx2'], 0,4);
					$dx3=substr($_POST['dx3'], 0,4);

					$sql="INSERT INTO hc_hospitalario (id_user,freg_hchosp,hreg_hchosp,motivo_consulta,enfer_actual,his_personal,his_familiar,
						perso_premorbida,ant_alergicos,ant_patologico,ant_quirurgico,ant_toxicologico,ant_farmaco,ant_gineco,ant_psiquiatrico,ant_hospitalario,
						ant_traumatologico,ant_familiar,otros_ant,estado_general,tad,tas,tam,fr,fc,so,peso,talla,temperatura,imc,cabcuello,torax,ext,abdomen,
						neurologico,genitourinario,examen_mental,analisis,finalidad,causa_externa,dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,
						dx3,ddx3,tdx3,plantratamiento,tipo_atencion,especialidad,estado_hchosp) VALUES
					('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["motivoconsulta"]."',
					'".$_POST["enferactual"]."','".$_POST["hpersonal"]."','".$_POST["hfamiliar"]."','".$_POST["ppremorbida"]."','".$_POST["antalergico"]."',
					'".$_POST["antpatologico"]."','".$_POST["antquirurgico"]."','".$_POST["anttoxicologicos"]."','".$_POST["antfarmacologico"]."',
					'".$_POST["antgineco"]."','".$_POST["antpsiquiatrico"]."','".$_POST["anthospitalario"]."','".$_POST["anttrauma"]."','".$_POST["antfami"]."',
					'".$_POST["antotros"]."','".$_POST["estadogen"]."','".$_POST["tad"]."','".$_POST["tas"]."','$tamt','".$_POST["fr"]."','".$_POST["fc"]."',
					'".$_POST["sao2"]."','".$_POST["peso"]."','".$_POST["talla"]."','".$_POST["temperatura"]."','$imc','".$_POST["cabezacuello"]."',
					'".$_POST["torax"]."','".$_POST["extsup"]."','".$_POST["abdomen"]."','".$_POST["neurologico"]."','".$_POST["genitourinario"]."',
					'".$_POST["exmental"]."','".$_POST["analisis"]."','".$_POST["finconsulta"]."','".$_POST["causaexterna"]."',
					'$dxp','".$_POST["dx"]."','".$_POST["tdx"]."','$dx1','".$_POST["dx1"]."','".$_POST["tdx1"]."','$dx2',
					'".$_POST["dx2"]."','".$_POST["tdx2"]."','$dx3','".$_POST["dx3"]."','".$_POST["tdx3"]."','".$_POST["plant"]."','Hospitalario',
					'".$_SESSION["AUT"]["especialidad"]."','Realizada')";

						$subtitulo="La historia clínica de ingreso Ya existe para esta Admisión";

				}
			}else {
				$tallat=$_POST["talla"] * $_POST["talla"];
				$imc=$_POST["peso"] / $tallat;
				$tam1=$_POST["tad"] * 2;
				$tam2=$tam1 + $_POST["tds"];
				$tamt=$tam2/3;
				$dxp=substr($_POST['dx'], 0,4);
				$dx1=substr($_POST['dx1'], 0,4);
				$dx2=substr($_POST['dx2'], 0,4);
				$dx3=substr($_POST['dx3'], 0,4);

				$sql="INSERT INTO hc_hospitalario (id_adm_hosp,id_user,freg_hchosp,hreg_hchosp,motivo_consulta,enfer_actual,his_personal,his_familiar,
					perso_premorbida,ant_alergicos,ant_patologico,ant_quirurgico,ant_toxicologico,ant_farmaco,ant_gineco,ant_psiquiatrico,ant_hospitalario,
					ant_traumatologico,ant_familiar,otros_ant,estado_general,tad,tas,tam,fr,fc,so,peso,talla,temperatura,imc,cabcuello,torax,ext,abdomen,
					neurologico,genitourinario,examen_mental,analisis,finalidad,causa_externa,dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,
					dx3,ddx3,tdx3,plantratamiento,tipo_atencion,especialidad,estado_hchosp) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["motivoconsulta"]."',
				'".$_POST["enferactual"]."','".$_POST["hpersonal"]."','".$_POST["hfamiliar"]."','".$_POST["ppremorbida"]."','".$_POST["antalergico"]."',
				'".$_POST["antpatologico"]."','".$_POST["antquirurgico"]."','".$_POST["anttoxicologicos"]."','".$_POST["antfarmacologico"]."',
				'".$_POST["antgineco"]."','".$_POST["antpsiquiatrico"]."','".$_POST["anthospitalario"]."','".$_POST["anttrauma"]."','".$_POST["antfami"]."',
				'".$_POST["antotros"]."','".$_POST["estadogen"]."','".$_POST["tad"]."','".$_POST["tas"]."','$tamt','".$_POST["fr"]."','".$_POST["fc"]."',
				'".$_POST["sao2"]."','".$_POST["peso"]."','".$_POST["talla"]."','".$_POST["temperatura"]."','$imc','".$_POST["cabezacuello"]."',
				'".$_POST["torax"]."','".$_POST["extsup"]."','".$_POST["abdomen"]."','".$_POST["neurologico"]."','".$_POST["genitourinario"]."',
				'".$_POST["exmental"]."','".$_POST["analisis"]."','".$_POST["finconsulta"]."','".$_POST["causaexterna"]."',
				'$dxp','".$_POST["dx"]."','".$_POST["tdx"]."','$dx1','".$_POST["dx1"]."','".$_POST["tdx1"]."','$dx2',
				'".$_POST["dx2"]."','".$_POST["tdx2"]."','$dx3','".$_POST["dx3"]."','".$_POST["tdx3"]."','".$_POST["plant"]."','Hospitalario',
				'".$_SESSION["AUT"]["especialidad"]."','Realizada')";
				$e=$_POST['df_conducta'];
				$f=date('Y-m-d');
				$h=date('H:i');
				if ($e=='svoluntario') {
					$sql1="UPDATE adm_hospitalario SET estado_adm_hosp='Parcial',estado_salida='Salida voluntaria',fegreso_hosp='".$f."',hegreso_hosp='".$h."',medsalida='".$_SESSION["AUT"]["id_user"]."'
					 WHERE id_adm_hosp='".$_POST["idadmhosp"]."'";
				}
				if ($e=='Hospitalario') {
					$sql1="UPDATE adm_hospitalario SET estado_adm_hosp='Parcial',estado_salida='Hospitalario',fegreso_hosp='".$f."',hegreso_hosp='".$h."',medsalida='".$_SESSION["AUT"]["id_user"]."'
					 WHERE id_adm_hosp='".$_POST["idadmhosp"]."'";
				}
					$subtitulo="La historia clínica de ingreso";
					$subtitulo2=" Otras opciones" ;
					$subtitulo1="Adicionado";

			}
			break;
			case 'EVO':
			$dxp=substr($_POST['dx'], 0,4);
			$dx1=substr($_POST['dx1'], 0,4);
			$dx2=substr($_POST['dx2'], 0,4);
			$dx3=substr($_POST['dx3'], 0,4);
				$sql="INSERT INTO evolucion_medica (id_adm_hosp,id_user,freg_evomed,hreg_evomed,objetivo,subjetivo,analisis_evomed,plan_tratamiento
					,dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,resp_evomed,estado_evomed,justificacion_hosp,servicio,tipo_evo) VALUES
				('".$_POST["id"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["objetivo"]."',
				'".$_POST["subjetivo"]."','".$_POST["analisis"]."','".$_POST["plantratamiento"]."','$dxp','".$_POST["dx"]."','".$_POST["tdx"]."',
				'$dx1','".$_POST["dx1"]."','".$_POST["tdx1"]."','$dx2','".$_POST["dx2"]."','".$_POST["tdx2"]."',
				'".$_SESSION["AUT"]["nombre"]."','Realizada','".$_POST["justificacion_hosp"]."','".$_POST["servicio"]."','Evolucion')";
				$subtitulo="La evolución Medica";
				$subtitulo1="Adicionado";
			break;
			case 'ORDVER':
				$sql="INSERT INTO orden_verbal( id_adm_hosp, id_user, freg_ord_verbal, hreg_ord_verbal, orden_verbal, estado_orden_verbal) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["ordverb"]."','Realizada')";
				$subtitulo="Orden Verbal";
				$subtitulo1="Adicionada";
			break;
			case 'CLASE':
				$sql="UPDATE adm_hospitalario SET clase_dx_hosp ='".$_POST["clase"]."',
				 						 resp_clase_dx='".$_SESSION["AUT"]["id_user"]."'
				WHERE id_adm_hosp='".$_POST["id_adm_hosp"]."'";
				$subtitulo="Clasificación diagnostica";
				$subtitulo1="Adicionada";
			break;
			case 'MTRATANTE':
				$sql="UPDATE adm_hospitalario SET tratante_hosp ='".$_POST["tratante_hosp"]."',
				resp_trtante='".$_SESSION["AUT"]["id_user"]."'
				WHERE id_adm_hosp='".$_POST["id_adm_hosp"]."'";
				$subtitulo="Medico tratante";
				$subtitulo1="Asignado";
			break;
			case 'OXI':
			$fi=$_POST['finicial'];
			$ff=$_POST['ffinal'];
			$segundos= strtotime($ff) - strtotime($fi);
			$diferencia_dias=intval($segundos/60/60/24);

				$sql="INSERT INTO oxigeno(id_adm_hosp, resp_reg, finicial, ffinal, litro,
					frecuencia, obs_oxigeno, tiempo_adm) VALUES
				('".$_POST["id_adm_hosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["finicial"]."',
				'".$_POST["ffinal"]."','".$_POST["litro"]."','".$_POST["frecuencia"]."','".$_POST["obs_oxigeno"]."',
				'".$diferencia_dias."')";
				$subtitulo="Orden de oxigeno";
				$subtitulo1="Adicionado";
			break;
			case 'REMISION':
			$cups=substr($_POST['cups'], 0,6);
			$sql="INSERT INTO remision(id_adm_hosp, id_user,cups, descricups, justificacion, estado_remision) VALUES
				('".$_POST["id_adm_hosp"]."','".$_SESSION["AUT"]["id_user"]."','".$cups."',
				'".$_POST["cups"]."','".$_POST["justificacion"]."','Realizada')";
				$subtitulo="Formato de referencia";
				$subtitulo1="Adicionado";
			break;
		}
		//echo $sql;
		//echo $sql1;
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo fue $subtitulo1 con exito!";
			$check='si';
				if ($bd1->consulta($sql1)) {
					$subtitulo="$subtitulo. OK!!!";
					$check='si';
				}
		}else{
			$subtitulo="$subtitulo en $subtitulo2 NO fue $subtitulo1 !!! .";
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
			$boton="Agregar HC ingreso";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$form1='formulariosHOSP/MEDICOS/hc_hospitalaria.php';
			$subtitulo='Historia Clinica de ingreso';
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
			$form1='formulariosHOSP/MEDICOS/evo_medhosp.php';
			$subtitulo='Evolución Medica';
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
			case 'CLASE':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,clase_dx_hosp,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
									left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Clasificación DX";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formulariosHOSP/clasedx.php';
			$subtitulo='Clasificación DX hospitalaria';
			break;
			case 'MTRATANTE':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,clase_dx_hosp,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
									left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Asignar Medico tratante";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formulariosHOSP/mtratante.php';
			$subtitulo='MEDICO TRATANTE';
			break;
			case 'OXI':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,clase_dx_hosp,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
									left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Solicitud oxigeno";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$nom=$_REQUEST['nom'];
			if ($nom=='') {

			}else {
				$filtro=$_REQUEST['nom'];
			}
			$doc=$_REQUEST['doc'];
			if ($doc=='') {

			}else {
				$filtro=$_REQUEST['doc'];
			}

			$form1='formulariosHOSP/add_oxigeno.php';
			$subtitulo='Solicitud de oxigeno';
			break;
			case 'REMISION':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,clase_dx_hosp,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
									left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Remision";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$form1='formulariosHOSP/add_remision.php';
			$subtitulo='Solicitud de remisión';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"",
				"dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"",
				"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id_sedes_ips"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"",
				"dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"",
				"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id_sedes_ips"=>"");
			}

		?>

		<script type="text/javascript" src="/js/jquery.js"></script>

		<div class="alert alert-info animated bounceInRight">		</div>

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

<section class="panel panel-default">
<section class="panel-body">
	<?php
		include("consulta_rapida1.php");
	?>
</section>
	<section class="panel-heading"><h4>Medico Especialista en <?php echo $_SESSION['AUT']['especialidad'] ?></h4></section>
	<section class="panel-body">
		<section class="col-md-12">
			<form>
				<div class="row">
				  <div class="col-lg-6">
				    <div class="input-group">
							<input type="text" class="form-control" name="doc" placeholder="Digite identificación">
				      <span class="input-group-btn">
									<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
									<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
				      </span>
				    </div><!-- /input-group -->
				  </div><!-- /.col-lg-6 -->
				</div>
			</form>
			<br>
			<form>
				<div class="row">
				  <div class="col-lg-6">
				    <div class="input-group">
				      <input type="text" class="form-control" name="nom" placeholder="Digite nombre o apellidos">
							<span class="input-group-btn">
									<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
									<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
				      </span>
				    </div><!-- /input-group -->
				  </div><!-- /.col-lg-6 -->
				</div>
			</form>
		</section>
	</section>
	<section class="panel-body">
		<table class="table table-sm table-bordered">
		<tr>
			<th class="text-center success">PACIENTE</th>
			<th class="text-center success"><span class="fa fa-prescription-bottle-alt fa-2x"></span></th>
			<th class="text-center success"><span class="fa fa-flask fa-2x"></span> - <span class="fa fa-pills fa-2x"></span></th>
		</tr>
		<?php
		if (isset($_REQUEST["doc"])){

						$doc=$_REQUEST["doc"];
						$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
												 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,
												 o.freg_ord_verbal,orden_verbal
									FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
																	 LEFT JOIN orden_verbal o on a.id_adm_hosp=o.id_adm_hosp
									WHERE p.doc_pac='".$doc."' and a.estado_adm_hosp='Activo' and tipo_servicio='Hospitalario'";
										//echo $sql;
						if ($tabla=$bd1->sub_tuplas($sql)){
							foreach ($tabla as $fila ) {

								if ($fila['orden_verbal']!='') {
									echo'<section>';
									echo '<script>swal("Atención !!! '.$_SESSION["AUT"]["nombre"].'","'.$fila["orden_verbal"].'","warning")</script>';
									echo'</section>';
								}
							}
						}
					}
			?>

			<?php
			if (isset($_REQUEST["doc"])){
			    $doc=$_REQUEST["doc"];
			    $sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
			                 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,estado_salida,
			                 s.id_sedes_ips,nom_sedes,
			                 h.id_hchosp,
											 max(f.id_ubipaciente) ubi

			          FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
			                           INNER JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
			                           LEFT JOIN hc_hospitalario h on a.id_adm_hosp=h.id_adm_hosp
			                           LEFT JOIN ubipaciente f on (f.id_adm_hosp = a.id_adm_hosp)

			          WHERE p.doc_pac='".$doc."' and a.estado_adm_hosp='Activo' and tipo_servicio='Hospitalario'
								GROUP BY  p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
						                 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,
						                 s.id_sedes_ips,nom_sedes,
						                 h.id_hchosp ";
			      //echo $sql;
			      if ($tabla=$bd1->sub_tuplas($sql)){
			        foreach ($tabla as $fila ) {

									echo"<tr >";
									echo'<td>
												<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
												<p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].' <strong>AMD: </strong> '.$fila["id_adm_hosp"].'</p>
												<p><strong>INGRESO: </strong> '.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].'</p>';
												if ($fila['ubi']=='') {
								          echo'<p><span class="text-danger fa fa-bed fa-2x"> No se ha realizado asignación de habitación</p>';
								        }else {
								          echo'<p><span class="text-success fa fa-bed fa-2x"></span> <span class="text-danger text-right animated jello"><strong>'.$fila['estado_salida'].'</strong></span></p>';
								        }
									echo'<table>
												<tr>
													<td><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ORDVER&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info " ><span class="fa fa-bullhorn"></span> Alertas</button></a></td>
													<td><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CLASE&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-exclamation"></span> Clase DX</button></a></td>
													<td><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=REMISION&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success " ><span class="fa fa-paper-plane"></span> Remisión</button></a></td>
													<td><a href="rpt_remision.php?idadmhosp='.$fila["id_adm_hosp"].'" target="_blank"><button type="button" class="btn btn-inverse " ><span class="fa fa-print"></span> ';
									        $sqlR="SELECT count(id_remision) remi FROM remision where id_adm_hosp='".$fila['id_adm_hosp']."'";
									        if ($tablaR=$bd1->sub_tuplas($sqlR)){
									          foreach ($tablaR as $filaR ) {
									            echo'<span class="badge">'.$filaR['remi'].'</span>';
									          }
									        }
									        echo'</button></a></td>
												</tr>
											 </table>';

									echo'</td>';
									$habi=$fila['ubi'];
									if ($habi=='') {
										$hc=$fila['id_hchosp'];
										if ($hc==''){
											echo'<td  class="text-info text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-plus-circle"></span> HC </button></a></td>';
											echo'<td>
														<p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Hospitalario&doc='.$fila["doc_pac"].'&sede='.$fila['id_sedes_ips'].'&tf=N"><button type="button" class="btn btn-danger " ><span class="fa fa-toggle-on"></span> Formula</button></a></p>
														<p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Hospitalario&doc='.$fila["doc_pac"].'&sede='.$fila['id_sedes_ips'].'&tf=E"><button type="button" class="btn btn-danger " ><span class="fa fa-toggle-on"></span> Carro Paro</button></a></p>

													 </td>';
										}else {
											echo'<td>HC ya fue registrada</td>';
											echo'<td class="text-center text-danger"><span class="fa fa-ban fa-3x"></span></td>';
										}
									}

									if ($habi!='') {
										$hc=$fila['id_hchosp'];
										if ($hc!=''){
											echo'<td>
														<p class="text-info text-center"><span class="fa fa-check"></span> HC registrada</p>
														<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&servicio=Hospitalario"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>
														<p><a href="'.PROGRAMA.'?opcion=37&servicio=Hospitalario&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-warning"><span class="fa fa-share"></span> Egreso</button></a></p>
													 </td>';
											echo'<td>
														<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Hospitalario&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success" ><span class="fa fa-flask"></span> Ayuda Dx</button></a></p>
														<p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Hospitalario&doc='.$fila["doc_pac"].'&sede='.$fila['id_sedes_ips'].'&tf=N"><button type="button" class="btn btn-danger " ><span class="fa fa-toggle-on"></span> Formula</button></a></p>
														<p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Hospitalario&doc='.$fila["doc_pac"].'&sede='.$fila['id_sedes_ips'].'&tf=E"><button type="button" class="btn btn-danger " ><span class="fa fa-toggle-on"></span> Carro Paro</button></a></p>
														<div class="col-md-6">
									            <a href="'.PROGRAMA.'?opcion='.$_REQUEST['opcion'].'&mante=OXI&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario&doc='.$fila["doc_pac"].'&tf=E">
									            <button type="button" class="btn btn-success"  ><span class="fa fa-cloud"></span> Oxigeno</button></a>
									          </div>
														<div class="col-md-6"><button type="button" class="btn btn-inverse" data-toggle="modal" data-target="#mod_oxigeno"><span class="fa fa-search"></span>';
									          $sqlO="SELECT count(id_oxigeno) oxigeno FROM oxigeno where id_adm_hosp='".$fila['id_adm_hosp']."'";
									          if ($tablaO=$bd1->sub_tuplas($sqlO)){
									            foreach ($tablaO as $filaO ) {
									              echo'<span class="badge">'.$filaO['oxigeno'].'</span>';
									            }
									          }
									          echo'</button>
									          <div class="modal fade" id="mod_oxigeno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									            <div class="modal-dialog" role="document">
									              <div class="modal-content">
									                <div class="modal-header">
									                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									                  <h4 class="modal-title" id="myModalLabel">HISTORICO DE REGISTROS DE OXIGENO</h4>
									                </div>
									                <div class="modal-body">
									                <table class"table table-bordered">
									                <tr>
									                  <th class="info text-center">FECHA ADMINISTRACION</th>
									                  <th class="info text-center" colspan="2">RESPONSABLE</th>
									                </tr>';
									                $sqlt="SELECT a.id_adm_hosp,finicial,ffinal,litro,frecuencia,obs_oxigeno,
									                              b.fadmin,
									                              c.nombre,especialidad
									                       FROM oxigeno a left JOIN detalle_oxigeno b on a.id_oxigeno=b.id_oxigeno
									                                      left join user c on c.id_user=b.resp_reg
									                       WHERE a.id_adm_hosp='".$fila['id_adm_hosp']."'";

									                if ($tablat=$bd1->sub_tuplas($sqlt)){
									                  foreach ($tablat as $filat ) {
									                    if (isset($filat['fadmin'])) {
									                      echo'<tr>
									                            <td> '.$filat['fadmin'].'</td>
									                            <td> '.$filat['nombre'].' '.$filat['especialidad'].'</td>
									                          </tr>';
									                    }else {
									                      echo'<tr>
									                            <td colspan="2" class="text-danger">TIENE ORDEN DE OXIGENO, PERO NO HAY REGISTRO DE DETALLES</td>
									                          </tr>';
									                    }

									                  }
									                }
									              echo'</table>
									                </div>
									                <div class="modal-footer">
									                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
									                </div>
									              </div>
									            </div>
									          </div>
									          </div>
													 </td>';
										}else {
											echo'<td><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-plus-circle"></span> HC </button></a></td>';
											echo'<td><span class="fa fa-ban "></span></td>';
											echo'<td><span class="fa fa-ban "></span></td>';
										}
									}
									echo"</tr>";

			        }
						}
					}//fin de la validacion del filtro de documento que viene de GET

					if (isset($_REQUEST["nom"])){
							$doc=$_REQUEST["nom"];
							$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
													 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,estado_salida,
													 s.id_sedes_ips,nom_sedes,
													 h.id_hchosp,
													 max(f.id_ubipaciente) ubi

										FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
																		 INNER JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
																		 LEFT JOIN hc_hospitalario h on a.id_adm_hosp=h.id_adm_hosp
																		 LEFT JOIN ubipaciente f on (f.id_adm_hosp = a.id_adm_hosp)

										WHERE p.nom_completo like '%".$doc."%' and a.estado_adm_hosp='Activo' and tipo_servicio='Hospitalario'
										GROUP BY  p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
																 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,
																 s.id_sedes_ips,nom_sedes,
																 h.id_hchosp ";
								//echo $sql;
								if ($tabla=$bd1->sub_tuplas($sql)){
									foreach ($tabla as $fila ) {

											echo"<tr >";
											echo'<td>
														<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
														<p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].' <strong>AMD: </strong> '.$fila["id_adm_hosp"].'</p>
														<p><strong>INGRESO: </strong> '.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].'</p>';
														if ($fila['ubi']=='') {
															echo'<p><span class="text-danger fa fa-bed fa-2x"> No se ha realizado asignación de habitación</p>';
														}else {
															echo'<p><span class="text-success fa fa-bed fa-2x"></span> <span class="text-danger text-right animated jello"><strong>'.$fila['estado_salida'].'</strong></span></p>';
														}
											echo'<table>
														<tr>
															<td><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ORDVER&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info " ><span class="fa fa-bullhorn"></span> Alertas</button></a></td>
															<td><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CLASE&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-exclamation"></span> Clase DX</button></a></td>
															<td><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=REMISION&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success " ><span class="fa fa-paper-plane"></span> Remisión</button></a></td>
															<td><a href="rpt_remision.php?idadmhosp='.$fila["id_adm_hosp"].'" target="_blank"><button type="button" class="btn btn-inverse " ><span class="fa fa-print"></span> ';
															$sqlR="SELECT count(id_remision) remi FROM remision where id_adm_hosp='".$fila['id_adm_hosp']."'";
															if ($tablaR=$bd1->sub_tuplas($sqlR)){
																foreach ($tablaR as $filaR ) {
																	echo'<span class="badge">'.$filaR['remi'].'</span>';
																}
															}
															echo'</button></a></td>
														</tr>
													 </table>';

											echo'</td>';
											$habi=$fila['ubi'];
											if ($habi=='') {
												$hc=$fila['id_hchosp'];
												if ($hc==''){
													echo'<td  class="text-info text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-plus-circle"></span> HC </button></a></td>';
													echo'<td>
																<p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Hospitalario&doc='.$fila["doc_pac"].'&sede='.$fila['id_sedes_ips'].'&tf=N"><button type="button" class="btn btn-danger " ><span class="fa fa-toggle-on"></span> Formula</button></a></p>
																<p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Hospitalario&doc='.$fila["doc_pac"].'&sede='.$fila['id_sedes_ips'].'&tf=E"><button type="button" class="btn btn-danger " ><span class="fa fa-toggle-on"></span> Carro Paro</button></a></p>
															 </td>';
												}else {
													echo'<td><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-plus-circle"></span> HC </button></a></td>';
													echo'<td class="text-center text-danger"><span class="fa fa-ban fa-3x"></span></td>';
												}
											}

											if ($habi!='') {
												$hc=$fila['id_hchosp'];
												if ($hc!=''){
													echo'<td>
																<p class="text-info text-center"><span class="fa fa-check"></span> HC registrada</p>
																<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario"><button type="button" class="btn btn-primary " ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>
																<p><a href="'.PROGRAMA.'?opcion=37&servicio=Hospitalario&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-warning"><span class="fa fa-share"></span> Egreso</button></a></p>
															 </td>';
													echo'<td>
																<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Hospitalario&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success " ><span class="fa fa-flask"></span> Ayuda Dx</button></a></p>
																<p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Hospitalario&doc='.$fila["doc_pac"].'&sede='.$fila['id_sedes_ips'].'&tf=N"><button type="button" class="btn btn-danger " ><span class="fa fa-pills"></span> Formula</button></a></p>
																<p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario&atencion=Hospitalario&doc='.$fila["doc_pac"].'&sede='.$fila['id_sedes_ips'].'&tf=E"><button type="button" class="btn btn-danger " ><span class="fa fa-pills"></span> Carro Paro</button></a></p>
																<div class="col-md-6">
																	<a href="'.PROGRAMA.'?opcion='.$_REQUEST['opcion'].'&mante=OXI&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario&doc='.$fila["doc_pac"].'&tf=E">
																	<button type="button" class="btn btn-success"  ><span class="fa fa-cloud"></span> Oxigeno</button></a>
																</div>
																<div class="col-md-6"><button type="button" class="btn btn-inverse" data-toggle="modal" data-target="#mod_oxigeno"><span class="fa fa-search"></span>';
																$sqlO="SELECT count(id_oxigeno) oxigeno FROM oxigeno where id_adm_hosp='".$fila['id_adm_hosp']."'";
																if ($tablaO=$bd1->sub_tuplas($sqlO)){
																	foreach ($tablaO as $filaO ) {
																		echo'<span class="badge">'.$filaO['oxigeno'].'</span>';
																	}
																}
																echo'</button>
																<div class="modal fade" id="mod_oxigeno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																				<h4 class="modal-title" id="myModalLabel">HISTORICO DE REGISTROS DE OXIGENO</h4>
																			</div>
																			<div class="modal-body">
																			<table class"table table-bordered">
																			<tr>
																				<th class="info text-center">FECHA ADMINISTRACION</th>
																				<th class="info text-center" colspan="2">RESPONSABLE</th>
																			</tr>';
																			$sqlt="SELECT a.id_adm_hosp,finicial,ffinal,litro,frecuencia,obs_oxigeno,
																										b.fadmin,
																										c.nombre,especialidad
																						 FROM oxigeno a left JOIN detalle_oxigeno b on a.id_oxigeno=b.id_oxigeno
																														left join user c on c.id_user=b.resp_reg
																						 WHERE a.id_adm_hosp='".$fila['id_adm_hosp']."'";

																			if ($tablat=$bd1->sub_tuplas($sqlt)){
																				foreach ($tablat as $filat ) {
																					if (isset($filat['fadmin'])) {
																						echo'<tr>
																									<td> '.$filat['fadmin'].'</td>
																									<td> '.$filat['nombre'].' '.$filat['especialidad'].'</td>
																								</tr>';
																					}else {
																						echo'<tr>
																									<td colspan="2" class="text-danger">TIENE ORDEN DE OXIGENO, PERO NO HAY REGISTRO DE DETALLES</td>
																								</tr>';
																					}

																				}
																			}
																		echo'</table>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																			</div>
																		</div>
																	</div>
																</div>
																</div>
															 </td>';
												}else {
													echo'<td><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-plus-circle"></span> HC </button></a></td>';
													echo'<td><span class="fa fa-ban "></span></td>';
													echo'<td><span class="fa fa-ban "></span></td>';
												}
											}
											echo"</tr>";

									}
								}
							}//fin de la validacion del filtro de nombre que viene de GET
			?>
		<table>
	</section>
</section>
		<?php
	}
	?>
