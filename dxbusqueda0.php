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
        $('#buscardx1').autocomplete({
          source : 'busdx.php'
        });
        $('#buscardx2').autocomplete({
          source : 'busdx.php'
        });
        $('#buscardx3').autocomplete({
          source : 'busdx.php'
        });

      });
    </script>
  </head>
  <body>
<section class="panel-body col-xs-12">
  <?php  ?>
      <table class="table table-bordered">
        <tr>
          <td class="text-center alert alert-danger"><strong>SELECCION DE DIAGNOSTICO</strong></td>
          <td class="text-center alert alert-danger"><strong>TIPO DIAGNOSTICO</strong></td>
        </tr>
        <tr>

        <?php
          $adm=$_REQUEST['idadmhosp'];
          $sql_dx="SELECT ddxp,tdxp FROM evolucion_medica a inner join user b on a.id_user=b.id_user
           WHERE a.id_adm_hosp=$adm and b.id_perfil=3 ORDER BY id_evomed DESC limit 1";
           //echo $sql_dx;
           if ($tabla_dx=$bd1->sub_tuplas($sql_dx)){
             foreach ($tabla_dx as $fila_dx) {
               ?>
               <td class="alert-info">
                 <label for="">Diagnostico Principal</label> <label for="" class="text-danger"><span class="fa fa-info-circle"></span> Recuerde que este dx es obligatorio</label>
                 <input type="text" name="dx" class="form-control" value="<?php echo $fila_dx['ddxp'] ?>" id="buscardx" required="">
               </td>
               <td class="alert-info">
                 <label for="">Tipo diagnostico:</label>
                 <select class="form-control" name="tdx" required="">
                   <option value="<?php echo $fila_dx['tdxp'] ?>"><?php echo $fila_dx['tdxp'] ?></option>
                   <option value="Impresion Diagnostica">Impresion Diagnostica</option>
                   <option value="Confirmado Nuevo">Confirmado Nuevo</option>
                   <option value="Confirmado Repetido">Confirmado Repetido</option>
                 </select>
               </td>
               <?php
             }
           }else {
             ?>
             <td class="alert-info">
               <label for="">Diagnostico Principal</label> <label for="" class="text-danger"><span class="fa fa-info-circle"></span> Recuerde que este dx es obligatorio</label>
               <input type="text" name="dx" class="form-control" value="" id="buscardx" required="">
             </td>
             <td class="alert-info">
               <label for="">Tipo diagnostico:</label>
               <select class="form-control" name="tdx" required="">
                 <option value=""></option>
                 <option value="Impresion Diagnostica">Impresion Diagnostica</option>
                 <option value="Confirmado Nuevo">Confirmado Nuevo</option>
                 <option value="Confirmado Repetido">Confirmado Repetido</option>
               </select>
             </td>
             <?php
           }

        ?>
        </tr>
        <tr>
          <?php
            $adm=$_REQUEST['idadmhosp'];
            $sql_dx1="SELECT ddx1,tdx1 FROM evolucion_medica a inner join user b on a.id_user=b.id_user
             WHERE a.id_adm_hosp=$adm and b.id_perfil=3 ORDER BY id_evomed DESC limit 1";
             //echo $sql_dx1;
             if ($tabla_dx1=$bd1->sub_tuplas($sql_dx1)){
               foreach ($tabla_dx1 as $fila_dx1) {
                 ?>
                 <td class="">
                   <label for="">Diagnostico Relacionado 1</label>
                   <input type="text" name="dx1" class="form-control" value="<?php echo $fila_dx1['ddx1'] ?>" id="buscardx1">
                 </td>
                 <td class="">
                   <label for="">Tipo diagnostico:</label>
                   <select class="form-control" name="tdx1">
                     <option value="<?php echo $fila_dx1['tdx1'] ?>"><?php echo $fila_dx1['tdx1'] ?></option>
                     <option value="Impresion Diagnostica">Impresion Diagnostica</option>
                     <option value="Confirmado Nuevo">Confirmado Nuevo</option>
                     <option value="Confirmado Repetido">Confirmado Repetido</option>
                   </select>
                 </td>
                 <?php
               }
             }else {
               ?>
               <td class="">
                 <label for="">Diagnostico Relacionado 1</label>
                 <input type="text" name="dx1" class="form-control" value="" id="buscardx1">
               </td>
               <td class="">
                 <label for="">Tipo diagnostico:</label>
                 <select class="form-control" name="tdx1">
                   <option value=""></option>
                   <option value="Impresion Diagnostica">Impresion Diagnostica</option>
                   <option value="Confirmado Nuevo">Confirmado Nuevo</option>
                   <option value="Confirmado Repetido">Confirmado Repetido</option>
                 </select>
               </td>
               <?php
             }
             ?>

        </tr>
        <tr>
          <?php
            $adm=$_REQUEST['idadmhosp'];
            $sql_dx2="SELECT ddx2,tdx2 FROM evolucion_medica a inner join user b on a.id_user=b.id_user
             WHERE a.id_adm_hosp=$adm and b.id_perfil=3 ORDER BY id_evomed DESC limit 1";
             //echo $sql_dx1;
             if ($tabla_dx2=$bd1->sub_tuplas($sql_dx2)){
               foreach ($tabla_dx2 as $fila_dx2) {
                 ?>
          <td class="">
            <label for="">Diagnostico Relacionado 2</label>
            <input type="text" name="dx2" class="form-control" value="<?php echo $fila_dx2['ddx2'] ?>" id="buscardx2">
          </td>
          <td class="">
            <label for="">Tipo diagnostico:</label>
            <select class="form-control" name="tdx2">
              <option value="<?php echo $fila_dx2['tdx2'] ?>"><?php echo $fila_dx2['tdx2'] ?></option>
              <option value="Impresion Diagnostica">Impresion Diagnostica</option>
              <option value="Confirmado Nuevo">Confirmado Nuevo</option>
              <option value="Confirmado Repetido">Confirmado Repetido</option>
            </select>
          </td>
          <?php
        }
      }else {
        ?>
        <td class="">
          <label for="">Diagnostico Relacionado 2</label>
          <input type="text" name="dx2" class="form-control" value="" id="buscardx2">
        </td>
        <td class="">
          <label for="">Tipo diagnostico:</label>
          <select class="form-control" name="tdx2">
            <option value=""></option>
            <option value="Impresion Diagnostica">Impresion Diagnostica</option>
            <option value="Confirmado Nuevo">Confirmado Nuevo</option>
            <option value="Confirmado Repetido">Confirmado Repetido</option>
          </select>
        </td>
        <?php
      }
      ?>
        </tr>
        <tr>
          <?php
            $adm=$_REQUEST['idadmhosp'];
            $sql_dx3="SELECT ddx3,tdx3 FROM evolucion_medica a inner join user b on a.id_user=b.id_user
             WHERE a.id_adm_hosp=$adm and b.id_perfil=3 ORDER BY id_evomed DESC limit 1";
             //echo $sql_dx1;
             if ($tabla_dx3=$bd1->sub_tuplas($sql_dx3)){
               foreach ($tabla_dx3 as $fila_dx3) {
                 ?>
          <td class="">
            <label for="">Diagnostico Relacionado 3</label>
            <input type="text" name="dx3" class="form-control" value="<?php echo $fila_dx3['ddx3'] ?>" id="buscardx3">
          </td>
          <td class="">
            <label for="">Tipo diagnostico:</label>
            <select class="form-control" name="tdx3">
              <option value="<?php echo $fila_dx3['tdx3'] ?>"><?php echo $fila_dx3['tdx3'] ?></option>
              <option value="Impresion Diagnostica">Impresion Diagnostica</option>
              <option value="Confirmado Nuevo">Confirmado Nuevo</option>
              <option value="Confirmado Repetido">Confirmado Repetido</option>
            </select>
          </td>
          <?php
        }
      }else {
        ?>
        <td class="">
          <label for="">Diagnostico Relacionado 3</label>
          <input type="text" name="dx3" class="form-control" value="" id="buscardx3">
        </td>
        <td class="">
          <label for="">Tipo diagnostico:</label>
          <select class="form-control" name="tdx3">
            <option value=""></option>
            <option value="Impresion Diagnostica">Impresion Diagnostica</option>
            <option value="Confirmado Nuevo">Confirmado Nuevo</option>
            <option value="Confirmado Repetido">Confirmado Repetido</option>
          </select>
        </td>
        <?php
      }
      ?>
        </tr>
      </table>
  </section>
  </body>
</html>
