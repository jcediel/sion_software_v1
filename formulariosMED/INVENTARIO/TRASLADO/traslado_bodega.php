  <form action="<?php echo PROGRAMA.'?opcion=97';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
    <section class="panel panel-default">
      <section class="panel-heading">
        <h2><?php echo $subtitulo ?></h2>
      </section>
      <section class="panel-body">
        <article class="col-md-12">
          <label for="">Producto:</label>
          <h3><?php echo $fila['nom_producto'] ?></h3>
          <input type="hidden" class="form-control" name="id_producto" value="<?php echo $fila['idm'] ?>">
        </article>
      </section>
      <section class="panel-body">
        <table class="table table-bordered table-responsive">
          <tr>
            <th colspan="5" class="text-center text-primary">LISTA DETALLE DE PRODUCTO</th>
          </tr>
          <tr>
            <th>MEDICAMENTO</th>
            <th>LOTE</th>
            <th>FECHA VENCIMIENTO</th>
            <th>CANTIDAD</th>
            <th>FRACCION</th>
          </tr>
          <?php
          $idm=$fila['idm'];
          $sql_detalle="SELECT id_dproducto, id_producto, id_bodega, id_user, fcreacion, pactivo, concentracion, ffarmaceutica,
                               nom_completa, nom_comercial,cantidad, laboratorio, reg_invima, fvencimiento, cum, lote, propio,
                               total_fraccion, user_mod, accion
                        FROM d_producto
                        WHERE id_producto=$idm";
                        // echo $sql_detalle;
                        if($tabla_detalle=$bd1->sub_tuplas($sql_detalle)){
                          foreach ($tabla_detalle as $fila_detalle) {
                            echo '<tr>';
                            echo '<td>'.$fila_detalle['nom_completa'].'</td>';
                            echo '<td>'.$fila_detalle['lote'].'</td>';
                            echo '<td>'.$fila_detalle['fvencimiento'].'</td>';
                            echo '<td>'.$fila_detalle['cantidad'].'</td>';
                            echo '<td>'.$fila_detalle['total_fraccion'].'</td>';
                            echo '</tr>';
                          }
                        }
          ?>
        </table>
      </section>

      <section class="panel-body">

      </section>
      <div class="row text-center">
        <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
        <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
        <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
      </div>
    </section>
  </form>
