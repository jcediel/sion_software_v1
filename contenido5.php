<?php
defined("CLAVE5") or die ("Acceso No Autorizado");
echo $error1;

if (isset($_REQUEST["opcion"])){
	//$sql="SELECT modulo from menus where id=".$_GET["opcion"];

	$sql="SELECT modulo from aux_perfiles_menus a LEFT JOIN menu m ON a.id_menu=m.id_menu
	where a.id_perfil=".$_SESSION["AUT"]["id_perfil"]." AND a.id_menu=".$_REQUEST["opcion"];


	if ($fila=$bd1->sub_fila($sql)){
		include ($fila["modulo"].VERSION.".php");
	}else{
		?>
		<img src="images/denegado.png" width="100%" alt="pitbull" />
		<?php
	}
}else{
	if ($_SESSION['AUT']['id_perfil']=='10'  || $_SESSION['AUT']['id_perfil']=='49' ||
			$_SESSION['AUT']['id_perfil']=='74'  || $_SESSION['AUT']['id_perfil']=='73' || $_SESSION['AUT']['id_perfil']=='41' || $_SESSION['AUT']['id_perfil']=='1' ) {

			include("tablero/admisiones.php");

	}
	if ($_SESSION['AUT']['id_perfil']=='21' || $_SESSION['AUT']['id_perfil']=='22' || $_SESSION['AUT']['id_perfil']=='23' ||
			$_SESSION['AUT']['id_perfil']=='24'  || $_SESSION['AUT']['id_perfil']=='25' || $_SESSION['AUT']['id_perfil']=='26' ||
			$_SESSION['AUT']['id_perfil']=='27' || $_SESSION['AUT']['id_perfil']=='28' || $_SESSION['AUT']['id_perfil']=='31' ||
			$_SESSION['AUT']['id_perfil']=='32' || $_SESSION['AUT']['id_perfil']=='33' || $_SESSION['AUT']['id_perfil']=='34' || $_SESSION['AUT']['id_perfil']=='48') {

			include("tablero/profesionales_dom.php");

	}
	if ($_SESSION['AUT']['id_perfil']=='70' ) {

			include("tablero/aux_enfermeria_dom.php");

	}
	if ($_SESSION['AUT']['id_perfil']=='45' ) {

			include("tablero/coordinador_dom.php");

	}
	if ($_SESSION['AUT']['id_perfil']=='46' ) {

			include("tablero/coordinador_dom_enfermeria.php");

	}
	if ($_SESSION['AUT']['id_perfil']=='94' ) {

			include("tablero/cocina.php");

	}
}
?>
