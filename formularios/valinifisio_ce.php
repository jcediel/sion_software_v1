
<form action="<?php echo PROGRAMA;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-body">
	  <?php
	    include("consulta_paciente.php");
	  ?>
	</section>
	<article>
		<h4 id="th-estilot">Valoracion inicial Terapia Fisica Consulta Externa</h4>


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
			<article class="col-xs-10">
				<label for="">Motivo Consulta:</label>
				<textarea class="form-control" name="motivo_consulta" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10" id="th-estilo1">
				<label for="">ANTECEDENTES PERSONALES</label>
			</article>
			<article class="col-xs-10">
				<label for="">PATOLOGICOS:</label>
				<textarea class="form-control" name="ant_patologico" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">TRAUMATICOS:</label>
				<textarea class="form-control" name="ant_traumaticos" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">TOXICOALERGICOS:</label>
				<textarea class="form-control" name="ant_toxicologico" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">QUIRURGICOS:</label>
				<textarea class="form-control" name="ant_quirurgico" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">FARMACOLOGICOS:</label>
				<textarea class="form-control" name="ant_farmacologico" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">OCUPACIONALES:</label>
				<textarea class="form-control" name="ant_ocupacional" rows="5" id="comment" required ></textarea>
			</article><article class="col-xs-10">
				<label for="">FAMILIARES:</label>
				<textarea class="form-control" name="ant_familiar" rows="5" id="comment" required ></textarea>
			</article><article class="col-xs-10">
				<label for="">APOYOS DIAGNOSTICOS:</label>
				<textarea class="form-control" name="apoyo_dx" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10" id="th-estilo1">
				<label for="">VALORACION FISIOTERAPEUTICA</label>
			</article>
			<article class="col-xs-10">
				<label for="">Dolor:</label>
				<textarea class="form-control" name="dolor" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">Piel y Faneras:</label>
				<textarea class="form-control" name="pf" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">Sensibilidad:</label>
				<textarea class="form-control" name="sencibilidad" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">Función Osteomuscular:</label>
				<textarea class="form-control" name="fosteomuscular" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">Postura:</label>
				<textarea class="form-control" name="postura" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">Marcha:</label>
				<textarea class="form-control" name="marcha" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">DIAGNOSTICO FISIOTERAPEUTICO:</label>
				<textarea class="form-control" name="dx_fisioterapeutico" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">PRONOSTICO FISIOTERAPEUTICO:</label>
				<textarea class="form-control" name="pron_fisioterapeutico" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">PLAN DE INTERVENCION:</label>
				<textarea class="form-control" name="plan_intervencion" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">OBJETIVO TERAPEUTICO:</label>
				<textarea class="form-control" name="obj_terapeutico" rows="5" id="comment" required ></textarea>
			</article>
		</section>
	<div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
