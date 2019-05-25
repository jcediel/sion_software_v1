
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
				$sql="UPDATE evo_psico_reh SET freg_evopsico_reh='".$_POST["freg"]."',hreg_evopsico_reh='".$_POST["hreg"]."',evolucionpsico_reh='".$_POST["evolucion"]."' WHERE id_evopsico=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'FONO':
				$sql="UPDATE evo_fono_reh SET freg_evofono_reh='".$_POST["freg"]."',hreg_evofono_reh='".$_POST["hreg"]."',evolucionfono_reh='".$_POST["evolucion"]."' WHERE id_evofono_reh=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'TO':
				$sql="UPDATE evo_to_reh SET freg_evoto_reh='".$_POST["freg"]."',hreg_evoto_reh='".$_POST["hreg"]."',evolucionto_reh='".$_POST["evolucion"]."' WHERE id_evoto_reh=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'FISIO':
				$sql="UPDATE evo_fisio_reh SET freg_evofisio_reh='".$_POST["freg"]."',hreg_evofisio_reh='".$_POST["hreg"]."',evolucionfisio_reh='".$_POST["evolucion"]."' WHERE id_evofisio_reh=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'MUSICO':
				$sql="UPDATE evo_musico_reh SET freg_evomusico_reh='".$_POST["freg"]."',hreg_evomusico_reh='".$_POST["hreg"]."',evolucionmusico_reh='".$_POST["evolucion"]."' WHERE id_evomusico_reh=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
				$ident=$_POST["ident"];
			break;
			case 'EQUINO':
				$sql="UPDATE evo_equino_reh SET freg_evoequino_reh='".$_POST["freg"]."',hreg_evoequino_reh='".$_POST["hreg"]."',evolucionequino_reh='".$_POST["evolucion"]."' WHERE id_evoequino_reh=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'HIDRO':
				$sql="UPDATE evo_hidro_reh SET freg_evohidro_reh='".$_POST["freg"]."',hreg_evohidro_reh='".$_POST["hreg"]."',evolucionhidro_reh='".$_POST["evolucion"]."' WHERE id_evohidro_reh=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'PSICOCOG':
				$sql="UPDATE evo_psicocog_reh SET freg_evopsicocog_reh='".$_POST["freg"]."',hreg_evopsicocog_reh='".$_POST["hreg"]."',evolucionpsicocog_reh='".$_POST["evolucion"]."' WHERE id_evopsicocog_reh=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'TAP':
				$sql="UPDATE evo_tap_reh SET freg_evotap_reh='".$_POST["freg"]."',hreg_evotap_reh='".$_POST["hreg"]."',evoluciontap_reh='".$_POST["evolucion"]."' WHERE id_evotap_reh=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'ENF':
				$sql="UPDATE enfermeria_reh SET freg_nota='".$_POST["freg"]."',hreg_nota='".$_POST["hreg"]."',descripnota='".$_POST["evolucion"]."' WHERE id_enfermeria=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'SOM':
				$sql="UPDATE evo_sombra_reh SET freg_evosombra_reh='".$_POST["freg"]."',hreg_evosombra_reh='".$_POST["hreg"]."',evolucionsombra_reh='".$_POST["evolucion"]."' WHERE id_evosombra_reh=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
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
			$sql="select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'PSICOLOGIA' tipo_terapia,
e.id_evopsico id, e.freg_evopsico_reh fecha_evo,e.hreg_evopsico_reh hora_evo,e.evolucionpsico_reh evolucion,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat,
g.nom_eps eps,
h.nom_sedes sedes

from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join evo_psico_reh e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
where b.tipo_servicio = 'Rehabilitacion' and e.id_evopsico='".$idevo."'";
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de Evolucion PSICOLOGIA';
			$ident=$_GET["doc"];
			$f1=$_GET["f1"];
			$f2=$_GET["f2"];
			break;
		case 'FONO':
			$sql="select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FONOAUDIOLOGIA' tipo_terapia,
e.id_evofono_reh id, e.freg_evofono_reh fecha_evo,e.hreg_evofono_reh hora_evo,e.evolucionfono_reh evolucion,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat,
g.nom_eps eps,
h.nom_sedes sedes

from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join evo_fono_reh e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
where b.tipo_servicio = 'Rehabilitacion' and e.id_evofono_reh='".$idevo."'";
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de Evolucion FONOAUDIOLOGIA';
			$ident=$_GET["doc"];
			$f1=$_GET["f1"];
			$f2=$_GET["f2"];
			break;
		case 'TO':
			$sql="select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA OCUPACIONAL' tipo_terapia,
e.id_evoto_reh id, e.freg_evoto_reh fecha_evo,e.hreg_evoto_reh hora_evo,e.evolucionto_reh evolucion,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat,
g.nom_eps eps,
h.nom_sedes sedes

from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join evo_to_reh e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
where b.tipo_servicio = 'Rehabilitacion' and e.id_evoto_reh='".$idevo."'";
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de Evolucion TERAPIA OCUPACIONAL';
			$ident=$_GET["doc"];
			$f1=$_GET["f1"];
			$f2=$_GET["f2"];

			break;

			case 'FISIO':

					$sql="select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
e.id_evofisio_reh id, e.freg_evofisio_reh fecha_evo,e.hreg_evofisio_reh hora_evo,e.evolucionfisio_reh evolucion,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat,
g.nom_eps eps,
h.nom_sedes sedes

from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join evo_fisio_reh e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
where b.tipo_servicio = 'Rehabilitacion' and e.id_evofisio_reh='".$idevo."'";


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
			break;

						case 'MUSICO':

											$sql="select
						a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'MUSICOTERAPIA' tipo_terapia,
						e.id_evomusico_reh id, e.freg_evomusico_reh fecha_evo,e.hreg_evomusico_reh hora_evo,e.evolucionmusico_reh evolucion,e.id_user id_user,
						f.nombre nombre_usuario, f.firma firmat,
						g.nom_eps eps,
						h.nom_sedes sedes

						from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
						right join evo_musico_reh e on (e.id_adm_hosp = b.id_adm_hosp)
						right join user f on (f.id_user = e.id_user)
						right join eps g on (g.id_eps = b.id_eps)
						right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
						where b.tipo_servicio = 'Rehabilitacion' and e.id_evomusico_reh='".$idevo."'";


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
									break;
									case 'EQUINO':

														$sql="select
									a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'EQUINOTERAPIA' tipo_terapia,
									e.id_evoequino_reh id, e.freg_evoequino_reh fecha_evo,e.hreg_evoequino_reh hora_evo,e.evolucionequino_reh evolucion,e.id_user id_user,
									f.nombre nombre_usuario, f.firma firmat,
									g.nom_eps eps,
									h.nom_sedes sedes

									from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
									right join evo_equino_reh e on (e.id_adm_hosp = b.id_adm_hosp)
									right join user f on (f.id_user = e.id_user)
									right join eps g on (g.id_eps = b.id_eps)
									right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
									where b.tipo_servicio = 'Rehabilitacion' and e.id_evoequino_reh='".$idevo."'";


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
												break;
												case 'HIDRO':

																	$sql="select
												a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'HIDROTERAPIA' tipo_terapia,
												e.id_evohidro_reh id, e.freg_evohidro_reh fecha_evo,e.hreg_evohidro_reh hora_evo,e.evolucionhidro_reh evolucion,e.id_user id_user,
												f.nombre nombre_usuario, f.firma firmat,
												g.nom_eps eps,
												h.nom_sedes sedes

												from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
												right join evo_hidro_reh e on (e.id_adm_hosp = b.id_adm_hosp)
												right join user f on (f.id_user = e.id_user)
												right join eps g on (g.id_eps = b.id_eps)
												right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
												where b.tipo_servicio = 'Rehabilitacion' and e.id_evohidro_reh='".$idevo."'";


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
															break;
															case 'PSICOCOG':

																				$sql="select
															a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'PSICOLOGIA COGNITIVA' tipo_terapia,
															e.id_evopsicocog_reh id, e.freg_evopsicocog_reh fecha_evo,e.hreg_evopsicocog_reh hora_evo,e.evolucionpsicocog_reh evolucion,e.id_user id_user,
															f.nombre nombre_usuario, f.firma firmat,
															g.nom_eps eps,
															h.nom_sedes sedes

															from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
															right join evo_psicocog_reh e on (e.id_adm_hosp = b.id_adm_hosp)
															right join user f on (f.id_user = e.id_user)
															right join eps g on (g.id_eps = b.id_eps)
															right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
															where b.tipo_servicio = 'Rehabilitacion' and e.id_evopsicocog_reh='".$idevo."'";


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
																		break;
																		case 'TAP':

																							$sql="select
																		a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA ASISTIDA POR PERROS' tipo_terapia,
																		e.id_evotap_reh id, e.freg_evotap_reh fecha_evo,e.hreg_evotap_reh hora_evo,e.evoluciontap_reh evolucion,e.id_user id_user,
																		f.nombre nombre_usuario, f.firma firmat,
																		g.nom_eps eps,
																		h.nom_sedes sedes

																		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
																		right join evo_tap_reh e on (e.id_adm_hosp = b.id_adm_hosp)
																		right join user f on (f.id_user = e.id_user)
																		right join eps g on (g.id_eps = b.id_eps)
																		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
																		where b.tipo_servicio = 'Rehabilitacion' and e.id_evotap_reh='".$idevo."'";


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
																					break;
																					case 'ENF':

																										$sql="select
																					a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'ENFERMERIA' tipo_terapia,
																					e.id_enfermeria id, e.freg_nota fecha_evo,e.hreg_nota hora_evo,e.descripnota evolucion,e.id_user id_user,
																					f.nombre nombre_usuario, f.firma firmat,
																					g.nom_eps eps,
																					h.nom_sedes sedes

																					from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
																					right join enfermeria_reh e on (e.id_adm_hosp = b.id_adm_hosp)
																					right join user f on (f.id_user = e.id_user)
																					right join eps g on (g.id_eps = b.id_eps)
																					right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
																					where b.tipo_servicio = 'Rehabilitacion' and e.id_enfermeria='".$idevo."'";


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
																								break;
																								case 'SOM':

																													$sql="select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'ACOMPAÑAMIENTO SOMBRA' tipo_terapia,
																													 e.id_evosombra_reh id, e.freg_evosombra_reh fecha_evo,e.hreg_evosombra_reh hora_evo,e.evolucionsombra_reh evolucion,e.id_user id_user,
																													 f.nombre nombre_usuario, f.firma firmat,
																													 g.nom_eps eps ,
																													 h.nom_sedes sedes
																													from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
																													right join evo_sombra_reh e on (e.id_adm_hosp = b.id_adm_hosp)
																													right join user f on (f.id_user = e.id_user)
																													right join eps g on (g.id_eps = b.id_eps)
																													right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

																								where b.tipo_servicio = 'Rehabilitacion' and e.id_evosombra_reh='".$idevo."'";


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
																											break;

		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("doc_pac"=>"","nom1"=>"",' ',"nom2"=>"",' ',"ape1"=>"",' ',"ape2"=>"", "id_adm_hosp"=>"" ,"id"=>"" ,"fecha_evo"=>"" ,"hora_evo"=>"" ,"evolucion"=>"");

			}
		}else{
				$fila=array("doc_pac"=>"","nom1"=>"",' ',"nom2"=>"",' ',"ape1"=>"",' ',"ape2"=>"", "id_adm_hosp"=>"" ,"id"=>"" ,"fecha_evo"=>"" ,"hora_evo"=>"" ,"evolucion"=>"");
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


<form action="<?php echo PROGRAMA.'?&opcion=74&docu='.$ident.'&f1='.$f1.'&f2='.$f2;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<div class="botonhc"id="th-estilo1">
			<a data-toggle="collapse" class="ac" data-target="#datpac" >Datos del Paciente</a> <span class="glyphicon glyphicon-arrow-down"></span>
	</div>

		<section class="collapse" id="datpac">
			<section class="panel-body" id="secteps"><!--section de eps-->
				<article class="col-xs-3">
					<label  for="">ID:</label>
					<input type="text"  name="idadmhosp" class="form-control" value="<?php echo $fila["id_adm_hosp"];?>"<?php echo $atributo2;?>/>
				</article>
				<article class="col-xs-5">
					<label for="">Fecha y Hora Ingreso:</label>
					<input type="text" name="fhingreso" class="form-control" value="<?php echo $fila["fingreso_hosp"];?> <?php echo $fila["hingreso_hosp"];?>"<?php echo $atributo2?>/>
				</article>
				<article class="col-xs-3">
					<label for="">Tipo Usuario:</label>
					<input type="text" name="fhingreso" class="form-control" value="<?php echo $fila["tipo_usuario"];?>"<?php echo $atributo2?>/>
				</article>
				<article class="col-xs-4">
					<label for="">Tipo Afiliación:</label>
					<input type="text" name="fhingreso" class="form-control" value="<?php echo $fila["tipo_afiliacion"];?>"<?php echo $atributo2?>/>
				</article>
				<article class="col-xs-6">
					<label for="">Ocupación:</label>
					<input type="text" name="fhingreso" class="form-control" value="<?php echo $fila["ocupacion"];?>"<?php echo $atributo2?>/>
				</article>
				<article class="col-xs-6">
					<label for="">Residencia:</label>
					<input type="text" name="fhingreso" class="form-control" value="<?php echo $fila["dep_residencia"];?> <?php echo $fila["mun_residencia"];?> <?php echo $fila["zona_residencia"];?>"<?php echo $atributo2?>/>
				</article>
			</section>
			<section class="panel-body" id="sectpac"> <!--section de paciente-->
				<article class="col-xs-1">
					<label  for="">ID:</label>
					<input type="text"  name="idpaci" class="form-control" value="<?php echo $fila["id_paciente"];?>"<?php echo $atributo2;?>/>
				</article>
				<article class="col-xs-5">
					<label for="">Nombre Completo:</label>
					<input type="text" name="nompac" class="form-control text-center" value="<?php echo $fila["nom1"];?> <?php echo $fila["nom2"];?> <?php echo $fila["ape1"];?> <?php echo $fila["ape2"];?>"<?php echo $atributo3;?>/>
				</article>
				<article class="col-xs-3">
					<label for="">Identificación:</label>
					<input type="text" name="identificacion" class="form-control text-center" value="<?php echo $fila["tdoc_pac"];?> <?php echo $fila["doc_pac"];?>"<?php echo $atributo3;?>/>
					<input type="hidden" name="ident" class="form-control text-center" value="<?php echo $fila["doc_pac"];?>"<?php echo $atributo3;?>/>
				</article>
				<article class="col-xs-3">
					<label for="">Estado Civil:</label>
					<input type="text" name="nompac" class="form-control text-center" value=""<?php echo $atributo3;?>/>
				</article>
				<article class="col-xs-3">
					<label for="">Lateralidad:</label>
					<input type="text" name="nompac" class="form-control text-center" value=""<?php echo $atributo3;?>/>
				</article>
				<article class="col-xs-3">
					<label for="">Religión:</label>
					<input type="text" name="nompac" class="form-control text-center" value=""<?php echo $atributo3;?>/>
				</article>
				<article class="col-xs-3">
					<label for="">Edad:</label>
					<input type="text" name="edad" class="form-control text-center" value="<?php echo $fila["edad"];?>"<?php echo $atributo3;?>/>
				</article>

				<figure class="col-xs-6">
					<img src="<?php echo $fila["fotopac"];?>" alt ="foto" class="image_logo_admision">
				</figure>
			</section>
		</section>

	<article>
		<h4 id="th-estilot">Datos de Evolucion</h4>
	</article>
	<section class="panel-body"> <!--Anamnesis-->
		<section class="panel-body">
			<article class="col-xs-3">
				<label for="">Fecha de registro:</label>
				<input type="text" name="freg" value="<?php echo $fila["fecha_evo"] ;?>" class="form-control" >
				<input type="hidden" name="idevolucion" value="<?php echo $fila["id"] ;?>" class="form-control" >

			</article>
			<article class="col-xs-3">
				<label for="">Hora de registro</label>
				<input type="text" name="hreg" value="<?php echo $fila["hora_evo"]  ;?>" class="form-control" >
			</article>
			<article class="col-xs-5">
				<label >Evolucion: <span class="fa fa-info-circle" data-toggle="popover" title="Consolidado de la realidad del paciente" data-content=""></span></label>
				<textarea class="form-control" name="evolucion" rows="6" id="comment" ><?php echo $fila["evolucion"];?></textarea>
			</article>
	<div class="row text-center">
	  	<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>

<?php
}else{
	echo '<div class="alert alert-success animated bounceInRight">';
	echo $subtitulo;
	echo '</div>';
// nivel 1?>
<div class="panel-default">
<div class="panel-body">
	<section class="panel panel-default" class="col-xs-12" >
		<form>
			<section class="panel-body">
					<article class="col-xs-2">
						<label>Fecha inicial:</label>
						<input type="date" class="form-control" value="<?php echo $_GET["f1"];?>" name="fecha1">
					</article>
					<article class="col-xs-2">
						<label>Fecha Final:</label>
						<input type="date" class="form-control" value="<?php echo $_GET["f2"];?>" name="fecha2">
					</article>
					<article class="col-xs-2">
							<label for="">Seleccione mes:</label>
							<select class="form-control" name="mes">
								<option value="enero">enero</option>
								<option value="febrero">febrero</option>
								<option value="marzo">marzo</option>
								<option value="abril">abril</option>
								<option value="mayo">mayo</option>
								<option value="junio">junio</option>
								<option value="julio">julio</option>
								<option value="agosto">agosto</option>
								<option value="septiembre">septiembre</option>
								<option value="octubre">octubre</option>
								<option value="noviembre">noviembre</option>
								<option value="diciembre">diciembre</option>

							</select>
					</article>
					<article class="col-xs-3">
						<label for="">Numero de identificacion:</label>
							<input type="text" class="form-control" name="doc" value="<?php echo $_GET["docu"];?>" placeholder="Digite Identificacion">
					</article>
					<div class="col-xs-3">
						<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
						<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
					</div>
			</section>
	  </form>
		<section class="panel-body">
		    <a class="btn btn-primary" href="<?php echo PROGRAMA.'?opcion=166';?>">Novedades de informe mensual <span class="fa fa-mail-forward"></span></a>
		</section>
		<br>
	<table class="table table-bordered">
	<tr>
		<th id="th-estilo1">IDENTIFICACIÓN</th>
		<th id="th-estilo2">NOMBRES Y APELLIDOS</th>
		<th id="th-estilo3">TIPO TERAPIA</th>
		<th id="th-estilo3">ID EVOLUCION</th>
		<th id="th-estilo4">FECHA EVOLUCION</th>
		<th id="th-estilo4">HORA EVOLUCION</th>
		<th id="th-estilo4">EVOLUCION</th>
		<th id="th-estilo4">PROFESIONAL</th>
	</tr>

	<?php
	if (isset($_REQUEST["doc"])){
	$doc=$_REQUEST["doc"];
	$f1=$_REQUEST["fecha1"];
	$f2=$_REQUEST["fecha2"];
	$mes=$_REQUEST["mes"];
	$sql="
	select
		a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
		e.id_evofisio_reh id, e.freg_evofisio_reh fecha_evo,e.hreg_evofisio_reh hora_evo,e.evolucionfisio_reh evolucion,e.id_user id_user,
		f.nombre nombre_usuario, f.firma firmat,
		g.nom_eps eps,
		h.nom_sedes sedes

		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		right join evo_fisio_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		right join user f on (f.id_user = e.id_user)
		right join eps g on (g.id_eps = b.id_eps)
		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
		where b.tipo_servicio = 'Rehabilitacion' and a.doc_pac='".$doc."' and e.freg_evofisio_reh BETWEEN '".$f1."' and '".$f2."'

		UNION

		select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA OCUPACIONAL' tipo_terapia,
		 e.id_evoto_reh id, e.freg_evoto_reh fecha_evo,e.hreg_evoto_reh hora_evo,e.evolucionto_reh evolucion,e.id_user id_user,
		 f.nombre nombre_usuario, f.firma firmat ,
		 g.nom_eps eps,
		 h.nom_sedes sedes
		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		right join evo_to_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		right join user f on (f.id_user = e.id_user)
		right join eps g on (g.id_eps = b.id_eps)
		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

		where b.tipo_servicio = 'Rehabilitacion' and a.doc_pac='".$doc."' and e.freg_evoto_reh BETWEEN '".$f1."' and '".$f2."'

		UNION

		select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FONOAUDIOLOGIA' tipo_terapia,
		 e.id_evofono_reh id, e.freg_evofono_reh fecha_evo,e.hreg_evofono_reh hora_evo,e.evolucionfono_reh evolucion,e.id_user id_user,
		 f.nombre nombre_usuario, f.firma firmat ,
		 g.nom_eps eps,
		 h.nom_sedes sedes
		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		right join evo_fono_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		right join user f on (f.id_user = e.id_user)
		right join eps g on (g.id_eps = b.id_eps)
		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

		where b.tipo_servicio = 'Rehabilitacion' and a.doc_pac='".$doc."' and e.freg_evofono_reh BETWEEN '".$f1."' and '".$f2."'

		UNION

		select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'PSICOLOGIA' tipo_terapia,
		 e.id_evopsico id, e.freg_evopsico_reh fecha_evo,e.hreg_evopsico_reh hora_evo,e.evolucionpsico_reh evolucion,e.id_user id_user,
		 f.nombre nombre_usuario, f.firma firmat,
		 g.nom_eps eps ,
		 h.nom_sedes sedes
		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		right join evo_psico_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		right join user f on (f.id_user = e.id_user)
		right join eps g on (g.id_eps = b.id_eps)
		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

		where b.tipo_servicio = 'Rehabilitacion' and a.doc_pac='".$doc."' and e.freg_evopsico_reh BETWEEN '".$f1."' and '".$f2."'

		UNION



		select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'MUSICOTERAPIA' tipo_terapia,
		 e.id_evomusico_reh id, e.freg_evomusico_reh fecha_evo,e.hreg_evomusico_reh hora_evo,e.evolucionmusico_reh evolucion,e.id_user id_user,
		 f.nombre nombre_usuario, f.firma firmat,
		 g.nom_eps eps ,
		 h.nom_sedes sedes
		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		right join evo_musico_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		right join user f on (f.id_user = e.id_user)
		right join eps g on (g.id_eps = b.id_eps)
		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

		where b.tipo_servicio = 'Rehabilitacion' and a.doc_pac='".$doc."' and e.freg_evomusico_reh BETWEEN '".$f1."' and '".$f2."'
		UNION

		select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'EQUINOTERAPIA' tipo_terapia,
		 e.id_evoequino_reh id, e.freg_evoequino_reh fecha_evo,e.hreg_evoequino_reh hora_evo,e.evolucionequino_reh evolucion,e.id_user id_user,
		 f.nombre nombre_usuario, f.firma firmat,
		 g.nom_eps eps ,
		 h.nom_sedes sedes
		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		right join evo_equino_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		right join user f on (f.id_user = e.id_user)
		right join eps g on (g.id_eps = b.id_eps)
		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

		where b.tipo_servicio = 'Rehabilitacion' and a.doc_pac='".$doc."' and e.freg_evoequino_reh BETWEEN '".$f1."' and '".$f2."'
		UNION

		select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'HIDROTERAPIA' tipo_terapia,
		 e.id_evohidro_reh id, e.freg_evohidro_reh fecha_evo,e.hreg_evohidro_reh hora_evo,e.evolucionhidro_reh evolucion,e.id_user id_user,
		 f.nombre nombre_usuario, f.firma firmat,
		 g.nom_eps eps ,
		 h.nom_sedes sedes
		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		right join evo_hidro_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		right join user f on (f.id_user = e.id_user)
		right join eps g on (g.id_eps = b.id_eps)
		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

		where b.tipo_servicio = 'Rehabilitacion' and a.doc_pac='".$doc."' and e.freg_evohidro_reh BETWEEN '".$f1."' and '".$f2."'
		UNION

		select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'PSICOLOGIA COGNITIVA' tipo_terapia,
		 e.id_evopsicocog_reh id, e.freg_evopsicocog_reh fecha_evo,e.hreg_evopsicocog_reh hora_evo,e.evolucionpsicocog_reh evolucion,e.id_user id_user,
		 f.nombre nombre_usuario, f.firma firmat,
		 g.nom_eps eps ,
		 h.nom_sedes sedes
		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		right join evo_psicocog_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		right join user f on (f.id_user = e.id_user)
		right join eps g on (g.id_eps = b.id_eps)
		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

		where b.tipo_servicio = 'Rehabilitacion' and a.doc_pac='".$doc."' and e.freg_evopsicocog_reh BETWEEN '".$f1."' and '".$f2."'
		UNION

		select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA ASISTIDA POR PERROS' tipo_terapia,
		 e.id_evotap_reh id, e.freg_evotap_reh fecha_evo,e.hreg_evotap_reh hora_evo,e.evoluciontap_reh evolucion,e.id_user id_user,
		 f.nombre nombre_usuario, f.firma firmat,
		 g.nom_eps eps ,
		 h.nom_sedes sedes
		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		right join evo_tap_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		right join user f on (f.id_user = e.id_user)
		right join eps g on (g.id_eps = b.id_eps)
		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

		where b.tipo_servicio = 'Rehabilitacion' and a.doc_pac='".$doc."' and e.freg_evotap_reh BETWEEN '".$f1."' and '".$f2."'
		UNION

		select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'ENFERMERIA' tipo_terapia,
		 e.id_enfermeria id, e.freg_nota fecha_evo,e.hreg_nota hora_evo,e.descripnota evolucion,e.id_user id_user,
		 f.nombre nombre_usuario, f.firma firmat,
		 g.nom_eps eps ,
		 h.nom_sedes sedes
		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		right join enfermeria_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		right join user f on (f.id_user = e.id_user)
		right join eps g on (g.id_eps = b.id_eps)
		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

		where b.tipo_servicio = 'Rehabilitacion' and a.doc_pac='".$doc."' and e.freg_nota BETWEEN '".$f1."' and '".$f2."'
		UNION

		select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'ACOMPAÑAMIENTO SOMBRA' tipo_terapia,
		 e.id_evosombra_reh id, e.freg_evosombra_reh fecha_evo,e.hreg_evosombra_reh hora_evo,e.evolucionsombra_reh evolucion,e.id_user id_user,
		 f.nombre nombre_usuario, f.firma firmat,
		 g.nom_eps eps ,
		 h.nom_sedes sedes
		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		right join evo_sombra_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		right join user f on (f.id_user = e.id_user)
		right join eps g on (g.id_eps = b.id_eps)
		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

		where b.tipo_servicio = 'Rehabilitacion' and a.doc_pac='".$doc."' and e.freg_evosombra_reh BETWEEN '".$f1."' and '".$f2."'
		order by 7,9 ASC	";

	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {

			echo"<tr >\n";
			echo'<td class="text-center">'.$fila["doc_pac"].'</td>';
			echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
			echo'<td class="text-center">'.$fila["tipo_terapia"].'</td>';
			echo'<td class="text-center">'.$fila["id"].'</td>';
			echo'<td class="text-center">'.$fila["fecha_evo"].'</td>';
			echo'<td class="text-center">'.$fila["hora_evo"].'</td>';
			echo'<td class="text-justify">'.$fila["evolucion"].'</td>';
			echo'<td class="text-center">'.$fila["nombre_usuario"].'</td>';
			$edad=$fila["doc_pac"];
			$cie=$fila["descricie"];

			if ($fila["tipo_terapia"]=='FISIOTERAPIA') {
				echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=FISIO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
			}
			if ($fila["tipo_terapia"]=='TERAPIA OCUPACIONAL') {
				echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
			}
			if ($fila["tipo_terapia"]=='FONOAUDIOLOGIA') {
				echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=FONO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
			}
			if ($fila["tipo_terapia"]=='PSICOLOGIA') {
				echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PSICO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
			}
			//COMPLEMENTARIAS
			if ($fila["tipo_terapia"]=='MUSICOTERAPIA') {
				echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MUSICO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
			}
			if ($fila["tipo_terapia"]=='EQUINOTERAPIA') {
				echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EQUINO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
			}
			if ($fila["tipo_terapia"]=='HIDROTERAPIA') {
				echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HIDRO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
			}
			if ($fila["tipo_terapia"]=='PSICOLOGIA COGNITIVA') {
				echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PSICOCOG&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
			}
			if ($fila["tipo_terapia"]=='TERAPIA ASISTIDA POR PERROS') {
				echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TAP&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
			}
			if ($fila["tipo_terapia"]=='ENFERMERIA') {
				echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ENF&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
			}
			if ($fila["tipo_terapia"]=='ACOMPAÑAMIENTO SOMBRA') {
				echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SOM&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
			}
			echo "</tr>\n";
		}
		$fechaactual=$_get["mes"];
		if ($fechaactual==enero) {
			$f1='2017-01-01';
			$f2='2017-01-31';
		}
		if ($fechaactual==febrero) {
			$f1='2017-02-01';
			$f2='2017-02-31';
		}
		if ($fechaactual==marzo) {
			$f1='2017-03-01';
			$f2='2017-03-31';
		}
		if ($fechaactual==abril) {
			$f1='2017-04-01';
			$f2='2017-04-31';
		}
		if ($fechaactual==mayo) {
			$f1='2017-05-01';
			$f2='2017-05-31';
		}
		if ($fechaactual==junio) {
			$f1='2017-06-01';
			$f2='2017-06-31';
		}
		if ($fechaactual==julio) {
			$f1='2017-07-01';
			$f2='2017-07-31';
		}
		if ($fechaactual==agosto) {
			$f1='2017-08-01';
			$f2='2017-08-31';
		}
		if ($fechaactual==septiembre) {
			$f1='2017-09-01';
			$f2='2017-09-31';
		}
		if ($fechaactual==octubre) {
			$f1='2017-10-01';
			$f2='2017-10-31';
		}
		if ($fechaactual==noviembre) {
			$f1='2017-11-01';
			$f2='2017-11-31';
		}
		if ($fechaactual==diciembre) {
			$f1='2017-12-01';
			$f2='2017-12-31';
		}
		$id=$fila["id_adm_hosp"];
		echo $id;
		$sql1="select b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia, count(9) cuantas
		from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
										 inner join evo_fisio_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		where b.id_adm_hosp='".$id."' and e.freg_evofisio_reh between '".$f1."' and '".$f2."'
		group by b.id_adm_hosp
		union
		select b.id_adm_hosp id_adm_hosp,'TERAPIA OCUPACIONAL' tipo_terapia, count(9) cuantas
		from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
										 inner join evo_to_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		where b.id_adm_hosp='".$id."' and e.freg_evoto_reh between '".$f1."' and '".$f2."'
		group by b.id_adm_hosp
		union
		select b.id_adm_hosp id_adm_hosp,'FONOAUDIOLOGIA' tipo_terapia, count(9) cuantas
		from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
										 inner join evo_fono_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		where b.id_adm_hosp='".$id."' and e.freg_evofono_reh between '".$f1."' and '".$f2."'
		group by b.id_adm_hosp
		union
		select b.id_adm_hosp id_adm_hosp,'PSICOLOGIA' tipo_terapia, count(9) cuantas
		from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
										 inner join evo_psico_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		where b.id_adm_hosp='".$id."' and e.freg_evopsico_reh between '".$f1."' and '".$f2."'
		group by b.id_adm_hosp
		union
		select b.id_adm_hosp id_adm_hosp,'MUSICOTERAPIA' tipo_terapia, count(9) cuantas
		from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
										 inner join evo_musico_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		where b.id_adm_hosp='".$id."' and e.freg_evomusico_reh between '".$f1."' and '".$f2."'
		group by b.id_adm_hosp
		union
		select b.id_adm_hosp id_adm_hosp,'EQUINOTERAPIA' tipo_terapia, count(9) cuantas
		from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
										 inner join evo_equino_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		where b.id_adm_hosp='".$id."' and e.freg_evoequino_reh between '".$f1."' and '".$f2."'
		group by b.id_adm_hosp
		union
		select b.id_adm_hosp id_adm_hosp,'HIDROTERAPIA' tipo_terapia, count(9) cuantas
		from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
										 inner join evo_hidro_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		where b.id_adm_hosp='".$id."' and e.freg_evohidro_reh between '".$f1."' and '".$f2."'
		group by b.id_adm_hosp
		union
		select b.id_adm_hosp id_adm_hosp,'PSICOLOGIA COGNITIVA' tipo_terapia, count(9) cuantas
		from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
										 inner join evo_psicocog_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		where b.id_adm_hosp='".$id."' and e.freg_evopsicocog_reh between '".$f1."' and '".$f2."'
		group by b.id_adm_hosp
		union
		select b.id_adm_hosp id_adm_hosp,'TAP' tipo_terapia, count(9) cuantas
		from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
										 inner join evo_tap_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		where b.id_adm_hosp='".$id."' and e.freg_evotap_reh between '".$f1."' and '".$f2."'
		group by b.id_adm_hosp
		union
		select b.id_adm_hosp id_adm_hosp,'ENFERMERIA' tipo_terapia, count(9) cuantas
		from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
										 inner join enfermeria_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		where b.id_adm_hosp='".$id."' and e.freg_nota between '".$f1."' and '".$f2."'
		group by b.id_adm_hosp
		union
		select b.id_adm_hosp id_adm_hosp,'ACOMPAÑAMIENTO SOMBRA' tipo_terapia, count(9) cuantas
		from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
										 inner join evo_sombra_reh e on (e.id_adm_hosp = b.id_adm_hosp)
		where b.id_adm_hosp='".$id."' and e.freg_evosombra_reh between '".$f1."' and '".$f2."'
		group by b.id_adm_hosp";

		if ($tabla=$bd1->sub_tuplas($sql1)){

			foreach ($tabla as $fila1 ) {

				echo"<tr> \n";
				echo'<td class="text-center alert-info">Evoluciones realizadas de: '.$fila1["tipo_terapia"].'</td>';
				echo'<td class="text-center">'.$fila1["cuantas"].'</td>';
				echo "</tr>\n";

			}
		}
	}
}


	?>

</table>

</div>
</div>
	<?php
}
?>
