<form action="<?php echo PROGRAMA.'?&opcion='.$return;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel-body">
	<?php
		include("consulta_paciente.php");
	?>
</section>
	<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Anamnesis</a></li>
    <li><a href="#tabs-2">Antecedentes Personales</a></li>
    <li><a href="#tabs-3">Examen fisico</a></li>
		<li><a href="#tabs-4">Revision por sistemas y paraclinicos</a></li>
		<li><a href="#tabs-5">Analisis</a></li>
		<li><a href="#tabs-6">Impresion Diagnostica</a></li>
		<li><a href="#tabs-7">Plan tratamiento</a></li>
  </ul>
  <div id="tabs-1" class="panel-body">
		<article class="col-xs-3">
			<label for="">Fecha de registro:</label>
			<input type="text" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1?> >
		</article>
		<article class="col-xs-3">
			<label for="">Hora de registro</label>
			<input type="text" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1?>>
		</article>
		<article class="col-xs-10">
			<label for="">Motivo de consulta:</label>
			<textarea class="form-control" name="motivoconsulta" rows="5" id="comment" required=""></textarea>
		</article>
		<article class="col-xs-10">
			<label for="" >Enfermedad Actual: <span class="fa fa-info-circle" data-toggle="popover" title="Circunstancias especiales del paciente en relación con su enfermedad" data-content=""></span></label>
			<textarea class="form-control" name="enferactual" rows="5" id="comment" required=""></textarea>
		</article>

  </div>
  <div id="tabs-2" class="panel-body">
		<article class="col-xs-3" class="panel-body">
			<label for="">Alergicos:</label>
			<button type="button" class="btn-danger"  onclick="verTexto1()" ><span class="ui-icon ui-icon-plus"></span></button>
			<textarea class="form-control" name="antalergico" rows="4" id="respuesta1" required=""></textarea>
		</article>
		<article class="col-xs-3">
			<label for="">Psiquiatricos:</label>
			<button type="button" class="btn-danger"  onclick="verTexto2()" ><span class="ui-icon ui-icon-plus"></span></button>
			<textarea class="form-control" name="antpsiquiatrico" rows="4" id="respuesta2" required=""></textarea>
		</article>
		<article class="col-xs-3">
			<label for="">Patologicos:</label>
			<button type="button" class="btn-danger"  onclick="verTexto3()" ><span class="ui-icon ui-icon-plus"></span></button>
			<textarea class="form-control" name="antpatologico" rows="4" id="respuesta3" required=""></textarea>
		</article>
		<article class="col-xs-3">
			<label for="">Quirurgicos:</label>
			<button type="button" class="btn-danger"  onclick="verTexto4()" ><span class="ui-icon ui-icon-plus"></span></button>
			<textarea class="form-control" name="antquirurgico" rows="4" id="respuesta4" required=""></textarea>
		</article>
		<article class="col-xs-3">
			<label for="">Toxicológicos:</label>
			<button type="button" class="btn-danger"  onclick="verTexto5()" ><span class="ui-icon ui-icon-plus"></span></button>
			<textarea class="form-control" name="anttoxicologicos" rows="4" id="respuesta5" required=""></textarea>
		</article>
		<article class="col-xs-3">
			<label for="">Farmacológicos:</label>
			<button type="button" class="btn-danger"  onclick="verTexto6()" ><span class="ui-icon ui-icon-plus"></span></button>
			<textarea class="form-control" name="antfarmacologico" rows="4" id="respuesta6" required=""></textarea>
		</article>
		<article class="col-xs-3">
			<label for="">Hospitalarios:</label>
			<button type="button" class="btn-danger"  onclick="verTexto7()" ><span class="ui-icon ui-icon-plus"></span></button>
			<textarea class="form-control" name="anthospitalario" rows="4" id="respuesta7" required=""></textarea>
		</article>
		<article class="col-xs-3">
			<label for="">Gineco-obstetricos:</label>
			<textarea class="form-control" name="antgineco" rows="4" id="respuesta" ></textarea>
		</article>
		<article class="col-xs-4">
			<label for="">Traumatologicos:</label>
			<button type="button" class="btn-danger"  onclick="verTexto8()" ><span class="ui-icon ui-icon-plus"></span></button>
			<textarea class="form-control" name="anttrauma" rows="4" id="respuesta8" required=""></textarea>
		</article>
		<article class="col-xs-4">
			<label for="">Familiares:</label>
			<button type="button" class="btn-danger"  onclick="verTexto9()" ><span class="ui-icon ui-icon-plus"></span></button>
			<textarea class="form-control" name="antfami" rows="4" id="respuesta9" required=""></textarea>
		</article>
		<article class="col-xs-4">
			<label for="">Otros Antecedentes:</label>
			<button type="button" class="btn-danger"  onclick="verTexto10()" ><span class="ui-icon ui-icon-plus"></span></button>
			<textarea class="form-control"  name="antotros" rows="4" id="respuesta10" required=""></textarea>
		</article>
  </div>
  <div id="tabs-3" class="panel-body">
		<article class="col-xs-2">
			<label for="">TAS(mm/hg):</label>
			<input type="text" name="tas" value="" class="form-control">
		</article>
		<article class="col-xs-2">
			<label for="">TAD(mm/hg):</label>
			<input type="text" name="tad" value="" class="form-control">
		</article>
		<article class="col-xs-2">
			<label for="">FC(x min):</label>
			<input type="text" name="fc" value="" class="form-control">
		</article>
		<article class="col-xs-2">
			<label for="">FR(x min):</label>
			<input type="text" name="fr" value="" class="form-control">
		</article>
		<article class="col-xs-2">
			<label for="">SAO2:</label>
			<input type="text" name="sao2" value="" class="form-control">
		</article>
		<article class="col-xs-2">
			<label for="">Peso(Kg):</label>
			<input type="text" name="peso" value="" class="form-control">
		</article>
		<article class="col-xs-2">
			<label for="">Talla(mts): <span class="fa fa-pulse fa-comment-o" data-toggle="popover" title="El valor correspondiente a la talla del paciente debe ser diligenciado en metros Ej: 1.95" data-content=""></span></label>
			<input type="text" name="talla" value="" class="form-control">
		</article>
		<article class="col-xs-2">
			<label for="">Temp(°C):</label>
			<input type="text" name="temperatura" value="" class="form-control">
		</article>
		<article class="col-xs-6 animated tada fuente_alerta_fijo">
			<label class="fuente_alerta_fijo" for="">Doctor(a) los datos que debe ingresar en estos campos deben ser numericos, en el campo de talla digite en metros Ejemplo: 1.95</label>
		</article>
  </div>
	<div id="tabs-4" class="panel-body">
		<article class="col-xs-12">
			<label for="">Revision por sistemas:</label>
			<textarea class="form-control" name="rxs" rows="5"  required=""></textarea>
		</article>
		<article class="col-xs-12">
			<label for="">Paraclinicos:</label>
			<textarea class="form-control" name="paraclinicos" rows="5"  required=""></textarea>
		</article>
	</div>
	<div id="tabs-5" class="panel-body">
		<article class="col-xs-10">
			<label for="">Analisis:</label>
			<textarea class="form-control" name="analisis" rows="5" id="comment" required=""></textarea>
		</article>
		<article class="col-xs-5">
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
		<article class="col-xs-5">
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
	<div id="tabs-6" class="panel-body">
		<article class="col-xs-12">
			<?php include("dxbusqueda.php");?>
		</article>
	</div>
	<div id="tabs-7" class="panel-body">
		<article class="col-xs-12">
			<label for="">Plan de tratamiento:</label>
			<textarea class="form-control" name="plant" rows="8" id="comment" required=""></textarea>
		</article>
		<section class="text-center">
		  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</section>
	</div>
</div>
</form>
