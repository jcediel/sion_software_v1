<?php

        $id_cuestionario=$_POST['id_cuestionario'];
      	$freg_rta=date('Y-m-d');
      	$hreg_rta=date('H:i');
      	$resp_contesta=$_POST['resp_contesta'];
      	$rta1=$_POST['rta1'];
      	$rta2=$_POST['rta2'];
      	$rta3=$_POST['rta3'];
      	$rta4=$_POST['rta4'];
      	$rta5=$_POST['rta5'];

      	include('conexion.php');
      $hoy=date('Y-m-d');
      	$sql_borrar="INSERT INTO respuesta_cuestionario (id_cuestionario, freg_rta,hreg_rta,resp_contesta, rta1,
      																								 rta2, rta3, rta4,rta5)
      							 VALUES ('$id_cuestionario','$freg_rta','$hreg_rta','$resp_contesta','$rta1','$rta2','$rta3','$rta4','$rta5')";

      	$conex->query($sql_borrar);
      	if($conex->errno) die($conex->error);

      	mysqli_close($conex);

?>
<script language = javascript>
alert("Cuestionario resuelto con exito")
location.href = "../aplicacion5.php"
</script>
