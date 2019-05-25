<form action="<?php echo PROGRAMA.'?option=161&idadmhosp='.$return1.'&sede='.$return2.'&doc='.$return;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">

  <section class="panel-body"> <!--notas de enfermeria-->

    <article class="col-xs-12">

      <h1>
        <p class="alert alert-danger">
            <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
            <?php echo $mensaje;?>, donde se encontraba ubicado el paciente
              <strong><?php
              echo'<br><strong>'.$fila["nom_completo"].' </strong>
                   <img src="'.$fila["fotopac"].'"alt ="foto" class="img-rounded" width="150" data-toggle="modal" data-target="#modalpac">'; ?></strong>
        </p>
      </h1>

      <input type="hidden" class="form-control" name="idc" value="<?php echo $_GET['f'];?>">
      <input type="hidden" name="estado" value="<?php echo $estado;?>" class="form-control" <?php echo $atributo1;?> >
      <input type="hidden" name="finicial" value="<?php echo $fila['finicial'];?>" class="form-control" <?php echo $atributo1;?> >
      <input type="hidden" name="idu" value="<?php echo $fila['id_ubipaciente'];?>" class="form-control" <?php echo $atributo1;?> >
      <input type="hidden" name="freal" value="<?php echo date('Y-m-d');?>" class="form-control" <?php echo $atributo1;?> >
      <input type="hidden" name="hab1" value="<?php echo $fila['nom_cama'].' '.$fila['nom_hab'].' '.$fila['nom_piso'].' '.$fila['nom_pabellon'];?>" class="form-control" <?php echo $atributo1;?> >
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
