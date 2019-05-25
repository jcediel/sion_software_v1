<form action="<?php echo PROGRAMA.'?option=133';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
		<section class="panel-heading"><h4><?php echo $subtitulo; ?></h4></section>
		<section class="panel-body">
			<?php
				include("consulta_paciente.php");
			?>
		</section>
		<section class="panel panel-body">
			<article class="col-xs-1">
		  	<label  for="">ID:</label>
		  	<input type="text"  name="id" class="form-control" value="<?php echo $fila["id_eps"];?>"<?php echo $atributo1;?>/>
				<input type="hidden"  name="idadmhosp" class="form-control" value="<?php echo $_GET["idadmhosp"];?>"<?php echo $atributo1;?>/>
		  </article>
			<article class="col-xs-3">
				<label for="">Fecha Registro:</label>
				<input type="text" name="freg" class="form-control" value="<?php echo date('Y-m-d');?>" <?php echo $atributo1; ?>>
				<input type="hidden" name="idadmhosp" class="form-control" value="<?php echo $_GET["idadmhosp"];?>" <?php echo $atributo1;?>/>
			</article>
			<article class="col-xs-3">
				<label for="">Hora Registro:</label>
				<input type="text" name="hreg" class="form-control" value="<?php echo date('H:m');?>" <?php echo $atributo1; ?>>
			</article>
			<article class="col-xs-3">
				<label for="">Tipo de servicio:</label>
				<input type="text" name="tiposervicio" class="form-control" value="Hospitalario" <?php echo $atributo1; ?>>
			</article>
			<article class="col-xs-12">
				<?php include("dxindv.php");?>
			</article>

		</section>
	</section>
		<div class="row text-center">
		  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>
		<section class="panel-body">
			<?php
				include("consulta_ultimaEvo.php");
			?>
		</section>
  </section>
</form>
