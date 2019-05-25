<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion=23';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
		<section class="panel-body">
			<?php
				include("consulta_paciente.php");
			?>
		</section>
		<section class="panel-heading">
			<h4>Evolución Psicología <?php echo $_REQUEST['servicio'] ?></h4>
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
		<section class="panel-body"> <!--Anamnesis-->
			<article class="col-xs-3">
				<label for="">Fecha de registro:</label>
				<input type="date" name="freg" value="<?php echo $date;?>" class="form-control" <?php echo $atributo3?> >
			</article>
			<article class="col-xs-3">
				<label for="">Hora de registro</label>
				<input type="text" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1?>>
				<input type="hidden" name="idadmhosp" value="<?php echo $fila['id_adm_hosp'];?>">
			</article>
			<article class="col-xs-6">
				<label for="">Tipo de sesión: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
				<select class="form-control" name="tsesion">
					<option value="Valoracion">Valoración</option>
					<option value="psicoterapia">Psicoterapia</option>
				</select>
			</article>
			<br>
			<article class="col-xs-6">
				<label >Objetivo de la sesión: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
				<textarea class="form-control" name="objsesion" rows="4" id="comment" required=""></textarea>
			</article>
			<article class="col-xs-6">
				<label for="">Actividades: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
				<textarea class="form-control" name="actividades" rows="4" id="comment" required=""></textarea>
			</article>
			<article class="col-xs-6">
				<label for="">Resultado de la sesión: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
				<textarea class="form-control" name="resultado" rows="4" id="comment" required=""></textarea>
			</article>
			<article class="col-xs-6">
				<label for="">Observaciones: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
				<textarea class="form-control" name="obsevopsico" rows="4" id="comment" required=""></textarea>
			</article>
		</section>
			<div class="row text-center">
			  	<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
				<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
				<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
			</div>
	</section>
</form>
