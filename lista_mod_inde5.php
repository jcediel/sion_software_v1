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
				$sql="UPDATE evo_psico_dem SET freg_evopsico='".$_POST["freg"]."',hreg_evopsico='".$_POST["hreg"]."',evolucionpsico='".$_POST["evolucion"]."'  ,estado_evopsico ='".$_POST['estado']."' WHERE id_evopsico=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'FONO':
				$sql="UPDATE evo_fono_dem SET freg_evofono='".$_POST["freg"]."',hreg_evofono='".$_POST["hreg"]."',evolucionfono='".$_POST["evolucion"]."'  ,estado_evofono ='".$_POST['estado']."' WHERE id_evofono=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'TO':
				$sql="UPDATE evo_to_dem SET freg_evoto='".$_POST["freg"]."',hreg_evoto='".$_POST["hreg"]."',evolucionto='".$_POST["evolucion"]."'  ,estado_evoto ='".$_POST['estado']."' WHERE id_evoto=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'FISIO':
				$sql="UPDATE evo_fisio_dem SET freg_evofisio='".$_POST["freg"]."',hreg_evofisio='".$_POST["hreg"]."',evolucionfisio='".$_POST["evolucion"]."'  ,estado_evofisio ='".$_POST['estado']."' WHERE id_evofisio=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'MUSICO':
				$sql="UPDATE evo_musico_dem SET freg_evomusico='".$_POST["freg"]."',hreg_evomusico='".$_POST["hreg"]."',evolucionmusico='".$_POST["evolucion"]."' ,estado_evomusico ='".$_POST['estado']."'  WHERE id_evomusico=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
				$ident=$_POST["ident"];
			break;
			case 'EQUINO':
				$sql="UPDATE evo_npsico_dem SET freg_evonpsico='".$_POST["freg"]."',hreg_evonpsico='".$_POST["hreg"]."',evolucionnpsico='".$_POST["evolucion"]."'  ,estado_evonpsico ='".$_POST['estado']."' WHERE id_evonpsico=".$_POST["idevolucion"];
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
e.id_evopsico id, e.freg_evopsico fecha_evo,e.hreg_evopsico hora_evo,e.evolucionpsico evolucion,e.estado_evopsico estado,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat,
g.nom_eps eps,
h.nom_sedes sedes
from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join evo_psico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
where b.tipo_servicio in ('Demencias','AVD') and e.id_evopsico='".$idevo."'";
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
e.id_evofono id, e.freg_evofono fecha_evo,e.hreg_evofono hora_evo,e.evolucionfono evolucion,e.estado_evofono estado,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat,
g.nom_eps eps,
h.nom_sedes sedes
from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join evo_fono_dem e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
where b.tipo_servicio in ('Demencias','AVD') and e.id_evofono='".$idevo."'";
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
e.id_evoto id, e.freg_evoto fecha_evo,e.hreg_evoto hora_evo,e.evolucionto evolucion,e.estado_evoto estado,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat,
g.nom_eps eps,
h.nom_sedes sedes
from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join evo_to_dem e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
where b.tipo_servicio in ('Demencias','AVD') and e.id_evoto='".$idevo."'";
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
e.id_evofisio id, e.freg_evofisio fecha_evo,e.hreg_evofisio hora_evo,e.evolucionfisio evolucion,e.estado_evofisio estado,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat,
g.nom_eps eps,
h.nom_sedes sedes
from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join evo_fisio_dem e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
where b.tipo_servicio in ('Demencias','AVD') and e.id_evofisio='".$idevo."'";
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
	e.id_evomusico id, e.freg_evomusico fecha_evo,e.hreg_evomusico hora_evo,e.evolucionmusico evolucion,e.estado_evomusico estado,e.id_user id_user,
	f.nombre nombre_usuario, f.firma firmat,
	g.nom_eps eps,
	h.nom_sedes sedes
	from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
	right join evo_musico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
	right join user f on (f.id_user = e.id_user)
	right join eps g on (g.id_eps = b.id_eps)
	right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
	where b.tipo_servicio in ('Demencias','AVD') and e.id_evomusico='".$idevo."'";
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
a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'NEUROPSICOLOGIA' tipo_terapia,
e.id_evonpsico id, e.freg_evonpsico fecha_evo,e.hreg_evonpsico hora_evo,e.evolucionnpsico evolucion,e.estado_evonpsico estado,e.id_user id_user,
f.nombre nombre_usuario, f.firma firmat,
g.nom_eps eps,
h.nom_sedes sedes
from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
right join evo_npsico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
right join user f on (f.id_user = e.id_user)
right join eps g on (g.id_eps = b.id_eps)
right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
where b.tipo_servicio in ('Demencias','AVD') and e.id_evonpsico='".$idevo."'";
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
				$fila=array("doc_pac"=>"","nom1"=>"",' ',"nom2"=>"",' ',"ape1"=>"",' ',"ape2"=>"", "id_adm_hosp"=>"" ,"id"=>"" ,"fecha_evo"=>"" ,"hora_evo"=>"" ,"evolucion"=>"","estado"=>"");
			}
		}else{
				$fila=array("doc_pac"=>"","nom1"=>"",' ',"nom2"=>"",' ',"ape1"=>"",' ',"ape2"=>"", "id_adm_hosp"=>"" ,"id"=>"" ,"fecha_evo"=>"" ,"hora_evo"=>"" ,"evolucion"=>"","estado"=>"");
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


<form action="<?php echo PROGRAMA.'?&opcion=148&docu='.$ident.'&f1='.$f1.'&f2='.$f2;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
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
			<article class="col-xs-3">
				<label for="">Estado :</label>
				<select class="form-control" name="estado">
					<?php
					if ($fila['estado']=='Realizada') {
						echo'<option value='.$fila['estado'].'>'.$fila['estado'].'</option>';
						echo'<option value="Cancelada">Cancelada</option>';
					}else {
						echo'<option value='.$fila['estado'].'>'.$fila['estado'].'</option>';
						echo'<option value="Realizada">Realizada</option>';
					}
					 ?>
				</select>

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
		    <a class="btn btn-primary" href="<?php echo PROGRAMA.'?opcion=156';?>">Novedades de informe mensual <span class="fa fa-mail-forward"></span></a>
		</section>
		<br>
	<table class="table table-bordered">

		<tr>
			<th>#</th>
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
	$i=1;
	$sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
		e.id_evofisio id, e.freg_evofisio fecha_evo,e.hreg_evofisio hora_evo,e.evolucionfisio evolucion,e.estado_evofisio estado,e.id_user id_user,
		f.nombre nombre_usuario, f.firma firmat,
		g.nom_eps eps,
		h.nom_sedes sedes
		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		right join evo_fisio_dem e on (e.id_adm_hosp = b.id_adm_hosp)
		right join user f on (f.id_user = e.id_user)
		right join eps g on (g.id_eps = b.id_eps)
		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
		where b.tipo_servicio in ('Demencias','AVD') and a.doc_pac='".$doc."' and e.freg_evofisio BETWEEN '".$f1."' and '".$f2."'

		UNION

		SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'TERAPIA OCUPACIONAL' tipo_terapia,
		 e.id_evoto id, e.freg_evoto fecha_evo,e.hreg_evoto hora_evo,e.evolucionto evolucion,e.estado_evoto estado,e.id_user id_user,
		 f.nombre nombre_usuario, f.firma firmat ,
		 g.nom_eps eps,
		 h.nom_sedes sedes
		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		right join evo_to_dem e on (e.id_adm_hosp = b.id_adm_hosp)
		right join user f on (f.id_user = e.id_user)
		right join eps g on (g.id_eps = b.id_eps)
		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
		where b.tipo_servicio in ('Demencias','AVD') and a.doc_pac='".$doc."' and e.freg_evoto BETWEEN '".$f1."' and '".$f2."'

		UNION

		select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FONOAUDIOLOGIA' tipo_terapia,
		 e.id_evofono id, e.freg_evofono fecha_evo,e.hreg_evofono hora_evo,e.evolucionfono evolucion,e.estado_evofono estado,e.id_user id_user,
		 f.nombre nombre_usuario, f.firma firmat ,
		 g.nom_eps eps,
		 h.nom_sedes sedes
		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		right join evo_fono_dem e on (e.id_adm_hosp = b.id_adm_hosp)
		right join user f on (f.id_user = e.id_user)
		right join eps g on (g.id_eps = b.id_eps)
		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
		where b.tipo_servicio in ('Demencias','AVD') and a.doc_pac='".$doc."' and e.freg_evofono BETWEEN '".$f1."' and '".$f2."'
		UNION
		select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'PSICOLOGIA' tipo_terapia,
		 e.id_evopsico id, e.freg_evopsico fecha_evo,e.hreg_evopsico hora_evo,e.evolucionpsico evolucion,e.estado_evopsico estado,e.id_user id_user,
		 f.nombre nombre_usuario, f.firma firmat,
		 g.nom_eps eps ,
		 h.nom_sedes sedes
		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		right join evo_psico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
		right join user f on (f.id_user = e.id_user)
		right join eps g on (g.id_eps = b.id_eps)
		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
		where b.tipo_servicio in ('Demencias','AVD') and a.doc_pac='".$doc."' and e.freg_evopsico BETWEEN '".$f1."' and '".$f2."'
		UNION
		select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'MUSICOTERAPIA' tipo_terapia,
		 e.id_evomusico id, e.freg_evomusico fecha_evo,e.hreg_evomusico hora_evo,e.evolucionmusico evolucion,e.estado_evomusico estado,e.id_user id_user,
		 f.nombre nombre_usuario, f.firma firmat,
		 g.nom_eps eps ,
		 h.nom_sedes sedes
		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		right join evo_musico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
		right join user f on (f.id_user = e.id_user)
		right join eps g on (g.id_eps = b.id_eps)
		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
		where b.tipo_servicio in ('Demencias','AVD') and a.doc_pac='".$doc."' and e.freg_evomusico BETWEEN '".$f1."' and '".$f2."'
		UNION
		select a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'NEUROPSICOLOGIA' tipo_terapia,
		 e.id_evonpsico id, e.freg_evonpsico fecha_evo,e.hreg_evonpsico hora_evo,e.evolucionnpsico evolucion,e.estado_evonpsico estado,e.id_user id_user,
		 f.nombre nombre_usuario, f.firma firmat,
		 g.nom_eps eps ,
		 h.nom_sedes sedes
		from pacientes a right join adm_hospitalario b on (b.id_paciente = a.id_paciente)
		right join evo_npsico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
		right join user f on (f.id_user = e.id_user)
		right join eps g on (g.id_eps = b.id_eps)
		right join sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
		where b.tipo_servicio in ('Demencias','AVD') and a.doc_pac='".$doc."' and e.freg_evonpsico BETWEEN '".$f1."' and '".$f2."'
		order by 7,9 ASC	";
		//echo $sql;
	if ($tabla=$bd1->sub_tuplas($sql)){
		foreach ($tabla as $fila ) {
			if ($fila['estado']=='Cancelada') {
				echo"<tr >\n";
				echo'<td class="text-center alert alert-danger">
							<p>'.$i++.'</p>
						 </td>';
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
					echo'<th class="text-center alert-danger"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=FISIO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
				}
				if ($fila["tipo_terapia"]=='TERAPIA OCUPACIONAL') {
					echo'<th class="text-center alert-danger"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
				}
				if ($fila["tipo_terapia"]=='FONOAUDIOLOGIA') {
					echo'<th class="text-center alert-danger"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=FONO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
				}
				if ($fila["tipo_terapia"]=='PSICOLOGIA') {
					echo'<th class="text-center alert-danger"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PSICO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
				}
				//COMPLEMENTARIAS
				if ($fila["tipo_terapia"]=='MUSICOTERAPIA') {
					echo'<th class="text-center alert-danger"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MUSICO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
				}
				if ($fila["tipo_terapia"]=='NEUROPSICOLOGIA') {
					echo'<th class="text-center alert-danger"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EQUINO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
				}
				echo "</tr>\n";
			}else {
				echo"<tr >\n";
				echo'<td class="text-center">
							<p>'.$i++.'</p>
						 </td>';
				echo'<td class="text-center">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p>DI: '.$fila["doc_pac"].'</p>
						 </td>';
				echo'<td class="text-center">
							<p><strong>'.$fila["tipo_terapia"].'</strong></p>
							<p>'.$fila["id"].'</p>
						 </td>';
				echo'<td class="text-center">'.$fila["fecha_evo"].'<br>'.$fila["hora_evo"].'</td>';
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
				if ($fila["tipo_terapia"]=='NEUROPSICOLOGIA') {
					echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EQUINO&idadmhosp='.$fila["id_adm_hosp"].'&idevo='.$fila["id"].'&tterapia='.$fila["tipo_terapia"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
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
						<th class="text-center"><small>FISIOTERAPIA</small></th>
						<th class="text-center"><small>FONOAUDIOLOGIA</small></th>
						<th class="text-center"><small>OCUPACIONAL</small></th>
						<th class="text-center"><small>PSICOLOGIA</small></th>
						<th class="text-center"><small>MUSICOTERAPIA</small></th>
						<th class="text-center"><small>NEUROPSICOLOGIA</small></th>
					</tr>
					<tr>
						<th class="text-center danger"><small>EVOLUCION</small></th>
						<th class="text-center danger"><small>EVOLUCION</small></th>
						<th class="text-center danger"><small>EVOLUCION</small></th>
						<th class="text-center danger"><small>EVOLUCION</small></th>
						<th class="text-center danger"><small>EVOLUCION</small></th>
						<th class="text-center danger"><small>EVOLUCION</small></th>
					</tr>
					<tr>
						<td class="text-center">
						<?php
						$id=$fila['id_adm_hosp'];
						$sql1="SELECT  count(b.id_adm_hosp) cuantas
						from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
														 left join evo_fisio_dem e on (e.id_adm_hosp = b.id_adm_hosp)
						where b.id_adm_hosp='".$id."' and e.estado_evofisio='Realizada'
																					and e.freg_evofisio between '".$f1."' and '".$f2."'
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
														 left join evo_fono_dem e on (e.id_adm_hosp = b.id_adm_hosp)
						where b.id_adm_hosp='".$id."'  and e.estado_evofono='Realizada'
																					 and e.freg_evofono between '".$f1."' and '".$f2."'
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
														 left join evo_to_dem e on (e.id_adm_hosp = b.id_adm_hosp)
						where b.id_adm_hosp='".$id."'  and e.estado_evoto='Realizada'
																					 and e.freg_evoto between '".$f1."' and '".$f2."'
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
														 left join evo_psico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
						where b.id_adm_hosp='".$id."'  and e.estado_evopsico='Realizada'
																					 and e.freg_evopsico between '".$f1."' and '".$f2."'
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
														 left join evo_musico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
						where b.id_adm_hosp='".$id."'  and e.estado_evomusico='Realizada'
																					 and e.freg_evomusico between '".$f1."' and '".$f2."'
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
														 left join evo_npsico_dem e on (e.id_adm_hosp = b.id_adm_hosp)
						where b.id_adm_hosp='".$id."'  and e.estado_evonpsico='Realizada'
																					 and e.freg_evonpsico between '".$f1."' and '".$f2."'
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

</div>
</div>
	<?php
}
?>
