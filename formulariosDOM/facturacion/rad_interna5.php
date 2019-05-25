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
    <h4>RADICACIÓN INTERNA DE SOPORTES</h4>
  </section>
	<section class="panel-body">
    <section class="col-md-6">
			<section class="col-md-12">
				<form>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
                <input type="date" class="form-control" name="f1" vlaue="<?php echo date('Y-m-01')?>" aria-describedby="basic-addon1">
							</div><!-- /input-group -->
              <div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
                <input type="date" class="form-control" name="f2" vlaue="<?php echo date('Y-m-31')?>" aria-describedby="basic-addon1">
							</div><!-- /input-group -->
						</div><!-- /.col-lg-6 -->
						<div class="col-md-6">
							<div class="input-group">
								<input type="text" class="form-control" name="doc" placeholder="Documento">
								<span class="input-group-btn">
										<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
										<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
								</span>
							</div><!-- /input-group -->
						</div>

						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><span class="fa fa-user-md"></span></span>
                <select class="form-control" name="tprofesional">
                  <option value=""></option>
                  <option value="1">Medicos</option>
                  <option value="2">Terapeutas</option>
                  <option value="3">Enfermeria</option>
                </select>
							</div>
						</div>
					</div>
				</form>
			</section>
		</section>
  </section>
  <section class="panel-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <td class="info">PROFESIONAL</td>
          <td class="info">PACIENTE</td>
        </tr>
      </thead>
      <tbody>
      <?php
        $doc=$_REQUEST['doc'];
				if (isset($doc)) {
					if ($doc=='') {
						$profesional=$_GET['tprofesional'];
						if ($profesional==1) {
							$prof_validar=40;
						}
						if ($profesional==2) {
							$prof_validar='21,22,23,24,25,31,32,33,34,37';
						}
						if ($profesional==3) {
							$prof_validar=70;
						}
						$sql_profesionales="SELECT a.id_user, nombre,
																			 cuenta, clave, foto, email, tdoc, doc, dir_user, tel_user, rm_profesional,
																			 especialidad, firma, estado,jz, supernum ,
																			 b.nombre_perfil
																FROM user a INNER JOIN perfil b on b.id_perfil=a.id_perfil
																WHERE a.estado='Activo' and a.id_perfil in ($prof_validar)
																ORDER by especialidad ASC";
					}else {
						$doc=$_REQUEST['doc'];
							$sql_profesionales="SELECT a.id_user, nombre,
																				 cuenta, clave, foto, email, tdoc, doc, dir_user, tel_user, rm_profesional,
																				 especialidad, firma, estado,jz, supernum ,
																				 b.nombre_perfil
																	FROM user a INNER JOIN perfil b on b.id_perfil=a.id_perfil
																	WHERE a.estado='Activo'  and a.doc='$doc'
																	ORDER by especialidad ASC";

					}
					if ($tabla_profesionales=$bd1->sub_tuplas($sql_profesionales)){
						foreach ($tabla_profesionales as $fila_profesionales) {
							echo"<tr>\n";
							echo'<td class="text-left">
										<h3>'.$fila_profesionales["nombre"].'</h3>
										<p>'.$fila_profesionales["doc"].'</p>
										<p><strong>Tel: </strong>: '.$fila_profesionales["tel_user"].'</p>
										<p><strong>Dirección: </strong> '.$fila_profesionales["dir_user"].'</p>
										<p><strong>Email: </strong> '.$fila_profesionales["email"].'</p>
										<p><strong>RM: </strong> '.$fila_profesionales["rm_profesional"].'</p>
										<p><strong>Especialidad: </strong> '.$fila_profesionales["especialidad"].'</p>
									 </td>
									 <td>';
									 $user=$fila_profesionales['id_user'];
									 $f1=$_GET['f1'];
									 $f2=$_GET['f2'];
									 $sql_detalle="SELECT h.nom_eps,b.tdoc_pac,b.doc_pac, b.nom_completo,b.tel_pac,b.dir_pac,
									 								 c.tipo_usuario,b.zonificacion,
																	 c.mun_residencia,c.dep_residencia,i.descrimuni,c.zona_residencia,
																	 c.id_adm_hosp,d.id_m_aut_dom,e.id_d_aut_dom,
																	 e.freg, e.cups, e.procedimiento, e.cantidad, e.finicio, e.ffinal,
																	 e.num_aut_externa, e.estado_d_aut_dom, e.intervalo,
																	 e.temporalidad,
																	 g.nombre profesional,id_prof_d_dom,
																	 j.nom_sedes,
																	 k.nomclaseusuario,
																	 cantidad_sesion_dom(e.cups,c.id_adm_hosp,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones

																	 from adm_hospitalario c INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
																	 												 INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom and ffinal BETWEEN '$f1' AND '$f2')
																		 										 	 INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
																		 										 	 INNER JOIN eps h on (h.id_eps = c.id_eps)
																		 									 		 INNER JOIN sedes_ips j on (j.id_sedes_ips = c.id_sedes_ips)
																		 								 		   INNER  JOIN profesional_d_dom f on (f.id_d_aut_dom = e.id_d_aut_dom)
																		 							 		     LEFT  JOIN user g on (g.id_user = f.profesional)
																		 						 		       LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)
																													 LEFT  JOIN clase_usuario k on (k.id_cusuario = d.tipo_paciente)
																		where c.tipo_servicio = 'Domiciliarios' and c.estado_adm_hosp = 'Activo'
																		 																				and f.profesional=$user
																																						and f.estado_profesional=1";
																		//echo $sql_detalle;
										 if ($tabla_detalle=$bd1->sub_tuplas($sql_detalle)){
											 foreach ($tabla_detalle as $fila_detalle) {
												 echo'<p><button data-toggle="collapse" class="btn btn-primary" data-target="#procedimiento_'.$fila_detalle['id_d_aut_dom'].'">'.$fila_detalle['nom_completo'].'  <span class="fa fa-arrow-down fa-2x"></span></button></p>
														<div id="procedimiento_'.$fila_detalle['id_d_aut_dom'].'" class="collapse">';
														?>
														<p class="text-primary"><strong>ID: </strong> <?php echo $fila_detalle['id_d_aut_dom'] ?></p>
														<p><strong>Procedimiento: </strong> <?php echo $fila_detalle['procedimiento'] ?></p>
														<p><strong>Vigencia: </strong> <?php echo $fila_detalle['finicio'].' - '.$fila_detalle['ffinal'] ?></p>
														<p><strong>Turno: </strong> <?php echo $fila_detalle['intervalo'] ?> Horas</p>
														<p><strong>Temporalidad: </strong> <?php echo $fila_detalle['temporalidad'] ?></p>
														<p class="lead"><strong class="text-primary">Tipo Paciente: </strong> <?php echo $fila_detalle['nomclaseusuario'] ?></p>
														<p class="lead text-success"><strong># autorizado: </strong> <?php echo $fila_detalle['cantidad'] ?></p>
														<p class="lead text-danger"><strong># Realizado: </strong> <?php echo $fila_detalle['sesiones'] ?></p>
														<?php

														$tp=$_GET['tprofesional'];
														if ($tp!='') {
															if ($tp==1) {
																echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_medico_'.$fila_detalle['id_d_aut_dom'].'">
																			<span class="fa fa-search"></span> Consultar<br>Evoluciones</button>
																		    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#registro_medico_'.$fila_detalle['id_d_aut_dom'].'">
																			<span class="fa fa-hashtag"></span> Registar<br>Total</button>
																		 </p>';
																				include('medico_dom1.php');
																				include('notas_radicadas_medico.php');
															}
															if ($tp==2) {
																echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_terapeuta_'.$fila_detalle['id_d_aut_dom'].'"><span class="fa fa-search"></span> Consultar<br>Evoluciones</button>
																				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#registro_terapeuta_'.$fila_detalle['id_d_aut_dom'].'"><span class="fa fa-hashtag"></span> Registar<br>Total</button></p>';
																				include('terapeuta_dom1.php');
																				include('notas_radicadas_terapeuta.php');
															}
															if ($tp==3) {
																echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle['id_d_aut_dom'].'"><span class="fa fa-search"></span> Consultar<br>Registros</button>
																				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#registro_'.$fila_detalle['id_d_aut_dom'].'"><span class="fa fa-hashtag"></span> Registar<br>Notas</button></p>';
																include('enfermeria_dom1.php');
																include('notas_radicadas_enfermeria.php');
															}
														}
														$doc=$_GET['doc'];
														if ($doc!='') {
															$especialidad=$fila_profesionales["especialidad"];

															if ($especialidad=='Medico General') {
																echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_medico_'.$fila_detalle['id_d_aut_dom'].'">
																			<span class="fa fa-search"></span> Consultar<br>Evoluciones</button>
																		    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#registro_medico_'.$fila_detalle['id_d_aut_dom'].'">
																			<span class="fa fa-hashtag"></span> Registar<br>Total</button>
																		 </p>';
																				include('medico_dom1.php');
																				include('notas_radicadas_medico.php');
															}
															if ($especialidad=='FISIOTERAPIA' || $especialidad=='FONOAUDIOLOGIA' || $especialidad=='TERAPIA OCUPACIONAL' || $especialidad=='PSICOLOGIA' || $especialidad=='NUTRICION' ) {
																echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_terapeuta_'.$fila_detalle['id_d_aut_dom'].'"><span class="fa fa-search"></span> Consultar<br>Evoluciones</button>
																				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#registro_terapeuta_'.$fila_detalle['id_d_aut_dom'].'"><span class="fa fa-hashtag"></span> Registar<br>Total</button></p>';
																				include('terapeuta_dom1.php');
																				include('notas_radicadas_terapeuta.php');
															}
															if ($especialidad=='Aux. Enfermeria') {
																echo'<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consulta_notas_'.$fila_detalle['id_d_aut_dom'].'"><span class="fa fa-search"></span> Consultar<br>Registros</button>
																				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#registro_'.$fila_detalle['id_d_aut_dom'].'"><span class="fa fa-hashtag"></span> Registar<br>Notas</button></p>';
																include('enfermeria_dom1.php');
																include('notas_radicadas_enfermeria.php');
															}
														}

														// configurar boton de cierre de radicado
												echo'</div>';
											 }
										 }else {
											echo '<p class="alert alert-danger animated bounceLeft">El profesional NO tiene Pacientes o procedimientos asignados en estas fechas '.$_GET['f1'].'--'.$_GET['f2'].'</p>';
										 }
										 echo'</td>';
							echo"</tr>\n";
						}
					}else {
						echo '<p class="alert alert-danger animated bounceLeft">El profesional consultado no existe en base de datos</p>';
					}

				}
      ?>
      </tbody>
    </table>
  </section>
</section>
	<?php
}
?>
