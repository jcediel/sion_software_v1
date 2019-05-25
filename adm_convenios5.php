<h1 class="fuente_titulo text-center">Administración de Convenios</h1>
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
				$sql="UPDATE convenios SET id_eps='".$_POST["id_eps"]."',id_ips='".$_POST["id_ips"]."',finicial='".$_POST["finicial"]."',ffinal='".$_POST["ffinal"]."',nom_convenio='".$_POST["nom_convenio"]."',estado_convenio='".$_POST["estado_convenio"]."' WHERE id_convenios=".$_POST["id_conve"];
				$subtitulo="Actualizado";
			break;
			case 'X':
				$sql="SELECT logoips from convenios where id_convenios=".$_POST["id_conve"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="DELETE FROM convenios WHERE id_convenios=".$_POST["id_conve"];
				$subtitulo="Eliminado";
			break;
			case 'A':
				$sql="INSERT INTO convenios (id_eps,id_ips,finicial,ffinal,nom_convenio,estado_convenio) VALUES
				('".$_POST["id_eps"]."','".$_POST["id_ips"]."','".$_POST["finicial"]."','".$_POST["ffinal"]."','".$_POST["nom_convenio"]."','".$_POST["estado_convenio"]."')";
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
			$sql="SELECT id_convenios,id_eps,id_ips,finicial,ffinal,nom_convenio,estado_convenio FROM  convenios where id_convenios=".$_GET["idconv"];
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de datos de Convenios';
			break;
			case 'X':
			$sql="SELECT id_convenios,id_eps,id_ips,finicial,ffinal,nom_convenio,estado_convenio FROM  convenios where id_convenios=".$_GET["idconv"];
			$color="red";
			$boton="Eliminar";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$subtitulo='Confirmación para eliminar de datos de Convenios';
			break;
			case 'A':
			$sql="";
			$color="yellow";
			$boton="Crear";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Creación de Convenios';
			break;
		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_convenios"=>"","id_eps"=>"","id_ips"=>"","finicial"=>"","ffinal"=>"","nom_convenio"=>"","estado_convenio"=>"");

			}
		}else{
				$fila=array("id_convenios"=>"","id_eps"=>"","id_ips"=>"","finicial"=>"","ffinal"=>"","nom_convenio"=>"","estado_convenio"=>"");
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nom_convenio.value == ""){
					alert("Se requiere el nombre del Convenio!!!!!!!!!!");
					document.forms[0].nom_convenio.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].finicial.value == ""){
					alert("Se requiere diligenciar la fecha inicial del contrato");
					document.forms[0].finicial.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].ffinal.value == ""){
					alert("Se requiere diligenciar la fecha final del contrato");
					document.forms[0].ffinal.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].id_eps.value == ""){
					alert("Se requiere seleccionar EPS!!!!!!!!!!!");
					document.forms[0].id_eps.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].id_ips.value == ""){
					alert("Se requiere seleccionar IPS!!!!!!!!!!!!");
					document.forms[0].id_ips.focus();				// Ubicar el cursor
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
		  	<input type="text"  name="idconve" class="form-control" value="<?php echo $fila["id_convenios"];?>"<?php echo $atributo1;?>/>
		  </article>
			<article class="col-xs-3">
				<label>Selecccionar EPS:</label><br>
				<select name="id_eps" class="form-control" <?php echo atributo3; ?>>
					<?php
					$sql="SELECT id_eps,nom_eps from eps ORDER BY nom_eps ASC";
					if($tabla=$bd1->sub_tuplas($sql)){
						foreach ($tabla as $fila2) {
							if ($fila["id_eps"]==$fila2["id_eps"]){
								$sw=' selected="selected"';
							}else{
								$sw="";
							}
						echo '<option value="'.$fila2["id_eps"].'"'.$sw.'>'.$fila2["nom_eps"].'</option>';
						}
					}
					?>
				</select>
			</article>
			<article class="col-xs-6">
				<label>Seleccionar IPS:</label><br>
				<select name="id_ips" class="form-control" requiere <?php echo atributo3; ?>>
					<?php
					$sql="SELECT id_ips,nom_ips from ips ORDER BY nom_ips ASC";
					if($tabla=$bd1->sub_tuplas($sql)){
						foreach ($tabla as $fila2) {
							if ($fila["id_ips"]==$fila2["id_ips"]){
								$sw=' selected="selected"';
							}else{
								$sw="";
							}
						echo '<option value="'.$fila2["id_ips"].'"'.$sw.'>'.$fila2["nom_ips"].'</option>';
						}
					}
					?>
				</select>
			</article>
			<article class="col-xs-3">
				<label class="text-center">Fecha Inicial:</label><br>
				<input type="date" class="form-control text-center" name="finicial" value="<?php echo $fila["finicial"];?>"<?php echo $atributo2;?>/>
			</article>
			<article class="col-xs-3">
				<label class="text-center">Fecha Final:</label><br>
				<input type="date" class="form-control text-center" name="ffinal" value="<?php echo $fila["ffinal"];?>"<?php echo $atributo2;?>/>
			</article>
			<article class="col-xs-3">
				<label class="text-center">Nombre Convenio:</label><br>
				<input type="text" class="form-control text-center" name="nom_convenio" value="<?php echo $fila["finicial"];?>"<?php echo $atributo2;?>/>
			</article>
		  <article class="col-xs-2">
		  	<label for="">Estado:</label>
		  	<select name="estado_convenio" class="form-control"<?php echo atributo3; ?>>
				<option value="Activo" selected="selected">Activo</option>
				<option value="Inactivo" >Inactivo</option>
			</select>
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
		<th id="th-estilo2">NOMBRE CONVENIO</th>
		<th id="th-estilo2">ESTADO</th>
	</tr>

	<?php
	$sql="SELECT id_convenios,nom_convenio,estado_convenio FROM convenios";

if ($tabla=$bd1->sub_tuplas($sql)){
	foreach ($tabla as $fila ) {
		echo"<tr>\n";
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idconv='.$fila["id_convenios"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-pencil"></span></button></a></th>';
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=X&idconv='.$fila["id_convenios"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-trash"></span></button></a></th>';
		echo'<td class="text-right">'.$fila["id_convenios"].'</td>';
		echo'<td class="text-left">'.$fila["nom_convenio"].'</td>';
		echo'<td class="text-center">'.$fila["estado_convenio"].'</td>';
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.'&mante=AS&idips='.$fila["id_ips"].'"><button type="button" class="btn btn-primary">Agregar Manual</button></a></th>';
		echo "</tr>\n";
	}
}
	?>
	<tr>
		<th colspan="11" class="text-center"><a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A'?>" align="center" ><button type="button" class="btn btn-primary" >Adicionar Convenio</button>
		</a></th>
	<tr>
</table>
</div>
</div>
	<?php
}
?>
