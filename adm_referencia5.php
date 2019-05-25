<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["foto"])){
				if (is_uploaded_file($_FILES["foto"]["tmp_name"])){
					$cfoto=explode(".",$_FILES["foto"]["name"]);
					$archivo=$_POST["id_referencia"].'_'.$_POST["nomdoc"].".".$cfoto[count($cfoto)-1];
					if(move_uploaded_file($_FILES["foto"]["tmp_name"],WEB.SOPREF.$archivo)){
						$fotoE=",soporte_referencia='".SOPREF.$archivo."'";
						$fotoA=',soporte_referencia';
						$fotob=",'".SOPREF.$archivo."'";
						}
				}
			}

			switch ($_POST["operacion"]) {
				case 'ADDPRESEN':
					$sql="INSERT INTO referencia (id_paciente, id_eps, resp_crea, f_correo, h_correo, cuerpo_referencia, medico_asignado, estado_referencia)
					VALUES ('".$_POST["id_paciente"]."', '".$_POST["id_eps"]."','".$_SESSION["AUT"]["id_user"]."',
					'".$_POST["f_correo"]."','".$_POST["h_correo"]."','".$_POST["cuerpo_referencia"]."',
					'".$_POST["medico_asignado"]."', '1')";
					$subtitulo="Presentación hospitalaria del paciente fue";
					$subtitulo1="registrada";
				break;
				case 'SOPORTEREF':
				if ($_FILES["foto"]["error"] > 0) {
					$sql="INSERT INTO soporte_referencia (resp_cargue,nom_soporte$fotoA)
					VALUES ('".$_POST["id_referencia"]."','".$_SESSION['AUT']['id_user']."','".$_POST[""]."'$fotob)";
					$subtitulo="El documento <strong>".$_POST["nomdoc"].'</strong>';
					$subtitulo1="Cargado. <strong class='animated bounceIn'>Debido a que el archivo supera los 2 mb.</strong>";
				}else {
					$sql="INSERT INTO soporte_referencia (id_referencia,resp_cargue,nom_soporte$fotoA)
					VALUES ('".$_POST["id_referencia"]."','".$_SESSION['AUT']['id_user']."','".$_POST["nomdoc"]."'$fotob)";
					$subtitulo="El documento <strong>".$_POST["nomdoc"].'</strong>';
					$subtitulo1="Cargado";
				}
				break;
				case 'CREARPACIENTE':
				$nom_completo=$_POST["nom1"].' '.$_POST["nom2"].' '.$_POST["ape1"].' '.$_POST["ape2"];
					$sql="INSERT INTO pacientes (tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,dir_pac,tel_pac,genero,nom_completo) VALUES
					 			('".$_POST["tdocpac"]."','".$_POST["docpac"]."','".$_POST["nom1"]."','".$_POST["nom2"]."',
								'".$_POST["ape1"]."','".$_POST["ape2"]."','".$_POST["dirpac"]."','".$_POST["telpac"]."',
								'".$_POST["genero"]."','$nom_completo')";
					$subtitulo="El paciente".$_POST["nom1"].' '.$_POST["nom2"].' '.$_POST["ape1"].' '.$_POST["ape2"].' fue';
					$subtitulo1="agregada";
				break;
				case 'EDITPACIENTE':
					$sql="UPDATE pacientes SET tdoc_pac='".$_POST["tdocpac"]."',doc_pac='".$_POST["docpac"]."',
																		 nom1='".$_POST["nom1"]."',nom2='".$_POST["nom2"]."',
																		 ape1='".$_POST["ape1"]."',ape2='".$_POST["ape2"]."',
																		 dir_pac='".$_POST["dirpac"]."',tel_pac='".$_POST["telpac"]."',
																		 genero='".$_POST["genero"]."' WHERE id_paciente='".$_POST["idpaci"]."' ";
					$subtitulo="Datos de ".$_POST["nom1"].' '.$_POST["nom1"].' '.$_POST["ape1"].' '.$_POST["ape2"]." del paciente ";
					$subtitulo1="Actualizados";
				break;
				case 'RTAPRESENTACION':
				include "PHPmailer/class.phpmailer.php";
				include "PHPmailer/class.smtp.php";

				$rta1=$_POST['rta_validacion1'];
				$rta2=$_POST['rta_validacion2'];
				$rta3=$_POST['rta_validacion3'];
				$rta4=$_POST['rta_validacion4'];
				$rta5=$_POST['rta_validacion5'];
				$rta6=$_POST['rta_validacion6'];
				$rta7=$_POST['rta_validacion7'];
				$rta8=$_POST['rta_validacion8'];

				if ($rta1==1) {
					$eps_solicita=$_POST['presentacion'];
					$rta_ips=$_POST['respuesta1'];
					$mail1=$_POST['mail1'];
					$mail2=$_POST['mail2'];
					$mail3=$_POST['mail3'];
					$mail4=$_POST['mail4'];
					$mail5=$_POST['mail5'];
					$mail6=$_POST['mail6'];
					$asunto=$_POST['nom'];
					$crea=$_POST['resp1'];
					$med=$_SESSION['AUT']['nombre'];
					$email_user = "referencia@consorcio.emmanuelips.co";
					$email_password = "Referencia_2019";
					$the_subject = $asunto;
					$prueba1="sistemas2@emmanuelips.com";
					$prueba2="";
					/*$prueba3="direccion.cientifica@emmanuelips.com";*/
					$address_to = $mail1;
					$address_to2 = $mail2;
					$address_to3= $mail3;
					$address_to4= $mail4;
					$address_to5= $mail5;
					$address_to6= $mail6;
					$address_toP= "direccionsaludmental@consorcio.emmanuelips.co";
					$address_toM= "direccioncientifica@consorcio.emmanuelips.co";
					$address_toR= "referencia@consorcio.emmanuelips.co";
					$address_toBK= "bkreferencia@consorcio.emmanuelips.co";

					$from_name = "REFERENCIA CLINICA CONSORCIO EMMANUEL";
					$phpmailer = new PHPMailer();
					// ---------- datos de la cuenta de Gmail -------------------------------
					$phpmailer->Username = $email_user;
					$phpmailer->Password = $email_password;
					//-----------------------------------------------------------------------
					//$phpmailer->SMTPDebug = 1;
					$phpmailer->SMTPSecure = 'STARTTLS';
					$phpmailer->Host = "mail.emmanuelips.co"; // GMail
					$phpmailer->Port = 25
					;
					$phpmailer->IsSMTP(); // use SMTP
					$phpmailer->SMTPAuth = true;
					$phpmailer->setFrom($phpmailer->Username,$from_name);

					$phpmailer->AddAddress($address_to);
					$phpmailer->AddAddress($address_to2);
					$phpmailer->AddAddress($address_to3);
					$phpmailer->AddAddress($address_to4);
					$phpmailer->AddAddress($address_to5);
					$phpmailer->AddAddress($address_to6);

					$phpmailer->AddAddress($address_toP);
					$phpmailer->AddAddress($address_toM);
					$phpmailer->AddAddress($address_toR);
					$phpmailer->AddAddress($address_toBK);
					$phpmailer->Subject = utf8_decode($the_subject);
					$phpmailer->Body .= "<p>Cordial saludo</p>";

				  $phpmailer->Body .= utf8_decode("<p class='text-left'><strong>La EPS solicita:</strong></p>
															 <p class='text-justify'>$eps_solicita</p>");
					$phpmailer->Body .= utf8_decode("<p class='text-left'><strong>La IPS Responde:</strong></p>
															 <p class='text-justify'>$rta_ips</p>");
					$phpmailer->Body .= "<p class='text-left'><strong>Medico que recibe:</strong> $med</p><br>";
					$phpmailer->Body .= utf8_decode("<p class='text-left'>Referencia y contrareferencia</p>
															 <p class='text-left'>Clínica consorcio emmanuel</p>
															 <p class='text-left'>TEL: 4431850 Ext: 201 - 200 - 3045968650</p>");
					$phpmailer->Body .= utf8_decode("<p class='text-center text-primary'>CONSORCIO CLÍNICA EMMANUEL ---- Vereda los manzanos Km3 Vía Florida Anolaima, Facatativa-Cundinamarca</p>");
					$phpmailer->IsHTML(true);
					$phpmailer->Send();

					$sql1="UPDATE referencia SET estado_referencia=3 WHERE id_referencia='".$_POST["id_referencia"]."'";
					$sql="INSERT INTO rta_referencia (id_referencia, resp_rta, f_rta, h_rta, respuesta,estado_rta) VALUES
					 			('".$_POST["id_referencia"]."','".$_SESSION['AUT']["id_user"]."','".$_POST["f_rta"]."','".$_POST["h_rta"]."',
								'".$_POST["respuesta1"]."','3')";
					$subtitulo="La respuesta a la presentacion #".$_POST['id_referencia']." es de ACEPTACION Y fue";
					$subtitulo1="REGISTRADA";

				}
				if ($rta2==1) {
					$eps_solicita=$_POST['presentacion'];
					$rta_ips=$_POST['respuesta2'];
					$mail1=$_POST['mail1'];
					$mail2=$_POST['mail2'];
					$mail3=$_POST['mail3'];
					$mail4=$_POST['mail4'];
					$mail5=$_POST['mail5'];
					$mail6=$_POST['mail6'];
					$asunto=$_POST['nom'];
					$med=$_SESSION['AUT']['nombre'];
					$email_user = "referencia@consorcio.emmanuelips.co";
					$email_password = "Referencia_2019";
					$the_subject = $asunto;
					$address_to = $mail1;
					$address_to2 = $mail2;
					$address_to3= $mail3;
					$address_to4= $mail4;
					$address_to5= $mail5;
					$address_to6= $mail6;
					$address_toP= "direccionsaludmental@consorcio.emmanuelips.co";
					$address_toM= "direccioncientifica@consorcio.emmanuelips.co";
					$address_toR= "referencia@consorcio.emmanuelips.co";
					$address_toBK= "bkreferencia@consorcio.emmanuelips.co";

					$from_name = "REFERENCIA CLINICA CONSORCIO EMMANUEL";
					$phpmailer = new PHPMailer();
					// ---------- datos de la cuenta de Gmail -------------------------------
					$phpmailer->Username = $email_user;
					$phpmailer->Password = $email_password;
					//-----------------------------------------------------------------------
					//$phpmailer->SMTPDebug = 1;
					$phpmailer->SMTPSecure = 'STARTTLS';
					$phpmailer->Host = "mail.emmanuelips.co"; // GMail
					$phpmailer->Port = 25;
					$phpmailer->IsSMTP(); // use SMTP
					$phpmailer->SMTPAuth = true;
					$phpmailer->setFrom($phpmailer->Username,$from_name);
					$phpmailer->AddAddress($address_to);
					$phpmailer->AddAddress($address_to2);
					$phpmailer->AddAddress($address_to3);
					$phpmailer->AddAddress($address_to4);
					$phpmailer->AddAddress($address_to5);
					$phpmailer->AddAddress($address_to6);

					$phpmailer->AddAddress($address_toP);
					$phpmailer->AddAddress($address_toM);
					$phpmailer->AddAddress($address_toR);
					$phpmailer->AddAddress($address_toBK);
					$phpmailer->Subject = $the_subject;
					$phpmailer->Body .= "<p>Cordial saludo</p>";

				  $phpmailer->Body .= utf8_decode("<p class='text-left'><strong>La EPS solicita:</strong></p>
															 <p class='text-justify'>$eps_solicita</p>");
					$phpmailer->Body .= utf8_decode("<p class='text-left'><strong>La IPS Responde:</strong></p>
															 <p class='text-justify'>$rta_ips</p>");
					$phpmailer->Body .= "<p class='text-left'><strong>Medico que recibe:</strong> $med</p><br>";
					$phpmailer->Body .= utf8_decode("<p class='text-left'>Referencia y contrareferencia</p>
															 <p class='text-left'>Clínica consorcio emmanuel</p>
															 <p class='text-left'>TEL: 4431850 Ext: 201 - 200 - 30459686504</p>");
					$phpmailer->Body .= utf8_decode("<p class='text-center text-primary'>CONSORCIO CLÍNICA EMMANUEL -- --- Calle 136 No 52ª- 46 Bogotá DC</p>");
					$phpmailer->IsHTML(true);
					$phpmailer->Send();

					$sql1="UPDATE referencia SET estado_referencia=3 WHERE id_referencia='".$_POST["id_referencia"]."'";
					$sql="INSERT INTO rta_referencia (id_referencia, resp_rta, f_rta, h_rta, respuesta,estado_rta) VALUES
					 			('".$_POST["id_referencia"]."','".$_SESSION['AUT']["id_user"]."','".$_POST["f_rta"]."','".$_POST["h_rta"]."',
								'".$_POST["respuesta2"]."','3')";
					$subtitulo="La respuesta a la presentacion #".$_POST['id_referencia']." es de ACEPTACION Y fue";
					$subtitulo1="REGISTRADA";
				}
				if ($rta3==1) {
					$eps_solicita=$_POST['presentacion'];
					$rta_ips=$_POST['respuesta3'];
					$mail1=$_POST['mail1'];
					$mail2=$_POST['mail2'];
					$mail3=$_POST['mail3'];
					$mail4=$_POST['mail4'];
					$mail5=$_POST['mail5'];
					$mail6=$_POST['mail6'];
					$asunto=$_POST['nom'];
					$med=$_SESSION['AUT']['nombre'];
					$email_user = "referencia@consorcio.emmanuelips.co";
					$email_password = "Referencia_2019";
					$the_subject = $asunto;
					$address_to = $mail1;
					$address_to2 = $mail2;
					$address_to3= $mail3;
					$address_to4= $mail4;
					$address_to5= $mail5;
					$address_to6= $mail6;
					$address_toP= "direccionsaludmental@consorcio.emmanuelips.co";
					$address_toM= "direccioncientifica@consorcio.emmanuelips.co";
					$address_toR= "referencia@consorcio.emmanuelips.co";
					$address_toBK= "bkreferencia@consorcio.emmanuelips.co";

					$from_name = "REFERENCIA CLINICA CONSORCIO EMMANUEL";
					$phpmailer = new PHPMailer();
					// ---------- datos de la cuenta de Gmail -------------------------------
					$phpmailer->Username = $email_user;
					$phpmailer->Password = $email_password;
					//-----------------------------------------------------------------------
					//$phpmailer->SMTPDebug = 1;
					$phpmailer->SMTPSecure = 'STARTTLS';
					$phpmailer->Host = "mail.emmanuelips.co"; // GMail
					$phpmailer->Port = 25;
					$phpmailer->IsSMTP(); // use SMTP
					$phpmailer->SMTPAuth = true;
					$phpmailer->setFrom($phpmailer->Username,$from_name);
					$phpmailer->AddAddress($address_to);
					$phpmailer->AddAddress($address_to2);
					$phpmailer->AddAddress($address_to3);
					$phpmailer->AddAddress($address_to4);
					$phpmailer->AddAddress($address_to5);
					$phpmailer->AddAddress($address_to6);

					$phpmailer->AddAddress($address_toP);
					$phpmailer->AddAddress($address_toM);
					$phpmailer->AddAddress($address_toR);
					$phpmailer->AddAddress($address_toBK);
					$phpmailer->Subject = $the_subject;
					$phpmailer->Body .= "<p>Cordial saludo</p>";

				  $phpmailer->Body .= utf8_decode("<p class='text-left'><strong>La EPS solicita:</strong></p>
															 <p class='text-justify'>$eps_solicita</p>");
					$phpmailer->Body .= utf8_decode("<p class='text-left'><strong>La IPS Responde:</strong></p>
															 <p class='text-justify'>$rta_ips</p>");
					$phpmailer->Body .= "<p class='text-left'><strong>Medico que recibe:</strong> $med</p><br>";
					$phpmailer->Body .= utf8_decode("<p class='text-left'>Referencia y contrareferencia</p>
															 <p class='text-left'>Clínica consorcio emmanuel</p>
															 <p class='text-left'>TEL: 4431850 Ext: 201 - 200 - 3045968650</p>");
					$phpmailer->Body .= utf8_decode("<p class='text-center text-primary'>CONSORCIO CLÍNICA EMMANUEL </p>");
					$phpmailer->IsHTML(true);
					$phpmailer->Send();

					$sql1="UPDATE referencia SET estado_referencia=4 WHERE id_referencia='".$_POST["id_referencia"]."'";
					$sql="INSERT INTO rta_referencia (id_referencia, resp_rta, f_rta, h_rta, respuesta,estado_rta) VALUES
					 			('".$_POST["id_referencia"]."','".$_SESSION['AUT']["id_user"]."','".$_POST["f_rta"]."','".$_POST["h_rta"]."',
								'".$_POST["respuesta3"]."','4')";
					$subtitulo="La respuesta a la presentacion #".$_POST['id_referencia']." Se encuentra PENDIENTE Y fue";
					$subtitulo1="REGISTRADA";
				}
				if ($rta4==1) {
					$eps_solicita=$_POST['presentacion'];
					$rta_ips=$_POST['respuesta4'];
					$mail1=$_POST['mail1'];
					$mail2=$_POST['mail2'];
					$mail3=$_POST['mail3'];
					$mail4=$_POST['mail4'];
					$mail5=$_POST['mail5'];
					$mail6=$_POST['mail6'];
					$asunto=$_POST['nom'];
					$med=$_SESSION['AUT']['nombre'];
					$email_user = "referencia@consorcio.emmanuelips.co";
					$email_password = "Referencia_2019";
					$the_subject = $asunto;
					$address_to = $mail1;
					$address_to2 = $mail2;
					$address_to3= $mail3;
					$address_to4= $mail4;
					$address_to5= $mail5;
					$address_to6= $mail6;
					$address_toP= "direccionsaludmental@consorcio.emmanuelips.co";
					$address_toM= "direccioncientifica@consorcio.emmanuelips.co";
					$address_toR= "referencia@consorcio.emmanuelips.co";
					$address_toBK= "bkreferencia@consorcio.emmanuelips.co";

					$from_name = "REFERENCIA CLINICA CONSORCIO EMMANUEL";
					$phpmailer = new PHPMailer();
					// ---------- datos de la cuenta de Gmail -------------------------------
					$phpmailer->Username = $email_user;
					$phpmailer->Password = $email_password;
					//-----------------------------------------------------------------------
					//$phpmailer->SMTPDebug = 1;
					$phpmailer->SMTPSecure = 'STARTTLS';
					$phpmailer->Host = "mail.emmanuelips.co"; // GMail
					$phpmailer->Port = 25;
					$phpmailer->IsSMTP(); // use SMTP
					$phpmailer->SMTPAuth = true;
					$phpmailer->setFrom($phpmailer->Username,$from_name);
					$phpmailer->AddAddress($address_to);
					$phpmailer->AddAddress($address_to2);
					$phpmailer->AddAddress($address_to3);
					$phpmailer->AddAddress($address_to4);
					$phpmailer->AddAddress($address_to5);
					$phpmailer->AddAddress($address_to6);

					$phpmailer->AddAddress($address_toP);
					$phpmailer->AddAddress($address_toM);
					$phpmailer->AddAddress($address_toR);
					$phpmailer->AddAddress($address_toBK);
					$phpmailer->Subject = $the_subject;
					$phpmailer->Body .= "<p>Cordial saludo</p>";

				  $phpmailer->Body .= utf8_decode("<p class='text-left'><strong>La EPS solicita:</strong></p>
															 <p class='text-justify'>$eps_solicita</p>");
					$phpmailer->Body .= utf8_decode("<p class='text-left'><strong>La IPS Responde:</strong></p>
															 <p class='text-justify'>$rta_ips</p>");
					$phpmailer->Body .= "<p class='text-left'><strong>Medico que recibe:</strong> $med</p><br>";
					$phpmailer->Body .= utf8_decode("<p class='text-left'>Referencia y contrareferencia</p>
															 <p class='text-left'>Clínica consorcio emmanuel</p>
															 <p class='text-left'>TEL: 4431850 Ext: 201 - 200 - 3045968650</p>");
					$phpmailer->Body .= utf8_decode("<p class='text-center text-primary'>CONSORCIO CLÍNICA EMMANUEL </p>");
					$phpmailer->IsHTML(true);
					$phpmailer->Send();

					$sql1="UPDATE referencia SET estado_referencia=4 WHERE id_referencia='".$_POST["id_referencia"]."'";
					$sql="INSERT INTO rta_referencia (id_referencia, resp_rta, f_rta, h_rta, respuesta,estado_rta) VALUES
					 			('".$_POST["id_referencia"]."','".$_SESSION['AUT']["id_user"]."','".$_POST["f_rta"]."','".$_POST["h_rta"]."',
								'".$_POST["respuesta4"]."','4')";
					$subtitulo="La respuesta a la presentacion #".$_POST['id_referencia']." Se encuentra PENDIENTE Y fue";
					$subtitulo1="REGISTRADA";
				}
				if ($rta5==1) {
					$eps_solicita=$_POST['presentacion'];
					$rta_ips=$_POST['respuesta5'];
					$mail1=$_POST['mail1'];
					$mail2=$_POST['mail2'];
					$mail3=$_POST['mail3'];
					$mail4=$_POST['mail4'];
					$mail5=$_POST['mail5'];
					$mail6=$_POST['mail6'];
					$asunto=$_POST['nom'];
					$med=$_SESSION['AUT']['nombre'];
					$email_user = "referencia@consorcio.emmanuelips.co";
					$email_password = "Referencia_2019";
					$the_subject = $asunto;
					$address_to = $mail1;
					$address_to2 = $mail2;
					$address_to3= $mail3;
					$address_to4= $mail4;
					$address_to5= $mail5;
					$address_to6= $mail6;
					$address_toP= "direccionsaludmental@consorcio.emmanuelips.co";
					$address_toM= "direccioncientifica@consorcio.emmanuelips.co";
					$address_toR= "referencia@consorcio.emmanuelips.co";
					$address_toBK= "bkreferencia@consorcio.emmanuelips.co";

					$from_name = "REFERENCIA CLINICA CONSORCIO EMMANUEL";
					$phpmailer = new PHPMailer();
					// ---------- datos de la cuenta de Gmail -------------------------------
					$phpmailer->Username = $email_user;
					$phpmailer->Password = $email_password;
					//-----------------------------------------------------------------------
					//$phpmailer->SMTPDebug = 1;
					$phpmailer->SMTPSecure = 'STARTTLS';
					$phpmailer->Host = "mail.emmanuelips.co"; // GMail
					$phpmailer->Port = 25;
					$phpmailer->IsSMTP(); // use SMTP
					$phpmailer->SMTPAuth = true;
					$phpmailer->setFrom($phpmailer->Username,$from_name);
					$phpmailer->AddAddress($address_to);
					$phpmailer->AddAddress($address_to2);
					$phpmailer->AddAddress($address_to3);
					$phpmailer->AddAddress($address_to4);
					$phpmailer->AddAddress($address_to5);
					$phpmailer->AddAddress($address_to6);

					$phpmailer->AddAddress($address_toP);
					$phpmailer->AddAddress($address_toM);
					$phpmailer->AddAddress($address_toR);
					$phpmailer->AddAddress($address_toBK);
					$phpmailer->Subject = $the_subject;
					$phpmailer->Body .= "<p>Cordial saludo</p>";

				  $phpmailer->Body .= utf8_decode("<p class='text-left'><strong>La EPS solicita:</strong></p>
															 <p class='text-justify'>$eps_solicita</p>");
					$phpmailer->Body .= utf8_decode("<p class='text-left'><strong>La IPS Responde:</strong></p>
															 <p class='text-justify'>$rta_ips</p>");
					$phpmailer->Body .= "<p class='text-left'><strong>Medico que recibe:</strong> $med</p><br>";
					$phpmailer->Body .= utf8_decode("<p class='text-left'>Referencia y contrareferencia</p>
															 <p class='text-left'>Clínica consorcio emmanuel</p>
															 <p class='text-left'>TEL: 4431850 Ext: 201 - 200 - 3045968650</p>");
					$phpmailer->Body .= utf8_decode("<p class='text-center text-primary'>CONSORCIO CLÍNICA EMMANUEL </p>");
					$phpmailer->IsHTML(true);
					$phpmailer->Send();

					$sql1="UPDATE referencia SET estado_referencia=4 WHERE id_referencia='".$_POST["id_referencia"]."'";
					$sql="INSERT INTO rta_referencia (id_referencia, resp_rta, f_rta, h_rta, respuesta,estado_rta) VALUES
					 			('".$_POST["id_referencia"]."','".$_SESSION['AUT']["id_user"]."','".$_POST["f_rta"]."','".$_POST["h_rta"]."',
								'".$_POST["respuesta5"]."','4')";
					$subtitulo="La respuesta a la presentacion #".$_POST['id_referencia']." Se encuentra PENDIENTE Y fue";
					$subtitulo1="REGISTRADA";
				}
				if ($rta6==1) {
					$eps_solicita=$_POST['presentacion'];
					$rta_ips=$_POST['respuesta6'];
					$mail1=$_POST['mail1'];
					$mail2=$_POST['mail2'];
					$mail3=$_POST['mail3'];
					$mail4=$_POST['mail4'];
					$mail5=$_POST['mail5'];
					$mail6=$_POST['mail6'];
					$asunto=$_POST['nom'];
					$med=$_SESSION['AUT']['nombre'];
					$email_user = "referencia@consorcio.emmanuelips.co";
					$email_password = "Referencia_2019";
					$the_subject = $asunto;
					$address_to = $mail1;
					$address_to2 = $mail2;
					$address_to3= $mail3;
					$address_to4= $mail4;
					$address_to5= $mail5;
					$address_to6= $mail6;
					$address_toP= "direccionsaludmental@consorcio.emmanuelips.co";
					$address_toM= "direccioncientifica@consorcio.emmanuelips.co";
					$address_toR= "referencia@consorcio.emmanuelips.co";
					$address_toBK= "bkreferencia@consorcio.emmanuelips.co";

					$from_name = "REFERENCIA CLINICA CONSORCIO EMMANUEL";
					$phpmailer = new PHPMailer();
					// ---------- datos de la cuenta de Gmail -------------------------------
					$phpmailer->Username = $email_user;
					$phpmailer->Password = $email_password;
					//-----------------------------------------------------------------------
					//$phpmailer->SMTPDebug = 1;
					$phpmailer->SMTPSecure = 'STARTTLS';
					$phpmailer->Host = "mail.emmanuelips.co"; // GMail
					$phpmailer->Port = 25;
					$phpmailer->IsSMTP(); // use SMTP
					$phpmailer->SMTPAuth = true;
					$phpmailer->setFrom($phpmailer->Username,$from_name);
					$phpmailer->AddAddress($address_to);
					$phpmailer->AddAddress($address_to2);
					$phpmailer->AddAddress($address_to3);
					$phpmailer->AddAddress($address_to4);
					$phpmailer->AddAddress($address_to5);
					$phpmailer->AddAddress($address_to6);

					$phpmailer->AddAddress($address_toP);
					$phpmailer->AddAddress($address_toM);
					$phpmailer->AddAddress($address_toR);
					$phpmailer->AddAddress($address_toBK);
					$phpmailer->Subject = $the_subject;
					$phpmailer->Body .= "<p>Cordial saludo</p>";

				  $phpmailer->Body .= utf8_decode("<p class='text-left'><strong>La EPS solicita:</strong></p>
															 <p class='text-justify'>$eps_solicita</p>");
					$phpmailer->Body .= utf8_decode("<p class='text-left'><strong>La IPS Responde:</strong></p>
															 <p class='text-justify'>$rta_ips</p>");
					$phpmailer->Body .= "<p class='text-left'><strong>Medico que recibe:</strong> $med</p><br>";
					$phpmailer->Body .= utf8_decode("<p class='text-left'>Referencia y contrareferencia</p>
															 <p class='text-left'>Clínica consorcio emmanuel</p>
															 <p class='text-left'>TEL: 4431850 Ext: 201 - 200 - 3045968650</p>");
					$phpmailer->Body .= utf8_decode("<p class='text-center text-primary'>CONSORCIO CLÍNICA EMMANUEL </p>");
					$phpmailer->IsHTML(true);
					$phpmailer->Send();

					$sql1="UPDATE referencia SET estado_referencia=2 WHERE id_referencia='".$_POST["id_referencia"]."'";
					$sql="INSERT INTO rta_referencia (id_referencia, resp_rta, f_rta, h_rta, respuesta,estado_rta) VALUES
					 			('".$_POST["id_referencia"]."','".$_SESSION['AUT']["id_user"]."','".$_POST["f_rta"]."','".$_POST["h_rta"]."',
								'".$_POST["respuesta6"]."','2')";
					$subtitulo="La respuesta a la presentacion #".$_POST['id_referencia']." ha sido NO ACEPTADA Y fue";
					$subtitulo1="REGISTRADA";
				}
				if ($rta7==1) {
					$eps_solicita=$_POST['presentacion'];
					$rta_ips=$_POST['respuesta7'];
					$mail1=$_POST['mail1'];
					$mail2=$_POST['mail2'];
					$mail3=$_POST['mail3'];
					$mail4=$_POST['mail4'];
					$mail5=$_POST['mail5'];
					$mail6=$_POST['mail6'];
					$asunto=$_POST['nom'];
					$med=$_SESSION['AUT']['nombre'];
					$email_user = "referencia@consorcio.emmanuelips.co";
					$email_password = "Referencia_2019";
					$the_subject = $asunto;
					$address_to = $mail1;
					$address_to2 = $mail2;
					$address_to3= $mail3;
					$address_to4= $mail4;
					$address_to5= $mail5;
					$address_to6= $mail6;
					$address_toP= "direccionsaludmental@consorcio.emmanuelips.co";
					$address_toM= "direccioncientifica@consorcio.emmanuelips.co";
					$address_toR= "referencia@consorcio.emmanuelips.co";
					$address_toBK= "bkreferencia@consorcio.emmanuelips.co";

					$from_name = "REFERENCIA CLINICA CONSORCIO EMMANUEL";
					$phpmailer = new PHPMailer();
					// ---------- datos de la cuenta de Gmail -------------------------------
					$phpmailer->Username = $email_user;
					$phpmailer->Password = $email_password;
					//-----------------------------------------------------------------------
					//$phpmailer->SMTPDebug = 1;
					$phpmailer->SMTPSecure = 'STARTTLS';
					$phpmailer->Host = "mail.emmanuelips.co"; // GMail
					$phpmailer->Port = 25;
					$phpmailer->IsSMTP(); // use SMTP
					$phpmailer->SMTPAuth = true;
					$phpmailer->setFrom($phpmailer->Username,$from_name);
					$phpmailer->AddAddress($address_to);
					$phpmailer->AddAddress($address_to2);
					$phpmailer->AddAddress($address_to3);
					$phpmailer->AddAddress($address_to4);
					$phpmailer->AddAddress($address_to5);
					$phpmailer->AddAddress($address_to6);

					$phpmailer->AddAddress($address_toP);
					$phpmailer->AddAddress($address_toM);
					$phpmailer->AddAddress($address_toR);
					$phpmailer->AddAddress($address_toBK);
					$phpmailer->Subject = $the_subject;
					$phpmailer->Body .= "<p>Cordial saludo</p>";

				  $phpmailer->Body .= utf8_decode("<p class='text-left'><strong>La EPS solicita:</strong></p>
															 <p class='text-justify'>$eps_solicita</p>");
					$phpmailer->Body .= utf8_decode("<p class='text-left'><strong>La IPS Responde:</strong></p>
															 <p class='text-justify'>$rta_ips</p>");
					$phpmailer->Body .= "<p class='text-left'><strong>Medico que recibe:</strong> $med</p><br>";
					$phpmailer->Body .= utf8_decode("<p class='text-left'>Referencia y contrareferencia</p>
															 <p class='text-left'>Clínica consorcio emmanuel</p>
															 <p class='text-left'>TEL: 4431850 Ext: 201 - 200 - 3045968650</p>");
					$phpmailer->Body .= utf8_decode("<p class='text-center text-primary'>CONSORCIO CLÍNICA EMMANUEL</p>");
					$phpmailer->IsHTML(true);
					$phpmailer->Send();

					$sql1="UPDATE referencia SET estado_referencia=2 WHERE id_referencia='".$_POST["id_referencia"]."'";
					$sql="INSERT INTO rta_referencia (id_referencia, resp_rta, f_rta, h_rta, respuesta,estado_rta) VALUES
					 			('".$_POST["id_referencia"]."','".$_SESSION['AUT']["id_user"]."','".$_POST["f_rta"]."','".$_POST["h_rta"]."',
								'".$_POST["respuesta7"]."','2')";
					$subtitulo="La respuesta a la presentacion #".$_POST['id_referencia']." ha sido NO ACEPTADA Y fue";
					$subtitulo1="REGISTRADA";
				}
				if ($rta8==1) {
					$eps_solicita=$_POST['presentacion'];
					$rta_ips=$_POST['respuesta8'];
					$mail1=$_POST['mail1'];
					$mail2=$_POST['mail2'];
					$mail3=$_POST['mail3'];
					$mail4=$_POST['mail4'];
					$mail5=$_POST['mail5'];
					$mail6=$_POST['mail6'];
					$asunto=$_POST['nom'];
					$med=$_SESSION['AUT']['nombre'];
					$email_user = "referencia@consorcio.emmanuelips.co";
					$email_password = "Referencia_2019";
					$the_subject = $asunto;
					$address_to = $mail1;
					$address_to2 = $mail2;
					$address_to3= $mail3;
					$address_to4= $mail4;
					$address_to5= $mail5;
					$address_to6= $mail6;
					$address_toP= "direccionsaludmental@consorcio.emmanuelips.co";
					$address_toM= "direccioncientifica@consorcio.emmanuelips.co";
					$address_toR= "referencia@consorcio.emmanuelips.co";
					$address_toBK= "bkreferencia@consorcio.emmanuelips.co";

					$from_name = "REFERENCIA CLINICA CONSORCIO EMMANUEL";
					$phpmailer = new PHPMailer();
					// ---------- datos de la cuenta de Gmail -------------------------------
					$phpmailer->Username = $email_user;
					$phpmailer->Password = $email_password;
					//-----------------------------------------------------------------------
					//$phpmailer->SMTPDebug = 1;
					$phpmailer->SMTPSecure = 'STARTTLS';
					$phpmailer->Host = "mail.emmanuelips.co"; // GMail
					$phpmailer->Port = 25;
					$phpmailer->IsSMTP(); // use SMTP
					$phpmailer->SMTPAuth = true;
					$phpmailer->setFrom($phpmailer->Username,$from_name);
					$phpmailer->AddAddress($address_to);
					$phpmailer->AddAddress($address_to2);
					$phpmailer->AddAddress($address_to3);
					$phpmailer->AddAddress($address_to4);
					$phpmailer->AddAddress($address_to5);
					$phpmailer->AddAddress($address_to6);

					$phpmailer->AddAddress($address_toP);
					$phpmailer->AddAddress($address_toM);
					$phpmailer->AddAddress($address_toR);
					$phpmailer->AddAddress($address_toBK);
					$phpmailer->Subject = $the_subject;
					$phpmailer->Body .= "<p>Cordial saludo</p>";

				  $phpmailer->Body .= utf8_decode("<p class='text-left'><strong>La EPS solicita:</strong></p>
															 <p class='text-justify'>$eps_solicita</p>");
					$phpmailer->Body .= utf8_decode("<p class='text-left'><strong>La IPS Responde:</strong></p>
															 <p class='text-justify'>$rta_ips</p>");
					$phpmailer->Body .= "<p class='text-left'><strong>Medico que recibe:</strong> $med</p><br>";
					$phpmailer->Body .= utf8_decode("<p class='text-left'>Referencia y contrareferencia</p>
															 <p class='text-left'>Clínica consorcio emmanuel</p>
															 <p class='text-left'>TEL: 4431850 Ext: 201 - 200 - 3045968650</p>");
					$phpmailer->Body .= utf8_decode("<p class='text-center text-primary'>CONSORCIO CLÍNICA EMMANUEL </p>");
					$phpmailer->IsHTML(true);
					$phpmailer->Send();

					$sql1="UPDATE referencia SET estado_referencia=2 WHERE id_referencia='".$_POST["id_referencia"]."'";
					$sql="INSERT INTO rta_referencia (id_referencia, resp_rta, f_rta, h_rta, respuesta,estado_rta) VALUES
					 			('".$_POST["id_referencia"]."','".$_SESSION['AUT']["id_user"]."','".$_POST["f_rta"]."','".$_POST["h_rta"]."',
								'".$_POST["respuesta8"]."','2')";
					$subtitulo="La respuesta a la presentacion #".$_POST['id_referencia']." ha sido NO ACEPTADA Y fue";
					$subtitulo1="REGISTRADA";
				}

				break;
			case 'XSOPORTE':
				$sql="SELECT soporte_referencia  from soporte_referencia where id_soporte_ref=".$_POST["idsref"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("foto"=> "");
				}
				$sql="DELETE FROM soporte_referencia WHERE id_soporte_ref=".$_POST["idsref"];
				$subtitulo="El documento <strong>".$_POST["nomdoc"].'</strong>';
				$subtitulo="Eliminado";
			break;
			case 'ADDBITACORA':
				$sql="INSERT INTO bitacora_referencia_hosp (id_referencia, resp_bitacora, freg_bitacora, hreg_bitacora, bitacora)
				VALUES ('".$_POST["id_referencia"]."','".$_SESSION["AUT"]["id_user"]."',
				'".$_POST["freg_bitacora"]."','".$_POST["hreg_bitacora"]."','".$_POST["bitacora"]."')";
				$subtitulo="Bitacora ";
				$subtitulo1="registrada";
			break;
			case 'CANCELPRES':
				$sql="UPDATE referencia SET estado_referencia=5,obs_cancelacion='".$_POST['obs_cancelacion']."' WHERE id_referencia='".$_POST["id_referencia"]."'";
				$subtitulo="Referencia ";
				$subtitulo1="Cancelada";
			break;
		}
		//echo $sql;
		//echo $sql1;
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo $subtitulo1 con exito!";
			$check='si';
				if ($bd1->consulta($sql1)) {
					$check='si';
				}
		}else{
			$subtitulo="$subtitulo NO fue $subtitulo1 !!! .";
			$check="no";
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'ADDPRESEN':
			$idpac=$_REQUEST['idpac'];
			$sql="SELECT id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,dir_pac,tel_pac,genero
						FROM pacientes WHERE id_paciente=$idpac";
			$color="yellow";
			$boton="Agregar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$opcion=$_REQUEST['opcion'];
			$doc=$_REQUEST['docc'];
			$form1='referencia/presentacion/add_presentacion.php';
			$subtitulo='Registro de presentación hospitalario';
		break;
		case 'SOPORTEREF':
			$idpac=$_REQUEST['idpac'];
			$sql="SELECT id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,dir_pac,tel_pac,genero
						FROM pacientes WHERE id_paciente=$idpac";
			$color="yellow";
			$boton="Cargar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$opcion=$_REQUEST['opcion'];
			$doc=$_REQUEST['docc'];
			$referencia=$_REQUEST['idr'];
			$form1='referencia/presentacion/upload.php';
			$subtitulo='Cargue de soportes de presentación';
		break;
		case 'EDITPACIENTE':
			$idpac=$_REQUEST['idpac'];
			$sql="SELECT id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,dir_pac,tel_pac,genero
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
		case 'CREARPACIENTE':
			$idpac=$_REQUEST['idpac'];
			$sql="SELECT id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,dir_pac,tel_pac,genero
						FROM pacientes WHERE id_paciente=$idpac";
			$color="yellow";
			$boton="Registrar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$opcion=$_REQUEST['opcion'];
			$doc=$_REQUEST['docc'];
			$form1='formulariosDOM/presentacion/add_paciente.php';
			$subtitulo='Creación de datos básicos paciente';
		break;
		case 'CANCELPRES':
			$idref=$_REQUEST['idr'];
			$sql="SELECT a.nom_completo,doc_pac,tdoc_pac,
									 b.id_referencia,f_correo,h_correo,estado_referencia,cuerpo_referencia,resp_crea,
									 c.nom_eps,c.id_eps ideps,
									 d.id_soporte_ref, resp_cargue, fcargue, nom_soporte, soporte_referencia,
									 e.nombre resp1
						 FROM pacientes a INNER JOIN referencia b on a.id_paciente=b.id_paciente
															INNER JOIN eps c on c.id_eps=b.id_eps
															LEFT JOIN soporte_referencia d on d.id_referencia=b.id_referencia
															LEFT JOIN user e on e.id_user=b.resp_crea
						 WHERE b.id_referencia=$idref";
						 //echo $sql;
			$color="yellow";
			$boton="Cancelar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$opcion=$_REQUEST['opcion'];
			$doc=$_REQUEST['docc'];
			$form1='referencia/presentacion/cancel_ref.php';
			$subtitulo='Cancelación de la referencia hospitalaria';
		break;
		case 'RTAPRESENTACION':
			$idref=$_REQUEST['idr'];
			$sql="SELECT a.nom_completo,doc_pac,tdoc_pac,
									 b.id_referencia,f_correo,h_correo,estado_referencia,cuerpo_referencia,resp_crea,
									 c.nom_eps,c.id_eps ideps,
									 d.id_soporte_ref, resp_cargue, fcargue, nom_soporte, soporte_referencia,
									 e.nombre resp1
						 FROM pacientes a INNER JOIN referencia b on a.id_paciente=b.id_paciente
															INNER JOIN eps c on c.id_eps=b.id_eps
															LEFT JOIN soporte_referencia d on d.id_referencia=b.id_referencia
															LEFT JOIN user e on e.id_user=b.resp_crea
						 WHERE b.id_referencia=$idref";
						 //echo $sql;
			$color="yellow";
			$boton="Responder";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$opcion=$_REQUEST['opcion'];
			$doc=$_REQUEST['docc'];
			$form1='referencia/presentacion/add_rta.php';
			$subtitulo='Registro de respuesta a presentación hospitalaria';
		break;
		case 'ADDBITACORA':
			$idref=$_REQUEST['idr'];
			$sql="SELECT a.nom_completo,doc_pac,tdoc_pac,
									 b.id_referencia,f_correo,h_correo,estado_referencia,cuerpo_referencia,resp_crea,
									 c.nom_eps,c.id_eps ideps,
									 d.id_soporte_ref, resp_cargue, fcargue, nom_soporte, soporte_referencia,
									 e.nombre resp1
						 FROM pacientes a INNER JOIN referencia b on a.id_paciente=b.id_paciente
															INNER JOIN eps c on c.id_eps=b.id_eps
															LEFT JOIN soporte_referencia d on d.id_referencia=b.id_referencia
															LEFT JOIN user e on e.id_user=b.resp_crea
						 WHERE b.id_referencia=$idref";
			$color="yellow";
			$boton="Agregar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$opcion=$_REQUEST['opcion'];
			$doc=$_REQUEST['docc'];
			$form1='referencia/presentacion/add_bitacora.php';
			$subtitulo='Registro de bitacora referencia';
		break;

		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"",
										"dir_pac"=>"","tel_pac"=>"","genero"=>"","id_adm_hosp"=>"","id_eps"=>"","id"=>"","nom_completo"=>"",
										"id_referencia"=>"","f_correo"=>"","h_correo"=>"","estado_referencia"=>"","cuerpo_referencia"=>"","nom_eps"=>"","ideps"=>"","resp1"=>"");

			}
		}else{
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"",
										"dir_pac"=>"","tel_pac"=>"","genero"=>"","id_adm_hosp"=>"","id_eps"=>"","id"=>"","nom_completo"=>"",
										"id_referencia"=>"","f_correo"=>"","h_correo"=>"","estado_referencia"=>"","cuerpo_referencia"=>"","nom_eps"=>"","ideps"=>"","resp1"=>"");
			}

		?>
<?php include ($form1);?>
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
  <section class="panel-heading">
    <h4>Referencia y contrareferencia de pacientes hospitalarios</h4>
  </section>
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
    </section>
		<section class="col-md-2">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#pac_ace"><span class="fa fa-check fa-2x"></span> Pacientes<br>Aceptados</button>
			<div id="pac_ace" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Pacientes <strong class="text-success">Aceptados</strong>  en proceso de referencia</h4>
		      </div>
		      <div class="modal-body">
						<table class="table table-bordered ">
							<tr>
								<td>PACIENTE</td>
								<td>FECHA<br>ACEPTACION</td>
								<td>ESTADO</td>
								<td></td>
							</tr>
							<?php
								$sql_1="SELECT a.nom_completo,doc_pac,
															 b.id_referencia,estado_referencia
												FROM pacientes a INNER JOIN referencia b on a.id_paciente=b.id_paciente
												WHERE b.estado_referencia in (3) ";
								$i=1;
								if ($tabla_1=$bd1->sub_tuplas($sql_1)){
									foreach ($tabla_1 as $fila_1 ) {
										if ($fila_1['estado_referencia']==3) {
											echo'<tr><td class="alert alert-success">
														<p>'.$fila_1['nom_completo'].'</p>
														<p>'.$fila_1['doc_pac'].'</p>
														<p>'.$fila_1['id_referencia'].'</p>
													 </td>';
													 echo'<td class="alert alert-success">';
													 $idrf=$fila_1['id_referencia'];
													 $sql_detalle="SELECT a.f_rta,
													 											b.nombre
																	 FROM rta_referencia a INNER JOIN user b on a.resp_rta=b.id_user
																	 WHERE a.id_referencia=$idrf ";
																	 //echo $sql_detalle;
													 if ($tabla_detalle=$bd1->sub_tuplas($sql_detalle)){
														 foreach ($tabla_detalle as $fila_detalle) {
															 echo'<p>'.$fila_detalle['f_rta'].'</p>';
															 echo'<p>'.$fila_detalle['nombre'].'</p>';
													 	 }
													 }
		 											 echo'</td>';
													 echo'<td class="alert alert-success">
		 														<p>ACEPTADO</p>
		 													 </td>
															 <td class="alert alert-success">
															 <a href="'.PROGRAMA.'?doc='.$fila_1["doc_pac"].'&buscar=Consultar&opcion='.$_REQUEST["opcion"].'"><button type="button" class="btn btn-success" ><span class="fa fa-eye"></span> VER </button></a></td>
															 </tr>';
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
    </section>


		<section class="col-md-2">
      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#pac_pen"><span class="fa fa-clock-o fa-2x"></span> Pacientes<br>Pendientes</button>
			<div id="pac_pen" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Pacientes <strong class="text-warning">Pendientes</strong> en proceso de referencia</h4>
		      </div>
		      <div class="modal-body">
						<table class="table table-bordered ">
							<tr>
								<td>PACIENTE</td>
								<td>FECHA<br>ACEPTACION</td>
								<td>ESTADO</td>
								<td></td>
							</tr>
							<?php
								$sql_1="SELECT a.nom_completo,doc_pac,
															 b.id_referencia,estado_referencia,
															 c.f_rta,
															 d.nombre
												FROM pacientes a INNER JOIN referencia b on a.id_paciente=b.id_paciente
																				 INNER JOIN rta_referencia c on c.id_referencia=b.id_referencia
																				 INNER JOIN user d on d.id_user=c.resp_rta
												WHERE b.estado_referencia in (4) ORDER by f_rta ASC";
								$i=1;
								if ($tabla_1=$bd1->sub_tuplas($sql_1)){
									foreach ($tabla_1 as $fila_1 ) {
										if ($fila_1['estado_referencia']==4) {
											echo'<tr><td class="alert alert-warning">
														<p>'.$fila_1['nom_completo'].'</p>
														<p>'.$fila_1['doc_pac'].'</p>
														<p>'.$fila_1['id_referencia'].'</p>
													 </td>';
													 echo'<td class="alert alert-warning">
															 <p>'.$fila_1['f_rta'].'</p>
															 <p>'.$fila_1['nombre'].'</p>
															</td>';
													 echo'<td class="alert alert-warning">
		 														<p>PENDIENTE</p>
		 													 </td>
															 <td class="alert alert-warning"><a href="'.PROGRAMA.'?doc='.$fila_1["doc_pac"].'&buscar=Consultar&opcion='.$_REQUEST["opcion"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-eye"></span> VER </button></a></td>
															 </tr>';
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
    </section>
		<section class="col-md-2">
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#pac_pres"><span class="fa fa-gift fa-2x"></span> Pacientes<br>presentados</button>
			<div id="pac_pres" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Pacientes <strong class="text-success">Presentados</strong>  en proceso de referencia</h4>
		      </div>
		      <div class="modal-body">
						<table class="table table-bordered ">
							<tr>
								<td>PACIENTE</td>
								<td>FECHA<br>ACEPTACION</td>
								<td>ESTADO</td>
								<td></td>
							</tr>
							<?php
								$sql_1="SELECT a.nom_completo,doc_pac,
															 b.id_referencia,freg_crea,estado_referencia,
															 d.nombre
												FROM pacientes a INNER JOIN referencia b on a.id_paciente=b.id_paciente
																				 INNER JOIN user d on d.id_user=b.resp_crea
												WHERE b.estado_referencia in (1) ORDER by freg_crea ASC";
								$i=1;
								if ($tabla_1=$bd1->sub_tuplas($sql_1)){
									foreach ($tabla_1 as $fila_1 ) {
										if ($fila_1['estado_referencia']==1) {
											echo'<tr><td class="alert alert-info">
														<p>'.$fila_1['nom_completo'].'</p>
														<p>'.$fila_1['doc_pac'].'</p>
														<p>'.$fila_1['id_referencia'].'</p>
													 </td>';
													 echo'<td class="alert alert-info">
															 <p>'.$fila_1['freg_crea'].'</p>
															 <p>'.$fila_1['nombre'].'</p>
															</td>';
													 echo'<td class="alert alert-info">
		 														<p>PRESENTADO</p>
		 													 </td>
															 <td class="alert alert-info"><a href="'.PROGRAMA.'?doc='.$fila_1["doc_pac"].'&buscar=Consultar&opcion='.$_REQUEST["opcion"].'"><button type="button" class="btn btn-info" ><span class="fa fa-eye"></span> VER </button></a></td>
															 </tr>';
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
    </section>
		<section class="col-md-2">
			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#pac_nace"><span class="fa fa-check fa-2x"></span> Pacientes<br>NO Aceptados</button>
			<div id="pac_nace" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Pacientes <strong class="text-danger">NO Aceptados</strong>  en proceso de referencia</h4>
					</div>
					<div class="modal-body">
						<table class="table table-bordered ">
							<tr>
								<td>PACIENTE</td>
								<td>FECHA<br>ACEPTACION</td>
								<td>ESTADO</td>
								<td></td>
							</tr>
							<?php
								$sql_1="SELECT a.nom_completo,doc_pac,
															 b.id_referencia,estado_referencia
												FROM pacientes a INNER JOIN referencia b on a.id_paciente=b.id_paciente
												WHERE b.estado_referencia in (2) ";
								$i=1;
								if ($tabla_1=$bd1->sub_tuplas($sql_1)){
									foreach ($tabla_1 as $fila_1 ) {
										if ($fila_1['estado_referencia']==2) {
											echo'<tr><td class="alert alert-danger">
														<p>'.$fila_1['nom_completo'].'</p>
														<p>'.$fila_1['doc_pac'].'</p>
														<p>'.$fila_1['id_referencia'].'</p>
													 </td>';
													 echo'<td class="alert alert-danger">';
													 $idrf=$fila_1['id_referencia'];
													 $sql_detalle="SELECT a.f_rta,
																								b.nombre
																	 FROM rta_referencia a INNER JOIN user b on a.resp_rta=b.id_user
																	 WHERE a.id_referencia=$idrf ";
																	 //echo $sql_detalle;
													 if ($tabla_detalle=$bd1->sub_tuplas($sql_detalle)){
														 foreach ($tabla_detalle as $fila_detalle) {
															 echo'<p>'.$fila_detalle['f_rta'].'</p>';
															 echo'<p>'.$fila_detalle['nombre'].'</p>';
														 }
													 }
													 echo'</td>';
													 echo'<td class="alert alert-danger">
																<p>NO ACEPTADO</p>
															 </td>
															 <td class="alert alert-danger">
															 <a href="'.PROGRAMA.'?doc='.$fila_1["doc_pac"].'&buscar=Consultar&opcion='.$_REQUEST["opcion"].'"><button type="button" class="btn btn-success" ><span class="fa fa-eye"></span> VER </button></a></td>
															 </tr>';
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
		</section>
  </section>
  <section class="panel-body">
    <table class="table table-bordered">
      <tr>
        <td class="info">PACIENTE</td>
				<td class="info">PRESENTACIÓN</td>
				<td class="info">BITACORA</td>
      </tr>

      <?php
      $doc=$_REQUEST['doc'];
      if (isset($doc)) {
        $sqlp="SELECT a.id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento,
                        edad, uedad, dir_pac, zonificacion, tel_pac, email_pac, estadocivil,
                        genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac,
                        cie, descricie, zonapac, ipsordena, nom_completo,
                      c.nom_barrio,
                      d.nom_upz,
                      e.nom_localidad
               FROM pacientes a LEFT JOIN barrio c on a.zonificacion=c.id_barrio
                                LEFT JOIN upz d on d.id_upz=c.id_upz
                                LEFT JOIN localidades e on e.id_localidad=d.id_localidad
               WHERE a.doc_pac='$doc'";
               //echo $sqlp;
        if ($tablap=$bd1->sub_tuplas($sqlp)){
          foreach ($tablap as $filap ) {
            echo'<tr>';//    SECCION DE PACIENTES CRUD DE PACIENTE
            echo'<td>
                  <p>'.$filap['nom1'].' '.$filap['nom2'].' '.$filap['ape1'].' '.$filap['ape2'].'</p>
                  <p>'.$filap['tdoc_pac'].': '.$filap['doc_pac'].'</p>
                  <p><strong>Dirección: </strong> '.$filap['dir_pac'].'</p>
                  <p><strong>Contacto: </strong> '.$filap['tel_pac'].'</p>
									<p class="text-left"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EDITPACIENTE&idpac='.$filap["id_paciente"].'&docc='.$filap['doc_pac'].'">
									<button type="button" class="btn btn-warning">
									<span class="fa fa-edit"></span> Editar paciente</button></a></p>';
									$pac=$filap['id_paciente'];
									$sql_egreso="SELECT fegreso_hosp,estado_salida FROM adm_hospitalario WHERE id_paciente=$pac and estado_salida='Expulsado'";
									if ($tabla_egreso=$bd1->sub_tuplas($sql_egreso)){
									 foreach ($tabla_egreso as $fila_egreso) {
										 echo'<section class="panel-body alert alert-danger">
													 <p><strong>Este paciente tuvo egreso el <strong class="text-primary">'.$fila_egreso['fegreso_hosp'].'</strong> en el servicio HOSPITALARIO</strong></p>
													 <p>Y su estado de salida fue : <strong>'.$fila_egreso['estado_salida'].'</strong></p>
													</section>';
									 }
									}
						echo'</td>';
						echo '<td>';
						$pac=$filap['id_paciente'];
						//echo $pac;
						$sql_adm="SELECT id_adm_hosp,fingreso_hosp,tipo_servicio,estado_adm_hosp,estado_salida
									 FROM adm_hospitalario
									 WHERE id_paciente=$pac and estado_adm_hosp='Activo' and tipo_servicio='Hospitalario'";
									 //echo $sql_adm;
						if ($tabla_adm=$bd1->sub_tuplas($sql_adm)){
							foreach ($tabla_adm as $fila_adm) {
								echo'<section class="panel-body">
											<p><strong>Este paciente tiene admisión <strong class="text-primary">Activa</strong> en el servicio HOSPITALARIO</strong></p>
										 	<p><strong>Fecha ingreso: </strong>'.$fila_adm['fingreso_hosp'].'</p>
										 </section>';
							}
						}else {
							$pac=$filap['id_paciente'];
							$sqlh="SELECT b.id_referencia,f_correo, h_correo, cuerpo_referencia, medico_asignado, estado_referencia
							       FROM pacientes a LEFT JOIN referencia b on a.id_paciente=b.id_paciente
							       WHERE a.id_paciente=$pac ";
							       //echo $sqlh;
							if ($tablah=$bd1->sub_tuplas($sqlh)){
							  foreach ($tablah as $filah) {
									if ($filah['estado_referencia']==1) {//en caso de presentado
										echo'<section class="panel-body">
													<p><strong>ID: </strong> '.$filah['id_referencia'].'</p>
													<p><strong>Fecha: </strong>'.$filah['f_correo'].' <strong>Hora: </strong>'.$filah['h_correo'].'  <strong>Estado: </strong><strong class="alert alert-info"> PRESENTADO</strong>
												 </section>';
										echo'<section class="panel-body">
													<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detalle_referencia"><span class="fa fa-list"></span> Ver Detalle</button> <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CANCELPRES&idpac='.$filap["id_paciente"].'&idr='.$filah["id_referencia"].'&docc='.$filap['doc_pac'].'">
													<button type="button" class="btn btn-danger">
													<span class="fa fa-times-circle"></span> Cancelar Presentación</button></a></p>
		 										 </section>';
										echo'<section class="panel-body">';
										$idref=$filah['id_referencia'];
										$sqlr="SELECT id_soporte_ref, fcargue, nom_soporte, soporte_referencia
													FROM soporte_referencia
													WHERE  id_referencia=$idref limit 1";
													//echo $sqlr;
													if ($tablar=$bd1->sub_tuplas($sqlr)){
														foreach ($tablar as $filar) {
															if ($filar['id_soporte_ref']=='') {
																echo'<p class="alert alert-danger fa fa-info-circle animated zoomIn"> Desea realizar cargue de soportes?
																<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SOPORTEREF&idr='.$idref.'&docc='.$filap['doc_pac'].'">
																<button type="button" class="btn btn-success">
																<span class="fa fa-upload"></span> </button></a></p>';
															}else {
																echo'<p class="alert alert-info fa fa-info-circle animated zoomIn"> Ya existen cargues. Desea seguir cargando?
																<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SOPORTEREF&idr='.$idref.'&docc='.$filap['doc_pac'].'">
																<button type="button" class="btn btn-success">
																<span class="fa fa-upload"></span> </button></a></p>';
															}
														}
													}else {
														echo'<p class="alert alert-danger fa fa-info-circle animated zoomIn"> No ha realizado ningun cargue, desea hacerlo?
														<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SOPORTEREF&idr='.$idref.'&docc='.$filap['doc_pac'].'">
														<button type="button" class="btn btn-success">
														<span class="fa fa-upload"></span> </button></a></p>';
													}
		 		 						echo'</section>';
										echo'<div id="detalle_referencia" class="modal fade" role="dialog">
												  <div class="modal-dialog modal-lg">
												    <div class="modal-content">
												      <div class="modal-header">
												        <button type="button" class="close" data-dismiss="modal">&times;</button>
												        <h4 class="modal-title">Detalles de presentación hospitalaria</h4>
												      </div>
												      <div class="modal-body">
															<section class="panel-body">
																<table class="table table-bordered">
																	<tr>
																		<td>
																		<h3>Solicitud de EPS</h3>
																		<p>'.$filah['cuerpo_referencia'].'</p>
																		</td>
																	</tr>
																</table>
															</section>
															<section class="panel-body">
																<table class="table table-bordered">';
																$idref=$filah['id_referencia'];
																$sqlr1="SELECT id_soporte_ref, fcargue, nom_soporte, soporte_referencia
													            FROM soporte_referencia
													            WHERE  id_referencia=$idref";
													            //echo $sqlr;
													            if ($tablar1=$bd1->sub_tuplas($sqlr1)){
													              foreach ($tablar1 as $filar1) {
													                echo'<tr>';
													                echo'<td>
													                      <p>'.$filar1['id_soporte_ref'].' - '.$filar1['nom_soporte'].' - '.$filar1['fcargue'].'
													                      <a href="'.$filar1['soporte_referencia'].'">
													                      <button type="button" class="btn btn-success">
													                      <span class="fa fa-file-pdf-o"></span> </button></a></p>
													                    </td>';
													                echo'</tr>';
													              }
													            }else {
													              echo'<tr>';
													              echo'<td>
													                    <p class="alert alert-danger"><span class="fa fa-warning fa-2x"></span> No hay soportes cargados al sistema</p>
													                  </td>';
													              echo'</tr>';
													            }
												 echo'</table></section></div>
												      <div class="modal-footer">
												        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												      </div>
												    </div>
												  </div>
												</div>';//fin del modal de detalle
												echo'<td>';
													echo'<p class="text-left"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDBITACORA&idref='.$idref.'&docc='.$filap['doc_pac'].'">
													<button type="button" class="btn btn-primary">
													<span class="fa fa-plus"></span> Adicionar Bitacora</button></a></p>';
												echo'</td>';
									}
									if ($filah['estado_referencia']==2) {//en caso de NO ACEPTADO
										echo'<section class="panel-body">
													<p><strong>ID: </strong> '.$filah['id_referencia'].'</p>
													<p><strong>Fecha: </strong>'.$filah['f_correo'].' <strong>Hora: </strong>'.$filah['h_correo'].'  <strong>Estado: </strong><strong class="alert alert-danger"> NO ACEPTADO</strong>
												 </section>';
										echo'<section class="panel-body">
													<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detalle_referencia"><span class="fa fa-list"></span> Ver Detalle</button></p>
		 										 </section>';
										echo'<section class="panel-body">
												 	<p class="text-left"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDPRESEN&idpac='.$filap["id_paciente"].'&docc='.$filap['doc_pac'].'">
												 <button type="button" class="btn btn-primary">
												 <span class="fa fa-plus"></span> Adicionar Presentación</button></a></p>
												 </section>';
												 echo'<div id="detalle_referencia" class="modal fade" role="dialog">
		 												  <div class="modal-dialog modal-lg">
		 												    <div class="modal-content">
		 												      <div class="modal-header">
		 												        <button type="button" class="close" data-dismiss="modal">&times;</button>
		 												        <h4 class="modal-title">Detalles de presentación hospitalaria</h4>
		 												      </div>
		 												      <div class="modal-body">
		 															<section class="panel-body">
		 																<table class="table table-bordered">
		 																	<tr>
		 																		<td class="alert alert-info ">
		 																		<h3>Solicitud de EPS</h3>
		 																		<p>'.$filah['cuerpo_referencia'].'</p>
		 																		</td>
		 																	</tr>
		 																</table>
		 															</section>
		 															<section class="panel-body">
		 																<table class="table table-bordered">
		 																<tr>
		 		 														 <td><h3>Soportes cargados</h3></td>
		 		 													 </tr>';
		 																$idref=$filah['id_referencia'];
		 																$sqlr1="SELECT id_soporte_ref, fcargue, nom_soporte, soporte_referencia
		 													            FROM soporte_referencia
		 													            WHERE  id_referencia=$idref";
		 													            //echo $sqlr;
		 													            if ($tablar1=$bd1->sub_tuplas($sqlr1)){
		 													              foreach ($tablar1 as $filar1) {
		 													                echo'<tr>';
		 													                echo'<td>
		 													                      <p>'.$filar1['id_soporte_ref'].' - '.$filar1['nom_soporte'].' - '.$filar1['fcargue'].'
		 													                      <a href="'.$filar1['soporte_referencia'].'">
		 													                      <button type="button" class="btn btn-success">
		 													                      <span class="fa fa-file-pdf-o"></span> </button></a></p>
		 													                    </td>';
		 													                echo'</tr>';
		 													              }
		 													            }else {
		 													              echo'<tr>';
		 													              echo'<td>
		 													                    <p class="alert alert-danger"><span class="fa fa-warning fa-2x"></span> No hay soportes cargados al sistema</p>
		 													                  </td>';
		 													              echo'</tr>';
		 													            }
		 												 echo'</table></section>';
		 												 //REspuesta del medico
		 												 echo'<section class="panel-body">
		 									         <table class="table table-bordered">
		 													 <tr>
		 														 <td><h3>Respuesta del Medico</h3></td>
		 													 </tr>';
		 									         		$idref=$filah['id_referencia'];
		 									       			$sqlr2="SELECT a.id_rta_referencia, resp_rta, f_rta, h_rta, respuesta,estado_rta,
		 									                      		 b.nombre
		 													             FROM rta_referencia a inner join user b on a.resp_rta=b.id_user
		 													             WHERE  id_referencia=$idref";
		 													             //echo $sqlr2;
		 													             if ($tablar2=$bd1->sub_tuplas($sqlr2)){
		 													               foreach ($tablar2 as $filar2) {
		 																					 if ($filar2['estado_rta']==3) {
		 																						 echo'<tr>';
		   													                 echo'<td class="alert alert-success">
		   													                       <p><strong class="text-success">Fecha rta:</strong> '.$filar2['f_rta'].' <strong class="text-success">Hora rta:</strong> '.$filar2['h_rta'].'</p>
		   													                       <p><strong>Respuesta en estado ACEPTADO:</strong> '.$filar2['respuesta'].'</p>
		   													                      </td>';
		   													                 echo'</tr>
		 																						 <tr class="info"></tr>';
		 																					 }
		 																					 if ($filar2['estado_rta']==2) {
		 																						 echo'<tr>';
		   													                 echo'<td class="alert alert-danger">
		   													                       <p><strong class="text-danger">Fecha rta:</strong> '.$filar2['f_rta'].' <strong class="text-danger">Hora rta:</strong> '.$filar2['h_rta'].'</p>
		   													                       <p><strong>Respuesta en estado NO ACEPTADO:</strong> '.$filar2['respuesta'].'</p>
		   													                      </td>';
		   													                 echo'</tr>
		 																						 <tr class="info"></tr>';
		 																					 }
		 																					 if ($filar2['estado_rta']==4) {
		 																						 echo'<tr>';
		   													                 echo'<td class="alert alert-warning">
		   													                       <p><strong class="text-warning">Fecha rta:</strong> '.$filar2['f_rta'].' <strong class="text-warning">Hora rta:</strong> '.$filar2['h_rta'].'</p>
		   													                       <p><strong>Respuesta en estado PENDIENTE:</strong> '.$filar2['respuesta'].'</p>
		   													                      </td>';
		   													                 echo'</tr>
		 																						 <tr class="info"></tr>';
		 																					 }

		 													               }
		 													             }
		 									  			echo'</table>
		 									     				</section>';
		 													echo'<section class="panel-body">
		 													      <table class="table table-bordered">
		 																<tr>
		 																	<td><h3>Apuntes de bitacora</h3></td>
		 																</tr>';
		 													      $idref=$filah['id_referencia'];
		 													    $sqlr3="SELECT a.id_bitacora_repsh, resp_bitacora, freg_bitacora, hreg_bitacora, bitacora,
		 													                   b.nombre
		 													          FROM bitacora_referencia_hosp a inner join user b on a.resp_bitacora=b.id_user
		 													          WHERE  id_referencia=$idref ORDER BY freg_bitacora ASC, hreg_bitacora ASC";
		 													          //echo $sqlr2;
		 													          $i=1;
		 													          if ($tablar3=$bd1->sub_tuplas($sqlr3)){
		 													            foreach ($tablar3 as $filar3) {
		 													              echo'<tr>';
		 													              echo'<td  class="alert alert-warning">
		 													                    <p class="lead"><strong class="text-success">#</strong>'.$i++.' - <strong class="text-warning">Fecha bitacora:</strong> '.$filar3['freg_bitacora'].'<strong class="text-warning">Hora bitacora:</strong>  '.$filar3['hreg_bitacora'].'</p>
		 													                    <p><strong>Bitacora:<br></strong> '.$filar3['bitacora'].'</p>
		 													                  </td>
		 													                  ';
		 													              echo'</tr>
		 													              <tr class="info"></tr>';
		 													            }
		 													          }
		 													echo'</table>
		 													</section>';

		 												echo'</div>
		 												      <div class="modal-footer">
		 												        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		 												      </div>
		 												    </div>
		 												  </div>
		 												</div>';//fin del modal de detalle

												echo'<td>';
													echo'<p class="text-left"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDBITACORA&idref='.$idref.'&docc='.$filap['doc_pac'].'">
													<button type="button" class="btn btn-primary">
													<span class="fa fa-plus"></span> Adicionar Bitacora</button></a></p>';
												echo'</td>';
									}

									if ($filah['estado_referencia']==3) {//en caso de ACEPTADO
										echo'<section class="panel-body">
													<p><strong>ID: </strong> '.$filah['id_referencia'].'</p>
													<p><strong>Fecha: </strong>'.$filah['f_correo'].' <strong>Hora: </strong>'.$filah['h_correo'].'  <strong>Estado: </strong><strong class="alert alert-success"> ACEPTADO</strong>
												 </section>';
										echo'<section class="panel-body">
													<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detalle_referencia"><span class="fa fa-list"></span> Ver Detalle</button> <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CANCELPRES&idpac='.$filap["id_paciente"].'&idr='.$filah["id_referencia"].'&docc='.$filap['doc_pac'].'">
													<button type="button" class="btn btn-danger">
													<span class="fa fa-times-circle"></span> Cancelar Presentación</button></a></p>
		 										 </section>';
										echo'<section class="panel-body">';
										$idref=$filah['id_referencia'];
										$sqlr="SELECT id_soporte_ref, fcargue, nom_soporte, soporte_referencia
													FROM soporte_referencia
													WHERE  id_referencia=$idref limit 1";
													//echo $sqlr;
													if ($tablar=$bd1->sub_tuplas($sqlr)){
														foreach ($tablar as $filar) {
															if ($filar['id_soporte_ref']=='') {
																echo'<p class="alert alert-danger fa fa-info-circle animated zoomIn"> Desea realizar cargue de soportes?
																<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SOPORTEREF&idr='.$idref.'&docc='.$filap['doc_pac'].'">
																<button type="button" class="btn btn-success">
																<span class="fa fa-upload"></span> </button></a></p>';
															}else {
																echo'<p class="alert alert-info fa fa-info-circle animated zoomIn"> Ya existen cargues. Desea seguir cargando?
																<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SOPORTEREF&idr='.$idref.'&docc='.$filap['doc_pac'].'">
																<button type="button" class="btn btn-success">
																<span class="fa fa-upload"></span> </button></a></p>';
															}
														}
													}else {
														echo'<p class="alert alert-danger fa fa-info-circle animated zoomIn"> No ha realizado ningun cargue, desea hacerlo?
														<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SOPORTEREF&idr='.$idref.'&docc='.$filap['doc_pac'].'">
														<button type="button" class="btn btn-success">
														<span class="fa fa-upload"></span> </button></a></p>';
													}
		 		 						echo'</section>';
										echo'<div id="detalle_referencia" class="modal fade" role="dialog">
												  <div class="modal-dialog modal-lg">
												    <div class="modal-content">
												      <div class="modal-header">
												        <button type="button" class="close" data-dismiss="modal">&times;</button>
												        <h4 class="modal-title">Detalles de presentación hospitalaria</h4>
												      </div>
												      <div class="modal-body">
															<section class="panel-body">
																<table class="table table-bordered">
																	<tr>
																		<td class="alert alert-info ">
																		<h3>Solicitud de EPS</h3>
																		<p>'.$filah['cuerpo_referencia'].'</p>
																		</td>
																	</tr>
																</table>
															</section>
															<section class="panel-body">
																<table class="table table-bordered">
																<tr>
		 														 <td><h3>Soportes cargados</h3></td>
		 													 </tr>';
																$idref=$filah['id_referencia'];
																$sqlr1="SELECT id_soporte_ref, fcargue, nom_soporte, soporte_referencia
													            FROM soporte_referencia
													            WHERE  id_referencia=$idref";
													            //echo $sqlr;
													            if ($tablar1=$bd1->sub_tuplas($sqlr1)){
													              foreach ($tablar1 as $filar1) {
													                echo'<tr>';
													                echo'<td>
													                      <p>'.$filar1['id_soporte_ref'].' - '.$filar1['nom_soporte'].'
													                      <a href="'.$filar1['soporte_referencia'].'">
													                      <button type="button" class="btn btn-success">
													                      <span class="fa fa-file-pdf-o"></span> </button></a></p>
													                    </td>';
													                echo'</tr>';
													              }
													            }else {
													              echo'<tr>';
													              echo'<td>
													                    <p class="alert alert-danger"><span class="fa fa-warning fa-2x"></span> No hay soportes cargados al sistema</p>
													                  </td>';
													              echo'</tr>';
													            }
												 echo'</table></section>';
												 //REspuesta del medico
												 echo'<section class="panel-body">
									         <table class="table table-bordered">
													 <tr>
														 <td><h3>Respuesta del Medico</h3></td>
													 </tr>';
									         		$idref=$filah['id_referencia'];
									       			$sqlr2="SELECT a.id_rta_referencia, resp_rta, f_rta, h_rta, respuesta,estado_rta,
									                      		 b.nombre
													             FROM rta_referencia a inner join user b on a.resp_rta=b.id_user
													             WHERE  id_referencia=$idref";
													             //echo $sqlr2;
													             if ($tablar2=$bd1->sub_tuplas($sqlr2)){
													               foreach ($tablar2 as $filar2) {
																					 if ($filar2['estado_rta']==3) {
																						 echo'<tr>';
  													                 echo'<td class="alert alert-success">
  													                       <p><strong class="text-success">Fecha rta:</strong> '.$filar2['f_rta'].' <strong class="text-success">Hora rta:</strong> '.$filar2['h_rta'].'</p>
  													                       <p><strong>Respuesta en estado ACEPTADO:</strong> '.$filar2['respuesta'].'</p>
  													                      </td>';
  													                 echo'</tr>
																						 <tr class="info"></tr>';
																					 }
																					 if ($filar2['estado_rta']==2) {
																						 echo'<tr>';
  													                 echo'<td class="alert alert-danger">
  													                       <p><strong class="text-danger">Fecha rta:</strong> '.$filar2['f_rta'].' <strong class="text-danger">Hora rta:</strong> '.$filar2['h_rta'].'</p>
  													                       <p><strong>Respuesta en estado NO ACEPTADO:</strong> '.$filar2['respuesta'].'</p>
  													                      </td>';
  													                 echo'</tr>
																						 <tr class="info"></tr>';
																					 }
																					 if ($filar2['estado_rta']==4) {
																						 echo'<tr>';
  													                 echo'<td class="alert alert-warning">
  													                       <p><strong class="text-warning">Fecha rta:</strong> '.$filar2['f_rta'].' <strong class="text-warning">Hora rta:</strong> '.$filar2['h_rta'].'</p>
  													                       <p><strong>Respuesta en estado PENDIENTE:</strong> '.$filar2['respuesta'].'</p>
  													                      </td>';
  													                 echo'</tr>
																						 <tr class="info"></tr>';
																					 }

													               }
													             }
									  			echo'</table>
									     				</section>';
													echo'<section class="panel-body">
													      <table class="table table-bordered">
																<tr>
																	<td><h3>Apuntes de bitacora</h3></td>
																</tr>';
													      $idref=$filah['id_referencia'];
													    $sqlr3="SELECT a.id_bitacora_repsh, resp_bitacora, freg_bitacora, hreg_bitacora, bitacora,
													                   b.nombre
													          FROM bitacora_referencia_hosp a inner join user b on a.resp_bitacora=b.id_user
													          WHERE  id_referencia=$idref ORDER BY freg_bitacora ASC, hreg_bitacora ASC";
													          //echo $sqlr2;
													          $i=1;
													          if ($tablar3=$bd1->sub_tuplas($sqlr3)){
													            foreach ($tablar3 as $filar3) {
													              echo'<tr>';
													              echo'<td  class="alert alert-warning">
													                    <p class="lead"><strong class="text-success">#</strong>'.$i++.' - <strong class="text-warning">Fecha bitacora:</strong> '.$filar3['freg_bitacora'].'<strong class="text-warning">Hora bitacora:</strong>  '.$filar3['hreg_bitacora'].'</p>
													                    <p><strong>Bitacora:<br></strong> '.$filar3['bitacora'].'</p>
													                  </td>
													                  ';
													              echo'</tr>
													              <tr class="info"></tr>';
													            }
													          }
													echo'</table>
													</section>';

												echo'</div>
												      <div class="modal-footer">
												        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
												      </div>
												    </div>
												  </div>
												</div>';//fin del modal de detalle

												echo'<td>';
													echo'<p class="text-left"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDBITACORA&idref='.$idref.'&docc='.$filap['doc_pac'].'">
													<button type="button" class="btn btn-primary">
													<span class="fa fa-plus"></span> Adicionar Bitacora</button></a></p>';
												echo'</td>';
									}

									if ($filah['estado_referencia']==4) {//en caso de ACEPTADO
										echo'<section class="panel-body">
													<p><strong>ID: </strong> '.$filah['id_referencia'].'</p>
													<p><strong>Fecha: </strong>'.$filah['f_correo'].' <strong>Hora: </strong>'.$filah['h_correo'].'  <strong>Estado: </strong><strong class="alert alert-warning"> PENDIENTE</strong>
												 </section>';
										echo'<section class="panel-body">
													<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detalle_referencia"><span class="fa fa-list"></span> Ver Detalle</button> <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CANCELPRES&idpac='.$filap["id_paciente"].'&idr='.$filah["id_referencia"].'&docc='.$filap['doc_pac'].'">
													<button type="button" class="btn btn-danger">
													<span class="fa fa-times-circle"></span> Cancelar Presentación</button></a></p>
												 </section>';
										echo'<section class="panel-body">';
										$idref=$filah['id_referencia'];
										$sqlr="SELECT id_soporte_ref, fcargue, nom_soporte, soporte_referencia
													FROM soporte_referencia
													WHERE  id_referencia=$idref limit 1";
													//echo $sqlr;
													if ($tablar=$bd1->sub_tuplas($sqlr)){
														foreach ($tablar as $filar) {
															if ($filar['id_soporte_ref']=='') {
																echo'<p class="alert alert-danger fa fa-info-circle animated zoomIn"> Desea realizar cargue de soportes?
																<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SOPORTEREF&idr='.$idref.'&docc='.$filap['doc_pac'].'">
																<button type="button" class="btn btn-success">
																<span class="fa fa-upload"></span> </button></a></p>';
															}else {
																echo'<p class="alert alert-info fa fa-info-circle animated zoomIn"> Ya existen cargues. Desea seguir cargando?
																<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SOPORTEREF&idr='.$idref.'&docc='.$filap['doc_pac'].'">
																<button type="button" class="btn btn-success">
																<span class="fa fa-upload"></span> </button></a></p>';
															}
														}
													}else {
														echo'<p class="alert alert-danger fa fa-info-circle animated zoomIn"> No ha realizado ningun cargue, desea hacerlo?
														<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SOPORTEREF&idr='.$idref.'&docc='.$filap['doc_pac'].'">
														<button type="button" class="btn btn-success">
														<span class="fa fa-upload"></span> </button></a></p>';
													}
										echo'</section>';
										echo'<div id="detalle_referencia" class="modal fade" role="dialog">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title">Detalles de presentación hospitalaria</h4>
															</div>
															<div class="modal-body">
															<section class="panel-body">
																<table class="table table-bordered">
																	<tr>
																		<td class="alert alert-info ">
																		<h3>Solicitud de EPS</h3>
																		<p>'.$filah['cuerpo_referencia'].'</p>
																		</td>
																	</tr>
																</table>
															</section>
															<section class="panel-body">
																<table class="table table-bordered">
																<tr>
																 <td><h3>Soportes cargados</h3></td>
															 </tr>';
																$idref=$filah['id_referencia'];
																$sqlr1="SELECT id_soporte_ref, fcargue, nom_soporte, soporte_referencia
																			FROM soporte_referencia
																			WHERE  id_referencia=$idref";
																			//echo $sqlr;
																			if ($tablar1=$bd1->sub_tuplas($sqlr1)){
																				foreach ($tablar1 as $filar1) {
																					echo'<tr>';
																					echo'<td>
																								<p>'.$filar1['id_soporte_ref'].' - '.$filar1['nom_soporte'].' - '.$filar1['fcargue'].'
																								<a href="'.$filar1['soporte_referencia'].'">
																								<button type="button" class="btn btn-success">
																								<span class="fa fa-file-pdf-o"></span> </button></a></p>
																							</td>';
																					echo'</tr>';
																				}
																			}else {
																				echo'<tr>';
																				echo'<td>
																							<p class="alert alert-danger"><span class="fa fa-warning fa-2x"></span> No hay soportes cargados al sistema</p>
																						</td>';
																				echo'</tr>';
																			}
												 echo'</table></section>';
												 //REspuesta del medico
												 echo'<section class="panel-body">
													 <table class="table table-bordered">
													 <tr>
														 <td><h3>Respuesta del Medico</h3></td>
													 </tr>';
															$idref=$filah['id_referencia'];
															$sqlr2="SELECT a.id_rta_referencia, resp_rta, f_rta, h_rta, respuesta,estado_rta,
																						 b.nombre
																			 FROM rta_referencia a inner join user b on a.resp_rta=b.id_user
																			 WHERE  id_referencia=$idref";
																			 //echo $sqlr2;
																			 if ($tablar2=$bd1->sub_tuplas($sqlr2)){
																				 foreach ($tablar2 as $filar2) {
																					 if ($filar2['estado_rta']==3) {
																						 echo'<tr>';
																						 echo'<td class="alert alert-success">
																									 <p><strong class="text-success">Fecha rta:</strong> '.$filar2['f_rta'].' <strong class="text-success">Hora rta:</strong> '.$filar2['h_rta'].'</p>
																									 <p><strong>Respuesta en estado ACEPTADO:</strong> '.$filar2['respuesta'].'</p>
																									</td>';
																						 echo'</tr>
																						 <tr class="info"></tr>';
																					 }
																					 if ($filar2['estado_rta']==2) {
																						 echo'<tr>';
																						 echo'<td class="alert alert-danger">
																									 <p><strong class="text-danger">Fecha rta:</strong> '.$filar2['f_rta'].' <strong class="text-danger">Hora rta:</strong> '.$filar2['h_rta'].'</p>
																									 <p><strong>Respuesta en estado NO ACEPTADO:</strong> '.$filar2['respuesta'].'</p>
																									</td>';
																						 echo'</tr>
																						 <tr class="info"></tr>';
																					 }
																					 if ($filar2['estado_rta']==4) {
																						 echo'<tr>';
																						 echo'<td class="alert alert-warning">
																									 <p><strong class="text-warning">Fecha rta:</strong> '.$filar2['f_rta'].' <strong class="text-warning">Hora rta:</strong> '.$filar2['h_rta'].'</p>
																									 <p><strong>Respuesta en estado PENDIENTE:</strong> '.$filar2['respuesta'].'</p>
																									</td>';
																						 echo'</tr>
																						 <tr class="info"></tr>';
																					 }

																				 }
																			 }
													echo'</table>
															</section>';
													echo'<section class="panel-body">
																<table class="table table-bordered">
																<tr>
																	<td><h3>Apuntes de bitacora</h3></td>
																</tr>';
																$idref=$filah['id_referencia'];
															$sqlr3="SELECT a.id_bitacora_repsh, resp_bitacora, freg_bitacora, hreg_bitacora, bitacora,
																						 b.nombre
																		FROM bitacora_referencia_hosp a inner join user b on a.resp_bitacora=b.id_user
																		WHERE  id_referencia=$idref ORDER BY freg_bitacora ASC, hreg_bitacora ASC";
																		//echo $sqlr2;
																		$i=1;
																		if ($tablar3=$bd1->sub_tuplas($sqlr3)){
																			foreach ($tablar3 as $filar3) {
																				echo'<tr>';
																				echo'<td  class="alert alert-warning">
																							<p class="lead"><strong class="text-success">#</strong>'.$i++.' - <strong class="text-warning">Fecha bitacora:</strong> '.$filar3['freg_bitacora'].'<strong class="text-warning">Hora bitacora:</strong>  '.$filar3['hreg_bitacora'].'</p>
																							<p><strong>Bitacora:<br></strong> '.$filar3['bitacora'].'</p>
																						</td>
																						';
																				echo'</tr>
																				<tr class="info"></tr>';
																			}
																		}
													echo'</table>
													</section>';

												echo'</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
															</div>
														</div>
													</div>
												</div>';//fin del modal de detalle
												echo'<td>';
													echo'<p class="text-left"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDBITACORA&idref='.$idref.'&docc='.$filap['doc_pac'].'">
													<button type="button" class="btn btn-primary">
													<span class="fa fa-plus"></span> Adicionar Bitacora</button></a></p>';
												echo'</td>';
									}

									if ($filah['estado_referencia']=='') {//en caso de NULL en consulta
										echo'<p class="text-left"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDPRESEN&idpac='.$filap["id_paciente"].'&docc='.$filap['doc_pac'].'">
									  <button type="button" class="btn btn-primary">
									  <span class="fa fa-plus"></span> Adicionar Presentación</button></a></p>';
									}
									if ($filah['estado_referencia']=='5') {//en caso de NULL en consulta
										echo'<p class="text-left"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDPRESEN&idpac='.$filap["id_paciente"].'&docc='.$filap['doc_pac'].'">
									  <button type="button" class="btn btn-primary">
									  <span class="fa fa-plus"></span> Adicionar Presentación</button></a></p>';
									}
									if ($filah['estado_referencia']=='6') {//en caso de NULL en consulta
										echo'<p class="text-left"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDPRESEN&idpac='.$filap["id_paciente"].'&docc='.$filap['doc_pac'].'">
									  <button type="button" class="btn btn-primary">
									  <span class="fa fa-plus"></span> Adicionar Presentación</button></a></p>';
									}
							  }
							}else {
								echo'<p class="text-left"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDPRESEN&idpac='.$filap["id_paciente"].'&docc='.$filap['doc_pac'].'">
								<button type="button" class="btn btn-primary">
								<span class="fa fa-plus"></span> Adicionar Presentación</button></a></p>';
							}
						}
						echo '</td>';
            echo'</tr>';
          }
        }else {
        	echo'<p class="alert alert-danger"><span class="fa fa-info-circle fa-2x"></span> No existe paciente en base de datos <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CREARPACIENTE&idpac='.$filap["id_paciente"].'&docc='.$filap['doc_pac'].'">
							 <button type="button" class="btn btn-primary" >
							 <span class="fa fa-plus-circle"></span> Crear Paciente</button></a></p>';
        }
      }

      ?>
    </table>
  </section>
</section>
	<?php
}
?>
