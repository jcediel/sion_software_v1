<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/jquery-ui.css" media="screen" title="no title" charset="utf-8">
    <script src="js/jquery-3.1.1.min.js" charset="utf-8"></script>
    <script src="js/jquery-ui.min.js" charset="utf-8"></script>
    <script type="text/javascript">
  $('document').ready(function() {
        $('#buscar').autocomplete({
          source : 'cupsautori.php'
        });
      });
    </script>
  </head>
  <body>
    <section class="panel-body">
      <article class="col-xs-8">
        <label for="">Seleccione Procedimiento</label>
        <input type="text" name="cups1" class="form-control" value="<?php echo $fila["cups"];?>" id="buscar" <?php echo $atributo2;?>>
      </article>
      <article class="col-xs-2">
        <label for="">Frecuencia:</label>
        <select class="form-control" value="" name="frecuencia" required="" <?php echo $atributo3;?>>
          <option value="<?php echo $fila["frecuencia"];?>"><?php echo $fila["frecuencia"];?></option>
          <option value="20">20 minutos</option>
          <option value="30">30 minutos</option>
          <option value="40">40 minutos</option>
          <option value="60">1 hora</option>
          <option value="3">3 horas</option>
          <option value="6">6 horas</option>
          <option value="8">8 horas</option>
          <option value="12">12 horas</option>
          <option value="24">24 horas</option>
          <option value="12">12 horas nocturna</option>
          <option value="24">24 horas nocturna</option>
          <option value="No aplica">No aplica</option>
        </select>
      </article>
      <article class="col-xs-2">
        <label for="">Cantidad:</label>
        <input type="number" name="cantidad" class="form-control" value="<?php echo $fila["cantidad"];?>" <?php echo $atributo2;?>>
      </article>
    </section>
  </body>
</html>
