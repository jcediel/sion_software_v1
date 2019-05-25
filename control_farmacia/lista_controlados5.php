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
			case 'HC':
			$tallat=$_POST["talla"] * $_POST["talla"];
			$imc=$_POST["peso"] / $tallat;
			$tam1=$_POST["tad"] * 2;
			$tam2=$tam1 + $_POST["tds"];
			$tamt=$tam2/3;
			$dxp=substr($_POST['dx'], 0,4);
			$dx1=substr($_POST['dx1'], 0,4);
			$dx2=substr($_POST['dx2'], 0,4);
			$dx3=substr($_POST['dx3'], 0,4);

			$sql="INSERT INTO hc_hospitalario (id_adm_hosp,id_user,freg_hchosp,hreg_hchosp,motivo_consulta,enfer_actual,his_personal,his_familiar,
				perso_premorbida,ant_alergicos,ant_patologico,ant_quirurgico,ant_toxicologico,ant_farmaco,ant_gineco,ant_psiquiatrico,ant_hospitalario,
				ant_traumatologico,ant_familiar,otros_ant,estado_general,tad,tas,tam,fr,fc,so,peso,talla,temperatura,imc,cabcuello,torax,ext,abdomen,
				neurologico,genitourinario,examen_mental,analisis,finalidad,causa_externa,dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,
				dx3,ddx3,tdx3,plantratamiento,tipo_atencion,especialidad,estado_hchosp) VALUES
			('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["motivoconsulta"]."',
			'".$_POST["enferactual"]."','".$_POST["hpersonal"]."','".$_POST["hfamiliar"]."','".$_POST["ppremorbida"]."','".$_POST["antalergico"]."',
			'".$_POST["antpatologico"]."','".$_POST["antquirurgico"]."','".$_POST["anttoxicologicos"]."','".$_POST["antfarmacologico"]."',
			'".$_POST["antgineco"]."','".$_POST["antpsiquiatrico"]."','".$_POST["anthospitalario"]."','".$_POST["anttrauma"]."','".$_POST["antfami"]."',
			'".$_POST["antotros"]."','".$_POST["estadogen"]."','".$_POST["tad"]."','".$_POST["tas"]."','$tamt','".$_POST["fr"]."','".$_POST["fc"]."',
			'".$_POST["sao2"]."','".$_POST["peso"]."','".$_POST["talla"]."','".$_POST["temperatura"]."','$imc','".$_POST["cabezacuello"]."',
			'".$_POST["torax"]."','".$_POST["extsup"]."','".$_POST["abdomen"]."','".$_POST["neurologico"]."','".$_POST["genitourinario"]."',
			'".$_POST["exmental"]."','".$_POST["analisis"]."','".$_POST["finconsulta"]."','".$_POST["causaexterna"]."',
			'$dxp','".$_POST["dx"]."','".$_POST["tdx"]."','$dx1','".$_POST["dx1"]."','".$_POST["tdx1"]."','$dx2',
			'".$_POST["dx2"]."','".$_POST["tdx2"]."','$dx3','".$_POST["dx3"]."','".$_POST["tdx3"]."','".$_POST["plant"]."','Hospitalario',
			'".$_SESSION["AUT"]["especialidad"]."','Realizada')";
				$sql1="UPDATE adm_hospitalario SET estado_adm_hosp='".$_POST["df_conducta"]."',fegreso_hosp='".$_POST["freg_hchosp"]."',
				hegreso_hosp='".$_POST["hreg_hchosp"]."',medsalida='".$_SESSION["AUT"]["id_user"]."'
				 WHERE id_adm_hosp='".$_POST["idadmhosp"]."'";
				$subtitulo="Historia Clinica de ingreso";
				$subtitulo1="Adicionado";
			break;
			case 'EVO':
				$sql="INSERT INTO evolucion_medica (id_adm_hosp,id_user,freg_evomed,hreg_evomed,objetivo,subjetivo,analisis_evomed,plan_tratamiento,
					remision_sintomas,conciencia_enfermedad,adherencia_terapeutica,dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,resp_evomed,estado_evomed) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["objetivo"]."',
				'".$_POST["subjetivo"]."','".$_POST["analisis"]."','".$_POST["plantratamiento"]."','".$_POST["remision_sintomas"]."',
				'".$_POST["conciencia_enfermedad"]."','".$_POST["adherencia_terapeutica"]."','".$_POST["dx"]."','".$_POST["dx"]."','".$_POST["tdx"]."',
				'".$_POST["dx1"]."','".$_POST["dx1"]."','".$_POST["tdx1"]."','".$_POST["dx2"]."','".$_POST["dx2"]."','".$_POST["tdx2"]."',
				'".$_SESSION["AUT"]["nombre"]."','Realizada')";
				$subtitulo="Evolución Medica";
				$subtitulo1="Adicionado";
			break;
			case 'ORDVER':
				$sql="INSERT INTO orden_verbal( id_adm_hosp, id_user, freg_ord_verbal, hreg_ord_verbal, orden_verbal, estado_orden_verbal) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["ordverb"]."','Realizada')";
				$subtitulo="Orden Verbal";
				$subtitulo1="Adicionada";
			break;
			case 'CLASE':
				$sql="UPDATE adm_hospitalario SET clase_dx_hosp ='".$_POST["clase"]."',
				 						 resp_clase_dx='".$_SESSION["AUT"]["id_user"]."'
				WHERE id_adm_hosp='".$_POST["id_adm_hosp"]."'";
				$subtitulo="Clasificación diagnostica";
				$subtitulo1="Adicionada";
			break;
			case 'OXI':
			$fi=$_POST['finicial'];
			$ff=$_POST['ffinal'];
			$segundos= strtotime($ff) - strtotime($fi);
			$diferencia_dias=intval($segundos/60/60/24);

				$sql="INSERT INTO oxigeno(id_adm_hosp, resp_reg, finicial, ffinal, litro,
					frecuencia, obs_oxigeno, tiempo_adm) VALUES
				('".$_POST["id_adm_hosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["finicial"]."',
				'".$_POST["ffinal"]."','".$_POST["litro"]."','".$_POST["frecuencia"]."','".$_POST["obs_oxigeno"]."',
				'".$diferencia_dias."')";
				$subtitulo="Oxigeno";
				$subtitulo1="Adicionado";
			break;
			case 'REMISION':
			$cups=substr($_POST['cups'], 0,6);
			$sql="INSERT INTO remision(id_adm_hosp, id_user,cups, descricups, justificacion, estado_remision) VALUES
				('".$_POST["id_adm_hosp"]."','".$_SESSION["AUT"]["id_user"]."','".$cups."',
				'".$_POST["cups"]."','".$_POST["justificacion"]."','Realizada')";
				$subtitulo="Referencia";
				$subtitulo1="Adicionado";
			break;
		}
		//echo $sql;
		//echo $sql1;
		if ($bd1->consulta($sql)){
			$subtitulo="El formato de $subtitulo fue $subtitulo1 con exito!";
			$check='si';
				if ($bd1->consulta($sql1)) {
					$subtitulo="$subtitulo fue $subtitulo1 con exito!";
					$check='si';
				}
		}else{
			$subtitulo="El formato de $subtitulo en $subtitulo2 NO fue $subtitulo1 !!! .";
		$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'HC':
    $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
    j.nom_eps
    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                left join eps j on (j.id_eps=b.id_eps)
    where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar HC ingreso";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$form1='formularios/hc_hospitalaria.php';
			$subtitulo='Historia Clinica de ingreso';
			break;
			case 'EVO':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Evolución Medica";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$form1='formularios/evo_medhosp.php';
			$subtitulo='Evolución Medica';
			break;
			case 'EPI':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Epicrisis";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/epicrisis.php';
			$subtitulo='Plan Trimestral Terapia Ocupacional';
			break;
			case 'ORDVER':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
									left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Orden Verbal";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/ordenverbal.php';
			$subtitulo='Orden verbal';
			break;
			case 'CLASE':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,clase_dx_hosp,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
									left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Clasificación DX";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formulariosHOSP/clasedx.php';
			$subtitulo='Clasificación DX hospitalaria';
			break;
			case 'OXI':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,clase_dx_hosp,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
									left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Solicitud oxigeno";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formulariosHOSP/add_oxigeno.php';
			$subtitulo='Solicitud de oxigeno';
			break;
			case 'REMISION':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,clase_dx_hosp,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
									left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Remision";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$form1='formulariosHOSP/add_remision.php';
			$subtitulo='Solicitud de remisión';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"",
				"dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"",
				"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id_sedes_ips"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"",
				"dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"",
				"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id_sedes_ips"=>"");
			}

		?>

		<script type="text/javascript" src="/js/jquery.js"></script>

		<div class="alert alert-info animated bounceInRight">		</div>

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
  <section class="panel-body">
  	<?php
  		include("consulta_rapida1.php");
  	?>
  </section>
	<section class="panel-heading"><h4>LISTADO DE MEDICAMENTOS CONTROLADOS INTRAHOSPITALARIOS</h4></section>
  <section class="panel-body">
    <form>
      <article class="col-xs-3">
        <label for="">Fecha inicial:</label>
        <input type="date" class="form-control" name="f1" value="">
      </article>
      <article class="col-xs-3">
        <label for="">Fecha final:</label>
        <input type="date" class="form-control" name="f2" value="">
      </article>
			<article class="col-xs-4">
        <label for="">Seleccione Sede:</label>
        <select class="form-control" name="sede">
        	<option value="2,8">Todas</option>
					<option value="2">Clínica Emmanuel Facatativá</option>
					<option value="8">Clínica Emmanuel Bogotá</option>
        </select>
      </article>
      <div class="col-xs-2">
        <input type="submit" name="buscar" class="btn btn-primary" value="Buscar">
        <input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
      </div>
    </form>
  </section>
	<section class="panel-body">
		<table class="table table-sm table-bordered">
		<tr>
			<th class="text-center success">#</th>
			<th class="text-center success">PACIENTE</th>
			<th class="text-center success">IDENTIFICACION</th>
      <th class="text-center success">SEDE</th>
			<th class="text-center success">MEDICAMENTO</th>
			<th class="text-center success">PROFESIONAL</th>
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
											 e.fadmin,nom_admin,cant_admin,hora_admin,estado_admin,resp_adm,
                       h.nom_sedes,
                       l.nombre,
											 m.nombre despachador

                FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
                                 INNER JOIN eps f on (f.id_eps = b.id_eps)
                                 INNER JOIN sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
                                 INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
                                 INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
                                 INNER JOIN m_producto g on (g.id_producto = d.cod_med)
                                 LEFT  JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
                                 left join user l on (l.id_user=c.id_user)
																 left join user m on (m.id_user=e.id_user)
                WHERE  c.estado_m_fmedhosp='solicitado' and d.freg between '$f1' and '$f2'
                                                        and g.controlado=1 and d.estado_med='Solicitado'
																												and h.id_sedes_ips in ($sede)
                GROUP BY f.nom_eps,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
												 b.fingreso_hosp,b.fegreso_hosp,b.id_adm_hosp,d.medicamento,id,
												 g.id_producto,l.nombre,m.nombre
                order by 3
			          ";
			      //echo $sql;
						$i=1;
			      if ($tabla=$bd1->sub_tuplas($sql)){

			        foreach ($tabla as $fila ) {
                echo'<tr>';
								echo'<th>'.$i++.'</th>';
                echo'<td>'.$fila['nom1'].' '.$fila['nom2'].' '.$fila['ape1'].' '.$fila['ape2'].'</td>';
                echo'<td><strong>'.$fila['tdoc_pac'].': </strong> '.$fila['doc_pac'].'</td>';
                echo'<td>'.$fila['nom_sedes'].'</td>';
                $d1=$fila['dosis1'];
                $d2=$fila['dosis2'];
                $d3=$fila['dosis3'];
                $d4=$fila['dosis4'];
                $dt=$d1+$d2+$d3+$d4;
                $fecha1=$fila["fejecucion_inicial"];
                $fecha2=$fila["fejecucion_final"];
            		$segundos= strtotime($fecha2) - strtotime($fecha1);
            		$diferencia_dias=intval($segundos/60/60/24);
								$t=$dt*$diferencia_dias;
								$total=ceil($t/$fila['unidad']);
								$cambio=valorEnLetras($total);
                echo'<td>
                      <article class="col-xs-12">
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
													<article class="col-xs-12">
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
																	<article class="col-xs-3">
																		<p class="col-xs-12">'.$dias.'</p>
																	<article>
																 </td>
																 <td>
																 <p class="col-xs-12">'.$total2.' '.$cambio1.'</p>
																 <a href="rpt_auxiliares/rpt_controlados.php?id='.$fila["id"].'&letra='.$cambio.'&unidad='.$total2.'" target="_blank">
								                          <button type="button" class="btn btn-info  " >
								                          <span class="fa fa-print"></span> Imprimir Formula
								                          </button></a>
																 </td>';
													}else {
														echo'<td>
																	<article class="col-xs-3">
																		<p class="col-xs-12">'.$diferencia_dias.'</p>
																	<article>
																 </td>
																 <td>
																 <p class="col-xs-12">'.$total.' '.$cambio.'</p>
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

                echo'<td>
											<article>
											<p><strong class="text-danger">Ordenó:</strong><br>'.$fila['nombre'].' </br> '.$fila['freg'].'</p>
											<p><strong class="text-primary">Dispensó:</strong><br>'.$fila['despachador'].' </br> '.$fila['freg_farmacia'].'</p></td>';
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
