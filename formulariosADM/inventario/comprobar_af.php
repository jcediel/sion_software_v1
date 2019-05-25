<?php
sleep(1);
include('config.php');
if($_REQUEST) {
    $username = $_REQUEST['username'];
    $query = "SELECT a.activo_fijo afe, a.categoria_equipo,a.marca_equipo,
                    b.categoria_periferico, b.activo_fijo afp
              FROM equipo_inv a inner JOIN perifericos b on (a.id_equipo=b.id_equipo)
              WHERE a.activo_fijo = '".strtolower($username)."' or b.activo_fijo = '".strtolower($username)."'";
    $results = mysql_query( $query) or die('ok');

    if(mysql_num_rows(@$results) > 0)
        echo '<div id="Error"><p class="alert alert-danger fa fa-times-circle"> Activo fijo ya existente</p></div>';
    else
        echo '<div id="Success"><p class="alert alert-success fa fa-check-circle"> Activo fijo Disponible</p></div>';
}
?>
