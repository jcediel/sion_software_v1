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
			case 'VALINI':
				$sql="INSERT INTO tsce_sm ( id_adm_hosp, id_user, freg_tsce_sm, hreg_tsce_sm,tipo_atencion,h_familiar,estudio_socio,concepto_ts,recomendaciones,estado_tsce_sm) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["tipoatencion"]."','".$_POST["h_familiar"]."',
				'".$_POST["estudio_socio"]."','".$_POST["concepto_ts"]."','".$_POST["recomendaciones"]."','Realizada')";
				$subtitulo="Valoracion inicial hospitalario";
				$subtitulo1="Adicionado";

			break;
			case 'EVO':
				$sql="INSERT INTO evo_ts (id_adm_hosp,id_user,freg_evots	,hreg_evots,evolucion_ts,estado_evots) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg_ts"]."','".$_POST["hreg_ts"]."','".$_POST["evolucion_ts"]."','Realizado')";
				$subtitulo="Evolución en Trabajo social";
				$subtitulo1="Adicionado";
			break;

			case 'ORDVER':
				$sql="INSERT INTO orden_verbal( id_adm_hosp, id_user, freg_ord_verbal, hreg_ord_verbal, orden_verbal, estado_orden_verbal)
							VALUES ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."',
											'".$_POST["ordverb"]."','Realizada')";
				$subtitulo="Orden Verbal";
				$subtitulo1="Adicionado";
			break;
			case 'TRAS':
			$fecha=$_POST["f"];
			$segundos= strtotime('now') - strtotime($fecha);
			$diferencia_dias=intval($segundos/60/60/24);
			$dias=round($diferencia_dias/365);

				$sql1="UPDATE ubipaciente SET ffinal='".$_POST["freg"]."',total_destancia='".$dias."'
							 WHERE id_ubipaciente='".$_POST["idu"]."' ";

 				$sql="INSERT INTO traslados (id_adm_hosp, id_user, freg_traslado, hreg_traslado, fprog_envio, hprog_envio,origen,
																		 obs_envio, resp_envio, estado_traslado)
 				VALUES ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."',
								'".$_POST["fprog"]."','".$_POST["hprog"]."','".$_POST["sedes"]."','".$_POST["obs_envio"]."',
								'".$_SESSION["AUT"]["nombre"]."','Enviado');";
 				$subtitulo="Ordenes de traslado Interno";
 				$subtitulo1="Adicionado";
 			break;
		}
		//echo $sql;
		//echo $sql1;
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo fue $subtitulo1 con exito!";
			$check='si';
				if ($bd1->consulta($sql1)) {
					$subtitulo="$subtitulo fue $subtitulo1 con exito!";
					$check='si';
				}
		}else{
			$subtitulo="$subtitulo NO fue $subtitulo1 !!! .";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'VALINI':
    $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
    j.nom_eps
    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                left join eps j on (j.id_eps=b.id_eps)
    where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Valoracion Inicial Hospitalaria";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$opcion=$_REQUEST['opcion'];
			$doc=$_REQUEST['doc'];
			$form1='formulariosHOSP/TS/val_ini_ts.php';
			$subtitulo='Valoracion Inicial Trabajo social';
			break;
			case 'EVO':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Evolución";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$opcion=$_REQUEST['opcion'];
			$doc=$_REQUEST['doc'];
			$form1='formulariosHOSP/TS/evots.php';
			$subtitulo='Trabajo Social';
			break;
			case 'TRAS':
			$idadm=$_REQUEST['idadmhosp'];
      $sql="SELECT a.id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento, edad, uedad, dir_pac, tel_pac, email_pac, estadocivil,
									 genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac, cie, descricie, zonapac, ipsordena,
									 c.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
									 b.id_ubipaciente idubi,b.id_cama idc,finicial,ffinal,
									 d.nom_cama,
									 e.nom_hab,
									 f.nom_pabellon,
									 g.nom_piso
						FROM pacientes a INNER JOIN adm_hospitalario c on a.id_paciente=c.id_paciente
														 LEFT JOIN ubipaciente b on b.id_adm_hosp=c.id_adm_hosp
														 LEFT JOIN cama d on d.id_cama=b.id_cama
														 LEFT JOIN habitacion e on e.id_habitacion=d.id_habitacion
														 LEFT JOIN pabellon f on f.id_pabellon=e.id_pabellon
														 LEFT JOIN piso g on g.id_piso=f.id_piso
						WHERE c.id_adm_hosp=$idadm and c.estado_adm_hosp='Activo' and b.ffinal is null" ;
						//echo $sql;
			$boton="Agregar Orden de traslado";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formulariosHOSP/TS/ordtraslado.php';
			$subtitulo='Solicitud Orden de traslado interno';
			break;

			case 'ORDVER':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,
										lateralidad,religion,fotopac,
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
			if (!$fila=$bd1->sub_fila($sql))
			{
				$fila=array("id_paciente"=>"", "tdoc_pac"=>"", "doc_pac"=>"", "nom1"=>"", "nom2"=>"", "ape1"=>"", "ape2"=>"",
				"fnacimiento"=>"", "edad"=>"", "uedad"=>"", "dir_pac"=>"", "tel_pac"=>"", "email_pac"=>"", "estadocivil"=>"",
				"genero"=>"", "rh"=>"", "etnia"=>"", "lateralidad"=>"", "profesion"=>"", "religion"=>"", "fotopac"=>"","estado_pac"=>"",
				"cie"=>"", "descricie"=>"", "zonapac"=>"", "ipsordena"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"",
				"fegreso_hosp"=>"","hegreso_hosp"=>"","idubi"=>"","finicial"=>"","ffinal"=>"","nom_cama"=>"","nom_hab"=>"","nom_pabellon"=>"",
				"nom_piso"=>"");
			}
		}else
		{
				$fila=array("id_paciente"=>"", "tdoc_pac"=>"", "doc_pac"=>"", "nom1"=>"", "nom2"=>"", "ape1"=>"", "ape2"=>"",
				"fnacimiento"=>"", "edad"=>"", "uedad"=>"", "dir_pac"=>"", "tel_pac"=>"", "email_pac"=>"", "estadocivil"=>"",
				"genero"=>"", "rh"=>"", "etnia"=>"", "lateralidad"=>"", "profesion"=>"", "religion"=>"", "fotopac"=>"","estado_pac"=>"",
				"cie"=>"", "descricie"=>"", "zonapac"=>"", "ipsordena"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"",
				"fegreso_hosp"=>"","hegreso_hosp"=>"","idubi"=>"","finicial"=>"","ffinal"=>"","nom_cama"=>"","nom_hab"=>"","nom_pabellon"=>"",
				"nom_piso"=>"");
			}

		?>

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
	<section class="panel-heading">
		<h4>Trabajo social en servicio de SALUD MENTAL</h4>
	</section>
	<section class="panel-body">
		<section class="panel-body">
			<article class="col-md-12">
				<?php
					include("consulta_rapida1.php");
				?>
			</article>
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
		<section class="panel panel-body">
			<table class="table table-responsive">
				<tr>
					<th class="info"></th>
					<th class="info">PACIENTE</th>
					<th class="info">FECHA INGRESO</th>
					<th class="info">SERVICIO</th>
					<th class="info">FOTO</th>
					<th class="info" colspan="3"></th>

				</tr>

				<?php
				if (isset($_REQUEST["doc"])){
				$doc=$_REQUEST["doc"];
				$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
										 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,
										 s.nom_sedes

							FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
															 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips

							WHERE p.doc_pac='".$doc."' and a.estado_adm_hosp='Activo' and tipo_servicio in ('Hospitalario','Hospital dia','Consulta Externa SM')";

				if ($tabla=$bd1->sub_tuplas($sql)){
					foreach ($tabla as $fila ) {
						if ($fila['tipo_servicio']=='Hospitalario') {
							echo"<tr >	\n";
							echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ORDVER&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-bell animated shake"></span></button></a></th>';
							echo'<td class="text-left">
										<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
										<p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].'</p>
										<p><strong>ADM: </strong> '.$fila["id_adm_hosp"].'</p>
									 </td>';
							echo'<td class="text-center"><p><strong class="text-info">Fecha: </strong>'.$fila["fingreso_hosp"].'</p><p><strong class="text-info">Hora: </strong>'.$fila["hingreso_hosp"].'</p></td>';
							echo'<td class="text-center">'.$fila["tipo_servicio"].'</td>';
							echo'<td class="text-center"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
							echo'<th class="text-center">';
							$adm=$fila['id_adm_hosp'];
										$sqlv="SELECT id_tsce_sm FROM tsece_sm where id_adm_hosp=$adm";
										if ($tablav=$bd1->sub_tuplas($sqlv)){
											foreach ($tablav as $filav ) {
												echo'<p class="text-primary">Valoración Registrada</p>';
												echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila["tipo_servicio"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>';
											}
										}else {
											echo'<th class="text-left">
														<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VALINI&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Valoración <br> Inicial</button></a></p>
														<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila["tipo_servicio"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>
													 </th>';
										}
							echo'</th>';
							echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TRAS&idadmhosp='.$fila["id_adm_hosp"].'&idadmhosp='.$fila['id_adm_hosp'].'"><button type="button" class="btn btn-success" ><span class="fa fa-rocket"></span> Traslado<br>Interno</button></a></th>';
							echo "</tr>\n";
						}
						if ($fila['tipo_servicio']=='Hospital dia') {
							echo"<tr >	\n";
							echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ORDVER&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-bell animated shake"></span></button></a></th>';
							echo'<td class="text-left">
										<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
										<p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].'</p>
										<p><strong>ADM: </strong> '.$fila["id_adm_hosp"].'</p>
									 </td>';
							echo'<td class="text-center"><p><strong class="text-info">Fecha: </strong>'.$fila["fingreso_hosp"].'</p><p><strong class="text-info">Hora: </strong>'.$fila["hingreso_hosp"].'</p></td>';
							echo'<td class="text-center">'.$fila["tipo_servicio"].'</td>';
							echo'<td class="text-center"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
							echo'<th class="text-center">';
							$adm=$fila['id_adm_hosp'];
										$sqlv="SELECT id_tsce_sm FROM tsece_sm where id_adm_hosp=$adm";
										if ($tablav=$bd1->sub_tuplas($sqlv)){
											foreach ($tablav as $filav ) {
												echo'<p class="text-primary">Valoración Registrada</p>';
												echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila["tipo_servicio"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>';
												echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila['tipo_servicio'].'&doc='.$fila["doc_pac"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-success " ><span class="fa fa-flask"></span> Ayuda Dx</button></a></th>';
											}
										}else {
											echo'<th class="text-left">
														<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VALINI&idadmhosp='.$fila["id_adm_hosp"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Valoración <br> Inicial</button></a></p>
														<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila["tipo_servicio"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>
														<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila['tipo_servicio'].'&doc='.$fila["doc_pac"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-success " ><span class="fa fa-flask"></span> Ayuda Dx</button></a></p>
													 </th>';
										}
							echo'</th>';
							echo "</tr>\n";
						}
						$fconsulta=date('Y-m-d');
						if ($fila['tipo_servicio']=='Consulta Externa SM' && $fila['fingreso_hosp']=="'.$fconsulta.'") {
							echo"<tr >	\n";
							echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ORDVER&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-bell animated shake"></span></button></a></th>';
							echo'<td class="text-left">
										<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
										<p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].'</p>
										<p><strong>ADM: </strong> '.$fila["id_adm_hosp"].'</p>
									 </td>';
							echo'<td class="text-center"><p><strong class="text-info">Fecha: </strong>'.$fila["fingreso_hosp"].'</p><p><strong class="text-info">Hora: </strong>'.$fila["hingreso_hosp"].'</p></td>';
							echo'<td class="text-center">'.$fila["tipo_servicio"].'</td>';
							echo'<td class="text-center"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
							echo'<th class="text-center">';
							$adm=$fila['id_adm_hosp'];
										$sqlv="SELECT id_tsce_sm FROM tsece_sm where id_adm_hosp=$adm";
										if ($tablav=$bd1->sub_tuplas($sqlv)){
											foreach ($tablav as $filav ) {
												echo'<p class="text-primary">Valoración Registrada</p>';
												echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila["tipo_servicio"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>';
												echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila['tipo_servicio'].'&doc='.$fila["doc_pac"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-success " ><span class="fa fa-flask"></span> Ayuda Dx</button></a></th>';
											}
										}else {
											echo'<th class="text-left">
														<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VALINI&idadmhosp='.$fila["id_adm_hosp"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Valoración <br> Inicial</button></a></p>
														<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila["tipo_servicio"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>
														<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila['tipo_servicio'].'&doc='.$fila["doc_pac"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-success " ><span class="fa fa-flask"></span> Ayuda Dx</button></a></p>
													 </th>';
										}
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
										 s.nom_sedes
							FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
															 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
							WHERE p.nom_completo LIKE '%".$doc."%' and a.estado_adm_hosp='Activo' and tipo_servicio in ('Hospitalario','Hospital dia','Consulta Externa SM')";

				if ($tabla=$bd1->sub_tuplas($sql)){
					//echo $sql;
					foreach ($tabla as $fila ) {
						if ($fila['tipo_servicio']=='Hospitalario') {
							echo"<tr >	\n";
							echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ORDVER&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-bell animated shake"></span></button></a></th>';
							echo'<td class="text-left">
										<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
										<p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].'</p>
										<p><strong>ADM: </strong> '.$fila["id_adm_hosp"].'</p>
									 </td>';
							echo'<td class="text-center"><p><strong class="text-info">Fecha: </strong>'.$fila["fingreso_hosp"].'</p><p><strong class="text-info">Hora: </strong>'.$fila["hingreso_hosp"].'</p></td>';
							echo'<th class="text-center text-success">'.$fila["tipo_servicio"].'</th>';
							echo'<td class="text-center"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
							echo'<th class="text-center">';
							$adm=$fila['id_adm_hosp'];
										$sqlv="SELECT id_tsce_sm FROM tsece_sm where id_adm_hosp=$adm";
										if ($tablav=$bd1->sub_tuplas($sqlv)){
											foreach ($tablav as $filav ) {
												echo'<p class="text-primary">Valoración Registrada</p>';
												echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila["tipo_servicio"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>';

											}
										}else {
											echo'<th class="text-left">
														<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VALINI&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Valoración <br> Inicial</button></a></p>
														<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila["tipo_servicio"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>

													 </th>';
										}
							echo'</th>';
							echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TRAS&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success" ><span class="fa fa-rocket"></span> Traslado<br>Interno</button></a></th>';
							echo "</tr>\n";
						}
						if ($fila['tipo_servicio']=='Hospital dia') {
							echo"<tr >	\n";
							echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ORDVER&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-bell animated shake"></span></button></a></th>';
							echo'<td class="text-left">
										<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
										<p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].'</p>
										<p><strong>ADM: </strong> '.$fila["id_adm_hosp"].'</p>
									 </td>';
							echo'<td class="text-center"><p><strong class="text-info">Fecha: </strong>'.$fila["fingreso_hosp"].'</p><p><strong class="text-info">Hora: </strong>'.$fila["hingreso_hosp"].'</p></td>';
							echo'<th class="text-center text-info">'.$fila["tipo_servicio"].'</th>';
							echo'<td class="text-center"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
							echo'<th class="text-center">';
							$adm=$fila['id_adm_hosp'];
										$sqlv="SELECT id_tsce_sm FROM tsece_sm where id_adm_hosp=$adm";
										if ($tablav=$bd1->sub_tuplas($sqlv)){
											foreach ($tablav as $filav ) {
												echo'<p class="text-primary">Valoración Registrada</p>';
												echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila["tipo_servicio"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>';
												echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila['tipo_servicio'].'&doc='.$fila["doc_pac"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-success " ><span class="fa fa-flask"></span> Ayuda Dx</button></a></th>';
											}
										}else {
											echo'<th class="text-left">
														<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VALINI&idadmhosp='.$fila["id_adm_hosp"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Valoración <br> Inicial</button></a></p>
														<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila["tipo_servicio"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>
														<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila['tipo_servicio'].'&doc='.$fila["doc_pac"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-success " ><span class="fa fa-flask"></span> Ayuda Dx</button></a></p>
													 </th>';
										}
							echo'</th>';
							echo "</tr>\n";
						}
						$fconsulta=date('Y-m-d');
						if ($fila['tipo_servicio']=='Consulta Externa SM' && $fila['fingreso_hosp']=="'.$fconsulta.'") {
							echo"<tr >	\n";
							echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ORDVER&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger " ><span class="fa fa-bell animated shake"></span></button></a></th>';
							echo'<td class="text-left">
										<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
										<p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].'</p>
										<p><strong>ADM: </strong> '.$fila["id_adm_hosp"].'</p>
									 </td>';
							echo'<td class="text-center"><p><strong class="text-info">Fecha: </strong>'.$fila["fingreso_hosp"].'</p><p><strong class="text-info">Hora: </strong>'.$fila["hingreso_hosp"].'</p></td>';
							echo'<th class="text-center text-danger">'.$fila["tipo_servicio"].'</th>';
							echo'<td class="text-center"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
							echo'<th class="text-center">';
							$adm=$fila['id_adm_hosp'];
										$sqlv="SELECT id_tsce_sm FROM tsece_sm where id_adm_hosp=$adm";
										if ($tablav=$bd1->sub_tuplas($sqlv)){
											foreach ($tablav as $filav ) {
												echo'<p class="text-primary">Valoración Registrada</p>';
												echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila["tipo_servicio"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>';
												echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila['tipo_servicio'].'&doc='.$fila["doc_pac"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-success " ><span class="fa fa-flask"></span> Ayuda Dx</button></a></th>';
											}
										}else {
											echo'<th class="text-left">
														<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VALINI&idadmhosp='.$fila["id_adm_hosp"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Valoración <br> Inicial</button></a></p>
														<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila["tipo_servicio"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>
														<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio='.$fila['tipo_servicio'].'&doc='.$fila["doc_pac"].'&atencion=Ambulatoria&sede='.$fila["sede"].'"><button type="button" class="btn btn-success " ><span class="fa fa-flask"></span> Ayuda Dx</button></a></p>
													 </th>';
										}
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
</section>
		<?php
	}
	?>
