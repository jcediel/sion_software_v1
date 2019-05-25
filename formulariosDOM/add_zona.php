<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
          $("#codigo").autocomplete({
              source: "formulariosDOM/bus_barrio.php",
              minLength: 1,
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
<form action="<?php echo PROGRAMA.'?opcion='.$return.'&iduser='.$return2;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-body">
      <article class="">
        <input type="text" name="iduserzona" value="<?php echo $_GET['iduser'];?>">
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
		  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>
  </section>
</form>
