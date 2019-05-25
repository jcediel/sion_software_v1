<form action="<?php echo PROGRAMA.'?opcion=142'.$presentacion;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">

<section class="panel panel-default">
	<section class="panel-body">
		<article class="col-xs-1">
			<input type="hidden" name="idpresentacion" class="form-control" value="<?php echo $_GET["idpresentacion"];?>" <?php echo $atributo1;?>/>
			<input type="hidden" name="idprocedimiento" class="form-control" value="<?php echo $_GET["idpprocedimiento"];?>" <?php echo $atributo1;?>/>
		</article>
		<article class="col-xs-12">
			<?php include("busqcupsautori.php");?>
		</article>
		<article class="col-xs-12">
			<label for="">Observación Procedimiento:</label>
			<textarea name="obs_cups" class="form-control" rows="5" <?php echo $atributo2;?>><?php echo $fila["obs_cups"];?></textarea>
		</article>
	</section>
	<div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
