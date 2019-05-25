
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
<section class="panel panel-default">
  <section class="panel-heading">
    <h4>Multievolución  psicologia salud mental (Pacientes institucionalizados)</h4>
  </section>
  <section class="panel-body">
    <form>
        <section class="panel-body">
          <article class="col-md-2">
            <label for="">Tipo sesión:</label>
            <select class="form-control" name="tipo_sesion">
              <option value=""></option>
              <option value="Valoracion">Valoracion</option>
              <option value="Psicoterapia">Psicoterapia</option>
            </select>
          </article>
          <article class="col-md-3">
            <label for="">Objetivo:</label>
            <textarea name="objetivo" required="" class="form-control" rows="4"></textarea>
          </article>
          <article class="col-md-3">
            <label for="">Actividades:</label>
            <textarea name="actividad" required="" class="form-control" rows="4"></textarea>
          </article>
          <article class="col-md-3">
            <label for="">Resultado:</label>
            <textarea name="resultado" required="" class="form-control" rows="4"></textarea>
          </article>
          <article class="col-md-3">
            <label for="">Observación:</label>
            <textarea name="observacion" required="" class="form-control" rows="4"></textarea>
          </article>
          <article class="col-md-3">
            <label for="">Seleccione SEDE:</label>
     				<select name="sede" class="form-control" required="" <?php echo atributo3; ?>>
              <option value=""></option>
     					<?php
     					$sql="SELECT id_sedes_ips,nom_sedes from sedes_ips WHERE id_sedes_ips in (2,8) ORDER BY id_sedes_ips ASC";
     					if($tabla=$bd1->sub_tuplas($sql)){
     						foreach ($tabla as $fila2) {
     							if ($fila["id_sedes_ips"]==$fila2["id_sedes_ips"]){
     								$sw=' selected="selected"';
     							}else{
     								$sw="";
     							}
     						echo '<option value="'.$fila2["id_sedes_ips"].'"'.$sw.'>'.$fila2["nom_sedes"].'</option>';
     						}
     					}
     					?>
     			  </select>
          </article>
          <article class="col-md-3">
            <label for="">Seleccione Clasificación DX:</label>
     				<select name="clasedx" class="form-control" required="" <?php echo atributo3; ?>>
              <option value=""></option>
              <option value="Institucionalizado">Institucionalizado</option>
     				  <option value="Agudo Salud mental">Agudo Salud mental</option>
              <option value="Farmacodependencia (deshabituacion)">Farmacodependencia (deshabituacion)</option>
              <option value="Farmacodependencia (desintoxicacion)">Farmacodependencia (desintoxicacion)</option>
     			  </select>
          </article>
          <article class="col-md-3">
            <label for="">AVD?</label>
            <select class="form-control" name="avd">
              <option value=""></option>
              <option value="si">SI</option>
              <option value="no">NO</option>
            </select>
          </article>
        </section>
        <section class="col-md-12 text-center">
          <article class="col-md-12">
            <label for=""> </label>
            <input type="submit" name="buscar" class="btn btn-warning" value="Buscar">
            <input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
          </article>
        </section>
    </form>
  </section>
</section>
<?php
$sedes=$_REQUEST['sede'];
if (isset($sedes)) {
?>
<form method='post'>
  <table class="table table-bordered">
  	<thead class="thead-inverse ">
			<tr>
        <td colspan="5"><h3>Está realizando evolución del día <strong><?php echo date('Y-m-d') ?></strong></h3></td>
				<td colspan="1" class="text-center"><input type="submit" name="insertar" value="Agregar Evoluciones" class="btn btn-primary"/> </td>
        <td colspan="1" class="text-center"><a class="btn btn-success" href="<?php echo PROGRAMA.'?opcion=23';?>">
          <span class="fa fa-backward"> Regresar a consulta individual</span></a></td>
			</tr>
			<tr>
				<th>#</th>
				<th>PACIENTE</th>
        <th>TIPO&nbsp;SESION</th>
				<th>OBJETIVO</th>
				<th>ACTIVIDADES</th>
        <th>RESULTADO</th>
        <th>OBSERVACION</th>
			</tr>
  	</thead>
  	<?php
    $sede=$_REQUEST['sede'];
    $clasedx=$_REQUEST['clasedx'];
    $avd=$_REQUEST['avd'];
    if ($avd=='si') {
      $sql="SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
  								 b.id_adm_hosp,clase_dx_hosp,estado_salida,
  								 concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi

  					FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
  																	left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
  																	left join cama g on (g.id_cama = f.id_cama )
  																	left join habitacion h on (h.id_habitacion = g.id_habitacion )
  																	left join pabellon i on ( i.id_pabellon = h.id_pabellon )
  																	left join piso j on (j.id_piso = i.id_piso )
  				 WHERE b.id_sedes_ips in ($sede) and b.estado_adm_hosp='Activo'
  																		 and b.clase_dx_hosp='$clasedx'
  																		 and b.tipo_servicio='Hospitalario'
                                       and b.avd='si' order by 6 ASC";
    			//echo $sql;
    }
    if ($avd=='no') {
      $sql="SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
  								 b.id_adm_hosp,clase_dx_hosp,estado_salida,
  								 concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi

  					FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
  																	left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
  																	left join cama g on (g.id_cama = f.id_cama )
  																	left join habitacion h on (h.id_habitacion = g.id_habitacion )
  																	left join pabellon i on ( i.id_pabellon = h.id_pabellon )
  																	left join piso j on (j.id_piso = i.id_piso )
  				 WHERE b.id_sedes_ips in ($sede) and b.estado_adm_hosp='Activo'
  																		 and b.clase_dx_hosp='$clasedx'
  																		 and b.tipo_servicio='Hospitalario'
                                       and b.avd is null order by 6 ASC";
    			//echo $sql;
    }

				$i=1;
  if ($tabla=$bd1->sub_tuplas($sql)){
  	foreach ($tabla as $fila ) {
      $esalida=$fila['estado_salida'];
      if ($esalida=='Salida Parcial') {
        echo"<tr class='alert alert-danger'>\n";
            echo'<th class="text-center">
                    <p>'.$i++.'</p>
                 </th>';
              echo'<td class="text-left">';
                echo '<article class="col-md-6"><p>'.$fila['paciente'].'<br><strong>'.$fila['tdoc_pac'].': </strong>'.$fila['doc_pac'].'</p>
                        <p>
                        <select class="form-control" required name="control[]">
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>
                        </select>
                        </p>
                        </article>';
                echo '<article class="col-md-6"><p>';
                      if ($fila['habi']=='') {
                        echo'<strong class="text-danger">NO TIENE UBICACION. COMUNICAR A ENFERMERIA</strong></p>';
                        echo '<input type="hidden" class="form-control" required name="freg_evopsico[]" value="'.date('Y-m-d').'" readonly="readonly">';
                        echo '<input type="hidden" class="form-control" required name="hreg_evopsico[]" value="'.date('H:i').'" readonly="readonly">';
                        echo '<input type="hidden" class="form-control" required name="id_user[]" value="'.$_SESSION['AUT']['id_user'].'" readonly="readonly">';
                        echo '<input type="hidden" class="form-control" required name="resp_evopsico[]" value="'.$_SESSION['AUT']['nombre'].'" readonly="readonly">';
                        echo '<input type="hidden" class="form-control" required name="estado_evopsico[]" value="Realizada" readonly="readonly">';
                      }else {
                        echo'<p>'.$fila['habi'].'</p>';
                        echo '<input type="hidden" class="form-control" required name="freg_evopsico[]" value="'.date('Y-m-d').'" readonly="readonly">';
                        echo '<input type="hidden" class="form-control" required name="hreg_evopsico[]" value="'.date('H:i').'" readonly="readonly">';
                        echo '<input type="hidden" class="form-control" required name="id_user[]" value="'.$_SESSION['AUT']['id_user'].'" readonly="readonly">';
                        echo '<input type="hidden" class="form-control" required name="resp_evopsico[]" value="'.$_SESSION['AUT']['nombre'].'" readonly="readonly">';
                        echo '<input type="hidden" class="form-control" required name="estado_evopsico[]" value="Realizada" readonly="readonly">';
                      }
                echo'</article>';
                echo'<article class="col-md-2">
                      <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" readonly="readonly">
                     </article>';
              echo'</td>';
              echo'<td class="text-center">
                    <input type="text" class="form-control" required name="tipo_sesion[]" value="'.$_REQUEST['tipo_sesion'].'" >
                   </td>';
              echo'<td class="text-center">
                    <textarea required name="objetivo[]" class="form-control" rows="3" cols="50">'.$_REQUEST['objetivo'].'</textarea>
                   </td>';
              echo'<td class="text-center">
                    <textarea required name="actividad[]" class="form-control" rows="3" cols="50">'.$_REQUEST['actividad'].'</textarea>
                   </td>';
              echo'<td class="text-center">
                    <textarea required name="resultado[]" class="form-control" rows="3" cols="50">'.$_REQUEST['resultado'].'</textarea>
                   </td>';
              echo'<td class="text-center">
                    <textarea required name="observacion[]" class="form-control" rows="3" cols="50">'.$_REQUEST['observacion'].'</textarea>
                   </td>';
          echo"</tr >\n";
      }else {
        echo"<tr>\n";
            echo'<th class="text-center">
                    <p>'.$i++.'</p>
                 </th>';
              echo'<td class="text-left">';
                echo '<article class="col-md-6"><p>'.$fila['paciente'].'<br><strong>'.$fila['tdoc_pac'].': </strong>'.$fila['doc_pac'].'</p>
                <p>
                <select class="form-control" required name="control[]">
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
                </p></article>';
                echo '<article class="col-md-6"><p>';
                      if ($fila['habi']=='') {
                        echo'<strong class="text-danger">NO TIENE UBICACION. COMUNICAR A ENFERMERIA</strong></p>';
                        echo '<input type="hidden" class="form-control" required name="freg_evopsico[]" value="'.date('Y-m-d').'" readonly="readonly">';
                        echo '<input type="hidden" class="form-control" required name="hreg_evopsico[]" value="'.date('H:i').'" readonly="readonly">';
                        echo '<input type="hidden" class="form-control" required name="id_user[]" value="'.$_SESSION['AUT']['id_user'].'" readonly="readonly">';
                        echo '<input type="hidden" class="form-control" required name="resp_evopsico[]" value="'.$_SESSION['AUT']['nombre'].'" readonly="readonly">';
                        echo '<input type="hidden" class="form-control" required name="estado_evopsico[]" value="Realizada" readonly="readonly">';
                      }else {
                        echo'<p>'.$fila['habi'].'</p>';
                        echo '<input type="hidden" class="form-control" required name="freg_evopsico[]" value="'.date('Y-m-d').'" readonly="readonly">';
                        echo '<input type="hidden" class="form-control" required name="hreg_evopsico[]" value="'.date('H:i').'" readonly="readonly">';
                        echo '<input type="hidden" class="form-control" required name="id_user[]" value="'.$_SESSION['AUT']['id_user'].'" readonly="readonly">';
                        echo '<input type="hidden" class="form-control" required name="resp_evopsico[]" value="'.$_SESSION['AUT']['nombre'].'" readonly="readonly">';
                        echo '<input type="hidden" class="form-control" required name="estado_evopsico[]" value="Realizada" readonly="readonly">';
                      }
                echo'</article>';
                echo'<article class="col-md-2">
                      <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" readonly="readonly">
                     </article>';
              echo'</td>';
              echo'<td class="text-center">
                    <input type="text" class="form-control" required name="tipo_sesion[]" value="'.$_REQUEST['tipo_sesion'].'" >
                   </td>';
              echo'<td class="text-center">
                    <textarea required name="objetivo[]" class="form-control" rows="3" cols="50">'.$_REQUEST['objetivo'].'</textarea>
                   </td>';
              echo'<td class="text-center">
                    <textarea required name="actividad[]" class="form-control" rows="3" cols="50">'.$_REQUEST['actividad'].'</textarea>
                   </td>';
              echo'<td class="text-center">
                    <textarea required name="resultado[]" class="form-control" rows="3" cols="50">'.$_REQUEST['resultado'].'</textarea>
                   </td>';
              echo'<td class="text-center">
                    <textarea required name="observacion[]" class="form-control" rows="3" cols="50">'.$_REQUEST['observacion'].'</textarea>
                   </td>';
          echo"</tr >\n";
      }



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
  if(isset($_POST['insertar']) ) {


      $items1 = ($_POST['id_adm_hosp']);
      $items2 = ($_POST['id_user']);
      $items3 = ($_POST['freg_evopsico']);
      $items4 = ($_POST['hreg_evopsico']);
      $items5 = ($_POST['tipo_sesion']);
      $items6 = ($_POST['objetivo']);
      $items7 = ($_POST['actividad']);
      $items8 = ($_POST['resultado']);
      $items9 = ($_POST['observacion']);
      $items10 = ($_POST['estado_evopsico']);
      $items11 = ($_POST['resp_evopsico']);
      $items12 = ($_POST['control']);


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


          ////// ASIGNARLOS A VARIABLES ///////////////////
          $id_adm_hosp=(( $item1 !== false) ? $item1 : ", &nbsp;");
          $id_user=(( $item2 !== false) ? $item2 : ", &nbsp;");
          $freg_evopsico=(( $item3 !== false) ? $item3 : ", &nbsp;");
          $hreg_evopsico=(( $item4 !== false) ? $item4 : ", &nbsp;");
          $tipo_sesion=(( $item5 !== false) ? $item5 : ", &nbsp;");
          $objetivo=(( $item6 !== false) ? $item6 : ", &nbsp;");
          $actividades=(( $item7 !== false) ? $item7 : ", &nbsp;");
          $resultado=(( $item8 !== false) ? $item8 : ", &nbsp;");
          $observacion=(( $item9 !== false) ? $item9 : ", &nbsp;");
          $estado_evopsico=(( $item10 !== false) ? $item10 : ", &nbsp;");
          $resp_evopsico=(( $item11 !== false) ? $item11 : ", &nbsp;");
          $condicion=(( $item12 !== false) ? $item12 : ", &nbsp;");

            if ($condicion=='SI') {
              //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
              $valores='("'.$id_adm_hosp.'","'.$id_user.'","'.$freg_evopsico.'","'.$hreg_evopsico.'","'.utf8_decode($tipo_sesion).'","'.utf8_decode($objetivo).'","'.utf8_decode($actividades).'","'.utf8_decode($resultado).'","'.utf8_decode($observacion).'","'.$estado_evopsico.'","'.$resp_evopsico.'"),';

              //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
              $valoresQ= substr($valores, 0, -1);

              ///////// QUERY DE INSERCIÓN ////////////////////////////

                $sql = "INSERT INTO evo_psicologia (id_adm_hosp, id_user, freg_evo_psico, hreg_evo_psico, tipo_sesion, obj_sesion, actividades, resultado, obs_evo_psico, estado_evo_psico, resp_evo_psico)
              VALUES $valoresQ";
                //echo $sql;

              $sqlRes=$conexion->query($sql) or mysql_error();
            }
            if ($condicion=='NO') {
              //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
              $valores='("'.$id_adm_hosp.'","'.$id_user.'","'.$freg_evopsico.'","'.$hreg_evopsico.'","'.utf8_decode($tipo_sesion).'","'.utf8_decode($objetivo).'","'.utf8_decode($actividades).'","'.utf8_decode($resultado).'","'.utf8_decode($observacion).'","'.$estado_evopsico.'","'.$resp_evopsico.'"),';

              //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
              $valoresQ= substr($valores, 0, -1);

              ///////// QUERY DE INSERCIÓN ////////////////////////////

                $sql = "INSERT INTO evo_psicologia ( id_user, freg_evo_psico, hreg_evo_psico, tipo_sesion, obj_sesion, actividades, resultado, obs_evo_psico, estado_evo_psico, resp_evo_psico)
              VALUES $valoresQ";
                //echo $sql;

              $sqlRes=$conexion->query($sql) or mysql_error();
            }
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


            // Check terminator
            if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false && $item7 === false
            && $item8 === false && $item9 === false && $item10 === false && $item11 === false && $item12 === false) break;



      }
  }

?>
</section>

</body>

</html>
