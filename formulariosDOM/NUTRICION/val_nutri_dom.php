<script src = "js_p/sha3.js"></script>
		<script>
			function validar(){

				if (document.forms[0].freg.value > document.forms[0].fecha1.value){
					alert("Apreciado Terapeuta <?php echo $_SESSION["AUT"]["nombre"]?>, no no no, NO puede adelantar las fechas.");
					document.forms[0].freg.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion=105';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel-body">
		<article>
			<?php
				include("consulta_rapidaDOM.php");
			?>
  </section>
<section class="panel-body"> <!--Anamnesis-->
  <section class="panel-body">
		<?php
			include("consulta_paciente.php");
		?>
    <article class="col-xs-3">
      <label for="">Fecha de registro:</label>
      <input type="text" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1;?> >
      <input type="hidden" name="idadmhosp" value="<?php echo $_GET["idadmhosp"] ;?>" class="form-control" <?php echo $atributo1;?> >
    </article>
    <article class="col-xs-3">
      <label for="">Hora de registro</label>
      <input type="time" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1;?>>
    </article>
	</section>
	<section class="panel-body">
		<div id="tabs" class="panel panel-default">
			<ul>
				<li><a href="#tabs-1">Valoracion</a></li>
				<li><a href="#tabs-2">Antecedentes Personales</a></li>
			</ul>
			<div id="tabs-1" class="panel-body">
				<article class="col-xs-10">
					<label for="">Motivo de Consulta:</label>
					<textarea class="form-control" name="motivonutri" rows="5" id="comment" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
				</article>
				<article class="col-xs-10">
					<label for="">Valoración Nutricional:</label>
					<textarea class="form-control" name="val_nutri" rows="5" id="comment" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
				</article>
				<article class="col-xs-10">
					<label for="">Diagnostico Nutricional:</label>
					<textarea class="form-control" name="dxnutri" rows="5" id="comment" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
				</article>
				<article class="col-xs-10">
					<label for="">Plan tratamiento:</label>
					<textarea class="form-control" name="plan_nutri" rows="5" id="comment" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
				</article>
				<article class="col-xs-12">
					<label for="">Recomendaciones: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
					<textarea class="form-control" name="recomendaciones" rows="6" id="comment" ></textarea>
				</article>
			</div>
			<div id="tabs-2" class="panel-body">
				<?php
				$pac=$fila_admision['idp'];
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
		</div>
	</section>
  </section>
  <div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
</section>
</form>
