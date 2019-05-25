<form action="<?php echo PROGRAMA.'?&opcion=19';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel panel-default">
	<section class="panel-heading">
		<h3><?php echo $subtitulo; ?></h3>
	</section>
	<section class="panel-body">
		<article class="col-xs-2">
			<label for="">ADM:</label>
			<input type="text" class="form-control" name="id_adm_hosp" value="<?php echo $fila['id_adm_hosp'];?>">
		</article>
		<article class="col-xs-4">
			<label for="">Seleccione tipo de clasificación:</label>
			<select class="form-control" required="" name="clase">
				<option value="<?php echo $fila['clase_dx_hosp'];?>"><?php echo $fila['clase_dx_hosp'];?></option>
				<option value="Institucionalizado">Institucionalizado</option>
				<option value="Agudo Salud mental">Agudo Salud mental</option>
				<option value="Farmacodependencia (desintoxicacion)">Farmacodependencia (desintoxicacion)</option>
				<option value="Farmacodependencia (deshabituacion)">Farmacodependencia (deshabituacion)</option>
				<option value="Farmacodependencia (Semi-ambulatorio)">Farmacodependencia (Semi-ambulatorio)</option>
			</select>
		</article>
	</section>
	<section class="col-xs-12">
		<input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
	  <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
	  <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</section>
</section>
	</form>
