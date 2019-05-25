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
			$docE="";$docA1="";$docA2="";
			if (isset($_FILES["foto"])){
				if (is_uploaded_file($_FILES["foto"]["tmp_name"])){
					$cfoto=explode(".",$_FILES["foto"]["name"]);
					$archivo=$_POST["nomdoc"].".".$cfoto[count($cfoto)-1];
					if(move_uploaded_file($_FILES["foto"]["tmp_name"],WEB.DOCPAC.$archivo)){
						$docE=",foto='".DOCPAC.$archivo."'";
						$docA=',foto';
						$docb=",'".DOCPAC.$archivo."'";
						}
				}
			}

			switch ($_POST["operacion"]) {
				case 'ADDPROFESIONAL':
				include "phpmailer/class.phpmailer.php";
				include "phpmailer/class.smtp.php";
					$idp=$_POST['profesional'];

					$sql_email="SELECT email FROM user WHERE id_user=$idp";
					if ($tabla_email=$bd1->sub_tuplas($sql_email)){
						foreach ($tabla_email as $fila_email) {
							$mail_profesional=$fila_email['email'];

							$eps=$_POST['eps'];
							if ($eps==13) {
								$mail1="terapiasdomsanitas@emmanuelips.co";

								$mail3=$mail_profesional;

								$asunto='Presentación servicios domiciliarios: '.$_POST['nom'];
								$paciente=$_POST['nom'];
								$doc=$_POST['doc_pac'];
								$dir_pac=$_POST['dir'];
								$tel_pac=$_POST['tel'];
								$barrio=$_POST['barrio'];
								$cuidador=$_POST['nom_acu'];
								$dir_acu=$_POST['dir_acu'];
								$tel_acu=$_POST['tel_acu'];
								$procedimiento=$_POST['cups'].' | '.$_POST['procedimiento'];
								$sesiones=$_POST['sesion_asignada'];
								$atencion=$_POST['atencion'];
								$email_user = "terapiasdomsanitas@emmanuelips.co";
								$email_password = "Emmanuel_12345";
								$the_subject = $asunto;
								$prueba1="analistadeterapias@emmanuelips.co";

								$address_to = $mail1;

								$address_to3= $mail3;

								$from_name = "SERVICIO DOMICILIARIO EMMANUEL IPS";
								$phpmailer = new PHPMailer();
								// ---------- datos de la cuenta de Gmail -------------------------------
								$phpmailer->Username = $email_user;
								$phpmailer->Password = $email_password;
								//-----------------------------------------------------------------------
								//$phpmailer->SMTPDebug = 1;
								$phpmailer->SMTPSecure = 'STARTTLS';
								$phpmailer->Host = "mail.emmanuelips.co"; // GMail
								$phpmailer->Port = 587;
								$phpmailer->IsSMTP(); // use SMTP
								$phpmailer->SMTPAuth = true;
								$phpmailer->setFrom($phpmailer->Username,$from_name);

								$phpmailer->AddAddress($prueba1);
								$phpmailer->AddAddress($address_to);
								$phpmailer->AddAddress($address_to3);

								$phpmailer->Subject = utf8_decode($the_subject);
								$phpmailer->Body .= "<p>Cordial saludo</p>";

								$phpmailer->Body .= utf8_decode("<p class='text-left'><strong>En el presente correo me permito enviar datos del paciente que se nombra a continuación;  para dar inicio de intervención terapeutica:</strong></p>
																		 <p class='text-danger'><strong><i><u>DATOS DEL PACIENTE: </u></i></strong></p>
																		 <p class=''><strong>PACIENTE: </strong>$paciente</p>
																		 <p class=''><strong>DOCUMENTO: </strong>$doc</p>
																		 <p class=''><strong>DIRECCIÓN: </strong>$dir_pac.' -- '.$barrio</p>
																		 <p class=''><strong>TELEFONO: </strong>$tel_pac</p>");
								$phpmailer->Body .= utf8_decode(" <p class='text-danger'><strong><i><u>DATOS DEL CUIDADOR: </u></i></strong></p>
																									 <p class=''><strong>NOMBRE: </strong>$cuidador</p>
																									 <p class=''><strong>DIRECCIÓN: </strong>$dir_acu</p>
																									 <p class=''><strong>TELEFONO: </strong>$tel_acu</p>");
								$phpmailer->Body .= utf8_decode("<p class='text-danger'><strong><i><u>PROCEDIMIENTO AUTORIZADO: </u></i></strong></p>
																									 <p class=''><strong>$procedimiento</strong></p>
																									 <p class=''><strong>Sesiones Autorizadas: $sesiones</strong></p>
																									 <p class=''><strong>Fecha atención: $atencion</strong></p><br>");
								$phpmailer->Body .= utf8_decode("<p class='text-left'>Coordinación terapias Sanitas</p>
																		 <p class='text-left'>Emmanuel IPS</p>
																		 <p class='text-left'>TEL: 743 3693 Ext: 3003-3002</p>");

								$phpmailer->IsHTML(true);
								$phpmailer->Send();
							}else {
								$mail1="terapiasdom@emmanuelips.co";

								$mail3=$mail_profesional;

								$asunto='Presentación servicios domiciliarios: '.$_POST['nom'];
								$paciente=$_POST['nom'];
								$doc=$_POST['doc_pac'];
								$dir_pac=$_POST['dir'];
								$tel_pac=$_POST['tel'];
								$barrio=$_POST['barrio'];
								$cuidador=$_POST['nom_acu'];
								$dir_acu=$_POST['dir_acu'];
								$tel_acu=$_POST['tel_acu'];
								$procedimiento=$_POST['cups'].' | '.$_POST['procedimiento'];
								$sesiones=$_POST['sesion_asignada'];
								$atencion=$_POST['atencion'];
								$email_user = "terapiasdom@emmanuelips.co";
								$email_password = "Emmanuel_12345";
								$the_subject = $asunto;

								$prueba1="analistadeterapias@emmanuelips.co";
								$address_to = $mail1;
								$address_to3= $mail3;

								$from_name = "SERVICIO DOMICILIARIO EMMANUEL IPS";
								$phpmailer = new PHPMailer();
								// ---------- datos de la cuenta de Gmail -------------------------------
								$phpmailer->Username = $email_user;
								$phpmailer->Password = $email_password;
								//-----------------------------------------------------------------------
								//$phpmailer->SMTPDebug = 1;
								$phpmailer->SMTPSecure = 'STARTTLS';
								$phpmailer->Host = "mail.emmanuelips.co"; // GMail
								$phpmailer->Port = 587;
								$phpmailer->IsSMTP(); // use SMTP
								$phpmailer->SMTPAuth = true;
								$phpmailer->setFrom($phpmailer->Username,$from_name);

								$phpmailer->AddAddress($prueba1);
								$phpmailer->AddAddress($address_to);
								$phpmailer->AddAddress($address_to3);

								$phpmailer->Subject = utf8_decode($the_subject);
								$phpmailer->Body .= "<p>Cordial saludo</p>";

								$phpmailer->Body .= utf8_decode("<p class='text-left'><strong>En el presente correo me permito enviar datos del paciente que se nombra a continuación;  para dar inicio de intervención terapeutica:</strong></p>
																		 <p class='text-danger'><strong><i><u>DATOS DEL PACIENTE: </u></i></strong></p>
																		 <p class=''><strong>PACIENTE: </strong>$paciente</p>
																		 <p class=''><strong>DOCUMENTO: </strong>$doc</p>
																		 <p class=''><strong>DIRECCIÓN: </strong>$dir_pac -- $barrio</p>
																		 <p class=''><strong>TELEFONO: </strong>$tel_pac</p>");
								$phpmailer->Body .= utf8_decode(" <p class='text-danger'><strong><i><u>DATOS DEL CUIDADOR: </u></i></strong></p>
																									 <p class=''><strong>NOMBRE: </strong>$cuidador</p>
																									 <p class=''><strong>DIRECCIÓN: </strong>$dir_acu</p>
																									 <p class=''><strong>TELEFONO: </strong>$tel_acu</p>");
								$phpmailer->Body .= utf8_decode("<p class='text-danger'><strong><i><u>PROCEDIMIENTO AUTORIZADO: </u></i></strong></p>
																									 <p class=''><strong>$procedimiento</strong></p>
																									 <p class=''><strong>Sesiones Autorizadas: $sesiones</strong></p>
																									 <p class=''><strong>Fecha atención: $atencion</strong></p><br>");
								$phpmailer->Body .= utf8_decode("<p class='text-left'>Coordinación terapias Domiciliarias</p>
																		 <p class='text-left'>Emmanuel IPS</p>
																		 <p class='text-left'>TEL: 743 3693 Ext: 3004-3002</p>");

								$phpmailer->IsHTML(true);
								$phpmailer->Send();
							}
						}
					}

					$d=date('Y-m-d');
					$sql="INSERT INTO profesional_d_dom (id_d_aut_dom, id_user, freg, profesional, estado_profesional)
								VALUES ('".$_POST["id_d_aut_dom"]."','".$_SESSION["AUT"]["id_user"]."','".$d."','".$_POST["profesional"]."','1')";
					$subtitulo="Profesional ";
					$subtitulo1=" asignado";
				break;
				case 'ENCUESTA':
				$ida=$_POST['idadmhosp'];
				$y=date('Y');
				$m=date('m');
				$sql_validar="SELECT id_encuesta_dom FROM encuesta_dom WHERE id_adm_hosp=$ida and freg_encuesta BETWEEN '$y-$m-1' and '$y-$m-31'";
				if ($tabla_validar=$bd1->sub_tuplas($sql_validar)){
					foreach ($tabla_validar as $fila_validar) {
						$idr=$fila_validar['id_encuesta_dom'];
						if ($idr=='') {
							$sql="INSERT INTO encuesta_dom (id_adm_hosp, id_user, freg_encuesta, pregunta1, valor1, pregunta2, valor2, pregunta3, valor3, pregunta4, valor4,
								pregunta5, valor5, pregunta6, valor6, pregunta7, valor7, pregunta8, valor8, pregunta9, valor9, pregunta10, valor10, pregunta11, valor11, pregunta12,
								valor12, pregunta13, valor13, pregunta14, valor14, pregunta15, valor15, pregunta16, valor16, pregunta17, valor17, pregunta18, valor18, pregunta19,
								valor19, pregunta20, valor20, pregunta21, valor21, pregunta22, valor22, pregunta23, valor23, pregunta24, valor24, pregunta25, valor25, pregunta26,
								valor26, pregunta27, valor27, pregunta28, valor28, pregunta29, valor29, pregunta30, valor30, pregunta31, valor31, pregunta32, valor32, pregunta33,
								valor33, obs33, pregunta34, valor34 ) VALUES
							('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg_encuesta"]."',
								'".$_POST["pregunta1"]."','".$_POST["valor1"]."',
								'".$_POST["pregunta2"]."', '".$_POST["valor2"]."',
							 '".$_POST["pregunta3"]."', '".$_POST["valor3"]."',
							  '".$_POST["pregunta4"]."', '".$_POST["valor4"]."',
						   '".$_POST["pregunta5"]."', '".$_POST["valor5"]."',
							  '".$_POST["pregunta6"]."','".$_POST["valor6"]."',
								'".$_POST["pregunta7"]."', '".$_POST["valor7"]."',
							 '".$_POST["pregunta8"]."', '".$_POST["valor8"]."',
							  '".$_POST["pregunta9"]."', '".$_POST["valor9"]."',
						 	 '".$_POST["pregunta10"]."', '".$_POST["valor10"]."',
							  '".$_POST["pregunta11"]."','".$_POST["valor11"]."',
								 '".$_POST["pregunta12"]."', '".$_POST["valor12"]."',
							 '".$_POST["pregunta13"]."', '".$_POST["valor13"]."',
							  '".$_POST["pregunta14"]."', '".$_POST["valor14"]."',
						   '".$_POST["pregunta15"]."', '".$_POST["valor15"]."',
							 '".$_POST["pregunta16"]."','".$_POST["valor16"]."',
							 '".$_POST["pregunta17"]."', '".$_POST["valor17"]."',
							 '".$_POST["pregunta18"]."', '".$_POST["valor18"]."',
							  '".$_POST["pregunta19"]."', '".$_POST["valor19"]."',
						   '".$_POST["pregunta20"]."', '".$_POST["valor20"]."', '".$_POST["pregunta21"]."',
							 '".$_POST["valor21"]."', '".$_POST["pregunta22"]."', '".$_POST["valor22"]."',
							 '".$_POST["pregunta23"]."', '".$_POST["valor23"]."', '".$_POST["pregunta24"]."', '".$_POST["valor24"]."',
						   '".$_POST["pregunta25"]."', '".$_POST["valor25"]."', '".$_POST["pregunta26"]."',
							 '".$_POST["valor26"]."', '".$_POST["pregunta27"]."', '".$_POST["valor27"]."',
							 '".$_POST["pregunta28"]."', '".$_POST["valor28"]."', '".$_POST["pregunta29"]."', '".$_POST["valor29"]."',
						   '".$_POST["pregunta30"]."', '".$_POST["valor30"]."', '".$_POST["pregunta31"]."', '".$_POST["valor31"]."',
							 '".$_POST["pregunta32"]."', '".$_POST["valor32"]."',
				       '".$_POST["pregunta33"]."', '".$_POST["valor33"]."', '".$_POST["obs33"]."', '".$_POST["pregunta34"]."', '".$_POST["valor34"]."')";
							 $subtitulo="ENCUESTA REGISTRADA CON EXITO";
						}
						if ($idr!='') {
							$sql="INSERT INTO encuesta_dom (, id_user, freg_encuesta, pregunta1, valor1, pregunta2, valor2, pregunta3, valor3, pregunta4, valor4,
								pregunta5, valor5, pregunta6, valor6, pregunta7, valor7, pregunta8, valor8, pregunta9, valor9, pregunta10, valor10, pregunta11, valor11, pregunta12,
								valor12, pregunta13, valor13, pregunta14, valor14, pregunta15, valor15, pregunta16, valor16, pregunta17, valor17, pregunta18, valor18, pregunta19,
								valor19, pregunta20, valor20, pregunta21, valor21, pregunta22, valor22, pregunta23, valor23, pregunta24, valor24, pregunta25, valor25, pregunta26,
								valor26, pregunta27, valor27, pregunta28, valor28, pregunta29, valor29, pregunta30, valor30, pregunta31, valor31, pregunta32, valor32, pregunta33,
								valor33, obs33, pregunta34, valor34 ) VALUES
							('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg_encuesta"]."','".$_POST["pregunta1"]."',
							 '".$_POST["valor1"]."''".$_POST["pregunta2"]."', '".$_POST["valor2"]."'
							 '".$_POST["pregunta3"]."', '".$_POST["valor3"]."' '".$_POST["pregunta4"]."', '".$_POST["valor4"]."',
						 '".$_POST["pregunta5"]."', '".$_POST["valor5"]."' '".$_POST["pregunta6"]."',
							 '".$_POST["valor6"]."' '".$_POST["pregunta7"]."', '".$_POST["valor7"]."'
							 '".$_POST["pregunta8"]."', '".$_POST["valor8"]."' '".$_POST["pregunta9"]."', '".$_POST["valor9"]."',
						 '".$_POST["pregunta10"]."', '".$_POST["valor10"]."', '".$_POST["pregunta11"]."',
							 '".$_POST["valor11"]."', '".$_POST["pregunta12"]."', '".$_POST["valor12"]."',
							 '".$_POST["pregunta13"]."', '".$_POST["valor13"]."', '".$_POST["pregunta14"]."', '".$_POST["valor14"]."',
						, '".$_POST["pregunta15"]."', '".$_POST["valor15"]."','".$_POST["pregunta16"]."',
							 '".$_POST["valor16"]."','".$_POST["pregunta17"]."', '".$_POST["valor17"]."',
							 '".$_POST["pregunta18"]."', '".$_POST["valor18"]."', '".$_POST["pregunta19"]."', '".$_POST["valor19"]."',
						, '".$_POST["pregunta20"]."', '".$_POST["valor20"]."', '".$_POST["pregunta21"]."',
							 '".$_POST["valor21"]."', '".$_POST["pregunta22"]."', '".$_POST["valor22"]."',
							 '".$_POST["pregunta23"]."', '".$_POST["valor23"]."', '".$_POST["pregunta24"]."', '".$_POST["valor24"]."',
						, '".$_POST["pregunta25"]."', '".$_POST["valor25"]."', '".$_POST["pregunta26"]."',
							 '".$_POST["valor26"]."', '".$_POST["pregunta27"]."', '".$_POST["valor27"]."',
							 '".$_POST["pregunta28"]."', '".$_POST["valor28"]."', '".$_POST["pregunta29"]."', '".$_POST["valor29"]."',
						, '".$_POST["pregunta30"]."', '".$_POST["valor30"]."', '".$_POST["pregunta31"]."', '".$_POST["valor31"]."', '".$_POST["pregunta32"]."', '".$_POST["valor32"]."'
					, '".$_POST["pregunta33"]."', '".$_POST["valor33"]."', '".$_POST["obs33"]."', '".$_POST["pregunta34"]."', '".$_POST["valor34"]."')";
							 $subtitulo="No se pueden registrar mas encuestas";
						}
					}
				}else {
					$sql="INSERT INTO encuesta_dom (id_adm_hosp, id_user, freg_encuesta, pregunta1, valor1, pregunta2, valor2, pregunta3, valor3, pregunta4, valor4,
						pregunta5, valor5, pregunta6, valor6, pregunta7, valor7, pregunta8, valor8, pregunta9, valor9, pregunta10, valor10, pregunta11, valor11, pregunta12,
						valor12, pregunta13, valor13, pregunta14, valor14, pregunta15, valor15, pregunta16, valor16, pregunta17, valor17, pregunta18, valor18, pregunta19,
						valor19, pregunta20, valor20, pregunta21, valor21, pregunta22, valor22, pregunta23, valor23, pregunta24, valor24, pregunta25, valor25, pregunta26,
						valor26, pregunta27, valor27, pregunta28, valor28, pregunta29, valor29, pregunta30, valor30, pregunta31, valor31, pregunta32, valor32, pregunta33,
						valor33, obs33, pregunta34, valor34 ) VALUES
						('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg_encuesta"]."',
							'".$_POST["pregunta1"]."','".$_POST["valor1"]."',
							'".$_POST["pregunta2"]."', '".$_POST["valor2"]."',
						 '".$_POST["pregunta3"]."', '".$_POST["valor3"]."',
							'".$_POST["pregunta4"]."', '".$_POST["valor4"]."',
						 '".$_POST["pregunta5"]."', '".$_POST["valor5"]."',
							'".$_POST["pregunta6"]."','".$_POST["valor6"]."',
							'".$_POST["pregunta7"]."', '".$_POST["valor7"]."',
						 '".$_POST["pregunta8"]."', '".$_POST["valor8"]."',
							'".$_POST["pregunta9"]."', '".$_POST["valor9"]."',
						 '".$_POST["pregunta10"]."', '".$_POST["valor10"]."',
							'".$_POST["pregunta11"]."','".$_POST["valor11"]."',
							 '".$_POST["pregunta12"]."', '".$_POST["valor12"]."',
						 '".$_POST["pregunta13"]."', '".$_POST["valor13"]."',
							'".$_POST["pregunta14"]."', '".$_POST["valor14"]."',
						 '".$_POST["pregunta15"]."', '".$_POST["valor15"]."',
						 '".$_POST["pregunta16"]."','".$_POST["valor16"]."',
						 '".$_POST["pregunta17"]."', '".$_POST["valor17"]."',
						 '".$_POST["pregunta18"]."', '".$_POST["valor18"]."',
							'".$_POST["pregunta19"]."', '".$_POST["valor19"]."',
						 '".$_POST["pregunta20"]."', '".$_POST["valor20"]."', '".$_POST["pregunta21"]."',
						 '".$_POST["valor21"]."', '".$_POST["pregunta22"]."', '".$_POST["valor22"]."',
						 '".$_POST["pregunta23"]."', '".$_POST["valor23"]."', '".$_POST["pregunta24"]."', '".$_POST["valor24"]."',
						 '".$_POST["pregunta25"]."', '".$_POST["valor25"]."', '".$_POST["pregunta26"]."',
						 '".$_POST["valor26"]."', '".$_POST["pregunta27"]."', '".$_POST["valor27"]."',
						 '".$_POST["pregunta28"]."', '".$_POST["valor28"]."', '".$_POST["pregunta29"]."', '".$_POST["valor29"]."',
						 '".$_POST["pregunta30"]."', '".$_POST["valor30"]."', '".$_POST["pregunta31"]."', '".$_POST["valor31"]."',
						 '".$_POST["pregunta32"]."', '".$_POST["valor32"]."',
						 '".$_POST["pregunta33"]."', '".$_POST["valor33"]."', '".$_POST["obs33"]."', '".$_POST["pregunta34"]."', '".$_POST["valor34"]."')";
						 $subtitulo="ENCUESTA REGISTRADA CON EXITO";
				}
				break;
				case 'RONDA':
				$ida=$_POST['idadmhosp'];
				$y=date('Y');
				$m=date('m');
				$sql_validar="SELECT id_ronseg_dom FROM ronda_seguridad WHERE id_adm_hosp=$ida and freg_ronda BETWEEN '$y-$m-1' and '$y-$m-31'";
				if ($tabla_validar=$bd1->sub_tuplas($sql_validar)){
					foreach ($tabla_validar as $fila_validar) {
						$idr=$fila_validar['id_ronseg_dom'];
						if ($idr=='') {
							$sql="INSERT INTO ronda_seguridad (id_adm_hosp, id_user, freg_ronda, criterio1, valor1, obs1, criterio2, valor2, obs2, criterio3, valor3,
																obs3, criterio4, valor4, obs4, criterio5, valor5, obs5, criterio6, valor6, obs6, criterio7, valor7, obs7, criterio8, valor8,
																obs8, criterio9, valor9, obs9, criterio10, valor10, obs10, criterio11, valor11, obs11, criterio12, valor12, obs12, criterio13,
																valor13, obs13, criterio14, valor14, obs14, criterio15, valor15, obs15, criterio16, valor16, obs16, criterio17, valor17, obs17,
																criterio18, valor18, obs18, criterio19, valor19, obs19, criterio20, valor20, obs20, criterio21, valor21, obs21, criterio22,
																valor22, obs22, criterio23, valor23, obs23, criterio24, valor24, obs24, criterio25, valor25, obs25, criterio26,
																valor26, obs26, criterio27, valor27, obs27, criterio28, valor28, obs28, criterio29, valor29, obs29, criterio30, valor30,
																obs30) VALUES
							('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg_ronda"]."','".$_POST["criterio1"]."',
							 '".$_POST["valor1"]."', '".$_POST["obs1"]."','".$_POST["criterio2"]."', '".$_POST["valor2"]."', '".$_POST["obs2"]."',
							 '".$_POST["criterio3"]."', '".$_POST["valor3"]."', '".$_POST["obs3"]."', '".$_POST["criterio4"]."', '".$_POST["valor4"]."',
							 '".$_POST["obs4"]."', '".$_POST["criterio5"]."', '".$_POST["valor5"]."', '".$_POST["obs5"]."', '".$_POST["criterio6"]."',
							 '".$_POST["valor6"]."', '".$_POST["obs6"]."', '".$_POST["criterio7"]."', '".$_POST["valor7"]."', '".$_POST["obs7"]."',
							 '".$_POST["criterio8"]."', '".$_POST["valor8"]."', '".$_POST["obs8"]."', '".$_POST["criterio9"]."', '".$_POST["valor9"]."',
							 '".$_POST["obs9"]."', '".$_POST["criterio10"]."', '".$_POST["valor10"]."', '".$_POST["obs10"]."', '".$_POST["criterio11"]."',
							 '".$_POST["valor11"]."', '".$_POST["obs11"]."', '".$_POST["criterio12"]."', '".$_POST["valor12"]."', '".$_POST["obs12"]."',
							 '".$_POST["criterio13"]."', '".$_POST["valor13"]."', '".$_POST["obs13"]."', '".$_POST["criterio14"]."', '".$_POST["valor14"]."',
							 '".$_POST["obs14"]."', '".$_POST["criterio15"]."', '".$_POST["valor15"]."','".$_POST["obs15"]."','".$_POST["criterio16"]."',
							 '".$_POST["valor16"]."', '".$_POST["obs16"]."','".$_POST["criterio17"]."', '".$_POST["valor17"]."', '".$_POST["obs17"]."',
							 '".$_POST["criterio18"]."', '".$_POST["valor18"]."', '".$_POST["obs18"]."', '".$_POST["criterio19"]."', '".$_POST["valor19"]."',
							 '".$_POST["obs19"]."', '".$_POST["criterio20"]."', '".$_POST["valor20"]."', '".$_POST["obs20"]."', '".$_POST["criterio21"]."',
							 '".$_POST["valor21"]."', '".$_POST["obs21"]."', '".$_POST["criterio22"]."', '".$_POST["valor22"]."', '".$_POST["obs22"]."',
							 '".$_POST["criterio23"]."', '".$_POST["valor23"]."', '".$_POST["obs23"]."', '".$_POST["criterio24"]."', '".$_POST["valor24"]."',
							 '".$_POST["obs24"]."', '".$_POST["criterio25"]."', '".$_POST["valor25"]."', '".$_POST["obs25"]."', '".$_POST["criterio26"]."',
							 '".$_POST["valor26"]."', '".$_POST["obs26"]."', '".$_POST["criterio27"]."', '".$_POST["valor27"]."', '".$_POST["obs27"]."',
							 '".$_POST["criterio28"]."', '".$_POST["valor28"]."', '".$_POST["obs28"]."', '".$_POST["criterio29"]."', '".$_POST["valor29"]."',
							 '".$_POST["obs29"]."', '".$_POST["criterio30"]."', '".$_POST["valor30"]."','".$_POST["obs30"]."')";
							 $subtitulo="FORMATO RONDA DE SEGURIDAD REGISTRADO CON EXITO";
						}
						if ($idr!='') {
							$sql="INSERT INTO ronda_seguridad (, id_user, freg_ronda, criterio1, valor1, obs1, criterio2, valor2, obs2, criterio3, valor3,
																obs3, criterio4, valor4, obs4, criterio5, valor5, obs5, criterio6, valor6, obs6, criterio7, valor7, obs7, criterio8, valor8,
																obs8, criterio9, valor9, obs9, criterio10, valor10, obs10, criterio11, valor11, obs11, criterio12, valor12, obs12, criterio13,
																valor13, obs13, criterio14, valor14, obs14, criterio15, valor15, obs15, criterio16, valor16, obs16, criterio17, valor17, obs17,
																criterio18, valor18, obs18, criterio19, valor19, obs19, criterio20, valor20, obs20, criterio21, valor21, obs21, criterio22,
																valor22, obs22, criterio23, valor23, obs23, criterio24, valor24, obs24, criterio25, valor25, obs25, criterio26,
																valor26, obs26, criterio27, valor27, obs27, criterio28, valor28, obs28, criterio29, valor29, obs29, criterio30, valor30,
																obs30) VALUES
							('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg_ronda"]."','".$_POST["criterio1"]."',
							 '".$_POST["valor1"]."', '".$_POST["obs1"]."','".$_POST["criterio2"]."', '".$_POST["valor2"]."', '".$_POST["obs2"]."',
							 '".$_POST["criterio3"]."', '".$_POST["valor3"]."', '".$_POST["obs3"]."', '".$_POST["criterio4"]."', '".$_POST["valor4"]."',
							 '".$_POST["obs4"]."', '".$_POST["criterio5"]."', '".$_POST["valor5"]."', '".$_POST["obs5"]."', '".$_POST["criterio6"]."',
							 '".$_POST["valor6"]."', '".$_POST["obs6"]."', '".$_POST["criterio7"]."', '".$_POST["valor7"]."', '".$_POST["obs7"]."',
							 '".$_POST["criterio8"]."', '".$_POST["valor8"]."', '".$_POST["obs8"]."', '".$_POST["criterio9"]."', '".$_POST["valor9"]."',
							 '".$_POST["obs9"]."', '".$_POST["criterio10"]."', '".$_POST["valor10"]."', '".$_POST["obs10"]."', '".$_POST["criterio11"]."',
							 '".$_POST["valor11"]."', '".$_POST["obs11"]."', '".$_POST["criterio12"]."', '".$_POST["valor12"]."', '".$_POST["obs12"]."',
							 '".$_POST["criterio13"]."', '".$_POST["valor13"]."', '".$_POST["obs13"]."', '".$_POST["criterio14"]."', '".$_POST["valor14"]."',
							 '".$_POST["obs14"]."', '".$_POST["criterio15"]."', '".$_POST["valor15"]."','".$_POST["obs15"]."','".$_POST["criterio16"]."',
							 '".$_POST["valor16"]."', '".$_POST["obs16"]."','".$_POST["criterio17"]."', '".$_POST["valor17"]."', '".$_POST["obs17"]."',
							 '".$_POST["criterio18"]."', '".$_POST["valor18"]."', '".$_POST["obs18"]."', '".$_POST["criterio19"]."', '".$_POST["valor19"]."',
							 '".$_POST["obs19"]."', '".$_POST["criterio20"]."', '".$_POST["valor20"]."', '".$_POST["obs20"]."', '".$_POST["criterio21"]."',
							 '".$_POST["valor21"]."', '".$_POST["obs21"]."', '".$_POST["criterio22"]."', '".$_POST["valor22"]."', '".$_POST["obs22"]."',
							 '".$_POST["criterio23"]."', '".$_POST["valor23"]."', '".$_POST["obs23"]."', '".$_POST["criterio24"]."', '".$_POST["valor24"]."',
							 '".$_POST["obs24"]."', '".$_POST["criterio25"]."', '".$_POST["valor25"]."', '".$_POST["obs25"]."', '".$_POST["criterio26"]."',
							 '".$_POST["valor26"]."', '".$_POST["obs26"]."', '".$_POST["criterio27"]."', '".$_POST["valor27"]."', '".$_POST["obs27"]."',
							 '".$_POST["criterio28"]."', '".$_POST["valor28"]."', '".$_POST["obs28"]."', '".$_POST["criterio29"]."', '".$_POST["valor29"]."',
							 '".$_POST["obs29"]."', '".$_POST["criterio30"]."', '".$_POST["valor30"]."','".$_POST["obs30"]."')";
							 $subtitulo="No se pueden registrar mas rondas de seguridad HOY";
						}
					}
				}else {
					$sql="INSERT INTO ronda_seguridad (id_adm_hosp, id_user, freg_ronda, criterio1, valor1, obs1, criterio2, valor2, obs2, criterio3, valor3,
														obs3, criterio4, valor4, obs4, criterio5, valor5, obs5, criterio6, valor6, obs6, criterio7, valor7, obs7, criterio8, valor8,
														obs8, criterio9, valor9, obs9, criterio10, valor10, obs10, criterio11, valor11, obs11, criterio12, valor12, obs12, criterio13,
														valor13, obs13, criterio14, valor14, obs14, criterio15, valor15, obs15, criterio16, valor16, obs16, criterio17, valor17, obs17,
														criterio18, valor18, obs18, criterio19, valor19, obs19, criterio20, valor20, obs20, criterio21, valor21, obs21, criterio22,
														valor22, obs22, criterio23, valor23, obs23, criterio24, valor24, obs24, criterio25, valor25, obs25, criterio26,
														valor26, obs26, criterio27, valor27, obs27, criterio28, valor28, obs28, criterio29, valor29, obs29, criterio30, valor30,
														obs30) VALUES
					('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg_ronda"]."','".$_POST["criterio1"]."',
					 '".$_POST["valor1"]."', '".$_POST["obs1"]."','".$_POST["criterio2"]."', '".$_POST["valor2"]."', '".$_POST["obs2"]."',
					 '".$_POST["criterio3"]."', '".$_POST["valor3"]."', '".$_POST["obs3"]."', '".$_POST["criterio4"]."', '".$_POST["valor4"]."',
					 '".$_POST["obs4"]."', '".$_POST["criterio5"]."', '".$_POST["valor5"]."', '".$_POST["obs5"]."', '".$_POST["criterio6"]."',
					 '".$_POST["valor6"]."', '".$_POST["obs6"]."', '".$_POST["criterio7"]."', '".$_POST["valor7"]."', '".$_POST["obs7"]."',
					 '".$_POST["criterio8"]."', '".$_POST["valor8"]."', '".$_POST["obs8"]."', '".$_POST["criterio9"]."', '".$_POST["valor9"]."',
					 '".$_POST["obs9"]."', '".$_POST["criterio10"]."', '".$_POST["valor10"]."', '".$_POST["obs10"]."', '".$_POST["criterio11"]."',
					 '".$_POST["valor11"]."', '".$_POST["obs11"]."', '".$_POST["criterio12"]."', '".$_POST["valor12"]."', '".$_POST["obs12"]."',
					 '".$_POST["criterio13"]."', '".$_POST["valor13"]."', '".$_POST["obs13"]."', '".$_POST["criterio14"]."', '".$_POST["valor14"]."',
					 '".$_POST["obs14"]."', '".$_POST["criterio15"]."', '".$_POST["valor15"]."','".$_POST["obs15"]."','".$_POST["criterio16"]."',
					 '".$_POST["valor16"]."', '".$_POST["obs16"]."','".$_POST["criterio17"]."', '".$_POST["valor17"]."', '".$_POST["obs17"]."',
					 '".$_POST["criterio18"]."', '".$_POST["valor18"]."', '".$_POST["obs18"]."', '".$_POST["criterio19"]."', '".$_POST["valor19"]."',
					 '".$_POST["obs19"]."', '".$_POST["criterio20"]."', '".$_POST["valor20"]."', '".$_POST["obs20"]."', '".$_POST["criterio21"]."',
					 '".$_POST["valor21"]."', '".$_POST["obs21"]."', '".$_POST["criterio22"]."', '".$_POST["valor22"]."', '".$_POST["obs22"]."',
					 '".$_POST["criterio23"]."', '".$_POST["valor23"]."', '".$_POST["obs23"]."', '".$_POST["criterio24"]."', '".$_POST["valor24"]."',
					 '".$_POST["obs24"]."', '".$_POST["criterio25"]."', '".$_POST["valor25"]."', '".$_POST["obs25"]."', '".$_POST["criterio26"]."',
					 '".$_POST["valor26"]."', '".$_POST["obs26"]."', '".$_POST["criterio27"]."', '".$_POST["valor27"]."', '".$_POST["obs27"]."',
					 '".$_POST["criterio28"]."', '".$_POST["valor28"]."', '".$_POST["obs28"]."', '".$_POST["criterio29"]."', '".$_POST["valor29"]."',
					 '".$_POST["obs29"]."', '".$_POST["criterio30"]."', '".$_POST["valor30"]."','".$_POST["obs30"]."')";
					 $subtitulo="FORMATO RONDA DE SEGURIDAD REGISTRADO CON EXITO";
				}

				break;
				case 'INCLUSION':
				$ida=$_POST['idadmhosp'];
				$sql_validar="SELECT id_inclusion_dom FROM inclusion_domiciliarios WHERE id_adm_hosp=$ida";
				if ($tabla_validar=$bd1->sub_tuplas($sql_validar)){
					foreach ($tabla_validar as $fila_validar) {
						$id=$fila_validar['id_inclusion_dom'];
						if ($id=='') {
							$sql="INSERT INTO inclusion_domiciliarios (id_adm_hosp, id_user, freg_inclusion, criterio1, valor1, obs1,
																												criterio2, valor2, obs2, criterio3, valor3, obs3, criterio4, valor4, obs4, criterio5, valor5,
																												obs5, criterio6, valor6, obs6, criterio7, valor7, obs7, criterio8, valor8, obs8, criterio9,
																												valor9, obs9, criterio10, valor10, obs10, criterio11, valor11, obs11, criterio12, valor12,
																												obs12, criterio13, valor13, obs13, criterio14, valor14, obs14) VALUES
							('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg_inclusion"]."','".$_POST["criterio1"]."',
							 '".$_POST["valor1"]."', '".$_POST["obs1"]."','".$_POST["criterio2"]."', '".$_POST["valor2"]."', '".$_POST["obs2"]."',
							 '".$_POST["criterio3"]."', '".$_POST["valor3"]."', '".$_POST["obs3"]."', '".$_POST["criterio4"]."', '".$_POST["valor4"]."',
							 '".$_POST["obs4"]."', '".$_POST["criterio5"]."', '".$_POST["valor5"]."', '".$_POST["obs5"]."', '".$_POST["criterio6"]."',
							 '".$_POST["valor6"]."', '".$_POST["obs6"]."', '".$_POST["criterio7"]."', '".$_POST["valor7"]."', '".$_POST["obs7"]."',
							 '".$_POST["criterio8"]."', '".$_POST["valor8"]."', '".$_POST["obs8"]."', '".$_POST["criterio9"]."', '".$_POST["valor9"]."',
							 '".$_POST["obs9"]."', '".$_POST["criterio10"]."', '".$_POST["valor10"]."', '".$_POST["obs10"]."', '".$_POST["criterio11"]."',
							 '".$_POST["valor11"]."', '".$_POST["obs11"]."', '".$_POST["criterio12"]."', '".$_POST["valor12"]."', '".$_POST["obs12"]."',
							 '".$_POST["criterio13"]."', '".$_POST["valor13"]."', '".$_POST["obs13"]."', '".$_POST["criterio14"]."', '".$_POST["valor14"]."',
							 '".$_POST["obs14"]."')";
							$subtitulo="FORMATO DE CRITERIOS DE INCLUSION REGISTRADO CON EXITO";
						}
						if ($id!='') {
							$sql="INSERT INTO inclusion_domiciliarios ( id_user, freg_inclusion, criterio1, valor1, obs1,
																												criterio2, valor2, obs2, criterio3, valor3, obs3, criterio4, valor4, obs4, criterio5, valor5,
																												obs5, criterio6, valor6, obs6, criterio7, valor7, obs7, criterio8, valor8, obs8, criterio9,
																												valor9, obs9, criterio10, valor10, obs10, criterio11, valor11, obs11, criterio12, valor12,
																												obs12, criterio13, valor13, obs13, criterio14, valor14, obs14) VALUES
							('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg_inclusion"]."','".$_POST["criterio1"]."',
							 '".$_POST["valor1"]."', '".$_POST["obs1"]."','".$_POST["criterio2"]."', '".$_POST["valor2"]."', '".$_POST["obs2"]."',
							 '".$_POST["criterio3"]."', '".$_POST["valor3"]."', '".$_POST["obs3"]."', '".$_POST["criterio4"]."', '".$_POST["valor4"]."',
							 '".$_POST["obs4"]."', '".$_POST["criterio5"]."', '".$_POST["valor5"]."', '".$_POST["obs5"]."', '".$_POST["criterio6"]."',
							 '".$_POST["valor6"]."', '".$_POST["obs6"]."', '".$_POST["criterio7"]."', '".$_POST["valor7"]."', '".$_POST["obs7"]."',
							 '".$_POST["criterio8"]."', '".$_POST["valor8"]."', '".$_POST["obs8"]."', '".$_POST["criterio9"]."', '".$_POST["valor9"]."',
							 '".$_POST["obs9"]."', '".$_POST["criterio10"]."', '".$_POST["valor10"]."', '".$_POST["obs10"]."', '".$_POST["criterio11"]."',
							 '".$_POST["valor11"]."', '".$_POST["obs11"]."', '".$_POST["criterio12"]."', '".$_POST["valor12"]."', '".$_POST["obs12"]."',
							 '".$_POST["criterio13"]."', '".$_POST["valor13"]."', '".$_POST["obs13"]."', '".$_POST["criterio14"]."', '".$_POST["valor14"]."',
							 '".$_POST["obs14"]."')";
							$subtitulo="YA EXISTE UN DILIGENCIAMIENTO DE CRITERIOS DE INCLUSIÓN PARA ESTA ADMISION";
						}

					}
				}else {
					$sql="INSERT INTO inclusion_domiciliarios (id_adm_hosp, id_user, freg_inclusion, criterio1, valor1, obs1,
																										criterio2, valor2, obs2, criterio3, valor3, obs3, criterio4, valor4, obs4, criterio5, valor5,
																										obs5, criterio6, valor6, obs6, criterio7, valor7, obs7, criterio8, valor8, obs8, criterio9,
																										valor9, obs9, criterio10, valor10, obs10, criterio11, valor11, obs11, criterio12, valor12,
																										obs12, criterio13, valor13, obs13, criterio14, valor14, obs14) VALUES
					('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg_inclusion"]."','".$_POST["criterio1"]."',
					 '".$_POST["valor1"]."', '".$_POST["obs1"]."','".$_POST["criterio2"]."', '".$_POST["valor2"]."', '".$_POST["obs2"]."',
					 '".$_POST["criterio3"]."', '".$_POST["valor3"]."', '".$_POST["obs3"]."', '".$_POST["criterio4"]."', '".$_POST["valor4"]."',
					 '".$_POST["obs4"]."', '".$_POST["criterio5"]."', '".$_POST["valor5"]."', '".$_POST["obs5"]."', '".$_POST["criterio6"]."',
					 '".$_POST["valor6"]."', '".$_POST["obs6"]."', '".$_POST["criterio7"]."', '".$_POST["valor7"]."', '".$_POST["obs7"]."',
					 '".$_POST["criterio8"]."', '".$_POST["valor8"]."', '".$_POST["obs8"]."', '".$_POST["criterio9"]."', '".$_POST["valor9"]."',
					 '".$_POST["obs9"]."', '".$_POST["criterio10"]."', '".$_POST["valor10"]."', '".$_POST["obs10"]."', '".$_POST["criterio11"]."',
					 '".$_POST["valor11"]."', '".$_POST["obs11"]."', '".$_POST["criterio12"]."', '".$_POST["valor12"]."', '".$_POST["obs12"]."',
					 '".$_POST["criterio13"]."', '".$_POST["valor13"]."', '".$_POST["obs13"]."', '".$_POST["criterio14"]."', '".$_POST["valor14"]."',
					 '".$_POST["obs14"]."')";
					$subtitulo="FORMATO DE CRITERIOS DE INCLUSION REGISTRADO CON EXITO";
				}

				break;
				case 'VISITAENFERMERIA':
					$sql="INSERT INTO visita_dom_enfermeria ( id_adm_hosp, id_user, freg, criterio1, criterio2, criterio3, criterio4, criterio5, criterio6, criterio7,
						criterio8, criterio9, obs_visita,fallida) VALUES
					('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["criterio1"]."','".$_POST["criterio2"]."',
						'".$_POST["criterio3"]."','".$_POST["criterio4"]."',
						'".$_POST["criterio5"]."','".$_POST["criterio6"]."','".$_POST["criterio7"]."','".$_POST["criterio8"]."','".$_POST["criterio9"]."',
						'".$_POST["obs_visita"]."',0)";
					$subtitulo="Formato de visita enfermeria registrado con exito";
				break;
				case 'BITACORA':
					$sql="INSERT INTO bitacora_procedimiento (id_d_aut_dom, id_user, freg, tipo_bitacora, descripcion_bitacora) VALUES
					('".$_POST["idd"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["tipo_bitacora"]."',
					'".$_POST["descripcion_bitacora"]."')";
					$subtitulo="Evento de bitacora registrado con exito";
				break;
				case 'DOC':
					$sql="INSERT INTO info_documentacion (id_paciente,nombre_doc$docA)
					VALUES ('".$_POST["idpac"]."','".$_POST["nomdoc"]."'$docb)";
					$subtitulo="El soporte documental registrado con exito";
				break;
				case 'EDITBARRIO':
					$sql="UPDATE pacientes SET zonificacion='".$_POST["zonificacion"]."' WHERE id_paciente='".$_POST["idpac"]."' ";
					$subtitulo="Zonificación del paciente agregada con exito";
				break;
				case 'EACUDIENTE':
					$sql="UPDATE info_acudiente SET nombre_acu='".$_POST["nombre_acu"]."',dir_acu='".$_POST["dir_acu"]."',
					tel_acu='".$_POST["tel_acu"]."',parentesco_acu	='".$_POST["parentesco_acu"]."',user_actualiza='".$_SESSION["AUT"]["id_user"]."',
					obs_actualiza='".$_POST['obs_actualiza']."'
					WHERE id_infoacu='".$_POST["id_infoacu"]."' ";
					$subtitulo="Zonificación del paciente agregada con exito";
				break;
				case 'ADDBARRIO':
					$sql="UPDATE pacientes SET zonificacion='".$_POST["zonificacion"]."' WHERE id_paciente='".$_POST["idpac"]."' ";
					$subtitulo="Zonificación del paciente agregada";
				break;
				case 'ACUDIENTE':
					$sql="INSERT INTO info_acudiente (id_adm_hosp,nombre_acu,dir_acu,tel_acu,parentesco_acu) VALUES
					('".$_POST["idadm"]."','".$_POST["nombre"]."','".$_POST["direccion"]."','".$_POST["telefono"]."',
					'".$_POST["parentesco"]."')";
					$subtitulo="Los datos básicos de cuidador primario han sido Adicionados";
				break;
				case 'EDITPACIENTE':
					$sql="UPDATE pacientes SET tdoc_pac='".$_POST["tdocpac"]."',doc_pac='".$_POST["docpac"]."',
																		 nom1='".$_POST["nom1"]."',nom2='".$_POST["nom2"]."',
																		 ape1='".$_POST["ape1"]."',ape2='".$_POST["ape2"]."',
																		 dir_pac='".$_POST["dirpac"]."',tel_pac='".$_POST["telpac"]."',email_pac='".$_POST['email']."',
																		 genero='".$_POST["genero"]."',fnacimiento='".$_POST["fnacimiento"]."',lat='".$_POST["lat"]."',
																		 lo='".$_POST["lo"]."'
								WHERE id_paciente='".$_POST["idpaci"]."' ";
					$subtitulo="Datos de ".$_POST["nom1"].' '.$_POST["nom1"].' '.$_POST["ape1"].' '.$_POST["ape2"]." del paciente Actualizados";

				break;
			case 'NORTON':
			$total=($_POST['dato1']) + ($_POST['dato2']) + ($_POST['dato3']) + ($_POST['dato4']) + ($_POST['dato5']);

			if ($total >= 5 && $total <= 9) {
				$resultado='MUY ALTO';
				$sql="INSERT INTO escala_norton ( id_adm_hosp, id_user, freg, hreg, dato1, dato2, dato3, dato4,
																					dato5,total,riesgo,observacion)
							 VALUES ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["dato1"]."','".$_POST["dato2"]."',
											 '".$_POST["dato3"]."','".$_POST["dato4"]."','".$_POST["dato5"]."','".$total."','".$resultado."','".$_POST["observacion"]."')";
				$subtitulo="Escala Norton registrada con exito, reportando $resultado.";
			}
			if ($total >= 10 && $total <= 12) {
				$resultado='ALTO';
				$sql="INSERT INTO escala_norton (  id_adm_hosp, id_user, freg, hreg, dato1, dato2, dato3, dato4,
																					dato5,total,riesgo,observacion)
																					VALUES ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["dato1"]."','".$_POST["dato2"]."',
																									'".$_POST["dato3"]."','".$_POST["dato4"]."','".$_POST["dato5"]."','".$total."','".$resultado."','".$_POST["observacion"]."')";
				$subtitulo="Escala Norton registrada con exito, reportando $resultado.";
			}
			if ($total >= 13 && $total <= 14) {
				$resultado='MEDIO';
				$sql="INSERT INTO escala_norton (  id_adm_hosp, id_user, freg, hreg, dato1, dato2, dato3, dato4,
																					dato5,total,riesgo,observacion)
																					VALUES ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["dato1"]."','".$_POST["dato2"]."',
																									'".$_POST["dato3"]."','".$_POST["dato4"]."','".$_POST["dato5"]."','".$total."','".$resultado."','".$_POST["observacion"]."')";
				$subtitulo="Escala Norton registrada con exito, reportando $resultado.";
			}
			if ($total > 14) {
				$resultado='NO RIESGO';
				$sql="INSERT INTO escala_norton (  id_adm_hosp, id_user, freg, hreg, dato1, dato2, dato3, dato4,
																					dato5,total,riesgo,observacion)
																					VALUES ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["dato1"]."','".$_POST["dato2"]."',
																									'".$_POST["dato3"]."','".$_POST["dato4"]."','".$_POST["dato5"]."','".$total."','".$resultado."','".$_POST["observacion"]."')";
				$subtitulo="Escala Norton registrada con exito, reportando $resultado.";
			}

			break;
			case 'BARTHEL':
				$total=($_POST['dato1_puntaje']) + ($_POST['dato2_puntaje']) + ($_POST['dato3_puntaje']) + ($_POST['dato4_puntaje']) + ($_POST['dato5_puntaje'])
								+ ($_POST['dato6_puntaje'])+ ($_POST['dato7_puntaje'])+ ($_POST['dato8_puntaje'])+ ($_POST['dato9_puntaje'])+ ($_POST['dato10_puntaje']);

				if ($total <= 20) {
					$resultado='Dependencia total';
					$sql="INSERT INTO escala_barthel ( id_adm_hosp, id_user, freg, hreg, dato1_puntaje, dato2_puntaje, dato3_puntaje, dato4_puntaje,
																						dato5_puntaje, dato6_puntaje, dato7_puntaje, dato8_puntaje, dato9_puntaje, dato10_puntaje, total, calificacion_total,observacion)
								 VALUES ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["dato1_puntaje"]."','".$_POST["dato2_puntaje"]."',
								 				 '".$_POST["dato3_puntaje"]."','".$_POST["dato4_puntaje"]."','".$_POST["dato5_puntaje"]."','".$_POST["dato6_puntaje"]."','".$_POST["dato7_puntaje"]."',
												 '".$_POST["dato8_puntaje"]."','".$_POST["dato9_puntaje"]."','".$_POST["dato10_puntaje"]."','".$total."','".$resultado."','".$_POST["observacion"]."')";
					$subtitulo="Escala Barthel registrada con exito, reportando Dependencia total.";
				}
				if ($total > 20 && $total <= 60) {
					$resultado='Dependencia severa';
					$sql="INSERT INTO escala_barthel ( id_adm_hosp, id_user, freg, hreg, dato1_puntaje, dato2_puntaje, dato3_puntaje, dato4_puntaje,
																						dato5_puntaje, dato6_puntaje, dato7_puntaje, dato8_puntaje, dato9_puntaje, dato10_puntaje, total, calificacion_total,observacion)
								 VALUES ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["dato1_puntaje"]."','".$_POST["dato2_puntaje"]."',
								 				 '".$_POST["dato3_puntaje"]."','".$_POST["dato4_puntaje"]."','".$_POST["dato5_puntaje"]."','".$_POST["dato6_puntaje"]."','".$_POST["dato7_puntaje"]."',
												 '".$_POST["dato8_puntaje"]."','".$_POST["dato9_puntaje"]."','".$_POST["dato10_puntaje"]."','".$total."','".$resultado."','".$_POST["observacion"]."')";
					$subtitulo="Escala Barthel registrada con exito, reportando $resultado.";
				}
				if ($total > 60 && $total <= 90) {
					$resultado='Dependencia moderada';
					$sql="INSERT INTO escala_barthel ( id_adm_hosp, id_user, freg, hreg, dato1_puntaje, dato2_puntaje, dato3_puntaje, dato4_puntaje,
																						dato5_puntaje, dato6_puntaje, dato7_puntaje, dato8_puntaje, dato9_puntaje, dato10_puntaje, total, calificacion_total,observacion)
								 VALUES ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["dato1_puntaje"]."','".$_POST["dato2_puntaje"]."',
								 				 '".$_POST["dato3_puntaje"]."','".$_POST["dato4_puntaje"]."','".$_POST["dato5_puntaje"]."','".$_POST["dato6_puntaje"]."','".$_POST["dato7_puntaje"]."',
												 '".$_POST["dato8_puntaje"]."','".$_POST["dato9_puntaje"]."','".$_POST["dato10_puntaje"]."','".$total."','".$resultado."','".$_POST["observacion"]."')";
					$subtitulo="Escala Barthel registrada con exito, reportando $resultado.";
				}
				if ($total > 90 && $total <= 99) {
					$resultado='Dependencia leve';
					$sql="INSERT INTO escala_barthel ( id_adm_hosp, id_user, freg, hreg, dato1_puntaje, dato2_puntaje, dato3_puntaje, dato4_puntaje,
																						dato5_puntaje, dato6_puntaje, dato7_puntaje, dato8_puntaje, dato9_puntaje, dato10_puntaje, total, calificacion_total,observacion)
								 VALUES ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["dato1_puntaje"]."','".$_POST["dato2_puntaje"]."',
								 				 '".$_POST["dato3_puntaje"]."','".$_POST["dato4_puntaje"]."','".$_POST["dato5_puntaje"]."','".$_POST["dato6_puntaje"]."','".$_POST["dato7_puntaje"]."',
												 '".$_POST["dato8_puntaje"]."','".$_POST["dato9_puntaje"]."','".$_POST["dato10_puntaje"]."','".$total."','".$resultado."','".$_POST["observacion"]."')";
					$subtitulo="Escala Barthel registrada con exito, reportando $resultado.";
				}
				if ($total >= 100 ) {
					$resultado='Independencia';
					$sql="INSERT INTO escala_barthel ( id_adm_hosp, id_user, freg, hreg, dato1_puntaje, dato2_puntaje, dato3_puntaje, dato4_puntaje,
																						dato5_puntaje, dato6_puntaje, dato7_puntaje, dato8_puntaje, dato9_puntaje, dato10_puntaje, total, calificacion_total,observacion)
								 VALUES ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["dato1_puntaje"]."','".$_POST["dato2_puntaje"]."',
								 				 '".$_POST["dato3_puntaje"]."','".$_POST["dato4_puntaje"]."','".$_POST["dato5_puntaje"]."','".$_POST["dato6_puntaje"]."','".$_POST["dato7_puntaje"]."',
												 '".$_POST["dato8_puntaje"]."','".$_POST["dato9_puntaje"]."','".$_POST["dato10_puntaje"]."','".$total."','".$resultado."','".$_POST["observacion"]."')";
					$subtitulo="Escala Barthel registrada con exito, reportando $resultado.";
				}
			break;
			case 'DOWNTON':
			$total=($_POST['med1_c']) + ($_POST['med2_c']) + ($_POST['med3_c']) + ($_POST['med4_c']) + ($_POST['med5_c']) + ($_POST['med6_c'])+ ($_POST['med7_c'])+ ($_POST['calificacion1'])
			         + ($_POST['ds1_c'])+ ($_POST['ds2_c'])+ ($_POST['ds3_c'])+ ($_POST['ds4_c'])+ ($_POST['deambulacion']);
			if ($total < 3) {
				$r_total='BAJO RIESGO';
				$sql="INSERT INTO escala_downton ( id_adm_hosp, id_user, freg, hreg, calificacion1, med1,
																					med1_c, med2, med2_c, med3, med3_c, med4, med4_c, med5, med5_c, med6, med6_c, med7, med7_c,
																					ds1, ds1_c, ds2, ds2_c, ds3, ds3_c, ds4, ds4_c,em1_c, deambulacion, total,
																					criterio_total,sugerencia)
							 VALUES ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["calificacion1"]."','".$_POST["med1"]."',
							 				 '".$_POST["med1_c"]."','".$_POST["med2"]."','".$_POST["med2_c"]."','".$_POST["med3"]."','".$_POST["med3_c"]."','".$_POST["med4"]."','".$_POST["med4_c"]."',
											 '".$_POST["med5"]."','".$_POST["med5_c"]."','".$_POST["med6"]."','".$_POST["med6_c"]."','".$_POST["med7"]."','".$_POST["med7_c"]."',
										 	 '".$_POST["ds1"]."','".$_POST["ds1_c"]."','".$_POST["ds2"]."','".$_POST["ds2_c"]."','".$_POST["ds3"]."','".$_POST["ds3_c"]."','".$_POST["ds4"]."','".$_POST["ds4_c"]."',
									 		 '".$_POST["em1_c"]."','".$_POST["deambulacion"]."','".$total."','".$r_total."','".$_POST["sugerencia"]."')";
				$subtitulo="Escala Downton registrada con exito, reportando BAJO RIESGO.";

			}
			if ($total >= 3) {
				$r_total='ALTO RIESGO';
				$sql="INSERT INTO escala_downton (id_adm_hosp, id_user, freg, hreg, calificacion1, med1,
																					med1_c, med2, med2_c, med3, med3_c, med4, med4_c, med5, med5_c, med6, med6_c, med7, med7_c,
																					ds1, ds1_c, ds2, ds2_c, ds3, ds3_c, ds4, ds4_c,  em1_c, deambulacion, total,
																					criterio_total,sugerencia)

							 VALUES ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["calificacion1"]."','".$_POST["med1"]."',
							 				 '".$_POST["med1_c"]."','".$_POST["med2"]."','".$_POST["med2_c"]."','".$_POST["med3"]."','".$_POST["med3_c"]."','".$_POST["med4"]."','".$_POST["med4_c"]."',
											 '".$_POST["med5"]."','".$_POST["med5_c"]."','".$_POST["med6"]."','".$_POST["med6_c"]."','".$_POST["med7"]."','".$_POST["med7_c"]."',
										 	 '".$_POST["ds1"]."','".$_POST["ds1_c"]."','".$_POST["ds2"]."','".$_POST["ds2_c"]."','".$_POST["ds3"]."','".$_POST["ds3_c"]."','".$_POST["ds4"]."','".$_POST["ds4_c"]."',
									 		 '".$_POST["em1_c"]."','".$_POST["deambulacion"]."','".$total."','".$r_total."','".$_POST["sugerencia"]."')";

				$subtitulo="Escala Downton registrada con exito, reportando ALTO RIESGO.";
			}
			break;

		}
		//echo $sql;
		//echo $sql1;
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo";
			$check='si';
			if($_POST["operacion"]=="XDOCS"){
			if(is_file($fila["foto"])){
				unlink($fila["foto"]);
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
		case 'DOWNTON':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
									left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
				$boton="Guardar Escala";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$date=date('Y-m-d');
				$date1=date('H:i');
				$doc=$_REQUEST['doc'];
				$opcion=$_REQUEST['opcion'];
				$form1='formularios/escalas/downton.php';
				$titulo='Registro de escala downton';
		break;
		case 'ADDPROFESIONAL':
			$idm=$_REQUEST['idd'];
			$sql="SELECT a.id_m_aut_dom, a.id_adm_hosp id, id_user, tipo_paciente, zona_paciente, ips_ordena, medico_ordena, estado_p_principal,
									 b.id_eps,
									 c.id_d_aut_dom, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa, estado_d_aut_dom
						 FROM m_aut_dom a INNER JOIN adm_hospitalario b on a.id_adm_hosp=b.id_adm_hosp
						 									LEFT JOIN d_aut_dom c on c.id_m_aut_dom=a.id_m_aut_dom
						 WHERE c.id_d_aut_dom=$idm";
						//echo $sql;
			$color="yellow";
			$boton="Asignar Profesional";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$opcion=$_REQUEST['opcion'];
			$doc=$_REQUEST['doc'];
			$form1='formulariosDOM/autorizacion/add_profesional.php';
			$subtitulo='Asignación del profesional en servicio domiciliario';
		break;
			case 'BARTHEL':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
									left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
				$boton="Guardar Escala";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$date=date('Y-m-d');
				$date1=date('H:i');
				$doc=$_REQUEST['doc'];
				$opcion=$_REQUEST['opcion'];
				$form1='formularios/escalas/barthel.php';
				$titulo='Registro de escala barthel';
				break;
			case 'NORTON':
				$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
				b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
				j.nom_eps
				from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
										left join eps j on (j.id_eps=b.id_eps)
				where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
					$boton="Guardar Escala";
					$atributo1=' readonly="readonly"';
					$atributo2='';
					$atributo3='';
					$date=date('Y-m-d');
					$date1=date('H:i');
					$doc=$_REQUEST['doc'];
					$opcion=$_REQUEST['opcion'];
					$form1='formularios/escalas/norton.php';
					$titulo='Registro de escala norton';
			break;
			case 'EDITPACIENTE':
				$idpac=$_REQUEST['idpac'];
				$sql="SELECT id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,dir_pac,tel_pac,email_pac,genero,fnacimiento,lat,lo
							FROM pacientes WHERE id_paciente=$idpac";

				$color="yellow";
				$boton="Actualizar";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$opcion=$_REQUEST['opcion'];
				$doc=$_REQUEST['docc'];
				$form1='formulariosDOM/presentacion/add_paciente.php';
				$subtitulo='Actualización de datos básicos paciente';
			break;
			case 'DOC':
				$sql="SELECT a.id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento, edad, uedad, dir_pac, tel_pac, email_pac, estadocivil,
										 genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac, cie, descricie, zonapac, ipsordena,
										 b.id_adm_hosp
							FROM pacientes a LEFT JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
							WHERE a.id_paciente=".$_GET["idpac"];
							//echo $sql;
				$color="green";
				$boton="Cargar Documento";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$opcion=$_REQUEST['opcion'];
				$doc=$_REQUEST['doc'];
				$servicio=$_REQUEST['servicio'];
				$form1='formulariosDOM/presentacion/add_documentos.php';
				$subtitulo='Cargar documentos del paciente';
			break;
			case 'XDOC':
					$sql="SELECT id_infodocs
								FROM info_documentacion
								WHERE id_paciente=".$_GET["pac"];
								//echo $sql;
					$color="green";
					$boton="Eliminar Documento";
					$atributo1=' readonly="readonly"';
					$atributo2='';
					$atributo3='';
					$opcion=$_REQUEST['opcion'];
					$doc=$_REQUEST['doc'];
					$servicio=$_REQUEST['servicio'];
					$form1='formulariosDOM/presentacion/del_documentos.php';
					$subtitulo='Confirmación de eliminación de documento ';
				break;
				case 'EDITBARRIO':
					$idpac=$_REQUEST['idpac'];
					$sql="SELECT id_paciente,doc_pac,nom1,nom2,ape1,ape2
								FROM pacientes
								WHERE id_paciente=$idpac";
					$color="yellow";
					$boton="Agregar";
					$atributo1=' readonly="readonly"';
					$atributo2='';
					$atributo3='';
					$opcion=$_REQUEST['opcion'];
					$doc=$_REQUEST['docc'];
					$form1='formulariosDOM/presentacion/add_barrio.php';
					$subtitulo='Edición de barrio para pacientes';
				break;
				case 'ADDBARRIO':
					$idpac=$_REQUEST['idpac'];
					$sql="SELECT id_paciente,doc_pac,nom1,nom2,ape1,ape2
								FROM pacientes
								WHERE id_paciente=$idpac";
					$color="yellow";
					$boton="Agregar";
					$atributo1=' readonly="readonly"';
					$atributo2='';
					$atributo3='';
					$opcion=$_REQUEST['opcion'];
					$doc=$_REQUEST['docc'];
					$form1='formulariosDOM/presentacion/add_barrio.php';
					$subtitulo='Registro de barrio para pacientes';
					break;
					case 'EACUDIENTE':
						$idacu=$_REQUEST['idacu'];
						$sql="SELECT a.id_infoacu,nombre_acu,dir_acu,tel_acu,parentesco_acu
									FROM info_acudiente
									WHERE id_infoacu=$idacu";
						$color="yellow";
						$boton="Agregar";
						$atributo1=' readonly="readonly"';
						$atributo2='';
						$atributo3='';
						$option=$_REQUEST['opcion'];
						$doc=$_REQUEST['docc'];
						$form1='formulariosDOM/presentacion/add_acudiente.php';
						$subtitulo='Edición datos básicos cuidador primario';
					break;
					case 'ACUDIENTE':
						$idadm=$_REQUEST['idadm'];
						$sql="SELECT a.dir_pac,tel_pac,b.id_adm_hosp
						      FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
						      WHERE id_adm_hosp=$idadm";
						$color="yellow";
						$boton="Agregar";
						$atributo1=' readonly="readonly"';
						$atributo2='';
						$atributo3='';
						$option=$_REQUEST['opcion'];
						$doc=$_REQUEST['docc'];
						$form1='admision/add_acudiente.php';
						$subtitulo='Registro datos básicos cuidador primario';
					break;
					case 'BITACORA':
						$idd=$_REQUEST['idd'];
						$sql="SELECT a.id_d_aut_dom, id_m_aut_dom, freg, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa, estado_d_aut_dom, intervalo, temporalidad, profesional, f_prof,
												 b.nombre
						      FROM d_aut_dom a LEFT JOIN user b on a.profesional=b.id_user
						      WHERE id_d_aut_dom=$idd";
						$color="yellow";
						$boton="Agregar";
						$atributo1=' readonly="readonly"';
						$atributo2='';
						$atributo3='';
						$option=$_REQUEST['opcion'];
						$doc=$_REQUEST['docc'];
						$form1='formulariosDOM/autorizacion/add_bitacora_procedimiento.php';
						$subtitulo='Registro de bitacora de procedimientos autorizados';
					break;
					case 'VISITAENFERMERIA':
						$sql="";
						$color="yellow";
						$boton="Agregar";
						$atributo1=' readonly="readonly"';
						$atributo2='';
						$atributo3='';
						$option=$_REQUEST['opcion'];
						$doc=$_REQUEST['doc'];
						$form1='formulariosDOM/enfermeria/visitadom.php';
						$subtitulo='Registro de formato de visita enfermería';
					break;
					case 'INCLUSION':
						$idd=$_REQUEST['idd'];
						$sql="SELECT a.id_d_aut_dom, id_m_aut_dom, freg, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa, estado_d_aut_dom, intervalo, temporalidad, profesional, f_prof,
												 b.nombre
						      FROM d_aut_dom a LEFT JOIN user b on a.profesional=b.id_user
						      WHERE id_d_aut_dom=$idd";
						$color="yellow";
						$boton="Agregar";
						$atributo1=' readonly="readonly"';
						$atributo2='';
						$atributo3='';
						$option=$_REQUEST['opcion'];
						$doc=$_REQUEST['doc'];
						$form1='formulariosDOM/enfermeria/inclusion.php';
						$subtitulo='Criterios de inclusión al servicio domiciliario';
					break;
					case 'RONDA':
						$idd=$_REQUEST['idd'];
						$sql="SELECT a.id_d_aut_dom, id_m_aut_dom, freg, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa, estado_d_aut_dom, intervalo, temporalidad, profesional, f_prof,
												 b.nombre
						      FROM d_aut_dom a LEFT JOIN user b on a.profesional=b.id_user
						      WHERE id_d_aut_dom=$idd";
						$color="yellow";
						$boton="Agregar";
						$atributo1=' readonly="readonly"';
						$atributo2='';
						$atributo3='';
						$option=$_REQUEST['opcion'];
						$doc=$_REQUEST['doc'];
						$form1='formulariosDOM/enfermeria/ronda_seguridad.php';
						$subtitulo='Registro de Ronda de Seguridad servicio domiciliario';
					break;
					case 'VALPHD':
						$idd=$_REQUEST['idd'];
						$sql="SELECT a.id_d_aut_dom, id_m_aut_dom, freg, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa, estado_d_aut_dom, intervalo, temporalidad, profesional, f_prof,
												 b.nombre
						      FROM d_aut_dom a LEFT JOIN user b on a.profesional=b.id_user
						      WHERE id_d_aut_dom=$idd";
						$color="yellow";
						$boton="Agregar";
						$atributo1=' readonly="readonly"';
						$atributo2='';
						$atributo3='';
						$option=$_REQUEST['opcion'];
						$doc=$_REQUEST['doc'];
						$form1='formulariosDOM/enfermeria/valoracion_phd.php';
						$subtitulo='Valoración de PHD';
					break;
					case 'ENCUESTA':
						$idd=$_REQUEST['idd'];
						$sql="SELECT a.id_d_aut_dom, id_m_aut_dom, freg, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa, estado_d_aut_dom, intervalo, temporalidad, profesional, f_prof,
												 b.nombre
									FROM d_aut_dom a LEFT JOIN user b on a.profesional=b.id_user
									WHERE id_d_aut_dom=$idd";
						$color="yellow";
						$boton="Agregar";
						$atributo1=' readonly="readonly"';
						$atributo2='';
						$atributo3='';
						$option=$_REQUEST['opcion'];
						$doc=$_REQUEST['doc'];
						$form1='formulariosDOM/enfermeria/encuesta_dom.php';
						$subtitulo='ENCUESTA DE SATISFACCIÓN DE USUARIO SERVICIOS DOMICILIARIOS';
					break;
					case 'XESCALA':
						$escala=$_REQUEST['tabla'];
						$id_escala=$_REQUEST['id'];
						if ($escala=='downton') {
							$sql="SELECT a.id_esc_downton id_escala
										FROM escala_downton
										WHERE id_esc_downton=$id_escala";
							$color="yellow";
							$boton="Agregar";
							$atributo1=' readonly="readonly"';
							$atributo2='';
							$atributo3='';
							$option=$_REQUEST['opcion'];
							$doc=$_REQUEST['doc'];
							$form1='formularios/escalas/del_escala.php';
							$subtitulo='ENCUESTA DE SATISFACCIÓN DE USUARIO SERVICIOS DOMICILIARIOS';
						}
						if ($escala=='barthel') {
							$sql="SELECT a.id_esc_barthel id_escala
										FROM escala_barthel
										WHERE id_esc_barthel=$id_escala";
							$color="yellow";
							$boton="Agregar";
							$atributo1=' readonly="readonly"';
							$atributo2='';
							$atributo3='';
							$option=$_REQUEST['opcion'];
							$doc=$_REQUEST['doc'];
							$form1='formularios/escalas/del_escala.php';
							$subtitulo='ENCUESTA DE SATISFACCIÓN DE USUARIO SERVICIOS DOMICILIARIOS';
						}
						if ($escala=='norton') {
							$sql="SELECT a.id_esc_norton id_escala
										FROM escala_norton
										WHERE id_esc_norton=$id_escala";
							$color="yellow";
							$boton="Agregar";
							$atributo1=' readonly="readonly"';
							$atributo2='';
							$atributo3='';
							$option=$_REQUEST['opcion'];
							$doc=$_REQUEST['doc'];
							$form1='formularios/escalas/del_escala.php';
							$subtitulo='ENCUESTA DE SATISFACCIÓN DE USUARIO SERVICIOS DOMICILIARIOS';
						}

					break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
			$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"",
			"fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"",
			"religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"",
			"hegreso_hosp"=>"", "nom_eps"=>"","id_infodocs"=>"",
			"id_d_aut_dom"=>"", "id_m_aut_dom"=>"", "freg"=>"", "cups"=>"", "procedimiento"=>"", "cantidad"=>"", "finicio"=>"",
			"ffinal"=>"", "num_aut_externa"=>"", "estado_d_aut_dom"=>"", "intervalo"=>"", "temporalidad"=>"",
			"profesional"=>"", "f_prof"=>"","nombre"=>"","id_escala"=>"","lat"=>"","lo"=>"",
			"id_infoacu"=>"","nombre_acu"=>"","dir_acu"=>"","tel_acu"=>"","parentesco_acu"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"",
				"fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"",
				"religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id_infodocs"=>"",
				"id_d_aut_dom"=>"", "id_m_aut_dom"=>"", "freg"=>"", "cups"=>"", "procedimiento"=>"", "cantidad"=>"", "finicio"=>"",
				"ffinal"=>"", "num_aut_externa"=>"", "estado_d_aut_dom"=>"", "intervalo"=>"", "temporalidad"=>"",
				"profesional"=>"", "f_prof"=>"","nombre"=>"","id_escala"=>"","lat"=>"","lo"=>"",
				"id_infoacu"=>"","nombre_acu"=>"","dir_acu"=>"","tel_acu"=>"","parentesco_acu"=>"");
			}

		?>


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
<section class="panel-default">
	<section class="panel-heading"><h4>Jefes de enfermería Servicios Domiciliarios</h4></section>
	<section class="panel-body">
		<section class="col-md-6">
			<section class="row">
				<form>
						<div class="col-lg-12">
							<div class="input-group">
								<input type="text" class="form-control" name="doc" placeholder="Digite identificación">
								<span class="input-group-btn">
										<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
										<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
								</span>
							</div><!-- /input-group -->
						</div><!-- /.col-lg-6 -->
				</form>
				<form>
						<div class="col-lg-12">
							<div class="input-group">
								<input type="text" class="form-control" name="nom" placeholder="Digite nombre o apellidos">
								<span class="input-group-btn">
										<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
										<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
								</span>
							</div><!-- /input-group -->
						</div><!-- /.col-lg-6 -->
				</form>
			</section>
		</section>
		<section class="col-md-3">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#pac_phd">Pacientes PHD</button>
			<div id="pac_phd" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-lg">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Pacientes Asignados para realizacion de valoración PHD</h4>
			      </div>
			      <div class="modal-body">
							<?php
							$asignado=$_SESSION['AUT']['id_user'];
							$sql_phd="SELECT a.nom_completo,doc_pac,
															 b.fingreso_hosp,
															 c.tipo_paciente,dx_presentacion,c.id_m_aut_dom idm,
															 e.nombre,
															 d.f_realizacion
												FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
												                 INNER JOIN m_aut_dom c on c.id_adm_hosp=b.id_adm_hosp
																				 LEFT JOIN valoracion_phd d on d.id_m_aut_dom=c.id_m_aut_dom
																				 LEFT JOIN ips_externa e on e.id_ips_externa=c.ips_ordena
												WHERE  c.estado_p_principal=1 and c.tipo_paciente=3";
							if ($tabla_phd=$bd1->sub_tuplas($sql_phd)){
								foreach ($tabla_phd as $fila_phd) {
									?>
									<section class="panel-body">
										<article class="col-md-4">
											<p><strong>Paciente:</strong> <?php echo $fila_phd['nom_completo'] ?></p>
											<p><strong>Documento:</strong> <?php echo $fila_phd['doc_pac'] ?></p>
											<p><strong>Fecha ingreso:</strong> <?php echo $fila_phd['fingreso_hosp'] ?></p>
										</article>
										<article class="col-md-4">
											<p><strong>Dx presentacion:</strong> <?php echo $fila_phd['dx_presentacion'] ?></p>
											<p><strong>IPS ordena:</strong> <?php echo $fila_phd['nombre'] ?></p>
										</article>
										<article class="col-md-4">
											<?php
											echo'
											<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VALPHD&idm='.$fila_phd["idm"].'&doc='.$fila_phd['doc_pac'].'">
											<button type="button" class="btn btn-primary">
											<span class="fa fa-plus-circle"></span> Registrar<br>valoracion PHD</button></a>';
											 ?>
										</article>
									</section>
									<?php
								}
							}
							 ?>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>

			  </div>
			</div>
		</section>
	</section>

	<section class="panel-body">
		<?php
		$jefe=$_SESSION['AUT']['id_user'];
		// ZONA 1 = Jacqueline Ramirez Torres
		if ($jefe==1772) {
		?>
		<button data-toggle="collapse" class="btn btn-success col-md-12" data-target="#m"><span class="fa fa-map-marked-alt fa-3x text-danger"></span>  Geolocalización agrupada</button>
		<section class="col-md-12">
			<section id="m" class="collapse">
			<?php include('jefe_zona1/lista_jefes_dom5.php') ?>
			</section>
		</section>
		<?php
		}
		// ZONA 2 = gina
	 if ($jefe==2238) {
	 ?>
	 <button data-toggle="collapse" class="btn btn-success col-md-12" data-target="#m1"><span class="fa fa-map-marked-alt fa-3x text-danger"></span>  Geolocalización agrupada</button>
	 <section class="col-md-12">
		 <section id="m1" class="collapse">
		 <?php include('jefe_zona2/lista_jefes_dom5.php') ?>
		 </section>
	 </section>
	 <?php
	 }
	 // ZONA 3 = Paula Ximena Murcia Roa
	 if ($jefe==1773) {
	 ?>
	 <button data-toggle="collapse" class="btn btn-success col-md-12" data-target="#m2"><span class="fa fa-map-marked-alt fa-3x text-danger"></span>  Geolocalización agrupada</button>
	 <section class="col-md-12">
		 <section id="m2" class="collapse">
		 <?php include('jefe_zona3/lista_jefes_dom5.php') ?>
		 </section>
	 </section>
	 <?php
	 }
	 // ZONA 5 = zona sabana
	 if ($jefe==2539) {
	 ?>
	 <button data-toggle="collapse" class="btn btn-success col-md-12" data-target="#m5"><span class="fa fa-map-marked-alt fa-3x text-danger"></span>  Geolocalización agrupada</button>
	 <section class="col-md-12">
		 <section id="m5" class="collapse">
		 <?php include('jefe_zona5/lista_jefes_dom5.php') ?>
		 </section>
	 </section>
	 <?php
	 }
	 ?>
 </section>
<section class="panel-body">

</section>
 <section class="panel-body">
	 <table class="table table-bordered">
		 <tr>
			 <th class="info">#</th>
			 <th class="info">PACIENTE</th>
			 <th class="info">INGRESO</th>
			 <th class="info"></th>
		 </tr>
		 <?php
		 	$doc=$_REQUEST['doc'];
		 	$nom=$_REQUEST['nom'];

		 	if (isset($doc)) {
				$doc=$_REQUEST["doc"];
				$jefe=$_SESSION["AUT"]["id_user"];
				$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,dir_pac,tel_pac,zonificacion,
				             a.id_adm_hosp,fingreso_hosp,hingreso_hosp,estado_salida,
				             s.nom_sedes,
				             e.nom_eps
				      FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
				                       LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
				                       LEFT JOIN eps e on a.id_eps=e.id_eps
				      WHERE p.doc_pac=$doc and a.estado_adm_hosp='Activo' and tipo_servicio='Domiciliarios' and p.jefe_zona=$jefe";
				      $i=1;
				if ($tabla=$bd1->sub_tuplas($sql)){
				  //echo $sql;
				  foreach ($tabla as $fila) {
						$estado_salida=$fila['estado_salida'];
						if ($estado_salida=='Fallecimiento') {
							echo"<tr >\n";
							echo'<td>Paciente Fallecido</td>';
							echo"</tr >\n";
						}else {
							echo"<tr >\n";
					    echo'<td>'.$i++.'</td>';
					    echo'<td class="text-Left">
					          <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
					          <p><strong>ADM: </strong>'.$fila["id_adm_hosp"].'</p>
					          <p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>
					          <p><strong>Dirección: </strong>'.$fila["dir_pac"].'</p>
					          <p><strong>Teléfono: </strong>'.$fila["tel_pac"].'</p>
					          <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EDITPACIENTE&idpac='.$fila["id_paciente"].'&docc='.$fila['doc_pac'].'">
					          <button type="button" class="btn btn-warning">
					          <span class="fa fa-edit"></span> Editar paciente</button></a></p>';
					          // zonificacion del paciente asignacion del barrio
					          if ($fila['zonificacion']=='') {
					            echo'<p class="alert alert-danger animated bounce text-center"><span class="fa fa-warning"></span> No tiene Zona asignada.
					            <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDBARRIO&idpac='.$fila["id_paciente"].'&docc='.$fila['doc_pac'].'">
					            <button type="button" class="btn btn-primary">
					            <span class="fa fa-plus-circle"></span> Adicionar Barrio</button></a></p>
					            ';
					          }else {
					            $zona=$fila['zonificacion'];
					            $sql_barrios="SELECT a.nom_barrio,b.nom_upz,c.nom_localidad
					                          FROM barrio a inner join upz b on a.id_upz=b.id_upz
					                                        inner join localidades c on c.id_localidad=b.id_localidad
					                          WHERE a.id_barrio=$zona";
					            if ($tabla_barrios=$bd1->sub_tuplas($sql_barrios)){
					              foreach ($tabla_barrios as $fila_barrios ) {
					                echo'<p class="text-info"><strong>Barrio:</strong> '.$fila_barrios['nom_barrio'].'</p>
					                     <p class="text-info"><strong>Localidad:</strong> '.$fila_barrios['nom_localidad'].'</p>
					                     <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EDITBARRIO&idpac='.$fila["id_paciente"].'&docc='.$fila['doc_pac'].'">
					                     <button type="button" class="btn btn-warning">
					                     <span class="fa fa-edit"></span> Editar Barrio</button></a></p>';
					              }
					            }

					          }
										$fecha=date('Y-m-d');
										$hora=date('H:i');
										echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#dinvasivo_'.$fila['id_paciente'].'"> Dispositvos Invasivos</button></p>
										<div id="dinvasivo_'.$fila['id_paciente'].'" class="modal fade" role="dialog">
											<div class="modal-dialog">

												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Registro y consulta dispositivos invasivos</h4>
													</div>
													<div class="modal-body">
													<form action="Funcion_base/add_dinvasivoJ.php" method="POST">
														<section class="panel-body">
															<article class="col-md-12">
																<label>Seleccione Dispositivo:</label>
																<select class="form-control" name="dispositivo_invasivo">
																	<option values="Traqueostomia">Traqueostomia</option>
																	<option values="Esofagostomia">Esofagostomia</option>
																	<option values="Gastrostomia">Gastrostomia</option>
																	<option values="Yeyunostomia">Yeyunostomia</option>
																	<option values="Ileostomia">Ileostomia</option>
																	<option values="Colostomia">Colostomia</option>
																	<option values="Nefrostomia">Nefrostomia</option>
																	<option values="Urostomia">Urostomia</option>
																	<option values="Sonda Nasogastrica">Sonda Nasogastrica</option>
																	<option values="Sonda Orogastrica">Sonda Orogastrica</option>
																	<option values="Sonda Vesical">Sonda Vesical</option>
																	<option values="Cateter Subcutaneo">Cateter Subcutaneo</option>
																	<option values="Fístula">Fístula</option>
																</select>
															</article>
															<article class="col-md-12">
																<label>Observación:</label>
																<textarea class="form-control" name="obs_dinvasivo"></textarea>

																<input type="hidden" name="fecha_dinvasivo" value="'.$fecha.'">
																<input type="hidden" name="hora_dinvasivo" value="'.$hora.'">
																<input type="hidden" name="id_user" value="'.$_SESSION['AUT']['id_user'].'">
																<input type="hidden" name="id_paciente" value="'.$fila['id_paciente'].'">
																<input type="hidden" name="doc" value="'.$fila['doc_pac'].'">
																</select>
															</article>
														</section>
														<section class="panel-body">
															<article class="col-md-12">
																<input type="submit" value="Guardar">
															</article>
														</section>

													</form>';
													$pac=$fila['id_paciente'];
													$sql_dinvasivo="SELECT id_dinvasivo, id_paciente, id_user, fecha_dinvasivo,
																							 hora_dinvasivo, dispositivo_invasivo, obs_dinvasivo, estado_dinvasivo
																				FROM dispositivos_invasivos
																				WHERE id_paciente=$pac";
																				if ($tabla_dinvasivo=$bd1->sub_tuplas($sql_dinvasivo)){
																					 foreach ($tabla_dinvasivo as $fila_dinvasivo) {
																						 echo'<p class="text-primary"><strong>Dispositivo: </strong>'.$fila_dinvasivo['dispositivo_invasivo'].'</p>';
																						 echo'<p class="text-primary"><strong>Observacion: </strong>'.$fila_dinvasivo['obs_dinvasivo'].'</p>';
																					 }
																				}
													echo'</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
													</div>
												</div>

											</div>
										</div>';
					    echo'</td>';
					    echo'<td class="text-left">

					          <p><strong>INGRESO: </strong>'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
					          <p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>';
					        $idadm=$fila['id_adm_hosp'];
					        $sqlacu="SELECT id_infoacu,nombre_acu,tel_acu,dir_acu,parentesco_acu
					                   FROM info_acudiente
					                   WHERE id_adm_hosp=$idadm";
					        //echo $sql_adm;
					        if ($tablaacu=$bd1->sub_tuplas($sqlacu)){
					           foreach ($tablaacu as $filaacu) {
					             echo'
					             <p class="text-success"><u><b>DATOS DE CUIDADOR PRIMARIO</b></p>
					             <p class="text-success"><strong>Cuidador: </strong>'.$filaacu['nombre_acu'].'</p>
					             <p class="text-success"><strong>Contacto y Ubicación: </strong>'.$filaacu['tel_acu'].'-'.$filaacu['dir_acu'].'</p>
					             <p class="text-success"><strong>Parentesco: </strong>'.$filaacu['parentesco_acu'].'</p>
					             <p class="text-success">	<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EACUDIENTE&idacu='.$fila["id_infoacu"].'&docc='.$fila["doc_pac"].'">
					               <button type="button" class="btn btn-warning btn-xs" ><span class="fa fa-edit"></span> Editar Cuidador
					               </button></a></p>
					            ';
					             echo'<section class="row">
					             <article class="col-md-12">';
					             echo'<p><button type="button" class="btn btn-info " data-toggle="modal" data-target="#gdocu_'.$fila["id_adm_hosp"].'">Gestor Documental</button></p>';
					             echo'</article>';

					             echo'<article class="col-md-12">';
					             echo'<p><button type="button" class="btn btn-warning " data-toggle="modal" data-target="#sa'.$fila["id_adm_hosp"].'">Servicios Autorizados</button></p>';
					             echo'</article>';

											 echo'<article class="col-md-12">';
											 echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VISITAENFERMERIA&idadm='.$fila['id_adm_hosp'].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-primary"><span class="fa fa-medkit"></span> Visita Enfermería</button></p></a>';
											 echo'<p><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#falla_'.$fila['id_adm_hosp'].'">Fallida</button></p>
														<div id="falla_'.$fila['id_adm_hosp'].'" class="modal fade" role="dialog">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal">&times;</button>
																		<h4 class="modal-title">Porque esta visita es fallida?</h4>
																	</div>
																	<div class="modal-body">
																	<form action="Funcion_base/visita_fallida.php" method="POST">
																		<section class="panel-body">
																			<article class="col-md-12">
																			<label>Observacion</label>
																			<textarea class="form-control" name="observacion"></textarea>
																			<input type="hidden" name="idadmhosp" value="'.$fila["id_adm_hosp"].'">
																			<input type="hidden" name="doc" value="'.$fila["doc_pac"].'">
																			<input type="hidden" name="resp" value="'.$_SESSION['AUT']['id_user'].'">
																			<input type="hidden" name="servicio" value="'.$_REQUEST["servicio"].'">
																			</article>
																		</section>
																		<section class="panel-body">
																			<article class="col-md-12">
																				<input type="submit" value="Guardar">
																			</article>
																		</section>

																	</form>
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																	</div>
																</div>

															</div>
														</div>
											 ';

											 echo'<p><button type="button" class="btn btn-info " data-toggle="modal" data-target="#hvisitas_'.$fila["id_adm_hosp"].'">Historico visitas</button></p>';
											 echo'</article>';

					             echo'</section>';
											 echo'
					             <div id="hvisitas_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
					               <div class="modal-dialog">

					                 <!-- Modal content-->
					                 <div class="modal-content">
					                   <div class="modal-header">
					                     <button type="button" class="close" data-dismiss="modal">&times;</button>
					                     <h4 class="modal-title">Historico de visitas domiciliarias enfermería </h4>

					                   </div>
					                   <div class="modal-body">';
					                   $id=$fila['id_adm_hosp'];
					                      $sql_venfermeria="SELECT a.id_visita_dom, freg, criterio1, criterio2, criterio3, criterio4, criterio5, criterio6,
																								 criterio7, criterio8, criterio9, obs_visita,fallida,
																								 b.nombre
																								 FROM visita_dom_enfermeria a inner join user b on b.id_user=a.id_user
					                                      WHERE a.id_adm_hosp=$id";

					                      if ($tabla_venfermeria=$bd1->sub_tuplas($sql_venfermeria)){
					                        foreach ($tabla_venfermeria as $fila_venfermeria) {
					                          $fallida=$fila_venfermeria['fallida'];

																		if ($fallida==1) {
																			echo'<section class="panel-body alert alert-danger">';
																			  echo'<article class="col-md-12 ">';
																			    echo'<p><strong>Fecha Registro: </strong>'.$fila_venfermeria['freg'].'</p>';
																			    echo'<p><strong>Responsable: </strong>'.$fila_venfermeria['nombre'].'</p>';
																			  echo'</article>';
																			  echo'<article class="col-md-12 ">';
																			    echo'<p><strong>Verificacion de datos del paciente y cuidador: </strong>';
																			    if ($fila_venfermeria['criterio1']==1) {
																			      echo'SI';
																			    }else {
																			      echo'NO';
																			    }
																			    echo'</p>';
																			    echo'<p><strong>Verificacion de servicios autorizados: </strong>';
																			    if ($fila_venfermeria['criterio2']==1) {
																			      echo'SI';
																			    }else {
																			      echo'NO';
																			    }
																			    echo'</p>';
																			    echo'<p><strong>Socializacion de derechos y deberes del usuario y la familia: </strong>';
																			    if ($fila_venfermeria['criterio3']==1) {
																			      echo'SI';
																			    }else {
																			      echo'NO';
																			    }
																			    echo'</p>';
																			    echo'<p><strong>Revision de criterios de inclusion y exclusion: </strong>';
																			    if ($fila_venfermeria['criterio4']==1) {
																			      echo'SI';
																			    }else {
																			      echo'NO';
																			    }
																			    echo'</p>';
																			    echo'<p><strong>Socializacion del consentimiento informado de servicios domiciliarios: </strong>';
																			    if ($fila_venfermeria['criterio5']==1) {
																			      echo'SI';
																			    }else {
																			      echo'NO';
																			    }
																			    echo'</p>';
																			    echo'<p><strong>Socializacion de las funciones del Auxiliar de enfermeria: </strong>';
																			    if ($fila_venfermeria['criterio6']==1) {
																			      echo'SI';
																			    }else {
																			      echo'NO';
																			    }
																			    echo'</p>';
																			    echo'<p><strong>Valoracion cefalocaudal del paciente y aplicacion de escalas de valoracion: </strong>';
																			    if ($fila_venfermeria['criterio7']==1) {
																			      echo'SI';
																			    }else {
																			      echo'NO';
																			    }
																			    echo'</p>';
																			    echo'<p><strong>Diligenciamiento de la ronda de seguridad: </strong>';
																			    if ($fila_venfermeria['criterio8']==1) {
																			      echo'SI';
																			    }else {
																			      echo'NO';
																			    }
																			    echo'</p>';
																			    echo'<p><strong>Aplicacion de encuesta de satisfaccion: </strong>';
																			    if ($fila_venfermeria['criterio9']==1) {
																			      echo'SI';
																			    }else {
																			      echo'NO';
																			    }
																			    echo'</p>';
																			  echo'</article>';
																			  echo'<article class="col-md-12 ">';
																			    echo'<p><strong>Observación: </strong><br>'.$fila_venfermeria['obs_visita'].'</p>';
																			  echo'</article>';

																			echo'</section>';
																			echo'<section class="panel-body">';

																			echo'</section>';
																		}
																		if ($fallida==0) {
																			echo'<section class="panel-body alert alert-info">';
																				echo'<article class="col-md-12 ">';
																					echo'<p><strong>Fecha Registro: </strong>'.$fila_venfermeria['freg'].'</p>';
																					echo'<p><strong>Responsable: </strong>'.$fila_venfermeria['nombre'].'</p>';
																				echo'</article>';
																				echo'<article class="col-md-12 ">';
																					echo'<p><strong>Verificacion de datos del paciente y cuidador: </strong>';
																					if ($fila_venfermeria['criterio1']==1) {
																						echo'SI';
																					}else {
																						echo'NO';
																					}
																					echo'</p>';
																					echo'<p><strong>Verificacion de servicios autorizados: </strong>';
																					if ($fila_venfermeria['criterio2']==1) {
																						echo'SI';
																					}else {
																						echo'NO';
																					}
																					echo'</p>';
																					echo'<p><strong>Socializacion de derechos y deberes del usuario y la familia: </strong>';
																					if ($fila_venfermeria['criterio3']==1) {
																						echo'SI';
																					}else {
																						echo'NO';
																					}
																					echo'</p>';
																					echo'<p><strong>Revision de criterios de inclusion y exclusion: </strong>';
																					if ($fila_venfermeria['criterio4']==1) {
																						echo'SI';
																					}else {
																						echo'NO';
																					}
																					echo'</p>';
																					echo'<p><strong>Socializacion del consentimiento informado de servicios domiciliarios: </strong>';
																					if ($fila_venfermeria['criterio5']==1) {
																						echo'SI';
																					}else {
																						echo'NO';
																					}
																					echo'</p>';
																					echo'<p><strong>Socializacion de las funciones del Auxiliar de enfermeria: </strong>';
																					if ($fila_venfermeria['criterio6']==1) {
																						echo'SI';
																					}else {
																						echo'NO';
																					}
																					echo'</p>';
																					echo'<p><strong>Valoracion cefalocaudal del paciente y aplicacion de escalas de valoracion: </strong>';
																					if ($fila_venfermeria['criterio7']==1) {
																						echo'SI';
																					}else {
																						echo'NO';
																					}
																					echo'</p>';
																					echo'<p><strong>Diligenciamiento de la ronda de seguridad: </strong>';
																					if ($fila_venfermeria['criterio8']==1) {
																						echo'SI';
																					}else {
																						echo'NO';
																					}
																					echo'</p>';
																					echo'<p><strong>Aplicacion de encuesta de satisfaccion: </strong>';
																					if ($fila_venfermeria['criterio9']==1) {
																						echo'SI';
																					}else {
																						echo'NO';
																					}
																					echo'</p>';
																				echo'</article>';
																				echo'<article class="col-md-12 ">';
																					echo'<p><strong>Observación: </strong><br>'.$fila_venfermeria['obs_visita'].'</p>';
																				echo'</article>';

																			echo'</section>';
																			echo'<section class="panel-body">';

																			echo'</section>';
																		}
					                        }
					                      }
					                   echo'</div>
					                   <div class="modal-footer">
					                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					                   </div>
					                 </div>

					               </div>
					             </div>';

					             echo'
					             <div id="gdocu_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
					               <div class="modal-dialog">

					                 <!-- Modal content-->
					                 <div class="modal-content">
					                   <div class="modal-header">
					                     <button type="button" class="close" data-dismiss="modal">&times;</button>
					                     <h4 class="modal-title">Gestor Documental </h4>
					                    <p class="text-right"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOC&idpac='.$fila["id_paciente"].'&idadm='.$fila['id_adm_hosp'].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-success"><span class="fa fa-file-text"></span>Cargar documento Nuevo</button></a></p>
					                   </div>
					                   <div class="modal-body">';
					                   $id=$fila['id_paciente'];
					                      $sql_doc="SELECT id_infodocs,nombre_doc,foto,fcargue FROM info_documentacion
					                                      WHERE id_paciente=$id";
					                      if ($tabla_doc=$bd1->sub_tuplas($sql_doc)){
					                        foreach ($tabla_doc as $fila_doc ) {
					                          echo'<section class="panel-body">';
					                            echo'<article class="col-md-12 ">';
					                              echo'<p><strong>Fecha Registro: </strong>'.$fila_doc['fcargue'].'</p>';
					                              echo'<p><strong>Nombre: </strong>'.$fila_doc['nombre_doc'].'</p>';
					                              echo'<p><a href="'.$fila_doc['foto'].'"><button type="button" class="btn btn-info btn-md" ><span class="fa fa-file-pdf-o"></span> </button></a>
					                                     <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=XDOC&idadm='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'">
					                            <button type="button" class="btn btn-danger" ><span class="fa fa-times-circle"></span>	</button></a></p>';
					                            echo'</article>';
					                          echo'</section>';
					                        }
					                      }
					                   echo'</div>
					                   <div class="modal-footer">
					                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					                   </div>
					                 </div>

					               </div>
					             </div>';

					             echo'
					             <div id="sa'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
					               <div class="modal-dialog modal-lg">

					                 <!-- Modal content-->
					                 <div class="modal-content">
					                   <div class="modal-header">
					                     <button type="button" class="close" data-dismiss="modal">&times;</button>
					                     <h4 class="modal-title">Servicios Autorizados</h4>
					                   </div>
					                   <div class="modal-body">';
					                   $id=$fila["id_adm_hosp"];
					                   $y=date('Y');
					                   $mes=date('m');
					                    $sql_master="SELECT a.id_m_aut_dom,cdx_presentacion,dx_presentacion,estado_p_principal,
					                                        b.nomclaseusuario,
					                                        c.id_d_aut_dom, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa, estado_d_aut_dom, intervalo, temporalidad, profesional, f_prof

					                                 FROM m_aut_dom a INNER JOIN clase_usuario b on a.tipo_paciente=b.id_cusuario
					                                                  INNER JOIN d_aut_dom c on c.id_m_aut_dom=a.id_m_aut_dom
					                                 WHERE a.id_adm_hosp=$id ORDER BY finicio DESC";
					                                 //echo $sql_master;
					                    if ($tabla_master=$bd1->sub_tuplas($sql_master)){
					                      foreach ($tabla_master as $fila_master ) {
					                        $cups=$fila_master['cups'];
					                        if ($cups=='890105') {
					                          echo'<section class="panel-body">';
					                            echo'<article class="col-md-12">';
					                              echo'<p><strong>Tipo Paciente: </strong>'.$fila_master['nomclaseusuario'].'</p>';
					                              echo'<p><strong>Dx presentación: </strong>'.$fila_master['cdx_presentacion'].' '.$fila_master['dx_presentacion'].'</p>';

					                            echo'</article>';
					                            echo'<article class="col-md-6">
					                                  <p>'.$fila_master['cups'].' '.$fila_master['procedimiento'].' </p>
					                                  <p><strong>Cantidad:</strong> '.$fila_master['cantidad'].' Turnos </p>
					                                  <p><strong>Temporalidad:</strong> '.$fila_master['intervalo'].' Horas de '.$fila_master['temporalidad'].' </p>
																						<p class="text-"><strong>VIGENCIA:</strong> '.$fila_master['finicio'].' '.$fila_master['ffinal'].' </p>
					                                 </article>';
																			echo'<article class="col-md-6">';
			 				                               $idd=$fila_master['id_d_aut_dom'];
																						 $sql_prof="SELECT a.id_prof_d_dom,a.id_d_aut_dom idd, a.profesional prof, estado_profesional, user_cancela,
													 																		b.id_d_aut_dom, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa,
														 																 estado_d_aut_dom, intervalo, temporalidad,
													 																		c.nombre,tel_user,email
													 													FROM profesional_d_dom a INNER JOIN d_aut_dom b on a.id_d_aut_dom=b.id_d_aut_dom
													 																									 INNER JOIN user c on c.id_user=a.profesional
													 													WHERE a.id_d_aut_dom=$idd and a.estado_profesional=1";
													 													//echo $sql_prof;
													 													if ($tabla_prof=$bd1->sub_tuplas($sql_prof)){
													 														foreach ($tabla_prof as $fila_prof) {
													 															echo'<p><strong>Profesional: </strong>'.$fila_prof['nombre'].' <strong>TEL:</strong>'.$fila_prof['tel_user'].' <strong>EMAIL:</strong>'.$fila_prof['email'].'</p>';
																												echo'<p><a href="Funcion_base/borrar_prof_dom_jefes.php?idd='.$fila_prof["id_prof_d_dom"].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span>	</button></a></p>';

													 														}
													 													}else {
													 														echo'	<p>No hay profesional asignado</p>';
													 													}
			 				                        echo'</article>';
																			echo'<article class="col-md-12">
																						<p>
																						 <button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota_historia_'.$fila_master['id_d_aut_dom'].'">Historico de Notas'.$fila_master['id_d_aut_dom'].'<span class="glyphicon glyphicon-arrow-down"></span> </button>
																						</p>';
																			echo'<p>';
																			echo'<section id="nota_historia_'.$fila_master['id_d_aut_dom'].'" class="collapse">';
																			$turno=$fila_master['intervalo'];
																			$idd=$fila_master["id_d_aut_dom"];
																			if ($turno == 3) {
																				$sql_nota="SELECT a.id_enf_dom3,id_adm_hosp, freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota,
																										 u.nombre
																				FROM enferdom3 a INNER join user u on a.id_user=u.id_user
																				WHERE estado_nota='Realizada' and id_d_aut_dom=$idd ORDER by a.freg3 ASC";
																					//echo $sql;
																				if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																					foreach ($tabla_nota as $fila_nota) {
																						echo'<section class="panel-body">
																									<article class="col-md-8">';
																						echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom3'].'">Nota del '.$fila_nota["freg3"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																						echo'</article>';
																						echo'<article class="col-md-4">';

																						echo'</article>';
																						echo'</section>';

																						echo'<section id="nota'.$fila_nota['id_enf_dom3'].'" class="collapse">';
																						echo"<article class='col-md-6'>\n";
																							echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg3"].'</strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-6'>";
																							echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["hnota1"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["hnota2"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["hnota3"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																						echo"</article>";
																						echo'</section>';
																					}
																				}else {
																					echo"<article class='col-md-12'>";
																						echo'<p class="text-left">No hay registro de notas de enfermeria 3 Horas</p>';
																					echo"</article>";
																				}
																			}
																			if ($turno == 6) {
																				$sql_nota="SELECT a.id_enf_dom6,id_adm_hosp, freg_reg, freg6, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6, estado_nota,
																										 u.nombre
																				FROM enferdom6 a INNER join user u on a.id_user=u.id_user
																				WHERE estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg6 ASC";
																					//echo $sql;
																				if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																					foreach ($tabla_nota as $fila_nota) {
																						echo'<section class="panel-body">
																									<article class="col-md-8">';
																						echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom6'].'">Nota del '.$fila_nota["freg6"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																						echo'</article>';
																						echo'<article class="col-md-4">';

																						echo'</article>';
																						echo'</section>';

																						echo'<section id="nota'.$fila_nota['id_enf_dom6'].'" class="collapse">';
																						echo"<article class='col-md-6'>\n";
																							echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg6"].'</strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-6'>";
																							echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
																						echo"</article>";
																						echo'</section>';
																					}
																				}else {
																					echo"<article class='col-md-12'>";
																						echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
																					echo"</article>";
																				}
																			}
																			if ($turno == 8) {
																				$sql_nota="SELECT a.id_enf_dom8,id_adm_hosp, freg_reg, freg8, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6, estado_nota,hnota7, nota7, hnota8, nota8,
																										 u.nombre
																				FROM enferdom8 a INNER join user u on a.id_user=u.id_user
																				WHERE estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg8 ASC";
																					//echo $sql;
																				if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																					foreach ($tabla_nota as $fila_nota) {
																						echo'<section class="panel-body">
																									<article class="col-md-8">';
																						echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom8'].'">Nota del '.$fila_nota["freg8"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																						echo'</article>';
																						echo'<article class="col-md-4">';

																						echo'</article>';
																						echo'</section>';

																						echo'<section id="nota'.$fila_nota['id_enf_dom8'].'" class="collapse">';
																						echo"<article class='col-md-6'>\n";
																							echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg8"].'</strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-6'>";
																							echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota7"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota7"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota8"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota8"].' </p>';
																						echo"</article>";
																						echo'</section>';
																					}
																				}else {
																					echo"<article class='col-md-12'>";
																						echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
																					echo"</article>";
																				}
																			}
																			if ($turno == 12) {
																				$sql_nota="SELECT a.id_enf_dom12,id_adm_hosp, freg_reg, freg12, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6,
																													hnota7, nota7, hnota8, nota8, hnota9, nota9, hnota10, nota10, hnota11, nota11, hnota12, nota12, estado_nota,
																										 u.nombre
																				FROM enferdom12 a INNER join user u on a.id_user=u.id_user
																				WHERE estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg12 ASC";
																					//echo $sql_nota;
																					//echo $fila_detalle["id_d_aut_dom"];
																				if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																					foreach ($tabla_nota as $fila_nota) {
																						echo'<section class="panel-body">
																									<article class="col-md-8">';
																						echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom12'].'">Nota del '.$fila_nota["freg12"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																						echo'</article>';
																						echo'<article class="col-md-4">';

																						echo'</article>';
																						echo'</section>';

																						echo'<section id="nota'.$fila_nota['id_enf_dom12'].'" class="collapse">';
																						echo"<article class='col-md-6'>\n";
																							echo'<p class="text-danger"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg12"].'</strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-6'>";
																							echo'<p class="text-danger"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota7"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota7"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota8"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota8"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota9"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota9"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota10"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota10"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota11"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota11"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota12"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota12"].' </p>';
																						echo"</article>";
																						echo'</section>';
																					}
																				}else {
																					echo"<article class='col-md-12'>";
																						echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
																					echo"</article>";
																				}
																			}
																			if ($turno == 24) {
																				$sql_nota="SELECT a.id_enf_dom12,id_adm_hosp, freg_reg, freg12, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6,
																													hnota7, nota7, hnota8, nota8, hnota9, nota9, hnota10, nota10, hnota11, nota11, hnota12, nota12, estado_nota,
																										 u.nombre
																				FROM enferdom12 a INNER join user u on a.id_user=u.id_user
																				WHERE  estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg12 ASC";
																					echo $sql_nota;
																				if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																					foreach ($tabla_nota as $fila_nota) {
																						echo'<section class="panel-body">
																									<article class="col-md-8">';
																						echo'<p><button  data-toggle="collapse" class="btn btn-primary text-center col-md-12" data-target="#nota'.$fila_nota['id_enf_dom12'].'">Nota del '.$fila_nota["freg12"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																						echo'</article>';
																						echo'<article class="col-md-4">';

																						echo'</article>';
																						echo'</section>';

																						echo'<section id="nota'.$fila_nota['id_enf_dom12'].'" class="collapse">';
																						echo"<article class='col-md-6'>\n";
																							echo'<p class="text-danger"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg12"].'</strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-6'>";
																							echo'<p class="text-danger"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota7"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota7"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota8"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota8"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota9"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota9"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota10"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota10"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota11"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota11"].' </p>';
																						echo"</article>";
																						echo"<article class='col-md-4'>";
																							echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota12"].' </strong></p>';
																						echo"</article>";
																						echo"<article class='col-md-8'>";
																							echo'<p class="text-left"> '.$fila_nota["nota12"].' </p>';
																						echo"</article>";
																						echo'</section>';
																					}
																				}else {
																					echo"<article class='col-md-12'>";
																						echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
																					echo"</article>";
																				}
																			}
																			echo'</section>';
																			echo'</p>';
																			echo'</article>';
					                            echo'<article class="col-md-12">
					                                  <p>
					                                    <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BITACORA&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'&t=POSITIVO"><button type="button" class="btn btn-success" ><span class="fa fa-thumbs-up"></span>	Comentario Positivo</button></a>
					                                    <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BITACORA&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'&t=NEGATIVO"><button type="button" class="btn btn-danger" ><span class="fa fa-thumbs-down"></span>	Comentario Negativo</button></a>
					                                    <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PROFESIONAL&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-user-md"></span>	Asignar Profesional</button></a>
					                                  </p>
					                                 </article>';
					                          echo'</section>';
					                        }else {
					                          echo'<section class="panel-body">';
					                            echo'<article class="col-md-12">';
					                              echo'<p><strong>Tipo Paciente: </strong>'.$fila_master['nomclaseusuario'].'</p>';
					                              echo'<p><strong>Dx presentación: </strong>'.$fila_master['cdx_presentacion'].' '.$fila_master['dx_presentacion'].'</p>';

					                            echo'</article>';
					                            echo'<article class="col-md-6">
					                                  <p>'.$fila_master['cups'].' '.$fila_master['procedimiento'].' </p>
					                                  <p><strong>Cantidad:</strong> '.$fila_master['cantidad'].' <strong>Frecuancia:</strong> '.$fila_master['intervalo'].' Min.</p>
																						<p class="text-"><strong>VIGENCIA:</strong> '.$fila_master['finicio'].' '.$fila_master['ffinal'].' </p>
					                                 </article>';
																					 echo'<article class="col-md-6">';
			 		 				                               $idd=$fila_master['id_d_aut_dom'];
			 																					 $sql_tera="SELECT a.id_prof_d_dom,a.id_d_aut_dom idd, a.profesional prof, estado_profesional, user_cancela,
			 												 																		b.id_d_aut_dom,
			 												 																		c.nombre,tel_user,email
			 												 													FROM profesional_d_dom a INNER JOIN d_aut_dom b on a.id_d_aut_dom=b.id_d_aut_dom
			 												 																									 INNER JOIN user c on c.id_user=a.profesional
			 												 													WHERE a.id_d_aut_dom=$idd and a.estado_profesional=1";
			 												 													//echo $sql_prof;
			 												 													if ($tabla_tera=$bd1->sub_tuplas($sql_tera)){
			 												 														foreach ($tabla_tera as $fila_tera) {
			 												 															echo'<p><strong>Profesional: </strong>'.$fila_tera['nombre'].' TEL:'.$fila_tera['tel_user'].'<strong>EMAIL:</strong>'.$fila_tera['email'].'</p>';
																														echo'<p><a href="Funcion_base/borrar_prof_dom_jefes.php?idd='.$fila_tera["id_prof_d_dom"].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span>	</button></a></p>';
			 												 														}
			 												 													}else {
			 												 														echo'	<p>No hay profesional asignado</p>';
			 												 													}
			 		 				                        echo'</article>';
					                            echo'<article class="col-md-12">
					                                  <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BITACORA&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'&t=POSITIVO"><button type="button" class="btn btn-success" ><span class="fa fa-thumbs-up"></span>	Comentario Positivo</button></a>
					                                    <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BITACORA&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'&t=NEGATIVO"><button type="button" class="btn btn-danger" ><span class="fa fa-thumbs-down"></span>	Comentario Negativo</button></a>
					                                  </p>
					                                </article>';
					                          echo'</section>';
					                        }

					                      }
					                    }
					                   echo'</div>
					                   <div class="modal-footer">
					                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					                   </div>
					                 </div>

					               </div>
					             </div>';
					           }
					        }else {
										echo'<section class="panel-body"><section class="row">
	 											<article class="col-md-12">
	 											 <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ACUDIENTE&idadm='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'">
	 											 <button type="button" class="btn btn-danger" ><span class="fa fa-users"></span> Agregar Cuidador
	 											 </button></a>
	 											</article>';

	 								 echo'<article class="col-md-12">';
	 								 echo'<p><button type="button" class="btn btn-info " data-toggle="modal" data-target="#gdocu_'.$fila["id_adm_hosp"].'">Gestor Documental</button></p>';
	 								 echo'</article>';

	 								 echo'<article class="col-md-12">';
	 								 echo'<p><button type="button" class="btn btn-warning " data-toggle="modal" data-target="#sa'.$fila["id_adm_hosp"].'">Servicios Autorizados</button></p>';
	 								 echo'</article>';

									 echo'<article class="col-md-12">';
	 								 echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VISITAENFERMERIA&idadm='.$fila['id_adm_hosp'].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-primary"><span class="fa fa-medkit"></span> Visita Enfermería</button></p></a>';
									 echo'<p><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#falla_'.$fila['id_adm_hosp'].'">Fallida</button></p>
												<div id="falla_'.$fila['id_adm_hosp'].'" class="modal fade" role="dialog">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title">Porque esta visita es fallida?</h4>
															</div>
															<div class="modal-body">
															<form action="Funcion_base/visita_fallida.php" method="POST">
																<section class="panel-body">
																	<article class="col-md-12">
																	<label>Observacion</label>
																	<textarea class="form-control" name="observacion"></textarea>
																	<input type="hidden" name="idadmhosp" value="'.$fila["id_adm_hosp"].'">
																	<input type="hidden" name="doc" value="'.$fila["doc_pac"].'">
																	<input type="hidden" name="resp" value="'.$_SESSION['AUT']['id_user'].'">
																	<input type="hidden" name="servicio" value="'.$_REQUEST["servicio"].'">
																	</article>
																</section>
																<section class="panel-body">
																	<article class="col-md-12">
																		<input type="submit" value="Guardar">
																	</article>
																</section>

															</form>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															</div>
														</div>

													</div>
												</div>
									 ';

									 echo'<p><button type="button" class="btn btn-info " data-toggle="modal" data-target="#hvisitas_'.$fila["id_adm_hosp"].'">Historico visitas</button></p>';

	 								 echo'</article>';

	 								 echo'</section></section>';
									 echo'
									 <div id="hvisitas_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
										 <div class="modal-dialog">

											 <!-- Modal content-->
											 <div class="modal-content">
												 <div class="modal-header">
													 <button type="button" class="close" data-dismiss="modal">&times;</button>
													 <h4 class="modal-title">Historico de visitas domiciliarias enfermería </h4>

												 </div>
												 <div class="modal-body">';
												 $id=$fila['id_adm_hosp'];
														$sql_venfermeria="SELECT a.id_visita_dom, freg, criterio1, criterio2, criterio3, criterio4, criterio5, criterio6,
																						 criterio7, criterio8, criterio9, obs_visita,fallida,
																						 b.nombre FROM visita_dom_enfermeria a inner join user b on b.id_user=a.id_user
																						WHERE a.id_adm_hosp=$id";

														if ($tabla_venfermeria=$bd1->sub_tuplas($sql_venfermeria)){
															foreach ($tabla_venfermeria as $fila_venfermeria ) {
																$fallida=$fila_venfermeria['fallida'];

																if ($fallida==1) {
																	echo'<section class="panel-body alert alert-danger">';
																		echo'<article class="col-md-12 ">';
																			echo'<p><strong>Fecha Registro: </strong>'.$fila_venfermeria['freg'].'</p>';
																			echo'<p><strong>Responsable: </strong>'.$fila_venfermeria['nombre'].'</p>';
																		echo'</article>';
																		echo'<article class="col-md-12 ">';
																			echo'<p><strong>Verificacion de datos del paciente y cuidador: </strong>';
																			if ($fila_venfermeria['criterio1']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																			echo'<p><strong>Verificacion de servicios autorizados: </strong>';
																			if ($fila_venfermeria['criterio2']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																			echo'<p><strong>Socializacion de derechos y deberes del usuario y la familia: </strong>';
																			if ($fila_venfermeria['criterio3']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																			echo'<p><strong>Revision de criterios de inclusion y exclusion: </strong>';
																			if ($fila_venfermeria['criterio4']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																			echo'<p><strong>Socializacion del consentimiento informado de servicios domiciliarios: </strong>';
																			if ($fila_venfermeria['criterio5']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																			echo'<p><strong>Socializacion de las funciones del Auxiliar de enfermeria: </strong>';
																			if ($fila_venfermeria['criterio6']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																			echo'<p><strong>Valoracion cefalocaudal del paciente y aplicacion de escalas de valoracion: </strong>';
																			if ($fila_venfermeria['criterio7']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																			echo'<p><strong>Diligenciamiento de la ronda de seguridad: </strong>';
																			if ($fila_venfermeria['criterio8']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																			echo'<p><strong>Aplicacion de encuesta de satisfaccion: </strong>';
																			if ($fila_venfermeria['criterio9']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																		echo'</article>';
																		echo'<article class="col-md-12 ">';
																			echo'<p><strong>Observación: </strong><br>'.$fila_venfermeria['obs_visita'].'</p>';
																		echo'</article>';

																	echo'</section>';
																	echo'<section class="panel-body">';

																	echo'</section>';
																}
																if ($fallida==0) {
																	echo'<section class="panel-body alert alert-info">';
																		echo'<article class="col-md-12 ">';
																			echo'<p><strong>Fecha Registro: </strong>'.$fila_venfermeria['freg'].'</p>';
																			echo'<p><strong>Responsable: </strong>'.$fila_venfermeria['nombre'].'</p>';
																		echo'</article>';
																		echo'<article class="col-md-12 ">';
																			echo'<p><strong>Verificacion de datos del paciente y cuidador: </strong>';
																			if ($fila_venfermeria['criterio1']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																			echo'<p><strong>Verificacion de servicios autorizados: </strong>';
																			if ($fila_venfermeria['criterio2']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																			echo'<p><strong>Socializacion de derechos y deberes del usuario y la familia: </strong>';
																			if ($fila_venfermeria['criterio3']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																			echo'<p><strong>Revision de criterios de inclusion y exclusion: </strong>';
																			if ($fila_venfermeria['criterio4']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																			echo'<p><strong>Socializacion del consentimiento informado de servicios domiciliarios: </strong>';
																			if ($fila_venfermeria['criterio5']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																			echo'<p><strong>Socializacion de las funciones del Auxiliar de enfermeria: </strong>';
																			if ($fila_venfermeria['criterio6']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																			echo'<p><strong>Valoracion cefalocaudal del paciente y aplicacion de escalas de valoracion: </strong>';
																			if ($fila_venfermeria['criterio7']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																			echo'<p><strong>Diligenciamiento de la ronda de seguridad: </strong>';
																			if ($fila_venfermeria['criterio8']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																			echo'<p><strong>Aplicacion de encuesta de satisfaccion: </strong>';
																			if ($fila_venfermeria['criterio9']==1) {
																				echo'SI';
																			}else {
																				echo'NO';
																			}
																			echo'</p>';
																		echo'</article>';
																		echo'<article class="col-md-12 ">';
																			echo'<p><strong>Observación: </strong><br>'.$fila_venfermeria['obs_visita'].'</p>';
																		echo'</article>';

																	echo'</section>';
																	echo'<section class="panel-body">';

																	echo'</section>';
																}
															}
														}
												 echo'</div>
												 <div class="modal-footer">
													 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												 </div>
											 </div>

										 </div>
									 </div>';
					          echo'
					          <div id="gdocu_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
					            <div class="modal-dialog">

					              <!-- Modal content-->
					              <div class="modal-content">
					                <div class="modal-header">
					                  <button type="button" class="close" data-dismiss="modal"><span class="fa fa-times text-danger"></span></button>
					                  <h4 class="modal-title">Gestor Documental </h4>
					                  <p class="text-right"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOC&idpac='.$fila["id_paciente"].'&idadm='.$fila['id_adm_hosp'].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-success"><span class="fa fa-file-text"></span>Cargar documento Nuevo</button></a></p>
					                </div>
					                <div class="modal-body">';
					                $id=$fila['id_paciente'];
					                  $sql_doc="SELECT id_infodocs,nombre_doc,foto,fcargue FROM info_documentacion
					                                  WHERE id_paciente=$id";
					                  if ($tabla_doc=$bd1->sub_tuplas($sql_doc)){
					                    foreach ($tabla_doc as $fila_doc ) {
					                      echo'<section class="panel-body">';
					                        echo'<article class="col-md-12 ">';
					                          echo'<p><strong>Fecha Registro: </strong>'.$fila_doc['fcargue'].'</p>';
					                          echo'<p><strong>Nombre: </strong>'.$fila_doc['nombre_doc'].'</p>';
					                          echo'<p><a href="'.$fila_doc['foto'].'"><button type="button" class="btn btn-info btn-md" ><span class="fa fa-file-pdf-o"></span> </button></a>
					                                  <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=XDOC&idadm='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'">
					                         <button type="button" class="btn btn-danger" ><span class="fa fa-times-circle"></span>	</button></a></p>';
					                        echo'</article>';
					                      echo'</section>';
					                    }
					                  }
					                echo'</div>
					                <div class="modal-footer">
					                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					                </div>
					              </div>

					            </div>
					          </div>';

					           echo'
					           <div id="sa'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
					             <div class="modal-dialog modal-lg">

					               <!-- Modal content-->
					               <div class="modal-content">
					                 <div class="modal-header">
					                   <button type="button" class="close" data-dismiss="modal">&times;</button>
					                   <h4 class="modal-title">Servicios Autorizados</h4>
					                 </div>
					                 <div class="modal-body">';
					                 $id=$fila["id_adm_hosp"];
					                 $y=date('Y');
					                 $mes=date('m');
					                  $sql_master="SELECT a.id_m_aut_dom,cdx_presentacion,dx_presentacion,estado_p_principal,
					                                      b.nomclaseusuario,
					                                      c.id_d_aut_dom, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa,
																								estado_d_aut_dom, intervalo,
																								temporalidad, profesional, f_prof

					                               FROM m_aut_dom a INNER JOIN clase_usuario b on a.tipo_paciente=b.id_cusuario
					                                                INNER JOIN d_aut_dom c on c.id_m_aut_dom=a.id_m_aut_dom
					                               WHERE a.id_adm_hosp=$id  ORDER BY finicio DESC";
					                               //echo $sql_master;
					                  if ($tabla_master=$bd1->sub_tuplas($sql_master)){
					                    foreach ($tabla_master as $fila_master ) {
					                      $cups=$fila_master['cups'];
					                      if ($cups=='890105') {
					                        echo'<section class="panel-body">';
					                          echo'<article class="col-md-12">';
					                            echo'<p><strong>Tipo Paciente: </strong>'.$fila_master['nomclaseusuario'].'</p>';
					                            echo'<p><strong>Dx presentación: </strong>'.$fila_master['cdx_presentacion'].' '.$fila_master['dx_presentacion'].'</p>';

					                          echo'</article>';
					                          echo'<article class="col-md-6">
					                                <p>'.$fila_master['cups'].' '.$fila_master['procedimiento'].' </p>
					                                <p><strong>Cantidad:</strong> '.$fila_master['cantidad'].' Turnos </p>
					                                <p><strong>Temporalidad:</strong> '.$fila_master['intervalo'].' Horas de '.$fila_master['temporalidad'].' </p>
																					<p class="text-"><strong>VIGENCIA:</strong> '.$fila_master['finicio'].' '.$fila_master['ffinal'].' </p>
					                               </article>';
																				 echo'<article class="col-md-12">
																							 <p>
																								<button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota_historia_'.$fila_master['id_d_aut_dom'].'">Historico de Notas<span class="glyphicon glyphicon-arrow-down"></span> </button>
																							 </p>';
																				 echo'<p>';
																				 echo'<section id="nota_historia_'.$fila_master['id_d_aut_dom'].'" class="collapse">';
																				 $turno=$fila_master['intervalo'];
																				 $idd=$fila_master["id_d_aut_dom"];
																				 if ($turno == 3) {
																					 $sql_nota="SELECT a.id_enf_dom3,id_adm_hosp, freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota,
																												u.nombre
																					 FROM enferdom3 a INNER join user u on a.id_user=u.id_user
																					 WHERE estado_nota='Realizada' and id_d_aut_dom=$idd ORDER by a.freg3 ASC";
																						 //echo $sql;
																					 if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																						 foreach ($tabla_nota as $fila_nota) {
																							 echo'<section class="panel-body">
																										 <article class="col-md-12">';
																							 echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom3'].'">Nota del '.$fila_nota["freg3"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																							 echo'</article>';

																							 echo'</section>';

																							 echo'<section id="nota'.$fila_nota['id_enf_dom3'].'" class="collapse">';
																							 echo"<article class='col-md-6'>\n";
																								 echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg3"].'</strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-6'>";
																								 echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["hnota1"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["hnota2"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["hnota3"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																							 echo"</article>";
																							 echo'</section>';
																						 }
																					 }else {
																						 echo"<article class='col-md-12'>";
																							 echo'<p class="text-left">No hay registro de notas de enfermeria 3 Horas</p>';
																						 echo"</article>";
																					 }
																				 }
																				 if ($turno == 6) {
																					 $sql_nota="SELECT a.id_enf_dom6,id_adm_hosp, freg_reg, freg6, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6, estado_nota,
																												u.nombre
																					 FROM enferdom6 a INNER join user u on a.id_user=u.id_user
																					 WHERE estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg6 ASC";
																						 //echo $sql;
																					 if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																						 foreach ($tabla_nota as $fila_nota) {
																							 echo'<section class="panel-body">
																										 <article class="col-md-12">';
																							 echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom6'].'">Nota del '.$fila_nota["freg6"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																							 echo'</article>';

																							 echo'</section>';

																							 echo'<section id="nota'.$fila_nota['id_enf_dom6'].'" class="collapse">';
																							 echo"<article class='col-md-6'>\n";
																								 echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg6"].'</strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-6'>";
																								 echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
																							 echo"</article>";
																							 echo'</section>';
																						 }
																					 }else {
																						 echo"<article class='col-md-12'>";
																							 echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
																						 echo"</article>";
																					 }
																				 }
																				 if ($turno == 8) {
																					 $sql_nota="SELECT a.id_enf_dom8,id_adm_hosp, freg_reg, freg8, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6, estado_nota,hnota7, nota7, hnota8, nota8,
																												u.nombre
																					 FROM enferdom8 a INNER join user u on a.id_user=u.id_user
																					 WHERE estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg8 ASC";
																						 //echo $sql;
																					 if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																						 foreach ($tabla_nota as $fila_nota) {
																							 echo'<section class="panel-body">
																										 <article class="col-md-12">';
																							 echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom8'].'">Nota del '.$fila_nota["freg8"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																							 echo'</article>';

																							 echo'</section>';

																							 echo'<section id="nota'.$fila_nota['id_enf_dom8'].'" class="collapse">';
																							 echo"<article class='col-md-6'>\n";
																								 echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg8"].'</strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-6'>";
																								 echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota7"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota7"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota8"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota8"].' </p>';
																							 echo"</article>";
																							 echo'</section>';
																						 }
																					 }else {
																						 echo"<article class='col-md-12'>";
																							 echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
																						 echo"</article>";
																					 }
																				 }
																				 if ($turno == 12) {
																					 $sql_nota="SELECT a.id_enf_dom12,id_adm_hosp, freg_reg, freg12, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6,
																														 hnota7, nota7, hnota8, nota8, hnota9, nota9, hnota10, nota10, hnota11, nota11, hnota12, nota12, estado_nota,
																												u.nombre
																					 FROM enferdom12 a INNER join user u on a.id_user=u.id_user
																					 WHERE estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg12 ASC";
																						 //echo $sql_nota;
																						 //echo $fila_detalle["id_d_aut_dom"];
																					 if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																						 foreach ($tabla_nota as $fila_nota) {
																							 echo'<section class="panel-body">
																										 <article class="col-md-8">';
																							 echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom12'].'">Nota del '.$fila_nota["freg12"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																							 echo'</article>';
																							 echo'<article class="col-md-4">';

																							 echo'</article>';
																							 echo'</section>';

																							 echo'<section id="nota'.$fila_nota['id_enf_dom12'].'" class="collapse">';
																							 echo"<article class='col-md-6'>\n";
																								 echo'<p class="text-danger"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg12"].'</strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-6'>";
																								 echo'<p class="text-danger"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota7"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota7"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota8"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota8"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota9"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota9"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota10"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota10"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota11"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota11"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota12"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota12"].' </p>';
																							 echo"</article>";
																							 echo'</section>';
																						 }
																					 }else {
																						 echo"<article class='col-md-12'>";
																							 echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
																						 echo"</article>";
																					 }
																				 }
																				 if ($turno == 24) {
																					 $sql_nota="SELECT a.id_enf_dom12,id_adm_hosp, freg_reg, freg12, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6,
																														 hnota7, nota7, hnota8, nota8, hnota9, nota9, hnota10, nota10, hnota11, nota11, hnota12, nota12, estado_nota,
																												u.nombre
																					 FROM enferdom12 a INNER join user u on a.id_user=u.id_user
																					 WHERE  estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg12 ASC";
																						 //echo $sql_nota;
																					 if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																						 foreach ($tabla_nota as $fila_nota) {
																							 echo'<section class="panel-body">
																										 <article class="col-md-8">';
																							 echo'<p><button  data-toggle="collapse" class="btn btn-primary text-center col-md-12" data-target="#nota'.$fila_nota['id_enf_dom12'].'">Nota del '.$fila_nota["freg12"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																							 echo'</article>';
																							 echo'<article class="col-md-4">';

																							 echo'</article>';
																							 echo'</section>';

																							 echo'<section id="nota'.$fila_nota['id_enf_dom12'].'" class="collapse">';
																							 echo"<article class='col-md-6'>\n";
																								 echo'<p class="text-danger"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg12"].'</strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-6'>";
																								 echo'<p class="text-danger"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota7"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota7"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota8"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota8"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota9"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota9"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota10"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota10"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota11"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota11"].' </p>';
																							 echo"</article>";
																							 echo"<article class='col-md-4'>";
																								 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota12"].' </strong></p>';
																							 echo"</article>";
																							 echo"<article class='col-md-8'>";
																								 echo'<p class="text-left"> '.$fila_nota["nota12"].' </p>';
																							 echo"</article>";
																							 echo'</section>';
																						 }
																					 }else {
																						 echo"<article class='col-md-12'>";
																							 echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
																						 echo"</article>";
																					 }
																				 }
																				 echo'</section>';
																				 echo'</p>';
																				 echo'</article>';
					                          echo'<article class="col-md-12">
					                                <p>
					                               <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BITACORA&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'&t=POSITIVO"><button type="button" class="btn btn-success" ><span class="fa fa-thumbs-up"></span>	</button></a>
					                                 <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BITACORA&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'&t=NEGATIVO"><button type="button" class="btn btn-danger" ><span class="fa fa-thumbs-down"></span>	</button></a>
					                                </p>
					                               </article>';
					                      $detalle=$fila_master["id_d_aut_dom"];
					                      $sql_prof="SELECT b.nombre
					                                 FROM profesional_d_dom a INNER JOIN user b on a.profesional=b.id_user
					                                 WHERE id_d_aut_dom=$detalle";
					                      if ($tabla_prof=$bd1->sub_tuplas($sql_prof)){
					                        foreach ($tabla_prof as $fila_prof) {
					                          echo'<article class="col-md-12">
					                                <p>
					                                 <strong>Responsable de atención: </strong> '.$fila_prof['nombre'].'
					                                </p>
					                               </article>';
					                        }
					                      }else {
					                        echo'<article class="col-md-12">
					                              <p>No Existe prefesional asignado</p>
					                                <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDPROFESIONAL&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'"><button type="button" class="btn btn-success" ><span class="fa fa-user-md"></span>	Asignar<br>Profesional</button></a></p>
					                               </article>';
					                      }

					                        echo'</section>';
					                      }else {
					                        echo'<section class="panel-body">';
					                          echo'<article class="col-md-12">';
					                            echo'<p><strong>Tipo Paciente: </strong>'.$fila_master['nomclaseusuario'].'</p>';
					                            echo'<p><strong>Dx presentación: </strong>'.$fila_master['cdx_presentacion'].' '.$fila_master['dx_presentacion'].'</p>';

					                          echo'</article>';
					                          echo'<article class="col-md-6">
					                                <p>'.$fila_master['cups'].' '.$fila_master['procedimiento'].' </p>
					                                <p><strong>Cantidad:</strong> '.$fila_master['cantidad'].' <strong>Frecuencia:</strong> '.$fila_master['intervalo'].' Min.</p>
																					<p class="text-"><strong>VIGENCIA:</strong> '.$fila_master['finicio'].' '.$fila_master['ffinal'].' </p>
					                               </article>';
					                          echo'<article class="col-md-6">
					                                <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BITACORA&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'&t=POSITIVO"><button type="button" class="btn btn-success" ><span class="fa fa-thumbs-up"></span>	</button></a>
					                                  <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BITACORA&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'&t=NEGATIVO"><button type="button" class="btn btn-danger" ><span class="fa fa-thumbs-down"></span>	</button></a>
					                                </p>
					                              </article>';
					                            $detalle=$fila_master["id_d_aut_dom"];
					                            $sql_prof="SELECT b.nombre
					                                       FROM profesional_d_dom a INNER JOIN user b on a.profesional=b.id_user
					                                       WHERE id_d_aut_dom=$detalle";
					                            if ($tabla_prof=$bd1->sub_tuplas($sql_prof)){
					                              foreach ($tabla_prof as $fila_prof) {
					                                echo'<article class="col-md-12">
					                                      <p>
					                                       <strong>Responsable de atención: </strong> '.$fila_prof['nombre'].'
																								 <p><a href="Funcion_base/borrar_prof_dom_jefes.php?idd='.$fila_tera["id_prof_d_dom"].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span>	</button></a></p>
					                                      </p>';
					                                 echo'</article>';
					                              }
					                            }else {
					                              echo'<article class="col-md-12">
					                                    <p>No Existe prefesional asignado</p>
					                                   </article>';
					                            }
					                        echo'</section>';
					                      }

					                    }
					                  }
					                 echo'</div>
					                 <div class="modal-footer">
					                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					                 </div>
					               </div>

					             </div>
					           </div>';
					        }


					    echo'</td>';
					    echo'<th class="text-left">';
					    echo'<section class="row">';
					          $id=$fila['id_adm_hosp'];
					          $sql_downton="SELECT count(id_esc_downton) cuantos	 FROM escala_downton WHERE id_adm_hosp=$id";
					          if ($tabla_downton=$bd1->sub_tuplas($sql_downton)){
					            foreach ($tabla_downton as $fila_downton ) {
					              $id_c=$fila_downton['cuantos'];
					              if ($id_c >= 0) {
					                echo'<article class="col-md-6">';
					                echo'<button type="button" class="btn btn-info " data-toggle="modal" data-target="#historia_downton_'.$fila["id_adm_hosp"].'">Historico Downton</button>';
					                echo'</article>';
					                echo'<article class="col-md-6">';
					                echo'<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOWNTON&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-square"></span> </button></a>';
					                echo'</article>';
					                echo'
					                <div id="historia_downton_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
					                  <div class="modal-dialog">

					                    <!-- Modal content-->
					                    <div class="modal-content">
					                      <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal">&times;</button>
					                        <h4 class="modal-title">Historico de registros Escala Downton</h4>
					                      </div>
					                      <div class="modal-body">';
					                        $sql_h_downton="SELECT a.id_esc_downton,freg,total,criterio_total,sugerencia,b.nombre
					                                        FROM escala_downton a inner join user b on a.id_user=b.id_user
					                                        WHERE id_adm_hosp=$id and a.estado is null
					                                        ORDER BY freg DESC";
					                        if ($tabla_h_downton=$bd1->sub_tuplas($sql_h_downton)){
					                          foreach ($tabla_h_downton as $fila_h_downton ) {
					                            echo'<section class="panel-body">';
					                            $riesgo=$fila_h_downton['criterio_total'];
					                            if ($riesgo=='BAJO RIESGO') {
					                                echo'<article class="col-md-12 alert alert-success">';
					                                echo'<p><strong>Fecha Registro: </strong>'.$fila_h_downton['freg'].'</p>';
					                                echo'<p><strong>Clasificación: </strong>'.$fila_h_downton['criterio_total'].'</p>';
					                                echo'<p><strong>Total: </strong>'.$fila_h_downton['total'].'</p>';
					                                echo'<p><strong>Responsable: </strong>'.$fila_h_downton['nombre'].'</p>';
																					echo'<p>'.$fila_h_downton['sugerencia'].'</p>';
					                                echo'</article>';
					                                echo '<article class="col-md-4">';
					                                echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_downton['id_esc_downton'].'&tabla=downton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
					                                echo'</article>';
					                            }
					                            if ($riesgo=='ALTO RIESGO') {
					                                echo'<article class="col-md-12 alert alert-danger">';
					                                echo'<p><strong>Fecha Registro: </strong>'.$fila_h_downton['freg'].'</p>';
					                                echo'<p><strong>Clasificación: </strong>'.$fila_h_downton['criterio_total'].'</p>';
					                                echo'<p><strong>Total: </strong>'.$fila_h_downton['total'].'</p>';
					                                echo'<p><strong>Responsable: </strong>'.$fila_h_downton['nombre'].'</p>';
																					echo'<p>'.$fila_h_downton['sugerencia'].'</p>';
					                                echo'</article>';
					                                echo '<article class="col-md-4">';
					                                echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_downton['id_esc_downton'].'&tabla=downton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
					                                echo'</article>';
					                            }
					                            echo'</section>';
					                          }
					                        }
					                      echo'</div>
					                      <div class="modal-footer">
					                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					                      </div>
					                    </div>

					                  </div>
					                </div>';
					              }
					            }
					          }
					          echo'</section>';
					          echo'<section class="row">';
					          $id=$fila['id_adm_hosp'];
					          $sql_barthel="SELECT count(id_esc_barthel) cuantos	 FROM escala_barthel WHERE id_adm_hosp=$id";
					          if ($tabla_barthel=$bd1->sub_tuplas($sql_barthel)){
					            foreach ($tabla_barthel as $fila_barthel ) {
					              $id_c=$fila_barthel['cuantos'];
					              if ($id_c >= 0) {
					                echo'<br><article class="col-md-6">';
					                echo'<button type="button" class="btn btn-info " data-toggle="modal" data-target="#historia_barthel_'.$fila["id_adm_hosp"].'">Historico Barthel</button>';
					                echo'</article>';
					                echo'<article class="col-md-6">';
					                echo'<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BARTHEL&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-square"></span> </button></a>';
					                echo'</article>';
					                echo'
					                <div id="historia_barthel_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
					                  <div class="modal-dialog">

					                    <!-- Modal content-->
					                    <div class="modal-content">
					                      <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal">&times;</button>
					                        <h4 class="modal-title">Historico de registros Escala Barthel</h4>
					                      </div>
					                      <div class="modal-body">';
					                        $sql_h_barthel="SELECT a.id_esc_barthel,freg,total,calificacion_total,b.nombre
					                                        FROM escala_barthel a inner join user b on a.id_user=b.id_user
					                                        WHERE id_adm_hosp=$id and a.estado is null
					                                        ORDER BY freg DESC";

					                        if ($tabla_h_barthel=$bd1->sub_tuplas($sql_h_barthel)){
					                          foreach ($tabla_h_barthel as $fila_h_barthel ) {
					                            echo'<section class="panel-body">';
					                            $riesgo=$fila_h_barthel['calificacion_total'];
					                            if ($riesgo=='Dependencia total') {
					                              echo'<article class="col-md-12 alert alert-danger">';
					                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_barthel['freg'].'</p>';
					                              echo'<p><strong>Clasificación: </strong>'.$fila_h_barthel['calificacion_total'].'</p>';
					                              echo'<p><strong>Total: </strong>'.$fila_h_barthel['total'].'</p>';
					                              echo'<p><strong>Responsable: </strong>'.$fila_h_barthel['nombre'].'</p>';
																				echo'<p>'.$fila_h_downton['observacion'].'</p>';
					                              echo'</article>';
					                              echo '<article class="col-md-4">';
					                              echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_barthel['id_esc_barthel'].'&tabla=barthel"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
					                              echo'</article>';
					                            }
					                            if ($riesgo=='Dependencia severa') {
					                              echo'<article class="col-md-12 alert alert-warning">';
					                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_barthel['freg'].'</p>';
					                              echo'<p><strong>Clasificación: </strong>'.$fila_h_barthel['calificacion_total'].'</p>';
					                              echo'<p><strong>Total: </strong>'.$fila_h_barthel['total'].'</p>';
					                              echo'<p><strong>Responsable: </strong>'.$fila_h_barthel['nombre'].'</p>';
																				echo'<p>'.$fila_h_downton['observacion'].'</p>';
					                              echo'</article>';
					                              echo '<article class="col-md-4">';
					                              echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_barthel['id_esc_barthel'].'&tabla=barthel"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
					                              echo'</article>';
					                            }
					                            if ($riesgo=='Dependencia moderada') {
					                              echo'<article class="col-md-12 alert alert-primary">';
					                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_barthel['freg'].'</p>';
					                              echo'<p><strong>Clasificación: </strong>'.$fila_h_barthel['calificacion_total'].'</p>';
					                              echo'<p><strong>Total: </strong>'.$fila_h_barthel['total'].'</p>';
					                              echo'<p><strong>Responsable: </strong>'.$fila_h_barthel['nombre'].'</p>';
																				echo'<p>'.$fila_h_downton['observacion'].'</p>';
					                              echo'</article>';
					                              echo '<article class="col-md-4">';
					                              echo'<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=XESCALA&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_h_barthel['id_esc_barthel'].'&tabla=barthel"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> </button></a>';
					                              echo'</article>';
					                            }
					                            if ($riesgo=='Dependencia leve') {
					                              echo'<article class="col-md-12 alert alert-info">';
					                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_barthel['freg'].'</p>';
					                              echo'<p><strong>Clasificación: </strong>'.$fila_h_barthel['calificacion_total'].'</p>';
					                              echo'<p><strong>Total: </strong>'.$fila_h_barthel['total'].'</p>';
					                              echo'<p><strong>Responsable: </strong>'.$fila_h_barthel['nombre'].'</p>';
																				echo'<p>'.$fila_h_downton['observacion'].'</p>';
					                              echo'</article>';
					                              echo '<article class="col-md-4">';
					                              echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_barthel['id_esc_barthel'].'&tabla=barthel"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
					                              echo'</article>';
					                            }
					                            if ($riesgo=='Independencia') {
					                              echo'<article class="col-md-12 alert alert-success">';
					                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_barthel['freg'].'</p>';
					                              echo'<p><strong>Clasificación: </strong>'.$fila_h_barthel['calificacion_total'].'</p>';
					                              echo'<p><strong>Total: </strong>'.$fila_h_barthel['total'].'</p>';
					                              echo'<p><strong>Responsable: </strong>'.$fila_h_barthel['nombre'].'</p>';
																				echo'<p>'.$fila_h_downton['observacion'].'</p>';
					                              echo'</article>';
					                              echo '<article class="col-md-4">';
					                              echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_barthel['id_esc_barthel'].'&tabla=barthel"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
					                              echo'</article>';
					                            }
					                            echo'</section>';
					                          }
					                        }
					                      echo'</div>
					                      <div class="modal-footer">
					                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					                      </div>
					                    </div>

					                  </div>
					                </div>';
					              }
					            }
					          }
					          echo'</section>';

					          echo'<section class="row">';
					          $id=$fila['id_adm_hosp'];
					          $sql_norton="SELECT count(id_esc_norton) cuantos	 FROM escala_norton WHERE id_adm_hosp=$id";
					          if ($tabla_norton=$bd1->sub_tuplas($sql_norton)){
					            foreach ($tabla_norton as $fila_norton ) {
					              $id_c=$fila_norton['cuantos'];
					              if ($id_c >= 0) {
					                echo'<br>
					                <article class="col-md-6">';
					                echo'<button type="button" class="btn btn-info " data-toggle="modal" data-target="#historia_norton_'.$fila["id_adm_hosp"].'">Historico Norton</button>';
					                echo'</article>';
					                echo'<article class="col-md-6">';
					                echo'<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NORTON&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-square"></span> </button></a>';
					                echo'</article>';
					                echo'
					                <div id="historia_norton_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
					                  <div class="modal-dialog">

					                    <!-- Modal content-->
					                    <div class="modal-content">
					                      <div class="modal-header">
					                        <button type="button" class="close" data-dismiss="modal">&times;</button>
					                        <h4 class="modal-title">Historico de registros Escala Norton</h4>
					                      </div>
					                      <div class="modal-body">';
					                        $sql_h_norton="SELECT a.id_esc_norton,freg,total,riesgo,observacion,b.nombre
					                                        FROM escala_norton a inner join user b on a.id_user=b.id_user
					                                        WHERE id_adm_hosp=$id and a.estado is null
					                                        ORDER BY freg DESC";
					                        if ($tabla_h_norton=$bd1->sub_tuplas($sql_h_norton)){
					                          foreach ($tabla_h_norton as $fila_h_norton ) {
					                            echo'<section class="panel-body">';
					                            $riesgo=$fila_h_norton['riesgo'];
					                            if ($riesgo=='MUY ALTO') {
					                              echo'<article class="col-md-12 alert alert-danger">';
					                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_norton['freg'].'</p>';
					                              echo'<p><strong>Clasificación: </strong>'.$fila_h_norton['riesgo'].'</p>';
					                              echo'<p><strong>Total: </strong>'.$fila_h_norton['total'].'</p>';
					                              echo'<p><strong>Responsable: </strong>'.$fila_h_norton['nombre'].'</p>';
					                              echo'<p><strong>Observación: </strong>'.$fila_h_norton['observacion'].'</p>';
					                              echo'</article>';
					                              echo '<article class="col-md-4">';
					                              echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_norton['id_esc_norton'].'&tabla=norton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
					                              echo'</article>';

					                            }
					                            if ($riesgo=='ALTO') {
					                              echo'<article class="col-md-12 alert alert-warning">';
					                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_norton['freg'].'</p>';
					                              echo'<p><strong>Clasificación: </strong>'.$fila_h_norton['riesgo'].'</p>';
					                              echo'<p><strong>Total: </strong>'.$fila_h_norton['total'].'</p>';
					                              echo'<p><strong>Responsable: </strong>'.$fila_h_norton['nombre'].'</p>';
					                              echo'<p><strong>Observación: </strong>'.$fila_h_norton['observacion'].'</p>';
					                              echo'</article>';
					                              echo '<article class="col-md-4">';
					                              echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_norton['id_esc_norton'].'&tabla=norton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
					                              echo'</article>';
					                            }
					                            if ($riesgo=='MEDIO') {
					                              echo'<article class="col-md-12 alert alert-primary">';
					                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_norton['freg'].'</p>';
					                              echo'<p><strong>Clasificación: </strong>'.$fila_h_norton['riesgo'].'</p>';
					                              echo'<p><strong>Total: </strong>'.$fila_h_norton['total'].'</p>';
					                              echo'<p><strong>Responsable: </strong>'.$fila_h_norton['nombre'].'</p>';
					                              echo'<p><strong>Observación: </strong>'.$fila_h_norton['observacion'].'</p>';
					                              echo'</article>';
					                              echo '<article class="col-md-4">';
					                              echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_norton['id_esc_norton'].'&tabla=norton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
					                              echo'</article>';
					                            }
					                            if ($riesgo=='NO RIESGO') {
					                              echo'<article class="col-md-12 alert alert-info">';
					                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_norton['freg'].'</p>';
					                              echo'<p><strong>Clasificación: </strong>'.$fila_h_norton['riesgo'].'</p>';
					                              echo'<p><strong>Total: </strong>'.$fila_h_norton['total'].'</p>';
					                              echo'<p><strong>Responsable: </strong>'.$fila_h_norton['nombre'].'</p>';
					                              echo'<p><strong>Observación: </strong>'.$fila_h_norton['observacion'].'</p>';
					                              echo'</article>';
					                              echo '<article class="col-md-4">';
					                              echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_norton['id_esc_norton'].'&tabla=norton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
					                              echo'</article>';
					                            }
					                            echo'</section>';
					                          }
					                        }
					                      echo'</div>
					                      <div class="modal-footer">
					                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					                      </div>
					                    </div>

					                  </div>
					                </div>';
					              }
					            }
					          }
					          echo'</section>';
					          echo'<section class="row">';
					          echo'<article class="col-md-12">';
					              $ida=$fila['id_adm_hosp'];
					              $sql_inclusion="SELECT id_inclusion_dom FROM inclusion_domiciliarios WHERE id_adm_hosp=$ida";
					              if ($tabla_inclusion=$bd1->sub_tuplas($sql_inclusion)){
					                foreach ($tabla_inclusion as $fila_inclusion) {
					                  $idi=$fila_inclusion['id_inclusion_dom'];
					                  if ($idi=='') {
					                    echo'<br>
					                    <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=INCLUSION&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-plus-square"></span> Criterios Inclusión</button></a>';
					                  }
					                  if ($idi!='') {
					                    echo'<br>
					                    <p>Ya existe Formato de inclusión en esta Admisión</p>';
					                  }
					                }
					              }else {
					                echo'<br>
					                <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=INCLUSION&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-plus-square"></span> Criterios Inclusión</button></a>';
					              }
					          echo'</article>';
					          echo'<article class="col-md-12">';
					              $ida=$fila['id_adm_hosp'];
					              $y=date('Y');
					              $m=date('m');
					              $sqlid_ronseg_dom="SELECT id_ronseg_dom FROM ronda_seguridad WHERE id_adm_hosp=$ida and freg_ronda BETWEEN '$y-$m-1' and '$y-$m-31'";
					              //echo $sqlid_ronseg_dom;
					              if ($tablaid_ronseg_dom=$bd1->sub_tuplas($sqlid_ronseg_dom)){
					                foreach ($tablaid_ronseg_dom as $filaid_ronseg_dom) {
					                  $idi=$filaid_ronseg_dom['id_ronseg_dom'];

					                  if ($idi=='') {
					                    echo'<br>
					                    <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=RONDA&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-danger" ><span class="fa fa-plus-square"></span> Ronda Seguridad</button></a>';
					                  }
					                  if ($idi!='') {
					                    echo'<br>
					                    <p>Ya existe Formato de Ronda de seguridad este mes</p>';
					                  }
					                }
					              }else {
					                echo'<br>
					                <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=RONDA&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-danger" ><span class="fa fa-plus-square"></span> Ronda Seguridad</button></a>';
					              }
					          echo'</article>';
					          echo'<article class="col-md-12">';
					              $ida=$fila['id_adm_hosp'];
					              $y=date('Y');
					              $m=date('m');
					              $sql_encu_dom="SELECT id_encuesta_dom FROM encuesta_dom WHERE id_adm_hosp=$ida and freg_encuesta BETWEEN '$y-$m-1' and '$y-$m-31'";
					              //echo $sql_encu_dom;
					              if ($tabla_encu_dom=$bd1->sub_tuplas($sql_encu_dom)){
					                foreach ($tabla_encu_dom as $fila_encu_dom) {
					                  $idi=$fila_encu_dom['id_encuesta_dom'];

					                  if ($idi=='') {
					                    echo'<br>
					                    <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ENCUESTA&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-info" ><span class="fa fa-plus-square"></span> Encuesta Satisfacción</button></a>';
					                  }
					                  if ($idi!='') {
					                    echo'<br>
					                    <p>Ya existe Formato de encuesta este mes</p>';
					                  }
					                }
					              }else {
					                echo'<br>
					                <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ENCUESTA&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-info" ><span class="fa fa-plus-square"></span> Encuesta Satisfacción</button></a>';
					              }
					          echo'</article>';
					          echo'</section>';
					    echo'</th>';
					    echo'</th>';
					    echo "</tr>\n";
						}

				  }
				}
		 	}
			//filtro por nombre
			$nom=$_REQUEST["nom"];
		 	if (isset($nom)) {
				$nom=$_REQUEST["nom"];
				$jefe=$_SESSION["AUT"]["id_user"];
				$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,dir_pac,tel_pac,zonificacion,
				             a.id_adm_hosp,fingreso_hosp,hingreso_hosp,estado_salida,
				             s.nom_sedes,
				             e.nom_eps
				      FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
				                       LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
				                       LEFT JOIN eps e on a.id_eps=e.id_eps
				      WHERE p.nom_completo like '%$nom%' and a.estado_adm_hosp='Activo' and tipo_servicio='Domiciliarios' and p.jefe_zona=$jefe";
				      $i=1;
							//echo $sql;
							if ($tabla=$bd1->sub_tuplas($sql)){
							  //echo $sql;
							  foreach ($tabla as $fila) {
									$estado_salida=$fila['estado_salida'];
									if ($estado_salida=='Fallecimiento') {
										echo"<tr >\n";
										echo'<td>Paciente Fallecido</td>';
										echo"</tr >\n";
									}else {
										echo"<tr >\n";
								    echo'<td>'.$i++.'</td>';
								    echo'<td class="text-Left">
								          <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
								          <p><strong>ADM: </strong>'.$fila["id_adm_hosp"].'</p>
								          <p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>
								          <p><strong>Dirección: </strong>'.$fila["dir_pac"].'</p>
								          <p><strong>Teléfono: </strong>'.$fila["tel_pac"].'</p>
								          <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EDITPACIENTE&idpac='.$fila["id_paciente"].'&docc='.$fila['doc_pac'].'">
								          <button type="button" class="btn btn-warning">
								          <span class="fa fa-edit"></span> Editar paciente</button></a></p>';
								          // zonificacion del paciente asignacion del barrio
								          if ($fila['zonificacion']=='') {
								            echo'<p class="alert alert-danger animated bounce text-center"><span class="fa fa-warning"></span> No tiene Zona asignada.
								            <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDBARRIO&idpac='.$fila["id_paciente"].'&docc='.$fila['doc_pac'].'">
								            <button type="button" class="btn btn-primary">
								            <span class="fa fa-plus-circle"></span> Adicionar Barrio</button></a></p>
								            ';
								          }else {
								            $zona=$fila['zonificacion'];
								            $sql_barrios="SELECT a.nom_barrio,b.nom_upz,c.nom_localidad
								                          FROM barrio a inner join upz b on a.id_upz=b.id_upz
								                                        inner join localidades c on c.id_localidad=b.id_localidad
								                          WHERE a.id_barrio=$zona";
								            if ($tabla_barrios=$bd1->sub_tuplas($sql_barrios)){
								              foreach ($tabla_barrios as $fila_barrios ) {
								                echo'<p class="text-info"><strong>Barrio:</strong> '.$fila_barrios['nom_barrio'].'</p>
								                     <p class="text-info"><strong>Localidad:</strong> '.$fila_barrios['nom_localidad'].'</p>
								                     <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EDITBARRIO&idpac='.$fila["id_paciente"].'&docc='.$fila['doc_pac'].'">
								                     <button type="button" class="btn btn-warning">
								                     <span class="fa fa-edit"></span> Editar Barrio</button></a></p>';
								              }
								            }

								          }
													$fecha=date('Y-m-d');
													$hora=date('H:i');
													echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#dinvasivo_'.$fila['id_paciente'].'"> Dispositvos Invasivos</button></p>
													<div id="dinvasivo_'.$fila['id_paciente'].'" class="modal fade" role="dialog">
														<div class="modal-dialog">

															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title">Registro y consulta dispositivos invasivos</h4>
																</div>
																<div class="modal-body">
																<form action="Funcion_base/add_dinvasivoJ.php" method="POST">
																	<section class="panel-body">
																		<article class="col-md-12">
																			<label>Seleccione Dispositivo:</label>
																			<select class="form-control" name="dispositivo_invasivo">
																				<option values="Traqueostomia">Traqueostomia</option>
																				<option values="Esofagostomia">Esofagostomia</option>
																				<option values="Gastrostomia">Gastrostomia</option>
																				<option values="Yeyunostomia">Yeyunostomia</option>
																				<option values="Ileostomia">Ileostomia</option>
																				<option values="Colostomia">Colostomia</option>
																				<option values="Nefrostomia">Nefrostomia</option>
																				<option values="Urostomia">Urostomia</option>
																				<option values="Sonda Nasogastrica">Sonda Nasogastrica</option>
																				<option values="Sonda Orogastrica">Sonda Orogastrica</option>
																				<option values="Sonda Vesical">Sonda Vesical</option>
																				<option values="Cateter Subcutaneo">Cateter Subcutaneo</option>
																				<option values="Fístula">Fístula</option>
																			</select>
																		</article>
																		<article class="col-md-12">
																			<label>Observación:</label>
																			<textarea class="form-control" name="obs_dinvasivo"></textarea>

																			<input type="hidden" name="fecha_dinvasivo" value="'.$fecha.'">
																			<input type="hidden" name="hora_dinvasivo" value="'.$hora.'">
																			<input type="hidden" name="id_user" value="'.$_SESSION['AUT']['id_user'].'">
																			<input type="hidden" name="id_paciente" value="'.$fila['id_paciente'].'">
																			<input type="hidden" name="doc" value="'.$fila['doc_pac'].'">
																			</select>
																		</article>
																	</section>
																	<section class="panel-body">
																		<article class="col-md-12">
																			<input type="submit" value="Guardar">
																		</article>
																	</section>

																</form>';
																$pac=$fila['id_paciente'];
																$sql_dinvasivo="SELECT id_dinvasivo, id_paciente, id_user, fecha_dinvasivo,
																										 hora_dinvasivo, dispositivo_invasivo, obs_dinvasivo, estado_dinvasivo
																							FROM dispositivos_invasivos
																							WHERE id_paciente=$pac";
																							if ($tabla_dinvasivo=$bd1->sub_tuplas($sql_dinvasivo)){
																								 foreach ($tabla_dinvasivo as $fila_dinvasivo) {
																									 echo'<p class="text-primary"><strong>Dispositivo: </strong>'.$fila_dinvasivo['dispositivo_invasivo'].'</p>';
																									 echo'<p class="text-primary"><strong>Observacion: </strong>'.$fila_dinvasivo['obs_dinvasivo'].'</p>';
																								 }
																							}
																echo'</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																</div>
															</div>

														</div>
													</div>';
								    echo'</td>';
								    echo'<td class="text-left">

								          <p><strong>INGRESO: </strong>'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</p>
								          <p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>';
								        $idadm=$fila['id_adm_hosp'];
								        $sqlacu="SELECT id_infoacu,nombre_acu,tel_acu,dir_acu,parentesco_acu
								                   FROM info_acudiente
								                   WHERE id_adm_hosp=$idadm";
								        //echo $sql_adm;
								        if ($tablaacu=$bd1->sub_tuplas($sqlacu)){
								           foreach ($tablaacu as $filaacu) {
								             echo'
								             <p class="text-success"><u><b>DATOS DE CUIDADOR PRIMARIO</b></p>
								             <p class="text-success"><strong>Cuidador: </strong>'.$filaacu['nombre_acu'].'</p>
								             <p class="text-success"><strong>Contacto y Ubicación: </strong>'.$filaacu['tel_acu'].'-'.$filaacu['dir_acu'].'</p>
								             <p class="text-success"><strong>Parentesco: </strong>'.$filaacu['parentesco_acu'].'</p>
								             <p class="text-success">	<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EACUDIENTE&idacu='.$fila["id_infoacu"].'&docc='.$fila["doc_pac"].'">
								               <button type="button" class="btn btn-warning btn-xs" ><span class="fa fa-edit"></span> Editar Cuidador
								               </button></a></p>
								            ';
								             echo'<section class="row">
								             <article class="col-md-12">';
								             echo'<p><button type="button" class="btn btn-info " data-toggle="modal" data-target="#gdocu_'.$fila["id_adm_hosp"].'">Gestor Documental</button></p>';
								             echo'</article>';

								             echo'<article class="col-md-12">';
								             echo'<p><button type="button" class="btn btn-warning " data-toggle="modal" data-target="#sa'.$fila["id_adm_hosp"].'">Servicios Autorizados</button></p>';
								             echo'</article>';

														 echo'<article class="col-md-12">';
														 echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VISITAENFERMERIA&idadm='.$fila['id_adm_hosp'].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-primary"><span class="fa fa-medkit"></span> Visita Enfermería</button></p></a>';
														 echo'<p><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#falla_'.$fila['id_adm_hosp'].'">Fallida</button></p>
																	<div id="falla_'.$fila['id_adm_hosp'].'" class="modal fade" role="dialog">
																		<div class="modal-dialog">
																			<div class="modal-content">
																				<div class="modal-header">
																					<button type="button" class="close" data-dismiss="modal">&times;</button>
																					<h4 class="modal-title">Porque esta visita es fallida?</h4>
																				</div>
																				<div class="modal-body">
																				<form action="Funcion_base/visita_fallida.php" method="POST">
																					<section class="panel-body">
																						<article class="col-md-12">
																						<label>Observacion</label>
																						<textarea class="form-control" name="observacion"></textarea>
																						<input type="hidden" name="idadmhosp" value="'.$fila["id_adm_hosp"].'">
																						<input type="hidden" name="doc" value="'.$fila["doc_pac"].'">
																						<input type="hidden" name="resp" value="'.$_SESSION['AUT']['id_user'].'">
																						<input type="hidden" name="servicio" value="'.$_REQUEST["servicio"].'">
																						</article>
																					</section>
																					<section class="panel-body">
																						<article class="col-md-12">
																							<input type="submit" value="Guardar">
																						</article>
																					</section>

																				</form>
																				</div>
																				<div class="modal-footer">
																					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																				</div>
																			</div>

																		</div>
																	</div>
														 ';

														 echo'<p><button type="button" class="btn btn-info " data-toggle="modal" data-target="#hvisitas_'.$fila["id_adm_hosp"].'">Historico visitas</button></p>';
														 echo'</article>';

								             echo'</section>';
														 echo'
								             <div id="hvisitas_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
								               <div class="modal-dialog">

								                 <!-- Modal content-->
								                 <div class="modal-content">
								                   <div class="modal-header">
								                     <button type="button" class="close" data-dismiss="modal">&times;</button>
								                     <h4 class="modal-title">Historico de visitas domiciliarias enfermería </h4>

								                   </div>
								                   <div class="modal-body">';
								                   $id=$fila['id_adm_hosp'];
								                      $sql_venfermeria="SELECT a.id_visita_dom, freg, criterio1, criterio2, criterio3, criterio4, criterio5, criterio6,
																											 criterio7, criterio8, criterio9, obs_visita,fallida,
																											 b.nombre
																											 FROM visita_dom_enfermeria a inner join user b on b.id_user=a.id_user
								                                      WHERE a.id_adm_hosp=$id";

								                      if ($tabla_venfermeria=$bd1->sub_tuplas($sql_venfermeria)){
								                        foreach ($tabla_venfermeria as $fila_venfermeria ) {
								                          $fallida=$fila_venfermeria['fallida'];
																					if ($fallida==1) {
																						echo'<section class="panel-body alert alert-danger">';
																						  echo'<article class="col-md-12 ">';
																						    echo'<p><strong>Fecha Registro: </strong>'.$fila_venfermeria['freg'].'</p>';
																						    echo'<p><strong>Responsable: </strong>'.$fila_venfermeria['nombre'].'</p>';
																						  echo'</article>';
																						  echo'<article class="col-md-12 ">';
																						    echo'<p><strong>Verificacion de datos del paciente y cuidador: </strong>';
																						    if ($fila_venfermeria['criterio1']==1) {
																						      echo'SI';
																						    }else {
																						      echo'NO';
																						    }
																						    echo'</p>';
																						    echo'<p><strong>Verificacion de servicios autorizados: </strong>';
																						    if ($fila_venfermeria['criterio2']==1) {
																						      echo'SI';
																						    }else {
																						      echo'NO';
																						    }
																						    echo'</p>';
																						    echo'<p><strong>Socializacion de derechos y deberes del usuario y la familia: </strong>';
																						    if ($fila_venfermeria['criterio3']==1) {
																						      echo'SI';
																						    }else {
																						      echo'NO';
																						    }
																						    echo'</p>';
																						    echo'<p><strong>Revision de criterios de inclusion y exclusion: </strong>';
																						    if ($fila_venfermeria['criterio4']==1) {
																						      echo'SI';
																						    }else {
																						      echo'NO';
																						    }
																						    echo'</p>';
																						    echo'<p><strong>Socializacion del consentimiento informado de servicios domiciliarios: </strong>';
																						    if ($fila_venfermeria['criterio5']==1) {
																						      echo'SI';
																						    }else {
																						      echo'NO';
																						    }
																						    echo'</p>';
																						    echo'<p><strong>Socializacion de las funciones del Auxiliar de enfermeria: </strong>';
																						    if ($fila_venfermeria['criterio6']==1) {
																						      echo'SI';
																						    }else {
																						      echo'NO';
																						    }
																						    echo'</p>';
																						    echo'<p><strong>Valoracion cefalocaudal del paciente y aplicacion de escalas de valoracion: </strong>';
																						    if ($fila_venfermeria['criterio7']==1) {
																						      echo'SI';
																						    }else {
																						      echo'NO';
																						    }
																						    echo'</p>';
																						    echo'<p><strong>Diligenciamiento de la ronda de seguridad: </strong>';
																						    if ($fila_venfermeria['criterio8']==1) {
																						      echo'SI';
																						    }else {
																						      echo'NO';
																						    }
																						    echo'</p>';
																						    echo'<p><strong>Aplicacion de encuesta de satisfaccion: </strong>';
																						    if ($fila_venfermeria['criterio9']==1) {
																						      echo'SI';
																						    }else {
																						      echo'NO';
																						    }
																						    echo'</p>';
																						  echo'</article>';
																						  echo'<article class="col-md-12 ">';
																						    echo'<p><strong>Observación: </strong><br>'.$fila_venfermeria['obs_visita'].'</p>';
																						  echo'</article>';

																						echo'</section>';
																						echo'<section class="panel-body">';

																						echo'</section>';
																					}
																					if ($fallida==0) {
																						echo'<section class="panel-body alert alert-info">';
																							echo'<article class="col-md-12 ">';
																								echo'<p><strong>Fecha Registro: </strong>'.$fila_venfermeria['freg'].'</p>';
																								echo'<p><strong>Responsable: </strong>'.$fila_venfermeria['nombre'].'</p>';
																							echo'</article>';
																							echo'<article class="col-md-12 ">';
																								echo'<p><strong>Verificacion de datos del paciente y cuidador: </strong>';
																								if ($fila_venfermeria['criterio1']==1) {
																									echo'SI';
																								}else {
																									echo'NO';
																								}
																								echo'</p>';
																								echo'<p><strong>Verificacion de servicios autorizados: </strong>';
																								if ($fila_venfermeria['criterio2']==1) {
																									echo'SI';
																								}else {
																									echo'NO';
																								}
																								echo'</p>';
																								echo'<p><strong>Socializacion de derechos y deberes del usuario y la familia: </strong>';
																								if ($fila_venfermeria['criterio3']==1) {
																									echo'SI';
																								}else {
																									echo'NO';
																								}
																								echo'</p>';
																								echo'<p><strong>Revision de criterios de inclusion y exclusion: </strong>';
																								if ($fila_venfermeria['criterio4']==1) {
																									echo'SI';
																								}else {
																									echo'NO';
																								}
																								echo'</p>';
																								echo'<p><strong>Socializacion del consentimiento informado de servicios domiciliarios: </strong>';
																								if ($fila_venfermeria['criterio5']==1) {
																									echo'SI';
																								}else {
																									echo'NO';
																								}
																								echo'</p>';
																								echo'<p><strong>Socializacion de las funciones del Auxiliar de enfermeria: </strong>';
																								if ($fila_venfermeria['criterio6']==1) {
																									echo'SI';
																								}else {
																									echo'NO';
																								}
																								echo'</p>';
																								echo'<p><strong>Valoracion cefalocaudal del paciente y aplicacion de escalas de valoracion: </strong>';
																								if ($fila_venfermeria['criterio7']==1) {
																									echo'SI';
																								}else {
																									echo'NO';
																								}
																								echo'</p>';
																								echo'<p><strong>Diligenciamiento de la ronda de seguridad: </strong>';
																								if ($fila_venfermeria['criterio8']==1) {
																									echo'SI';
																								}else {
																									echo'NO';
																								}
																								echo'</p>';
																								echo'<p><strong>Aplicacion de encuesta de satisfaccion: </strong>';
																								if ($fila_venfermeria['criterio9']==1) {
																									echo'SI';
																								}else {
																									echo'NO';
																								}
																								echo'</p>';
																							echo'</article>';
																							echo'<article class="col-md-12 ">';
																								echo'<p><strong>Observación: </strong><br>'.$fila_venfermeria['obs_visita'].'</p>';
																							echo'</article>';

																						echo'</section>';
																						echo'<section class="panel-body">';

																						echo'</section>';
																					}
								                        }
								                      }
								                   echo'</div>
								                   <div class="modal-footer">
								                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								                   </div>
								                 </div>

								               </div>
								             </div>';

								             echo'
								             <div id="gdocu_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
								               <div class="modal-dialog">

								                 <!-- Modal content-->
								                 <div class="modal-content">
								                   <div class="modal-header">
								                     <button type="button" class="close" data-dismiss="modal">&times;</button>
								                     <h4 class="modal-title">Gestor Documental </h4>
								                    <p class="text-right"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOC&idpac='.$fila["id_paciente"].'&idadm='.$fila['id_adm_hosp'].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-success"><span class="fa fa-file-text"></span>Cargar documento Nuevo</button></a></p>
								                   </div>
								                   <div class="modal-body">';
								                   $id=$fila['id_paciente'];
								                      $sql_doc="SELECT id_infodocs,nombre_doc,foto,fcargue FROM info_documentacion
								                                      WHERE id_paciente=$id";
								                      if ($tabla_doc=$bd1->sub_tuplas($sql_doc)){
								                        foreach ($tabla_doc as $fila_doc ) {
								                          echo'<section class="panel-body">';
								                            echo'<article class="col-md-12 ">';
								                              echo'<p><strong>Fecha Registro: </strong>'.$fila_doc['fcargue'].'</p>';
								                              echo'<p><strong>Nombre: </strong>'.$fila_doc['nombre_doc'].'</p>';
								                              echo'<p><a href="'.$fila_doc['foto'].'"><button type="button" class="btn btn-info btn-md" ><span class="fa fa-file-pdf-o"></span> </button></a>
								                                     <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=XDOC&idadm='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'">
								                            <button type="button" class="btn btn-danger" ><span class="fa fa-times-circle"></span>	</button></a></p>';
								                            echo'</article>';
								                          echo'</section>';
								                        }
								                      }
								                   echo'</div>
								                   <div class="modal-footer">
								                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								                   </div>
								                 </div>

								               </div>
								             </div>';

								             echo'
								             <div id="sa'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
								               <div class="modal-dialog modal-lg">

								                 <!-- Modal content-->
								                 <div class="modal-content">
								                   <div class="modal-header">
								                     <button type="button" class="close" data-dismiss="modal">&times;</button>
								                     <h4 class="modal-title">Servicios Autorizados</h4>
								                   </div>
								                   <div class="modal-body">';
								                   $id=$fila["id_adm_hosp"];
								                   $y=date('Y');
								                   $mes=date('m');
								                    $sql_master="SELECT a.id_m_aut_dom,cdx_presentacion,dx_presentacion,estado_p_principal,
								                                        b.nomclaseusuario,
								                                        c.id_d_aut_dom, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa, estado_d_aut_dom, intervalo, temporalidad, profesional, f_prof

								                                 FROM m_aut_dom a INNER JOIN clase_usuario b on a.tipo_paciente=b.id_cusuario
								                                                  INNER JOIN d_aut_dom c on c.id_m_aut_dom=a.id_m_aut_dom
								                                 WHERE a.id_adm_hosp=$id ORDER BY finicio DESC";
								                                 //echo $sql_master;
								                    if ($tabla_master=$bd1->sub_tuplas($sql_master)){
								                      foreach ($tabla_master as $fila_master ) {
								                        $cups=$fila_master['cups'];
								                        if ($cups=='890105') {
								                          echo'<section class="panel-body">';
								                            echo'<article class="col-md-12">';
								                              echo'<p><strong>Tipo Paciente: </strong>'.$fila_master['nomclaseusuario'].'</p>';
								                              echo'<p><strong>Dx presentación: </strong>'.$fila_master['cdx_presentacion'].' '.$fila_master['dx_presentacion'].'</p>';

								                            echo'</article>';
								                            echo'<article class="col-md-6">
								                                  <p>'.$fila_master['cups'].' '.$fila_master['procedimiento'].' </p>
								                                  <p><strong>Cantidad:</strong> '.$fila_master['cantidad'].' Turnos </p>
								                                  <p><strong>Temporalidad:</strong> '.$fila_master['intervalo'].' Horas de '.$fila_master['temporalidad'].' </p>
																									<p class="text-"><strong>VIGENCIA:</strong> '.$fila_master['finicio'].' '.$fila_master['ffinal'].' </p>
								                                 </article>';
																						echo'<article class="col-md-6">';
						 				                               $idd=$fila_master['id_d_aut_dom'];
																									 $sql_prof="SELECT a.id_prof_d_dom,a.id_d_aut_dom idd, a.profesional prof, estado_profesional, user_cancela,
																 																		b.id_d_aut_dom, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa,
																	 																 estado_d_aut_dom, intervalo, temporalidad,
																 																		c.nombre,tel_user,email
																 													FROM profesional_d_dom a INNER JOIN d_aut_dom b on a.id_d_aut_dom=b.id_d_aut_dom
																 																									 INNER JOIN user c on c.id_user=a.profesional
																 													WHERE a.id_d_aut_dom=$idd and a.estado_profesional=1";
																 													//echo $sql_prof;
																 													if ($tabla_prof=$bd1->sub_tuplas($sql_prof)){
																 														foreach ($tabla_prof as $fila_prof) {
																 															echo'<p><strong>Profesional: </strong>'.$fila_prof['nombre'].' <strong>TEL:</strong>'.$fila_prof['tel_user'].' <strong>EMAIL:</strong>'.$fila_prof['email'].'</p>';
																															echo'<p><a href="Funcion_base/borrar_prof_dom_jefes.php?idd='.$fila_prof["id_prof_d_dom"].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span>	</button></a></p>';


																 														}
																 													}else {
																 														echo'	<p>No hay profesional asignado</p>';
																 													}
						 				                        echo'</article>';
																						echo'<article class="col-md-12">
																									<p>
																									 <button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota_historia_'.$fila_master['id_d_aut_dom'].'">Historico de Notas<span class="glyphicon glyphicon-arrow-down"></span> </button>
																									</p>';
																						echo'<p>';
																						echo'<section id="nota_historia_'.$fila_master['id_d_aut_dom'].'" class="collapse">';
																						$turno=$fila_master['intervalo'];
																						$idd=$fila_master["id_d_aut_dom"];
																						if ($turno == 3) {
																							$sql_nota="SELECT a.id_enf_dom3,id_adm_hosp, freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota,
																													 u.nombre
																							FROM enferdom3 a INNER join user u on a.id_user=u.id_user
																							WHERE estado_nota='Realizada' and id_d_aut_dom=$idd ORDER by a.freg3 ASC";
																								//echo $sql;
																							if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																								foreach ($tabla_nota as $fila_nota) {
																									echo'<section class="panel-body">
																												<article class="col-md-8">';
																									echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom3'].'">Nota del '.$fila_nota["freg3"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																									echo'</article>';
																									echo'<article class="col-md-4">';

																									echo'</article>';
																									echo'</section>';

																									echo'<section id="nota'.$fila_nota['id_enf_dom3'].'" class="collapse">';
																									echo"<article class='col-md-6'>\n";
																										echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg3"].'</strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-6'>";
																										echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["hnota1"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["hnota2"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["hnota3"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																									echo"</article>";
																									echo'</section>';
																								}
																							}else {
																								echo"<article class='col-md-12'>";
																									echo'<p class="text-left">No hay registro de notas de enfermeria 3 Horas</p>';
																								echo"</article>";
																							}
																						}
																						if ($turno == 6) {
																							$sql_nota="SELECT a.id_enf_dom6,id_adm_hosp, freg_reg, freg6, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6, estado_nota,
																													 u.nombre
																							FROM enferdom6 a INNER join user u on a.id_user=u.id_user
																							WHERE estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg6 ASC";
																								//echo $sql;
																							if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																								foreach ($tabla_nota as $fila_nota) {
																									echo'<section class="panel-body">
																												<article class="col-md-8">';
																									echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom6'].'">Nota del '.$fila_nota["freg6"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																									echo'</article>';
																									echo'<article class="col-md-4">';

																									echo'</article>';
																									echo'</section>';

																									echo'<section id="nota'.$fila_nota['id_enf_dom6'].'" class="collapse">';
																									echo"<article class='col-md-6'>\n";
																										echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg6"].'</strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-6'>";
																										echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
																									echo"</article>";
																									echo'</section>';
																								}
																							}else {
																								echo"<article class='col-md-12'>";
																									echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
																								echo"</article>";
																							}
																						}
																						if ($turno == 8) {
																							$sql_nota="SELECT a.id_enf_dom8,id_adm_hosp, freg_reg, freg8, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6, estado_nota,hnota7, nota7, hnota8, nota8,
																													 u.nombre
																							FROM enferdom8 a INNER join user u on a.id_user=u.id_user
																							WHERE estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg8 ASC";
																								//echo $sql;
																							if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																								foreach ($tabla_nota as $fila_nota) {
																									echo'<section class="panel-body">
																												<article class="col-md-8">';
																									echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom8'].'">Nota del '.$fila_nota["freg8"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																									echo'</article>';
																									echo'<article class="col-md-4">';

																									echo'</article>';
																									echo'</section>';

																									echo'<section id="nota'.$fila_nota['id_enf_dom8'].'" class="collapse">';
																									echo"<article class='col-md-6'>\n";
																										echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg8"].'</strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-6'>";
																										echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota7"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota7"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota8"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota8"].' </p>';
																									echo"</article>";
																									echo'</section>';
																								}
																							}else {
																								echo"<article class='col-md-12'>";
																									echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
																								echo"</article>";
																							}
																						}
																						if ($turno == 12) {
																							$sql_nota="SELECT a.id_enf_dom12,id_adm_hosp, freg_reg, freg12, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6,
																																hnota7, nota7, hnota8, nota8, hnota9, nota9, hnota10, nota10, hnota11, nota11, hnota12, nota12, estado_nota,
																													 u.nombre
																							FROM enferdom12 a INNER join user u on a.id_user=u.id_user
																							WHERE estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg12 ASC";
																								//echo $sql_nota;
																								//echo $fila_detalle["id_d_aut_dom"];
																							if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																								foreach ($tabla_nota as $fila_nota) {
																									echo'<section class="panel-body">
																												<article class="col-md-8">';
																									echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom12'].'">Nota del '.$fila_nota["freg12"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																									echo'</article>';
																									echo'<article class="col-md-4">';

																									echo'</article>';
																									echo'</section>';

																									echo'<section id="nota'.$fila_nota['id_enf_dom12'].'" class="collapse">';
																									echo"<article class='col-md-6'>\n";
																										echo'<p class="text-danger"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg12"].'</strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-6'>";
																										echo'<p class="text-danger"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota7"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota7"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota8"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota8"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota9"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota9"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota10"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota10"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota11"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota11"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota12"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota12"].' </p>';
																									echo"</article>";
																									echo'</section>';
																								}
																							}else {
																								echo"<article class='col-md-12'>";
																									echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
																								echo"</article>";
																							}
																						}
																						if ($turno == 24) {
																							$sql_nota="SELECT a.id_enf_dom12,id_adm_hosp, freg_reg, freg12, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6,
																																hnota7, nota7, hnota8, nota8, hnota9, nota9, hnota10, nota10, hnota11, nota11, hnota12, nota12, estado_nota,
																													 u.nombre
																							FROM enferdom12 a INNER join user u on a.id_user=u.id_user
																							WHERE  estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg12 ASC";
																								//echo $sql_nota;
																							if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																								foreach ($tabla_nota as $fila_nota) {
																									echo'<section class="panel-body">
																												<article class="col-md-8">';
																									echo'<p><button  data-toggle="collapse" class="btn btn-primary text-center col-md-12" data-target="#nota'.$fila_nota['id_enf_dom12'].'">Nota del '.$fila_nota["freg12"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																									echo'</article>';
																									echo'<article class="col-md-4">';

																									echo'</article>';
																									echo'</section>';

																									echo'<section id="nota'.$fila_nota['id_enf_dom12'].'" class="collapse">';
																									echo"<article class='col-md-6'>\n";
																										echo'<p class="text-danger"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg12"].'</strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-6'>";
																										echo'<p class="text-danger"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota7"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota7"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota8"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota8"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota9"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota9"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota10"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota10"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota11"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota11"].' </p>';
																									echo"</article>";
																									echo"<article class='col-md-4'>";
																										echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota12"].' </strong></p>';
																									echo"</article>";
																									echo"<article class='col-md-8'>";
																										echo'<p class="text-left"> '.$fila_nota["nota12"].' </p>';
																									echo"</article>";
																									echo'</section>';
																								}
																							}else {
																								echo"<article class='col-md-12'>";
																									echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
																								echo"</article>";
																							}
																						}
																						echo'</section>';
																						echo'</p>';
																						echo'</article>';
								                            echo'<article class="col-md-12">
								                                  <p>
								                                    <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BITACORA&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'&t=POSITIVO"><button type="button" class="btn btn-success" ><span class="fa fa-thumbs-up"></span>	</button></a>
								                                    <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BITACORA&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'&t=NEGATIVO"><button type="button" class="btn btn-danger" ><span class="fa fa-thumbs-down"></span>	</button></a>
								                                    <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDPROFESIONAL&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-user-md"></span>	Asignar Profesional</button></a>
								                                  </p>
								                                 </article>';
								                          echo'</section>';
								                        }else {
								                          echo'<section class="panel-body">';
								                            echo'<article class="col-md-12">';
								                              echo'<p><strong>Tipo Paciente: </strong>'.$fila_master['nomclaseusuario'].'</p>';
								                              echo'<p><strong>Dx presentación: </strong>'.$fila_master['cdx_presentacion'].' '.$fila_master['dx_presentacion'].'</p>';

								                            echo'</article>';
								                            echo'<article class="col-md-6">
								                                  <p>'.$fila_master['cups'].' '.$fila_master['procedimiento'].' </p>
								                                  <p><strong>Cantidad:</strong> '.$fila_master['cantidad'].' <strong>Frecuancia:</strong> '.$fila_master['intervalo'].' Min.</p>
																									<p class="text-"><strong>VIGENCIA:</strong> '.$fila_master['finicio'].' '.$fila_master['ffinal'].' </p>
								                                 </article>';
																								 echo'<article class="col-md-6">';
						 		 				                               $idd=$fila_master['id_d_aut_dom'];
						 																					 $sql_tera="SELECT a.id_prof_d_dom,a.id_d_aut_dom idd, a.profesional prof, estado_profesional, user_cancela,
						 												 																		b.id_d_aut_dom,
						 												 																		c.nombre,tel_user
						 												 													FROM profesional_d_dom a INNER JOIN d_aut_dom b on a.id_d_aut_dom=b.id_d_aut_dom
						 												 																									 INNER JOIN user c on c.id_user=a.profesional
						 												 													WHERE a.id_d_aut_dom=$idd and a.estado_profesional=1";
						 												 													//echo $sql_prof;
						 												 													if ($tabla_tera=$bd1->sub_tuplas($sql_tera)){
						 												 														foreach ($tabla_tera as $fila_tera) {
						 												 															echo'<p><strong>Profesional: </strong>'.$fila_tera['nombre'].' TEL:'.$fila_tera['tel_user'].'</p>';
																																	echo'<p><a href="Funcion_base/borrar_prof_dom_jefes.php?idd='.$fila_tera["id_prof_d_dom"].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span>	</button></a></p>';
						 												 														}
						 												 													}else {
						 												 														echo'	<p>No hay profesional asignado</p>';
						 												 													}
						 		 				                        echo'</article>';
								                            echo'<article class="col-md-12">
								                                  <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BITACORA&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'&t=POSITIVO"><button type="button" class="btn btn-success" ><span class="fa fa-thumbs-up"></span>	</button></a>
								                                    <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BITACORA&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'&t=NEGATIVO"><button type="button" class="btn btn-danger" ><span class="fa fa-thumbs-down"></span>	</button></a>
								                                  </p>
								                                </article>';
								                          echo'</section>';
								                        }

								                      }
								                    }
								                   echo'</div>
								                   <div class="modal-footer">
								                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								                   </div>
								                 </div>

								               </div>
								             </div>';
								           }
								        }else {
													echo'<section class="panel-body"><section class="row">
				 											<article class="col-md-12">
				 											 <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ACUDIENTE&idadm='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'">
				 											 <button type="button" class="btn btn-danger" ><span class="fa fa-users"></span> Agregar Cuidador
				 											 </button></a>
				 											</article>';

				 								 echo'<article class="col-md-12">';
				 								 echo'<p><button type="button" class="btn btn-info " data-toggle="modal" data-target="#gdocu_'.$fila["id_adm_hosp"].'">Gestor Documental</button></p>';
				 								 echo'</article>';

				 								 echo'<article class="col-md-12">';
				 								 echo'<p><button type="button" class="btn btn-warning " data-toggle="modal" data-target="#sa'.$fila["id_adm_hosp"].'">Servicios Autorizados</button></p>';
				 								 echo'</article>';

												 echo'<article class="col-md-12">';
				 								 echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VISITAENFERMERIA&idadm='.$fila['id_adm_hosp'].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-primary"><span class="fa fa-medkit"></span> Visita Enfermería</button></p></a>';
												 echo'<p><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#falla_'.$fila['id_adm_hosp'].'">Fallida</button></p>
															<div id="falla_'.$fila['id_adm_hosp'].'" class="modal fade" role="dialog">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal">&times;</button>
																			<h4 class="modal-title">Porque esta visita es fallida?</h4>
																		</div>
																		<div class="modal-body">
																		<form action="Funcion_base/visita_fallida.php" method="POST">
																			<section class="panel-body">
																				<article class="col-md-12">
																				<label>Observacion</label>
																				<textarea class="form-control" name="observacion"></textarea>
																				<input type="hidden" name="idadmhosp" value="'.$fila["id_adm_hosp"].'">
																				<input type="hidden" name="doc" value="'.$fila["doc_pac"].'">
																				<input type="hidden" name="resp" value="'.$_SESSION['AUT']['id_user'].'">
																				<input type="hidden" name="servicio" value="'.$_REQUEST["servicio"].'">
																				</article>
																			</section>
																			<section class="panel-body">
																				<article class="col-md-12">
																					<input type="submit" value="Guardar">
																				</article>
																			</section>

																		</form>
																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																		</div>
																	</div>

																</div>
															</div>
												 ';

												 echo'<p><button type="button" class="btn btn-info " data-toggle="modal" data-target="#hvisitas_'.$fila["id_adm_hosp"].'">Historico visitas</button></p>';

				 								 echo'</article>';

				 								 echo'</section></section>';
												 echo'
												 <div id="hvisitas_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
													 <div class="modal-dialog">

														 <!-- Modal content-->
														 <div class="modal-content">
															 <div class="modal-header">
																 <button type="button" class="close" data-dismiss="modal">&times;</button>
																 <h4 class="modal-title">Historico de visitas domiciliarias enfermería </h4>

															 </div>
															 <div class="modal-body">';
															 $id=$fila['id_adm_hosp'];
																	$sql_venfermeria="SELECT a.id_visita_dom, freg, criterio1, criterio2, criterio3, criterio4, criterio5, criterio6,
																									 criterio7, criterio8, criterio9, obs_visita,fallida,
																									 b.nombre
																									  FROM visita_dom_enfermeria a inner join user b on b.id_user=a.id_user
																									WHERE a.id_adm_hosp=$id";

																	if ($tabla_venfermeria=$bd1->sub_tuplas($sql_venfermeria)){
																		foreach ($tabla_venfermeria as $fila_venfermeria ) {
																			$fallida=$fila_venfermeria['fallida'];

																			if ($fallida==1) {
																				echo'<section class="panel-body alert alert-danger">';
																				  echo'<article class="col-md-12 ">';
																				    echo'<p><strong>Fecha Registro: </strong>'.$fila_venfermeria['freg'].'</p>';
																				    echo'<p><strong>Responsable: </strong>'.$fila_venfermeria['nombre'].'</p>';
																				  echo'</article>';
																				  echo'<article class="col-md-12 ">';
																				    echo'<p><strong>Verificacion de datos del paciente y cuidador: </strong>';
																				    if ($fila_venfermeria['criterio1']==1) {
																				      echo'SI';
																				    }else {
																				      echo'NO';
																				    }
																				    echo'</p>';
																				    echo'<p><strong>Verificacion de servicios autorizados: </strong>';
																				    if ($fila_venfermeria['criterio2']==1) {
																				      echo'SI';
																				    }else {
																				      echo'NO';
																				    }
																				    echo'</p>';
																				    echo'<p><strong>Socializacion de derechos y deberes del usuario y la familia: </strong>';
																				    if ($fila_venfermeria['criterio3']==1) {
																				      echo'SI';
																				    }else {
																				      echo'NO';
																				    }
																				    echo'</p>';
																				    echo'<p><strong>Revision de criterios de inclusion y exclusion: </strong>';
																				    if ($fila_venfermeria['criterio4']==1) {
																				      echo'SI';
																				    }else {
																				      echo'NO';
																				    }
																				    echo'</p>';
																				    echo'<p><strong>Socializacion del consentimiento informado de servicios domiciliarios: </strong>';
																				    if ($fila_venfermeria['criterio5']==1) {
																				      echo'SI';
																				    }else {
																				      echo'NO';
																				    }
																				    echo'</p>';
																				    echo'<p><strong>Socializacion de las funciones del Auxiliar de enfermeria: </strong>';
																				    if ($fila_venfermeria['criterio6']==1) {
																				      echo'SI';
																				    }else {
																				      echo'NO';
																				    }
																				    echo'</p>';
																				    echo'<p><strong>Valoracion cefalocaudal del paciente y aplicacion de escalas de valoracion: </strong>';
																				    if ($fila_venfermeria['criterio7']==1) {
																				      echo'SI';
																				    }else {
																				      echo'NO';
																				    }
																				    echo'</p>';
																				    echo'<p><strong>Diligenciamiento de la ronda de seguridad: </strong>';
																				    if ($fila_venfermeria['criterio8']==1) {
																				      echo'SI';
																				    }else {
																				      echo'NO';
																				    }
																				    echo'</p>';
																				    echo'<p><strong>Aplicacion de encuesta de satisfaccion: </strong>';
																				    if ($fila_venfermeria['criterio9']==1) {
																				      echo'SI';
																				    }else {
																				      echo'NO';
																				    }
																				    echo'</p>';
																				  echo'</article>';
																				  echo'<article class="col-md-12 ">';
																				    echo'<p><strong>Observación: </strong><br>'.$fila_venfermeria['obs_visita'].'</p>';
																				  echo'</article>';

																				echo'</section>';
																				echo'<section class="panel-body">';

																				echo'</section>';
																			}
																			if ($fallida==0) {
																				echo'<section class="panel-body alert alert-info">';
																					echo'<article class="col-md-12 ">';
																						echo'<p><strong>Fecha Registro: </strong>'.$fila_venfermeria['freg'].'</p>';
																						echo'<p><strong>Responsable: </strong>'.$fila_venfermeria['nombre'].'</p>';
																					echo'</article>';
																					echo'<article class="col-md-12 ">';
																						echo'<p><strong>Verificacion de datos del paciente y cuidador: </strong>';
																						if ($fila_venfermeria['criterio1']==1) {
																							echo'SI';
																						}else {
																							echo'NO';
																						}
																						echo'</p>';
																						echo'<p><strong>Verificacion de servicios autorizados: </strong>';
																						if ($fila_venfermeria['criterio2']==1) {
																							echo'SI';
																						}else {
																							echo'NO';
																						}
																						echo'</p>';
																						echo'<p><strong>Socializacion de derechos y deberes del usuario y la familia: </strong>';
																						if ($fila_venfermeria['criterio3']==1) {
																							echo'SI';
																						}else {
																							echo'NO';
																						}
																						echo'</p>';
																						echo'<p><strong>Revision de criterios de inclusion y exclusion: </strong>';
																						if ($fila_venfermeria['criterio4']==1) {
																							echo'SI';
																						}else {
																							echo'NO';
																						}
																						echo'</p>';
																						echo'<p><strong>Socializacion del consentimiento informado de servicios domiciliarios: </strong>';
																						if ($fila_venfermeria['criterio5']==1) {
																							echo'SI';
																						}else {
																							echo'NO';
																						}
																						echo'</p>';
																						echo'<p><strong>Socializacion de las funciones del Auxiliar de enfermeria: </strong>';
																						if ($fila_venfermeria['criterio6']==1) {
																							echo'SI';
																						}else {
																							echo'NO';
																						}
																						echo'</p>';
																						echo'<p><strong>Valoracion cefalocaudal del paciente y aplicacion de escalas de valoracion: </strong>';
																						if ($fila_venfermeria['criterio7']==1) {
																							echo'SI';
																						}else {
																							echo'NO';
																						}
																						echo'</p>';
																						echo'<p><strong>Diligenciamiento de la ronda de seguridad: </strong>';
																						if ($fila_venfermeria['criterio8']==1) {
																							echo'SI';
																						}else {
																							echo'NO';
																						}
																						echo'</p>';
																						echo'<p><strong>Aplicacion de encuesta de satisfaccion: </strong>';
																						if ($fila_venfermeria['criterio9']==1) {
																							echo'SI';
																						}else {
																							echo'NO';
																						}
																						echo'</p>';
																					echo'</article>';
																					echo'<article class="col-md-12 ">';
																						echo'<p><strong>Observación: </strong><br>'.$fila_venfermeria['obs_visita'].'</p>';
																					echo'</article>';

																				echo'</section>';
																				echo'<section class="panel-body">';

																				echo'</section>';
																			}
																		}
																	}
															 echo'</div>
															 <div class="modal-footer">
																 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															 </div>
														 </div>

													 </div>
												 </div>';
								          echo'
								          <div id="gdocu_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
								            <div class="modal-dialog">

								              <!-- Modal content-->
								              <div class="modal-content">
								                <div class="modal-header">
								                  <button type="button" class="close" data-dismiss="modal"><span class="fa fa-times text-danger"></span></button>
								                  <h4 class="modal-title">Gestor Documental </h4>
								                  <p class="text-right"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOC&idpac='.$fila["id_paciente"].'&idadm='.$fila['id_adm_hosp'].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-success"><span class="fa fa-file-text"></span>Cargar documento Nuevo</button></a></p>
								                </div>
								                <div class="modal-body">';
								                $id=$fila['id_paciente'];
								                  $sql_doc="SELECT id_infodocs,nombre_doc,foto,fcargue FROM info_documentacion
								                                  WHERE id_paciente=$id";
								                  if ($tabla_doc=$bd1->sub_tuplas($sql_doc)){
								                    foreach ($tabla_doc as $fila_doc ) {
								                      echo'<section class="panel-body">';
								                        echo'<article class="col-md-12 ">';
								                          echo'<p><strong>Fecha Registro: </strong>'.$fila_doc['fcargue'].'</p>';
								                          echo'<p><strong>Nombre: </strong>'.$fila_doc['nombre_doc'].'</p>';
								                          echo'<p><a href="'.$fila_doc['foto'].'"><button type="button" class="btn btn-info btn-md" ><span class="fa fa-file-pdf-o"></span> </button></a>
								                                  <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=XDOC&idadm='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'">
								                         <button type="button" class="btn btn-danger" ><span class="fa fa-times-circle"></span>	</button></a></p>';
								                        echo'</article>';
								                      echo'</section>';
								                    }
								                  }
								                echo'</div>
								                <div class="modal-footer">
								                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								                </div>
								              </div>

								            </div>
								          </div>';

								           echo'
								           <div id="sa'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
								             <div class="modal-dialog modal-lg">

								               <!-- Modal content-->
								               <div class="modal-content">
								                 <div class="modal-header">
								                   <button type="button" class="close" data-dismiss="modal">&times;</button>
								                   <h4 class="modal-title">Servicios Autorizados</h4>
								                 </div>
								                 <div class="modal-body">';
								                 $id=$fila["id_adm_hosp"];
								                 $y=date('Y');
								                 $mes=date('m');
								                  $sql_master="SELECT a.id_m_aut_dom,cdx_presentacion,dx_presentacion,estado_p_principal,
								                                      b.nomclaseusuario,
								                                      c.id_d_aut_dom, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa,
																											estado_d_aut_dom, intervalo,
																											temporalidad, profesional, f_prof

								                               FROM m_aut_dom a INNER JOIN clase_usuario b on a.tipo_paciente=b.id_cusuario
								                                                INNER JOIN d_aut_dom c on c.id_m_aut_dom=a.id_m_aut_dom
								                               WHERE a.id_adm_hosp=$id  ORDER BY finicio DESC";
								                               //echo $sql_master;
								                  if ($tabla_master=$bd1->sub_tuplas($sql_master)){
								                    foreach ($tabla_master as $fila_master ) {
								                      $cups=$fila_master['cups'];
								                      if ($cups=='890105') {
								                        echo'<section class="panel-body">';
								                          echo'<article class="col-md-12">';
								                            echo'<p><strong>Tipo Paciente: </strong>'.$fila_master['nomclaseusuario'].'</p>';
								                            echo'<p><strong>Dx presentación: </strong>'.$fila_master['cdx_presentacion'].' '.$fila_master['dx_presentacion'].'</p>';

								                          echo'</article>';
								                          echo'<article class="col-md-6">
								                                <p>'.$fila_master['cups'].' '.$fila_master['procedimiento'].' </p>
								                                <p><strong>Cantidad:</strong> '.$fila_master['cantidad'].' Turnos </p>
								                                <p><strong>Temporalidad:</strong> '.$fila_master['intervalo'].' Horas de '.$fila_master['temporalidad'].' </p>
																								<p class="text-"><strong>VIGENCIA:</strong> '.$fila_master['finicio'].' '.$fila_master['ffinal'].' </p>
								                               </article>';
																							 echo'<article class="col-md-12">
																										 <p>
																											<button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota_historia_'.$fila_master['id_d_aut_dom'].'">Historico de Notas<span class="glyphicon glyphicon-arrow-down"></span> </button>
																										 </p>';
																							 echo'<p>';
																							 echo'<section id="nota_historia_'.$fila_master['id_d_aut_dom'].'" class="collapse">';
																							 $turno=$fila_master['intervalo'];
																							 $idd=$fila_master["id_d_aut_dom"];
																							 if ($turno == 3) {
																								 $sql_nota="SELECT a.id_enf_dom3,id_adm_hosp, freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota,
																															u.nombre
																								 FROM enferdom3 a INNER join user u on a.id_user=u.id_user
																								 WHERE estado_nota='Realizada' and id_d_aut_dom=$idd ORDER by a.freg3 ASC";
																									 //echo $sql;
																								 if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																									 foreach ($tabla_nota as $fila_nota) {
																										 echo'<section class="panel-body">
																													 <article class="col-md-12">';
																										 echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom3'].'">Nota del '.$fila_nota["freg3"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																										 echo'</article>';

																										 echo'</section>';

																										 echo'<section id="nota'.$fila_nota['id_enf_dom3'].'" class="collapse">';
																										 echo"<article class='col-md-6'>\n";
																											 echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg3"].'</strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-6'>";
																											 echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["hnota1"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["hnota2"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["hnota3"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																										 echo"</article>";
																										 echo'</section>';
																									 }
																								 }else {
																									 echo"<article class='col-md-12'>";
																										 echo'<p class="text-left">No hay registro de notas de enfermeria 3 Horas</p>';
																									 echo"</article>";
																								 }
																							 }
																							 if ($turno == 6) {
																								 $sql_nota="SELECT a.id_enf_dom6,id_adm_hosp, freg_reg, freg6, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6, estado_nota,
																															u.nombre
																								 FROM enferdom6 a INNER join user u on a.id_user=u.id_user
																								 WHERE estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg6 ASC";
																									 //echo $sql;
																								 if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																									 foreach ($tabla_nota as $fila_nota) {
																										 echo'<section class="panel-body">
																													 <article class="col-md-12">';
																										 echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom6'].'">Nota del '.$fila_nota["freg6"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																										 echo'</article>';

																										 echo'</section>';

																										 echo'<section id="nota'.$fila_nota['id_enf_dom6'].'" class="collapse">';
																										 echo"<article class='col-md-6'>\n";
																											 echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg6"].'</strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-6'>";
																											 echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
																										 echo"</article>";
																										 echo'</section>';
																									 }
																								 }else {
																									 echo"<article class='col-md-12'>";
																										 echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
																									 echo"</article>";
																								 }
																							 }
																							 if ($turno == 8) {
																								 $sql_nota="SELECT a.id_enf_dom8,id_adm_hosp, freg_reg, freg8, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6, estado_nota,hnota7, nota7, hnota8, nota8,
																															u.nombre
																								 FROM enferdom8 a INNER join user u on a.id_user=u.id_user
																								 WHERE estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg8 ASC";
																									 //echo $sql;
																								 if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																									 foreach ($tabla_nota as $fila_nota) {
																										 echo'<section class="panel-body">
																													 <article class="col-md-12">';
																										 echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom8'].'">Nota del '.$fila_nota["freg8"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																										 echo'</article>';

																										 echo'</section>';

																										 echo'<section id="nota'.$fila_nota['id_enf_dom8'].'" class="collapse">';
																										 echo"<article class='col-md-6'>\n";
																											 echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg8"].'</strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-6'>";
																											 echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota7"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota7"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota8"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota8"].' </p>';
																										 echo"</article>";
																										 echo'</section>';
																									 }
																								 }else {
																									 echo"<article class='col-md-12'>";
																										 echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
																									 echo"</article>";
																								 }
																							 }
																							 if ($turno == 12) {
																								 $sql_nota="SELECT a.id_enf_dom12,id_adm_hosp, freg_reg, freg12, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6,
																																	 hnota7, nota7, hnota8, nota8, hnota9, nota9, hnota10, nota10, hnota11, nota11, hnota12, nota12, estado_nota,
																															u.nombre
																								 FROM enferdom12 a INNER join user u on a.id_user=u.id_user
																								 WHERE estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg12 ASC";
																									 //echo $sql_nota;
																									 //echo $fila_detalle["id_d_aut_dom"];
																								 if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																									 foreach ($tabla_nota as $fila_nota) {
																										 echo'<section class="panel-body">
																													 <article class="col-md-8">';
																										 echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom12'].'">Nota del '.$fila_nota["freg12"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																										 echo'</article>';
																										 echo'<article class="col-md-4">';

																										 echo'</article>';
																										 echo'</section>';

																										 echo'<section id="nota'.$fila_nota['id_enf_dom12'].'" class="collapse">';
																										 echo"<article class='col-md-6'>\n";
																											 echo'<p class="text-danger"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg12"].'</strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-6'>";
																											 echo'<p class="text-danger"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota7"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota7"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota8"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota8"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota9"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota9"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota10"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota10"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota11"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota11"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota12"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota12"].' </p>';
																										 echo"</article>";
																										 echo'</section>';
																									 }
																								 }else {
																									 echo"<article class='col-md-12'>";
																										 echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
																									 echo"</article>";
																								 }
																							 }
																							 if ($turno == 24) {
																								 $sql_nota="SELECT a.id_enf_dom12,id_adm_hosp, freg_reg, freg12, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6,
																																	 hnota7, nota7, hnota8, nota8, hnota9, nota9, hnota10, nota10, hnota11, nota11, hnota12, nota12, estado_nota,
																															u.nombre
																								 FROM enferdom12 a INNER join user u on a.id_user=u.id_user
																								 WHERE  estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg12 ASC";
																									 //echo $sql_nota;
																								 if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
																									 foreach ($tabla_nota as $fila_nota) {
																										 echo'<section class="panel-body">
																													 <article class="col-md-8">';
																										 echo'<p><button  data-toggle="collapse" class="btn btn-primary text-center col-md-12" data-target="#nota'.$fila_nota['id_enf_dom12'].'">Nota del '.$fila_nota["freg12"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
																										 echo'</article>';
																										 echo'<article class="col-md-4">';

																										 echo'</article>';
																										 echo'</section>';

																										 echo'<section id="nota'.$fila_nota['id_enf_dom12'].'" class="collapse">';
																										 echo"<article class='col-md-6'>\n";
																											 echo'<p class="text-danger"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg12"].'</strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-6'>";
																											 echo'<p class="text-danger"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota7"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota7"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota8"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota8"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota9"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota9"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota10"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota10"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota11"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota11"].' </p>';
																										 echo"</article>";
																										 echo"<article class='col-md-4'>";
																											 echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota12"].' </strong></p>';
																										 echo"</article>";
																										 echo"<article class='col-md-8'>";
																											 echo'<p class="text-left"> '.$fila_nota["nota12"].' </p>';
																										 echo"</article>";
																										 echo'</section>';
																									 }
																								 }else {
																									 echo"<article class='col-md-12'>";
																										 echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
																									 echo"</article>";
																								 }
																							 }
																							 echo'</section>';
																							 echo'</p>';
																							 echo'</article>';
								                          echo'<article class="col-md-12">
								                                <p>
								                               <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BITACORA&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'&t=POSITIVO"><button type="button" class="btn btn-success" ><span class="fa fa-thumbs-up"></span>	</button></a>
								                                 <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BITACORA&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'&t=NEGATIVO"><button type="button" class="btn btn-danger" ><span class="fa fa-thumbs-down"></span>	</button></a>
								                                </p>
								                               </article>';
								                      $detalle=$fila_master["id_d_aut_dom"];
								                      $sql_prof="SELECT b.nombre
								                                 FROM profesional_d_dom a INNER JOIN user b on a.profesional=b.id_user
								                                 WHERE id_d_aut_dom=$detalle";
								                      if ($tabla_prof=$bd1->sub_tuplas($sql_prof)){
								                        foreach ($tabla_prof as $fila_prof) {
								                          echo'<article class="col-md-12">
								                                <p>
								                                 <strong>Responsable de atención: </strong> '.$fila_prof['nombre'].'
								                                </p>
								                               </article>';
								                        }
								                      }else {
								                        echo'<article class="col-md-12">
								                              <p>No Existe prefesional asignado</p>
								                                <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDPROFESIONAL&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'"><button type="button" class="btn btn-success" ><span class="fa fa-user-md"></span>	Asignar<br>Profesional</button></a></p>
								                               </article>';
								                      }

								                        echo'</section>';
								                      }else {
								                        echo'<section class="panel-body">';
								                          echo'<article class="col-md-12">';
								                            echo'<p><strong>Tipo Paciente: </strong>'.$fila_master['nomclaseusuario'].'</p>';
								                            echo'<p><strong>Dx presentación: </strong>'.$fila_master['cdx_presentacion'].' '.$fila_master['dx_presentacion'].'</p>';

								                          echo'</article>';
								                          echo'<article class="col-md-6">
								                                <p>'.$fila_master['cups'].' '.$fila_master['procedimiento'].' </p>
								                                <p><strong>Cantidad:</strong> '.$fila_master['cantidad'].' <strong>Frecuencia:</strong> '.$fila_master['intervalo'].' Min.</p>
																								<p class="text-"><strong>VIGENCIA:</strong> '.$fila_master['finicio'].' '.$fila_master['ffinal'].' </p>
								                               </article>';
								                          echo'<article class="col-md-6">
								                                <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BITACORA&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'&t=POSITIVO"><button type="button" class="btn btn-success" ><span class="fa fa-thumbs-up"></span>	</button></a>
								                                  <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BITACORA&idd='.$fila_master["id_d_aut_dom"].'&docc='.$fila["doc_pac"].'&pac='.$fila["id_paciente"].'&t=NEGATIVO"><button type="button" class="btn btn-danger" ><span class="fa fa-thumbs-down"></span>	</button></a>
								                                </p>
								                              </article>';
								                            $detalle=$fila_master["id_d_aut_dom"];
								                            $sql_prof="SELECT b.nombre
								                                       FROM profesional_d_dom a INNER JOIN user b on a.profesional=b.id_user
								                                       WHERE id_d_aut_dom=$detalle";
								                            if ($tabla_prof=$bd1->sub_tuplas($sql_prof)){
								                              foreach ($tabla_prof as $fila_prof) {
								                                echo'<article class="col-md-12">
								                                      <p>
								                                       <strong>Responsable de atención: </strong> '.$fila_prof['nombre'].'
																											 <p><a href="Funcion_base/borrar_prof_dom_jefes.php?idd='.$fila_tera["id_prof_d_dom"].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span>	</button></a></p>
								                                      </p>';
								                                 echo'</article>';
								                              }
								                            }else {
								                              echo'<article class="col-md-12">
								                                    <p>No Existe prefesional asignado</p>
								                                   </article>';
								                            }
								                        echo'</section>';
								                      }

								                    }
								                  }
								                 echo'</div>
								                 <div class="modal-footer">
								                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								                 </div>
								               </div>

								             </div>
								           </div>';
								        }


								    echo'</td>';
								    echo'<th class="text-left">';
								    echo'<section class="row">';
								          $id=$fila['id_adm_hosp'];
								          $sql_downton="SELECT count(id_esc_downton) cuantos	 FROM escala_downton WHERE id_adm_hosp=$id";
								          if ($tabla_downton=$bd1->sub_tuplas($sql_downton)){
								            foreach ($tabla_downton as $fila_downton ) {
								              $id_c=$fila_downton['cuantos'];
								              if ($id_c >= 0) {
								                echo'<article class="col-md-6">';
								                echo'<button type="button" class="btn btn-info " data-toggle="modal" data-target="#historia_downton_'.$fila["id_adm_hosp"].'">Historico Downton</button>';
								                echo'</article>';
								                echo'<article class="col-md-6">';
								                echo'<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOWNTON&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-square"></span> </button></a>';
								                echo'</article>';
								                echo'
								                <div id="historia_downton_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
								                  <div class="modal-dialog">

								                    <!-- Modal content-->
								                    <div class="modal-content">
								                      <div class="modal-header">
								                        <button type="button" class="close" data-dismiss="modal">&times;</button>
								                        <h4 class="modal-title">Historico de registros Escala Downton</h4>
								                      </div>
								                      <div class="modal-body">';
								                        $sql_h_downton="SELECT a.id_esc_downton,freg,total,criterio_total,sugerencia,b.nombre
								                                        FROM escala_downton a inner join user b on a.id_user=b.id_user
								                                        WHERE id_adm_hosp=$id and a.estado is null
								                                        ORDER BY freg DESC";
								                        if ($tabla_h_downton=$bd1->sub_tuplas($sql_h_downton)){
								                          foreach ($tabla_h_downton as $fila_h_downton ) {
								                            echo'<section class="panel-body">';
								                            $riesgo=$fila_h_downton['criterio_total'];
								                            if ($riesgo=='BAJO RIESGO') {
								                                echo'<article class="col-md-12 alert alert-success">';
								                                echo'<p><strong>Fecha Registro: </strong>'.$fila_h_downton['freg'].'</p>';
								                                echo'<p><strong>Clasificación: </strong>'.$fila_h_downton['criterio_total'].'</p>';
								                                echo'<p><strong>Total: </strong>'.$fila_h_downton['total'].'</p>';
								                                echo'<p><strong>Responsable: </strong>'.$fila_h_downton['nombre'].'</p>';
																								echo'<p>'.$fila_h_downton['sugerencia'].'</p>';
								                                echo'</article>';
								                                echo '<article class="col-md-4">';
								                                echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_downton['id_esc_downton'].'&tabla=downton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
								                                echo'</article>';
								                            }
								                            if ($riesgo=='ALTO RIESGO') {
								                                echo'<article class="col-md-12 alert alert-danger">';
								                                echo'<p><strong>Fecha Registro: </strong>'.$fila_h_downton['freg'].'</p>';
								                                echo'<p><strong>Clasificación: </strong>'.$fila_h_downton['criterio_total'].'</p>';
								                                echo'<p><strong>Total: </strong>'.$fila_h_downton['total'].'</p>';
								                                echo'<p><strong>Responsable: </strong>'.$fila_h_downton['nombre'].'</p>';
																								echo'<p>'.$fila_h_downton['sugerencia'].'</p>';
								                                echo'</article>';
								                                echo '<article class="col-md-4">';
								                                echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_downton['id_esc_downton'].'&tabla=downton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
								                                echo'</article>';
								                            }
								                            echo'</section>';
								                          }
								                        }
								                      echo'</div>
								                      <div class="modal-footer">
								                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								                      </div>
								                    </div>

								                  </div>
								                </div>';
								              }
								            }
								          }
								          echo'</section>';
								          echo'<section class="row">';
								          $id=$fila['id_adm_hosp'];
								          $sql_barthel="SELECT count(id_esc_barthel) cuantos	 FROM escala_barthel WHERE id_adm_hosp=$id";
								          if ($tabla_barthel=$bd1->sub_tuplas($sql_barthel)){
								            foreach ($tabla_barthel as $fila_barthel ) {
								              $id_c=$fila_barthel['cuantos'];
								              if ($id_c >= 0) {
								                echo'<br><article class="col-md-6">';
								                echo'<button type="button" class="btn btn-info " data-toggle="modal" data-target="#historia_barthel_'.$fila["id_adm_hosp"].'">Historico Barthel</button>';
								                echo'</article>';
								                echo'<article class="col-md-6">';
								                echo'<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=BARTHEL&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-square"></span> </button></a>';
								                echo'</article>';
								                echo'
								                <div id="historia_barthel_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
								                  <div class="modal-dialog">

								                    <!-- Modal content-->
								                    <div class="modal-content">
								                      <div class="modal-header">
								                        <button type="button" class="close" data-dismiss="modal">&times;</button>
								                        <h4 class="modal-title">Historico de registros Escala Barthel</h4>
								                      </div>
								                      <div class="modal-body">';
								                        $sql_h_barthel="SELECT a.id_esc_barthel,freg,total,calificacion_total,b.nombre
								                                        FROM escala_barthel a inner join user b on a.id_user=b.id_user
								                                        WHERE id_adm_hosp=$id and a.estado is null
								                                        ORDER BY freg DESC";

								                        if ($tabla_h_barthel=$bd1->sub_tuplas($sql_h_barthel)){
								                          foreach ($tabla_h_barthel as $fila_h_barthel ) {
								                            echo'<section class="panel-body">';
								                            $riesgo=$fila_h_barthel['calificacion_total'];
								                            if ($riesgo=='Dependencia total') {
								                              echo'<article class="col-md-12 alert alert-danger">';
								                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_barthel['freg'].'</p>';
								                              echo'<p><strong>Clasificación: </strong>'.$fila_h_barthel['calificacion_total'].'</p>';
								                              echo'<p><strong>Total: </strong>'.$fila_h_barthel['total'].'</p>';
								                              echo'<p><strong>Responsable: </strong>'.$fila_h_barthel['nombre'].'</p>';
																							echo'<p>'.$fila_h_downton['observacion'].'</p>';
								                              echo'</article>';
								                              echo '<article class="col-md-4">';
								                              echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_barthel['id_esc_barthel'].'&tabla=barthel"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
								                              echo'</article>';
								                            }
								                            if ($riesgo=='Dependencia severa') {
								                              echo'<article class="col-md-12 alert alert-warning">';
								                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_barthel['freg'].'</p>';
								                              echo'<p><strong>Clasificación: </strong>'.$fila_h_barthel['calificacion_total'].'</p>';
								                              echo'<p><strong>Total: </strong>'.$fila_h_barthel['total'].'</p>';
								                              echo'<p><strong>Responsable: </strong>'.$fila_h_barthel['nombre'].'</p>';
																							echo'<p>'.$fila_h_downton['observacion'].'</p>';
								                              echo'</article>';
								                              echo '<article class="col-md-4">';
								                              echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_barthel['id_esc_barthel'].'&tabla=barthel"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
								                              echo'</article>';
								                            }
								                            if ($riesgo=='Dependencia moderada') {
								                              echo'<article class="col-md-12 alert alert-primary">';
								                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_barthel['freg'].'</p>';
								                              echo'<p><strong>Clasificación: </strong>'.$fila_h_barthel['calificacion_total'].'</p>';
								                              echo'<p><strong>Total: </strong>'.$fila_h_barthel['total'].'</p>';
								                              echo'<p><strong>Responsable: </strong>'.$fila_h_barthel['nombre'].'</p>';
																							echo'<p>'.$fila_h_downton['observacion'].'</p>';
								                              echo'</article>';
								                              echo '<article class="col-md-4">';
								                              echo'<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=XESCALA&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_h_barthel['id_esc_barthel'].'&tabla=barthel"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> </button></a>';
								                              echo'</article>';
								                            }
								                            if ($riesgo=='Dependencia leve') {
								                              echo'<article class="col-md-12 alert alert-info">';
								                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_barthel['freg'].'</p>';
								                              echo'<p><strong>Clasificación: </strong>'.$fila_h_barthel['calificacion_total'].'</p>';
								                              echo'<p><strong>Total: </strong>'.$fila_h_barthel['total'].'</p>';
								                              echo'<p><strong>Responsable: </strong>'.$fila_h_barthel['nombre'].'</p>';
																							echo'<p>'.$fila_h_downton['observacion'].'</p>';
								                              echo'</article>';
								                              echo '<article class="col-md-4">';
								                              echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_barthel['id_esc_barthel'].'&tabla=barthel"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
								                              echo'</article>';
								                            }
								                            if ($riesgo=='Independencia') {
								                              echo'<article class="col-md-12 alert alert-success">';
								                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_barthel['freg'].'</p>';
								                              echo'<p><strong>Clasificación: </strong>'.$fila_h_barthel['calificacion_total'].'</p>';
								                              echo'<p><strong>Total: </strong>'.$fila_h_barthel['total'].'</p>';
								                              echo'<p><strong>Responsable: </strong>'.$fila_h_barthel['nombre'].'</p>';
																							echo'<p>'.$fila_h_downton['observacion'].'</p>';
								                              echo'</article>';
								                              echo '<article class="col-md-4">';
								                              echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_barthel['id_esc_barthel'].'&tabla=barthel"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
								                              echo'</article>';
								                            }
								                            echo'</section>';
								                          }
								                        }
								                      echo'</div>
								                      <div class="modal-footer">
								                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								                      </div>
								                    </div>

								                  </div>
								                </div>';
								              }
								            }
								          }
								          echo'</section>';

								          echo'<section class="row">';
								          $id=$fila['id_adm_hosp'];
								          $sql_norton="SELECT count(id_esc_norton) cuantos	 FROM escala_norton WHERE id_adm_hosp=$id";
								          if ($tabla_norton=$bd1->sub_tuplas($sql_norton)){
								            foreach ($tabla_norton as $fila_norton ) {
								              $id_c=$fila_norton['cuantos'];
								              if ($id_c >= 0) {
								                echo'<br>
								                <article class="col-md-6">';
								                echo'<button type="button" class="btn btn-info " data-toggle="modal" data-target="#historia_norton_'.$fila["id_adm_hosp"].'">Historico Norton</button>';
								                echo'</article>';
								                echo'<article class="col-md-6">';
								                echo'<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NORTON&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-square"></span> </button></a>';
								                echo'</article>';
								                echo'
								                <div id="historia_norton_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
								                  <div class="modal-dialog">

								                    <!-- Modal content-->
								                    <div class="modal-content">
								                      <div class="modal-header">
								                        <button type="button" class="close" data-dismiss="modal">&times;</button>
								                        <h4 class="modal-title">Historico de registros Escala Norton</h4>
								                      </div>
								                      <div class="modal-body">';
								                        $sql_h_norton="SELECT a.id_esc_norton,freg,total,riesgo,observacion,b.nombre
								                                        FROM escala_norton a inner join user b on a.id_user=b.id_user
								                                        WHERE id_adm_hosp=$id and a.estado is null
								                                        ORDER BY freg DESC";
								                        if ($tabla_h_norton=$bd1->sub_tuplas($sql_h_norton)){
								                          foreach ($tabla_h_norton as $fila_h_norton ) {
								                            echo'<section class="panel-body">';
								                            $riesgo=$fila_h_norton['riesgo'];
								                            if ($riesgo=='MUY ALTO') {
								                              echo'<article class="col-md-12 alert alert-danger">';
								                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_norton['freg'].'</p>';
								                              echo'<p><strong>Clasificación: </strong>'.$fila_h_norton['riesgo'].'</p>';
								                              echo'<p><strong>Total: </strong>'.$fila_h_norton['total'].'</p>';
								                              echo'<p><strong>Responsable: </strong>'.$fila_h_norton['nombre'].'</p>';
								                              echo'<p><strong>Observación: </strong>'.$fila_h_norton['observacion'].'</p>';
								                              echo'</article>';
								                              echo '<article class="col-md-4">';
								                              echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_norton['id_esc_norton'].'&tabla=norton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
								                              echo'</article>';

								                            }
								                            if ($riesgo=='ALTO') {
								                              echo'<article class="col-md-12 alert alert-warning">';
								                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_norton['freg'].'</p>';
								                              echo'<p><strong>Clasificación: </strong>'.$fila_h_norton['riesgo'].'</p>';
								                              echo'<p><strong>Total: </strong>'.$fila_h_norton['total'].'</p>';
								                              echo'<p><strong>Responsable: </strong>'.$fila_h_norton['nombre'].'</p>';
								                              echo'<p><strong>Observación: </strong>'.$fila_h_norton['observacion'].'</p>';
								                              echo'</article>';
								                              echo '<article class="col-md-4">';
								                              echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_norton['id_esc_norton'].'&tabla=norton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
								                              echo'</article>';
								                            }
								                            if ($riesgo=='MEDIO') {
								                              echo'<article class="col-md-12 alert alert-primary">';
								                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_norton['freg'].'</p>';
								                              echo'<p><strong>Clasificación: </strong>'.$fila_h_norton['riesgo'].'</p>';
								                              echo'<p><strong>Total: </strong>'.$fila_h_norton['total'].'</p>';
								                              echo'<p><strong>Responsable: </strong>'.$fila_h_norton['nombre'].'</p>';
								                              echo'<p><strong>Observación: </strong>'.$fila_h_norton['observacion'].'</p>';
								                              echo'</article>';
								                              echo '<article class="col-md-4">';
								                              echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_norton['id_esc_norton'].'&tabla=norton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
								                              echo'</article>';
								                            }
								                            if ($riesgo=='NO RIESGO') {
								                              echo'<article class="col-md-12 alert alert-info">';
								                              echo'<p><strong>Fecha Registro: </strong>'.$fila_h_norton['freg'].'</p>';
								                              echo'<p><strong>Clasificación: </strong>'.$fila_h_norton['riesgo'].'</p>';
								                              echo'<p><strong>Total: </strong>'.$fila_h_norton['total'].'</p>';
								                              echo'<p><strong>Responsable: </strong>'.$fila_h_norton['nombre'].'</p>';
								                              echo'<p><strong>Observación: </strong>'.$fila_h_norton['observacion'].'</p>';
								                              echo'</article>';
								                              echo '<article class="col-md-4">';
								                              echo'<a href="Funcion_base/borrar.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$fila["doc_pac"].'&id='.$fila_h_norton['id_esc_norton'].'&tabla=norton"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar</button></a>';
								                              echo'</article>';
								                            }
								                            echo'</section>';
								                          }
								                        }
								                      echo'</div>
								                      <div class="modal-footer">
								                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								                      </div>
								                    </div>

								                  </div>
								                </div>';
								              }
								            }
								          }
								          echo'</section>';
								          echo'<section class="row">';
								          echo'<article class="col-md-12">';
								              $ida=$fila['id_adm_hosp'];
								              $sql_inclusion="SELECT id_inclusion_dom FROM inclusion_domiciliarios WHERE id_adm_hosp=$ida";
								              if ($tabla_inclusion=$bd1->sub_tuplas($sql_inclusion)){
								                foreach ($tabla_inclusion as $fila_inclusion) {
								                  $idi=$fila_inclusion['id_inclusion_dom'];
								                  if ($idi=='') {
								                    echo'<br>
								                    <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=INCLUSION&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-plus-square"></span> Criterios Inclusión</button></a>';
								                  }
								                  if ($idi!='') {
								                    echo'<br>
								                    <p>Ya existe Formato de inclusión en esta Admisión</p>';
								                  }
								                }
								              }else {
								                echo'<br>
								                <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=INCLUSION&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-plus-square"></span> Criterios Inclusión</button></a>';
								              }
								          echo'</article>';
								          echo'<article class="col-md-12">';
								              $ida=$fila['id_adm_hosp'];
								              $y=date('Y');
								              $m=date('m');
								              $sqlid_ronseg_dom="SELECT id_ronseg_dom FROM ronda_seguridad WHERE id_adm_hosp=$ida and freg_ronda BETWEEN '$y-$m-1' and '$y-$m-31'";
								              //echo $sqlid_ronseg_dom;
								              if ($tablaid_ronseg_dom=$bd1->sub_tuplas($sqlid_ronseg_dom)){
								                foreach ($tablaid_ronseg_dom as $filaid_ronseg_dom) {
								                  $idi=$filaid_ronseg_dom['id_ronseg_dom'];

								                  if ($idi=='') {
								                    echo'<br>
								                    <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=RONDA&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-danger" ><span class="fa fa-plus-square"></span> Ronda Seguridad</button></a>';
								                  }
								                  if ($idi!='') {
								                    echo'<br>
								                    <p>Ya existe Formato de Ronda de seguridad este mes</p>';
								                  }
								                }
								              }else {
								                echo'<br>
								                <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=RONDA&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-danger" ><span class="fa fa-plus-square"></span> Ronda Seguridad</button></a>';
								              }
								          echo'</article>';
								          echo'<article class="col-md-12">';
								              $ida=$fila['id_adm_hosp'];
								              $y=date('Y');
								              $m=date('m');
								              $sql_encu_dom="SELECT id_encuesta_dom FROM encuesta_dom WHERE id_adm_hosp=$ida and freg_encuesta BETWEEN '$y-$m-1' and '$y-$m-31'";
								              //echo $sql_encu_dom;
								              if ($tabla_encu_dom=$bd1->sub_tuplas($sql_encu_dom)){
								                foreach ($tabla_encu_dom as $fila_encu_dom) {
								                  $idi=$fila_encu_dom['id_encuesta_dom'];

								                  if ($idi=='') {
								                    echo'<br>
								                    <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ENCUESTA&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-info" ><span class="fa fa-plus-square"></span> Encuesta Satisfacción</button></a>';
								                  }
								                  if ($idi!='') {
								                    echo'<br>
								                    <p>Ya existe Formato de encuesta este mes</p>';
								                  }
								                }
								              }else {
								                echo'<br>
								                <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ENCUESTA&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-info" ><span class="fa fa-plus-square"></span> Encuesta Satisfacción</button></a>';
								              }
								          echo'</article>';
								          echo'</section>';
								    echo'</th>';
								    echo'</th>';
								    echo "</tr>\n";
									}

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
