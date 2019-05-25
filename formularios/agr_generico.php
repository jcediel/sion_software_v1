<form action="<?php echo PROGRAMA.'?&opcion=91';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">

    <section class="panel-body">
      <article class="col-md-10 col-xs-10 alert-success">
        <label for="">INFORMACION DEL GENERICO</label>
      </article>
      <article class="col-md-10 col-xs-10">
        <label for="">Nombre del medicamento:</label>
        <input type="text" name="nom_generico" class="form-control" id="campoUP" value="<?php echo $fila["nom_generico"];?>" required="" <?php echo $atributo3;?>>
				<input type="hidden" name="id_generico_med" class="form-control" id="campoUP" value="<?php echo $fila["id_generico_med"];?>" required="" <?php echo $atributo3;?>>
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
