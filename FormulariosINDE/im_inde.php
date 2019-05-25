<form action="<?php echo PROGRAMA.'?opcion='.$return.'&buscar=Consultar&doc='.$doc;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel-body">
    <?php
      include("consulta_paciente.php");
    ?>
  </section>
  <article>
		<h4 id="th-estilot">Datos del informe mensual de <?php echo $terapia ;?> en <?php echo $servicio ;?></h4>
		<?php  include("consulta_rapidaDEM.php");?>
<section class="panel-body"> <!--Anamnesis-->
  <article class="col-xs-12">

  </article>
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
    <article class="col-xs-6">
      <p class="alert alert-danger animated bounceInRight"><span class="fa fa-info-circle"></span> RECUERDE: Todos los campos son obligatorios</p>
    </article>
  </section>
  <section class="panel-body">
    <article class="col-xs-6">
      <label for="">Objetivo: </label>
      <textarea class="form-control" name="obj" rows="5" id="comment" ></textarea>
    </article>
    <article class="col-xs-6">
      <label for="" >Actividades Realizadas: </label>
      <textarea class="form-control" name="act" rows="5" id="comment" ></textarea>
    </article>

    <article class="col-xs-6">
      <label for="">Logros y avances: </label>
      <textarea class="form-control" name="logro" rows="5" id="comment" ></textarea>
    </article>
    <article class="col-xs-6">
      <label for="">Plan Tratamiento: </label>
      <textarea class="form-control" name="plant" rows="5" id="comment" ></textarea>
    </article>
  </section>
  <div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
</section>
</form>
