<form action="<?php echo PROGRAMA.'?opcion=100&rpt='.$return1;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-body">
		<?php
			include("consulta_paciente.php");
		?>
	</section>
	<article>
		<h4 id="th-estilot">Registro Evoluciones Terapia Ocupacional</h4>
		<?php include("consulta_rapida.php");?>

	<section class="panel-body"> <!--evolucion to-->
			<article class="col-xs-3">
				<label for="">Fecha de registro:</label>
				<input type="text" name="freg" value="<?php echo $_REQUEST['fecha'] ;?>" class="form-control" <?php echo $atributo1;?>>
				<input type="hidden" name="fecha" value="<?php echo $date1;?>">
				<input type="hidden" name="idadmhosp" value="<?php echo $fila['id_adm_hosp'] ;?>" class="form-control" <?php echo $atributo2;?> >
			</article>
			<article class="col-xs-3">
				<label for="">Hora de registro</label>
				<input type="time" name="hreg" value="<?php echo $date1 ;?>" class="form-control">
			</article>
			<article class="col-xs-10">
				<label >Objetivo de la sesión: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
				<textarea class="form-control" name="objsesion" rows="6" id="comment" required=""></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">Actividades: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
				<textarea class="form-control" name="actividades" rows="6" id="comment" required=""></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">Resultado de la sesión: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
				<textarea class="form-control" name="resultado" rows="6" id="comment" required=""></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">Resumen de evolución:</label>
				<textarea class="form-control" name="evoto" rows="15" id="comment" required <?php echo $atributo1;?>></textarea>
			</article>
		</section>
	<div class="row text-center">
	  	<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="reset" class="btn btn-primary" Value="Reestablecer"/>
		<input type="submit" class="btn btn-primary" name="aceptar" Value="Descartar"/>
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
