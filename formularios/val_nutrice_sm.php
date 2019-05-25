<form action="<?php echo PROGRAMA.'?&opcion=87';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
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
    </article>
    <article class="col-xs-10">
      <label for="">Motivo de Consulta:</label>
      <textarea class="form-control" name="motivonutri" rows="5" id="comment" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
    </article>
    <article class="col-xs-10">
      <label for="">Valoración Nutricional:</label>
      <textarea class="form-control" name="val_nutri" rows="5" id="comment" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
    </article>
    <article class="col-xs-10">
      <label for="">Diagnostico Nutricional:</label>
      <textarea class="form-control" name="dxnutri" rows="5" id="comment" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
    </article>
    <article class="col-xs-10">
      <label for="">Plan tratamiento:</label>
      <textarea class="form-control" name="plan_nutri" rows="5" id="comment" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
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
