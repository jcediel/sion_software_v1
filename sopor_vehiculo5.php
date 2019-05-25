<div align="center"><h2>Gestor de Documentacion PESV</h2></div>

<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["foto"])){
				if (is_uploaded_file($_FILES["foto"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["foto"]["name"]);
					$archivo=$_POST["tsoporte"].$_POST["placa"].$_POST["Transportadora"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["foto"]["tmp_name"],WEB.SOPORTE.$archivo)){
						$fotoE=",foto='".SOPORTE.$archivo."'";
						$fotoA1=",foto";
						$fotoA2=",'".SOPORTE.$archivo."'";
						}
				}
			}

			switch ($_POST["operacion"]) {
			case 'E':
				$sql="UPDATE user SET nombre='".$_POST["nombre"]."',cuenta='".$_POST["cuenta"]."',id_perfil='".$_POST["id_perfil"]."',estado='".$_POST["estado"]."'$fotoE$claveE WHERE id_user=".$_POST["idu"];
				$subtitulo="Actualizado";
			break;
			case 'X':
				$sql="SELECT foto from user where id_user=".$_POST["idu"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("foto"=> "");
				}
				$sql="DELETE FROM user WHERE id_user=".$_POST["idu"];
				$subtitulo="Eliminado";
			break;
			case 'A':
				$sql="INSERT INTO soportes (id_vehiculo,tipo_soporte,aseguradora,fecha_expedicion,fecha_vencimiento,codigounico$fotoA1,estado_soporte)
				VALUES ('".$_POST["idv"]."','".$_POST["tsoporte"]."','".$_POST["aseguradora"]."','".$_POST["fexpedicion"]."','".$_POST["fvencimiento"]."','".$_POST["codunico"]."'$fotoA2,'".$_POST["estado_soporte"]."')";
				$subtitulo="Adicionado";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El registro fue $subtitulo con exito!";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["foto"])){
				unlink($fila["foto"]);
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
			$sql="SELECT id_user,nombre,cuenta,foto,estado,id_perfil FROM  user where id_user=".$_GET["idu"];
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de datos del Usuario';
			break;
			case 'X':
			$sql="SELECT id_user,nombre,cuenta,foto,estado,id_perfil FROM  user where id_user=".$_GET["idu"];
			$color="red";
			$boton="Eliminar";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$subtitulo='Confirmación para eliminar de datos del Usuario';
			break;
			case 'A':
			$sql="";
			$color="yellow";
			$boton="Crear";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Subida de archivos';
			break;
		}
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_user"=>"","nombre"=>"","cuenta"=>"","foto"=>"","estado"=>"","id_perfil"=>"");
			}
		}else{
				$fila=array("id_user"=>"","nombre"=>"","cuenta"=>"","foto"=>"","estado"=>"","id_perfil"=>"");
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nombre.value == ""){
					alert("Se requiere el nombre del usuario!");
					document.forms[0].nombre.focus();				// Ubicar el cursor
					return(false);
				}

			}
		</script>
<form action="<?php echo PROGRAMA;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()">

  		<article id="th-estilo2">
			<?php echo $subtitulo;?>
		</article>
	<section class="panel panel-default">
	<section class="panel panel-body">
	<?php
	$idvehiculo=$_GET["idveh"];
	$sql1="SELECT v.id_vehiculo,tipo_vehiculo,placa,modelo,num_interno,capacidad_pasajeros,e.id_provexpreso,nom_provexpreso FROM vehiculos v LEFT JOIN ProveedorExpresos e on v.id_provexpreso=e.id_provexpreso where v.id_vehiculo='".$idvehiculo."'";

	if ($tabla=$bd1->sub_tuplas($sql1)){
		//echo $sql;
		foreach ($tabla as $fila1 ) {
			echo'<article class="col-xs-1"><label for="">ID: </label><input type="text" name="idv" class="form-control" value="'.$fila1["id_vehiculo"].'" '.$atributo1.'></article>';
			echo'<article class="col-xs-3"><label for="">Transportadora: </label><input type="text" name="Transportadora" class="form-control" value="'.$fila1["nom_provexpreso"].'" '.$atributo1.'></article>';
			echo'<article class="col-xs-2"><label for="">Tipo Vehículo: </label><input type="text" name="tvehiculo" class="form-control" value=" '.$fila1["tipo_vehiculo"].'" '.$atributo1.'></article>';
			echo'<article class="col-xs-2"><label for="">Placa: </label><input type="text" name="placa" class="form-control" value="'.$fila1["placa"].'" '.$atributo1.'></article>';
			echo'<article class="col-xs-2"><label for="">Modelo: </label><input type="text" name="modelo" class="form-control" value="'.$fila1["modelo"].'" '.$atributo1.'></article>';
			echo'<article class="col-xs-1"><label for="">#Interno: </label><input type="text" name="num_interno" class="form-control" value="'.$fila1["num_interno"].'" '.$atributo1.'></article>';
			echo'<article class="col-xs-1"><label for="">#Pasajeros: </label><input type="text" name="cpasajeros" class="form-control" value="'.$fila1["capacidad_pasajeros"].'" '.$atributo1.'></article>';
		}
	}
	?>
	</section>
</section>
<section class="panel panel-default">
	<section class="panel panel-body text-center">
		<article class="col-xs-4">
	  		<label for="">Tipo de soporte:</label>
		  	<select name="tsoporte" class="form-control" <?php echo atributo3; ?>>
				<option value="Tarjeta de propiedad">Tarjeta de propiedad</option>
				<option value="SOAT">SOAT</option>
				<option value="Tecnomecanica">Tecnomecanica</option>
				<option value="Tarjeta de operacion">Tarjeta de operación</option>
				<option value="Polizas">Polizas</option>
				<option value="seguro Contractual">Seguro Contractual</option>
				<option value="Seguro Extracontractual">Seguro Extracontractual</option>
				<option value="pase">pase</option>
			</select>
	  	</article>
		<article class="col-xs-5">
	  		<label for="">Aseguradora:</label>
		  	<select name="aseguradora" class="form-control" <?php echo atributo3; ?>>
				<option value="ACE SEGUROS S.A.">ACE SEGUROS S.A.</option>
				<option value="AIG SEGUROS COLOMBIA S.A.">AIG SEGUROS COLOMBIA S.A.</option>
				<option value="ALLIANZ SEGUROS S.A">ALLIANZ SEGUROS S.A</option>
				<option value="ARL SURA">ARL SURA</option>
				<option value="ASEGURADORA SOLIDARIA DE COLOMBIA LTDA, ENTIDAD COOPERATIVA">ASEGURADORA SOLIDARIA DE COLOMBIA LTDA, ENTIDAD COOPERATIVA</option>
				<option value="AXA COLPATRIA SEGUROS S.A.">AXA COLPATRIA SEGUROS S.A.</option>
				<option value="BBVA SEGUROS COLOMBIA S.A.">BBVA SEGUROS COLOMBIA S.A.</option>
				<option value="BNP PARIBAS CARDIF COLOMBIA">BNP PARIBAS CARDIF COLOMBIA</option>
				<option value="JMALUCELLI TRAVELERS SEGUROS S.A">JMALUCELLI TRAVELERS SEGUROS S.A</option>
				<option value="CHUBB DE COLOMBIA COMPAÑÍA DE SEGUROS S.A.">CHUBB DE COLOMBIA COMPAÑÍA DE SEGUROS S.A.</option>
				<option value="COFACE COLOMBIA SEGUROS DE CRÉDITO S.A">COFACE COLOMBIA SEGUROS DE CRÉDITO S.A</option>
				<option value="COMPAÑÍA ASEGURADORA DE FIANZAS S.A. CONFIANZA">COMPAÑÍA ASEGURADORA DE FIANZAS S.A. CONFIANZA</option>
				<option value="COMPAÑÍA MUNDIAL SEGUROS S.A.">COMPAÑÍA MUNDIAL SEGUROS S.A.</option>
				<option value="CONDOR S.A. COMPAÑÍA DE SEGUROS GENERALES">CONDOR S.A. COMPAÑÍA DE SEGUROS GENERALES</option>
				<option value="GENERALI COLOMBIA SEGUROS GENERALES S.A.">GENERALI COLOMBIA SEGUROS GENERALES S.A.</option>
				<option value="GRUPO COLMENA CAPITALIZADORA COLMENA S.A.">GRUPO COLMENA CAPITALIZADORA COLMENA S.A.</option>
				<option value="COMPAÑÍA SEGUROS BOLÍVAR">COMPAÑÍA SEGUROS BOLÍVAR</option>
				<option value="LA EQUIDAD SEGUROS GENERALES ORGANISMO COOPERATIVO">LA EQUIDAD SEGUROS GENERALES ORGANISMO COOPERATIVO</option>
				<option value="LA PREVISORA S.A. COMPAÑÍA DE SEGUROS">LA PREVISORA S.A. COMPAÑÍA DE SEGUROS</option>
				<option value="LIBERTY SEGUROS S.A.">LIBERTY SEGUROS S.A.</option>
				<option value="MAPFRE SEGUROS GENERALES DE COLOMBIA S.A.">MAPFRE SEGUROS GENERALES DE COLOMBIA S.A.</option>
				<option value="PAN AMERICAN LIFE DE COLOMBIA COMPAÑÍA DE SEGUROS S.A.">PAN AMERICAN LIFE DE COLOMBIA COMPAÑÍA DE SEGUROS S.A.</option>
				<option value="POSITIVA COMPAÑÍA DE SEGUROS">POSITIVA COMPAÑÍA DE SEGUROS</option>
				<option value="QBE SEGUROS S.A.">QBE SEGUROS S.A.</option>
				<option value="ROYAL & SUN ALLIANCE SEGUROS S.A.">ROYAL & SUN ALLIANCE SEGUROS S.A.</option>
				<option value="SEGUREXPO DE COLOMBIA S.A.">SEGUREXPO DE COLOMBIA S.A.</option>
				<option value="SEGUROS DEL ESTADO S.A.">SEGUROS DEL ESTADO S.A.</option>
				<option value="SEGUROS GENERALES SURAMERICANA S.A.">SEGUROS GENERALES SURAMERICANA S.A.</option>
			</select>
	  	</article>
	  	<article class="col-xs-4">
	  		<label for="">Fecha Expedición:</label>
	  		<input type="date" name="fexpedicion"  class="form-control" value="<?php echo $fila["fecha_expedicion"];?>"<?php echo $atributo2;?>/>
	  	</article>
	  	<article class="col-xs-4">
	  		<label for="">Fecha Vencimiento:</label>
	  		<input type="date" name="fvencimiento"  class="form-control" value="<?php echo $fila["fecha_vencimiento"];?>"<?php echo $atributo2;?>/>
	  	</article>
	  	<article class="col-xs-3">
	  		<label for="">Código Unico:</label>
	  		<input type="text" name="codunico"  class="form-control" value=""<?php echo $atributo2;?>/>
	  	</article>
		<article class="col-xs-6">
			<label>Suba aqui el soporte:</label>
			<?php echo $fila["foto"];?><br>
			<input type="file" class="form-control" name="foto" <?php echo $atributo3; ?>/>
		</article>
		<article class="col-xs-3">
			<label>Estado:</label><br>
			<select name="estado_soporte" class="form-control" <?php echo atributo3; ?>>
				<option value="Activo" selected="selected" class="form-control">Activo</option>
				<option value="Inactivo" >Inactivo</option>
			</select>
		</article>
	</section>
		<div class="text-center panel panel-body">
			<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="reset" class="btn btn-primary" Value="Reestablecer"/>
			<input type="submit" class="btn btn-primary" name="aceptar" Value="Descartar"/>
			<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>

	</section>
</form>

<?php
}else{
	echo $subtitulo;
// nivel 1?>
<div class="panel panel-default">
<div class="panel-body">
<button type="button" class="btn btn-link"><a href="<?php echo PROGRAMA.'?opcion=9';?>"><span class="glyphicon glyphicon-triangle-left">Regresar a Zona de vehículos</span></a></button>	
<table class="table table-responsive">
	<tr>
		<th id="th-estilo2">TRANSPORTADORA</th>
		<th id="th-estilo1">VEHICULO</th>
		<th id="th-estilo1"></th>
	</tr>
	<?php
	if (isset($_REQUEST["idveh"])){
	$idvehiculo=$_GET["idveh"];
	$sql="SELECT v.id_vehiculo,tipo_vehiculo,placa,e.id_provexpreso,nom_provexpreso FROM vehiculos v LEFT JOIN ProveedorExpresos e on v.id_provexpreso=e.id_provexpreso where v.id_vehiculo='".$idvehiculo."'";
	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {
			echo"<tr >\n";
			echo'<td class="text-center">'.$fila["nom_provexpreso"].'</td>';
			echo'<td class="text-center"><strong>'.$fila["tipo_vehiculo"].'</strong> con Placa <strong>'.$fila["placa"].'</strong></td>';
			echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idveh='.$fila["id_vehiculo"].'"><button type="button" class="btn btn-primary" ><span class="glyphicon glyphicon-plus"></span></button></a></th>';
			echo "</tr>\n";
		}
	}
}
	?>
	</table>
	<br>
	<button data-toggle="collapse" class="btn btn-primary" data-target="#demo">Ver lista de inspecciones <span class="glyphicon glyphicon-arrow-down"></span> </button>
  <section id="demo" class="collapse">
  	<table class="table table-responsive">
	<tr>
		<th id="th-estilo1">ID</th>
		<th id="th-estilo2">TIPO SOPORTE</th>
		<th id="th-estilo1">ASEGURADORA</th>
		<th id="th-estilo1">VENCIMIENTO</th>
		<th id="th-estilo1">ESTADO</th>
		<th id="th-estilo2"></th>
	</tr>

	<?php
	if (isset($_REQUEST["idveh"])){
	$idcli=$_GET["idveh"];
	$sql="SELECT id_soporte,id_vehiculo,tipo_soporte,aseguradora,fecha_vencimiento,estado_soporte FROM soportes where id_vehiculo=".$idcli." ORDER BY tipo_soporte ASC";

if ($tabla=$bd1->sub_tuplas($sql)){
	foreach ($tabla as $fila ) {
		echo"<tr>\n";
		echo'<td class="text-right">'.$fila["id_soporte"].'</td>';
		echo'<td class="text-left">'.$fila["tipo_soporte"].'</td>';
		echo'<td class="text-left">'.$fila["aseguradora"].'</td>';
		echo'<td class="text-left">'.$fila["fecha_vencimiento"].'</td>';
		echo'<td class="text-left">'.$fila["estado_soporte"].'</td>';
		echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idveh='.$fila["id_vehiculo"].'&idp='.$fila["id_soporte"].'"><button type="button" class="btn btn-primary" ><span class="glyphicon glyphicon-eye-open"></span></button></a></th>';
		echo "</tr>\n";
	}
}
}
	?>

</table>
  </section>
</div>
</div>
	<?php
}
?>
