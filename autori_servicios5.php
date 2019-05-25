<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

			switch ($_POST["operacion"]) {

			case 'X':
				$sql="SELECT logoips from convenios where id_convenios=".$_POST["id_conve"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="DELETE FROM convenios WHERE id_convenios=".$_POST["id_conve"];
				$subtitulo="Eliminado";
			break;
			case 'A':
			$aut=$_POST['num_autori'];
			if ($aut=='') {
				$sql1="SELECT max(num_autori) max FROM m_autorizacion where estado_m_autori='Solicitado'";
				//echo $sql1;
				if ($tabla1=$bd1->sub_tuplas($sql1)){
        	foreach ($tabla1 as $fila1 ) {
						$num=$fila1['max'];
					}
				}
				//echo $sql1;
				$numt=($num+1);
				$sql="INSERT INTO m_autorizacion (id_adm_hosp,resp_reg, finicial, ffinal, num_autori,tipo_num_autori, dx_autori,
					tdx_autori, tipo_servicio, estado_m_autori) VALUES
				('".$_POST["id_adm_hosp"]."','".$_SESSION["AUT"]['id_user']."','".$_POST["finicial"]."','".$_POST["ffinal"]."',
				'".$numt."','".$_POST["tipo_num_autori"]."','".$_POST["dx"]."','".$_POST["tdx"]."','".$_POST["tipo_servicio"]."','Solicitado')";
				$subtitulo="AUTORIZACION";
				$subtitulo1="Adicionado";
				$subtitulo2="SOLICITADO, quiere decir que esta pendiente agregar número de radicado";
			}else {
				$sql="INSERT INTO m_autorizacion (id_adm_hosp,resp_reg, finicial, ffinal, num_autori,tipo_num_autori, dx_autori,
					tdx_autori, tipo_servicio, estado_m_autori) VALUES
				('".$_POST["id_adm_hosp"]."','".$_SESSION["AUT"]['id_user']."','".$_POST["finicial"]."','".$_POST["ffinal"]."',
				'".$_POST["num_autori"]."','".$_POST["tipo_num_autori"]."','".$_POST["dx"]."','".$_POST["tdx"]."','".$_POST["tipo_servicio"]."','Radicado')";
				$subtitulo="AUTORIZACION";
				$subtitulo1="Adicionado";
				$subtitulo2="RADICADO, quiere decir que esta radicado y el número es".$_POST['num_autori'];
			}
			break;
			case 'EAUTORI':
				$sql="UPDATE m_autorizacion SET num_autori='".$_POST["num_autori"]."',tipo_num_autori='".$_POST["tipo_num_autori"]."',dx_autori='".$_POST["dx"]."',tdx_autori='".$_POST["tdx"]."'
				 			WHERE id_m_autori=".$_POST["id_m_autori"];
				$subtitulo="AUTORIZACION";
				$subtitulo1="Actualizado";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El registro de $subtitulo fue $subtitulo1 con exito!, en estado: $subtitulo2";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="El registro de $subtitulo NO fue $subtitulo1";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
			case 'DETALLE':
				$sql="SELECT id_convenios,id_eps,id_ips,finicial,ffinal,nom_convenio,estado_convenio FROM  convenios where id_convenios=".$_GET["idconv"];
				$color="green";
				$boton="Actualizar";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$idadm=$_REQUEST["idadm"];
				$servicio=$_REQUEST["servicio"];
				$doc=$_REQUEST["doc"];
				$subtitulo='Edición de datos de Convenios';
	      $form1='detalle_cups/add_d_autorizacion.php';
			break;
			case 'EAUTORI':
				$sql="SELECT id_m_autori, id_adm_hosp, freg, resp_reg, finicial, ffinal, num_autori,tipo_num_autori, dx_autori, tdx_autori, tipo_servicio, estado_m_autori
							FROM m_autorizacion WHERE id_m_autori=".$_GET["idmautori"];
							//echo $sql;
				$color="green";
				$boton="Actualizar Autorizacion";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$idadm=$_REQUEST["idadm"];
				$servicio=$_REQUEST["servicio"];
				$doc=$_REQUEST["doc"];
				$subtitulo='Editar autorización';
	      $form1='autorizacion/upt_numautori.php';
			break;
			case 'X':
				$sql="SELECT id_convenios,id_eps,id_ips,finicial,ffinal,nom_convenio,estado_convenio FROM  convenios where id_convenios=".$_GET["idconv"];
				$color="red";
				$boton="Eliminar";
				$atributo1=' readonly="readonly"';
				$atributo2=' readonly="readonly"';
				$atributo3=' disabled="disabled"';
				$subtitulo='Confirmación para eliminar de datos de Convenios';
	      $form1='autorizacion/';
			break;
			case 'A':
				$sql="";
				//echo $sql;
				$color="yellow";
				$boton="Crear Autorización";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
	      $idadm=$_REQUEST["idadm"];
	      $servicio=$_REQUEST["servicio"];
	      $doc=$_REQUEST["doc"];
				$subtitulo='Creación de Autorizacion';
	      $form1='autorizacion/add_m_autorizacion.php';
			break;
		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_m_autori"=>"", "id_adm_hosp"=>"", "freg"=>"", "resp_reg"=>"", "finicial"=>"","tipo_num_autori"=>"",
				"ffinal"=>"", "num_autori"=>"", "dx_autori"=>"", "tdx_autori"=>"", "tipo_servicio"=>"", "estado_m_autori"=>"" );

			}
		}else{
				$fila=array("id_m_autori"=>"", "id_adm_hosp"=>"", "freg"=>"", "resp_reg"=>"", "finicial"=>"","tipo_num_autori"=>"",
				"ffinal"=>"", "num_autori"=>"", "dx_autori"=>"", "tdx_autori"=>"", "tipo_servicio"=>"", "estado_m_autori"=>"" );
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
<?php
  $servicio=$_REQUEST['servicio'];
?>
<section class="panel panel-default">
  <section class="panel-heading"><h3>Autorización de servicios en servicio <strong><?php echo $servicio; ?></strong> </h3></section>
  <section class="panel-body">
    <table class="table table-bordered">
  	<?php
  	$doc=$_GET["doc"];
		$adm=$_GET["idadm"];
  	$sql="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,b.id_adm_hosp, b.id_sedes_ips sedes,b.id_eps eps,fingreso_hosp,hingreso_hosp,c.nom_sedes,d.nom_eps
					FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
													 INNER join sedes_ips c on b.id_sedes_ips=c.id_sedes_ips
													 INNER join eps d on b.id_eps=d.id_eps
				  WHERE a.doc_pac='".$doc."' and b.id_adm_hosp='".$adm."' ";
  	if ($tabla=$bd1->sub_tuplas($sql)){
  		//echo $sql;
  		foreach ($tabla as $fila ) {
				$tf=$_REQUEST['tf'];
				if ($tf=='N') {
					echo"<tr >\n";
	  			echo'<td colspan="10" class="text-center alert alert-success"><h3>FORMULA PARA DESCARGUE EN FARMACIA O CARRO AUXILIAR DE MEDICAMENTOS</h3></td>';
	  			echo "</tr>\n";
				}
				if ($tf=='E') {
					echo"<tr >\n";
	  			echo'<td colspan="10" class="text-center alert alert-info"><h3>FORMULA PARA DESCARGUE EN CARRO DE PARO</h3></td>';
	  			echo "</tr>\n";
				}
  			echo"<tr >\n";
  			echo'<td class="text-center alert alert-info"><strong>Identificación:</strong></td>';
  			echo'<td class="text-center">'.$fila["tdoc_pac"].' '.$fila["doc_pac"].'</td>';
				echo'<td class="text-center alert alert-info"><strong>Paciente:</strong></td>';
  			echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
				echo'<td class="text-center alert alert-info"><strong>Fecha ingreso:</strong></td>';
				echo'<td class="text-center">'.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-center alert alert-info"><strong>Sede Actual:</strong></td>';
				echo'<td class="text-center">'.$fila["nom_sedes"].'</td>';
				echo'<td class="text-center hidden">'.$fila["id_sedes_ips"].'</td>';
				echo'<td class="text-center alert alert-info"><strong>EPS:</strong></td>';
				echo'<td class="text-center">'.$fila["nom_eps"].'</td>';
  			echo "</tr>\n";
  		}
  	}
  	?>
  	</table>
  </section>
  <section class="panel-body">
    <table class="table table-responsive table-bordered">
      <tr>
        <td colspan="3" class="text-center"><a href="<?php echo PROGRAMA.'?doc='.$_REQUEST["doc"].'&buscar=Buscar&opcion=17'?>" align="center" ><button type="button" class="btn btn-success fa fa-arrow-left" > Regresar a consultar paciente</button></a></td>
        <td colspan="3" class="text-right"><a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadm='.$_REQUEST["idadm"].'&servicio='.$_REQUEST["servicio"].'&doc='.$_REQUEST["doc"]?>" align="center" ><button type="button" class="btn btn-primary fa fa-plus" > Adicionar Autorización</button></a></td>
      </tr>
    	<tr>
    		<th>VIGENCIA</th>
    		<th># AUTORIZACIÓN</th>
    		<th>DIAGNOSTICO</th>
        <th>ESTADO</th>
        <th></th>
    	</tr>
    	<?php
      $adm=$_REQUEST['idadm'];
    	$sql="SELECT c.tdoc_pac,doc_pac,concat(c.nom1,' ',c.nom2,' ',c.ape1,' ',c.ape2) paciente,
                   a.id_adm_hosp,fingreso_hosp,fegreso_hosp,
                   b.id_m_autori, b.finicial, b.ffinal, b.num_autori,b.tipo_num_autori, b.dx_autori, b.tdx_autori, b.tipo_servicio servicio,b.estado_m_autori

            FROM pacientes c INNER JOIN  adm_hospitalario a on c.id_paciente=a.id_paciente
                             LEFT JOIN  m_autorizacion b on a.id_adm_hosp=b.id_adm_hosp

            WHERE a.estado_adm_hosp='Activo' and a.id_adm_hosp='$adm'";
    			//echo $sql;
        if ($tabla=$bd1->sub_tuplas($sql)){
        	foreach ($tabla as $fila ) {

            if ($fila['id_m_autori']=='') {
              echo"<tr>\n";
        		    echo'<td colspan="6" class="text-center alert alert-danger animated zoomIn lead"><p> No existe resgitro de autorización en este momento</p></td>';
              echo"</tr>\n";
            }else {
              echo"<tr>\n";
              echo'<td class="text-left">';
              echo'
              <p class="text-danger"><strong>Fecha inicial:</strong> <br>'.$fila["finicial"].'</p>
              <p class="text-danger"><strong>Fecha Final:</strong> <br>'.$fila["ffinal"].'</p>
              <p><strong>Servicio:</strong> '.$fila["servicio"].'</p>';
              echo'</td>';

              if ($fila['tipo_num_autori']=='PROPIO') {
                echo'<td class="text-center alert alert-danger">
                      <p>Esta con código propio: <strong>'.$fila["num_autori"].'-'.$fila["tipo_num_autori"].'</strong></p>
                      <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EAUTORI&idmautori='.$fila["id_m_autori"].'&servicio='.$_REQUEST["servicio"].'&idadm='.$_REQUEST["idadm"].'&doc='.$_REQUEST["doc"].'"><button type="button" class="btn btn-primary btn-xs" ><span class="fa fa-edit"></span> Editar</button></a></p>
                     </td>';
              }else {
                echo'<td class="text-center alert alert-success">
                      <p>Numero radicado en EPS: <strong>'.$fila["num_autori"].'-'.$fila["tipo_num_autori"].'</strong></p>
                      <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EAUTORI&idmautori='.$fila["id_m_autori"].'&servicio='.$_REQUEST["servicio"].'&idadm='.$_REQUEST["idadm"].'&doc='.$_REQUEST["doc"].'"><button type="button" class="btn btn-primary btn-xs" ><span class="fa fa-edit"></span> Editar</button></a></p>
                     </td>';
              }

          		echo'<td class="text-left">
          		      <p><strong>Diagnostico:</strong> <br>'.$fila["dx_autori"].'</p>
                    <p><strong>Tipo<br>Diagnostico:</strong> <br>'.$fila["tdx_autori"].'</p>
          		     </td>';
          		echo'<td class="text-center">'.$fila["estado_m_autori"].'</td>';
          		echo'<th class="text-center">
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DETALLE&idm='.$fila["id_m_autori"].'&servicio='.$_REQUEST["servicio"].'&idadm='.$_REQUEST["idadm"].'&doc='.$_REQUEST["doc"].'">
											<button type="button" class="btn btn-primary" ><span class="fa fa-cog"></span> Agregar<br>Procedimientos</button>
										</a></p>
										<div class="table-responsive">
										<table class="table table-bordered">
											<tr class="success">
												<th>Procedimiento</th>
												<th>Cantidad</th>
											</tr>';
											$idm=$fila['id_m_autori'];
											$sqld="SELECT id_d_autori, id_m_autori, freg, cod_cups, cups, frecuencia, cantidad, estado_d_autori FROM d_autorizacion WHERE id_m_autori=$idm ";
											if ($tabla1=$bd1->sub_tuplas($sqld)){
							        	foreach ($tabla1 as $fila1 ) {
													echo'<tr>';
													echo'<td><strong>'.$fila1['cod_cups'].'</strong> | '.$fila1['cups'].'</td>';
													echo'<td>'.$fila1['cantidad'].'</td>';
													echo'</tr>';
												}
											}
							echo'	</table>
										<div>
									 </th>';
              echo "</tr>\n";
            }

        	}
        }
    	?>
    </table>
  </section>
</section>
	<?php
}
?>
