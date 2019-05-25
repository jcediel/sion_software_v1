<form action="<?php echo PROGRAMA.'?opcion='.$return.'&idpresentacion='.$return2.'&idpac='.$return3;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading"><h4>Definición del estado de procedimientos</h4></section>
    <section class="panel-body">
      <article class="col-xs-1">
  	  	<label for="">ID:</label>
  	  	<input type="text"  name="idpresentacion" class="form-control" value="<?php echo $_REQUEST["idpresentacion"];?>"<?php echo $atributo1;?>/>
        <input type="text" class="form-control" name="docpac" value="<?php echo $fila['doc_pac']?>" <?php echo $atributo1; ?>>
  	  </article>
  	  <article class="col-xs-11">
  	  	<label for="">Seleccione estado de la presentación del paciente:</label>
        <select class="form-control" name="estprod" required="">
          <option value=""></option>
          <option value="Aceptado">Aceptación de la presentación</option>
          <option value="Cancelado">Cancelación de la presentación</option>
        </select>
      </article>
  	  <article class="col-xs-12">
  	  	<label for="">Observacion:</label>
  	  	<textarea name="obs_pprocedimiento" rows="5" class="form-control" ></textarea>
  	  </article>
    </section>
    <div class="row text-center">
		  <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>
  </section>
</form>
