<h1 class="fuente_titulo text-center">Administración de IPS</h1>
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
				$sql="UPDATE ips SET nom_ips='".$_POST["nom_ips"]."',doc_ips='".$_POST["doc_ips"]."',tel_ips='".$_POST["tel_ips"]."',dir_ips='".$_POST["dir_ips"]."'$fotoE,estado_ips='".$_POST["estado_ips"]."' WHERE id_ips=".$_POST["idips"];
				$subtitulo="Actualizado";
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
				$sql="INSERT INTO ips (nom_ips,doc_ips,tel_ips,dir_ips$fotoA1,estado_ips) VALUES
				('".$_POST["nom_ips"]."','".$_POST["doc_ips"]."','".$_POST["tel_ips"]."','".$_POST["dir_ips"]."'$fotoA2,'".$_POST["estado_ips"]."')";
				$subtitulo="Adicionado";
			break;
		}
		echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El registro fue $subtitulo con exito!";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logoips"])){
				unlink($fila["logoips"]);
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
			$sql="SELECT id_ips,nom_ips,doc_ips,tel_ips,dir_ips,logoips,estado_ips FROM  ips where id_ips=".$_GET["idips"];
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de datos de IPS';
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
				$fila=array("id_ips"=>"","nom_ips"=>"","doc_ips"=>"","tel_ips"=>"","dir_ips"=>"","logo"=>"","estado_ips"=>"" );

			}
		}else{
				$fila=array("id_ips"=>"","nom_ips"=>"","doc_ips"=>"","tel_ips"=>"","dir_ips"=>"","logo"=>"","estado_ips"=>"" );
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
				if (document.forms[0].doc_ips.value == ""){
					alert("Se requiere el documento de la IPS!");
					document.forms[0].doc_ips.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].tel_ips.value == ""){
					alert("Se requiere el Teléfono de la IPS!");
					document.forms[0].tel_ips.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].estado_ips.value == ""){
					alert("Se requiere el estado de la IPS!");
					document.forms[0].estado_ips.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
		<section>
			<marquee class="fuente1">
				<?php echo $subtitulo;?>
			</marquee>
		</section>
		<section class="panel panel-body">
			<article class="col-xs-1">
		  	<label  for="">ID:</label>
		  	<input type="text"  name="idips" class="form-control" value="<?php echo $fila["id_ips"];?>"<?php echo $atributo1;?>/>
		  </article>
		  <article class="col-xs-5">
		  	<label for="">Nombre IPS:</label>
		  	<input type="text" name="nom_ips" class="form-control" value="<?php echo $fila["nom_ips"];?>"<?php echo $atributo2;?>/>
		  </article>
		  <article class="col-xs-3">
		  	<label for="">Documento IPS:</label>
		  	<input type="text" name="doc_ips" class="form-control" value="<?php echo $fila["doc_ips"];?>"<?php echo $atributo2;?>/>
		  </article>
		  <article class="col-xs-3">
		  	<label for="">Teléfono IPS:</label>
		  	<input type="text" name="tel_ips" class="form-control"  value="<?php echo $fila["tel_ips"];?>"<?php echo $atributo2;?>/>
		  </article>
		  <article class="col-xs-4">
		  	<label for="">Dirección IPS:</label>
		  	<input type="text" name="dir_ips"  class="form-control" value="<?php echo $fila["dir_ips"];?>"<?php echo $atributo2;?>/>
		  </article>
		  <article class="col-xs-2">
		  	<label for="">Estado:</label>
		  	<select name="estado_ips" class="form-control"<?php echo atributo3; ?>>
				<option value="Activo" selected="selected">Activo</option>
				<option value="Inactivo" >Inactivo</option>
			</select>
		  </article>

		  <article class="col-xs-6">
		  	<label for="">Logo:</label>
		  	<?php echo $fila["logo"];?><br/>
			<input type="file" class="form-control" name="logo" <?php echo $atributo3; ?>/><br>
		  </article>
		</section>
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
<table class="table table-responsive">
	<tr>
		<th colspan="2" id="th-estilo1"></th>
		<th id="th-estilo2">ID</th>
		<th id="th-estilo2">NOMBRE</th>
		<th id="th-estilo2">DOCUMENTO</th>
		<th id="th-estilo2">DIRECCION</th>
		<th id="th-estilo2">TELEFONO </th>
		<th id="th-estilo2">ESTADO</th>
		<th id="th-estilo2">LOGO</th>
	</tr>

	<?php
	$sql="SELECT id_ips,nom_ips,doc_ips,dir_ips,tel_ips,estado_ips,logoips FROM ips";

if ($tabla=$bd1->sub_tuplas($sql)){
	foreach ($tabla as $fila ) {
		echo"<tr>\n";
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idips='.$fila["id_ips"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-pencil"></span></button></a></th>';
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=X&idips='.$fila["id_ips"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-trash"></span></button></a></th>';
		echo'<td class="text-right">'.$fila["id_ips"].'</td>';
		echo'<td class="text-left">'.$fila["nom_ips"].'</td>';
		echo'<td class="text-left">'.$fila["doc_ips"].'</td>';
		echo'<td class="text-left">'.$fila["dir_ips"].'</td>';
		echo'<td class="text-left">'.$fila["tel_ips"].'</td>';
		echo'<td class="text-center">'.$fila["estado_ips"].'</td>';
		echo'<td class="text-center"><img src="'.$fila["logoips"].'"alt ="logoips" class="image_login"> </td>';
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion=4'.'&mante=AS&idips='.$fila["id_ips"].'"><button type="button" class="btn btn-primary">Agregar Sede</button></a></th>';
		echo "</tr>\n";
	}
}
	?>
	<tr>
		<th colspan="11" class="text-center"><a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A'?>" align="center" ><button type="button" class="btn btn-primary" >Adicionar IPS</button>
		</a></th>
	<tr>
</table>
</div>
</div>
	<?php
}
?>
