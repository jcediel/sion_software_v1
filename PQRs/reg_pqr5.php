<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["soporte_pqr"])){
				if (is_uploaded_file($_FILES["soporte_pqr"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["soporte_pqr"]["name"]);
					$archivo=$_POST["idpac"].'_soporte_'.$_POST["fradicado"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["soporte_pqr"]["tmp_name"],PQ.PQRS.$archivo)){
						$fotoE=",soporte_pqr='".PQRS.$archivo."'";
						$fotoA1=",soporte_pqr";
						$fotoA2=",'".PQRS.$archivo."'";
						}
				}
			}
			switch ($_POST["operacion"]) {
			case 'A':

			$sede=$_POST['sede'];
			$eps=$_POST['eps'];
			$servicio=$_POST['linea_negocio'];

			if ($sede==1 && $servicio==3) { //correo para alexandra garcia
				include "PHPmailer/class.phpmailer.php";
				include "PHPmailer/class.smtp.php";
				$sede=$_POST['id_sedes_ips'];
				$eps=$_POST['id_sedes_ips'];
				$servicio=$_POST['linea_negocio'];
				$radeps=$_POST['radicado_eps'];

				$email_user = "pqrs@emmanuelips.co";
				$email_password = "Emmanuel_12345";
				$the_subject = 'PQRS : '.$_POST['nompac'];
				$address_to = 'coordinacioncientifica@emmanuelips.co';
				$address_t1 = 'atencionalusuario@emmanuelips.co';

				$from_name = "Emmanuel IPS solicita una respuesta a esta PQRS ";
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
				$phpmailer->AddAddress($address_t1);
				$phpmailer->AddAddress($address_t2);
				$phpmailer->AddAddress($address_t3);
				$phpmailer->AddAddress($address_t4);
				$phpmailer->AddAddress($address_t5); // recipients email
				$phpmailer->Subject = $the_subject;
				$phpmailer->Body .= utf8_decode("<p class='text-left'>
																				  <strong>SION software le informa que tiene PQRS por contestar, acceda inmediatamente para realizar gestión.</strong>
																				 </p>
																				 <p>Gracias por su colaboración</p>
														 ");
				$phpmailer->Body .= utf8_decode("<a href='www.sionsoftware.com'>Ir a SION</a>");
				$phpmailer->IsHTML(true);
				$phpmailer->Send();

				$sql="INSERT INTO pqr (id_user_reg, id_sedes_ips, id_eps, id_paciente, linea_negocio, medio_registro, tipo_cliente, tipo_solicitud,causa,
															 fecha_radicado, hora_radicado,radicado_eps, contacto_cliente,email_rta, email_rta1, email_rta2, email_rta3, descripcion_pqrs, responsable_rta_pqrs, clasificacion,estado_pqrs$fotoA1)
						  VALUES ('".$_SESSION["AUT"]["id_user"]."','".$_POST["sede"]."','".$_POST["eps"]."','".$_POST["idpac"]."','".$_POST["linea_negocio"]."',
								'".$_POST["medio_registro"]."','".$_POST["tipo_cliente"]."','".$_POST["tipo_solicitud"]."','".$_POST["causa"]."','".$_POST["fecha_radicado"]."',
								'".$_POST["hora_radicado"]."','".$_POST["radicado_eps"]."','".$_POST["contacto_cliente"]."','".$_POST["email_rta"]."', '".$_POST["email_rta1"]."', '".$_POST["email_rta2"]."',
								'".$_POST["email_rta3"]."','".$_POST["descripcion_pqrs"]."','292','".$_POST["clasificacion"]."','1'$fotoA2)";
					$subtitulo="La PQRS fue ";
					$subtitulo1="Adicionada";
			}

			if ($sede==1 && $servicio==5) {
				include "PHPmailer/class.phpmailer.php";
				include "PHPmailer/class.smtp.php";
				$sede=$_POST['id_sedes_ips'];
				$eps=$_POST['id_sedes_ips'];
				$servicio=$_POST['linea_negocio'];
				$radeps=$_POST['radicado_eps'];

				$email_user = "pqrs@emmanuelips.co";
				$email_password = "Emmanuel_12345";
				$the_subject = 'PQRS : '.$_POST['nompac'];
				$address_to = 'coordinacioncientifica@emmanuelips.co';
				$address_t1 = 'atencionalusuario@emmanuelips.co';

				$from_name = "Emmanuel IPS solicita una respuesta a esta PQRS ";
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
				$phpmailer->AddAddress($address_t1);
				$phpmailer->AddAddress($address_t2);
				$phpmailer->AddAddress($address_t3);
				$phpmailer->AddAddress($address_t4);
				$phpmailer->AddAddress($address_t5); // recipients email
				$phpmailer->Subject = $the_subject;
				$phpmailer->Body .= utf8_decode("<p class='text-left'>
																				  <strong>SION software le informa que tiene PQRS por contestar, acceda inmediatamente para realizar gestión.</strong>
																				 </p>
																				 <p>Gracias por su colaboración</p>
														 ");
				$phpmailer->Body .= utf8_decode("<a href='www.sionsoftware.com'>Ir a SION</a>");
				$phpmailer->IsHTML(true);
				$phpmailer->Send();

				$sql="INSERT INTO pqr (id_user_reg, id_sedes_ips, id_eps, id_paciente, linea_negocio, medio_registro, tipo_cliente, tipo_solicitud,causa,
															 fecha_radicado, hora_radicado,radicado_eps, contacto_cliente,email_rta, email_rta1, email_rta2, email_rta3, descripcion_pqrs, responsable_rta_pqrs, clasificacion,estado_pqrs$fotoA1)
						  VALUES ('".$_SESSION["AUT"]["id_user"]."','".$_POST["sede"]."','".$_POST["eps"]."','".$_POST["idpac"]."','".$_POST["linea_negocio"]."',
								'".$_POST["medio_registro"]."','".$_POST["tipo_cliente"]."','".$_POST["tipo_solicitud"]."','".$_POST["causa"]."','".$_POST["fecha_radicado"]."',
								'".$_POST["hora_radicado"]."','".$_POST["radicado_eps"]."','".$_POST["contacto_cliente"]."','".$_POST["email_rta"]."', '".$_POST["email_rta1"]."', '".$_POST["email_rta2"]."',
								'".$_POST["email_rta3"]."','".$_POST["descripcion_pqrs"]."','292','".$_POST["clasificacion"]."','1'$fotoA2)";
					$subtitulo="La PQRS fue ";
					$subtitulo1="Adicionada";
			}
			if ($sede==1 && $servicio==7) {
				include "PHPmailer/class.phpmailer.php";
				include "PHPmailer/class.smtp.php";
				$sede=$_POST['id_sedes_ips'];
				$eps=$_POST['id_sedes_ips'];
				$servicio=$_POST['linea_negocio'];
				$radeps=$_POST['radicado_eps'];

				$email_user = "pqrs@emmanuelips.co";
				$email_password = "Emmanuel_12345";
				$the_subject = 'PQRS : '.$_POST['nompac'];
				$address_to = 'coordinacioncientifica@emmanuelips.co';
				$address_t1 = 'atencionalusuario@emmanuelips.co';

				$from_name = "Emmanuel IPS solicita una respuesta a esta PQRS ";
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
				$phpmailer->AddAddress($address_t1);
				$phpmailer->AddAddress($address_t2);
				$phpmailer->AddAddress($address_t3);
				$phpmailer->AddAddress($address_t4);
				$phpmailer->AddAddress($address_t5); // recipients email
				$phpmailer->Subject = $the_subject;
				$phpmailer->Body .= utf8_decode("<p class='text-left'>
																				  <strong>SION software le informa que tiene PQRS por contestar, acceda inmediatamente para realizar gestión.</strong>
																				 </p>
																				 <p>Gracias por su colaboración</p>
														 ");
				$phpmailer->Body .= utf8_decode("<a href='www.sionsoftware.com'>Ir a SION</a>");
				$phpmailer->IsHTML(true);
				$phpmailer->Send();

				$sql="INSERT INTO pqr (id_user_reg, id_sedes_ips, id_eps, id_paciente, linea_negocio, medio_registro, tipo_cliente, tipo_solicitud,causa,
															 fecha_radicado, hora_radicado,radicado_eps, contacto_cliente,email_rta, email_rta1, email_rta2, email_rta3, descripcion_pqrs, responsable_rta_pqrs, clasificacion,estado_pqrs$fotoA1)
						  VALUES ('".$_SESSION["AUT"]["id_user"]."','".$_POST["sede"]."','".$_POST["eps"]."','".$_POST["idpac"]."','".$_POST["linea_negocio"]."',
								'".$_POST["medio_registro"]."','".$_POST["tipo_cliente"]."','".$_POST["tipo_solicitud"]."','".$_POST["causa"]."','".$_POST["fecha_radicado"]."',
								'".$_POST["hora_radicado"]."','".$_POST["radicado_eps"]."','".$_POST["contacto_cliente"]."','".$_POST["email_rta"]."', '".$_POST["email_rta1"]."', '".$_POST["email_rta2"]."',
								'".$_POST["email_rta3"]."','".$_POST["descripcion_pqrs"]."','292','".$_POST["clasificacion"]."','1'$fotoA2)";
					$subtitulo="La PQRS fue ";
					$subtitulo1="Adicionada";
			}


			if ($sede==3 && $servicio==3) {// para keily rodriguez
				include "PHPmailer/class.phpmailer.php";
				include "PHPmailer/class.smtp.php";
				$sede=$_POST['id_sedes_ips'];
				$eps=$_POST['id_sedes_ips'];
				$servicio=$_POST['linea_negocio'];
				$radeps=$_POST['radicado_eps'];

				$email_user = "pqrs@emmanuelips.co";
				$email_password = "Emmanuel_12345";
				$the_subject = 'PQRS : '.$_POST['nompac'];
				$address_to = 'coordinacioncientifica@emmanuelips.co';
				$address_t1 = 'atencionalusuario@emmanuelips.co';

				$from_name = "Emmanuel IPS solicita una respuesta a esta PQRS ";
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
				$phpmailer->AddAddress($address_t1);
				$phpmailer->AddAddress($address_t2);
				$phpmailer->AddAddress($address_t3);
				$phpmailer->AddAddress($address_t4);
				$phpmailer->AddAddress($address_t5); // recipients email
				$phpmailer->Subject = $the_subject;
				$phpmailer->Body .= utf8_decode("<p class='text-left'>
																				  <strong>SION software le informa que tiene PQRS por contestar, acceda inmediatamente para realizar gestión.</strong>
																				 </p>
																				 <p>Gracias por su colaboración</p>
														 ");
				$phpmailer->Body .= utf8_decode("<a href='www.sionsoftware.com'>Ir a SION</a>");
				$phpmailer->IsHTML(true);
				$phpmailer->Send();

				$sql="INSERT INTO pqr (id_user_reg, id_sedes_ips, id_eps, id_paciente, linea_negocio, medio_registro, tipo_cliente, tipo_solicitud,causa,
															 fecha_radicado, hora_radicado,radicado_eps, contacto_cliente,email_rta, email_rta1, email_rta2, email_rta3, descripcion_pqrs, responsable_rta_pqrs, clasificacion,estado_pqrs$fotoA1)
						  VALUES ('".$_SESSION["AUT"]["id_user"]."','".$_POST["sede"]."','".$_POST["eps"]."','".$_POST["idpac"]."','".$_POST["linea_negocio"]."',
								'".$_POST["medio_registro"]."','".$_POST["tipo_cliente"]."','".$_POST["tipo_solicitud"]."','".$_POST["causa"]."','".$_POST["fecha_radicado"]."',
								'".$_POST["hora_radicado"]."','".$_POST["radicado_eps"]."','".$_POST["contacto_cliente"]."','".$_POST["email_rta"]."', '".$_POST["email_rta1"]."', '".$_POST["email_rta2"]."',
								'".$_POST["email_rta3"]."','".$_POST["descripcion_pqrs"]."','1063','".$_POST["clasificacion"]."','1'$fotoA2)";
					$subtitulo="La PQRS fue ";
					$subtitulo1="Adicionada";
			}

			if ($servicio==14) {
				include "PHPmailer/class.phpmailer.php";
				include "PHPmailer/class.smtp.php";
				$sede=$_POST['id_sedes_ips'];
				$eps=$_POST['id_sedes_ips'];
				$servicio=$_POST['linea_negocio'];
				$radeps=$_POST['radicado_eps'];

				$email_user = "pqrs@emmanuelips.co";
				$email_password = "Emmanuel_12345";
				$the_subject = 'PQRS : '.$_POST['nompac'];
				$address_to = 'coordinaciondom@emmanuelips.co';
				$address_t1 = 'atencionalusuario@emmanuelips.co';

				$from_name = "Emmanuel IPS solicita una respuesta a esta PQRS ";
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
				$phpmailer->AddAddress($address_t1);
				$phpmailer->AddAddress($address_t2);
				$phpmailer->AddAddress($address_t3);
				$phpmailer->AddAddress($address_t4);
				$phpmailer->AddAddress($address_t5); // recipients email
				$phpmailer->Subject = $the_subject;
				$phpmailer->Body .= utf8_decode("<p class='text-left'>
																				  <strong>SION software le informa que tiene PQRS por contestar, acceda inmediatamente para realizar gestión.</strong>
																				 </p>
																				 <p>Gracias por su colaboración</p>
														 ");
				$phpmailer->Body .= utf8_decode("<a href='www.sionsoftware.com'>Ir a SION</a>");
				$phpmailer->IsHTML(true);
				$phpmailer->Send();

				$sql="INSERT INTO pqr (id_user_reg, id_sedes_ips, id_eps, id_paciente, linea_negocio, medio_registro, tipo_cliente, tipo_solicitud,causa,
															 fecha_radicado, hora_radicado,radicado_eps, contacto_cliente,email_rta, email_rta1, email_rta2, email_rta3, descripcion_pqrs, responsable_rta_pqrs, clasificacion,estado_pqrs$fotoA1)
						  VALUES ('".$_SESSION["AUT"]["id_user"]."','".$_POST["sede"]."','".$_POST["eps"]."','".$_POST["idpac"]."','".$_POST["linea_negocio"]."',
								'".$_POST["medio_registro"]."','".$_POST["tipo_cliente"]."','".$_POST["tipo_solicitud"]."','".$_POST["causa"]."','".$_POST["fecha_radicado"]."',
								'".$_POST["hora_radicado"]."','".$_POST["radicado_eps"]."','".$_POST["contacto_cliente"]."','".$_POST["email_rta"]."', '".$_POST["email_rta1"]."', '".$_POST["email_rta2"]."',
								'".$_POST["email_rta3"]."','".$_POST["descripcion_pqrs"]."','2151','".$_POST["clasificacion"]."','1'$fotoA2)";
					$subtitulo="La PQRS fue ";
					$subtitulo1="Adicionada";
			}
			if ($servicio==15) {
				include "PHPmailer/class.phpmailer.php";
				include "PHPmailer/class.smtp.php";
				$sede=$_POST['id_sedes_ips'];
				$eps=$_POST['id_sedes_ips'];
				$servicio=$_POST['linea_negocio'];
				$radeps=$_POST['radicado_eps'];

				$email_user = "pqrs@emmanuelips.co";
				$email_password = "Emmanuel_12345";
				$the_subject = 'PQRS : '.$_POST['nompac'];
				$address_to = 'terapiasdom@emmanuelips.co';
				$address_t1 = 'atencionalusuario@emmanuelips.co';


				$from_name = "Emmanuel IPS solicita una respuesta a esta PQRS ";
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
				$phpmailer->AddAddress($address_t1);
				$phpmailer->AddAddress($address_t2);
				$phpmailer->AddAddress($address_t3);
				$phpmailer->AddAddress($address_t4);
				$phpmailer->AddAddress($address_t5); // recipients email
				$phpmailer->Subject = $the_subject;
				$phpmailer->Body .= utf8_decode("<p class='text-left'>
																					<strong>SION software le informa que tiene PQRS por contestar, acceda inmediatamente para realizar gestión.</strong>
																				 </p>
																				 <p>Gracias por su colaboración</p>
														 ");
				$phpmailer->Body .= utf8_decode("<a href='www.sionsoftware.com'>Ir a SION</a>");
				$phpmailer->IsHTML(true);
				$phpmailer->Send();

				$sql="INSERT INTO pqr (id_user_reg, id_sedes_ips, id_eps, id_paciente, linea_negocio, medio_registro, tipo_cliente, tipo_solicitud,causa,
															 fecha_radicado, hora_radicado,radicado_eps, contacto_cliente,email_rta, email_rta1, email_rta2, email_rta3, descripcion_pqrs, responsable_rta_pqrs, clasificacion,estado_pqrs$fotoA1)
						  VALUES ('".$_SESSION["AUT"]["id_user"]."','".$_POST["sede"]."','".$_POST["eps"]."','".$_POST["idpac"]."','".$_POST["linea_negocio"]."',
								'".$_POST["medio_registro"]."','".$_POST["tipo_cliente"]."','".$_POST["tipo_solicitud"]."','".$_POST["causa"]."','".$_POST["fecha_radicado"]."',
								'".$_POST["hora_radicado"]."','".$_POST["radicado_eps"]."','".$_POST["contacto_cliente"]."','".$_POST["email_rta"]."', '".$_POST["email_rta1"]."', '".$_POST["email_rta2"]."',
								'".$_POST["email_rta3"]."','".$_POST["descripcion_pqrs"]."','125','".$_POST["clasificacion"]."','1'$fotoA2)";
					$subtitulo="La PQRS fue ";
					$subtitulo1="Adicionada";
			}
			if ($eps==13 && $servicio==15) {
				include "PHPmailer/class.phpmailer.php";
				include "PHPmailer/class.smtp.php";
				$sede=$_POST['id_sedes_ips'];
				$eps=$_POST['id_sedes_ips'];
				$servicio=$_POST['linea_negocio'];
				$radeps=$_POST['radicado_eps'];

				$email_user = "pqrs@emmanuelips.co";
				$email_password = "Emmanuel_12345";
				$the_subject = 'PQRS : '.$_POST['nompac'];
				$address_to = 'terapiasdomsanitas@emmanuelips.co';
				$address_t1 = 'atencionalusuario@emmanuelips.co';

				$from_name = "Emmanuel IPS solicita una respuesta a esta PQRS ";
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
				$phpmailer->AddAddress($address_t1);
				$phpmailer->AddAddress($address_t2);
				$phpmailer->AddAddress($address_t3);
				$phpmailer->AddAddress($address_t4);
				$phpmailer->AddAddress($address_t5); // recipients email
				$phpmailer->Subject = $the_subject;
				$phpmailer->Body .= utf8_decode("<p class='text-left'>
																					<strong>SION software le informa que tiene PQRS por contestar, acceda inmediatamente para realizar gestión.</strong>
																				 </p>
																				 <p>Gracias por su colaboración</p>
														 ");
				$phpmailer->Body .= utf8_decode("<a href='www.sionsoftware.com'>Ir a SION</a>");
				$phpmailer->IsHTML(true);
				$phpmailer->Send();

				$sql="INSERT INTO pqr (id_user_reg, id_sedes_ips, id_eps, id_paciente, linea_negocio, medio_registro, tipo_cliente, tipo_solicitud,causa,
															 fecha_radicado, hora_radicado,radicado_eps, contacto_cliente,email_rta, email_rta1, email_rta2, email_rta3, descripcion_pqrs, responsable_rta_pqrs, clasificacion,estado_pqrs$fotoA1)
						  VALUES ('".$_SESSION["AUT"]["id_user"]."','".$_POST["sede"]."','".$_POST["eps"]."','".$_POST["idpac"]."','".$_POST["linea_negocio"]."',
								'".$_POST["medio_registro"]."','".$_POST["tipo_cliente"]."','".$_POST["tipo_solicitud"]."','".$_POST["causa"]."','".$_POST["fecha_radicado"]."',
								'".$_POST["hora_radicado"]."','".$_POST["radicado_eps"]."','".$_POST["contacto_cliente"]."','".$_POST["email_rta"]."', '".$_POST["email_rta1"]."', '".$_POST["email_rta2"]."',
								'".$_POST["email_rta3"]."','".$_POST["descripcion_pqrs"]."','293','".$_POST["clasificacion"]."','1'$fotoA2)";
					$subtitulo="La PQRS fue ";
					$subtitulo1="Adicionada";
			}
			if ($eps==13 && $servicio==14) {
				include "PHPmailer/class.phpmailer.php";
				include "PHPmailer/class.smtp.php";
				$sede=$_POST['id_sedes_ips'];
				$eps=$_POST['id_sedes_ips'];
				$servicio=$_POST['linea_negocio'];
				$radeps=$_POST['radicado_eps'];

				$email_user = "pqrs@emmanuelips.co";
				$email_password = "Emmanuel_12345";
				$the_subject = 'PQRS : '.$_POST['nompac'];
				$address_to = 'terapiasdomsanitas@emmanuelips.co';
				$address_t1 = 'atencionalusuario@emmanuelips.co';

				$from_name = "Emmanuel IPS solicita una respuesta a esta PQRS ";
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
				$phpmailer->AddAddress($address_t1);
				$phpmailer->AddAddress($address_t2);
				$phpmailer->AddAddress($address_t3);
				$phpmailer->AddAddress($address_t4);
				$phpmailer->AddAddress($address_t5); // recipients email
				$phpmailer->Subject = $the_subject;
				$phpmailer->Body .= utf8_decode("<p class='text-left'>
																					<strong>SION software le informa que tiene PQRS por contestar, acceda inmediatamente para realizar gestión.</strong>
																				 </p>
																				 <p>Gracias por su colaboración</p>
														 ");
				$phpmailer->Body .= utf8_decode("<a href='www.sionsoftware.com'>Ir a SION</a>");
				$phpmailer->IsHTML(true);
				$phpmailer->Send();

				$sql="INSERT INTO pqr (id_user_reg, id_sedes_ips, id_eps, id_paciente, linea_negocio, medio_registro, tipo_cliente, tipo_solicitud,causa,
															 fecha_radicado, hora_radicado,radicado_eps, contacto_cliente,email_rta, email_rta1, email_rta2, email_rta3, descripcion_pqrs, responsable_rta_pqrs, clasificacion,estado_pqrs$fotoA1)
						  VALUES ('".$_SESSION["AUT"]["id_user"]."','".$_POST["sede"]."','".$_POST["eps"]."','".$_POST["idpac"]."','".$_POST["linea_negocio"]."',
								'".$_POST["medio_registro"]."','".$_POST["tipo_cliente"]."','".$_POST["tipo_solicitud"]."','".$_POST["causa"]."','".$_POST["fecha_radicado"]."',
								'".$_POST["hora_radicado"]."','".$_POST["radicado_eps"]."','".$_POST["contacto_cliente"]."','".$_POST["email_rta"]."', '".$_POST["email_rta1"]."', '".$_POST["email_rta2"]."',
								'".$_POST["email_rta3"]."','".$_POST["descripcion_pqrs"]."','293','".$_POST["clasificacion"]."','1'$fotoA2)";
					$subtitulo="La PQRS fue ";
					$subtitulo1="Adicionada";
			}
			if ($servicio==4) {
				include "PHPmailer/class.phpmailer.php";
				include "PHPmailer/class.smtp.php";
				$sede=$_POST['id_sedes_ips'];
				$eps=$_POST['id_sedes_ips'];
				$servicio=$_POST['linea_negocio'];
				$radeps=$_POST['radicado_eps'];

				$email_user = "pqrs@emmanuelips.co";
				$email_password = "Emmanuel_12345";
				$the_subject = 'PQRS : '.$_POST['nompac'];
				$address_to = 'pqrsdomiciliarios@emmanuelips.co';
				$address_t1 = 'atencionalusuario@emmanuelips.co';

				$from_name = "Emmanuel IPS solicita una respuesta a esta PQRS ";
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
				$phpmailer->AddAddress($address_t1);
				$phpmailer->AddAddress($address_t2);
				$phpmailer->AddAddress($address_t3);
				$phpmailer->AddAddress($address_t4);
				$phpmailer->AddAddress($address_t5); // recipients email
				$phpmailer->Subject = $the_subject;
				$phpmailer->Body .= utf8_decode("<p class='text-left'>
																					<strong>SION software le informa que tiene PQRS por contestar, acceda inmediatamente para realizar gestión.</strong>
																				 </p>
																				 <p>Gracias por su colaboración</p>
														 ");
				$phpmailer->Body .= utf8_decode("<a href='www.sionsoftware.com'>Ir a SION</a>");
				$phpmailer->IsHTML(true);
				$phpmailer->Send();

				$sql="INSERT INTO pqr (id_user_reg, id_sedes_ips, id_eps, id_paciente, linea_negocio, medio_registro, tipo_cliente, tipo_solicitud,causa,
															 fecha_radicado, hora_radicado,radicado_eps, contacto_cliente,email_rta, email_rta1, email_rta2, email_rta3, descripcion_pqrs, responsable_rta_pqrs, clasificacion,estado_pqrs$fotoA1)
						  VALUES ('".$_SESSION["AUT"]["id_user"]."','".$_POST["sede"]."','".$_POST["eps"]."','".$_POST["idpac"]."','".$_POST["linea_negocio"]."',
								'".$_POST["medio_registro"]."','".$_POST["tipo_cliente"]."','".$_POST["tipo_solicitud"]."','".$_POST["causa"]."','".$_POST["fecha_radicado"]."',
								'".$_POST["hora_radicado"]."','".$_POST["radicado_eps"]."','".$_POST["contacto_cliente"]."','".$_POST["email_rta"]."', '".$_POST["email_rta1"]."', '".$_POST["email_rta2"]."',
								'".$_POST["email_rta3"]."','".$_POST["descripcion_pqrs"]."','1428','".$_POST["clasificacion"]."','1'$fotoA2)";
					$subtitulo="La PQRS fue ";
					$subtitulo1="Adicionada";
			}
			if ($sede==2 && $servicio==2) {
				include "PHPmailer/class.phpmailer.php";
				include "PHPmailer/class.smtp.php";
				$sede=$_POST['id_sedes_ips'];
				$eps=$_POST['id_sedes_ips'];
				$servicio=$_POST['linea_negocio'];
				$radeps=$_POST['radicado_eps'];

				$email_user = "pqrs@emmanuelips.co";
				$email_password = "Emmanuel_12345";
				$the_subject = 'PQRS : '.$_POST['nompac'];
				$address_to = 'direccioncientifica@consorcio.emmanuelips.co';
				$address_t1 = 'atencionalusuario@emmanuelips.co';

				$from_name = "Emmanuel IPS solicita una respuesta a esta PQRS ";
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
				$phpmailer->AddAddress($address_t1);
				$phpmailer->AddAddress($address_t2);
				$phpmailer->AddAddress($address_t3);
				$phpmailer->AddAddress($address_t4);
				$phpmailer->AddAddress($address_t5); // recipients email
				$phpmailer->Subject = $the_subject;
				$phpmailer->Body .= utf8_decode("<p class='text-left'>
																					<strong>SION software le informa que tiene PQRS por contestar, acceda inmediatamente para realizar gestión.</strong>
																				 </p>
																				 <p>Gracias por su colaboración</p>
														 ");
				$phpmailer->Body .= utf8_decode("<a href='www.sionsoftware.com'>Ir a SION</a>");
				$phpmailer->IsHTML(true);
				$phpmailer->Send();

				$sql="INSERT INTO pqr (id_user_reg, id_sedes_ips, id_eps, id_paciente, linea_negocio, medio_registro, tipo_cliente, tipo_solicitud,causa,
															 fecha_radicado, hora_radicado,radicado_eps, contacto_cliente,email_rta, email_rta1, email_rta2, email_rta3, descripcion_pqrs, responsable_rta_pqrs, clasificacion,estado_pqrs$fotoA1)
						  VALUES ('".$_SESSION["AUT"]["id_user"]."','".$_POST["sede"]."','".$_POST["eps"]."','".$_POST["idpac"]."','".$_POST["linea_negocio"]."',
								'".$_POST["medio_registro"]."','".$_POST["tipo_cliente"]."','".$_POST["tipo_solicitud"]."','".$_POST["causa"]."','".$_POST["fecha_radicado"]."',
								'".$_POST["hora_radicado"]."','".$_POST["radicado_eps"]."','".$_POST["contacto_cliente"]."','".$_POST["email_rta"]."', '".$_POST["email_rta1"]."', '".$_POST["email_rta2"]."',
								'".$_POST["email_rta3"]."','".$_POST["descripcion_pqrs"]."','1338','".$_POST["clasificacion"]."','1'$fotoA2)";
					$subtitulo="La PQRS fue ";
					$subtitulo1="Adicionada";
			}
			if ($sede==2 && $servicio==1) {
				include "PHPmailer/class.phpmailer.php";
				include "PHPmailer/class.smtp.php";
				$sede=$_POST['id_sedes_ips'];
				$eps=$_POST['id_sedes_ips'];
				$servicio=$_POST['linea_negocio'];
				$radeps=$_POST['radicado_eps'];

				$email_user = "pqrs@emmanuelips.co";
				$email_password = "Emmanuel_12345";
				$the_subject = 'PQRS : '.$_POST['nompac'];
				$address_to = 'direccioncientifica@consorcio.emmanuelips.co';
				$address_t1 = 'atencionalusuario@emmanuelips.co';

				$from_name = "Emmanuel IPS solicita una respuesta a esta PQRS ";
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
				$phpmailer->AddAddress($address_t1);
				$phpmailer->AddAddress($address_t2);
				$phpmailer->AddAddress($address_t3);
				$phpmailer->AddAddress($address_t4);
				$phpmailer->AddAddress($address_t5); // recipients email
				$phpmailer->Subject = $the_subject;
				$phpmailer->Body .= utf8_decode("<p class='text-left'>
																					<strong>SION software le informa que tiene PQRS por contestar, acceda inmediatamente para realizar gestión.</strong>
																				 </p>
																				 <p>Gracias por su colaboración</p>
														 ");
				$phpmailer->Body .= utf8_decode("<a href='www.sionsoftware.com'>Ir a SION</a>");
				$phpmailer->IsHTML(true);
				$phpmailer->Send();

				$sql="INSERT INTO pqr (id_user_reg, id_sedes_ips, id_eps, id_paciente, linea_negocio, medio_registro, tipo_cliente, tipo_solicitud,causa,
															 fecha_radicado, hora_radicado,radicado_eps, contacto_cliente,email_rta, email_rta1, email_rta2, email_rta3, descripcion_pqrs, responsable_rta_pqrs, clasificacion,estado_pqrs$fotoA1)
						  VALUES ('".$_SESSION["AUT"]["id_user"]."','".$_POST["sede"]."','".$_POST["eps"]."','".$_POST["idpac"]."','".$_POST["linea_negocio"]."',
								'".$_POST["medio_registro"]."','".$_POST["tipo_cliente"]."','".$_POST["tipo_solicitud"]."','".$_POST["causa"]."','".$_POST["fecha_radicado"]."',
								'".$_POST["hora_radicado"]."','".$_POST["radicado_eps"]."','".$_POST["contacto_cliente"]."','".$_POST["email_rta"]."', '".$_POST["email_rta1"]."', '".$_POST["email_rta2"]."',
								'".$_POST["email_rta3"]."','".$_POST["descripcion_pqrs"]."','1338','".$_POST["clasificacion"]."','1'$fotoA2)";
					$subtitulo="La PQRS fue ";
					$subtitulo1="Adicionada";
			}
			if ($sede==2 && $servicio==6) {
				include "PHPmailer/class.phpmailer.php";
				include "PHPmailer/class.smtp.php";
				$sede=$_POST['id_sedes_ips'];
				$eps=$_POST['id_sedes_ips'];
				$servicio=$_POST['linea_negocio'];
				$radeps=$_POST['radicado_eps'];

				$email_user = "pqrs@emmanuelips.co";
				$email_password = "Emmanuel_12345";
				$the_subject = 'PQRS : '.$_POST['nompac'];
				$address_to = 'direccioncientifica@consorcio.emmanuelips.co';
				$address_t1 = 'atencionalusuario@emmanuelips.co';

				$from_name = "Emmanuel IPS solicita una respuesta a esta PQRS ";
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
				$phpmailer->AddAddress($address_t1);
				$phpmailer->AddAddress($address_t2);
				$phpmailer->AddAddress($address_t3);
				$phpmailer->AddAddress($address_t4);
				$phpmailer->AddAddress($address_t5); // recipients email
				$phpmailer->Subject = $the_subject;
				$phpmailer->Body .= utf8_decode("<p class='text-left'>
																					<strong>SION software le informa que tiene PQRS por contestar, acceda inmediatamente para realizar gestión.</strong>
																				 </p>
																				 <p>Gracias por su colaboración</p>
														 ");
				$phpmailer->Body .= utf8_decode("<a href='www.sionsoftware.com'>Ir a SION</a>");
				$phpmailer->IsHTML(true);
				$phpmailer->Send();

				$sql="INSERT INTO pqr (id_user_reg, id_sedes_ips, id_eps, id_paciente, linea_negocio, medio_registro, tipo_cliente, tipo_solicitud,causa,
															 fecha_radicado, hora_radicado,radicado_eps, contacto_cliente,email_rta, email_rta1, email_rta2, email_rta3, descripcion_pqrs, responsable_rta_pqrs, clasificacion,estado_pqrs$fotoA1)
						  VALUES ('".$_SESSION["AUT"]["id_user"]."','".$_POST["sede"]."','".$_POST["eps"]."','".$_POST["idpac"]."','".$_POST["linea_negocio"]."',
								'".$_POST["medio_registro"]."','".$_POST["tipo_cliente"]."','".$_POST["tipo_solicitud"]."','".$_POST["causa"]."','".$_POST["fecha_radicado"]."',
								'".$_POST["hora_radicado"]."','".$_POST["radicado_eps"]."','".$_POST["contacto_cliente"]."','".$_POST["email_rta"]."', '".$_POST["email_rta1"]."', '".$_POST["email_rta2"]."',
								'".$_POST["email_rta3"]."','".$_POST["descripcion_pqrs"]."','1338','".$_POST["clasificacion"]."','1'$fotoA2)";
					$subtitulo="La PQRS fue ";
					$subtitulo1="Adicionada";
			}
			if ($sede==8 && $servicio==2) {
				include "PHPmailer/class.phpmailer.php";
				include "PHPmailer/class.smtp.php";
				$sede=$_POST['id_sedes_ips'];
				$eps=$_POST['id_sedes_ips'];
				$servicio=$_POST['linea_negocio'];
				$radeps=$_POST['radicado_eps'];

				$email_user = "pqrs@emmanuelips.co";
				$email_password = "Emmanuel_12345";
				$the_subject = 'PQRS : '.$_POST['nompac'];
				$address_to = 'direccioncientifica@consorcio.emmanuelips.co';
				$address_t1 = 'atencionalusuario@emmanuelips.co';

				$from_name = "Emmanuel IPS solicita una respuesta a esta PQRS ";
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
				$phpmailer->AddAddress($address_t1);
				$phpmailer->AddAddress($address_t2);
				$phpmailer->AddAddress($address_t3);
				$phpmailer->AddAddress($address_t4);
				$phpmailer->AddAddress($address_t5); // recipients email
				$phpmailer->Subject = $the_subject;
				$phpmailer->Body .= utf8_decode("<p class='text-left'>
																					<strong>SION software le informa que tiene PQRS por contestar, acceda inmediatamente para realizar gestión.</strong>
																				 </p>
																				 <p>Gracias por su colaboración</p>
														 ");
				$phpmailer->Body .= utf8_decode("<a href='www.sionsoftware.com'>Ir a SION</a>");
				$phpmailer->IsHTML(true);
				$phpmailer->Send();

				$sql="INSERT INTO pqr (id_user_reg, id_sedes_ips, id_eps, id_paciente, linea_negocio, medio_registro, tipo_cliente, tipo_solicitud,causa,
															 fecha_radicado, hora_radicado,radicado_eps, contacto_cliente,email_rta, email_rta1, email_rta2, email_rta3, descripcion_pqrs, responsable_rta_pqrs, clasificacion,estado_pqrs$fotoA1)
						  VALUES ('".$_SESSION["AUT"]["id_user"]."','".$_POST["sede"]."','".$_POST["eps"]."','".$_POST["idpac"]."','".$_POST["linea_negocio"]."',
								'".$_POST["medio_registro"]."','".$_POST["tipo_cliente"]."','".$_POST["tipo_solicitud"]."','".$_POST["causa"]."','".$_POST["fecha_radicado"]."',
								'".$_POST["hora_radicado"]."','".$_POST["radicado_eps"]."','".$_POST["contacto_cliente"]."','".$_POST["email_rta"]."', '".$_POST["email_rta1"]."', '".$_POST["email_rta2"]."',
								'".$_POST["email_rta3"]."','".$_POST["descripcion_pqrs"]."','34','".$_POST["clasificacion"]."','1'$fotoA2)";
					$subtitulo="La PQRS fue ";
					$subtitulo1="Adicionada";
			}
			if ($sede==8 && $servicio==1) {
				include "PHPmailer/class.phpmailer.php";
				include "PHPmailer/class.smtp.php";
				$sede=$_POST['id_sedes_ips'];
				$eps=$_POST['id_sedes_ips'];
				$servicio=$_POST['linea_negocio'];
				$radeps=$_POST['radicado_eps'];

				$email_user = "pqrs@emmanuelips.co";
				$email_password = "Emmanuel_12345";
				$the_subject = 'PQRS : '.$_POST['nompac'];
				$address_to = 'direccioncientifica@consorcio.emmanuelips.co';
				$address_t1 = 'atencionalusuario@emmanuelips.co';

				$from_name = "Emmanuel IPS solicita una respuesta a esta PQRS ";
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
				$phpmailer->AddAddress($address_t1);
				$phpmailer->AddAddress($address_t2);
				$phpmailer->AddAddress($address_t3);
				$phpmailer->AddAddress($address_t4);
				$phpmailer->AddAddress($address_t5); // recipients email
				$phpmailer->Subject = $the_subject;
				$phpmailer->Body .= utf8_decode("<p class='text-left'>
																					<strong>SION software le informa que tiene PQRS por contestar, acceda inmediatamente para realizar gestión.</strong>
																				 </p>
																				 <p>Gracias por su colaboración</p>
														 ");
				$phpmailer->Body .= utf8_decode("<a href='www.sionsoftware.com'>Ir a SION</a>");
				$phpmailer->IsHTML(true);
				$phpmailer->Send();

				$sql="INSERT INTO pqr (id_user_reg, id_sedes_ips, id_eps, id_paciente, linea_negocio, medio_registro, tipo_cliente, tipo_solicitud,causa,
															 fecha_radicado, hora_radicado,radicado_eps, contacto_cliente,email_rta, email_rta1, email_rta2, email_rta3, descripcion_pqrs, responsable_rta_pqrs, clasificacion,estado_pqrs$fotoA1)
						  VALUES ('".$_SESSION["AUT"]["id_user"]."','".$_POST["sede"]."','".$_POST["eps"]."','".$_POST["idpac"]."','".$_POST["linea_negocio"]."',
								'".$_POST["medio_registro"]."','".$_POST["tipo_cliente"]."','".$_POST["tipo_solicitud"]."','".$_POST["causa"]."','".$_POST["fecha_radicado"]."',
								'".$_POST["hora_radicado"]."','".$_POST["radicado_eps"]."','".$_POST["contacto_cliente"]."','".$_POST["email_rta"]."', '".$_POST["email_rta1"]."', '".$_POST["email_rta2"]."',
								'".$_POST["email_rta3"]."','".$_POST["descripcion_pqrs"]."','34','".$_POST["clasificacion"]."','1'$fotoA2)";
					$subtitulo="La PQRS fue ";
					$subtitulo1="Adicionada";
			}
			if ($sede==8 && $servicio==6) {
				include "PHPmailer/class.phpmailer.php";
				include "PHPmailer/class.smtp.php";
				$sede=$_POST['id_sedes_ips'];
				$eps=$_POST['id_sedes_ips'];
				$servicio=$_POST['linea_negocio'];
				$radeps=$_POST['radicado_eps'];

				$email_user = "pqrs@emmanuelips.co";
				$email_password = "Emmanuel_12345";
				$the_subject = 'PQRS : '.$_POST['nompac'];
				$address_to = 'direccioncientifica@consorcio.emmanuelips.co';
				$address_t1 = 'atencionalusuario@emmanuelips.co';

				$from_name = "Emmanuel IPS solicita una respuesta a esta PQRS ";
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
				$phpmailer->AddAddress($address_t1);
				$phpmailer->AddAddress($address_t2);
				$phpmailer->AddAddress($address_t3);
				$phpmailer->AddAddress($address_t4);
				$phpmailer->AddAddress($address_t5); // recipients email
				$phpmailer->Subject = $the_subject;
				$phpmailer->Body .= utf8_decode("<p class='text-left'>
																					<strong>SION software le informa que tiene PQRS por contestar, acceda inmediatamente para realizar gestión.</strong>
																				 </p>
																				 <p>Gracias por su colaboración</p>
														 ");
				$phpmailer->Body .= utf8_decode("<a href='www.sionsoftware.com'>Ir a SION</a>");
				$phpmailer->IsHTML(true);
				$phpmailer->Send();

				$sql="INSERT INTO pqr (id_user_reg, id_sedes_ips, id_eps, id_paciente, linea_negocio, medio_registro, tipo_cliente, tipo_solicitud,causa,
															 fecha_radicado, hora_radicado,radicado_eps, contacto_cliente,email_rta, email_rta1, email_rta2, email_rta3, descripcion_pqrs, responsable_rta_pqrs, clasificacion,estado_pqrs$fotoA1)
						  VALUES ('".$_SESSION["AUT"]["id_user"]."','".$_POST["sede"]."','".$_POST["eps"]."','".$_POST["idpac"]."','".$_POST["linea_negocio"]."',
								'".$_POST["medio_registro"]."','".$_POST["tipo_cliente"]."','".$_POST["tipo_solicitud"]."','".$_POST["causa"]."','".$_POST["fecha_radicado"]."',
								'".$_POST["hora_radicado"]."','".$_POST["radicado_eps"]."','".$_POST["contacto_cliente"]."','".$_POST["email_rta"]."', '".$_POST["email_rta1"]."', '".$_POST["email_rta2"]."',
								'".$_POST["email_rta3"]."','".$_POST["descripcion_pqrs"]."','34','".$_POST["clasificacion"]."','1'$fotoA2)";
					$subtitulo="La PQRS fue ";
					$subtitulo1="Adicionada";
			}
			break;

			case 'RTA': // reparar para la salida

			include "PHPmailer/class.phpmailer.php";
			include "PHPmailer/class.smtp.php";
			$respuesta=$_POST['respuesta'];
			$radeps=$_POST['radicado_eps'];
			$profesional=$_POST['profesional'];
			$espec=$_POST['especialidad'];
			$firma=$_POST['firma'];

			$email_user = "pqrs@emmanuelips.co";
			$email_password = "Emmanuel_12345";
			$the_subject = 'RESPUESTA : RAD:'.$radeps.' '.$_POST['pacnom'].' - '.$_POST['tdoc'].': '.$_POST['doc'];
			$rad2='RAD:'.$radeps.' '.$_POST['pacnom'].' - '.$_POST['tdoc'].': '.$_POST['doc'];
			$address_to = $_POST['e1'];
			$address_t1 = $_POST['e2'];
			$address_t2 = $_POST['e3'];
			$address_t3 = $_POST['e4'];
			$from_name = "Emmanuel IPS envia respuesta a PQRS";
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
			$phpmailer->AddAddress($address_t1);
			$phpmailer->AddAddress($address_t2);
			$phpmailer->AddAddress($address_t3);
			$phpmailer->AddAddress($address_t4);
			$phpmailer->AddAddress($address_t5);

			 // recipients email
			$phpmailer->Subject = $the_subject;
			$phpmailer->Body .= utf8_decode("
																			<h2>RESPUESTA A PQRS: RAD:$rad2</h2>
																			<h3>A quien le interese</h3>
																			<p>Reciba un cordial saludo de parte de Emmanuel instituto de rehabilitación y habilitación infantil.</p>
																			<p>$respuesta</p>
																			<img src=".$firma.">
																			<p><strong>$profesional</strong></p>
																			<p>$espec</p>
																			");
			$phpmailer->IsHTML(true);
			$phpmailer->Send();

			$sql="UPDATE pqr SET estado_pqrs=2,user_rta='".$_SESSION["AUT"]["jefe_zona"]."' ,fecha_rta='".$_POST["fecha_rta"]."'
													 ,hora_rta='".$_POST["hora_rta"]."',descripcion_rta_pqr='".$_POST["respuesta"]."' ,servicio_interno='".$_POST["servicio"]."'
						WHERE id_pqr='".$_POST["id_pqr"]."' ";
			$subtitulo="";

			break;
			case 'CLASE2':

			$f=date('Y-m-d');
			$sql="UPDATE pqr SET resp_atributo='".$_SESSION['AUT']['id_user']."',freg_atributo='".$f."',nivel_satisfaccion='".$_POST["nivel_satisfaccion"]."',
													 atributo_pqrs='".$_POST["atributo_pqrs"]."',obs_clasificacion_pqrs='".$_POST["obs_clasificacion_pqrs"]."'
						WHERE id_pqr='".$_POST["id_pqr"]."' ";
			$sql1="UPDATE pqr SET estado_pqrs=4
						 WHERE id_pqr='".$_POST["id_pqr"]."' ";
						$subtitulo="Clasificación adicional de PQRS fue ";
						$subtitulo1="Adicionada";
			break;
			case 'PLAN':
			$sql="UPDATE pqr SET estado_pqrs=3
						WHERE id_pqr='".$_POST["id_pqr"]."' ";
			$date=date('Y-m-d');
			$sql1="INSERT INTO plan_mejora (id_pqr, freg, user_reg, que, como, cuando_inicial, cuando_final, quien, donde, porque, f_seguimiento, estado_plan_mejora)
						 VALUES ('".$_POST["id_pqr"]."','".$date."','".$_SESSION['AUT']['id_user']."','".$_POST["que"]."','".$_POST["como"]."','".$_POST["inicial"]."','".$_POST["final"]."',
						 				 '".$_POST["quien"]."','".$_POST["donde"]."','".$_POST["porque"]."','".$_POST["f_seguimiento"]."','SOLICITADO')";
			$subtitulo2="plan agregado";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo fue $subtitulo1 con exito!.$subtitulo2";
		$check='si';
			if ($bd1->consulta($sql1)) {
				$subtitulo="$subtitulo fue $subtitulo1 con exito!.$subtitulo2";
				$check='si';
			}
		}else{
			$subtitulo="$subtitulo  NO fue $subtitulo1 !!!.$subtitulo2";
		$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {

			case 'RTA':
			$idp=$_REQUEST['idp'];
      $sql="SELECT a.nom_completo,a.id_paciente idpac,
									 b.id_pqr,id_user_reg,linea_negocio,medio_registro,tipo_cliente,tipo_solicitud,fecha_radicado,hora_radicado,radicado_eps,
									 	 contacto_cliente,email_rta,email_rta1,email_rta2,email_rta3,descripcion_pqrs,clasificacion,soporte_pqr,
									 c.nombre registra
						FROM pacientes a left join pqr b on a.id_paciente=b.id_paciente
							  						left join user c on c.id_user=b.id_user_reg
						WHERE id_pqr=$idp" ;
			$boton="Responder";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='PQRs/add_resp_pqr.php';
			$subtitulo='Respuesta Petición, Quejas, Reclamos y sugerencias';
			break;
			case 'PLAN':
			$idp=$_REQUEST['idp'];
      $sql="SELECT a.nom_completo,a.id_paciente idpac,
									 b.id_pqr,id_user_reg,linea_negocio,medio_registro,tipo_cliente,tipo_solicitud,fecha_radicado,hora_radicado,radicado_eps,
									 	 contacto_cliente,email_rta,email_rta1,email_rta2,email_rta3,descripcion_pqrs,clasificacion,soporte_pqr,fecha_rta, hora_rta, descripcion_rta_pqr,
										 servicio_interno, nivel_satisfaccion, atributo_pqrs, obs_clasificacion_pqrs,
									 c.nombre registra
						FROM pacientes a left join pqr b on a.id_paciente=b.id_paciente
							  						left join user c on c.id_user=b.id_user_reg
						WHERE id_pqr=$idp" ;
			$boton="Grabar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='PQRs/add_plan_mejora.php';
			$subtitulo='Registro plan de acción';
			break;
			case 'CLASE2':
			$idp=$_REQUEST['idp'];
      $sql="SELECT a.nom_completo,a.id_paciente idpac,
									 b.id_pqr,id_user_reg,linea_negocio,medio_registro,tipo_cliente,tipo_solicitud,fecha_radicado,hora_radicado,
									 	 contacto_cliente,email_rta,descripcion_pqrs,clasificacion,soporte_pqr,
									 c.nombre registra
						FROM pacientes a left join pqr b on a.id_paciente=b.id_paciente
							  						left join user c on c.id_user=b.id_user_reg
						WHERE id_pqr=$idp" ;
			$boton="Clasificar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='PQRs/clasificacion_calidad.php';
			$subtitulo='Clasificación de atributo en Calidad';
			break;
			case 'A':
      $sql="" ;
			$boton="Guardar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='PQRs/add_pqr.php';
			$subtitulo='Registro de PQRS';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("nom_completo"=>"","idpac"=>"","id_pqr"=>"","linea_negocio"=>"","medio_registro"=>"","tipo_cliente"=>"","tipo_solicitud"=>"",
										 "fecha_radicado"=>"",
										 "hora_radicado"=>"","radicado_eps"=>"","contacto_cliente"=>"","email_rta"=>"","email_rta1"=>"","email_rta2"=>"","email_rta3"=>"","descripcion_pqrs"=>"","clasificacion"=>"","soporte_pqr"=>"",
										 "registra"=>"","fecha_rta"=>"", "hora_rta"=>"", "descripcion_rta_pqr"=>"",
										 "servicio_interno"=>"", "nivel_satisfaccion"=>"", "atributo_pqrs"=>"", "obs_clasificacion_pqrs"=>"");
			}
		}else{
			$fila=array("nom_completo"=>"","idpac"=>"","id_pqr"=>"","linea_negocio"=>"","medio_registro"=>"","tipo_cliente"=>"","tipo_solicitud"=>"","fecha_radicado"=>"",
									 "hora_radicado"=>"","radicado_eps"=>"","contacto_cliente"=>"","email_rta"=>"","email_rta1"=>"","email_rta2"=>"","email_rta3"=>"","descripcion_pqrs"=>"","clasificacion"=>"","soporte_pqr"=>"",
									 "registra"=>"","fecha_rta"=>"", "hora_rta"=>"", "descripcion_rta_pqr"=>"",
									 "servicio_interno"=>"", "nivel_satisfaccion"=>"", "atributo_pqrs"=>"", "obs_clasificacion_pqrs"=>"");
			}

 include($form1);

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
// nivel 1
	?>
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script type="text/javascript">
	$(function() {
	          $("#codigo").autocomplete({
	              source: "configuraciones/bus_pac.php",
	              minLength: 4,
	              select: function(event, ui) {
	        event.preventDefault();
	                  $('#codigo').val(ui.item.codigo);
	        $('#descripcion').val(ui.item.descripcion);

	         }
	          });
	  });
	</script>
	<section class="panel panel-default">
		<section class="panel-heading">
			<h3>Peticiones, Quejas, Reclamos y Sugerencias</h3>
		</section>
		<section class="panel-body">
			<table class="table table-bordered">
				<tr>
					<td colspan="7" class="text-right">
						<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A'?>" align="center" ><button type="button" class="btn btn-primary btn-lg" >Adicionar Nueva PQRS</button></a>
					</td>
				</tr>
			</table>
		</section>
		<?php
		  $perfil=$_SESSION['AUT']['id_perfil'];
		  if ($perfil==83 || $perfil==1 || $perfil==85) {
		    ?>
		    <section class="panel-body">
		      <form>
		      <section class="col-md-12">
		          <article class="col-md-3">
		            <label>Fecha inicial:</label>
		            <input type="date" class="form-control" name="fecha1">
		          </article>
		          <article class="col-md-3">
		            <label>Fecha Final:</label>
		            <input type="date" class="form-control" name="fecha2">
		          </article>
		          <article class="col-md-3">
		            <label for="">Seleccione SEDE:</label>
		            <select class="form-control input-sm" required="" name="sede">
		              <option value="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15">Todas</option>
		              <?php
		              $sql="SELECT id_sedes_ips,nom_sedes from sedes_ips where id_sedes_ips in (2,8) and estado_sedes='Activo' ORDER BY id_sedes_ips ASC";
		              if($tabla=$bd1->sub_tuplas($sql)){
		                foreach ($tabla as $fila2) {
		                  if ($fila["id_sedes_ips"]==$fila2["id_sedes_ips"]){
		                    $sw=' selected="selected"';
		                  }else{
		                    $sw="";
		                  }
		                echo '<option value="'.$fila2["id_sedes_ips"].'"'.$sw.'>'.$fila2["nom_sedes"].'</option>';
		                }
		              }
		              ?>
		            </select>
		          </article>
		          <article class="col-md-3">
		            <label for="">Seleccione EPS:</label>
		            <select class="form-control input-sm" required="" name="eps">
		              <option value="0,12,13,14,15,16,17,18,19,20,21,22,23,24,25">Todas</option>
		              <?php
		              $sql="SELECT id_eps,nom_eps from eps where estado_eps='Activo' ORDER BY id_eps ASC";
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
		      </section>
		      <section class="col-md-12">
		        <article class="col-md-4">
		          <label for="">Busqueda Paciente:</label>
		          <input type="text"  class="form-control" name="id_pac" id="codigo" placeholder="Digite numero de documento" value="">
		        </article>
		        <article class="col-md-4">
		          <label for="">Paciente seleccionado:</label>
		          <input type="text"  class="form-control" name="nompac" id="descripcion"   value="" <?php echo $atributo1;?>>
		        </article>
		        <div class="row col-md-2">
		          <br>
		          <input type="submit" name="buscar" class="btn btn-primary " value="Buscar">
		          <input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		        </div>
		      </section>
		      </form>
		    </section>
		    <section class="panel-body">
		      <section class="col-md-12">
		        <table class="table table-bordered">
		          <tr>
		            <th>Fecha<br>Radicado</th>
		            <th>Tipo<br>Solicitud</th>
		            <th>Tipo<br>Cliente</th>
		            <th>Detalle<br>Cliente</th>
		            <th></th>
		          </tr>
		          <?php
		          $f1=$_REQUEST['fecha1'];
		          $f2=$_REQUEST['fecha2'];
		          $eps=$_REQUEST['eps'];
		          $sede=$_REQUEST['sede'];
		          $doc=$_REQUEST['id_pac'];
		          if ($doc=='') {
		            $sql_externas="SELECT a.id_pqr, id_user_reg, linea_negocio, medio_registro, tipo_cliente,
		                                  tipo_solicitud, fecha_radicado, hora_radicado, contacto_cliente,email_rta, descripcion_pqrs, responsable_rta_pqrs,
		                                  clasificacion, estado_pqrs, soporte_pqr, user_rta, descripcion_rta_pqr, nivel_satisfaccion, atributo_pqrs,
		                                  obs_clasificacion_pqrs,
		                                  b.nombre user_reg,
		                                  c.nom_eps eps,
		                                  d.nom_sedes sede,
		                                  e.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,nom_completo,
																			f.nomserv,
																			g.nombre resp
		                           FROM pqr a LEFT JOIN user b on a.id_user_reg=b.id_user
		                                      LEFT JOIN eps c on a.id_eps=c.id_eps
		                                      LEFT JOIN sedes_ips d on a.id_sedes_ips=d.id_sedes_ips
		                                      LEFT JOIN pacientes e on a.id_paciente=e.id_paciente
																					LEFT JOIN tipo_servicio f on a.linea_negocio=f.id_serv
																					LEFT JOIN user g on a.responsable_rta_pqrs=g.id_user
		                           WHERE a.id_sedes_ips in ($sede) and a.id_eps in ($eps) and a.fecha_radicado BETWEEN '$f1' and '$f2'";
		                           //echo $sql_externas;
		            if ($tabla_externas=$bd1->sub_tuplas($sql_externas)){
		              foreach ($tabla_externas as $fila_externas) {
		                echo'<tr>';

		                echo'<td>'.$fila_externas["fecha_radicado"].'</td>';
		                echo'<td>'.$fila_externas["tipo_solicitud"].'</td>';
		                echo'<td>'.$fila_externas["tipo_cliente"].'</td>';
		                echo'<td>
		                      <p>'.$fila_externas["nom1"].' '.$fila_externas["nom2"].' '.$fila_externas["ape1"].' '.$fila_externas["ape2"].'</p>
		                      <p>'.$fila_externas["tdoc_pac"].': '.$fila_externas["doc_pac"].'</p>';
		                      $clase=$fila_externas['clasificacion'];
		                      if ($clase=='A') {
		                        echo'<p class="alert alert-danger text-center"><strong>Claificación '.$fila_externas["clasificacion"].'</strong></p>';
		                      }
		                      if ($clase=='B') {
		                        echo'<p class="alert alert-warning text-center"><strong>Claificación '.$fila_externas["clasificacion"].'</strong></p>';
		                      }
		                      if ($clase=='C') {
		                        echo'<p class="alert alert-success text-center"><strong>Claificación '.$fila_externas["clasificacion"].'</strong></p>';
		                      }
		                echo'</td>';
										$estado=$fila_externas['estado_pqrs'];
										$email=$fila_externas['email_rta'];
										if ($estado==1) {
											echo'<td>
													 <p>Aun no hay respuesta de esta PQRS</p>
													 <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CLASE2&idp='.$fila_externas["id_pqr"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-pen-square"></span> Atributos</button></a></p>
													 <p><p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary" data-target="#pqrs'.$fila_externas["id_pqr"].'">Consultar PQRS <span class="fa fa-search"></span> </button></p>
													 </td>';
										}
										if ($estado==2) {
											 echo'<td>
											 			<p><a href="PQRs/rpt_carta_rta.php?ipqr='.$fila_externas["id_pqr"].'&nom='.$fila_externas["nom_completo"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-file-pdf-o"></span> Carta Respueta</button></a></p>
														<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CLASE2&idp='.$fila_externas["id_pqr"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-pen-square"></span> Atributos</button></a></p>
														<p><p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary" data-target="#pqrs'.$fila_externas["id_pqr"].'">Consultar PQRS <span class="fa fa-search"></span> </button></p>
											 			</td>';
										}
										if ($estado==3) {
											 echo'<td>
											 			<p><a href="PQRs/rpt_carta_rta.php?ipqr='.$fila_externas["id_pqr"].'&nom='.$fila_externas["nom_completo"].'"><button type="button" class="btn btn-primary " ><span class="fa fa-file-pdf-o"></span> Carta Respueta</button></a></p>
											 			<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CLASE2&idp='.$fila_externas["id_pqr"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-pen-square"></span> Atributos</button></a></p>
														<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CLASE2&idp='.$fila_externas["id_pqr"].'"><button type="button" class="btn btn-success" ><span class="fa fa-eye"></span> Ver plan de accion</button></a></p>
														<p><p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary " data-target="#pqrs'.$fila_externas["id_pqr"].'">Consultar PQRS <span class="fa fa-search"></span> </button></p>
											 			</td>';
										}

		                echo'</tr>';
										echo'<tr><th colspan="5">';
										echo'<section id="pqrs'.$fila_externas["id_pqr"].'" class="collapse">';
										echo"<article class='col-md-6'>\n";
										echo'<p class="text-justify">
														<label class="text-success">Registrada por: </label><br> '.$fila_externas["medio_registro"].'</strong></p>';
										echo"</article>";
										echo"<article class='col-md-6'>\n";
										echo'<p class="text-justify">
														<label class="text-success">Linea negocio: </label><br> '.$fila_externas["nomserv"].'</strong></p>';
										echo"</article>";
										echo"<article class='col-md-6'>";
										echo'<p class="text-justify">
														<label class="text-success">Descripción de la PQRS: </label><br> '.$fila_externas["descripcion_pqrs"].'</p>';
										echo"</article>";
										echo"<article class='col-md-12'>";
										echo'<p class="text-justify">
														<label class="text-success">Responsable de respuesta: </label><br> '.$fila_externas["resp"].'</p>';
										echo"</article>";
										echo"<article class='col-md-12'>";
										echo'<p class="text-justify">
														<label class="text-danger">Respuesta: </label><br> <p>'.$fila_externas["descripcion_rta_pqr"].'</p></p>';
										echo"</article>";
										echo'</section>';
										echo'</th></tr>';
		              }
		            }
		          }else {
		            echo "<tr><td>No hay PQRS</td></tr>";
		          }

		          ?>
							<!-- Modal -->


		        </table>
		      </section>
		    </section>
		    <?php
		  }
		?>
	</section>
	<?php
	}
	?>
