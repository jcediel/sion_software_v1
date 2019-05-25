<form action="<?php echo PROGRAMA.'?doc='.$return.'&buscar=Consultar&&opcion='.$option;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
    <section class="panel-heading">
      <h3>Registro de signos vitales</h3>
    </section>
		<section class="panel panel-body">
			<article class="col-xs-2">
				<label for="">Fecha registro:</label>
				<input type="text" class="form-control" name="freg" value="<?php echo $date;?>" <?php echo $atributo1;?>>
				<input type="hidden" name="fecha" value="<?php echo $date1;?>">
			</article>
			<article class="col-xs-2">
				<label for="">Hora registro:</label>
				<input type="time" class="form-control" name="hreg" value="<?php echo $date1;?>">
				<input type="hidden" class="form-control" name="idadm" value="<?php echo $_GET['idadmhosp'];?>">
			</article>

			<article class="col-xs-3">
				<label for="">TA Sistólica:</label>
				<input type="text" name="tas" class="form-control" value="">
			</article>
			<article class="col-xs-3">
				<label for="">TA Diastólica:</label>
				<input type="text" name="tad" class="form-control" value="">
			</article>
			<article class="col-xs-3">
				<label for="">FC:</label>
				<input type="text" name="fc" class="form-control" value="">
			</article>
			<article class="col-xs-3">
				<label for="">FR:</label>
				<input type="text" name="fr" class="form-control" value="">
			</article>
			<article class="col-xs-3">
				<label for="">Temp:</label>
				<input type="text" name="temp" class="form-control" value="">
			</article>
			<article class="col-xs-3">
				<label for="">SpO2:</label>
				<input type="text" name="sat" class="form-control" value="">
			</article>
		</section>

		<div class="panel panel-body text-center">
		  <input type="submit" class="btn btn-primary sombra_movil" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="submit" class="btn btn-primary sombra_movil" name="aceptar" Value="Descartar"/>
			<input type="hidden" class="btn btn-primary sombra_movil" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary sombra_movil" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>
	</section>
</form>
