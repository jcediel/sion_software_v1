<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion=19';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel panel-default">
	<section class="panel-body">
		<?php include("consulta_paciente.php");?>
	</section>
	<section class="panel-body">
		<article class="col-xs-12">
			<?php include("consulta_rapidaCESM.php");?>
		</article>
	</section>
	<section class="panel-heading">
		<h3>Registro de inasistencia en consulta externa SM</h3>
	</section>
	<section class="panel-body col-xs-12">
		<article class="col-xs-12">
			<input type="hidden" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1;?> >
			<input type="hidden" name="id" value="<?php echo $fila['id_adm_hosp'] ;?>" class="form-control" <?php echo $atributo1;?> >
		</article>
		<article class="col-xs-12">
			<input type="hidden" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1;?>>
		</article>
		<article class="col-xs-12">
	    <label for="">Comentario inasistencia: </label>
	    <textarea class="form-control" name="inasistencia" rows="5" id="comment"  required=""></textarea>
	  </article>
	</section>
	<section class="col-xs-12">
		<input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
	  <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
	  <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</section>
</section>
	</form>
