<form action="<?php echo PROGRAMA.'?option=22';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
		<section class="panel-heading">
			<h1><?php echo $subtitulo ?></h1>
		</section>
		<section class="panel-body">
			<?php
				include("consulta_paciente.php");
			?>
		</section>
		<section class="panel-body"> <!--notas de enfermeria-->
			<article class="col-md-2">
				<label for="">ID</label>
				<input type="text" class="form-control" name="idadm" value="<?php echo $_GET['idadmhosp'];?>" <?php echo $atributo1?> >
				<input type="hidden" class="form-control" name="hab" value="<?php echo $_GET['f'];?>">
			</article>
			<article class="col-md-3">
				<label for="">Fecha de registro:</label>
				<input type="text" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1?> >
				<input type="hidden" name="fecha" value="<?php echo $date1;?>">
				<input type="hidden" name="estado" value="Ocupado">
				<input type="hidden" name="finicial" required="" value="<?php echo date('Y-m-d');?>" class="form-control" <?php echo $atributo1?>>
			</article>
			<article class="col-md-7">
				<label for="">Habitación a Asignar</label>
				<p class="alert alert-info animated bounceIn lead text-center"><strong><?php echo 'Habitación: '.$_REQUEST['H'].' <br>Piso: '.$_REQUEST['P'] ?></strong></p>
				<input type="hidden" name="habitacion" value="<?php echo 'Habitación: '.$_REQUEST['H'].' <br>Piso: '.$_REQUEST['P'] ?>">

			</article>
		</section>
		<section class="panel-body">
			<label for="">Nota de traslado: <span class="alert alert-danger animated zoomIn fa fa-info"><i> (Enfermeria debe realizar nota de traslado donde informa las razones por las cuales fue ubicado el paciente)</i></span></label>
			<article class="col-md-12">
				<textarea name="notatraslado" class="form-control" required="" rows="5"></textarea>
			</article>
		</section>

		<div class="row text-center">
			<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>
	</section>
	</section>
</form>
