<form action="<?php echo PROGRAMA.'?opcion=37&opc=19&servicio=Hospitalario&idadmhosp='.$return.'&doc='.$return1;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-heading">
	 <h2><?php echo $subtitulo;?></h2>
	</section>
	<section class="panel panel-default">
		<section class="panel-body">
			<article class="col-xs-3">
				<label for="">Identificacion:</label>
				<input type="text" name="name" class="form-control" value="<?php echo $fila["tdoc_pac"].':  '.$fila["doc_pac"];?>" <?php echo $atributo1; ?>>
				<input type="hidden" name="idadmhosp" class="form-control" value="<?php echo $fila["id_adm_hosp"];?>" <?php echo $atributo1; ?>>
			</article>
			<article class="col-xs-3">
				<label for="">Nombre Completo:</label>
				<input type="text" name="name" class="form-control" value="<?php echo $fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"];?>" <?php echo $atributo1; ?>>
			</article>
			<article class="col-xs-3">
				<label for="">Fecha Registro Incapacidad:</label>
				<input type="text" name="freg_incapa_hosp" class="form-control" value="<?php echo date('Y-m-d');?>" <?php echo $atributo1; ?>>
			</article>
		</section>
		<section class="panel-body">
			<article class="col-xs-3">
				<label for="">Fecha Inicio Incapacidad:</label>
				<input type="date" name="fini_incapa" class="form-control" value="<?php echo $fila["fingreso_hosp"];?>" <?php echo $atributo2; ?>>
			</article>
			<article class="col-xs-3">
				<label for="">Fecha Final Incapacidad:</label>
				<input type="date" name="ffin_incapa" class="form-control" value="" <?php echo $atributo2; ?> required="">
			</article>
			<article class="col-xs-3">
				<label for="">Tipo de atención:</label>
				<select name="tipo_atencion" class="form-control" <?php echo atributo3; ?> required="es requerido este campo">
					<option value=""></option>
					<option value="Ambulatorio">Ambulatorio</option>
					<option value="Hospitalario">Hospitalario</option>
				</select>
			</article>
			<article class="col-xs-3">
				<label for="">Origen de atención:</label>
				<select name="origen_atencion" class="form-control" <?php echo atributo3; ?> required="">
					<option value=""></option>
					<option value="Enfermedad general">Enfermedad general</option>
					<option value="Enfermedad Laboral">Enfermedad Laboral</option>
					<option value="SOAT">SOAT</option>
				</select>
			</article>
			<article class="col-xs-12">

				<?php include("dxindv.php");?>
			</article>
		 <article class="col-xs-12">
			 <label for="">Observaciones:</label>
			 <textarea name="obs_incapa_med" class='form-control' rows="5" cols="40"></textarea>
		 </article>
	</section>
	<div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
