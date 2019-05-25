<?php
include("config/class.mysql.php");
include("config/class.combos.php");
$selects = new selects();
$paises = $selects->cargarPaises();
foreach($paises as $key=>$value)
{
		echo "<option value=\"$key\">$value</option>";
}
?>
