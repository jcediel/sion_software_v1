<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio='.$servicio.'&buscar=Buscar&opcion='.$option;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading">
     <h2><?php echo $subtitulo; ?></h2>
    </section>
    <section class="panel-body">
      <article class="col-md-6">
        <label>Fecha registro:</label>
        <input type="text" class="form-control" name="freg_ronda" value="<?php echo date('Y-m-d') ?>"<?php echo $atributo1?>>
        <input type="hidden" class="form-control" name="idadmhosp" value="<?php echo $_REQUEST['idadmhosp'] ?>"<?php echo $atributo1?>>
      </article>
    </section>
    <section class="panel-body">
      <article class="col-md-6 text-left">
        <label>Los profesionales de salud saludan amablemente y se presentan delante del paciente.</label>
        <input type="hidden" class="form-control" name="criterio1" value="Los profesionales de salud saludan amablemente y se presentan delante del paciente."<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor1">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
          <option value="No Aplica">No Aplica</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs1" class="form-control"  rows="4" cols="80"></textarea>
      </article>
      <article class="col-md-6 text-left">
        <label>El consentimiento informado se firmo antes de iniciar la atencion domiciliaria?</label>
        <input type="hidden" class="form-control" name="criterio2" value="El consentimiento informado se firmo antes de iniciar la atencion domiciliaria?"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor2">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
          <option value="No Aplica">No Aplica</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs2" class="form-control"  rows="4" cols="80"></textarea>
      </article>

      <article class="col-md-6 text-left">
        <label>El paciente cuenta con cuidador idoneo permanente (que no sea menor de edad ni adulto mayor enfermo, ni persona en condicion de discapacidad)?</label>
        <input type="hidden" class="form-control" name="criterio3" value="El paciente cuenta con cuidador idoneo permanente (que no sea menor de edad ni adulto mayor enfermo, ni persona en condicion de discapacidad)?"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor3">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
          <option value="No Aplica">No Aplica</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs3" class="form-control"  rows="4" cols="80"></textarea>
      </article>


      <article class="col-md-6 text-left">
        <label>El personal de salud realiza lavado de manos antes de cada intervencion, y/o  utilizan alcohol glicerinado. </label>
        <input type="hidden" class="form-control" name="criterio4" value="El personal de salud realiza lavado de manos antes de cada intervencion, y/o  utilizan alcohol glicerinado. "<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor4">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
          <option value="No Aplica">No Aplica</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs4" class="form-control"  rows="4" cols="80"></textarea>
      </article>

      <article class="col-md-6 text-left">
        <label>El personal de enfermeria aplica higiene de manos en los 5 momentos de protocolo?</label>
        <input type="hidden" class="form-control" name="criterio5" value="El personal de enfermeria aplica higiene de manos en los 5 momentos de protocolo?"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor5">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
          <option value="No Aplica">No Aplica</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs5" class="form-control"  rows="4" cols="80"></textarea>
      </article>

      <article class="col-md-6 text-left">
        <label>El personal de salud cuenta con los insumos para hacer higiene de manos?</label>
        <input type="hidden" class="form-control" name="criterio6" value="El personal de salud cuenta con los insumos para hacer higiene de manos?"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor6">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
          <option value="No Aplica">No Aplica</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs6" class="form-control"  rows="4" cols="80"></textarea>
      </article>

      <article class="col-md-6 text-left">
        <label>Conoce el personal de salud , el diagnostico del paciente y su estado actual?</label>
        <input type="hidden" class="form-control" name="criterio7" value="Conoce el personal de salud , el diagnostico del paciente y su estado actual?"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor7">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
          <option value="No Aplica">No Aplica</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs7" class="form-control"  rows="4" cols="80"></textarea>
      </article>

      <article class="col-md-6 text-left">
        <label>El medico explica al paciente o familiar,   la enfermedad por la cual se le prescribe la medicación o se le define plan de tratamiento</label>
        <input type="hidden" class="form-control" name="criterio8" value="El medico explica al paciente o familiar,   la enfermedad por la cual se le prescribe la medicación o se le define plan de tratamiento"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor8">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
          <option value="No Aplica">No Aplica</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs8" class="form-control"  rows="4" cols="80"></textarea>
      </article>

      <article class="col-md-6 text-left">
        <label>El personal de Terapeutas y de Enfermeria explican los procedimientos que se realizan al paciente o familiar ?</label>
        <input type="hidden" class="form-control" name="criterio9" value="El personal de Terapeutas y de Enfermeria explican los procedimientos que se realizan al paciente o familiar ?"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor9">
          <option value="Cumple">Cumple</option>
          <option value="No Cumple">No Cumple</option>
          <option value="No Aplica">No Aplica</option>
        </select>
      </article>
      <article class="col-md-4">
        <label for="">Observación:</label>
        <textarea name="obs9" class="form-control"  rows="4" cols="80"></textarea>
      </article>
      <article class="col-md-6 text-left">
          <label>Se brinda información sobre signos de alarma y cuidados frente a la intervencion?</label>
          <input type="hidden" class="form-control" name="criterio10" value="Se brinda información sobre signos de alarma y cuidados frente a la intervencion?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor10">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs10" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>Se protege la intimidad del paciente?</label>
          <input type="hidden" class="form-control" name="criterio11" value="Se protege la intimidad del paciente?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor11">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs11" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>El personal de salud que realiza administracion de medicamentos aplican los 5  correctos (paciente correcto, hora correcta, medicamento correcto, dosis correcta, via de administración correcta) en la administración de medicamentos?</label>
          <input type="hidden" class="form-control" name="criterio12" value="El personal de salud que realiza administracion de medicamentos aplican los 5  correctos (paciente correcto, hora correcta, medicamento correcto, dosis correcta, via de administración correcta) en la administración de medicamentos?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor12">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs12" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>El personal de salud que realiza administracion de medicamentos aplican los 5  correctos (paciente correcto, hora correcta, medicamento correcto, dosis correcta, via de administración correcta) en la administración de medicamentos?</label>
          <input type="hidden" class="form-control" name="criterio13" value="El personal de salud que realiza administracion de medicamentos aplican los 5  correctos (paciente correcto, hora correcta, medicamento correcto, dosis correcta, via de administración correcta) en la administración de medicamentos?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor13">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs13" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>Se brinda informacion de los posibles efectos que pueden producir los medicamentos y que hacer en caso en que se presenten?</label>
          <input type="hidden" class="form-control" name="criterio14" value="Se brinda informacion de los posibles efectos que pueden producir los medicamentos y que hacer en caso en que se presenten?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor14">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs14" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>En el domicilio han adoptado los procesos para la prevención de caidas de pacientes?</label>
          <input type="hidden" class="form-control" name="criterio15" value="En el domicilio han adoptado los procesos para la prevención de caidas de pacientes?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor15">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs15" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>Se evalua el riesgo de caida del paciente?</label>
          <input type="hidden" class="form-control" name="criterio16" value="Se evalua el riesgo de caida del paciente?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor16">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs16" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>Se evidencian antideslizantes en las escaleras y baños con agarraderas.</label>
          <input type="hidden" class="form-control" name="criterio17" value="Se evidencian antideslizantes en las escaleras y baños con agarraderas."<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor17">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs17" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>En la deambulacion del paciente, ya sea por sus propios medios o en silla de ruedas, siempre esta asistido por cuidador y/o auxiliar de enfermeria?</label>
          <input type="hidden" class="form-control" name="criterio18" value="En la deambulacion del paciente, ya sea por sus propios medios o en silla de ruedas, siempre esta asistido por cuidador y/o auxiliar de enfermeria?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor18">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs18" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>En el cuidado basico diario, la auxiliar de enfermeria, revisa la piel, identificando zonas de presion o ulceras?</label>
          <input type="hidden" class="form-control" name="criterio19" value="En el cuidado basico diario, la auxiliar de enfermeria, revisa la piel, identificando zonas de presion o ulceras?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor19">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs19" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>La auxiliar de enfermeria lubrica adecuadamente la piel?</label>
          <input type="hidden" class="form-control" name="criterio20" value="La auxiliar de enfermeria lubrica adecuadamente la piel?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor20">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs20" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>Se evidencian cambios de posicion del paciente por el auxiliar de enfermeria y cuidador?</label>
          <input type="hidden" class="form-control" name="criterio21" value="Se evidencian cambios de posicion del paciente por el auxiliar de enfermeria y cuidador?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor21">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs21" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>Los dispositivos invasivos que tiene el paciente se encuentran en posicion adecuada?</label>
          <input type="hidden" class="form-control" name="criterio22" value="Los dispositivos invasivos que tiene el paciente se encuentran en posicion adecuada?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor22">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs22" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>Se manejan estos dispositivos con tecnicas de asepsia y antisepsia?</label>
          <input type="hidden" class="form-control" name="criterio23" value="Se manejan estos dispositivos con tecnicas de asepsia y antisepsia?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor23">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs23" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>La auxiliar de enfermeria y / o cuidador conocen el manejo de los dispositivos invasivos?</label>
          <input type="hidden" class="form-control" name="criterio24" value="La auxiliar de enfermeria y / o cuidador conocen el manejo de los dispositivos invasivos?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor24">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs24" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>En pacientes con sonda vesical, se estan realizando los cambios cada 15 dias?</label>
          <input type="hidden" class="form-control" name="criterio25" value="En pacientes con sonda vesical, se estan realizando los cambios cada 15 dias?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor25">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs25" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>Si el paciente tiene instalada venoclisis, cateter subcutaneo, se observan signos de flebitis?</label>
          <input type="hidden" class="form-control" name="criterio26" value="Si el paciente tiene instalada venoclisis, cateter subcutaneo, se observan signos de flebitis?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor26">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs26" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>Se ha identificado signos de infeccion producidos por los dispositivos invasivos?</label>
          <input type="hidden" class="form-control" name="criterio27" value="Se ha identificado signos de infeccion producidos por los dispositivos invasivos?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor27">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs27" class="form-control"  rows="4" cols="80"></textarea>
        </article>

        <article class="col-md-6 text-left">
          <label>Las condiciones de limpieza donde reside el paciente (dormitorio, baño, cocina, implementos para la alimentacion, alimentos), garantizan situacion de higiene para el páciente?</label>
          <input type="hidden" class="form-control" name="criterio28" value="Las condiciones de limpieza donde reside el paciente (dormitorio, baño, cocina, implementos para la alimentacion, alimentos), garantizan situacion de higiene para el páciente?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor28">
            <option value="Cumple">Cumple</option>
            <option value="No Cumple">No Cumple</option>
            <option value="No Aplica">No Aplica</option>
          </select>
        </article>
        <article class="col-md-4">
          <label for="">Observación:</label>
          <textarea name="obs28" class="form-control"  rows="4" cols="80"></textarea>
        </article>

                <article class="col-md-6 text-left">
                  <label>Se da capacitacion al cuidador y familia sobre los aspectos de seguridad para evitar caidas,ulceras, infecciones al paciente?</label>
                  <input type="hidden" class="form-control" name="criterio29" value="Se da capacitacion al cuidador y familia sobre los aspectos de seguridad para evitar caidas,ulceras, infecciones al paciente?"<?php echo $atributo1?>>
                </article>
                <article class="col-md-2">
                  <label for="">Seleccione:</label>
                  <select class="form-control" name="valor29">
                    <option value="Cumple">Cumple</option>
                    <option value="No Cumple">No Cumple</option>
                    <option value="No Aplica">No Aplica</option>
                  </select>
                </article>
                <article class="col-md-4">
                  <label for="">Observación:</label>
                  <textarea name="obs29" class="form-control"  rows="4" cols="80"></textarea>
                </article>

                <article class="col-md-6 text-left">
                  <label>Se han realizado capacitaciones internas con el personal asistencial sobre las medidas de seguridad para evitar las  acciones inseguras más frecuentes que pueden generar eventos adversos en los pacientes domiciliarios.</label>
                  <input type="hidden" class="form-control" name="criterio30" value="Se han realizado capacitaciones internas con el personal asistencial sobre las medidas de seguridad para evitar las  acciones inseguras más frecuentes que pueden generar eventos adversos en los pacientes domiciliarios."<?php echo $atributo1?>>
                </article>
                <article class="col-md-2">
                  <label for="">Seleccione:</label>
                  <select class="form-control" name="valor30">
                    <option value="Cumple">Cumple</option>
                    <option value="No Cumple">No Cumple</option>
                    <option value="No Aplica">No Aplica</option>
                  </select>
                </article>
                <article class="col-md-4">
                  <label for="">Observación:</label>
                  <textarea name="obs30" class="form-control"  rows="4" cols="80"></textarea>
                </article>

    </section>
    <section class="panel-body">
     <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
     <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
     <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
   </section>
 		</section>
  </form>
