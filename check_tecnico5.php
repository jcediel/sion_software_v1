<div align="center"><h2>Inspección Técnica del Vehículo</h2></div>
<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

			switch ($_POST["operacion"]) {
			case 'E':

			break;
			case 'A':
				$sql="INSERT INTO pesvtecnico (id_vehiculo,fechareg_pesvtec,fugas,llantas,sisaire,exhosto,nivelliquidos,aguabateria,tablero,espejos,alarmas,frenos,cajacambios,volante,acceso,pasamanos,silleteria,cinturones,pisos,iluminacion,ventemergencia,obs_pesvtecnico,resp_pesvtec) VALUES
				('".$_POST["idv"]."','".$_POST["fechareg"]."','".$_POST["fugas"]."','".$_POST["llantas"]."','".$_POST["sisaire"]."','".$_POST["exhosto"]."','".$_POST["nivelliquidos"]."','".$_POST["aguabateria"]."','".$_POST["tablero"]."','".$_POST["espejos"]."','".$_POST["alarmas"]."','".$_POST["frenos"]."','".$_POST["cajacambios"]."','".$_POST["volante"]."','".$_POST["acceso"]."','".$_POST["pasamanos"]."','".$_POST["silleteria"]."','".$_POST["cinturones"]."','".$_POST["pisos"]."','".$_POST["iluminacion"]."','".$_POST["ventemergencia"]."','".$_POST["obspesvtecnico"]."','".$_POST["resp_pesvtec"]."')";
				$subtitulo="Adicionado";


			break;
		}
		//echo $sql;
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
			$sql="SELECT id_pesvtecnico,id_vehiculo,fechareg_pesvtec,fugas,llantas,sisaire,exhosto,nivelliquidos,aguabateria,tablero,espejos,alarmas,frenos,cajacambios,volante,acceso,pasamanos,silleteria,cinturones,pisos,iluminacion,venetemergencia,obs_pesvtecnico,resp_pesvtec from pesvtecnico where id_pesvtecnico=".$_GET["idp"];
			$color="green";
			$boton="Imprimir";
			$atributo1=' readonly="readonly"';
			$atributo2='readonly="readonly"';
			$atributo3='';
			$subtitulo='';
			$freg='hidden';
			$freg1='text';
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
				$fila=array("id_pesvtecnico"=>"","id_vehiculo"=>"","fechareg_pesvtec"=>"","extintor"=>"","prese_conductor"=>"","higiene"=>"","aire"=>"","silla"=>"","tv"=>"","sonido"=>"","baño"=>"","obs_pesvtecnico"=>"","resp_revision"=>"");
			}
		}else{
				$fila=array("id_pesvtecnico"=>"","id_vehiculo"=>"","fechareg_pesvtec"=>"","extintor"=>"","prese_conductor"=>"","higiene"=>"","aire"=>"","silla"=>"","tv"=>"","sonido"=>"","baño"=>"","obs_pesvtecnico"=>"","resp_revision"=>"");
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
	<button type="button" class="btn btn-link"><a href="<?php echo PROGRAMA.'?opcion=12';?>"><span class="glyphicon glyphicon-triangle-left"></span></a></button>
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
		<h3 id="th-estilo2">Revisión Técnica del vehículo</h3>
	</article>
<section class="panel panel-default">
	<section class="panel panel-body">
		<article class="col-xs-1">
		  <label for="">ID:</label>
		  <input type="text"  name="idpesvd" class="form-control" value="<?php echo $fila["id_pesvtecnico"];?>"<?php echo $atributo1;?>/>
		</article>
	    <article class="col-xs-3">
		  <label for="">Fecha Registro:</label>
		  <input type="<?php echo $freg;?>" name="fechareg" class="form-control" value="<?php echo date('Y-m-d');?>"<?php echo $atributo1;?>/>
		  <input type="<?php echo $freg1;?>" name="fechareg1" class="form-control" value="<?php echo $fila["fechareg_pesvtec"];?>"<?php echo $atributo1;?>/>
		</article>
	</section>
</section>
<section class="panel panel-default">
	<section class="panel panel-body">
		<table class="table table-hover">
			<tr>
				<th rowspan="5">
					<h4><strong>Parte Externa</strong></h4>
				</th>
			</tr>
			<tr>
				<th><label for="">Verificar presencia de fugas de fluidos defectos o daños:</label></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="fugas" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="fugas1" class="form-control" value="<?php echo $fila["fugas"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><label for="">Estado de las llantas. Presión. Defectos:</label></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="llantas" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="llantas1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><label for="">Sistema de aire(mangueras, tanques, conexiones):</label></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="sisaire" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="sisaire1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><label for="">Exhosto: roturas, porosidad:</label></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="exhosto" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="exhosto1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th rowspan="3">
					<h4><strong>Compartimiento del motor</strong></h4>
				</th>
			</tr>
			<tr>
				<th><label for="">Niveles de aceite, de refrigerante y de liquido de frenos:</label></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="nivelliquidos" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="nivelliquidos1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><label for="">Agua de Batería:</label></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="aguabateria" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="aguabateria1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th rowspan="7">
					<h4><strong>Interior del Vehículo</strong></h4>
				</th>
			</tr>
			<tr>
				<th><p>Tablero de instrumentos:Velocimetro,gasolina,carga de batería, direccionales,temperatura, luces.</p></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="tablero" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="tablero1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><label for="">Espejos:Limpios, libres de daños, bien ajustados y máxima visibilidad.</label></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="espejos" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="espejos1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><p>Pito y alarma de reversa.</p></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="alarmas" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="alarmas1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><p>Frenos: Hacer prueba de frenado.</p></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="frenos" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="frenos1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><p>Palanca de cambios: Hacer prueba y verificar caja de cambios normal.</p></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="cajacambios" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="cajacambios1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><p>Volante: Hacer prueba y verificar dirección normal.</p></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="volante" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="volante1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th rowspan="8">
					<h4><strong>Cabina de pasajeros</strong></h4>
				</th>
			</tr>
			<tr>
				<th><p>Escaleras de Acceso.</p></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="acceso" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="acceso1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><label for="">Pasamanos del techo.</label></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="pasamanos" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="pasamanos1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><p>Silletería.</p></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="silleteria" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="silleteria1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><p>Cinturones de seguridad.</p></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="cinturones" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="cinturones1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><p>Estado de pisos: Sin obstáculos.</p></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="pisos" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="pisos1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><p>Iluminación interior.</p></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="iluminacion" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="iluminacion1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
			<tr>
				<th><p>Ventana de emergencia.</p></th>
				<td>
				<select style="visibility:<?php echo $valor; ?>" name="ventemergencia" class="form-control">
					<option value="SI">SI</option>
					<option value="NO">NO</option>
		  		</select>
		  		<input type="<?php echo $valor1 ;?>" name="ventemergencia1" class="form-control" value="<?php echo $fila["prese_conductor"];?>" <?php echo $atributo1;?>>
		  		</td>
			</tr>
		</table>

		</article>
	</section>
	<section class="panel panel-body">
		<label for="">Observaciones:</label>
		<textarea class="form-control" name="obspesvtecnico" <?php echo $atributo2;?>><?php echo $fila["obs_pesvtecnico"];?></textarea>
		<input type="hidden" name="resp_pesvtec" value="<?php echo $_SESSION["AUT"]["nombre"]; ?>">
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
  	<table class="table table-bordered">
	<tr>
		<th id="th-estilo1">ID</th>
		<th id="th-estilo2">FECHA REGISTRO</th>
		<th id="th-estilo1">OBSERVACIONES</th>
		<th id="th-estilo2"></th>
	</tr>

	<?php
	if (isset($_REQUEST["idveh"])){
	$idcli=$_GET["idveh"];
	$sql="SELECT id_pesvtecnico,id_vehiculo,fechareg_pesvtec,obs_pesvtecnico FROM pesvtecnico where id_vehiculo=".$idcli." ORDER BY fechareg_pesvtec ASC";

if ($tabla=$bd1->sub_tuplas($sql)){
	foreach ($tabla as $fila ) {
		echo"<tr>\n";
		echo'<td class="text-right">'.$fila["id_pesvtecnico"].'</td>';
		echo'<td class="text-left">'.$fila["fechareg_pesvtec"].'</td>';
		echo'<td class="text-left">'.$fila["obs_pesvtecnico"].'</td>';
		echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idveh='.$fila["id_vehiculo"].'&idp='.$fila["id_pesvtecnico"].'"><button type="button" class="btn btn-primary" ><span class="glyphicon glyphicon-eye-open"></span></button></a></th>';
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
