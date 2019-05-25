<?php
$subtitulo="";
if(isset($_POST["operacion"])){	//nivel3
	if($_POST["aceptar"]!="Descartar"){
		//print_r($_FILES);
		$fotoE="";$fotoA1="";$fotoA2="";
		if (isset($_FILES["foto"])){
			if (is_uploaded_file($_FILES["foto"]["tmp_name"])){

				$cfoto=explode(".",$_FILES["foto"]["name"]);
				$archivo=$_POST["username"].".".$cfoto[count($cfoto)-1];

				if(move_uploaded_file($_FILES["foto"]["tmp_name"],WEB.FOTOS.$archivo)){
					$fotoE=",foto='".FOTOS.$archivo."'";
					$fotoA1=",foto";
					$fotoA2=",'".FOTOS.$archivo."'";
					}
			}
		}
		$docE="";$docA1="";$docA2="";
		if (isset($_FILES["soporte_hdesk"])){
			if (is_uploaded_file($_FILES["soporte_hdesk"]["tmp_name"])){
				$cfoto=explode(".",$_FILES["soporte_hdesk"]["name"]);
				$archivo=$_POST["nombre_soporte"].".".$cfoto[count($cfoto)-1];
				if(move_uploaded_file($_FILES["soporte_hdesk"]["tmp_name"],WEB.SHDESK.$archivo)){
					$docE=",soporte_hdesk='".SHDESK.$archivo."'";
					$docA=',soporte_hdesk';
					$docb=",'".SHDESK.$archivo."'";
					}
			}
		}
		switch ($_POST["operacion"]) {
			case 'CERRAR':
				$sql="UPDATE help_desk SET estado_soporte='".$_POST["estado_soporte"]."' WHERE id_hdesk='".$_POST["id_hdesk"]."'";
				$subtitulo="El caso se ha cerrado con exito.";
				$subtitulo1="Algo salio mal tu caso no se registro verifica el texto en busca de una comilla sencilla  ";
				// echo $sql;
			break;
			case 'RESPUESTA2HD':
				$sql="UPDATE help_desk SET estado_soporte='".$_POST["estado_soporte"]."',rta_hdesk2='".$_POST['rta_hdesk1']."',
				observacion_hdesk2='".$_POST['observacion_hdesk1']."', user_rta2='".$_SESSION["AUT"]["id_user"]."', frta2='".$_POST['frta1']."',
					hrta2='".$_POST['hrta1']."' WHERE id_hdesk='".$_POST["id_hdesk"]."'";
				$subtitulo="La respuesta ha sido cargada con exito";
				$subtitulo1="Algo salio mal tu caso no se registro verifica el texto en busca de una comilla sencilla  ";
			//	echo $sql;
			break;
			case 'RESPUESTAHD':
				$sql="UPDATE help_desk SET estado_soporte='".$_POST["estado_soporte"]."', rta_hdesk1='".$_POST['rta_hdesk1']."',
							frta1='".$_POST['frta1']."', hrta1='".$_POST['hrta1']."', observacion_hdesk1='".$_POST['observacion_hdesk1']."',
							user_rta1='".$_SESSION["AUT"]["id_user"]."' WHERE id_hdesk='".$_POST["id_hdesk"]."'";
				$subtitulo="La respuesta ha sido cargada con exito. ";
				$subtitulo1="Algo salio mal tu caso no se registro verifica el texto en busca de una comilla sencilla  ";
				// echo $sql;
			break;
			case 'EVIDENCIA':
				$sql="INSERT INTO soporte_hdesk (id_hdesk,id_user,freg_hdesk,hreg_hdesk,nombre_soporte$docA)
				VALUES ('".$_POST["id_hdesk"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg_hdesk"]."','".$_POST["hreg_hdesk"]."',
					'".$_POST["nombre_soporte"]."'$docb)";
				$subtitulo="Evidencia cargada con exito";
				$subtitulo1="los documentos cargados no deben superar las 2MB . Revise nuevamente el cargue.";
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
		case 'ADDHDESK':
			$sql="INSERT INTO help_desk (id_user,freg_hdesk, hreg_hdesk, descripcion, tipo_soporte,estado_soporte)
			VALUES ('".$_SESSION['AUT']['id_user']."','".$_POST["freg_hdesk"]."','".$_POST["hreg_hdesk"]."','".$_POST["descripcion"]."','".$_POST["tipo_soporte"]."',1)";
			$subtitulo="El item ha sido agregado con exito. ";
      $subtitulo1="Algo salio mal";
		break;

	}//echo $sql;
	if ($bd1->consulta($sql)){
		$subtitulo="$subtitulo";
		$check='si';
		if($_POST["operacion"]=="X"){
		if(is_file($fila["foto"])){
			unlink($fila["foto"]);
		}
		}
	}else{
		$subtitulo="$subtitulo1";
		$check='no';
	}
}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'CERRAR':
		$id=$_REQUEST['id'];
		$sql="SELECT id_hdesk, id_user, freg_hdesk, hreg_hdesk, descripcion, tipo_soporte, estado_soporte, rta_hdesk1,
								 frta1, hrta1, observacion_hdesk1, user_rta1, rta_hdesk2, observacion_hdesk2, user_rta2, frta2, hrta2
					FROM help_desk WHERE id_hdesk=$id";
					// echo $sql;
		$boton="Agregar";
		$atributo1=' readonly="readonly"';
		$atributo2='';
		$atributo3='';
		$date=date('Y-m-d');
		$date1=date('H:i');
		$doc=$_REQUEST['doc'];
		$servicio=$_REQUEST['servicio'];
		$form1='formulariosADM/help_desk/cerrar.php';
		$boton='cerrar';
		$subtitulo='Cerrar caso';
		break;
		case 'RESPUESTA2HD':
		$id=$_REQUEST['id'];
		$sql="SELECT id_hdesk, id_user, freg_hdesk, hreg_hdesk, descripcion, tipo_soporte, estado_soporte, rta_hdesk1,
								 frta1, hrta1, observacion_hdesk1, user_rta1, rta_hdesk2, observacion_hdesk2, user_rta2, frta2, hrta2
					FROM help_desk WHERE id_hdesk=$id";
					// echo $sql;
		$boton="Agregar";
		$atributo1=' readonly="readonly"';
		$atributo2='';
		$atributo3='';
		$date=date('Y-m-d');
		$date1=date('H:i');
		$doc=$_REQUEST['doc'];
		$servicio=$_REQUEST['servicio'];
		$form1='formulariosADM/help_desk/add_respuesta.php';
		$subtitulo='registro de respuesta';
		break;
		case 'ADDHDESK':
    $sql="";
    //echo $sql;
		$boton="Agregar";
		$atributo1=' readonly="readonly"';
		$atributo2='';
		$atributo3='';
		$date=date('Y-m-d');
		$date1=date('H:i');
		$doc=$_REQUEST['doc'];
		$servicio=$_REQUEST['servicio'];
		$form1='formulariosADM/help_desk/add_hdesk.php';
		$subtitulo='Registro de TICKET para help desk';
		break;
			case 'RESPUESTAHD':
			$id=$_REQUEST['id'];
			$sql="SELECT id_hdesk, id_user, freg_hdesk, hreg_hdesk, descripcion, tipo_soporte, estado_soporte, rta_hdesk1,
									 frta1, hrta1, observacion_hdesk1, user_rta1, rta_hdesk2, observacion_hdesk2, user_rta2, frta2, hrta2
						FROM help_desk WHERE id_hdesk=$id";
			$boton="Agregar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
      $doc=$_REQUEST['doc'];
      $servicio=$_REQUEST['servicio'];
			$form1='formulariosADM/help_desk/add_respuesta.php';
			$subtitulo='registro de respuesta';
			break;
			case 'EVIDENCIA':
			$sql="";
			//echo $sql;
				$boton="Agregar";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$date=date('Y-m-d');
				$date1=date('H:i');
				$doc=$_REQUEST['doc'];
				$servicio=$_REQUEST['servicio'];
				$form1='formulariosADM/help_desk/soporte_hdesk.php';
				$subtitulo='Registro de evidencias HELP DESK';
				break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_hdesk"=>"", "id_user"=>"", "freg_hdesk"=>"", "hreg_hdesk"=>"", "descripcion"=>"", "tipo_soporte"=>"",
										 "estado_soporte"=>"","rta_hdesk1"=>"", "frta1, hrta1"=>"", "observacion_hdesk1"=>"", "user_rta1"=>"",
							 			 "rta_hdesk2"=>"", "observacion_hdesk2"=>"", "user_rta2"=>"", "frta2"=>"", "hrta2"=>"");
			}
		}else{
				$fila=array("id_hdesk"=>"", "id_user"=>"", "freg_hdesk"=>"", "hreg_hdesk"=>"", "descripcion"=>"", "tipo_soporte"=>"",
										 "estado_soporte"=>"","rta_hdesk1"=>"", "frta1, hrta1"=>"", "observacion_hdesk1"=>"", "user_rta1"=>"",
							 			 "rta_hdesk2"=>"", "observacion_hdesk2"=>"", "user_rta2"=>"", "frta2"=>"", "hrta2"=>"");
			}
		?>
		<?php include($form1);?>

			<?php
			}else{
			  if ($check=='si') {
					echo'<section>';
					echo '<script>swal("MUY BIEN  !!!","'.$subtitulo.'","success")</script>';
					echo'</section>';
				}if ($check=='no') {
					echo'<section>';
					echo '<script>swal("ALGO SALIO MAL !!! ","'.$subtitulo1.'","error")</script>';
					echo'</section>';
				}
// nivel 1?>
				<section class="panel panel-default">
					<section class="panel-heading animated slideInLeft">
						<h1>HELP DESK</h1>
				  </section><br>
					<?php
							$perfil=$_SESSION['AUT']['id_perfil'];
							if ($perfil==1 || $perfil==89) { //vista filtro soporte
						  $user=$_SESSION['AUT']['id_user'];
									?>
									<section class=" ">
										<div class="container">
										<div class="panel-group" id="accordion">
											<div class="panel panel-default col-md-10">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Clinica Emmanuel Facatativá</a>
													</h4>
												</div>
												<div id="collapse1" class="panel-collapse collapse in">
													<div class="panel-body">
														<?php
														include('formulariosADM/help_desk/sede1.php');
														 ?>
													</div>
												</div>
											</div>
											<div class="panel panel-default col-md-10">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Sede Emmanuel Bogota</a>
													</h4>
												</div>
												<div id="collapse2" class="panel-collapse collapse">
													<div class="panel-body">
														<?php
														include('formulariosADM/help_desk/sede2.php');
														 ?>
													</div>
												</div>
											</div>
											<div class="panel panel-default col-md-10">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Clinica Emmanuel Bogota</a>
													</h4>
												</div>
												<div id="collapse3" class="panel-collapse collapse">
													<div class="panel-body">
															<?php
															include('formulariosADM/help_desk/sede3.php');
															 ?>
													</div>
												</div>
											</div>
											<div class="panel panel-default col-md-10">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Sede Emmanuel Facatativa</a>
													</h4>
												</div>
												<div id="collapse4" class="panel-collapse collapse">
													<div class="panel-body">
														<?php
														include('formulariosADM/help_desk/sede4.php');
														 ?>
													</div>
												</div>
											</div>
										</div>
									</div>
									</section>
									<?php
							}else { //vista filtro usuario
								  include('formulariosADM/help_desk/filtro_usuario.php');
						}
					 ?>
				</section>
					<?php
}
?>
