<form action="<?php echo PROGRAMA.'?&opcion=29';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel-body">
    <?php
      include("consulta_paciente.php");
    ?>
  </section>
<section class="panel-body"> <!--Anamnesis-->
  <section class="panel-body">
    <article class="col-xs-3">
      <label for="">Fecha de registro:</label>
      <input type="text" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1;?> >
      <input type="hidden" name="idadmhosp" value="<?php echo $_GET["idadmhosp"] ;?>" class="form-control" <?php echo $atributo1;?> >
    </article>
    <article class="col-xs-3">
      <label for="">Hora de registro</label>
      <input type="time" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1;?>>
      <input type="hidden" name="tipoatencion" value="Hospitalario" class="form-control" <?php echo $atributo1;?>>
    </article>
    <article class="col-xs-12">
      <label for="">Historia Familiar: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
      <textarea class="form-control" name="h_familiar" rows="5" id="comment" ></textarea>
    </article>
    <article class="col-xs-12">
      <label for="" >Estudio socioeconomico: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
      <textarea class="form-control" name="estudio_socio" rows="5" id="comment" ></textarea>
    </article>

    <article class="col-xs-12">
      <label for="">Analisis: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
      <textarea class="form-control" name="analisis" rows="6" id="comment" ></textarea>
    </article>
    <article class="col-xs-12">
      <label for="">Concepto Trabajo social: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
      <textarea class="form-control" name="concepto_ts" rows="6" id="comment" ></textarea>
    </article>
    <article class="col-xs-12">
      <label for="">Recomendaciones: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
      <textarea class="form-control" name="recomendaciones" rows="6" id="comment" ></textarea>
    </article>
  </section>
  <div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
</section>
</form>
