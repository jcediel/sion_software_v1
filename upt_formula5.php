<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["soporte"])){
				if (is_uploaded_file($_FILES["soporte"]["tmp_name"])){
					$cfoto=explode(".",$_FILES["soporte"]["name"]);
					$archivo=$_POST["id_d_fmedhosp"].".".$cfoto[count($cfoto)-1];
					if(move_uploaded_file($_FILES["soporte"]["tmp_name"],LOG.MIPRES.$archivo)){
						$fotopE=",soporte='".MIPRES.$archivo."'";
						$fotopA1=",soporte";
						$fotopA2=",'".MIPRES.$archivo."'";
						}
				}
			}
			switch ($_POST["operacion"]) {
        case 'DELETES':
          $sql="UPDATE d_fmedhosp set estado_med='Cancelado',user_actualiza='".$_SESSION["AUT"]["id_user"]."' where id_d_fmedhosp=".$_POST['idd'];
					$subtitulo="El Medicamento".$_POST['Medicamento'];
					$subtitulo2="CANCELADO con ";
        break;
    case 'UPT':
			$sql="UPDATE d_fmedhosp SET medicamento='".$_POST["medicamento"]."', via='".$_POST["via"]."', frecuencia='".$_POST["frecuencia"]."', dosis1='".$_POST["dosis1"]."',
			dosis2='".$_POST["dosis2"]."', dosis3='".$_POST["dosis3"]."', dosis4='".$_POST["dosis4"]."', obsfmedhosp='".$_POST["obsfmedhosp"]."',user_actualiza='".$_SESSION["AUT"]["id_user"]."'
			WHERE id_d_fmedhosp= '".$_POST["idd"]."' ";

			$subtitulo="El Medicamento".$_POST['Medicamento'];
			$subtitulo2="ACTUALIZADO con ";
			break;
			case 'A':
      $fecha =date('Y-m-d');
      $nuevafecha = strtotime ( '+16 day' , strtotime ( $fecha ) ) ;
      $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
      $f1=$nuevafecha;
      $f2=$_POST['fejecucion_final'];

      if ($f1 <= $f2) {
        $sql="INSERT INTO m_fmedhosp (,id_user,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,servicio) VALUES
        ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["fejecucion_inicial"]."','".$_POST["fejecucion_final"]."','".$_POST["tipo_formula"]."','Solicitado','".$_POST["servicio"]."')";
        $subtitulo="Generada";
        $subtitulo2="Doctor (a): No puede realizar formulas médicas con vigencia superior a 30 días.";
      }
      if ($f1 > $f2) {
          $sql="INSERT INTO m_fmedhosp (id_adm_hosp,id_user,id_bodega,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,servicio) VALUES
          ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["idbodega"]."','".$_POST["fejecucion_inicial"]."','".$_POST["fejecucion_final"]."','".$_POST["tipo_formula"]."','Solicitado','".$_POST["servicio"]."')";
          $subtitulo="Generada";
      }
			break;
			case 'MIPRES':
				$sql="UPDATE d_fmedhosp SET rad_mipres='".$_POST['rad_mipres']."', tipo_mipres='".$_POST['tipo_mipres']."'$fotopE
				WHERE id_d_fmedhosp='".$_POST['id_d_fmedhosp']."'";
				$subtitulo="El MIPRES ".$_POST['rad_mipres'];
				$subtitulo2="registrado";
			break;
		}
	//echo $sql;
    if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo fue $subtitulo2 EXITO.";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logoips"])){
				unlink($fila["logoips"]);
			}
			}
		}else{
			$subtitulo=" $subtitulo NO fue $subtitulo2  exito !!!!!!!!!!!!!!!!!";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
    case 'DELETES':
      $sql="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
									 b.id_m_fmedhosp,id_user,freg_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,servicio,
									 c.id_d_fmedhosp, freg, medicamento, via, frecuencia, dosis1, dosis2, dosis3, dosis4, obsfmedhosp

						FROM adm_hospitalario a left join m_fmedhosp b on a.id_adm_hosp=b.id_adm_hosp
																		left join d_fmedhosp c on b.id_m_fmedhosp=c.id_m_fmedhosp

						WHERE c.id_d_fmedhosp='".$_REQUEST['idm']."'";
      $boton="Cancelar Medicamento";
      $atributo1=' readonly="readonly"';
      $atributo2='readonly="readonly"';
      $atributo3='';
      $return=153;
			$return1=$_REQUEST['id'];
      $return2=$_REQUEST['idadmhosp'];
      $return3=$_REQUEST['doc'];
			$return4=$_REQUEST['idma'];
			$return5=$_REQUEST['servicio'];
			$return8=$_REQUEST['atencion'];
			$return7=$_REQUEST['sede'];
			$return6=$_REQUEST['tf'];
			$return9=$_REQUEST['bod'];
			$frecuencia='<input class="form-control" type="text"  name="frecuencia" value=""<?php echo '.$atributo2.';?>';
      $date=date('Y-m-d');
      $date1=date('H:i');
      $form1='formulariosMED/upt_detalle.php';
      $subtitulo='Cancelación del medicamento';
    break;
		case 'UPT':
      $sql="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
									 b.id_m_fmedhosp,id_user,freg_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,servicio,
									 c.id_d_fmedhosp, freg, medicamento, via, frecuencia, dosis1, dosis2, dosis3, dosis4, obsfmedhosp

						FROM adm_hospitalario a left join m_fmedhosp b on a.id_adm_hosp=b.id_adm_hosp
																		left join d_fmedhosp c on b.id_m_fmedhosp=c.id_m_fmedhosp

						WHERE c.id_d_fmedhosp='".$_REQUEST['idm']."' ";
      $boton="Editar Medicamento";
      $atributo1=' readonly="readonly"';
      $atributo2='';
      $atributo3='';
      $return=153;
      $return1=$_REQUEST['id'];
      $return2=$_REQUEST['idadmhosp'];
      $return3=$_REQUEST['doc'];
			$return4=$_REQUEST['idma'];
			$return7=$_REQUEST['sede'];
			$return8=$_REQUEST['atencion'];
			$return5=$_REQUEST['servicio'];
			$return6=$_REQUEST['tf'];
			$return9=$_REQUEST['bod'];
			$frecuencia='<select class="form-control" name="frecuencia" required="">
				<option value="'.$fila["frecuencia"].'"> <?php echo '.$fila["frecuencia"].';?> Horas</option>
				<option value="24">24 Horas</option>
				<option value="12">12 Horas</option>
				<option value="8">8 Horas</option>
				<option value="6">6 Horas</option>
				<option value="4">4 Horas</option>
			</select>';
      $date=date('Y-m-d');
      $date1=date('H:i');
      $form1='formulariosMED/upt_detalle.php';
			$subtitulo='Edición del medicamento';
    break;

		case 'A':
			$sql="";
			$boton="Crear Formula";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$return=153;
			$return1=$_REQUEST['id'];
			$return2=$_REQUEST['idadmhosp'];
			$return3=$_REQUEST['doc'];
			$return4=$_REQUEST['idma'];
			$return5=$_REQUEST['servicio'];
			$return8=$_REQUEST['atencion'];
			$return7=$_REQUEST['sede'];
			$return6=$_REQUEST['tf'];
			$return9=$_REQUEST['bod'];
			$date=date('Y-m-d');
			$date1=date('H:i');
			if ($return6=='A') {
				$form1='medicacionAmbu/add_fmedhosp.php';
			}else {
				$form1='medicacion/add_fmedhosp.php';
			}

			$subtitulo='Registro de formula';
		break;
		case 'MIPRES':
			$sql="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
									 b.id_m_fmedhosp,id_user,freg_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,servicio,dx_formula,
									 c.id_d_fmedhosp, freg, medicamento, via, frecuencia, dosis1, dosis2, dosis3, dosis4, obsfmedhosp,rad_mipres,cod_med,
									 d.pos

						FROM adm_hospitalario a left join m_fmedhosp b on a.id_adm_hosp=b.id_adm_hosp
																		left join d_fmedhosp c on b.id_m_fmedhosp=c.id_m_fmedhosp
																		left join m_producto d on c.cod_med=d.id_producto

						WHERE c.id_d_fmedhosp='".$_REQUEST['idm']."' ";
						//echo $sql;
			$boton="Registrar MIPRES";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$return=153;
			$return1=$_REQUEST['idma'];
      $return2=$_REQUEST['idadmhosp'];
      $return3=$_REQUEST['doc'];
			$return5=$_REQUEST['servicio'];
			$return8=$_REQUEST['atencion'];
			$return7=$_REQUEST['sede'];
			$return6=$_REQUEST['tf'];
			$return9=$_REQUEST['bod'];
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formulariosMED/add_mipres.php';
			$subtitulo='Registro de número radicado MIPRES en formula médica';
		break;
		}
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("id_d_fmedhosp"=>"", "freg"=>"", "medicamento"=>"", "via"=>"", "frecuencia"=>"", "dosis1"=>"", "dosis2"=>"", "dosis3"=>"", "dosis4"=>"", "obsfmedhosp"=>""
											 ,"dx_formula"=>"", "rad_mipres"=>"", "cod_med"=>"", "pos"=>"");
			}
		}else{
					$fila=array("id_d_fmedhosp"=>"", "freg"=>"", "medicamento"=>"", "via"=>"", "frecuencia"=>"", "dosis1"=>"", "dosis2"=>"", "dosis3"=>"", "dosis4"=>"", "obsfmedhosp"=>""
											 ,"dx_formula"=>"", "rad_mipres"=>"", "cod_med"=>"", "pos"=>"");
			}
		?>
    <script src = "js/sha3.js"></script>
    		<script>
    			function validar(){
    				if (document.forms[0].fejecucion_final.value < document.forms[0].fejecucion_inicial.value){
    					alert("Doctor(a): la fecha final de la formula no puede ser menor a la fecha inicial.");
    					document.forms[0].fejecucion_final.focus();				// Ubicar el cursor
    					return(false);
    				}
    			}
    		</script>
    <div class="alert alert-info animated bounceInRight"></div>
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
	$doc=$_REQUEST['doc'];
	$idadmhosp=$_REQUEST['idadmhosp'];
	$servicio=$_REQUEST['servicio'];
	$atencion=$_REQUEST['atencion'];
	$sede=$_REQUEST['sede'];
	$tf=$_REQUEST['tf'];
?>

<br>
<section class="panel panel-default">
	<section class="panel-body">
		<section class="col-xs-6 text-left">
			<?php include('consulta_ultimaEvo.php') ?>
		</section>
		<section class="col-xs-6 text-right">
		    <a class="btn btn-primary" href="<?php echo PROGRAMA.'?opcion=151&idadmhosp='.$idadmhosp.'&servicio='.$servicio.'&atencion='.$atencion.'&sede='.$sede.'&doc='.$doc.'&tf='.$tf;?>"><span class="glyphicon glyphicon-triangle-left">Regresar a consultar Formulas realizadas</span></a>
		</section>
	</section>
  <section class="panel-heading"><h4>Datos del paciente</h4></section>
  <section class="panel-body">
    <table class="table table-bordered">
  	<?php
  	$doc=$_GET["doc"];
		$adm=$_GET["idadmhosp"];
  	$sql="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,b.id_adm_hosp, b.id_sedes_ips sedes,b.id_eps eps,fingreso_hosp,hingreso_hosp,c.nom_sedes,d.nom_eps
					FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente INNER join sedes_ips c on b.id_sedes_ips=c.id_sedes_ips INNER join eps d on b.id_eps=d.id_eps
					WHERE a.doc_pac='".$doc."' and b.id_adm_hosp='".$adm."' ";
  	if ($tabla=$bd1->sub_tuplas($sql)){
  		//echo $sql;
  		foreach ($tabla as $fila ) {
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
  <section class="panel-heading"><h4>Actualización o eliminación de medicamentos <?php echo $_GET['servicio']; ?></h4></section>
  <section class="panel-body">
  <table class="table table-responsive table-bordered">
  	<tr>
      <th class="text-center"></th>
			<th class="text-center success">MEDICAMENTO</th>
  		<th class="text-center success">6am-8am</th>
			<th class="text-center success">12m-2pm</th>
			<th class="text-center success">6pm-8pm</th>
			<th class="text-center success">10pm-12pm</th>
			<th class="text-center success">OBSERVACIÓN</th>
			<th class="text-center success text-primary">MIPRES</th>

  	</tr>
  	<?php
  	if (isset($_REQUEST["idadmhosp"])){
  	$idm=$_GET["idm"];
  	$sql="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
								 b.id_m_fmedhosp,id_user,freg_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,servicio,dx_formula,dx1_formula,dx2_formula,
								 c.id_d_fmedhosp, freg, medicamento, via, frecuencia, dosis1, dosis2, dosis3, dosis4, obsfmedhosp,rad_mipres,tipo_mipres,soporte,cod_med,
								 d.pos

					FROM adm_hospitalario a left join m_fmedhosp b on a.id_adm_hosp=b.id_adm_hosp
																	left join d_fmedhosp c on b.id_m_fmedhosp=c.id_m_fmedhosp
																	left join m_producto d on c.cod_med=d.id_producto

					WHERE b.id_m_fmedhosp='".$idm."' and c.estado_med='Solicitado'";
		//echo $sql;
  	if ($tabla=$bd1->sub_tuplas($sql)){
  		foreach ($tabla as $fila ) {

        if ($fila['id_m_fmedhosp']=='') {
          $doc=$_REQUEST['doc'];
          echo"<tr >\n";
    			echo'<td colspan="8" class="text-center"><h2 class="alert alert-danger text-center">No existen formulas creadas en admisión '.$fila['id_adm_hosp'].'</h2></th>';
    			echo "</tr>\n";
        }else {
					if ($fila['estado_m_fmedhosp']=='Solicitado') {
							echo"<tr >\n";
		          echo'<th class="text-center info" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DELETES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'&sede='.$_REQUEST['sede'].'&bod='.$_REQUEST['bod'].'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-trash"></span> Cancelar <br>Medicamento</button></a></th>';
		          $id=$fila["id_m_fmedhosp"];

		    			echo'<td class="text-left info">
										<p><strong class="text-primary">'.$fila["medicamento"].'</strong></p>
										<p><strong>Vía: </strong> '.$fila["via"].'</p>
										<p><strong>Frecuencia: </strong> '.$fila["frecuencia"].'</p>
										<p><strong>Fecha registro:</strong> '.$fila["freg"].'</p>
										<p><strong>ID:</strong> '.$fila["id_d_fmedhosp"].'</p>
									 </td>';
							echo'<td class="text-center info">'.$fila["dosis1"].'</td>';
							echo'<td class="text-center info">'.$fila["dosis2"].'</td>';
							echo'<td class="text-center info">'.$fila["dosis3"].'</td>';
							echo'<td class="text-center info">'.$fila["dosis4"].'</td>';
							echo'<td class="text-center info">
										<p>'.$fila["obsfmedhosp"].'</p></td>';
							echo'<td class="text-justify info">';

							$dx=$fila['dx_formula'];
							$dx1=$fila['dx1_formula'];
							$dx2=$fila['dx2_formula'];
							$pos=$fila['pos'];
							$cod=$fila['cod_med'];

							//Validacion para medicamentos NO POS
							if ($pos==1) {
								include('formulariosMED/exepcionDx.php');

						   }
							//validacion para el medicamento POS puro
							if ($pos==0) {
								echo'<p class="text-success"><strong>POS</strong> </p>';
							}
							if ($pos==3) {
								echo'<p class="text-danger"><strong>NO POS</strong></p>';
								$rad=$fila['rad_mipres'];
								$tm=$fila['tipo_mipres'];
								if ($tm==1) {
									echo'<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=JM&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>Junta Medica</button></a>';
								}
								if($tm==''){
									echo'<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a>';
								}
							}
							echo'</td>';

		    			echo "</tr>\n";
					}
        }
  		}
  	}
  }
  	?>
    <tr>
      <td>
        <th colspan="13" class="text-center"><a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&servicio='.$_REQUEST['servicio'].'&idadmhosp='.$_REQUEST["idadmhosp"].'&atencion='.$_REQUEST["atencion"].'&sede='.$_REQUEST["sede"].'&bod='.$_REQUEST["bod"].'&idm='.$_REQUEST['idm'].'&doc='.$_REQUEST['doc'].'&tf='.$_REQUEST['tf'];?>"><button type="button" class="btn btn-primary"> <span class="fa fa-plus"></span> Crear <br>Medicamento</button>
      </td>
    </tr>
  	</table>
  	<br>
  </section>
</section>
	<?php
}
?>
|
