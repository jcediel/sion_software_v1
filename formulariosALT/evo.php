<form action="<?php echo PROGRAMA.'?opcion=100&rpt='.$return1;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel panel-default">
	<section class="panel-body">
		<?php include("consulta_paciente.php");?>
	</section>
	<section class="panel-body">
		<article class="col-xs-12">
			<?php include("consulta_rapida.php");?>
		</article>
	</section>
	<section class="panel-body">
		<section class="col-xs-12 well">
			<article class="col-xs-6">
				<label for="">Fecha de registro:</label>
				<input type="date" name="freg" value="<?php echo $_REQUEST['fecha'] ;?>" class="form-control" <?php echo $atributo2;?> >
				<input type="hidden" name="idadmhosp" value="<?php echo $fila['id_adm_hosp'] ;?>" class="form-control" <?php echo $atributo2;?> >
			</article>
			<article class="col-xs-6">
				<label for="">Hora de registro</label>
				<input type="time" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo2;?>>
			</article>
		</section>
	</section>
	<section class="panel-heading">
		<h3>Evolución medica hospitalaria</h3>
	</section>
	<section class="panel-body col-xs-12">
		<article class="col-xs-6">
	    <label for="">Subjetivo: <span class="fa fa-info-circle" data-toggle="popover" title="Versión de la realidad proporcionada por el paciente" data-content=""></span></label>
	    <textarea class="form-control" name="subjetivo" rows="4" id="comment"  required=""></textarea>
	  </article>
	  <article class="col-xs-6">
	    <label for="" >Objetivo: <span class="fa fa-info-circle" data-toggle="popover" title="Realidad encontrada por el medico con relación al paciente" data-content=""></span></label>
	    <textarea class="form-control" name="objetivo" rows="4" id="comment" required="" ></textarea>
	  </article>
	</section>
	<section class="panel-body col-xs-12">
		<article class="col-xs-6">
	    <label >Analisis: <span class="fa fa-info-circle" data-toggle="popover" title="Consolidado de la realidad del paciente" data-content=""></span></label>
	    <textarea class="form-control" name="analisis" rows="4" id="comment"  required=""></textarea>
	  </article>
	  <article class="col-xs-6">
	    <label for="">Plan tratamiento: <span class="fa fa-info-circle" data-toggle="popover" title="Definición de conducta y procedimientos a realizar en relación a la realidad del paciente" data-content=""></span></label>
	    <textarea class="form-control" name="plantratamiento" rows="4" id="comment" required=""></textarea>
	  </article>
	</section>
	<section class="panel-body  col-md-12">
		<article class="col-xs-12 alert alert-info">
			<label class="text-danger animated shake">Justifique porque el paciente debe continuar hospitalizado?:</label>
			<textarea class="form-control" required name="justificacion_hosp" rows="6" id="comment"></textarea>
		</article>
	</section>
	<section class="col-xs-12">
    <?php include("dxbusqueda.php");?>
  </section>
	<section class="col-xs-12">
		<input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
	  <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
	  <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</section>
</section>
	</form>
