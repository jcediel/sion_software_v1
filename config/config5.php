<?php
$bd="mysql";
//$bd="postgresql";
switch ($bd) {
	case 'mysql':
		define("IP_SERVER","localhost" );
		define("USER_DB", "root");
		define("PASSWORD_DB","515t3m45" );
		define("DB", "emmanuelips");
		define("PORT", "3306");
		define("DRIVER", "mysqli.class.php");
		break;
	case 'postgresql':
		define("IP_SERVER","127.0.0.1" );
		define("USER_DB", "postgres");
		define("PASSWORD_DB","2491770" );
		define("DB", "vacaciones");
		define("PORT", "5432");
		define("DRIVER", "posgresql.class.php");
		break;
}

define("VERSION", 5);
define("LOGINI","index.php");
define("PROGRAMA","aplicacion" .VERSION.".php");
define("SOFTWARE","SION software");
define("EMPRESA","SION software de información Emmanuel");
define("AUTOR","Edgar Alberto Malagón Gaitán - &copy;");
define("WEB","/var/www/html/consorcio/");
define("WEBE","/var/www/html/");               ///opt/lampp/htdocs/nombre correspondiente/        /var/www/html/
define("FOTOS","user_foto/");
define("SOPLAB","soportelab/");
define("SOPREF","soporteReferencia/");
define("DOCPAC","docpaciente/");
define("SHDESK","soporte_hdesk/");
define("SANUNCIO","soporte_anuncio/");
define("FIR","/var/www/html/consorcio/");               ///opt/lampp/htdocs/nombre correspondiente/        /var/www/html/
define("FIRMAS","firmas/");
define("LOG","/var/www/html/consorcio/");               ///opt/lampp/htdocs/nombre correspondiente/        /var/www/html/
define("LOGOS","logos/");
define("FCON","/var/www/html/consorcio/");
define("MIPRES","mipres/");               ///opt/lampp/htdocs/nombre correspondiente/        /var/www/html/
define("CONDUCTOR","fconductor/");
define("IVEHI","/var/www/html/consorcio/");               ///opt/lampp/htdocs/nombre correspondiente/        /var/www/html/
define("VEHICULOS","ivehiculos/");
define("PLANILLA","planillas/");
define("PACIENTES","fotopaciente/");
define("PQ","/var/www/html/consorcio/");
define("PQRS","pqrssoportes/");
define("SOPORTE","soportesPESV/");
define("CLAVE5","123");
define('DURACION_SESION','7200'); //2 horas

require_once(DRIVER);

define("CODEC", "utf8");
?>
