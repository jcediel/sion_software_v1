<?php
$l=$fila2['lunes'];
$ma=$fila2['martes'];
$mi=$fila2['miercoles'];
$ju=$fila2['jueves'];
$vi=$fila2['viernes'];
$sa=$fila2['sabado'];

$l_ma=$fila2['l_ma'];
$l_mi=$fila2['l_mi'];
$l_ju=$fila2['l_ju'];
$l_vi=$fila2['l_vi'];
$l_sa=$fila2['l_sa'];

$d_evaluar=$fila2['nom_dia'];
$d_dia=$fila2['dia'];

if ($dias > 0 && $dias <= $l) {
	if ($d_evaluar=='LU') {
	 echo'<th >
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
					<select class="form-group" required name="asistencia[]">
						<option values="S">S</option>
						<option values="N">N</option>
						<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'">
						<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'">
						<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'">
						<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
						<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
					</select>
	 			</th>';
 }
 if ($d_evaluar=='MA') {
	 echo'<th >
 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 				<select class="form-group" required name="asistencia[]">
 					<option values="N">N</option>
 					<option values="S">S</option>
 				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			 </th>';
 }
 if ($d_evaluar=='MI') {
	 echo'<th >
				 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
				 <select class="form-group" required name="asistencia[]">
					 <option values="N">N</option>
					 <option values="S">S</option>
				 </select>
				 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
				</th>';
 }
 if ($d_evaluar=='JU') {
	 echo'<th >
				 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
				 <select class="form-group" required name="asistencia[]">
					 <option values="N">N</option>
					 <option values="S">S</option>
				 </select>
				 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
				</th>';
 }
 if ($d_evaluar=='VI') {
	 echo'<th >
				 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
				 <select class="form-group" required name="asistencia[]">
					 <option values="N">N</option>
					 <option values="S">S</option>
				 </select>
				 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
				</th>';
 }
 if ($d_evaluar=='SA') {
	 echo'<th >
				 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
				 <select class="form-group" required name="asistencia[]">
					 <option values="N">N</option>
					 <option values="S">S</option>
				 </select>
				 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
				</th>';
 }
}

if ($dias > $l && $dias <= $l_ma) {
 if ($d_evaluar=='LU') {
	 echo'<th>
				 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
				 <select class="form-group" required name="asistencia[]">
					 <option values="S">S</option>
					 <option values="N">N</option>
				 </select>
				 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			</th>';
 }

 $dr=$fila2['miercoles'];
 $dt=$dias-$l;
 $d_dia=$fila2['dia'];


 if ($dt==3) {
	 if ($d_evaluar=='MA' && $d_dia==5) {
		 echo'<th>
					 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
					 <select class="form-group" required name="asistencia[]">
						 <option values="S">S</option>
						 <option values="N">N</option>
					 </select>
					 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
		 			</th>';
	 }
	 if ($d_evaluar=='MA' && $d_dia==12) {
		 echo'<th>
					 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
					 <select class="form-group" required name="asistencia[]">
						 <option values="S">S</option>
						 <option values="N">N</option>
					 </select>
					 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
		 			</th>';
	 }
	 if ($d_evaluar=='MA' && $d_dia==19) {
		 echo'<th>
					<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
					<select class="form-group" required name="asistencia[]">
						<option values="S">S</option>
						<option values="N">N</option>
					</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
				 </th>';
	 }
 }
 if ($dt==2) {
	 if ($d_evaluar=='MA' && $d_dia==5) {
		 echo'<th>
					<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
					<select class="form-group" required name="asistencia[]">
						<option values="S">S</option>
						<option values="N">N</option>
					</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
				 </th>';
	 }
	 if ($d_evaluar=='MA' && $d_dia==12) {
		 echo'<th>
					<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
					<select class="form-group" required name="asistencia[]">
						<option values="S">S</option>
						<option values="N">N</option>
					</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
				 </th>';
	 }
	 if ($d_evaluar=='MA' && $d_dia==19) {
		 echo'<th>
					<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
					<select class="form-group" required name="asistencia[]">
						<option values="N">N</option>
						<option values="S">S</option>
					</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
				 </th>';
	 }
 }
 if ($dt==1) {
	 if ($d_evaluar=='MA' && $d_dia==5) {
		 echo'<th>
					<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
					<select class="form-group" required name="asistencia[]">
						<option values="S">S</option>
						<option values="N">N</option>
					</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
				 </th>';
	 }
	 if ($d_evaluar=='MA' && $d_dia==12) {
		 echo'<th>
					<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
					<select class="form-group" required name="asistencia[]">
						<option values="N">N</option>
						<option values="S">S</option>
					</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
				 </th>';
	 }
	 if ($d_evaluar=='MA' && $d_dia==19) {
		 echo'<th>
					<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
					<select class="form-group" required name="asistencia[]">
						<option values="N">N</option>
						<option values="S">S</option>
					</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
				 </th>';
	 }
 }
 if ($d_evaluar=='MI') {
	 echo'<th>
				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
				<select class="form-group" required name="asistencia[]">
					<option values="N">N</option>
					<option values="S">S</option>
				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
			 </th>';
 }
 if ($d_evaluar=='JU') {
	 echo'<th>
 			 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 			 <select class="form-group" required name="asistencia[]">
 				 <option values="N">N</option>
 				 <option values="S">S</option>
 			 </select>
			 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
			 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
			 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
			 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
			 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			</th>';
 }
 if ($d_evaluar=='VI') {
	 echo'<th>
 			 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 			 <select class="form-group" required name="asistencia[]">
 				 <option values="N">N</option>
 				 <option values="S">S</option>
 			 </select>
			 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
			 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
			 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
			 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
			 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			</th>';
 }
 if ($d_evaluar=='SA') {
	 echo'<th>
 			 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 			 <select class="form-group" required name="asistencia[]">
 				 <option values="N">N</option>
 				 <option values="S">S</option>
 			 </select>
			 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
			 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
			 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
			 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
			 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			</th>';
 }
}

if ($dias > $l_ma && $dias <= $l_mi) {
	if ($d_evaluar=='LU') {
		echo'<th>
 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 				<select class="form-group" required name="asistencia[]">
 					<option values="S">S</option>
 					<option values="N">N</option>
 				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			 </th>';
 }
 if ($d_evaluar=='MA') {
	 echo'<th>
 			<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 			<select class="form-group" required name="asistencia[]">
 				<option values="S">S</option>
 				<option values="N">N</option>
 			</select>
			<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
			<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
			<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
			<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
			<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 		 </th>';
 }

 $dr=$fila2['miercoles'];
 $dt=$dias-$l_ma;
 $d_dia=$fila2['dia'];

 if ($dt==3) {
	 if ($d_evaluar=='MI' && $d_dia==6) {
		 echo'<th>
					<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
					<select class="form-group" required name="asistencia[]">
						<option values="S">S</option>
						<option values="N">N</option>
					</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
				 </th>';
	 }
	 if ($d_evaluar=='MI' && $d_dia==13) {
		 echo'<th>
					<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
					<select class="form-group" required name="asistencia[]">
						<option values="S">S</option>
						<option values="N">N</option>
					</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
				 </th>';
	 }
	 if ($d_evaluar=='MI' && $d_dia==20) {
		 echo'<th>
  				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
  				<select class="form-group" required name="asistencia[]">
  					<option values="S">S</option>
  					<option values="N">N</option>
  				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
  			 </th>';
	 }
 }
 if ($dt==2) {
	 if ($d_evaluar=='MI' && $d_dia==6) {
		 echo'<th>
					<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
					<select class="form-group" required name="asistencia[]">
						<option values="S">S</option>
						<option values="N">N</option>
					</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
				 </th>';
	 }
	 if ($d_evaluar=='MI' && $d_dia==13) {
		 echo'<th>
					<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
					<select class="form-group" required name="asistencia[]">
						<option values="S">S</option>
						<option values="N">N</option>
					</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
				 </th>';
	 }
	 if ($d_evaluar=='MI' && $d_dia==20) {
		 echo'<th>
  				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
  				<select class="form-group" required name="asistencia[]">
						<option values="N">N</option>
  					<option values="S">S</option>
  				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
  			 </th>';
	 }
 }
 if ($dt==1) {
	 if ($d_evaluar=='MI' && $d_dia==6) {
		 echo'<th>
					<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
					<select class="form-group" required name="asistencia[]">
						<option values="S">S</option>
						<option values="N">N</option>
					</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
				 </th>';
	 }
	 if ($d_evaluar=='MI' && $d_dia==13) {
		 echo'<th>
  				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
  				<select class="form-group" required name="asistencia[]">
						<option values="N">N</option>
  					<option values="S">S</option>
  				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
  			 </th>';
	 }
	 if ($d_evaluar=='MI' && $d_dia==20) {
		 echo'<th>
  				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
  				<select class="form-group" required name="asistencia[]">
						<option values="N">N</option>
  					<option values="S">S</option>
  				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
  			 </th>';
	 }
 }
 if ($d_evaluar=='JU') {
	 echo'<th>
 			 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 			 <select class="form-group" required name="asistencia[]">
 				 <option values="N">N</option>
 				 <option values="S">S</option>
 			 </select>
			 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
			 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
			 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
			 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
			 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			</th>';
 }
 if ($d_evaluar=='VI') {
	 echo'<th>
 			 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 			 <select class="form-group" required name="asistencia[]">
 				 <option values="N">N</option>
 				 <option values="S">S</option>
 			 </select>
			 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
			 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
			 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
			 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
			 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			</th>';
 }
 if ($d_evaluar=='SA') {
	 echo'<th>
 			 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 			 <select class="form-group" required name="asistencia[]">
 				 <option values="N">N</option>
 				 <option values="S">S</option>
 			 </select>
			 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
			 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
			 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
			 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
			 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			</th>';
 }
}

if ($dias > $l_mi && $dias <= $l_ju) {
	if ($d_evaluar=='LU') {
		echo'<th>
 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 				<select class="form-group" required name="asistencia[]">
 					<option values="S">S</option>
 					<option values="N">N</option>
 				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			 </th>';
	}
	if ($d_evaluar=='MA') {
		echo'<th>
 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 				<select class="form-group" required name="asistencia[]">
 					<option values="S">S</option>
 					<option values="N">N</option>
 				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			 </th>';
	}
	if ($d_evaluar=='MI') {
		echo'<th>
 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 				<select class="form-group" required name="asistencia[]">
 					<option values="S">S</option>
 					<option values="N">N</option>
 				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			 </th>';
	}

	$dr=$fila2['jueves'];
	$dt=$dias-$l_mi;
	$d_dia=$fila2['dia'];

	if ($dt==2) {
		if ($d_evaluar=='JU' && $d_dia==14) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="S">S</option>
	 					<option values="N">N</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
		if ($d_evaluar=='JU' && $d_dia==21) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="S">S</option>
	 					<option values="N">N</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
	}
	if ($dt==1) {
		if ($d_evaluar=='JU' && $d_dia==14) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="S">S</option>
	 					<option values="N">N</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
		if ($d_evaluar=='JU' && $d_dia==21) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="N">N</option>
	 					<option values="S">S</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
	}
	if ($d_evaluar=='VI') {
		echo'<th>
 			 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 			 <select class="form-group" required name="asistencia[]">
 				 <option values="N">N</option>
 				 <option values="S">S</option>
 			 </select>
			 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
			 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
			 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
			 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
			 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			</th>';
	}
	if ($d_evaluar=='SA') {
		echo'<th>
 			 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 			 <select class="form-group" required name="asistencia[]">
 				 <option values="N">N</option>
 				 <option values="S">S</option>
 			 </select>
			 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
			 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
			 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
			 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
			 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			</th>';
	}
}

if ($dias > $l_ju && $dias <= $l_vi) {
	if ($d_evaluar=='LU') {
		echo'<th>
				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
				<select class="form-group" required name="asistencia[]">
					<option values="S">S</option>
					<option values="N">N</option>
				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
			 </th>';
	}
	if ($d_evaluar=='MA') {
		echo'<th>
 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 				<select class="form-group" required name="asistencia[]">
 					<option values="S">S</option>
 					<option values="N">N</option>
 				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			 </th>';
	}
	if ($d_evaluar=='MI') {
		echo'<th>
 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 				<select class="form-group" required name="asistencia[]">
 					<option values="S">S</option>
 					<option values="N">N</option>
 				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			 </th>';
	}
	if ($d_evaluar=='JU') {
		echo'<th>
 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 				<select class="form-group" required name="asistencia[]">
 					<option values="S">S</option>
 					<option values="N">N</option>
 				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			 </th>';
	}

	$dr=$fila2['viernes'];
	$dt=$dias-$l_ju;
	$d_dia=$fila2['dia'];

	if ($dt==3) {
		if ($d_evaluar=='VI' && $d_dia==1) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="S">S</option>
	 					<option values="N">N</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
		if ($d_evaluar=='VI' && $d_dia==15) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="S">S</option>
	 					<option values="N">N</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
		if ($d_evaluar=='VI' && $d_dia==22) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="S">S</option>
	 					<option values="N">N</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
	}
	if ($dt==2) {
		if ($d_evaluar=='VI' && $d_dia==1) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="S">S</option>
	 					<option values="N">N</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
		if ($d_evaluar=='VI' && $d_dia==15) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="S">S</option>
	 					<option values="N">N</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
		if ($d_evaluar=='VI' && $d_dia==22) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="N">N</option>
	 					<option values="S">S</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
	}
	if ($dt==1) {
		if ($d_evaluar=='VI' && $d_dia==1) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="S">S</option>
	 					<option values="N">N</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
		if ($d_evaluar=='VI' && $d_dia==15) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="N">N</option>
	 					<option values="S">S</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
		if ($d_evaluar=='VI' && $d_dia==22) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="N">N</option>
	 					<option values="S">S</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
	}
	if ($d_evaluar=='SA') {
		echo'<th>
 			 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 			 <select class="form-group" required name="asistencia[]">
 				 <option values="N">N</option>
 				 <option values="S">S</option>
 			 </select>
			 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
			 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
			 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
			 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
			 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			</th>';
	}
}

if ($dias > $l_vi && $dias <= $l_sa) {
	if ($d_evaluar=='LU') {
		echo'<th>
 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 				<select class="form-group" required name="asistencia[]">
 					<option values="S">S</option>
 					<option values="N">N</option>
 				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			 </th>';
	}
	if ($d_evaluar=='MA') {
		echo'<th>
 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 				<select class="form-group" required name="asistencia[]">
 					<option values="S">S</option>
 					<option values="N">N</option>
 				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			 </th>';
	}
	if ($d_evaluar=='MI') {
		echo'<th>
 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 				<select class="form-group" required name="asistencia[]">
 					<option values="S">S</option>
 					<option values="N">N</option>
 				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			 </th>';
	}
	if ($d_evaluar=='JU') {
		echo'<th>
 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 				<select class="form-group" required name="asistencia[]">
 					<option values="S">S</option>
 					<option values="N">N</option>
 				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			 </th>';
	}
	if ($d_evaluar=='VI') {
		echo'<th>
 			 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 			 <select class="form-group" required name="asistencia[]">
 				 <option values="S">S</option>
 				 <option values="N">N</option>
 			 </select>
			 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
			 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
			 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
			 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
			 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			</th>';
	}

	$dr=$fila2['sabado'];
	$dt=$dias-$l_vi;
	$d_dia=$fila2['dia'];

	if ($dt==3) {
		if ($d_evaluar=='SA' && $d_dia==2) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="S">S</option>
	 					<option values="N">N</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
		if ($d_evaluar=='SA' && $d_dia==16) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="S">S</option>
	 					<option values="N">N</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
		if ($d_evaluar=='SA' && $d_dia==23) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="S">S</option>
	 					<option values="N">N</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
	}
	if ($dt==2) {
		if ($d_evaluar=='SA' && $d_dia==2) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="S">S</option>
	 					<option values="N">N</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
		if ($d_evaluar=='SA' && $d_dia==16) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="S">S</option>
	 					<option values="N">N</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
		if ($d_evaluar=='SA' && $d_dia==23) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="N">N</option>
	 					<option values="S">S</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
	}
	if ($dt==1) {
		if ($d_evaluar=='SA' && $d_dia==2) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="S">S</option>
	 					<option values="N">N</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
		if ($d_evaluar=='SA' && $d_dia==16) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="N">N</option>
	 					<option values="S">S</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
		if ($d_evaluar=='SA' && $d_dia==23) {
			echo'<th>
	 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
	 				<select class="form-group" required name="asistencia[]">
	 					<option values="N">N</option>
	 					<option values="S">S</option>
	 				</select>
					<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
					<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
					<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
					<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
					<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
	 			 </th>';
		}
	}

}

if ($dias > $l_sa) {
	if ($d_evaluar=='LU') {
		echo'<th>
 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 				<select class="form-group" required name="asistencia[]">
 					<option values="S">S</option>
 					<option values="N">N</option>
 				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			 </th>';
	}
	if ($d_evaluar=='MA') {
		echo'<th>
 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 				<select class="form-group" required name="asistencia[]">
 					<option values="S">S</option>
 					<option values="N">N</option>
 				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			 </th>';
	}
	if ($d_evaluar=='MI') {
		echo'<th>
 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 				<select class="form-group" required name="asistencia[]">
 					<option values="S">S</option>
 					<option values="N">N</option>
 				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			 </th>';
	}
	if ($d_evaluar=='JU') {
		echo'<th>
 				<small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 				<select class="form-group" required name="asistencia[]">
 					<option values="S">S</option>
 					<option values="N">N</option>
 				</select>
				<input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
				<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
				<input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
				<input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
				<input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			 </th>';
	}
	if ($d_evaluar=='VI') {
		echo'<th>
 			 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 			 <select class="form-group" required name="asistencia[]">
 				 <option values="S">S</option>
 				 <option values="N">N</option>
 			 </select>
			 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
			 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
			 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
			 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
			 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			</th>';
	}
	if ($d_evaluar=='SA') {
		echo'<th>
 			 <small class="text-info">'.$d_evaluar.'<br>'.$d_dia.'</small>
 			 <select class="form-group" required name="asistencia[]">
 				 <option values="S">S</option>
 				 <option values="N">N</option>
 			 </select>
			 <input type="hidden" class="form-control" required name="id_d_laboral[]" value="'.$fila2["id_d_laboral"].'" >
			 <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" >
			 <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
			 <input type="hidden" class="form-control" required name="nom_dia[]" value="'.$fila2["nom_dia"].'">
			 <input type="hidden" class="form-control" required name="num_dia[]" value="'.$fila2["dia"].'">
 			</th>';
	}


}
 ?>
