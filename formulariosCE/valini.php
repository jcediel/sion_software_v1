<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion='.$opcion.'';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel-body">
	<?php
		include("consulta_paciente.php");
	?>
</section>
	<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Anamnesis</a></li>
    <li><a href="#tabs-2">Antecedentes Personales</a></li>
    <li><a href="#tabs-3">Valoracion</a></li>
		<li><a href="#tabs-6">Impresion Diagnostica</a></li>
		<li><a href="#tabs-7">Plan tratamiento</a></li>
  </ul>
  <div id="tabs-1" class="panel-body">
		<article class="col-xs-3">
			<label for="">Fecha de registro:</label>
			<input type="text" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1?> >
			<input type="hidden" name="idadmhosp" value="<?php echo $fila['id_adm_hosp'];?>">
		</article>
		<article class="col-xs-3">
			<label for="">Hora de registro</label>
			<input type="text" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1?>>
		</article>
		<article class="col-xs-10">
			<label for="">Motivo de consulta:</label>
			<textarea class="form-control" name="m_consulta" rows="5" id="comment" required=""></textarea>
		</article>
		<article class="col-xs-10">
			<label for="" >Enfermedad Actual: <span class="fa fa-info-circle" data-toggle="popover" title="Circunstancias especiales del paciente en relación con su enfermedad" data-content=""></span></label>
			<textarea class="form-control" name="e_actual" rows="5" id="comment" required=""></textarea>
		</article>
  </div>
  <div id="tabs-2" class="panel-body">
		<article class="col-xs-3">
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
    <?php
      if ($fila['genero']=='Masculino') {
        ?>
        <article class="col-xs-3">
    			<label for="">Gineco-obstetricos:</label>
    			<textarea class="form-control" name="antgineco" rows="4" id="respuesta" <?php echo $atributo1; ?>>Antecedente no Aplica debido a genero del paciente.</textarea>
    		</article>
        <?php
      }else {
        ?>
        <article class="col-xs-3">
    			<label for="">Gineco-obstetricos:</label>
    			<textarea class="form-control" name="antgineco" rows="4" id="respuesta" ></textarea>
    		</article>
        <?php
      }
     ?>
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
    <article class="col-xs-12">
			<label for="">Valoración:</label>
			<textarea class="form-control" name="valoracion" rows="9" id="comment" required=""></textarea>
		</article>
  </div>
	<div id="tabs-6" class="panel-body">
		<article class="col-xs-12">
			<?php include("dxbusqueda.php");?>
		</article>
	</div>
	<div id="tabs-7" class="panel-body">
    <article class="col-xs-12">
			<label for="">Recomendaciones:</label>
			<textarea class="form-control" name="recomendaciones" rows="8" id="comment" required=""></textarea>
		</article>
		<article class="col-xs-12">
			<label for="">Plan de tratamiento:</label>
			<textarea class="form-control" name="plan_tratamiento" rows="8" id="comment" required=""></textarea>
		</article>
		<section class="text-center">
		  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</section>
	</div>
</div>
</form>
