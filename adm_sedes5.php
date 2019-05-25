<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

			switch ($_POST["operacion"]) {
			case 'E':
				$sql="UPDATE sedes_ips SET nom_sedes='".$_POST["nom_sede"]."',dir_sedes='".$_POST["dir_sede"]."',estado_sedes='".$_POST["estado_sede"]."' WHERE id_sedes_ips=".$_POST["idsede"];
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
			case 'AS':
				$sql="INSERT INTO sedes_ips (id_ips,nom_sedes,dir_sedes,estado_sedes) VALUES ('".$_POST["idips"]."','".$_POST["nom_sede"]."','".$_POST["dir_sede"]."','".$_POST["estado_sede"]."')";
				$subtitulo="Adicionado";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El registro fue $subtitulo con exito!";
			?>
				<button type="button" class="btn btn-link"><a href="<?php echo PROGRAMA.'?opcion=3';?>"><span class="glyphicon glyphicon-triangle-left"> Regresar a Listado de IPS</span></a></button>

			<?php
		}else{
			$subtitulo="El registro NO fue $subtitulo !!! .";
		}
	}

}


if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'E':
			$sql="SELECT id_sedes_ips,id_ips,nom_sedes,dir_sedes,estado_sedes FROM  sedes_ips where id_sedes_ips=".$_GET["idsede"];
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de datos del Cliente';
			break;
			case 'X':
			$sql="SELECT id_sedes_ips,id_ips,nom_sedes,dir_sedes,estado_sedes FROM  sedes_ips where id_sedes_ips=".$_GET["idsede"];
			$color="red";
			$boton="Eliminar";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$subtitulo='Confirmación para eliminar de datos del Cliente';
			break;
			case 'AS':
			$sql="";
			$color="yellow";
			$boton="Crear";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Creación de Sedes';
			break;
		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_sedes_ips"=>"","id_ips"=>"","nom_sedes"=>"","dir_sedes"=>"","estado_sedes"=>"",);

			}
		}else{
				$fila=array("id_sedes_ips"=>"","id_ips"=>"","nom_sedes"=>"","dir_sedes"=>"","estado_sedes"=>"",);
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
		<button type="button" class="btn btn-link"><a href="<?php echo PROGRAMA.'?opcion=3';?>"><span class="glyphicon glyphicon-triangle-left"> Regresar a Listado de IPS</span></a></button>
<form action="<?php echo PROGRAMA?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
	<article>
		<h3 id="th-estilo2"><?php echo $subtitulo;?></h3>
	</article>
	<div class="panel panel-body row">
	  <article class="col-xs-1">
	  	<label  for="">ID:</label>
	  	<input type="text"  name="idsede" class="form-control" value="<?php echo $fila["id_sedes_ips"];?>"<?php echo $atributo1;?>/>
	  	<input type="hidden"  name="idips" class="form-control" value="<?php echo $_GET["idips"];?>"<?php echo $atributo1;?>/>
	  </article>
	  <article class="col-xs-3">
	  	<label for="">Nombre Sede:</label>
	  	<input type="text" name="nom_sede" class="form-control" value="<?php echo $fila["nom_sedes"];?>"<?php echo $atributo2;?>/>
	  </article>
	  <article class="col-xs-3">
	  	<label for="">Dirección Sede:</label>
	  	<input type="text" name="dir_sede" class="form-control" value="<?php echo $fila["dir_sedes"];?>"<?php echo $atributo2;?>/>
	  </article>
	  <article class="col-xs-3">
	  	<label for="">Estado:</label>
	  	<select name="estado_sede" class="form-control"<?php echo atributo3; ?>>
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
<button data-toggle="collapse" class="btn btn-primary" data-target="#demo">Ver lista de Sedes <span class="glyphicon glyphicon-arrow-down"></span> </button>

  <section id="demo" class="collapse">
  	<table class="table table-bordered">
	<tr>
		<th id="th-estilo1">ID</th>
		<th id="th-estilo2">NOMBRE SEDE</th>
		<th id="th-estilo1">DIRECCION</th>
		<th id="th-estilo2">ESTADO</th>
	</tr>

	<?php
	$idips=$_GET["idips"];
	$sql="SELECT id_sedes_ips,id_ips,nom_sedes,dir_sedes,estado_sedes FROM sedes_ips where id_ips=".$idips." ORDER BY id_sedes_ips ASC";

if ($tabla=$bd1->sub_tuplas($sql)){
	foreach ($tabla as $fila ) {
		echo"<tr>\n";
		echo'<td class="text-right">'.$fila["id_sedes_ips"].'</td>';
		echo'<td class="text-left">'.$fila["nom_sedes"].'</td>';
		echo'<td class="text-left">'.$fila["dir_sedes"].'</td>';
		echo'<td class="text-left">'.$fila["estado_sedes"].'</td>';
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion=4'.'&mante=E&idsede='.$fila["id_sedes_ips"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-pencil"></span></button></a></th>';
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion=4'.'&mante=X&idsede='.$fila["id_sedes_ips"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-trash"></span></button></a></th>';
		echo "</tr>\n";
	}
}
	?>

</table>
  </section>
<?php
}else{
	echo $subtitulo;
// nivel 1?>

	<?php
}
?>
