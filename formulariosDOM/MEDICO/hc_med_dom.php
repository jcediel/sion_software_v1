<script src = "js_p/sha3.js"></script>
		<script>
			function validar(){

				if (document.forms[0].freg.value > document.forms[0].fecha1.value){
					swal("OJO DOCTOR(A) !!! <?php echo $_SESSION["AUT"]["nombre"] ?>","NO NO NO puede adelantar fechas.","error")
					document.forms[0].freg.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].freg.value < document.forms[0].v1.value){

					swal("OJO DOCTOR(A) !!! <?php echo $_SESSION["AUT"]["nombre"] ?>","la fecha de la evolución no puede ser MENOR a la fecha de inicio de la vigencia del servicio.","error")
					document.forms[0].freg.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].freg.value > document.forms[0].v2.value){
					swal("OJO DOCTOR(A) !!! <?php echo $_SESSION["AUT"]["nombre"] ?>","la fecha de la evolución no puede ser MAYOR a la fecha de finalización de la vigencia del servicio.","error")
					document.forms[0].freg.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA.'?&opcion=19';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
		<section class="panel-heading">
			<h1><?php echo $subtitulo; ?></h1>
		</section>
		<section class="panel-body">
			<?php
				include("consulta_paciente.php");
			?>
		</section>
		<section class="panel-body">
			<?php
				include("consulta_rapidaDOM.php");
			?>
		</section>
		<section class="panel-body">
			<ul class="nav nav-tabs">
		    <li class="active"><a data-toggle="tab" href="#home">ANAMNESIS</a></li>
		    <li><a data-toggle="tab" href="#menu1">ANTECEDENTES PERSONALES</a></li>
		    <li><a data-toggle="tab" href="#menu2">EXAMEN FISICO</a></li>
		    <li><a data-toggle="tab" href="#menu3">EXPLORACION GENERAL / REGIONAL</a></li>
				<li><a data-toggle="tab" href="#menu4">ANALISIS</a></li>
				<li><a data-toggle="tab" href="#menu5">IMPRESION DIAGNOSTICA</a></li>
				<li><a data-toggle="tab" href="#menu6">PLAN TRATAMIENTO</a></li>
		  </ul>
		</section>
		<section class="panel-body">
			<div class="tab-content">
		    <div id="home" class="tab-pane fade in active">
					<section class="pasnel-body">
						<article class="col-md-3">
							<label for="">Fecha de registro:</label>
							<input type="date" required name="freg" value="" class="form-control" <?php echo $atributo3?> >
							<input type="hidden" name="hoyf" value="<?php echo date('Y-m-d') ?>">
							<input type="hidden" name="idadmhosp" value="<?php echo $fila['id_adm_hosp'];?>">
							<input type="hidden" name="paciente" value="<?php echo $fila['id_paciente'];?>">
						</article>
						<article class="col-md-3">
							<label for="">Hora de registro</label>
							<input type="time" required name="hreg" value="" class="form-control" <?php echo $atributo3?>>
							<input type="hidden" name="hoyh" value="<?php echo date('H:i') ?>">
						</article>
						<article class="col-md-4">
							<h3 class="text-danger">INFORMACIÓN DE AUTORIZACIÓN</h3>
							<?php
							$d_procedimiento=$_GET['idd'];
							$sql_autorizado="SELECT id_d_aut_dom, id_m_aut_dom, resp_d_aut_dom, freg, cups,
														procedimiento, cantidad, finicio, ffinal, num_aut_externa,
														resp_inicial_num, estado_d_aut_dom, intervalo, temporalidad,
														dosis, frecuencia, succion, profesional, f_prof, f_cancela,
														resp_cancela, justificacion_cancela, resp_ext, justificacion_ext
				            FROM d_aut_dom
				            WHERE id_d_aut_dom=$d_procedimiento";
										if ($tabla_autorizado=$bd1->sub_tuplas($sql_autorizado)){
											foreach ($tabla_autorizado as $fila_autorizado) {
												?>
												<p><strong>Procedimiento: </strong><?php echo $fila_autorizado['procedimiento'] ?></p>
												<p class="text-primary"><strong>Cantidad Autorizada: </strong><span class="lead"><?php echo $fila_autorizado['cantidad'] ?></span></p>
												<p><strong>Vigencia : </strong><?php echo $fila_autorizado['finicio'].' - '.$fila_autorizado['ffinal'] ?></p>
												<input type="hidden" name="v1" value="<?php echo $fila_autorizado['finicio']; ?>">
												<input type="hidden" name="v2" value="<?php echo $fila_autorizado['ffinal']; ?>">
												<?php
											}
										}
							 ?>
							 <?php
			 				$d_procedimiento=$_GET['idd'];
			 				$sql_realizado="SELECT count(id_d_aut_dom) cuantos
			 	            FROM evo_fisio_dom
			 	            WHERE id_d_aut_dom=$d_procedimiento and estado_evofisio_dom='Realizada'";
			 							if ($tabla_realizado=$bd1->sub_tuplas($sql_realizado)){
			 								foreach ($tabla_realizado as $fila_realizado) {
			 									?>
			 									<p class="text-danger"><strong>Hasta el momento USTED ha realizado: </strong><span class="lead"><?php echo $fila_realizado['cuantos'] ?></span></p>
			 									<?php
			 								}
			 							}
			 				 ?>
						</article>
					</section>
					<section class="panel-body">
						<article class="col-md-2">
							<label for="">ID Autorizado:</label>
							<input type="text" class="form-control" name="idd" value="<?php echo $_GET['idd'];?>"  <?php echo $atributo1?>>
						</article>
						<article class="col-md-4">
							<?php
							$idd=$_GET['idd'];
							$sql_vigencia="SELECT finicio,ffinal FROM d_aut_dom WHERE id_d_aut_dom=$idd";
							//echo $sql_vigencia;
							if ($tabla_vigencia=$bd1->sub_tuplas($sql_vigencia)){
								foreach ($tabla_vigencia as $fila_vigencia) {
									?>
									<label for="">Fecha de inicio:</label>
									<input type="text" class="form-control" name="finicio" value="<?php echo $fila_vigencia['finicio'] ?>"<?php echo $atributo1?>>
									<label for="">Fecha Finalizacion:</label>
									<input type="text" class="form-control" name="ffinal" value="<?php echo $fila_vigencia['ffinal'] ?>"<?php echo $atributo1?>>
									<?php
							  }
							}
							?>
						</article>
						<article class="col-md-6">
						 <label for="">Seleccione tipo de HC:</label>
						 <select class="form-control" name="tipo_hc" required="">
							 <option value=""></option>
							 <option value="Historia Clinica Primera vez">Historia Clinica Primera vez</option>
							 <option value="Historia Clinica Control">Historia Clinica Control</option>
						 </select>
					 </article>
					</section>
					<section class="panel-body">
						<article class="col-md-6">
							<label for="">Motivo de consulta:</label>
							<textarea class="form-control" name="motivo_consulta" rows="5" id="comment" required=""></textarea>
						</article>
						<article class="col-md-6">
							<label for="" >Enfermedad Actual:</span></label>
							<textarea class="form-control" name="enfer_actual" rows="5" id="comment" required=""></textarea>
						</article>
					</section>
		    </div>

		    <div id="menu1" class="tab-pane fade">
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
								<article class="col-md-3">
									<label for="">Alergicos:</label>
									<button type="button" class="btn-danger"  onclick="verTexto1()" ><span class="fa fa-plus"></span></button>
									<textarea class="form-control" name="ant_alergicos" rows="4" id="respuesta1" required=""><?php echo $fila_hc_principal['ant_alergicos'] ?></textarea>
									<input type="hidden" name="id_hc_principal" value="<?php echo $fila_hc_principal['id_hcp']?>">
								</article>
								<article class="col-md-3">
									<label for="">Psiquiatricos:</label>
									<button type="button" class="btn-danger"  onclick="verTexto2()" ><span class="fa fa-plus"></span></button>
									<textarea class="form-control" name="ant_psiquiatrico" rows="4" id="respuesta2" required=""><?php echo $fila_hc_principal['ant_psiquiatrico'] ?></textarea>
								</article>
								<article class="col-md-3">
									<label for="">Patologicos:</label>
									<button type="button" class="btn-danger"  onclick="verTexto3()" ><span class="fa fa-plus"></span></button>
									<textarea class="form-control" name="ant_patologicos" rows="4" id="respuesta3" required=""><?php echo $fila_hc_principal['ant_patologicos'] ?></textarea>
								</article>
								<article class="col-md-3">
									<label for="">Quirurgicos:</label>
									<button type="button" class="btn-danger"  onclick="verTexto4()" ><span class="fa fa-plus"></span></button>
									<textarea class="form-control" name="ant_quirurgico" rows="4" id="respuesta4" required=""><?php echo $fila_hc_principal['ant_quirurgico'] ?></textarea>
								</article>
								<article class="col-md-3">
									<label for="">Toxicológicos:</label>
									<button type="button" class="btn-danger"  onclick="verTexto5()" ><span class="fa fa-plus"></span></button>
									<textarea class="form-control" name="ant_toxicologico" rows="4" id="respuesta5" required=""><?php echo $fila_hc_principal['ant_toxicologico'] ?></textarea>
								</article>
								<article class="col-md-3">
									<label for="">Farmacológicos:</label>
									<button type="button" class="btn-danger"  onclick="verTexto6()" ><span class="fa fa-plus"></span></button>
									<textarea class="form-control" name="ant_farmaco" rows="4" id="respuesta6" required=""><?php echo $fila_hc_principal['ant_farmaco'] ?></textarea>
								</article>
								<article class="col-md-3">
									<label for="">Hospitalarios:</label>
									<button type="button" class="btn-danger"  onclick="verTexto7()" ><span class="fa fa-plus"></span></button>
									<textarea class="form-control" name="ant_hospitalario" rows="4" id="respuesta7" required=""><?php echo $fila_hc_principal['ant_hospitalario'] ?></textarea>
								</article>
								<?php
									if ($fila['genero']=='Masculino') {
										?>
										<article class="col-md-3">
											<label for="">Gineco-obstetricos:</label>
											<textarea class="form-control" name="ant_gineco" rows="4" id="respuesta" <?php echo $atributo1; ?>>Antecedente no Aplica debido a genero del paciente.</textarea>
										</article>
										<?php
									}else {
										?>
										<article class="col-md-3">
											<label for="">Gineco-obstetricos:</label>
											<textarea class="form-control" name="ant_gineco" rows="4" id="respuesta" ><?php echo $fila_hc_principal['ant_gineco'] ?></textarea>
										</article>
										<?php
									}
								 ?>
								<article class="col-md-4">
									<label for="">Traumatologicos:</label>
									<button type="button" class="btn-danger"  onclick="verTexto8()" ><span class="fa fa-plus"></span></button>
									<textarea class="form-control" name="ant_traumatologico" rows="4" id="respuesta8" required=""><?php echo $fila_hc_principal['ant_traumatologico'] ?></textarea>
								</article>
								<article class="col-md-4">
									<label for="">Familiares:</label>
									<button type="button" class="btn-danger"  onclick="verTexto9()" ><span class="fa fa-plus"></span></button>
									<textarea class="form-control" name="ant_familiar" rows="4" id="respuesta9" required=""><?php echo $fila_hc_principal['ant_familiar'] ?></textarea>
								</article>
								<article class="col-md-4">
									<label for="">Otros Antecedentes:</label>
									<button type="button" class="btn-danger"  onclick="verTexto10()" ><span class="fa fa-plus"></span></button>
									<textarea class="form-control"  name="otros_ant" rows="4" id="respuesta10" required=""><?php echo $fila_hc_principal['otros_ant'] ?></textarea>
								</article>
								<?php
							}
						}else {
						 ?>
						 <article class="col-md-3">
							 <label for="">Alergicos:</label>
							 <button type="button" class="btn-danger"  onclick="verTexto1()" ><span class="fa fa-plus"></span></button>
							 <textarea class="form-control" name="ant_alergicos" rows="4" id="respuesta1" required=""><?php echo $fila_hc_principal['ant_alergicos'] ?></textarea>
							 <input type="hidden" name="id_hc_principal" value="<?php echo $fila_hc_principal['id_hcp']?>">
						 </article>
						 <article class="col-md-3">
							 <label for="">Psiquiatricos:</label>
							 <button type="button" class="btn-danger"  onclick="verTexto2()" ><span class="fa fa-plus"></span></button>
							 <textarea class="form-control" name="ant_psiquiatrico" rows="4" id="respuesta2" required=""><?php echo $fila_hc_principal['ant_psiquiatrico'] ?></textarea>
						 </article>
						 <article class="col-md-3">
							 <label for="">Patologicos:</label>
							 <button type="button" class="btn-danger"  onclick="verTexto3()" ><span class="fa fa-plus"></span></button>
							 <textarea class="form-control" name="ant_patologicos" rows="4" id="respuesta3" required=""><?php echo $fila_hc_principal['ant_patologicos'] ?></textarea>
						 </article>
						 <article class="col-md-3">
							 <label for="">Quirurgicos:</label>
							 <button type="button" class="btn-danger"  onclick="verTexto4()" ><span class="fa fa-plus"></span></button>
							 <textarea class="form-control" name="ant_quirurgico" rows="4" id="respuesta4" required=""><?php echo $fila_hc_principal['ant_quirurgico'] ?></textarea>
						 </article>
						 <article class="col-md-3">
							 <label for="">Toxicológicos:</label>
							 <button type="button" class="btn-danger"  onclick="verTexto5()" ><span class="fa fa-plus"></span></button>
							 <textarea class="form-control" name="ant_toxicologico" rows="4" id="respuesta5" required=""><?php echo $fila_hc_principal['ant_toxicologico'] ?></textarea>
						 </article>
						 <article class="col-md-3">
							 <label for="">Farmacológicos:</label>
							 <button type="button" class="btn-danger"  onclick="verTexto6()" ><span class="fa fa-plus"></span></button>
							 <textarea class="form-control" name="ant_farmaco" rows="4" id="respuesta6" required=""><?php echo $fila_hc_principal['ant_farmaco'] ?></textarea>
						 </article>
						 <article class="col-md-3">
							 <label for="">Hospitalarios:</label>
							 <button type="button" class="btn-danger"  onclick="verTexto7()" ><span class="fa fa-plus"></span></button>
							 <textarea class="form-control" name="ant_hospitalario" rows="4" id="respuesta7" required=""><?php echo $fila_hc_principal['ant_hospitalario'] ?></textarea>
						 </article>
						 <?php
							 if ($fila['genero']=='Masculino') {
								 ?>
								 <article class="col-md-3">
									 <label for="">Gineco-obstetricos:</label>
									 <textarea class="form-control" name="ant_gineco" rows="4" id="respuesta" <?php echo $atributo1; ?>>Antecedente no Aplica debido a genero del paciente.</textarea>
								 </article>
								 <?php
							 }else {
								 ?>
								 <article class="col-md-3">
									 <label for="">Gineco-obstetricos:</label>
									 <textarea class="form-control" name="ant_gineco" rows="4" id="respuesta" ><?php echo $fila_hc_principal['ant_gineco'] ?></textarea>
								 </article>
								 <?php
							 }
							?>
						 <article class="col-md-4">
							 <label for="">Traumatologicos:</label>
							 <button type="button" class="btn-danger"  onclick="verTexto8()" ><span class="fa fa-plus"></span></button>
							 <textarea class="form-control" name="ant_traumatologico" rows="4" id="respuesta8" required=""><?php echo $fila_hc_principal['ant_traumatologico'] ?></textarea>
						 </article>
						 <article class="col-md-4">
							 <label for="">Familiares:</label>
							 <button type="button" class="btn-danger"  onclick="verTexto9()" ><span class="fa fa-plus"></span></button>
							 <textarea class="form-control" name="ant_familiar" rows="4" id="respuesta9" required=""><?php echo $fila_hc_principal['ant_familiar'] ?></textarea>
						 </article>
						 <article class="col-md-4">
							 <label for="">Otros Antecedentes:</label>
							 <button type="button" class="btn-danger"  onclick="verTexto10()" ><span class="fa fa-plus"></span></button>
							 <textarea class="form-control"  name="otros_ant" rows="4" id="respuesta10" required=""><?php echo $fila_hc_principal['otros_ant'] ?></textarea>
						 </article>
						 <?php
						}
						?>
		    </div>
		    <div id="menu2" class="tab-pane fade">
					<article class="col-md-2">
 	 				<label for="">TAS(mm/hg):</label>
 	 				<input type="text" name="tas" value="" class="form-control">
 	 			</article>
 	 			<article class="col-md-2">
 	 				<label for="">TAD(mm/hg):</label>
 	 				<input type="text" name="tad" value="" class="form-control">
 	 			</article>
 	 			<article class="col-md-2">
 	 				<label for="">FC(x min):</label>
 	 				<input type="text" name="fc" value="" class="form-control">
 	 			</article>
 	 			<article class="col-md-2">
 	 				<label for="">FR(x min):</label>
 	 				<input type="text" name="fr" value="" class="form-control">
 	 			</article>
 	 			<article class="col-md-2">
 	 				<label for="">SAO2:</label>
 	 				<input type="text" name="sao2" value="" class="form-control">
 	 			</article>
 	 			<article class="col-md-2">
 	 				<label for="">Peso(Kg):</label>
 	 				<input type="text" name="peso" value="" class="form-control">
 	 			</article>
 	 			<article class="col-md-2">
 	 				<label for="">Talla(mts): <span class="fa fa-pulse fa-comment-o" data-toggle="popover" title="El valor correspondiente a la talla del paciente debe ser diligenciado en metros Ej: 1.95" data-content=""></span></label>
 	 				<input type="text" name="talla" value="" class="form-control">
 	 			</article>
 	 			<article class="col-md-2">
 	 				<label for="">Glasgow:</label>
 	 				<input type="text" name="glasgow" value="" class="form-control">
 	 			</article>
 	 			<article class="col-md-2">
 	 				<label for="">Glucometria:</label>
 	 				<input type="text" name="glucometria" value="" class="form-control">
 	 			</article>
 	 			<article class="col-md-6 animated tada fuente_alerta_fijo">
 	 				<label class="fuente_alerta_fijo" for="">Doctor(a) los datos que debe ingresar en estos campos deben ser numericos, en el campo de talla digite en metros Ejemplo: 1.95</label>
 	 			</article>
		    </div>
		    <div id="menu3" class="tab-pane fade">
					<article class="col-md-12">
						<label for="">RxS:</label>
						<textarea class="form-control" name="rxs" rows="3"  required=""></textarea>
					</article>
					<article class="col-md-3">
						<label for="">Cabeza y Cuello:</label>
						<button type="button" class="btn-danger"  onclick="verTexto12()" ><span class="ui-icon ui-icon-plus"></span></button>
						<textarea class="form-control" name="cabezacuello" rows="5" id="respuesta12" required=""></textarea>
					</article>
					<article class="col-md-3">
						<label for="">Torax:</label>
						<button type="button" class="btn-danger"  onclick="verTexto13()" ><span class="ui-icon ui-icon-plus"></span></button>
						<textarea class="form-control" name="torax" rows="5" id="respuesta13" required=""></textarea>
					</article>
					<article class="col-md-3">
						<label for="">Abdomen:</label>
						<button type="button" class="btn-danger"  onclick="verTexto16()" ><span class="ui-icon ui-icon-plus"></span></button>
						<textarea class="form-control" name="abdomen" rows="5" id="respuesta16" required=""></textarea>
					</article>
					<article class="col-md-3">
						<label for="">Genitourinario:</label>
						<button type="button" class="btn-danger"  onclick="verTexto17()" ><span class="ui-icon ui-icon-plus"></span></button>
						<textarea class="form-control" name="genitourinario" rows="5" id="respuesta17" required=""></textarea>
					</article>
					<article class="col-md-3">
						<label for="">Extremidades:</label>
						<button type="button" class="btn-danger"  onclick="verTexto14()" ><span class="ui-icon ui-icon-plus"></span></button>
						<textarea class="form-control" name="ext" rows="5" id="respuesta14" required=""></textarea>
					</article>
					<article class="col-md-3">
						<label for="">Neurologico:</label>
						<button type="button" class="btn-danger"  onclick="verTexto15()" ><span class="ui-icon ui-icon-plus"></span></button>
						<textarea class="form-control" name="neurologico" rows="5" id="respuesta15" required=""></textarea>
					</article>
					<article class="col-md-2">
						<label for="">BARTHEL:</label>
						<input type="text" class="form-control"  name="barthel" value="">
					</article>
					<article class="col-md-2">
						<label for="">CRUZ ROJA:</label>
						<input type="text"  class="form-control" name="cruz_roja" value="">
					</article>
					<article class="col-md-2">
						<label for="">KARNELL:</label>
						<input type="text"  class="form-control" name="karnell" value="">
					</article>
					<article class="col-md-2">
						<label for="">NORTON:</label>
						<input type="text"  class="form-control" name="norton" value="">
					</article>
					<article class="col-md-2">
						<label for="">WEE FIM:</label>
						<input type="text"  class="form-control" name="wee_fim" value="">
					</article>
					<article class="col-md-2">
						<label for="">REISBERG:</label>
						<input type="text" class="form-control"  name="reisberg" value="">
					</article>
					<article class="col-md-2">
						<label for="">GROSS MOTOR:</label>
						<input type="text"  class="form-control" name="gross_motor" value="">
					</article>
					<article class="col-md-2">
						<label for="">HONEN YAHR:</label>
						<input type="text"  class="form-control" name="honen_yahr" value="">
					</article>
					<article class="col-md-12">
						<label for="">FAC:</label>
						<input type="text"  class="form-control" name="fac" value="">
					</article>
		    </div>
				<div id="menu4" class="tab-pane fade">
					<article class="col-md-10">
						<label for="">Analisis:</label>
						<textarea class="form-control" name="analisis" rows="5" id="comment" required=""></textarea>
					</article>
					<article class="col-md-5">
						<label for="">Finalidad de la consulta: </label>
						<select name="finconsulta" class="form-control"  required="" <?php echo atributo3; ?>>
							<option value=""></option>
							<?php
							$sql="SELECT id_fconsulta,descripfconsulta from finalidad_consulta ORDER BY id_fconsulta ASC";
							if($tabla=$bd1->sub_tuplas($sql)){
								foreach ($tabla as $fila2) {
									if ($fila["descripfconsulta"]==$fila2["descripfconsulta"]){
										$sw=' selected="selected"';
									}else{
										$sw="";
									}
								echo '<option value="'.$fila2["descripfconsulta"].'"'.$sw.'>'.$fila2["descripfconsulta"].'</option>';
								}
							}
							?>
						</select>
					</article>
					<article class="col-md-5">
						<label for="">Causa externa: </label>
						<select name="causaexterna" class="form-control"  required=""  <?php echo atributo3; ?>>
							<option value=""></option>
							<?php
							$sql="SELECT id_cexterna,descricexterna from causa_externa ORDER BY id_cexterna ASC";
							if($tabla=$bd1->sub_tuplas($sql)){
								foreach ($tabla as $fila2) {
									if ($fila["descricexterna"]==$fila2["descricexterna"]){
										$sw=' selected="selected"';
									}else{
										$sw="";
									}
								echo '<option value="'.$fila2["descricexterna"].'"'.$sw.'>'.$fila2["descricexterna"].'</option>';
								}
							}
							?>
						</select>
					</article>
		    </div>
				<div id="menu5" class="tab-pane fade">
					<article class="col-md-12">
						<?php include("dxbusqueda.php");?>
					</article>
		    </div>
				<div id="menu6" class="tab-pane fade">
					<section class="col-md-12 text-left">
						<article class="col-md-12">
							<label for="">Plan de tratamiento:</label>
							<textarea class="form-control" name="plant" rows="5" id="comment" required=""></textarea>
						</article>
						<article class="col-md-12 alert alert-info">
							<p>Apreciado medico, a partir de ahora puede realizar registro de las sesiones de terapia, enfermería o medicina que debe autorizar el paciente.</p>
						</article>
						<section class="col-md-6">
							<h3>Valoraciones medicas:</h3>
							<article class="col-md-6">
								<label for="">Cantidad:</label>
								<input type="number" class="form-control" name="cant_valmed" value="0">
							</article>
							<article class="col-md-6">
								<label for="">Periodicidad:</label>
								<select class="form-control" required name="periodo_valmed">
									<option value=""></option>
									<option value="1">1 mes</option>
									<option value="2">2 meses</option>
									<option value="3">3 meses</option>
									<option value="4">4 meses</option>
									<option value="6">6 meses</option>
								</select>
							</article>
						</section>
						<section class="col-md-6">
							<h3>Turnos de enfermería:</h3>
							<article class="col-md-4">
								<label for="">Cantidad:</label>
								<input type="number" class="form-control" name="cant_enfer" value="0"  min="0" max="32">
							</article>
							<article class="col-md-4">
								<label for="">Temporalidad:</label>
								<select class="form-control"  name="temp_valenf">
									<option value=""></option>
									<option value="3">3 Horas</option>
									<option value="6">6 Horas</option>
									<option value="8">8 Horas</option>
									<option value="12">12 Horas</option>
									<option value="24">24 Horas</option>
								</select>
							</article>
							<article class="col-md-4">
								<label for="">Periodicidad:</label>
								<select class="form-control"  name="periodo_valenf">
									<option value=""></option>
									<option value="NA">No aplica</option>
									<option value="L-V">L-V</option>
									<option value="L-S">L-S</option>
									<option value="D-D">D-D</option>
								</select>
							</article>
						</section>
						<section class="col-md-12">
							<h3>Terapias:</h3>
							<article class="col-md-3">
								<label for="">Cantidad Fisioterapia:</label>
								<input type="number" class="form-control" name="cant_fisio" value="0" min="0" max="62">
							</article>
							<article class="col-md-3">
								<label for="">Cantidad Fonoaudiologia:</label>
								<input type="number" class="form-control" name="cant_fono" value="0" min="0" max="62">
							</article>
							<article class="col-md-3">
								<label for="">Cantidad Ocupacional:</label>
								<input type="number" class="form-control" name="cant_to" value="0" min="0" max="62">
							</article>
							<article class="col-md-3">
								<label for="">Cantidad Respiratoria:</label>
								<input type="number" class="form-control" name="cant_resp" value="0" min="0" max="62">
							</article>
						</section>
						<section class="panel-body text-center">
							<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
							<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
							<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
						</section>
					</section>
		    </div>
		  </div>
		</section>
	</section>
</form>
