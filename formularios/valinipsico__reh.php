<form action="<?php echo PROGRAMA.'?&opcion=50';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-body">
	  <?php
	    include("consulta_paciente.php");
	  ?>
	</section>
		<article>
			<h4 id="th-estilot">Datos de Valoración inicial Psicologia</h4>

				<section class="panel-body"> <!---->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#anamnesis" >Lenguaje</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="anamnesis">
						<article class="col-xs-3">
							<label for="">Fecha de registro:</label>
							<input type="text" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1?> >
						</article>
						<article class="col-xs-3">
							<label for="">Hora de registro</label>
							<input type="text" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1?>>
						</article>
						<div class="col-xs-10">

						</div>
						<article class="col-xs-5">
							<label for="">Lenguaje Comprensivo:</label>
							<select class="form-control" name="leng_comprensivo">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-5">
							<label for="">Lenguaje Expresivo:</label>
							<select class="form-control" name="leng_expresivo">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!---->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#praxis" >Comportamiento</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="praxis">

						<article class="col-xs-3">
							<label for="">Sigue instrucciones?:</label>
							<select class="form-control" name="comportamiento1">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
								<option value="Simple">Simple</option>
								<option value="Semi-complejas">Semi-complejas</option>
								<option value="Complejas">Complejas</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Presenta conductas disruptivas:</label>
							<select class="form-control" name="comportamiento2">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
								<option value="Auto-lesivas">Auto-lesivas</option>
								<option value="Hetero-lesivas">Hetero-lesivas</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Actividad Motora:</label>
							<select class="form-control" name="comportamiento3">
								<option value="Alta">Alta</option>
								<option value="Adecuada para edad">Adecuada para edad</option>
								<option value="Baja">Baja</option>
							</select>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#desarrollo" >Área emocional</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="desarrollo">
						<article class="col-xs-10">
							<label for="">Temperamento:</label>
							<select class="form-control" name="aemocional1">
								<option value="Tranquilo">Tranquilo</option>
								<option value="Irritabilidad">Irritabilidad</option>
							</select>
						</article>
						<article class="col-xs-10">
							<label for="">Tolerancia a la frustración:</label>
							<select class="form-control" name="aemocional2">
								<option value="Baja">Baja</option>
								<option value="Control">Control</option>
								<option value="Logra">Logra</option>
							</select>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#nivel" >Social - Personal</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="nivel">
						<article class="col-xs-2">
							<img src="images/feliz.png" class="imagecara" alt="" />
							<select class="form-control" name="reconoce1">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-2">
							<img src="images/pensativo.png" class="imagecara" alt="" />
							<select class="form-control" name="reconoce2">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-2">
							<img src="images/serio.png" class="imagecara" alt="" />
							<select class="form-control" name="reconoce3">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-2">
							<img src="images/asustado.png" class="imagecara" alt="" />
							<select class="form-control" name="reconoce4">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-2">
							<img src="images/triste.png" class="imagecara" alt="" />
							<select class="form-control" name="reconoce5">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-2">
							<img src="images/lloron.png" class="imagecara" alt="" />
							<select class="form-control" name="reconoce6">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-5">
							<label for="">Repertorios sociales:</label>
							<select class="form-control" name="nsintac1">
								<option value="Contacto limitado">Contacto limitado</option>
								<option value="Básicos">Básicos</option>
								<option value="De cortesia">De cortesia</option>
								<option value="Con intension">Con intension</option>
							</select>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#sintactico" >Atención</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="sintactico">
						<article class="col-xs-5">
							<label for="">Sostenida:</label>
							<select class="form-control" name="atencion1">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-5">
							<label for="">Focalizada:</label>
							<select class="form-control" name="atencion2">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-5">
							<label for="">Alternante:</label>
							<select class="form-control" name="atencion3">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-5">
							<label for="">Dividida:</label>
							<select class="form-control" name="atencion4">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-5">
							<label for="">Selectiva:</label>
							<select class="form-control" name="atencion5">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-7">
							<label for="">Caracteristicas Atención:</label>
							<textarea class="form-control" name="carac_atencion" rows="4" id="comment" ></textarea>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#pragmatico" >Memoria:</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="pragmatico">
						<article class="col-xs-5">
							<label for="">Recuerda corto plazo:</label>
							<select class="form-control" name="memoria1">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-5">
							<label for="">Recuerda largo plazo:</label>
							<select class="form-control" name="memoria2">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#senso" >Relación con el medio</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="senso">
						<article class="col-xs-4">
							<label for="">Contacto, mantenimiento y seguimiento visual:</label>
							<select class="form-control" name="rela_medio1">
								<option value="Objetos">Objetos</option>
								<option value="Objetos y personas">Objetos y personas</option>
								<option value="Ninguno">Ninguno</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Defencibilidad táctil:</label>
							<select class="form-control" name="rela_medio2">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
								<option value="Discrimina">Discrimina</option>
							</select>
						</article><article class="col-xs-3">
							<label for="">Dominancia manual:</label>
							<select class="form-control" name="rela_medio3">
								<option value="Zurdo(a)">Zurdo(a)</option>
								<option value="Diestro(a)">Diestro(a)</option>
								<option value="Indiferenciada">Indiferenciada</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Comunicación:</label>
							<select class="form-control" name="rela_medio4">
								<option value="Verbal">Verbal</option>
								<option value="No verbal">No verbal</option>
								<option value="Por">Por</option>
							</select>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#codlecto" >Dinámica familiar</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="codlecto">
						<article class="col-xs-10">
							<label for="">Relaciones familiares:</label>
							<textarea class="form-control" name="rel_familiar" rows="7" id="comment" ></textarea>
						</article>
						<article class="col-xs-10">
							<label for="">Pautas de crianza:</label>
							<textarea class="form-control" name="pauta_crianza" rows="7" id="comment" ></textarea>
						</article>
						<article class="col-xs-10">
							<label for="">Escolaridad:</label>
							<textarea class="form-control" name="escolaridad" rows="7" id="comment" ></textarea>
						</article>
						<article class="col-xs-3">
							<label for="">Examen mental:</label>
							<select class="form-control" name="e_mental">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
								<option value="Parcialmente">Parcialmente</option>
							</select>
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
