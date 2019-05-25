<form action="<?php echo PROGRAMA.'?option=161&idadmhosp='.$return1.'&sede='.$return2.'&doc='.$return;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">

  <section class="panel-body"> <!--notas de enfermeria-->

    <article class="col-xs-12">
      <h1>
        <p class="alert alert-info fa fa-warning">
            <?php echo $mensaje;?>
            <strong><?php echo $fila['nom1'].' '.$fila['nom2'].' '.$fila['ape1'].' '.$fila['ape2'] ?></strong>,
            ahora puede proceder con la asignación de la cama.
        </p>
      </h1>
      <input type="hidden" class="form-control" name="idc" value="<?php echo $_GET['f'];?>">
      <input type="hidden" name="estado" value="<?php echo $estado;?>" class="form-control" <?php echo $atributo1?> >
    </article>
  </section>
  <div class="row text-center">
    <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
    <input type="submit" class="btn btn-primary" name="aceptar" Value="Descartar"/>
    <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
    <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
  </div>
</section>
</form>
