<form action="<?php echo PROGRAMA.'?&opcion=44';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-body">
	  <?php
	    include("consulta_paciente.php");
	  ?>
	</section>

	<article>
		<h4 id="th-estilot">Datos de historia Clínica</h4>
	</article>

	<section class="panel-body"> <!--Anamnesis-->
		<div class="botonhc">
				<a data-toggle="collapse" class="ac" data-target="#anamnesis" >Anamnesis</a>
				<span class="glyphicon glyphicon-arrow-down"></span>
				<span class="badge">OK</span>
		</div>
		<section class="collapse" id="anamnesis">
			<article class="col-xs-3">
				<label for="">Fecha de registro:</label>
				<input type="date" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo2?> >
			</article>
			<article class="col-xs-3">
				<label for="">Hora de registro</label>
				<input type="time" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo2?>>
			</article>
			<article class="col-xs-10">
				<label for="">Motivo de consulta:<span class="fa fa-info-circle" data-toggle="popover" title="Descripcion subjetiva emitida por el paciente o su acudiente en la consulta" data-content=""></span></label>
				<textarea class="form-control" name="motivoconsulta" rows="5" id="comment" required=""></textarea>
			</article>
			<article class="col-xs-10">
				<label for="" >Enfermedad Actual: <span class="fa fa-info-circle" data-toggle="popover" title="Descripcion tecnica del comentario realizado en el "motivo de consulta"" data-content=""></span></label>
				<textarea class="form-control" name="enferactual" rows="5" id="comment" required=""></textarea>
			</article>
		</section>
</section>
<section class="panel-body">
		<div class="botonhc">
			<a data-toggle="collapse" class="ac" data-target="#antpersonal" >Antecedentes Personales <span class="glyphicon glyphicon-arrow-down"></span> </a>
			<span class="badge">OK</span>
		</div>
		  <section id="antpersonal" class="collapse">
				<article class="col-xs-3">
			  	<label for="">Alergicos:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto1()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto1()"></button>
			  	<textarea class="form-control" name="antalergico" rows="4" id="respuesta1" required=""></textarea>
			  </article>
				<article class="col-xs-3">
			  	<label for="">Psiquiatricos:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto2()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto2()"></button>
			  	<textarea class="form-control" name="antpsiquiatrico" rows="4" id="respuesta2" required=""></textarea>
			  </article>
				<article class="col-xs-3">
					<label for="">Patologicos:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto3()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto3()"></button>
					<textarea class="form-control" name="antpatologico" rows="4" id="respuesta3" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Quirurgicos:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto4()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto4()"></button>
					<textarea class="form-control" name="antquirurgico" rows="4" id="respuesta4" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Toxicológicos:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto5()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto5()"></button>
					<textarea class="form-control" name="anttoxicologicos" rows="4" id="respuesta5" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Farmacológicos:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto6()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto6()"></button>
					<textarea class="form-control" name="antfarmacologico" rows="4" id="respuesta6" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Hospitalarios:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto7()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto7()"></button>
					<textarea class="form-control" name="anthospitalario" rows="4" id="respuesta7" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Gineco-obstetricos:</label>
					<textarea class="form-control" name="antgineco" rows="4" id="respuesta" ></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Traumatologicos:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto8()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto8()"></button>
					<textarea class="form-control" name="anttrauma" rows="4" id="respuesta8" required=""></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Familiares:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto9()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto9()"></button>
					<textarea class="form-control" name="antfami" rows="4" id="respuesta9" required=""></textarea>
				</article>
				<article class="col-xs-6">
					<label for="">Otros Antecedentes:</label>
					<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto10()" ></button>
   				<button type="button" class="fa fa-minus btn-danger" onclick="ocultarTexto10()"></button>
					<textarea class="form-control"  name="antotros" rows="4" id="respuesta10" required=""></textarea>
				</article>
		  </section>
</section>
<section class="panel-body">
			<div class="botonhc">
				<a data-toggle="collapse" class="ac" data-target="#exmental" >EXAMENES DIAGNOSTICOS<span class="glyphicon glyphicon-arrow-down"></span> </a>
				<span class="badge">OK</span>
			</div>
			<section id="exmental" class="collapse">
				<article class="col-xs-10">
					<label for="">Analisis:</label>
					<textarea class="form-control" name="analisis" rows="5" id="comment" required=""></textarea>
				</article>
				<article class="col-xs-5">
					<label for="">Finalidad de la consulta: </label>
					<select name="finconsulta" class="form-control" <?php echo atributo3; ?>>
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
				<article class="col-xs-5">
					<label for="">Causa externa: </label>
					<select name="causaexterna" class="form-control" <?php echo atributo3; ?>>
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
			</section>
</section>
<section class="panel-body">
		<div class="botonhc">
			<a data-toggle="collapse" class="ac" data-target="#dxingreso" >Diagnosticos Ingreso<span class="glyphicon glyphicon-arrow-down"></span> </a>
			<span class="badge text-left">OK</span>
		</div>
			<section id="dxingreso" class="collapse">
				<article class="col-xs-12">
					<?php include("dxbusqueda.php");?>
				</article>
			</section>
	</section>
	<section class="panel-body">
			<div class="botonhc">
				<a data-toggle="collapse" class="ac" data-target="#plan" >Plan tratamiento y recomendaciones<span class="glyphicon glyphicon-arrow-down"></span> </a>
				<span class="badge text-left">OK</span>
			</div>
				<section id="plan" class="collapse">
					<article class="col-xs-12">
						<label for="">Describa aqui el Plan de tratamiento</label>
						<textarea name="plan_tratamiento" rows="8" class="form-control"></textarea>
					</article>
					<article class="col-xs-12">
						<label for="">Describaaqui las recomendaciones</label>
						<textarea name="reco" rows="8" class="form-control"></textarea>
					</article>
				</section>
		</section>

	<div class="row text-center">
	  	<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>

</form>
