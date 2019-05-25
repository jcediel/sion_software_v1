<form action="<?php echo PROGRAMA.'?opcion=81';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel-body">
    <?php
      include("consulta_paciente.php");
    ?>
  </section>
<section class="panel-body"> <!--Anamnesis-->
  <section class="panel-body">
    <article class="col-xs-10">
      <?php include("diagnosticos/dx.php");?>
    </article>
  </section>
  <section class="panel-body">
    <article class="col-xs-3">
      <label for="">Fecha de registro:</label>
      <input type="text" name="fregimto" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1;?> >
      <input type="hidden" name="idadmhosp" value="<?php echo $_GET["idadmhosp"] ;?>" class="form-control" <?php echo $atributo1;?> >
    </article>
    <article class="col-xs-3">
      <label for="">Hora de registro</label>
      <input type="time" name="hregimto" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1;?>>
    </article>

    <article class="col-xs-12">
      <label for="" >Descripcion de informe: <span class="fa fa-info-circle" data-toggle="popover" title="Espacio para digitacion del cuerpo del informe a realizar" data-content=""></span></label>
      <textarea class="form-control" name="informe" rows="8" id="comment" ></textarea>
    </article>

  </section>
  <div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
</section>
</form>
