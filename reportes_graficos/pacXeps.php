<?php

				require_once("conexion/conexion.php");

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>SION Gráficas</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
#container {
	height: 400px;
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
		            text: 'Censo Pacientes por EPS'
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
	</head>
	<body>

<script src="charts/js/highcharts.js"></script>
<script src="charts/js/highcharts-3d.js"></script>
<script src="charts/js/modules/exporting.js"></script>

<div id="container" style="height: 400px"></div>
	</body>
</html>
