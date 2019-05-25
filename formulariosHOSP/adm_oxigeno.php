<form action="<?php echo PROGRAMA.'?doc='.$filtro.'&buscar=Consultar&opcion=22';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel panel-default">
	<section class="panel-heading">
		<h3><?php echo $subtitulo; ?></h3>
	</section>
	<section class="panel-body">
		<section class="col-xs-9">
			<article class="col-xs-3">
				<label for="">Fecha Administración:</label>
				<input type="date" name="fadmin" class="form-control" value="" required="">
				<input type="hidden" name="id_oxigeno" class="form-control" value="<?php echo $fila['id_oxigeno']?>">
			</article>
			<article class="col-xs-3">
				<label for="">Litros:</label>
				<input type="text" name="litros" class="form-control" value="<?php echo $fila['litro'] ?> L x Min" <?php echo $atributo1 ?>>
			</article>
			<article class="col-xs-3">
				<label for="">Frecuencia:</label>
				<input type="text" name="frecuencia" class="form-control" value="<?php echo $fila['frecuencia']?> Horas" <?php echo $atributo1 ?>>
			</article>
		</section>
		<section class="col-xs-3">
			<input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</section>
	</section>
</section>
</form>
