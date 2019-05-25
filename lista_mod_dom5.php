
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
			case 'PSICO':
			$horaInicial=$_POST["hreg"];
			$horat= strtotime ( '+40 minute' , strtotime ( $horaInicial ) ) ;
			$ht=date('H:i',$horat);
				$sql="UPDATE evo_psico_dom
				SET freg_evopsico_dom='".$_POST["freg"]."',hreg_evopsico_dom='".$_POST["hreg"]."',
				evolucionpsico_dom='".$_POST["evolucion"]."', estado_evopsico_dom='".$_POST['estado']."'
				WHERE id_evopsico_dom=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'FONO':
			$horaInicial=$_POST["hreg"];
			$horat= strtotime ( '+40 minute' , strtotime ( $horaInicial ) ) ;
			$ht=date('H:i',$horat);
				$sql="UPDATE evo_fono_dom
				SET freg_evofono_dom='".$_POST["freg"]."',hreg_evofono_dom='".$_POST["hreg"]."',hfin_evofono_dom='".$ht."',
				evolucionfono_dom='".$_POST["evolucion"]."', estado_evofono_dom='".$_POST['estado']."'
				WHERE id_evofono_dom=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'TO':
			$horaInicial=$_POST["hreg"];
			$horat= strtotime ( '+40 minute' , strtotime ( $horaInicial ) ) ;
			$ht=date('H:i',$horat);
				$sql="UPDATE evo_to_dom
				SET freg_evoto_dom='".$_POST["freg"]."',hreg_evoto_dom='".$_POST["hreg"]."',hfin_evoto_dom='".$ht."',
				evolucionto_dom='".$_POST["evolucion"]."', estado_evoto_dom='".$_POST['estado']."'
				WHERE id_evoto_dom=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'FISIO':
			$horaInicial=$_POST["hreg"];
			$horat= strtotime ( '+40 minute' , strtotime ( $horaInicial ) ) ;
			$ht=date('H:i',$horat);
				$sql="UPDATE evo_fisio_dom
				SET freg_evofisio_dom='".$_POST["freg"]."',hreg_evofisio_dom='".$_POST["hreg"]."',hfin_evofisio_dom='".$ht."',
				evolucionfisio_dom='".$_POST["evolucion"]."', estado_evofisio_dom='".$_POST['estado']."'
				WHERE id_evofisio_dom=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'TR':
			$horaInicial=$_POST["hreg"];
			$horat= strtotime ( '+40 minute' , strtotime ( $horaInicial ) ) ;
			$ht=date('H:i',$horat);
				$sql="UPDATE evo_tr_dom
				SET freg_evotr_dom='".$_POST["freg"]."',hreg_evotr_dom='".$_POST["hreg"]."',hfin_evotr_dom='".$ht."',
				evoluciontr_dom='".$_POST["evolucion"]."' , estado_evotr_dom='".$_POST['estado']."'
				WHERE id_evotr_dom=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
				$ident=$_POST["ident"];
			break;
			case 'FISIOV':
				$sql="UPDATE val_inifisio_dom
				SET freg_fisio_dom='".$_POST["freg"]."',hreg_fisio_dom='".$_POST["hreg"]."',
				 		estado_fisio_dom='".$_POST['estado']."'
				WHERE id_fisio_dom=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
				$ident=$_POST["ident"];
			break;
			case 'FONOV':
				$sql="UPDATE val_inifono_dom
				SET freg_valini_reh='".$_POST["freg"]."',hreg_valini_reh='".$_POST["hreg"]."',
				 		estado_valini_reh='".$_POST['estado']."'
				WHERE id_valinifono_dom=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
				$ident=$_POST["ident"];
			break;
			case 'TRV':
				$sql="UPDATE val_initr_dom
				SET freg_tr_dom='".$_POST["freg"]."',hreg_tr_dom='".$_POST["hreg"]."',
				 		estado_tr_dom='".$_POST['estado']."'
				WHERE id_tr_dom=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
				$ident=$_POST["ident"];
			break;
			case 'TOV':
				$sql="UPDATE terapia_ocupacional_ce
				SET freg_to_ce='".$_POST["freg"]."',hreg_to_ce='".$_POST["hreg"]."',
				 		estado_to_ce='".$_POST['estado']."'
				WHERE id_to_ce=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
				$ident=$_POST["ident"];
			break;
			case 'MD':
				$sql="UPDATE hcini_dom
				SET freg_hchosp='".$_POST["freg"]."',hreg_hchosp='".$_POST["hreg"]."',
				 		estado_hchosp='".$_POST['estado']."'
				WHERE id_hchosp=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
				$ident=$_POST["ident"];
			break;
			case 'CDX':
				$sql="UPDATE pacientes
				SET descricie='".$_POST["dx"]."' WHERE id_paciente=".$_POST["id_paciente"];
				$subtitulo="Actualizado";
				$ident=$_POST["ident"];
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

if (isset($_GET["mante"])){
	$idevo=$_REQUEST["idevo"];
	$idadm=$_REQUEST["idadmhosp"];
	$tterapia=$_REQUEST["tterapia"];				///nivel 2
	switch ($_GET["mante"]) {
		case 'PSICO':
			$sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'PSICOLOGIA' tipo_terapia,
									e.id_evopsico_dom id, e.freg_evopsico_dom fecha_evo,e.hreg_evopsico_dom hora_evo,e.evolucionpsico_dom evolucion,e.estado_evopsico_dom estado,e.id_user id_user,
									f.nombre nombre_usuario, f.firma firmat,
									g.nom_eps eps,
									h.nom_sedes sedes

						from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
						right join evo_psico_dom e on (e.id_adm_hosp = b.id_adm_hosp)
						right join user f on (f.id_user = e.id_user)
						right join eps g on (g.id_eps = b.id_eps)
						right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
						where b.tipo_servicio = 'Domiciliarios' and e.id_evopsico_dom='".$idevo."'";
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de Evolucion PSICOLOGIA';
			$ident=$_GET["doc"];
			$f1=$_GET["f1"];
			$f2=$_GET["f2"];
			$form1='formulariosDOM/novedad.php';
			break;
		case 'FONO':
			$sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FONOAUDIOLOGIA' tipo_terapia,
										e.id_evofono_dom id, e.freg_evofono_dom fecha_evo,e.hreg_evofono_dom hora_evo,e.evolucionfono_dom evolucion,e.estado_evofono_dom estado,e.id_user id_user,
										f.nombre nombre_usuario, f.firma firmat,
										g.nom_eps eps,
										h.nom_sedes sedes

						from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
						right join evo_fono_dom e on (e.id_adm_hosp = b.id_adm_hosp)
						right join user f on (f.id_user = e.id_user)
						right join eps g on (g.id_eps = b.id_eps)
						right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
						where b.tipo_servicio = 'Domiciliarios' and e.id_evofono_dom='".$idevo."'";
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de Evolucion FONOAUDIOLOGIA';
			$ident=$_GET["doc"];
			$f1=$_GET["f1"];
			$f2=$_GET["f2"];
			$form1='formulariosDOM/novedad.php';
			break;
		case 'TO':
			$sql="select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA OCUPACIONAL' tipo_terapia,
e.id_evoto_dom id, e.freg_evoto_dom fecha_evo,e.hreg_evoto_dom hora_evo,e.evolucionto_dom evolucion,e.estado_evoto_dom estado,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat,
g.nom_eps eps,
h.nom_sedes sedes

from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join evo_to_dom e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
where b.tipo_servicio = 'Domiciliarios' and e.id_evoto_dom='".$idevo."'";
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de Evolucion TERAPIA OCUPACIONAL';
			$ident=$_GET["doc"];
			$f1=$_GET["f1"];
			$f2=$_GET["f2"];
			$form1='formulariosDOM/novedad.php';

			break;

			case 'FISIO':

					$sql="select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
e.id_evofisio_dom id, e.freg_evofisio_dom fecha_evo,e.hreg_evofisio_dom hora_evo,e.evolucionfisio_dom evolucion,e.estado_evofisio_dom estado,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat,
g.nom_eps eps,
h.nom_sedes sedes

from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join evo_fisio_dom e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
where b.tipo_servicio = 'Domiciliarios' and e.id_evofisio_dom='".$idevo."'";


			$color="yellow";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y/m/d');
			$date1=date('H:i');
			$subtitulo='';
			$ident=$_GET["doc"];
			$f1=$_GET["f1"];
			$f2=$_GET["f2"];
			$form1='formulariosDOM/novedad.php';
			break;

						case 'TR':

								$sql="select
			a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA RESPIRATORIA' tipo_terapia,
			e.id_evotr_dom id, e.freg_evotr_dom fecha_evo,e.hreg_evotr_dom hora_evo,e.evoluciontr_dom evolucion,e.estado_evotr_dom estado,e.id_user id_user,
			f.nombre nombre_usuario, f.firma firmat,
			g.nom_eps eps,
			h.nom_sedes sedes

			from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
			right join evo_tr_dom e on (e.id_adm_hosp = b.id_adm_hosp)
			right join user f on (f.id_user = e.id_user)
			right join eps g on (g.id_eps = b.id_eps)
			right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
			where b.tipo_servicio = 'Domiciliarios' and e.id_evotr_dom='".$idevo."'";


						$color="yellow";
						$boton="Actualizar";
						$atributo1=' readonly="readonly"';
						$atributo2='';
						$atributo3='disabled';
						$date=date('Y/m/d');
						$date1=date('H:i');
						$subtitulo='';
						$ident=$_GET["doc"];
						$f1=$_GET["f1"];
						$f2=$_GET["f2"];
						$form1='formulariosDOM/novedad.php';
						break;

						case 'FISIOV':

								$sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIO' tipo_terapia,
														 e.id_fisio_dom id, e.freg_fisio_dom fecha_evo,e.hreg_fisio_dom hora_evo,e.estado_fisio_dom estado,e.id_user id_user,
														 f.nombre nombre_usuario, f.firma firmat,
														 g.nom_eps eps,
														 h.nom_sedes sedes

									FROM pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
																	 right join val_inifisio_dom e on (e.id_adm_hosp = b.id_adm_hosp)
																	 right join user f on (f.id_user = e.id_user)
																	 right join eps g on (g.id_eps = b.id_eps)
																	 right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
									WHERE b.tipo_servicio = 'Domiciliarios' and e.id_fisio_dom='".$idevo."'";


						$color="yellow";
						$boton="Actualizar";
						$atributo1=' readonly="readonly"';
						$atributo2='';
						$atributo3='disabled';
						$date=date('Y/m/d');
						$date1=date('H:i');
						$subtitulo='';
						$ident=$_GET["doc"];
						$f1=$_GET["f1"];
						$f2=$_GET["f2"];
						$form1='formulariosDOM/novedad.php';
						break;
						case 'FONOV':

								$sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIO' tipo_terapia,
														e.id_valinifono_dom id, e.freg_valinifono_dom fecha_evo,e.hreg_valinifono_dom hora_evo,e.estado_valini_fono estado,e.id_user id_user,
													 f.nombre nombre_usuario, f.firma firmat ,
													 g.nom_eps eps,
													 h.nom_sedes sedes
													FROM pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
													right join val_inifono_dom e on (e.id_adm_hosp = b.id_adm_hosp)
													right join user f on (f.id_user = e.id_user)
													right join eps g on (g.id_eps = b.id_eps)
													right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
									WHERE b.tipo_servicio = 'Domiciliarios' and e.id_valinifono_dom='".$idevo."'";


						$color="yellow";
						$boton="Actualizar";
						$atributo1=' readonly="readonly"';
						$atributo2='';
						$atributo3='disabled';
						$date=date('Y/m/d');
						$date1=date('H:i');
						$subtitulo='';
						$ident=$_GET["doc"];
						$f1=$_GET["f1"];
						$f2=$_GET["f2"];
						$form1='formulariosDOM/novedad.php';
						break;
						case 'TRV':

								$sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA RESPIRATORIA V' tipo_terapia,
														 e.id_tr_dom id, e.freg_tr_dom fecha_evo,e.hreg_tr_dom hora_evo,e.estado_tr_dom estado,e.id_user id_user,
														 f.nombre nombre_usuario, f.firma firmat ,
														 g.nom_eps eps,
														 h.nom_sedes sedes
														FROM pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
														right join val_initr_dom e on (e.id_adm_hosp = b.id_adm_hosp)
														right join user f on (f.id_user = e.id_user)
														right join eps g on (g.id_eps = b.id_eps)
														right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
									WHERE b.tipo_servicio = 'Domiciliarios' and e.id_tr_dom='".$idevo."'";


						$color="yellow";
						$boton="Actualizar";
						$atributo1=' readonly="readonly"';
						$atributo2='';
						$atributo3='disabled';
						$date=date('Y/m/d');
						$date1=date('H:i');
						$subtitulo='';
						$ident=$_GET["doc"];
						$f1=$_GET["f1"];
						$f2=$_GET["f2"];
						$form1='formulariosDOM/novedad.php';
						break;
						case 'TOV':
						$sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIO' tipo_terapia,
											e.id_to_ce id, e.freg_to_ce fecha_evo,e.hreg_to_ce hora_evo,'VALORACION INICIAL TERAPIA OCUPACIONAL' evolucion,e.estado_to_ce estado,e.id_user id_user,
										 f.nombre nombre_usuario, f.firma firmat ,
										 g.nom_eps eps,
										 h.nom_sedes sedes
										FROM pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
										right join terapia_ocupacional_ce e on (e.id_adm_hosp = b.id_adm_hosp)
										right join user f on (f.id_user = e.id_user)
										right join eps g on (g.id_eps = b.id_eps)
										right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
							WHERE b.tipo_servicio = 'Domiciliarios' and e.id_to_ce='".$idevo."'";
						$color="yellow";
						$boton="Actualizar";
						$atributo1=' readonly="readonly"';
						$atributo2='';
						$atributo3='disabled';
						$date=date('Y/m/d');
						$date1=date('H:i');
						$subtitulo='';
						$ident=$_GET["doc"];
						$f1=$_GET["f1"];
						$f2=$_GET["f2"];
						$form1='formulariosDOM/novedad.php';
						break;
						case 'MD':
						$sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'MEDICINA GENERAL' tipo_terapia,
						 e.id_hchosp id, e.freg_hchosp fecha_evo,e.hreg_hchosp hora_evo,'HC MEDICINA GENERAL DOMICILIARIOS' evolucion,e.estado_hchosp estado,e.id_user id_user,
						 f.nombre nombre_usuario, f.firma firmat,
						 g.nom_eps eps ,
						 h.nom_sedes sedes
						from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
						right join hcini_dom e on (e.id_adm_hosp = b.id_adm_hosp)
						right join user f on (f.id_user = e.id_user)
						right join eps g on (g.id_eps = b.id_eps)
						right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
							WHERE b.tipo_servicio = 'Domiciliarios' and e.id_hchosp='".$idevo."'";
						$color="yellow";
						$boton="Actualizar";
						$atributo1=' readonly="readonly"';
						$atributo2='';
						$atributo3='disabled';
						$date=date('Y/m/d');
						$date1=date('H:i');
						$subtitulo='';
						$ident=$_GET["doc"];
						$f1=$_GET["f1"];
						$f2=$_GET["f2"];
						$form1='formulariosDOM/novedad.php';
						break;
						case 'CDX':
						$sql="SELECT id_paciente,doc_pac,nom1,nom2,ape1,ape2,descricie
										FROM pacientes
							WHERE doc_pac='".$_GET['doc']."'";
						$color="yellow";
						$boton="Actualizar";
						$atributo1=' readonly="readonly"';
						$atributo2='';
						$atributo3='disabled';
						$date=date('Y/m/d');
						$date1=date('H:i');
						$subtitulo='';
						$ident=$_GET["doc"];
						$f1=$_GET["fecha1"];
						$f2=$_GET["fecha2"];
						$form1='formulariosDOM/cdxdom.php';
						break;
		}

//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_paciente"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","descricie"=>"",
				"id_adm_hosp"=>"" ,"id"=>"" ,"fecha_evo"=>"" ,"hora_evo"=>"" ,"evolucion"=>"","estado"=>"");

			}
		}else{
			$fila=array("id_paciente"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","descricie"=>"",
			"id_adm_hosp"=>"" ,"id"=>"" ,"fecha_evo"=>"" ,"hora_evo"=>"" ,"evolucion"=>"","estado"=>"");
			}

		?>

		<?php include($form1);?>
<?php
}else{
	echo '<div class="alert alert-success animated bounceInRight">';
	echo $subtitulo;
	echo '</div>';
// nivel 1?>
<section class="panel panel-default">
	<section class="panel-heading">
		<h2>Novedades Servicio Domiciliarios</h2>
	</section>
	<section class="panel-body">
		<section class="panel panel-default" class="col-xs-12" >
				<section class="panel-body col-md-12">
					<form>
						<div class="row">
						  <div class="col-lg-4 col-xs-4 col-md-4" >
								<div class="input-group">
								  <span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
								  <input type="date" class="form-control" name="fecha1" aria-describedby="basic-addon1">
								</div>
						  </div>
							<div class="col-lg-4 col-xs-4 col-md-4" >
								<div class="input-group">
								  <span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
								  <input type="date" class="form-control" name="fecha2" aria-describedby="basic-addon1">
								</div>
						  </div>
						  <div class="col-lg-4 col-xs-4 col-md-4" >
						    <div class="input-group">
						      <input type="text" class="form-control" placeholder="Digite identificacion" name="doc">
						      <span class="input-group-btn">
										<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
										<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
						      </span>
						    </div>
						  </div>
						</div>
					</form>
				</section>
				<section class="panel-body">

					<table class="table table-bordered">
						<tr>
							<td>DX:</td>
							<?php
							$doc1=$_REQUEST['doc'];
								$sqlA="SELECT id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,descricie
								FROM pacientes
								WHERE doc_pac='".$doc1."'";

								if ($tablaA=$bd1->sub_tuplas($sqlA)){
									foreach ($tablaA as $filaA ) {
										echo'<td colspan="3">
													<p>'.$filaA['descricie'].'</p>
												 </td>';
										echo'<td colspan="2">
													<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CDX&doc='.$_REQUEST["doc"].'&fecha1='.$_REQUEST["fecha1"].'&fecha2='.$_REQUEST["fecha2"].'">
													<button type="button" class="btn btn-success sombra_movil" >
													<span class="fa fa-edit"></span> Cambio de diagnostico</button></a></td>';
									}
								}
							 ?>
						</tr>
						<tr>
							<th class="info text-center">PACIENTE</th>
							<th class="info text-center">TIPO TERAPIA</th>
							<th class="info text-center">FECHA EVOLUCION</th>
							<th class="info text-center">EVOLUCION</th>
							<th class="info text-center">PROFESIONAL</th>
							<th class="info text-center"></th>
						</tr>

					<?php
					if (isset($_REQUEST["doc"])){
					$doc=$_REQUEST["doc"];
					$f1=$_REQUEST["fecha1"];
					$f2=$_REQUEST["fecha2"];

					$sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente,
												 b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
												 e.id_evofisio_dom id, e.freg_evofisio_dom fecha_evo,e.hreg_evofisio_dom hora_evo,e.evolucionfisio_dom evolucion,e.estado_evofisio_dom estado,e.id_user id_user,
												 f.nombre nombre_usuario, f.firma firmat,
												 g.nom_eps eps,
												 h.nom_sedes sedes

					FROM pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
					right join evo_fisio_dom e on (e.id_adm_hosp = b.id_adm_hosp)
					right join user f on (f.id_user = e.id_user)
					right join eps g on (g.id_eps = b.id_eps)
					right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
					WHERE b.tipo_servicio = 'Domiciliarios' and a.doc_pac='".$doc."' and e.freg_evofisio_dom BETWEEN '".$f1."' and '".$f2."'

					UNION

					SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA V' tipo_terapia,
					 e.id_fisio_dom id, e.freg_fisio_dom fecha_evo,e.hreg_fisio_dom hora_evo,'VALORACION INICIAL FISIOTERAPIA' evolucion,e.estado_fisio_dom estado,e.id_user id_user,
					 f.nombre nombre_usuario, f.firma firmat ,
					 g.nom_eps eps,
					 h.nom_sedes sedes
					FROM pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
					right join val_inifisio_dom e on (e.id_adm_hosp = b.id_adm_hosp)
					right join user f on (f.id_user = e.id_user)
					right join eps g on (g.id_eps = b.id_eps)
					right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

					WHERE b.tipo_servicio = 'Domiciliarios' and a.doc_pac='".$doc."' and e.freg_fisio_dom BETWEEN '".$f1."' and '".$f2."'

					UNION

					SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FONOAUDIOLOGIA V' tipo_terapia,
					 e.id_valinifono_dom id, e.freg_valinifono_dom fecha_evo,e.hreg_valinifono_dom hora_evo,'VALORACION INICIAL FONOAUDIOLOGIA' evolucion,e.estado_valinifono_dom estado,e.id_user id_user,
					 f.nombre nombre_usuario, f.firma firmat ,
					 g.nom_eps eps,
					 h.nom_sedes sedes
					FROM pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
					right join val_inifono_dom e on (e.id_adm_hosp = b.id_adm_hosp)
					right join user f on (f.id_user = e.id_user)
					right join eps g on (g.id_eps = b.id_eps)
					right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

					WHERE b.tipo_servicio = 'Domiciliarios' and a.doc_pac='".$doc."' and e.freg_valinifono_dom BETWEEN '".$f1."' and '".$f2."'

					UNION

					SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA RESPIRATORIA V' tipo_terapia,
					 e.id_tr_dom id, e.freg_tr_dom fecha_evo,e.hreg_tr_dom hora_evo,'VALORACION INICIAL TERAPIA RESPIRATORIA' evolucion,e.estado_tr_dom estado,e.id_user id_user,
					 f.nombre nombre_usuario, f.firma firmat ,
					 g.nom_eps eps,
					 h.nom_sedes sedes
					FROM pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
					right join val_initr_dom e on (e.id_adm_hosp = b.id_adm_hosp)
					right join user f on (f.id_user = e.id_user)
					right join eps g on (g.id_eps = b.id_eps)
					right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

					WHERE b.tipo_servicio = 'Domiciliarios' and a.doc_pac='".$doc."' and e.freg_tr_dom BETWEEN '".$f1."' and '".$f2."'

					UNION

					SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA OCUPACIONAL V' tipo_terapia,
					 e.id_to_ce id, e.freg_to_ce fecha_evo,e.hreg_to_ce hora_evo,'VALORACION INICIAL TERAPIA OCUPACIONAL' evolucion,e.estado_to_ce estado,e.id_user id_user,
					 f.nombre nombre_usuario, f.firma firmat ,
					 g.nom_eps eps,
					 h.nom_sedes sedes
					FROM pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
					right join terapia_ocupacional_ce e on (e.id_adm_hosp = b.id_adm_hosp)
					right join user f on (f.id_user = e.id_user)
					right join eps g on (g.id_eps = b.id_eps)
					right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

					WHERE b.tipo_servicio = 'Domiciliarios' and a.doc_pac='".$doc."' and e.freg_to_ce BETWEEN '".$f1."' and '".$f2."'

					UNION

					SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA OCUPACIONAL' tipo_terapia,
					 e.id_evoto_dom id, e.freg_evoto_dom fecha_evo,e.hreg_evoto_dom hora_evo,e.evolucionto_dom evolucion,e.estado_evoto_dom estado,e.id_user id_user,
					 f.nombre nombre_usuario, f.firma firmat ,
					 g.nom_eps eps,
					 h.nom_sedes sedes
					FROM pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
					right join evo_to_dom e on (e.id_adm_hosp = b.id_adm_hosp)
					right join user f on (f.id_user = e.id_user)
					right join eps g on (g.id_eps = b.id_eps)
					right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

					WHERE b.tipo_servicio = 'Domiciliarios' and a.doc_pac='".$doc."' and e.freg_evoto_dom BETWEEN '".$f1."' and '".$f2."'

					UNION

					SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FONOAUDIOLOGIA' tipo_terapia,
					 e.id_evofono_dom id, e.freg_evofono_dom fecha_evo,e.hreg_evofono_dom hora_evo,e.evolucionfono_dom evolucion,e.estado_evofono_dom estado,e.id_user id_user,
					 f.nombre nombre_usuario, f.firma firmat ,
					 g.nom_eps eps,
					 h.nom_sedes sedes
					from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
					right join evo_fono_dom e on (e.id_adm_hosp = b.id_adm_hosp)
					right join user f on (f.id_user = e.id_user)
					right join eps g on (g.id_eps = b.id_eps)
					right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

					where b.tipo_servicio = 'Domiciliarios' and a.doc_pac='".$doc."' and e.freg_evofono_dom BETWEEN '".$f1."' and '".$f2."'

					UNION

					select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'PSICOLOGIA' tipo_terapia,
					 e.id_evopsico_dom id, e.freg_evopsico_dom fecha_evo,e.hreg_evopsico_dom hora_evo,e.evolucionpsico_dom evolucion,e.estado_evopsico_dom estado,e.id_user id_user,
					 f.nombre nombre_usuario, f.firma firmat,
					 g.nom_eps eps ,
					 h.nom_sedes sedes
					from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
					right join evo_psico_dom e on (e.id_adm_hosp = b.id_adm_hosp)
					right join user f on (f.id_user = e.id_user)
					right join eps g on (g.id_eps = b.id_eps)
					right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

					where b.tipo_servicio = 'Domiciliarios' and a.doc_pac='".$doc."' and e.freg_evopsico_dom BETWEEN '".$f1."' and '".$f2."'

					UNION

					select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA RESPIRATORIA' tipo_terapia,
					 e.id_evotr_dom id, e.freg_evotr_dom fecha_evo,e.hreg_evotr_dom hora_evo,e.evoluciontr_dom evolucion,e.estado_evotr_dom estado,e.id_user id_user,
					 f.nombre nombre_usuario, f.firma firmat,
					 g.nom_eps eps ,
					 h.nom_sedes sedes
					from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
					right join evo_tr_dom e on (e.id_adm_hosp = b.id_adm_hosp)
					right join user f on (f.id_user = e.id_user)
					right join eps g on (g.id_eps = b.id_eps)
					right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

					where b.tipo_servicio = 'Domiciliarios' and a.doc_pac='".$doc."' and e.freg_evotr_dom BETWEEN '".$f1."' and '".$f2."'

					UNION

					select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'MEDICINA GENERAL' tipo_terapia,
					 e.id_hchosp id, e.freg_hchosp fecha_evo,e.hreg_hchosp hora_evo,'HC MEDICINA GENERAL DOMICILIARIOS' evolucion,e.estado_hchosp estado,e.id_user id_user,
					 f.nombre nombre_usuario, f.firma firmat,
					 g.nom_eps eps ,
					 h.nom_sedes sedes
					from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
					right join hcini_dom e on (e.id_adm_hosp = b.id_adm_hosp)
					right join user f on (f.id_user = e.id_user)
					right join eps g on (g.id_eps = b.id_eps)
					right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

					where b.tipo_servicio = 'Domiciliarios' and a.doc_pac='".$doc."' and e.freg_hchosp BETWEEN '".$f1."' and '".$f2."'
					order by 7,9 ASC


					";
				//echo $sql;
					if ($tabla=$bd1->sub_tuplas($sql)){

						foreach ($tabla as $fila ) {
							if ($fila['estado']=='Cancelada') {
								echo"<tr >\n";
								echo'<td class="text-center alert alert-danger">
											<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
											<p>DI: '.$fila["doc_pac"].'</p>
										 </td>';
								echo'<td class="text-center alert alert-danger">
											<p><strong>'.$fila["tipo_terapia"].'</strong></p>
											<p>'.$fila["id"].'</p>
										 </td>';
								echo'<td class="text-center alert alert-danger">'.$fila["fecha_evo"].'<br>'.$fila["hora_evo"].'</td>';
								echo'<td class="text-justify alert alert-danger">'.$fila["evolucion"].'</td>';
								echo'<td class="text-center alert alert-danger">'.$fila["nombre_usuario"].'</td>';
								$edad=$fila["doc_pac"];
								$cie=$fila["descricie"];

								if ($fila["tipo_terapia"]=='FISIOTERAPIA') {
									echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=FISIO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
								}
								if ($fila["tipo_terapia"]=='TERAPIA OCUPACIONAL') {
									echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
								}
								if ($fila["tipo_terapia"]=='FONOAUDIOLOGIA') {
									echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=FONO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
								}
								if ($fila["tipo_terapia"]=='PSICOLOGIA') {
									echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PSICO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
								}
								if ($fila["tipo_terapia"]=='TERAPIA RESPIRATORIA') {
									echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TR&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
								}
								if ($fila["tipo_terapia"]=='FISIOTERAPIA V') {
									echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=FISIOV&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
								}
								if ($fila["tipo_terapia"]=='TERAPIA OCUPACIONAL V') {
									echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TOV&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
								}
								if ($fila["tipo_terapia"]=='FONOAUDIOLOGIA V') {
									echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=FONOV&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
								}
								if ($fila["tipo_terapia"]=='PSICOLOGIA V') {
									echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PSICOV&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
								}
								if ($fila["tipo_terapia"]=='TERAPIA RESPIRATORIA V') {
									echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TRV&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
								}
								if ($fila["tipo_terapia"]=='MEDICINA GENERAL') {
									echo'<th class="text-center ">
												<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MD&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
												<button type="button" class="btn btn-danger sombra_movil" >
													<span class="fa fa-edit"></span>
													</button>
												</a>
											 </th>';
								}
								echo "</tr>\n";
							}else {
								echo"<tr >\n";
								echo'<td class="text-center">
											<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
											<p>DI: '.$fila["doc_pac"].'</p>
										 </td>';
								echo'<td class="text-center">
											<p class=" text-primary"><strong>'.$fila["tipo_terapia"].'</strong></p>
											<p>'.$fila["id"].'</p>
										 </td>';
								echo'<td class="text-center">'.$fila["fecha_evo"].'<br>'.$fila["hora_evo"].'</td>';
								echo'<td class="text-justify">'.$fila["evolucion"].'</td>';
								echo'<td class="text-center">'.$fila["nombre_usuario"].'</td>';
								$edad=$fila["doc_pac"];
								$cie=$fila["descricie"];

								if ($fila["tipo_terapia"]=='FISIOTERAPIA') {
									echo'<th class="text-center">
												<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=FISIO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
												<button type="button" class="btn btn-danger sombra_movil" >
												<span class="fa fa-edit"></span>
												</button>
												</a>
											 </th>';
								}
								if ($fila["tipo_terapia"]=='TERAPIA OCUPACIONAL') {
									echo'<th class="text-center">
												<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
													<button type="button" class="btn btn-danger sombra_movil" >
													<span class="fa fa-edit"></span>
													</button>
												</a>
											 </th>';
								}
								if ($fila["tipo_terapia"]=='FONOAUDIOLOGIA') {
									echo'<th class="text-center ">
												<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=FONO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
												<button type="button" class="btn btn-danger sombra_movil" >
												<span class="fa fa-edit"></span>
												</button>
												</a>
											 </th>';
								}
								if ($fila["tipo_terapia"]=='PSICOLOGIA') {
									echo'<th class="text-center ">
												<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PSICO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
												<button type="button" class="btn btn-danger sombra_movil" >
													<span class="fa fa-edit"></span>
													</button>
												</a>
											 </th>';
								}
								if ($fila["tipo_terapia"]=='TERAPIA RESPIRATORIA') {
									echo'<th class="text-center ">
												<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TR&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
												<button type="button" class="btn btn-danger sombra_movil" >
													<span class="fa fa-edit"></span>
													</button>
												</a>
											 </th>';
								}
								if ($fila["tipo_terapia"]=='FISIOTERAPIA V') {
									echo'<th class="text-center">
												<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=FISIOV&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
												<button type="button" class="btn btn-danger sombra_movil" >
													<span class="fa fa-edit"></span>
													</button>
												</a>
											 </th>';
								}
								if ($fila["tipo_terapia"]=='TERAPIA OCUPACIONAL V') {
									echo'<th class="text-center">
												<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TOV&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
													<button type="button" class="btn btn-danger sombra_movil" >
													<span class="fa fa-edit"></span>
													</button>
												</a>
											 </th>';
								}
								if ($fila["tipo_terapia"]=='FONOAUDIOLOGIA V') {
									echo'<th class="text-center ">
												<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=FONOV&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
												<button type="button" class="btn btn-danger sombra_movil" >
													<span class="fa fa-edit"></span>
													</button>
												</a>
											 </th>';
								}
								if ($fila["tipo_terapia"]=='PSICOLOGIA V') {
									echo'<th class="text-center ">
												<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PSICOV&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
												<button type="button" class="btn btn-danger sombra_movil" >
													<span class="fa fa-edit"></span>
													</button>
												</a>
											 </th>';
								}
								if ($fila["tipo_terapia"]=='TERAPIA RESPIRATORIA V') {
									echo'<th class="text-center ">
												<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TRV&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
												<button type="button" class="btn btn-danger sombra_movil" >
													<span class="fa fa-edit"></span>
													</button>
												</a>
											 </th>';
								}
								if ($fila["tipo_terapia"]=='MEDICINA GENERAL') {
									echo'<th class="text-center ">
												<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MD&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
												<button type="button" class="btn btn-danger sombra_movil" >
													<span class="fa fa-edit"></span>
													</button>
												</a>
											 </th>';
								}
								echo "</tr>\n";
							}

						}
					}
				}

					?>
					<tr>
						<td colspan="6">
							<button data-toggle="collapse" class="btn btn-primary text-center" data-target="#fisio">Contador de evoluciones <span class="glyphicon glyphicon-arrow-down"></span> </button>
							<section id="fisio" class="collapse">
								<table class="table table-bordered">
									<tr>
										<th colspan="2" class="text-center">FISIOTERAPIA</th>
										<th colspan="2" class="text-center">FONOAUDIOLOGIA</th>
										<th colspan="2" class="text-center">OCUPACIONAL</th>
										<th colspan="2" class="text-center">RESPIRATORIA</th>
									</tr>
									<tr>
										<th class="text-center danger"><small>EVOLUCION</small></th>
										<th class="text-center info"><small>VALORACION</small></th>
										<th class="text-center danger"><small>EVOLUCION</small></th>
										<th class="text-center info"><small>VALORACION</small></th>
										<th class="text-center danger"><small>EVOLUCION</small></th>
										<th class="text-center info"><small>VALORACION</small></th>
										<th class="text-center danger"><small>EVOLUCION</small></th>
										<th class="text-center info"><small>VALORACION</small></th>
									</tr>
									<tr>
										<td class="text-center">
										<?php
										$id=$fila['id_adm_hosp'];
										$sql1="SELECT  count(b.id_adm_hosp) cuantas
										from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
																		 left join evo_fisio_dom e on (e.id_adm_hosp = b.id_adm_hosp)
										where b.id_adm_hosp='".$id."'  and e.estado_evofisio_dom='Realizada'
																									 and e.freg_evofisio_dom between '".$f1."' and '".$f2."'
										group by b.id_adm_hosp
										";
										//echo $sql1;
										if ($tabla=$bd1->sub_tuplas($sql1)){
											foreach ($tabla as $fila1 ) {
												echo $fila1["cuantas"];
											}
										}else {
											echo'0';
										}
										 ?>
									 	</td>
										<td class="text-center">
										<?php
										$id=$fila['id_adm_hosp'];
										$sql1="SELECT  count(b.id_adm_hosp) cuantas
										from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
																		 inner join val_inifisio_dom e on (e.id_adm_hosp = b.id_adm_hosp)
										where b.id_adm_hosp='".$id."'  and e.estado_fisio_dom='Realizada' and e.freg_fisio_dom between '".$f1."' and '".$f2."'
										group by b.id_adm_hosp
										";
										//echo $sql1;
										if ($tabla=$bd1->sub_tuplas($sql1)){
											foreach ($tabla as $fila1 ) {
												echo $fila1["cuantas"];
											}
										}else {
											echo'0';
										}
										 ?>
									 	</td>

										<td class="text-center">
										<?php
										$id=$fila['id_adm_hosp'];
										$sql1="SELECT  count(b.id_adm_hosp) cuantas
										from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
																		 left join evo_fono_dom e on (e.id_adm_hosp = b.id_adm_hosp)
										where b.id_adm_hosp='".$id."' and e.estado_evofono_dom='Realizada'
																									 and e.freg_evofono_dom BETWEEN '".$f1."' and '".$f2."'
										group by b.id_adm_hosp
										";
										//echo $sql1;
										if ($tabla=$bd1->sub_tuplas($sql1)){
											foreach ($tabla as $fila1 ) {
												echo $fila1["cuantas"];
											}
										}else {
											echo'0';
										}
										 ?>
									 	</td>
										<td class="text-center">
										<?php
										$id=$fila['id_adm_hosp'];
										$sql1="SELECT  count(b.id_adm_hosp) cuantas
										from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
																		 inner join val_inifono_dom e on (e.id_adm_hosp = b.id_adm_hosp)
										where b.id_adm_hosp='".$id."'  and e.estado_fono_dom='Realizada' and e.freg_fono_dom between '".$f1."' and '".$f2."'
										group by b.id_adm_hosp
										";
										//echo $sql1;
										if ($tabla=$bd1->sub_tuplas($sql1)){
											foreach ($tabla as $fila1 ) {
												echo $fila1["cuantas"];
											}
										}else {
											echo'0';
										}
										 ?>
									 	</td>

										<td class="text-center">
										<?php
										$id=$fila['id_adm_hosp'];
										$sql1="SELECT  count(b.id_adm_hosp) cuantas
										from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
																		 left join evo_to_dom e on (e.id_adm_hosp = b.id_adm_hosp)
										where b.id_adm_hosp='".$id."'  and e.estado_evoto_dom='Realizada'
																									 and e.freg_evoto_dom between '".$f1."' and '".$f2."'
										group by b.id_adm_hosp
										";
										//echo $sql1;
										if ($tabla=$bd1->sub_tuplas($sql1)){
											foreach ($tabla as $fila1 ) {
												echo $fila1["cuantas"];
											}
										}else {
											echo'0';
										}
										 ?>
									 	</td>
										<td class="text-center">
										<?php
										$id=$fila['id_adm_hosp'];
										$sql1="SELECT  count(b.id_adm_hosp) cuantas
										from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
																		 inner join terapia_ocupacional_ce e on (e.id_adm_hosp = b.id_adm_hosp)
										where b.id_adm_hosp='".$id."'  and e.estado_to_ce='Realizada' and e.freg_to_ce between '".$f1."' and '".$f2."'
										group by b.id_adm_hosp
										";
										//echo $sql1;
										if ($tabla=$bd1->sub_tuplas($sql1)){
											foreach ($tabla as $fila1 ) {
												echo $fila1["cuantas"];
											}
										}else {
											echo'0';
										}
										 ?>
									 	</td>

										<td class="text-center">
										<?php
										$id=$fila['id_adm_hosp'];
										$sql1="SELECT  count(b.id_adm_hosp) cuantas
										from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
																		 left join evo_tr_dom e on (e.id_adm_hosp = b.id_adm_hosp)
										where b.id_adm_hosp='".$id."'  and e.estado_evotr_dom='Realizada'
																									 and e.freg_evotr_dom between '".$f1."' and '".$f2."'
										group by b.id_adm_hosp
										";
										//echo $sql1;
										if ($tabla=$bd1->sub_tuplas($sql1)){
											foreach ($tabla as $fila1 ) {
												echo $fila1["cuantas"];
											}
										}else {
											echo'0';
										}
										 ?>
									 	</td>
										<td class="text-center">
										<?php
										$id=$fila['id_adm_hosp'];
										$sql1="SELECT  count(b.id_adm_hosp) cuantas
										from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
																		 inner join val_initr_dom e on (e.id_adm_hosp = b.id_adm_hosp)
										where b.id_adm_hosp='".$id."'  and e.estado_tr_dom='Realizada' and e.freg_tr_dom between '".$f1."' and '".$f2."'
										group by b.id_adm_hosp
										";
										//echo $sql1;
										if ($tabla=$bd1->sub_tuplas($sql1)){
											foreach ($tabla as $fila1 ) {
												echo $fila1["cuantas"];
											}
										}else {
											echo'0';
										}
										 ?>
									 	</td>

									</tr>


								</table>
							</section>
						</td>
					</tr>
				</table>
				</section>
	</section>
</section>
	<?php
}
?>
