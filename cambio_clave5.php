<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["foto"])){
				if (is_uploaded_file($_FILES["foto"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["foto"]["name"]);
					$archivo=$_POST["cuenta"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["foto"]["tmp_name"],WEB.FOTOS.$archivo)){
						$fotoE=",foto='".FOTOS.$archivo."'";
						$fotoA1="foto";
						$fotoA2="'".FOTOS.$archivo."'";
						}
				}
			}
			$firmaE="";$firmaA1="";$firmaA2="";
			if (isset($_FILES["firma"])){
				if (is_uploaded_file($_FILES["firma"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["firma"]["name"]);
					$archivo=$_POST["cuenta"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["firma"]["tmp_name"],FIR.FIRMAS.$archivo)){
						$firmaE="firma='".FIRMAS.$archivo."'";
						$firmaA1=",firma";
						$firmaA2=",'".FIRMAS.$archivo."'";
						}
				}
			}
			$claveE="";$claveA1="";$claveA2="";
			if ($_POST["clave1"]==$_POST["clave2"]){
				if ($_POST["clave1"]!=""){
					$claveE="clave='".$_POST["clave1"]."'";
					$claveA1=",clave";
					$claveA2=",clave='".$_POST["clave1"]."'";
				}
			}
			switch ($_POST["operacion"]) {
			case 'E':
				$sql="UPDATE user SET $claveE$fotoE WHERE id_user=".$_POST["id"];
				$subtitulo="Actualizado";
			break;
			case 'X':
				$sql="SELECT foto from user where id_user=".$_POST["idu"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("foto"=> "");
				}
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("firma"=> "");
				}
				$sql="DELETE FROM user WHERE id_user=".$_POST["idu"];
				$subtitulo="Eliminado";
			break;
			case 'A':
				$sql="INSERT INTO user (nombre,cuenta,email,tdoc,doc,dir_user,tel_user,rm_profesional,especialidad,estado,id_perfil$fotoA1$claveA1$firmaA1) VALUES ('".$_POST["nombre"]."','".$_POST["cuenta"]."','".$_POST["email"]."','".$_POST["tdoc"]."','".$_POST["doc"]."','".$_POST["dir_user"]."','".$_POST["tel_user"]."','".$_POST["rm_profesional"]."','".$_POST["especialidad"]."','".$_POST["estado"]."','".$_POST["id_perfil"]."'$fotoA2$claveA2$firmaA2)";

				$subtitulo="Adicionado";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El registro fue $subtitulo con exito!";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["foto"])){
				unlink($fila["foto"]);
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
			$sql="SELECT id_user,nombre,cuenta,tdoc,doc,dir_user,tel_user,email,rm_profesional,especialidad,foto,estado,id_perfil,firma FROM  user where id_user=".$_GET["id"];
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$user=$_REQUEST['id'];
			$form1='configuraciones/cpassword.php';
			$subtitulo='Edición de datos del Usuario';
			break;
			case 'X':
			$sql="SELECT id_user,nombre,cuenta,tdoc,doc,dir_user,tel_user,email,rm_profesional,especialidad,foto,estado,id_perfil,firma FROM  user where id_user=".$_GET["idu"];
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
			$boton="Actualizar contraseña";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$return=$_REQUEST['user'];
			$form1='configuraciones/cpassword.php';
			$subtitulo='Actualizar contraseña';
			break;
		}
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_user"=>"","nombre"=>"","cuenta"=>"","foto"=>"","email"=>"","tdoc"=>"","doc"=>"","estado"=>"","id_perfil"=>"","firma"=>"","especialidad"=>"");
			}
		}else{
				$fila=array("id_user"=>"","nombre"=>"","cuenta"=>"","foto"=>"","email"=>"","tdoc"=>"","doc"=>"","estado"=>"","id_perfil"=>"","firma"=>"","especialidad"=>"");
			}

		?>
		<script src = "js/sha3.js"></script>
				<script>
					function validar(){

						if (document.forms[0].clave1.value == document.forms[0].clave2.value ){
							if (document.forms[0].clave1.value != ""){
								document.forms[0].clave1.value = CryptoJS.SHA3(document.forms[0].clave1.value);
								document.forms[0].clave2.value = document.forms[0].clave1.value;
							}
						}else{
							alert("Error en confirmacion de la clave!");
							document.forms[0].clave1.value = "";
							document.forms[0].clave2.value = "";
							document.forms[0].clave1.focus();				// Ubicar el cursor
							return(false);
						}
					}
				</script>
		<?php include($form1);?>
<?php
}else{
	echo '<div class="alert alert-success animated bounceInRight">';
	echo $subtitulo;
	echo '</div>';
// nivel 1?>
<section class="panel panel-default">
  <section class="panel-heading"><h4>Actualización de perfil</h4></section>
	<section class="panel-body">


	<?php
	$id=$_REQUEST["user"];
	$sql="SELECT id_user,nombre,doc,especialidad,cuenta,foto,estado,nombre_perfil FROM user u LEFT JOIN perfil p ON u.id_perfil=p.id_perfil where id_user='".$id."'";
  if ($tabla=$bd1->sub_tuplas($sql)){
  	foreach ($tabla as $fila ) {
      ?>
			<section class="panel-heading"><h4>Datos básicos</h4>
      <section class="panel-body col-xs-4 text-center">
        <figure class="col-xs-12">
					<figcaption>Foto perfil</figcaption>
					<img class="img-thumbnail" src="<?php echo $fila['foto'];?>" width="50%"alt="Foto perfil "/>
					<aside class="">
						<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&id='.$fila['id_user']?>" align="center" ><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-camera"></span> Editar foto</button>
					</aside>
				</figure>
			</section>

				<section class="panel-body col-xs-8">
					<section class="panel-body">
						<article class="col-xs-9">
							<label for="" class="alert alert-success">Nombre completo:
							<h2><?php echo $fila['nombre'];?></h2></label>
						</article>
						<article class="col-xs-3">
							<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&id='.$fila['id_user']?>" align="center" ><button type="button" class="btn btn-primary btn-lg" ><span class="fa fa-edit"></span> Cambiar clave</button>
						</article>
					</section>
					<section class="panel-body">
						<article class="col-xs-3">
							<label for="" class="alert alert-success">Identificación:
							<h4><?php echo $fila['doc'];?></h4></label>
						</article>
						<article class="col-xs-3">
							<label for="" class="alert alert-success">Especialidad:
							<h4><?php echo $fila['especialidad'];?></h4></label>
						</article>
						<article class="col-xs-3">
							<label for="" class="alert alert-success">Perfil:
							<h4><?php echo $fila['nombre_perfil'];?></h4></label>
						</article>
						<article class="col-xs-3">
							<label for="" class="alert alert-info">Cuenta:
							<h4><?php echo $fila['cuenta'];?></h4></label>
						</article>
					</section>
	      </section>
			</section>
      <?php

  	}
  }
	?>
	</section>
</section>
	<?php
}
?>
