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
		switch ($_POST["operacion"]) {
			case 'CANCELFOOD':
			$sql="UPDATE food SET estado_food=3 WHERE id_food='".$_POST[id_food]."'";
			$subtitulo="El almuerzo se ha cancelado con exito. ";
			$subtitulo1="Algo salio mal";
			// echo $sql;
			break;
			case 'ADDFOOD':
				$fh=$_POST['freg_food'];
				$user=$_SESSION['AUT']['id_user'];
				$sql_validacion="SELECT id_food, id_user FROM food WHERE freg_food='$fh' and id_user=$user and estado_food in (1,2)";
				echo $sql_validacion;
				if ($tabla_validacion=$bd1->sub_tuplas($sql_validacion)){
					foreach ($tabla_validacion as $fila_validacion) {
						$sql="INSERT INTO food (freg_foo, estado_food)
									VALUES (NULL,'".$_SESSION['AUT']['id_user']."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["freg_food"]."',1)";
						$subtitulo1="Algo salio mal";
					}
				}else {
						$sql="INSERT INTO food (id_user, freg, hreg, freg_food, estado_food)
									VALUES ('".$_SESSION['AUT']['id_user']."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["freg_food"]."',1)";
						$subtitulo="El almuerzo ha sido registrado con exito. ";
					}
			break;
		}echo $sql;
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
		case 'REPORTE':
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
			$form1='formulariosADM/food/reporte.php';
			$subtitulo='Reporte de almuerzos';
		break;
		case 'ADDFOOD':
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
			$form1='formulariosADM/food/addfood.php';
			$subtitulo='Pedir Almuerzo';
		break;
	}
	//echo $sql;
	if($sql!=""){
		if (!$fila=$bd1->sub_fila($sql)){
			$fila=array("id_food"=>"", "id_user"=>"", "freg"=>"", "hreg"=>"", "freg_food"=>"", "estado_food"=>"");
		}
	}else{
		$fila=array("id_food"=>"", "id_user"=>"", "freg"=>"", "hreg"=>"", "freg_food"=>"", "estado_food"=>"");
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
	<?php
	$perfil=$_SESSION['AUT']['id_perfil'];
	if ($perfil==94) {
		?>
		<section class="panel panel-default">
			<section class="panel-heading animated slideInLeft">
				<h1 class="fas fa-utensils"> FOOD</h1>
			</section>
			<section class="panel-body">
				<section class="col-md-6">
					<form>
						<div class="input-group">
							<span class="input-group-btn">
								<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
								<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
							</span>
							<input type="text" class="form-control" name="ident" placeholder="Filtro por identificación" aria-describedby="basic-addon1">
						</div>
					</form>
				</section>
			</section>
			<section class="panel-body">
				<?php
				$h=date_default_timezone_set('America/Bogota');
				$t=time();
				$tm=date('H:i');
				$fh=date('y-m-d');
				$doc=$_REQUEST["ident"];
				if (isset($doc)) {
					?>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4><strong>Datos Usuario</strong></h4>
						</div>
						<div class="panel-body"><?php
						$user=$_SESSION['AUT']['id_user'];
						$sql_usuario="SELECT id_food, b.id_user, freg, hreg, freg_food, estado_food, freg_cancelado, resp_cancelado, freg_entrega, resp_entrega,
																 a.doc, a.id_perfil perfil, p.nombre_perfil, a. nombre, a.cuenta, a.clave, a.foto, a.email, a.tdoc, a.doc, a.dir_user, a.tel_user,
																 a.rm_profesional, a.especialidad, a.firma, a.estado
													FROM food b
																INNER JOIN user a on b.id_user=a.id_user
																INNER JOIN perfil p on a.id_perfil=p.id_perfil
													WHERE a.doc='$doc' and freg_food='$fh' and estado_food=1
													group by id_food";
													//echo $sql_usuario;
						if ($tablau=$bd1->sub_tuplas($sql_usuario)){
							foreach ($tablau as $filau) {
								echo '<article class="col-md-4">';
									echo' <h5><strong>Nombre:  </strong>'.$filau['nombre'].'</h5>';
									echo' <h5><strong>'.$filau['tdoc'].':  </strong>'.$filau['doc'].'</h5>';
									echo' <h5><strong>Especialidad:  </strong>'.$filau['especialidad'].'</h5>';
								echo '</article>';
								echo '<article class="col-md-4">';
									echo' <h5><strong>Cuenta:  </strong>'.$filau['cuenta'].'</h5>';
									echo' <h5><strong>Perfil:  </strong>'.$filau['nombre_perfil'].'</h5>';
									echo' <h5><strong>Email:  </strong>'.$filau['email'].'</h5>';
								echo '</article>';
								echo '<article class="col-md-4 text-center">';
									$foto=$filau['foto'];
									if (isset($foto)) {
										echo'<img class="media-object" width="300px" src="/'.$foto.'" alt="...">';
									}else {
										echo'<img class="media-object" width="95px" src="/fotos/nofoto.png" alt="...">';
									}
								echo '</article>';
								echo '<article class="col-md-12 text-center">';
								echo '<p>
								<a href="Funcion_base/entregar_food.php?id_food='.$filau["id_food"].'&resp='.$_SESSION['AUT']['id_user'].'">
								<button type="button" class="btn btn-warning btn-lg" ><span class="fa fa-trash"></span> Entregar Almuerzo</button></a>
								</p>';
								echo '</article>';
								?>
							</div>
						</div>
						<?php	}
					}else {
						echo 'no hay ningun pedido relacionado con el # de documento <Strong>'.$doc.'</strong>';
					}
				}	?>
			</section>
		</section>
	<?php }else {?>
		<section class="panel panel-default">
			<section class="panel-heading animated slideInLeft">
				<h1 class="fas fa-utensils"> FOOD</h1>
			</section>
			<section class="col-md-12 col-sm-12">
				<br>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4><strong>Datos Usuario</strong></h4>
					</div>
					<div class="panel-body">
						<?php
						$user=$_SESSION['AUT']['id_user'];
						$sql_usuario="SELECT a.id_user,a.id_perfil perfil, nombre, cuenta, clave, foto, email, tdoc, doc, dir_user, tel_user,
																 rm_profesional, especialidad, firma, estado,b.nombre_perfil
													FROM user a INNER JOIN perfil b on a.id_perfil=b.id_perfil
													WHERE a.id_user='$user'";
						//echo $sql_usuario;
						if ($tablau=$bd1->sub_tuplas($sql_usuario)){
							foreach ($tablau as $filau) {
								echo '<article class="col-md-5">';
									echo' <h5><strong>Nombre:  </strong>'.$filau['nombre'].'</h5>';
									echo' <h5><strong>'.$filau['tdoc'].':  </strong>'.$filau['doc'].'</h5>';
									echo' <h5><strong>Especialidad:  </strong>'.$filau['especialidad'].'</h5>';
								echo '</article>';
								echo '<article class="col-md-5">';
									echo' <h5><strong>Cuenta:  </strong>'.$filau['cuenta'].'</h5>';
									echo' <h5><strong>Perfil:  </strong>'.$filau['nombre_perfil'].'</h5>';
									echo' <h5><strong>Email:  </strong>'.$filau['email'].'</h5>';
								echo '</article>';
							}
						}
						?>
					</div>
				</div>
				<?php
				$perfil=$_SESSION['AUT']['id_perfil'];
				?>
				<article class="col-md-4">
				</article>
				<section class="">
					<table class="table table striped"><br>
						<tr class="fuente_titulo_tabla"><br>
							<th class="text-center text-primary">#</th>
							<th class="text-center text-primary">FECHA</th>
							<th class="text-center text-primary">DETALLE</th>
							<th class="text-center text-primary">ACCION</th>
						</tr>
						<article class="text-center">
							<?php
							$h=date_default_timezone_set('America/Bogota');
							$t=time();
							$tm=date('H:i');
							$fh=date('y-m-d');
							$h2='08:30';
							$sql_val="SELECT id_food, b.id_user, freg, hreg, freg_food, estado_food, freg_cancelado, resp_cancelado, freg_entrega, resp_entrega,
																						 a.doc, a.id_perfil perfil, p.nombre_perfil, a. nombre, a.cuenta, a.clave, a.foto, a.email, a.tdoc, a.doc, a.dir_user, a.tel_user,
																						 a.rm_profesional, a.especialidad, a.firma, a.estado
												FROM food b
														  INNER JOIN user a on b.id_user=a.id_user
														  INNER JOIN perfil p on a.id_perfil=p.id_perfil
											  WHERE a.id_user=$user and freg_food='$fh' and estado_food in (1,2)
											  group by id_food";
												//echo $sql_val;
							if ($tablau=$bd1->sub_tuplas($sql_val)){
								foreach ($tablau as $filau) {
									echo '<article>';
									echo '<h5 class="col-md-4 text-center alert alert-danger"><Strong>Ya Realizo un pedido</Strong>';
									echo '</article>';
									if ($perfil==92 || $perfil==79) {
										?>
										<article class="col-md-3">
											<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=REPORTE'?>" align="center" ><button type="button" class="btn btn-primary" ><strong>Reporte</strong></button></a>
										</article>
										<?php
									}
								}
							}else {
								echo '<p class="col-md-2 text-center">
								<strong><br>Hora: </strong><br><span class="lead">'.$tm.'</span></p>';
								if($tm<$h2){
									?>
									<article class="col-md-4">
										<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDFOOD'?>" align="center" ><button type="button" class="btn btn-primary" ><strong>Deseas pedir almuerzo?</strong></button></a>
									</article>
									<?php
								}
								if ($tm>$h2) {
									echo '<h2 class="col-md-7 text-center alert alert-danger"><Strong>Esta fuera del horario establecido</Strong></h2>';
								}
								if ($perfil==92 || $perfil==79) {
									?>
									<article class="col-md-3">
										<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=REPORTE'?>" align="center" ><button type="button" class="btn btn-primary" ><strong>Reporte</strong></button></a>
									</article>
									<?php
								}
							}?>
						</article>
						<?php
						$sql_historico="SELECT id_food, id_user, freg, hreg, freg_food, estado_food, freg_cancelado, resp_cancelado, freg_entrega, resp_entrega
						FROM food
						WHERE id_user=$user order by freg_food desc";
						$i=1;
						// echo $sql_historico;
						if ($tablau=$bd1->sub_tuplas($sql_historico)){
							foreach ($tablau as $filau) {
								$estado_food=$filau['estado_food'];
								if ($estado_food==1) {
									echo '<tr>';
									echo '<td class="col-md-1">
										<h5 class="text-center alert alert-info"><strong>'.$i++.'</strong></></h5>';
									echo '</td>';
									echo '<td class="col-md-4 text-center">
										<p><strong>Fecha de solicitud: </strong>'.$filau['freg_food'].'</p>
										<p><strong>Hora Registro: </strong>'.$filau['hreg'].'</p>
									</td>';
									echo '<td class="col-md-4">';
										echo '<h5 class="text-center alert alert-info"><Strong>Estado:</Strong> Solicitado';
									echo '</td>';
								}
								if ($estado_food==2) {
									echo '<tr>';
									echo '<td class="col-md-1">
										<h5 class="text-center alert alert-info"><strong>'.$i++.'</strong></></h5>';
									echo '</td>';
									echo '<td class="col-md-4 text-center">
										<p><strong>Fecha de registro: </strong>'.$filau['freg'].'</p>
										<p><strong>Hora Registro: </strong>'.$filau['hreg'].'</p>
									</td>';
									echo '<td class="col-md-4">';
										echo '<h5 class="text-center alert alert-success"><Strong>Estado:</Strong> Reclamado';
									echo '</td>';
								}
								if ($estado_food==3) {
									echo '<tr>';
										echo '<td class="col-md-1">
										<h5 class="text-center alert alert-danger"><strong>'.$i++.'</strong></></h5>';
									echo '</td>';
									echo '<td class="col-md-4 text-center">
										<p><strong>Fecha de registro: </strong>'.$filau['freg'].'</p>
										<p><strong>Hora Registro: </strong>'.$filau['hreg'].'</p>
									</td>';
									echo '<td class="col-md-4">';
										echo '<h5 class="text-center alert alert-danger"><Strong>Estado:</Strong> Cancelado';
									echo '</td>';
								}
								echo '</td>';
								echo '<td class="text-center">';
								if ($estado_food==1 && $tm<$h2) {
										echo '<p>
										<a href="Funcion_base/cancelar_food.php?id_food='.$filau["id_food"].'&resp='.$_SESSION['AUT']['id_user'].'">
										<button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Cancelar Almuerzo</button></a>
										</p>';
									echo '</td>';
								}if ($estado_food==1 && $tm>$h2) {
										echo '<p class="alert alert-danger">Esta fuera del horario establecido para cancelar su almuerzo</p>';
								}if ($estado_food==2){
										echo '<p><strong>Fecha de entrega: </strong>'.$filau['freg_entrega'].'</p>';
										echo '<p><strong>Responsable de entrega: </strong>'.$filau['resp_entrega'].'</p>';
								}
								echo '</tr>';
							}
						} ?>
					</table>
				</section>
			</section>
		</section><?php
	}
}
?>
