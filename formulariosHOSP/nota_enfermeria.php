<form action="<?php echo PROGRAMA.'?doc='.$return.'&buscar=Consultar&opcion='.$return1;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion=19';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
		<section class="panel-body">
			<?php include("consulta_paciente.php");?>
		</section>
		<section class="panel-body">
			<article class="col-xs-12">
				<?php include("consulta_rapida.php");?>
			</article>
		</section>
		<section class="panel-heading">
			<section class="panel-body">
				<article class="col-md-12">
					<?php include("alerta_fija/alert_alert.php");?>
				</article>
			</section>
		</section>
			<section class="col-xs-4 well">
				<article class="col-xs-6">
					<label for="">Fecha de registro:</label>
					<input type="text" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1?> >
					<input type="hidden" name="idadmhosp" value="<?php echo $fila['id_adm_hosp'];?>">
					<input type="hidden" name="fecha" value="<?php echo $date1;?>">
				</article>
				<article class="col-xs-6">
					<label for="">Hora de registro</label>
					<input type="time" name="hreg" value="<?php echo $date1;?>" class="form-control">
				</article>
			</section>
			<section class="col-xs-4 well">
				<?php include("alerta_fija/alert_ubi_formula.php");?>
			</section>
			<section class="col-xs-4 well">
				<?php include("alerta_fija/alert_dieta.php");?>
			</section>
		<section class="panel-body">
			<section class="panel-body col-md-12">
				<article class="col-xs-10">
					<label for="">Descripción Nota Enfermería:</label>
					<textarea class="form-control" name="notaenfermeria" rows="10" id="comment" required=""></textarea>
				</article>
			</section>
		</section>
		<section class="col-xs-12">
			<input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
		  <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		  <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</section>
	</section>
		</form>
