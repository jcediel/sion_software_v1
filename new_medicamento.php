<!DOCTYPE html>
<html>
<head>
	<title>SIEMM</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css" media="screen" title="no title" charset="utf-8">
	<script src="js/jquery.js"></script>
  <script src="js/jquery-3.1.1.min.js" charset="utf-8"></script>
  <script src="js/jquery-ui.min.js" charset="utf-8"></script>
  <script type="text/javascript">
    $('document').ready(function() {
      $('#buscar').autocomplete({
        source : 'busmed.php'
      });
    });
  </script>
  <script>
    $(document).ready(function(){
        $('#24').change(function(){
            $("#f1").show(500, function(){
            });
            $("#f2").hide(500, function(){
            });
            $("#f3").hide(500, function(){
            });
            $("#f4").hide(500, function(){
            });
        });
        $('#12').change(function(){
            $("#f1").show(500, function(){
            });
            $("#f2").show(500, function(){
            });
            $("#f3").hide(500, function(){
            });
            $("#f4").hide(500, function(){
            });
        });
        $('#8').change(function(){
            $("#f1").show(500, function(){
            });
            $("#f2").show(500, function(){
            });
            $("#f3").show(500, function(){
            });
            $("#f4").hide(500, function(){
            });
        });
        $('#6').change(function(){
            $("#f1").show(500, function(){
            });
            $("#f2").show(500, function(){
            });
            $("#f3").show(500, function(){
            });
            $("#f4").show(500, function(){
            });
        });
        $('#u').change(function(){
            $("#f1").show(500, function(){
            });
            $("#f2").hide(500, function(){
            });
            $("#f3").hide(500, function(){
            });
            $("#f4").hide(500, function(){
            });
        });
      });
    </script>
</head>
<body>
  <?php
  $idmformula=$_GET['idmformula'];
   ?>
	<?php include('config/conexion_new.php'); ?>
	<?php include('config/config5.php'); ?>
  <section class="panel panel-default">
    <section class="panel-heading">
      <h1>Registro de medicamentos</h1>
    </section>
    <section>
      <form action="add_medicamento.php" method="post">
        <article class="col-md-3">
          <label for="">Seleccione Medicamento:</label>
          <input type="text" name="idmformula" value="<?php echo $idmformula; ?>">
          <input type="text" name="med" class="form-control" id="buscar" value="">
    		</article>
        <article class="col-xs-3 form-group">
          <label for="">Via administracion:</label>
          <select class=" form-control"  name="via">
            <option value=""></option>
            <option value="Via oral">Via oral</option>
            <option value="Via intravenosa">Via intravenosa</option>
            <option value="Via Intramuscular">Via Intramuscular</option>
            <option value="Via Cutanea">Via Cutanea</option>
            <option value="Via subcutanea">Via subcutanea</option>
            <option value="Via Sublingual">Via Sublingual</option>
            <option value="Via Rectal">Via Rectal</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Frecuencia:</label>
          <table class="table-bordered">
            <tr>
              <td><input type="radio" name="frec" value="24"  id="24"><strong> 24 </strong></td>
              <td><input type="radio" name="frec" value="12"  id="12"> <strong> 12 </strong></td>
              <td><input type="radio" name="frec" value="8" id="8" > <strong> 8 </strong></td>
              <td><input type="radio" name="frec" value="6"  id="6"> <strong> 6 </strong></td>
              <td><input type="radio" name="frec" value="u" id="u" > <strong> Unica dosis</strong></td>
            </tr>
          </table>
        </article>

        <article class="col-xs-1 form-group">
          <label for="">Dosis</label>
          <input type="number" name="dosis1" id="f1" class="form-control form-group" value="0">

          <input type="number" name="dosis2" id="f2" class="form-control form-group" value="0">

          <input type="number" name="dosis3" id="f3" class="form-control form-group" value="0">

          <input type="number" name="dosis4" id="f4" class="form-control form-group" value="0">
        </article>
        <article class="col-md-10 form-group ">
          <label for="">Oservacion Medicamento:</label>
          <textarea name="obs_formula" class="form-control" rows="2" ></textarea>
        </article>
      </section>
      <section class="panel-footer">
        <div class="row text-center">
    			<input type="submit" class="btn btn-primary" value="Guardar Medicamento">
    		</div>
      </section>
    	</form>
  </section>


</body>
</html>
