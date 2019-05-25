<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/jquery-ui.css" media="screen" title="no title" charset="utf-8">
    <script src="js/jquery-3.1.1.min.js" charset="utf-8"></script>
    <script src="js/jquery-ui.min.js" charset="utf-8"></script>
    <script type="text/javascript">
  $('document').ready(function() {
        $('#buscarmed').autocomplete({
          source : 'busmed.php'
        });
      });
    </script>
  </head>
  <body>
    <label for="">Medicamento</label> 
    <input type="text" name="medicamento" class="form-control" value="" id="buscarmed" required="">  </body>
</html>
