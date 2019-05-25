
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
<?php
  $f=$_REQUEST['f'];
  $doc=$_REQUEST['doc'];
  $idadmhosp=$_REQUEST['idadmhosp'];
  $sede=$_REQUEST['sede'];
  $bod=$_REQUEST['bod'];
  $cod=$_REQUEST['cod'];

  echo'<form method="post" action="aplicacion5.php?opcion=152&doc='.$doc.'&idadmhosp='.$idadmhosp.'&sede='.$sede.'&f='.$f.'&bod='.$bod.'">';
  $sql_verificar_despacho="SELECT freg_farmacia";
  echo'
      <div class="row text-center">
  	  <input type="submit" name="insertar" value="Dosificar Medicamentos" class="btn btn-primary btn-lg"/>
  	</div>
  </form>';
 ?>

<?php

  //////////////////////// PRESIONAR EL BOTÓN //////////////////////////
  if(isset($_POST['insertar']))

  {

  $items1 = ($_POST['id_d_fmedhosp']);
  $items2 = ($_POST['id_user']);
  $items3 = ($_POST['freg_farmacia']);
  $items4 = ($_POST['nom_dosi']);
  $items5 = ($_POST['cant_dosi']);
  $items6 = ($_POST['estado_dosi']);
  $items7 = ($_POST['detalle_despacho']);


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
        $id_d_fmedhosp=(( $item1 !== false) ? $item1 : ", &nbsp;");
        $id_user=(( $item2 !== false) ? $item2 : ", &nbsp;");
        $freg_farmacia=(( $item3 !== false) ? $item3 : ", &nbsp;");
        $nom_dosi=(( $item4 !== false) ? $item4 : ", &nbsp;");
        $cant_dosi=(( $item5 !== false) ? $item5 : ", &nbsp;");
        $estado_dosi=(( $item6 !== false) ? $item6 : ", &nbsp;");
        $detalle_despacho=(( $item7 !== false) ? $item7 : ", &nbsp;");

        //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
        $valores='("'.$id_d_fmedhosp.'","'.$id_user.'","'.$freg_farmacia.'","'.$nom_dosi.'","'.$cant_dosi.'","'.$estado_dosi.'","'.$detalle_despacho.'"),';

        //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
        $valoresQ= substr($valores, 0, -1);

             $total=$fila_consulta['cantidad'];
             $total1=$total-$cant_dosi;
             ///////// QUERY DE INSERCIÓN ////////////////////////////
             $sql = "INSERT INTO dosificacion_med (id_d_fmedhosp, id_user, freg_farmacia, nom_dosi, cant_dosi, estado_dosi,d_producto)
           VALUES $valoresQ";
             //echo $sql;

           $sqlRes=$conexion->query($sql) or mysql_error();


             // Up! Next Value
             $item1 = next( $items1 );
             $item2 = next( $items2 );
             $item3 = next( $items3 );
             $item4 = next( $items4 );
             $item5 = next( $items5 );
             $item6 = next( $items6 );
             $item7 = next( $items7 );

             // Check terminator
             if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false && $item7 === false) break;

    }
  }

?>
</section>

<section class="panel-default">
  <section class="panel-heading">
    <h2>Descargue de inventario</h2>
  </section>
  <section class="panel-body">
    <form method='post'>
      <table class="table table-bordered">
      	<thead class="thead-inverse ">
      		<tr>
      			<th class="text-center danger">INFORMACIÓN DE DISPENSACIÓN</th>
      			<th class="text-center danger">DESCARGUE EN INVENTARIO</th>
      		</tr>
      	</thead>
      	<?php

      	$fa=$_REQUEST['f'];
      	$doc=$_REQUEST["doc"];
      	$fbus=$_REQUEST["fbus"];
      	$sql3="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
      							 b.id_adm_hosp,
      							 c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,dx_formula,dx1_formula,dx2_formula,
      							 d.id_d_fmedhosp,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4,obsfmedhosp,tipo_mipres,rad_mipres,cod_med,
                     e.freg_farmacia,  sum(cant_dosi) total, estado_dosi,
                     f.id_dproducto, nom_completa,nom_comercial,cantidad, cantidad, laboratorio, reg_invima, fvencimiento, cum, lote

      			FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
      											 INNER JOIN m_fmedhosp c on (b.id_adm_hosp=c.id_adm_hosp)
      											 INNER JOIN d_fmedhosp d on (c.id_m_fmedhosp=d.id_m_fmedhosp)
                             LEFT JOIN dosificacion_med e on (e.id_d_fmedhosp=d.id_d_fmedhosp)
                             LEFT JOIN d_producto f on (f.id_dproducto=e.d_producto)

            WHERE b.id_adm_hosp='".$_REQUEST['idadmhosp']."' and e.estado_dosi='Dosificado'
                                                             and e.freg_farmacia='$fa'
				    GROUP BY a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
      							 b.id_adm_hosp,
      							 c.id_m_fmedhosp,fejecucion_inicial,fejecucion_final,tipo_formula,estado_m_fmedhosp,dx_formula,dx1_formula,dx2_formula,
      							 d.id_d_fmedhosp,medicamento,via,frecuencia,dosis1,dosis2,dosis3,dosis4,obsfmedhosp,tipo_mipres,rad_mipres,cod_med,
                     e.freg_farmacia, estado_dosi,
                     f.id_dproducto, nom_completa,nom_comercial,cantidad, cantidad, laboratorio, reg_invima, fvencimiento, cum, lote
          ";
      			//echo $sql3;
      if ($tabla3=$bd1->sub_tuplas($sql3)){
      	foreach ($tabla3 as $fila3 ) {
          echo '<tr>';
          echo '<td>Medicamento: '.$fila3['nom_completa'].'  Cantidad: '.$fila3['total'].'</td>';
          $cant_inventario=$fila3['cantidad'];
          $cant_despacho=$fila3['total'];

          if ($cant_inventario>$cant_despacho) {
            $total=$cant_inventario-$cant_despacho;
            echo '<td>';
            ?>
            <label for="">Lote de descarga:</label>
              <input type="text" class="form-control" required name="id_dproducto[]" value="<?php echo $fila3['id_dproducto'] ?>" <?php echo $atributo1 ?>>
            <?php
            ?>
            <label for="">Cantidad real:</label>
              <input type="text" class="form-control" required name="descargue[]" value="<?php echo $total ?>" <?php echo $atributo1 ?>>
            <?php
            echo'</td>';
          }
          echo '</tr>';
      	}
      }

      ?>

      </table>
      <div class="col-lg-12">
        <div class="text-left col-lg-6">
          <input type="submit" name="actualizar" value="Descargar pedido" class="btn btn-success btn-lg"/>
        </div>
        <div class="text-right col-lg-6">
          <?php
            $idadm=$_GET['idadmhosp'];
          echo'
          <a href="aplicacion5.php?opcion=152&idadmhosp='.$idadm.'&servicio=Hospitalario&doc='.$_REQUEST['doc'].'&f='.$_REQUEST['f'].'&sede='.$_REQUEST['sede'].'&bod='.$_REQUEST['bod'].'">
            <button type="button" class="btn btn-primary btn-lg" name="button"> Regresar a despacho</button>
          </a>';
          ?>
        </div>

    	</div>
    </form>
    <?php

      //////////////////////// PRESIONAR EL BOTÓN //////////////////////////
      if(isset($_POST['actualizar']))

      {

      $items1 = ($_POST['id_dproducto']);
      $items2 = ($_POST['descargue']);


        while(true) {

            //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
            $item1 = current($items1);
            $item2 = current($items2);

            ////// ASIGNARLOS A VARIABLES ///////////////////
            $id_dproducto=(( $item1 !== false) ? $item1 : ", &nbsp;");
            $descargue=(( $item2 !== false) ? $item2 : ", &nbsp;");

                 ///////// QUERY DE INSERCIÓN ////////////////////////////
                 $sql_descargue = "UPDATE d_producto SET cantidad=$descargue WHERE id_dproducto=$id_dproducto; ";
                 echo $sql_descargue;

               $sqlRes=$conexion->query($sql_descargue) or mysql_error();


                 // Up! Next Value
                 $item1 = next( $items1 );
                 $item2 = next( $items2 );

                 // Check terminator
                 if($item1 === false && $item2 === false ) break;

        }
      }

    ?>
  </section>
</section>
</body>

</html>
