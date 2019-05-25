
<form action="<?php echo PROGRAMA.'?doc='.$return.'&buscar=Buscar&opcion=158';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel-default">
      <section class="panel-heading"><h4>Valoración inicial Fisioterapia en Salud Mental</h4></section>
      <section class="panel-body">
        <?php
          include("consulta_paciente.php");
        ?>
      </section>
      <section class="panel-body">
        <?php include("consulta_rapida.php");?>
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
      <section class="panel-heading"><h4>ANAMNESIS</h4></section>
      <section class="panel-body">
        <article class="col-xs-10">
  				<label for="">Motivo Consulta:</label>
  				<textarea class="form-control" name="motivo_consulta" rows="3" id="comment" required ></textarea>
  			</article>
      </section>
      <section class="panel-heading success"><h4>ANTECEDENTES PERSONALES</h4></section>
      <section class="panel-body">
        <article class="col-xs-6">
  				<label for="">PATOLOGICOS:</label>
  				<textarea class="form-control" name="ant_patologico" rows="3" id="comment" required ></textarea>
  			</article>
  			<article class="col-xs-6">
  				<label for="">TRAUMATICOS:</label>
  				<textarea class="form-control" name="ant_traumaticos" rows="3" id="comment" required ></textarea>
  			</article>
  			<article class="col-xs-6">
  				<label for="">TOXICOALERGICOS:</label>
  				<textarea class="form-control" name="ant_toxicologico" rows="3" id="comment" required ></textarea>
  			</article>
  			<article class="col-xs-6">
  				<label for="">QUIRURGICOS:</label>
  				<textarea class="form-control" name="ant_quirurgico" rows="3" id="comment" required ></textarea>
  			</article>
  			<article class="col-xs-6">
  				<label for="">FARMACOLOGICOS:</label>
  				<textarea class="form-control" name="ant_farmacologico" rows="3" id="comment" required ></textarea>
  			</article>
  			<article class="col-xs-6">
  				<label for="">OCUPACIONALES:</label>
  				<textarea class="form-control" name="ant_ocupacional" rows="3" id="comment" required ></textarea>
  			</article><article class="col-xs-6">
  				<label for="">FAMILIARES:</label>
  				<textarea class="form-control" name="ant_familiar" rows="3" id="comment" required ></textarea>
  			</article><article class="col-xs-6">
  				<label for="">APOYOS DIAGNOSTICOS:</label>
  				<textarea class="form-control" name="apoyo_dx" rows="3" id="comment" required ></textarea>
  			</article>
      </section>
      <section class="panel-heading panel-primary"><h4>VALORACIÓN FISIOTERAPEUTICA</h4></section>
      <section class="panel-body">
        <article class="col-xs-6">
  				<label for="">Dolor:</label>
  				<textarea class="form-control" name="dolor" rows="3" id="comment" required ></textarea>
  			</article>
  			<article class="col-xs-6">
  				<label for="">Piel y Faneras:</label>
  				<textarea class="form-control" name="pf" rows="3" id="comment" required ></textarea>
  			</article>
  			<article class="col-xs-6">
  				<label for="">Sensibilidad:</label>
  				<textarea class="form-control" name="sencibilidad" rows="3" id="comment" required ></textarea>
  			</article>
  			<article class="col-xs-6">
  				<label for="">Función Osteomuscular:</label>
  				<textarea class="form-control" name="fosteomuscular" rows="3" id="comment" required ></textarea>
  			</article>
  			<article class="col-xs-6">
  				<label for="">Postura:</label>
  				<textarea class="form-control" name="postura" rows="3" id="comment" required ></textarea>
  			</article>
  			<article class="col-xs-6">
  				<label for="">Marcha:</label>
  				<textarea class="form-control" name="marcha" rows="3" id="comment" required ></textarea>
  			</article>
      </section>
      <section class="panel-heading"><h4>DIAGNÓSTICO, PRONOSTICO, PLAN DE INTERVENCIÓN Y OBJETIVO TERAPEUTICO</h4></section>
      <section>
        <article class="col-xs-6">
  				<label for="">DIAGNOSTICO FISIOTERAPEUTICO:</label>
  				<textarea class="form-control" name="dx_fisioterapeutico" rows="3" id="comment" required ></textarea>
  			</article>
        <article class="col-xs-6">
  				<label for="">PRONOSTICO FISIOTERAPEUTICO:</label>
  				<textarea class="form-control" name="pron_fisioterapeutico" rows="3" id="comment" required ></textarea>
  			</article>
        <article class="col-xs-6">
  				<label for="">PLAN DE INTERVENCION:</label>
  				<textarea class="form-control" name="plan_intervencion" rows="3" id="comment" required ></textarea>
  			</article>
  			<article class="col-xs-6">
  				<label for="">OBJETIVO TERAPEUTICO:</label>
  				<textarea class="form-control" name="obj_terapeutico" rows="3" id="comment" required ></textarea>
  			</article>
      </section>
      <br>
    	<section class="panel-body text-center">
    	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
    		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
    		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
    	</section>
  </section>
</form>
