
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
    <h4>Registro de sesiones autorizadas REHABILITACIÓN INFANTIL</h4>
  </section>

<?php
$sedes=$_REQUEST['sede'];
if (isset($sedes)) {
?>
<form method='post'>
  <table class="table table-bordered">
    <tr>
      <td colspan="3"><h4>Está realizando registro de sesiones entre el <strong><?php echo $_REQUEST['f1'] ?> --- <?php echo $_REQUEST['f2'] ?></strong></h4></td>
      <td colspan="1" class="text-center"><input type="submit" name="insertar" value="Agregar Sesiones" class="btn btn-primary"/> </td>
      <td colspan="1" class="text-center"><a class="btn btn-success" href="<?php echo PROGRAMA.'?opcion=30';?>">
        <span class="fa fa-backward"> Regresar a consultar plan general</span></a></td>
    </tr>
  </table>
  <table class="table table-bordered">
  	<thead class="thead-inverse ">

			<tr>
				<th>#</th>
				<th>PACIENTE</th>
				<th>TOTAL<br>SESIONES</th>
				<th>Fisio</th>
        <th>Fono</th>
        <th>TO</th>
        <th>Psico</th>
        <th>Equino</th>
        <th>Hidro</th>
        <th>TAP</th>
        <th>Cog</th>
        <th>Musico</th>
        <th>Sombra</th>

			</tr>
  	</thead>
  	<?php
    $sede=$_REQUEST['sede'];
    $f1=$_REQUEST['f1'];
    $f2=$_REQUEST['f2'];
      $sql="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
  								 b.id_adm_hosp,
                   c.total_sesion,id_m_plan

  					FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
  																	left join m_plan c on (c.id_adm_hosp = b.id_adm_hosp)

  				 WHERE b.id_sedes_ips in ($sede) and b.estado_adm_hosp='Activo'
  																		 and b.tipo_servicio='Rehabilitacion'
                                       and c.finicial between '$f1' and '$f2' and total_hora > 0 order by 5 ASC";
    			echo $sql;

				$i=1;
  if ($tabla=$bd1->sub_tuplas($sql)){
  	foreach ($tabla as $fila ) {
  				echo"<tr >\n";
              echo'<th class="text-center">
                      <p>'.$i++.'</p>
                      <p><input type="checkbox" checked  name="condiciones" value="1"></p>
                   </th>';
  							echo'<td class="text-left">';
								echo '<article class="col-xs-6"><p>'.$fila['nom1'].' '.$fila['nom2'].' '.$fila['ape1'].' '.$fila['ape2'].'<br><strong>'.$fila['tdoc_pac'].': </strong>'.$fila['doc_pac'].'</p></article>';
  							echo'<article class="col-xs-2">
											<input type="hidden" class="form-control" required name="id_m_plan[]" value="'.$fila["id_m_plan"].'" readonly="readonly">
										 </article>';
  							echo'</td>';
                echo'<td class="text-center">
                        <input type="text" class="form-control" required name="total_sesion[]" value="'.$fila["total_sesion"].'" readonly="readonly"><br>
                        <label id="spTotal"></label>
                     </td>';
                echo'<td class="text-center">
                      <input type="text" class="form-control" required name="sesion_fisio[]" value="0" >
                      <input type="hidden" class="form-control" id="txt_campo_1" required name="cups_fisio[]" value="931000" >
                     </td>';
                echo'<td class="text-center">
                      <input type="text" class="form-control" required name="sesion_fono[]" value="0" >
                      <input type="hidden" class="form-control" id="txt_campo_2" required name="cups_fono[]" value="937000" >
                     </td>';
                echo'<td class="text-center">
                      <input type="text" class="form-control" required name="sesion_to[]" value="0" >
                      <input type="hidden" class="form-control" id="txt_campo_3" required name="cups_to[]" value="938300" >
                     </td>';
                echo'<td class="text-center">
                      <input type="text" class="form-control" required name="sesion_psico[]" value="0" >
                      <input type="hidden" class="form-control" id="txt_campo_4" required name="cups_psico[]" value="943102" >
                     </td>';
                echo'<td class="text-center">
                      <input type="text" class="form-control" required name="sesion_hidro[]" value="0" >
                      <input type="hidden" class="form-control" id="txt_campo_5" required name="cups_hidro[]" value="933300" >
                     </td>';
                echo'<td class="text-center">
                      <input type="text" class="form-control" required name="sesion_equino[]" value="0" >
                      <input type="hidden" class="form-control" id="txt_campo_6" required name="cups_equino[]" value="EMM001" >
                     </td>';
                echo'<td class="text-center">
                      <input type="text" class="form-control" required name="sesion_tap[]" value="0" >
                      <input type="hidden" class="form-control" id="txt_campo_7" required name="cups_tap[]" value="EMM002" >
                     </td>';
                echo'<td class="text-center">
                      <input type="text" class="form-control" required name="sesion_cog[]" value="0" >
                      <input type="hidden" class="form-control" id="txt_campo_8" required name="cups_cog[]" value="EMM003" >
                     </td>';
                echo'<td class="text-center">
                      <input type="text" class="form-control" required name="sesion_musico[]" value="0" >
                      <input type="hidden" class="form-control" id="txt_campo_9" required name="cups_musico[]" value="EMM004" >
                     </td>';
                echo'<td class="text-center">
                      <input type="text" class="form-control" id="txt_campo_10" required name="sesion_sombra[]" value="0" >
                      <select class="form-control" required name="cups_sombra[]">
                        <option value="0">SIN SOMBRA</option>
                        <option value="EMM005">Acompañamiento sombra 1</option>
                        <option value="EMM006">Acompañamiento sombra 2</option>
                        <option value="EMM007">Acompañamiento sombra 3</option>
                        <option value="EMM008">Acompañamiento sombra 4</option>
                        <option value="EMM009">Acompañamiento sombra 5</option>
                        <option value="EMM0010">Acompañamiento sombra 6</option>
                        <option value="EMM0011">Acompañamiento sombra 7</option>
                        <option value="EMM0012">Acompañamiento sombra 8</option>
                        <option value="EMM0013">Acompañamiento sombra 9</option>
                        <option value="EMM0014">Acompañamiento sombra 10</option>
                      </select>
                     </td>';
            echo"</tr >\n";


  	}
  }

  ?>

  </table>

</form>
<?php
}
 ?>

<?php

  //////////////////////// PRESIONAR EL BOTÓN //////////////////////////
  if(isset($_POST['insertar']) && $_POST['condiciones']==1) {


      $items1 = ($_POST['id_m_plan']);
      $items2 = ($_POST['cups_fisio']);
      $items3 = ($_POST['sesion_fisio']);
      $items4 = ($_POST['cups_fono']);
      $items5 = ($_POST['sesion_fono']);
      $items6 = ($_POST['cups_to']);
      $items7 = ($_POST['sesion_to']);
      $items8 = ($_POST['cups_psico']);
      $items9 = ($_POST['sesion_psico']);
      $items10 = ($_POST['cups_hidro']);
      $items11 = ($_POST['sesion_hidro']);
      $items12= ($_POST['cups_equino']);
      $items13 = ($_POST['sesion_equino']);
      $items14 = ($_POST['cups_tap']);
      $items15 = ($_POST['sesion_tap']);
      $items16 = ($_POST['cups_cog']);
      $items17 = ($_POST['sesion_cog']);
      $items18 = ($_POST['cups_musico']);
      $items19 = ($_POST['sesion_musico']);
      $items20 = ($_POST['cups_sombra']);
      $items21 = ($_POST['sesion_sombra']);
      $items22 = ($_POST['total_sesion']);


      ///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 4 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
      while(true) {

          //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
          $item1 = current($items1);
          $item2 = current($items2);
          $item3 = current($items3);
          $item4 = current($items4);
          $item5 = current($items5);
          $item6 = current($items6);
          $item7 = current($items7);
          $item8 = current($items8);
          $item9 = current($items9);
          $item10 = current($items10);
          $item11 = current($items11);
          $item12 = current($items12);
          $item13 = current($items13);
          $item14 = current($items14);
          $item15 = current($items15);
          $item16 = current($items16);
          $item17 = current($items17);
          $item18 = current($items18);
          $item19 = current($items19);
          $item20 = current($items20);
          $item21 = current($items21);
          $item22 = current($items22);



          ////// ASIGNARLOS A VARIABLES ///////////////////
          $id_m_plan=(( $item1 !== false) ? $item1 : ", &nbsp;");
          $cups_fisio=(( $item2 !== false) ? $item2 : ", &nbsp;");
          $sesion_fisio=(( $item3 !== false) ? $item3 : ", &nbsp;");
          $cups_fono=(( $item4 !== false) ? $item4 : ", &nbsp;");
          $sesion_fono=(( $item5 !== false) ? $item5 : ", &nbsp;");
          $cups_to=(( $item6 !== false) ? $item6 : ", &nbsp;");
          $sesion_to=(( $item7 !== false) ? $item7 : ", &nbsp;");
          $cups_psico=(( $item8 !== false) ? $item8 : ", &nbsp;");
          $sesion_psico=(( $item9 !== false) ? $item9 : ", &nbsp;");
          $cups_hidro=(( $item10 !== false) ? $item10 : ", &nbsp;");
          $sesion_hidro=(( $item11 !== false) ? $item11 : ", &nbsp;");
          $cups_equino=(( $item12 !== false) ? $item12 : ", &nbsp;");
          $sesion_equino=(( $item13 !== false) ? $item13 : ", &nbsp;");
          $cups_tap=(( $item14 !== false) ? $item14 : ", &nbsp;");
          $sesion_tap=(( $item15 !== false) ? $item15 : ", &nbsp;");
          $cups_cog=(( $item16 !== false) ? $item16 : ", &nbsp;");
          $sesion_cog=(( $item17 !== false) ? $item17 : ", &nbsp;");
          $cups_musico=(( $item18 !== false) ? $item18 : ", &nbsp;");
          $sesion_musico=(( $item19 !== false) ? $item19 : ", &nbsp;");
          $sesion_sombra=(( $item20 !== false) ? $item20 : ", &nbsp;");
          $cups_sombra=(( $item21 !== false) ? $item21 : ", &nbsp;");
          $tsesion=(( $item22 !== false) ? $item22 : ", &nbsp;");

          $t=$sesion_fisio+$sesion_fono+$sesion_to+
          $sesion_psico+$sesion_hidro+$sesion_equino+$sesion_tap+
          $sesion_cog+$sesion_musico+$sesion_sombra;
          echo $t.' -- '.$tsesion;

            //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
            $valores='("'.$id_m_plan.'","'.$cups_fisio.'","'.$sesion_fisio.'","'.$cups_fono.'","'.$sesion_fono.'","'.$cups_to.'","'.$sesion_to.'","'.$cups_psico.'",
            "'.$sesion_psico.'","'.$cups_hidro.'","'.$sesion_hidro.'","'.$cups_equino.'","'.$sesion_equino.'","'.$cups_tap.'","'.$sesion_tap.'","'.$cups_cog.'",
            "'.$sesion_cog.'","'.$cups_musico.'","'.$sesion_musico.'","'.$sesion_sombra.'","'.$cups_sombra.'"),';

            //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
            $valoresQ= substr($valores, 0, -1);

            ///////// QUERY DE INSERCIÓN ////////////////////////////

              $sql = "INSERT INTO d_plan (id_m_plan, cups_fisio, sesion_fisio, cups_fono, sesion_fono, cups_to, sesion_to, cups_psico, sesion_psico,
                                          cups_hidro, sesion_hidro, cups_equino, sesion_equino, cups_tap, sesion_tap, cups_cog, sesion_cog, cups_musico, sesion_musico,
                                          cups_sombra, sesion_sombra)
            VALUES $valoresQ";
              //echo $sql;

            $sqlRes=$conexion->query($sql) or mysql_error();


              // Up! Next Value
              $item1 = next($items1);
              $item2 = next($items2);
              $item3 = next($items3);
              $item4 = next($items4);
              $item5 = next($items5);
              $item6 = next($items6);
              $item7 = next($items7);
              $item8 = next($items8);
              $item9 = next($items9);
              $item10 = next($items10);
              $item11 = next($items11);
              $item12 = next($items12);
              $item13 = next($items13);
              $item14 = next($items14);
              $item15 = next($items15);
              $item16 = next($items16);
              $item17 = next($items17);
              $item18 = next($items18);
              $item19 = next($items19);
              $item20 = next($items20);
              $item21 = next($items21);


              // Check terminator
              if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false
                 && $item7 === false && $item8 === false && $item9 === false && $item10 === false&&
                $item11 === false && $item12 === false && $item13 === false && $item14 === false && $item15 === false && $item16 === false
                && $item17 === false && $item18 === false && $item19 === false && $item20 === false && $item21 === false ) break;


      }
  }

?>
</section>

</body>

</html>
