
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
				$sql="INSERT INTO hc_hospitalario (id_adm_hosp,id_user,freg_hchosp,hreg_hchosp,motivo_consulta,enfer_actual,his_personal,his_familiar,perso_premorbida,ant_alergicos,ant_patologico,ant_quirurgico,ant_toxicologico,ant_farmaco,ant_gineco,ant_psiquiatrico,ant_hospitalario,ant_traumatologico,ant_familiar,otros_ant,estado_general,tad,tas,tam,fr,fc,so,peso,talla,temperatura,imc,cabcuello,torax,ext,abdomen,neurologico,genitourinario,examen_mental,analisis,finalidad,causa_externa,plantratamiento,Resp_hchosp,especialidad,estado_hchosp) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["motivoconsulta"]."','".$_POST["enferactual"]."','".$_POST["hpersonal"]."','".$_POST["hfamiliar"]."','".$_POST["ppremorbida"]."','".$_POST["antalergico"]."','".$_POST["antpatologico"]."','".$_POST["antquirurgico"]."','".$_POST["anttoxicologicos"]."','".$_POST["antfarmacologico"]."','".$_POST["antgineco"]."','".$_POST["antpsiquiatrico"]."','".$_POST["anthospitalario"]."','".$_POST["anttrauma"]."','".$_POST["antfami"]."','".$_POST["antotros"]."','".$_POST["estadogen"]."','".$_POST["tad"]."','".$_POST["tas"]."','$tamt','".$_POST["fr"]."','".$_POST["fc"]."','".$_POST["sao2"]."','".$_POST["peso"]."','".$_POST["talla"]."','".$_POST["temperatura"]."','$imc2','".$_POST["cabezacuello"]."','".$_POST["torax"]."','".$_POST["extsup"]."','".$_POST["abdomen"]."','".$_POST["neurologico"]."','".$_POST["genitourinario"]."','".$_POST["exmental"]."','".$_POST["analisis"]."','".$_POST["finconsulta"]."','".$_POST["causaexterna"]."','".$_POST["plant"]."','".$_SESSION["AUT"]["nombre"]."','".$_SESSION["AUT"]["especialidad"]."','Realizada')";
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
		<script type="text/javascript" src="/js/jquery.js"></script>
		<style>
		b{color:blue;}
		#resultado{width:600px;border:solid 1px #dadada;text-align:justify;padding:5px;}
		</style>
		<script src="ajax.js"></script>

<form action="<?php echo PROGRAMA;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
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
		<h4 id="th-estilot">Datos de historia Clínica</h4>
	</article>

	<section class="panel-body"> <!--Anamnesis-->
		<div class="botonhc">
				<a data-toggle="collapse" class="ac" data-target="#anamnesis" >Anamnesis</a>
				<span class="glyphicon glyphicon-arrow-down"></span>
				<span class="badge">OK</span>
		</div>
		<section class="collapse" id="anamnesis">
			<article class="col-xs-3">
				<label for="">Fecha de registro:</label>
				<input type="text" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1?> >
			</article>
			<article class="col-xs-3">
				<label for="">Hora de registro</label>
				<input type="text" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1?>>
			</article>
			<article class="col-xs-10">
				<label for="">Motivo de consulta:</label>
				<textarea class="form-control" name="motivoconsulta" rows="5" id="comment" required=""></textarea>
			</article>
			<article class="col-xs-10">
				<label for="" >Enfermedad Actual: <span class="fa fa-info-circle" data-toggle="popover" title="Circunstancias especiales del paciente en relación con su enfermedad" data-content=""></span></label>
				<textarea class="form-control" name="enferactual" rows="5" id="comment" required=""></textarea>
			</article>
			<article class="col-xs-5">
				<label >Historia Personal: <span class="fa fa-info-circle" data-toggle="popover" title="Embarazo, parto, lactancia y desarrollo psicomotor, niñez, adolecencia,adultez, senectud, personalidad previa, antecedentes legales" data-content=""></span></label>
				<textarea class="form-control" name="hpersonal" rows="6" id="comment" required=""></textarea>
			</article>
			<article class="col-xs-5">
				<label for="">Historia Familiar:</label>
				<textarea class="form-control" name="hfamiliar" rows="6" id="comment" required=""></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">Personalidad Premorbida:</label>
				<textarea class="form-control" name="ppremorbida" rows="3" id="comment" required=""></textarea>
			</article>
		</section>
</section>
<section class="panel-body">
		<div class="botonhc">
			<a data-toggle="collapse" class="ac" data-target="#antpersonal" >Antecedentes Personales <span class="glyphicon glyphicon-arrow-down"></span> </a>
			<span class="badge">OK</span>
		</div>
		  <section id="antpersonal" class="collapse">
				<article class="col-xs-3">
			  	<label for="">Alergicos:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto1()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto1()"></button>
			  	<textarea class="form-control" name="antalergico" rows="4" id="respuesta1" required=""></textarea>
			  </article>
				<article class="col-xs-3">
			  	<label for="">Psiquiatricos:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto2()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto2()"></button>
			  	<textarea class="form-control" name="antpsiquiatrico" rows="4" id="respuesta2" required=""></textarea>
			  </article>
				<article class="col-xs-3">
					<label for="">Patologicos:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto3()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto3()"></button>
					<textarea class="form-control" name="antpatologico" rows="4" id="respuesta3" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Quirurgicos:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto4()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto4()"></button>
					<textarea class="form-control" name="antquirurgico" rows="4" id="respuesta4" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Toxicológicos:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto5()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto5()"></button>
					<textarea class="form-control" name="anttoxicologicos" rows="4" id="respuesta5" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Farmacológicos:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto6()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto6()"></button>
					<textarea class="form-control" name="antfarmacologico" rows="4" id="respuesta6" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Hospitalarios:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto7()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto7()"></button>
					<textarea class="form-control" name="anthospitalario" rows="4" id="respuesta7" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Gineco-obstetricos:</label>
					<textarea class="form-control" name="antgineco" rows="4" id="respuesta" ></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Traumatologicos:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto8()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto8()"></button>
					<textarea class="form-control" name="anttrauma" rows="4" id="respuesta8" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Familiares:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto9()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto9()"></button>
					<textarea class="form-control" name="antfami" rows="4" id="respuesta9" required=""></textarea>
				</article>
				<article class="col-xs-6">
					<label for="">Otros Antecedentes:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto10()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto10()"></button>
					<textarea class="form-control"  name="antotros" rows="4" id="respuesta10" required=""></textarea>
				</article>
		  </section>
</section>
<section class="panel-body">
			<div class="botonhc">
				<a data-toggle="collapse" class="ac" data-target="#efisico" >Examen Físico <span class="glyphicon glyphicon-arrow-down"></span> </a>
				<span class="badge">OK</span>
			</div>
			<section id="efisico" class="collapse">
<article class="col-xs-2">
					<label for="">TAS(mm/hg):</label>
					<input type="text" name="tas" value="" class="form-control">
				</article>
				<article class="col-xs-2">
					<label for="">TAD(mm/hg):</label>
					<input type="text" name="tad" value="" class="form-control">
				</article>

				<article class="col-xs-2">
					<label for="">FC(x min):</label>
					<input type="text" name="fc" value="" class="form-control">
				</article>
				<article class="col-xs-2">
					<label for="">FR(x min):</label>
					<input type="text" name="fr" value="" class="form-control">
				</article>
				<article class="col-xs-2">
					<label for="">SAO2:</label>
					<input type="text" name="sao2" value="" class="form-control">
				</article>
				<article class="col-xs-2">
					<label for="">Peso(Kg):</label>
					<input type="text" name="peso" value="" class="form-control">
				</article>
				<article class="col-xs-2">
					<label for="">Talla(mts): <span class="fa fa-pulse fa-comment-o" data-toggle="popover" title="El valor correspondiente a la talla del paciente debe ser diligenciado en metros Ej: 1.95" data-content=""></span></label>
					<input type="text" name="talla" value="" class="form-control">
				</article>
				<article class="col-xs-2">
					<label for="">Temp(°C):</label>
					<input type="text" name="temperatura" value="" class="form-control">
				</article>
<article class="col-xs-6 animated tada fuente_alerta_fijo">
					<label class="fuente_alerta_fijo" for="">Doctor(a) los datos que debe ingresar en estos campos deben ser numericos, en el campo de talla digite en metros Ejemplo: 1.95</label>

				</article>
			</section>
</section>
<section class="panel-body">
			<div class="botonhc">
				<a data-toggle="collapse" class="ac" data-target="#explogeneral" >Exploración general y regional<span class="glyphicon glyphicon-arrow-down"></span> </a>
				<span class="badge">OK</span>
			</div>
			<section id="explogeneral" class="collapse">
				<article class="col-xs-12">
					<label for="">Estado General:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto11()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto11()"></button>
					<textarea class="form-control" name="estadogen" rows="3" id="respuesta11" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Cabeza y Cuello:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto12()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto12()"></button>
					<textarea class="form-control" name="cabezacuello" rows="5" id="respuesta12" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Torax:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto13()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto13()"></button>
					<textarea class="form-control" name="torax" rows="5" id="respuesta13" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Abdomen:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto16()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto16()"></button>
					<textarea class="form-control" name="abdomen" rows="5" id="respuesta16" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Genitourinario:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto17()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto17()"></button>
					<textarea class="form-control" name="genitourinario" rows="5" id="respuesta17" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Extremidades:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto14()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto14()"></button>
					<textarea class="form-control" name="extsup" rows="5" id="respuesta14" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Neurologico:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto15()" ></button>
					<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto15()"></button>
					<textarea class="form-control" name="neurologico" rows="5" id="respuesta15" required=""></textarea>
				</article>

			</section>
</section>
<section class="panel-body">
			<div class="botonhc">
				<a data-toggle="collapse" class="ac" data-target="#exmental" >Examen Mental y Analisis<span class="glyphicon glyphicon-arrow-down"></span> </a>
				<span class="badge">OK</span>
			</div>
			<section id="exmental" class="collapse">
				<article class="col-xs-10">
					<label for="">Examen Mental:</label>
					<textarea class="form-control" name="exmental" rows="5" id="comment" required=""></textarea>
				</article>
				<article class="col-xs-10">
					<label for="">Analisis y Diagnostico:</label>
					<textarea class="form-control" name="analisis" rows="5" id="comment" required=""></textarea>
				</article>
				<article class="col-xs-5">
					<label for="">Finalidad de la consulta: </label>
					<select name="finconsulta" class="form-control" <?php echo atributo3; ?>>
						<?php
						$sql="SELECT id_fconsulta,descripfconsulta from finalidad_consulta ORDER BY id_fconsulta ASC";
						if($tabla=$bd1->sub_tuplas($sql)){
							foreach ($tabla as $fila2) {
								if ($fila["descripfconsulta"]==$fila2["descripfconsulta"]){
									$sw=' selected="selected"';
								}else{
									$sw="";
								}
							echo '<option value="'.$fila2["descripfconsulta"].'"'.$sw.'>'.$fila2["descripfconsulta"].'</option>';
							}
						}
						?>
					</select>
				</article>
				<article class="col-xs-5">
					<label for="">Causa externa: </label>
					<select name="causaexterna" class="form-control" <?php echo atributo3; ?>>
						<?php
						$sql="SELECT id_cexterna,descricexterna from causa_externa ORDER BY id_cexterna ASC";
						if($tabla=$bd1->sub_tuplas($sql)){
							foreach ($tabla as $fila2) {
								if ($fila["descricexterna"]==$fila2["descricexterna"]){
									$sw=' selected="selected"';
								}else{
									$sw="";
								}
							echo '<option value="'.$fila2["descricexterna"].'"'.$sw.'>'.$fila2["descricexterna"].'</option>';
							}
						}
						?>
					</select>
				</article>
			</section>
</section>

<section class="panel-body">

			<div class="botonhc">
				<a data-toggle="collapse" class="ac" data-target="#plant" >Plan Tratamiento<span class="glyphicon glyphicon-arrow-down"></span> </a>
				<span class="badge text-left">OK</span>
			</div>
			<section id="plant" class="collapse">
				<article class="col-xs-12">
					<label for="">Plan de tratamiento:</label>
					<textarea class="form-control" name="plant" rows="8" id="comment" required=""></textarea>
				</article>
			</section>

	</section>
	<div class="row text-center">
	  	<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>

<?php
}else{
	echo $subtitulo;
// nivel 1?>
<div class="panel-default">
<div class="panel-body">
	<section class="panel panel-default">

		<section class="col-xs-12">
			<form>
				<article class="col-xs-2">
					<label>Fecha inicial:</label>
					<input type="date" class="form-control" name="fecha1">
				</article>
				<article class="col-xs-2">
					<label>Fecha Final:</label>
					<input type="date" class="form-control" name="fecha2">
				</article>
				<article class="col-xs-2">
					<label for="">Seleccione EPS:</label>
					<select name="eps" class="form-control" <?php echo atributo3; ?>>
						<?php
						$sql="SELECT id_eps,nom_eps from eps ORDER BY id_eps ASC";
						if($tabla=$bd1->sub_tuplas($sql)){
							foreach ($tabla as $fila2) {
								if ($fila["nom_eps"]==$fila2["nom_eps"]){
									$sw=' selected="selected"';
								}else{
									$sw="";
								}
							echo '<option value="'.$fila2["nom_eps"].'"'.$sw.'>'.$fila2["nom_eps"].'</option>';
							}
						}
						?>
					</select>
				</article>
				<article class="col-xs-4">
					<label for="">Seleccione Sede:</label>
					<select name="sede" class="form-control" <?php echo atributo3; ?>>
						<?php
						$sql="SELECT id_sedes_ips,nom_sedes from sedes_ips ORDER BY id_sedes_ips ASC";
						if($tabla=$bd1->sub_tuplas($sql)){
							foreach ($tabla as $fila2) {
								if ($fila["nom_eps"]==$fila2["nom_sedes"]){
									$sw=' selected="selected"';
								}else{
									$sw="";
								}
							echo '<option value="'.$fila2["nom_sedes"].'"'.$sw.'>'.$fila2["nom_sedes"].'</option>';
							}
						}
						?>
					</select>
				</article>
				<div class="col-xs-2">
						<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
						<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
				</div>
	    </form>
		</section>

<br>
	<table class="table table-responsive">
	<tr>
		<th id="th-estilo4">Reporte Informe Mensual</th>
		<th id="th-estilo4">Reporte Evoluciones</th>
	</tr>

	<?php

if (isset($_REQUEST["eps"])){
	$eps=$_REQUEST["eps"];
	$f1=$_REQUEST["fecha1"];
	$f2=$_REQUEST["fecha2"];
	$sede=$_REQUEST["sede"];

$sql="select    b.id_adm_hosp id_adm_hosp, 'FISIOTERAPIA' tipo_terapia, count(9) cuantas

from      pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
                      inner join evo_fisio_reh e on (e.id_adm_hosp = b.id_adm_hosp)
where          b.tipo_servicio = 'Rehabilitacion'

and b.estado_adm_hosp = 'Activo' and e.freg_evofisio_reh between '2016-10-01' and '2016-10-31'

group by b.id_adm_hosp

union

select    b.id_adm_hosp id_adm_hosp, 'FONOAUDIOLOGIA' tipo_terapia, count(9) cuantos

from      pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
                      inner join evo_fono_reh f on (f.id_adm_hosp = b.id_adm_hosp)
where  b.tipo_servicio = 'Rehabilitacion' and b.estado_adm_hosp = 'Activo' and f.freg_evofono_reh between '2016-10-01' and '2016-10-31'
group by f.id_adm_hosp

union

select    b.id_adm_hosp                                                                id_adm_hosp,

        'TERAPIA OCUPACIONAL'                                                                                       tipo_terapia,

        count(9)                                                                       cuantos

from      pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)

                                inner join evo_to_reh g on (g.id_adm_hosp = b.id_adm_hosp)

where

                b.tipo_servicio = 'Rehabilitacion'

and b.estado_adm_hosp = 'Activo'

and g.freg_evoto_reh between '2016-10-01' and '2016-10-31'

group by g.id_adm_hosp

union

select    b.id_adm_hosp                                                                id_adm_hosp,

        'PSICOLOGIA'                                                                                          tipo_terapia,

        count(9)                                                                       cuantos

from      pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)

                                                                                inner join evo_psico_reh h on (h.id_adm_hosp = b.id_adm_hosp)

where

                b.tipo_servicio = 'Rehabilitacion'

and b.estado_adm_hosp = 'Activo'

and h.freg_evopsico_reh between '2016-10-01' and '2016-10-31'

group by b.id_adm_hosp

union

select    b.id_adm_hosp                                                                id_adm_hosp,

        'HIDROTERAPIA'                                                                                         tipo_terapia,

        count(9)                                                                       cuantos

from      pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)

                                                                                inner join evo_hidro_reh i on (i.id_adm_hosp = b.id_adm_hosp)



where

                b.tipo_servicio = 'Rehabilitacion'

and b.estado_adm_hosp = 'Activo'

and i.freg_evohidro_reh between '2016-10-01' and '2016-10-31'

group by b.id_adm_hosp

union

select  b.id_adm_hosp                                                  id_adm_hosp,

        'TAP'                                                                                              tipo_terapia,

        count(9)                                                                       cuantos

from      pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)

                                                                                inner join evo_tap_reh j on (j.id_adm_hosp = b.id_adm_hosp)

                    inner join user k on (k.id_user = j.id_user)

                    inner join eps  r on (r.id_eps = b.id_eps)

                    inner join sedes_ips s on (s.id_sedes_ips = b.id_sedes_ips)

where

                b.tipo_servicio = 'Rehabilitacion'

and b.estado_adm_hosp = 'Activo'

and j.freg_evotap_reh between '2016-10-01' and '2016-10-31'

group by b.id_adm_hosp

union

select  b.id_adm_hosp                                                  id_adm_hosp,

        'MUSICOTERAPIA'                                                                     tipo_terapia,

        count(9)                                                                       cuantos

from      pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)

                                                                                inner join evo_musico_reh k on (k.id_adm_hosp = b.id_adm_hosp)

                    inner join user l on (l.id_user = k.id_user)

                    inner join eps  r on (r.id_eps = b.id_eps)

                    inner join sedes_ips  s on (s.id_sedes_ips = b.id_sedes_ips)

where

                b.tipo_servicio = 'Rehabilitacion'

and b.estado_adm_hosp = 'Activo'

and k.freg_evomusico_reh between '2016-10-01' and '2016-10-31' 

group by b.id_adm_hosp

union

select  b.id_adm_hosp                                                  id_adm_hosp,

        'EQUINOTERAPIA'                                                                     tipo_terapia,

        count(9)                                                                       cuantos

from      pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)

                                                                                inner join evo_equino_reh l on (l.id_adm_hosp = b.id_adm_hosp)

                    inner join user m on (m.id_user = l.id_user)

                    inner join eps  r on (r.id_eps = b.id_eps)

                    inner join sedes_ips  s on (s.id_sedes_ips = b.id_sedes_ips)

where

                b.tipo_servicio = 'Rehabilitacion'

and b.estado_adm_hosp = 'Activo'

and l.freg_evoequino_reh between '2016-10-01' and '2016-10-31'

group by b.id_adm_hosp

union

select  b.id_adm_hosp                                                  id_adm_hosp,

        'PSICOLOGIA COGNITIVA'                                                                tipo_terapia,

        count(9)                                                                       cuantos

from      pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)

                                inner join evo_psicocog_reh e on (e.id_adm_hosp = b.id_adm_hosp)

                    inner join user f on (f.id_user = e.id_user)

                    inner join eps  r on (r.id_eps = b.id_eps)

                    inner join sedes_ips s on (s.id_sedes_ips = b.id_sedes_ips)

where

                b.tipo_servicio = 'Rehabilitacion'

and b.estado_adm_hosp = 'Activo'

and e.freg_evopsicocog_reh between '2016-10-01' and '2016-10-31'

group by b.id_adm_hosp

order by 1,2";

			echo"<tr >	\n";
			echo'<th class="text-center" ><a href="rptimrehabilitacion.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&eps='.$eps.'&sede='.$sede.'"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span></button></a></th>';
			echo'<th class="text-center" ><a href="rptevo_indv_reh.php?idadmhosp='.$fila["id_adm_hosp"].'&f1='.$f1.'&f2='.$f2.'&eps='.$eps.'&sede='.$sede.'"><button type="button" class="btn btn-warning sombra_movil " ><span class="fa fa-file-pdf-o"></span></button></a></th>';
			echo "</tr>\n";

}
	?>

</table>

</div>
</div>
	<?php
}
?>
