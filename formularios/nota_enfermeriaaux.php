<form action="<?php echo PROGRAMA.'?&opcion=22';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-body">
		<?php
			include("consulta_paciente.php");
		?>
	</section>
		<article>
			<h4 id="th-estilot">Registro Notas de enfermería</h4>
			<?php include("consulta_rapida.php");?>

	<section class="panel-body"> <!--notas de enfermeria-->
			<article class="col-xs-3">
				<label for="">Fecha de registro:</label>
				<input type="text" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1?> >
				<input type="hidden" name="fecha" value="<?php echo $date1;?>">
			</article>
			<article class="col-xs-3">
				<label for="">Hora de registro</label>
				<input type="time" name="hreg" value="<?php echo $date1;?>" class="form-control">
			</article>
			<article class="col-xs-10">
				<label for="">Descripción Nota Enfermería:</label>
				<textarea class="form-control" name="notaenfermeria" rows="15" id="comment" required=""></textarea>
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
