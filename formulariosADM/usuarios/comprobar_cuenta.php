<?php
sleep(1);
include('config.php');
if($_REQUEST) {
    $username = $_REQUEST['username'];
    $query = "SELECT * from user where cuenta = '".strtolower($username)."'";
    $results = mysql_query( $query) or die('ok');

    if(mysql_num_rows(@$results) > 0)
        echo '<div id="Error"><p class="alert alert-danger fa fa-times-circle"> Usuario ya existente</p></div>';
    else
        echo '<div id="Success"><p class="alert alert-success fa fa-check-circle"> Usuario Disponible</p></div>';
}
?>
