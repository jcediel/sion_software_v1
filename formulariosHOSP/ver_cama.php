<form action="<?php echo PROGRAMA.'?option=161&idadmhosp='.$return1.'&sede='.$return2.'&doc='.$return;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">

  <section class="panel-body"> <!--notas de enfermeria-->

    <article class="col-xs-4">
      <img class="img-rounded col-xs-10" src="<?php echo $fila['fotopac']; ?>" alt="Noy hay imagen">
    </article>
    <article class="col-xs-8">
      <label for="">Nombre Paciente:</label>
      <h3><?php echo $fila['nom1'].' '.$fila['nom2'].' '.$fila['ape1'].' '.$fila['ape2'] ?></h3>
      <label for="">identificación:</label>
      <h3><?php echo $fila['tdoc_pac'].': '.$fila['doc_pac'] ?></h3>
      <label for="">Ingreso a la institución:</label>
      <h3><?php echo $fila['fingreso_hosp']; ?></h3>
      <label for="">Fecha inicial en esta cama:</label>
      <input type="text" name="" class="form-control" value="<?php echo $fila['finicial'];?>" <?php echo $atributo1;?>>
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
