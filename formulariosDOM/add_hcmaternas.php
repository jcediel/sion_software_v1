<form action="<?php echo PROGRAMA.'?doc='.$return.'&buscar=Buscar&opcion=70';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading"><h4>Historia Clínica Maternas</h4></section>
    <section class="panel-body">
  		<?php
  			include("consulta_paciente.php");
  		?>
  	</section>
    <section class="panel-body">
      <article class="col-xs-2">
				<label for="">Fecha de registro:</label>
				<input type="date" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo3?> >
        <input type="hidden" name="idadmhosp" value="<?php echo $_GET['idadmhosp']?>">
			</article>
			<article class="col-xs-2">
				<label for="">Hora de registro</label>
				<input type="time" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo3?>>
			</article>
      <article class="col-xs-8 alert alert-danger animated tada">
          <ul>Recomendaciones:
            <li>NO utilice ' en el texto, este caracter no permite guardar los registros.</li>
            <li>Diligencie todos los campos.</li>
          </ul>
      </article>
    </section>
    <section class="panel-heading col-xs-6"><h4>Motivo de consulta y enfermedad actual</h4></section>
    <section class="panel-heading col-xs-6"><h4>Factores de riesgo psicosocial</h4></section>
    <section class="panel-body col-xs-6">
      <article class="col-xs-12">
        <table class="table table-bordered table-hover">
          <tr>
            <td>
              Adolescentes menores de 15 años.
            </td>
            <td>
              <input type="radio" class="radio" name="mc1"
                <?php if (isset($tmuscular1) && $tmuscular1=="0") echo "checked";?>
                value="0">
            </td>
          </tr>
          <tr>
            <td>
              Adolescentes entre 15 y 19 años con 2 o más gestaciones.
            </td>
            <td>
              <input type="radio" class="radio" name="mc1"
                <?php if (isset($tmuscular1) && $tmuscular1=="1") echo "checked";?>
                value="1">
            </td>
          </tr>
          <tr>
            <td>
              Mujeres mayores de 35 años.
            </td>
            <td>
              <input type="radio" class="radio" name="mc1"
                <?php if (isset($tmuscular1) && $tmuscular1=="1+") echo "checked";?>
                value="1+">
            </td>
          </tr>
        </table>
      </article>
      <article class="col-xs-7">
        <p><strong>Mujeres con insuficiente control prenatal (Según edadgestacional).</strong></p>
      </article>
      <article class="col-xs-2">
        <label for="">SI</label>
        <input type="radio" class="radio-inline" name="mc4"
          <?php if (isset($tmuscular1) && $tmuscular1=="SI") echo "checked";?>
          value="SI">
      </article>
      <article class="col-xs-2">
        <label for="">NO</label>
        <input type="radio" class="radio-inline" name="mc4"
          <?php if (isset($tmuscular1) && $tmuscular1=="NO") echo "checked";?>
          value="NO">
      </article>

      <article class="col-xs-7">
        <p><strong>Mujeres con enfermedades pre-existentes como cardiopatías,diabetes, hipertensión, entre otros.</strong></p>
      </article>
      <article class="col-xs-2">
        <label for="">SI</label>
        <input type="radio" class="radio-inline" name="mc5"
          <?php if (isset($tmuscular1) && $tmuscular1=="SI") echo "checked";?>
          value="SI">
      </article>
      <article class="col-xs-2">
        <label for="">NO</label>
        <input type="radio" class="radio-inline" name="mc5"
          <?php if (isset($tmuscular1) && $tmuscular1=="NO") echo "checked";?>
          value="NO">
      </article>

      <article class="col-xs-7">
        <p><strong>Mujeres con 3 o más criterios de inclusión para morbilidad materna extrema.</strong></p>
      </article>
      <article class="col-xs-2">
        <label for="">SI</label>
        <input type="radio" class="radio-inline" name="mc6"
          <?php if (isset($tmuscular1) && $tmuscular1=="SI") echo "checked";?>
          value="SI">
      </article>
      <article class="col-xs-2">
        <label for="">NO</label>
        <input type="radio" class="radio-inline" name="mc6"
          <?php if (isset($tmuscular1) && $tmuscular1=="NO") echo "checked";?>
          value="NO">
      </article>
      <article class="col-xs-7">
        <p><strong>Mujeres con secuelas o discapacidades secundarias al evento obstétrico.</strong></p>
      </article>
      <article class="col-xs-2">
        <label for="">SI</label>
        <input type="radio" class="radio-inline" name="mc7"
          <?php if (isset($tmuscular1) && $tmuscular1=="SI") echo "checked";?>
          value="SI">
      </article>
      <article class="col-xs-2">
        <label for="">NO</label>
        <input type="radio" class="radio-inline" name="mc7"
          <?php if (isset($tmuscular1) && $tmuscular1=="NO") echo "checked";?>
          value="NO">
      </article>
    </section>
    <section class="col-xs-6">
      <article class="col-xs-7">
        <p><strong>Pareja estable.</strong></p>
      </article>
      <article class="col-xs-2">
        <label for="">SI</label>
        <input type="radio" class="radio-inline" name="fr1"
          <?php if (isset($tmuscular1) && $tmuscular1=="SI") echo "checked";?>
          value="SI">
      </article>
      <article class="col-xs-2">
        <label for="">NO</label>
        <input type="radio" class="radio-inline" name="fr1"
          <?php if (isset($tmuscular1) && $tmuscular1=="NO") echo "checked";?>
          value="NO">
      </article>
      <article class="col-xs-7">
        <p><strong>Misma pareja de eventos obstetricos anteriores.</strong></p>
      </article>
      <article class="col-xs-2">
        <label for="">SI</label>
        <input type="radio" class="radio-inline" name="fr2"
          <?php if (isset($tmuscular1) && $tmuscular1=="SI") echo "checked";?>
          value="SI">
      </article>
      <article class="col-xs-2">
        <label for="">NO</label>
        <input type="radio" class="radio-inline" name="fr2"
          <?php if (isset($tmuscular1) && $tmuscular1=="NO") echo "checked";?>
          value="NO">
      </article>
      <article class="col-xs-7">
        <p><strong>Embarazo planeado.</strong></p>
      </article>
      <article class="col-xs-2">
        <label for="">SI</label>
        <input type="radio" class="radio-inline" name="fr3"
          <?php if (isset($tmuscular1) && $tmuscular1=="SI") echo "checked";?>
          value="SI">
      </article>
      <article class="col-xs-2">
        <label for="">NO</label>
        <input type="radio" class="radio-inline" name="fr3"
          <?php if (isset($tmuscular1) && $tmuscular1=="NO") echo "checked";?>
          value="NO">
      </article>
      <article class="col-xs-7">
        <p><strong>Embarazo deseado.</strong></p>
      </article>
      <article class="col-xs-2">
        <label for="">SI</label>
        <input type="radio" class="radio-inline" name="fr4"
          <?php if (isset($tmuscular1) && $tmuscular1=="SI") echo "checked";?>
          value="SI">
      </article>
      <article class="col-xs-2">
        <label for="">NO</label>
        <input type="radio" class="radio-inline" name="fr4"
          <?php if (isset($tmuscular1) && $tmuscular1=="NO") echo "checked";?>
          value="NO">
      </article>
      <article class="col-xs-7">
        <p><strong>Embarazo aceptado.</strong></p>
      </article>
      <article class="col-xs-2">
        <label for="">SI</label>
        <input type="radio" class="radio-inline" name="fr5"
          <?php if (isset($tmuscular1) && $tmuscular1=="SI") echo "checked";?>
          value="SI">
      </article>
      <article class="col-xs-2">
        <label for="">NO</label>
        <input type="radio" class="radio-inline" name="fr5"
          <?php if (isset($tmuscular1) && $tmuscular1=="NO") echo "checked";?>
          value="NO">
      </article>
      <article class="col-xs-7">
        <p><strong>Red de apoyo familiar.</strong></p>
      </article>
      <article class="col-xs-2">
        <label for="">SI</label>
        <input type="radio" class="radio-inline" name="fr6"
          <?php if (isset($tmuscular1) && $tmuscular1=="SI") echo "checked";?>
          value="SI">
      </article>
      <article class="col-xs-2">
        <label for="">NO</label>
        <input type="radio" class="radio-inline" name="fr6"
          <?php if (isset($tmuscular1) && $tmuscular1=="NO") echo "checked";?>
          value="NO">
      </article>
    </section>
    <section class="panel-heading col-xs-12"><h4>ANTECEDENTES PARA EL EMBARAZO</h4>
      <section class="panel panel-body">
        <article class="col-xs-2">
          <label for="">Menarquia:</label>
          <input type="date" class="form-control" name="menarquia" value="">
        </article>
        <article class="col-xs-2">
          <label for="">Ciclos:</label>
          <select class="form-control" name="ciclos">
            <option value="Regular">Regular</option>
            <option value="Irregular">Irregular</option>
          </select>
        </article>
        <article class="col-xs-2">
          <label for="">FUM:</label>
          <input type="date" class="form-control" name="fum" value="">
        </article>
        <article class="col-xs-2">
          <label for="">PF previa:</label>
          <select class="form-control" name="pfprevia" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-3">
          <label for="">Consulta preconcepcional:</label>
          <select class="form-control" name="cpreconcepcional" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-2">
          <label for="">Edad gestacional:</label>
          <input type="number" class="form-control" name="egestacional" value="" required="">
        </article>
        <article class="col-xs-2">
          <label for="">FPP:</label>
          <input type="date" class="form-control" name="fpp" value="" required="">
        </article>
        <article class="col-xs-3">
          <label for="">Antecedentes Transfusionales:</label>
          <select class="form-control" name="ant_transfucionales" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-3">
          <label for="">PF posterior:</label>
          <select class="form-control" name="pfposterior" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-3">
          <label for="">Metodo:</label>
          <select class="form-control" name="metodopf" required="">
            <option value=""></option>
            <option value="Métodos naturales">Métodos naturales</option>
            <option value="Coito interrumpido">Coito interrumpido</option>
            <option value="Preservativo">Preservativo</option>
            <option value="Diafragma">Diafragma</option>
            <option value="Esponja anticonceptiva">Esponja anticonceptiva</option>
            <option value="Preservativo femenino">Preservativo femenino</option>
            <option value="Pastillas anticonceptivas">Pastillas anticonceptivas</option>
            <option value="Pastillasn con estrógeno naturales">pastillasn con estrógeno naturales</option>
            <option value="Inyactable">Inyactable</option>
            <option value="DIU">DIU</option>
            <option value="Parches">Parches</option>
            <option value="Anillo intravajinal">Anillo intravajinal</option>
            <option value="Implantes hormonales">Implantes hormonales</option>
            <option value="Post day">Post day</option>

          </select>
        </article>
        <section class="panel-body col-xs-12">
          <article class="col-xs-3">
    				<label for="">Antecedentes Patologicos:</label>
    				<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto3()" ></button>
    				<textarea class="form-control" name="ant_patologicos" rows="4" id="respuesta3" required=""></textarea>
    			</article>
          <article class="col-xs-3">
    				<label for="">Antecedentes Quirurgicos:</label>
    				<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto4()" ></button>
    				<textarea class="form-control" name="ant_quirurgicos" rows="4" id="respuesta4" required=""></textarea>
    			</article>
          <article class="col-xs-3">
    				<label for="">Antecedentes Familiares:</label>
            <button type="button" class="fa fa-plus btn-danger"  onclick="verTexto9()" ></button>
      			<textarea class="form-control" name="ant_familiares" rows="4" id="respuesta9" required=""></textarea>
    			</article>
    			<article class="col-xs-3">
    				<label for="">Antecedentes Toxicológicos:</label>
    				<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto5()" ></button>
    				<textarea class="form-control" name="ant_toxicologicos" rows="4" id="respuesta5" required=""></textarea>
    			</article>
        </section>
      </section>
    </section>
    <section class="panel-heading col-xs-12"><h4>FORMULA OBSTETRICA</h4>
      <section class="panel panel-body">
        <section class="panel-body col-xs-12">
          <article class="col-xs-2">
            <label for="">Gestaciones</label>
            <input type="number" name="g" class="form-control" value="0">
          </article>
          <article class="col-xs-1">
            <label for="">Partos</label>
            <input type="number" name="p" class="form-control" value="0">
          </article>
          <article class="col-xs-1">
            <label for="">Abortos</label>
            <input type="number" name="a" class="form-control" value="0">
          </article>
          <article class="col-xs-2">
            <label for="">Cesareas</label>
            <input type="number" name="c" class="form-control" value="0">
          </article>
          <article class="col-xs-2">
            <label for="">Ectopicos</label>
            <input type="number" name="e" class="form-control" value="0">
          </article>
          <article class="col-xs-2">
            <label for="">Vivos</label>
            <input type="number" name="v" class="form-control" value="0">
          </article>
          <article class="col-xs-2">
            <label for="">Muertos</label>
            <input type="number" name="m" class="form-control" value="0">
          </article>
        </section>
        <section class="panel-body col-xs-12">
          <table class="table table-bordered table-responsive table-hover">
            <tr>
              <th>Gestaciones</th>
              <th>Partos</th>
              <th>Abortos</th>
              <th>Cesareas</th>
              <th>Ectopicos</th>
              <th>Muertos</th>
            </tr>
            <tr>
              <td><input type="date" class="form-control" name="g1" value=""></td>
              <td><input type="date" class="form-control" name="p1" value=""></td>
              <td><input type="date" class="form-control" name="a1" value=""></td>
              <td><input type="date" class="form-control" name="c1" value=""></td>
              <td><input type="date" class="form-control" name="e1" value=""></td>
              <td><input type="date" class="form-control" name="m1" value=""></td>
            </tr>
            <tr>
              <td><input type="date" class="form-control" name="g2" value=""></td>
              <td><input type="date" class="form-control" name="p2" value=""></td>
              <td><input type="date" class="form-control" name="a2" value=""></td>
              <td><input type="date" class="form-control" name="c2" value=""></td>
              <td><input type="date" class="form-control" name="e2" value=""></td>
              <td><input type="date" class="form-control" name="m2" value=""></td>
            </tr>
            <tr>
              <td><input type="date" class="form-control" name="g3" value=""></td>
              <td><input type="date" class="form-control" name="p3" value=""></td>
              <td><input type="date" class="form-control" name="a3" value=""></td>
              <td><input type="date" class="form-control" name="c3" value=""></td>
              <td><input type="date" class="form-control" name="e3" value=""></td>
              <td><input type="date" class="form-control" name="m3" value=""></td>
            </tr>
            <tr>
              <td><input type="date" class="form-control" name="g4" value=""></td>
              <td><input type="date" class="form-control" name="p4" value=""></td>
              <td><input type="date" class="form-control" name="a4" value=""></td>
              <td><input type="date" class="form-control" name="c4" value=""></td>
              <td><input type="date" class="form-control" name="e4" value=""></td>
              <td><input type="date" class="form-control" name="m4" value=""></td>
            </tr>
            <tr>
              <td><input type="date" class="form-control" name="g5" value=""></td>
              <td><input type="date" class="form-control" name="p5" value=""></td>
              <td><input type="date" class="form-control" name="a5" value=""></td>
              <td><input type="date" class="form-control" name="c5" value=""></td>
              <td><input type="date" class="form-control" name="e5" value=""></td>
              <td><input type="date" class="form-control" name="m5" value=""></td>
            </tr>
          </table>
        </section>
      </section>
    </section>
    <section class="panel-heading col-xs-12"><h4>REVISION POR SISTEMAS</h4>
      <section class="panel panel-body">
        <article class="col-xs-2">
          <label for="">Mov. fetal:</label>
          <select class="form-control" name="movfetal" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-2">
          <label for="">Actividad Uterina:</label>
          <select class="form-control" name="actuterina" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-2">
          <label for="">Amniorrea:</label>
          <select class="form-control" name="amniorrea" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-2">
          <label for="">Sangrado vaginal:</label>
          <select class="form-control" name="sangvaginal" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-2">
          <label for="">Sintomas urinarios:</label>
          <select class="form-control" name="sinturinarios" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-2">
          <label for="">Flujo vaginal:</label>
          <select class="form-control" name="fvaginal" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-2">
          <label for="">Sint. respiratorios:</label>
          <select class="form-control" name="sintrespiratorios" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-1">
          <label for="">Fiebre:</label>
          <select class="form-control" name="fiebre" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-3">
          <label for="">Sintomas de sangrado anormal (coagulopatias):</label>
          <select class="form-control" name="sanganormal" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-6">
          <label for="">Cual:</label>
          <textarea name="cual" class="form-control" rows="3" ></textarea>
        </article>
        <article class="col-xs-1">
          <label for="">Cefalea:</label>
          <select class="form-control" name="cefalea" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-1">
          <label for="">Fosfenos:</label>
          <select class="form-control" name="fosfenos" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-1">
          <label for="">Acufenos:</label>
          <select class="form-control" name="acufenos" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-1">
          <label for="">Edemas:</label>
          <select class="form-control" name="edemas" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-2">
          <label for="">Epigastralgia:</label>
          <select class="form-control" name="epigastralgia" required="">
            <option value=""></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
        </article>
        <article class="col-xs-6">
          <label for="">Observación revisión por sistemas:</label>
          <textarea name="cual" class="form-control" rows="3" ></textarea>
        </article>
      </section>
    </section>
    <section class="panel-heading col-xs-12"><h4>RESULTADOS DE LABORATORIO</h4>
      <section class="panel panel-body">
        <table class="table table-bordered table-hover">
          <tr>
            <th class="text-center success">LABORATORIOS</th>
            <th class="text-center success">1 TRIMESTRE</th>
            <th class="text-center success">2 TRIMESTRE</th>
            <th class="text-center success">3 TRIMESTRE</th>
          </tr>
          <tr>
            <th class="text-center success">HEMOCLASIFICACION</th>
            <th><select class="form-control" name="hemoclasi1" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="hemoclasi2" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="hemoclasi3" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
          </tr>
          <tr>
            <th class="text-center success">TOXOPLASMA</th>
            <th><select class="form-control" name="toxoplasma1" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="toxoplasma2" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="toxoplasma3" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
          </tr>
          <tr>
            <th class="text-center success">SEROLOGIA</th>
            <th><select class="form-control" name="serologia1" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="serologia2" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="serologia3" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
          </tr>
          <tr>
            <th class="text-center success">VIH</th>
            <th><select class="form-control" name="vih1" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="vih2" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="vih3" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
          </tr>
          <tr>
            <th class="text-center success">RUBEOLA</th>
            <th><select class="form-control" name="rubeola1" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="rubeola2" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="rubeola3" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
          </tr>
          <tr>
            <th class="text-center success">P.O/UROCULTIVO</th>
            <th><select class="form-control" name="urocultivo1" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="urocultivo2" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="urocultivo3" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
          </tr>
          <tr>
            <th class="text-center success">FROTIS FLUJO VAGINAL</th>
            <th><select class="form-control" name="frotis1" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="frotis2" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="frotis3" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
          </tr>
          <tr>
            <th class="text-center success">GLICEMIA/CURVA DE GLICEMIA</th>
            <th><select class="form-control" name="glicemia1" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="glicemia2" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="glicemia3" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
          </tr>
          <tr>
            <th class="text-center success">HEMOGLOBINA</th>
            <th><select class="form-control" name="hemoglobina1" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="hemoglobina2" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="hemoglobina3" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
          </tr>
          <tr>
            <th class="text-center success">HEPATITIS B</th>
            <th><select class="form-control" name="hepatitisb1" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="hepatitisb2" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
            <th><select class="form-control" name="hepatitisb3" required="">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select></th>
          </tr>
        </table>
        <br>
        <table class="table table-bordered table-hover">
          <tr>
            <th class="text-center info">ECOGRAFIAS</th>
            <th class="text-center info">1 TRIMESTRE</th>
            <th class="text-center info">2 TRIMESTRE</th>
            <th class="text-center info">3 TRIMESTRE</th>
          </tr>
          <tr>
            <th class="text-left info">FECHA</th>
            <th><input type="date" name="fecha1" class="form-control" value=""></th>
            <th><input type="date" name="fecha2" class="form-control" value=""></th>
            <th><input type="date" name="fecha3" class="form-control" value=""></th>
          </tr>
          <tr>
            <th class="text-left info">EDAD GESTACIONAL</th>
            <th><input type="text" name="egesta1" class="form-control" value=""></th>
            <th><input type="text" name="egesta2" class="form-control" value=""></th>
            <th><input type="text" name="egesta3" class="form-control" value=""></th>
          </tr>
          <tr>
            <th class="text-left info">BIENESTAR FETAL</th>
            <th><input type="text" name="bfetal1" class="form-control" value=""></th>
            <th><input type="text" name="bfetal2" class="form-control" value=""></th>
            <th><input type="text" name="bfetal3" class="form-control" value=""></th>
          </tr>
          <tr>
            <th class="text-left info">PLACENTA</th>
            <th><input type="text" name="placenta1" class="form-control" value=""></th>
            <th><input type="text" name="placenta2" class="form-control" value=""></th>
            <th><input type="text" name="placenta3" class="form-control" value=""></th>
          </tr>
        </table>
      </section>
    </section>
    <section class="panel-heading col-xs-12"><h4>EXAMEN FÍSICO</h4>
      <section class="panel panel-body">
        <article class="col-xs-2">
          <label for="">Talla:</label>
          <input type="number" class="form-control" name="talla" value="">
        </article>
        <article class="col-xs-2">
          <label for="">Peso inicial:</label>
          <input type="number" class="form-control" name="pesoinicio" value="">
        </article>
        <article class="col-xs-2">
          <label for="">IMC inicial:</label>
          <input type="number" class="form-control" name="imcinicio" value="">
        </article>
        <article class="col-xs-2">
          <label for="">Peso Actual:</label>
          <input type="number" class="form-control" name="pesoactual" value="">
        </article>
        <article class="col-xs-3">
          <label for="">Clasificación peso</label>
          <select class="form-control" name="clasipeso">
            <option value="Desnutrición">Desnutrición</option>
            <option value="Bajo peso">Bajo peso</option>
            <option value="normal">normal</option>
            <option value="sobrepeso">sobrepeso</option>
            <option value="Obesidad">Obesidad</option>
          </select>
        </article>
        <article class="col-xs-2">
          <label for="">TA:</label>
          <input type="number" class="form-control" name="ta" value="">
        </article>
        <article class="col-xs-2">
          <label for="">FC:</label>
          <input type="number" class="form-control" name="fc" value="">
        </article>
        <article class="col-xs-2">
          <label for="">FR:</label>
          <input type="number" class="form-control" name="fr" value="">
        </article>
        <article class="col-xs-2">
          <label for="">T°:</label>
          <input type="number" class="form-control" name="t" value="">
        </article>
        <article class="col-xs-2">
          <label for="">Glucometria:</label>
          <input type="number" class="form-control" name="glucometria" value="">
        </article>
        <article class="col-xs-6">
          <label for="">Cardiopulmonar:</label>
          <textarea name="cardiopulmonar" rows="4" class="form-control"></textarea>
        </article>
        <article class="col-xs-12">
          <h4 class="alert alert-info">ABDOMEN</h4>
        </article>
        <article class="col-xs-4">
          <label for="">AU:</label>
          <input type="text" class="form-control" name="au" value="">
        </article>
        <article class="col-xs-4">
          <label for="">Presentación del feto:</label>
          <input type="text" class="form-control" name="presentacionfeto" value="">
        </article>
        <article class="col-xs-4">
          <label for="">Situación fetal:</label>
          <input type="text" class="form-control" name="situacionfetal" value="">
        </article>
        <article class="col-xs-1">
          <label for="">FCF:</label>
          <input type="number" class="form-control" name="fcf" value="">
        </article>
        <article class="col-xs-11">
          <label for="">Observaciones:</label>
          <textarea name="cardiopulmonar" rows="4" class="form-control"></textarea>
        </article>
        <article class="col-xs-12">
          <h4 class="alert alert-info">EXTREMIDADES</h4>
        </article>
        <article class="col-xs-4">
          <label for="">Edemas:</label>
          <select class="form-control" name="edemasvaso" required="">
            <option value="NO">NO</option>
            <option value="SI">SI</option>
          </select>
        </article>
        <article class="col-xs-4">
          <label for="">Varices:</label>
          <select class="form-control" name="varices" required="">
            <option value="NO">NO</option>
            <option value="SI">SI</option>
          </select>
        </article>
      </section>
    </section>
    <section class="panel-heading col-xs-12"><h4>IMPRESIÓN DIAGNOSTICA</h4>
      <section class="panel panel-body">
        <?php include("dxbusqueda.php");?>
        <article class="col-xs-6">
          <label for="">Patologias Asociadas (Al egreso):</label>
          <textarea name="patoasociada" rows="4" class="form-control"></textarea>
        </article>
        <article class="col-xs-6">
          <label for="">Patologias Identificadas (En la visita):</label>
          <textarea name="patoidentificada" rows="4" class="form-control"></textarea>
        </article>
      </section>
    </section>
    <section class="panel-heading col-xs-12"><h4>PLAN DE MANEJO</h4>
      <section class="panel panel-body">
        <article class="col-xs-6">
          <label for="">Verificación y cumplimiento de plande manejo al egreso hospitalario:</label>
          <textarea name="pm1" rows="4" class="form-control"></textarea>
        </article>
        <article class="col-xs-6">
          <label for="">Plan de manejo de situaciones evidenciadas durante la visita:</label>
          <textarea name="pm2" rows="4" class="form-control"></textarea>
        </article>
        <article class="col-xs-6">
          <label for="">Barreras de acceso evidenciadas:</label>
          <textarea name="pm3" rows="4" class="form-control"></textarea>
        </article>
        <article class="col-xs-6">
          <label for="">Entrega de numeros telefonicos con la EPS:</label>
          <select class="form-control" name="pm4" required="">
            <option value="NO">NO</option>
            <option value="SI">SI</option>
          </select>
        </article>
        <article class="col-xs-6">
          <label for="">Educación en signos de alarma:</label>
          <textarea name="pm5" rows="4" class="form-control"></textarea>
        </article>
      </section>
    </section>
    <section class="panel-heading col-xs-12"><h4>OBSERVACIONES GENERALES DE LA VISITA Y VALORACIÓN DEL RIESGO PSICOSOCIAL</h4>
      <section class="panel panel-body">
        <article class="col-xs-6">
          <label for="">Observaciones:</label>
          <textarea name="obsgeneral" rows="4" class="form-control"></textarea>
        </article>
        <article class="col-xs-6">
          <label for="">Valoración de riesgo psicosocial:</label>
          <select class="form-control" name="vrp" required="">
            <option value="ALTO">ALTO</option>
            <option value="BAJO">BAJO</option>
          </select>
        </article>
        <article class="col-xs-6">
          <label for="">Valoración del riesgo obstetrico:</label>
          <select class="form-control" name="vro" required="">
            <option value="ALTO">ALTO</option>
            <option value="BAJO">BAJO</option>
          </select>
        </article>
      </section>
    </section>
    <section class="panel-heading col-xs-12">
      <section class="panel panel-body text-center" >
        <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
        <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
        <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
      </section>
    </section>
  </section>

</form>
