<table class="table table-bordered alert alert-info">
	<tr>
		<th class="text-center">TOTAL GENERAL</th>
		<th class="text-center">CONSOLIDADO X ESPECIALIDAD</th>
		<th class="text-center">CONSOLIDADO X CALIFICACION</th>
	</tr>
	<tr>
		<td class="text-center">
			<?php
			$cuestion=$fila_validar_cuestionario['id_cuestionario'];
			$sql_countT="SELECT COUNT(a.id_rta_cuestionario) cuanto, id_cuestionario, freg_rta, hreg_rta, resp_contesta, rta1, rta2, rta3, rta4, rta5,
																														 b.nombre,id_perfil,especialidad
									 FROM respuesta_cuestionario a INNER JOIN user b on a.resp_contesta=b.id_user
									 WHERE a.id_cuestionario=$cuestion";
			if ($tabla_countT=$bd1->sub_tuplas($sql_countT)){
				foreach ($tabla_countT as $fila_countT) {
					echo'<h2><strong>'.$fila_countT['cuanto'].'</strong></h2>';
				}
			}
			 ?>
		</td>
		<td class="text-center">
			<?php
			$cuestion=$fila_validar_cuestionario['id_cuestionario'];
			$sql_count1="SELECT COUNT(a.id_rta_cuestionario) cuanto, id_cuestionario, freg_rta, hreg_rta, resp_contesta, rta1, rta2, rta3, rta4, rta5,
																														 b.nombre,id_perfil,especialidad
									 FROM respuesta_cuestionario a INNER JOIN user b on a.resp_contesta=b.id_user
									 WHERE a.id_cuestionario=$cuestion
																											GROUP by especialidad";
			if ($tabla_count1=$bd1->sub_tuplas($sql_count1)){
				foreach ($tabla_count1 as $fila_count1) {
					echo'<p><strong>'.$fila_count1['especialidad'].':</strong> <span class="lead">'.$fila_count1['cuanto'].'</span></p>';
				}
			}
			 ?>
		</td>
		<td class="text-center">
			<?php
			$cuestion=$fila_validar_cuestionario['id_cuestionario'];
			$sql_count2="SELECT count(a.id_rta_cuestionario) cuantos, id_cuestionario, freg_rta, hreg_rta, resp_contesta, (rta1 + rta2 + rta3 + rta4 + rta5) as total,
			                    b.nombre,id_perfil,especialidad
									 FROM respuesta_cuestionario a INNER JOIN user b on a.resp_contesta=b.id_user
									 WHERE a.id_cuestionario=$cuestion group by total";
			if ($tabla_count2=$bd1->sub_tuplas($sql_count2)){
				foreach ($tabla_count2 as $fila_count2) {
					$t=$fila_count2['total'];
					if ($t==0) {
						echo'<p><strong>MALO:</strong> <span class="lead">'.$fila_count2['cuantos'].'</span></p>';
					}
					if ($t==1) {
						echo'<p><strong>INSUFICIENTE:</strong> <span class="lead">'.$fila_count2['cuantos'].'</span></p>';
					}
					if ($t==2) {
						echo'<p><strong>REGULAR:</strong> <span class="lead">'.$fila_count2['cuantos'].'</span></p>';
					}
					if ($t==3) {
						echo'<p><strong>BUENO:</strong> <span class="lead">'.$fila_count2['cuantos'].'</span></p>';
					}
					if ($t==4) {
						echo'<p><strong>MUY BUENO:</strong> <span class="lead">'.$fila_count2['cuantos'].'</span></p>';
					}
					if ($t==5) {
						echo'<p><strong>EXCELENTE:</strong> <span class="lead">'.$fila_count2['cuantos'].'</span></p>';
					}
				}
			}
			 ?>
		</td>
	</tr>
</table>
