
<form action="<?php echo PROGRAMA;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-body">
	  <?php
	    include("consulta_paciente.php");
	  ?>
	</section>
	<article>
		<h4 id="th-estilot">Valoracion inicial Psicologia Consulta Externa</h4>


	<section class="panel-body"> <!--evolucion to-->
			<article class="col-xs-3">
				<label for="">Fecha de registro:</label>
				<input type="text" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1;?>>
				<input type="hidden" name="fecha" value="<?php echo $date1;?>">
			</article>
			<article class="col-xs-3">
				<label for="">Hora de registro</label>
				<input type="time" name="hreg" value="<?php echo $date1 ;?>" class="form-control">
			</article>
	</section>
	<section class="panel-body">
			<article class="col-xs-6">
				<label for="">Motivo Consulta:</label>
				<textarea class="form-control" name="motivo_consulta" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-6">
				<label for="">Remitido Por:</label>
				<textarea class="form-control" name="remitido_por" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-6">
				<label for="">Antecedentes:</label>
				<textarea class="form-control" name="antecedentes" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-6">
				<label for="">Examen Mental:</label>
				<textarea class="form-control" name="examen_mental" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-6">
				<label for="">Personal Social:</label>
				<textarea class="form-control" name="personal_social" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-6">
				<label for="">Area Familiar:</label>
				<textarea class="form-control" name="area_familiar" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-6">
				<label for="">Area Productiva / Laboral:</label>
				<textarea class="form-control" name="area_laboral" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-6">
				<label for="">Area Emocional:</label>
				<textarea class="form-control" name="area_emocional" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-6">
				<label for="">Observaciones:</label>
				<textarea class="form-control" name="observaciones" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-6">
				<label for="">Plan tratamiento:</label>
				<textarea class="form-control" name="plan_tratamiento" rows="5" id="comment" required ></textarea>
			</article>
		</section>
	<div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
