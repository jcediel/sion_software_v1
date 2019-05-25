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
  #containerHDB {
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
									depth: 60
							}
					},
					title: {
							text: 'Pacientes Hospitalizados'
					},
					subtitle: {
							text: 'Cantidad de pacientes agrupados por EPS'
					},
					plotOptions: {
							column: {
									depth: 20
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
			$('#containerHDB').highcharts({
					chart: {
							type: 'column',
							margin: 95,
							options3d: {
									enabled: true,
									alpha: 10,
									beta: 25,
									depth: 60
							}
					},
					title: {
							text: 'Pacientes Hospital Día'
					},
					subtitle: {
							text: 'Cantidad de pacientes agrupados por EPS'
					},
					plotOptions: {
							column: {
									depth: 20
							}
					},
					xAxis: {
							categories: [
				<?php
	$sql=mysql_query("SELECT j.nom_eps,COUNT(b.id_adm_hosp) cuantos

							from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
										left join eps j on (j.id_eps=b.id_eps)
							where b.estado_adm_hosp='Activo' and b.id_sedes_ips in (8,5)
														and b.tipo_servicio='Hospital dia' group by nom_eps");
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
							where b.estado_adm_hosp='Activo' and b.id_sedes_ips in (8,5)
														and b.tipo_servicio='Hospital dia' group by nom_eps");
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
  #containerHDF {
		height: 300px;
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
			$('#containerHDF').highcharts({
					chart: {
							type: 'column',
							margin: 95,
							options3d: {
									enabled: true,
									alpha: 10,
									beta: 25,
									depth: 60
							}
					},
					title: {
							text: 'Pacientes Hospital Día'
					},
					subtitle: {
							text: 'Cantidad de pacientes agrupados por EPS'
					},
					plotOptions: {
							column: {
									depth: 20
							}
					},
					xAxis: {
							categories: [
				<?php
	$sql=mysql_query("SELECT j.nom_eps,COUNT(b.id_adm_hosp) cuantos

							from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
										left join eps j on (j.id_eps=b.id_eps)
							where b.estado_adm_hosp='Activo' and b.id_sedes_ips in (2)
														and b.tipo_servicio='Hospital dia' group by nom_eps");
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
							where b.estado_adm_hosp='Activo' and b.id_sedes_ips in (2)
														and b.tipo_servicio='Hospital dia' group by nom_eps");
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
<body>
<!--Indicadores de bogotá-->
<table class="table table-bordered table-responsive col-xs-12">
  <tr>
    <td colspan="4"><h3>Clínica Emmanuel Bogotá</h3></td>
  </tr>
  <tr>
    <td>
      <div id="container" style="height: 300px"></div>
    </td>
    <td >
      <div id="container1" style="height: 300px"></div>
    </td>
    <td >
      <div id="containerHDB" style="height: 300px"></div>
    </td>
  </tr>
  <tr>
    <td class="text-center">
     <a  data-toggle="modal" data-target="#censobta" type="button" ><button type="button" name="button" class="btn btn-primary"><span class="fa fa-list"> </span> Detalle <br>Hospitalizados</button> </a>
     <section class="modal fade" id="censobta" role="dialog">
       <section class="modal-dialog modal-lg" >
         <div class="modal-content">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h3 class="modal-title alert alert-success" >CONSOLIDADO DE PACIENTES EN CLÍNICA EMMANUEL BOGOTÁ</h3>
           </div>
           <div class="modal-body">

               <table class="table table-bordered" id="Exportar_a_Excel">
                 <tr>
                   <td class="text-center"><strong>PACIENTE</strong></td>
                   <td class="text-center"><strong>UBICACION</strong></td>
                   <td class="text-center"><strong>GENERALIDADES</strong></td>
                   <td class="text-center"><strong>ESTANCIA</strong></td>
                   <td class="text-center"><strong>INGRESO / EPS</strong></td>
                   <td class="text-center"><strong>DX</strong></td>
                 </tr>
               <?php
               $sql="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac,a.tdoc_pac,a.edad,a.genero,
                            concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,j.nom_piso piso,b.estado_salida,
                               i.nom_pabellon pabellon,concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,'-',g.nom_cama) habi,l.nom_eps,b.fingreso_hosp,
                               DATEDIFF(CURDATE(),b.fingreso_hosp) as estancia,b.clase_dx_hosp,m.dxp
                     FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)

                         left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                         left join cama g on (g.id_cama = f.id_cama )
                         left join habitacion h on (h.id_habitacion = g.id_habitacion )
                         left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                         left join piso j on (j.id_piso = i.id_piso )
                         left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )
                         left join eps l on (l.id_eps=b.id_eps)
                         left join hc_hospitalario m on (m.id_adm_hosp=b.id_adm_hosp)
                     WHERE b.id_sedes_ips in ('8') and b.estado_adm_hosp='Activo' and b.tipo_servicio='Hospitalario' order by 1,4,3";
                 //echo $sql;
               if ($tabla=$bd1->sub_tuplas($sql)){

                 //echo $sql;
                 foreach ($tabla as $fila ) {
                   $fecha=$fila["fingreso_hosp"];
                   $segundos= strtotime('now') - strtotime($fecha);
                   $diferencia_dias=intval($segundos/60/60/24);
                   echo"<tr >\n";
                   echo'<td class="text-center success">
                         <p>'.$fila["paciente"].'</p>
                         <p><strong><span class="fa fa-user-md"></span> '.$fila["tdoc_pac"].' : '.$fila["doc_pac"].' </strong></p>
                        </td>';
                   echo'<td class="text-left ">
                         <p><strong>'.$fila["habi"].'</strong></p>
                         <p class="alert alert-danger"><strong>'.$fila["estado_salida"].'</strong></p>
                        </td>';
                   echo'<td class="text-left ">
                         <p><strong>Edad: </strong>'.$fila["edad"].' Años</p>
                         <p><strong>Genero: </strong>'.$fila["genero"].'</p>
                        </td>';
                   echo'<td class="text-left ">'.$fila["estancia"].'</td>';
                   echo'<td class="text-left ">
                         <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>
                         <p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
                        </td>';
                   if ($fila['clase_dx_hosp']=='') {
                     echo'<td class="text-left alert alert-danger ">SIN clasificación DX</td>';
                   }else {
                     echo'<td class="text-left ">'.$fila["clase_dx_hosp"].'</td>';
                   }
                   echo '</tr>';
                 }
               }
               ?>

             </table>

           </div>
         </div>
       </section>
     </section>
		 <a  data-toggle="modal" data-target="#hdb" type="button" ><button type="button" name="button" class="btn btn-primary"><span class="fa fa-list"> </span> Detalle <br>Hospital dia</button> </a>
		 <section class="modal fade" id="hdb" role="dialog">
			 <section class="modal-dialog modal-lg" >
				 <div class="modal-content">
					 <div class="modal-header">
						 <button type="button" class="close" data-dismiss="modal">&times;</button>
						 <h3 class="modal-title alert alert-success" >Detalle Hospital Dia</h3>
					 </div>
					 <div class="modal-body">

							 <table class="table table-bordered" id="Exportar_a_Excel">
								 <tr>
									 <td class="text-center"><strong>PACIENTE</strong></td>
									 <td class="text-center"><strong>UBICACION</strong></td>
									 <td class="text-center"><strong>GENERALIDADES</strong></td>
									 <td class="text-center"><strong>INGRESO / EPS</strong></td>
								 </tr>
							 <?php
							 $sql="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac,a.tdoc_pac,a.edad,a.genero,
							 							concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,
														b.estado_salida,l.nom_eps,b.fingreso_hosp,
															 DATEDIFF(CURDATE(),b.fingreso_hosp) as estancia,b.clase_dx_hosp
										 FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
												 left join sedes_ips k on (k.id_sedes_ips= b.id_sedes_ips )
												 left join eps l on (l.id_eps=b.id_eps)
										 WHERE b.id_sedes_ips in (8,5) and b.estado_adm_hosp='Activo' and b.tipo_servicio='Hospital dia' order by 1,4,3";
								 //echo $sql;
								 $i=1;
							 if ($tabla=$bd1->sub_tuplas($sql)){
								 foreach ($tabla as $fila ) {
									 $fecha=$fila["fingreso_hosp"];
									 $segundos= strtotime('now') - strtotime($fecha);
									 $diferencia_dias=intval($segundos/60/60/24);

										 echo"<tr >\n";
										 echo'<td class="text-center success">
													 <p><strong>'.$i++.'</strong> -- '.$fila["paciente"].'</p>
													 <p><strong><span class="fa fa-user-md"></span> '.$fila["tdoc_pac"].' : '.$fila["doc_pac"].' </strong></p>
													</td>';
										 echo'<td class="text-left ">
													 <p><strong>'.$fila["habi"].'</strong></p>
													 <p class="alert alert-danger"><strong>'.$fila["estado_salida"].'</strong></p>
													</td>';
										 echo'<td class="text-left ">
													 <p><strong>Edad: </strong>'.$fila["edad"].' Años</p>
													 <p><strong>Genero: </strong>'.$fila["genero"].'</p>
													</td>';
										 echo'<td class="text-left ">
													 <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>
													 <p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
													</td>';
										 echo '</tr>';


								 }
							 }
							 ?>

						 </table>

					 </div>
				 </div>
			 </section>
		 </section>
    </td>
    <td class="text-center">
      <a  data-toggle="modal" data-target="#s_parcial" type="button" ><button type="button" name="button" class="btn btn-primary"><span class="fa fa-arrow-circle-o-left"> </span> Salidas parciales</button> </a>
      <div id="s_parcial" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Pacientes en Salida Parcial</h4>
            </div>
            <div class="modal-body">
              <table class="table table-bordered" id="Exportar_a_Excel">
                <tr>
                  <td class="text-center"><strong>Identificacion</strong></td>
                  <td class="text-center"><strong>Nombre completo</strong></td>
                  <td class="text-center"><strong>EPS</strong></td>
                  <td class="text-center"><strong>SEDE</strong></td>
                </tr>
                <?php

                $sqlhd="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
                b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
                c.descripestadoc,
                d.descriafiliado,
                e.descritusuario,
                f.descriocu,
                i.descripuedad,
                j.nom_eps,
                k.ddxp,
                l.id_sedes_ips,nom_sedes
                from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
                      left join estado_civil c on (c.codestadoc = a.estadocivil)
                      inner join tusuario e on (e.codtusuario=b.tipo_usuario)
                      inner join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
                      inner join ocupacion f on (f.codocu=b.ocupacion)
                      inner join uedad i on (i.coduedad=a.uedad)
                      left join eps j on (j.id_eps=b.id_eps)
                      left join sedes_ips l on (l.id_sedes_ips=b.id_sedes_ips)
                      left join hc_hospdia k on (k.id_adm_hosp=b.id_adm_hosp)


                where b.id_sedes_ips in ('8') and b.estado_adm_hosp='Activo' and tipo_servicio='Hospitalario' and estado_salida='Salida Parcial' order by a.doc_pac,b.id_sedes_ips ASC";
                  //echo $sql;
                if ($tablahd=$bd1->sub_tuplas($sqlhd)){
                  foreach ($tablahd as $filahd ) {
                    if ($filahd['id_sedes_ips']==2) {
                      echo"<tr >\n";
                      echo'<td class="text-center ">
                            <p class="btn-xs"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PARCIAL&idadm='.$filahd["id_adm_hosp"].'&ser='.$filahd["id_serv"].'&doc='.$filahd["doc_pac"].'"><button type="button" class="btn btn-danger sombra_movil"><span class="fa fa-hospital-o"></span> Regreso<br>Hospitalario</button></a></p>
                           </td>';
                      echo'<td class="text-left ">
                            <p>'.$filahd["nom1"].' '.$filahd["nom2"].' '.$filahd["ape1"].' '.$filahd["ape2"].'</p>
                            <p><strong><span class="fa fa-user-md"></span> '.$filahd["tdoc_pac"].' : '.$filahd["doc_pac"].' </strong></p>
                           </td>';
                      echo'<td class="text-left "> '.$filahd["nom_eps"].'</td>';
                      echo'<td class="text-left "> '.$filahd["nom_sedes"].'</td>';
                      echo '</tr>';
                    }
                    if ($filahd['id_sedes_ips']==8) {
                      echo"<tr >\n";
                      echo'<td class="text-center">
                            <p class="btn-xs"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PARCIAL&idadm='.$filahd["id_adm_hosp"].'&ser='.$filahd["id_serv"].'&doc='.$filahd["doc_pac"].'"><button type="button" class="btn btn-danger sombra_movil"><span class="fa fa-hospital-o"></span> Regreso<br>Hospitalario</button></a></p>
                           </td>';
                      echo'<td class="text-left">
                            <p>'.$filahd["nom1"].' '.$filahd["nom2"].' '.$filahd["ape1"].' '.$filahd["ape2"].'</p>
                            <p><strong><span class="fa fa-user-md"></span> '.$filahd["tdoc_pac"].' : '.$filahd["doc_pac"].' </strong></p>
                           </td>';
                      echo'<td class="text-left"> '.$filahd["nom_eps"].'</td>';
                      echo'<td class="text-left"> '.$filahd["nom_sedes"].'</td>';
                      echo '</tr>';
                    }

                  }
                }
                ?>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </div>

        </div>
      </div>
    </td>
    <td class="text-center">
      <a  data-toggle="modal" data-target="#ult_ingreso" type="button" ><button type="button" name="button" class="btn btn-primary"><span class="fa fa-arrow-circle-o-right"> </span> Ultimos Ingresos</button> </a>
			<a  data-toggle="modal" data-target="#ult_egreso" type="button" ><button type="button" name="button" class="btn btn-danger"><span class="fa fa-arrow-circle-o-right"> </span> Ultimos Egresos</button> </a>
			<section class="modal fade" id="ult_egreso" role="dialog">
				<section class="modal-dialog modal-lg" >
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h3 class="modal-title alert alert-success" >ULTIMOS PACIENTES EGRESADOS</h3>
						</div>
						<div class="modal-body">

								<table class="table table-bordered" id="Exportar_a_Excel">
									<tr>
										<td class="text-center"><strong>PACIENTE</strong></td>
										<td class="text-center"><strong>DX EGRESO</strong></td>
										<td class="text-center"><strong>ESTADO SALIDA</strong></td>
									</tr>
								<?php
								$fecha=date('m');
								$sql="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac,a.tdoc_pac,a.edad,a.genero,
														 concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,j.nom_piso piso,b.estado_salida,
																i.nom_pabellon pabellon,concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,'-',g.nom_cama) habi,
																l.nom_eps,b.fingreso_hosp,b.fegreso_hosp,b.estado_salida,
																DATEDIFF(CURDATE(),b.fingreso_hosp) as estancia,b.clase_dx_hosp,m.ddxp_epi,plant_epicrisis
											FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)

													left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
													left join cama g on (g.id_cama = f.id_cama )
													left join habitacion h on (h.id_habitacion = g.id_habitacion )
													left join pabellon i on ( i.id_pabellon = h.id_pabellon )
													left join piso j on (j.id_piso = i.id_piso )
													left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )
													left join eps l on (l.id_eps=b.id_eps)
													left join epicrisis m on (m.id_adm_hosp=b.id_adm_hosp)
											WHERE b.id_sedes_ips in ('8')  and b.tipo_servicio='Hospitalario'
															 and b.estado_adm_hosp='Parcial'
                               and b.fegreso_hosp BETWEEN '2018-$fecha-01' and '2018-$fecha-31'
											order by 1,4,3";
									//echo $sql;
								if ($tabla=$bd1->sub_tuplas($sql)){

									//echo $sql;
									foreach ($tabla as $fila ) {
										$fecha=$fila["fingreso_hosp"];
										$segundos= strtotime('now') - strtotime($fecha);
										$diferencia_dias=intval($segundos/60/60/24);

											echo"<tr >\n";
											echo'<td class="text-center success">
														<p>'.$fila["paciente"].'</p>
														<p><strong><span class="fa fa-user-md"></span> '.$fila["tdoc_pac"].' : '.$fila["doc_pac"].' </strong></p>
														<p><strong><span class="fa fa-calendar"></span> '.$fila["fegreso_hosp"].' </strong></p>
													 </td>';
											echo'<td class="text-left ">
														<p><strong>'.$fila["ddxp_epi"].'</strong></p>

													 </td>';
											echo'<td class="text-left ">
														<p>'.$fila["estado_salida"].'</p>
													 </td>';
											echo '</tr>';


									}
								}
								?>

							</table>

						</div>
					</div>
				</section>
			</section>
			<section class="modal fade" id="ult_ingreso" role="dialog">
        <section class="modal-dialog modal-lg" >
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title alert alert-success" >ULTIMOS PACIENTES ADMISIONADOS</h3>
            </div>
            <div class="modal-body">

                <table class="table table-bordered" id="Exportar_a_Excel">
                  <tr>
                    <td class="text-center"><strong>PACIENTE</strong></td>
                    <td class="text-center"><strong>UBICACION</strong></td>
                    <td class="text-center"><strong>GENERALIDADES</strong></td>
                    <td class="text-center"><strong>ESTANCIA</strong></td>
                    <td class="text-center"><strong>INGRESO / EPS</strong></td>
                    <td class="text-center"><strong>DX</strong></td>
                  </tr>
                <?php
                $sql="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac,a.tdoc_pac,a.edad,a.genero,
                             concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,j.nom_piso piso,b.estado_salida,
                                i.nom_pabellon pabellon,concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,'-',g.nom_cama) habi,l.nom_eps,b.fingreso_hosp,
                                DATEDIFF(CURDATE(),b.fingreso_hosp) as estancia,b.clase_dx_hosp,m.dxp
                      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)

                          left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                          left join cama g on (g.id_cama = f.id_cama )
                          left join habitacion h on (h.id_habitacion = g.id_habitacion )
                          left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                          left join piso j on (j.id_piso = i.id_piso )
                          left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )
                          left join eps l on (l.id_eps=b.id_eps)
                          left join hc_hospitalario m on (m.id_adm_hosp=b.id_adm_hosp)
                      WHERE b.id_sedes_ips in ('8') and b.estado_adm_hosp='Activo' and b.tipo_servicio='Hospitalario' order by 1,4,3";
                  //echo $sql;
                if ($tabla=$bd1->sub_tuplas($sql)){

                  //echo $sql;
                  foreach ($tabla as $fila ) {
                    $fecha=$fila["fingreso_hosp"];
                    $segundos= strtotime('now') - strtotime($fecha);
                    $diferencia_dias=intval($segundos/60/60/24);
                    if ($fila['estancia'] < 5) {
                      echo"<tr >\n";
                      echo'<td class="text-center success">
                            <p>'.$fila["paciente"].'</p>
                            <p><strong><span class="fa fa-user-md"></span> '.$fila["tdoc_pac"].' : '.$fila["doc_pac"].' </strong></p>
                           </td>';
                      echo'<td class="text-left ">
                            <p><strong>'.$fila["habi"].'</strong></p>
                            <p class="alert alert-danger"><strong>'.$fila["estado_salida"].'</strong></p>
                           </td>';
                      echo'<td class="text-left ">
                            <p><strong>Edad: </strong>'.$fila["edad"].' Años</p>
                            <p><strong>Genero: </strong>'.$fila["genero"].'</p>
                           </td>';
                      echo'<td class="text-left ">'.$fila["estancia"].'</td>';
                      echo'<td class="text-left ">
                            <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>
                            <p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
                           </td>';
                      if ($fila['clase_dx_hosp']=='') {
                        echo'<td class="text-left alert alert-danger ">SIN clasificación DX</td>';
                      }else {
                        echo'<td class="text-left ">'.$fila["clase_dx_hosp"].'</td>';
                      }
                      echo '</tr>';
                    }

                  }
                }
                ?>

              </table>

            </div>
          </div>
        </section>
      </section>
    </td>
  </tr>
  <tr class="">
    <th  class="text-center"><strong class="text-primary">Total Hospitalizados:</strong>
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
    <th  class="text-center"><strong class="text-primary">Salidas Parciales: </strong>
      <?php
      $sql="SELECT COUNT(b.id_adm_hosp) cuantos

          from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
                left join eps j on (j.id_eps=b.id_eps)
          where b.estado_adm_hosp='Activo' and b.id_sedes_ips='8'
                        and b.tipo_servicio='Hospitalario' and b.estado_salida='Salida Parcial'";
        //echo $sql;
      if ($tabla=$bd1->sub_tuplas($sql)){

        //echo $sql;
        foreach ($tabla as $fila ) {
          echo $fila["cuantos"];
        }
      }
      ?>
    </th>
    <th  class="text-center"><strong class="text-primary">Total Hospital día:</strong>
      <?php
      $sql="SELECT COUNT(b.id_adm_hosp) cuantos

          from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
                left join eps j on (j.id_eps=b.id_eps)
          where b.estado_adm_hosp='Activo' and b.id_sedes_ips in (8,5)
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

  <!--Indicadores de FACATATIVÁ-->
  <table class="table table-bordered table-responsive col-xs-12">
    <tr>
      <td colspan="4"><h3>Clínica Emmanuel FACATATIVÁ</h3></td>
    </tr>
    <tr>
      <td>
        <div id="container2" style="height: 300px"></div>
      </td>
      <td >
        <div id="container3" style="height: 300px"></div>
      </td>
      <td >
        <div id="containerHDF" style="height: 300px"></div>
      </td>
    </tr>
    <tr>
      <td class="text-center">
       <a  data-toggle="modal" data-target="#censofaca" type="button" ><button type="button" name="button" class="btn btn-primary"><span class="fa fa-list"> </span> Detalle <br>Hospitalizados</button> </a>
       <section class="modal fade" id="censofaca" role="dialog">
         <section class="modal-dialog modal-lg" >
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title alert alert-success" >CONSOLIDADO DE PACIENTES EN CLÍNICA EMMANUEL FACATATIVÁ</h3>
             </div>
             <div class="modal-body">

                 <table class="table table-bordered" id="Exportar_a_Excel">
                   <tr>
                     <td class="text-center"><strong>PACIENTE</strong></td>
                     <td class="text-center"><strong>UBICACION</strong></td>
                     <td class="text-center"><strong>GENERALIDADES</strong></td>
                     <td class="text-center"><strong>ESTANCIA</strong></td>
                     <td class="text-center"><strong>INGRESO / EPS</strong></td>
                     <td class="text-center"><strong>DX</strong></td>
                   </tr>
                 <?php
                 $sql="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac,a.tdoc_pac,a.edad,a.genero,
                              concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,j.nom_piso piso,b.estado_salida,
                                 i.nom_pabellon pabellon,concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,'-',g.nom_cama) habi,l.nom_eps,b.fingreso_hosp,
                                 DATEDIFF(CURDATE(),b.fingreso_hosp) as estancia,b.clase_dx_hosp,m.dxp
                       FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)

                           left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                           left join cama g on (g.id_cama = f.id_cama )
                           left join habitacion h on (h.id_habitacion = g.id_habitacion )
                           left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                           left join piso j on (j.id_piso = i.id_piso )
                           left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )
                           left join eps l on (l.id_eps=b.id_eps)
                           left join hc_hospitalario m on (m.id_adm_hosp=b.id_adm_hosp)
                       WHERE b.id_sedes_ips in ('2') and b.estado_adm_hosp='Activo' and b.tipo_servicio='Hospitalario' order by 1,4,3";
                   //echo $sql;
									 $i=1;
                 if ($tabla=$bd1->sub_tuplas($sql)){

                   //echo $sql;
                   foreach ($tabla as $fila ) {
                     $fecha=$fila["fingreso_hosp"];
                     $segundos= strtotime('now') - strtotime($fecha);
                     $diferencia_dias=intval($segundos/60/60/24);
                     echo"<tr >\n";

                     echo'<td class="text-center success">
                           <p><storng>'.$i++.'</storng> -- '.$fila["paciente"].'</p>
                           <p><strong><span class="fa fa-user-md"></span> '.$fila["tdoc_pac"].' : '.$fila["doc_pac"].' </strong></p>
                          </td>';
                     echo'<td class="text-left ">
                           <p><strong>'.$fila["habi"].'</strong></p>
                           <p class="alert alert-danger"><strong>'.$fila["estado_salida"].'</strong></p>
                          </td>';
                     echo'<td class="text-left ">
                           <p><strong>Edad: </strong>'.$fila["edad"].' Años</p>
                           <p><strong>Genero: </strong>'.$fila["genero"].'</p>
                          </td>';
                     echo'<td class="text-left ">'.$fila["estancia"].'</td>';
                     echo'<td class="text-left ">
                           <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>
                           <p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
                          </td>';
                     if ($fila['clase_dx_hosp']=='') {
                       echo'<td class="text-left alert alert-danger ">SIN clasificación DX</td>';
                     }else {
                       echo'<td class="text-left ">'.$fila["clase_dx_hosp"].'</td>';
                     }
                     echo '</tr>';
                   }
                 }
                 ?>

               </table>

             </div>
           </div>
         </section>
       </section>
			 <a  data-toggle="modal" data-target="#hdf" type="button" ><button type="button" name="button" class="btn btn-primary"><span class="fa fa-list"> </span> Detalle <br>Hospital dia</button> </a>
			 <section class="modal fade" id="hdf" role="dialog">
				 <section class="modal-dialog modal-lg" >
					 <div class="modal-content">
						 <div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal">&times;</button>
							 <h3 class="modal-title alert alert-success" >Detalle Hospital Dia</h3>
						 </div>
						 <div class="modal-body">

								 <table class="table table-bordered" id="Exportar_a_Excel">
									 <tr>
										 <td class="text-center"><strong>PACIENTE</strong></td>
										 <td class="text-center"><strong>UBICACION</strong></td>
										 <td class="text-center"><strong>GENERALIDADES</strong></td>
										 <td class="text-center"><strong>INGRESO / EPS</strong></td>
									 </tr>
								 <?php
								 $sql="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac,a.tdoc_pac,a.edad,a.genero,
								 							concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,
															b.estado_salida,l.nom_eps,b.fingreso_hosp,
																 DATEDIFF(CURDATE(),b.fingreso_hosp) as estancia,b.clase_dx_hosp
											 FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
													 left join sedes_ips k on (k.id_sedes_ips= b.id_sedes_ips )
													 left join eps l on (l.id_eps=b.id_eps)

											 WHERE b.id_sedes_ips in ('2') and b.estado_adm_hosp='Activo' and b.tipo_servicio='Hospital dia' order by 1,4,3";
									 //echo $sql;
									 $i=1;
								 if ($tabla=$bd1->sub_tuplas($sql)){

									 //echo $sql;
									 foreach ($tabla as $fila ) {
										 $fecha=$fila["fingreso_hosp"];
										 $segundos= strtotime('now') - strtotime($fecha);
										 $diferencia_dias=intval($segundos/60/60/24);

											 echo"<tr >\n";
											 echo'<td class="text-center success">
														 <p><storng>'.$i++.'</storng> -- '.$fila["paciente"].'</p>
														 <p><strong><span class="fa fa-user-md"></span> '.$fila["tdoc_pac"].' : '.$fila["doc_pac"].' </strong></p>
														</td>';
											 echo'<td class="text-left ">
														 <p><strong>'.$fila["habi"].'</strong></p>
														 <p class="alert alert-danger"><strong>'.$fila["estado_salida"].'</strong></p>
														</td>';
											 echo'<td class="text-left ">
														 <p><strong>Edad: </strong>'.$fila["edad"].' Años</p>
														 <p><strong>Genero: </strong>'.$fila["genero"].'</p>
														</td>';
											 echo'<td class="text-left ">
														 <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>
														 <p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
														</td>';
											 echo '</tr>';


									 }
								 }
								 ?>
							 </table>

						 </div>
					 </div>
				 </section>
			 </section>
      </td>
      <td class="text-center">
        <a  data-toggle="modal" data-target="#s_parcialf" type="button" ><button type="button" name="button" class="btn btn-primary"><span class="fa fa-arrow-circle-o-left"> </span> Salidas parciales</button> </a>
        <div id="s_parcialf" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">

            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pacientes en Salida Parcial</h4>
              </div>
              <div class="modal-body">
                <table class="table table-bordered" id="Exportar_a_Excel">
                  <tr>
                    <td class="text-center"><strong>Nombre completo</strong></td>
                    <td class="text-center"><strong>EPS</strong></td>
                    <td class="text-center"><strong>SEDE</strong></td>
                  </tr>
                  <?php

                  $sqlhd="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
                  b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
                  c.descripestadoc,
                  d.descriafiliado,
                  e.descritusuario,
                  f.descriocu,
                  i.descripuedad,
                  j.nom_eps,
                  k.ddxp,
                  l.id_sedes_ips,nom_sedes
                  from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
                        left join estado_civil c on (c.codestadoc = a.estadocivil)
                        inner join tusuario e on (e.codtusuario=b.tipo_usuario)
                        inner join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
                        inner join ocupacion f on (f.codocu=b.ocupacion)
                        inner join uedad i on (i.coduedad=a.uedad)
                        left join eps j on (j.id_eps=b.id_eps)
                        left join sedes_ips l on (l.id_sedes_ips=b.id_sedes_ips)
                        left join hc_hospdia k on (k.id_adm_hosp=b.id_adm_hosp)


                  where b.id_sedes_ips in ('2') and b.estado_adm_hosp='Activo' and tipo_servicio='Hospitalario' and estado_salida='Salida Parcial' order by a.doc_pac,b.id_sedes_ips ASC";
                    //echo $sql;
                  if ($tablahd=$bd1->sub_tuplas($sqlhd)){
                    foreach ($tablahd as $filahd ) {
                      if ($filahd['id_sedes_ips']==2) {
                        echo"<tr >\n";
                        echo'<td class="text-left ">
                              <p>'.$filahd["nom1"].' '.$filahd["nom2"].' '.$filahd["ape1"].' '.$filahd["ape2"].'</p>
                              <p><strong><span class="fa fa-user-md"></span> '.$filahd["tdoc_pac"].' : '.$filahd["doc_pac"].' </strong></p>
                             </td>';
                        echo'<td class="text-left "> '.$filahd["nom_eps"].'</td>';
                        echo'<td class="text-left "> '.$filahd["nom_sedes"].'</td>';
                        echo '</tr>';
                      }
                    }
                  }
                  ?>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
            </div>

          </div>
        </div>
      </td>
      <td class="text-center">
        <a  data-toggle="modal" data-target="#ult_ingresof" type="button" ><button type="button" name="button" class="btn btn-primary"><span class="fa fa-arrow-circle-o-right"> </span> Ultimos ingresos</button> </a>
				<a  data-toggle="modal" data-target="#ult_egreso" type="button" ><button type="button" name="button" class="btn btn-danger"><span class="fa fa-arrow-circle-o-right"> </span> Ultimos Egresos</button> </a>
				<section class="modal fade" id="ult_egreso" role="dialog">
					<section class="modal-dialog modal-lg" >
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h3 class="modal-title alert alert-success" >ULTIMOS PACIENTES EGRESADOS</h3>
							</div>
							<div class="modal-body">

									<table class="table table-bordered" id="Exportar_a_Excel">
										<tr>
											<td class="text-center"><strong>PACIENTE</strong></td>
											<td class="text-center"><strong>DX EGRESO</strong></td>
											<td class="text-center"><strong>PLAN TRATAMIENTO</strong></td>
										</tr>
									<?php
									$fecha=date('m');
									$sql="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac,a.tdoc_pac,a.edad,a.genero,
															 concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,j.nom_piso piso,b.estado_salida,
																	i.nom_pabellon pabellon,concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,'-',g.nom_cama) habi,l.nom_eps,b.fingreso_hosp,
																	DATEDIFF(CURDATE(),b.fingreso_hosp) as estancia,b.clase_dx_hosp,m.ddxp_epi,plant_epicrisis
												FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)

														left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
														left join cama g on (g.id_cama = f.id_cama )
														left join habitacion h on (h.id_habitacion = g.id_habitacion )
														left join pabellon i on ( i.id_pabellon = h.id_pabellon )
														left join piso j on (j.id_piso = i.id_piso )
														left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )
														left join eps l on (l.id_eps=b.id_eps)
														left join epicrisis m on (m.id_adm_hosp=b.id_adm_hosp)
	WHERE b.id_sedes_ips in ('2')  and b.tipo_servicio='Hospitalario'
																 and b.estado_adm_hosp='Parcial'
	                               and b.fegreso_hosp BETWEEN '2018-$fecha-01' and '2018-$fecha-31'
												order by 1,4,3";
										//echo $sql;
									if ($tabla=$bd1->sub_tuplas($sql)){

										//echo $sql;
										foreach ($tabla as $fila ) {
											$fecha=$fila["fingreso_hosp"];
											$segundos= strtotime('now') - strtotime($fecha);
											$diferencia_dias=intval($segundos/60/60/24);

												echo"<tr >\n";
												echo'<td class="text-center success">
															<p>'.$fila["paciente"].'</p>
															<p><strong><span class="fa fa-user-md"></span> '.$fila["tdoc_pac"].' : '.$fila["doc_pac"].' </strong></p>
															<p><strong><span class="fa fa-calendar"></span> '.$fila["fegreso_hosp"].' </strong></p>
														 </td>';
												echo'<td class="text-left ">
															<p><strong>'.$fila["ddxp_epi"].'</strong></p>

														 </td>';
												echo'<td class="text-left ">
															<p>'.$fila["plant_epicrisis"].'</p>
														 </td>';
												echo '</tr>';


										}
									}
									?>

								</table>

							</div>
						</div>
					</section>
				</section>
        <section class="modal fade" id="ult_ingresof" role="dialog">
          <section class="modal-dialog modal-lg" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title alert alert-success" >ULTIMOS PACIENTES ADMISIONADOS</h3>
              </div>
              <div class="modal-body">

                  <table class="table table-bordered" id="Exportar_a_Excel">
                    <tr>
                      <td class="text-center"><strong>PACIENTE</strong></td>
                      <td class="text-center"><strong>UBICACION</strong></td>
                      <td class="text-center"><strong>GENERALIDADES</strong></td>
                      <td class="text-center"><strong>ESTANCIA</strong></td>
                      <td class="text-center"><strong>INGRESO / EPS</strong></td>
                      <td class="text-center"><strong>DX</strong></td>
                    </tr>
                  <?php
                  $sql="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac,a.tdoc_pac,a.edad,a.genero,
                               concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,j.nom_piso piso,b.estado_salida,
                                  i.nom_pabellon pabellon,concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,'-',g.nom_cama) habi,l.nom_eps,b.fingreso_hosp,
                                  DATEDIFF(CURDATE(),b.fingreso_hosp) as estancia,b.clase_dx_hosp,m.dxp
                        FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)

                            left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
                            left join cama g on (g.id_cama = f.id_cama )
                            left join habitacion h on (h.id_habitacion = g.id_habitacion )
                            left join pabellon i on ( i.id_pabellon = h.id_pabellon )
                            left join piso j on (j.id_piso = i.id_piso )
                            left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )
                            left join eps l on (l.id_eps=b.id_eps)
                            left join hc_hospitalario m on (m.id_adm_hosp=b.id_adm_hosp)
                        WHERE b.id_sedes_ips in ('2') and b.estado_adm_hosp='Activo' and b.tipo_servicio='Hospitalario' order by 1,4,3";
                    //echo $sql;
                  if ($tabla=$bd1->sub_tuplas($sql)){

                    //echo $sql;
                    foreach ($tabla as $fila ) {
                      $fecha=$fila["fingreso_hosp"];
                      $segundos= strtotime('now') - strtotime($fecha);
                      $diferencia_dias=intval($segundos/60/60/24);
                      if ($fila['estancia'] < 5) {
                        echo"<tr >\n";
                        echo'<td class="text-center success">
                              <p>'.$fila["paciente"].'</p>
                              <p><strong><span class="fa fa-user-md"></span> '.$fila["tdoc_pac"].' : '.$fila["doc_pac"].' </strong></p>
                             </td>';
                        echo'<td class="text-left ">
                              <p><strong>'.$fila["habi"].'</strong></p>
                              <p class="alert alert-danger"><strong>'.$fila["estado_salida"].'</strong></p>
                             </td>';
                        echo'<td class="text-left ">
                              <p><strong>Edad: </strong>'.$fila["edad"].' Años</p>
                              <p><strong>Genero: </strong>'.$fila["genero"].'</p>
                             </td>';
                        echo'<td class="text-left ">'.$fila["estancia"].'</td>';
                        echo'<td class="text-left ">
                              <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>
                              <p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
                             </td>';
                        if ($fila['clase_dx_hosp']=='') {
                          echo'<td class="text-left alert alert-danger ">SIN clasificación DX</td>';
                        }else {
                          echo'<td class="text-left ">'.$fila["clase_dx_hosp"].'</td>';
                        }
                        echo '</tr>';
                      }

                    }
                  }
                  ?>
                </table>

              </div>
            </div>
          </section>
        </section>
      </td>
    </tr>
    <tr class="">
      <th  class="text-center"><strong class="text-primary">Total Hospitalizados:</strong>
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
      <th  class="text-center"><strong class="text-primary">Salidas Parciales: </strong>
        <?php
        $sql="SELECT COUNT(b.id_adm_hosp) cuantos

            from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
            where b.estado_adm_hosp='Activo' and b.id_sedes_ips='2'
                          and b.tipo_servicio='Hospitalario' and b.estado_salida='Salida Parcial'";
          //echo $sql;
        if ($tabla=$bd1->sub_tuplas($sql)){

          //echo $sql;
          foreach ($tabla as $fila ) {
            echo $fila["cuantos"];
          }
        }
        ?>
      </th>
      <th  class="text-center"><strong class="text-primary">Total Hospital día:</strong>
        <?php
        $sql="SELECT COUNT(b.id_adm_hosp) cuantos

            from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
            where b.estado_adm_hosp='Activo' and b.id_sedes_ips in (2)
                          and b.tipo_servicio='Hospital dia' and b.estado_adm_hosp='Activo'";
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
</body>
