<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["logo"])){
				if (is_uploaded_file($_FILES["logo"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["logo"]["name"]);
					$archivo=$_POST["nom_eps"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["logo"]["tmp_name"],LOG.LOGOS.$archivo)){
						$fotoE=",logo='".LOGOS.$archivo."'";
						$fotoA1=",logo";
						$fotoA2=",'".LOGOS.$archivo."'";
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
				case 'ADDDETALLE':
					$idm=$_POST['idm'];
					$cups=$_POST['cups'];
					$fi=$_POST['finicio'];
					$ff=$_POST['ffinal'];
					$procedimiento=$_POST['procedimiento'];
					$sql_validacion="SELECT id_d_aut_dom FROM d_aut_dom WHERE cups ='$cups' and estado_d_aut_dom in (1,2) and id_m_aut_dom=$idm and  finicio BETWEEN '$fi' and '$ff' ";
					if ($tabla_validacion=$bd1->sub_tuplas($sql_validacion)){
						foreach ($tabla_validacion as $fila_validacion) {
							$sql="INSERT INTO d_aut_dom (id_m_aut_dom,cups,procedimiento,cantidad,finicio,ffinal,
																					 estado_d_aut_dom,intervalo,temporalidad,succion)
									   VALUES (''".$_POST["cups"]."', '".$_POST["procedimiento"]."',
					 					'".$_POST["cantidad"]."','".$_POST["finicio"]."','".$_POST["ffinal"]."',
					 					'1', '".$_POST["intervalo"]."', '".$_POST["temporalidad"]."','".$_POST["succion"]."')";
							$subtitulo="El Procedimiento $procedimiento ";
							$subtitulo1="registrado. Porque ya existe un procedimiento en estas fechas";
						}
					}else {
						$sql="INSERT INTO d_aut_dom (id_m_aut_dom,cups,procedimiento,cantidad,finicio,ffinal,
																				 estado_d_aut_dom,intervalo,temporalidad,succion)
									 VALUES ('".$_POST["idm"]."','".$_POST["cups"]."', '".$_POST["procedimiento"]."',
									'".$_POST["cantidad"]."','".$_POST["finicio"]."','".$_POST["ffinal"]."',
									'1', '".$_POST["intervalo"]."', '".$_POST["temporalidad"]."','".$_POST["succion"]."')";
						$subtitulo="El Procedimiento $procedimiento ";
						$subtitulo1="registrado";
					}
				break;
				case 'MODFECHA':
					$sql="UPDATE d_aut_dom SET ffinal='".$_POST["freg"]."' WHERE id_d_aut_dom='".$_POST["idd"]."'";
				break;
				case 'DOC':
					$sql="INSERT INTO info_documentacion (id_paciente,nombre_doc$docA)
					VALUES ('".$_POST["idpac"]."','".$_POST["nomdoc"]."'$docb)";
					$subtitulo="El soporte documental ";
					$subtitulo1="Cargado";
				break;
				case 'ADM':
					$sql="INSERT INTO adm_hospitalario ( id_eps, id_paciente, id_sedes_ips, fingreso_hosp, hingreso_hosp,
						tipo_usuario, tipo_afiliacion, ocupacion, dep_residencia, mun_residencia, zona_residencia,tipo_servicio,
						resp_admhosp,estado_adm_hosp )
					VALUES ('".$_POST["id_eps"]."', '".$_POST["id_paciente"]."', '".$_POST["id_sedes_ips"]."',
					'".$_POST["fingreso_hosp"]."','".$_POST["hingreso_hosp"]."','".$_POST["tipo_usuario"]."',
					'".$_POST["tipo_afiliacion"]."', '".$_POST["ocupacion"]."', '".$_POST["dep_residencia"]."',
					'".$_POST["mun_residencia"]."', '".$_POST["zona_residencia"]."','Domiciliarios','".$_SESSION["AUT"]["id_user"]."',
					'Activo')";
					$subtitulo="Admisión del paciente fue";
					$subtitulo1="registrada";
				break;
				case 'MASTER':
					$dxp=substr($_POST['dx'], 0,4);
					$d=date('Y-m-d');
					$sql="INSERT INTO m_aut_dom (id_adm_hosp, id_user, tipo_paciente, zona_paciente,
																			ips_ordena, medico_ordena,cdx_presentacion,dx_presentacion,estado_p_principal) VALUES
					 			('".$_POST["idadm"]."','".$_SESSION['AUT']['id_user']."','".$_POST["tipo_paciente"]."',
								'".$_POST["zona_paciente"]."','".$_POST["ips_ordena"]."','".$_POST["medico_ordena"]."',
								'".$dxp."','".$_POST["dx"]."','1')";
					$subtitulo="Plan Principal ";
					$subtitulo1="agregado";
				break;
				case 'ADDPROFESIONAL':
					$profesional=$_POST['profesional'];
					$sql_email="SELECT email FROM user WHERE id_user=$profesional";
				  if ($tabla_email=$bd1->sub_tuplas($sql_email)){
				    foreach ($tabla_email as $fila_email) {

								include "PHPmailer/class.phpmailer.php";
								include "PHPmailer/class.smtp.php";
								$paciente=$_POST['nom'];
								$doc=$_POST['doc_pac'];
								$dir_pac=$_POST['dir'];
								$tel_pac=$_POST['tel'];
								$barrio=$_POST['barrio'];
								$cuidador=$_POST['nom_acu'];
								$dir_acu=$_POST['dir_acu'];
								$tel_acu=$_POST['tel_acu'];
								$procedimiento=$_POST['cups'].' | '.$_POST['procedimiento'];
								$sesiones=$_POST['cantidad_autorizada'];

								$email_user = "comunicados@emmanuelips.co";
								$email_password = "Emmanuel_12345";
								$the_subject = 'Emmanuel IPS te ha asignado un paciente';

								$address_t1 = $fila_email['email'];
								$from_name = "Asignacion de profesional a paciente";
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

								$phpmailer->AddAddress($address_t1); // recipients email
								$phpmailer->Subject = $the_subject;
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
																									 <br>");
								$phpmailer->Body .= utf8_decode("
																		 <p class='text-left'>Emmanuel IPS</p>
																		 <p class='text-left'>TEL: 743 3693 Ext: 3000-3001-3002-3003-3004-3005</p>");
								$phpmailer->IsHTML(true);
								$phpmailer->Send();

							$d=date('Y-m-d');
							$sql="INSERT INTO profesional_d_dom (id_d_aut_dom, id_user, freg, profesional, estado_profesional)
										VALUES ('".$_POST["id_d_aut_dom"]."','".$_SESSION["AUT"]["id_user"]."','".$d."','".$_POST["profesional"]."','1')";
							$subtitulo="Profesional ";
							$subtitulo1=" asignado";
						}
					}else {
						$d=date('Y-m-d');
						$sql="INSERT INTO profesional_d_dom (id_d_aut_dom, id_user, freg, profesional, estado_profesional)
									VALUES ('".$_POST[""]."','".["AUT"]["id_user"]."','".$d."','".$_POST["profesional"]."','1')";
						$subtitulo="Profesional ";
						$subtitulo1=" asignado";
					}
				break;

				case 'CREARPACIENTE':
					$sql="INSERT INTO pacientes (tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,dir_pac,tel_pac,email_pac,genero,fnacimiento) VALUES
					 			('".$_POST["tdocpac"]."','".$_POST["docpac"]."','".$_POST["nom1"]."','".$_POST["nom2"]."',
								'".$_POST["ape1"]."','".$_POST["ape2"]."','".$_POST["dirpac"]."','".$_POST["telpac"]."','".$_POST["email"]."',
								'".$_POST["genero"]."','".$_POST["fnacimiento"]."')";
					$subtitulo="El paciente".$_POST["nom1"].' '.$_POST["nom1"].' '.$_POST["ape1"].' '.$_POST["ape2"].' fue';
					$subtitulo1="agregada";
				break;
				case 'EDITBARRIO':
					$sql="UPDATE pacientes SET zonificacion='".$_POST["zonificacion"]."' WHERE id_paciente='".$_POST["idpac"]."' ";
					$subtitulo="Zonificación del paciente ";
					$subtitulo1="agregada";
				break;
				case 'EDITJEFE':
				$profesional=$_POST['jefe_zona'];
				$sql_email="SELECT email FROM user WHERE id_user=$profesional";
				if ($tabla_email=$bd1->sub_tuplas($sql_email)){
					foreach ($tabla_email as $fila_email) {

							include "PHPmailer/class.phpmailer.php";
							include "PHPmailer/class.smtp.php";
							$paciente=$_POST['nombre'];
							$doc=$_POST['doc_pac'];
							$dir_pac=$_POST['dir_pac'];
							$tel_pac=$_POST['tel_pac'];

							$email_user = "comunicados@emmanuelips.co";
							$email_password = "Emmanuel_12345";
							$the_subject = 'Emmanuel IPS ha asignado un paciente a su zona';

							$address_t1 = $fila_email['email'];
							$from_name = "Emmanuel IPS ha asignado un paciente a su zona";
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

							$phpmailer->AddAddress($address_t1); // recipients email
							$phpmailer->Subject = $the_subject;
							$phpmailer->Body .= utf8_decode("<p class='text-left'><strong>Tienes un nuevo paciente asignado a la zona:</strong></p>
																	 <p class='text-danger'><strong><i><u>DATOS DEL PACIENTE: </u></i></strong></p>
																	 <p class=''><strong>PACIENTE: </strong>$paciente</p>
																	 <p class=''><strong>DOCUMENTO: </strong>$doc</p>
																	 <p class=''><strong>DIRECCIÓN: </strong>$dir_pac</p>
																	 <p class=''><strong>TELEFONO: </strong>$tel_pac</p>");

							$phpmailer->Body .= utf8_decode("
																	 <p class='text-left'>Emmanuel IPS</p>
																	 <p class='text-left'>TEL: 743 3693 Ext: 3000-3001-3002-3003-3004-3005</p>");
							$phpmailer->IsHTML(true);
							$phpmailer->Send();

						$d=date('Y-m-d');
						$sql="UPDATE pacientes SET jefe_zona='".$_POST["jefe_zona"]."' WHERE id_paciente='".$_POST["id_paciente"]."' ";
						$subtitulo="Jefe de zona del paciente ";
						$subtitulo1="agregada";
					}
				}else {
					$sql="UPDATE pacientes SET jefe_zo='".$_PO."' WHERE id_paciente='".$_POST["id_paciente"]."' ";
					$subtitulo="Jefe de zona del paciente ";
					$subtitulo1="agregada";
				}
				break;
				case 'ADDJEFEZONA':
				$profesional=$_POST['jefe_zona'];
				$sql_email="SELECT email FROM user WHERE id_user=$profesional";
				if ($tabla_email=$bd1->sub_tuplas($sql_email)){
					foreach ($tabla_email as $fila_email) {

							include "PHPmailer/class.phpmailer.php";
							include "PHPmailer/class.smtp.php";
							$paciente=$_POST['nombre'];
							$doc=$_POST['doc_pac'];
							$dir_pac=$_POST['dir_pac'];
							$tel_pac=$_POST['tel_pac'];

							$email_user = "comunicados@emmanuelips.co";
							$email_password = "Emmanuel_12345";
							$the_subject = 'Emmanuel IPS ha asignado un paciente a su zona';

							$address_t1 = $fila_email['email'];
							$from_name = "Emmanuel IPS ha asignado un paciente a su zona";
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

							$phpmailer->AddAddress($address_t1); // recipients email
							$phpmailer->Subject = $the_subject;
							$phpmailer->Body .= utf8_decode("<p class='text-left'><strong>Tienes un nuevo paciente asignado a la zona:</strong></p>
																	 <p class='text-danger'><strong><i><u>DATOS DEL PACIENTE: </u></i></strong></p>
																	 <p class=''><strong>PACIENTE: </strong>$paciente</p>
																	 <p class=''><strong>DOCUMENTO: </strong>$doc</p>
																	 <p class=''><strong>DIRECCIÓN: </strong>$dir_pac</p>
																	 <p class=''><strong>TELEFONO: </strong>$tel_pac</p>");

							$phpmailer->Body .= utf8_decode("
																	 <p class='text-left'>Emmanuel IPS</p>
																	 <p class='text-left'>TEL: 743 3693 Ext: 3000-3001-3002-3003-3004-3005</p>");
							$phpmailer->IsHTML(true);
							$phpmailer->Send();

						$d=date('Y-m-d');
						$sql="UPDATE pacientes SET jefe_zona='".$_POST["jefe_zona"]."' WHERE id_paciente='".$_POST["id_paciente"]."' ";
						$subtitulo="Jefe de zona del paciente ";
						$subtitulo1="agregada";
					}
				}else {
					$sql="UPDATE pacientes SET jefe_zo='".$_PO."' WHERE id_paciente='".$_POST["id_paciente"]."' ";
					$subtitulo="Jefe de zona del paciente ";
					$subtitulo1="agregada";
				}
				break;
				case 'EDITPACIENTE':
					$sql="UPDATE pacientes SET tdoc_pac='".$_POST["tdocpac"]."',doc_pac='".$_POST["docpac"]."',
																		 nom1='".$_POST["nom1"]."',nom2='".$_POST["nom2"]."',
																		 ape1='".$_POST["ape1"]."',ape2='".$_POST["ape2"]."',
																		 dir_pac='".$_POST["dirpac"]."',tel_pac='".$_POST["telpac"]."',email_pac='".$_POST["email"]."',
																		 genero='".$_POST["genero"]."',fnacimiento='".$_POST["fnacimiento"]."' WHERE id_paciente='".$_POST["idpaci"]."' ";
					$subtitulo="Datos de ".$_POST["nom1"].' '.$_POST["nom1"].' '.$_POST["ape1"].' '.$_POST["ape2"]." del paciente ";
					$subtitulo1="Actualizados";
				break;
			case 'X':
				$sql="SELECT logo from eps where id_eps=".$_POST["ideps"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="DELETE FROM eps WHERE id_eps=".$_POST["ideps"];
				$subtitulo="Eliminado";
			break;
			case 'ADDBARRIO':
				$sql="UPDATE pacientes SET zonificacion='".$_POST["zonificacion"]."' WHERE id_paciente='".$_POST["idpac"]."' ";
				$subtitulo="Zonificación del paciente ";
				$subtitulo1="agregada";
			break;

			case 'ACUDIENTE':
				$sql="INSERT INTO info_acudiente (id_adm_hosp,nombre_acu,dir_acu,tel_acu,parentesco_acu) VALUES
				('".$_POST["idadm"]."','".$_POST["nombre"]."','".$_POST["direccion"]."','".$_POST["telefono"]."',
				'".$_POST["parentesco"]."')";
				$subtitulo="Los datos básicos de cuidador primario han sido ";
				$subtitulo1="Adicionados";
			break;
			case 'SALIDA':
				$estado_salida=$_POST["esalida"];
				$fecha=date('Y-m-d');
				$hora=date('H:i');
				$name=$_POST['name'];
				if ($estado_salida == 'Hospitalizacion') {
					$sql="UPDATE adm_hospitalario SET resp_log_egreso='".$_SESSION["AUT"]["id_user"]."',estado_salida='".$_POST["esalida"]."',fegreso_hosp='".$_POST["fegreso"]."',
					hegreso_hosp='".$_POST["hegreso"]."',via_salida='".$_POST["viasalida"]."',
					estado_adm_hosp='Activo'
					WHERE id_adm_hosp='".$_POST["idadmhosp"]."'";
					$subtitulo="Paciente: $name, Ha cambiado su estado a HOSPITALIZADO ";
				}
				if ($estado_salida == 'Convenio Finalizado') {
					$sql="UPDATE adm_hospitalario SET resp_log_egreso='".$_SESSION["AUT"]["id_user"]."',estado_salida='".$_POST["esalida"]."',fegreso_hosp='".$_POST["fegreso"]."',
					hegreso_hosp='".$_POST["hegreso"]."',via_salida='".$_POST["viasalida"]."',
					estado_adm_hosp='Parcial'
					WHERE id_adm_hosp='".$_POST["idadmhosp"]."'";
					$subtitulo="Paciente: $name. Ha finalizado atención en esta admisión por finalización del convenio.";
				}
				if ($estado_salida == 'Fallecimiento') {
					$sql="UPDATE adm_hospitalario SET resp_log_egreso='".$_SESSION["AUT"]["id_user"]."',estado_salida='".$_POST["esalida"]."',fegreso_hosp='".$_POST["fegreso"]."',
					hegreso_hosp='".$_POST["hegreso"]."',via_salida='2',
					estado_adm_hosp='Activo'
					WHERE id_adm_hosp='".$_POST["idadmhosp"]."'";
					$subtitulo="Paciente: $name, Ha cambiado su estado a FALLECIDO ";
				}
				if ($estado_salida == 'Retiro Voluntario') {
					$sql="UPDATE adm_hospitalario SET resp_log_egreso='".$_SESSION["AUT"]["id_user"]."',estado_salida='".$_POST["esalida"]."',fegreso_hosp='".$_POST["fegreso"]."',
					hegreso_hosp='".$_POST["hegreso"]."',via_salida='".$_POST["viasalida"]."',
					estado_adm_hosp='Parcial'
					WHERE id_adm_hosp='".$_POST["idadmhosp"]."'";
					$subtitulo="Paciente: $name. Ha finalizado atención en esta admisión por retiro voluntario.";
				}
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo $subtitulo1 con exito!";
			$check="si";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="$subtitulo NO fue $subtitulo1 !!! .";
			$check="no";
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'MODFECHA':
			$idadm=$_REQUEST['idadm'];
			$sql="";
			$color="yellow";
			$boton="Agregar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$opcion=$_REQUEST['opcion'];
			$doc=$_REQUEST['doc'];
			$form1='formulariosDOM/autorizacion/cambio_fecha.php';
			$subtitulo='Cambio de fecha para el procedimiento';
		break;
		case 'CREARPACIENTE':
			$idpac=$_REQUEST['idpac'];
			$sql="";
			$color="yellow";
			$boton="Agregar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$opcion=$_REQUEST['opcion'];
			$doc=$_REQUEST['docc'];
			$form1='formulariosDOM/presentacion/add_paciente.php';
			$subtitulo='Registro datos básicos paciente';
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
			$option=183;
			$doc=$_REQUEST['doc'];
			$servicio=$_REQUEST['servicio'];
			$form1='formulariosDOM/presentacion/add_documentos.php';
			$subtitulo='Cargar documentos del paciente';
			break;
		case 'ADM':
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
			$form1='formulariosDOM/presentacion/add_admision_dom.php';
			$subtitulo='Registro de admisión en servicio Domiciliario';
		break;

		case 'MASTER':
			$idadm=$_REQUEST['idadm'];
			$sql="SELECT a.id_m_aut_dom, a.id_adm_hosp id, resp_m_aut_dom, freg_m_aut_dom,
									 finicial, ffinal, num_aut_dom, tipo_paciente,
									 estado_aut_dom,
									 b.id_eps
						 FROM m_aut_dom a INNER JOIN adm_hospitalario b on a.id_adm_hosp=b.id_adm_hosp
						 WHERE id_adm_hosp=$idadm";
			$color="yellow";
			$boton="Agregar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$opcion=$_REQUEST['opcion'];
			$doc=$_REQUEST['docc'];
			$form1='formulariosDOM/autorizacion/add_m_autorizacion.php';
			$subtitulo='Registro de plan principal en servicio Domiciliario';
		break;
		case 'ADDDETALLE':
			$idm=$_REQUEST['idm'];
			$sql="SELECT a.id_m_aut_dom, a.id_adm_hosp id, resp_m_aut_dom, freg_m_aut_dom,
									 finicial, ffinal, num_aut_dom, tipo_paciente,
									 estado_aut_dom,
									 b.id_eps
						 FROM m_aut_dom a INNER JOIN adm_hospitalario b on a.id_adm_hosp=b.id_adm_hosp
						 WHERE id_adm_hosp=$idadm";
			$color="yellow";
			$boton="Agregar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$opcion=$_REQUEST['opcion'];
			$doc=$_REQUEST['doc'];
			$form1='formulariosDOM/autorizacion/add_detalle.php';
			$subtitulo='Registro de procedimientos autorizados y asignación de profesionales';
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
			$opcion=198;
			$doc=$_REQUEST['doc'];
			$form1='formulariosDOM/autorizacion/add_profesional.php';
			$subtitulo='Asignación del profesional en servicio domiciliario';
		break;
		case 'ACUDIENTE':
			$idadm=$_REQUEST['idadm'];
			$sql="SELECT id_adm_hosp FROM adm_hospitalario WHERE id_adm_hosp=$idadm";
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
		case 'EDITPACIENTE':
			$idpac=$_REQUEST['idpac'];
			$sql="SELECT id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,dir_pac,tel_pac,email_pac,genero,fnacimiento
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
			case 'SALIDA':
				$idpac=$_REQUEST['idpac'];
				$sql="SELECT a.id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento, edad, uedad, dir_pac, tel_pac, email_pac, estadocivil,
										 genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac, cie, descricie, zonapac, ipsordena,
										 c.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
										 b.id_ubipaciente,b.id_cama idc,finicial,ffinal,
										 d.nom_cama,
										 e.nom_hab,
										 f.nom_pabellon,
										 g.nom_piso
							FROM pacientes a INNER JOIN adm_hospitalario c on a.id_paciente=c.id_paciente
															 LEFT JOIN ubipaciente b on b.id_adm_hosp=c.id_adm_hosp
															 LEFT JOIN cama d on d.id_cama=b.id_cama
															 LEFT JOIN habitacion e on e.id_habitacion=d.id_habitacion
															 LEFT JOIN pabellon f on f.id_pabellon=e.id_pabellon
															 LEFT JOIN piso g on g.id_piso=f.id_piso
							WHERE c.id_adm_hosp=$idpac and c.estado_adm_hosp='Activo'";
				$color="yellow";
				$boton="Agregar";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$opcion=$_REQUEST['opcion'];
				$doc=$_REQUEST['docc'];
				$form1='formulariosDOM/presentacion/egreso_dom.php';
				$subtitulo='Egreso de paciente';
			break;
			case 'ADDJEFEZONA':
			$idpac=$_REQUEST['idpac'];
			$sql="SELECT id_paciente,doc_pac,nom1,nom2,ape1,ape2,tel_pac,dir_pac,nom_completo
						FROM pacientes
						WHERE id_paciente=$idpac";
			$color="yellow";
			$boton="Agregar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$opcion=$_REQUEST['opcion'];
			$doc=$_REQUEST['docc'];
			$form1='formulariosDOM/presentacion/add_jefe.php';
			$subtitulo='Registrar jefe de zona';
			break;
			case 'EDITJEFE':
			$idpac=$_REQUEST['idpac'];
			$sql="SELECT id_paciente,doc_pac,nom1,nom2,ape1,ape2,dir_pac,tel_pac,nom_completo
						FROM pacientes
						WHERE id_paciente=$idpac";
			$color="yellow";
			$boton="Agregar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$opcion=$_REQUEST['opcion'];
			$doc=$_REQUEST['docc'];
			$form1='formulariosDOM/presentacion/add_jefe.php';
			$subtitulo='Editar jefe de zona';
			break;
		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_paciente"=>"", "tdoc_pac"=>"", "doc_pac"=>"", "nom1"=>"", "nom2"=>"", "ape1"=>"", "ape2"=>"", "fnacimiento"=>"", "edad"=>"",
				"uedad"=>"", "dir_pac"=>"", "tel_pac"=>"", "email_pac"=>"", "estadocivil"=>"", "genero"=>"", "rh"=>"", "etnia"=>"", "lateralidad"=>"",
				"profesion"=>"", "religion"=>"", "fotopac"=>"", "estado_pac"=>"","nom_completo"=>"", "cie"=>"", "descricie"=>"", "zonapac"=>"", "ipsordena"=>"", "tipo"=>"",
				"descri_tipo"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","id_adm_hosp"=>"","id_eps"=>"","id"=>"",
									 	"id_d_aut_dom"=>"", "freg"=>"", "cups"=>"", "procedimiento"=>"",
										"cantidad"=>"", "finicio"=>"", "ffinal"=>"", "num_aut_externa"=>"", "estado_d_aut_dom"=>"");

			}
		}else{
				$fila=array("id_paciente"=>"", "tdoc_pac"=>"", "doc_pac"=>"", "nom1"=>"", "nom2"=>"", "ape1"=>"", "ape2"=>"", "fnacimiento"=>"", "edad"=>"",
				"uedad"=>"", "dir_pac"=>"", "tel_pac"=>"", "email_pac"=>"", "estadocivil"=>"", "genero"=>"", "rh"=>"", "etnia"=>"", "lateralidad"=>"",
				"profesion"=>"", "religion"=>"", "fotopac"=>"", "estado_pac"=>"", "cie"=>"", "descricie"=>"", "zonapac"=>"", "ipsordena"=>"", "tipo"=>"",
				"descri_tipo"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","id_adm_hosp"=>"","id_eps"=>"","id"=>"",
										"id_d_aut_dom"=>"", "freg"=>"", "cups"=>"", "procedimiento"=>"",
 										"cantidad"=>"", "finicio"=>"", "ffinal"=>"", "num_aut_externa"=>"", "estado_d_aut_dom"=>"");
			}

		?>
<?php include ($form1);?>
<?php
}else{
	if ($check=='si') {
		echo'<section>';
		echo '<script>swal("EXCELENTE !!! ","'.$subtitulo.'","success")</script>';
		echo'</section>';
	}if ($check=='no') {
		echo'<section>';
		echo '<script>swal("DEBES REVISAR EL PROCESO !!! ","'.$subtitulo.'","error")</script>';
		echo'</section>';
	}
// nivel 1?>
<section class="panel panel-default">
  <section class="panel-heading">
    <h4>GESTION DE PROFESIONALES EN SERVICIO DOMICILIARIO</h4>
  </section>
	<section class="panel-body">
    <section class="col-md-6">
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
		<section class="col-md-2">
			<button data-toggle="collapse" class="btn btn-success text-center" data-target="#enfermeria"> <span class="fa fa-briefcase-medical fa-2x"></span> Estado<br>Enfermeria</strong></button>
		</section>
		<section class="col-md-2">
			<button data-toggle="collapse" class="btn btn-success text-center" data-target="#terapias"><span class="fa fa-briefcase-medical fa-2x"></span> Estado<br>Terapias</strong></button>
		</section>
		<section class="col-md-2">
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#hosp_pac"><span class="fa fa-hospital-o fa-2x"></span> Pacientes<br>Hospitalizados</strong></button>
			<div id="hosp_pac" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-lg">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Lista de pacientes Hospitalizados en servicio domiciliarios</h4>
			      </div>
			      <div class="modal-body">
			        <?php
							$sql_hosp="SELECT a.nom_completo,doc_pac
												 FROM pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
												 WHERE b.estado_salida='Hospitalizacion'";
												 //echo $sql_hosp;
												if ($tabla_hosp=$bd1->sub_tuplas($sql_hosp)){
								 					foreach ($tabla_hosp as $fila_hosp) {
														echo'
														<section class="panel-body">
															<article class="col-md-6">
																<p><strong>Paciente: </strong> '.$fila_hosp['nom_completo'].'</p>
																<p><strong>Identificación: </strong> '.$fila_hosp['doc_pac'].'</p>
															</article>
															<article class="col-md-6">
																<p class=""><a href="'.PROGRAMA.'?doc='.$fila_hosp["doc_pac"].'&buscar=Consultar&opcion='.$_REQUEST["opcion"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-eye"></span> VER </button></a></p>
															</article>
														</section>';
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
		<section id="enfermeria" class="collapse">
			<table class="table table-bordered">
				<tr>
					<th>#</th>
					<th class="text-primary text-center">PACIENTE</th>
					<th class="text-primary text-center">PROCEDIMIENTO</th>
					<th class="text-primary text-center">AUTORIZADO</th>
					<th class="text-primary text-center">REALIZADO</th>
				</tr>

			<?php
			$sql_enfermeria="SELECT month(current_date),h.nom_eps,b.doc_pac, b.nom_completo,b.tel_pac,b.dir_pac,
															c.tipo_usuario,c.mun_residencia,c.dep_residencia,i.descrimuni,c.zona_residencia,
    													IFNULL(c.id_adm_hosp,0),
															d.id_m_aut_dom,
															IFNULL(e.id_d_aut_dom,0),e.freg, e.cups, e.procedimiento, e.cantidad, e.finicio, e.ffinal,
       												e.num_aut_externa, e.estado_d_aut_dom, e.intervalo,
       												e.temporalidad,
    													cantidad_sesion_dom(e.cups,c.id_adm_hosp,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones
											FROM adm_hospitalario c  INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
    																					 INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom and CURRENT_DATE BETWEEN
                                        CAST(e.finicio AS DATE) AND CAST(e.ffinal  AS DATE))
     																					 INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
    																			 		 INNER JOIN eps h on (h.id_eps = c.id_eps)
    																			 	   LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)

											WHERE c.tipo_servicio= 'Domiciliarios' and c.estado_adm_hosp = 'Activo' and estado_d_aut_dom in (1,2,3) and e.cups='890105' ORDER BY sesiones ASC ";
					$i=1;
				if ($tabla_enfermeria=$bd1->sub_tuplas($sql_enfermeria)){
					foreach ($tabla_enfermeria as $fila_enfermeria) {
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td>
								<p><?php echo $fila_enfermeria['nom_completo'] ?></p>
								<p><?php echo $fila_enfermeria['doc_pac'] ?> </p>
								<p><?php echo $fila_enfermeria['IFNULL(c.id_adm_hosp,0)'] ?> </p>
								<?php
								$user=$_SESSION['AUT']['id_perfil'];
								$turno=$fila_enfermeria['intervalo'];
								if ($user==1) {
									echo'<p><a href="Funcion_base/ajuste_id_d.php?idadmhosp='.$fila_enfermeria['IFNULL(c.id_adm_hosp,0)'].'&doc='.$fila["doc_pac"].'&idd='.$fila_enfermeria['IFNULL(e.id_d_aut_dom,0)'].'&turno='.$fila_enfermeria['intervalo'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-edit"></span> Ajustar ID</button></a></p>';
								}
								 ?>
							</td>
							<td>
								<p class="text-primary"><?php echo $fila_enfermeria['IFNULL(e.id_d_aut_dom,0)'] ?> </p>
								<p> <strong><?php echo $fila_enfermeria['procedimiento'] ?></strong></p>
								<p> <strong>Intervalo</strong>: Turnos <?php echo $fila_enfermeria['intervalo'] ?> Horas</p>
								<p> <strong>Temporalidad</strong>: <?php echo $fila_enfermeria['temporalidad'] ?></p>
								<p> <strong>Fecha inicial</strong>: <?php echo $fila_enfermeria['finicio'] ?></p>
								<p> <strong>Fecha Final</strong>: <?php echo $fila_enfermeria['ffinal'] ?></p>
								<p><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#profesionales_<?php echo $fila_enfermeria['IFNULL(e.id_d_aut_dom,0)'] ?>">Profesionales</button></p>

							</td>
							<td>
								<p><h1 class="text-primary"><strong><?php echo $fila_enfermeria['cantidad'] ?></strong></h1></p>
							</td>
							<td>
								<p><h1 class="text-danger"><strong><?php echo $fila_enfermeria['sesiones'] ?></strong></h1> </p>
							</td>
						</tr>

					<div id="profesionales_<?php echo $fila_enfermeria['IFNULL(e.id_d_aut_dom,0)'] ?>" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Profesionales Que atienden a <?php echo  $fila_enfermeria['nom_completo']?></h4>
								</div>
								<div class="modal-body">
									<?php
									$idd=$fila_enfermeria['IFNULL(e.id_d_aut_dom,0)'];
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
														echo'	<p>No hay profesional asignado</p>';
													}
									?>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
						<?php
					}
				}
			?>
			</table>
		</section><!--Fin de enfermeria-->
		<section id="terapias" class="collapse">
			<table class="table table-bordered">
				<tr>
					<th>#</th>
					<th class="text-primary text-center">PACIENTE</th>
					<th class="text-primary text-center">PROCEDIMIENTO</th>
					<th class="text-primary text-center">AUTORIZADO</th>
					<th class="text-primary text-center">REALIZADO</th>
				</tr>

			<?php
			$sql_profesional="SELECT month(current_date),h.nom_eps,b.doc_pac, b.nom_completo,b.tel_pac,b.dir_pac,
															c.tipo_usuario,c.mun_residencia,c.dep_residencia,i.descrimuni,c.zona_residencia,
    													IFNULL(c.id_adm_hosp,0),
															d.id_m_aut_dom,
															IFNULL(e.id_d_aut_dom,0),e.freg, e.cups, e.procedimiento, e.cantidad, e.finicio, e.ffinal,
       												e.num_aut_externa, e.estado_d_aut_dom, e.intervalo,
       												e.temporalidad,
    													cantidad_sesion_dom(e.cups,c.id_adm_hosp,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones
											FROM adm_hospitalario c  INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
    																					 INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom and CURRENT_DATE BETWEEN
                                        CAST(e.finicio AS DATE) AND CAST(e.ffinal  AS DATE))
     																					 INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
    																			 		 INNER JOIN eps h on (h.id_eps = c.id_eps)
    																			 	   LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)

											WHERE c.tipo_servicio= 'Domiciliarios' and c.estado_adm_hosp = 'Activo' and estado_d_aut_dom in (1,2,3) and e.cups in ('890101','890106','890108','890110','890111','890112','890113') ORDER BY sesiones ASC ";
							$i=1;
				if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
					foreach ($tabla_profesional as $fila_profesional) {
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td>
								<p><?php echo $fila_profesional['nom_completo'] ?></p>
								<p><?php echo $fila_profesional['doc_pac'] ?> </p>
							</td>
							<td>
								<p> <strong><?php echo $fila_profesional['procedimiento'] ?></strong></p>
								<p> <strong>Intervalo</strong>: sesión <?php echo $fila_profesional['intervalo'] ?> minutos</p>
								<p> <strong>Fecha inicial</strong>: <?php echo $fila_profesional['finicio'] ?></p>
								<p> <strong>Fecha Final</strong>: <?php echo $fila_profesional['ffinal'] ?></p>
								<p><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#profesionales_<?php echo $fila_profesional['IFNULL(e.id_d_aut_dom,0)'] ?>">Profesionales</button></p>

							</td>
							<td>
								<p><h1 class="text-primary"><strong><?php echo $fila_profesional['cantidad'] ?></strong></h1></p>
							</td>
							<td>
								<p><h1 class="text-danger"><strong><?php echo $fila_profesional['sesiones'] ?></strong></h1> </p>
							</td>
						</tr>

					<div id="profesionales_<?php echo $fila_profesional['IFNULL(e.id_d_aut_dom,0)'] ?>" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Profesionales Que atienden a <?php echo  $fila_profesional['nom_completo']?></h4>
								</div>
								<div class="modal-body">
									<?php
									$idd=$fila_profesional['IFNULL(e.id_d_aut_dom,0)'];
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
														echo'	<p>No hay profesional asignado</p>';
													}
									?>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
						<?php
					}
				}
			?>
			</table>
		</section>
		<section class="panel-body">
			<article class="col-md-4">
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#pacphd"><span class="fa fa-users"></span> Pacientes PHD</button>
				<div id="pacphd" class="modal fade" role="dialog">
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
			</article>
	 	</section>
    <table class="table table-bordered">
      <tr>
        <td class="info">PACIENTE</td>
        <td class="info">ADMISION</td>
				<td class="info">PROCEDIMIENTOS</td>
      </tr>
      <?php
      $doc=$_REQUEST['doc'];
      if (isset($doc)) {
        $sqlp="SELECT a.id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento,
                        edad, uedad, dir_pac, zonificacion, tel_pac, email_pac, estadocivil,
                        genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac,
                        cie, descricie, zonapac, ipsordena, nom_completo,jefe_zona,
                      c.nom_barrio,
                      d.nom_upz,
                      e.nom_localidad,
											f.nombre
               FROM pacientes a LEFT JOIN barrio c on a.zonificacion=c.id_barrio
                                LEFT JOIN upz d on d.id_upz=c.id_upz
                                LEFT JOIN localidades e on e.id_localidad=d.id_localidad
																LEFT JOIN user f on f.id_user=a.jefe_zona
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
									if ($filap['zonificacion']=='') {
										echo'<p class="alert alert-danger animated bounce text-center"><span class="fa fa-warning"></span> No tiene Zona asignada.
										<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDBARRIO&idpac='.$filap["id_paciente"].'&docc='.$filap['doc_pac'].'">
										<button type="button" class="btn btn-primary">
										<span class="fa fa-plus-circle"></span> Adicionar Barrio</button></a></p>
										';
									}else {
										echo'<p class="text-info"><strong>Barrio:</strong> '.$filap['nom_barrio'].'</p>
												 <p class="text-info"><strong>Localidad:</strong> '.$filap['nom_localidad'].'</p>
												 <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EDITBARRIO&idpac='.$filap["id_paciente"].'&docc='.$filap['doc_pac'].'">
												 <button type="button" class="btn btn-warning">
												 <span class="fa fa-edit"></span> Editar Barrio</button></a></p>';
									}
									if ($filap['jefe_zona']=='1' || $filap['jefe_zona']=='1772' || $filap['jefe_zona']=='1773' || $filap['jefe_zona']=='1774'
											|| $filap['jefe_zona']=='1771'  || $filap['jefe_zona']=='2539'  || $filap['jefe_zona']=='2238' || $filap['jefe_zona']=='1949') {
										echo'<p class="text-info"><strong>Jefe zona:</strong> '.$filap['nombre'].'</p>
												 <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EDITJEFE&idpac='.$filap["id_paciente"].'&docc='.$filap['doc_pac'].'">
												 <button type="button" class="btn btn-warning">
												 <span class="fa fa-edit"></span> Editar Jefe Zona</button></a></p>';
									}else {
										echo'<p class="alert alert-danger animated bounce text-center"><span class="fa fa-warning"></span> No tiene Jefe de zona asignada.
										<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDJEFEZONA&idpac='.$filap["id_paciente"].'&docc='.$filap['doc_pac'].'">
										<button type="button" class="btn btn-primary">
										<span class="fa fa-plus-circle"></span> Adicionar Jefe Zona</button></a></p>';
									}
									$fecha=date('Y-m-d');
									$hora=date('H:i');
									echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#dinvasivo_'.$filap['id_paciente'].'"> Dispositvos Invasivos</button></p>
									<div id="dinvasivo_'.$filap['id_paciente'].'" class="modal fade" role="dialog">
										<div class="modal-dialog">

											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Registro y consulta dispositivos invasivos</h4>
												</div>
												<div class="modal-body">
												<form action="Funcion_base/add_dinvasivo.php" method="POST">
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
															</select>
														</article>
														<article class="col-md-12">
															<label>Observación:</label>
															<textarea class="form-control" name="obs_dinvasivo"></textarea>

															<input type="hidden" name="fecha_dinvasivo" value="'.$fecha.'">
															<input type="hidden" name="hora_dinvasivo" value="'.$hora.'">
															<input type="hidden" name="id_user" value="'.$_SESSION['AUT']['id_user'].'">
															<input type="hidden" name="id_paciente" value="'.$filap['id_paciente'].'">
															<input type="hidden" name="doc" value="'.$filap['doc_pac'].'">
															</select>
														</article>
													</section>
													<section class="panel-body">
														<article class="col-md-12">
															<input type="submit" value="Guardar">
														</article>
													</section>

												</form>';
												$pac=$filap['id_paciente'];
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

						echo'<td>';// seccion de admisión del paciente
									$idpac=$filap['id_paciente'];
									$sql_adm="SELECT a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_servicio,estado_adm_hosp,fegreso_hosp,hegreso_hosp,estado_salida,
																	 b.nom_eps,
																	 c.nom_sedes
														FROM adm_hospitalario a INNER JOIN eps b on a.id_eps=b.id_eps
																										INNER JOIN sedes_ips c on a.id_sedes_ips=c.id_sedes_ips
														WHERE a.id_paciente=$idpac and a.tipo_servicio='Domiciliarios' and estado_adm_hosp='Activo'";
									//echo $sql_adm;
									if ($tabla_adm=$bd1->sub_tuplas($sql_adm)){
										 foreach ($tabla_adm as $fila_adm) {
											 if ($fila_adm['estado_adm_hosp']=='Activo') {
												 echo'<p class="alert alert-info">Paciente <strong>'.$filap['nom1'].' '.$filap['nom2'].' '.$filap['ape1'].' '.$filap['ape2'].'</strong>, Tiene admisión <strong>ACTIVA ('.$fila_adm['id_adm_hosp'].')</strong> en  servicio <strong>'.$fila_adm['tipo_servicio'].'</strong></p>';
												 echo'<p><strong class="text-primary">Ingreso: </strong>'.$fila_adm['fingreso_hosp'].'-'.$fila_adm['hingreso_hosp'].'</p>';
												 echo'<p><strong class="text-primary">EPS: </strong>'.$fila_adm['nom_eps'].'</p>';
												 echo'<p><strong class="text-primary">SEDE: </strong>'.$fila_adm['nom_sedes'].'</p>';
												 echo'<p>
															 <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SALIDA&idpac='.$fila_adm["id_adm_hosp"].'&doc='.$filap["doc_pac"].'&servicio=4">
															 <button type="button" class="btn btn-danger" ><span class="fa fa-sign-out-alt"></span> Definir egreso
															 </button></a>
															</p>';
															$idadm=$fila_adm['id_adm_hosp'];
															$sqlacu="SELECT id_infoacu,nombre_acu,tel_acu,dir_acu,parentesco_acu
																			 FROM info_acudiente
																			 WHERE id_adm_hosp=$idadm";
														//echo $sql_adm;
														if ($tablaacu=$bd1->sub_tuplas($sqlacu)){
															 foreach ($tablaacu as $filaacu) {
																 echo'<ul class="alert alert-success"><u><b>DATOS DE CUIDADOR PRIMARIO</b></u>
																				<li><strong>Cuidador: </strong>'.$filaacu['nombre_acu'].'</li>
																				<li><strong>Contacto y Ubicación: </strong>'.$filaacu['tel_acu'].'-'.$filaacu['dir_acu'].'</li>
																				<li><strong>Parentesco: </strong>'.$filaacu['parentesco_acu'].'</li>
																			</ul>';
																			echo'<article class="col-xs-12">
																						 <button type="button" class="btn btn-info " data-toggle="modal" data-target="#gdocu_'.$fila["id_adm_hosp"].'">Gestor Documental</button>
																					 </article>
																					 <article class="col-xs-12 text-left">';
																					 echo'
																					 <div id="gdocu_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
																						<div class="modal-dialog">

																							<!-- Modal content-->
																							<div class="modal-content">
																								<div class="modal-header">
																									<button type="button" class="close" data-dismiss="modal">&times;</button>
																									<h4 class="modal-title">Gestor Documental </h4>
																								 <p class="text-right"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOC&idpac='.$filap["id_paciente"].'&idadm='.$fila_adm['id_adm_hosp'].'&doc='.$filap["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-success"><span class="fa fa-file-text"></span>Cargar documento Nuevo</button></a></p>
																								</div>
																								<div class="modal-body">';
																								$id=$filap['id_paciente'];
																									 $sql_doc="SELECT id_infodocs,nombre_doc,foto,fcargue FROM info_documentacion
																																	 WHERE id_paciente=$id";
																									 if ($tabla_doc=$bd1->sub_tuplas($sql_doc)){
																										 foreach ($tabla_doc as $fila_doc ) {
																											 echo'<section class="panel-body">';
																												 echo'<article class="col-md-12 ">';
																													 echo'<p><strong>Fecha Registro: </strong>'.$fila_doc['fcargue'].'</p>';
																													 echo'<p><strong>Nombre: </strong>'.$fila_doc['nombre_doc'].'</p>';
																													 echo'<p><a href="'.$fila_doc['foto'].'"><button type="button" class="btn btn-info btn-md" ><span class="fa fa-file-pdf-o"></span> </button></a>
																																	<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=XDOC&idadm='.$fila_adm["id_adm_hosp"].'&docc='.$filap["doc_pac"].'&pac='.$filap["id_paciente"].'">
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

																			echo'</article>';
															 }
														}else {
															echo'<p>
																		<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ACUDIENTE&idadm='.$fila_adm["id_adm_hosp"].'&docc='.$filap["doc_pac"].'">
																		<button type="button" class="btn btn-danger" ><span class="fa fa-users"></span> Agregar Cuidador
																		</button></a>
																	 </p>';
																	 echo'<article class="col-xs-12">
			 																	 <button type="button" class="btn btn-info " data-toggle="modal" data-target="#gdocu_'.$fila["id_adm_hosp"].'">Gestor Documental</button>
			 																 </article>
			 																 <article class="col-xs-12 text-left">';
			 																 echo'
			 																 <div id="gdocu_'.$fila["id_adm_hosp"].'" class="modal fade" role="dialog">
			 																	<div class="modal-dialog">

			 																		<!-- Modal content-->
			 																		<div class="modal-content">
			 																			<div class="modal-header">
			 																				<button type="button" class="close" data-dismiss="modal">&times;</button>
			 																				<h4 class="modal-title">Gestor Documental </h4>
			 																			 <p class="text-right"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOC&idpac='.$filap["id_paciente"].'&idadm='.$fila_adm['id_adm_hosp'].'&doc='.$filap["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-success"><span class="fa fa-file-text"></span>Cargar documento Nuevo</button></a></p>
			 																			</div>
			 																			<div class="modal-body">';
			 																			$id=$filap['id_paciente'];
			 																				 $sql_doc="SELECT id_infodocs,nombre_doc,foto,fcargue FROM info_documentacion
			 																												 WHERE id_paciente=$id";
			 																				 if ($tabla_doc=$bd1->sub_tuplas($sql_doc)){
			 																					 foreach ($tabla_doc as $fila_doc ) {
			 																						 echo'<section class="panel-body">';
			 																							 echo'<article class="col-md-12 ">';
			 																								 echo'<p><strong>Fecha Registro: </strong>'.$fila_doc['fcargue'].'</p>';
			 																								 echo'<p><strong>Nombre: </strong>'.$fila_doc['nombre_doc'].'</p>';
			 																								 echo'<p><a href="'.$fila_doc['foto'].'"><button type="button" class="btn btn-info btn-md" ><span class="fa fa-file-pdf-o"></span> </button></a>
			 																												<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=XDOC&idadm='.$fila_adm["id_adm_hosp"].'&docc='.$filap["doc_pac"].'&pac='.$filap["id_paciente"].'">
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

			 														echo'</article>';
														}
											 } /////////------------------------------------
										 }
									}else {
										echo'<p class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADM&idpac='.$filap["id_paciente"].'&docc='.$filap["doc_pac"].'">
											 <button type="button" class="btn btn-danger" ><span class="fa fa-plus"></span> Agregar Admisión
											 </button></a></p>';
									}
		 				echo'</td>';

						echo'<td>';// seccion de crud para INGRESAR PROCEDIMIENTOS AUTORIZADOS.
									$idadm=$fila_adm['id_adm_hosp'];
									$estado_salida=$fila_adm['estado_salida'];

									if ($estado_salida=='Fallecimiento') {
										echo'<article class="col-md-12">
												 <p>
													<h2><span class="fa fa-dizzy text-danger"></span> Paciente fallecido<h2>
												 </p>
												 </article>';

									}
									$idadm=$fila_adm['id_adm_hosp'];
									if ($estado_salida=='Hospitalizacion') {
										echo'<article class="col-md-12">
												 <p>
													<h2><span class="fa fa-hospital text-danger"></span> Paciente Hospitalizado<h2>
												 </p>
												 <p><a href="Funcion_base/return_hospitalario.php?idadmhosp='.$fila_adm["id_adm_hosp"].'&doc='.$filap["doc_pac"].'&id='.$fila_d['id_d_aut_dom'].'
												 &resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-ban"></span> No estaba muerto <br>Andaba de ...</button></a></p>
												 </article>';
									}
									if ($estado_salida=='') {
										$sqlm="SELECT id_m_aut_dom, id_adm_hosp, id_user, freg, tipo_paciente,
																	zona_paciente, ips_ordena, medico_ordena, estado_p_principal
													 FROM m_aut_dom WHERE id_adm_hosp=$idadm ORDER BY freg DESC";
													 //echo $sqlm;
										if ($tablam=$bd1->sub_tuplas($sqlm)){
											foreach ($tablam as $filam) {

												echo'<section class="panel-body alert alert-info">
															<article class="col-md-12">
															<p>
																# <strong>'.$filam['id_m_aut_dom'].'</strong>. Plan principal agregado el <strong>'.$filam['freg'].' </strong>
																<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#detalle_plan_principal'.$filam['id_m_aut_dom'].'"><span class="fa fa-eye"></span></button>
															</p>
															</article>
															<div id="detalle_plan_principal'.$filam['id_m_aut_dom'].'" class="modal fade" role="dialog">
															<div class="modal-dialog modal-lg">
																<div class="modal-content">
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal">&times;</button>
																		<h4 class="modal-title">DETALLES DE PLAN PRINCIPAL <strong><i class="lead">#</i> '.$filam['id_m_aut_dom'].'</strong></h4>
																	</div>
																	<div class="modal-body">
																	';
																	$idm=$filam['id_m_aut_dom'];
																	$sql_m="SELECT a.id_m_aut_dom, id_adm_hosp, id_user, freg, tipo_paciente,
																								 zona_paciente, ips_ordena, medico_ordena,cdx_presentacion,
																								 dx_presentacion,estado_p_principal,
																								 b.nombre,
																								 c.nomclaseusuario
																				 FROM m_aut_dom a INNER JOIN ips_externa b on a.ips_ordena=b.id_ips_externa
																													INNER JOIN clase_usuario c on c.id_cusuario=a.tipo_paciente
																				 WHERE id_m_aut_dom=$idm
																				 ";
																					//echo $sql_m;
																					if ($tabla_m=$bd1->sub_tuplas($sql_m)){
																						foreach ($tabla_m as $fila_m) {
																								echo'<article>
																											<p><strong>Tipo paciente: </strong><b class="lead">'.$fila_m['nomclaseusuario'].'</b></p>
																											<p><strong>Zona paciente: </strong><b class="lead">'.$fila_m['zona_paciente'].'</b></p>
																											<p><strong>IPS remitente: </strong><b class="lead">'.$fila_m['nom_ips_externa'].'</b></p>
																											<p><strong>Medico que ordena: </strong><b class="lead">'.$fila_m['medico_ordena'].'</b></p>
																											<p><strong>Diagnostico: </strong><b class="lead">'.$fila_m['dx_presentacion'].'</b></p>
																										 </article>';
																						}
																					}
												echo'</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
															</div>
														</div>

													</div>
												</div>';


												echo'<article class="col-md-6">
												<p>
													<button type="button" class="btn btn-info" data-toggle="modal" data-target="#prodDom'.$filam['id_m_aut_dom'].'"><span class="fa fa-flask"></span>Ver<br>Procedimientos</button>
												</p>
												</article>
												<div id="prodDom'.$filam['id_m_aut_dom'].'" class="modal fade" role="dialog">
												<div class="modal-dialog modal-lg">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">PROCEDIMIENTOS AGREGADOS</h4>
														</div>
														<div class="modal-body">
														<table class="table table-bordered">
														<tr>
															<td class="info">PROCEDIMIENTO</td>
															<td class="info">DETALLES</td>
															<td class="info">PROFESIONAL</td>
														</tr>
												';
												$idm=$filam['id_m_aut_dom'];
												$sql_d="SELECT id_d_aut_dom, freg, cups, procedimiento,
																			 cantidad,intervalo,temporalidad, finicio, ffinal, num_aut_externa, estado_d_aut_dom
																FROM d_aut_dom
																WHERE id_m_aut_dom=$idm order by freg DESC";
																//echo $sql_d;
																if ($tabla_d=$bd1->sub_tuplas($sql_d)){
																	foreach ($tabla_d as $fila_d) {

																		$estado_procedimiento=$fila_d['estado_d_aut_dom'];
																		if ($estado_procedimiento==1) {
																			echo'<tr><td colspan="3" class="text-info"><h3>Procedimiento SOLICITADO</h3></td></tr>';
																			echo'<tr>
																			      <td>
																				      <p class="text-danger"><strong>ID:</strong> '.$fila_d['id_d_aut_dom'].'</p>
																				      <p>'.$fila_d['cups'].' | '.$fila_d['procedimiento'].'</p>';
																							$cups=$fila_d['cups'];
																							$d=$fila_d['id_d_aut_dom'];
																							if ($cups=='890101') {
																								$sql_evoluciones="SELECT count(id_hchosp) cuantos FROM hcini_dom WHERE id_d_aut_dom=$d and estado_hchosp='Realizada'";
																								if ($tabla_evoluciones=$bd1->sub_tuplas($sql_evoluciones)){
																									foreach ($tabla_evoluciones as $fila_evoluciones) {
																										$c=$fila_evoluciones['cuantos'];
																										if ($c > 0) {
																											echo'<p>Existen registros en este procedimiento, no puede realizar cancelación del procedimiento.</p>';
																											echo'<h3><strong class="text-danger"> Avance: </strong>'.$c.'</h3>';
																										}else {

																										}
																									}
																								}

																							}
																							if ($cups=='890110') {
																								$sql_evoluciones="SELECT count(id_evofono_dom) cuantos FROM evo_fono_dom WHERE id_d_aut_dom=$d and estado_evofono_dom='Realizada'";
																								if ($tabla_evoluciones=$bd1->sub_tuplas($sql_evoluciones)){
																									foreach ($tabla_evoluciones as $fila_evoluciones) {
																										$c=$fila_evoluciones['cuantos'];
																										if ($c > 0) {
																											echo'<p>Existen registros en este procedimiento, no puede realizar cancelación del procedimiento.</p>';
																											echo'<h3><strong class="text-danger"> Avance: </strong>'.$c.'</h3>';
																										}else {

																										}
																									}
																								}

																							}
																							if ($cups=='890111') {
																								$sql_evoluciones="SELECT count(id_evofisio_dom) cuantos FROM evo_fisio_dom WHERE id_d_aut_dom=$d and estado_evofisio_dom='Realizada'";
																								if ($tabla_evoluciones=$bd1->sub_tuplas($sql_evoluciones)){
																									foreach ($tabla_evoluciones as $fila_evoluciones) {
																										$c=$fila_evoluciones['cuantos'];
																										if ($c > 0) {
																											echo'<p>Existen registros en este procedimiento, no puede realizar cancelación del procedimiento.</p>';
																											echo'<h3><strong class="text-danger"> Avance: </strong>'.$c.'</h3>';
																										}else {

																										}
																									}
																								}

																							}
																							if ($cups=='890112') {
																								$sql_evoluciones="SELECT count(id_evotr_dom) cuantos FROM evo_tr_dom WHERE id_d_aut_dom=$d  and estado_evotr_dom='Realizada'";
																								if ($tabla_evoluciones=$bd1->sub_tuplas($sql_evoluciones)){
																									foreach ($tabla_evoluciones as $fila_evoluciones) {
																										$c=$fila_evoluciones['cuantos'];
																										if ($c > 0) {
																											echo'<p>Existen registros en este procedimiento, no puede realizar cancelación del procedimiento.</p>';
																											echo'<h3><strong class="text-danger"> Avance: </strong>'.$c.'</h3>';
																										}else {

																										}
																									}
																								}

																							}
																							if ($cups=='890113') {
																								$sql_evoluciones="SELECT count(id_evoto_dom) cuantos FROM evo_to_dom WHERE id_d_aut_dom=$d  and estado_evoto_dom='Realizada'";
																								if ($tabla_evoluciones=$bd1->sub_tuplas($sql_evoluciones)){
																									foreach ($tabla_evoluciones as $fila_evoluciones) {
																										$c=$fila_evoluciones['cuantos'];
																										if ($c > 0) {
																											echo'<p>Existen registros en este procedimiento, no puede realizar cancelación del procedimiento.</p>';
																											echo'<h3><strong class="text-danger"> Avance: </strong>'.$c.'</h3>';
																										}else {

																										}
																									}
																								}

																							}
																							$d=$fila_d['id_d_aut_dom'];
																							$t=$fila_d['intervalo'];
																							if ($t==3) {
																								$sql_evoluciones="SELECT count(id_enf_dom3) cuantos FROM enferdom3 WHERE id_d_aut_dom=$d  and estado_nota='Realizada'";
																								if ($tabla_evoluciones=$bd1->sub_tuplas($sql_evoluciones)){
																									foreach ($tabla_evoluciones as $fila_evoluciones) {
																										$c=$fila_evoluciones['cuantos'];
																										if ($c > 0) {
																											echo'<p>Existen registros en este procedimiento, no puede realizar cancelación del procedimiento.</p>';
																											echo'<h3><strong class="text-danger"> Avance: </strong>'.$c.'</h3>';
																										}else {

																										}
																									}
																								}
																							}
																							if ($t==6) {
																								$sql_evoluciones="SELECT count(id_enf_dom6) cuantos FROM enferdom6 WHERE id_d_aut_dom=$d and estado_nota='Realizada'";
																								if ($tabla_evoluciones=$bd1->sub_tuplas($sql_evoluciones)){
																									foreach ($tabla_evoluciones as $fila_evoluciones) {
																										$c=$fila_evoluciones['cuantos'];
																										if ($c > 0) {
																											echo'<p>Existen registros en este procedimiento, no puede realizar cancelación del procedimiento.</p>';
																											echo'<h3><strong class="text-danger"> Avance: </strong>'.$c.'</h3>';
																										}else {

																										}
																									}
																								}
																							}
																							if ($t==8) {
																								$sql_evoluciones="SELECT count(id_enf_dom8) cuantos FROM enferdom8 WHERE id_d_aut_dom=$d and estado_nota='Realizada'";
																								if ($tabla_evoluciones=$bd1->sub_tuplas($sql_evoluciones)){
																									foreach ($tabla_evoluciones as $fila_evoluciones) {
																										$c=$fila_evoluciones['cuantos'];
																										if ($c > 0) {
																											echo'<p>Existen registros en este procedimiento, no puede realizar cancelación del procedimiento.</p>';
																											echo'<h3><strong class="text-danger"> Avance: </strong>'.$c.'</h3>';
																										}else {

																										}
																									}
																								}
																							}
																							if ($t==12) {
																								$sql_evoluciones="SELECT count(id_enf_dom12) cuantos FROM enferdom12 WHERE id_d_aut_dom=$d and estado_nota='Realizada'";
																								if ($tabla_evoluciones=$bd1->sub_tuplas($sql_evoluciones)){
																									foreach ($tabla_evoluciones as $fila_evoluciones) {
																										$c=$fila_evoluciones['cuantos'];
																										if ($c > 0) {
																											echo'<p>Existen registros en este procedimiento, no puede realizar cancelación del procedimiento.</p>';
																											echo'<h3><strong class="text-danger"> Avance: </strong>'.$c.'</h3>';
																										}else {

																										}
																									}
																								}
																							}
																							if ($t==24) {
																								$sql_evoluciones="SELECT count(id_enf_dom12) cuantos FROM enferdom12 WHERE id_d_aut_dom=$d and estado_nota='Realizada'";
																								if ($tabla_evoluciones=$bd1->sub_tuplas($sql_evoluciones)){
																									foreach ($tabla_evoluciones as $fila_evoluciones) {
																										$c=$fila_evoluciones['cuantos'];
																										if ($c > 0) {
																											echo'<p>Existen registros en este procedimiento, no puede realizar cancelación del procedimiento.</p>';
																											echo'<h3><strong class="text-danger"> Avance: </strong>'.$c.'</h3>';
																										}else {

																										}
																									}
																								}
																							}
																			echo'</td>';
																			echo'<td>
																			      <p><strong>Cantidad: </strong> '.$fila_d['cantidad'].'</p>
																						<p><strong>Turno: </strong> '.$fila_d['intervalo'].'</p>
																						<p><strong>Temporalidad: </strong> '.$fila_d['temporalidad'].'</p>
																			      <p><strong>Inicio: </strong> '.$fila_d['finicio'].'</p>
																			      <p><strong>Final: </strong> '.$fila_d['ffinal'].'</p>
																			     </td>
																			     <td>';

																			$idd=$fila_d['id_d_aut_dom'];
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
																			            echo'<p><a href="Funcion_base/borrar_prof_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$filap["doc_pac"].'&id='.$fila_prof['id_prof_d_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-ban"></span> Inactivar</button></a></p>';
																			            echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDPROFESIONAL&idd='.$fila_prof['idd'].'&doc='.$filap["doc_pac"].'&nc='.$filap['nom_completo'].'&servicio='.$fila_adm["tipo_servicio"].'&idadm='.$fila_adm["id_adm_hosp"].'">
																			              <button type="button" class="btn btn-success" >
																			              <span class="fa fa-edit"></span> Otro Profesional?</button>
																			              </a></p>';
																			          }
																			        }else {
																			          echo'	<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDPROFESIONAL&idd='.$fila_d['id_d_aut_dom'].'&doc='.$filap["doc_pac"].'&nc='.$filap['nom_completo'].'&servicio='.$fila_adm["tipo_servicio"].'&idadm='.$fila_adm["id_adm_hosp"].'">
																			            <button type="button" class="btn btn-success" >
																			            <span class="fa fa-edit"></span> Asignar Profesional</button>
																			            </a></p>';
																			        }
																							$autorizacion=$fila_d['num_aut_externa'];
																							if ($autorizacion=='') {
																							
																							}else {
																								echo'<p>
																											Este procedimiento cuenta con el numero de Autorizacion: <strong>'.$fila_d['num_aut_externa'].'</strong>
																										 </p>';
																							}
																			  echo'</td>
																			  </tr>';
																		}
																		if ($estado_procedimiento==2) {
																			echo'<tr><td colspan="3" class="text-info"><h3>Procedimiento AUTORIZADO</h3></td></tr>';
																			echo'<tr>
																			<td>
																			 <p class="text-danger"><strong>ID:</strong> '.$fila_d['id_d_aut_dom'].'</p>
																			 <p>'.$fila_d['cups'].' | '.$fila_d['procedimiento'].'</p>';
															 echo'</td>';
																			echo'<td>
																			<p><strong>Cantidad: </strong> '.$fila_d['cantidad'].'</p>
																			<p><strong>Turno: </strong> '.$fila_d['intervalo'].'</p>
																			<p><strong>Temporalidad: </strong> '.$fila_d['temporalidad'].'</p>
																			<p><strong>Inicio: </strong> '.$fila_d['finicio'].'</p>
																			<p><strong>Final: </strong> '.$fila_d['ffinal'].'</p>
																			     </td>
																			     <td>';

																			$idd=$fila_d['id_d_aut_dom'];
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
																			            echo'<p><a href="Funcion_base/borrar_prof_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$filap["doc_pac"].'&id='.$fila_prof['id_prof_d_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-ban"></span> Inactivar</button></a></p>';
																			            echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDPROFESIONAL&idd='.$fila_prof['idd'].'&doc='.$filap["doc_pac"].'&nc='.$filap['nom_completo'].'&servicio='.$fila_adm["tipo_servicio"].'&idadm='.$fila_adm["id_adm_hosp"].'">
																			              <button type="button" class="btn btn-success" >
																			              <span class="fa fa-edit"></span> Otro Profesional?</button>
																			              </a></p>';
																			          }
																			        }else {
																			          echo'	<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDPROFESIONAL&idd='.$fila_d['id_d_aut_dom'].'&doc='.$filap["doc_pac"].'&nc='.$filap['nom_completo'].'&servicio='.$fila_adm["tipo_servicio"].'&idadm='.$fila_adm["id_adm_hosp"].'">
																			            <button type="button" class="btn btn-success" >
																			            <span class="fa fa-edit"></span> Asignar Profesional</button>
																			            </a></p>';
																			        }
																			  echo'</td>
																			  </tr>';
																		}
																		if ($estado_procedimiento==3) {
																			echo'<tr><td colspan="3" class="text-success"><h3>Procedimiento FACTURADO</h3></td></tr>';
																			echo'<tr>
																			      <td>
																				      <p class="text-danger"><strong>ID:</strong> '.$fila_d['id_d_aut_dom'].'</p>
																				      <p>'.$fila_d['cups'].' | '.$fila_d['procedimiento'].'</p>';
																							$perfil=$_SESSION['AUT']['id_perfil'];
																							if ($perfil==43) {
																								echo'	<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MODFECHA&idd='.$fila_d['id_d_aut_dom'].'&doc='.$filap["doc_pac"].'&nc='.$filap['nom_completo'].'&servicio='.$fila_adm["tipo_servicio"].'&idadm='.$fila_adm["id_adm_hosp"].'">
																									<button type="button" class="btn btn-primary" >
																									<span class="fa fa-exchange-alt"></span> Cambiar fecha</button>
																									</a></p>';
																							}
																			echo'</td>';
																			echo'<td>
																			<p><strong>Cantidad: </strong> '.$fila_d['cantidad'].'</p>
																			<p><strong>Turno: </strong> '.$fila_d['intervalo'].'</p>
																			<p><strong>Temporalidad: </strong> '.$fila_d['temporalidad'].'</p>
																			<p><strong>Inicio: </strong> '.$fila_d['finicio'].'</p>
																			<p><strong>Final: </strong> '.$fila_d['ffinal'].'</p>
																			     </td>
																			     <td>';

																			$idd=$fila_d['id_d_aut_dom'];
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
																			          echo'NO ASIGNO PROFESIONAL';
																			        }
																			  echo'</td>
																			  </tr>';
																		}
																		if ($estado_procedimiento==4) {
																			echo'<tr><td colspan="3"  class="text-warning"><h3>Procedimiento NO AUTORIZADO</h3></td></tr>';
																			echo'<tr>
																			<td>
																			 <p class="text-danger"><strong>ID:</strong> '.$fila_d['id_d_aut_dom'].'</p>
																			 <p>'.$fila_d['cups'].' | '.$fila_d['procedimiento'].'</p>';
															 			 	echo'</td>';
																			echo'<td>
																			<p><strong>Cantidad: </strong> '.$fila_d['cantidad'].'</p>
																			<p><strong>Turno: </strong> '.$fila_d['intervalo'].'</p>
																			<p><strong>Temporalidad: </strong> '.$fila_d['temporalidad'].'</p>
																			<p><strong>Inicio: </strong> '.$fila_d['finicio'].'</p>
																			<p><strong>Final: </strong> '.$fila_d['ffinal'].'</p>
																			     </td>
																			     <td>';

																			$idd=$fila_d['id_d_aut_dom'];
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
																			            echo'<p><a href="Funcion_base/borrar_prof_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&docc='.$filap["doc_pac"].'&id='.$fila_prof['id_prof_d_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-ban"></span> Inactivar</button></a></p>';
																			            echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDPROFESIONAL&idd='.$fila_prof['idd'].'&doc='.$filap["doc_pac"].'&nc='.$filap['nom_completo'].'&servicio='.$fila_adm["tipo_servicio"].'&idadm='.$fila_adm["id_adm_hosp"].'">
																			              <button type="button" class="btn btn-success" >
																			              <span class="fa fa-edit"></span> Otro Profesional?</button>
																			              </a></p>';
																			          }
																			        }else {
																			          echo'	<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADDPROFESIONAL&idd='.$fila_d['id_d_aut_dom'].'&doc='.$filap["doc_pac"].'&nc='.$filap['nom_completo'].'&servicio='.$fila_adm["tipo_servicio"].'&idadm='.$fila_adm["id_adm_hosp"].'">
																			            <button type="button" class="btn btn-success" >
																			            <span class="fa fa-edit"></span> Asignar Profesional</button>
																			            </a></p>';
																			        }
																			  echo'</td>
																			  </tr>';
																		}// fin de evaluacion de estado procedimientos

																	}
																}
												echo '</table></div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
													</div>
												</div>

											</div>
										</div>
										</section>';
											}
											echo'<section class="panel-body">
													 </section>';
										}else {
											echo'<section class="panel-body">
													 </section>';
										}
									}
		 				echo'</td>';
            echo'</tr>';
          }
        }else {
        	echo'<p class="alert alert-danger"><span class="fa fa-info-circle fa-2x"></span> No existe paciente en base de datos <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CREARPACIENTE&idpac='.$filap["id_paciente"].'&docc='.$_REQUEST['doc'].'">
							 <button type="button" class="btn btn-primary" >
							 <span class="fa fa-plus-circle"></span> Crear Paciente</button></a></p>';
        }
      }

			// filtro por nombre pendiente


      ?>
    </table>
  </section>
</section>
	<?php
}
?>
