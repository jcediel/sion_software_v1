<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion=19';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel panel-default">
	<section class="panel-body">
		<?php include("consulta_paciente.php");?>
	</section>
	<section class="panel-body">
		<article class="col-xs-12">
			<?php include("consulta_rapida.php");?>
		</article>
	</section>
	<section class="panel-heading">
		<section class="panel-body">
			<article class="col-md-12">
				<?php include("alerta_fija/alert_alert.php");?>
			</article>
		</section>
	</section>
		<section class="col-xs-4 well">
			<article class="col-xs-6">
				<label for="">Fecha de registro:</label>
				<input type="text" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1;?> >
				<input type="hidden" name="id" value="<?php echo $fila['id_adm_hosp'] ;?>" class="form-control" <?php echo $atributo1;?> >
				<input type="hidden" name="servicio" value="<?php echo $_REQUEST['servicio'] ;?>" class="form-control" <?php echo $atributo1;?> >
			</article>
			<article class="col-xs-6">
				<label for="">Hora de registro</label>
				<input type="time" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1;?>>
			</article>
		</section>
		<section class="col-xs-4 well">
			<?php include("alerta_fija/alert_ubi_formula.php");?>
		</section>
		<section class="col-xs-4 well">
			<?php include("alerta_fija/alert_dieta.php");?>
		</section>
	<section class="panel-body">
		<section class="panel-body col-md-12">
			<article class="col-xs-6">
				<label for="">Subjetivo: </label> <label for="" class="text-danger"><span class="fa fa-info-circle"></span> <i><small>Campo Obligatorio</small></i></label>
				<textarea class="form-control" name="subjetivo" rows="4" id="comment"  required=""></textarea>
			</article>
			<article class="col-xs-6">
				<label for="" >Objetivo: </label> <label for="" class="text-danger"><span class="fa fa-info-circle"></span> <i><small>Campo Obligatorio</small></i></label>
				<textarea class="form-control" name="objetivo" rows="4" id="comment" required="" ></textarea>
			</article>
		</section>
		<section class="panel-body  col-md-12">
			<article class="col-xs-6">
				<label >Analisis: </label> <label for="" class="text-danger"><span class="fa fa-info-circle"></span> <i><small>Campo Obligatorio</small></i></label>
				<textarea class="form-control" name="analisis" rows="4" id="comment"  required=""></textarea>
			</article>
			<article class="col-xs-6">
				<label for="">Plan tratamiento: </label> <label for="" class="text-danger"><span class="fa fa-info-circle"></span> <i><small>Campo Obligatorio</small></i></label>
				<textarea class="form-control" name="plantratamiento" rows="4" id="comment" required=""></textarea>
			</article>
		</section>
		<section class="panel-body  col-md-12">
			<article class="col-xs-12 alert alert-info">
				<label class="text-danger animated shake">Justifique porque el paciente debe continuar hospitalizado?:</label>
				<textarea class="form-control" required name="justificacion_hosp" rows="6" id="comment"></textarea>
			</article>
		</section>
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
