<form action="<?php echo PROGRAMA.'?&opcion='.$return;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel-body">
    <?php
      include("consulta_paciente.php");
    ?>
  </section>
<section class="panel-body">

  <article>
		<h4 id="th-estilot">Registro plan trimestral de <?php echo $terapia ;?> en <?php echo $servicio ;?></h4>
		<?php  include("consulta_rapidaDEM.php");?>
  <section class="panel-body">
    <article class="col-xs-3">
      <label for="">Fecha de registro:</label>
      <input type="text" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1;?> >
    </article>
    <article class="col-xs-6">
      <?php
      $fecha = date('Y-m-j');
      $nuevafecha = strtotime ( '+90 day' , strtotime ( $fecha ) ) ;
      $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
       ?>
      <p class="alert alert-danger animated bounceInRight"><span class="fa fa-info-circle"></span> <strong>RECUERDE:</strong> Todos los campos son obligatorios ||| EL VENCIMIENTO DE ESTE PLAN ES EN TRES MESES <strong><?php echo $nuevafecha; ?></strong></p>
    </article>
    <article class="col-xs-10">
      <label for="" >Objetivo Especifico: </label>
      <textarea class="form-control" name="obespec" rows="5" id="comment" ></textarea>
      <input type="hidden" name="idgen" value="<?php echo $_GET['id']; ?>">
    </article>

    <article class="col-xs-5">
      <label for="">Actividades 1: </label>
      <textarea class="form-control" name="actividad1" rows="5" id="comment"></textarea>
    </article>
    <article class="col-xs-5">
      <label for="">Actividades 2: </label>
      <textarea class="form-control" name="actividad2" rows="5" id="comment"></textarea>
    </article>
  </section>
  <div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
</section>
</form>
