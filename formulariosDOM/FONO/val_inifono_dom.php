<script src="js2/jquery.js" charset="utf-8"></script>
<script src="js2/jqueryui.js" charset="utf-8"></script>
<script>
	$( function() {
		$( "#tabs" ).tabs();
	} );
</script>
<form action="<?php echo PROGRAMA.'?opcion=62';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">

	<section class="panel-header">
	  <?php
	    include("consulta_paciente.php");
	  ?>
	</section>

		<div id="tabs" class="panel panel-default">
			<ul>
		    <li><a href="#tabs-1">Anamnesis</a></li>
		    <li><a href="#tabs-2">Antecedentes Personales</a></li>
		    <li><a href="#tabs-3">Exploración de organos fonoarticuladores y Área funcional </a></li>
				<li><a href="#tabs-5">Pronostico y objetivo</a></li>
				<li><a href="#tabs-6">Plan de intervencion</a></li>
		  </ul>
			<div id="tabs-1" class="panel-body">
				<article class="col-xs-3">
					<label for="">Fecha de registro:</label>
					<input type="text" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1;?>>
					<input type="hidden" name="fecha" value="<?php echo $date1;?>">
					<input type="hidden" name="paciente" value="<?php echo $fila['id_paciente'];?>">
				</article>
				<article class="col-xs-3">
					<label for="">Hora de registro</label>
					<input type="time" required name="hreg" value="" class="form-control">
				</article>
				<article class="col-xs-10">
					<label for="">Motivo Consulta:</label>
					<textarea class="form-control" name="m_consulta" rows="5" id="comment" required ></textarea>
				</article>
        <article class="col-xs-10">
          <label for="">Enfermedad Actual:</label>
          <textarea class="form-control" name="enf_actual" rows="5" id="comment" required ></textarea>
        </article>
			</div>
			<div id="tabs-2" class="panel-body">
				<?php
				$pac=$fila['id_paciente'] ;
					$sql_hc_principal="SELECT id_hcp, id_paciente, ant_alergicos, ant_patologicos, ant_quirurgico, ant_toxicologico, ant_farmaco,
					ant_gineco, ant_psiquiatrico, ant_hospitalario, ant_traumatologico, ant_familiar, otros_ant FROM hc_principal WHERE id_paciente=$pac";
					//echo $sql_hc_principal;
					if ($tabla_hc_principal=$bd1->sub_tuplas($sql_hc_principal)){
						foreach ($tabla_hc_principal as $fila_hc_principal) {
							if ($fila_hc_principal['id_hcp']=='') {
							}
							?>
							<article class="col-xs-3">
								<label for="">Alergicos:</label>
								<button type="button" class="btn-danger"  onclick="verTexto1()" ><span class="fa fa-plus"></span></button>
								<textarea class="form-control" name="ant_alergicos" rows="4" id="respuesta1" required=""><?php echo $fila_hc_principal['ant_alergicos'] ?></textarea>
								<input type="hidden" name="id_hc_principal" value="<?php echo $fila_hc_principal['id_hcp']?>">
							</article>
							<article class="col-xs-3">
								<label for="">Psiquiatricos:</label>
								<button type="button" class="btn-danger"  onclick="verTexto2()" ><span class="fa fa-plus"></span></button>
								<textarea class="form-control" name="ant_psiquiatrico" rows="4" id="respuesta2" required=""><?php echo $fila_hc_principal['ant_psiquiatrico'] ?></textarea>
							</article>
							<article class="col-xs-3">
								<label for="">Patologicos:</label>
								<button type="button" class="btn-danger"  onclick="verTexto3()" ><span class="fa fa-plus"></span></button>
								<textarea class="form-control" name="ant_patologicos" rows="4" id="respuesta3" required=""><?php echo $fila_hc_principal['ant_patologicos'] ?></textarea>
							</article>
							<article class="col-xs-3">
								<label for="">Quirurgicos:</label>
								<button type="button" class="btn-danger"  onclick="verTexto4()" ><span class="fa fa-plus"></span></button>
								<textarea class="form-control" name="ant_quirurgico" rows="4" id="respuesta4" required=""><?php echo $fila_hc_principal['ant_quirurgico'] ?></textarea>
							</article>
							<article class="col-xs-3">
								<label for="">Toxicológicos:</label>
								<button type="button" class="btn-danger"  onclick="verTexto5()" ><span class="fa fa-plus"></span></button>
								<textarea class="form-control" name="ant_toxicologico" rows="4" id="respuesta5" required=""><?php echo $fila_hc_principal['ant_toxicologico'] ?></textarea>
							</article>
							<article class="col-xs-3">
								<label for="">Farmacológicos:</label>
								<button type="button" class="btn-danger"  onclick="verTexto6()" ><span class="fa fa-plus"></span></button>
								<textarea class="form-control" name="ant_farmaco" rows="4" id="respuesta6" required=""><?php echo $fila_hc_principal['ant_farmaco'] ?></textarea>
							</article>
							<article class="col-xs-3">
								<label for="">Hospitalarios:</label>
								<button type="button" class="btn-danger"  onclick="verTexto7()" ><span class="fa fa-plus"></span></button>
								<textarea class="form-control" name="ant_hospitalario" rows="4" id="respuesta7" required=""><?php echo $fila_hc_principal['ant_hospitalario'] ?></textarea>
							</article>
							<?php
					      if ($fila['genero']=='Masculino') {
					        ?>
					        <article class="col-xs-3">
					    			<label for="">Gineco-obstetricos:</label>
					    			<textarea class="form-control" name="ant_gineco" rows="4" id="respuesta" <?php echo $atributo1; ?>>Antecedente no Aplica debido a genero del paciente.</textarea>
					    		</article>
					        <?php
					      }else {
					        ?>
					        <article class="col-xs-3">
					    			<label for="">Gineco-obstetricos:</label>
					    			<textarea class="form-control" name="ant_gineco" rows="4" id="respuesta" ><?php echo $fila_hc_principal['ant_gineco'] ?></textarea>
					    		</article>
					        <?php
					      }
					     ?>
							<article class="col-xs-4">
								<label for="">Traumatologicos:</label>
								<button type="button" class="btn-danger"  onclick="verTexto8()" ><span class="fa fa-plus"></span></button>
								<textarea class="form-control" name="ant_traumatologico" rows="4" id="respuesta8" required=""><?php echo $fila_hc_principal['ant_traumatologico'] ?></textarea>
							</article>
							<article class="col-xs-4">
								<label for="">Familiares:</label>
								<button type="button" class="btn-danger"  onclick="verTexto9()" ><span class="fa fa-plus"></span></button>
								<textarea class="form-control" name="ant_familiar" rows="4" id="respuesta9" required=""><?php echo $fila_hc_principal['ant_familiar'] ?></textarea>
							</article>
							<article class="col-xs-4">
								<label for="">Otros Antecedentes:</label>
								<button type="button" class="btn-danger"  onclick="verTexto10()" ><span class="fa fa-plus"></span></button>
								<textarea class="form-control"  name="otros_ant" rows="4" id="respuesta10" required=""><?php echo $fila_hc_principal['otros_ant'] ?></textarea>
							</article>
							<?php
						}
					}else {
					 ?>
					 <article class="col-xs-3">
						 <label for="">Alergicos:</label>
						 <button type="button" class="btn-danger"  onclick="verTexto1()" ><span class="fa fa-plus"></span></button>
						 <textarea class="form-control" name="ant_alergicos" rows="4" id="respuesta1" required=""><?php echo $fila_hc_principal['ant_alergicos'] ?></textarea>
						 <input type="hidden" name="id_hc_principal" value="<?php echo $fila_hc_principal['id_hcp']?>">
					 </article>
					 <article class="col-xs-3">
						 <label for="">Psiquiatricos:</label>
						 <button type="button" class="btn-danger"  onclick="verTexto2()" ><span class="fa fa-plus"></span></button>
						 <textarea class="form-control" name="ant_psiquiatrico" rows="4" id="respuesta2" required=""><?php echo $fila_hc_principal['ant_psiquiatrico'] ?></textarea>
					 </article>
					 <article class="col-xs-3">
						 <label for="">Patologicos:</label>
						 <button type="button" class="btn-danger"  onclick="verTexto3()" ><span class="fa fa-plus"></span></button>
						 <textarea class="form-control" name="ant_patologicos" rows="4" id="respuesta3" required=""><?php echo $fila_hc_principal['ant_patologicos'] ?></textarea>
					 </article>
					 <article class="col-xs-3">
						 <label for="">Quirurgicos:</label>
						 <button type="button" class="btn-danger"  onclick="verTexto4()" ><span class="fa fa-plus"></span></button>
						 <textarea class="form-control" name="ant_quirurgico" rows="4" id="respuesta4" required=""><?php echo $fila_hc_principal['ant_quirurgico'] ?></textarea>
					 </article>
					 <article class="col-xs-3">
						 <label for="">Toxicológicos:</label>
						 <button type="button" class="btn-danger"  onclick="verTexto5()" ><span class="fa fa-plus"></span></button>
						 <textarea class="form-control" name="ant_toxicologico" rows="4" id="respuesta5" required=""><?php echo $fila_hc_principal['ant_toxicologico'] ?></textarea>
					 </article>
					 <article class="col-xs-3">
						 <label for="">Farmacológicos:</label>
						 <button type="button" class="btn-danger"  onclick="verTexto6()" ><span class="fa fa-plus"></span></button>
						 <textarea class="form-control" name="ant_farmaco" rows="4" id="respuesta6" required=""><?php echo $fila_hc_principal['ant_farmaco'] ?></textarea>
					 </article>
					 <article class="col-xs-3">
						 <label for="">Hospitalarios:</label>
						 <button type="button" class="btn-danger"  onclick="verTexto7()" ><span class="fa fa-plus"></span></button>
						 <textarea class="form-control" name="ant_hospitalario" rows="4" id="respuesta7" required=""><?php echo $fila_hc_principal['ant_hospitalario'] ?></textarea>
					 </article>
					 <?php
						 if ($fila['genero']=='Masculino') {
							 ?>
							 <article class="col-xs-3">
								 <label for="">Gineco-obstetricos:</label>
								 <textarea class="form-control" name="ant_gineco" rows="4" id="respuesta" <?php echo $atributo1; ?>>Antecedente no Aplica debido a genero del paciente.</textarea>
							 </article>
							 <?php
						 }else {
							 ?>
							 <article class="col-xs-3">
								 <label for="">Gineco-obstetricos:</label>
								 <textarea class="form-control" name="ant_gineco" rows="4" id="respuesta" ><?php echo $fila_hc_principal['ant_gineco'] ?></textarea>
							 </article>
							 <?php
						 }
						?>
					 <article class="col-xs-4">
						 <label for="">Traumatologicos:</label>
						 <button type="button" class="btn-danger"  onclick="verTexto8()" ><span class="fa fa-plus"></span></button>
						 <textarea class="form-control" name="ant_traumatologico" rows="4" id="respuesta8" required=""><?php echo $fila_hc_principal['ant_traumatologico'] ?></textarea>
					 </article>
					 <article class="col-xs-4">
						 <label for="">Familiares:</label>
						 <button type="button" class="btn-danger"  onclick="verTexto9()" ><span class="fa fa-plus"></span></button>
						 <textarea class="form-control" name="ant_familiar" rows="4" id="respuesta9" required=""><?php echo $fila_hc_principal['ant_familiar'] ?></textarea>
					 </article>
					 <article class="col-xs-4">
						 <label for="">Otros Antecedentes:</label>
						 <button type="button" class="btn-danger"  onclick="verTexto10()" ><span class="fa fa-plus"></span></button>
						 <textarea class="form-control"  name="otros_ant" rows="4" id="respuesta10" required=""><?php echo $fila_hc_principal['otros_ant'] ?></textarea>
					 </article>
					 <?php
					}
				 	?>
			</div>
			<div id="tabs-3" class="panel-body">
				<article class="col-xs-12">
					<label for="">EXPLORACION DE ORGANOS FONOARTICULADORES:</label>
					<textarea class="form-control" name="exploracion_organos" rows="5" id="comment" required ></textarea>
				</article>
				<article class="col-xs-6">
					<label for="">NIVEL SEMANTICO:</label>
					<textarea class="form-control" name="nivel_semantico" rows="5" id="comment" required ></textarea>
				</article>
				<article class="col-xs-6">
					<label for="">NIVEL SINTACTICO:</label>
					<textarea class="form-control" name="nivel_sintactico" rows="5" id="comment" required ></textarea>
				</article>
				<article class="col-xs-6">
					<label for="">NIVEL PRAGMATICO:</label>
					<textarea class="form-control" name="nivel_pregmatico" rows="5" id="comment" required ></textarea>
				</article>
				<article class="col-xs-6">
					<label for="">DESARROLLO LINGUISTICO:</label>
					<textarea class="form-control" name="desarrollo_linguistico" rows="5" id="comment" required ></textarea>
				</article>
				<article class="col-xs-6">
					<label for="">TEST DE ARTICULACION :</label>
					<textarea class="form-control" name="test_articulacion" rows="5" id="comment" required ></textarea>
				</article>
        <article class="col-xs-6">
					<label for="">FUNCIONES ALIMENTICIAS:</label>
					<textarea class="form-control" name="funciones_alimentarias" rows="5" id="comment" required ></textarea>
				</article>
			</div>

			<div id="tabs-5" class="panel-body">
				<article class="col-xs-10">
					<label for="">PRONOSTICO TERAPEUTICO:</label>
					<textarea class="form-control" name="pronostico" rows="5" id="comment" required ></textarea>
				</article>
				<article class="col-xs-10">
					<label for="">OBJETIVO TERAPEUTICO:</label>
					<textarea class="form-control" name="objetivo" rows="5" id="comment" required ></textarea>
				</article>
			</div>
			<div id="tabs-6"  class="panel-body">
				<article class="col-xs-10">
					<label for="">PLAN DE INTERVENCION:</label>
					<textarea class="form-control" name="plan_tratamiento" rows="5" id="comment" required ></textarea>
				</article>
				<div class="col-md-12 text-center">
				  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
					<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
					<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
				</div>
			</div>
		</div>
</form>
