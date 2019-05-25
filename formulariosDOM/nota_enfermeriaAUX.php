<section class="panel panel-default">
  <section class="panel-heading">
    <h3>Generación de formato para registro de enfermería</h3>
  </section>
  <section class="panel-body">
    <button data-toggle="collapse" class="btn btn-primary" data-target="#demo">Click Aqui para ver procedimientos autorizados y generar formato</strong><span class="glyphicon glyphicon-arrow-down"></span> </button>
  	<section id="demo" class="collapse">
      <section class="panel-body">
        <table  class="table table-bordered">
          <tr>
            <th class="text-center alert alert-info">PROCEDIMIENTOS AUTORIZADOS</th>
            <th class="text-center alert alert-info">FECUENCIA</th>
            <th class="text-center alert alert-info">JORNADA</th>
            <th class="text-center alert alert-info">CANTIDAD</th>
          </tr>
          <?php
          $sql="SELECT a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
                       b.id_presentacion_dom,tipo_paciente,
                       c.id_pprocedimiento,cups,frecuencia,jornada,cantidad,obs_cups,
                       d.descupsmin
                FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
                                 LEFT JOIN presentacion_dom b on a.id_paciente=b.id_paciente
                                 LEFT JOIN pprocedimiento c on b.id_presentacion_dom=c.id_presentacion_dom
                                 LEFT JOIN cups d on d.codcups=c.cups
                WHERE a.id_adm_hosp='".$_REQUEST['idadmhosp']."'";
                if ($tabla=$bd1->sub_tuplas($sql)){

            			foreach ($tabla as $fila ) {
                      echo"<tr >	\n";
              				echo'<td class="text-center"><strong>'.$fila["descupsmin"].' | <i>'.$fila["cups"].'</i></td>';
                      $cups=$fila['cups'];
                      $doc=$_REQUEST['doc'];
                      echo'<td class="text-center"><strong>'.$fila["frecuencia"].'</td>';
                      echo'<td class="text-center"><strong>'.$fila["jornada"].'</td>';
                      echo'<td class="text-center"><strong>'.$fila["cantidad"].' sesiones</td>';
                      if ($fila['cups']=='6983' || $fila['cups']=='6984' || $fila['cups']=='6985' || $fila['cups']=='6986' || $fila['cups']=='6987' || $fila['cups']=='6988' || $fila['cups']=='6989' || $fila['cups']=='6990') {
                        echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NE&idadmhosp='.$fila["id_adm_hosp"].'&formato='.$cups.'&doc='.$doc.'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-stethoscope"></span> Genración de formato</button></a></th>';
                      }else {
                        echo'<th class="text-center"><span class="fa fa-ban"></span></th>';
                      }
              				echo "</tr>\n";
            			}
            		}
           ?>
        </table>
      </section>
    </section>
  </section>

  <?php
  $f=$_REQUEST['formato'];
    if ($f=='6983') {
    ?>
    <section class="panel-heading">
      <h3>Formato de registro enfermería Turno 3 horas</h3>
    </section>
    <section class="panel-body">
      <section class="col-xs-2 ">
        <article class="col-xs-12">
          <label for="">Fecha de Atención:</label>
          <input type="date" name="freg3" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo2;?> >
          <input type="hidden" name="idadmhosp" value="<?php echo $_GET["idadmhosp"] ;?>" class="form-control" <?php echo $atributo3;?> >
          <input type="hidden" name="aut" value="<?php echo $_GET["formato"] ;?>" class="form-control" <?php echo $atributo3;?> >
        </article>
        <article class="col-xs-12">
          <label for="">Hora de Atención:</label>
          <input type="time" name="hnota" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo3;?>>
        </article>
      </section>
      <section class="col-xs-10 well" >
        <h4 class="col-xs-12 text-success">Estado del servicio</h4>
        <article class="col-xs-2">
          <label for="">Sesiones Autorizadas:</label>
          <input type="text" name="tema" value="" class="form-control" <?php echo $atributo2;?> >
        </article>
        <article class="col-xs-2">
          <label for="">Sesiones Realizadas:</label>
          <input type="text" name="tema" value=" " class="form-control" <?php echo $atributo2;?> >
        </article>
      </section>
      <section class="col-xs-12 well">
        <h4 class="col-xs-12 text-info">Registro enfermería</h4>
        <article class="col-xs-4 form-group">
          <label for="">Nota 1 </label>
          <textarea class="form-control" name="nota1" rows="5" id="comment" required=""></textarea>
        </article>
        <article class="col-xs-4 form-group">
          <label for="">Nota  2</label>
          <textarea class="form-control" name="nota2" rows="5" id="comment" required=""></textarea>
        </article>
        <article class="col-xs-4 form-group">
          <label for="">Nota  3</label>
          <textarea class="form-control" name="nota3" rows="5" id="comment" required=""></textarea>
        </article>
      </section>
      <section class="col-xs-12 well">
        <h4 class="col-xs-12 text-info">Signos vitales</h4>
        <article class="col-xs-1">
          <label for="">TAS:</label>
          <input type="text" name="tas" class="form-control" value=""  required="">
        </article>
        <article class="col-xs-1">
          <label for="">TAD:</label>
          <input type="text" name="tad" class="form-control" value=""  required="">
        </article>
        <article class="col-xs-1">
          <label for="">FC:</label>
          <input type="text" name="fc" class="form-control" value=""  required="">
        </article>
        <article class="col-xs-1">
          <label for="">FR:</label>
          <input type="text" name="fr" class="form-control" value=""  required="">
        </article>
        <article class="col-xs-1">
          <label for="">Temp:</label>
          <input type="text" name="t" class="form-control" value=""  required="">
        </article>
        <article class="col-xs-1">
          <label for="">SpO2:</label>
          <input type="text" name="sat" class="form-control" value=""  required="">
        </article>
        <article class="col-xs-2">
          <label for="">Glasgow:</label>
          <select class="form-control" name="glasgow"  required="">
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
          </select>
        </article>
        <article class="col-xs-2">
          <label for="">EVA:</label>
          <select class="form-control" name="eva"  required="">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
          </select>
        </article>
      </section>
      <section class="col-xs-10 well" >
        <h4 class="col-xs-12 text-success">Educación al cuidador</h4>
        <article class="col-xs-3">
          <label for="">Tema:</label>
          <input type="text" name="tema" value=" " class="form-control" <?php echo $atributo2;?> >
        </article>
        <article class="col-xs-2">
          <label for="">Tiempo:</label>
          <input type="number" name="tiempo" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo3;?>>
        </article>
        <article class="col-xs-7">
          <label for="">Observaciones:</label>
          <textarea name="obs_edupaciente" class="form-control" rows="3" ></textarea>
        </article>
      </section>
      <section>
        <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?> Truno 3 horas" />
        <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
        <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
      </section>
    </section>
    <?php
    }
    if ($f=='6984') {
    ?>
    <section class="panel-heading">
      <h3>Formato de registro enfermería Turno 6 horas</h3>
    </section>
    <section class="panel-body">
      <section class="panel-body">
        <section class="col-xs-2 ">
          <article class="col-xs-12">
            <label for="">Fecha de Atención:</label>
            <input type="date" name="freg3" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo2;?> >
            <input type="hidden" name="idadmhosp" value="<?php echo $_GET["idadmhosp"] ;?>" class="form-control" <?php echo $atributo3;?> >
            <input type="hidden" name="aut" value="<?php echo $_GET["formato"] ;?>" class="form-control" <?php echo $atributo3;?> >
          </article>
          <article class="col-xs-12">
            <label for="">Hora de Atención:</label>
            <input type="time" name="hnota" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo3;?>>
          </article>
        </section>
        <section class="col-xs-10 well" >
          <h4 class="col-xs-12 text-success">Estado del servicio</h4>
          <article class="col-xs-2">
            <label for="">Sesiones Autorizadas:</label>
            <input type="text" name="tema" value="" class="form-control" <?php echo $atributo2;?> >
          </article>
          <article class="col-xs-2">
            <label for="">Sesiones Realizadas:</label>
            <input type="text" name="tema" value=" " class="form-control" <?php echo $atributo2;?> >
          </article>
        </section>
        <section class="col-xs-12 well">
          <h4 class="col-xs-12 text-info">Registro enfermería</h4>
          <article class="col-xs-4 form-group">
            <label for="">Nota 1 </label>
            <textarea class="form-control" name="nota1" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  2</label>
            <textarea class="form-control" name="nota2" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  3</label>
            <textarea class="form-control" name="nota3" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota 4 </label>
            <textarea class="form-control" name="nota4" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  5</label>
            <textarea class="form-control" name="nota5" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  6</label>
            <textarea class="form-control" name="nota6" rows="5" id="comment" required=""></textarea>
          </article>
        </section>
        <section class="col-xs-12 well">
          <h4 class="col-xs-12 text-info">Signos vitales</h4>
          <article class="col-xs-1">
            <label for="">TAS:</label>
            <input type="text" name="tas" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-1">
            <label for="">TAD:</label>
            <input type="text" name="tad" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-1">
            <label for="">FC:</label>
            <input type="text" name="fc" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-1">
            <label for="">FR:</label>
            <input type="text" name="fr" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-1">
            <label for="">Temp:</label>
            <input type="text" name="t" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-1">
            <label for="">SpO2:</label>
            <input type="text" name="sat" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-2">
            <label for="">Glasgow:</label>
            <select class="form-control" name="glasgow"  required="">
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
            </select>
          </article>
          <article class="col-xs-2">
            <label for="">EVA:</label>
            <select class="form-control" name="eva"  required="">
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </article>
        </section>
        <section class="col-xs-12 well" >
          <h4 class="col-xs-3 text-success">Educación al cuidador</h4>
          <h5 class="col-xs-9 alert alert-info"><span class="fa fa-info-circle fa-2x"> </span> Recuerde registrar dos veces en el mes. El tiempo de registro es en minutos.</h5>
          <article class="col-xs-3">
            <label for="">Tema:</label>
            <input type="text" name="tema" value=" " class="form-control" <?php echo $atributo2;?> >
          </article>
          <article class="col-xs-2">
            <label for="">Tiempo:</label>
            <input type="number" name="tiempo" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo3;?>>
          </article>
          <article class="col-xs-7">
            <label for="">Observaciones:</label>
            <textarea name="obs_edupaciente" class="form-control" rows="3" ></textarea>
          </article>
        </section>
        <section>
          <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?> Truno 6 horas" />
          <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
          <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
        </section>
    </section>
    <?php
    }
    if ($f=='6985') {
    ?>
    <section class="panel-heading">
      <h3>Formato de registro enfermería Turno 8 horas</h3>
    </section>
    <section class="panel-body">
      <section class="panel-body">
        <section class="col-xs-2 ">
          <article class="col-xs-12">
            <label for="">Fecha de Atención:</label>
            <input type="date" name="freg3" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo2;?> >
            <input type="hidden" name="idadmhosp" value="<?php echo $_GET["idadmhosp"] ;?>" class="form-control" <?php echo $atributo3;?> >
            <input type="hidden" name="aut" value="<?php echo $_GET["formato"] ;?>" class="form-control" <?php echo $atributo3;?> >
          </article>
          <article class="col-xs-12">
            <label for="">Hora de Atención:</label>
            <input type="time" name="hnota" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo3;?>>
          </article>
        </section>
        <section class="col-xs-10 well" >
          <h4 class="col-xs-12 text-success">Estado del servicio</h4>
          <article class="col-xs-2">
            <label for="">Sesiones Autorizadas:</label>
            <input type="text" name="tema" value="" class="form-control" <?php echo $atributo2;?> >
          </article>
          <article class="col-xs-2">
            <label for="">Sesiones Realizadas:</label>
            <input type="text" name="tema" value=" " class="form-control" <?php echo $atributo2;?> >
          </article>
        </section>
        <section class="col-xs-12 well">
          <h4 class="col-xs-12 text-info">Registro enfermería</h4>
          <article class="col-xs-4 form-group">
            <label for="">Nota 1 </label>
            <textarea class="form-control" name="nota1" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  2</label>
            <textarea class="form-control" name="nota2" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  3</label>
            <textarea class="form-control" name="nota3" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota 4 </label>
            <textarea class="form-control" name="nota4" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  5</label>
            <textarea class="form-control" name="nota5" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  6</label>
            <textarea class="form-control" name="nota6" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  7</label>
            <textarea class="form-control" name="nota7" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  8</label>
            <textarea class="form-control" name="nota8" rows="5" id="comment" required=""></textarea>
          </article>
        </section>
        <section class="col-xs-12 well">
          <h4 class="col-xs-12 text-info">Signos vitales</h4>
          <article class="col-xs-1">
            <label for="">TAS:</label>
            <input type="text" name="tas" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-1">
            <label for="">TAD:</label>
            <input type="text" name="tad" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-1">
            <label for="">FC:</label>
            <input type="text" name="fc" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-1">
            <label for="">FR:</label>
            <input type="text" name="fr" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-1">
            <label for="">Temp:</label>
            <input type="text" name="t" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-1">
            <label for="">SpO2:</label>
            <input type="text" name="sat" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-2">
            <label for="">Glasgow:</label>
            <select class="form-control" name="glasgow"  required="">
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
            </select>
          </article>
          <article class="col-xs-2">
            <label for="">EVA:</label>
            <select class="form-control" name="eva"  required="">
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </article>
        </section>
        <section class="col-xs-12 well" >
          <h4 class="col-xs-3 text-success">Educación al cuidador</h4>
          <h5 class="col-xs-9 alert alert-info"><span class="fa fa-info-circle fa-2x"> </span> Recuerde registrar dos veces en el mes. El tiempo de registro es en minutos.</h5>
          <article class="col-xs-3">
            <label for="">Tema:</label>
            <input type="text" name="tema" value=" " class="form-control" <?php echo $atributo2;?> >
          </article>
          <article class="col-xs-2">
            <label for="">Tiempo:</label>
            <input type="number" name="tiempo" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo3;?>>
          </article>
          <article class="col-xs-7">
            <label for="">Observaciones:</label>
            <textarea name="obs_edupaciente" class="form-control" rows="3" ></textarea>
          </article>
        </section>
        <section>
          <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?> Truno 8 horas" />
          <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
          <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
        </section>
    </section>
    <?php
    }
    if ($f=='6986' ||$f=='6987' || $f=='6990') {
    ?>
    <section class="panel-heading">
      <h3>Formato de registro enfermería Turno 12 horassss</h3>
    </section>
    <section class="panel-body">
      <section class="panel-body">
        <section class="col-xs-2 ">
          <article class="col-xs-12">
            <label for="">Fecha de Atenciiiiión:</label>
            <input type="date" name="freg3" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo2;?> >
            <input type="hidden" name="idadmhosp" value="<?php echo $_GET["idadmhosp"] ;?>" class="form-control" <?php echo $atributo3;?> >
            <input type="hidden" name="aut" value="<?php echo $_GET["formato"] ;?>" class="form-control" <?php echo $atributo3;?> >
          </article>
          <article class="col-xs-12">
            <label for="">Hora de Atención:</label>
            <input type="time" name="hnota" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo3;?>>
          </article>
        </section>
        <section class="col-xs-10 well" >
          <h4 class="col-xs-12 text-success">Estado del servicio</h4>
          <article class="col-xs-2">
            <label for="">Sesiones Autorizadas:</label>
            <input type="text" name="tema" value="" class="form-control" <?php echo $atributo2;?> >
          </article>
          <article class="col-xs-2">
            <label for="">Sesiones Realizadas:</label>
            <input type="text" name="tema" value=" " class="form-control" <?php echo $atributo2;?> >
          </article>
        </section>
        <section class="col-xs-12 well">
          <h4 class="col-xs-12 text-info">Registro eweraesrfasdnfermería</h4>
          <article class="col-xs-4 form-group">
            <label for="">Nota 1 </label>
            <textarea class="form-control" name="nota1" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  2</label>
            <textarea class="form-control" name="nota2" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  3</label>
            <textarea class="form-control" name="nota3" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota 4 </label>
            <textarea class="form-control" name="nota4" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  5</label>
            <textarea class="form-control" name="nota5" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  6</label>
            <textarea class="form-control" name="nota6" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  7</label>
            <textarea class="form-control" name="nota7" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  8</label>
            <textarea class="form-control" name="nota8" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  9</label>
            <textarea class="form-control" name="nota9" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  10</label>
            <textarea class="form-control" name="nota10" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  11</label>
            <textarea class="form-control" name="nota11" rows="5" id="comment" required=""></textarea>
          </article>
          <article class="col-xs-4 form-group">
            <label for="">Nota  12</label>
            <textarea class="form-control" name="nota12" rows="5" id="comment" required=""></textarea>
          </article>
        </section>
        <section class="col-xs-12 well">
          <h4 class="col-xs-12 text-info">Signos vitales</h4>
          <article class="col-xs-1">
            <label for="">TAS:</label>
            <input type="text" name="tas" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-1">
            <label for="">TAD:</label>
            <input type="text" name="tad" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-1">
            <label for="">FC:</label>
            <input type="text" name="fc" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-1">
            <label for="">FR:</label>
            <input type="text" name="fr" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-1">
            <label for="">Temp:</label>
            <input type="text" name="t" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-1">
            <label for="">SpO2:</label>
            <input type="text" name="sat" class="form-control" value=""  required="">
          </article>
          <article class="col-xs-2">
            <label for="">Glasgow:</label>
            <select class="form-control" name="glasgow"  required="">
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
            </select>
          </article>
          <article class="col-xs-2">
            <label for="">EVA:</label>
            <select class="form-control" name="eva"  required="">
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </article>
        </section>
        <section class="col-xs-12 well" >
          <h4 class="col-xs-3 text-success">Educación al cuidador</h4>
          <h5 class="col-xs-9 alert alert-info"><span class="fa fa-info-circle fa-2x"> </span> Recuerde registrar dos veces en el mes. El tiempo de registro es en minutos.</h5>
          <article class="col-xs-3">
            <label for="">Tema:</label>
            <input type="text" name="tema" value=" " class="form-control" <?php echo $atributo2;?> >
          </article>
          <article class="col-xs-2">
            <label for="">Tiempo:</label>
            <input type="number" name="tiempo" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo3;?>>
          </article>
          <article class="col-xs-7">
            <label for="">Observaciones:</label>
            <textarea name="obs_edupaciente" class="form-control" rows="3" ></textarea>
          </article>
        </section>
        <section>
          <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?> Truno 8 horas" />
          <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
          <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
        </section>
    </section>
    <?php
    }
   ?>

</section>
