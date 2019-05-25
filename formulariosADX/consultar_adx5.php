<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

			switch ($_POST["operacion"]) {
        case 'DELETES':
          $sql="UPDATE m_fmedhosp set estado_m_fmedhosp='Cancelado' where id_m_fmedhosp=".$_POST['idm'];
          $subtitulo='Cancelada';
          break;
      case 'E':
			$sql="INSERT INTO ord_med_ambu (id_adm_hosp, id_user, freg_ord_med_ambu, hreg_ord_med_ambu, ts_ord_med_ambu, procedimiento, estado_ord_med_ambu, obs_proc ) VALUES
			('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["tiposervicio"]."','".$_POST["cups"]."','Realizada','".$_POST["obs_proc"]."')";
			$subtitulo="Generada";
			break;
			case 'A':
        $sql="INSERT INTO master_procedimiento (id_adm_hosp,id_user, servicio, tipo_atencion, dx, tdx, estado_orden) VALUES
        ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["servicio"]."','".$_POST["tipo_atencion"]."','".$_POST["dx"]."','".$_POST["tdx"]."','Solicitado')";
        $subtitulo="Generada";
      break;
			case 'INTERPRETACION':
        $sql="UPDATE detalle_procedimiento SET freg_inter='".$_POST["freg"]."',nota_inter='".$_POST["interpretacion"]."',estado_prod='Interpretado' WHERE id_d_procedimiento='".$_POST["idd"]."' ";
        $subtitulo="Generada";
      break;
		}
		echo $sql;
    if ($bd1->consulta($sql)){
			$subtitulo="La ayuda diagnóstica ha sido $subtitulo con EXITO.";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logoips"])){
				unlink($fila["logoips"]);
			}
			}
		}else{
			$subtitulo="La ayuda diagnóstica NO se ha $subtitulo !!!";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
    case 'DELETES':
      $sql="SELECT id_m_fmedhosp,tipo_formula from m_fmedhosp where id_m_fmedhosp=".$_GET['idm'];
      $boton="Cancelar Formula";
      $atributo1=' readonly="readonly"';
      $atributo2='readonly="readonly"';
      $atributo3='';
      $return=133;
      $return1=$_REQUEST['idadmhosp'];
      $return2=$_REQUEST['servicio'];
      $return3=$_REQUEST['doc'];
      $date=date('Y-m-d');
      $date1=date('H:i');
      $form1='formulariosMED/add_m_fmedhosp.php';
      $subtitulo='Cancelación de formula';
    break;
    case 'ADDDETALLE':
      $sql="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
									 b.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
									 c.id_d_procedimiento,freg,procedimiento,observacion,estado_prod

						FROM adm_hospitalario a left join master_procedimiento b on a.id_adm_hosp=b.id_adm_hosp
																		left join detalle_procedimiento c on b.id_master_prod=c.id_master_prod
						WHERE b.id_master_prod='".$_GET['idm']."' order by freg DESC";
      $boton="Crear Formula";
      $atributo1=' readonly="readonly"';
      $atributo2='';
      $atributo3='';
      $return=133;
      $return1=$_REQUEST['id'];
      $return2=$_REQUEST['servicio'];
      $return3=$_REQUEST['doc'];
      $date=date('Y-m-d');
      $date1=date('H:i');
      $form1='formulariosADX/add_adx.php';
    break;
		case 'CONSULTARDETALLE':
      $sql="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
									 b.id_master_prod,  fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
									 c.id_d_procedimiento,freg,procedimiento,observacion,estado_prod

						FROM adm_hospitalario a left join master_procedimiento b on a.id_adm_hosp=b.id_adm_hosp
																		left join detalle_procedimiento c on b.id_master_prod=c.id_master_prod
						WHERE b.id_master_prod='".$_GET['idm']."' order by freg DESC";
      $boton="Crear Formula";
      $atributo1=' readonly="readonly"';
      $atributo2='';
      $atributo3='';
      $return=133;
			$return1=$_REQUEST['idm'];
      $return2=$_REQUEST['idadmhosp'];
      $return3=$_REQUEST['doc'];
			$return4=$_REQUEST['servicio'];
      $date=date('Y-m-d');
      $date1=date('H:i');
      $form1='formulariosADX/consultar_adx.php';
    break;
		case 'INTERPRETACION':
      $sql="SELECT procedimiento,observacion FROM detalle_procedimiento where id_d_procedimiento=".$_GET['idd'];
      $boton="Adicionar Interpretacíon";
      $atributo1=' readonly="readonly"';
      $atributo2='';
      $atributo3='';
      $return=133;
      $return1=$_REQUEST['idm'];
      $return2=$_REQUEST['idadmhosp'];
      $return3=$_REQUEST['doc'];
			$return4=$_REQUEST['servicio'];
      $date=date('Y-m-d');
      $date1=date('H:i');
      $form1='formulariosADX/interpretacion.php';
    break;

			case 'A':
  			$sql="";
  			$color="yellow";
  			$boton="Crear Orden de servicio";
  			$atributo1=' readonly="readonly"';
  			$atributo2='';
  			$atributo3='';
        $return=133;
        $return1=$_REQUEST['idadmhosp'];
        $return2=$_REQUEST['servicio'];
        $return3=$_REQUEST['doc'];
  			$date=date('Y-m-d');
  			$date1=date('H:i');
        $form1='formulariosADX/add_master_prod.php';
        $subtitulo='Creación de ayuda diagnóstica  en servicio '.$return2;
			break;
		}
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("id_master_prod"=>"","fecha_orden"=>"","servicio"=>"","tipo_atencion"=>"","dx"=>"","tdx"=>"","estado_orden"=>"",
					"id_d_procedimiento"=>"","freg"=>"","procedimiento"=>"","observacion"=>"","estado_prod"=>"");
			}
		}else{
					$fila=array("id_master_prod"=>"","fecha_orden"=>"","servicio"=>"","tipo_atencion"=>"","dx"=>"","tdx"=>"","estado_orden"=>"",
					"id_d_procedimiento"=>"","freg"=>"","procedimiento"=>"","observacion"=>"","estado_prod"=>"");
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
<?php $doc=$_REQUEST['doc']; ?>
<section class="col-xs-7">
    <a class="btn btn-primary" href="<?php echo PROGRAMA.'?opcion=133&idadmhosp='.$_REQUEST['idadmhosp'].'&servicio='.$_REQUEST['servicio'].'&doc='.$_REQUEST['doc'].'';?>"><span class="glyphicon glyphicon-triangle-left">Regresar a consultar orden de servicio</span></a>
</section>
<br>
<section class="panel panel-default">
  <section class="panel-heading"><h4>Datos del paciente</h4></section>
  <section class="panel-body">
    <table class="table table-bordered">
  	<?php
  	$doc=$_GET["doc"];
		$adm=$_GET["idadmhosp"];
  	$sql="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,b.id_adm_hosp, b.id_sedes_ips sedes,b.id_eps eps,fingreso_hosp,hingreso_hosp,c.nom_sedes,d.nom_eps FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente INNER join sedes_ips c on b.id_sedes_ips=c.id_sedes_ips INNER join eps d on b.id_eps=d.id_eps WHERE a.doc_pac='".$doc."' and b.id_adm_hosp='".$adm."' ";
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
  <section class="panel-heading"><h4>Listado de procedimientos Ordenados para esta orden de servicio</h4></section>
  <section class="panel-body">
  <table class="table table-responsive table-bordered">
    <tr>
      <th>ID</th>
      <th>PROCEDIMIENTO</th>
      <th>OBSERVACION</th>
      <th>TIPO PROCEDIMIENTO</th>
      <th>ESTADO</th>
    </tr>
    <?php

    $idm=$_GET["idm"];
    $sql="SELECT a.id_adm_hosp,id_sedes_ips,tipo_servicio,
                 b.id_master_prod,fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
                 c.id_d_procedimiento,procedimiento,observacion,estado_prod,freg_inter,nota_inter,
								 d.tipo_procedimiento
          FROM adm_hospitalario a left join master_procedimiento b on a.id_adm_hosp=b.id_adm_hosp
                                  left join detalle_procedimiento c on b.id_master_prod=c.id_master_prod
																	left join cups d on c.cod_cups=d.codcupsmin
          WHERE b.id_master_prod='".$idm."' order by fecha_orden DESC";
      //echo $sql;
    if ($tabla=$bd1->sub_tuplas($sql)){

      foreach ($tabla as $fila ) {
        if ($fila['id_d_procedimiento']=='') {
          $doc=$_REQUEST['doc'];
          echo"<tr >\n";
          echo'<td colspan="8" class="text-center"><h2 class="alert alert-danger text-center">No existen detalles de orden en esta solicitud</h2></th>';
          echo "</tr>\n";
        }else {
          if ($fila['estado_prod']=='Solicitado') {
              echo"<tr >\n";
              echo'<td class="text-center danger">'.$fila["id_d_procedimiento"].'</td>';
              $idm=$fila["id_master_prod"];
              echo'<td class="text-center danger"><strong>'.$fila["procedimiento"].'</strong></td>';
              echo'<td class="text-center danger">'.$fila["observacion"].'</td>';
              echo'<td class="text-center danger">'.$fila["tipo_procedimiento"].'</td>';
              echo'<td class="text-center danger lead">'.$fila["estado_prod"].'</td>';
              echo'<th class="text-center danger" ><span class="fa fa-spinner fa-pulse fa-3x fa-fw text-danger"></span>Aún no se ha tomado la muestra...</th>';
              echo "</tr>\n";
          }
					if ($fila['estado_prod']=='Muestra') {
              echo"<tr >\n";
              echo'<td class="text-center warning">'.$fila["id_d_procedimiento"].'</td>';
              $idm=$fila["id_master_prod"];
              echo'<td class="text-center warning"><strong>'.$fila["procedimiento"].'</strong></td>';
              echo'<td class="text-center warning">'.$fila["observacion"].'</td>';
              echo'<td class="text-center warning">'.$fila["tipo_procedimiento"].'</td>';
              echo'<td class="text-center warning">'.$fila["estado_prod"].'</td>';
              echo'<th class="text-center warning" ><span class="fa fa-spinner fa-pulse fa-3x fa-fw text-danger"></span><p class="text-justify">Ya se tomo muestra, falta procesamiento en laboratorio...</p></th>';
              echo "</tr>\n";
          }
					if ($fila['estado_prod']=='Procesada') {
              echo"<tr >\n";
              echo'<td class="text-center info">'.$fila["id_d_procedimiento"].'</td>';
              $idm=$fila["id_master_prod"];
              echo'<td class="text-center info"><strong>'.$fila["procedimiento"].'</strong></td>';
              echo'<td class="text-center info">'.$fila["observacion"].'</td>';
              echo'<td class="text-center info">'.$fila["tipo_procedimiento"].'</td>';
              echo'<td class="text-center info">'.$fila["estado_prod"].'</td>';
              echo'<th class="text-center info" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=INTERPRETACION&idd='.$fila['id_d_procedimiento'].'&idm='.$idm.'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$_REQUEST['servicio'].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-square-o"></span> Agregar Interpretación</button></a></th>';
              echo "</tr>\n";
          }
					if ($fila['estado_prod']=='Interpretado') {
              echo"<tr >\n";
              echo'<td class="text-center success">'.$fila["id_d_procedimiento"].'</td>';
              $id=$fila["id_master_prod"];
              echo'<td class="text-center success"><strong>'.$fila["procedimiento"].'</strong></td>';
              echo'<td class="text-center success">'.$fila["observacion"].'</td>';
              echo'<td class="text-center success">'.$fila["tipo_procedimiento"].'</td>';
              echo'<td class="text-center success">'.$fila["estado_prod"].'</td>';
              echo'<th class="text-center success" ><span class="fa fa-ban"></span></th>';
              echo "</tr>\n";
          }
        }
      }
    }

    ?>
    <tr>
      <td>
        <th colspan="8" class="text-center"><a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$fila['id_adm_hosp'].'&servicio='.$fila['tipo_servicio'].'&sede='.$fila['id_sedes_ips'];?>"><button type="button" class="btn btn-primary"> <span class="fa fa-upload"></span> Cargar Soporte Laboratorio</button>
      </td>
    </tr>
  	</table>
  	<br>
  </section>
</section>
	<?php
}
?>
