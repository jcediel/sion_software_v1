
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
      <h4>Registro plan de intervención</h4>
  </section>
  <section class="panel-body">
    <form>
      <section class="col-xs-12">
        <article class="col-xs-4">
  				<label for="">Seleccione EPS:</label>
  				<select class="form-control" required="" name="eps">
  					<option value="12,13,14,15,16,17,18,19,20,21,22,23,24">Todas las EPS</option>
  					<?php
  					$sql="SELECT id_eps,nom_eps from eps where estado_eps='Activo' ORDER BY id_eps ASC";
  					if($tabla=$bd1->sub_tuplas($sql)){
  						foreach ($tabla as $fila2) {
  							if ($fila["id_eps"]==$fila2["id_eps"]){
  								$sw=' selected="selected"';
  							}else{
  								$sw="";
  							}
  						echo '<option value="'.$fila2["id_eps"].'"'.$sw.'>'.$fila2["nom_eps"].'</option>';
  						}
  					}
  					?>
  				</select>
  			</article>
  			<article class="col-xs-4">
  				<label for="">Seleccione SEDE:</label>
  				<select class="form-control" required="" name="sede">
  					<option value="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15">Todas las sedes</option>
  					<?php
  					$sql="SELECT id_sedes_ips,nom_sedes from sedes_ips where estado_sedes='Activo' ORDER BY id_sedes_ips ASC";
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
  			<article class="col-xs-4">
  				<label for="">Seleccione Servicio:</label>
  				<select class="form-control" required="" name="servicio">
  					<option value="'Hospitalario','Consulta Externa SM','Rehabilitacion ','Domiciliarios','Consulta externa REH','Hospital dia','ARL','Demencias','AVD','Consulta externa INDE','Colegios','Pruebas cognitivas','Medicina General INDE'">Todas los servicios</option>
  					<?php
  					$sql="SELECT nomserv from tipo_servicio ORDER BY id_serv ASC";
  					if($tabla=$bd1->sub_tuplas($sql)){
  						foreach ($tabla as $fila2) {
  							if ($fila["nomserv"]==$fila2["nomserv"]){
  								$sw=' selected="selected"';
  							}else{
  								$sw="";
  							}
  						echo '<option value="'.$fila2["nomserv"].'"'.$sw.'>'.$fila2["nomserv"].'</option>';
  						}
  					}
  					?>
  				</select>
  			</article>
        <br>
        <article class="col-xs-3">
          <label for="">Fecha inicial</label>
          <input type="date" class="form-control" name="f1" value="">
        </article>
        <article class="col-xs-3">
          <label for="">Fecha final</label>
          <input type="date" class="form-control" name="f2" value="">
        </article>
        <article class="col-xs-6">
          <label for=""></label>
          <br>
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
    <tr>
      <td colspan="2"><h4>Está realizando registro de planes para <strong><?php echo $_REQUEST['mes'] ?> <?php echo $_REQUEST['an'] ?></strong></h4></td>
      <td colspan="1" class="text-center"><input type="submit" name="insertar" value="Agregar Plan" class="btn btn-primary"/> </td>
      <td colspan="1" class="text-center"><a class="btn btn-success" href="<?php echo PROGRAMA.'?opcion=181&f1='.$_REQUEST['f1'].'&f2='.$_REQUEST['f2'].'&sede='.$_REQUEST['sede'].'';?>">
        <span class="fa fa-plus"> Registrar sesiones </span></a></td>
        <td colspan="1" class="text-center"><a class="btn btn-danger" href="<?php echo PROGRAMA.'?opcion=182&f1='.$_REQUEST['f1'].'&f2='.$_REQUEST['f2'].'&sede='.$_REQUEST['sede'].'';?>">
          <span class="fa fa-calendar"> Registrar asistencia en calendario </span></a></td>
    </tr>
  </table>
  <table class="table table-bordered">
  	<thead class="thead-inverse ">

			<tr>
				<th>#</th>
				<th>PACIENTE</th>
				<th>EPS/SEDE</th>
        <th>SERVICIO</th>
        <th colspan="3"></th>
			</tr>
  	</thead>
  	<?php
    $sede=$_REQUEST['sede'];
    $servicio=$_REQUEST['servicio'];
    $mes=$_REQUEST['mes'];
    $an=$_REQUEST['an'];
    $eps=$_REQUEST['eps'];
    $f1=$_REQUEST['f1'];
    $f2=$_REQUEST['f2'];
      $sql="SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
  								 b.id_adm_hosp,
                   c.nom_eps,
                   d.nom_sedes,
                   e.total_hora,total_sesion
  					FROM adm_hospitalario b INNER JOIN pacientes a on (a.id_paciente = b.id_paciente)
                                    INNER JOIN eps c on (c.id_eps = b.id_eps)
                                    INNER JOIN sedes_ips d on (d.id_sedes_ips = b.id_sedes_ips)
                                    LEFT JOIN m_plan e on (e.id_adm_hosp = b.id_adm_hosp)
  				  WHERE b.id_sedes_ips in ($sede) and b.estado_adm_hosp='Activo'
  																		      and b.tipo_servicio in ('$servicio')
                                            and b.id_eps in ($eps)
                                            and e.finicial <> '$f1'
            order by 2 ASC";
    			//echo $sql;
				$i=1;
  if ($tabla=$bd1->sub_tuplas($sql)){
  	foreach ($tabla as $fila ) {
  				echo"<tr >\n";
              echo'<th class="text-center">
                      <p>'.$i++.'</p>
                      <p><input type="checkbox" checked  name="condiciones" value="1"></p>
                   </th>';
  							echo'<td class="text-left"><p>'.$fila['paciente'].'<br><strong>'.$fila['tdoc_pac'].': </strong>'.$fila['doc_pac'].'</p></td>';
                echo'<td class="text-left"><strong><p class="text-primary">'.$fila['nom_eps'].'</p> <p class="text-success">'.$fila['nom_sedes'].'</p></strong>
                <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$fila['id_adm_hosp'].'" >
                <input type="hidden" class="form-control" required name="estado_m_plan[]" value="Activo" >
                <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
                </td>';

                echo'<td class="text-left">
                      '.$servicio.'

                     </td>';
                echo'<td class="text-left">
                      <label>Fecha inicial:</label>
                      <input type="date" class="form-control" required name="finicial[]" value="'.$f1.'" >
                      <label>Fecha final:</label>
                      <input type="date" class="form-control" required name="ffinal[]" value="'.$f2.'" >
                     </td>';
                echo'<td class="text-left">
                      <label>Total horas:</label>
                      <input type="text" class="form-control" required name="total_hora[]" value="'.$fila['total_hora'].'" >
                      <label>Total sesión:</label>
                      <input type="text" class="form-control" required name="total_sesion[]" value="'.$fila['total_sesion'].'" >
                     </td>';
                echo'<td class="text-center">

                     </td>';
            echo"</tr >\n";
  	}
  }else {
    $sqla="SELECT a.tdoc_pac,doc_pac,concat(nom1,' ',nom2,' ',ape1,' ',ape2) paciente,
                 b.id_adm_hosp,
                 c.nom_eps,
                 d.nom_sedes,
                 e.total_hora,total_sesion
          FROM adm_hospitalario b INNER JOIN pacientes a on (a.id_paciente = b.id_paciente)
                                  INNER JOIN eps c on (c.id_eps = b.id_eps)
                                  INNER JOIN sedes_ips d on (d.id_sedes_ips = b.id_sedes_ips)
                                  LEFT JOIN m_plan e on (e.id_adm_hosp = b.id_adm_hosp)
          WHERE b.id_sedes_ips in ($sede) and b.estado_adm_hosp='Activo'
                                          and b.tipo_servicio in ('$servicio')
                                          and b.id_eps in ($eps)
          order by 2 ASC";
          //echo $sqla;
          if ($tablaa=$bd1->sub_tuplas($sqla)){
            foreach ($tablaa as $filaa ) {
              echo"<tr >\n";
                  echo'<th class="text-center">
                          <p>'.$i++.'</p>
                          <p><input type="checkbox" checked  name="condiciones" value="1"></p>
                       </th>';
                    echo'<td class="text-left"><p>'.$filaa['paciente'].'<br><strong>'.$filaa['tdoc_pac'].': </strong>'.$filaa['doc_pac'].'</p></td>';
                    echo'<td class="text-left"><strong><p class="text-primary">'.$filaa['nom_eps'].'</p> <p class="text-success">'.$filaa['nom_sedes'].'</p></strong>
                    <input type="hidden" class="form-control" required name="id_adm_hosp[]" value="'.$filaa['id_adm_hosp'].'" >
                    <input type="hidden" class="form-control" required name="estado_m_plan[]" value="Activo" >
                    <input type="hidden" class="form-control" required name="resp_reg[]" value="'.$_SESSION['AUT']['id_user'].'" >
                    </td>';

                    echo'<td class="text-left">'.$servicio.'</td>';
                    echo'<td class="text-left">
                          <label>Fecha inicial:</label>
                          <input type="date" class="form-control" required name="finicial[]" value="'.$f1.'" >
                          <label>Fecha final:</label>
                          <input type="date" class="form-control" required name="ffinal[]" value="'.$f2.'" >
                         </td>';
                    echo'<td class="text-left">
                          <label>Total horas:</label>
                          <input type="text" class="form-control" required name="total_hora[]" value="'.$filaa['total_hora'].'" >
                          <label>Total sesión:</label>
                          <input type="text" class="form-control" required name="total_sesion[]" value="'.$filaa['total_sesion'].'" >
                         </td>';
                    echo'<td class="text-center">';
                        $sqlp="";
                    echo'</td>';
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
  if(isset($_POST['insertar'])) {


      $items1 = ($_POST['id_adm_hosp']);
      $items2 = ($_POST['finicial']);
      $items3 = ($_POST['ffinal']);
      $items4 = ($_POST['total_hora']);
      $items5 = ($_POST['total_sesion']);
      $items6 = ($_POST['estado_m_plan']);
      $items7 = ($_POST['resp_reg']);



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

          ////// ASIGNARLOS A VARIABLES ///////////////////
          $id_adm_hosp=(( $item1 !== false) ? $item1 : ", &nbsp;");
          $finicial=(( $item2 !== false) ? $item2 : ", &nbsp;");
          $ffinal=(( $item3 !== false) ? $item3 : ", &nbsp;");
          $total_hora=(( $item4 !== false) ? $item4 : ", &nbsp;");
          $total_sesion=(( $item5 !== false) ? $item5 : ", &nbsp;");
          $estado_m_plan=(( $item6 !== false) ? $item6 : ", &nbsp;");
          $resp_reg=(( $item7 !== false) ? $item7 : ", &nbsp;");


            //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
            $valores='("'.$id_adm_hosp.'","'.$resp_reg.'","'.$finicial.'","'.$ffinal.'","'.$total_hora.'","'.$total_sesion.'","'.$estado_m_plan.'"),';

            //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
            $valoresQ= substr($valores, 0, -1);

            ///////// QUERY DE INSERCIÓN ////////////////////////////

              $sql = "INSERT INTO m_plan (id_adm_hosp, resp_reg, finicial, ffinal, total_hora, total_sesion, estado_m_plan)
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



              // Check terminator
              if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false
                 && $item7 === false ) break;


      }
  }

?>
</section>

</body>

</html>
