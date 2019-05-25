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
          source : 'buscups.php'
        });
      });
    </script>
  </head>
  <body>
    <section class="panel-body">
      <article class="col-xs-6">
        <label for="">Seleccione Procedimiento</label>
        <input type="text" name="cups" class="form-control" value="" id="buscar" id="first_name">
      </article>
      <article class="col-xs-6">
        <label for="">Observaciones:</label>
        <textarea name="obs_proc" class="form-control" rows="4" id="last_name"></textarea>
      </article>
    </section>
  </body>
</html>
