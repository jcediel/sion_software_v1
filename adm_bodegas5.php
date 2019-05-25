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
				$sql="UPDATE bodega SET id_sedes_ips='".$_POST["id_sedes"]."',nom_bodega='".$_POST["nom_bodega"]."',tipo_bodega='".$_POST["tipo_bodega"]."',estado_bodega='".$_POST["estado_act"]."' WHERE id_bodega=".$_POST["id_bodega"];
				$subtitulo1="La bodega";
				$subtitulo="Actualizado";
			break;

			case 'A':
				$f=date('Y-m-d H:m');
				$sql="INSERT INTO bodega (id_sedes_ips,id_user,fcreacion,nom_bodega,tipo_bodega,estado_bodega) VALUES
				('".$_POST["id_sedes"]."','".$_SESSION["AUT"]["id_user"]."','$f','".$_POST["nom_bodega"]."','".$_POST["tipo_bodega"]."','Activo')";
				$subtitulo1="La bodega";
				$subtitulo="Adicionada";
			break;
			case 'MED':
				$f=date('Y-m-d H:m');
				$sql="INSERT INTO pro_medicametos(id_bodega, id_user,fcreacion, cod_atc, descrip_atc, prin_activo, concentracion, presentacion, clas_pos, ffabricacion, fvencimiento, lote, reg_invima, laboratorio, cum, precio_compra, cantidad_total, cantidad_fraccion, tipo_unidad_f, cod_barras, semaforo, estado_pro_med) values
				('".$_POST["idb"]."','".$_SESSION["AUT"]["id_user"]."','$f','".$_POST["cod_atc"]."','".$_POST["descrip_atc"]."','".$_POST["prin_activo"]."','".$_POST["concentracion"]."','".$_POST["presentacion"]."','".$_POST["clas_pos"]."','".$_POST["ffabricacion"]."','".$_POST["fvencimiento"]."','".$_POST["lote"]."','".$_POST["reg_invima"]."','".$_POST["laboratorio"]."','".$_POST["cum"]."','".$_POST["precio_compra"]."','".$_POST["cantidad_total"]."','".$_POST["cantidad_fraccion"]."','".$_POST["tipo_unidad_f"]."','".$_POST["cod_barras"]."','".$_POST["semaforo"]."','Activo')";
				$subtitulo1="El medicamento";
				$subtitulo="Adicionado";
			break;
			case 'INS':
				$f=date('Y-m-d H:m');
				$sql="INSERT INTO pro_insumos(id_bodega,id_user, fcreacion, nom_insumo, fabricante, cod_barras, ffabricacion, fvencimiento, lote, reg_invima, clasi_riesgo, clasi_tipo, cantidad_t, precio_compra, semaforo, estado_pro_insumo) values
				('".$_POST["idb"]."','".$_SESSION["AUT"]["id_user"]."','$f','".$_POST["nom_insumo"]."','".$_POST["fabricante"]."','".$_POST["cod_barras"]."','".$_POST["ffabricacion"]."','".$_POST["fvencimiento"]."','".$_POST["lote"]."','".$_POST["reg_invima"]."','".$_POST["clasi_riesgo"]."','".$_POST["clasi_tipo"]."','".$_POST["cantidad_t"]."','".$_POST["precio_compra"]."','".$_POST["semaforo"]."','Activo')";
				$subtitulo1="El insumo o dispositivo medico";
				$subtitulo="Adicionado";
			break;
		}
	//	echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo1 fue  $subtitulo con exito!";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="La bodega NO fue $subtitulo !!! .";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'E':
			$sql="SELECT b.id_bodega, fcreacion, nom_bodega,tipo_bodega,s.nom_sedes  FROM bodega b left join sedes_ips s on b.id_sedes_ips=s.id_sedes_ips where id_bodega=".$_GET["idbog"];
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$estado='<article class="col-xs-3">
				<label for="">Estado Bodega:</label>
				<select class="form-control" name="estado_act" required="">
					<option value=""></option>
					<option value="Activo">Activo</option>
					<option value="Inactivo">Inactivo</option>
				</select>
			</article>';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/bodega.php';
			$subtitulo='Edicion de bodega';
			break;

			case 'A':
			$sql="";
			$color="yellow";
			$boton="Crear";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date();
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/bodega.php';
			$subtitulo='Creacion de bodega';
			break;

		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){

				$fila=array("id_bodega"=>"", "fcreacion"=>"", "nom_bodega"=>"","tipo_bodega"=>"","nom_sedes"=>"");
				print_r($fila);
			}
		}else{
				$fila=array("id_bodega"=>"", "fcreacion"=>"", "nom_bodega"=>"","tipo_bodega"=>"","nom_sedes"=>"");
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nom_convenio.value == ""){
					alert("Se requiere el nombre de la bodega!!!!!!!!!!");
					document.forms[0].nom_convenio.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<?php include($form1);?>
<?php
}else{
	if ($check=='si') {
		echo '<div class="alert alert-success animated bounceInRight">';
		echo $subtitulo;
		echo '</div>';
	}else {
		echo '<div class="alert alert-danger animated bounceInRight">';
		echo $subtitulo;
		echo '</div>';
	}// nivel 1?>
<div class="panel panel-default">
	<div> <a href="reporteexcel.php"> Haz clic para descargar el reporte</a> </div>
<div class="panel-body">
<table class="table table-bordered">
	<tr>
		<th id="th-estilo1"></th>
		<th id="th-estilo2">ID</th>
		<th id="th-estilo2">NOMBRE BODEGA</th>
		<th id="th-estilo3">NOMBRE SEDE</th>
	</tr>

	<?php
	$sql="SELECT b.id_bodega, fcreacion, nom_bodega,tipo_bodega,s.nom_sedes  FROM bodega b left join sedes_ips s on b.id_sedes_ips=s.id_sedes_ips where estado_bodega='Activo'";

if ($tabla=$bd1->sub_tuplas($sql)){
	foreach ($tabla as $fila ) {
		echo"<tr>\n";
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idbog='.$fila["id_bodega"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-pencil"></span></button></a></th>';
		echo'<td class="text-right">'.$fila["id_bodega"].'</td>';
		echo'<td class="text-left">'.$fila["nom_bodega"].'</td>';
		echo'<td class="text-center">'.$fila["nom_sedes"].'</td>';
		echo "</tr>\n";
	}
}
	?>
	<tr>
		<th colspan="11" class="text-center"><a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A'?>" align="center" ><button type="button" class="btn btn-primary" >Adicionar Bodega</button>
		</a></th>
	</tr>
</table>
</div>
</div>
	<?php
}
?>
