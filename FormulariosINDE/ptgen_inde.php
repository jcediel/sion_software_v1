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
      <input type="text" name="freg" value="<?php echo $date ;?> <?php echo $date1 ;?>" class="form-control" <?php echo $atributo1;?> >
      <input type="hidden" name="idadmhosp" value="<?php echo $_GET["idadmhosp"] ;?>" class="form-control" <?php echo $atributo1;?> >
    </article>
    <article class="col-xs-3">
      <label for="">Modulo:</label>
      <select class="form-control" name="modulo" required="">
        <option value=""></option>
        <option value="Afecto">Afecto</option>
        <option value="Cognitivo">Cognitivo</option>
        <option value="Biologico">Biologico</option>
        <option value="Sociofamiliar">Sociofamiliar</option>
      </select>
    </article>
    <article class="col-xs-12">
      <label for="">Objetivo General: </label>
      <textarea class="form-control" name="objgen" rows="4" id="comment" <?php echo $atributo3;?>></textarea>
    </article>
  </section>
  <div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
</section>
</form>
