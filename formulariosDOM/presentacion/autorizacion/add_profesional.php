<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
          $("#codigo").autocomplete({
              source: "vista_administrativo/autorizacion/bus_profesional.php",
              minLength: 4,
              select: function(event, ui) {
        event.preventDefault();
                  $('#codigo').val(ui.item.codigo);
        $('#descripcion').val(ui.item.descripcion);

         }
          });

  });
</script>
<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio='.$servicio.'&buscar=Buscar&opcion='.$option;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel-body">
    <article class="col-md-2">
      <label for="">CUPS a realizar:</label>
      <input type="text" class="form-control" name="" value="<?php echo $fila['cups_d_aut']?>">
    </article>
    <article class="col-md-6">
      <label for="">Descripción del procedimiento:</label>
      <input type="text" class="form-control" name="" value="<?php echo $fila['procedimiento_d_aut']?>">
    </article>
  </section>
  <section class="panel-body">
    <article class="col-md-4">
      <label for="">Seleccione profeisonal:</label>
      <input type="text" class="form-control" name="user_profesional" id="codigo" value="">
      <input type="hidden" required="" class="form-control" name="id_d_aut" value="<?php echo $fila['id_d_aut']?>">
    </article>
    <article class="col-md-8">
      <label for="">Profesional seleccionada:</label>
      <input type="text" class="form-control" name="descrip_profesional" id="descripcion"  <?php echo $atributo1;?>>
    </article>
  </section>
  <br>
  <section class="panel-body col-md-3">
    <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" /><br>
    <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
    <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
  </section>
</form>
