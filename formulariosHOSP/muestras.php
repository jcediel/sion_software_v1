<form action="<?php echo PROGRAMA.'?f1='.$return.'&f2='.$return1.'&sede='.$return2.'&buscar=Consultar&opcion=175';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">

  <section class="panel-body">
    <article class="col-xs-12">
      <p class="alert alert-info lead animated bounce">El procedimiento <strong><?php echo $fila['procedimiento'].'</strong>, '.$fila['observacion'];?>.
        Se envia para procesamiento en laboratorio Clínico</p>
        <input type="hidden" name="idd" value="<?php echo $_REQUEST['id']?>">
        <input type="hidden" name="estado" value="Muestra">
    </article>
    <article class="col-xs-12">
      <label for="">Registro de toma de muestra</label>
      <textarea name="obs_muestra" class="form-control" rows="5" required=""></textarea>
    </article>
  </section>
  <div class="row text-center">
    <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
    <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
    <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
  </div>
</section>
</form>
