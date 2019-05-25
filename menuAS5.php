<?php
defined("CLAVE5") or die ("Acceso No Autorizado");

$bd1=new subase();
$sql="SELECT m.id_menu,titulo,grupo from aux_perfiles_menus a LEFT JOIN menu m ON a.id_menu=m.id_menu where a.id_perfil=".$_SESSION["AUT"]["id_perfil"]." and m.grupo='Asistencial'";
//echo "$sql";
if ($tabla=$bd1->sub_tuplas($sql))
{
	foreach ($tabla as $fila)
	{
		echo '<a  href="'.PROGRAMA.'?opcion='.$fila["id_menu"].'"><span class="fa fa-h-square"></span> '.$fila["titulo"].'</a></br>';
	}
}else
{
	echo"Upsss!!! No tienes opciones de menú, Comunicate con el departamento TIC.";
}

?>
