
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
    <h4>Multievolución Nutrición SM</h4>
  </section>
  <section class="panel-body">
    <form>
      <article class="col-xs-6">
        <label for="">Evolución:</label>
        <textarea name="evolucion" required="" class="form-control" rows="4"></textarea>
      </article>
      <div class="col-xs-3">
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
    </div>
    <br>
    <div class="col-xs-3 text-left">
      <article class="col-xs-9">
        <label for="">AVD?</label>
        <select class="form-control" name="avd">
          <option value=""></option>
          <option value="si">SI</option>
          <option value="no">NO</option>
        </select>
      </article>
      <article class="col-xs-3">
        <label for=""> </label>
        <input type="submit" name="buscar" class="btn btn-warning" value="Buscar">
        <input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
      </article>
    </div>
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
        <td colspan="3"><h3>Está realizando evolución del día <strong><?php echo date('Y-m-d') ?></strong></h3></td>
				<td colspan="1" class="text-center"><input type="submit" name="insertar" value="Agregar Evoluciones" class="btn btn-primary"/> </td>
        <td colspan="1" class="text-center"><a class="btn btn-success" href="<?php echo PROGRAMA.'?opcion=30';?>">
          <span class="fa fa-backward"> Regresar a consulta individual</span></a></td>
			</tr>
			<tr>
				<th>#</th>
				<th>PACIENTE</th>
				<th>EVOLUCION</th>
			</tr>
  	</thead>
  	<?php
    $sede=$_REQUEST['sede'];
    $avd=$_REQUEST['avd'];
    if ($avd=='si') {
      $sql="SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
  								 b.id_adm_hosp,clase_dx_hosp,
  								 concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi

  					FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
  																	left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
  																	left join cama g on (g.id_cama = f.id_cama )
  																	left join habitacion h on (h.id_habitacion = g.id_habitacion )
  																	left join pabellon i on ( i.id_pabellon = h.id_pabellon )
  																	left join piso j on (j.id_piso = i.id_piso )
  				 WHERE b.id_sedes_ips in ($sede) and b.estado_adm_hosp='Activo'
  																		 and b.clase_dx_hosp='Institucionalizado'
  																		 and b.tipo_servicio='Hospitalario'
                                       and b.avd='si' order by 6 ASC";
    			//echo $sql;
    }
    if ($avd=='no') {
      $sql="SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
  								 b.id_adm_hosp,clase_dx_hosp,
  								 concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi

  					FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
  																	left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
  																	left join cama g on (g.id_cama = f.id_cama )
  																	left join habitacion h on (h.id_habitacion = g.id_habitacion )
  																	left join pabellon i on ( i.id_pabellon = h.id_pabellon )
  																	left join piso j on (j.id_piso = i.id_piso )
  				 WHERE b.id_sedes_ips in ($sede) and b.estado_adm_hosp='Activo'
  																		 and b.clase_dx_hosp='Institucionalizado'
  																		 and b.tipo_servicio='Hospitalario'
                                       and b.avd is null order by 6 ASC";
    			//echo $sql;
    }

				$i=1;
  if ($tabla=$bd1->sub_tuplas($sql)){
  	foreach ($tabla as $fila ) {
  				echo"<tr >\n";
              echo'<th class="text-left">
                      <article class="col-xs-12">'.$i++.'</article>
                   </th>';
  							echo'<td class="text-left">';

									echo '<section class="col-xs-12"><article class="col-xs-6"><p>'.$fila['paciente'].'<br><strong>'.$fila['tdoc_pac'].': </strong>'.$fila['doc_pac'].'</p></article>';
									echo '<article class="col-xs-6"><p>';
												if ($fila['habi']=='') {
													echo'<strong class="text-danger">NO TIENE UBICACION. COMUNICAR A ENFERMERIA</strong></p>';
                          echo '<input type="hidden" class="form-control" required name="freg_evoto[]" value="'.date('Y-m-d').'" readonly="readonly">';
                          echo '<input type="hidden" class="form-control" required name="hreg_evoto[]" value="'.date('H:i').'" readonly="readonly">';
                          echo '<input type="hidden" class="form-control" required name="id_user[]" value="'.$_SESSION['AUT']['id_user'].'" readonly="readonly">';
                          echo '<input type="hidden" class="form-control" required name="resp_evoto[]" value="'.$_SESSION['AUT']['nombre'].'" readonly="readonly">';
                          echo '<input type="hidden" class="form-control" required name="estado_evoto[]" value="Realizada" readonly="readonly">';
												}else {
													echo'<p>'.$fila['habi'].'</p>';
                          echo '<input type="hidden" class="form-control" required name="freg_evoto[]" value="'.date('Y-m-d').'" readonly="readonly">';
                          echo '<input type="hidden" class="form-control" required name="hreg_evoto[]" value="'.date('H:i').'" readonly="readonly">';
                          echo '<input type="hidden" class="form-control" required name="id_user[]" value="'.$_SESSION['AUT']['id_user'].'" readonly="readonly">';
                          echo '<input type="hidden" class="form-control" required name="resp_evoto[]" value="'.$_SESSION['AUT']['nombre'].'" readonly="readonly">';
                          echo '<input type="hidden" class="form-control" required name="estado_evoto[]" value="Realizada" readonly="readonly">';
												}
									echo'</article>';
  								echo'<article class="col-xs-3">
												<input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila["id_adm_hosp"].'" readonly="readonly">
											 </article>
                       <section class="col-xs-12 alert alert-success">
                       <article class="col-xs-3 text-success animated shake">
                        <strong class="text-left">Habilitar:</strong> <span class="fa fa-arrow-right text-right"></span>
                       </article>
                       <article class="col-xs-9">
                         <select class="form-control" required name="control[]">
                           <option value="SI">SI</option>
                           <option value="NO">NO</option>
                         </select>
                       </article>
                       </section></section>';
  							echo'</td>';
                echo'<td class="text-center">
                      <textarea required name="evolucion[]" class="form-control" rows="3" cols="50">'.$_REQUEST['evolucion'].'</textarea>
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
  if(isset($_POST['insertar'])) {


      $items1 = ($_POST['id_adm_hosp']);
      $items2 = ($_POST['id_user']);
      $items3 = ($_POST['freg_evoto']);
      $items4 = ($_POST['hreg_evoto']);
      $items5 = ($_POST['evolucion']);
      $items6 = ($_POST['estado_evoto']);
      $items7 = ($_POST['control']);




      ///////////// SEPARAR VALORES DE ARRAYS)
      while(true) {

          //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
          $item1 = current($items1);
          $item2 = current($items2);
          $item3 = current($items3);
          $item4 = current($items4);
          $item5 = current($items5);
          $item6 = current($items6);
          $item7 = current($items7);

          ////// ASIGNARLOS A VARIABLES ///////////////////
          $id_adm_hosp=(( $item1 !== false) ? $item1 : ", &nbsp;");
          $id_user=(( $item2 !== false) ? $item2 : ", &nbsp;");
          $freg_evoto=(( $item3 !== false) ? $item3 : ", &nbsp;");
          $hreg_evoto=(( $item4 !== false) ? $item4 : ", &nbsp;");
          $evolucion=(( $item5 !== false) ? $item5 : ", &nbsp;");
          $estado=(( $item6 !== false) ? $item6 : ", &nbsp;");
          $condicion=(( $item7 !== false) ? $item7 : ", &nbsp;");


      if ($condicion=='SI') {
        //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
        $valores='("'.$id_adm_hosp.'","'.$id_user.'","'.$freg_evoto.'","'.$hreg_evoto.'","'.utf8_decode($evolucion).'","'.$estado_evoto.'"),';

        //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
        $valoresQ= substr($valores, 0, -1);
        ///////// QUERY DE INSERCIÓN ////////////////////////////

          $sql = "INSERT INTO evo_nutrism (id_adm_hosp, id_user, freg_nutrice_sm, hreg_nutrice_sm, evolucion_nutri, estado_evonutri)
            VALUES $valoresQ";
              //echo $sql;
              $sqlRes=$conexion->query($sql) or mysql_error();
      }
      if ($condicion=='NO') {
        //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
        $valores='("'.$id_adm_hosp.'","'.$id_user.'","'.$freg_evoto.'","'.$hreg_evoto.'","'.utf8_decode($objetivo).'",
        "'.utf8_decode($actividades).'","'.utf8_decode($resultado).'","'.utf8_decode($evolucionto).'","'.$estado_evoto.'","'.$resp_evoto.'"),';

        //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
        $valoresQ= substr($valores, 0, -1);
        ///////// QUERY DE INSERCIÓN ////////////////////////////

          $sql = "INSERT INTO evo_to ( id_user, freg_evoto, hreg_evoto, obj_sesion, actividades, resultado, evolucion_to, estado_evoto, resp_evoto)
            VALUES $valoresQ";
              //echo $sql;
              $sqlRes=$conexion->query($sql) or mysql_error();
      }
      // Up! Next Value
      $item1 = next( $items1 );
      $item2 = next( $items2 );
      $item3 = next( $items3 );
      $item4 = next( $items4 );
      $item5 = next( $items5 );
      $item6 = next( $items6 );
      $item7 = next( $items7 );


      // Check terminator
                      if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false
                          && $item7 === false) break;


      }
  }

?>
</section>

</body>

</html>
