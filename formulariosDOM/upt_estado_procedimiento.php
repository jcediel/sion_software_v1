<form action="<?php echo PROGRAMA.'?&opcion='.$return.'&idpresentacion='.$return2.'&idpac='.$return3;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading"><h4>Definición del estado de procedimientos</h4></section>
    <section class="panel-body">
      <article class="col-xs-1">
  	  	<label for="">ID:</label>
  	  	<input type="text"  name="idproced" class="form-control" value="<?php echo $_REQUEST["idpprod"];?>"<?php echo $atributo1;?>/>
  	  </article>
  	  <article class="col-xs-11">
  	  	<label for="">Estado del Procedimiento:</label>
        <select class="form-control" name="estprod" required="">
          <option value=""></option>
          <option value="Asignada">Procedimiento aceptado en servicio domiciliarios</option>
          <option value="Cancelado">Cancelación del procedimiento</option>
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
