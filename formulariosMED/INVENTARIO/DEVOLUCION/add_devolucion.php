<form action="<?php echo PROGRAMA.'?f1='.$f1.'&f2='.$f2.'&buscar=Buscar&opcion=190';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading"><h4><?php echo $subtitulo ?></h4></section>
    <section class="panel-body">
      <article class="col-md-4">
        <input type="hidden" class="form-control" name="id_dosi_med" value="<?php echo $_REQUEST['dosi'] ?>" <?php echo $atributo1 ?>>
      </article>
      <article class="col-md-4">
        <input type="hidden" class="form-control" name="id_dproducto" value="<?php echo $_REQUEST['producto'] ?>" <?php echo $atributo1 ?>>
      </article>
    </section>
    <section class="panel-body">
      <section class="col-md-6">
        <section class="panel-heading">
          <h3>INFORMACIÓN DE INVENTARIO</h3>
        </section>
        <?php
          $id_dproducto=$_REQUEST['producto'];
          $sql_info_producto="SELECT * FROM d_producto where id_dproducto=$id_dproducto";
          if ($tabla_info_producto=$bd1->sub_tuplas($sql_info_producto)){
          	foreach ($tabla_info_producto as $fila_info_producto) {
              ?>
              <article class="col-md-12">
                <label for="">Cantidad total en inventario: </label>
                <input type="text" class="form-control" name="total_inv" value="<?php echo $fila_info_producto['cantidad'] ?>" <?php echo $atributo1 ?>>
                <input type="hidden" name="ffarmaceutica" value="<?php echo $fila_info_producto['ffarmaceutica'] ?>">
                <input type="hidden" name="id_producto" value="<?php echo $fila_info_producto['id_dproducto'] ?>">
                <input type="hidden" name="total_fraccion" value="<?php echo $fila_info_producto['total_fraccion'] ?>">
              </article>
              <article class="col-md-12">
                <label for="">Qué desea hacer ?</label>
                <select class="form-control" required name="accion">
                  <option value=""></option>
                  <option value="Devolucion">Devolución</option>
                  <option value="Desperdicio">Desperdicio</option>
                </select>
              </article>
              <?php
            }
          }
        ?>
      </section>
      <section class="col-md-6">
        <section class="panel-heading">
          <h3>INFORMACIÓN DE DISPENSACIÓN</h3>
        </section>
        <?php
          $id_dosi_med=$_REQUEST['dosi'];
          $sql_info_dosi="SELECT a.id_dosi_med,fadmin,nom_admin,cant_admin,hora_admin,obs_admin,
                                 b.nombre
                          FROM dosificacion_med a INNER JOIN user b on b.id_user=a.resp_adm where id_dosi_med=$id_dosi_med";
          if ($tabla_info_dosi=$bd1->sub_tuplas($sql_info_dosi)){
          	foreach ($tabla_info_dosi as $fila_info_dosi) {
              ?>
              <article class="col-md-4">
                <label for="">Franja :</label>
                <input type="text" class="form-control" name="fadmin" value="<?php echo $fila_info_dosi['nom_admin'] ?>" <?php echo $atributo1 ?>>
              </article>
              <article class="col-md-5">
                <label for="">Fecha y Hora:</label>
                <input type="text" class="form-control" name="fyh" value="<?php echo $fila_info_dosi['fadmin'].' '.$fila_info_dosi['hora_admin']?>" <?php echo $atributo1 ?>>
              </article>
              <article class="col-md-3">
                <label for="">Dosificacion :</label>
                <input type="text" class="form-control" name="id_dosi_med" value="<?php echo $fila_info_dosi['id_dosi_med'] ?>"<?php echo $atributo1 ?> >
              </article>
              <article class="col-md-6">
                <label for="">Cantidad :</label>
                <input type="text" class="form-control" name="cant_devolucion" value="<?php echo $fila_info_dosi['cant_admin'] ?>"<?php echo $atributo1 ?> >
              </article>
              <article class="col-md-6">
                <label for="">Responsable: </label>
                <input type="text" class="form-control" name="resp_adm" value="<?php echo $fila_info_dosi['nombre'] ?>" <?php echo $atributo1 ?>>
              </article>
              <article class="col-md-12">
                <label for="">Observación :</label>
                <textarea name="name" class="form-control" rows="4"<?php echo $atributo1 ?>><?php echo $fila_info_dosi['obs_admin'] ?></textarea>
              </article>

              <?php
            }
          }
        ?>
      </section>
    </section>
    <section class="panel-body">
      <div class="col-md-12 text-center">
       <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
     	 <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
     	 <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
      </div>
    </section>
  </section>
</form>
