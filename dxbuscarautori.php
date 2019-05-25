<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/jquery-ui.css" media="screen" title="no title" charset="utf-8">
    <script src="js/jquery-3.1.1.min.js" charset="utf-8"></script>
    <script src="js/jquery-ui.min.js" charset="utf-8"></script>
    <script type="text/javascript">
  $('document').ready(function() {
        $('#buscardx').autocomplete({
          source : 'dxautori.php'
        });
      });
    </script>
  </head>
  <body>
<section class="panel-body">
      <table class="table table-bordered">
        <tr>
          <td class="text-center alert alert-danger"><strong>SELECCION DE DIAGNOSTICO</strong></td>
        </tr>
        <tr>
            <td class="alert-info">
              <label for="">Diagnostico Principal</label>
              <input type="text" name="dx_autorizacion" class="form-control" value="" id="buscardx">
            </td>
        </tr>
      </table>
  </section>
  </body>
</html>
