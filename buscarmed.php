<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/jquery-ui.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="css/fuentes.css">
    <script src="js/jquery-3.1.1.min.js" charset="utf-8"></script>
    <script src="js/jquery-ui.min.js" charset="utf-8"></script>
    <script src="js2/tool.js" charset="utf-8"></script>
    <script src="js2/jqueryui.js" charset="utf-8"></script>
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
          //med2
          $('#241').change(function(){
              $("#f11").show(500, function(){
              });
              $("#f21").hide(500, function(){
              });
              $("#f31").hide(500, function(){
              });
              $("#f41").hide(500, function(){
              });
          });
          $('#121').change(function(){
              $("#f11").show(500, function(){
              });
              $("#f21").show(500, function(){
              });
              $("#f31").hide(500, function(){
              });
              $("#f41").hide(500, function(){
              });
          });
          $('#81').change(function(){
              $("#f11").show(500, function(){
              });
              $("#f21").show(500, function(){
              });
              $("#f31").show(500, function(){
              });
              $("#f41").hide(500, function(){
              });
          });
          $('#61').change(function(){
              $("#f11").show(500, function(){
              });
              $("#f21").show(500, function(){
              });
              $("#f31").show(500, function(){
              });
              $("#f41").show(500, function(){
              });
          });
          $('#u1').change(function(){
              $("#f11").show(500, function(){
              });
              $("#f21").hide(500, function(){
              });
              $("#f31").hide(500, function(){
              });
              $("#f41").hide(500, function(){
              });
          });
          //med3
          $('#242').change(function(){
              $("#f12").show(500, function(){
              });
              $("#f22").hide(500, function(){
              });
              $("#f32").hide(500, function(){
              });
              $("#f42").hide(500, function(){
              });
          });
          $('#122').change(function(){
              $("#f12").show(500, function(){
              });
              $("#f22").show(500, function(){
              });
              $("#f32").hide(500, function(){
              });
              $("#f42").hide(500, function(){
              });
          });
          $('#82').change(function(){
              $("#f12").show(500, function(){
              });
              $("#f22").show(500, function(){
              });
              $("#f32").show(500, function(){
              });
              $("#f42").hide(500, function(){
              });
          });
          $('#62').change(function(){
              $("#f12").show(500, function(){
              });
              $("#f22").show(500, function(){
              });
              $("#f32").show(500, function(){
              });
              $("#f42").show(500, function(){
              });
          });
          $('#u2').change(function(){
              $("#f12").show(500, function(){
              });
              $("#f22").hide(500, function(){
              });
              $("#f32").hide(500, function(){
              });
              $("#f42").hide(500, function(){
              });
          });

          $('#243').change(function(){
              $("#f13").show(500, function(){
              });
              $("#f23").hide(500, function(){
              });
              $("#f33").hide(500, function(){
              });
              $("#f43").hide(500, function(){
              });
          });
          $('#123').change(function(){
              $("#f13").show(500, function(){
              });
              $("#f23").show(500, function(){
              });
              $("#f33").hide(500, function(){
              });
              $("#f43").hide(500, function(){
              });
          });
          $('#83').change(function(){
              $("#f13").show(500, function(){
              });
              $("#f23").show(500, function(){
              });
              $("#f33").show(500, function(){
              });
              $("#f43").hide(500, function(){
              });
          });
          $('#63').change(function(){
              $("#f13").show(500, function(){
              });
              $("#f23").show(500, function(){
              });
              $("#f33").show(500, function(){
              });
              $("#f43").show(500, function(){
              });
          });
          $('#u3').change(function(){
              $("#f13").show(500, function(){
              });
              $("#f23").hide(500, function(){
              });
              $("#f33").hide(500, function(){
              });
              $("#f43").hide(500, function(){
              });
          });
          $('#244').change(function(){
              $("#f14").show(500, function(){
              });
              $("#f24").hide(500, function(){
              });
              $("#f34").hide(500, function(){
              });
              $("#f44").hide(500, function(){
              });
          });
          $('#124').change(function(){
              $("#f14").show(500, function(){
              });
              $("#f24").show(500, function(){
              });
              $("#f34").hide(500, function(){
              });
              $("#f44").hide(500, function(){
              });
          });
          $('#84').change(function(){
              $("#f14").show(500, function(){
              });
              $("#f24").show(500, function(){
              });
              $("#f34").show(500, function(){
              });
              $("#f44").hide(500, function(){
              });
          });
          $('#64').change(function(){
              $("#f14").show(500, function(){
              });
              $("#f24").show(500, function(){
              });
              $("#f34").show(500, function(){
              });
              $("#f44").show(500, function(){
              });
          });
          $('#u4').change(function(){
              $("#f14").show(500, function(){
              });
              $("#f24").hide(500, function(){
              });
              $("#f34").hide(500, function(){
              });
              $("#f44").hide(500, function(){
              });
          });
      });
    </script>
    <script type="text/javascript">
  $('document').ready(function() {
        $('#buscar').autocomplete({
          source : 'busmed.php'
        });
        $('#buscar1').autocomplete({
          source : 'busmed.php'
        });
        $('#buscar2').autocomplete({
          source : 'busmed.php'
        });
        $('#buscar3').autocomplete({
          source : 'busmed.php'
        });
        $('#buscar4').autocomplete({
          source : 'busmed.php'
        });
      });
    </script>
  </head>
  <body>
    <section class="col-md-12 cuadrosection">
      <article class="col-md-4 form-group">
        <label for="">Seleccione Medicamento:</label>
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
        <input type="text" name="dosis1" id="f1" class="form-control form-group" value="">

        <input type="text" name="dosis2" id="f2" class="form-control form-group" value="">

        <input type="text" name="dosis3" id="f3" class="form-control form-group" value="">

        <input type="text" name="dosis4" id="f4" class="form-control form-group" value="">
      </article>
      <article class="col-md-10 form-group ">
        <label for="">Oservacion Medicamento:</label>
        <textarea name="obs_formula" class="form-control" rows="1" ></textarea>
      </article>
    </section>
    <section class="col-md-12">
      <article class="col-md-4 form-group">
        <label for="">Seleccione Medicamento:</label>
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
            <td><input type="radio" name="frec" value="242"  id="242"><strong> 24 </strong></td>
            <td><input type="radio" name="frec" value="122"  id="122"> <strong> 12 </strong></td>
            <td><input type="radio" name="frec" value="82" id="82" > <strong> 8 </strong></td>
            <td><input type="radio" name="frec" value="62"  id="62"> <strong> 6 </strong></td>
            <td><input type="radio" name="frec" value="u2" id="u2" > <strong> Unica dosis</strong></td>
          </tr>
        </table>
      </article>

      <article class="col-xs-1 form-group">
        <label for="">Dosis</label>
        <input type="text" name="dosis1" id="f12" class="form-control form-group" value="">

        <input type="text" name="dosis2" id="f22" class="form-control form-group" value="">

        <input type="text" name="dosis3" id="f32" class="form-control form-group" value="">

        <input type="text" name="dosis4" id="f42" class="form-control form-group" value="">
      </article>
      <article class="col-md-10 form-group ">
        <label for="">Oservacion Medicamento:</label>
        <textarea name="obs_formula" class="form-control" rows="1" ></textarea>
      </article>
    </section>
    <section class="col-md-12 cuadrosection">
      <article class="col-md-4 form-group">
        <label for="">Seleccione Medicamento:</label>
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
            <td><input type="radio" name="frec" value="243"  id="243"><strong> 24 </strong></td>
            <td><input type="radio" name="frec" value="123"  id="123"> <strong> 12 </strong></td>
            <td><input type="radio" name="frec" value="83" id="83" > <strong> 8 </strong></td>
            <td><input type="radio" name="frec" value="63"  id="63"> <strong> 6 </strong></td>
            <td><input type="radio" name="frec" value="u3" id="u3" > <strong> Unica dosis</strong></td>
          </tr>
        </table>
      </article>

      <article class="col-xs-1 form-group">
        <label for="">Dosis</label>
        <input type="text" name="dosis1" id="f13" class="form-control form-group" value="">

        <input type="text" name="dosis2" id="f23" class="form-control form-group" value="">

        <input type="text" name="dosis3" id="f33" class="form-control form-group" value="">

        <input type="text" name="dosis4" id="f43" class="form-control form-group" value="">
      </article>
      <article class="col-md-10 form-group ">
        <label for="">Oservacion Medicamento:</label>
        <textarea name="obs_formula" class="form-control" rows="1" ></textarea>
      </article>
    </section>
    </body>
</html>
