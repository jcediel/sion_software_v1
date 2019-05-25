<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
          $("#codigo").autocomplete({
              source: "formulariosDOM/bus_barrio.php",
              minLength: 4,
              select: function(event, ui) {
        event.preventDefault();
                  $('#codigo').val(ui.item.codigo);
        $('#descripcion').val(ui.item.descripcion);
        $('#precio').val(ui.item.precio);
        $('#id_producto').val(ui.item.id_producto);
         }
          });
  });
</script>
<form action="<?php echo PROGRAMA.'?opcion='.$return;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-body">
      <article class="col-xs-1">
  	  	<label for="">ID:</label>
  	  	<input type="text"  name="idpac" class="form-control" value="<?php echo $_REQUEST["idpac"];?>"<?php echo $atributo1;?>/>
        <input type="text" class="form-control" name="docpac" value="<?php echo $fila['doc_pac']?>" <?php echo $atributo1; ?>>
  	  </article>
  	  <article class="col-xs-5">
  	  	<label for="">Dirección del paciente:</label>
        <input type="text" name="dir_pac" class="form-control" value="<?php echo $fila['dir_pac'];?>">
      </article>
      <article class="col-xs-3">
        <label for="">Seleccione barrio de ubicación:</label>
        <input type="text" class="form-control" name="search" id="codigo" value="">
        <input type="hidden" name="zonificacion" id="id_producto">
      </article>
      <article class="col-xs-3">
        <label for="">Barrio seleccionado:</label>
        <input type="text" class="form-control" name="nom_barrio" id="descripcion" value="" <?php echo $atributo1;?>>
      </article>
    </section>
    <div class="row text-center">
		  <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>
  </section>
</form>
