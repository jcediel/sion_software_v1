<form action="<?php echo PROGRAMA.'?f1='.$return.'&f2='.$return1.'&buscar=Consultar&opcion=176';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">

  <section class="panel-body">
    <article class="col-xs-4">
      <label for="">Clasifique la muestra:</label>
      <select class="form-control" name="estado_prod">
        <option value="Procesada">Procesada</option>
        <option value="Fallida">Fallida</option>
      </select>
      <input type="hidden" name="id_d_procedimiento" value="<?php echo $fila['id_d_procedimiento']?>">
    </article>
    <article class="col-xs-12">
      <label for="">Observación:</label>
      <textarea name="obs_procesa" class="form-control" rows="5"></textarea>
    </article>
  </section>
  <div class="row text-center">
    <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
    <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
    <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
  </div>
</section>
</form>
