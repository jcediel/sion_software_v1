<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["fotopac"])){
				if (is_uploaded_file($_FILES["fotopac"]["tmp_name"])){
					$cfoto=explode(".",$_FILES["fotopac"]["name"]);
					$archivo=$_POST["docpac"].".".$cfoto[count($cfoto)-1];
					if(move_uploaded_file($_FILES["fotopac"]["tmp_name"],LOG.PACIENTES.$archivo)){
						$fotoE=",fotopac='".PACIENTES.$archivo."'";
						$fotoA1=",fotopac";
						$fotoA2=",'".PACIENTES.$archivo."'";
						}
				}
			}
			switch ($_POST["operacion"]) {
			case 'A':
			$save=$_POST['cat'];
			if ($save==1) {
				$sql="INSERT INTO m_producto ( fcreacion, id_categoria_producto, nom_producto, estado_producto, crea_mproducto, gterapeutico, pos, controlado, altocosto,
										 embalaje, unidad, exepcion) VALUES
				('".date('Y-m-d')."','".$_POST["cat"]."','".$_POST["nom_producto"]."','Activo','".$_SESSION["AUT"]["id_user"]."','".$_POST["gterapeutico"]."', '".$_POST["pos"]."',
				 '".$_POST["controlado"]."', '".$_POST["altocosto"]."','".$_POST["embalaje"]."', '".$_POST["unidad"]."', '".$_POST["exepcion"]."')";
				$subtitulo="El Medicamento principal fue adicionado con exito  !!!";
				$subtitulo1="El medicamento principal NO FUE adicionado.";
			}
			if ($save==2) {
				$sql="INSERT INTO m_producto ( fcreacion, id_categoria_producto, nom_producto, estado_producto, crea_mproducto, gterapeutico, pos, controlado, altocosto,
										 embalaje, unidad, exepcion,clase_riesgo) VALUES
				('".date('Y-m-d')."','".$_POST["cat"]."','".$_POST["nom_producto"]."','Activo','".$_SESSION["AUT"]["id_user"]."','".$_POST["gterapeutico"]."', '".$_POST["pos"]."',
				 '".$_POST["controlado"]."', '".$_POST["altocosto"]."','".$_POST["embalaje"]."', '".$_POST["unidad"]."', '".$_POST["exepcion"]."', '".$_POST["clase_riesgo"]."')";
				$subtitulo="El Medicamento principal fue adicionado con exito  !!!";
				$subtitulo1="El medicamento principal NO FUE adicionado.";
			}
			break;
			case 'ADD2':
			$lote=$_POST['lote'];
			$cantidad=$_POST['cantidad'];
			$total=$cantidad + $_POST['cantidad_ant'];

			$forma=$_POST['ffarmaceutica'];
			if ($forma=='GOTAS' || $forma=='SOLUCION ORAL' || $forma=='JARABE' || $forma=='SUSPENSION'
													|| $forma=='SOLUCION OFTALMICA'  || $forma=='LOCION'  || $forma=='AEROSOL'
													|| $forma=='POLVO PARA RECONTITUIR' || $forma=='SHAMPOO'  || $forma=='JALEA'  || $forma=='CREMA') {
														$sql="UPDATE d_producto SET cantidad='$cantidad',user_mod='".$_SESSION['AUT']['id_user']."',accion=1,total_fraccion='".$_POST['total_fraccion']."'	WHERE id_dproducto='".$_POST['id_dproducto']."'";
														$subtitulo="Lote $lote fue actualizado con $cantidad unidades.";
			}
			if ($forma=='TABLETA' || $forma=='CAPSULA' || $forma=='SOLUCION INYECTABLE'  || $forma=='GRAGEA'
			|| $forma=='COMPRIMIDO' || $forma=='OVULO' || $forma=='PERLAS'  || $forma=='UNIDAD') {
				$sql="UPDATE d_producto SET cantidad='$total',user_mod='".$_SESSION['AUT']['id_user']."',accion=1,total_fraccion='".$_POST['total_fraccion']."'	WHERE id_dproducto='".$_POST['id_dproducto']."'";
				$subtitulo="Lote $lote fue actualizado con $cantidad unidades.";
			}
			break;
			case 'SUST2':
			$lote=$_POST['lote'];
			$cantidad=$_POST['cantidad'];
			$total=$_POST['cantidad_ant'] - $cantidad ;
			$forma=$_POST['ffarmaceutica'];
			if ($forma=='GOTAS' || $forma=='SOLUCION ORAL' || $forma=='JARABE' || $forma=='SUSPENSION'
													|| $forma=='SOLUCION OFTALMICA'  || $forma=='LOCION'  || $forma=='AEROSOL'
													|| $forma=='POLVO PARA RECONTITUIR' || $forma=='SHAMPOO'  || $forma=='JALEA' || $forma=='CREMA') {
														$sql="UPDATE d_producto SET cantidad='$cantidad',user_mod='".$_SESSION['AUT']['id_user']."',accion=2,total_fraccion='".$_POST['total_fraccion']."'	WHERE id_dproducto='".$_POST['id_dproducto']."'";
														$subtitulo="Lote $lote fue actualizado con $cantidad unidades.";
			}
			if ($forma=='TABLETA' || $forma=='CAPSULA' || $forma=='SOLUCION INYECTABLE'  || $forma=='GRAGEA'
			|| $forma=='COMPRIMIDO' || $forma=='OVULO' || $forma=='PERLAS'  || $forma=='UNIDAD') {
				$sql="UPDATE d_producto SET cantidad='$total',user_mod='".$_SESSION['AUT']['id_user']."',accion=2,total_fraccion='".$_POST['total_fraccion']."'	WHERE id_dproducto='".$_POST['id_dproducto']."'";
				$subtitulo="Lote $lote fue actualizado con $cantidad unidades.";
			}
			break;
			case 'ADDDETALLE':
			$lote=$_POST['lote'];
			$bod=$_POST['id_bodega'];
			//echo $lote;
			$sql_lote="SELECT lote FROM d_producto WHERE lote = '$lote' and id_bodega=$bod";
			//echo $sql_lote;
			if ($tabla_lote=$bd1->sub_tuplas($sql_lote)){
				foreach ($tabla_lote as $fila_lote) {
					$sql="INSERT INTO d_producto ( id_bodega, id_user, fcreacion, pactivo, concentracion,
																				 ffarmaceutica, nom_completa, nom_comercial, cantidad, laboratorio, reg_invima,
																				 fvencimiento, cum, lote, semaforizacion) VALUES
																			 ('".date('Y-m-d')."','".$_POST["cat"]."','".$_POST["nom_producto"]."','Activo','".$_SESSION["AUT"]["id_user"]."',
																			 '".$_POST["gterapeutico"]."','".$_POST["pos"]."','".$_POST["controlado"]."', '".$_POST["altocosto"]."',
																			 '".$_POST["embalaje"]."', '".$_POST["unidad"]."', '".$_POST["exepcion"]."')";
					$subtitulo="";
					$subtitulo1="Notificación de error: El detalle de medicamento no ha podido ser procesado.";
				}
			}else {

				$nom_completa=$_POST['pactivo'].' '.$_POST['concentracion'].' '.$_POST['ffarmaceutica'];

				$sql="INSERT INTO d_producto ( id_producto,id_bodega, id_user, fcreacion, pactivo, concentracion,
																			 ffarmaceutica, nom_completa, nom_comercial, cantidad, laboratorio, reg_invima,
																			 fvencimiento, cum, lote,propio,total_fraccion,user_mod,accion) VALUES
																		 ('".$_POST["id_producto"]."','".$_POST["id_bodega"]."','".$_SESSION["AUT"]["id_user"]."','".date('Y-m-d')."','".$_POST["pactivo"]."',
																		 '".$_POST["concentracion"]."','".$_POST["ffarmaceutica"]."','$nom_completa', '".$_POST["nom_comercial"]."',
																		 '".$_POST["cantidad"]."', '".$_POST["laboratorio"]."','".$_POST["reg_invima"]."','".$_POST["fvencimiento"]."','".$_POST["cum"]."'
																	 	,'".$_POST["lote"]."','".$_POST["propio"]."','".$_POST["total_fraccion"]."','".$_SESSION["AUT"]["id_user"]."',6)";
				$subtitulo="El detalle de producto $nom_completa con lote: $lote fue agregado con EXITO !!!";
				$subtitulo1="";
			}

			break;
			case 'EDITMPRODUCTO':
			$idp=$_POST['id_producto'];
			$sql="UPDATE m_producto SET nom_producto='".$_POST["nom_producto"]."', gterapeutico='".$_POST["gterapeutico"]."', pos='".$_POST["pos"]."',
																	controlado='".$_POST["controlado"]."', altocosto='".$_POST["altocosto"]."',embalaje='".$_POST["embalaje"]."',
																	unidad='".$_POST["unidad"]."', exepcion='".$_POST["exepcion"]."' WHERE id_producto=$idp";
			$subtitulo="Medicamento principal";
			$subtitulo1="Actualizado";
			break;

		}
	//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
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
			case 'ADDDETALLE':
			$producto=$_REQUEST['idmp'];
			$sql="SELECT id_producto, fcreacion, id_categoria_producto, nom_producto, estado_producto, crea_mproducto, gterapeutico, pos, controlado, altocosto,
									 embalaje, unidad, exepcion
						FROM m_producto WHERE id_producto=$producto";
			//echo $sql;
				$boton="Guardar";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$date=date('Y-m-d');
				$date1=date('H:i');
				$form1='formulariosMED/INVENTARIO/add_d_producto_indv.php';
				$subtitulo='Registro de detalle (Medicamento por ajuste)';
			break;
			case 'ADD2':
			$producto=$_REQUEST['iddp'];
			$sql="SELECT a.id_dproducto, pactivo, concentracion, ffarmaceutica, nom_completa,
									 nom_comercial, cantidad, laboratorio, reg_invima, fvencimiento, cum, lote,propio,total_fraccion,
									 b.nom_producto,
									 c.nom_bodega,c.id_bodega idbog
						FROM m_producto b INNER JOIN  d_producto a on b.id_producto=a.id_producto
															LEFT JOIN bodega c on c.id_bodega=a.id_bodega
						WHERE a.id_dproducto=$producto";
			//echo $sql;
				$boton="Guardar";
				$atributo1=' readonly="readonly"';
				$atributo2=' readonly="readonly"';
				$atributo3='';
				$date=date('Y-m-d');
				$date1=date('H:i');
				$form1='formulariosMED/INVENTARIO/add_d_producto_indv.php';
				$subtitulo='Adición de detalle de producto ';
			break;
			case 'SUST2':
			$producto=$_REQUEST['iddp'];
			$sql="SELECT a.id_dproducto, pactivo, concentracion, ffarmaceutica, nom_completa,
									 nom_comercial, cantidad, laboratorio, reg_invima, fvencimiento, cum,  lote,propio,total_fraccion,
									 b.nom_producto,
									 c.nom_bodega,c.id_bodega idbog
						FROM m_producto b INNER JOIN  d_producto a on b.id_producto=a.id_producto
															LEFT JOIN bodega c on c.id_bodega=a.id_bodega
						WHERE a.id_dproducto=$producto";
			//echo $sql;
				$boton="Guardar";
				$atributo1=' readonly="readonly"';
				$atributo2=' readonly="readonly"';
				$atributo3='';
				$date=date('Y-m-d');
				$date1=date('H:i');
				$form1='formulariosMED/INVENTARIO/add_d_producto_indv.php';
				$subtitulo='Sustracción de detalle de producto ';
			break;
			case 'TRASLADO':
			$producto=$_REQUEST['idmp'];
			$sql="SELECT a.id_dproducto, pactivo, concentracion, ffarmaceutica, nom_completa,
									 nom_comercial, cantidad, laboratorio, reg_invima, fvencimiento, cum,  lote,propio,total_fraccion,
									 b.nom_producto,b.id_producto idm,
									 c.nom_bodega,c.id_bodega idbog
						FROM m_producto b INNER JOIN  d_producto a on b.id_producto=a.id_producto
															LEFT JOIN bodega c on c.id_bodega=a.id_bodega
						WHERE b.id_producto=$producto";
			//echo $sql;
				$boton="Guardar";
				$atributo1=' readonly="readonly"';
				$atributo2=' readonly="readonly"';
				$atributo3='';
				$date=date('Y-m-d');
				$date1=date('H:i');
				$form1='formulariosMED/INVENTARIO/TRASLADO/traslado_bodega.php';
				$nom_producto=$_REQUEST['mp'];
				$subtitulo='Traslado de producto ('.$nom_producto.') entre bodegas';
			break;
			case 'A':
	      $sql="";
				$boton="Guardar";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$date=date('Y-m-d');
				$date1=date('H:i');
				$form1='formulariosMED/INVENTARIO/add_m_producto.php';
				$cat=$_REQUEST['CAT'];
				if ($cat==1) {
					$subtitulo='Creación de medicamento principal.';
				}
				if ($cat==2) {
					$subtitulo='Creación de dispositivo medico principal.';
				}
				if ($cat==3) {
					$subtitulo='Creación de insumos principal.';
				}
			break;
			case 'DEVOLUCION':
				$sql="";
				$boton="Guardar";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$date=date('Y-m-d');
				$date1=date('H:i');
				$form1='formulariosMED/INVENTARIO/devoluciones.php';
				$subtitulo='Creación de medicamento principal.';
			break;
			case 'EDITMPRODUCTO':
			$producto=$_REQUEST['idmp'];
      $sql="SELECT id_producto, fcreacion, id_categoria_producto, nom_producto, estado_producto, crea_mproducto, gterapeutico, pos, controlado, altocosto,
									 embalaje, unidad, exepcion
						FROM m_producto WHERE id_producto=$producto";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formulariosMED/INVENTARIO/add_m_producto.php';
			$subtitulo='Edición de medicamento principal.';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_producto"=>"", "fcreacion"=>"", "tipo_producto"=>"", "nom_producto"=>"", "estado_producto"=>"",
										 "crea_mproducto"=>"", "gterapeutico"=>"", "pos"=>"", "controlado"=>"", "altocosto"=>"",
										 "embalaje"=>"", "unidad"=>"", "exepcion"=>"","id_dproducto"=>"", "fcreacion"=>"", "pactivo"=>"", "concentracion"=>"",
										 "ffarmaceutica"=>"", "nom_completa"=>"","nom_comercial"=>"", "cantidad"=>"", "laboratorio"=>"", "reg_invima"=>"",
										 "fvencimiento"=>"", "cum"=>"", "lote"=>"", "propio"=>"", "total_fraccion"=>"","nom_bodega"=>"","idbog"=>"","idm"=>"");
			}
		}else{
				$fila=array("id_producto"=>"", "fcreacion"=>"", "tipo_producto"=>"", "nom_producto"=>"", "estado_producto"=>"",
										 "crea_mproducto"=>"", "gterapeutico"=>"", "pos"=>"", "controlado"=>"", "altocosto"=>"",
										 "embalaje"=>"", "unidad"=>"", "exepcion"=>"","id_dproducto"=>"", "fcreacion"=>"", "pactivo"=>"", "concentracion"=>"",
										 "ffarmaceutica"=>"", "nom_completa"=>"","nom_comercial"=>"", "cantidad"=>"", "laboratorio"=>"", "reg_invima"=>"",
										 "fvencimiento"=>"", "cum"=>"", "lote"=>"", "propio"=>"", "total_fraccion"=>"","nom_bodega"=>"","idbog"=>"","idm"=>"");
			}
		?>

		<?php include($form1);?>

<?php
}else{
	if ($check=='si') {
		echo '<div class="alert alert-success animated bounceInRight">';
		echo $subtitulo;
		echo '</div>';
	}else {
		echo '<div class="alert alert-danger animated bounceInRight">';
		echo $subtitulo;
		echo '</div>';
	}
// nivel 1?>
<section class="panel panel-default">
  <section class="panel-heading"><h3>Registro de inventario Farmacia Hospitalaria</h3></section>
    <section class="panel-body">
      <form >
				<section class="col-md-12">
					<section class="col-md-4">
						<article class="col-md-12">
							<label for="">Nombre producto:</label>
							<input type="text"  required="" class="form-control" name="prod" value="" placeholder="Digite nombre de producto para realizar busqueda.">
						</article>
						<div class="col-md-12">
							<label for=""> </label>
							<input type="submit" name="buscar" class="btn btn-primary" value="Buscar">
							<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
						</div>
					</section>
					<section class="col-md-4 text-center"><!--Filtro para devoluciones-->
						<div class="col-md-12 ">
							<?php $hoy=date('Y-m-d') ?>
							<a href="<?php echo PROGRAMA.'?opcion=190';?>"><button type="button" class="btn btn-danger" ><span class="fa fa-undo  fa-2x"> </span> Devoluciones</button></a>
						</div>
					</section>

					<section class="col-md-4 text-center">
						<div class="col-md-12 text-center">
							<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ORDENCOMPRA';?>"><button type="button" class="btn btn-primary" ><span class="fa fa-shopping-cart  fa-2x"> </span> Orden de Compra</button></a>
						</div>
					</section>
				</section>
      </form>
			<section>

			</section>
    </section>

	<section class="panel-body">
		<table class="table table-bordered">
			<tr>
    		<th colspan="2" class="text-center">
					<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&CAT=1';?>"><button type="button" class="btn btn-success" ><span class="fa fa-pills fa-2x"></span> Nuevo MEDICAMENTO</button></a>
				</th>
				<th colspan="2" class="text-center">
					<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&CAT=2';?>"><button type="button" class="btn btn-primary" ><span class="fa fa-syringe fa-2x"></span> Nuevo DISPOSITIVO MEDICO</button></a>
				</th>
				<th colspan="2" class="text-center">
					<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&CAT=3';?>"><button type="button" class="btn btn-warning" ><span class="fa fa-archive fa-2x"></span> Nuevo INSUMO</button></a>
				</th>
    	</tr>
		</table>
    <table class="table table-bordered">

    	<tr>
    		<th class="text-center success">ID</th>
        <th class="text-center success">PRODUCTO</th>
				<th class="text-center success">TIPO PRODUCTO</th>
        <th class="text-center success">CARACTERISTICAS</th>
    		<th class="text-center success">CANTIDAD</th>
    		<th class="text-center success"><span class="fa fa-"></span> </th>
    	</tr>

    	<?php

			$nom=$_REQUEST['prod'];
			$tipo=$_REQUEST['tipo'];
			if ($nom!='') {
				$sql1="SELECT id_producto,nom_producto,id_categoria_producto,estado_producto, crea_mproducto,
											gterapeutico, pos, controlado, altocosto, embalaje,
											unidad, exepcion
							 FROM m_producto
							 WHERE nom_producto like '%$nom%' ";
							 //echo $sql1;
			 				if (isset($sql1)){
			 					if ($tabla=$bd1->sub_tuplas($sql1)){
			 						foreach ($tabla as $fila ) {
			 								echo"<tr >\n";
			 								$idprod=$fila['id_producto'];
			 								echo'<td class="text-center">'.$fila["id_producto"].'</td>';
			 								echo'<td class="text-left">
			 											<p><strong>'.$fila["nom_producto"].'</strong></p>
			 											<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EDITMPRODUCTO&idmp='.$idprod.'&CAT='.$fila["id_categoria_producto"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-edit"></span> Editar producto</button></a></p>
														<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDDETALLE&idmp='.$idprod.'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Agregar Nuevo Detalle</button></a></p>
			 										 </td>';
			 								echo'<td class="text-center">';
			 											if ($fila['id_categoria_producto']==1) {
			 												echo "<p>Medicamento</p>";
			 											}
			 											if ($fila['id_categoria_producto']==2) {
			 												echo "<p>Dispositivo Medico</p>";
			 											}
			 											if ($fila['id_categoria_producto']==3) {
			 												echo "<p>Insumo</p>";
			 											}

			 								echo'</td>';
			 								echo'<td class="text-left">';
			 											$gt=$fila['gterapeutico'];
			 											$pos=$fila['pos'];
			 											$regulado=$fila['regulado'];
			 											$controlado=$fila['controlado'];
			 											$altocosto=$fila['altocosto'];
			 											$psiquiatrico=$fila['psiquiatrico'];

			 											if ($pos=='1') {
			 												echo'<p><strong class="text-danger">Medicamento NO POS: </strong>, <strong>aunque </strong> '.$fila['exepcion'].'</p>';
			 											}
			 											if ($controlado==1) {
			 												echo'<p><strong class="text-danger">Medicamento controlado </strong></p>';
			 											}
			 											if ($altocosto==1) {
			 												echo'<p><strong class="text-danger">Medicamento COSTO ALTO</strong></p>';
			 											}
			 								echo'</td>';
			 								echo'<td class="text-center">';
														$mproducto=$fila['id_producto'];
														$sql_d_producto="SELECT SUM(cantidad) total FROM d_producto WHERE id_producto = $mproducto";
														if ($tabla_d_producto=$bd1->sub_tuplas($sql_d_producto)){
															foreach ($tabla_d_producto as $fila_d_producto ) {
																if ($fila_d_producto['total']=='') {
																	echo'<p class="text-danger"><strong>0 existencias</strong></p>';
																}else {
																	echo'<p class="text-primary"><strong>'.$fila_d_producto['total'].' existencias</strong></p>';
																}

															}
														}
			 								echo'</td>';
			 								echo'<th class="text-center">';
														$mproducto=$fila['id_producto'];
			 											echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#detalle_'.$mproducto.'">Consultar Detalle<br>#'.$mproducto.'</button></p>';
														echo '<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TRASLADO&idmp='.$mproducto.'&mp='.$fila['nom_producto'].'"><button type="button" class="btn btn-primary" > Trasladar Producto<br>de  bodega</button></a></p>';
			 								echo'</th>';
			 								echo "</tr>\n";
											?>
											<div id="detalle_<?php echo $mproducto?>" class="modal fade" role="dialog">
											  <div class="modal-dialog modal-lg">

											    <!-- Modal content-->
											    <div class="modal-content">
											      <div class="modal-header">
											        <button type="button" class="close" data-dismiss="modal">&times;</button>
											        <h4 class="modal-title">Lista detalle producto <strong class="text-success"><?php echo $fila['nom_producto'] ?></strong> ID <strong><?php echo $mproducto ?></strong></h4>
											      </div>
											      <div class="modal-body">
															<section class="panel-body">
																<?php
															 $mproducto=$fila['id_producto'];
															 $sql_d_producto1="SELECT a.id_dproducto, id_producto,  pactivo, concentracion, ffarmaceutica,
															 														nom_completa, nom_comercial, cantidad, laboratorio, reg_invima, fvencimiento, cum, lote, propio,
																													total_fraccion,
																												b.nom_bodega
																												 FROM d_producto a INNER JOIN bodega b on a.id_bodega=b.id_bodega WHERE a.id_producto = $mproducto";
															 //echo $sql_d_producto1;
															 if ($tabla_d_producto1=$bd1->sub_tuplas($sql_d_producto1)){
																 foreach ($tabla_d_producto1 as $fila_d_producto1) {

																	 $vencimiento=$fila_d_producto1['fvencimiento'];
																	 $segundos= strtotime($vencimiento) - strtotime('now');
													 				 $diferencia_dias=intval($segundos /60/60/24);
																	 $dias=ceil($diferencia_dias);

																	 if ($dias>0 && $dias<=183) {
																	 	?>
																		<section class="col-md-12 alert alert-danger">
 																		 <article class="col-md-3">
   																	 	<label for="">Detalle:</label>
   																		<p><strong>ID:</strong>	<?php echo $fila_d_producto1['id_dproducto']?> -- <?php echo $fila_d_producto1['nom_completa']?></p>
   																	 </article>
 																		 <article class="col-md-3">
 																		 	<label for="">Lote:</label>
 																			<p><?php echo $fila_d_producto1['lote']?></p>
																			<p><?php echo $fila_d_producto1['nom_bodega']?></p>
 																		 </article>
 																		 <article class="col-md-3">
 																		 	<label for="">Caracteristicas:</label>
 																			<p><?php echo $fila_d_producto1['fvencimiento']?></p>
																			<p><?php echo 'A <strong>'.$dias.'</strong> dias de vencer'?></p>
																			<p><?php echo 'Cantidad: <strong>'.$fila_d_producto1['cantidad'].'</strong>'?></p>
 																		 </article>
																		 <article class="col-md-3">
 																			<p>
 																				<?php
 																				 echo '<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADD2&iddp='.$fila_d_producto1['id_dproducto'].'">
 																				 <button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span>  <br>Sumar por ajuste</button>
 																				 </a>';
 																				 ?>
 																			</p>
 																		</article>

 																	 </section>
																		<?php
																	 }
																	 if ($dias>183 && $dias<=365) {
																	 	?>
																		<section class="col-md-12 alert alert-warning">
																			<article class="col-md-3">
    																	 	<label for="">Detalle:</label>
    																		<p><strong>ID:</strong>	<?php echo $fila_d_producto1['id_dproducto']?> -- <?php echo $fila_d_producto1['nom_completa']?></p>
    																	 </article>
  																		 <article class="col-md-3">
  																		 	<label for="">Lote:</label>
  																			<p><?php echo $fila_d_producto1['lote']?></p>
 																				<p><?php echo $fila_d_producto1['nom_bodega']?></p>
  																		 </article>
  																		 <article class="col-md-3">
  																		 	<label for="">Caracteristicas:</label>
  																			<p><?php echo $fila_d_producto1['fvencimiento']?></p>
 																			<p><?php echo 'A <strong>'.$dias.'</strong> dias de vencer'?></p>
 																			<p><?php echo 'Cantidad: <strong>'.$fila_d_producto1['cantidad'].'</strong>'?></p>
  																		 </article>
																			 <article class="col-md-3">
	 																			<p>
	 																				<?php
	 																				 echo '<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADD2&iddp='.$fila_d_producto1['id_dproducto'].'">
	 																				 <button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span>  <br>Sumar por ajuste</button>
	 																				 </a>';
	 																				 ?>
	 																			</p>
	 																		</article>

 																	 </section>
																		<?php
																	 }
																	 if ($dias>365) {
																	 	?>
																		<section class="col-md-12 alert alert-success">
																			<article class="col-md-3">
																			 <label for="">Detalle:</label>
																			 <p><strong>ID:</strong>	<?php echo $fila_d_producto1['id_dproducto']?> -- <?php echo $fila_d_producto1['nom_completa']?></p>
																			</article>
																			<article class="col-md-3">
																			 <label for="">Lote:</label>
																			 <p><?php echo $fila_d_producto1['lote']?></p>
																			 <p><?php echo $fila_d_producto1['nom_bodega']?></p>
																			</article>
																			<article class="col-md-3">
																			 <label for="">Caracteristicas:</label>
																			 <p><?php echo $fila_d_producto1['fvencimiento']?></p>
																			 <p><?php echo 'A <strong>'.$dias.'</strong> dias de vencer'?></p>
																			 <p><?php echo 'Cantidad: <strong>'.$fila_d_producto1['cantidad'].'</strong>'?></p>
																			</article>
																			<article class="col-md-3">
  																			<p>
  																				<?php
  																				 echo '<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADD2&iddp='.$fila_d_producto1['id_dproducto'].'">
  																				 <button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span>  <br>Sumar por ajuste</button>
  																				 </a>';
  																				 ?>
  																			</p>
  																		</article>

 																	 </section>
																		<?php
																	 }
																 }
															 }
															 ?>
															</section>
											      </div>
											      <div class="modal-footer">
											        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											      </div>
											    </div>

											  </div>
											</div>
											<?php
			 								}

			 							}
			 				 		}else {
			 							echo'<h3 class="alert alert-danger text-center">Debe realizar el filtro del medicamento.</h3>';
			 				 		}

			}

    	?>

    </table>
  </section>
</section>
	<?php
}
?>
