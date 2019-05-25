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
			$d_procedimiento=$_GET['idd'];
      $sql="SELECT id_d_aut_dom, id_m_aut_dom, resp_d_aut_dom, freg, cups,
										procedimiento, cantidad, finicio, ffinal, num_aut_externa,
										resp_inicial_num, estado_d_aut_dom, intervalo, temporalidad,
										dosis, frecuencia, succion, profesional, f_prof, f_cancela,
										resp_cancela, justificacion_cancela, resp_ext, justificacion_ext
            FROM d_aut_dom
            WHERE id_d_aut_dom=$d_procedimiento" ;
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
				//$form1='formulariosDOM/enfermeria/problemas.php';
			}
			if ($turno==24) {
				$titulo='Formato enfermeria turno 24 HORAS';
				$form1='formulariosDOM/enfermeria/nota12horas.php';
				//$form1='formulariosDOM/enfermeria/problemas.php';
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
        "id_presentacion_dom"=>"","tipo_paciente"=>"","finicio"=>"","ffinal"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"",
        "tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"",
        "fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id_sedes_ips"=>"",
        "id_presentacion_dom"=>"","tipo_paciente"=>"","finicio"=>"","ffinal"=>"");
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
<section class="panel-heading"><h4>Auxiliares de enfermería en servicios domiciliarios</h4></section>
	<section class="panel-body">
		<section class="panel-body">
			<section class="col-md-4">
				<form>
					<div class="row">
						<div class="col-lg-12">
							<div class="input-group">
								<input type="text" class="form-control" name="doc" placeholder="Digite identificación">
								<span class="input-group-btn">
										<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
										<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
								</span>
							</div><!-- /input-group -->
						</div><!-- /.col-lg-6 -->
					</div>
				</form>
				<br>
				<form>
					<div class="row">
						<div class="col-lg-12">
							<div class="input-group">
								<input type="text" class="form-control" name="nom" placeholder="Digite nombre o apellidos">
								<span class="input-group-btn">
										<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
										<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
								</span>
							</div><!-- /input-group -->
						</div><!-- /.col-lg-6 -->
					</div>
				</form>
			</section>

			</section>
	</section>
	<section class="panel-body">
	<table class="table table-bordered table-responsive">
		<tr>
			<th class="info">PACIENTE</th>
			<th class="info">ADMISION</th>
			<th class="info">AUTORIZACION</th>
			<th class="info" colspan="4">ACCION</th>
		</tr>

		<?php
		if (isset($_REQUEST["doc"])){
		$doc=$_REQUEST["doc"];
		$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
                 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,estado_salida,
                 s.id_sedes_ips,nom_sedes,
								 e.nom_eps

          FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
                           INNER JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
													 INNER JOIN eps e on a.id_eps=e.id_eps

          WHERE p.doc_pac='".$doc."' and a.estado_adm_hosp='Activo' and tipo_servicio='Domiciliarios'";
    //echo $sql;
		if ($tabla=$bd1->sub_tuplas($sql)){
			foreach ($tabla as $fila) {
				echo"<tr >	\n";
				echo'<td class="text-center">
							<p><strong>NOMBRE: </strong> '.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>IDENTIFICACIÓN: </strong> '.$fila["tdoc_pac"].' '.$fila["doc_pac"].'</p>
							<p><strong>ADM: </strong> '.$fila["id_adm_hosp"].' </p>
						 </td>';
				echo'<td class="text-left">
							<p><strong>FECHA INGRESO: </strong> '.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].' </p>
							<p><strong>SEDE: </strong> '.$fila["nom_sedes"].'</p>
							<p><strong>EPS: </strong> '.$fila["nom_eps"].'</p>
						 </td>';
						 $estado_salida=$fila['estado_salida'];
						 if ($estado_salida=='Fallecimiento') {
						 	echo '<td><p class="alert alert-dom"><span class="fa fa-skull-crossbones"></span>Paciente Fallecido</p></td>';
						 }
						 if ($estado_salida=='Hospitalizado') {
						 	echo '<td><p class="alert alert-dom"><span class="fa fa-procedures"></span>Paciente Hospitalizado</p></td>';
						 }
						 if ($estado_salida=='') {
							 $adm=$fila['id_adm_hosp'];
							 $hoy=date('Y-m-d');
							 $profesional=$_SESSION['AUT']['id_user'];
							 $sql_detalle="SELECT a.id_m_aut_dom, id_adm_hosp, zona_paciente,cdx_presentacion,dx_presentacion,
							 										 b.id_d_aut_dom, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa,
																	 estado_d_aut_dom, intervalo, temporalidad, profesional, f_prof,
							 										 c.nomclaseusuario
							 							FROM m_aut_dom a INNER JOIN d_aut_dom b on a.id_m_aut_dom=b.id_m_aut_dom
							 															 INNER JOIN clase_usuario c on a.tipo_paciente=c.id_cusuario
							 							WHERE a.id_adm_hosp=$adm and b.estado_d_aut_dom in (1,2) and b.cups in ('890105','F890121','F890122','F890123','F890124','F890125')";
							 //echo $sql_detalle;
							 if ($tabla_detalle=$bd1->sub_tuplas($sql_detalle)){
							 	foreach ($tabla_detalle as $fila_detalle) {
							 		$hoy=date('Y-m-d');
							 		$fini=$fila_detalle['finicio'];
							 		$ffin=$fila_detalle['ffinal'];
									//validar si ya completo la orden por cantidades
									$id_vcant=$fila_detalle['id_d_aut_dom'];
									$turno=$fila_detalle['intervalo'];
									$cups=$fila_detalle['cups'];
									include('formulariosDOM/autorizacion/validar_turno_intervalo.php');
							 	}
							 }else {
							 	echo'<th class="text-center">
							 				<p>El paciente no tiene servicios autorizados para Enfermería</p>
							 			 </th>';
							 }
						 }

				echo "</tr>\n";
			}
		}
	}// fin filtro por documento

	if (isset($_REQUEST["nom"])){
		$doc=$_REQUEST["nom"];
		$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
                 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,estado_salida,
                 s.id_sedes_ips,nom_sedes,
								 e.nom_eps

          FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
                           INNER JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
													 INNER JOIN eps e on a.id_eps=e.id_eps

          WHERE p.nom_completo LIKE '%".$doc."%' and a.estado_adm_hosp='Activo' and tipo_servicio='Domiciliarios'";

		if ($tabla=$bd1->sub_tuplas($sql)){
			foreach ($tabla as $fila ) {
				echo"<tr >	\n";
				echo'<td class="text-center">
							<p><strong>NOMBRE: </strong> '.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>IDENTIFICACIÓN: </strong> '.$fila["tdoc_pac"].' '.$fila["doc_pac"].'</p>
							<p><strong>ADM: </strong> '.$fila["id_adm_hosp"].' </p>
						 </td>';
				echo'<td class="text-left">
							<p><strong>FECHA INGRESO: </strong> '.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].' </p>
							<p><strong>SEDE: </strong> '.$fila["nom_sedes"].'</p>
							<p><strong>EPS: </strong> '.$fila["nom_eps"].'</p>
						 </td>';
						 $estado_salida=$fila['estado_salida'];
						 if ($estado_salida=='Fallecimiento') {
						 	echo '<td><p class="alert alert-dom"><span class="fa fa-skull-crossbones"></span>Paciente Fallecido</p></td>';
						 }
						 if ($estado_salida=='Hospitalizado') {
						 	echo '<td><p class="alert alert-dom"><span class="fa fa-procedures"></span>Paciente Hospitalizado</p></td>';
						 }
						 if ($estado_salida=='') {
							 $adm=$fila['id_adm_hosp'];
							 $hoy=date('Y-m-d');
							 $profesional=$_SESSION['AUT']['id_user'];
							 $sql_detalle="SELECT a.id_m_aut_dom, id_adm_hosp, zona_paciente,cdx_presentacion,dx_presentacion,
							 										 b.id_d_aut_dom, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa,
																	 estado_d_aut_dom, intervalo, temporalidad, profesional, f_prof,
							 										 c.nomclaseusuario
							 							FROM m_aut_dom a INNER JOIN d_aut_dom b on a.id_m_aut_dom=b.id_m_aut_dom
							 															 INNER JOIN clase_usuario c on a.tipo_paciente=c.id_cusuario
							 							WHERE a.id_adm_hosp=$adm and b.estado_d_aut_dom in (1,2) and b.cups in ('890105','F890121','F890122','F890123','F890124','F890125')";
							 //echo $sql_detalle;
							 if ($tabla_detalle=$bd1->sub_tuplas($sql_detalle)){
							 	foreach ($tabla_detalle as $fila_detalle) {
							 		$hoy=date('Y-m-d');
							 		$fini=$fila_detalle['finicio'];
							 		$ffin=$fila_detalle['ffinal'];
									//validar si ya completo la orden por cantidades
									$id_vcant=$fila_detalle['id_d_aut_dom'];
									$turno=$fila_detalle['intervalo'];
									$cups=$fila_detalle['cups'];
									include('formulariosDOM/autorizacion/validar_turno_intervalo.php');
							 	}
							 }else {
							 	echo'<th class="text-center">
							 				<p>El paciente no tiene servicios autorizados para Enfermería</p>
							 			 </th>';
							 }
						 }

				echo "</tr>\n";
			}
		}
	}
		?>

	</table>


	</section>
</section>
		<?php
	}
	?>
