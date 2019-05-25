<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=facatativa.xls");
header("Pragma: no-cache");
header("Expires: 0");

if (isset($_POST['facatativa']) && $_POST['facatativa'] != '') echo $_POST['facatativa'];
?>
