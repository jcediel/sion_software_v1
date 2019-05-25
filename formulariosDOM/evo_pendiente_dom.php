<form action="<?php echo PROGRAMA.'?&opcion='.$opcion.'';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-body">
	  <?php
	    include("consulta_paciente.php");
	  ?>
	</section>
	<article>
		<h4 id="th-estilot">Evoluciones Pendiente </h4>

	<section class="panel-body"> <!--evolucion to-->
			<article class="col-xs-3">
				<label for="">Fecha de registro:</label>
				<select class="form-control" name="freg">
          <option value=""></option>
          <option value="2018-11-29">2018-11-29</option>
          <option value="2018-11-30">2018-11-30</option>
        </select>
				<input type="hidden" name="fecha" value="<?php echo $date1;?>">
			</article>
      <article class="col-xs-3">
        <label for="">Hora de Evolucion</label>
        <input type="time" required name="hregevo" value="" class="form-control">
        <input type="hidden" name="hreg" value="<?php echo $date1 ;?>" class="form-control">
				<input type="hidden" name="idadmhosp" value="<?php echo $fila['id_adm_hosp'] ;?>" class="form-control">
      </article>
      <article class="col-xs-10">
        <label for="">Evolucion:</label>
  			<textarea class="form-control" name="evoto" rows="15" id="respuesta18" required ></textarea>
      </article>
		</section>
	<div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
