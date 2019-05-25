<form action="<?php echo PROGRAMA.'?&opcion='.$return;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel-body">
	<?php
		include("consulta_paciente.php");
	?>
</section>
	<article>
		<h4 id="th-estilot">Datos de Evolución Medica</h4>
		<?php include("$consulta"); ?>
	<section class="panel-body"> <!--Anamnesis-->
		<section class="panel-body">
			<article class="col-xs-3">
				<label for="">Fecha de registro:</label>
				<input type="text" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1;?> >
				<input type="hidden" name="id" value="<?php $fila['id_adm_hosp'] ;?>" class="form-control" <?php echo $atributo1;?> >
			</article>
			<article class="col-xs-3">
				<label for="">Hora de registro</label>
				<input type="time" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1;?>>
			</article>
			<article class="col-xs-6">
	      <p class="alert alert-danger animated bounceInRight"><span class="fa fa-info-circle"></span> RECUERDE: Todos los campos son obligatorios</p>
	    </article>
			<article class="col-xs-6">
				<label for="">Subjetivo: <span class="fa fa-info-circle" data-toggle="popover" title="Versión de la realidad proporcionada por el paciente" data-content=""></span></label>
				<textarea class="form-control" name="subjetivo" rows="5" id="comment"  required=""></textarea>
			</article>
			<article class="col-xs-6">
				<label for="" >Objetivo: <span class="fa fa-info-circle" data-toggle="popover" title="Realidad encontrada por el medico con relación al paciente" data-content=""></span></label>
				<textarea class="form-control" name="objetivo" rows="5" id="comment" required="" ></textarea>
			</article>
			<article class="col-xs-12">
				<label >Analisis: <span class="fa fa-info-circle" data-toggle="popover" title="Consolidado de la realidad del paciente" data-content=""></span></label>
				<textarea class="form-control" name="analisis" rows="6" id="comment"  required=""></textarea>
			</article>
			<article class="col-xs-12">
				<label for="">Plan tratramiento: <span class="fa fa-info-circle" data-toggle="popover" title="Definición de conducta y procedimientos a realizar en relación a la realidad del paciente" data-content=""></span></label>
				<textarea class="form-control" name="plantratamiento" rows="6" id="comment" required=""></textarea>
			</article>
			<article class="col-xs-12">
				<?php include("dxbusqueda.php");?>
			</article>
		</section>
</section>
	<div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
