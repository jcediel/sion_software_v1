<?php
$subtitulo="";
if(isset($_POST["operacion"])){	//nivel3
	if($_POST["aceptar"]!="Descartar"){
		//print_r($_FILES);
		switch ($_POST["operacion"]) {
		case 'A':
		$hab=$_POST['hab'];
		$sql_validacion1="SELECT estado_cama FROM cama WHERE id_cama=$hab";
		//echo $sql_validacion1;
		if ($tabla_validacion1=$bd1->sub_tuplas($sql_validacion1)){
			foreach ($tabla_validacion1 as $fila_validacion1) {
				$estado=$fila_validacion1['estado_cama'];
				if ($estado=='Libre') {
					$sql="INSERT INTO ubipaciente (id_adm_hosp, id_cama, resp_reg, freg, finicial,nota_traslado) VALUES
					('".$_POST["idadm"]."','".$_POST["hab"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."',
					 '".$_POST["finicial"]."','".$_POST["notatraslado"]."')
					  ";
					$subtitulo="La asignación del paciente". $_POST['nompac']. " en la Habitación  ".$_POST['habitacion']. " fue realizado exitosamente. ";
					$sql1="UPDATE cama SET estado_cama='".$_POST["estado"]."' WHERE id_cama='".$_POST["hab"]."'";
					$subtitulo1="Cama ".$hab." ha cambiado estado a Ocupada";

				}
				if ($estado=='Ocupado') {
					$sql="INSERT INTO ubipaciente ( id_cama, resp_reg, freg, finicial,nota_traslado) VALUES
					('".$_POST["idadm"]."','".$_POST["hab"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."',
					 '".$_POST["finicial"]."','".$_POST["notatraslado"]."')
						";
					$subtitulo="Esta cama SE ENCUENTRA OCUPADA no esposible realizar asignación";
					$sql1="UPDATE  SET estado_cama='".$_POST["estado"]."' WHERE id_cama='".$_POST["hab"]."'";
					$subtitulo1=".";
					$sub2='REALIZADA';
				}
			}
		}
		break;

		case 'LIB':
			$sql="UPDATE cama SET estado_cama='".$_POST["estado"]."' WHERE id_cama='".$_POST["idc"]."'";
			$subtitulo="La Reservada de la cama";
			$sub2='REALIZADA';
		break;
		case 'CAL':
			$sql="UPDATE cama SET estado_cama='".$_POST["estado"]."' WHERE id_cama='".$_POST["idc"]."'";
			$subtitulo="La cancelación de la reserva ";
			$sub2='REALIZADA';
		break;
		case 'OCP':
		$fecha=$_POST["finicial"];
		$segundos= strtotime('now') - strtotime($fecha);
		$diferencia_dias=intval($segundos/60/60/24);

		$sql="UPDATE cama SET estado_cama='".$_POST["estado"]."' WHERE id_cama='".$_POST["idc"]."' ";
		$sql1="UPDATE ubipaciente SET ffinal='".$_POST["freal"]."',total_destancia='".$diferencia_dias."'
					 WHERE id_ubipaciente='".$_POST["idu"]."' ";
			$subtitulo="Se liberado la cama ".$_POST['hab1'];
			$sub2="REALIZADA";
		break;
	}

//echo $sql.'  '.$sql1;

	if ($bd1->consulta($sql)){
		$check='si';
		if ($bd1->consulta($sql1)) {
			$subtitulo="$subtitulo $subtitulo1";
			$check='si';
		}
	}else{
		$subtitulo="$subtitulo";
		$check='no';
	}
}
}
if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'A':
		$id=$_REQUEST['idadmhosp'];
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp =$id" ;

			$color="yellow";
			$boton="Asignar Ubicación";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return2=$_POST['idc'];
			$return=$_REQUEST['doc'];
			$return1=$_REQUEST['idadmhosp'];
			$form1='formulariosHOSP/CAMAS/traslado_cama.php';
			$subtitulo='Asignación de ubicación en clínica';
		break;
		case 'CAL':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$color="yellow";
			$boton="Cancelar reserva";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['doc'];
			$return1=$_REQUEST['idadmhosp'];
			$return2=$_REQUEST['S'];
			$estado="Libre";
			$cama=$_REQUEST['H'];
			$mensaje='Esta CANCELANDO la reserva de la cama<strong> '.$cama.'</strong> para el paciente';
			$form1='formulariosHOSP/oper_cama.php';
			$subtitulo='';
		break;
		case 'LIB':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$color="yellow";
			$boton="Reservar cama";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['doc'];
			$return1=$_REQUEST['idadmhosp'];
			$return2=$_REQUEST['S'];
			$estado="Reservado";
			$cama=$_REQUEST['H'];
			$mensaje='Esta realizando RESERVA de la cama<strong> '.$cama.'</strong> para el paciente';
			$form1='formulariosHOSP/oper_cama.php';
			$subtitulo='';
		break;
		case 'VER':
			$idadm=$_REQUEST['idadmhosp'];
			$date=date('Y-m-d');
      $sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
									 b.id_adm_hosp,fingreso_hosp,
									 c.id_ubipaciente,finicial,
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
					WHERE c.id_cama='".$_GET["f"]."' and c.id_adm_hosp=$idadm and c.ffinal is null" ;
				//echo $sql;
			$color="yellow";
			$boton="Liberar Cama";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['doc'];
			$return1=$_REQUEST['idadmhosp'];
			$return2=$_REQUEST['S'];
			$estado="Reservado";
			$cama=$_REQUEST['H'];
			$mensaje='Esta realizando RESERVA de la cama<strong> '.$cama.'</strong> para el paciente';
			$form1='formulariosHOSP/ver_cama.php';
			$subtitulo='';
		break;
		case 'OCP':
		$c=$_REQUEST['f'];
      $sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,nom_completo,
									 b.id_adm_hosp,fingreso_hosp,
									 c.id_ubipaciente,finicial,
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
					WHERE c.id_cama=$c and ffinal is null" ;
			$color="yellow";
			$boton="Liberar Cama";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['doc'];
			$return1=$_REQUEST['idadmhosp'];
			$return2=$_REQUEST['S'];
			$estado="Libre";
			$cama=$_REQUEST['H'];
			$mensaje='Está LIBERANDO la cama '.$cama;
			$form1='formulariosHOSP/liberar_cama.php';
			$subtitulo='';
		break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"",
				"tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"",
				"hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id_ubipaciente"=>"","nom_cama"=>"","nom_hab"=>"","nom_pabellon"=>"",
				"nom_piso"=>"","finicial"=>"","ffinal"=>"","total_deestancia"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"",
				"tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"",
				"hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id_ubipaciente"=>"","nom_cama"=>"","nom_hab"=>"","nom_pabellon"=>"",
				"nom_piso"=>"","finicial"=>"","ffinal"=>"","total_deestancia"=>"");
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
<section class="panel-body">
		<a class="btn btn-primary" href="<?php echo PROGRAMA.'?doc='.$_REQUEST['doc'].'&buscar=Consultar&opcion=22';?>"><span class="glyphicon glyphicon-triangle-left">Regresar a consultar paciente</span></a>
</section>
<br>
<section class="panel panel-default">
	<section class="panel-heading">
		<h3>Ubicación física y traslado de habitaciones</h3>
	</section>
		<section class="panel-body">
			<?php
				$sede=$_REQUEST['sede'];
				if ($sede==2) {
					?>
						<section class="panel-body">
							<div class="col-md-12 text-center">
									<button data-toggle="collapse" class="btn btn-primary text-center col-md-12" data-target="#uca">
										<article class="col-md-2">
											<span class="fa fa-hospital-o fa-4x"></span>
										</article>
										<article class="col-md-6">
											<hgroup>
												<h3>UCA</h3>
												<h4>Clínica Facatativá</h4>
											</hgroup>
										</article>
										<article class="col-md-4">
											<dl><i><strong>PABELLONES</strong></i>
												<dd>Femenino</dd>
												<dd>Masculino</dd>
											</dl>
										</article>
									</button>
							</div>
							<section id="uca" class="collapse">
								<table class="table table-bordered">
									<thead class="thead-inverse ">
										<tr>
											<th class="text-center danger">ID</th>
											<th class="text-center danger">UBICACION</th>
											<th class="text-center danger">PACIENTE<br>ACTUAL</th>
											<th class="text-center danger"></th>
										</tr>
									</thead>
									<?php
									$sql="SELECT c.id_sedes_ips,
															 d.id_cama idc,nom_cama,estado_cama,
															 e.nom_hab,
															 f.nom_pabellon,
															 g.nom_piso
											FROM sedes_ips c 	INNER JOIN piso g on g.id_sedes_ips=c.id_sedes_ips
																				INNER JOIN pabellon f on f.id_piso=g.id_piso
																				INNER JOIN habitacion e on e.id_pabellon=f.id_pabellon
																				INNER JOIN cama d on d.id_habitacion=e.id_habitacion
											WHERE  g.id_piso='1' ";
											//echo $sql;
											if ($tabla=$bd1->sub_tuplas($sql) ){
												foreach ($tabla as $fila ) {
													$doc=$_REQUEST['doc'];
													$idadmhosp=$_REQUEST['idadmhosp'];
													$sede=$_REQUEST['sede'];
													if ($fila['estado_cama']=='Ocupado') {
														echo"<tr >\n";
														echo'<td class="text-center alert alert-danger">
																		<label>'.$fila["idc"].'</label>
																 </td>';
														echo'<td class="text-center alert-danger">
																		<p><strong>Piso/Pabellon: </strong>'.$fila["nom_piso"].'--'.$fila["nom_pabellon"].'</p>
																		<p><strong>Habitacion/Cama: </strong>'.$fila["nom_hab"].'-'.$fila["nom_cama"].'</p>
																 </td>';
														echo'<td class="text-center alert-danger">';
														$cama=$fila['idc'];
		 															$sql_2="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,nom_completo,
																							 b.id_adm_hosp,fingreso_hosp,
																							 c.id_ubipaciente,finicial,ffinal,
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
																			WHERE c.id_cama=$cama and ffinal is null and b.estado_adm_hosp='Activo'";

																			if ($tabla_2=$bd1->sub_tuplas($sql_2) ){
																				foreach ($tabla_2 as $fila_2 ) {
																					echo'<p><strong>'.$fila_2["nom_completo"].' </strong></p>
																							 <p><img src="'.$fila_2["fotopac"].'"alt ="foto" class="img-rounded" width="60" data-toggle="modal" data-target="#modalpac"></p>';
																				}
																			}
		 												echo'</td>';
														echo'<th class="text-center alert-danger">
																	<article class="col-md-12">
																		<p>Esta cama se encuentra <strong>OCUPADA</strong> desea	</p>
																	</article>
																	<article class="col-md-12">
																		<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=OCP&idadmhosp='.$idadmhosp.'&doc='.$doc.'&f='.$fila['idc'].'&H='.$fila['nom_hab'].'--'.$fila['nom_cama'].'&S='.$sede.'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-ban fa-1x"></span> Liberar cama</button></a></p>
																	</article>
																 </th>';
														echo"</tr >\n";
														echo"<tr >\n";
														echo"<td class='alert alert primary' colspan='4'></td >\n";
														echo"</tr >\n";
													}
													if ($fila['estado_cama']=='Libre') {
														echo"<tr >\n";
														echo'<td class="text-center alert alert-success">
																		<label>'.$fila["idc"].'</label>
																 </td>';
														echo'<td class="text-center alert-success">
																		<p><strong>Piso/Pabellon: </strong>'.$fila["nom_piso"].'--'.$fila["nom_pabellon"].'</p>
																		<p><strong>Habitacion/Cama: </strong>'.$fila["nom_hab"].'-'.$fila["nom_cama"].'</p>
																 </td>';
														echo'<th class="text-center alert alert-success" colspan="3">
																	<p>Esta cama se encuentra <strong>LIBRE</strong> desea:	</p>
																	<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$idadmhosp.'&doc='.$doc.'&f='.$fila['idc'].'&H='.$fila['nom_hab'].'--'.$fila['nom_cama'].'&P='.$fila['nom_piso'].'--'.$fila['nom_pabellon'].'&S='.$sede.'&servicio=Hospitalario"><button type="button" class="btn btn-success" ><span class="fa fa-check-circle fa-2x"></span> Ubicar Paciente</button></a></p>
																 </th>';
														echo"</tr >\n";
														echo"<tr >\n";
														echo"<td class='alert alert primary' colspan='4'></td >\n";
														echo"</tr >\n";
													}
												}
											}
								?>
								</table>
							</section>
						</section>

						<section class="panel-body">
							<div class="col-md-12 text-center">
									<button data-toggle="collapse" class="btn btn-primary text-center col-md-12" data-target="#p1">
										<article class="col-md-2">
											<span class="fa fa-hospital-o fa-4x"></span>
										</article>
										<article class="col-md-6">
											<hgroup>
												<h3>PISO 1</h3>
												<h4>Clínica Facatativá</h4>
											</hgroup>
										</article>
										<article class="col-md-4">
											<dl><i><strong>PABELLONES</strong></i>
												<dd>AVD mixto</dd>
												<dd>Mujeres</dd>
											</dl>
										</article>
									</button>
							</div>
							<section id="p1" class="collapse">
								<table class="table table-bordered">
									<thead class="thead-inverse ">
										<tr>
											<th class="text-center danger">ID</th>
											<th class="text-center danger">UBICACION</th>
											<th class="text-center danger"></th>
										</tr>
									</thead>
									<?php
									$sql="SELECT c.id_sedes_ips,
															 d.id_cama idc,nom_cama,estado_cama,
															 e.nom_hab,
															 f.nom_pabellon,
															 g.nom_piso
											FROM sedes_ips c 	INNER JOIN piso g on g.id_sedes_ips=c.id_sedes_ips
																				INNER JOIN pabellon f on f.id_piso=g.id_piso
																				INNER JOIN habitacion e on e.id_pabellon=f.id_pabellon
																				INNER JOIN cama d on d.id_habitacion=e.id_habitacion
											WHERE  g.id_piso='2' ";
											//echo $sql;
											if ($tabla=$bd1->sub_tuplas($sql) ){
												foreach ($tabla as $fila ) {
													$doc=$_REQUEST['doc'];
													$idadmhosp=$_REQUEST['idadmhosp'];
													$sede=$_REQUEST['sede'];
													if ($fila['estado_cama']=='Ocupado') {
														echo"<tr >\n";
														echo'<td class="text-center alert alert-danger">
																		<label>'.$fila["idc"].'</label>
																 </td>';
														echo'<td class="text-center alert-danger">
																		<p><strong>Piso/Pabellon: </strong>'.$fila["nom_piso"].'--'.$fila["nom_pabellon"].'</p>
																		<p><strong>Habitacion/Cama: </strong>'.$fila["nom_hab"].'-'.$fila["nom_cama"].'</p>
																 </td>';
														echo'<td class="text-center alert-danger">';
														$cama=$fila['idc'];
																	$sql_2="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,nom_completo,
																							 b.id_adm_hosp,fingreso_hosp,
																							 c.id_ubipaciente,finicial,
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
																			WHERE c.id_cama=$cama and ffinal is null and b.estado_adm_hosp='Activo'";

																			if ($tabla_2=$bd1->sub_tuplas($sql_2) ){
																				foreach ($tabla_2 as $fila_2 ) {
																					echo'<p><strong>'.$fila_2["nom_completo"].' </strong></p>
																							 <p><img src="'.$fila_2["fotopac"].'"alt ="foto" class="img-rounded" width="60" data-toggle="modal" data-target="#modalpac"></p>';
																				}
																			}
														echo'</td>';
														echo'<th class="text-center alert-danger">
																	<article class="col-md-12">
																		<p>Esta cama se encuentra <strong>OCUPADA</strong> desea	</p>
																	</article>
																	<article class="col-md-12">
																		<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=OCP&idadmhosp='.$idadmhosp.'&doc='.$doc.'&f='.$fila['idc'].'&H='.$fila['nom_hab'].'--'.$fila['nom_cama'].'&S='.$sede.'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-ban fa-1x"></span> Liberar cama</button></a></p>
																	</article>
																 </th>';
														echo"</tr >\n";
														echo"<tr >\n";
														echo"<td class='alert alert primary' colspan='4'></td >\n";
														echo"</tr >\n";
													}
													if ($fila['estado_cama']=='Libre') {
														echo"<tr >\n";
														echo'<td class="text-center alert alert-success">
																		<label>'.$fila["idc"].'</label>
																 </td>';
														echo'<td class="text-center alert-success">
																		<p><strong>Piso/Pabellon: </strong>'.$fila["nom_piso"].'--'.$fila["nom_pabellon"].'</p>
																		<p><strong>Habitacion/Cama: </strong>'.$fila["nom_hab"].'-'.$fila["nom_cama"].'</p>
																 </td>';
														echo'<th class="text-center alert alert-success" colspan="3">
																	<p>Esta cama se encuentra <strong>LIBRE</strong> desea:	</p>
																	<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$idadmhosp.'&doc='.$doc.'&f='.$fila['idc'].'&H='.$fila['nom_hab'].'--'.$fila['nom_cama'].'&P='.$fila['nom_piso'].'--'.$fila['nom_pabellon'].'&S='.$sede.'&servicio=Hospitalario"><button type="button" class="btn btn-success" ><span class="fa fa-check-circle fa-2x"></span> Ubicar Paciente</button></a></p>
																 </th>';
														echo"</tr >\n";
														echo"<tr >\n";
														echo"<td class='alert alert primary' colspan='4'></td >\n";
														echo"</tr >\n";
													}
												}
											}
								?>
								</table>
							</section>
						</section>
						<section class="panel-body">
							<div class="col-md-12 text-center">
									<button data-toggle="collapse" class="btn btn-primary text-center col-md-12" data-target="#p2">
										<article class="col-md-2">
											<span class="fa fa-hospital-o fa-4x"></span>
										</article>
										<article class="col-md-6">
											<hgroup>
												<h3>PISO 2</h3>
												<h4>Clínica Facatativá</h4>
											</hgroup>
										</article>
										<article class="col-md-4">
											<dl><i><strong>PABELLONES</strong></i>
												<dd>Cronico Masculino NO AVD</dd>
												<dd>Hombres</dd>
											</dl>
										</article>
									</button>
							</div>
							<section id="p2" class="collapse">
								<table class="table table-bordered">
									<thead class="thead-inverse ">
										<tr>
											<th class="text-center danger">ID</th>
											<th class="text-center danger">UBICACION</th>
											<th class="text-center danger"></th>
										</tr>
									</thead>
									<?php
									$sql="SELECT c.id_sedes_ips,
															 d.id_cama idc,nom_cama,estado_cama,
															 e.nom_hab,
															 f.nom_pabellon,
															 g.nom_piso
											FROM sedes_ips c 	INNER JOIN piso g on g.id_sedes_ips=c.id_sedes_ips
																				INNER JOIN pabellon f on f.id_piso=g.id_piso
																				INNER JOIN habitacion e on e.id_pabellon=f.id_pabellon
																				INNER JOIN cama d on d.id_habitacion=e.id_habitacion
											WHERE  g.id_piso='3' ";
											//echo $sql;
											if ($tabla=$bd1->sub_tuplas($sql) ){
												foreach ($tabla as $fila ) {
													$doc=$_REQUEST['doc'];
													$idadmhosp=$_REQUEST['idadmhosp'];
													$sede=$_REQUEST['sede'];
													if ($fila['estado_cama']=='Ocupado') {
														echo"<tr >\n";
														echo'<td class="text-center alert alert-danger">
																		<label>'.$fila["idc"].'</label>
																 </td>';
														echo'<td class="text-center alert-danger">
																		<p><strong>Piso/Pabellon: </strong>'.$fila["nom_piso"].'--'.$fila["nom_pabellon"].'</p>
																		<p><strong>Habitacion/Cama: </strong>'.$fila["nom_hab"].'-'.$fila["nom_cama"].'</p>
																 </td>';
														echo'<td class="text-center alert-danger">';
														$cama=$fila['idc'];
		 															$sql_2="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,nom_completo,
																							 b.id_adm_hosp,fingreso_hosp,
																							 c.id_ubipaciente,finicial,
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
																			WHERE c.id_cama=$cama and ffinal is null and b.estado_adm_hosp='Activo'";

																			if ($tabla_2=$bd1->sub_tuplas($sql_2) ){
																				foreach ($tabla_2 as $fila_2 ) {
																					echo'<p><strong>'.$fila_2["nom_completo"].' </strong></p>
																							 <p><img src="'.$fila_2["fotopac"].'"alt ="foto" class="img-rounded" width="60" data-toggle="modal" data-target="#modalpac"></p>';
																				}
																			}
		 												echo'</td>';
														echo'<th class="text-center alert-danger">
																	<article class="col-md-12">
																		<p>Esta cama se encuentra <strong>OCUPADA</strong> desea	</p>
																	</article>
																	<article class="col-md-12">
																		<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=OCP&idadmhosp='.$idadmhosp.'&doc='.$doc.'&f='.$fila['idc'].'&H='.$fila['nom_hab'].'--'.$fila['nom_cama'].'&S='.$sede.'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-ban fa-1x"></span> Liberar cama</button></a></p>
																	</article>
																 </th>';
														echo"</tr >\n";
														echo"<tr >\n";
														echo"<td class='alert alert primary' colspan='4'></td >\n";
														echo"</tr >\n";
													}
													if ($fila['estado_cama']=='Libre') {
														echo"<tr >\n";
														echo'<td class="text-center alert alert-success col-md-1">
																		<label>'.$fila["idc"].'</label>
																 </td>';
														echo'<td class="text-center alert-success col-md-5">
																		<p><strong>Piso/Pabellon: </strong>'.$fila["nom_piso"].'--'.$fila["nom_pabellon"].'</p>
																		<p><strong>Habitacion/Cama: </strong>'.$fila["nom_hab"].'-'.$fila["nom_cama"].'</p>
																 </td>';
														echo'<th class="text-center alert alert-success col-md-6">
																	<p>Esta cama se encuentra <strong>LIBRE</strong> desea:	</p>
																	<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$idadmhosp.'&doc='.$doc.'&f='.$fila['idc'].'&H='.$fila['nom_hab'].'--'.$fila['nom_cama'].'&P='.$fila['nom_piso'].'--'.$fila['nom_pabellon'].'&S='.$sede.'&servicio=Hospitalario"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-check-circle fa-2x"></span> Ubicar Paciente</button></a></p>
																 </th>';
														echo"</tr >\n";
														echo"<tr >\n";
														echo"<td class='alert alert primary' colspan='3'></td >\n";
														echo"</tr >\n";
													}
												}
											}
								?>
								</table>
							</section>
						</section>
						<section class="panel-body">
							<div class="col-md-12 text-center">
									<button data-toggle="collapse" class="btn btn-primary text-center col-md-12" data-target="#p3">
										<article class="col-md-2">
											<span class="fa fa-hospital-o fa-4x"></span>
										</article>
										<article class="col-md-6">
											<hgroup>
												<h3>PISO 3</h3>
												<h4>Clínica Facatativá</h4>
											</hgroup>
										</article>
										<article class="col-md-4">
											<dl><i><strong>PABELLONES</strong></i>
												<dd>VIP</dd>
											</dl>
										</article>
									</button>
							</div>
							<section id="p3" class="collapse">
								<table class="table table-bordered">
									<thead class="thead-inverse ">
										<tr>
											<th class="text-center danger">ID</th>
											<th class="text-center danger">UBICACION</th>
											<th class="text-center danger"></th>
										</tr>
									</thead>
									<?php
									$sql="SELECT c.id_sedes_ips,
															 d.id_cama idc,nom_cama,estado_cama,
															 e.nom_hab,
															 f.nom_pabellon,
															 g.nom_piso
											FROM sedes_ips c 	INNER JOIN piso g on g.id_sedes_ips=c.id_sedes_ips
																				INNER JOIN pabellon f on f.id_piso=g.id_piso
																				INNER JOIN habitacion e on e.id_pabellon=f.id_pabellon
																				INNER JOIN cama d on d.id_habitacion=e.id_habitacion
											WHERE  g.id_piso='4' ";
											//echo $sql;
											if ($tabla=$bd1->sub_tuplas($sql) ){
												foreach ($tabla as $fila ) {
													$doc=$_REQUEST['doc'];
													$idadmhosp=$_REQUEST['idadmhosp'];
													$sede=$_REQUEST['sede'];
													if ($fila['estado_cama']=='Ocupado') {
														echo"<tr >\n";
														echo'<td class="text-center alert alert-danger">
																		<label>'.$fila["idc"].'</label>
																 </td>';
														echo'<td class="text-center alert-danger">
																		<p><strong>Piso/Pabellon: </strong>'.$fila["nom_piso"].'--'.$fila["nom_pabellon"].'</p>
																		<p><strong>Habitacion/Cama: </strong>'.$fila["nom_hab"].'-'.$fila["nom_cama"].'</p>
																 </td>';
														echo'<td class="text-center alert-danger">';
														$cama=$fila['idc'];
																	$sql_2="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,nom_completo,
																							 b.id_adm_hosp,fingreso_hosp,
																							 c.id_ubipaciente,finicial,
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
																			WHERE c.id_cama=$cama and ffinal is null and b.estado_adm_hosp='Activo'";

																			if ($tabla_2=$bd1->sub_tuplas($sql_2) ){
																				foreach ($tabla_2 as $fila_2 ) {
																					echo'<p><strong>'.$fila_2["nom_completo"].' </strong></p>
																							 <p><img src="'.$fila_2["fotopac"].'"alt ="foto" class="img-rounded" width="60" data-toggle="modal" data-target="#modalpac"></p>';
																				}
																			}
														echo'</td>';
														echo'<th class="text-center alert-danger">
																	<article class="col-md-12">
																		<p>Esta cama se encuentra <strong>OCUPADA</strong> desea	</p>
																	</article>
																	<article class="col-md-12">
																		<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=OCP&idadmhosp='.$idadmhosp.'&doc='.$doc.'&f='.$fila['idc'].'&H='.$fila['nom_hab'].'--'.$fila['nom_cama'].'&S='.$sede.'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-ban fa-1x"></span> Liberar cama</button></a></p>
																	</article>
																 </th>';
														echo"</tr >\n";
														echo"<tr >\n";
														echo"<td class='alert alert primary' colspan='4'></td >\n";
														echo"</tr >\n";
													}
													if ($fila['estado_cama']=='Libre') {
														echo"<tr >\n";
														echo'<td class="text-center alert alert-success col-md-1">
																		<label>'.$fila["idc"].'</label>
																 </td>';
														echo'<td class="text-center alert-success col-md-5">
																		<p><strong>Piso/Pabellon: </strong>'.$fila["nom_piso"].'--'.$fila["nom_pabellon"].'</p>
																		<p><strong>Habitacion/Cama: </strong>'.$fila["nom_hab"].'-'.$fila["nom_cama"].'</p>
																 </td>';
														echo'<th class="text-center alert alert-success col-md-6">
																	<p>Esta cama se encuentra <strong>LIBRE</strong> desea:	</p>
																	<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$idadmhosp.'&doc='.$doc.'&f='.$fila['idc'].'&H='.$fila['nom_hab'].'--'.$fila['nom_cama'].'&P='.$fila['nom_piso'].'--'.$fila['nom_pabellon'].'&S='.$sede.'&servicio=Hospitalario"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-check-circle fa-2x"></span> Ubicar Paciente</button></a></p>
																 </th>';
														echo"</tr >\n";
														echo"<tr >\n";
														echo"<td class='alert alert primary' colspan='3'></td >\n";
														echo"</tr >\n";
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

			<?php
				$sede=$_REQUEST['sede'];
				if ($sede==8) {
					?>
						<section class="panel-body">
							<div class="col-md-12 text-center">
									<button data-toggle="collapse" class="btn btn-primary text-center col-md-12" data-target="#uca">
										<article class="col-md-2">
											<span class="fa fa-hospital-o fa-4x"></span>
										</article>
										<article class="col-md-6">
											<hgroup>
												<h3>UCA</h3>
												<h4>Clínica Bogotá</h4>
											</hgroup>
										</article>
										<article class="col-md-4">
											<dl><i><strong>PABELLONES</strong></i>
												<dd>UCA</dd>
											</dl>
										</article>
									</button>
							</div>
							<section id="uca" class="collapse">
								<table class="table table-bordered">
									<thead class="thead-inverse ">
										<tr>
											<th class="text-center danger">ID</th>
					            <th class="text-center danger">UBICACION</th>
											<th class="text-center danger"></th>
					          </tr>
									</thead>
									<?php
									$sql="SELECT c.id_sedes_ips,
															 d.id_cama idc,nom_cama,estado_cama,
															 e.nom_hab,
															 f.nom_pabellon,
															 g.nom_piso
											FROM sedes_ips c 	INNER JOIN piso g on g.id_sedes_ips=c.id_sedes_ips
											 									INNER JOIN pabellon f on f.id_piso=g.id_piso
																				INNER JOIN habitacion e on e.id_pabellon=f.id_pabellon
																				INNER JOIN cama d on d.id_habitacion=e.id_habitacion
											WHERE  g.id_piso='8' ";
											//echo $sql;
											if ($tabla=$bd1->sub_tuplas($sql) ){
												foreach ($tabla as $fila ) {
													$doc=$_REQUEST['doc'];
													$idadmhosp=$_REQUEST['idadmhosp'];
													$sede=$_REQUEST['sede'];
													if ($fila['estado_cama']=='Ocupado') {
														echo"<tr >\n";
														echo'<td class="text-center alert alert-danger">
																		<label>'.$fila["idc"].'</label>
																 </td>';
														echo'<td class="text-center alert-danger">
																		<p><strong>Piso/Pabellon: </strong>'.$fila["nom_piso"].'--'.$fila["nom_pabellon"].'</p>
																		<p><strong>Habitacion/Cama: </strong>'.$fila["nom_hab"].'-'.$fila["nom_cama"].'</p>
																 </td>';
														echo'<td class="text-center alert-danger">';
														$cama=$fila['idc'];
																	$sql_2="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,nom_completo,
																							 b.id_adm_hosp,fingreso_hosp,
																							 c.id_ubipaciente,finicial,
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
																			WHERE c.id_cama=$cama and ffinal is null and b.estado_adm_hosp='Activo'";

																			if ($tabla_2=$bd1->sub_tuplas($sql_2) ){
																				foreach ($tabla_2 as $fila_2 ) {
																					echo'<p><strong>'.$fila_2["nom_completo"].' </strong></p>
																							 <p><img src="'.$fila_2["fotopac"].'"alt ="foto" class="img-rounded" width="60" data-toggle="modal" data-target="#modalpac"></p>';
																				}
																			}
														echo'</td>';
														echo'<th class="text-center alert-danger">
																	<article class="col-md-12">
																		<p>Esta cama se encuentra <strong>OCUPADA</strong> desea	</p>
																	</article>
																	<article class="col-md-12">
																		<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=OCP&idadmhosp='.$idadmhosp.'&doc='.$doc.'&f='.$fila['idc'].'&H='.$fila['nom_hab'].'--'.$fila['nom_cama'].'&S='.$sede.'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-ban fa-1x"></span> Liberar cama</button></a></p>
																	</article>
																 </th>';
														echo"</tr >\n";
														echo"<tr >\n";
														echo"<td class='alert alert primary' colspan='4'></td >\n";
														echo"</tr >\n";
													}
													if ($fila['estado_cama']=='Libre') {
														echo"<tr >\n";
														echo'<td class="text-center alert alert-success col-md-1">
																		<label>'.$fila["idc"].'</label>
																 </td>';
														echo'<td class="text-center alert-success col-md-5">
																		<p><strong>Piso/Pabellon: </strong>'.$fila["nom_piso"].'--'.$fila["nom_pabellon"].'</p>
																		<p><strong>Habitacion/Cama: </strong>'.$fila["nom_hab"].'-'.$fila["nom_cama"].'</p>
																 </td>';
														echo'<th class="text-center alert alert-success col-md-6">
																	<p>Esta cama se encuentra <strong>LIBRE</strong> desea:	</p>
																	<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$idadmhosp.'&doc='.$doc.'&f='.$fila['idc'].'&H='.$fila['nom_hab'].'--'.$fila['nom_cama'].'&P='.$fila['nom_piso'].'--'.$fila['nom_pabellon'].'&S='.$sede.'&servicio=Hospitalario"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-check-circle fa-2x"></span> Ubicar Paciente</button></a></p>
																 </th>';
														echo"</tr >\n";
														echo"<tr >\n";
														echo"<td class='alert alert primary' colspan='3'></td >\n";
														echo"</tr >\n";
													}
												}
											}
								?>
								</table>
							</section>
						</section>

						<section class="panel-body">
							<div class="col-md-12 text-center">
									<button data-toggle="collapse" class="btn btn-primary text-center col-md-12" data-target="#p1">
										<article class="col-md-2">
											<span class="fa fa-hospital-o fa-4x"></span>
										</article>
										<article class="col-md-6">
											<hgroup>
												<h3>PISO 1</h3>
												<h4>Clínica Bogotá</h4>
											</hgroup>
										</article>
										<article class="col-md-4">
											<dl><i><strong>PABELLONES</strong></i>
												<dd>Intermedios</dd>
											</dl>
										</article>
									</button>
							</div>
							<section id="p1" class="collapse">
								<table class="table table-bordered">
									<thead class="thead-inverse ">
										<tr>
											<th class="text-center danger">ID</th>
											<th class="text-center danger">UBICACION</th>
											<th class="text-center danger"></th>
										</tr>
									</thead>
									<?php
									$sql="SELECT c.id_sedes_ips,
															 d.id_cama idc,nom_cama,estado_cama,
															 e.nom_hab,
															 f.nom_pabellon,
															 g.nom_piso
											FROM sedes_ips c 	INNER JOIN piso g on g.id_sedes_ips=c.id_sedes_ips
																				INNER JOIN pabellon f on f.id_piso=g.id_piso
																				INNER JOIN habitacion e on e.id_pabellon=f.id_pabellon
																				INNER JOIN cama d on d.id_habitacion=e.id_habitacion
											WHERE  g.id_piso='5' ";
											//echo $sql;
											if ($tabla=$bd1->sub_tuplas($sql) ){
												foreach ($tabla as $fila ) {
													$doc=$_REQUEST['doc'];
													$idadmhosp=$_REQUEST['idadmhosp'];
													$sede=$_REQUEST['sede'];
													if ($fila['estado_cama']=='Ocupado') {
														echo"<tr >\n";
														echo'<td class="text-center alert alert-danger">
																		<label>'.$fila["idc"].'</label>
																 </td>';
														echo'<td class="text-center alert-danger">
																		<p><strong>Piso/Pabellon: </strong>'.$fila["nom_piso"].'--'.$fila["nom_pabellon"].'</p>
																		<p><strong>Habitacion/Cama: </strong>'.$fila["nom_hab"].'-'.$fila["nom_cama"].'</p>
																 </td>';
														echo'<td class="text-center alert-danger">';
														$cama=$fila['idc'];
																	$sql_2="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,nom_completo,
																							 b.id_adm_hosp,fingreso_hosp,
																							 c.id_ubipaciente,finicial,
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
																			WHERE c.id_cama=$cama and ffinal is null and b.estado_adm_hosp='Activo'";

																			if ($tabla_2=$bd1->sub_tuplas($sql_2) ){
																				foreach ($tabla_2 as $fila_2 ) {
																					echo'<p><strong>'.$fila_2["nom_completo"].' </strong></p>
																							 <p><img src="'.$fila_2["fotopac"].'"alt ="foto" class="img-rounded" width="60" data-toggle="modal" data-target="#modalpac"></p>';
																				}
																			}
														echo'</td>';
														echo'<th class="text-center alert-danger">
																	<article class="col-md-12">
																		<p>Esta cama se encuentra <strong>OCUPADA</strong> desea	</p>
																	</article>
																	<article class="col-md-12">
																		<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=OCP&idadmhosp='.$idadmhosp.'&doc='.$doc.'&f='.$fila['idc'].'&H='.$fila['nom_hab'].'--'.$fila['nom_cama'].'&S='.$sede.'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-ban fa-1x"></span> Liberar cama</button></a></p>
																	</article>
																 </th>';
														echo"</tr >\n";
														echo"<tr >\n";
														echo"<td class='alert alert primary' colspan='4'></td >\n";
														echo"</tr >\n";
													}
													if ($fila['estado_cama']=='Libre') {
														echo"<tr >\n";
														echo'<td class="text-center alert alert-success col-md-1">
																		<label>'.$fila["idc"].'</label>
																 </td>';
														echo'<td class="text-center alert-success col-md-5">
																		<p><strong>Piso/Pabellon: </strong>'.$fila["nom_piso"].'--'.$fila["nom_pabellon"].'</p>
																		<p><strong>Habitacion/Cama: </strong>'.$fila["nom_hab"].'-'.$fila["nom_cama"].'</p>
																 </td>';
														echo'<th class="text-center alert alert-success col-md-6">
																	<p>Esta cama se encuentra <strong>LIBRE</strong> desea:	</p>
																	<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$idadmhosp.'&doc='.$doc.'&f='.$fila['idc'].'&H='.$fila['nom_hab'].'--'.$fila['nom_cama'].'&P='.$fila['nom_piso'].'--'.$fila['nom_pabellon'].'&S='.$sede.'&servicio=Hospitalario"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-check-circle fa-2x"></span> Ubicar Paciente</button></a></p>
																 </th>';
														echo"</tr >\n";
														echo"<tr >\n";
														echo"<td class='alert alert primary' colspan='3'></td >\n";
														echo"</tr >\n";
													}
												}
											}
								?>
								</table>
							</section>
						</section>
						<section class="panel-body">
							<div class="col-md-12 text-center">
									<button data-toggle="collapse" class="btn btn-primary text-center col-md-12" data-target="#p2">
										<article class="col-md-2">
											<span class="fa fa-hospital-o fa-4x"></span>
										</article>
										<article class="col-md-6">
											<hgroup>
												<h3>PISO 2</h3>
												<h4>Clínica Bogotá</h4>
											</hgroup>
										</article>
										<article class="col-md-4">
											<dl><i><strong>PABELLONES</strong></i>
												<dd>Niños y adolescentes</dd>
											</dl>
										</article>
									</button>
							</div>
							<section id="p2" class="collapse">
								<table class="table table-bordered">
									<thead class="thead-inverse ">
										<tr>
											<th class="text-center danger">ID</th>
											<th class="text-center danger">UBICACION</th>
											<th class="text-center danger"></th>
										</tr>
									</thead>
									<?php
									$sql="SELECT c.id_sedes_ips,
															 d.id_cama idc,nom_cama,estado_cama,
															 e.nom_hab,
															 f.nom_pabellon,
															 g.nom_piso
											FROM sedes_ips c 	INNER JOIN piso g on g.id_sedes_ips=c.id_sedes_ips
																				INNER JOIN pabellon f on f.id_piso=g.id_piso
																				INNER JOIN habitacion e on e.id_pabellon=f.id_pabellon
																				INNER JOIN cama d on d.id_habitacion=e.id_habitacion
											WHERE  g.id_piso='6' ";
											//echo $sql;
											if ($tabla=$bd1->sub_tuplas($sql) ){
												foreach ($tabla as $fila ) {
													$doc=$_REQUEST['doc'];
													$idadmhosp=$_REQUEST['idadmhosp'];
													$sede=$_REQUEST['sede'];
													if ($fila['estado_cama']=='Ocupado') {
														echo"<tr >\n";
														echo'<td class="text-center alert alert-danger">
																		<label>'.$fila["idc"].'</label>
																 </td>';
														echo'<td class="text-center alert-danger">
																		<p><strong>Piso/Pabellon: </strong>'.$fila["nom_piso"].'--'.$fila["nom_pabellon"].'</p>
																		<p><strong>Habitacion/Cama: </strong>'.$fila["nom_hab"].'-'.$fila["nom_cama"].'</p>
																 </td>';
														echo'<td class="text-center alert-danger">';
														$cama=$fila['idc'];
		 															$sql_2="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,nom_completo,
																							 b.id_adm_hosp,fingreso_hosp,
																							 c.id_ubipaciente,finicial,
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
																			WHERE c.id_cama=$cama and ffinal is null and b.estado_adm_hosp='Activo'";

																			if ($tabla_2=$bd1->sub_tuplas($sql_2) ){
																				foreach ($tabla_2 as $fila_2 ) {
																					echo'<p><strong>'.$fila_2["nom_completo"].' </strong></p>
																							 <p><img src="'.$fila_2["fotopac"].'"alt ="foto" class="img-rounded" width="60" data-toggle="modal" data-target="#modalpac"></p>';
																				}
																			}
		 												echo'</td>';
														echo'<th class="text-center alert-danger">
																	<article class="col-md-12">
																		<p>Esta cama se encuentra <strong>OCUPADA</strong> desea	</p>
																	</article>
																	<article class="col-md-12">
																		<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=OCP&idadmhosp='.$idadmhosp.'&doc='.$doc.'&f='.$fila['idc'].'&H='.$fila['nom_hab'].'--'.$fila['nom_cama'].'&S='.$sede.'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-ban fa-1x"></span> Liberar cama</button></a></p>
																	</article>
																 </th>';
														echo"</tr >\n";
														echo"<tr >\n";
														echo"<td class='alert alert primary' colspan='4'></td >\n";
														echo"</tr >\n";
													}
													if ($fila['estado_cama']=='Libre') {
														echo"<tr >\n";
														echo'<td class="text-center alert alert-success col-md-1">
																		<label>'.$fila["idc"].'</label>
																 </td>';
														echo'<td class="text-center alert-success col-md-5">
																		<p><strong>Piso/Pabellon: </strong>'.$fila["nom_piso"].'--'.$fila["nom_pabellon"].'</p>
																		<p><strong>Habitacion/Cama: </strong>'.$fila["nom_hab"].'-'.$fila["nom_cama"].'</p>
																 </td>';
														echo'<th class="text-center alert alert-success col-md-6">
																	<p>Esta cama se encuentra <strong>LIBRE</strong> desea:	</p>
																	<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$idadmhosp.'&doc='.$doc.'&f='.$fila['idc'].'&H='.$fila['nom_hab'].'--'.$fila['nom_cama'].'&P='.$fila['nom_piso'].'--'.$fila['nom_pabellon'].'&S='.$sede.'&servicio=Hospitalario"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-check-circle fa-2x"></span> Ubicar Paciente</button></a></p>
																 </th>';
														echo"</tr >\n";
														echo"<tr >\n";
														echo"<td class='alert alert primary' colspan='3'></td >\n";
														echo"</tr >\n";
													}
												}
											}
								?>
								</table>
							</section>
						</section>
						<section class="panel-body">
							<div class="col-md-12 text-center">
									<button data-toggle="collapse" class="btn btn-primary text-center col-md-12" data-target="#p3">
										<article class="col-md-2">
											<span class="fa fa-hospital-o fa-4x"></span>
										</article>
										<article class="col-md-6">
											<hgroup>
												<h3>PISO 3</h3>
												<h4>Clínica Bogotá</h4>
											</hgroup>
										</article>
										<article class="col-md-4">
											<dl><i><strong>PABELLONES</strong></i>
												<dd>Adultos</dd>
											</dl>
										</article>
									</button>
							</div>
							<section id="p3" class="collapse">
								<table class="table table-bordered">
									<thead class="thead-inverse ">
										<tr>
											<th class="text-center danger">ID</th>
											<th class="text-center danger">UBICACION</th>
											<th class="text-center danger"></th>
										</tr>
									</thead>
									<?php
									$sql="SELECT c.id_sedes_ips,
															 d.id_cama idc,nom_cama,estado_cama,
															 e.nom_hab,
															 f.nom_pabellon,
															 g.nom_piso
											FROM sedes_ips c 	INNER JOIN piso g on g.id_sedes_ips=c.id_sedes_ips
																				INNER JOIN pabellon f on f.id_piso=g.id_piso
																				INNER JOIN habitacion e on e.id_pabellon=f.id_pabellon
																				INNER JOIN cama d on d.id_habitacion=e.id_habitacion
											WHERE  g.id_piso='7' ";
											//echo $sql;
											if ($tabla=$bd1->sub_tuplas($sql) ){
												foreach ($tabla as $fila ) {
													$doc=$_REQUEST['doc'];
													$idadmhosp=$_REQUEST['idadmhosp'];
													$sede=$_REQUEST['sede'];
													if ($fila['estado_cama']=='Ocupado') {
														echo"<tr >\n";
														echo'<td class="text-center alert alert-danger">
																		<label>'.$fila["idc"].'</label>
																 </td>';
														echo'<td class="text-center alert-danger">
																		<p><strong>Piso/Pabellon: </strong>'.$fila["nom_piso"].'--'.$fila["nom_pabellon"].'</p>
																		<p><strong>Habitacion/Cama: </strong>'.$fila["nom_hab"].'-'.$fila["nom_cama"].'</p>
																 </td>';
														echo'<td class="text-center alert-danger">';
														$cama=$fila['idc'];
																	$sql_2="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,nom_completo,
																							 b.id_adm_hosp,fingreso_hosp,
																							 c.id_ubipaciente,finicial,
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
																			WHERE c.id_cama=$cama and ffinal is null and b.estado_adm_hosp='Activo'";

																			if ($tabla_2=$bd1->sub_tuplas($sql_2) ){
																				foreach ($tabla_2 as $fila_2 ) {
																					echo'<p><strong>'.$fila_2["nom_completo"].' </strong></p>
																							 <p><img src="'.$fila_2["fotopac"].'"alt ="foto" class="img-rounded" width="60" data-toggle="modal" data-target="#modalpac"></p>';
																				}
																			}
														echo'</td>';
														echo'<th class="text-center alert-danger">
																	<article class="col-md-12">
																		<p>Esta cama se encuentra <strong>OCUPADA</strong> desea	</p>
																	</article>
																	<article class="col-md-12">
																		<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=OCP&idadmhosp='.$idadmhosp.'&doc='.$doc.'&f='.$fila['idc'].'&H='.$fila['nom_hab'].'--'.$fila['nom_cama'].'&S='.$sede.'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-ban fa-1x"></span> Liberar cama</button></a></p>
																	</article>
																 </th>';
														echo"</tr >\n";
														echo"<tr >\n";
														echo"<td class='alert alert primary' colspan='4'></td >\n";
														echo"</tr >\n";
													}
													if ($fila['estado_cama']=='Libre') {
														echo"<tr >\n";
														echo'<td class="text-center alert alert-success col-md-1">
																		<label>'.$fila["idc"].'</label>
																 </td>';
														echo'<td class="text-center alert-success col-md-5">
																		<p><strong>Piso/Pabellon: </strong>'.$fila["nom_piso"].'--'.$fila["nom_pabellon"].'</p>
																		<p><strong>Habitacion/Cama: </strong>'.$fila["nom_hab"].'-'.$fila["nom_cama"].'</p>
																 </td>';
														echo'<th class="text-center alert alert-success col-md-6">
																	<p>Esta cama se encuentra <strong>LIBRE</strong> desea:	</p>
																	<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$idadmhosp.'&doc='.$doc.'&f='.$fila['idc'].'&H='.$fila['nom_hab'].'--'.$fila['nom_cama'].'&P='.$fila['nom_piso'].'--'.$fila['nom_pabellon'].'&S='.$sede.'&servicio=Hospitalario"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-check-circle fa-2x"></span> Ubicar Paciente</button></a></p>
																 </th>';
														echo"</tr >\n";
														echo"<tr >\n";
														echo"<td class='alert alert primary' colspan='3'></td >\n";
														echo"</tr >\n";
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

		</section>
</section>
	<?php
}
?>
