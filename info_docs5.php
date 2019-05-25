<div align="center"><h2>Gestor de Documentacion Paciente</h2></div>

<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["foto"])){
				if (is_uploaded_file($_FILES["foto"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["foto"]["name"]);
					$archivo=$_POST["idpac"].'_'.$_POST["nomdoc"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["foto"]["tmp_name"],WEB.DOCPAC.$archivo)){
						$fotoE=",foto='".DOCPAC.$archivo."'";
						$fotoA=',foto';
						$fotob=",'".DOCPAC.$archivo."'";
						}
				}
			}

			switch ($_POST["operacion"]) {

			case 'X':
				$sql="SELECT foto from user where id_user=".$_POST["idu"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("foto"=> "");
				}
				$sql="DELETE FROM user WHERE id_user=".$_POST["idu"];
				$subtitulo="Eliminado";
			break;
			case 'A':
				$sql="INSERT INTO info_documentacion (id_paciente,nombre_doc$fotoA)
				VALUES ('".$_POST["idpac"]."','".$_POST["nomdoc"]."'$fotob)";
				$subtitulo="Adicionado";
			break;
		}
		echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El documento fue $subtitulo con exito!";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["foto"])){
				unlink($fila["foto"]);
			}
			}
		}else{
			$subtitulo="El documento NO fue $subtitulo !!! .";
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'E':
			$sql="SELECT id_user,nombre,cuenta,foto,estado,id_perfil FROM  user where id_user=".$_GET["idu"];
			$color="green";
			$boton="Agregar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Creación ';
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
	<section class="panel panel-body text-center">
			<article class="col-xs-5">
				<input type="hidden" name="idpac" value="<?php echo $_GET["id_pac"];?>">
	  		<label for="">Documento:</label>
		  	<select name="nomdoc" class="form-control" <?php echo atributo3; ?>>
				<option value="Documento Identidad">Documento Identidad</option>
				<option value="Autorizacion EPS">Autorizacion EPS</option>
				<option value="Consentimiento Informado">Consentimiento Informado</option>
				<option value="Consentimiento Procedimientos">Consentimiento Procedimientos</option>
				<option value="Consentimiento Traslado">Consentimiento Traslado</option>
				<option value="Epicrisis">Epicrisis</option>
				<option value="Pagare">Pagare</option>
			</select>
	  </article>
		<article class="col-xs-6">
			<label>Suba aqui el documento:</label>
			<?php echo $fila["foto"];?><br>
			<input type="file" class="form-control" name="foto" <?php echo $atributo3; ?>/>
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
	echo '<div class="animated bounceInRight">';
	echo $subtitulo;
	echo '</div>';
// nivel 1?>

<div class="panel panel-default">
	<div class="col-xs-7">
			<a class="btn btn-primary" href="<?php echo PROGRAMA.'?opcion=17';?>"><span class="glyphicon glyphicon-triangle-left">Regresar a Zona de Pacientes</span></a>
	</div>
	<br>
<div class="panel panel-body">

<table class="table table-responsive">
	<tr>
		<th id="th-estilo2">ID</th>
		<th id="th-estilo1">IDENTIFICACIÓN</th>
		<th id="th-estilo2">NOMBRE COMPLETO</th>
		<th id="th-estilo1">FOTO</th>
		<th ></th>
	</tr>
	<?php
	if (isset($_REQUEST["idpac"])){
	$idpaciente=$_GET["idpac"];
	$sql="SELECT id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fnacimiento,edad,uedad,dir_pac,tel_pac,email_pac,estadocivil,etnia,lateralidad,profesion,religion,fotopac FROM pacientes where id_paciente='".$idpaciente."'";
	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {
			echo"<tr >\n";
			echo'<td class="text-center info">'.$fila["id_paciente"].'</td>';
			echo'<td class="text-center info">'.$fila["tdoc_pac"].': '.$fila["doc_pac"].'</td>';
			echo'<td class="text-center info">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
			echo'<td class="text-left info"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login"> </td>';
			echo'<th class="text-center " ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&id_pac='.$fila["id_paciente"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="glyphicon glyphicon-plus"></span></button></a></th>';
			echo "</tr>\n";
		}
	}
}
	?>
	</table>
	<br>
	<button data-toggle="collapse" class="btn btn-primary" data-target="#demo">Ver Registros <span class="glyphicon glyphicon-arrow-down"></span> </button>
  <section id="demo" class="collapse">
  	<table class="table table-bordered">
	<tr>
		<th id="th-estilo3">ID DOCS</th>
		<th id="th-estilo1">ID</th>
		<th id="th-estilo2">TIPO DOCUMENTO</th>
		<th id="th-estilo4"></th>
	</tr>

	<?php
	if (isset($_REQUEST["idpac"])){
	$idcli=$_GET["idpac"];
	$sql="SELECT id_infodocs,id_paciente,nombre_doc FROM info_documentacion where id_paciente=".$idcli."";

if ($tabla=$bd1->sub_tuplas($sql)){
	foreach ($tabla as $fila ) {
		echo"<tr>\n";
		echo'<td class="text-right">'.$fila["id_infodocs"].'</td>';
		echo'<td class="text-right">'.$fila["id_paciente"].'</td>';
		echo'<td class="text-left">'.$fila["nombre_doc"].'</td>';
		if ($fila['nombre_doc']=='Documento Identidad') {
			echo'<th class="text-center" ><a href="docpaciente/'.$idcli.'_Documento Identidad.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-eye"></span> Ver soporte</button></a></th>';
		}
		if ($fila['nombre_doc']=='Consentimiento Informado') {
			echo'<th class="text-center" ><a href="docpaciente/'.$idcli.'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-eye"></span> Ver soporte</button></a></th>';
		}
		if ($fila['nombre_doc']=='Epicrisis') {
			echo'<th class="text-center" ><a href="docpaciente/'.$idcli.'_Epicrisis.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-eye"></span> Ver soporte</button></a></th>';
		}
		if ($fila['nombre_doc']=='Pagare') {
			echo'<th class="text-center" ><a href="docpaciente/'.$idcli.'_Pagare.pdf"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-eye"></span> Ver soporte</button></a></th>';
		}
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
