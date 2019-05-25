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
		<h3>Evolución medica de control</h3>
	</section>
	<section class="panel-body col-xs-4">
		<article class="col-xs-12">
			<input type="hidden" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1;?> >
			<input type="hidden" name="idadmhosp" value="<?php echo $fila['id_adm_hosp'] ;?>" class="form-control" <?php echo $atributo1;?> >
		</article>
		<article class="col-xs-12">
			<input type="hidden" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1;?>>
		</article>
		<article class="col-xs-12">
	    <label for="">Subjetivo: <span class="fa fa-info-circle" data-toggle="popover" title="Versión de la realidad proporcionada por el paciente" data-content=""></span></label>
	    <textarea class="form-control" name="subjetivo" rows="4" id="comment"  required=""></textarea>
	  </article>
	  <article class="col-xs-12">
	    <label for="" >Objetivo: <span class="fa fa-info-circle" data-toggle="popover" title="Realidad encontrada por el medico con relación al paciente" data-content=""></span></label>
	    <textarea class="form-control" name="objetivo" rows="4" id="comment" required="" ></textarea>
	  </article>
	</section>
	<section class="panel-body col-xs-4">
		<article class="col-xs-12">
	    <label >Analisis: <span class="fa fa-info-circle" data-toggle="popover" title="Consolidado de la realidad del paciente" data-content=""></span></label>
	    <textarea class="form-control" name="analisis" rows="4" id="comment"  required=""></textarea>
	  </article>
	  <article class="col-xs-12">
	    <label for="">Plan tratamiento: <span class="fa fa-info-circle" data-toggle="popover" title="Definición de conducta y procedimientos a realizar en relación a la realidad del paciente" data-content=""></span></label>
	    <textarea class="form-control" name="plantratamiento" rows="4" id="comment" required=""></textarea>
	  </article>
	</section>

	<section class="col-xs-12">
    <?php include("dxbusqueda.php");?>
  </section>
	<section class="col-xs-12">
		<input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
	  <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
	  <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</section>
</section>
	</form>
