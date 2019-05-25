<h1 class="fuente_titulo text-center">Cierre del paciente</h1>
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
			$sql="UPDATE adm_hospitalario set fegreso_hosp='".$_POST["fegreso"]."',hegreso_hosp='".$_POST["hegreso"]."',
			estado_salida='".$_POST["esalida"]."',via_salida='".$_POST["viasalida"]."',medsalida='".$_SESSION["AUT"]["nombre"]."',estado_adm_hosp='Parcial' WHERE id_adm_hosp='".$_POST["idadmhosp"]."'";
			$subtitulo="Realizado";
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
			$subtitulo="El cierre parcial del paciente fue $subtitulo con exito!";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logoips"])){
				unlink($fila["logoips"]);
			}
			}
		}else{
			$subtitulo="El cierre parcial del paciente NO fue $subtitulo !!! .";
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'E':
			$sql="SELECT p.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,a.id_adm_hosp,fingreso_hosp,hingreso_hosp
			FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
			WHERE a.id_adm_hosp=".$_GET["idadmhosp"];
			$color="green";
			$boton="Agregar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3=' disabled="disabled"';
			$subtitulo='Egreso del paciente al servicio de hospitalización';
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
<form action="<?php echo PROGRAMA.'?opcion=37';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section>
		<marquee class="fuente1 banermarquee">
			<?php echo $subtitulo;?>
		</marquee>
	</section>
	<section class="panel panel-default">
		<section class="panel-body">
			<article class="col-xs-3">
				<label for="">Identificacion:</label>
				<input type="text" name="name" class="form-control" value="<?php echo $fila["tdoc_pac"].':  '.$fila["doc_pac"];?>"<?php echo $atributo1;?>>
				<input type="hidden" name="idadmhosp" class="form-control" value="<?php echo $fila["id_adm_hosp"];?>">
			</article>
			<article class="col-xs-3">
				<label for="">Nombre Completo:</label>
				<input type="text" name="name" class="form-control" value="<?php echo $fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"];?>"<?php echo $atributo1;?>>
			</article>
			<article class="col-xs-3">
				<label for="">Fecha y Hora INGRESO:</label>
				<input type="text" name="name" class="form-control" value="<?php echo $fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"];?>"<?php echo $atributo1;?>>
			</article>
			<article class="col-xs-3">
				<label for="">Fecha egreso:</label>
				<input type="text" name="fegreso" class="form-control" value="<?php echo $date;?>"<?php echo $atributo1;?>/>
			</article>
			<article class="col-xs-3">
				<label for="">Hora egreso:</label>
				<input type="time" name="hegreso" class="form-control" value="<?php echo $date1;?>" <?php echo $atributo1;?>/>
			</article>
			<article class="col-xs-4">
		  	<label for="">Seleccione Estado de salida:</label>
				<select name="viasalida" class="form-control" <?php echo atributo3; ?>>
					<?php
					$sql="SELECT id_eegreso,descripeegreso from estado_egreso WHERE id_eegreso >2 ORDER BY id_eegreso ASC";
					if($tabla=$bd1->sub_tuplas($sql)){
						foreach ($tabla as $fila2) {
							if ($fila["descripeegreso"]==$fila2["descripeegreso"]){
								$sw=' selected="selected"';
							}else{
								$sw="";
							}
						echo '<option value="'.$fila2["descripeegreso"].'"'.$sw.'>'.$fila2["descripeegreso"].'</option>';
						}
					}
					?>
			</select>
			<input type="hidden" name="esalida" value="<?php echo $_GET["idsalida"];?>">
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
	<div class="col-xs-7">
			<a class="btn btn-primary" href="<?php echo PROGRAMA.'?opcion=17';?>"><span class="glyphicon glyphicon-triangle-left">Regresar a Menu de admisiones</span></a>
	</div>
	<br>
<div class="panel panel-body">

<table class="table table-responsive">
	<tr>
		<th id="th-estilo3">Egreso</th>
		<th id="th-estilo1">ID ADM</th>
		<th id="th-estilo1">NOMBRE Y APELLIDOS</th>
		<th id="th-estilo2">HC  </th>
		<th id="th-estilo1">FECHA Y HORA INGRESO</th>
		<th id="th-estilo2">TIPO SERVICIO</th>
		<th id="th-estilo1">FECHA Y HORA EGRESO</th>
		<th id="th-estilo2">FOTO</th>

	</tr>
	<?php
	if (isset($_REQUEST["idpac"])){
	$idpaciente=$_GET["idpac"];
	$sql="SELECT p.nom1,nom2,ape1,ape2,fotopac,a.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,tipo_servicio,h.id_hchosp FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN hc_hospitalario h on a.id_adm_hosp=h.id_adm_hosp WHERE p.id_paciente='".$idpaciente."' and estado_adm_hosp='Activo'";

	if ($tabla=$bd1->sub_tuplas($sql)){

		foreach ($tabla as $fila ) {
			echo"<tr >\n";
			echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-ban"></span></button></a></th>';

			echo'<td class="text-center info">'.$fila["id_adm_hosp"].'</td>';
			echo'<td class="text-center info">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
			echo'<td class="text-center info">'.$fila["id_hchosp"].'</td>';
			echo'<td class="text-center info">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
			echo'<td class="text-center info">'.$fila["tipo_servicio"].'</td>';
			echo'<td class="text-center info">'.$fila["fegreso_hosp"].' | '.$fila["hegreso_hosp"].'</td>';
			echo'<td class="text-left info"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login"> </td>';

		}
	}
}
	?>
	</table>
	<br>

  </section>
</div>
</div>
	<?php
}
?>
