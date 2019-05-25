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
			case 'MED':
				$hoy=date('Y-m-d');
				$sql="INSERT INTO administracion_med_dom (id_adm_hosp, id_user,id_d_aut_dom, freg, hreg, medicamento,
					                                        via, frecuencia, dosis, obs_medicamento,estado_adm_med)
							VALUES ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["idd"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["medicamento"]."'
							,'".$_POST["via"]."','".$_POST["frecuencia"]."','".$_POST["dosis"]."','".$_POST["obs_medicamento"]."','Realizada')";
				$subtitulo="Medicamento Administrado";
			break;
			case 'SIG':
				$tam1=$_POST['tad_s'] * 2;
				$tam2=$tam1 + $_POST['tas_s'];
				$tamt=$tam2/3;
				$hoy=date('Y-m-d');
				$sql="INSERT INTO signos_vitales (id_adm_hosp,id_user,id_d_aut_dom,freg_sv,hreg_sv,tas_s,tad_s,tm_s,fc_s,fr_s,temp_s,spo_s,
																					glucometria,estado_sv,resp_sv,obs_signos)
				VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["idd"]."','".$_POST["freg_sv"]."','".$_POST["hreg_sv"]."','".$_POST["tas_s"]."',
					'".$_POST["tad_s"]."','$tamt','".$_POST["fc_s"]."','".$_POST["fr_s"]."','".$_POST["temp_s"]."','".$_POST["spo_s"]."',
					'".$_POST["glucometria"]."','Realizada','".$_SESSION["AUT"]["nombre"]."','".$_POST["obs_signos"]."')";
				$subtitulo="Signos registrados";
			break;
			case 'NE':
			$turno=$_POST['turno'];
			//echo $turno;
			if ($turno==3) { //para turno de 3 horas
				$fecha=$_POST['freg3'];
				$idadm=$_POST['idadmhosp'];
				$tipo=$_POST['tipo'];
				$turno=$_POST['turno'];
				$idd=$_POST['idd'];
				$intervalo=$_POST['temporalidad'];
				$sql_validacion="SELECT count(id_enf_dom3) cuantos,freg_reg FROM enferdom3 WHERE freg3='$fecha' and id_d_aut_dom=$idd and estado_nota='Realizada'";
				//echo $sql_validacion;
				if ($tabla_validacion=$bd1->sub_tuplas($sql_validacion)){
					foreach ($tabla_validacion as $fila_validacion) {
						$cuantos=$fila_validacion['cuantos'];
						if ($cuantos==0) {
							$f1=$_POST['v1'];
							$f2=$_POST['v2'];
							$fevaluar=$_POST['freg3'];

							if ($fevaluar <= $f1 || $fevaluar >= $f2) {
								$hini=$_POST['hnota'];

								$hnota2 = strtotime ( '+60 minute' , strtotime ( $hini ) ) ;
								$hnota2t=date('H:i', $hnota2);
								$hnota3 = strtotime ( '+120 minute' , strtotime ( $hini ) ) ;
								$hnota3t=date('H:i', $hnota3);
								$hoy=date('Y-m-d');
								$sql="INSERT INTO enferdom3 (id_adm_hosp, id_user,id_d_aut_dom, freg_reg,freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota)
								VALUES
								('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["idd"]."','$hoy',
								'".$_POST["freg3"]."','".$_POST["hnota"]."','".$_POST["nota1"]."','$hnota2t','".$_POST["nota2"]."','$hnota3t',
								'".$_POST["nota3"]."','Realizada')";
								$subtitulo="El formato de Nota de enfermería (Turno 3 horas) fue Adicionado con exito";
							}else {
								$sql="INSERT INTO enferdom12 (, id_user, freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota, tas, tad, fc, fr, t, spo,
									glasgow, eva) VALUES
								('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".date('Y-m-d')."',
								'".$_POST["freg3"]."','".$_POST["hnota1"]."','".$_POST["nota1"]."','".$_POST["hnota2"]."','".$_POST["nota2"]."','".$_POST["hnota3"]."','".$_POST["nota3"]."','Realizada'
								,'".$_POST["tas"]."','".$_POST["tad"]."','".$_POST["fc"]."','".$_POST["fr"]."','".$_POST["t"]."','".$_POST["sat"]."','".$_POST["glasgow"]."','".$_POST["eva"]."')";
								$subtitulo="No puede realizar notas si estan por fuera de las fechas de vigencia";
							}
						}else {
							$sql="INSERT INTO enferdom12 (, id_user, freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota, tas, tad, fc, fr, t, spo,
								glasgow, eva) VALUES
							('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".date('Y-m-d')."',
							'".$_POST["freg3"]."','".$_POST["hnota1"]."','".$_POST["nota1"]."','".$_POST["hnota2"]."','".$_POST["nota2"]."','".$_POST["hnota3"]."','".$_POST["nota3"]."','Realizada'
							,'".$_POST["tas"]."','".$_POST["tad"]."','".$_POST["fc"]."','".$_POST["fr"]."','".$_POST["t"]."','".$_POST["sat"]."','".$_POST["glasgow"]."','".$_POST["eva"]."')";
							$subtitulo="No puede realizar mas de 1 nota el mismo día, en el turno de 3 horas";
						}


					}
				}
			}// termina turno de 3 horas
			if ($turno==6) { //para turno de 6 horas
				$fecha=$_POST['freg3'];
				$idadm=$_POST['idadmhosp'];
				$tipo=$_POST['tipo'];
				$turno=$_POST['turno'];
				$idd=$_POST['idd'];
				$sql_validacion="SELECT count(id_enf_dom6) cuantos,freg_reg FROM enferdom6 WHERE freg6='$fecha' and id_d_aut_dom=$idd and estado_nota='Realizada'";
				//echo $sql_validacion;
				if ($tabla_validacion=$bd1->sub_tuplas($sql_validacion)){
					foreach ($tabla_validacion as $fila_validacion) {
						$cuantos=$fila_validacion['cuantos'];
						if ($cuantos==0) {
							$f1=$_POST['v1'];
							$f2=$_POST['v2'];
							$fevaluar=$_POST['freg3'];

							if ($fevaluar <= $f1 || $fevaluar >= $f2) {
								$hini=$_POST['hnota'];

								$hnota2 = strtotime ( '+60 minute' , strtotime ( $hini ) ) ;
								$hnota2t=date('H:i', $hnota2);
								$hnota3 = strtotime ( '+120 minute' , strtotime ( $hini ) ) ;
								$hnota3t=date('H:i', $hnota3);
								$hnota4 = strtotime ( '+180 minute' , strtotime ( $hini ) ) ;
								$hnota4t=date('H:i', $hnota4);
								$hnota5 = strtotime ( '+240 minute' , strtotime ( $hini ) ) ;
								$hnota5t=date('H:i', $hnota5);
								$hnota6 = strtotime ( '+300 minute' , strtotime ( $hini ) ) ;
								$hnota6t=date('H:i', $hnota6);

								$sql="INSERT INTO enferdom6 (id_adm_hosp, id_user, id_d_aut_dom, freg_reg, freg6, hnota1, nota1, hnota2, nota2, hnota3, nota3,hnota4, nota4, hnota5, nota5, hnota6, nota6, estado_nota) VALUES
								('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["idd"]."','".date('Y-m-d')."',
								'".$_POST["freg3"]."','$hini','".$_POST["nota1"]."','$hnota2t','".$_POST["nota2"]."','$hnota3t','".$_POST["nota3"]."'
								,'$hnota4t','".$_POST["nota4"]."','$hnota5t','".$_POST["nota5"]."','$hnota6t','".$_POST["nota6"]."','Realizada')";
								$subtitulo="El formato de Nota de enfermería (Turno 6 horas) fue Adicionado con exito";
							}else {
								$sql="INSERT INTO enferdom12 (, id_user, freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota, tas, tad, fc, fr, t, spo,
									glasgow, eva) VALUES
								('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".date('Y-m-d')."',
								'".$_POST["freg3"]."','".$_POST["hnota1"]."','".$_POST["nota1"]."','".$_POST["hnota2"]."','".$_POST["nota2"]."','".$_POST["hnota3"]."','".$_POST["nota3"]."','Realizada'
								,'".$_POST["tas"]."','".$_POST["tad"]."','".$_POST["fc"]."','".$_POST["fr"]."','".$_POST["t"]."','".$_POST["sat"]."','".$_POST["glasgow"]."','".$_POST["eva"]."')";
								$subtitulo="No puede realizar notas si estan por fuera de las fechas de vigencia";
							}
						}else {
							$sql="INSERT INTO enferdom12 (, id_user, freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota, tas, tad, fc, fr, t, spo,
								glasgow, eva) VALUES
							('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".date('Y-m-d')."',
							'".$_POST["freg3"]."','".$_POST["hnota1"]."','".$_POST["nota1"]."','".$_POST["hnota2"]."','".$_POST["nota2"]."','".$_POST["hnota3"]."','".$_POST["nota3"]."','Realizada'
							,'".$_POST["tas"]."','".$_POST["tad"]."','".$_POST["fc"]."','".$_POST["fr"]."','".$_POST["t"]."','".$_POST["sat"]."','".$_POST["glasgow"]."','".$_POST["eva"]."')";
							$subtitulo="No puede realizar mas de 1 nota el mismo día, en el turno de 6 horas";
						}


					}
				}
			}
			if ($turno==8) {//para turno de 8 horas
				$fecha=$_POST['freg3'];
				$idadm=$_POST['idadmhosp'];
				$tipo=$_POST['tipo'];
				$turno=$_POST['turno'];
				$idd=$_POST['idd'];
				$sql_validacion="SELECT count(id_enf_dom8) cuantos,freg_reg FROM enferdom8 WHERE freg8='$fecha' and id_d_aut_dom=$idd and estado_nota='Realizada'";
				//echo $sql_validacion;
				if ($tabla_validacion=$bd1->sub_tuplas($sql_validacion)){
					foreach ($tabla_validacion as $fila_validacion) {
						$cuantos=$fila_validacion['cuantos'];
						if ($cuantos==0) {
							$f1=$_POST['v1'];
							$f2=$_POST['v2'];
							$fevaluar=$_POST['freg3'];

							if ($fevaluar <= $f1 || $fevaluar >= $f2) {
								$hini=$_POST['hnota'];

								$hnota2 = strtotime ( '+60 minute' , strtotime ( $hini ) ) ;
								$hnota2t=date('H:i', $hnota2);
								$hnota3 = strtotime ( '+120 minute' , strtotime ( $hini ) ) ;
								$hnota3t=date('H:i', $hnota3);
								$hnota4 = strtotime ( '+180 minute' , strtotime ( $hini ) ) ;
								$hnota4t=date('H:i', $hnota4);
								$hnota5 = strtotime ( '+240 minute' , strtotime ( $hini ) ) ;
								$hnota5t=date('H:i', $hnota5);
								$hnota6 = strtotime ( '+300 minute' , strtotime ( $hini ) ) ;
								$hnota6t=date('H:i', $hnota6);
								$hnota7 = strtotime ( '+360 minute' , strtotime ( $hini ) ) ;
								$hnota7t=date('H:i', $hnota7);
								$hnota8 = strtotime ( '+420 minute' , strtotime ( $hini ) ) ;
								$hnota8t=date('H:i', $hnota8);

								$sql="INSERT INTO enferdom8 (id_adm_hosp, id_user, id_d_aut_dom, freg_reg, freg8, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4,
				          hnota5, nota5, hnota6, nota6, hnota7, nota7, hnota8, nota8, estado_nota) VALUES
									('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["idd"]."','".date('Y-m-d')."',
					        '".$_POST["freg3"]."','$hini','".$_POST["nota1"]."','$hnota2t','".$_POST["nota2"]."','$hnota3t','".$_POST["nota3"]."'
					        ,'$hnota4t','".$_POST["nota4"]."','$hnota5t','".$_POST["nota5"]."','$hnota6t','".$_POST["nota6"]."',
					        '$hnota7t','".$_POST["nota7"]."','$hnota8t','".$_POST["nota8"]."','Realizada')";
					        $subtitulo="El formato de Nota de enfermería (Turno 8 horas) fue Adicionado con exito";
							}else {
								$sql="INSERT INTO enferdom12 (, id_user, freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota, tas, tad, fc, fr, t, spo,
									glasgow, eva) VALUES
								('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".date('Y-m-d')."',
								'".$_POST["freg3"]."','".$_POST["hnota1"]."','".$_POST["nota1"]."','".$_POST["hnota2"]."','".$_POST["nota2"]."','".$_POST["hnota3"]."','".$_POST["nota3"]."','Realizada'
								,'".$_POST["tas"]."','".$_POST["tad"]."','".$_POST["fc"]."','".$_POST["fr"]."','".$_POST["t"]."','".$_POST["sat"]."','".$_POST["glasgow"]."','".$_POST["eva"]."')";
								$subtitulo="No puede realizar notas si estan por fuera de las fechas de vigencia";
							}
						}else {
							$sql="INSERT INTO enferdom12 (, id_user, freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota, tas, tad, fc, fr, t, spo,
								glasgow, eva) VALUES
							('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".date('Y-m-d')."',
							'".$_POST["freg3"]."','".$_POST["hnota1"]."','".$_POST["nota1"]."','".$_POST["hnota2"]."','".$_POST["nota2"]."','".$_POST["hnota3"]."','".$_POST["nota3"]."','Realizada'
							,'".$_POST["tas"]."','".$_POST["tad"]."','".$_POST["fc"]."','".$_POST["fr"]."','".$_POST["t"]."','".$_POST["sat"]."','".$_POST["glasgow"]."','".$_POST["eva"]."')";
							$subtitulo="No puede realizar mas de 1 nota el mismo día, en el turno de 8 horas";
						}


					}
				}
			}
			if ($turno==12) {//para turno de 12 horas
				$fecha=$_POST['freg3'];
				$idadm=$_POST['idadmhosp'];
				$tipo=$_POST['tipo'];
				$turno=$_POST['turno'];
				$idd=$_POST['idd'];
				$sql_validacion="SELECT count(id_enf_dom12) cuantos,freg_reg FROM enferdom12 WHERE freg12='$fecha' and id_d_aut_dom=$idd and estado_nota='Realizada'";
				//echo $sql_validacion;
				if ($tabla_validacion=$bd1->sub_tuplas($sql_validacion)){
					foreach ($tabla_validacion as $fila_validacion) {
						$cuantos=$fila_validacion['cuantos'];
						echo $cuantos;
						if ($cuantos == '0') {
							$f1=$_POST['v1'];
							$f2=$_POST['v2'];
							$fevaluar=$_POST['freg3'];

							if ($fevaluar <= $f1 || $fevaluar >= $f2) {
								$hini=$_POST['hnota'];

								$hnota2 = strtotime ( '+60 minute' , strtotime ( $hini ) ) ;
								$hnota2t=date('H:i', $hnota2);
								$hnota3 = strtotime ( '+120 minute' , strtotime ( $hini ) ) ;
								$hnota3t=date('H:i', $hnota3);
								$hnota4 = strtotime ( '+180 minute' , strtotime ( $hini ) ) ;
								$hnota4t=date('H:i', $hnota4);
								$hnota5 = strtotime ( '+240 minute' , strtotime ( $hini ) ) ;
								$hnota5t=date('H:i', $hnota5);
								$hnota6 = strtotime ( '+300 minute' , strtotime ( $hini ) ) ;
								$hnota6t=date('H:i', $hnota6);
								$hnota7 = strtotime ( '+360 minute' , strtotime ( $hini ) ) ;
								$hnota7t=date('H:i', $hnota7);
								$hnota8 = strtotime ( '+420 minute' , strtotime ( $hini ) ) ;
								$hnota8t=date('H:i', $hnota8);
								$hnota9 = strtotime ( '+480 minute' , strtotime ( $hini ) ) ;
								$hnota9t=date('H:i', $hnota9);
								$hnota10 = strtotime ( '+540 minute' , strtotime ( $hini ) ) ;
								$hnota10t=date('H:i', $hnota10);
								$hnota11 = strtotime ( '+600 minute' , strtotime ( $hini ) ) ;
								$hnota11t=date('H:i', $hnota11);
								$hnota12 = strtotime ( '+660 minute' , strtotime ( $hini ) ) ;
								$hnota12t=date('H:i', $hnota12);

								$sql="INSERT INTO enferdom12 (id_adm_hosp, id_user, id_d_aut_dom, freg_reg, freg12, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4,
									hnota5, nota5, hnota6, nota6, hnota7, nota7, hnota8, nota8, hnota9, nota9, hnota10, nota10, hnota11, nota11, hnota12, nota12,
									estado_nota) VALUES
								('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["idd"]."','".date('Y-m-d')."',
								'".$_POST["freg3"]."','$hini','".$_POST["nota1"]."','$hnota2t','".$_POST["nota2"]."','$hnota3t','".$_POST["nota3"]."'
								,'$hnota4t','".$_POST["nota4"]."','$hnota5t','".$_POST["nota5"]."','$hnota6t','".$_POST["nota6"]."',
								'$hnota7t','".$_POST["nota7"]."','$hnota8t','".$_POST["nota8"]."',
								'$hnota9t','".$_POST["nota9"]."','$hnota10t','".$_POST["nota10"]."','$hnota11t','".$_POST["nota11"]."'
								,'$hnota12t','".$_POST["nota12"]."','Realizada')";
								$subtitulo="El formato de Nota de enfermería (Turno 12 horas) fue Adicionado con exito";
							}else {
								$sql="INSERT INTO enferdom12 (, id_user,id_d_aut_dom, freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota, tas, tad, fc, fr, t, spo,
									glasgow, eva) VALUES
								('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["idd"]."','".date('Y-m-d')."',
								'".$_POST["freg3"]."','".$_POST["hnota1"]."','".$_POST["nota1"]."','".$_POST["hnota2"]."','".$_POST["nota2"]."','".$_POST["hnota3"]."','".$_POST["nota3"]."','Realizada'
								,'".$_POST["tas"]."','".$_POST["tad"]."','".$_POST["fc"]."','".$_POST["fr"]."','".$_POST["t"]."','".$_POST["sat"]."','".$_POST["glasgow"]."','".$_POST["eva"]."')";
								$subtitulo="1 No puede realizar notas si estan por fuera de las fechas de vigencia";
							}
						}else {
							$sql="INSERT INTO enferdom12 (, id_user,id_d_aut_dom, freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota, tas, tad, fc, fr, t, spo,
								glasgow, eva) VALUES
							('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["idd"]."','".date('Y-m-d')."',
							'".$_POST["freg3"]."','".$_POST["hnota1"]."','".$_POST["nota1"]."','".$_POST["hnota2"]."','".$_POST["nota2"]."','".$_POST["hnota3"]."','".$_POST["nota3"]."','Realizada'
							,'".$_POST["tas"]."','".$_POST["tad"]."','".$_POST["fc"]."','".$_POST["fr"]."','".$_POST["t"]."','".$_POST["sat"]."','".$_POST["glasgow"]."','".$_POST["eva"]."')";
							$subtitulo="2 No puede realizar más de 1() nota el mismo día, en el turno de 12 horas";
						}


					}
				}
			}
			if ($turno==24) {//para turno de 24 horas
				$fecha=$_POST['freg3'];
				$idadm=$_POST['idadmhosp'];
				$tipo=$_POST['tipo'];
				$turno=$_POST['turno'];
				$idd=$_POST['idd'];
				$sql_validacion="SELECT count(id_enf_dom12) cuantos,freg_reg FROM enferdom12 WHERE freg12='$fecha' and id_d_aut_dom=$idd and estado_nota='Realizada'";
				//echo $sql_validacion;
				if ($tabla_validacion=$bd1->sub_tuplas($sql_validacion)){
				  foreach ($tabla_validacion as $fila_validacion) {
						$cuantos=$fila_validacion['cuantos'];
						if ($cuantos==1  || $cuantos==0) {
							$f1=$_POST['v1'];
							$f2=$_POST['v2'];
							$fevaluar=$_POST['freg3'];

							if ($fevaluar <= $f1 || $fevaluar >= $f2) {
								$hini=$_POST['hnota'];

								$hnota2 = strtotime ( '+60 minute' , strtotime ( $hini ) ) ;
								$hnota2t=date('H:i', $hnota2);
								$hnota3 = strtotime ( '+120 minute' , strtotime ( $hini ) ) ;
								$hnota3t=date('H:i', $hnota3);
								$hnota4 = strtotime ( '+180 minute' , strtotime ( $hini ) ) ;
								$hnota4t=date('H:i', $hnota4);
								$hnota5 = strtotime ( '+240 minute' , strtotime ( $hini ) ) ;
								$hnota5t=date('H:i', $hnota5);
								$hnota6 = strtotime ( '+300 minute' , strtotime ( $hini ) ) ;
								$hnota6t=date('H:i', $hnota6);
								$hnota7 = strtotime ( '+360 minute' , strtotime ( $hini ) ) ;
								$hnota7t=date('H:i', $hnota7);
								$hnota8 = strtotime ( '+420 minute' , strtotime ( $hini ) ) ;
								$hnota8t=date('H:i', $hnota8);
								$hnota9 = strtotime ( '+480 minute' , strtotime ( $hini ) ) ;
								$hnota9t=date('H:i', $hnota9);
								$hnota10 = strtotime ( '+540 minute' , strtotime ( $hini ) ) ;
								$hnota10t=date('H:i', $hnota10);
								$hnota11 = strtotime ( '+600 minute' , strtotime ( $hini ) ) ;
								$hnota11t=date('H:i', $hnota11);
								$hnota12 = strtotime ( '+660 minute' , strtotime ( $hini ) ) ;
								$hnota12t=date('H:i', $hnota12);

								$sql="INSERT INTO enferdom12 (id_adm_hosp, id_user, id_d_aut_dom, freg_reg, freg12, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4,
									hnota5, nota5, hnota6, nota6, hnota7, nota7, hnota8, nota8, hnota9, nota9, hnota10, nota10, hnota11, nota11, hnota12, nota12,
									estado_nota,tipo_nota,intervalo_nota) VALUES
								('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["idd"]."','".date('Y-m-d')."',
								'".$_POST["freg3"]."','$hini','".$_POST["nota1"]."','$hnota2t','".$_POST["nota2"]."','$hnota3t','".$_POST["nota3"]."'
								,'$hnota4t','".$_POST["nota4"]."','$hnota5t','".$_POST["nota5"]."','$hnota6t','".$_POST["nota6"]."',
								'$hnota7t','".$_POST["nota7"]."','$hnota8t','".$_POST["nota8"]."',
								'$hnota9t','".$_POST["nota9"]."','$hnota10t','".$_POST["nota10"]."','$hnota11t','".$_POST["nota11"]."'
								,'$hnota12t','".$_POST["nota12"]."','Realizada','".$_POST["tipo"]."','".$_POST["turno"]."')";
								$subtitulo="El formato de Nota de enfermería (Turno 12 horas) fue Adicionado con exito";
							}else {
								$sql="INSERT INTO enferdom12 (, id_user, freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota, tas, tad, fc, fr, t, spo,
									glasgow, eva) VALUES
								('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".date('Y-m-d')."',
								'".$_POST["freg3"]."','".$_POST["hnota1"]."','".$_POST["nota1"]."','".$_POST["hnota2"]."','".$_POST["nota2"]."','".$_POST["hnota3"]."','".$_POST["nota3"]."','Realizada'
								,'".$_POST["tas"]."','".$_POST["tad"]."','".$_POST["fc"]."','".$_POST["fr"]."','".$_POST["t"]."','".$_POST["sat"]."','".$_POST["glasgow"]."','".$_POST["eva"]."')";
								$subtitulo="No puede realizar notas si estan por fuera de las fechas de vigencia";
							}
						}else {
							$sql="INSERT INTO enferdom12 (, id_user, freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota, tas, tad, fc, fr, t, spo,
								glasgow, eva) VALUES
							('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".date('Y-m-d')."',
							'".$_POST["freg3"]."','".$_POST["hnota1"]."','".$_POST["nota1"]."','".$_POST["hnota2"]."','".$_POST["nota2"]."','".$_POST["hnota3"]."','".$_POST["nota3"]."','Realizada'
							,'".$_POST["tas"]."','".$_POST["tad"]."','".$_POST["fc"]."','".$_POST["fr"]."','".$_POST["t"]."','".$_POST["sat"]."','".$_POST["glasgow"]."','".$_POST["eva"]."')";
							$subtitulo="No puede realizar mas de 2 notas en el turno de 24 horas";
						}


					}
				}
			}
			break;

		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="$subtitulo";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'NE':

      $sql="SELECT a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
                   b.id_presentacion_dom,tipo_paciente,
                   c.id_pprocedimiento,cups,frecuencia,jornada,cantidad,obs_cups,
                   d.descupsmin
            FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
                             LEFT JOIN presentacion_dom b on a.id_paciente=b.id_paciente
                             LEFT JOIN pprocedimiento c on b.id_presentacion_dom=c.id_presentacion_dom
                             LEFT JOIN cups d on d.codcups=c.cups
            WHERE a.id_adm_hosp='".$_REQUEST['idadmhosp']."'" ;
			$boton="Agregar Nota de Enfermeria";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$doc=$_REQUEST['doc'];
			$opcion=$_REQUEST['opcion'];
			$date=date('Y-m-d');
			$date1=date('H:i');
			$turno=$_REQUEST['turno'];
			if ($turno==3) {
				$titulo='Formato enfermeria turno 3 HORAS';
				$form1='formulariosDOM/enfermeria/nota3horas.php';
			}
			if ($turno==6) {
				$titulo='Formato enfermeria turno 6 HORAS';
				$form1='formulariosDOM/enfermeria/nota6horas.php';
			}
			if ($turno==8) {
				$titulo='Formato enfermeria turno 8 HORAS';
				$form1='formulariosDOM/enfermeria/nota8horas.php';
			}
			if ($turno==12) {
				$titulo='Formato enfermeria turno 12 HORAS';
				$form1='formulariosDOM/enfermeria/nota12horas.php';
			}
			if ($turno==24) {
				$titulo='Formato enfermeria turno 24 HORAS';
				$form1='formulariosDOM/enfermeria/nota12horas.php';
			}
		break;
		case 'MED':
		$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,
		email_pac,genero,lateralidad,religion,fotopac,
		b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
		j.nom_eps
		from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
								left join eps j on (j.id_eps=b.id_eps)
		where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
		$color="yellow";
		$boton="Agregar Medicamento";
		$atributo1=' readonly="readonly"';
		$atributo2='';
		$atributo3='disabled';
		$date=date('Y-m-d');
		$date1=date('H:i');
		$doc=$_REQUEST['doc'];
		$opcion=$_REQUEST['opcion'];
		$form1='formulariosDOM/enfermeria/medicamentos.php';
		$subtitulo='';
		break;
		case 'SIG':
		$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,
		email_pac,genero,lateralidad,religion,fotopac,
		b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
		j.nom_eps
		from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
								left join eps j on (j.id_eps=b.id_eps)
		where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
		$color="yellow";
		$boton="Agregar Signos vitales";
		$atributo1=' readonly="readonly"';
		$atributo2='';
		$atributo3='disabled';
		$date=date('Y-m-d');
		$date1=date('H:i');
		$doc=$_REQUEST['doc'];
		$opcion=$_REQUEST['opcion'];
		$form1='formulariosDOM/enfermeria/signos.php';
		$subtitulo='';
		break;
		}
			//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"",
        "tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"",
        "fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id_sedes_ips"=>"",
        "id_presentacion_dom"=>"","tipo_paciente"=>"",
        "id_pprocedimiento"=>"","cups"=>"","frecuencia"=>"","jornada"=>"","cantidad"=>"","obs_cups"=>"",
        "descupsmin"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"",
        "tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"",
        "fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id_sedes_ips"=>"",
        "id_presentacion_dom"=>"","tipo_paciente"=>"",
        "id_pprocedimiento"=>"","cups"=>"","frecuencia"=>"","jornada"=>"","cantidad"=>"","obs_cups"=>"",
        "descupsmin"=>"");
			}

		?>


		<?php include($form1);?>

<?php
}else{
if ($check=='si') {
	echo'<section>';
	echo '<script>swal("EXCELENTE !!! '.$subtitulo.'","","success")</script>';
	echo'</section>';
}if ($check=='no') {
	echo'<section>';
	echo '<script>swal("DEBES REVISAR EL PROCESO !!! '.$subtitulo.'","","error")</script>';
	echo'</section>';
}
// nivel 1?>
<section class="panel panel-default">
<section class="panel-heading"><h4>Seguimiento a procedimientos Domiciliarios</h4></section>
	<section class="panel-body">
			<section class="col-md-12">
				<form>
					<article class="col-md-3">
            <label for="">Seleccione tipo de paciente:</label>
            <select class="form-control" name="tpac">
              <option value="1,2,3,4">Todas</option>
              <?php
		          $sql="SELECT id_cusuario,nomclaseusuario from clase_usuario ";
		          if($tabla=$bd1->sub_tuplas($sql)){
		            foreach ($tabla as $fila2) {
		              if ($fila["id_cusuario"]==$fila2["id_cusuario"]){
		                $sw=' selected="selected"';
		              }else{
		                $sw="";
		              }
		            echo '<option value="'.$fila2["id_cusuario"].'"'.$sw.'>'.$fila2["nomclaseusuario"].'</option>';
		            }
		          }
		          ?>
            </select>
          </article>
          <article class="col-md-3">
            <label for="">Seleccione EPS:</label>
            <select class="form-control" name="eps">
              <option value="12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27">Todas</option>
              <?php
		          $sql="SELECT id_eps,nom_eps from eps ";
		          if($tabla=$bd1->sub_tuplas($sql)){
		            foreach ($tabla as $fila2) {
		              if ($fila["id_eps"]==$fila2["id_eps"]){
		                $sw=' selected="selected"';
		              }else{
		                $sw="";
		              }
		            echo '<option value="'.$fila2["id_eps"].'"'.$sw.'>'.$fila2["nom_eps"].'</option>';
		            }
		          }
		          ?>
            </select>
          </article>
					<article class="col-md-3">
            <label for="">Filtro por documento:</label>
            <input type="text" class="form-control" name="doc" value="">
          </article>
          <article class="col-md-4">
            <input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
            <input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
          </article>
				</form>
			</section>
	</section>
	<section class="panel-body">
	<table class="table table-bordered table-responsive">
		<tr>
			<th class="info">PACIENTE</th>
			<th class="info">PLAN DE INTERVENCION</th>
		</tr>
		<?php
		$eps=$_REQUEST["eps"];
    $tpac=$_REQUEST["tpac"];
		$doc=$_REQUEST['doc'];
		if ($doc!='') {
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,
									 s.id_sedes_ips,nom_sedes,
									 e.nom_eps,
									 d.id_m_aut_dom,freg, tipo_paciente, zona_paciente, ips_ordena,
									 medico_ordena, nom_paquete, cdx_presentacion, dx_presentacion, estado_p_principal

						FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
														 INNER JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
														 INNER JOIN eps e on a.id_eps=e.id_eps
														 INNER JOIN m_aut_dom d on a.id_adm_hosp=d.id_adm_hosp

						WHERE a.estado_adm_hosp='Activo'and p.doc_pac='$doc'
						and tipo_servicio='Domiciliarios' and estado_p_principal='1'  ORDER BY estado_p_principal,freg DESC ";
		}else {
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,
									 s.id_sedes_ips,nom_sedes,
									 e.nom_eps,
									 d.id_m_aut_dom,freg, tipo_paciente, zona_paciente, ips_ordena,
									 medico_ordena, nom_paquete, cdx_presentacion, dx_presentacion, estado_p_principal

						FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
														 INNER JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
														 INNER JOIN eps e on a.id_eps=e.id_eps
														 INNER JOIN m_aut_dom d on a.id_adm_hosp=d.id_adm_hosp

						WHERE a.estado_adm_hosp='Activo'and a.id_eps in ($eps) and d.tipo_paciente in ($tpac)
						and tipo_servicio='Domiciliarios' and estado_p_principal='1' ORDER BY estado_p_principal,freg DESC ";
		}

    //echo $sql;
		if ($tabla=$bd1->sub_tuplas($sql)){
			foreach ($tabla as $fila) {

				echo"<tr >	\n";
				echo'<td>';
				echo'<p><strong>NOMBRE: </strong> '.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>IDENTIFICACIÓN: </strong> '.$fila["tdoc_pac"].' '.$fila["doc_pac"].'</p>
							<p><strong>ADM: </strong> '.$fila["id_adm_hosp"].' </p>';
				echo'</td>';
        echo'<td>
							<section class="panel-body">';
							echo'<article class="col-md-6">
										<p><strong>ID:</strong> '.$fila['id_m_aut_dom'].'</p>
			             	<p><strong>Fecha Registro:</strong> '.$fila['freg'].'</p>
			             	<p><strong>DX:</strong> '.$fila['dx_presentacion'].'</p>
			             	<p><strong>Paquete?:</strong> '.$fila['nom_paquete'].'</p>';
							echo'</article>';
							echo'<article class="col-md-6">';
										$ep=$fila['estado_p_principal'];
										if ($ep==1) {
											echo'<p class="alert alert-info middle-text">Este Plan se encuentra ACTIVO</p>';
										}
										if ($ep==2) {
											echo'<p class="alert alert-danger middle-text">Este Plan se encuentra INACTIVO</p>';
										}
							echo'</article>';
							echo'<article class="col-md-12">
										<button class="btn btn-primary" data-toggle="collapse" data-target="#procedimientos_'.$fila['id_m_aut_dom'].'">
											Consulte los procedimientos activos del paciente <span
										</button>';
							echo'</article>';
        echo'</section>';
			  echo'<section class="panel-body">
							<section id="procedimientos_'.$fila['id_m_aut_dom'].'" class="collapse">';
							$idm=$fila['id_m_aut_dom'];
							$sql_procedimeinto="SELECT id_d_aut_dom, freg, cups, procedimiento,
																			 cantidad,intervalo,temporalidad, finicio, ffinal, num_aut_externa, estado_d_aut_dom
																FROM d_aut_dom
																WHERE id_m_aut_dom=$idm order by freg DESC";
																					//echo $sql_m;
							if ($tabla_procedimeinto=$bd1->sub_tuplas($sql_procedimeinto)){
								foreach ($tabla_procedimeinto as $fila_procedimeinto) {
									echo '<p>'.$fila_procedimeinto['procedimiento'].'</p>';
									$fecha=date('Y-m-d');
									$hora=date('H:i');
									echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#pprocedimiento_'.$fila_procedimeinto['id_d_aut_dom'].'"> Agregar Bitacora</button></p>
									<div id="pprocedimiento_'.$fila_procedimeinto['id_d_aut_dom'].'" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Registro y consulta de bitacora</h4>
												</div>
												<div class="modal-body">
												<form action="Funcion_base/add_bitacora_prod.php" method="POST">
													<section class="panel-body">
														<article class="col-md-6">
															<p><strong>Procedimiento: </strong>'.$fila_procedimeinto['procedimiento'].'</p>
															<p><strong>Cantidad: </strong>'.$fila_procedimeinto['cantidad'].'</p>
															<p><strong>Vigencia: </strong>'.$fila_procedimeinto['finicio'].' - '.$fila_procedimeinto['ffinal'].'</p>
														</article>';
														$idd=$fila_procedimeinto['id_d_aut_dom'];
														$sql_prof="SELECT a.id_prof_d_dom,a.id_d_aut_dom idd, a.profesional prof, estado_profesional, user_cancela,
																							b.id_d_aut_dom,
																							c.nombre,tel_user
																		FROM profesional_d_dom a INNER JOIN d_aut_dom b on a.id_d_aut_dom=b.id_d_aut_dom
																														 INNER JOIN user c on c.id_user=a.profesional
																		WHERE a.id_d_aut_dom=$idd and a.estado_profesional=1";
																		//echo $sql_prof;
																		if ($tabla_prof=$bd1->sub_tuplas($sql_prof)){
																			foreach ($tabla_prof as $fila_prof) {
																				echo'<p><strong>Profesional: </strong>'.$fila_prof['nombre'].' TEL:'.$fila_prof['tel_user'].'<br>';
																			}
																		}else {
																			echo'	<p>No tiene profesional asignado</p>';
																		}
													echo'</section>
													<section class="panel-body">
														<article class="col-md-12">
															<label>Procedimiento está en cumplimiento?:</label>
															<select class="form-control" name="calificacion">
																<option values="SI">SI</option>
																<option values="NO">NO</option>
															</select>
														</article>
														<article class="col-md-12">
															<label>Observación:</label>
															<textarea class="form-control" name="descripcion"></textarea>

															<input type="hidden" name="freg" value="'.$fecha.'">
															<input type="hidden" name="id_user" value="'.$_SESSION['AUT']['id_user'].'">
															<input type="hidden" name="id_d_aut_dom" value="'.$fila_procedimeinto['id_d_aut_dom'].'">
															<input type="hidden" name="tpac" value="'.$_GET['tpac'].'">
															<input type="hidden" name="eps" value="'.$_GET['eps'].'">
															</select>
														</article>
													</section>
													<section class="panel-body">
														<article class="col-md-12">
															<input type="submit" value="Guardar">
														</article>
													</section>

												</form>';
												$pac=$fila_procedimeinto['id_d_aut_dom'];
												$sql_prodcall="SELECT a.id_bit_pro_call, a.id_d_aut_dom, a.resp_bitacora, a.freg, a.calificacion, a.descripcion,
																							b.nombre
																			FROM bitacora_prod_call a inner join user b on b.id_user=a.resp_bitacora
																			WHERE a.id_d_aut_dom=$pac";
																			if ($tabla_prodcall=$bd1->sub_tuplas($sql_prodcall)){
																				 foreach ($tabla_prodcall as $fila_prodcall) {
																					 $cal=$fila_prodcall['calificacion'];
																					 if ($cal=='SI') {
																						 echo'<section class="panel-body alert alert-info">
																						 				<article class="col-md-12">
																											<p><strong>Fecha : </strong>'.$fila_prodcall['freg'].'</p>
																											<p><strong>Calificación : </strong>'.$fila_prodcall['calificacion'].'</p>
																						 					<p><strong>Observacion: </strong>'.$fila_prodcall['descripcion'].'</p>
																											<p><strong>Quien registro: </strong>'.$fila_prodcall['nombre'].'</p>
																										</article>
																									</section>';
																					 }
																					 if ($cal=='NO') {
																						 echo'<section class="panel-body alert alert-danger">
																						 				<article class="col-md-12">
																											<p><strong>Fecha : </strong>'.$fila_prodcall['freg'].'</p>
																											<p><strong>Calificación : </strong>'.$fila_prodcall['calificacion'].'</p>
																						 					<p><strong>Observacion: </strong>'.$fila_prodcall['descripcion'].'</p>
																											<p><strong>Quien registro: </strong>'.$fila_prodcall['nombre'].'</p>
																										</article>
																									</section>';
																					 }

																				 }
																			}
												echo'</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
												</div>
											</div>

										</div>
									</div>';
								}
							}
				echo'</section>
					</section>';
				echo'</td>';
				echo "</tr>\n";
			}
		}
		?>
	</table>
	</section>
</section>
		<?php
	}
	?>
