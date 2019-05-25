<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion='.$opcion.'';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
		<section class="panel-body">
		  <?php
		    include("consulta_paciente.php");
		  ?>
		</section>
		<section class="panel-heading">
			<h4>Evolución Trabajo social en servicio <?php echo $_REQUEST['servicio'] ?></h4>
		</section>
		<section class="panel-body">
			<?php
			$servicio=$_REQUEST['servicio'];
			if ($servicio=='Hospital dia') {
				include("consulta_rapidaHD.php");
			}
			if ($servicio=='Hospitalario') {
				include("consulta_rapida.php");
			}
		?>
		</section>
		<section class="panel-body">
			<section class="col-md-10">
				<article class="col-xs-3">
					<label for="">Fecha de registro:</label>
					<input type="text" name="freg_ts" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1?> >
				</article>
				<article class="col-xs-3">
					<label for="">Hora de registro</label>
					<input type="text" name="hreg_ts" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1?>>
					<input type="hidden" name="idadmhosp" value="<?php echo $fila['id_adm_hosp'];?>">
				</article>
				<article class="col-xs-12">
					<label for="">Evolución:</label>
					<textarea class="form-control" name="evolucion_ts" rows="10"></textarea>
				</article>
			</section>
			<section class="col-md-2"><!--Aqui puede adecuarse otra serie de consultas de acuerdo al servicio.-->
				<article class="col-md-12 alert alert-success">
					<h4 class="lead"><strong>Servicio:</strong> <br><?php echo $_REQUEST['servicio'] ?></h4>
				</article>
				<article class="">

				</article>
			</section>
		</section>
		<div class="row text-center">
				<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>
	</section>
</form>
