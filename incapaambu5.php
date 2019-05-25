<h1 class="fuente_titulo text-center">Incapacidad Médica</h1>
<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["logo"])){
				if (is_uploaded_file($_FILES["logo"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["logo"]["name"]);
					$archivo=$_POST["doc_ips"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["logo"]["tmp_name"],LOG.LOGOS.$archivo)){
						$fotoE=",logo='".LOGOS.$archivo."'";
						$fotoA1=",logoips";
						$fotoA2=",'".LOGOS.$archivo."'";
						}
				}
			}

			switch ($_POST["operacion"]) {
			case 'E':
			$fecha=$_POST["fini_incapa"];
			$fecha2=$_POST["ffin_incapa"];
			$fechaini=strtotime($fecha);
			$fechafin=strtotime($fecha2);
			$min=60;
			$hora=60*$min;
			$dia=24*$hora;
			$diast=floor($fechafin/$dia)-floor($fechaini/$dia) +1;

			$sql="INSERT INTO incapacidad_medica (id_adm_hosp, id_user, freg_incapa_med, tipo_atencion, origen_atencion, coddx_incapa_med, ddx_incapa_med, tdx_incapa_med, fini_incapa_med, ffin_incapa_med, total_dias_incapa, obs_incapa_med, estado_incapa) VALUES
			('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg_incapa_hosp"]."','".$_POST["tipo_atencion"]."','".$_POST["origen_atencion"]."','".$_POST["cdxp"]."','".$_POST["descridxp"]."','".$_POST["tdxp"]."','".$_POST["fini_incapa"]."','".$_POST["ffin_incapa"]."','$diast ','".$_POST["obs_incapa_med"]."','Realizada')";
			$subtitulo="Realizada";
			break;
			case 'X':
				$sql="SELECT logoips from ips where id_ips=".$_POST["idips"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="DELETE FROM ips WHERE id_ips=".$_POST["idips"];
				$subtitulo="Eliminado";
			break;
			case 'A':

			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="La incapacidad del paciente fue $subtitulo con EXITO!";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logoips"])){
				unlink($fila["logoips"]);
			}
			}
		}else{
			$subtitulo="La incapacidad del paciente NO fue $subtitulo !!! .";
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'E':
			$sql="SELECT p.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,a.id_adm_hosp,fingreso_hosp,hingreso_hosp FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente WHERE a.id_adm_hosp=".$_GET["idadmhosp"];
			$color="green";
			$boton="Generar Incapacidad";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3=' disabled="disabled"';
			$subtitulo='Generación de incapacidad médica';
			$date=date('Y-m-d');
			$date1=date('H:i');
			break;
			case 'X':
			$sql="SELECT id_ips,nom_ips,doc_ips,tel_ips,dir_ips,logoips,estado_ips FROM  ips where id_ips=".$_GET["idips"];
			$color="red";
			$boton="Eliminar";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$subtitulo='Confirmación para eliminar de datos de IPS';
			break;
			case 'A':
			$sql="";
			$color="yellow";
			$boton="Crear";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Creación de IPS';
			break;
		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"");

			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"");
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nom_ips.value == ""){
					alert("Se requiere el nombre de la IPS!");
					document.forms[0].nom_ips.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA.'?opcion=37&idadmhosp='.$fila["id_adm_hosp"];?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section>
		<marquee class="fuente1 banermarquee">
			<?php echo $subtitulo;?>
		</marquee>
	</section>
	<section class="panel panel-default">
		<section class="panel-body">
			<article class="col-xs-3">
				<label for="">Identificacion:</label>
				<input type="text" name="name" class="form-control" value="<?php echo $fila["tdoc_pac"].':  '.$fila["doc_pac"];?>" <?php echo $atributo1; ?>>
				<input type="hidden" name="idadmhosp" class="form-control" value="<?php echo $fila["id_adm_hosp"];?>" <?php echo $atributo1; ?>>
			</article>
			<article class="col-xs-3">
				<label for="">Nombre Completo:</label>
				<input type="text" name="name" class="form-control" value="<?php echo $fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"];?>" <?php echo $atributo1; ?>>
			</article>
			<article class="col-xs-3">
				<label for="">Fecha Registro Incapacidad:</label>
				<input type="text" name="freg_incapa_hosp" class="form-control" value="<?php echo date('Y-m-d');?>" <?php echo $atributo1; ?>>
			</article>
		</section>
		<section class="panel-body">
			<article class="col-xs-3">
				<label for="">Fecha Inicio Incapacidad:</label>
				<input type="date" name="fini_incapa" class="form-control" value="<?php echo $fila["fingreso_hosp"];?>" <?php echo $atributo2; ?>>
			</article>
			<article class="col-xs-3">
				<label for="">Fecha Final Incapacidad:</label>
				<input type="date" name="ffin_incapa" class="form-control" value="" <?php echo $atributo2; ?> required="">
			</article>
			<article class="col-xs-3">
				<label for="">Tipo de atención:</label>
				<select name="tipo_atencion" class="form-control" <?php echo atributo3; ?> required="es requerido este campo">
					<option value=""></option>
					<option value="Ambulatorio">Ambulatorio</option>
					<option value="Hospitalario">Hospitalario</option>
				</select>
			</article>
			<article class="col-xs-3">
				<label for="">Origen de atención:</label>
				<select name="origen_atencion" class="form-control" <?php echo atributo3; ?> required="">
					<option value=""></option>
					<option value="Enfermedad general">Enfermedad general</option>
					<option value="Enfermedad Laboral">Enfermedad Laboral</option>
					<option value="SOAT">SOAT</option>
				</select>
			</article>
			<article class="col-xs-12">
				<label class="alert-success">Diagnostico </label>
				<?php include("diagnosticos/dx.php");?>
			</article>
		 <article class="col-xs-12">
			 <label for="">Observaciones:</label>
			 <textarea name="obs_incapa_med" class='form-control' rows="5" cols="40"></textarea>
		 </article>
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
echo '<div class="alert alert-success animated bounceInRight">';
	echo $subtitulo;
echo '</div>';
// nivel 1?>
<div class="panel panel-default">
<section class="panel-heading"><h4>Genración de incapacidades medicas</h4></section>

<div class="panel-body">
	<table class="table table-responsive">
		<tr>

			<th id="th-estilo1">ID ADM</th>
			<th id="th-estilo1">NOMBRE Y APELLIDOS</th>
			<th id="th-estilo2">HC  </th>
			<th id="th-estilo1">FECHA Y HORA INGRESO</th>
			<th id="th-estilo2">FOTO</th>
			<th id="th-estilo4">Generar Incapacidad</th>
		</tr>
		<?php
		if (isset($_REQUEST["idadmhosp"])){
		$idpaciente=$_GET["idadmhosp"];
		$sql="SELECT p.nom1,nom2,ape1,ape2,fotopac,a.id_adm_hosp,fingreso_hosp,hingreso_hosp,h.id_hchosp FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN hc_hospitalario h on a.id_adm_hosp=h.id_adm_hosp WHERE a.id_adm_hosp='".$idpaciente."'";
		//echo $sql;
		if ($tabla=$bd1->sub_tuplas($sql)){
			//echo $sql;
			foreach ($tabla as $fila ) {
				echo"<tr >\n";

				echo'<td class="text-center info">'.$fila["id_adm_hosp"].'</td>';
				echo'<td class="text-center info">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
				echo'<td class="text-center info">'.$fila["id_hchosp"].'</td>';
				echo'<td class="text-center info">'.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-left info"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login"> </td>';
				echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idhc='.$fila["id_hchosp"].'&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-square-o"></span></button></a></th>';
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
