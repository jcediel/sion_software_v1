
<form action="<?php echo PROGRAMA.'?opcion=104';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel-body">
	  <?php
	    include("consulta_paciente.php");
	  ?>
	</section>
  <article>
		<h4 id="th-estilot">Registro de PQRS</h4>
	  <section class="panel-body"> <!--evolucion to-->

			<article class="col-xs-3">
				<label for="">Fecha de Respuesta:</label>
        <input type="hidden" name="id_pqr" value="<?php echo $_GET['idpqr']?>">
        <input type="date" name="frespuesta" class="form-control" value="<?php echo date('Y-m-d');?>" <?php echo $atributo1; ?>>
			</article>
      <article class="col-xs-9">
				<label for="">Describa la respuesta :</label>
        <textarea name="respuesta" class="form-control" rows="5"></textarea>
			</article>
			<article class="col-xs-3">
				<label for="">Seleccione servicio :</label>
        <select class="form-control" name="servicio" required="">
				  <option value=""></option>
          <option value="Fonoaudiologia">Fonoaudiologia</option>
          <option value="Fisioterapia">Fisioterapia</option>
          <option value="Psicologia Cognitiva">Psicologia Cognitiva</option>
          <option value="Psicologia">Psicologia</option>
          <option value="Terapia Ocupacional">Terapia Ocupacional</option>
          <option value="Equinoterapia">Equinoterapia</option>
          <option value="Terapia Asistida Perros">Terapia Asistida Perros</option>
          <option value="Hidroterapia">Hidroterapia</option>
          <option value="Musicoterapia">Musicoterapia</option>
          <option value="Enfermeria">Enfermeria</option>
          <option value="Medicina Fisica y Rahabilitacion">Medicina Fisica y Rahabilitacion</option>
          <option value="Psiquiatria">Psiquiatria</option>
          <option value="Neuropediatria">Neuropediatria</option>
          <option value="Rutas">Rutas</option>
          <option value="Administrativos">Administrativos</option>
          <option value="Ortopedia y Traumotalogia">Ortopedia y Traumotalogia</option>
          <option value="Medicina del Trabajo y Medicina Laboral">Medicina del Trabajo y Medicina Laboral</option>
          <option value="Trabajo Social">Trabajo Social</option>
          <option value="Terapia Respiratoria">Terapia Respiratoria</option>
          <option value="Motorizados">Motorizados</option>
          <option value="Recoleccion Residuos">Recoleccion Residuos</option>
          <option value="Medicina General">Medicina General</option>
          <option value="Farmacia">Farmacia</option>
          <option value="Casino Alimentos">Casino Alimentos</option>
          <option value="Otros">Otros</option>
				</select>
			</article>
      <article class="col-xs-3">
  			<label>Cargue de Anexos:</label>
  			Archivo: <?php echo $fila["evidencias"];?><br>
  			<input type="file" class="form-control" name="evidencias" <?php echo $atributo3; ?>/>
  		</article>
    </section>
    <section class="panel-body">
      <?php
        if ($_GET["cat"]=='A') {
          echo $plan;
        }

      ?>
    </section>
	<div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
