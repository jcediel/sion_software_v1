<div align="center"><h2> Registro de Vehículos</h2></div>
<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["fotocon"])){
				if (is_uploaded_file($_FILES["fotocon"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["fotocon"]["name"]);
					$archivo=$_POST["conductor"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["fotocon"]["tmp_name"],FCON.CONDUCTOR.$archivo)){
						$fotoE=",fotoconductor='".CONDUCTOR.$archivo."'";
						$fotoA1=",fotoconductor";
						$fotoA2=",'".CONDUCTOR.$archivo."'";
						}
				}
			}
			$firmaE="";$firmaA1="";$firmaA2="";
			if (isset($_FILES["imgvehi"])){
				if (is_uploaded_file($_FILES["imgvehi"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["imgvehi"]["name"]);
					$archivo=$_POST["placa"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["imgvehi"]["tmp_name"],IVEHI.VEHICULOS.$archivo)){
						$firmaE=",imagenvehiculo='".VEHICULOS.$archivo."'";
						$firmaA1=",imagenvehiculo";
						$firmaA2=",'".VEHICULOS.$archivo."'";
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
				$sql="INSERT INTO vehiculos (id_rutas,id_provexpreso,tipo_vehiculo,placa,num_interno,modelo,capacidad_pasajeros,conductor,contacto_conductor,estado_vehiculo$fotoA1$firmaA1) VALUES
				('".$_POST["idruta"]."','".$_POST["idprov"]."','".$_POST["tvehiculo"]."','".$_POST["placa"]."','".$_POST["num_interno"]."','".$_POST["modelo"]."','".$_POST["cpasajeros"]."','".$_POST["conductor"]."','".$_POST["cconductor"]."','Activo'$fotoA2$firmaA2)";
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
			$sql="SELECT v.id_vehiculo,id_rutas,tipo_vehiculo,tipo_vehiculo,placa,num_interno,modelo,cantidad_pasajeros,conductor,contacto_conductor,estado_vehiculo,e.nom_provexpreso FROM vehiculos v LEFT JOIN ProveedorExpresos e on v.id_provexpreso=e.id_provexpreso where v.id_vehiculo=".$_GET["idveh"];
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de datos del Vehículo';
			break;
			case 'X':
			$sql="SELECT v.id_vehiculo,tipo_vehiculo,id_rutas,tipo_vehiculo,placa,num_interno,modelo,cantidad_pasajeros,conductor,contacto_conductor,estado_vehiculo,e.nom_provexpreso FROM vehiculos v LEFT JOIN ProveedorExpresos e on v.id_provexpreso=e.id_provexpreso where v.id_vehiculo=".$_GET["idveh"];
			$color="red";
			$boton="Eliminar";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$subtitulo='Confirmación para eliminar de datos del Vehículo';
			break;
			case 'A':
			$sql="";
			$color="yellow";
			$boton="Crear";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$subtitulo='Creación de Vehículo';
			break;
		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_vehiculo"=>"","id_rutas"=>"","tipo_vehiculo"=>"","tipo_vehiculo"=>"","placa"=>"","num_interno"=>"","modelo"=>"","cantidad_pasajeros"=>"","conductor"=>"","contacto_conductor"=>"","estado_vehiculo"=>"","id_provexpreso="=>"","nom_provexpreso"=>"","logo"=>"");

			}
		}else{
				$fila=array("id_vehiculo"=>"","id_rutas"=>"","tipo_vehiculo"=>"","tipo_vehiculo"=>"","placa"=>"","num_interno"=>"","modelo"=>"","cantidad_pasajeros"=>"","conductor"=>"","contacto_conductor"=>"","estado_vehiculo"=>"","id_provexpreso="=>"","nom_provexpreso"=>"","logo"=>"");
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
				if (document.forms[0].doc_cliente.value == ""){
					alert("Se requiere el documento del cliente!");
					document.forms[0].doc_cliente.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].tel_cliente.value == ""){
					alert("Se requiere el Teléfono del cliente!");
					document.forms[0].tel_cliente.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  	<article>
		<h3 id="th-estilo2"><?php echo $subtitulo;?></h3>
	</article>
  <section class="panel panel-default">
	<section class="panel panel-body">

	  <article class="col-xs-1">
	  	<label for="">ID:</label>
	  	<input type="text"  name="idveh" class="form-control" value="<?php echo $fila["id_vehiculo"];?>"<?php echo $atributo1;?>/>
	  </article>
	  <article class="col-xs-5">
	  	<label for="">TRANSPORTADORA:</label>
	  	<select name="idprov" class="form-control" <?php echo atributo3; ?>>
				<?php
				$sql="SELECT id_provexpreso,nom_provexpreso from ProveedorExpresos ORDER BY nom_provexpreso ASC";
				if($tabla=$bd1->sub_tuplas($sql)){
					foreach ($tabla as $fila2) {
						if ($fila["id_provexpreso"]==$fila2["id_provexpreso"]){
							$sw=' selected="selected"';
						}else{
							$sw="";
						}
					echo '<option value="'.$fila2["id_provexpreso"].'"'.$sw.'>'.$fila2["nom_provexpreso"].'</option>';
					}
				}

				?>
		</select>
	  </article>
		<article class="col-xs-3">
	  	<label for="">Seleccione Ruta:</label>
	  	<select name="idruta" class="form-control" <?php echo atributo3; ?>>
				<?php
				$sql="SELECT id_rutas,nom_ruta from rutas ORDER BY nom_ruta ASC";
				if($tabla=$bd1->sub_tuplas($sql)){
					foreach ($tabla as $fila2) {
						if ($fila["id_rutas"]==$fila2["id_rutas"]){
							$sw=' selected="selected"';
						}else{
							$sw="";
						}
					echo '<option value="'.$fila2["id_rutas"].'"'.$sw.'>'.$fila2["nom_ruta"].'</option>';
					}
				}

				?>
		</select>
	  </article>
	  <article class="col-xs-2">
	  	<label for="">Tipo Vehículo:</label>
		  	<select name="tvehiculo" class="form-control" <?php echo atributo3; ?>>
				<option value="BUS">BUS</option>
				<option value="VAN">VAN</option>
				<option value="BUSETON">BUSETON</option>
				<option value="BUSETA">BUSETA</option>
				<option value="CAMIONETA">CAMIONETA</option>
				<option value="AUTOMOVIL">AUTOMOVIL</option>
				<option value="MICROBUS">MICROBUS</option>
			</select>
	  </article>
	  <article class="col-xs-2">
	  	<label for="">Placa:</label>
	  	<input type="text" name="placa" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" value="<?php echo $fila["placa"];?>"<?php echo $atributo2;?>/>
	  </article>
	  <article class="col-xs-2">
	  	<label for="">Numero Interno:</label>
	  	<input type="text" name="num_interno" class="form-control"  value="<?php echo $fila["num_interno"];?>"<?php echo $atributo2;?>/>
	  </article>
	  <article class="col-xs-2">
	  	<label for="">Modelo:</label>
	  	<input type="text" name="modelo"  class="form-control" value="<?php echo $fila["modelo"];?>"<?php echo $atributo2;?>/>
	  </article>
	  <article class="col-xs-2">
	  	<label for="">Capacidad Pasajeros:</label>
	  	<input type="number" name="cpasajeros"  class="form-control" value="<?php echo $fila["capacidad_pasajeros"];?>"<?php echo $atributo2;?>/>
	  </article>
	  <article class="col-xs-4">
	  	<label for="">Conductor:</label>
	  	<input type="text" name="conductor" class="form-control"  value="<?php echo $fila["num_interno"];?>"<?php echo $atributo2;?>/>
	  </article>
	  <article class="col-xs-4">
	  	<label for="">Contacto Conductor:</label>
	  	<input type="text" name="cconductor"  class="form-control" value="<?php echo $fila["modelo"];?>"<?php echo $atributo2;?>/>
	  </article>
	  <article class="col-xs-3">
	  	<label for="">Estado:</label>
	  	<select name="estado_vehiculo" class="form-control" <?php echo atributo3;?>>
			<option value="Activo" selected="selected">Activo</option>
			<option value="Inactivo" >Inactivo</option>
		</select>
	  </article>

	</section>
	<section class="panel">
		<article class="col-xs-4">
	  	<label for="">Foto Conductor:</label>
	  	<?php echo $fila["fotocon"];?><br/>
		<input type="file" class="form-control" name="fotocon" <?php echo $atributo2; ?>/><br>
	  </article>
		<article class="col-xs-4">
	  	<label for="">Imagen Vehiculo:</label>
	  	<?php echo $fila["imgvehi"];?><br/>
		<input type="file" class="form-control" name="imgvehi" <?php echo $atributo2; ?>/><br>
	  </article>
	</section>
	<div class="row text-center">
	  	<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="reset" class="btn btn-primary" Value="Reestablecer"/>
		<input type="submit" class="btn btn-primary" name="aceptar" Value="Descartar"/>
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>

<?php
}else{
	echo $subtitulo;
// nivel 1?>
<div class="panel panel-default">
<div class="panel-body">
	<section class="panel panel-default" id="search2">
		<form class="navbar-form navbar-center" role="search">
        	<section class="form-group">
          		<input type="text" class="form-control" name="placa" placeholder="Digite Nombre de ruta ">
        	</section>
        	<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
        	<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
      	</form>
	</section>
<table class="table table-responsive">
	<tr>
		<th colspan="2" id="th-estilo1"></th>
		<th id="th-estilo2">ID</th>
		<th id="th-estilo2">TRANSPORTADORA</th>
		<th id="th-estilo2">NOMBRE RUTA</th>
		<th id="th-estilo2">PLACA</th>
		<th id="th-estilo2">CONDUCTOR</th>
		<th id="th-estilo2">VEHICULO</th>
		<th id="th-estilo3">CHECK DETALLE</th>
		<th id="th-estilo3">CHECK TÉCNICO</th>
		<th id="th-estilo3">SOPORTES</th>
	</tr>

	<?php
	if (isset($_REQUEST["placa"])){
	$fecha=$_REQUEST["placa"];
	$sql="SELECT v.id_vehiculo,tipo_vehiculo,placa,num_interno,modelo,estado_vehiculo,fotoconductor,imagenvehiculo,e.id_provexpreso,nom_provexpreso,r.nom_ruta FROM vehiculos v LEFT JOIN ProveedorExpresos e on v.id_provexpreso=e.id_provexpreso LEFT JOIN rutas r on v.id_rutas=r.id_rutas  where r.nom_ruta='".$fecha."'";

	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {

			echo"<tr >\n";
			echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=X&idveh='.$fila["id_vehiculo"].'"><button type="button" class="btn btn-primary" ><span class="glyphicon glyphicon-pencil"></span></button></a></th>';
			echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=X&idveh='.$fila["id_vehiculo"].'"><button type="button" class="btn btn-primary" ><span class="glyphicon glyphicon-trash"></span></button></a></th>';
			echo'<td class="text-center">'.$fila["id_vehiculo"].'</td>';
			echo'<td class="text-center">'.$fila["nom_provexpreso"].'</td>';
			echo'<td class="text-center">'.$fila["nom_ruta"].'</td>';
			echo'<td class="text-center">'.$fila["placa"].'</td>';
			echo'<td class="text-center"><img src="'.$fila["fotoconductor"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalcon"> </td>';
			echo'<td class="text-center"><img src="'.$fila["imagenvehiculo"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalvhi" > </td>';
			echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion=12&idveh='.$fila["id_vehiculo"].'"><button type="button" class="btn btn-danger" >Detallado</button></a></th>';
			echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion=13&idveh='.$fila["id_vehiculo"].'"><button type="button" class="btn btn-danger" >Técnico</button></a></th>';
			echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion=14&idveh='.$fila["id_vehiculo"].'"><button type="button" class="btn btn-danger" >Soportes</button></a></th>';
			echo "</tr>\n";
		}
	}
}

	?>

	<tr>
		<th colspan="11" class="text-center"><a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A';?>"><button type="button" class="btn btn-primary" >Adicionar Vehículo</button>
		</a></th>
	</tr>
</table>
</div>
</div>
<section class="modal fade" id="modalvhi" role="dialog">
	<section class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" >Conductor Asignado al Vehiculo</h4>
			</div>
			<div class="modal-body">
				<table class="table table-responsive lettermodal">
					<tr>
						<th>NUMERO INTERNO</th>
						<th>PLACA</th>
						<th>MODELO</th>
						<th># PASAJEROS</th>
					</tr>

					<?php
					if (isset($_REQUEST["placa"])){
					$fecha=$_REQUEST["placa"];
					$sql="SELECT id_vehiculo,num_interno,placa,modelo,capacidad_pasajeros,imagenvehiculo FROM vehiculos where placa='".$fecha."'";

					if ($tabla=$bd1->sub_tuplas($sql)){
						//echo $sql;
						foreach ($tabla as $fila ) {

							echo"<tr >\n";
							echo'<td class="text-center">'.$fila["num_interno"].'</td>';
							echo'<td class="text-center">'.$fila["placa"].'</td>';
							echo'<td class="text-center">'.$fila["modelo"].'</td>';
							echo'<td class="text-center">'.$fila["cantidad_pasajeros"].'</td>';
							echo "</tr>\n";
						}
					}
				}

					?>

					<?php
						echo'<td class="text-center"><img src="'.$fila["imagenvehiculo"].'"alt ="foto" class="image_zoom text-center"> </td>';
					 ?>

				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</section>
</section>
<section class="modal fade" id="modalcon" role="dialog">
	<section class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" >Conductor Asignado al Vehiculo</h4>
			</div>
			<div class="modal-body">
				<table class="table table-responsive lettermodal">
					<tr>
						<th id="th-estilo2">NOMBRE CONDUCTOR</th>
						<th id="th-estilo1">TELEFONO CONDUCTOR</th>

					</tr>

					<?php
					if (isset($_REQUEST["placa"])){
					$fecha=$_REQUEST["placa"];
					$sql="SELECT id_vehiculo,conductor,placa,contacto_conductor,fotoconductor FROM vehiculos where placa='".$fecha."'";

					if ($tabla=$bd1->sub_tuplas($sql)){
						//echo $sql;
						foreach ($tabla as $fila ) {

							echo"<tr >\n";
							echo'<td class="text-center">'.$fila["conductor"].'</td>';
							echo'<td class="text-center">'.$fila["contacto_conductor"].'</td>';

							echo "</tr>\n";
						}
					}
				}

					?>
					<tr>
						<th class="text-center">FOTO</th>
					</tr>
					<?php
						echo'<td class="text-center"><img src="'.$fila["fotoconductor"].'"alt ="foto" class="image_zoom"> </td>';
					 ?>

				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</section>
</section>
	<?php
}
?>
