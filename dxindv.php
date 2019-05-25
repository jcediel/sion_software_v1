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
          source : 'busdx.php'
        });
      });
    </script>
  </head>
  <body>
<section class="panel-body">
      <table class="table table-bordered">
        <tr>
          <td class="text-center alert alert-danger"><strong>SELECCION DE DIAGNOSTICO</strong></td>
          <td class="text-center alert alert-danger"><strong>TIPO DIAGNOSTICO</strong></td>
        </tr>
        <tr>
            <td class="alert-info col-xs-10">
              <label for="">Diagnostico Principal</label>
              <input type="text" name="dx" class="form-control" value="<?php echo $fila['dx_autori']?>" id="buscardx" required="">
            </td>
            <td class="alert-info col-xs-2">
              <label for=""></label>
              <select class="form-control" name="tdx" required="">
                <option value="<?php echo $fila['tdx_autori']?>"><?php echo $fila['tdx_autori']?></option>
                <option value="Impresion Diagnostica">Impresion Diagnostica</option>
                <option value="Confirmado Nuevo">Confirmado Nuevo</option>
                <option value="Confirmado Repetido">Confirmado Repetido</option>
              </select>
            </td>
        </tr>
      </table>
  </section>
  </body>
</html>
