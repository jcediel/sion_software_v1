<h1 class="fuente_titulo text-center">Administración de EPS</h1>
<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["logo"])){
				if (is_uploaded_file($_FILES["logo"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["logo"]["name"]);
					$archivo=$_POST["nom_eps"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["logo"]["tmp_name"],LOG.LOGOS.$archivo)){
						$fotoE=",logo='".LOGOS.$archivo."'";
						$fotoA1=",logo";
						$fotoA2=",'".LOGOS.$archivo."'";
						}
				}
			}

			switch ($_POST["operacion"]) {
			case 'E':
				$sql="UPDATE eps SET nom_eps='".$_POST["nom_eps"]."',doc_eps='".$_POST["doc_eps"]."',tel_eps='".$_POST["tel_eps"]."',dir_eps='".$_POST["dir_eps"]."',cod_eps='".$_POST["cod_eps"]."'$fotoE,estado_eps='".$_POST["estado_eps"]."' WHERE id_eps=".$_POST["ideps"];
				$subtitulo="Actualizado";
			break;
			case 'X':
				$sql="SELECT logo from eps where id_eps=".$_POST["ideps"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="DELETE FROM eps WHERE id_eps=".$_POST["ideps"];
				$subtitulo="Eliminado";
			break;
			case 'A':
				$sql="INSERT INTO eps (nom_eps,doc_eps,tel_eps,dir_eps,cod_eps$fotoA1,estado_eps) VALUES
				('".$_POST["nom_eps"]."','".$_POST["doc_eps"]."','".$_POST["tel_eps"]."','".$_POST["dir_eps"]."','".$_POST["cod_eps"]."'$fotoA2,'".$_POST["estado_eps"]."')";
				$subtitulo="Adicionado";
			break;
		}
		echo $sql;
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
			$sql="SELECT id_eps,nom_eps,doc_eps,tel_eps,dir_eps,cod_eps,logo,estado_eps FROM  eps where id_eps=".$_GET["ideps"];
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de datos de EPS';
			break;
			case 'X':
			$sql="SELECT id_eps,nom_eps,doc_eps,tel_eps,dir_eps,cod_eps,logo,estado_eps FROM  eps where id_eps=".$_GET["ideps"];
			$color="red";
			$boton="Eliminar";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$subtitulo='Confirmación para eliminar de datos de EPS';
			break;
			case 'A':
			$sql="";
			$color="yellow";
			$boton="Crear";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Creación de EPS';
			break;
		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_eps"=>"","nom_eps"=>"","doc_eps"=>"","tel_eps"=>"","dir_eps"=>"","cod_eps"=>"","logo"=>"","estado_eps"=>"" );

			}
		}else{
				$fila=array("id_eps"=>"","nom_eps"=>"","doc_eps"=>"","tel_eps"=>"","dir_eps"=>"","cod_eps"=>"","logo"=>"","estado_eps"=>"" );
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nom_eps.value == ""){
					alert("Se requiere el nombre de la EPS!");
					document.forms[0].nom_EPS.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].doc_eps.value == ""){
					alert("Se requiere el documento de la EPS!");
					document.forms[0].doc_eps.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].tel_eps.value == ""){
					alert("Se requiere el Teléfono de la EPS!");
					document.forms[0].tel_eps.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].estado_eps.value == ""){
					alert("Se requiere el estado de la EPS!");
					document.forms[0].estado_eps.focus();				// Ubicar el cursor
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
		  	<input type="text"  name="ideps" class="form-control" value="<?php echo $fila["id_eps"];?>"<?php echo $atributo1;?>/>
		  </article>
		  <article class="col-xs-5">
		  	<label for="">Nombre EPS:</label>
		  	<input type="text" name="nom_eps" class="form-control" value="<?php echo $fila["nom_eps"];?>"<?php echo $atributo2;?>/>
		  </article>
		  <article class="col-xs-3">
		  	<label for="">Documento EPS:</label>
		  	<input type="text" name="doc_eps" class="form-control" value="<?php echo $fila["doc_eps"];?>"<?php echo $atributo2;?>/>
		  </article>
		  <article class="col-xs-3">
		  	<label for="">Teléfono EPS:</label>
		  	<input type="text" name="tel_eps" class="form-control"  value="<?php echo $fila["tel_eps"];?>"<?php echo $atributo2;?>/>
		  </article>
		  <article class="col-xs-4">
		  	<label for="">Dirección EPS:</label>
		  	<input type="text" name="dir_eps"  class="form-control" value="<?php echo $fila["dir_eps"];?>"<?php echo $atributo2;?>/>
		  </article>
			<article class="col-xs-4">
				<label for="">Código EPS:</label>
				<input type="text" name="cod_eps"  class="form-control" value="<?php echo $fila["cod_eps"];?>"<?php echo $atributo2;?>/>
			</article>
		  <article class="col-xs-2">
		  	<label for="">Estado:</label>
		  	<select name="estado_eps" class="form-control"<?php echo atributo3; ?>>
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
	$sql="SELECT id_eps,nom_eps,doc_eps,dir_eps,tel_eps,cod_eps,estado_eps,logo FROM eps";

if ($tabla=$bd1->sub_tuplas($sql)){
	foreach ($tabla as $fila ) {
		echo"<tr>\n";
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&ideps='.$fila["id_eps"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-pencil"></span></button></a></th>';
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=X&ideps='.$fila["id_eps"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-trash"></span></button></a></th>';
		echo'<td class="text-right">'.$fila["id_eps"].'</td>';
		echo'<td class="text-left">'.$fila["nom_eps"].'</td>';
		echo'<td class="text-left">'.$fila["doc_eps"].'</td>';
		echo'<td class="text-left">'.$fila["dir_eps"].'</td>';
		echo'<td class="text-left">'.$fila["tel_eps"].'</td>';
		echo'<td class="text-center">'.$fila["estado_eps"].'</td>';
		echo'<td class="text-center"><img src="'.$fila["logo"].'"alt ="logoeps" class="image_login"> </td>';

		echo "</tr>\n";
	}
}
	?>
	<tr>
		<th colspan="11" class="text-center"><a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A'?>" align="center" ><button type="button" class="btn btn-primary" >Adicionar EPS</button>
		</a></th>
	<tr>
</table>
</div>
</div>
	<?php
}
?>
