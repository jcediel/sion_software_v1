
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
				$sql="UPDATE evo_psico_dom SET freg_evopsico_dom='".$_POST["freg"]."',hreg_evopsico_dom='".$_POST["hreg"]."',evolucionpsico_dom='".$_POST["evolucion"]."' WHERE id_evopsico_dom=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'FONO':
				$sql="UPDATE evo_fono_dom SET freg_evofono_dom='".$_POST["freg"]."',hreg_evofono_dom='".$_POST["hreg"]."',evolucionfono_dom='".$_POST["evolucion"]."' WHERE id_evofono_dom=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'TO':
				$sql="UPDATE evo_to_dom SET freg_evoto_dom='".$_POST["freg"]."',hreg_evoto_dom='".$_POST["hreg"]."',evolucionto_dom='".$_POST["evolucion"]."' WHERE id_evoto_dom=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'FISIO':
				$sql="UPDATE evo_fisio_dom SET freg_evofisio_dom='".$_POST["freg"]."',hreg_evofisio_dom='".$_POST["hreg"]."',evolucionfisio_dom='".$_POST["evolucion"]."' WHERE id_evofisio_dom=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'TR':
				$sql="UPDATE evo_tr_dom SET freg_evotr_dom='".$_POST["freg"]."',hreg_evotr_dom='".$_POST["hreg"]."',evoluciontr_dom='".$_POST["evolucion"]."' WHERE id_evotr_dom=".$_POST["idevolucion"];
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
			$sql="select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'PSICOLOGIA' tipo_terapia,
e.id_evopsico_dom id, e.freg_evopsico_dom fecha_evo,e.hreg_evopsico_dom hora_evo,e.evolucionpsico_dom evolucion,e.id_user id_user,
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
			break;
		case 'FONO':
			$sql="select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FONOAUDIOLOGIA' tipo_terapia,
e.id_evofono_dom id, e.freg_evofono_dom fecha_evo,e.hreg_evofono_dom hora_evo,e.evolucionfono_dom evolucion,e.id_user id_user,
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
			break;
		case 'TO':
			$sql="select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA OCUPACIONAL' tipo_terapia,
e.id_evoto_dom id, e.freg_evoto_dom fecha_evo,e.hreg_evoto_dom hora_evo,e.evolucionto_dom evolucion,e.id_user id_user,
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

			break;

			case 'FISIO':

					$sql="select
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
e.id_evofisio_dom id, e.freg_evofisio_dom fecha_evo,e.hreg_evofisio_dom hora_evo,e.evolucionfisio_dom evolucion,e.id_user id_user,
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
			break;

						case 'TR':

								$sql="select
			a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
			e.id_evotr_dom id, e.freg_evotr_dom fecha_evo,e.hreg_evotr_dom hora_evo,e.evoluciontr_dom evolucion,e.id_user id_user,
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


<form action="<?php echo PROGRAMA.'?&opcion=79&docu='.$ident.'&f1='.$f1.'&f2='.$f2;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
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
	<?php include("crapidapruebas.php");?>

	<section class="panel panel-default" class="col-xs-10" >
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
					<article class="col-xs-3">
						<label>Numero de identificacion:</label>
						<input type="text" class="form-control" name="doc" value="<?php echo $_GET["docu"];?>" placeholder="Digite Identificacion">
					</article>
					<div class="col-xs-5">
						<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
						<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
					</div>
			</section>
	  </form>




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

	$sql="
	select
	a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
	e.id_evofisio_dom id, e.freg_evofisio_dom fecha_evo,e.hreg_evofisio_dom hora_evo,e.evolucionfisio_dom evolucion,e.id_user id_user,
	f.nombre nombre_usuario, f.firma firmat,
	g.nom_eps eps,
	h.nom_sedes sedes

	from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
	right join evo_fisio_dom e on (e.id_adm_hosp = b.id_adm_hosp)
	right join user f on (f.id_user = e.id_user)
	right join eps g on (g.id_eps = b.id_eps)
	right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
	where b.tipo_servicio = 'Domiciliarios' and a.doc_pac='".$doc."' and e.freg_evofisio_dom BETWEEN '".$f1."' and '".$f2."'

	UNION

	select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA OCUPACIONAL' tipo_terapia,
	 e.id_evoto_dom id, e.freg_evoto_dom fecha_evo,e.hreg_evoto_dom hora_evo,e.evolucionto_dom evolucion,e.id_user id_user,
	 f.nombre nombre_usuario, f.firma firmat ,
	 g.nom_eps eps,
	 h.nom_sedes sedes
	from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
	right join evo_to_dom e on (e.id_adm_hosp = b.id_adm_hosp)
	right join user f on (f.id_user = e.id_user)
	right join eps g on (g.id_eps = b.id_eps)
	right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

	where b.tipo_servicio = 'Domiciliarios' and a.doc_pac='".$doc."' and e.freg_evoto_dom BETWEEN '".$f1."' and '".$f2."'

	UNION

	select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FONOAUDIOLOGIA' tipo_terapia,
	 e.id_evofono_dom id, e.freg_evofono_dom fecha_evo,e.hreg_evofono_dom hora_evo,e.evolucionfono_dom evolucion,e.id_user id_user,
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
	 e.id_evopsico_dom id, e.freg_evopsico_dom fecha_evo,e.hreg_evopsico_dom hora_evo,e.evolucionpsico_dom evolucion,e.id_user id_user,
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
	 e.id_evotr_dom id, e.freg_evotr_dom fecha_evo,e.hreg_evotr_dom hora_evo,e.evoluciontr_dom evolucion,e.id_user id_user,
	 f.nombre nombre_usuario, f.firma firmat,
	 g.nom_eps eps ,
	 h.nom_sedes sedes
	from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
	right join evo_tr_dom e on (e.id_adm_hosp = b.id_adm_hosp)
	right join user f on (f.id_user = e.id_user)
	right join eps g on (g.id_eps = b.id_eps)
	right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)

	where b.tipo_servicio = 'Domiciliarios' and a.doc_pac='".$doc."' and e.freg_evotr_dom BETWEEN '".$f1."' and '".$f2."'
	order by 7,9 ASC


	";

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
			if ($fila["tipo_terapia"]=='TERAPIA RESPIRATORIA') {
				echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TR&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
			}
			echo "</tr>\n";
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
