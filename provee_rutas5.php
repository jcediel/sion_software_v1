<div align="center"><h2> Administración de Proveedores Expresos</h2></div>
<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["logo"])){
				if (is_uploaded_file($_FILES["logo"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["logo"]["name"]);
					$archivo=$_POST["nomprovex"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["logo"]["tmp_name"],WEB.FOTOS.$archivo)){
						$fotoE=",logo='".FOTOS.$archivo."'";
						$fotoA1=",logo";
						$fotoA2=",'".FOTOS.$archivo."'";
						}
				}
			}

			switch ($_POST["operacion"]) {
			case 'E':
				$sql="UPDATE ProveedorExpresos SET nom_provexpreso='".$_POST["nomprovex"]."',doc_provexpreso='".$_POST["docprovex"]."',dir_provexpreso='".$_POST["dirprovex"]."',mail_provexpreso='".$_POST["mailprovex"]."',tel_provexpreso='".$_POST["telprovex"]."',cupo_provexpreso='".$_POST["cupoprovex"]."'$fotoE,estado_provexpreso='".$_POST["estadoprovex"]."' WHERE id_provexpreso=".$_POST["idprovex"];
				$subtitulo="Actualizado";
			break;
			case 'X':
				$sql="SELECT logo from ProveedorExpresos where id_provexpreso=".$_POST["idprovex"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="DELETE FROM ProveedorExpresos WHERE id_provexpreso=".$_POST["idprovex"];
				$subtitulo="Eliminado";
			break;
			case 'A':
				$sql="INSERT INTO ProveedorExpresos (nom_provexpreso,doc_provexpreso,dir_provexpreso,tel_provexpreso,mail_provexpreso,cupo_provexpreso,estado_provexpreso$fotoA1) VALUES('".$_POST["nomprovex"]."','".$_POST["docprovex"]."','".$_POST["dirprovex"]."','".$_POST["telprovex"]."','".$_POST["mailprovex"]."','".$_POST["cupoprovex"]."','".$_POST["estadoprovex"]."'$fotoA2)";
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
			$sql="SELECT id_provexpreso,nom_provexpreso,doc_provexpreso,dir_provexpreso,mail_provexpreso,tel_provexpreso,cupo_provexpreso,logo,estado_provexpreso FROM ProveedorExpresos where id_provexpreso=".$_GET["idprovex"];
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de datos del Proveedor';
			break;
			case 'X':
			$sql="SELECT id_provexpreso,nom_provexpreso,doc_provexpreso,dir_provexpreso,mail_provexpreso,tel_provexpreso,cupo_provexpreso,logo,estado_provexpreso FROM ProveedorExpresos where id_provexpreso=".$_GET["idprovex"];
			$color="red";
			$boton="Eliminar";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$subtitulo='Confirmación para eliminar datos del Proveedor';
			break;
			case 'A':
			$sql="";
			$color="yellow";
			$boton="Crear";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Creación de Proveedor';
			break;
		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_provexpreso"=>"","nom_prevexpreso"=>"","doc_provexpreso"=>"","dir_provexpreso"=>"","mail_provexpreso"=>"","tel_provexpreso"=>"","cupo_provexpreso"=>"","logo"=>"","estado_provexpreso"=>"");

			}
		}else{
				$fila=array("id_provexpreso"=>"","nom_prevexpreso"=>"","doc_provexpreso"=>"","dir_provexpreso"=>"","mail_provexpreso"=>"","tel_provexpreso"=>"","cupo_provexpreso"=>"","logo"=>"","estado_provexpreso"=>"");
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nomprovex.value == ""){
					alert("Se requiere el nombre del Proveedor de expresos!");
					document.forms[0].nomprovex.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
	<article>
		<h3 id="th-estilo2"><?php echo $subtitulo;?></h3>
	</article>
	<div class="panel panel-body row">
	  <article class="col-xs-1">
	  	<label  for="">ID:</label>
	  	<input type="text"  name="idprovex" class="form-control" value="<?php echo $fila["id_provexpreso"];?>"<?php echo $atributo1;?>/>
	  </article>
	  <article class="col-xs-5">
	  	<label for="">Nombre / Razon Social:</label>
	  	<input type="text" name="nomprovex" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $fila["nom_provexpreso"];?>"<?php echo $atributo2;?>/>
	  </article>
	  <article class="col-xs-4">
	  	<label for="">Documento:</label>
	  	<input type="text" name="docprovex" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $fila["doc_provexpreso"];?>"<?php echo $atributo2;?>/>
	  </article>
	  <article class="col-xs-5">
	  	<label  for="">Dirección:</label>
	  	<input type="text"  name="dirprovex" class="form-control" value="<?php echo $fila["dir_provexpreso"];?>"<?php echo $atributo2;?>/>
	  </article>
	  <article class="col-xs-3">
	  	<label for="">Teléfono:</label>
	  	<input type="text" name="telprovex" class="form-control" value="<?php echo $fila["tel_provexpreso"];?>"<?php echo $atributo2;?>/>
	  </article>
	  <article class="col-xs-3">
	  	<label for="">Email:</label>
	  	<input type="text" name="mailprovex" class="form-control" value="<?php echo $fila["mail_provexpreso"];?>"<?php echo $atributo2;?>/>
	  </article>
	  <article class="col-xs-5">
	  	<label for="">Cupo / Saldo precompra:</label>
	  	<input type="text" name="cupoprovex" class="form-control" value="<?php echo $fila["cupo_provexpreso"];?>"<?php echo $atributo2;?>/>
	  </article>
	  <article class="col-xs-4">
	  	<label for="">Logo:</label>
	  	<?php echo $fila["logo"];?><br/>
		<input type="file" class="form-control" name="logo" <?php echo $atributo3; ?>/><br>
	  </article>
	  <article class="col-xs-2">
	  	<label for="">Estado:</label>
	  	<select name="estadoprovex" class="form-control"<?php echo atributo3; ?>>
			<option value="Activo" selected="selected">Activo</option>
			<option value="Inactivo" >Inactivo</option>
		</select>
	  </article>
	</div>
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
<table class="table table-responsive">
	<tr>
		<th colspan="2" id="th-estilo1"></th>
		<th id="th-estilo2">ID</th>
		<th id="th-estilo1">PROVEEDOR</th>
		<th id="th-estilo2">ESTADO</th>
		<th id="th-estilo1">LOGO</th>
		<th id="th-estilo2">VEHICULOS</th>
	</tr>

	<?php
	$sql="SELECT id_provexpreso,nom_provexpreso,logo,estado_provexpreso FROM ProveedorExpresos ORDER BY id_provexpreso ASC";

if ($tabla=$bd1->sub_tuplas($sql)){
	foreach ($tabla as $fila ) {
		echo"<tr>\n";
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idprovex='.$fila["id_provexpreso"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-pencil"></span></button></a></th>';
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=X&idprovex='.$fila["id_provexpreso"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-trash"></span></button></a></th>';
		echo'<td class="text-right">'.$fila["id_provexpreso"].'</td>';
		echo'<td class="text-left">'.$fila["nom_provexpreso"].'</td>';
		echo'<td class="text-left">'.$fila["estado_provexpreso"].'</td>';
		echo'<td class="text-center"><img src="'.$fila["logo"].'"alt ="logocliente" class="image_login"> </td>';
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion=9"><button type="button" class="btn btn-primary" >Vehículos</button></a></th>';
		echo "</tr>\n";
	}
}
	?>
	<tr>
		<th colspan="10" class="text-center"><a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A'?>" align="center" ><button type="button" class="btn btn-primary" >Adicionar Proveedor Expresos</button>
		</a></th>
	</tr>
</table>
</div>
</div>
	<?php
}
?>
