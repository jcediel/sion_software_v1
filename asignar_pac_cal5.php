
<?php
////////////////// CONEXION A LA BASE DE DATOS //////////////////

$host = 'localhost';
$basededatos = 'emmanuelips';
$usuario = 'root';
$contraseña = '515t3m45';



$conexion = new mysqli($host, $usuario,$contraseña, $basededatos);
if ($conexion -> connect_errno) {
die( "Fallo la conexión : (" . $conexion -> mysqli_connect_errno()
. ") " . $conexion -> mysqli_connect_error());
}
?>

<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].total.value > document.forms[0].total_sesion.value){
					alert("se padso mk");
					document.forms[0].total.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>

<section class="panel panel-default">
  <section class="panel-heading">
    <h4>Asignación de pacientes a calendario de asistencia en servicio REHABILITACIÓN INFANTIL</h4>
  </section>

<?php
$sedes=$_REQUEST['sede'];
if (isset($sedes)) {
?>
<form method='post'>
  <table class="table table-sm table-bordered fixed">
    <tr>
      <td colspan="3"><h4>Está realizando registro de asignación entre el <strong><br><?php echo $_REQUEST['f1'] ?> --- <?php echo $_REQUEST['f2'] ?></strong></h4></td>
      <td colspan="1" class="text-center"><input type="submit" name="insertar" value="Agregar Asignación" class="btn btn-primary"/> </td>
      <td colspan="1" class="text-center"><a class="btn btn-success" href="<?php echo PROGRAMA.'?opcion=98';?>">
        <span class="fa fa-backward"> Regresar a consultar plan general</span></a></td>
    </tr>
  </table>
  <section id="scroll">
		<table class="table table-bordered">
	  <tr>
	  	<?php
	    $f1=$_REQUEST['f1'];
	    $f2=$_REQUEST['f2'];
	    $sql1="SELECT fecha,dia,nom_dia

	           FROM calendar

	           WHERE fecha between '$f1' and '$f2'  order by fecha ASC";
	         //echo $sql1;
	      if ($tabla1=$bd1->sub_tuplas($sql1)){
	        foreach ($tabla1 as $fila1 ) {

	          echo'<th class="danger">'.$fila1['dia'].'<br><small><span class="text-primary">'.$fila1['nom_dia'].'</span></small></th>';
	        }
	      }
	     ?>
		 </tr>
		 <tr>
		 	<td colspan="30" class="alert alert-info"></td>
		 </tr>

	  	<?php
	    $sede=$_REQUEST['sede'];
	    $f1=$_REQUEST['f1'];
	    $f2=$_REQUEST['f2'];
	      $sql="SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
	  								 b.id_adm_hosp,id_eps,
	                   c.total_sesion,total_hora,id_m_plan,
										 d.nom_eps

	  					FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
	  																	left join m_plan c on (c.id_adm_hosp = b.id_adm_hosp)
																			left join eps d on (d.id_eps = b.id_eps)

	  				 WHERE b.id_sedes_ips in ($sede) and b.estado_adm_hosp='Activo'
	  																		 and b.tipo_servicio='Rehabilitacion'
	                                       and c.finicial between '$f1' and '$f2' and total_hora > 0 ORDER BY 2 ASC";
	    			//echo $sql;
					$i=1;
	  if ($tabla=$bd1->sub_tuplas($sql)){
	  	foreach ($tabla as $fila ) {
				$eps=$fila['id_eps'];
				$horas=$fila['total_hora'];
				if ($eps==12) {
					$hora_dia='3.5';
					$dias=round($horas/$hora_dia);
				 echo"<tr >\n";
					echo'<td class="text-left"  colspan="30">';
					echo '<article class="col-xs-4" >
								<p><strong class="text-danger">'.$i++.'</strong> -- <strong>'.$fila['paciente'].'</strong></p>
							 </article>';
					echo '<article class="col-xs-4" >
								<input type="hidden" class="form-control" required name="id_sedes_ips[]" value="'.$fila["id_eps"].'" readonly="readonly">
								<input type="hidden" class="form-control" required name="total_hora[]" value="'.$fila["total_hora"].'" readonly="readonly">
								<label>Total Días Atención:</label>
								<input type="text" class="form-control" required name="tdias[]" value="'.$dias.'" readonly="readonly">
							 </article>';
					echo '<article class="col-xs-4" >
								<label>Total Horas: </label>
								<input type="text" class="form-control" required name="total_hora[]" value="'.$fila["total_hora"].'" readonly="readonly">
							 </article>';
					echo'</td>';
					echo"</tr >\n";
					echo"<tr >\n";
					$sql2="SELECT a.id_m_laboral,lunes,martes,miercoles,jueves,viernes,sabado,l_ma,l_mi,l_ju,l_vi,l_sa,
												b.fecha,b.mes m,año,dia,nom_dia,id_d_laboral

			           FROM dias_laborales_reh a left JOIN calendar b on a.id_m_laboral=b.id_m_laboral

			           WHERE b.fecha between '$f1' and '$f2'
								 GROUP BY id_m_laboral,lunes,martes,miercoles,jueves,viernes,sabado,l_ma,l_mi,l_ju,l_vi,l_sa,
								 					b.fecha,m,año,dia,nom_dia,id_d_laboral";
			         //echo $sql1;
			      if ($tabla2=$bd1->sub_tuplas($sql2)){
			        foreach ($tabla2 as $fila2) {
								$mes_validar=$fila2['m'];
								$ano_validar=$fila2['año'];
								if ($mes_validar==12 && $ano_validar==2017) {
									include("calendario_reh/diciembre_2017.php");
								}
								if ($mes_validar==1 && $ano_validar==2018) {
									include("calendario_reh/enero_2018.php");
								}
								if ($mes_validar==2 && $ano_validar==2018) {
									include("calendario_reh/febrero_2018.php");
								}
								if ($mes_validar==3 && $ano_validar==2018) {
									include("calendario_reh/marzo_2018.php");
								}
								if ($mes_validar==4 && $ano_validar==2018) {
									include("calendario_reh/abril_2018.php");
								}
								if ($mes_validar==5 && $ano_validar==2018) {
									include("calendario_reh/mayo_2018.php");
								}
			        }
			      }

				 echo"</tr >\n";
				 echo"<tr>\n";
				  echo"<td class='alert alert-info' colspan='30'></td>";
				 echo"</tr>\n";
			 }else {
				 $hora_dia='4';
				 $dias=round($horas/$hora_dia);
				echo"<tr >\n";
				 echo'<td class="text-left"  colspan="30">';
				 echo '<article class="col-xs-4" >
							 <p><strong class="text-danger">'.$i++.'</strong> -- <strong>'.$fila['paciente'].'</strong></p>
							</article>';
				 echo '<article class="col-xs-4" >
							 <input type="hidden" class="form-control" required name="id_sedes_ips[]" value="'.$fila["id_eps"].'" readonly="readonly">
							 <input type="hidden" class="form-control" required name="total_hora[]" value="'.$fila["total_hora"].'" readonly="readonly">
							 <label>Total Días Atención:</label>
							 <input type="text" class="form-control" required name="tdias[]" value="'.$dias.'" readonly="readonly">
							</article>';
				 echo '<article class="col-xs-4" >
							 <label>Total Horas: </label>
							 <input type="text" class="form-control" required name="total_hora[]" value="'.$fila["total_hora"].'" readonly="readonly">
							</article>';
				 echo'</td>';
				 echo"</tr >\n";
				 echo"<tr >\n";
				 $sql2="SELECT a.id_m_laboral,lunes,martes,miercoles,jueves,viernes,sabado,l_ma,l_mi,l_ju,l_vi,l_sa,
											 b.fecha,b.mes m,año,dia,nom_dia

								FROM dias_laborales_reh a left JOIN calendar b on a.id_m_laboral=b.id_m_laboral

								WHERE b.fecha between '$f1' and '$f2'
								GROUP BY id_m_laboral,lunes,martes,miercoles,jueves,viernes,sabado,l_ma,l_mi,l_ju,l_vi,l_sa,
												 b.fecha,m,año,dia,nom_dia";
							//echo $sql1;
					 if ($tabla2=$bd1->sub_tuplas($sql2)){
						 foreach ($tabla2 as $fila2) {
							 $mes_validar=$fila2['m'];
							 $ano_validar=$fila2['año'];
							 if ($mes_validar==12 && $ano_validar==2017) {
								 include("calendario_reh/diciembre_2017.php");
							 }
							 if ($mes_validar==1 && $ano_validar==2018) {
								 include("calendario_reh/enero_2018.php");
							 }
							 if ($mes_validar==2 && $ano_validar==2018) {
								 include("calendario_reh/febrero_2018.php");
							 }
							 if ($mes_validar==3 && $ano_validar==2018) {
								 include("calendario_reh/marzo_2018.php");
							 }
							 if ($mes_validar==4 && $ano_validar==2018) {
								 include("calendario_reh/abril_2018.php");
							 }
							 if ($mes_validar==5 && $ano_validar==2018) {
								 include("calendario_reh/mayo_2018.php");
							 }
						 }
					 }

				echo"</tr >\n";
				echo"<tr>\n";
				 echo"<td class='alert alert-info' colspan='30'></td>";
				echo"</tr>\n";
			 }

	  	}
	  }

	  ?>

	  </table>
  </section>

</form>
<?php
}
 ?>

<?php

  //////////////////////// PRESIONAR EL BOTÓN //////////////////////////
  if(isset($_POST['insertar'])) {


      $items1 = ($_POST['id_adm_hosp']);
      $items2 = ($_POST['id_d_laboral']);
			$items3 = ($_POST['resp_reg']);
      $items4 = ($_POST['asistencia']);


      ///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 4 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
      while(true) {

          //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
          $item1 = current($items1);
          $item2 = current($items2);
          $item3 = current($items3);
          $item4 = current($items4);

          ////// ASIGNARLOS A VARIABLES ///////////////////
          $id_adm_hosp=(( $item1 !== false) ? $item1 : ", &nbsp;");
          $id_m_laboral=(( $item2 !== false) ? $item2 : ", &nbsp;");
          $resp_reg=(( $item3 !== false) ? $item3 : ", &nbsp;");
          $asistencia=(( $item4 !== false) ? $item4 : ", &nbsp;");

            //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
            $valores='("'.$id_adm_hosp.'","'.$id_m_laboral.'","'.$resp_reg.'","'.$asistencia.'"),';

            //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
            $valoresQ= substr($valores, 0, -1);

            ///////// QUERY DE INSERCIÓN ////////////////////////////

              $sql = "INSERT INTO historico_asistencia_reh (id_adm_hosp, id_d_laboral, resp_reg, asistencia)
            VALUES $valoresQ";
              //echo $sql;

            $sqlRes=$conexion->query($sql) or mysql_error();

              // Up! Next Value
              $item1 = next($items1);
              $item2 = next($items2);
              $item3 = next($items3);
              $item4 = next($items4);

              // Check terminator
              if($item1 === false && $item2 === false && $item3 === false && $item4 === false ) break;
      }
  }

?>
</section>

</body>

</html>
