<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/jquery-ui.css" media="screen" title="no title" charset="utf-8">
    <script src="js/jquery-3.1.1.min.js" charset="utf-8"></script>
    <script src="js/jquery-ui.min.js" charset="utf-8"></script>
    <script type="text/javascript">
  $('document').ready(function() {
        $('#buscarfab').autocomplete({
          source : 'busfab.php'
        });
      });
    </script>
  </head>
  <body>
    <article class="">
      <label for="">Seleccione Laboratorio:</label>
      <input type="text" name="laboratorio" class="form-control" value="<?php echo $fila['laboratorio'] ?>" id="buscarfab"  <?php echo $atributo2 ?>>
    </article>
  </body>
</html>
