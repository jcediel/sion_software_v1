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
				case 'DEVOLUCION':
				$idp=$_POST['id_producto'];
				$accion=$_POST['accion'];
				if ($accion=="Devolucion") {
					$forma=$_POST['ffarmaceutica'];
					if ($forma=='TABLETA' || $forma=='CAPSULA' || $forma=='SOLUCION INYECTABLE'  || $forma=='GRAGEA'
					|| $forma=='COMPRIMIDO' || $forma=='OVULO' || $forma=='PERLAS'  || $forma=='UNIDAD') {
						$tinventario=$_POST['total_inv'];
						$cantdevolucion=$_POST['cant_devolucion'];
						$total=$cantdevolucion + $tinventario;
						$sql="UPDATE d_producto SET cantidad='$total',user_mod='".$_SESSION['AUT']['id_user']."',accion=4,total_fraccion='".$_POST['total_fraccion']."'	WHERE id_dproducto='".$_POST['id_producto']."'";
						$sql1="UPDATE dosificacion_med SET estado_devolucion=1 WHERE id_dosi_med='".$_POST['id_dosi_med']."'";
						$subtitulo="Devolución hecha en inventario";
					}
				}
				if ($accion=="Desperdicio") {
					$forma=$_POST['ffarmaceutica'];
					if ($forma=='GOTAS' || $forma=='SOLUCION ORAL' || $forma=='JARABE' || $forma=='SUSPENSION'
															|| $forma=='SOLUCION OFTALMICA'  || $forma=='LOCION'  || $forma=='AEROSOL'
															|| $forma=='POLVO PARA RECONTITUIR' || $forma=='SHAMPOO'  || $forma=='JALEA') {
																$tinventario=$_POST['total_fraccion'];
																$cantdevolucion=$_POST['cant_devolucion'];
																$total=$tinventario - $cantdevolucion;
																$sql="UPDATE d_producto SET cantidad='".$_POST['total_inv']."',user_mod='".$_SESSION['AUT']['id_user']."',accion=4,total_fraccion=$total	WHERE id_dproducto='".$_POST['id_producto']."'";
																$sql1="UPDATE dosificacion_med SET estado_devolucion=2 WHERE id_dosi_med='".$_POST['id_dosi_med']."'";
																$subtitulo="Devolución hecha en inventario";
					}
					if ($forma=='TABLETA' || $forma=='CAPSULA' || $forma=='SOLUCION INYECTABLE'  || $forma=='GRAGEA'
					|| $forma=='COMPRIMIDO' || $forma=='OVULO' || $forma=='PERLAS'  || $forma=='UNIDAD') {
						$tinventario=$_POST['total_inv'];
						$cantdevolucion=$_POST['cant_devolucion'];
						$total=$tinventario - $cantdevolucion;
						$sql="UPDATE d_producto SET cantidad='$total',user_mod='".$_SESSION['AUT']['id_user']."',accion=5,total_fraccion='".$_POST['total_fraccion']."'	WHERE id_dproducto='".$_POST['id_producto']."'";
						$sql1="UPDATE dosificacion_med SET estado_devolucion=2 WHERE id_dosi_med='".$_POST['id_dosi_med']."'";
						$subtitulo="Devolución hecha en inventario";
				}
			}
				break;

		}
	//	echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo1 fue  $subtitulo con exito!";
			$check='si';
			if ($bd1->consulta($sql1)) {
					$subtitulo="$subtitulo con exito! $accion!";
					$check='si';
			}
		}else{
			$subtitulo="La bodega NO fue $subtitulo !!! .";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'E':
			$sql="SELECT b.id_bodega, fcreacion, nom_bodega,tipo_bodega,s.nom_sedes  FROM bodega b left join sedes_ips s on b.id_sedes_ips=s.id_sedes_ips where id_bodega=".$_GET["idbog"];
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$estado='<article class="col-xs-3">
				<label for="">Estado Bodega:</label>
				<select class="form-control" name="estado_act" required="">
					<option value=""></option>
					<option value="Activo">Activo</option>
					<option value="Inactivo">Inactivo</option>
				</select>
			</article>';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/bodega.php';
			$subtitulo='Edicion de bodega';
			break;

			case 'DEVOLUCION':
			$sql="";
			$color="yellow";
			$boton="Guardar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
      $f1=$_REQUEST['f1'];
      $f2=$_REQUEST['f2'];
			$date=date();
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formulariosMED/INVENTARIO/DEVOLUCION/add_devolucion.php';
			$subtitulo='Registro de devolución medicamentos';
			break;

		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){

				$fila=array("id_bodega"=>"", "fcreacion"=>"", "nom_bodega"=>"","tipo_bodega"=>"","nom_sedes"=>"");
				print_r($fila);
			}
		}else{
				$fila=array("id_bodega"=>"", "fcreacion"=>"", "nom_bodega"=>"","tipo_bodega"=>"","nom_sedes"=>"");
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
	}// nivel 1?>
  <section class="panel panel-default">
    <section class="panel-heading">
      <h2>Devolución de medicamentos</h2>
    </section>
    <section class="panel-body">
      <form>
        <section class="panel-body">
          <article class="col-md-3">
            <label for="">Filtro de fecha inicial:</label>
            <input type="date" class="form-control" name="f1" value="">
          </article>
          <article class="col-md-3">
            <label for="">Filtro de fecha final:</label>
            <input type="date" class="form-control" name="f2" value="">
          </article>
					<article class="col-md-4">
            <label for="">Selección de sede:</label>
            <select class="form-control"  name="sede">
            	<?php
							$sql="SELECT id_sedes_ips,nom_sedes from sedes_ips where id_sedes_ips in (2,8) ORDER BY id_sedes_ips ASC";
    					if($tabla=$bd1->sub_tuplas($sql)){
    						foreach ($tabla as $fila2) {
    							if ($fila["id_sedes_ips"]==$fila2["id_sedes_ips"]){
    								$sw=' selected="selected"';
    							}else{
    								$sw="";
    							}
    						echo '<option value="'.$fila2["id_sedes_ips"].'"'.$sw.'>'.$fila2["nom_sedes"].'</option>';
    						}
    					}
							 ?>
            </select>
          </article>
          <div class="col-md-2">
            <input type="submit" name="buscar" class="btn btn-primary" value="Buscar">
            <input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
          </div>
        </section>
      </form>
    </section>
    <section class="panel-body">
      <table class="table table-bordered">
          <tr>
            <th class="text-center danger" colspan="4">CONSOLIDADO DE DEVOLUCION</th>
          </tr>
        <?php

        $f1=$_REQUEST['f1'];
        $f2=$_REQUEST['f2'];
				$sede=$_REQUEST['sede'];
        $sql3="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
                     b.id_adm_hosp,
                     c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,dx_formula,dx1_formula,dx2_formula,
                     d.id_d_fmedhosp,cod_med,
                     e.freg_farmacia,  sum(cant_admin) total, estado_dosi,
                     f.id_dproducto, nom_completa,nom_comercial,cantidad, laboratorio, reg_invima, fvencimiento, cum, lote,
                     g.nombre respadm

            FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
                             INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
                             INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
                             INNER JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
                             INNER JOIN d_producto f on (f.id_dproducto=e.d_producto)
                             INNER JOIN user g on (g.id_user=e.resp_adm)

            WHERE e.estado_admin='Devuelto' and e.freg_farmacia BETWEEN '$f1' and '$f2'
            GROUP BY a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
                     b.id_adm_hosp,
                     c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,dx_formula,dx1_formula,dx2_formula,
                     d.id_d_fmedhosp,cod_med,
                     e.freg_farmacia, estado_dosi,
                     f.id_dproducto, nom_completa,nom_comercial,cantidad, laboratorio, reg_invima, fvencimiento, cum, lote,
                     g.nombre
          ";
            //echo $sql3;
      if ($tabla3=$bd1->sub_tuplas($sql3)){
        foreach ($tabla3 as $fila3 ) {
          echo '<tr class="text-center">';
          echo '<td  colspan="4">';
          echo'<p><h2><strong>Medicamento: </strong>'.$fila3['nom_completa'].' <strong>Cantidad total: </strong> <strong class="text-danger">'.$fila3['total'].'</strong></h2></p>';
          echo'</td>';
            ?>
              <tr>
								<td class="info">PACIENTE</td>
                <td class="info">MEDICAMENTO</td>
                <td class="info">LOTE</td>
                <td class="info">RESPONSABLES</td>
                <td class="info"></td>
              </tr>
            <?php
            $id_dosi=$fila3['id_d_fmedhosp'];
            $sql_d_producto="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
          							 b.id_adm_hosp,
          							 c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,dx_formula,dx1_formula,dx2_formula,
          							 d.id_d_fmedhosp,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4,obsfmedhosp,tipo_mipres,rad_mipres,cod_med,
                         e.id_dosi_med,freg_farmacia, cant_dosi,nom_dosi, estado_dosi,cant_admin,obs_admin,fadmin,estado_devolucion,
                         f.id_dproducto, nom_completa,nom_comercial,cantidad, laboratorio, reg_invima, fvencimiento, cum, lote,
                         g.nombre devuelve,h.nombre dosifica

          			FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
          											 INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
          											 INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
                                 INNER JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
                                 INNER JOIN d_producto f on (f.id_dproducto=e.d_producto)
                                 INNER JOIN user g on (g.id_user=e.resp_adm)
                                 INNER JOIN user h on (h.id_user=e.id_user)

                WHERE d.id_d_fmedhosp=$id_dosi AND e.estado_admin='Devuelto' and e.freg_farmacia BETWEEN '$f1' and '$f2'
    				   ";
          	//echo $sql_d_producto;
              if ($tabla_d_producto=$bd1->sub_tuplas($sql_d_producto)){
              	foreach ($tabla_d_producto as $fila_d_producto) {
                  echo'<tr>';
									echo'<td>
                        <p>'.$fila_d_producto['nom1'].' '.$fila_d_producto['nom2'].' '.$fila_d_producto['ape1'].' '.$fila_d_producto['ape2'].'</p>
                        <p><strong>'.$fila_d_producto['tdoc_pac'].':</strong> '.$fila_d_producto['doc_pac'].'</p>
                       </td>';
                  echo'<td>
                        <p>'.$fila_d_producto['nom_completa'].'</p>
                        <p><strong>Cantidad:</strong> '.$fila_d_producto['cant_admin'].'</p>
												<p><strong>Dosis:</strong> '.$fila_d_producto['nom_dosi'].'</p>
												<p><strong>Fecha devolución:</strong> '.$fila_d_producto['fadmin'].'</p>
												<p><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#devolucion'.$fila_d_producto['id_dosi_med'].'">Nota de devolución</button></p>
												<div id="devolucion'.$fila_d_producto['id_dosi_med'].'" class="modal fade" role="dialog">
											  <div class="modal-dialog">

											    <!-- Modal content-->
											    <div class="modal-content">
											      <div class="modal-header">
											        <button type="button" class="close" data-dismiss="modal">&times;</button>
											        <h4 class="modal-title">Nota de devolución</h4>
											      </div>
											      <div class="modal-body">
											        <p>'.$fila_d_producto['obs_admin'].'</p>
											      </div>
											      <div class="modal-footer">
											        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											      </div>
											    </div>

											  </div>
											</div>
                       </td>';
                  echo'<td>'.$fila_d_producto['lote'].'</td>';
                  echo'<td>
                        <p><strong>Responsable Devolución: </strong>'.$fila_d_producto['devuelve'].'</p>
                        <p><strong>Dosificador: </strong>'.$fila_d_producto['dosifica'].'</p>
                       </td>';
                  echo'<td>';
									$ed=$fila_d_producto['estado_devolucion'];
									if ($ed==0) {
										echo'<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DEVOLUCION&producto='.$fila_d_producto["id_dproducto"].'&dosi='.$fila_d_producto['id_dosi_med'].'&f1='.$_REQUEST['f1'].'&f2='.$_REQUEST['f2'].'&ct='.$fila_d_producto['cant_admin'].'">
										<button type="button" class="btn btn-danger">
										<span class="fa fa-minus"></span> Devolver</button></a>
									 </td>';
									}
									if ($ed==1) {
										echo'<p class="alert alert-info">Medicamento devuelto a inventario de farmacia.</p>
									 </td>';
									}
									if ($ed==2) {
										echo'<p class="alert alert-danger">Medicamento Fue marcado como desperdicio. <span class="fa fa-sad-tear"></span></p>
									 </td>';
									}

                  echo'</tr>';
                }
              }
             ?>

            <?php
          echo '</tr>';
          }
        }

      ?>

      </table>
    </section>
  </section>
	<?php
}
?>
