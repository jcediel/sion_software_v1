
<form action="<?php echo PROGRAMA.'?doc='.$return.'&buscar=Buscar&opcion=158';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-body">
	  <?php
	    include("consulta_paciente.php");
	  ?>
	</section>
	<article>
		<h4 id="th-estilot">Valoracion inicial Terapia Respiratoria Consulta Externa</h4>
		<?php include("consulta_rapida.php");?>

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
      <br>
			<article class="col-xs-10" id="th-estilo1">
				<label for="">ANTECEDENTES PERSONALES</label>
			</article>
			<article class="col-xs-4">
				<label for="">Fumador:</label>
				<textarea class="form-control" name="ant_per_fumador" rows="5" id="comment" required ></textarea>
			</article>
      <article class="col-xs-4">
        <label for="">Leña:</label>
        <textarea class="form-control" name="ant_per_leña" rows="5" id="comment" required ></textarea>
      </article>
      <article class="col-xs-4">
        <label for="">Ambiente:</label>
        <textarea class="form-control" name="ant_per_ambiental" rows="5" id="comment" required ></textarea>
      </article>
      <article class="col-xs-10" id="th-estilo1">
				<label for="">ANTECEDENTES GENERALES</label>
			</article>
      <article class="col-xs-10">
				<label for="">PATOLOGICOS:</label>
				<textarea class="form-control" name="ant_patologico" rows="5" id="comment" required ></textarea>
			</article>
      <article class="col-xs-10">
				<label for="">QUIRURGICOS:</label>
				<textarea class="form-control" name="ant_quirurgicos" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">TRAUMATICOS:</label>
				<textarea class="form-control" name="ant_traumatologico" rows="5" id="comment" required ></textarea>
			</article>
      <article class="col-xs-10">
				<label for="">TERAPEUTICOS:</label>
				<textarea class="form-control" name="ant_terapeutico" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">TOXICOLOGICOS:</label>
				<textarea class="form-control" name="ant_toxicologicos" rows="5" id="comment" required ></textarea>
			</article>
      <article class="col-xs-10">
				<label for="">ALERGICOS:</label>
				<textarea class="form-control" name="ant_alergicos" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">FARMACOLOGICOS:</label>
				<textarea class="form-control" name="ant_farmacologico" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-10" id="th-estilo1">
				<label for="">EVALUACION</label>
			</article>
			<article class="col-xs-10">
				<label for="">AUSCULTACION:</label>
				<textarea class="form-control" name="ascultacion" rows="5" id="comment" required ></textarea>
			</article>
			<article class="col-xs-12">
				<table class="table table-bordered">
				   <tr>
             <td rowspan="2">
               PATRON RESPIRATORIO
             </td>
            <td>
              Frecuencia Respiratoria x min
            </td>
            <td>
              Frecuencia Cardiaca x min
            </td>
            <td>
              Saturacion O2
            </td>
          </tr>
          <tr>
            <td>
              <input type="text" name="fr" value="" class="form-control">
            </td>
            <td>
              <input type="text" name="fc" value="" class="form-control">
            </td>
            <td>
              <input type="text" name="so2" value="" class="form-control">
            </td>
          </tr>
          <tr>
            <td rowspan="2">
              Cianosis
            </td>
            <td>
              Petibucal
            </td>
            <td>
              Distal
            </td>
          </tr>
          <tr>
            <td>
              <input type="text" name="petibucal" value="" class="form-control">
            </td>
            <td>
              <input type="text" name="distal" value="" class="form-control">
            </td>
          </tr>
				</table>
			</article>
			<article class="col-xs-12">
				<table class="table table-bordered">
				  <tr>
				    <td rowspan="2">
				      EXPANSIÓN
				    </td>
            <td>
              Torácica
            </td>
            <td>
              Abdominal
            </td>
            <td>
              Amplitud
            </td>
				  </tr>
          <tr>
            <td><textarea class="form-control" name="toracica" rows="5" id="comment" required ></textarea></td>
            <td><textarea class="form-control" name="abdominal" rows="5" id="comment" required ></textarea></td>
            <td><textarea class="form-control" name="amplitud" rows="5" id="comment" required ></textarea></td>
          </tr>
          <tr>
            <td>
              <label for="">Tiraje intercostal</label>
              <select class="form-control" name="tintercostal">
                <option value="SI">SI</option>
                <option value="NO">NO</option>
              </select>
            </td>
            <td>
              <label for="">Sistema de Oxigenoterapia</label>
              <select class="form-control" name="sis_oxigenoterapia">
                <option value="Canula">Canula</option>
                <option value="Venturi">Venturi</option>
                <option value="Sistema ventilatorio">Sistema ventilatorio</option>
                <option value="FI2">FI2</option>
                <option value="Mascara">Mascara</option>
                <option value="Natural-normal">Natural-normal</option>
              </select>
            </td>
            <td colspan="2"><textarea class="form-control" name="obs_sisoxigeno" rows="5" id="comment" ></textarea></td>
          </tr>
				</table>
			</article>
      <article class="col-xs-10">
        <label for="">OBJETIVO GENERAL</label>
        <textarea class="form-control" name="obj_general" rows="5" id="comment" required ></textarea>
      </article>
      <article class="col-xs-10">
        <label for="">OBJETIVO ESPECIFICOS</label>
        <textarea class="form-control" name="obj_especifico" rows="5" id="comment" required ></textarea>
      </article>
      <article class="col-xs-10">
        <label for="">PRONOSTICO TERAPEUTICO</label>
        <textarea class="form-control" name="pronostico" rows="5" id="comment" required ></textarea>
      </article>
      <article class="col-xs-10">
        <label for="">RECOMENDACIONES - ACTIVIDADES</label>
        <textarea class="form-control" name="recomendaciones" rows="5" id="comment" required ></textarea>
      </article>
		</section>
	<div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
