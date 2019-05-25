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
			case 'ADDITEM':
			$sql="INSERT INTO equipo_inv (id_dependencia, categoria_equipo, marca_equipo, modelo_equipo, serial_equipo, freg_compra, activo_fijo,
				foto_equipo, numero_factura, estado_equipo)
				VALUES ('".$_POST["tdependencia"]."','".$_POST["categoria_equipo"]."','".$_POST["marca_equipo"]."','".$_POST["modelo_equipo"]."',
					'".$_POST["serial_equipo"]."','".$_POST["freg_compra"]."','".$_POST["activo_fijo"]."',1,'".$_POST["numero_factura"]."','".$_POST["estado_equipo"]."')";
					$subtitulo="El item ha sido registrado. ";
					$subtitulo1="Algo salio mal";
					echo $sql;
					break;
					case 'ADDCARACTERISTICAS':
					$sql="INSERT INTO cate_equipo (id_equipo,nombre_equipo,disco_duro, ram, procesador, sistema_operativo, licencia, ofimatica,
						licencia_ofimatica, aplicaciones, tipo_red, ip, mascara, gateway, observaciones)
						VALUES ('".$_POST["id_equipo"]."','".$_POST["nombre_equipo"]."','".$_POST["disco_duro"]."','".$_POST["ram"]."',
							'".$_POST["procesador"]."','".$_POST["sistema_operativo"]."',
							'".$_POST["licencia"]."','".$_POST["ofimatica"]."','".$_POST["licencia_ofimatica"]."','".$_POST["aplicaciones"]."',
							'".$_POST["tipo_red"]."','".$_POST["ip"]."',
							'".$_POST["mascara"]."','".$_POST["gateway"]."','".$_POST["observaciones"]."')";
							$subtitulo="El item ha sido registrado. ";
							$subtitulo1="Algo salio mal";
							// echo $sql;
							break;
							case 'ADDPERIFERICO':
							$sql="INSERT INTO perifericos (id_equipo,categoria_periferico, marca_periferico, modelo_periferico, serial_periferico, activo_fijo, estado_periferico,observaciones)
							VALUES ('".$_POST["id_equipo"]."','".$_POST["categoria_periferico"]."','".$_POST["marca_periferico"]."','".$_POST["modelo_periferico"]."','".$_POST["serial_periferico"]."',
								'".$_POST["activo_fijo"]."','".$_POST["estado_periferico"]."','".$_POST["observaciones"]."')";
								$subtitulo="El item ha sido registrado. ";
								$subtitulo1="Algo salio mal";
								// echo $sql;
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
							case 'ADDITEM':
							$sql="";
							//echo $sql;
							$boton="Agregar";
							$boton1="Formulario";
							$atributo1=' readonly="readonly"';
							$atributo2='';
							$atributo3='';
							$date=date('Y-m-d');
							$date1=date('H:i');
							$doc=$_REQUEST['doc'];
							$servicio=$_REQUEST['servicio'];
							$form1='formulariosADM/inventario/add_item.php';
							$subtitulo='Registro de inventarios';
							$subtitulo1='Hardware';
							break;
							case 'ADDCARACTERISTICAS':
							$sql="";
							//echo $sql;
							$boton="Agregar";
							$boton1="Formulario";
							$atributo1=' readonly="readonly"';
							$atributo2='';
							$atributo3='';
							$date=date('Y-m-d');
							$date1=date('H:i');
							$doc=$_REQUEST['doc'];
							$servicio=$_REQUEST['servicio'];
							$form1='formulariosADM/inventario/add_caracteristicas.php';
							$subtitulo='Registro de categorias Equipo de computo';
							$subtitulo1='Hardware';
							break;
							case 'ADDPERIFERICO':
							$sql="";
							//echo $sql;
							$boton="Agregar";
							$boton1="Formulario";
							$atributo1=' readonly="readonly"';
							$atributo2='';
							$atributo3='';
							$date=date('Y-m-d');
							$date1=date('H:i');
							$doc=$_REQUEST['doc'];
							$servicio=$_REQUEST['servicio'];
							$form1='formulariosADM/inventario/add_periferico.php';
							$subtitulo='Registro de perifericos Equipo de computo';
							$subtitulo1='Hardware';
							break;
						}
						//echo $sql;
						if($sql!=""){
							if (!$fila=$bd1->sub_fila($sql)){
								$fila=array();
							}
						}else{
							$fila=array();
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
								<h1>INVENTARIOS</h1>
							</section>
							<section class="panel-body">
								<form>
									<section class="col-md-12">
										<article class="col-md-4">
											<label class="text-center">Categoria:</label>
											<select class="form-control" name="categoria_equipo">
												<option value=""></option>
												<option value="1">Equipos de computo</option>
												<option value="2">Equipos biomedicos</option>
												<option value="3">Equipo de redes</option>
												<option value="4">Impresoras</option>
												<option value="5">CCTV</option>
												<option value="6">Telefonia</option>
												<option value="7">Muebles</option>
											</select>
										</article>
										<article class="col-md-5">
										</article>
										<article class="col-md-3"><br>
											<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDITEM'?>" align="center" >
												<button type="button" class="btn btn-primary " ><span class="fa fa-tty"></span> Añadir elemento</button></a>
											</article>
										</section>
										<section class="col-md-12">
											<article class="col-md-4">
												<label class="text-center">Dependencia:</label>
												<select name="tdependencia" class="form-control" <?php echo atributo3; ?>>
													<option value="<?php echo $fila["tdependencia"];?>"><?php echo $fila["tdependencia"];?></option>
													<?php
													$sql="SELECT id_dependencia, nombre_dependencia from dependencia ORDER BY nombre_dependencia ASC";
													if($tabla=$bd1->sub_tuplas($sql)){
														foreach ($tabla as $fila2) {
															if ($fila["id_dependencia"]==$fila2["id_dependencia"]){
																$sw=' selected="selected"';
															}else{
																$sw="";
															}
															echo '<option value="'.$fila2["id_dependencia"].'"'.$sw.'>'.$fila2["nombre_dependencia"].'</option>';
														}
													}
													?>
												</select>
											</article>
										</section>
										<section class="col-md-12">
											<article class="col-md-5"><br>
												<input type="submit" name="buscar" class="btn btn-primary" value="Consultar"><span ></span>
												<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
											</article>
										</section>
									</form>
								</section>
								<section class="panel-body">
									<section class="col-md-12">
										<section class="row panel-body">
											<table class="table table-striped">
												<tr class="fuente_titulo_tabla">
													<th class="text-left text-primary">CATEGORIA</th>
													<th class="text-left text-primary">INFORMACION</th>
													<th class="text-left text-primary">ACCION</th>
												</tr>
												<?php
												$cat=$_REQUEST["categoria_equipo"];
												$dependencia=$_REQUEST["tdependencia"];
												$sql_categoria="SELECT *
												FROM equipo_inv
												WHERE categoria_equipo=$cat and id_dependencia=$dependencia";
												// echo $sql_categoria;
												if ($tablau=$bd1->sub_tuplas($sql_categoria)){
													foreach ($tablau as $filau ) {
														if ($cat==1) {
															echo'<tr>';
															echo'<td>';
															$cat=$filau['categoria_equipo'];
															if ($cat==1) {
																echo'<p><strong>Categoria: </strong>Equipo de computo</p>';
															}if ($cat==2) {
																echo'<p><strong>Categoria: </strong>Equipos biomedicos</p>';
															}if ($cat==3) {
																echo'<p><strong>Categoria: </strong>Equipo de redes</p>';
															}if ($cat==4) {
																echo'<p><strong>Categoria: </strong>Impresoras</p>';
															}if ($cat==5) {
																echo'<p><strong>Categoria: </strong>CCTV</p>';
															}if ($cat==6) {
																echo'<p><strong>Categoria: </strong>Telefonia</p>';
															}if ($cat==7) {
																echo'<p><strong>Categoria: </strong>Muebles</p>';
															}
															echo'<p><strong>fecha de compra: </strong>'.$filau['freg_compra'].'</p>
																<p><strong>No. Factura: </strong>'.$filau['numero_factura'].'</p>
															</td>';
															echo'<td class="col-md-5">
																<p><strong>Activo fijo: </strong>'.$filau['activo_fijo'].'</p>
																<p><strong>Marca equipo: </strong>'.$filau['marca_equipo'].'</p>
																<p><strong>Modelo: </strong>'.$filau['modelo_equipo'].'</p>
																<p><strong>Serie: </strong>'.$filau['serial_equipo'].'</p>
															</td>';
															echo'<td class="col-md-3">';
															echo'<article class="col-md-12">
															<p><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#categoria_equipo'.$filau['id_equipo'].'"><span class="far fa-eye"></span> Caracteristicas</button></p>
															<div id="categoria_equipo'.$filau['id_equipo'].'" class="modal fade" role="dialog">
																<div class="modal-dialog modal-lg">
																	<div class="modal-content">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal">&times;</button>
																			<h4 class="modal-title">Caracteristicas equipo #'.$filau['id_equipo'].'</h4>
																		</div>
																		<div class="modal-body">';
															$cat=$_REQUEST["categoria_equipo"];
															$id_equipo=$filau['id_equipo'];
															$sql_doc="SELECT nombre_equipo,disco_duro,ram, procesador,sistema_operativo,licencia,ofimatica,
															licencia_ofimatica,aplicaciones,tipo_red,ip,mascara,gateway, observaciones
															FROM cate_equipo
															WHERE id_equipo=$id_equipo";
															//echo $sql_doc;
															if ($tabla_doc=$bd1->sub_tuplas($sql_doc)){
																foreach ($tabla_doc as $fila_doc ) {
																	if ($cat==1) {
																		echo '<div class="container col-md-12">
																		<div class="panel-group col-md-12">
																			<div class="panel panel-default">
																				<div class="panel panel-heading">HARDWARE
																				</div>
																					<div class="panel panel-body">';
																						echo'<p><strong>Nombre Equipo: </strong>'.$fila_doc['nombre_equipo'].'</p>';
																						echo'<p><strong>Disco duro: </strong>'.$fila_doc['disco_duro'].'</p>';
																						echo'<p><strong>RAM: </strong>'.$fila_doc['ram'].'</p>';
																						echo'<p><strong>Procesador: </strong>'.$fila_doc['procesador'].'</p>';
																		echo '</div>
																				</div>';
																		echo '
																		<div class="panel panel-primary">
																			<div class="panel-heading">SOFTWARE
																			</div>
																				<div class="panel-body">';
																					echo'<p><strong>Sistema operativo: </strong>'.$fila_doc['sistema_operativo'].'</p>';
																				  echo'<p><strong>Licencia: </strong>'.$fila_doc['licencia'].'</p>';
																				  echo'<p><strong>Ofimatica: </strong>'.$fila_doc['ofimatica'].'</p>';
																				  echo'<p><strong>Licencia Ofimatica: </strong>'.$fila_doc['licencia_ofimatica'].'</p>';
																				  echo'<p><strong>Aplicaciones: </strong>'.$fila_doc['aplicaciones'].'</p>';
																	echo'	</div>
																			</div>
																		<div class="panel panel-success">
																			<div class="panel-heading">NETWORK
																			</div>
																				<div class="panel-body">';
																					$tred=$fila_doc["tipo_red"];
																					if ($tred==1) {
																					  echo'<p><strong>Tipo de red: </strong>Estatica</p>';
																					}if ($tred==2) {
																					  echo'<p><strong>Tipo de red: </strong>DHCP</p>';
																					}
																					  echo'<p><strong>Direccion ip: </strong>'.$fila_doc['ip'].'</p>';
																					  echo'<p><strong>Gateway: </strong>'.$fila_doc['gateway'].'</p>';
																		echo '</div>
																				</div>
																			</div>
																		</div>';
																		echo '<article class="modal-footer">
																			<article class="col-md-12">
																			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																		</article>';
																	}
																}
															}else {
																echo'<p>Este equipo no tiene Caracteristicas</p>
																	<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDCARACTERISTICAS&id='.$filau['id_equipo'].'">
																	<button type="button type="button" class="btn btn-warning"><span class="fa fa-edit"></span>Agregar Caracteristicas</button></a></p>';
																echo '<article class="modal-footer">
																	<article class="col-md-12">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																</article>';
															}
																echo'</div>
																		</div>
																	</div>
																</div>
															</div>
															</article>';
															echo'<article class="col-md-5">';
															echo '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#perifericos'.$filau['id_equipo'].'"><span class="far fa-keyboard"></span> Perifericos</button></p>
															  <div id="perifericos'.$filau['id_equipo'].'" class="modal fade" role="dialog">
															    <div class="modal-dialog modal-lg">
															      <div class="modal-content">
															        <div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal">&times;</button>
														          <h4 class="modal-title">Periferico del equipo #'.$filau['id_equipo'].'</h4>
														        </div>
															      <div class="modal-body">';
																		$id_equipo=$filau['id_equipo'];
																		$sql_doc="SELECT id_equipo,categoria_periferico, marca_periferico, modelo_periferico, serial_periferico, activo_fijo, estado_periferico,observaciones
																		FROM perifericos
																		WHERE id_equipo=$id_equipo";
																		//echo $sql_doc;
																		if ($tabla_doc=$bd1->sub_tuplas($sql_doc)){
																		  foreach ($tabla_doc as $fila_doc ) {
																		    $cat=$_REQUEST["categoria_equipo"];
																		    if ($cat==1) {
																						echo '<div class="container col-md-12">
																						<div class="panel-group col-md-12">
																							<div class="panel panel-default">
																								<div class="panel panel-heading">
																								<h4>'.$fila_doc['categoria_periferico'].'</h4>
																								</div>
																									<div class="panel panel-body">';
																									echo'<p><strong>Activo fijo : </strong>'.$fila_doc['activo_fijo'].'</p>';
																									echo'<p><strong>Marca periferico: </strong>'.$fila_doc['marca_periferico'].'</p>';
																									echo'<p><strong>Modelo periferico: </strong>'.$fila_doc['modelo_periferico'].'</p>';
																									echo'<p><strong>Serial periferico: </strong>'.$fila_doc['serial_periferico'].'</p>';
																						echo '
																									</div>
																								</div>
																							</div>
																						</div>';
																		    }
																		  }echo'<article class="col-md-12">
																			<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDPERIFERICO&id='.$filau['id_equipo'].'">
																			<button type="button type="button" class="btn btn-warning"><span class="fa fa-edit"></span>Agregar periferico</button></a></p>
																			</article>';
																		}else {
																		  echo'<p>Este equipo no tiene perifericos</p>
																			<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDPERIFERICO&id='.$filau['id_equipo'].'">
																			<button type="button type="button" class="btn btn-warning"><span class="fa fa-edit"></span>Agregar periferico</button></a></p>';
																		}
															     echo'<div class="modal-footer">
															        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															      </div>
															    </div>
																 </div>
															  </div>
															</div>';
															echo '</article>';
														}if ($cat!=1) {
															echo'<tr>';
																echo'<td>';
																	$cat=$filau['categoria_equipo'];
																	if ($cat==2) {
																		echo'<p><strong>Categoria: </strong>Equipos biomedicos</p>';
																	}if ($cat==3) {
																		echo'<p><strong>Categoria: </strong>Equipo de redes</p>';
																	}if ($cat==4) {
																		echo'<p><strong>Categoria: </strong>Impresoras</p>';
																	}if ($cat==5) {
																		echo'<p><strong>Categoria: </strong>CCTV</p>';
																	}if ($cat==6) {
																		echo'<p><strong>Categoria: </strong>Telefonia</p>';
																	}if ($cat==7) {
																		echo'<p><strong>Categoria: </strong>Muebles</p>';
															}
																echo'<p><strong>fecha de compra: </strong>'.$filau['freg_compra'].'</p>';
																echo'<p><strong>No. Factura: </strong>'.$filau['numero_factura'].'</p>';
															echo'</td>';
															echo'<td>
																		<p><strong>Activo fijo: </strong>'.$filau['activo_fijo'].'</p>
																		<p><strong>Marca equipo: </strong>'.$filau['marca_equipo'].'</p>
																		<p><strong>Modelo: </strong>'.$filau['modelo_equipo'].'</p>
																		<p><strong>Serie: </strong>'.$filau['serial_equipo'].'</p>
																	</td>';
															echo'<td>';
															echo'<article class="col-md-12">
															</article>';
															echo'</td>';
															echo'</tr>';
														}

													}
												}
												?>
											</table>
										</section>
									</section>
								</section>
							</section>
							<?php
						}
						?>
