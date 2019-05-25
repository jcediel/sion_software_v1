<form action="<?php echo PROGRAMA.'?&opcion=48';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-body">
	  <?php
	    include("consulta_paciente.php");
	  ?>
	</section>

		<article>
			<h4 id="th-estilot">Datos de Valoración inicial Fonoaudiologia</h4>

				<section class="panel-body"> <!---->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#anamnesis" >Exploración de órganos fonoarticuladores (ofa)</a>
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
							<label for="">Tono Muscular:</label>
							<textarea class="form-control" name="tmuscular_i" rows="3" id="comment" ></textarea>
						</article>
						<article class="col-xs-5">
							<label for="">Sensibilidad:</label>
							<textarea class="form-control" name="sencibilidad_i" rows="3" id="comment" ></textarea>
						</article>
						<article class="col-xs-5">
							<label for="">Simetria Facial:</label>
							<textarea class="form-control" name="simetria" rows="3" id="comment" ></textarea>
						</article>
						<article class="col-xs-5">
							<label for="">Labios:</label>
							<textarea class="form-control" name="labios" rows="3" id="comment" ></textarea>
						</article>
						<article class="col-xs-5">
							<label for="">Lengua:</label>
							<textarea class="form-control" name="lengua" rows="3" id="comment" ></textarea>
						</article>
						<article class="col-xs-5">
							<label for="">Maxilares:</label>
							<textarea class="form-control" name="maxilares" rows="3" id="comment" ></textarea>
						</article>
						<article class="col-xs-5">
							<label for="">Paladar:</label>
							<textarea class="form-control" name="paladar" rows="3" id="comment" ></textarea>
						</article>
						<article class="col-xs-5">
							<label for="">Sialorrea:</label>
							<textarea class="form-control" name="sialorrea" rows="3" id="comment" ></textarea>
						</article>
						<article class="col-xs-5">
							<label for="">Respiración:</label>
							<textarea class="form-control" name="respiracion" rows="3" id="comment" ></textarea>
						</article>
						<article class="col-xs-5">
							<label for="">Tipo Oclusión:</label>
							<textarea class="form-control" name="oclusion" rows="3" id="comment" ></textarea>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!---->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#praxis" >Praxias Orofaciales</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="praxis">

						<article class="col-xs-3">
							<label for="">Sacar y meter la lengua:</label>
							<select class="form-control" name="praxia1">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
								<option value="TORPE">TORPE</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Mover la lengua de derecha a izquierda:</label>
							<select class="form-control" name="praxia2">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
								<option value="TORPE">TORPE</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Mover la lengua de arriba abajo:</label>
							<select class="form-control" name="praxia3">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
								<option value="TORPE">TORPE</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Protruir labios:</label>
							<select class="form-control" name="praxia4">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
								<option value="TORPE">TORPE</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Extender labios:</label>
							<select class="form-control" name="praxia3">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
								<option value="TORPE">TORPE</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Chupar carrillos:</label>
							<select class="form-control" name="praxia6">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
								<option value="TORPE">TORPE</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Inflar o desinflar mejillas:</label>
							<select class="form-control" name="praxia7">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
								<option value="TORPE">TORPE</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Abrir y cerrar la boca:</label>
							<select class="form-control" name="praxia8">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
								<option value="TORPE">TORPE</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Mover maxilar de derecha a izquierda:</label>
							<select class="form-control" name="praxia9">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
								<option value="TORPE">TORPE</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Movimientos circulares de la lengua:</label>
							<select class="form-control" name="praxia10">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
								<option value="TORPE">TORPE</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Chasquear la lengua:</label>
							<select class="form-control" name="praxia11">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
								<option value="TORPE">TORPE</option>
							</select>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#desarrollo" >Desarrollo Linguístico,test de articulación y Funciones Alimenticias</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="desarrollo">
						<article class="col-xs-10">
							<label for="">Desarrollo Linguístico (reflejos prImitivos, pre requisitos de lenguaje):</label>
							<textarea class="form-control" name="desa_lingue" rows="4" id="comment" ></textarea>
						</article>
						<article class="col-xs-10">
							<label for="">Test de articulación:</label>
							<textarea class="form-control" name="tetst_arti" rows="4" id="comment" ></textarea>
						</article>
						<article class="col-xs-10">
							<label for="">Funciones Alimenticias:</label>
							<textarea class="form-control" name="oclusion" rows="4" id="comment" ></textarea>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#nivel" >Nivel Semántico</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="nivel">
						<article class="col-xs-3">
							<label for="">Reconoce categorías semánticas:</label>
							<select class="form-control" name="nseman1">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Ejecuta tareas verbales simples:</label>
							<select class="form-control" name="nseman2">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-3">
							<label for="">Ejecuta tareas verbales complejas :</label>
							<select class="form-control" name="nseman3">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-3">
							<label for="">Reconoce conceptos espaciales:</label>
							<select class="form-control" name="nseman4">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-3">
							<label for="">Reconoce conceptos temporales:</label>
							<select class="form-control" name="nseman5">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-3">
							<label for="">Reconoce conceptos de cantidad:</label>
							<select class="form-control" name="nseman6">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#sintactico" >Nivel Sintáctico</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="sintactico">
						<article class="col-xs-5">
							<label for="">Emplea pronombres personales:</label>
							<select class="form-control" name="nsintac1">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-5">
							<label for="">Emplea sustantivos masculino y femenino:</label>
							<select class="form-control" name="nsintac2">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-5">
							<label for="">Emplea y conjuga verbos en forma correcta:</label>
							<select class="form-control" name="nsintac3">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-5">
							<label for="">Emplea Adjetivos:</label>
							<select class="form-control" name="nsintac4">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-5">
							<label for="">Emplea Adverbios:</label>
							<select class="form-control" name="nsintac5">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-5">
							<label for="">Estructura frases con sentido gramatical:</label>
							<select class="form-control" name="nsintac6">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#pragmatico" >Nivel Pragmático</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="pragmatico">
						<article class="col-xs-3">
							<label for="">Expresa deseos:</label>
							<select class="form-control" name="nprag1">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Expresa emociones:</label>
							<select class="form-control" name="nprag2">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-3">
							<label for="">Realiza preguntas:</label>
							<select class="form-control" name="nprag3">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-3">
							<label for="">Realiza descripciones:</label>
							<select class="form-control" name="nprag4">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-3">
							<label for="">Realiza narraciones:</label>
							<select class="form-control" name="nprag5">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-3">
							<label for="">Considera al oyente en la comunicación:</label>
							<select class="form-control" name="nprag6">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Tolera contacto visual:</label>
							<select class="form-control" name="nprag7">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Realiza contacto visual con intención:</label>
							<select class="form-control" name="nprag8">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#senso" >Sensopercepción</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="senso">
						<article class="col-xs-3">
							<label for="">Reporta pérdida auditiva:</label>
							<select class="form-control" name="senso1">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Reporta perdida visual:</label>
							<select class="form-control" name="senso2">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-3">
							<label for="">Tolera estímulos auditivos:</label>
							<select class="form-control" name="senso3">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-3">
							<label for="">Tolera estímulos visuales:</label>
							<select class="form-control" name="senso4">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-3">
							<label for="">Percepción de sonido:</label>
							<select class="form-control" name="senso5">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article><article class="col-xs-3">
							<label for="">Ubicación de fuente sonora:</label>
							<select class="form-control" name="senso6">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Memoria auditiva:</label>
							<select class="form-control" name="senso7">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
						<article class="col-xs-3">
							<label for="">Memoria visual:</label>
							<select class="form-control" name="senso8">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#codlecto" >Código Lecto - Escrito</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="codlecto">
						<article class="col-xs-10">
							<label for="">Código Lecto - Escrito:</label>
							<textarea class="form-control" name="codlectoescrito" rows="7" id="comment" ></textarea>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#dxcomun" >Diagnostico Comunicativo</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="dxcomun">
						<article class="col-xs-10">
							<label for="">Diagnostico Comunicativo:</label>
							<textarea class="form-control" name="dxcomunicativo" rows="7" id="comment" ></textarea>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#plan" >Plan de Manejo</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="plan">
						<article class="col-xs-10">
							<label for="">Plan manejo:</label>
							<textarea class="form-control" name="planManejo" rows="7" id="comment" ></textarea>
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
