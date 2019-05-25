<div align="center"><h2>Inspección Detallada del Vehículo</h2></div>
<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

			switch ($_POST["operacion"]) {
			case 'E':

			break;
			case 'A':
				$sql="INSERT INTO pesvdetalle (id_vehiculo,fechareg,extintor,prese_conductor,higiene,aire,silla,tv,sonido,baño,obs_pesvdetalle,resp_revision) VALUES
				('".$_POST["idv"]."','".$_POST["fechareg1"]."','".$_POST["extintor"]."','".$_POST["pconductor"]."','".$_POST["higiene"]."','".$_POST["aire"]."','".$_POST["sillas"]."','".$_POST["tv"]."','".$_POST["sonido"]."','".$_POST["baño"]."','".$_POST["obspesvdetalle"]."','".$_POST["resp_pesvdetalle"]."')";
				$subtitulo="Adicionado";
			break;
		}
		echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El registro fue $subtitulo con exito!";
		}else{
			$subtitulo="El registro NO fue $subtitulo !!! .";
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'E':
			$sql="SELECT id_pesvdetalle,id_vehiculo,fechareg,extintor,prese_conductor,higiene,aire,silla,tv,sonido,baño,obs_pesvdetalle,resp_revision from pesvdetalle where id_pesvdetalle=".$_GET["idp"];
			$color="green";
			$boton="Imprimir";
			$atributo1=' readonly="readonly"';
			$atributo2='readonly="readonly"';
			$atributo3='';
			$subtitulo='';
			$freg='text';
			$freg1='hidden';
			$valor='hidden';
			$valor1='text';
			$ext='text';

			break;

			case 'A':
			$sql="";
			$color="yellow";
			$boton="Crear";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Adicionar lista';
			$date=date('Y-m-d');
			$valor='visible';
			$valor1='hidden';
			$freg1='hidden';
			$freg='text';
			$ext='date';
			break;
		}
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_pesvdetalle"=>"","id_vehiculo"=>"","fechareg"=>"","extintor"=>"","prese_conductor"=>"","higiene"=>"","aire"=>"","silla"=>"","tv"=>"","sonido"=>"","baño"=>"","obs_pesvdetalle"=>"","resp_revision"=>"");
			}
		}else{
				$fila=array("id_pesvdetalle"=>"","id_vehiculo"=>"","fechareg"=>"","extintor"=>"","prese_conductor"=>"","higiene"=>"","aire"=>"","silla"=>"","tv"=>"","sonido"=>"","baño"=>"","obs_pesvdetalle"=>"","resp_revision"=>"");
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
	<button type="button" class="btn btn-link"><a href="<?php echo PROGRAMA.'?opcion=12';?>"><span class="glyphicon glyphicon-triangle-left">Regresar a Zona de vehículos</span></a></button>
<form action="<?php echo PROGRAMA.'?opcion=12';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<article>
		<h3 id="th-estilo2">Información del Vehículo</h3>
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
	<article>
		<h3 id="th-estilo2">Datos de Evaluación</h3>
	</article>
<section class="panel panel-default">
	<section class="panel panel-body">
		<article class="col-xs-1">
		  <label for="">ID:</label>
		  <input type="text"  name="idpesvd" class="form-control" value="<?php echo $fila["id_pesvdetalle"];?>"<?php echo $atributo1;?>/>
		</article>
	    <article class="col-xs-3">
		  <label for="">Fecha Registro:</label>
		  <input type="<?php echo $freg1;?>" name="fechareg" class="form-control" value="<?php echo $fila["fechareg"];?>"<?php echo $atributo1;?>/>
		  <input type="<?php echo $freg;?>" name="fechareg1" class="form-control" value="<?php echo $date;?>"<?php echo $atributo1;?>/>
		</article>
		<article class="col-xs-3">
		  <label for="">Extintor:</label>
		  <input type="<?php echo $ext;?>" name="extintor" class="form-control" value="<?php echo $fila["extintor"];?>"<?php echo $atributo2;?>/>
		</article>
	</section>
</section>
<section class="panel panel-default">
	<section class="panel panel-body">
		<table class="table table-hover">
			<tr>
				<th><label for="">Presentación del conductor:</label></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="pconductor" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="pconductor1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><label for="">Higuiene del Vehículo:</label></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="higiene" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
				<input type="<?php echo $valor1 ;?>" name="higiene1" class="form-control" value="<?php echo $fila["higiene"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><label for="">Aire Acondicionado:</label></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="aire" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
				<input type="<?php echo $valor1 ;?>" name="aire1" class="form-control" value="<?php echo $fila["aire"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><label for="">Sillas Reclinables:</label></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="sillas" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
				<input type="<?php echo $valor1 ;?>" name="sillas1" class="form-control" value="<?php echo $fila["silla"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><label for="">Servicio de TV:</label></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="tv" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
				<input type="<?php echo $valor1 ;?>" name="tv1" class="form-control" value="<?php echo $fila["tv"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><label for="">Sonido:</label></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="sonido" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
				<input type="<?php echo $valor1 ;?>" name="sonido1" class="form-control" value="<?php echo $fila["sonido"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><label for="">Baños:</label></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="baño" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="baño1" class="form-control" value="<?php echo $fila["baño"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
		</table>

		</article>
	</section>
	<section class="panel panel-body">
		<label for="">Observaciones:</label>
		<textarea class="form-control" name="obspesvdetalle" <?php echo $atributo2;?>><?php echo $fila["obs_pesvdetalle"];?></textarea>
		<input type="hidden" name="resp_pesvdetalle" value="<?php echo $_SESSION["AUT"]["nombre"]; ?>">
	</section>
</section>
	<div class="row text-center">
	  	<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="reset" class="btn btn-primary" Value="Reestablecer"/>
		<input type="submit" class="btn btn-primary" name="aceptar" Value="Descartar"/>
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
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
		<th id="th-estilo2"></th>
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
		<th id="th-estilo2">FECHA REGISTRO</th>
		<th id="th-estilo1">OBSERVACIONES</th>
		<th id="th-estilo2"></th>
	</tr>

	<?php
	$idcli=$_GET["idveh"];
	$sql="SELECT id_pesvdetalle,id_vehiculo,fechareg,obs_pesvdetalle FROM pesvdetalle where id_vehiculo=".$idcli." ORDER BY fechareg ASC";

if ($tabla=$bd1->sub_tuplas($sql)){
	foreach ($tabla as $fila ) {
		echo"<tr>\n";
		echo'<td class="text-right">'.$fila["id_pesvdetalle"].'</td>';
		echo'<td class="text-left">'.$fila["fechareg"].'</td>';
		echo'<td class="text-left">'.$fila["obs_pesvdetalle"].'</td>';
		echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idveh='.$fila["id_vehiculo"].'&idp='.$fila["id_pesvdetalle"].'"><button type="button" class="btn btn-primary" ><span class="glyphicon glyphicon-eye-open"></span></button></a></th>';
		echo "</tr>\n";
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
