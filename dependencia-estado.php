<?php
include("config/class.mysql.php");
include("config/class.combos.php");
$estados = new selects();
$estados->code = $_GET["code"];
$estados = $estados->cargarEstados();
foreach($estados as $key=>$value)
{
		echo "<option value=\"$key\">$value</option>";
}
?>
