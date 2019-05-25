<?php
	require_once("reportes_graficos/conexion/conexion.php");
?>
<head>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<style type="text/css">
	#container {
		height: 300px;
		min-width: 310px;
		max-width: 800px;
		margin: 0 auto;
	}
	#container1 {
		height: 300px;
		min-width: 310px;
		max-width: 800px;
		margin: 0 auto;
	}
	#containerDXB {
		height: 300px;
		min-width: 310px;
		max-width: 800px;
		margin: 0 auto;
	}
</style>
<script type="text/javascript">
	$(function () {
			$('#container').highcharts({
					chart: {
							type: 'column',
							margin: 95,
							options3d: {
									enabled: true,
									alpha: 10,
									beta: 25,
									depth: 70
							}
					},
					title: {
							text: 'Pacientes por EPS'
					},
					subtitle: {
							text: 'Cantidad de pacientes agrupados por EPS'
					},
					plotOptions: {
							column: {
									depth: 25
							}
					},
					xAxis: {
							categories: [
				<?php
	$sql=mysql_query("SELECT j.nom_eps,COUNT(b.id_adm_hosp) cuantos

							from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
										left join eps j on (j.id_eps=b.id_eps)
							where b.estado_adm_hosp='Activo' and b.id_sedes_ips='8'
														and b.tipo_servicio='Hospitalario' group by nom_eps");
	while($res=mysql_fetch_array($sql)){
	?>

				['<?php echo $res['nom_eps']; ?>'],
	<?php
	}
	?>
				]
					},
					yAxis: {
							title: {
									text: null
							}
					},
					series: [{
							name: 'Cantidad de pacientes',
							data: [

				<?php
	$sql=mysql_query("SELECT j.nom_eps,COUNT(b.id_adm_hosp) cuantos

							from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
										left join eps j on (j.id_eps=b.id_eps)
							where b.estado_adm_hosp='Activo' and b.id_sedes_ips='8'
														and b.tipo_servicio='Hospitalario' group by nom_eps");
	while($res=mysql_fetch_array($sql)){
	?>

				[<?php echo $res['cuantos'] ?>],

	<?php
	}
	?>
				]
					}]
			});
	});
</script>
<script type="text/javascript">
	$(function () {
			$('#container1').highcharts({
				chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Pacientes X clase DX'
        },
        subtitle: {
            text: 'Cantidad de pacientes por clasificación dx'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: 'Cantidad de pacientes',
            data: [
              <?php
        			$sql=mysql_query("SELECT COUNT(b.id_adm_hosp) cuantos,b.clase_dx_hosp
              						from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
              									left join eps j on (j.id_eps=b.id_eps)
              						where b.estado_adm_hosp='Activo' and b.id_sedes_ips='8'
              													and b.tipo_servicio='Hospitalario' group by clase_dx_hosp");
        			while($res=mysql_fetch_array($sql)){
        			?>
        ['<?php echo $res['clase_dx_hosp'].' ('.$res['cuantos']?>)', <?php echo $res['cuantos'] ?> ],
        			<?php
        			}
        			?>
            ]
        }]
    });
});
</script>
<script type="text/javascript">
	$(function () {
			$('#containerDXB').highcharts({
					chart: {
							type: 'column',
							margin: 95,
							options3d: {
									enabled: true,
									alpha: 10,
									beta: 25,
									depth: 70
							}
					},
					title: {
							text: 'Pacientes * Diagnostico'
					},
					subtitle: {
							text: 'Cantidad de pacientes agrupados por diagnostico'
					},
					plotOptions: {
							column: {
									depth: 25
							}
					},
					xAxis: {
							categories: [
				<?php
	$sql=mysql_query("SELECT COUNT(b.id_adm_hosp) cuantos,
													 c.dxp,ddxp
							from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
															 left join hc_hospitalario c on b.id_adm_hosp=c.id_adm_hosp
										left join eps j on (j.id_eps=b.id_eps)
							where b.estado_adm_hosp='Activo' and b.id_sedes_ips='8' and dxp <> ''
														and b.tipo_servicio='Hospitalario' group by dxp,ddxp");
	while($res=mysql_fetch_array($sql)){
	?>

				['<?php echo $res['ddxp']; ?>'],
	<?php
	}
	?>
				]
					},
					yAxis: {
							title: {
									text: null
							}
					},
					series: [{
							name: 'Cantidad de pacientes',
							data: [

				<?php
	$sql=mysql_query("SELECT COUNT(b.id_adm_hosp) cuantos,
													 c.dxp
							from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
															 left join hc_hospitalario c on b.id_adm_hosp=c.id_adm_hosp
										left join eps j on (j.id_eps=b.id_eps)
							where b.estado_adm_hosp='Activo' and b.id_sedes_ips='8' and dxp <> ''
														and b.tipo_servicio='Hospitalario' group by dxp");
	while($res=mysql_fetch_array($sql)){
	?>

				[<?php echo $res['cuantos'] ?>],

	<?php
	}
	?>
				]
					}]
			});
	});
</script>

<style type="text/css">
	#container2 {
		height: 300px;
		min-width: 310px;
		max-width: 800px;
		margin: 0 auto;
	}
	#container3 {
		height: 300px;
		min-width: 310px;
		max-width: 800px;
		margin: 0 auto;
	}
	#containerDXF {
		height: 500px;
		min-width: 310px;
		max-width: 800px;
		margin: 0 auto;
	}
</style>
<script type="text/javascript">
	$(function () {
			$('#container2').highcharts({
					chart: {
							type: 'column',
							margin: 95,
							options3d: {
									enabled: true,
									alpha: 10,
									beta: 25,
									depth: 70
							}
					},
					title: {
							text: 'Pacientes por EPS'
					},
					subtitle: {
							text: 'Cantidad de pacientes agrupados por EPS'
					},
					plotOptions: {
							column: {
									depth: 25
							}
					},
					xAxis: {
							categories: [
				<?php
	$sql=mysql_query("SELECT j.nom_eps,COUNT(b.id_adm_hosp) cuantos

							from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
										left join eps j on (j.id_eps=b.id_eps)
							where b.estado_adm_hosp='Activo' and b.id_sedes_ips='2'
														and b.tipo_servicio='Hospitalario' group by nom_eps");
	while($res=mysql_fetch_array($sql)){
	?>

				['<?php echo $res['nom_eps']; ?>'],
	<?php
	}
	?>
				]
					},
					yAxis: {
							title: {
									text: null
							}
					},
					series: [{
							name: 'Cantidad de pacientes',
							data: [

				<?php
	$sql=mysql_query("SELECT j.nom_eps,COUNT(b.id_adm_hosp) cuantos

							from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
										left join eps j on (j.id_eps=b.id_eps)
							where b.estado_adm_hosp='Activo' and b.id_sedes_ips='2'
														and b.tipo_servicio='Hospitalario' group by nom_eps");
	while($res=mysql_fetch_array($sql)){
	?>

				[<?php echo $res['cuantos'] ?>],

	<?php
	}
	?>
				]
					}]
			});
	});
</script>
<script type="text/javascript">
	$(function () {
			$('#container3').highcharts({
				chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Pacientes X clase DX'
        },
        subtitle: {
            text: 'Cantidad de pacientes por clasificación dx'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: 'Cantidad de pacientes',
            data: [
              <?php
        			$sql=mysql_query("SELECT COUNT(b.id_adm_hosp) cuantos,b.clase_dx_hosp
              						from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
              									left join eps j on (j.id_eps=b.id_eps)
              						where b.estado_adm_hosp='Activo' and b.id_sedes_ips='2'
              													and b.tipo_servicio='Hospitalario' group by clase_dx_hosp");
        			while($res=mysql_fetch_array($sql)){
        			?>
        ['<?php echo $res['clase_dx_hosp'].' ('.$res['cuantos']?>)', <?php echo $res['cuantos'] ?> ],
        			<?php
        			}
        			?>
            ]
        }]
    });
});
</script>
<script type="text/javascript">
	$(function () {
			$('#containerDXF').highcharts({
					chart: {
							type: 'column',
							margin: 95,
							options3d: {
									enabled: true,
									alpha: 10,
									beta: 25,
									depth: 70
							}
					},
					title: {
							text: 'Pacientes * Diagnostico'
					},
					subtitle: {
							text: 'Cantidad de pacientes agrupados por diagnostico'
					},
					plotOptions: {
							column: {
									depth: 25
							}
					},
					xAxis: {
							categories: [
				<?php
	$sql=mysql_query("SELECT COUNT(b.id_adm_hosp) cuantos,
													 c.dxp,ddxp
							from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
															 left join hc_hospitalario c on b.id_adm_hosp=c.id_adm_hosp
										left join eps j on (j.id_eps=b.id_eps)
							where b.estado_adm_hosp='Activo' and b.id_sedes_ips='2' and dxp <> ''
														and b.tipo_servicio='Hospitalario' group by dxp,ddxp");
	while($res=mysql_fetch_array($sql)){
	?>

				['<?php echo $res['ddxp']; ?>'],
	<?php
	}
	?>
				]
					},
					yAxis: {
							title: {
									text: null
							}
					},
					series: [{
							name: 'Cantidad de pacientes',
							data: [

				<?php
	$sql=mysql_query("SELECT COUNT(b.id_adm_hosp) cuantos,
													 c.dxp
							from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
															 left join hc_hospitalario c on b.id_adm_hosp=c.id_adm_hosp
										left join eps j on (j.id_eps=b.id_eps)
							where b.estado_adm_hosp='Activo' and b.id_sedes_ips='2' and dxp <> '' and ddxp <> ''
														and b.tipo_servicio='Hospitalario' group by dxp");
	while($res=mysql_fetch_array($sql)){
	?>

				[<?php echo $res['cuantos'] ?>],

	<?php
	}
	?>
				]
					}]
			});
	});
</script>
</head>


  <ul class="nav navbar-nav " id="barra">
    <li class="dropdown">
      <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Censo Clinicas <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a  data-toggle="modal" data-target="#censobta" type="button" ><span class="fa fa-search"> Censo Diario Bogota</span></a></li>
        <li><a  data-toggle="modal" data-target="#censofaca" type="button" ><span class="fa fa-search"> Censo Diario Facatativa</span></a></li>
      </ul>
    </li>
  </ul>
  <ul class="nav navbar-nav " id="barra">
    <li class="dropdown">
      <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Censo Hospital dia <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a  data-toggle="modal" data-target="#censohd" type="button" ><span class="fa fa-search"> Censo Diario Hospital dia</span></a></li>
      </ul>
    </li>
  </ul>
	<ul class="nav navbar-nav " id="barra">
    <li class="dropdown">
      <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Listados especiales <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a  data-toggle="modal" data-target="#listNEPSfaca" type="button" ><span class="fa fa-search"> Institucionalizados Nueva EPS (Facatativá)</span></a></li>
				<li><a  data-toggle="modal" data-target="#listNEPSbta" type="button" ><span class="fa fa-search"> Institucionalizados Nueva EPS (Bogotá)</span></a></li>
				<li><a  data-toggle="modal" data-target="#listdietafaca" type="button" ><span class="fa fa-search"> Dietas (Facatativá)</span></a></li>
				<li><a  data-toggle="modal" data-target="#listdietabta" type="button" ><span class="fa fa-search"> Dietas (Bogotá)</span></a></li>
      </ul>
    </li>
  </ul>
	<ul class="nav navbar-nav " id="barra">
    <li class="dropdown">
      <button class="btn btn-success dropdown-toggle margen1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Pendientes <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a  data-toggle="modal" data-target="#pendientebta" type="button" ><span class="fa fa-search">Pendientes Bogotá </span></a></li>
        <li><a  data-toggle="modal" data-target="#pendientefaca" type="button" ><span class="fa fa-search">Pendientes Facatativa</span></a></li>
      </ul>
    </li>
  </ul>
	<!--pENDIENTES BOGOTA-->
	<section >
      <section>
        <section class="modal fade" id="pendientebta" role="dialog">
          <section class="modal-dialog modal-lg" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title alert alert-success" >Pendientes Clinica Bogota</h3>
              </div>
              <div class="modal-body">

                  <table class="table table-bordered" >
										<?php
										$fecha = date('Y-m-j');
										$nuevafecha = strtotime ( '-24 hour' , strtotime ( $fecha ) ) ;
										$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
										 ?>
										<tr>
	                    <td class="text-center"><strong>PACIENTE</strong></td>
	                    <td class="text-center"><strong>CLASE DX</strong></td>
											<td class="text-center"><strong>MEDICO TRATANTE</strong></td>
											<td class="text-center"><strong>HOY <?php echo $nuevafecha ?> <br> falta evolución?</strong></td>
	                  </tr>
                  <?php
                  $sql="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac,a.tdoc_pac,a.edad,a.genero,
															 concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,j.nom_piso piso,b.estado_salida,
																	i.nom_pabellon pabellon,concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,'-',g.nom_cama) habi,l.nom_eps,b.fingreso_hosp,
																	DATEDIFF(CURDATE(),b.fingreso_hosp) as estancia,b.clase_dx_hosp,b.id_adm_hosp id,m.dxp,b.tratante_hosp
												FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)

                            left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                            left join cama g on (g.id_cama = f.id_cama )
                            left join habitacion h on (h.id_habitacion = g.id_habitacion )
                            left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                            left join piso j on (j.id_piso = i.id_piso )
                            left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )
                            left join eps l on (l.id_eps=b.id_eps)
                            left join hc_hospitalario m on (m.id_adm_hosp=b.id_adm_hosp)
												WHERE b.id_sedes_ips in ('8') and b.estado_adm_hosp='Activo' and b.tipo_servicio='Hospitalario' order by 2,10";
                    //echo $sql;
                  if ($tabla=$bd1->sub_tuplas($sql)){
                    foreach ($tabla as $fila ) {
                      $fecha=$fila["fingreso_hosp"];
                      $segundos= strtotime('now') - strtotime($fecha);
                      $diferencia_dias=intval($segundos/60/60/24);
											echo"<tr >\n";
											echo'<td class="text-left success">
														<p>'.$fila["paciente"].'</p>
														<p><strong><span class="fa fa-user-md"></span> '.$fila["tdoc_pac"].' : '.$fila["doc_pac"].' </strong></p>
														<p><strong>Edad: </strong>'.$fila["edad"].' Años</p>
														<p><strong>Genero: </strong>'.$fila["genero"].'</p>
														<p><strong>Ubicación </strong>'.$fila["habi"].'</p>
														<p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>
														<p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
														<p><strong>Estancia: </strong>'.$fila["estancia"].'</p>
														<p class="alert alert-danger"><strong>'.$fila["estado_salida"].'</strong></p>';

														$perf=$_SESSION['AUT']['id_perfil'];
														if ($perf==10 || $perf==78 || $perf==80 || $perf==81) {

														}else {
															echo'<p class="btn-xs"><a href="'.PROGRAMA.'?doc='.$fila["doc_pac"].'&buscar=Consultar&opcion='.$_REQUEST["opcion"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-eye"></span> VER </button></a></p>';
														}
											echo'</td>';

											if ($fila['clase_dx_hosp']=='') {
												echo'<td class="text-left alert alert-danger ">
															<p>SIN clasificación DX<p>
															<p><a href="'.PROGRAMA.'?opcion=19&mante=CLASE&idadmhosp='.$fila["id"].'"><button type="button" class="btn btn-success " ><span class="fa fa-warning"></span> Desea Clasificarlo?</button></a></p>
														 </td>';
											}else {
												echo'<td class="text-left ">'.$fila["clase_dx_hosp"].'</td>';
											}
											if ($fila['tratante_hosp']=='') {
												echo'<td class="text-left alert alert-danger ">
												<p>SIN medico tratante<p>
												<p><a href="'.PROGRAMA.'?opcion=19&mante=MTRATANTE&idadmhosp='.$fila["id"].'"><button type="button" class="btn btn-success " ><span class="fa fa-warning"></span> Desea Asignarlo?</button></a></p>
														 </td>';
											}else {
												echo'<td class="text-left ">'.$fila["tratante_hosp"].'</td>';
											}
											echo'<td class="text-left ">';
											$idadm=$fila['id'];
											$fecha = date('Y-m-j');
											$nuevafecha = strtotime ( '-24 hour' , strtotime ( $fecha ) ) ;
											$d = date ( 'Y-m-j' , $nuevafecha );
											$perfil=$_SESSION['AUT']['id_perfil'];
											if ($perfil==3 || $perfil==4) {
												$sql_evol="SELECT a.id_evomed,b.nombre FROM evolucion_medica a INNER JOIN user b on a.id_user=b.id_user

																	WHERE id_adm_hosp=$idadm and freg_evomed='$d' and b.id_perfil=$perfil";
																	//echo $sql_evol;
												if ($tablae=$bd1->sub_tuplas($sql_evol)){
													foreach ($tablae as $filae ) {
														echo'<p class="alert alert-success animated flash text-center"> NO <br>'.$filae['id_evomed'].' - '.$filae['nombre'].'</p>';
													}
												}else {
													echo'<p class="alert alert-danger animated flash text-center"> SI hace falta Registro</p>';
												}
											}
											if ($perfil==5 || $perfil==6) {
												$sql_evol="SELECT a.id_notaenfermeria,b.nombre FROM nota_enfermeria a INNER JOIN user b on a.id_user=b.id_user

																	WHERE id_adm_hosp=$idadm and freg_nota='$d' and b.id_perfil=$perfil";
																	//echo $sql_evol;
												if ($tablae=$bd1->sub_tuplas($sql_evol)){
													foreach ($tablae as $filae ) {
														echo'<p class="alert alert-success animated flash text-center"> NO <br>'.$filae['id_notaenfermeria'].' - '.$filae['nombre'].'</p>';
													}
												}else {
													echo'<p class="alert alert-danger animated flash text-center"> SI hace falta Registro</p>';
												}
											}
											if ($perfil==8) {
												$sql_evol="SELECT a.id_evoto,b.nombre FROM evo_to a INNER JOIN user b on a.id_user=b.id_user

																	WHERE id_adm_hosp=$idadm and freg_evoto='$d' and b.id_perfil=$perfil";
																	//echo $sql_evol;
												if ($tablae=$bd1->sub_tuplas($sql_evol)){
													foreach ($tablae as $filae ) {
														echo'<p class="alert alert-success animated flash text-center"> NO <br>'.$filae['id_evoto'].' - '.$filae['nombre'].'</p>';
													}
												}else {
													echo'<p class="alert alert-danger animated flash text-center"> SI hace falta Registro</p>';
												}
											}
											if ($perfil==9) {
												$sql_evol="SELECT a.id_evo_psico,b.nombre FROM evo_psicologia a INNER JOIN user b on a.id_user=b.id_user

																	WHERE id_adm_hosp=$idadm and freg_evo_psico='$d' and b.id_perfil=$perfil";
																	//echo $sql_evol;
												if ($tablae=$bd1->sub_tuplas($sql_evol)){
													foreach ($tablae as $filae ) {
														echo'<p class="alert alert-success animated flash text-center"> NO <br>'.$filae['id_evo_psico'].' - '.$filae['nombre'].'</p>';
													}
												}else {
													echo'<p class="alert alert-danger animated flash text-center"> SI hace falta Registro</p>';
												}
											}
											echo'</td>';
                      echo '</tr>';
                    }
                  }
                  ?>
                </table>
              </div>
            </div>
          </section>
        </section>
      </section>
  </section>
	<!--pENDIENTES facatativa-->
	<section >
			<section>
				<section class="modal fade" id="pendientefaca" role="dialog">
					<section class="modal-dialog modal-lg" >
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h3 class="modal-title alert alert-success" >Pendientes Clinica Facatativa</h3>
							</div>
							<div class="modal-body">

									<table class="table table-bordered" >
										<?php
										$fecha = date('Y-m-j');
										$nuevafecha = strtotime ( '-24 hour' , strtotime ( $fecha ) ) ;
										$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
										 ?>
										<tr>
											<td class="text-center"><strong>PACIENTE</strong></td>
											<td class="text-center"><strong>CLASE DX</strong></td>
											<td class="text-center"><strong>MEDICO TRATANTE</strong></td>
											<td class="text-center"><strong>HOY <?php echo $nuevafecha ?> <br> falta evolución?</strong></td>
										</tr>
									<?php
									$sql="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac,a.tdoc_pac,a.edad,a.genero,
															 concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,j.nom_piso piso,b.estado_salida,
																	i.nom_pabellon pabellon,concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,'-',g.nom_cama) habi,l.nom_eps,b.fingreso_hosp,
																	DATEDIFF(CURDATE(),b.fingreso_hosp) as estancia,b.clase_dx_hosp,b.id_adm_hosp id,m.dxp,b.tratante_hosp
												FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)

														left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
														left join cama g on (g.id_cama = f.id_cama )
														left join habitacion h on (h.id_habitacion = g.id_habitacion )
														left join pabellon i on ( i.id_pabellon = h.id_pabellon )
														left join piso j on (j.id_piso = i.id_piso )
														left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )
														left join eps l on (l.id_eps=b.id_eps)
														left join hc_hospitalario m on (m.id_adm_hosp=b.id_adm_hosp)
												WHERE b.id_sedes_ips in ('2') and b.estado_adm_hosp='Activo' and b.tipo_servicio='Hospitalario' order by 2,10";
										//echo $sql;
									if ($tabla=$bd1->sub_tuplas($sql)){
										foreach ($tabla as $fila ) {
											$fecha=$fila["fingreso_hosp"];
											$segundos= strtotime('now') - strtotime($fecha);
											$diferencia_dias=intval($segundos/60/60/24);
											echo"<tr >\n";
											echo'<td class="text-left success">
														<p>'.$fila["paciente"].'</p>
														<p><strong><span class="fa fa-user-md"></span> '.$fila["tdoc_pac"].' : '.$fila["doc_pac"].' </strong></p>
														<p><strong>Edad: </strong>'.$fila["edad"].' Años</p>
														<p><strong>Genero: </strong>'.$fila["genero"].'</p>
														<p><strong>Ubicación </strong>'.$fila["habi"].'</p>
														<p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>
														<p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
														<p><strong>Estancia: </strong>'.$fila["estancia"].'</p>
														<p class="alert alert-danger"><strong>'.$fila["estado_salida"].'</strong></p>';

														$perf=$_SESSION['AUT']['id_perfil'];
														if ($perf==10 || $perf==78 || $perf==80 || $perf==81) {

														}else {
															echo'<p class="btn-xs"><a href="'.PROGRAMA.'?doc='.$fila["doc_pac"].'&buscar=Consultar&opcion='.$_REQUEST["opcion"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-eye"></span> VER </button></a></p>';
														}
											echo'</td>';

											if ($fila['clase_dx_hosp']=='') {
												echo'<td class="text-left alert alert-danger ">
															<p>SIN clasificación DX<p>
															<p><a href="'.PROGRAMA.'?opcion=19&mante=CLASE&idadmhosp='.$fila["id"].'"><button type="button" class="btn btn-success " ><span class="fa fa-warning"></span> Desea Clasificarlo?</button></a></p>
														 </td>';
											}else {
												echo'<td class="text-left ">'.$fila["clase_dx_hosp"].'</td>';
											}
											if ($fila['tratante_hosp']=='') {
												echo'<td class="text-left alert alert-danger ">
												<p>SIN medico tratante<p>
												<p><a href="'.PROGRAMA.'?opcion=19&mante=MTRATANTE&idadmhosp='.$fila["id"].'"><button type="button" class="btn btn-success " ><span class="fa fa-warning"></span> Desea Asignarlo?</button></a></p>
														 </td>';
											}else {
												echo'<td class="text-left ">'.$fila["tratante_hosp"].'</td>';
											}
											echo'<td class="text-left ">';
											$idadm=$fila['id'];
											$fecha = date('Y-m-j');
											$nuevafecha = strtotime ( '-24 hour' , strtotime ( $fecha ) ) ;
											$d = date ( 'Y-m-j' , $nuevafecha );
											$perfil=$_SESSION['AUT']['id_perfil'];
											if ($perfil==3 || $perfil==4) {
												$sql_evol="SELECT a.id_evomed,b.nombre FROM evolucion_medica a INNER JOIN user b on a.id_user=b.id_user

																	WHERE id_adm_hosp=$idadm and freg_evomed='$d' and b.id_perfil=$perfil";
																	//echo $sql_evol;
												if ($tablae=$bd1->sub_tuplas($sql_evol)){
													foreach ($tablae as $filae ) {
														echo'<p class="alert alert-success animated flash text-center"> NO <br>'.$filae['id_evomed'].' - '.$filae['nombre'].'</p>';
													}
												}else {
													echo'<p class="alert alert-danger animated flash text-center"> SI hace falta Registro</p>';
												}
											}
											if ($perfil==5 || $perfil==6) {
												$sql_evol="SELECT a.id_notaenfermeria,b.nombre FROM nota_enfermeria a INNER JOIN user b on a.id_user=b.id_user

																	WHERE id_adm_hosp=$idadm and freg_nota='$d' and b.id_perfil=$perfil";
																	//echo $sql_evol;
												if ($tablae=$bd1->sub_tuplas($sql_evol)){
													foreach ($tablae as $filae ) {
														echo'<p class="alert alert-success animated flash text-center"> NO <br>'.$filae['id_notaenfermeria'].' - '.$filae['nombre'].'</p>';
													}
												}else {
													echo'<p class="alert alert-danger animated flash text-center"> SI hace falta Registro</p>';
												}
											}
											if ($perfil==8) {
												$sql_evol="SELECT a.id_evoto,b.nombre FROM evo_to a INNER JOIN user b on a.id_user=b.id_user

																	WHERE id_adm_hosp=$idadm and freg_evoto='$d' and b.id_perfil=$perfil";
																	//echo $sql_evol;
												if ($tablae=$bd1->sub_tuplas($sql_evol)){
													foreach ($tablae as $filae ) {
														echo'<p class="alert alert-success animated flash text-center"> NO <br>'.$filae['id_evoto'].' - '.$filae['nombre'].'</p>';
													}
												}else {
													echo'<p class="alert alert-danger animated flash text-center"> SI hace falta Registro</p>';
												}
											}
											if ($perfil==9) {
												$sql_evol="SELECT a.id_evo_psico,b.nombre FROM evo_psicologia a INNER JOIN user b on a.id_user=b.id_user

																	WHERE id_adm_hosp=$idadm and freg_evo_psico='$d' and b.id_perfil=$perfil";
																	//echo $sql_evol;
												if ($tablae=$bd1->sub_tuplas($sql_evol)){
													foreach ($tablae as $filae ) {
														echo'<p class="alert alert-success animated flash text-center"> NO <br>'.$filae['id_evo_psico'].' - '.$filae['nombre'].'</p>';
													}
												}else {
													echo'<p class="alert alert-danger animated flash text-center"> SI hace falta Registro</p>';
												}
											}
											echo'</td>';
											echo '</tr>';
										}
									}
									?>
								</table>
							</div>
						</div>
					</section>
				</section>
			</section>
	</section>
<!--CenSO BOGOTA-->
  <section >
      <section>
        <section class="modal fade" id="censobta" role="dialog">
          <section class="modal-dialog modal-lg" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title alert alert-success" >Censo Diario Clinica Bogota</h3>
              </div>
              <div class="modal-body">
                <table class="table table-bordered table-responsive col-xs-12">
                  <tr>
                    <td colspan="6">
											<div id="container" style="height: 300px"></div>
                    </td>
										<td colspan="6">
											<div id="container1" style="height: 300px"></div>
                    </td>
                  </tr>
									<tr>
										<td colspan="12">
											<div id="containerDXB" style="height: 300px"></div>
                    </td>
									</tr>
                  <tr class="alert alert-info animated ZoomIn ">
                    <th colspan="4"  class="text-center">Total Pacientes Clinica Bogotá:</th>
                    <th colspan="4" class="text-center">
                      <?php
                      $sql="SELECT COUNT(b.id_adm_hosp) cuantos

              						from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
              									left join eps j on (j.id_eps=b.id_eps)
              						where b.estado_adm_hosp='Activo' and b.id_sedes_ips='8'
              													and b.tipo_servicio='Hospitalario'";
                        //echo $sql;
                      if ($tabla=$bd1->sub_tuplas($sql)){

                        //echo $sql;
                        foreach ($tabla as $fila ) {
                          echo $fila["cuantos"];
                        }
                      }
                      ?>
                    </th>
                  </tr>
									<tr class="alert alert-success animated ZoomIn ">
                    <th colspan="4"  class="text-center">Consolidados Clinica Facatativá:</th>
                    <th colspan="4" class="text-center">
                      <?php
                      $sql="SELECT COUNT(b.id_adm_hosp) cuantos

              						from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
              									left join eps j on (j.id_eps=b.id_eps)
              						where b.estado_adm_hosp='Activo' and b.id_sedes_ips='2'
              													and b.tipo_servicio='Hospitalario'";
                        //echo $sql;
                      if ($tabla=$bd1->sub_tuplas($sql)){

                        //echo $sql;
                        foreach ($tabla as $fila ) {
                          echo $fila["cuantos"];
                        }
                      }
                      ?>
                    </th>
                  </tr>
                  <tr class="alert alert-warning animated ZoomIn ">
                    <th colspan="4"  class="text-center">Consolidado pacientes Clínicas:</th>
                    <th colspan="4" class="text-center">
                      <?php
                      $sql="SELECT COUNT(b.id_adm_hosp) cuantos

              						from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
              									left join eps j on (j.id_eps=b.id_eps)
              						where b.estado_adm_hosp='Activo' and b.id_sedes_ips in ('8','2')
              													and b.tipo_servicio='Hospitalario'";
                        //echo $sql;
                      if ($tabla=$bd1->sub_tuplas($sql)){

                        //echo $sql;
                        foreach ($tabla as $fila ) {
                          echo $fila["cuantos"];
                        }
                      }
                      ?>
                    </th>
                  </tr>
                  </table>
                  <div class="text-center">
                    <button data-toggle="collapse" class="btn btn-primary" data-target="#demo">Ver Detallado de pacientes sede Bogotá<span class="glyphicon glyphicon-arrow-down"></span> </button>
                  </div>
                  <section id="demo" class="collapse">
                    <br>
                  <table class="table table-bordered" >
										<tr>
											<td>
												<?php
												echo'<a href="rptexcel/SM/censoBogota.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
												<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>';
												 ?>
											</td>
											<td>
												<a href="rpt_auxiliares/rpt_censob.php?sede=8"><button type="button" class="btn btn-danger" ><span class="fa fa-print"></span> Imprimir censo</button></a>
											</td>
										</tr>
										<tr>
	                    <td class="text-center"><strong>PACIENTE</strong></td>
	                    <td class="text-center"><strong>UBICACION</strong></td>
											<td class="text-center"><strong>INGRESO</strong></td>
	                    <td class="text-center"><strong>DX</strong></td>
											<td class="text-center"><strong>HOY <?php echo date('Y-m-d') ?> <br> falta evolución?</strong></td>
	                  </tr>
                  <?php
                  $sql="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac,a.tdoc_pac,a.edad,a.genero,
															 concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,j.nom_piso piso,b.estado_salida,
																	i.nom_pabellon pabellon,concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,'-',g.nom_cama) habi,l.nom_eps,b.fingreso_hosp,
																	DATEDIFF(CURDATE(),b.fingreso_hosp) as estancia,b.clase_dx_hosp,b.id_adm_hosp id,m.dxp
												FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)

                            left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                            left join cama g on (g.id_cama = f.id_cama )
                            left join habitacion h on (h.id_habitacion = g.id_habitacion )
                            left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                            left join piso j on (j.id_piso = i.id_piso )
                            left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )
                            left join eps l on (l.id_eps=b.id_eps)
                            left join hc_hospitalario m on (m.id_adm_hosp=b.id_adm_hosp)
												WHERE b.id_sedes_ips in ('8') and b.estado_adm_hosp='Activo' and b.tipo_servicio='Hospitalario' order by 2,10";
                    //echo $sql;
                  if ($tabla=$bd1->sub_tuplas($sql)){
                    foreach ($tabla as $fila ) {
                      $fecha=$fila["fingreso_hosp"];
                      $segundos= strtotime('now') - strtotime($fecha);
                      $diferencia_dias=intval($segundos/60/60/24);
											echo"<tr >\n";
											echo'<td class="text-left success">
														<p>'.$fila["paciente"].'</p>
														<p><strong><span class="fa fa-user-md"></span> '.$fila["tdoc_pac"].' : '.$fila["doc_pac"].' </strong></p>
														<p><strong>Edad: </strong>'.$fila["edad"].' Años</p>
														<p><strong>Genero: </strong>'.$fila["genero"].'</p>';
														$perf=$_SESSION['AUT']['id_perfil'];
														if ($perf==10 || $perf==78 || $perf==80 || $perf==81) {

														}else {
															echo'<p class="btn-xs"><a href="'.PROGRAMA.'?doc='.$fila["doc_pac"].'&buscar=Consultar&opcion='.$_REQUEST["opcion"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-eye"></span> VER </button></a></p>';
														}
											echo'</td>';
											echo'<td class="text-left ">
														<p><strong>'.$fila["habi"].'</strong></p>
														<p class="alert alert-danger"><strong>'.$fila["estado_salida"].'</strong></p>
													 </td>';
                      echo'<td class="text-left ">
														<p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>
														<p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
														<p><strong>Estancia: </strong>'.$fila["estancia"].'</p>
													 </td>';
											if ($fila['clase_dx_hosp']=='') {
												echo'<td class="text-left alert alert-danger ">SIN clasificación DX</td>';
											}else {
												echo'<td class="text-left ">'.$fila["clase_dx_hosp"].'</td>';
											}

											echo'<td class="text-left ">';
											$idadm=$fila['id'];
											$d=date('Y-m-d');
											$perfil=$_SESSION['AUT']['id_perfil'];
											if ($perfil==3 || $perfil==4) {
												$sql_evol="SELECT a.id_evomed,b.nombre FROM evolucion_medica a INNER JOIN user b on a.id_user=b.id_user

																	WHERE id_adm_hosp=$idadm and freg_evomed='$d' and b.id_perfil=$perfil";
																	//echo $sql_evol;
												if ($tablae=$bd1->sub_tuplas($sql_evol)){
													foreach ($tablae as $filae ) {
														echo'<p class="alert alert-success animated flash text-center"> NO <br>'.$filae['id_evomed'].' - '.$filae['nombre'].'</p>';
													}
												}else {
													echo'<p class="alert alert-danger animated flash text-center"> SI hace falta Registro</p>';
												}
											}
											if ($perfil==5 || $perfil==6) {
												$sql_evol="SELECT a.id_notaenfermeria,b.nombre FROM nota_enfermeria a INNER JOIN user b on a.id_user=b.id_user

																	WHERE id_adm_hosp=$idadm and freg_nota='$d' and b.id_perfil=$perfil";
																	//echo $sql_evol;
												if ($tablae=$bd1->sub_tuplas($sql_evol)){
													foreach ($tablae as $filae ) {
														echo'<p class="alert alert-success animated flash text-center"> NO <br>'.$filae['id_notaenfermeria'].' - '.$filae['nombre'].'</p>';
													}
												}else {
													echo'<p class="alert alert-danger animated flash text-center"> SI hace falta Registro</p>';
												}
											}
											if ($perfil==8) {
												$sql_evol="SELECT a.id_evoto,b.nombre FROM evo_to a INNER JOIN user b on a.id_user=b.id_user

																	WHERE id_adm_hosp=$idadm and freg_evoto='$d' and b.id_perfil=$perfil";
																	//echo $sql_evol;
												if ($tablae=$bd1->sub_tuplas($sql_evol)){
													foreach ($tablae as $filae ) {
														echo'<p class="alert alert-success animated flash text-center"> NO <br>'.$filae['id_evoto'].' - '.$filae['nombre'].'</p>';
													}
												}else {
													echo'<p class="alert alert-danger animated flash text-center"> SI hace falta Registro</p>';
												}
											}
											if ($perfil==9) {
												$sql_evol="SELECT a.id_evo_psico,b.nombre FROM evo_psicologia a INNER JOIN user b on a.id_user=b.id_user

																	WHERE id_adm_hosp=$idadm and freg_evo_psico='$d' and b.id_perfil=$perfil";
																	//echo $sql_evol;
												if ($tablae=$bd1->sub_tuplas($sql_evol)){
													foreach ($tablae as $filae ) {
														echo'<p class="alert alert-success animated flash text-center"> NO <br>'.$filae['id_evo_psico'].' - '.$filae['nombre'].'</p>';
													}
												}else {
													echo'<p class="alert alert-danger animated flash text-center"> SI hace falta Registro</p>';
												}
											}
											echo'</td>';
                      echo '</tr>';
                    }
                  }
                  ?>
                </table>
              </section>
              </div>
            </div>
          </section>
        </section>
      </section>
  </section>


  <section >   <!--  search for clinica de facatativa in down-->
      <section>
        <section class="modal fade" id="censofaca" role="dialog">
          <section class="modal-dialog modal-lg" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title alert alert-success" >Censo Diario Clinica Facatativa</h3>
              </div>
              <div class="modal-body">
                <table class="table table-bordered table-responsive">
                  <tr>
											<td colspan="4">
												<div id="container2" style="height: 300px"></div>
											</td>
											<td colspan="4">
												<div id="container3" style="height: 300px"></div>
											</td>
                  </tr>
									<tr>
										<td colspan="12">
											<div id="containerDXF" style="height: 300px"></div>
                    </td>
									</tr>
                  <tr class="alert alert-info animated ZoomIn ">
                    <th colspan="4"  class="text-center">Total Pacientes Clínica Facatativá:</th>
                    <th colspan="4" class="text-center">
                      <?php
                      $sql="SELECT COUNT(b.id_adm_hosp) cuantos

              						from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
              									left join eps j on (j.id_eps=b.id_eps)
              						where b.estado_adm_hosp='Activo' and b.id_sedes_ips='2'
              													and b.tipo_servicio='Hospitalario'";
                        //echo $sql;
                      if ($tabla=$bd1->sub_tuplas($sql)){

                        //echo $sql;
                        foreach ($tabla as $fila ) {
                          echo $fila["cuantos"];
                        }
                      }
                      ?>
                    </th>
                  </tr>
									<tr class="alert alert-info animated ZoomIn ">
                    <th colspan="4"  class="text-center">Consolidado Clinica Bogotá:</th>
                    <th colspan="4" class="text-center">
                      <?php
                      $sql="SELECT COUNT(b.id_adm_hosp) cuantos

              						from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
              									left join eps j on (j.id_eps=b.id_eps)
              						where b.estado_adm_hosp='Activo' and b.id_sedes_ips='8'
              													and b.tipo_servicio='Hospitalario'";
                        //echo $sql;
                      if ($tabla=$bd1->sub_tuplas($sql)){

                        //echo $sql;
                        foreach ($tabla as $fila ) {
                          echo $fila["cuantos"];
                        }
                      }
                      ?>
                    </th>
                  </tr>
                  <tr class="alert alert-warning animated ZoomIn ">
                    <th colspan="4"  class="text-center">Consolidado pacientes Clínicas:</th>
                    <th colspan="4" class="text-center">
                      <?php
                      $sql="SELECT COUNT(b.id_adm_hosp) cuantos

              						from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
              									left join eps j on (j.id_eps=b.id_eps)
              						where b.estado_adm_hosp='Activo' and b.id_sedes_ips in ('8','2')
              													and b.tipo_servicio='Hospitalario'";
                        //echo $sql;
                      if ($tabla=$bd1->sub_tuplas($sql)){

                        //echo $sql;
                        foreach ($tabla as $fila ) {
                          echo $fila["cuantos"];
                        }
                      }
                      ?>
                    </th>
                  </tr>
                </table>
                <div class="text-center">
                  <button data-toggle="collapse" class="btn btn-primary" data-target="#demo1">Ver Detallado de pacientes sede Facatativá<span class="glyphicon glyphicon-arrow-down"></span> </button>
                </div>
                <section id="demo1" class="collapse">
                  <br>
                <table class="table table-bordered">
									<tr>
										<td>
											<?php
											echo'<a href="rptexcel/SM/censoFaca.php?f1='.$_REQUEST["fecha1"].'&f2='.$_REQUEST["fecha2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
											<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>';
											 ?>
										</td>
										<td>
											<a href="rpt_auxiliares/rpt_censof.php?sede=2"><button type="button" class="btn btn-danger" ><span class="fa fa-print"></span> Imprimir censo</button></a>
										</td>
									</tr>
									<tr>
										<td class="text-center"><strong>PACIENTE</strong></td>
										<td class="text-center"><strong>UBICACION</strong></td>
										<td class="text-center"><strong>INGRESO</strong></td>
										<td class="text-center"><strong>DX</strong></td>
										<td class="text-center"><strong>HOY <?php echo date('Y-m-d') ?> <br> falta evolución?</strong></td>
									</tr>
									<?php
                  $sql="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac,a.tdoc_pac,a.edad,a.genero,
															 concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,j.nom_piso piso,b.estado_salida,
																	i.nom_pabellon pabellon,concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,'-',g.nom_cama) habi,l.nom_eps,b.fingreso_hosp,
																	DATEDIFF(CURDATE(),b.fingreso_hosp) as estancia,b.clase_dx_hosp,b.id_adm_hosp id,m.dxp
												FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)

                            left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                            left join cama g on (g.id_cama = f.id_cama )
                            left join habitacion h on (h.id_habitacion = g.id_habitacion )
                            left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                            left join piso j on (j.id_piso = i.id_piso )
                            left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )
                            left join eps l on (l.id_eps=b.id_eps)
                            left join hc_hospitalario m on (m.id_adm_hosp=b.id_adm_hosp)
												WHERE b.id_sedes_ips in ('2') and b.estado_adm_hosp='Activo' and b.tipo_servicio='Hospitalario' order by 2,10";
                    //echo $sql;
                  if ($tabla=$bd1->sub_tuplas($sql)){

                    //echo $sql;
                    foreach ($tabla as $fila ) {
                      $fecha=$fila["fingreso_hosp"];
                      $segundos= strtotime('now') - strtotime($fecha);
                      $diferencia_dias=intval($segundos/60/60/24);
											echo"<tr >\n";
											echo'<td class="text-left success">
														<p>'.$fila["paciente"].'</p>
														<p><strong><span class="fa fa-user-md"></span> '.$fila["tdoc_pac"].' : '.$fila["doc_pac"].' </strong></p>
														<p><strong>Edad: </strong>'.$fila["edad"].' Años</p>
														<p><strong>Genero: </strong>'.$fila["genero"].'</p>';
														$perf=$_SESSION['AUT']['id_perfil'];
														if ($perf==10 || $perf==78 || $perf==80 || $perf==81) {

														}else {
															echo'<p class="btn-xs"><a href="'.PROGRAMA.'?doc='.$fila["doc_pac"].'&buscar=Consultar&opcion='.$_REQUEST["opcion"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-eye"></span> VER </button></a></p>';
														}
											echo'</td>';
											echo'<td class="text-left ">
														<p><strong>'.$fila["habi"].'</strong></p>
														<p class="alert alert-danger"><strong>'.$fila["estado_salida"].'</strong></p>
													 </td>';
                      echo'<td class="text-left ">
														<p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>
														<p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
														<p><strong>Estancia: </strong>'.$fila["estancia"].'</p>
													 </td>';
											if ($fila['clase_dx_hosp']=='') {
												echo'<td class="text-left alert alert-danger ">SIN clasificación DX</td>';
											}else {
												echo'<td class="text-left ">'.$fila["clase_dx_hosp"].'</td>';
											}
											echo'<td class="text-left ">';
											$idadm=$fila['id'];
											$d=date('Y-m-d');
											$perfil=$_SESSION['AUT']['id_perfil'];
											if ($perfil==3 || $perfil==4) {
												$sql_evol="SELECT a.id_evomed,b.nombre FROM evolucion_medica a INNER JOIN user b on a.id_user=b.id_user

																	WHERE id_adm_hosp=$idadm and freg_evomed='$d' and b.id_perfil=$perfil";
																	//echo $sql_evol;
												if ($tablae=$bd1->sub_tuplas($sql_evol)){
													foreach ($tablae as $filae ) {
														echo'<p class="alert alert-success animated flash text-center"> NO <br>'.$filae['id_evomed'].' - '.$filae['nombre'].'</p>';
													}
												}else {
													echo'<p class="alert alert-danger animated flash text-center"> SI hace falta Registro</p>';
												}
											}
											if ($perfil==5 || $perfil==6) {
												$sql_evol="SELECT a.id_notaenfermeria,b.nombre FROM nota_enfermeria a INNER JOIN user b on a.id_user=b.id_user

																	WHERE id_adm_hosp=$idadm and freg_nota='$d' and b.id_perfil=$perfil";
																	//echo $sql_evol;
												if ($tablae=$bd1->sub_tuplas($sql_evol)){
													foreach ($tablae as $filae ) {
														echo'<p class="alert alert-success animated flash text-center"> NO <br>'.$filae['id_notaenfermeria'].' - '.$filae['nombre'].'</p>';
													}
												}else {
													echo'<p class="alert alert-danger animated flash text-center"> SI hace falta Registro</p>';
												}
											}
											if ($perfil==8) {
												$sql_evol="SELECT a.id_evoto,b.nombre FROM evo_to a INNER JOIN user b on a.id_user=b.id_user

																	WHERE id_adm_hosp=$idadm and freg_evoto='$d' and b.id_perfil=$perfil";
																	//echo $sql_evol;
												if ($tablae=$bd1->sub_tuplas($sql_evol)){
													foreach ($tablae as $filae ) {
														echo'<p class="alert alert-success animated flash text-center"> NO <br>'.$filae['id_evoto'].' - '.$filae['nombre'].'</p>';
													}
												}else {
													echo'<p class="alert alert-danger animated flash text-center"> SI hace falta Registro</p>';
												}
											}
											if ($perfil==9) {
												$sql_evol="SELECT a.id_evo_psico,b.nombre FROM evo_psicologia a INNER JOIN user b on a.id_user=b.id_user

																	WHERE id_adm_hosp=$idadm and freg_evo_psico='$d' and b.id_perfil=$perfil";
																	//echo $sql_evol;
												if ($tablae=$bd1->sub_tuplas($sql_evol)){
													foreach ($tablae as $filae ) {
														echo'<p class="alert alert-success animated flash text-center"> NO <br>'.$filae['id_evo_psico'].' - '.$filae['nombre'].'</p>';
													}
												}else {
													echo'<p class="alert alert-danger animated flash text-center"> SI hace falta Registro</p>';
												}
											}
											echo'</td>';
                      echo '</tr>';
                    }
                  }
                  ?>


                </table>
              </section>
              </div>

            </div>
          </section>
        </section>
      </section>
  </section>


	  <section >   <!--  search for clinica de facatativa in down-->
	      <section>
	        <section class="modal fade" id="censohd" role="dialog">
	          <section class="modal-dialog modal-lg" >
	            <div class="modal-content">
	              <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal">&times;</button>
	                <h3 class="modal-title alert alert-success" >Censo Diario Clinica Días</h3>
	              </div>
	              <div class="modal-body">
	                <table class="table table-bordered table-responsive">
	                  <tr>
	                    <td colspan="8">

	                      <div id="container2" style="height: 400px" class="col-xs-12"></div>
	                    </td>
	                  </tr>
	                  <tr class="alert alert-info animated ZoomIn ">
	                    <th colspan="4"  class="text-center">Total Pacientes Clínica día Facatativá:</th>
	                    <th colspan="4" class="text-center">
	                      <?php
	                      $sql="SELECT COUNT(b.id_adm_hosp) cuantos

	              						from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
	              									left join eps j on (j.id_eps=b.id_eps)
	              						where b.estado_adm_hosp='Activo' and b.id_sedes_ips='2'
	              													and b.tipo_servicio='Hospital dia'";
	                        //echo $sql;
	                      if ($tabla=$bd1->sub_tuplas($sql)){

	                        //echo $sql;
	                        foreach ($tabla as $fila ) {
	                          echo $fila["cuantos"];
	                        }
	                      }
	                      ?>
	                    </th>
	                  </tr>
										<tr class="alert alert-info animated ZoomIn ">
	                    <th colspan="4"  class="text-center">Consolidado Clinica día Bogotá:</th>
	                    <th colspan="4" class="text-center">
	                      <?php
	                      $sql="SELECT COUNT(b.id_adm_hosp) cuantos

	              						from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
	              									left join eps j on (j.id_eps=b.id_eps)
	              						where b.estado_adm_hosp='Activo' and b.id_sedes_ips='5'
	              													and b.tipo_servicio='Hospital dia'";
	                        //echo $sql;
	                      if ($tabla=$bd1->sub_tuplas($sql)){

	                        //echo $sql;
	                        foreach ($tabla as $fila ) {
	                          echo $fila["cuantos"];
	                        }
	                      }
	                      ?>
	                    </th>
	                  </tr>
	                  <tr class="alert alert-warning animated ZoomIn ">
	                    <th colspan="4"  class="text-center">Consolidado pacientes Clínica día:</th>
	                    <th colspan="4" class="text-center">
	                      <?php
	                      $sql="SELECT COUNT(b.id_adm_hosp) cuantos

	              						from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
	              									left join eps j on (j.id_eps=b.id_eps)
	              						where b.estado_adm_hosp='Activo' and b.id_sedes_ips in ('5','2')
	              													and b.tipo_servicio='Hospital dia'";
	                        //echo $sql;
	                      if ($tabla=$bd1->sub_tuplas($sql)){

	                        //echo $sql;
	                        foreach ($tabla as $fila ) {
	                          echo $fila["cuantos"];
	                        }
	                      }
	                      ?>
	                    </th>
	                  </tr>
	                </table>
	                <div class="text-center">
	                  <button data-toggle="collapse" class="btn btn-primary" data-target="#demo2">Ver Detallado de pacientes clínica día<span class="glyphicon glyphicon-arrow-down"></span> </button>
	                </div>
	                <section id="demo2" class="collapse">
	                  <br>
	                <table class="table table-bordered" id="Exportar_a_Excel">
	                  <tr>
	                    <td class="text-center"><strong>Identificacion</strong></td>
	                    <td class="text-center"><strong>Nombre completo</strong></td>
	                    <td class="text-center"><strong>Edad</strong></td>
	                    <td class="text-center"><strong>Genero</strong></td>
	                    <td class="text-center"><strong>Fecha ingreso</strong></td>
	                    <td class="text-center"><strong>EPS</strong></td>
	                    <td class="text-center"><strong>Diagnostico / Impresion diagnostica</strong></td>
	                  </tr>
	                  <?php

	                  $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
	                  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
	                  c.descripestadoc,
	                  d.descriafiliado,
	                  e.descritusuario,
	                  f.descriocu,
	                  i.descripuedad,
	                  j.nom_eps,
	                  k.ddxp
	                  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
	                        left join estado_civil c on (c.codestadoc = a.estadocivil)
	                        inner join tusuario e on (e.codtusuario=b.tipo_usuario)
	                        inner join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
	                        inner join ocupacion f on (f.codocu=b.ocupacion)
	                        inner join uedad i on (i.coduedad=a.uedad)
	                        left join eps j on (j.id_eps=b.id_eps)
	                        left join hc_hospdia k on (k.id_adm_hosp=b.id_adm_hosp)


	                  where b.id_sedes_ips in ('2','5') and b.estado_adm_hosp='Activo' and tipo_servicio='Hospital dia' order by a.edad ASC";
	                    //echo $sql;
	                  if ($tabla=$bd1->sub_tuplas($sql)){

	                    //echo $sql;
	                    foreach ($tabla as $fila ) {
	                      $fecha=$fila["fingreso_hosp"];
	                      $segundos= strtotime('now') - strtotime($fecha);
	                      $diferencia_dias=intval($segundos/60/60/24);
	                      echo"<tr >\n";
												echo'<td class="text-center success">
															<p><strong><span class="fa fa-user-md"></span> '.$fila["tdoc_pac"].' : '.$fila["doc_pac"].' </strong></p>
															<p class="btn-xs"><a href="'.PROGRAMA.'?doc='.$fila["doc_pac"].'&buscar=Consultar&opcion='.$_REQUEST["opcion"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-eye"></span> VER </button></a></p>
														 </td>';
	                      echo'<td class="text-left info"> '.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
	                      echo'<td class="text-left info"> '.$fila["edad"].'</td>';
	                      echo'<td class="text-left info"> '.$fila["genero"].'</td>';
	                      echo'<td class="text-left info"> '.$fila["fingreso_hosp"].'</td>';
	                      echo'<td class="text-left info"> '.$fila["nom_eps"].'</td>';
	                      echo'<td class="text-left info"> '.$fila["ddxp"].'</td>';
	                      echo '</tr>';
	                    }
	                  }
	                  ?>
	                  <tr>
	                    <form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
	                  	<button class="btn btn-success botonExcel" ><span class="fa fa-file-excel-o"></span> Exportar a excel</button>
	                  	<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
	                  	</form>
	                	</tr>
	                </table>
	              </section>
	              </div>

	            </div>
	          </section>
	        </section>
	      </section>
	  </section>

		<section >   <!--  search for clinica de facatativa in down-->
	 		 <section>
	 			 <section class="modal fade" id="ubiformulaf" role="dialog">
	 				 <section class="modal-dialog modal-lg" >
	 					 <div class="modal-content">
	 						 <div class="modal-header">
	 							 <button type="button" class="close" data-dismiss="modal">&times;</button>
	 							 <h3 class="modal-title alert alert-success" >Ubicación y Formulas medicas Facatativa</h3>
	 						 </div>
	 						 <div class="modal-body">
	 							 <section >
	 								 <br>
	 							 <table class="table table-bordered" id="facatativa">
	 								 <tr>
	 									 <td class="text-center"><strong>Identificacion</strong></td>
	 									 <td class="text-center"><strong>Paciente</strong></td>
	 									 <td class="text-center"><strong>Ubicación</strong></td>
	 									 <td class="text-center"><strong>Medico formula</strong></td>
	 									 <td class="text-center"><strong>Vencimiento</strong></td>
	 									 <td class="text-center"><strong>Medicamento</strong></td>
	 									 <td class="text-center"><strong>Dosis</strong></td>
	 								 </tr>
	 								 <?php

	 								 $sql="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac doc_pac,concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,
									 								 concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,e.nombre quien_formula,
        									 				 c.id_m_fmedhosp,c.fejecucion_inicial formula_desde,c.fejecucion_final formula_hasta,
        									 				 c.tipo_formula tipo_formula,c.estado_m_fmedhosp estado_formula,d.medicamento,
        									 				 d.via,d.frecuencia,d.dosis1,d.dosis2,d.dosis3,d.dosis4

											   FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
                                                 left join m_fmedhosp c on (c.id_adm_hosp = b.id_adm_hosp and (CURRENT_DATE between c.fejecucion_inicial and c.fejecucion_final ))
                            										 left join d_fmedhosp d on (d.id_m_fmedhosp = c.id_m_fmedhosp)
                            										 left join user e on (e.id_user = c.id_user)
                            										 left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                            										 left join cama g on (g.id_cama = f.id_cama )
                            										 left join habitacion h on (h.id_habitacion = g.id_habitacion )
                            										 left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                            										 left join piso j on (j.id_piso = i.id_piso )
                            										 left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )

												WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo' and b.tipo_servicio='Hospitalario' order by 1,3,2";
	 									 //echo $sql;
	 								 if ($tabla=$bd1->sub_tuplas($sql)){

	 									 //echo $sql;
	 									 foreach ($tabla as $fila ) {
	 										 $fecha=$fila["fingreso_hosp"];
	 										 $segundos= strtotime('now') - strtotime($fecha);
	 										 $diferencia_dias=intval($segundos/60/60/24);
	 										 echo"<tr >\n";

	 										 echo'<td class="text-center success col-xs-3"><strong>'.$fila["doc_pac"].' </strong></td>';
	 										 echo'<td class="text-left info col-xs-5">'.$fila["paciente"].' </td>';
	 										 echo'<td class="text-left info col-xs-6">'.$fila["habi"].'</td>';
	 										 echo'<td class="text-left info col-xs-6">'.$fila["quien_formula"].'</td>';
	 										 echo'<td class="text-left info col-xs-6">'.$fila["formula_desde"].' '.$fila["formula_hasta"].'</td>';
	 										 echo'<td class="text-left info col-xs-6">
											 				<p>'.$fila["medicamento"].'</p>
															<p>'.$fila["via"].'</p>
															<p>'.$fila["frecuencia"].'</p>
														</td>';
	 										 echo'<td class="text-left info col-xs-6">
											 				<p><strong>6am-8am</strong> = '.$fila["dosis1"].'
															<strong>12m-2pm</strong> = '.$fila["dosis2"].'
															<strong>6pm-8pm</strong> = '.$fila["dosis3"].'
															<strong>10pm-12pm</strong> = '.$fila["dosis4"].'</p>
														</td>';
	 										 echo '</tr>';
	 									 }
	 								 }
	 								 ?>
	 								 <tr>
										 <form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
										 <p>Exportar a Excel  </p>
										 <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
										 </form>
	 								 </tr>
	 							 </table>
	 						 </section>
	 						 </div>

	 					 </div>
	 				 </section>
	 			 </section>
	 		 </section>
	  </section>


		<section >   <!--  search for clinica de facatativa in down-->
			 <section>
				 <section class="modal fade" id="ubiformulab" role="dialog">
					 <section class="modal-dialog modal-lg" >
						 <div class="modal-content">
							 <div class="modal-header">
								 <button type="button" class="close" data-dismiss="modal">&times;</button>
								 <h3 class="modal-title alert alert-success" >Ubicación y Formulas medicas Bogotá</h3>
							 </div>
							 <div class="modal-body">
								 <section >
									 <br>
								 <table class="table table-bordered" id="Exportar_a_Excel">
									 <tr>
										 <td class="text-center"><strong>Identificacion</strong></td>
										 <td class="text-center"><strong>Paciente</strong></td>
										 <td class="text-center"><strong>Ubicación</strong></td>
										 <td class="text-center"><strong>Medico formula</strong></td>
										 <td class="text-center"><strong>Vencimiento</strong></td>
										 <td class="text-center"><strong>Medicamento</strong></td>
										 <td class="text-center"><strong>Dosis</strong></td>
									 </tr>
									 <?php

									 $sql="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac doc_pac,concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,
																	 concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,e.nombre quien_formula,
																	 c.id_m_fmedhosp,c.fejecucion_inicial formula_desde,c.fejecucion_final formula_hasta,
																	 c.tipo_formula tipo_formula,c.estado_m_fmedhosp estado_formula,d.medicamento,
																	 d.via,d.frecuencia,d.dosis1,d.dosis2,d.dosis3,d.dosis4

												 FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
																								 left join m_fmedhosp c on (c.id_adm_hosp = b.id_adm_hosp and (CURRENT_DATE between c.fejecucion_inicial and c.fejecucion_final ))
																								 left join d_fmedhosp d on (d.id_m_fmedhosp = c.id_m_fmedhosp)
																								 left join user e on (e.id_user = c.id_user)
																								 left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
																								 left join cama g on (g.id_cama = f.id_cama )
																								 left join habitacion h on (h.id_habitacion = g.id_habitacion )
																								 left join pabellon i on ( i.id_pabellon = h.id_pabellon )
																								 left join piso j on (j.id_piso = i.id_piso )
																								 left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )

												WHERE b.id_sedes_ips in (8) and b.estado_adm_hosp='Activo' and b.tipo_servicio='Hospitalario' order by 1,3,2";
										 //echo $sql;
									 if ($tabla=$bd1->sub_tuplas($sql)){

										 //echo $sql;
										 foreach ($tabla as $fila ) {
											 $fecha=$fila["fingreso_hosp"];
											 $segundos= strtotime('now') - strtotime($fecha);
											 $diferencia_dias=intval($segundos/60/60/24);
											 echo"<tr >\n";
											 echo'<td class="text-center success col-xs-3"><strong>'.$fila["doc_pac"].' </strong></td>';
											 echo'<td class="text-left info col-xs-5">'.$fila["paciente"].' </td>';
											 echo'<td class="text-left info col-xs-6">'.$fila["habi"].'</td>';
											 echo'<td class="text-left info col-xs-6">'.$fila["quien_formula"].'</td>';
											 echo'<td class="text-left info col-xs-6">'.$fila["formula_desde"].' '.$fila["formula_hasta"].'</td>';
											 echo'<td class="text-left info col-xs-6">
															<p>'.$fila["medicamento"].'</p>
															<p>'.$fila["via"].'</p>
															<p>'.$fila["frecuencia"].'</p>
														</td>';
											 echo'<td class="text-left info col-xs-6">
															<p><strong>6am-8am</strong> = '.$fila["dosis1"].'
															<strong>12m-2pm</strong> = '.$fila["dosis2"].'
															<strong>6pm-8pm</strong> = '.$fila["dosis3"].'
															<strong>10pm-12pm</strong> = '.$fila["dosis4"].'</p>
														</td>';
											 echo '</tr>';
										 }
									 }
									 ?>
									 <tr>
										 <form action="exportacionexcel/rpt_ubiformulab.php" method="post" target="_blank" id="FormularioExportacion">
										 <button class="btn btn-success botonExcel" ><span class="fa fa-file-excel-o"></span> Exportar a excel</button>
										 <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
										 </form>
									 </tr>
								 </table>
							 </section>
							 </div>

						 </div>
					 </section>
				 </section>
			 </section>
		</section>

		<section >   <!--  search for clinica de facatativa in down-->
			 <section>
				 <section class="modal fade" id="listNEPSfaca" role="dialog">
					 <section class="modal-dialog modal-lg" >
						 <div class="modal-content">
							 <div class="modal-header">
								 <button type="button" class="close" data-dismiss="modal">&times;</button>
								 <h3 class="modal-title alert alert-success" >Pacientes institucionalizados Nuyeva EPS (Facatativá)</h3>
							 </div>
							 <div class="modal-body">
								 <section >
									 <br>
									 <?php $user=$_SESSION['AUT']['id_perfil'];
									 ?>
								 <table class="table table-bordered" >
									 <tr>
									 	<td><a href="rpt_auxiliares/rpt_instituNeps.php?sede=2"><button type="button" class="btn btn-success" ><span class="fa fa-print"></span> Imprimir </button></a></td>
									 </tr>
									 <tr class="alert alert-info animated ZoomIn ">

                     <th class="text-center">Total Pacientes:</th>
                     <th colspan="4" class="text-center">
                       <?php
                       $sql="SELECT
																		count(b.id_adm_hosp) cuantos

														 FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)

														 WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
																												 and b.clase_dx_hosp='Institucionalizado'
																												 and b.id_eps=21
																												 and b.tipo_servicio='Hospitalario'";
                         //echo $sql;
                       if ($tabla=$bd1->sub_tuplas($sql)){

                         //echo $sql;
                         foreach ($tabla as $fila ) {
                           echo $fila["cuantos"];
                         }
                       }
                       ?>
                     </th>
                   </tr>
									 <tr>
										 <td>#</td>
										 <td class="text-center"><strong>Identificacion</strong></td>
										 <td class="text-center"><strong>Paciente</strong></td>
										 <td class="text-center"><strong></strong></td>
									 </tr>
									 <?php

									 $sql="SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
									 							b.id_adm_hosp,clase_dx_hosp,
																concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi

												 FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
																								 left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
																								 left join cama g on (g.id_cama = f.id_cama )
																								 left join habitacion h on (h.id_habitacion = g.id_habitacion )
																								 left join pabellon i on ( i.id_pabellon = h.id_pabellon )
																								 left join piso j on (j.id_piso = i.id_piso )
												WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo'
																										and b.clase_dx_hosp='Institucionalizado'
																										and b.id_eps=21
												 														and b.tipo_servicio='Hospitalario' order by 6 ASC";
										 //echo $sql;
									 if ($tabla=$bd1->sub_tuplas($sql)){
										 $i=1;
										 //echo $sql;
										 foreach ($tabla as $fila ) {
											 $fecha=$fila["fingreso_hosp"];
											 $segundos= strtotime('now') - strtotime($fecha);
											 $diferencia_dias=intval($segundos/60/60/24);
											 echo"<tr >\n";
											 echo'<td class="text-center col-xs-1">'.$i++.' </td>';
											 echo'<td class="text-center"><strong>'.$fila["doc_pac"].' </strong></td>';
											 echo'<td class="text-left">'.$fila["paciente"].' </td>';
											 echo'<td class="text-left">'.$fila["habi"].' </td>';
											 echo'<td class="text-center">';
											 echo'<p><a href="'.PROGRAMA.'?doc='.$fila["doc_pac"].'&buscar=Consultar&opcion='.$_REQUEST["opcion"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-eye"></span> VER </button></a></p></d>';
											 echo '</tr>';
										 }
									 }
									 ?>
								 </table>
							 </section>
							 </div>

						 </div>
					 </section>
				 </section>
			 </section>
		</section>


		<section >   <!--  search for clinica de facatativa in down-->
			 <section>
				 <section class="modal fade" id="listNEPSbta" role="dialog">
					 <section class="modal-dialog modal-lg" >
						 <div class="modal-content">
							 <div class="modal-header">
								 <button type="button" class="close" data-dismiss="modal">&times;</button>
								 <h3 class="modal-title alert alert-success" >Pacientes institucionalizados Nuyeva EPS (Bogotá)</h3>
							 </div>
							 <div class="modal-body">
								 <section >
									 <br>
								 <table class="table table-bordered" >
									 <tr>
									 	<td><a href="rpt_auxiliares/rpt_instituNeps.php?sede=8"><button type="button" class="btn btn-success" ><span class="fa fa-print"></span> Imprimir </button></a></td>
									 </tr>
									 <tr class="alert alert-info animated ZoomIn ">
                     <th class="text-center">Total Pacientes:</th>
                     <th colspan="4" class="text-center">
                       <?php
                       $sql="SELECT
																		count(b.id_adm_hosp) cuantos

														 FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)

														 WHERE b.id_sedes_ips in (8) and b.estado_adm_hosp='Activo'
																												 and b.clase_dx_hosp='Institucionalizado'
																												 and b.id_eps=21
																												 and b.tipo_servicio='Hospitalario'";
                         //echo $sql;
                       if ($tabla=$bd1->sub_tuplas($sql)){

                         //echo $sql;
                         foreach ($tabla as $fila ) {
                           echo $fila["cuantos"];
                         }
                       }
                       ?>
                     </th>
                   </tr>
									 <tr>
										 <td>#</td>
										 <td class="text-center"><strong>Identificacion</strong></td>
										 <td class="text-center"><strong>Paciente</strong></td>
										 <td class="text-center"><strong></strong></td>
									 </tr>
									 <?php

									 $sql="SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
																b.id_adm_hosp,clase_dx_hosp,
																concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi

												 FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
																								 left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
																								 left join cama g on (g.id_cama = f.id_cama )
																								 left join habitacion h on (h.id_habitacion = g.id_habitacion )
																								 left join pabellon i on ( i.id_pabellon = h.id_pabellon )
																								 left join piso j on (j.id_piso = i.id_piso )
												WHERE b.id_sedes_ips in (8) and b.estado_adm_hosp='Activo'
																										and b.clase_dx_hosp='Institucionalizado'
																										and b.id_eps=21
																										and b.tipo_servicio='Hospitalario' order by 6 ASC";
										 //echo $sql;
									 if ($tabla=$bd1->sub_tuplas($sql)){
										 $i=1;
										 //echo $sql;
										 foreach ($tabla as $fila ) {
											 $fecha=$fila["fingreso_hosp"];
											 $segundos= strtotime('now') - strtotime($fecha);
											 $diferencia_dias=intval($segundos/60/60/24);
											 echo"<tr >\n";
											 echo'<td class="text-center  col-xs-3">'.$i++.'</td>';
											 echo'<td class="text-center  col-xs-3"><strong>'.$fila["doc_pac"].' </strong></td>';
											 echo'<td class="text-left  col-xs-5">'.$fila["paciente"].' </td>';
											 echo'<td class="text-left  col-xs-5">'.$fila["habi"].' </td>';
											 echo'<td class="text-center  col-xs-6">';
											 $user=$_SESSION['AUT']['id_perfil'];
											 echo $user;
											echo'</td>';
											 echo '</tr>';
										 }
									 }
									 ?>
								 </table>
							 </section>
							 </div>

						 </div>
					 </section>
				 </section>
			 </section>
		</section>


		<section >   <!--  search for clinica de facatativa in down-->
			 <section>
				 <section class="modal fade" id="listdietabta" role="dialog">
					 <section class="modal-dialog modal-lg" >
						 <div class="modal-content">
							 <div class="modal-header">
								 <button type="button" class="close" data-dismiss="modal">&times;</button>
								 <h3 class="modal-title alert alert-success" >Listado dietas sede (Bogotá)</h3>
							 </div>
							 <div class="modal-body">
								 <section >
									 <br>
								 <table class="table table-bordered" >
									 <tr >
									 	<td colspan="6"><a href="rpt_auxiliares/rpt_dietaBTA.php?sede=8"><button type="button" class="btn btn-success" ><span class="fa fa-print"></span> Imprimir </button></a></td>
									 </tr>
									 <tr>
										 <td>#</td>
										 <td class="text-center"><strong>IDENTIFICACION</strong></td>
										 <td class="text-center"><strong>PACIENTE</strong></td>
										 <td class="text-center"><strong>UBICACION</strong></td>
										 <td class="text-center"><strong>TIPO DIETA</strong></td>
										 <td class="text-center"><strong>OBSERVACION</strong></td>
									 </tr>
									 <?php

									 $sql="SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
																b.id_adm_hosp,clase_dx_hosp,estado_salida,
																concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
																k.tipo_dieta,obs_dieta,estado_dieta

												 FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
																								 left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
																								 left join cama g on (g.id_cama = f.id_cama )
																								 left join habitacion h on (h.id_habitacion = g.id_habitacion )
																								 left join pabellon i on ( i.id_pabellon = h.id_pabellon )
																								 left join piso j on (j.id_piso = i.id_piso )
																								 left join dieta k on k.id_adm_hosp=b.id_adm_hosp
												WHERE b.id_sedes_ips in (8) and b.estado_adm_hosp='Activo' and b.tipo_servicio='Hospitalario'
												order by 7 ASC";
										 //echo $sql;
									 if ($tabla=$bd1->sub_tuplas($sql)){
										 $i=1;
										 foreach ($tabla as $fila ) {
											 $salida=$fila['estado_salida'];
											if ($salida=='Salida Parcial') {
												$fecha=$fila["fingreso_hosp"];
												$segundos= strtotime('now') - strtotime($fecha);
												$diferencia_dias=intval($segundos/60/60/24);
												echo"<tr >\n";
												echo'<td class="text-center">'.$i++.'</td>';
												echo'<td class="text-center"><strong>'.$fila["doc_pac"].' </strong></td>';
												echo'<td class="text-left">'.$fila["paciente"].' </td>';
												echo'<td class="text-left">'.$fila["habi"].' </td>';
												echo'<td class="text-left" colspan="2">Paciente en '.$fila["estado_salida"].' </td>';
												echo '</tr>';
											}
											if ($salida=='') {
												if ($fila['tipo_dieta']=='') {
													echo"<tr >\n";
   											 echo'<td class="text-center danger">'.$i++.'</td>';
   											 echo'<td class="text-center danger"><strong>'.$fila["doc_pac"].' </strong></td>';
   											 echo'<td class="text-left danger">'.$fila["paciente"].' </td>';
   											 echo'<td class="text-left danger">'.$fila["habi"].' </td>';
   											 echo'<td class="text-left danger text-danger">NO TIENE DIETA</td>';
 												 echo'<td class="text-left  danger text-danger">'.$fila["estado_dieta"].'</td>';
   											 echo '</tr>';
											 }else {
												 if ($fila['estado_dieta']=='Activa') {
													 $fecha=$fila["fingreso_hosp"];
   												$segundos= strtotime('now') - strtotime($fecha);
   												$diferencia_dias=intval($segundos/60/60/24);
   												echo"<tr >\n";
   												echo'<td class="text-center">'.$i++.'</td>';
   												echo'<td class="text-center"><strong>'.$fila["doc_pac"].' </strong></td>';
   												echo'<td class="text-left">'.$fila["paciente"].' </td>';
   												echo'<td class="text-left">'.$fila["habi"].' </td>';
   												echo'<td class="text-left">'.$fila["tipo_dieta"].' </td>';
   												echo'<td class="text-left">'.$fila["obs_dieta"].' </td>';
   												echo '</tr>';
												 }

											 }
											}

										 }
									 }
									 ?>
								 </table>
							 </section>
							 </div>

						 </div>
					 </section>
				 </section>
			 </section>
		</section>


		<section >   <!--  search for clinica de facatativa in down-->
			 <section>
				 <section class="modal fade" id="listdietafaca" role="dialog">
					 <section class="modal-dialog modal-lg" >
						 <div class="modal-content">
							 <div class="modal-header">
								 <button type="button" class="close" data-dismiss="modal">&times;</button>
								 <h3 class="modal-title alert alert-success" >Listado dietas sede (Facatativá)</h3>
							 </div>
							 <div class="modal-body">
								 <section >
									 <br>
								 <table class="table table-bordered" >
									 <tr>
									 	<td colspan="6"><a href="rpt_auxiliares/rpt_dieta.php?sede=2"><button type="button" class="btn btn-success" ><span class="fa fa-print"></span> Imprimir </button></a></td>
									 </tr>
									 <tr>
										 <td>#</td>
										 <td class="text-center"><strong>IDENTIFICACION</strong></td>
										 <td class="text-center"><strong>PACIENTE</strong></td>
										 <td class="text-center"><strong>UBICACION</strong></td>
										 <td class="text-center"><strong>TIPO DIETA</strong></td>

									 </tr>
									 <?php

									 $sql="SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
																b.id_adm_hosp,clase_dx_hosp,estado_salida,
																concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi,
																k.tipo_dieta,obs_dieta,estado_dieta

												 FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
																								 left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
																								 left join cama g on (g.id_cama = f.id_cama )
																								 left join habitacion h on (h.id_habitacion = g.id_habitacion )
																								 left join pabellon i on ( i.id_pabellon = h.id_pabellon )
																								 left join piso j on (j.id_piso = i.id_piso )
																								 left join dieta k on k.id_adm_hosp=b.id_adm_hosp
												WHERE b.id_sedes_ips in (2) and b.estado_adm_hosp='Activo' and b.tipo_servicio='Hospitalario'

						 order by 7 ASC

											 ";
										 //echo $sql;
									 if ($tabla=$bd1->sub_tuplas($sql)){
										 $i=1;
										 foreach ($tabla as $fila ) {
											 $salida=$fila['estado_salida'];
											if ($salida=='Salida Parcial') {
												$fecha=$fila["fingreso_hosp"];
												$segundos= strtotime('now') - strtotime($fecha);
												$diferencia_dias=intval($segundos/60/60/24);
												echo"<tr >\n";
												echo'<td class="text-center">'.$i++.'</td>';
												echo'<td class="text-center"><strong>'.$fila["doc_pac"].' </strong></td>';
												echo'<td class="text-left">'.$fila["paciente"].' </td>';
												echo'<td class="text-left">'.$fila["habi"].' </td>';
												echo'<td class="text-left" colspan="2">Paciente en '.$fila["estado_salida"].' </td>';
												echo '</tr>';
											}
											if ($salida=='') {
												if ($fila['tipo_dieta']=='') {
													echo"<tr >\n";
   											 echo'<td class="text-center danger">'.$i++.'</td>';
   											 echo'<td class="text-center danger"><strong>'.$fila["doc_pac"].' </strong></td>';
   											 echo'<td class="text-left danger">'.$fila["paciente"].' </td>';
   											 echo'<td class="text-left danger">'.$fila["habi"].' </td>';
   											 echo'<td class="text-left danger text-danger">NO TIENE DIETA</td>';
 												 echo'<td class="text-left  danger text-danger">'.$fila["estado_dieta"].'</td>';
   											 echo '</tr>';
											 }else {
												 if ($fila['estado_dieta']=='Activa') {
													 $fecha=$fila["fingreso_hosp"];
   												$segundos= strtotime('now') - strtotime($fecha);
   												$diferencia_dias=intval($segundos/60/60/24);
   												echo"<tr >\n";
   												echo'<td class="text-center">'.$i++.'</td>';
   												echo'<td class="text-center"><strong>'.$fila["doc_pac"].' </strong></td>';
   												echo'<td class="text-left">'.$fila["paciente"].' </td>';
   												echo'<td class="text-left">'.$fila["habi"].' </td>';
   												echo'<td class="text-left">'.$fila["tipo_dieta"].' </td>';
   												echo'<td class="text-left">'.$fila["obs_dieta"].' </td>';
   												echo '</tr>';
												 }

											 }
											}

										 }
									 }
									 ?>
								 </table>
							 </section>
							 </div>

						 </div>
					 </section>
				 </section>
			 </section>
		</section>
