<?php
include "class.phpmailer.php";
include "class.smtp.php";
$email_user = "referencia@emmanuelips.com";
$email_password = "Em@nueL123456";
$the_subject = "PRUEBA PRUEBA PRUEBA PRUEBA -- CC: 3030";
$address_to = "sistemas2@emmanuelips.com";
$address_to2 = "facturacionycartera@emmanuelips.com";
$from_name = "CLINICA CONSORCIO EMMANUEL";
$phpmailer = new PHPMailer();
// ---------- datos de la cuenta de Gmail -------------------------------
$phpmailer->Username = $email_user;
$phpmailer->Password = $email_password;
//-----------------------------------------------------------------------
//$phpmailer->SMTPDebug = 1;
$phpmailer->SMTPSecure = 'STARTTLS';
$phpmailer->Host = "smtp.emmanuelips.com"; // GMail
$phpmailer->Port = 25;
$phpmailer->IsSMTP(); // use SMTP
$phpmailer->SMTPAuth = true;
$phpmailer->setFrom($phpmailer->Username,$from_name);
$phpmailer->AddAddress($address_to,$address_to2); // recipients email
$phpmailer->Subject = $the_subject;
$phpmailer->Body .= "<p>Cordial saludo</p>
                     <p>Se acepta paciente en Sede Facatativá Vereda los manzanos Km3 Vía Florida Anolaima.  Requiere autorización para hospitalización en unidad de salud mental.  Debe acudir en compañía de familiar. Aceptado por el DR DAVID RODRIGUEZ</p>";
$phpmailer->Body .= "<p>Fecha y Hora: ".date("d-m-Y h:i:s")."</p>";
$phpmailer->IsHTML(true);
$phpmailer->Send();
?>
