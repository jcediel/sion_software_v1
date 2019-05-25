<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

			switch ($_POST["operacion"]) {
			case 'TRASLADO':
					$fecha=$_POST["finicial"];
					$segundos= strtotime('now') - strtotime($fecha);
					$diferencia_dias=intval($segundos/60/60/24);
					$dias=floor($diferencia_dias);

					$sql="UPDATE cama SET estado_cama='Libre' WHERE id_cama='".$_POST["id_cama"]."' ";
					$sql1="UPDATE ubipaciente SET ffinal='".$_POST["ffinal"]."',total_destancia='".$dias."' WHERE id_ubipaciente='".$_POST["id_ubipaciente"]."' ";
					$subtitulo1="La habitación se encuentra <strong>LIBRE</strong>. Puede proceder con la nueva asignación del paciente.";
			break;
			case 'SIG':
			$tam1=$_POST["tad"] * 2;
			$tam2=$tam1 + $_POST["tas"];
			$tamt=$tam2/3;
			$sql="INSERT INTO signos_vitales (id_adm_hosp,id_user,freg_sv,hreg_sv,tas_s,tad_s,tm_s,fc_s,fr_s,temp_s,spo_s,resp_sv) VALUES
			('".$_POST["idadm"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["tas"]."','".$_POST["tad"]."',
			'$tamt','".$_POST["fc"]."','".$_POST["fr"]."','".$_POST["temp"]."','".$_POST["sat"]."','".$_SESSION["AUT"]["nombre"]."')";
			$subtitulo="Adicionado";

			break;
			case 'X':
				$sql="SELECT logo from cliente where id=".$_POST["idcli"];

				$sql="DELETE FROM cliente WHERE id_cliente=".$_POST["idcli"];
				$subtitulo="Eliminado";
			break;
			case 'A':
				$sql="INSERT INTO nota_enfermeria (id_adm_hosp,id_user,freg_nota,hreg_nota,descripnota,estado_nota,resp_nota) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["notaenfermeria"]."','Realizada',
				'".$_SESSION["AUT"]["nombre"]."')";
				$subtitulo="Adicionado";
			break;
			case 'OXI':
				$sql="INSERT INTO detalle_oxigeno (id_oxigeno,resp_reg, fadmin, estado_admin) VALUES
				('".$_POST["id_oxigeno"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["fadmin"]."',
				'Realizada')";
				$subtitulo="Adicionado";
			break;
			case 'DOWNTON':
			$total=($_POST['med1_c']) + ($_POST['med2_c']) + ($_POST['med3_c']) + ($_POST['med4_c']) + ($_POST['med5_c']) + ($_POST['med6_c'])+ ($_POST['med7_c'])+ ($_POST['calificacion1'])
							 + ($_POST['ds1_c'])+ ($_POST['ds2_c'])+ ($_POST['ds3_c'])+ ($_POST['ds4_c'])+ ($_POST['deambulacion']);
			if ($total < 3) {
				$r_total='BAJO RIESGO';
				$sql="INSERT INTO escala_downton ( id_adm_hosp, id_user, freg, hreg, calificacion1, med1,
																					med1_c, med2, med2_c, med3, med3_c, med4, med4_c, med5, med5_c, med6, med6_c, med7, med7_c,
																					ds1, ds1_c, ds2, ds2_c, ds3, ds3_c, ds4, ds4_c,em1_c, deambulacion, total,
																					criterio_total,sugerencia)
							 VALUES ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["calificacion1"]."','".$_POST["med1"]."',
											 '".$_POST["med1_c"]."','".$_POST["med2"]."','".$_POST["med2_c"]."','".$_POST["med3"]."','".$_POST["med3_c"]."','".$_POST["med4"]."','".$_POST["med4_c"]."',
											 '".$_POST["med5"]."','".$_POST["med5_c"]."','".$_POST["med6"]."','".$_POST["med6_c"]."','".$_POST["med7"]."','".$_POST["med7_c"]."',
											 '".$_POST["ds1"]."','".$_POST["ds1_c"]."','".$_POST["ds2"]."','".$_POST["ds2_c"]."','".$_POST["ds3"]."','".$_POST["ds3_c"]."','".$_POST["ds4"]."','".$_POST["ds4_c"]."',
											 '".$_POST["em1_c"]."','".$_POST["deambulacion"]."','".$total."','".$r_total."','".$_POST["sugerencia"]."')";
				$subtitulo="Escala Downton registrada con exito, reportando BAJO RIESGO.";

			}
			if ($total >= 3) {
				$r_total='ALTO RIESGO';
				$sql="INSERT INTO escala_downton (id_adm_hosp, id_user, freg, hreg, calificacion1, med1,
																					med1_c, med2, med2_c, med3, med3_c, med4, med4_c, med5, med5_c, med6, med6_c, med7, med7_c,
																					ds1, ds1_c, ds2, ds2_c, ds3, ds3_c, ds4, ds4_c,  em1_c, deambulacion, total,
																					criterio_total,sugerencia)

							 VALUES ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["calificacion1"]."','".$_POST["med1"]."',
											 '".$_POST["med1_c"]."','".$_POST["med2"]."','".$_POST["med2_c"]."','".$_POST["med3"]."','".$_POST["med3_c"]."','".$_POST["med4"]."','".$_POST["med4_c"]."',
											 '".$_POST["med5"]."','".$_POST["med5_c"]."','".$_POST["med6"]."','".$_POST["med6_c"]."','".$_POST["med7"]."','".$_POST["med7_c"]."',
											 '".$_POST["ds1"]."','".$_POST["ds1_c"]."','".$_POST["ds2"]."','".$_POST["ds2_c"]."','".$_POST["ds3"]."','".$_POST["ds3_c"]."','".$_POST["ds4"]."','".$_POST["ds4_c"]."',
											 '".$_POST["em1_c"]."','".$_POST["deambulacion"]."','".$total."','".$r_total."','".$_POST["sugerencia"]."')";

				$subtitulo="Escala Downton registrada con exito, reportando ALTO RIESGO.";
			}
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El registro de enfermería fue <strong>$subtitulo</strong> con exito.";
			$check='si';
			if ($bd1->consulta($sql1)) {
				$subtitulo="$subtitulo. $subtitulo1";
				$check='si';
			}
		}else{
			$subtitulo="El registro de enfermeria <strong>NO fue $subtitulo !!!</strong> .";
			$check='no';
		}

	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'DOWNTON':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
									left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
				$boton="Guardar Escala";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$date=date('Y-m-d');
				$date1=date('H:i');
				$doc=$_REQUEST['doc'];
				$opcion=$_REQUEST['opcion'];
				$form1='formularios/escalas/downton.php';
				$titulo='Registro de escala downton';
		break;
		case 'E':
			$sql="SELECT ".$_GET["idveh"];
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
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$color="yellow";
			$boton="Agregar Nota";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['doc'];
			$return1=22;
			$form1='formulariosHOSP/nota_enfermeria.php';
			$subtitulo='Registro de enfermeria';
			break;
			case 'TRASLADO':
      $sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
									 b.id_adm_hosp,fingreso_hosp,
									 c.id_ubipaciente,c.id_cama idc,finicial,
									 d.nom_cama,
									 e.nom_hab,
									 f.nom_pabellon,
									 g.nom_piso
					FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
													 INNER JOIN ubipaciente c on b.id_adm_hosp=c.id_adm_hosp
													 INNER JOIN cama d on d.id_cama=c.id_cama
													 INNER JOIN habitacion e on e.id_habitacion=d.id_habitacion
													 INNER JOIN pabellon f on f.id_pabellon=e.id_pabellon
													 INNER JOIN piso g on g.id_piso=f.id_piso
					WHERE c.id_ubipaciente='".$_GET["idubi"]."' ";
			$color="yellow";
			$boton="Finalizar Ubicación";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['idadmhosp'];
			$return1=$_REQUEST['sede'];
			$return2=$_REQUEST['doc'];
			$form1='formulariosHOSP/traslado_bed.php';
			$subtitulo='';
			break;
			case 'SIG':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$color="yellow";
			$boton="Agregar Signos vitales";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['idadmhosp'];
			$return1=$_REQUEST['sede'];
			$return2=$_REQUEST['doc'];
			$option=22;
			$form1='formulariosHOSP/signos_vitales.php';
			$subtitulo='';
			break;
			case 'OXI':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,
										 rh,email_pac,genero,lateralidad,religion,fotopac,
									 b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,clase_dx_hosp,
			 					 	 j.nom_eps,
									 c.id_oxigeno, freg, resp_reg, finicial, ffinal, litro, frecuencia, obs_oxigeno, tiempo_adm, total_oxi
						FROM pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
														 left join eps j on (j.id_eps=b.id_eps)
														 left join oxigeno c on (c.id_adm_hosp=b.id_adm_hosp)
						WHERE b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
						//echo $sql;
			$boton="Administrar oxigeno";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$nom=$_REQUEST['nom'];
			if ($nom=='') {
				$filtro=$_REQUEST['nom'];
			}
			$doc=$_REQUEST['doc'];
			if ($doc=='') {
				$filtro=$_REQUEST['doc'];
			}
			$form1='formulariosHOSP/adm_oxigeno.php';
			$subtitulo='Administracion de oxigeno';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"",
				"genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"",
				"id_ubipaciente"=>"","idc"=>"","fnicial"=>"","nom_cama"=>"","nom_hab"=>"","nom_pabellon"=>"","nom_piso"=>"","id_oxigeno"=>"",
			"freg"=>"", "resp_reg"=>"", "finicial"=>"", "ffinal"=>"", "litro"=>"", "frecuencia"=>"", "obs_oxigeno"=>"", "tiempo_adm"=>"", "total_oxi"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"",
				"genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"",
				"id_ubipaciente"=>"","idc"=>"","fnicial"=>"","nom_cama"=>"","nom_hab"=>"","nom_pabellon"=>"","nom_piso"=>"","id_oxigeno"=>"",
			"freg"=>"", "resp_reg"=>"", "finicial"=>"", "ffinal"=>"", "litro"=>"", "frecuencia"=>"", "obs_oxigeno"=>"", "tiempo_adm"=>"", "total_oxi"=>"");
			}

		?>
<script src = "js/sha3.js"></script>
		<script>

		function validar(){
			if (document.forms[0].hreg.value > document.forms[0].fecha.value){
				alert("Jefe (a) <?php echo $_SESSION["AUT"]["nombre"]?>, NO puede adelantar el tiempo.");
				document.forms[0].hreg.focus();				// Ubicar el cursor
				return(false);
			}
		}
		</script>
		<script type="text/javascript" src="/js/jquery.js"></script>
		<?php include ($form1);?>
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
		<h4>Jefes de enfermería en servicio Hospitalario</h4>
	</section>
<section class="panel-body">
	<section class="panel-body">
		<?php
			include("consulta_rapida1.php");
		?>
	</section>
	<section class="panel-body">
		<section class="col-md-6">
			<form>
				<div class="row">
				  <div class="col-lg-12">
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
				  <div class="col-lg-12">
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
		<section class="col-md-3 text-center">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hd_list"><span class="fa fa-list fa-2x"></span> Pacientes <br> Hospital día</button>

			<div id="hd_list" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">

					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Pacientes ACTIVOS en Hospital día</h4>
						</div>
						<div class="modal-body">
							<table class="table table-bordered" id="Exportar_a_Excel">
								<tr>
									<td class="text-center"><strong>Identificacion</strong></td>
									<td class="text-center"><strong>Nombre completo</strong></td>
									<td class="text-center"><strong>EPS</strong></td>
									<td class="text-center"><strong>SEDE</strong></td>
								</tr>
								<?php

								$sqlhd="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
								b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
								c.descripestadoc,
								d.descriafiliado,
								e.descritusuario,
								f.descriocu,
								i.descripuedad,
								j.nom_eps,
								k.ddxp,
								l.id_sedes_ips,nom_sedes
								from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
											left join estado_civil c on (c.codestadoc = a.estadocivil)
											inner join tusuario e on (e.codtusuario=b.tipo_usuario)
											inner join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
											inner join ocupacion f on (f.codocu=b.ocupacion)
											inner join uedad i on (i.coduedad=a.uedad)
											left join eps j on (j.id_eps=b.id_eps)
											left join sedes_ips l on (l.id_sedes_ips=b.id_sedes_ips)
											left join hc_hospdia k on (k.id_adm_hosp=b.id_adm_hosp)


								where b.id_sedes_ips in ('2','8') and b.estado_adm_hosp='Activo' and tipo_servicio='Hospital dia' order by a.edad ASC";
									//echo $sql;
								if ($tablahd=$bd1->sub_tuplas($sqlhd)){

									//echo $sql;
									foreach ($tablahd as $filahd ) {
										if ($filahd['id_sedes_ips']==2) {
											echo"<tr >\n";
											echo'<td class="text-center ">
														<p class="btn-xs"><a href="'.PROGRAMA.'?doc='.$filahd["doc_pac"].'&buscar=Consultar&opcion='.$_REQUEST["opcion"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-search"></span> </button></a></p>
													 </td>';
											echo'<td class="text-left ">
														<p>'.$filahd["nom1"].' '.$filahd["nom2"].' '.$filahd["ape1"].' '.$filahd["ape2"].'</p>
														<p><strong><span class="fa fa-user-md"></span> '.$filahd["tdoc_pac"].' : '.$filahd["doc_pac"].' </strong></p>
													 </td>';
											echo'<td class="text-left "> '.$filahd["nom_eps"].'</td>';
											echo'<td class="text-left "> '.$filahd["nom_sedes"].'</td>';
											echo '</tr>';
										}
										if ($filahd['id_sedes_ips']==8) {
											echo"<tr >\n";
											echo'<td class="text-center">
														<p class="btn-xs"><a href="'.PROGRAMA.'?doc='.$filahd["doc_pac"].'&buscar=Consultar&opcion='.$_REQUEST["opcion"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-search"></span> </button></a></p>
													 </td>';
											echo'<td class="text-left">
														<p>'.$filahd["nom1"].' '.$filahd["nom2"].' '.$filahd["ape1"].' '.$filahd["ape2"].'</p>
														<p><strong><span class="fa fa-user-md"></span> '.$filahd["tdoc_pac"].' : '.$filahd["doc_pac"].' </strong></p>
													 </td>';
											echo'<td class="text-left"> '.$filahd["nom_eps"].'</td>';
											echo'<td class="text-left"> '.$filahd["nom_sedes"].'</td>';
											echo '</tr>';
										}

									}
								}
								?>
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						</div>
					</div>

				</div>
			</div>
		</section>
		<section class="col-md-3 text-center">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ce_list"><span class="fa fa-list fa-2x"></span> Pacientes <br> Consulta externa</button>

			<div id="ce_list" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">

					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Pacientes ACTIVOS en Consulta externa</h4>
						</div>
						<div class="modal-body">
							<table class="table table-bordered" id="Exportar_a_Excel">
								<tr>
									<td class="text-center"><strong>Identificacion</strong></td>
									<td class="text-center"><strong>Nombre completo</strong></td>
									<td class="text-center"><strong>EPS</strong></td>
									<td class="text-center"><strong>SEDE</strong></td>
								</tr>
								<?php
								$f=date('Y-m-d');
								$sqlhd="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
								b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
								c.descripestadoc,
								d.descriafiliado,
								e.descritusuario,
								f.descriocu,
								i.descripuedad,
								j.nom_eps,
								k.ddxp,
								l.id_sedes_ips,nom_sedes
								from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
											left join estado_civil c on (c.codestadoc = a.estadocivil)
											inner join tusuario e on (e.codtusuario=b.tipo_usuario)
											inner join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
											inner join ocupacion f on (f.codocu=b.ocupacion)
											inner join uedad i on (i.coduedad=a.uedad)
											left join eps j on (j.id_eps=b.id_eps)
											left join sedes_ips l on (l.id_sedes_ips=b.id_sedes_ips)
											left join hc_hospdia k on (k.id_adm_hosp=b.id_adm_hosp)


								where b.id_sedes_ips in ('2','5','8') and b.estado_adm_hosp='Activo'
																									and tipo_servicio='Consulta Externa SM'
																									and fingreso_hosp='$f'
								order by b.hingreso_hosp ASC";
									//echo $sql;
								if ($tablahd=$bd1->sub_tuplas($sqlhd)){

									//echo $sql;
									foreach ($tablahd as $filahd ) {
										if ($filahd['id_sedes_ips']==2) {
											echo"<tr >\n";
											echo'<td class="text-center ">
														<p class="btn-xs"><a href="'.PROGRAMA.'?doc='.$filahd["doc_pac"].'&buscar=Consultar&opcion='.$_REQUEST["opcion"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-search"></span> </button></a></p>
													 </td>';
											echo'<td class="text-left ">
														<p>'.$filahd["nom1"].' '.$filahd["nom2"].' '.$filahd["ape1"].' '.$filahd["ape2"].'</p>
														<p><strong><span class="fa fa-user-md"></span> '.$filahd["tdoc_pac"].' : '.$filahd["doc_pac"].' </strong></p>
													 </td>';
											echo'<td class="text-left "> '.$filahd["nom_eps"].'</td>';
											echo'<td class="text-left "> '.$filahd["nom_sedes"].'</td>';
											echo '</tr>';
										}
										if ($filahd['id_sedes_ips']==5) {
											echo"<tr >\n";
											echo'<td class="text-center">
														<p class="btn-xs"><a href="'.PROGRAMA.'?doc='.$filahd["doc_pac"].'&buscar=Consultar&opcion='.$_REQUEST["opcion"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-search"></span> </button></a></p>
													 </td>';
											echo'<td class="text-left">
														<p>'.$filahd["nom1"].' '.$filahd["nom2"].' '.$filahd["ape1"].' '.$filahd["ape2"].'</p>
														<p><strong><span class="fa fa-user-md"></span> '.$filahd["tdoc_pac"].' : '.$filahd["doc_pac"].' </strong></p>
													 </td>';
											echo'<td class="text-left"> '.$filahd["nom_eps"].'</td>';
											echo'<td class="text-left"> '.$filahd["nom_sedes"].'</td>';
											echo '</tr>';
										}
										if ($filahd['id_sedes_ips']==8) {
											echo"<tr >\n";
											echo'<td class="text-center">
														<p class="btn-xs"><a href="'.PROGRAMA.'?doc='.$filahd["doc_pac"].'&buscar=Consultar&opcion='.$_REQUEST["opcion"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-search"></span> </button></a></p>
													 </td>';
											echo'<td class="text-left">
														<p>'.$filahd["nom1"].' '.$filahd["nom2"].' '.$filahd["ape1"].' '.$filahd["ape2"].'</p>
														<p><strong><span class="fa fa-user-md"></span> '.$filahd["tdoc_pac"].' : '.$filahd["doc_pac"].' </strong></p>
													 </td>';
											echo'<td class="text-left"> '.$filahd["nom_eps"].'</td>';
											echo'<td class="text-left"> '.$filahd["nom_sedes"].'</td>';
											echo '</tr>';
										}
									}
								}
								?>
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						</div>
					</div>

				</div>
			</div>
		</section>
	</section>
	</section>
	<section class="col-md-12">
		<table class="table table-bordered">
			<tr>
				<th class="info text-center"></th>
				<th class="info text-center">PACIENTE</th>
				<th class="info text-center">UBICACION</th>
				<th class="info text-center"></th>
			</tr>

			<?php
			if (isset($_REQUEST["doc"])){
			$doc=$_REQUEST["doc"];
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,
									 s.id_sedes_ips ids,nom_sedes,
									 h.id_hchosp,
									 max(f.id_ubipaciente) ubi

						FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
														 INNER JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
														 LEFT JOIN hc_hospitalario h on a.id_adm_hosp=h.id_adm_hosp
														 LEFT JOIN ubipaciente f on (f.id_adm_hosp = a.id_adm_hosp)

						WHERE p.doc_pac = '".$doc."' and a.estado_adm_hosp='Activo'
						GROUP BY  p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
												 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,
												 s.id_sedes_ips,nom_sedes,
												 h.id_hchosp";
												 //echo $sql;
			if ($tabla=$bd1->sub_tuplas($sql)){
				foreach ($tabla as $fila ) {
					$servicio=$fila['tipo_servicio'];
					if ($servicio=='Hospitalario') {
						$ubi=$fila['ubi'];
						if ($ubi=='') {
							echo"<tr >\n";
							echo'<th class="text-center">';
							echo'<section class="row">';
									 $id=$fila['id_adm_hosp'];
									 $sql_downton="SELECT count(id_esc_downton) cuantos	 FROM escala_downton WHERE id_adm_hosp=$id";
									 if ($tabla_downton=$bd1->sub_tuplas($sql_downton)){
										 foreach ($tabla_downton as $fila_downton ) {
											 $id_c=$fila_downton['cuantos'];
											 if ($id_c >= 0) {
												 echo'<article class="col-md-6">';
												 echo'<button type="button" class="btn btn-info " data-toggle="modal" data-target="#historia_downton_'.$fila["id_adm_hosp"].'">Historico Downton</button>';
												 echo'</article>';
												 echo'<article class="col-md-6">';
												 echo'<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOWNTON&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-square"></span> </button></a>';
												 echo'</article>';
												 echo'
												 <div id="historia_downton_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
													 <div class="modal-dialog">

														 <!-- Modal content-->
														 <div class="modal-content">
															 <div class="modal-header">
																 <button type="button" class="close" data-dismiss="modal">&times;</button>
																 <h4 class="modal-title">Historico de registros Escala Downton</h4>
															 </div>
															 <div class="modal-body">';
																 $sql_h_downton="SELECT a.id_esc_downton,freg,total,criterio_total,sugerencia,b.nombre
																								 FROM escala_downton a inner join user b on a.id_user=b.id_user
																								 WHERE id_adm_hosp=$id and a.estado is null
																								 ORDER BY freg DESC";
																 if ($tabla_h_downton=$bd1->sub_tuplas($sql_h_downton)){
																	 foreach ($tabla_h_downton as $fila_h_downton ) {
																		 echo'<section class="panel-body">';
																		 $riesgo=$fila_h_downton['criterio_total'];
																		 if ($riesgo=='BAJO RIESGO') {
																				 echo'<article class="col-md-12 alert alert-success">';
																				 echo'<p><strong>Fecha Registro: </strong>'.$fila_h_downton['freg'].'</p>';
																				 echo'<p><strong>Clasificación: </strong>'.$fila_h_downton['criterio_total'].'</p>';
																				 echo'<p><strong>Total: </strong>'.$fila_h_downton['total'].'</p>';
																				 echo'<p><strong>Responsable: </strong>'.$fila_h_downton['nombre'].'</p>';
																				 echo'<p>'.$fila_h_downton['sugerencia'].'</p>';
																				 echo'</article>';
																				 echo '<article class="col-md-4">';
																				 echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_downton['id_esc_downton'].'&tabla=downton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
																				 echo'</article>';
																		 }
																		 if ($riesgo=='ALTO RIESGO') {
																				 echo'<article class="col-md-12 alert alert-danger">';
																				 echo'<p><strong>Fecha Registro: </strong>'.$fila_h_downton['freg'].'</p>';
																				 echo'<p><strong>Clasificación: </strong>'.$fila_h_downton['criterio_total'].'</p>';
																				 echo'<p><strong>Total: </strong>'.$fila_h_downton['total'].'</p>';
																				 echo'<p><strong>Responsable: </strong>'.$fila_h_downton['nombre'].'</p>';
																				 echo'<p>'.$fila_h_downton['sugerencia'].'</p>';
																				 echo'</article>';
																				 echo '<article class="col-md-4">';
																				 echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_downton['id_esc_downton'].'&tabla=downton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
																				 echo'</article>';
																		 }
																		 echo'</section>';
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
										 }
									 }
									 echo'</section>';

							echo'<section class="row">
										<p>
										<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=INSUMOS&idadmhosp='.$fila["id_adm_hosp"].'">
										<button type="button" class="btn btn-inverse" ><span class="fa fa-hand-paper-o"></span> Solicitud<br>insumos</button></a>
										</p>
									 </section>';
							echo'<td class="text-left">
												 <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
												 <p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].' </p>
												 <p><strong>ADM:</strong>'.$fila["id_adm_hosp"].'</p>
												 <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].'</p>
												 <p><img src="'.$fila["fotopac"].'"alt ="foto" class="img-rounded" width="80" data-toggle="modal" data-target="#modalpac"></p>
												 ';
									 echo'</td>';
									 $sql_ubipaciente="SELECT id_ubipaciente, id_adm_hosp, id_cama, resp_reg, freg, finicial, ffinal, total_destancia, nota_traslado
																		FROM ubipaciente
																		WHERE id_ubipaciente=$ubi";
																		//echo $sql_ubipaciente;
									if ($tabla_ubipaciente=$bd1->sub_tuplas($sql_ubipaciente)){
										foreach ($tabla_ubipaciente as $fila_ubipaciente) {
											if ($fila_ubipaciente['ffinal'] == '') {
												echo'<td class="text-center">
															<p class="lead"><strong><u>Ubicación actual:</u></strong><br> ';
																$cama=$fila_ubipaciente['id_cama'];
																$sql_cama="SELECT c.id_sedes_ips,
																						 d.id_cama idc,nom_cama,estado_cama,
																						 e.nom_hab,
																						 f.nom_pabellon,
																						 g.nom_piso
																		FROM sedes_ips c 	INNER JOIN piso g on g.id_sedes_ips=c.id_sedes_ips
																											INNER JOIN pabellon f on f.id_piso=g.id_piso
																											INNER JOIN habitacion e on e.id_pabellon=f.id_pabellon
																											INNER JOIN cama d on d.id_habitacion=e.id_habitacion
																		WHERE  d.id_cama=$cama";
																		if ($tabla_cama=$bd1->sub_tuplas($sql_cama)){
																			foreach ($tabla_cama as $fila_cama) {
																				echo  '<strong>Piso:</strong> '.$fila_cama["nom_piso"].' <strong>Pabellíon:</strong> '. $fila_cama["nom_pabellon"].' <strong>Habitación:</strong> '.$fila_cama["nom_hab"].' -- '.$fila_cama["nom_cama"];
																			}
																		}

												 echo'</p>
															<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TRASLADO&idc='.$fila_cama["idc"].'&idubi='.$fila_ubipaciente["id_ubipaciente"].'&sede='.$fila['ids'].'&doc='.$doc.'&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-refresh"></span> Trasladar a otra cama</button></a></p>
														 </td>';
											}
											if ($fila_ubipaciente['ffinal']!='') {
												echo'<th class="text-center alert alert-danger">
															<p><strong><u>NO TIENE UBICACION</u></p>
															<p><a href="'.PROGRAMA.'?opcion=161&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-bed"></span> Ubicación<br>Inicial</button></a></p>
														 </th>';
											}
										}
									}else {
										echo'<th class="text-center alert alert-danger">
													<p><strong><u>NO TIENE UBICACION</u><br>
													El paciente debe ser un NUEVO ingreso, debido a no presenta historico de ubicación</p>
													<p><a href="'.PROGRAMA.'?opcion=161&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-bed"></span> Ubicación<br>Inicial</button></a></p>
												 </th>';
									}


							echo'<th class="text-left">
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&servicio=Hospitalario"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Registro enfermería</button></a></p>
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&servicio=Hospitalario&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-stethoscope"></span> Signos vitales</button></a></p>
										<p><a href="'.PROGRAMA.'?opcion=155&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-medkit"></span> Medicamentos</button></a></p>
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST['opcion'].'&mante=OXI&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario&doc='.$fila["doc_pac"].'&tf=E"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-cloud"></span> Oxigeno</button></a></p>
									 </th>';
							echo "</tr>\n";
						}else {
							echo"<tr >\n";
							echo'<th class="text-center">';
										echo'<section class="row">';
												 $id=$fila['id_adm_hosp'];
												 $sql_downton="SELECT count(id_esc_downton) cuantos	 FROM escala_downton WHERE id_adm_hosp=$id";
												 if ($tabla_downton=$bd1->sub_tuplas($sql_downton)){
													 foreach ($tabla_downton as $fila_downton ) {
														 $id_c=$fila_downton['cuantos'];
														 if ($id_c >= 0) {
															 echo'<article class="col-md-6">';
															 echo'<button type="button" class="btn btn-info " data-toggle="modal" data-target="#historia_downton_'.$fila["id_adm_hosp"].'">Historico Downton</button>';
															 echo'</article>';
															 echo'<article class="col-md-6">';
															 echo'<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOWNTON&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-square"></span> </button></a>';
															 echo'</article>';
															 echo'
															 <div id="historia_downton_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
																 <div class="modal-dialog">

																	 <!-- Modal content-->
																	 <div class="modal-content">
																		 <div class="modal-header">
																			 <button type="button" class="close" data-dismiss="modal">&times;</button>
																			 <h4 class="modal-title">Historico de registros Escala Downton</h4>
																		 </div>
																		 <div class="modal-body">';
																			 $sql_h_downton="SELECT a.id_esc_downton,freg,total,criterio_total,sugerencia,b.nombre
																											 FROM escala_downton a inner join user b on a.id_user=b.id_user
																											 WHERE id_adm_hosp=$id and a.estado is null
																											 ORDER BY freg DESC";
																			 if ($tabla_h_downton=$bd1->sub_tuplas($sql_h_downton)){
																				 foreach ($tabla_h_downton as $fila_h_downton ) {
																					 echo'<section class="panel-body">';
																					 $riesgo=$fila_h_downton['criterio_total'];
																					 if ($riesgo=='BAJO RIESGO') {
																							 echo'<article class="col-md-12 alert alert-success">';
																							 echo'<p><strong>Fecha Registro: </strong>'.$fila_h_downton['freg'].'</p>';
																							 echo'<p><strong>Clasificación: </strong>'.$fila_h_downton['criterio_total'].'</p>';
																							 echo'<p><strong>Total: </strong>'.$fila_h_downton['total'].'</p>';
																							 echo'<p><strong>Responsable: </strong>'.$fila_h_downton['nombre'].'</p>';
																							 echo'<p>'.$fila_h_downton['sugerencia'].'</p>';
																							 echo'</article>';
																							 echo '<article class="col-md-4">';
																							 echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_downton['id_esc_downton'].'&tabla=downton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
																							 echo'</article>';
																					 }
																					 if ($riesgo=='ALTO RIESGO') {
																							 echo'<article class="col-md-12 alert alert-danger">';
																							 echo'<p><strong>Fecha Registro: </strong>'.$fila_h_downton['freg'].'</p>';
																							 echo'<p><strong>Clasificación: </strong>'.$fila_h_downton['criterio_total'].'</p>';
																							 echo'<p><strong>Total: </strong>'.$fila_h_downton['total'].'</p>';
																							 echo'<p><strong>Responsable: </strong>'.$fila_h_downton['nombre'].'</p>';
																							 echo'<p>'.$fila_h_downton['sugerencia'].'</p>';
																							 echo'</article>';
																							 echo '<article class="col-md-4">';
																							 echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_downton['id_esc_downton'].'&tabla=downton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
																							 echo'</article>';
																					 }
																					 echo'</section>';
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
													 }
												 }
												 echo'</section>';

										echo'<section class="row">
													<p>
													<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=INSUMOS&idadmhosp='.$fila["id_adm_hosp"].'">
													<button type="button" class="btn btn-inverse" ><span class="fa fa-hand-paper-o"></span> Solicitud<br>insumos</button></a>
													</p>
												 </section>
										</th>';
										echo'<td class="text-left">
												 <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
												 <p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].' </p>
												 <p><strong>ADM:</strong>'.$fila["id_adm_hosp"].'</p>
												 <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].'</p>
												 <p><img src="'.$fila["fotopac"].'"alt ="foto" class="img-rounded" width="80" data-toggle="modal" data-target="#modalpac"></p>
												 ';
									 echo'</td>';

									 $sql_ubipaciente="SELECT id_ubipaciente, id_adm_hosp, id_cama, resp_reg, freg, finicial, ffinal, total_destancia, nota_traslado
																		FROM ubipaciente
																		WHERE id_ubipaciente=$ubi";
																		//echo $sql_ubipaciente;
									if ($tabla_ubipaciente=$bd1->sub_tuplas($sql_ubipaciente)){
										foreach ($tabla_ubipaciente as $fila_ubipaciente) {
											if ($fila_ubipaciente['ffinal'] == '') {
												echo'<td class="text-center">
															<p class="lead"><strong><u>Ubicación actual:</u></strong><br> ';
																$cama=$fila_ubipaciente['id_cama'];
																$sql_cama="SELECT c.id_sedes_ips,
																						 d.id_cama idc,nom_cama,estado_cama,
																						 e.nom_hab,
																						 f.nom_pabellon,
																						 g.nom_piso
																		FROM sedes_ips c 	INNER JOIN piso g on g.id_sedes_ips=c.id_sedes_ips
																											INNER JOIN pabellon f on f.id_piso=g.id_piso
																											INNER JOIN habitacion e on e.id_pabellon=f.id_pabellon
																											INNER JOIN cama d on d.id_habitacion=e.id_habitacion
																		WHERE  d.id_cama=$cama";
																		if ($tabla_cama=$bd1->sub_tuplas($sql_cama)){
																			foreach ($tabla_cama as $fila_cama) {
																				echo  '<strong>Piso:</strong> '.$fila_cama["nom_piso"].' <strong>Pabellíon:</strong> '. $fila_cama["nom_pabellon"].' <strong>Habitación:</strong> '.$fila_cama["nom_hab"].' -- '.$fila_cama["nom_cama"];
																			}
																		}

												 echo'</p>
															<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TRASLADO&idc='.$fila_cama["idc"].'&idubi='.$fila_ubipaciente["id_ubipaciente"].'&sede='.$fila['ids'].'&doc='.$doc.'&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-refresh"></span> Trasladar a otra cama</button></a></p>
														 </td>';
											}
											if ($fila_ubipaciente['ffinal']!='') {
												echo'<th class="text-center alert alert-danger">
															<p><strong><u>NO TIENE UBICACION</u></p>
															<p><a href="'.PROGRAMA.'?opcion=161&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-bed"></span> Ubicación<br>Inicial</button></a></p>
														 </th>';
											}
										}
									}else {
										echo'<th class="text-center alert alert-danger">
													<p><strong><u>NO TIENE UBICACION</u><br>
													El paciente debe ser un NUEVO ingreso, debido a no presenta historico de ubicación</p>
													<p><a href="'.PROGRAMA.'?opcion=161&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-bed"></span> Ubicación<br>Inicial</button></a></p>
												 </th>';
									}


							echo'<th class="text-left">
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&servicio=Hospitalario"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Registro enfermería</button></a></p>
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&servicio=Hospitalario&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-stethoscope"></span> Signos vitales</button></a></p>
										<p><a href="'.PROGRAMA.'?opcion=155&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-medkit"></span> Medicamentos</button></a></p>
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST['opcion'].'&mante=OXI&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario&doc='.$fila["doc_pac"].'&tf=E"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-cloud"></span> Oxigeno</button></a></p>
									 </th>';
							echo "</tr>\n";
						}
					}
					if ($servicio=='Hospital dia') {
						echo"<tr >	\n";
						echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ORDVER&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-bell animated shake"></span></button></a></th>';
						echo'<td class="text-left">
									<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
									<p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].'</p>
									<p><strong>ADM: </strong> '.$fila["id_adm_hosp"].'</p>
								 </td>';
						echo'<td class="text-center">
									<p><strong class="text-info">Fecha: </strong>'.$fila["fingreso_hosp"].'</p><p><strong class="text-info">Hora: </strong>'.$fila["hingreso_hosp"].'</p>
									<p>'.$fila["tipo_servicio"].'</p>
									<p><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
						echo'<th class="text-center">';
						echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['sede'].'"><button type="button" class="btn btn-primary " ><span class="fa fa-plus-circle"></span> Agregar<br>Nota</button></a>
								 <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['sede'].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-info  " ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a>';
						echo'</th>';
						echo "</tr>\n";
					}
					$fconsulta=date('Y-m-d');
					if ($servicio=='Consulta Externa SM' ) {
						echo"<tr >	\n";
						echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ORDVER&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-bell animated shake"></span></button></a></th>';
						echo'<td class="text-left">
									<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
									<p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].'</p>
									<p><strong>ADM: </strong> '.$fila["id_adm_hosp"].'</p>
								 </td>';
						echo'<td class="text-center">
									<p><strong class="text-info">Fecha: </strong>'.$fila["fingreso_hosp"].'</p><p><strong class="text-info">Hora: </strong>'.$fila["hingreso_hosp"].'</p>
									<p>'.$fila["tipo_servicio"].'</p>
									<p><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
						echo'<th class="text-center">';
						echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['sede'].'"><button type="button" class="btn btn-primary " ><span class="fa fa-plus-circle"></span> Agregar<br>Nota</button></a>
								 <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['sede'].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-info  " ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a>';
						echo'</th>';
						echo "</tr>\n";
					}
				}
			}
		}


		if (isset($_REQUEST["nom"])){
			$doc=$_REQUEST["nom"];
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,
									 s.id_sedes_ips,nom_sedes,
									 h.id_hchosp,
									 max(f.id_ubipaciente) ubi

						FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
														 INNER JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
														 LEFT JOIN hc_hospitalario h on a.id_adm_hosp=h.id_adm_hosp
														 LEFT JOIN ubipaciente f on (f.id_adm_hosp = a.id_adm_hosp)

						WHERE p.nom_completo like '%".$doc."%' and a.estado_adm_hosp='Activo'
						GROUP BY  p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
												 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,
												 s.id_sedes_ips,nom_sedes,
												 h.id_hchosp ";
						//echo $sql;
			if ($tabla=$bd1->sub_tuplas($sql)){
				//echo $sql;
				foreach ($tabla as $fila ) {
					$servicio=$fila['tipo_servicio'];
					if ($servicio=='Hospitalario') {
						$ubi=$fila['ubi'];
						if ($ubi=='') {
							echo"<tr >\n";
							echo'<th class="text-center">
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ORDVER&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-inverse sombra_movil" ><span class="fa fa-bullhorn"></span> Alertas</button></a></p>
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=INSUMOS&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-inverse sombra_movil" ><span class="fa fa-hand-paper-o"></span> Solicitud<br>insumos</button></a></p></th>';
										echo'<td class="text-left">
												 <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
												 <p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].' </p>
												 <p><strong>ADM:</strong>'.$fila["id_adm_hosp"].'</p>
												 <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].'</p>
												 <p><img src="'.$fila["fotopac"].'"alt ="foto" class="img-rounded" width="80" data-toggle="modal" data-target="#modalpac"></p>
												 ';
									 echo'</td>';
									$sql_ubipaciente="SELECT id_ubipaciente, id_adm_hosp, id_cama, resp_reg, freg, finicial, ffinal, total_destancia, nota_traslado
																		FROM ubipaciente
																		WHERE id_ubipaciente=$ubi";
																		//echo $sql_ubipaciente;
									if ($tabla_ubipaciente=$bd1->sub_tuplas($sql_ubipaciente)){
										foreach ($tabla_ubipaciente as $fila_ubipaciente) {
											if ($fila_ubipaciente['ffinal'] == '') {
												echo'<td class="text-center">
															<p class="lead"><strong><u>Ubicación actual:</u></strong><br> ';
																$cama=$fila_ubipaciente['id_cama'];
																$sql_cama="SELECT c.id_sedes_ips,
																						 d.id_cama idc,nom_cama,estado_cama,
																						 e.nom_hab,
																						 f.nom_pabellon,
																						 g.nom_piso
																		FROM sedes_ips c 	INNER JOIN piso g on g.id_sedes_ips=c.id_sedes_ips
																											INNER JOIN pabellon f on f.id_piso=g.id_piso
																											INNER JOIN habitacion e on e.id_pabellon=f.id_pabellon
																											INNER JOIN cama d on d.id_habitacion=e.id_habitacion
																		WHERE  d.id_cama=$cama";
																		if ($tabla_cama=$bd1->sub_tuplas($sql_cama)){
																			foreach ($tabla_cama as $fila_cama) {
																				echo  '<strong>Piso:</strong> '.$fila_cama["nom_piso"].' <strong>Pabellíon:</strong> '. $fila_cama["nom_pabellon"].' <strong>Habitación:</strong> '.$fila_cama["nom_hab"].' -- '.$fila_cama["nom_cama"];
																			}
																		}

												 echo'</p>
															<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TRASLADO&idc='.$fila_cama["idc"].'&idubi='.$fila_ubipaciente["id_ubipaciente"].'&sede='.$fila['ids'].'&doc='.$doc.'&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-refresh"></span> Trasladar a otra cama</button></a></p>
														 </td>';
											}
											if ($fila_ubipaciente['ffinal']!='') {
												echo'<th class="text-center alert alert-danger">
															<p><strong><u>NO TIENE UBICACION</u></p>
															<p><a href="'.PROGRAMA.'?opcion=161&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-bed"></span> Ubicación<br>Inicial</button></a></p>
														 </th>';
											}
										}
									}else {
										echo'<th class="text-center alert alert-danger">
													<p><strong><u>NO TIENE UBICACION</u><br>
													El paciente debe ser un NUEVO ingreso, debido a no presenta historico de ubicación</p>
													<a href="'.PROGRAMA.'?doc='.$fila["doc_pac"].'&buscar=Consultar&opcion='.$_REQUEST["opcion"].'"><button type="button" class="btn btn-success btn-lg" ><span class="fa fa-search"></span> Filtrar por documento de identidad</button></a></p>
												 </th>';
			 						}



							echo'<th class="text-left">
										<p  class="text-justify alert alert-info animated bounceIn"><span class="fa fa-ban fa-2x text-danger"></span>Paciente sin registro de ubicación en SION software, es posible que sea un NUEVO ingreso.
										<a href="rpt_hcingreso.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&nom='.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'&edad='.$edad.'&eps='.$eps.'" target="_blank"><button type="button" class="btn btn-primary" ><span class="fa fa-eye"></span> Ver HC ingreso</button></a></p>
									 </th>';
							echo "</tr>\n";
						}else {
							echo"<tr >\n";
							echo'<th class="text-center">';
							echo'<section class="row">';
									 $id=$fila['id_adm_hosp'];
									 $sql_downton="SELECT count(id_esc_downton) cuantos	 FROM escala_downton WHERE id_adm_hosp=$id";
									 if ($tabla_downton=$bd1->sub_tuplas($sql_downton)){
										 foreach ($tabla_downton as $fila_downton ) {
											 $id_c=$fila_downton['cuantos'];
											 if ($id_c >= 0) {
												 echo'<article class="col-md-6">';
												 echo'<button type="button" class="btn btn-info " data-toggle="modal" data-target="#historia_downton_'.$fila["id_adm_hosp"].'">Historico Downton</button>';
												 echo'</article>';
												 echo'<article class="col-md-6">';
												 echo'<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOWNTON&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-square"></span> </button></a>';
												 echo'</article>';
												 echo'
												 <div id="historia_downton_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
													 <div class="modal-dialog">

														 <!-- Modal content-->
														 <div class="modal-content">
															 <div class="modal-header">
																 <button type="button" class="close" data-dismiss="modal">&times;</button>
																 <h4 class="modal-title">Historico de registros Escala Downton</h4>
															 </div>
															 <div class="modal-body">';
																 $sql_h_downton="SELECT a.id_esc_downton,freg,total,criterio_total,sugerencia,b.nombre
																								 FROM escala_downton a inner join user b on a.id_user=b.id_user
																								 WHERE id_adm_hosp=$id and a.estado is null
																								 ORDER BY freg DESC";
																 if ($tabla_h_downton=$bd1->sub_tuplas($sql_h_downton)){
																	 foreach ($tabla_h_downton as $fila_h_downton ) {
																		 echo'<section class="panel-body">';
																		 $riesgo=$fila_h_downton['criterio_total'];
																		 if ($riesgo=='BAJO RIESGO') {
																				 echo'<article class="col-md-12 alert alert-success">';
																				 echo'<p><strong>Fecha Registro: </strong>'.$fila_h_downton['freg'].'</p>';
																				 echo'<p><strong>Clasificación: </strong>'.$fila_h_downton['criterio_total'].'</p>';
																				 echo'<p><strong>Total: </strong>'.$fila_h_downton['total'].'</p>';
																				 echo'<p><strong>Responsable: </strong>'.$fila_h_downton['nombre'].'</p>';
																				 echo'<p>'.$fila_h_downton['sugerencia'].'</p>';
																				 echo'</article>';
																				 echo '<article class="col-md-4">';
																				 echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_downton['id_esc_downton'].'&tabla=downton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
																				 echo'</article>';
																		 }
																		 if ($riesgo=='ALTO RIESGO') {
																				 echo'<article class="col-md-12 alert alert-danger">';
																				 echo'<p><strong>Fecha Registro: </strong>'.$fila_h_downton['freg'].'</p>';
																				 echo'<p><strong>Clasificación: </strong>'.$fila_h_downton['criterio_total'].'</p>';
																				 echo'<p><strong>Total: </strong>'.$fila_h_downton['total'].'</p>';
																				 echo'<p><strong>Responsable: </strong>'.$fila_h_downton['nombre'].'</p>';
																				 echo'<p>'.$fila_h_downton['sugerencia'].'</p>';
																				 echo'</article>';
																				 echo '<article class="col-md-4">';
																				 echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_downton['id_esc_downton'].'&tabla=downton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
																				 echo'</article>';
																		 }
																		 echo'</section>';
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
										 }
									 }
									 echo'</section>';
									 echo'<section class="row">
												 <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=INSUMOS&idadmhosp='.$fila["id_adm_hosp"].'">
												 <button type="button" class="btn btn-inverse sombra_movil" ><span class="fa fa-hand-paper-o"></span> Solicitud<br>insumos</button></a>
												</section>';
										echo'<td class="text-left">
												 <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
												 <p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].' </p>
												 <p><strong>ADM:</strong>'.$fila["id_adm_hosp"].'</p>
												 <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].'</p>
												 <p><img src="'.$fila["fotopac"].'"alt ="foto" class="img-rounded" width="80" data-toggle="modal" data-target="#modalpac"></p>
												 ';
									 echo'</td>';

									 $sql_ubipaciente="SELECT id_ubipaciente, id_adm_hosp, id_cama, resp_reg, freg, finicial, ffinal, total_destancia, nota_traslado
																		 FROM ubipaciente
																		 WHERE id_ubipaciente=$ubi";
																		 //echo $sql_ubipaciente;
									 if ($tabla_ubipaciente=$bd1->sub_tuplas($sql_ubipaciente)){
										 foreach ($tabla_ubipaciente as $fila_ubipaciente) {
											 if ($fila_ubipaciente['ffinal'] == '') {
												 echo'<td class="text-center">
															 <p class="lead"><strong><u>Ubicación actual:</u></strong><br> ';
																 $cama=$fila_ubipaciente['id_cama'];
																 $sql_cama="SELECT c.id_sedes_ips,
																							d.id_cama idc,nom_cama,estado_cama,
																							e.nom_hab,
																							f.nom_pabellon,
																							g.nom_piso
																		 FROM sedes_ips c 	INNER JOIN piso g on g.id_sedes_ips=c.id_sedes_ips
																											 INNER JOIN pabellon f on f.id_piso=g.id_piso
																											 INNER JOIN habitacion e on e.id_pabellon=f.id_pabellon
																											 INNER JOIN cama d on d.id_habitacion=e.id_habitacion
																		 WHERE  d.id_cama=$cama";
																		 if ($tabla_cama=$bd1->sub_tuplas($sql_cama)){
																			 foreach ($tabla_cama as $fila_cama) {
																				 echo  '<strong>Piso:</strong> '.$fila_cama["nom_piso"].' <strong>Pabellíon:</strong> '. $fila_cama["nom_pabellon"].' <strong>Habitación:</strong> '.$fila_cama["nom_hab"].' -- '.$fila_cama["nom_cama"];
																			 }
																		 }

													echo'</p>
															 <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TRASLADO&idc='.$fila_cama["idc"].'&idubi='.$fila_ubipaciente["id_ubipaciente"].'&sede='.$fila['ids'].'&doc='.$doc.'&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-refresh"></span> Trasladar a otra cama</button></a></p>
															</td>';
											 }
											 if ($fila_ubipaciente['ffinal']!='') {
												 echo'<th class="text-center alert alert-danger">
															 <p><strong><u>NO TIENE UBICACION</u></p>
															 <p><a href="'.PROGRAMA.'?opcion=161&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-danger sombra_movil " ><span class="fa fa-bed"></span> Ubicación<br>Inicial</button></a></p>
															</th>';
											 }
										 }
									 }


							echo'<th class="text-left">
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&servicio=Hospitalario"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Registro enfermería</button></a></p>
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&servicio=Hospitalario&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-stethoscope"></span> Signos vitales</button></a></p>
										<p><a href="'.PROGRAMA.'?opcion=155&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-medkit"></span> Medicamentos</button></a></p>
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST['opcion'].'&mante=OXI&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario&doc='.$fila["doc_pac"].'&tf=E"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-cloud"></span> Oxigeno</button></a></p>
									 </th>';
							echo "</tr>\n";
						}
					}
					if ($servicio=='Hospital dia') {
						echo"<tr >	\n";
						echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ORDVER&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-bell animated shake"></span></button></a></th>';
						echo'<td class="text-left">
									<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
									<p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].'</p>
									<p><strong>ADM: </strong> '.$fila["id_adm_hosp"].'</p>
								 </td>';
						echo'<td class="text-center">
									<p><strong class="text-info">Fecha: </strong>'.$fila["fingreso_hosp"].'</p><p><strong class="text-info">Hora: </strong>'.$fila["hingreso_hosp"].'</p>
									<p>'.$fila["tipo_servicio"].'</p>
									<p><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
						echo'<th class="text-center">';
						echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['sede'].'"><button type="button" class="btn btn-primary " ><span class="fa fa-plus-circle"></span> Agregar<br>Nota</button></a>
								 <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['sede'].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-info  " ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a>';
						echo'</th>';
						echo "</tr>\n";
					}
					$fconsulta=date('Y-m-d');
					if ($servicio=='Consulta Externa SM' ) {
						echo"<tr >	\n";
						echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ORDVER&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-bell animated shake"></span></button></a></th>';
						echo'<td class="text-left">
									<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
									<p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].'</p>
									<p><strong>ADM: </strong> '.$fila["id_adm_hosp"].'</p>
								 </td>';
						echo'<td class="text-center">
									<p><strong class="text-info">Fecha: </strong>'.$fila["fingreso_hosp"].'</p><p><strong class="text-info">Hora: </strong>'.$fila["hingreso_hosp"].'</p>
									<p>'.$fila["tipo_servicio"].'</p>
									<p><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
						echo'<th class="text-center">';
						echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['sede'].'"><button type="button" class="btn btn-primary " ><span class="fa fa-plus-circle"></span> Agregar<br>Nota</button></a>
								 <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['sede'].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-info  " ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a>';
						echo'</th>';
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
