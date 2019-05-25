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


		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El formato de $subtitulo en $subtitulo2 fue $subtitulo1 con exito!";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="El formato de $subtitulo en $subtitulo2 NO fue $subtitulo1 !!! .";
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'VI':
    $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
    j.nom_eps
    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                left join eps j on (j.id_eps=b.id_eps)
    where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Valoración";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/valinipsico__reh.php';
			$subtitulo='Valoracion inicial Psicologia';
			break;
			case 'EVO':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Evolución";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/evo_psico_reh5.php';
			$subtitulo='Evolución Diaria Psicologia';
			break;
			case 'IM':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Informe Mensual";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/impsico_reh5.php';
			$subtitulo='Informe Mensual Psicologia';
			break;
			case 'PT':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Plan tratamiento";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/planfono_reh.php';
			$subtitulo='Plan Trimestral Psicologia ';
			break;

		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"");
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].hreg.value > document.forms[0].fecha.value){
					alert("Enfermero (a) <?php echo $_SESSION["AUT"]["nombre"]?>, NO puede adelantar el tiempo.");
					document.forms[0].hreg.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
		<script type="text/javascript" src="/js/jquery.js"></script>
		<div class="alert alert-info animated bounceInRight">
			<?php echo $subtitulo;?>
		</div>
		<?php include($form1);?>

<?php
}else{
	echo '<div class="alert alert-success animated bounceInRight">';
	echo $subtitulo;
	echo '</div>';
// nivel 1?>
<section class="panel-default">
  <section class="panel-heading">
    <h3>Medicamentos de NO CONTROLADOS</h3>
  </section>
  <section class="panel-body">
  <table class="table table-bordered">
  	<tr>
  		<th class="info">FORMULA</th>
  		<th class="info">MEDICAMENTO</th>
  		<th class="info text-center" colspan="2">Acciones</th>
  	</tr>

  	<?php
    $idadm=$_REQUEST['idadm'];
    $servicio=$_REQUEST['servicio'];
    $atencion=$_REQUEST['atencion'];
    $sql_formula="SELECT k.nom_eps,
                 a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
                 b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
                 c.descripestadoc,
                 d.descriafiliado,
                 e.descritusuario,
                 f.descriocu,
                 g.descripdep,
                 h.descrimuni,
                 i.descripuedad,
                 o.fejecucion_final,fejecucion_inicial,
                 m.medicamento,freg,via,frecuencia,dosis1,dosis2,dosis3,dosis4,id_d_fmedhosp,
                 q.nom_sedes,dir_sedes,telefono,ciudad,
                 n.controlado,unidad,embalaje,
                 l.nombre,l.rm_profesional,l.especialidad ,firma

          FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
                           INNER JOIN eps k on (k.id_eps = b.id_eps)
                           INNER JOIN sedes_ips q on (q.id_sedes_ips = b.id_sedes_ips)
                           left join estado_civil c on (c.codestadoc = a.estadocivil)
                           left join tusuario e on (e.codtusuario=b.tipo_usuario)
                           left join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
                           left join ocupacion f on (f.codocu=b.ocupacion)
                           left join departamento g on (g.coddep=b.dep_residencia)
                           left join municipios h on (h.codmuni=b.mun_residencia)
                           left join uedad i on (i.coduedad=a.uedad)
                           INNER JOIN m_fmedhosp o on (b.id_adm_hosp=o.id_adm_hosp)
                           INNER JOIN d_fmedhosp m on (o.id_m_fmedhosp=m.id_m_fmedhosp)
                           LEFT JOIN m_producto n on (n.id_producto = m.cod_med  and n.estado_propio = 2)
                           left join user l on (l.id_user=o.id_user)

          WHERE  b.id_adm_hosp=$idadm and m.estado_med='Solicitado'
          and o.tipo_formula='Ambulatoria' and b.tipo_servicio='$servicio' ORDER BY n.controlado ASC";
          //echo $sql_formula;
					$i=1;
          if ($tabla_formula=$bd1->sub_tuplas($sql_formula)){
            foreach ($tabla_formula as $fila_formula) {

              $control=$fila_formula['controlado'];
              if ($control<>1) {
								echo'<tr>';
								echo'<th>'.$i++.'</th>';
								$d1=$fila_formula['dosis1'];
								$d2=$fila_formula['dosis2'];
								$d3=$fila_formula['dosis3'];
								$d4=$fila_formula['dosis4'];
								$dt=$d1+$d2+$d3+$d4;
								$fecha1=$fila_formula["fejecucion_inicial"];
								$fecha2=$fila_formula["fejecucion_final"];
								$segundos= strtotime($fecha2) - strtotime($fecha1);
								$diferencia_dias=intval($segundos/60/60/24);
								if ($diferencia_dias==31) {
									$diferencia_dias=30;
								}else {
									$diferencia_dias=$diferencia_dias;
								}

								$t=$dt*$diferencia_dias;
								$total=ceil($t/$fila_formula['unidad']);

								$total_unico_dosis=$fila_formula['unidad'];
								$cambio=valorEnLetras($total);
								$cambio_unico_dosis=valorEnLetras($total_unico_dosis);
								echo'<td>
											<article class="col-md-12">
												<p><strong>'.$fila_formula['medicamento'].'</strong></p>
												<p><strong>Inicial:</strong> '.$fila_formula['fejecucion_inicial'].'</p>
												<p><strong>Final:</strong> '.$fila_formula['fejecucion_final'].'</p>
											</article>
											<table class="table table-bordered">
												<tr>
													<th>Unidad en Fracción</th>
													<th>Dias</th>
													<th>Total en UNIDAD</th>
												</tr>
												<tr>
													<td>
													<article class="col-md-12">
														<p>'.$dt.'</p>
													</article>
													</td>
													';
													$frecuencia=$fila_formula['frecuencia'];
												//echo $frecuencia;
													if ($frecuencia==1) {
														if ($diferencia_dias==0) {
															$dias=1;
															$total1=$dt*$dias;
															$total2=ceil($total1/$fila_formula['unidad']);
															$cambio1=valorEnLetras($total2);
															echo'<td>

																		<article class="col-md-3">
																			<p class="col-md-12">'.$dias.' </p>
																		<article>
																	 </td>
																	 <td>
																	 <p class="col-md-12">'.$total2.' '.$cambio1.'</p>
																	 <a href="rpt_auxiliares/rpt_no_controlados.php?id='.$fila_formula["id_d_fmedhosp"].'&letra='.$cambio.'&unidad='.$total2.'" target="_blank">
																						<button type="button" class="btn btn-info  " >
																						<span class="fa fa-print"></span> Imprimir Formula
																						</button></a>
																	 </td>';
														}else {
															echo'<td>
																		<article class="col-md-3">
																			<p class="col-md-12">'.$diferencia_dias.' </p>
																		<article>
																	 </td>
																	 <td>
																	 <p class="col-md-12">'.$total_unico_dosis,' '.$cambio_unico_dosis.'</p>
																	 <a href="rpt_auxiliares/rpt_no_controlados.php?id='.$fila_formula["id_d_fmedhosp"].'&letra='.$cambio_unico_dosis.'&unidad='.$total_unico_dosis.'" target="_blank">
																						<button type="button" class="btn btn-info" >
																						<span class="fa fa-print"></span> Imprimir Formula</button></a>
																	 </td>
																	 ';
														}
													}else {
														//echo $diferencia_dias;
														if ($diferencia_dias==0) {
															$dias=1;
															$total1=$dt*$dias;
															$total2=ceil($total1/$fila_formula['unidad']);
															$cambio1=valorEnLetras($total2);
															echo'<td>
																		<article class="col-md-3">
																			<p class="col-md-12">'.$dias.' oo</p>
																		<article>
																	 </td>
																	 <td>
																	 <p class="col-md-12">'.$total2.' '.$cambio1.'</p>
																	 <a href="rpt_auxiliares/rpt_no_controlados.php?id='.$fila_formula["id_d_fmedhosp"].'&letra='.$cambio.'&unidad='.$total2.'" target="_blank">
																						<button type="button" class="btn btn-info  " >
																						<span class="fa fa-print"></span> Imprimir Formula
																						</button></a>
																	 </td>';
														}else {
															echo'<td>
																		<article class="col-md-3">
																			<p class="col-md-12">'.$diferencia_dias.' ok</p>
																		<article>
																	 </td>
																	 <td>
																	 <p class="col-md-12">'.$total.' '.$cambio.'</p>
																	 <a href="rpt_auxiliares/rpt_no_controlados.php?id='.$fila_formula["id_d_fmedhosp"].'&letra='.$cambio.'&unidad='.$total.'" target="_blank">
																						<button type="button" class="btn btn-info  " >
																						<span class="fa fa-print"></span> Imprimir Formula</button></a>
																	 </td>
																	 ';
														}
													}

										 echo'</article>
													</td>
													';
								echo'</tr>
											</table>

										 </td>';
								echo'</tr>';
              }

            }
          }
  	?>

  </table>
</section>
<section class="panel-heading">
  <h3>Medicamentos de CONTROLADOS</h3>
</section>
<section class="panel-body">
  <table class="table table-sm table-bordered">
  <tr>
    <th class="text-center success">#</th>
    <th class="text-center success">MEDICAMENTO</th>
  </tr>
    <?php
    $f1=$_REQUEST['f1'];
    $f2=$_REQUEST['f2'];
    $sede=$_REQUEST['sede'];
        $sql="SELECT f.nom_eps,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
                     b.fingreso_hosp,b.fegreso_hosp,b.id_adm_hosp,
                     g.id_producto,unidad,embalaje,
                     c.fejecucion_inicial,c.fejecucion_final,
                     d.medicamento,d.id_d_fmedhosp id,d.freg,dosis1,dosis2,dosis3,dosis4,

                     h.nom_sedes,
                     l.nombre

              FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
                               INNER JOIN eps f on (f.id_eps = b.id_eps)
                               INNER JOIN sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
                               INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
                               INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
                               LEFT JOIN m_producto g on (g.id_producto = d.cod_med and g.estado_propio = 2)

                               left join user l on (l.id_user=c.id_user)

              WHERE  c.estado_m_fmedhosp='solicitado' and g.controlado=1 and d.estado_med='Solicitado' and
              b.id_adm_hosp=$idadm  and c.tipo_formula='Ambulatoria' and b.tipo_servicio='$servicio'
              GROUP BY f.nom_eps,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
                       b.fingreso_hosp,b.fegreso_hosp,b.id_adm_hosp,d.medicamento,id,
                       g.id_producto,l.nombre
              order by 3
              ";
          //echo $sql;
          $i=1;
          if ($tabla=$bd1->sub_tuplas($sql)){

            foreach ($tabla as $fila ) {
              echo'<tr>';
              echo'<th>'.$i++.'</th>';
              $d1=$fila['dosis1'];
              $d2=$fila['dosis2'];
              $d3=$fila['dosis3'];
              $d4=$fila['dosis4'];
              $dt=$d1+$d2+$d3+$d4;
              $fecha1=$fila["fejecucion_inicial"];
              $fecha2=$fila["fejecucion_final"];
              $segundos= strtotime($fecha2) - strtotime($fecha1);
              $diferencia_dias=intval($segundos/60/60/24);
							if ($diferencia_dias==31) {
								$diferencia_dias=30;
							}else {
								$diferencia_dias=$diferencia_dias;
							}
              $t=$dt*$diferencia_dias;
              $total=ceil($t/$fila['unidad']);
              $cambio=valorEnLetras($total);
              echo'<td>
                    <article class="col-md-12">
                      <p><strong>'.$fila['medicamento'].'</strong></p>
                      <p><strong>Inicial:</strong> '.$fila['fejecucion_inicial'].'</p>
                      <p><strong>Final:</strong> '.$fila['fejecucion_final'].'</p>
                    </article>
                    <table class="table table-bordered">
                      <tr>
                        <th>Unidad en Fracción</th>
                        <th>Dias</th>
                        <th>Total en UNIDAD</th>
                      </tr>
                      <tr>
                        <td>
                        <article class="col-md-12">
                          <p>'.$dt.'</p>
                        </article>
                        </td>
                        ';
                        if ($diferencia_dias==0) {
                          $dias=1;
                          $total1=$dt*$dias;
                          $total2=ceil($total1/$fila['unidad']);
                          $cambio1=valorEnLetras($total2);
                          echo'<td>
                                <article class="col-md-3">
                                  <p class="col-md-12">'.$dias.'</p>
                                <article>
                               </td>
                               <td>
                               <p class="col-md-12">'.$total2.' '.$cambio1.'</p>
                               <a href="rpt_auxiliares/rpt_controlados.php?id='.$fila["id"].'&letra='.$cambio.'&unidad='.$total2.'" target="_blank">
                                        <button type="button" class="btn btn-info  " >
                                        <span class="fa fa-print"></span> Imprimir Formula
                                        </button></a>
                               </td>';
                        }else {
                          echo'<td>
                                <article class="col-md-3">
                                  <p class="col-md-12">'.$diferencia_dias.'</p>
                                <article>
                               </td>
                               <td>
                               <p class="col-md-12">'.$total.' '.$cambio.'</p>
                               <a href="rpt_auxiliares/rpt_controlados.php?id='.$fila["id"].'&letra='.$cambio.'&unidad='.$total.'" target="_blank">
                                        <button type="button" class="btn btn-info  " >
                                        <span class="fa fa-print"></span> Imprimir Formula</button></a>
                               </td>
                               ';
                        }
                   echo'</article>
                        </td>
                        ';
              echo'</tr>
                    </table>

                   </td>';
              echo'</tr>';
            }
          }
    ?>
  <table>
</section>
</section>
	<?php
}
?>
