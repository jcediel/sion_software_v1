<form action="<?php echo PROGRAMA.'?doc='.$filtro.'&buscar=Consultar&opcion=19';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel panel-default">
	<section class="panel-heading">
		<h3><?php echo $subtitulo; ?></h3>
	</section>
	<section class="panel-body">
		<article class="col-xs-1">
			<label for="">ADM:</label>
			<input type="text" class="form-control" name="id_adm_hosp" value="<?php echo $fila['id_adm_hosp'];?>">
		</article>
		<article class="col-xs-3">
			<label for="">Seleccione Flujo:</label>
			<select class="form-control" required="" name="litro">
				<option value="<?php echo $fila['litros'];?>"><?php echo $fila['litros'];?></option>
				<option value="1">1 L x min</option>
				<option value="2">2 L x min</option>
				<option value="3">3 L x min</option>
				<option value="4">4 L x min</option>
				<option value="5">5 L x min</option>
				<option value="6">6 L x min</option>
				<option value="7">7 L x min</option>
				<option value="8">8 L x min</option>
				<option value="9">9 L x min</option>
				<option value="10">10 L x min</option>
			</select>
		</article>
		<article class="col-xs-3">
			<label for="">Seleccione horas dia:</label>
			<select class="form-control" required="" name="frecuencia">
				<option value="<?php echo $fila['frecuencia'];?>"><?php echo $fila['frecuencia'];?></option>
				<option value="4">4 horas</option>
				<option value="8">8 horas</option>
				<option value="12">12 horas</option>
				<option value="16">16 horas</option>
				<option value="24">24 horas</option>
			</select>
		</article>
		<article class="col-xs-2">
			<label for="">Fecha Inicial:</label>
			<input type="date" name="finicial" value="" class="form-control" required="">
		</article>
		<article class="col-xs-2">
			<label for="">Fecha Final:</label>
			<input type="date" name="ffinal" value="" class="form-control" required="">
		</article>
		<article class="col-xs-10">
			<label for="">Observación:</label>
			<textarea name="obs_oxigeno" rows="4" class="form-control"></textarea>
		</article>
	</section>
	<section class="col-xs-12">
		<input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
	  <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
	  <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</section>
</section>
	</form>
