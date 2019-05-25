
<?php
	require_once("reportes_graficos/conexion/conexion.php");
?>
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
  </style>
	<script type="text/javascript">
		$(function () {
				$('#container').highcharts({
					chart: {
							type: 'pie',
							options3d: {
									enabled: true,
									alpha: 45
							}
					},
					title: {
							text: 'CONSOLIDADO X RESULTADO'
					},
					subtitle: {
							text: 'Cantidad de pacientes agrupados por RESULTADO'
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
								$sql=mysql_query("SELECT a.tdoc_pac,COUNT(doc_pac) cuantos,nom_completo,TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad,
																								 c.freg fescala,hreg,total,riesgo,observacion,c.estado ,
																								 d.nombre

																						FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																														 INNER JOIN escala_norton c on c.id_adm_hosp=b.id_adm_hosp
																														 INNER JOIN user d on d.id_user=c.id_user
												WHERE b.id_eps in ($eps) and b.id_sedes_ips in ($sede) and
															freg BETWEEN '$f1' and '$f2' and c.estado is null
												GROUP BY riesgo");
								while($res=mysql_fetch_array($sql)){
								?>
					['<?php echo $res['riesgo'].' ('.$res['cuantos']?>)', <?php echo $res['cuantos'] ?> ],
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
							text: 'CONSOLIDADO X JEFE'
					},
					subtitle: {
							text: 'Cantidad de pacientes agrupados por JEFE'
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
								$sql=mysql_query("SELECT a.tdoc_pac,COUNT(doc_pac) cuantos,nom_completo,TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad,
																								 c.freg fescala,hreg,total,riesgo,observacion,c.estado ,
																								 d.nombre

																						FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
																														 INNER JOIN escala_norton c on c.id_adm_hosp=b.id_adm_hosp
																														 INNER JOIN user d on d.id_user=c.id_user
												WHERE b.id_eps in ($eps) and b.id_sedes_ips in ($sede) and
															freg BETWEEN '$f1' and '$f2' and c.estado is null
												GROUP BY nombre");
								while($res=mysql_fetch_array($sql)){
								?>
					['<?php echo $res['nombre'].' ('.$res['cuantos']?>)', <?php echo $res['cuantos'] ?> ],
								<?php
								}
								?>
							]
					}]
			});
	});
	</script>


        <section class="modal fade" id="graficosnorton" role="dialog">
          <section class="modal-dialog modal-lg" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title alert alert-success">Consolidado de resultados Escala NORTON</h3>
              </div>
              <div class="modal-body">
                <section class="panel-body">
									<article class="col-md-6">
                    <div id="container" style="height: 300px"></div>
                  </article>
                  <article class="col-md-6">
                    <div id="container1" style="height: 300px"></div>
                  </article>
                </section>
              </div>
            </div>
          </section>
        </section>
