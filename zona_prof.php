<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/jquery-ui.css" media="screen" title="no title" charset="utf-8">
    <script src="js/jquery-3.1.1.min.js" charset="utf-8"></script>
    <script src="js/jquery-ui.min.js" charset="utf-8"></script>
    <script type="text/javascript">
  $('document').ready(function() {
        $('#buscarzona').autocomplete({
          source : 'buszonaprof.php'
        });
      });
    </script>
  </head>
  <body>
    <article class="col-xs-12">
      <label for="">Seleccione Profesional:</label>
      <input type="text" name="zonificacion" class="form-control" value="<?php echo $zona;?>" id="buscarzona" required="">
    </article>
  </section>
  </body>
</html>
