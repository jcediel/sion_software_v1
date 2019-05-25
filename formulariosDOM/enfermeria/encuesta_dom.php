<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio='.$servicio.'&buscar=Buscar&opcion='.$option;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading">
     <h2><?php echo $subtitulo; ?></h2>
    </section>
    <section class="panel-body">
      <article class="col-md-6">
        <label>Fecha registro:</label>
        <input type="text" class="form-control" name="freg_encuesta" value="<?php echo date('Y-m-d') ?>"<?php echo $atributo1?>>
        <input type="hidden" class="form-control" name="idadmhosp" value="<?php echo $_REQUEST['idadmhosp'] ?>"<?php echo $atributo1?>>
      </article>
    </section>
    <section class="panel-body">
      <article class="col-md-6 text-left">
        <label>Fue amable y clara la comunicación del funcionario cuando lo contactarón para presentarle el servicio domiciliario</label>
        <input type="hidden" class="form-control" name="pregunta1" value="Fue amable y clara la comunicación del funcionario cuando lo contactarón para presentarle el servicio domiciliario"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor1">
          <option value="0">No aplica</option>
          <option value="1">Pesimo</option>
          <option value="2">Malo</option>
          <option value="3">Regular</option>
          <option value="4">Bueno</option>
          <option value="5">Excelente</option>
        </select>
      </article>

      <article class="col-md-6 text-left">
        <label>El tiempo de  asignación de auxiliares de enfermeria y profesionales asistenciales fue </label>
        <input type="hidden" class="form-control" name="pregunta2" value="El tiempo de  asignación de auxiliares de enfermeria y profesionales asistenciales fue "<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor2">
          <option value="0">No aplica</option>
          <option value="1">Pesimo</option>
          <option value="2">Malo</option>
          <option value="3">Regular</option>
          <option value="4">Bueno</option>
          <option value="5">Excelente</option>
        </select>
      </article>


      <article class="col-md-6 text-left">
        <label>Conoce los deberes y derechos de los usuarios en Emmanuel IPS</label>
        <input type="hidden" class="form-control" name="pregunta3" value="Conoce los deberes y derechos de los usuarios en Emmanuel IPS"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor3">
          <option value="0">No aplica</option>
          <option value="1">Pesimo</option>
          <option value="2">Malo</option>
          <option value="3">Regular</option>
          <option value="4">Bueno</option>
          <option value="5">Excelente</option>
        </select>
      </article>



      <article class="col-md-6 text-left">
        <label>El personal de salud le explico el plan de manejo domiciliario?</label>
        <input type="hidden" class="form-control" name="pregunta4" value="El personal de salud le explico el plan de manejo domiciliario?"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor4">
          <option value="0">No aplica</option>
          <option value="1">Pesimo</option>
          <option value="2">Malo</option>
          <option value="3">Regular</option>
          <option value="4">Bueno</option>
          <option value="5">Excelente</option>
        </select>
      </article>


      <article class="col-md-6 text-left">
        <label>Le presentaron y explicaron el consentimiento informado para realizar la atencion domiciliaria?</label>
        <input type="hidden" class="form-control" name="pregunta5" value="Le presentaron y explicaron el consentimiento informado para realizar la atencion domiciliaria?"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor5">
          <option value="0">No aplica</option>
          <option value="1">Pesimo</option>
          <option value="2">Malo</option>
          <option value="3">Regular</option>
          <option value="4">Bueno</option>
          <option value="5">Excelente</option>
        </select>
      </article>


      <article class="col-md-6 text-left">
        <label> Recibio un trato amable de parte de el medico en su atencion?</label>
        <input type="hidden" class="form-control" name="pregunta6" value=" Recibio un trato amable de parte de el medico en su atencion?"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor6">
          <option value="0">No aplica</option>
          <option value="1">Pesimo</option>
          <option value="2">Malo</option>
          <option value="3">Regular</option>
          <option value="4">Bueno</option>
          <option value="5">Excelente</option>
        </select>
      </article>


      <article class="col-md-6 text-left">
        <label>El cumplimiento de las visitas medicas ofrecidas fue </label>
        <input type="hidden" class="form-control" name="pregunta7" value="El cumplimiento de las visitas medicas ofrecidas fue "<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor7">
          <option value="0">No aplica</option>
          <option value="1">Pesimo</option>
          <option value="2">Malo</option>
          <option value="3">Regular</option>
          <option value="4">Bueno</option>
          <option value="5">Excelente</option>
        </select>
      </article>


      <article class="col-md-6 text-left">
        <label>Recibio llamada previa  para coordinar la visita medica?</label>
        <input type="hidden" class="form-control" name="pregunta8" value="Recibio llamada previa  para coordinar la visita medica?"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor8">
          <option value="0">No aplica</option>
          <option value="1">Pesimo</option>
          <option value="2">Malo</option>
          <option value="3">Regular</option>
          <option value="4">Bueno</option>
          <option value="5">Excelente</option>
        </select>
      </article>


      <article class="col-md-6 text-left">
        <label>Las respuestas a sus inquietudes fuerón resueltas?</label>
        <input type="hidden" class="form-control" name="pregunta9" value="Las respuestas a sus inquietudes fuerón resueltas?"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="valor9">
          <option value="0">No aplica</option>
          <option value="1">Pesimo</option>
          <option value="2">Malo</option>
          <option value="3">Regular</option>
          <option value="4">Bueno</option>
          <option value="5">Excelente</option>
        </select>
      </article>

      <article class="col-md-6 text-left">
          <label> Recibio un trato amable de parte de enfermeria en su atencion?</label>
          <input type="hidden" class="form-control" name="pregunta10" value=" Recibio un trato amable de parte de enfermeria en su atencion?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor10">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label>El cumplimiento de la atencion de enfermeria fue </label>
          <input type="hidden" class="form-control" name="pregunta11" value="El cumplimiento de la atencion de enfermeria fue "<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor11">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label>La auxiliar de enfermeria le informo cuando no iba a asistir o tardaba en llegar?</label>
          <input type="hidden" class="form-control" name="pregunta12" value="La auxiliar de enfermeria le informo cuando no iba a asistir o tardaba en llegar?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor12">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label>La enfermera se preocupo por su comodidad durante el servicio?</label>
          <input type="hidden" class="form-control" name="pregunta13" value="La enfermera se preocupo por su comodidad durante el servicio?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor13">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label>La enfermera le brindo medidas de seguridad mientras le atendia?</label>
          <input type="hidden" class="form-control" name="pregunta14" value="La enfermera le brindo medidas de seguridad mientras le atendia?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor14">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label>La enfermera le brindo privacidad mientras le administraba el cuidado?</label>
          <input type="hidden" class="form-control" name="pregunta15" value="La enfermera le brindo privacidad mientras le administraba el cuidado?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor15">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label>La enfermera le explico los procedimientos que le iba a realizar?</label>
          <input type="hidden" class="form-control" name="pregunta16" value="La enfermera le explico los procedimientos que le iba a realizar?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor16">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label>La enfermera realizo las actividades con higiene?</label>
          <input type="hidden" class="form-control" name="pregunta17" value="La enfermera realizo las actividades con higiene?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor17">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label>Confio en las habilidades de la enfermera?</label>
          <input type="hidden" class="form-control" name="pregunta18" value="Confio en las habilidades de la enfermera?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor18">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label>La enfermera brindo informacion sobre autocuidado?</label>
          <input type="hidden" class="form-control" name="pregunta19" value="La enfermera brindo informacion sobre autocuidado?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor19">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label>La enfermera respondio a sus inquietudes?</label>
          <input type="hidden" class="form-control" name="pregunta20" value="La enfermera respondio a sus inquietudes?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor20">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label> Recibio un trato amable de parte de terapia en su atencion?</label>
          <input type="hidden" class="form-control" name="pregunta21" value=" Recibio un trato amable de parte de terapia en su atencion?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor21">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label>El cumplimiento de la atencion de terapias fue </label>
          <input type="hidden" class="form-control" name="pregunta22" value="El cumplimiento de la atencion de terapias fue "<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor22">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label>La terapeuta le informo cuando no iba a asistir o tardaba en llegar?</label>
          <input type="hidden" class="form-control" name="pregunta23" value="La terapeuta le informo cuando no iba a asistir o tardaba en llegar?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor23">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label>La terapeuta se preocupo por su comodidad durante el servicio?</label>
          <input type="hidden" class="form-control" name="pregunta24" value="La terapeuta se preocupo por su comodidad durante el servicio?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor24">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label>La terapeuta le brindo medidas de seguridad mientras le atendia?</label>
          <input type="hidden" class="form-control" name="pregunta25" value="La terapeuta le brindo medidas de seguridad mientras le atendia?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor25">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label>La terapeuta le brindo privacidad mientras le administraba el cuidado?</label>
          <input type="hidden" class="form-control" name="pregunta26" value="La terapeuta le brindo privacidad mientras le administraba el cuidado?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor26">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label>La terapeuta le explico los procedimientos que le iba a realizar?</label>
          <input type="hidden" class="form-control" name="pregunta27" value="La terapeuta le explico los procedimientos que le iba a realizar?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor27">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


        <article class="col-md-6 text-left">
          <label>La terapeuta realizo las actividades con higiene?</label>
          <input type="hidden" class="form-control" name="pregunta28" value="La terapeuta realizo las actividades con higiene?"<?php echo $atributo1?>>
        </article>
        <article class="col-md-2">
          <label for="">Seleccione:</label>
          <select class="form-control" name="valor28">
            <option value="0">No aplica</option>
            <option value="1">Pesimo</option>
            <option value="2">Malo</option>
            <option value="3">Regular</option>
            <option value="4">Bueno</option>
            <option value="5">Excelente</option>
          </select>
        </article>


                <article class="col-md-6 text-left">
                  <label>Confio en las habilidades de la terapeuta?</label>
                  <input type="hidden" class="form-control" name="pregunta29" value="Confio en las habilidades de la terapeuta?"<?php echo $atributo1?>>
                </article>
                <article class="col-md-2">
                  <label for="">Seleccione:</label>
                  <select class="form-control" name="valor29">
                    <option value="0">No aplica</option>
                    <option value="1">Pesimo</option>
                    <option value="2">Malo</option>
                    <option value="3">Regular</option>
                    <option value="4">Bueno</option>
                    <option value="5">Excelente</option>
                  </select>
                </article>

                <article class="col-md-6 text-left">
                  <label>La terapeuta brindo informacion sobre autocuidado?</label>
                  <input type="hidden" class="form-control" name="pregunta30" value="La terapeuta brindo informacion sobre autocuidado?"<?php echo $atributo1?>>
                </article>
                <article class="col-md-2">
                  <label for="">Seleccione:</label>
                  <select class="form-control" name="valor30">
                    <option value="0">No aplica</option>
                    <option value="1">Pesimo</option>
                    <option value="2">Malo</option>
                    <option value="3">Regular</option>
                    <option value="4">Bueno</option>
                    <option value="5">Excelente</option>
                  </select>
                </article>


                <article class="col-md-6 text-left">
                  <label>El personal ha contado con los insumos para brindar la atencion?</label>
                  <input type="hidden" class="form-control" name="pregunta31" value="El personal ha contado con los insumos para brindar la atencion?"<?php echo $atributo1?>>
                </article>
                <article class="col-md-2">
                  <label for="">Seleccione:</label>
                  <select class="form-control" name="valor31">
                    <option value="0">No aplica</option>
                    <option value="1">Pesimo</option>
                    <option value="2">Malo</option>
                    <option value="3">Regular</option>
                    <option value="4">Bueno</option>
                    <option value="5">Excelente</option>
                  </select>
                </article>


                <article class="col-md-6 text-left">
                  <label>La recolección de desechos por el personal fue oportuna?</label>
                  <input type="hidden" class="form-control" name="pregunta32" value="La recolección de desechos por el personal fue oportuna?"<?php echo $atributo1?>>
                </article>
                <article class="col-md-2">
                  <label for="">Seleccione:</label>
                  <select class="form-control" name="valor32">
                    <option value="0">No aplica</option>
                    <option value="1">Pesimo</option>
                    <option value="2">Malo</option>
                    <option value="3">Regular</option>
                    <option value="4">Bueno</option>
                    <option value="5">Excelente</option>
                  </select>
                </article>


                <article class="col-md-6 text-left">
                  <label>En General la Calificación del Servicio Fue</label>
                  <input type="hidden" class="form-control" name="pregunta33" value="En General la Calificación del Servicio Fue"<?php echo $atributo1?>>
                </article>
                <article class="col-md-2">
                  <label for="">Seleccione:</label>
                  <select class="form-control" name="valor33">
                    <option value="0">No aplica</option>
                    <option value="1">Pesimo</option>
                    <option value="2">Malo</option>
                    <option value="3">Regular</option>
                    <option value="4">Bueno</option>
                    <option value="5">Excelente</option>
                  </select>
                </article>
                <article class="col-md-4">
                  <label for="">Si su respuesta es regular, malo o pesimo explique porque ?</label>
                  <textarea name="obs33" rows="4" cols="80" class="form-control"></textarea>
                </article>

                <article class="col-md-6 text-left">
                  <label>Recomendaria o volveria a solicitar los servicios de Emmanuel IPS, Servicios Domiciliarios:</label>
                  <input type="hidden" class="form-control" name="pregunta34" value="Recomendaria o volveria a solicitar los servicios de Emmanuel IPS, Servicios Domiciliarios:"<?php echo $atributo1?>>
                </article>
                <article class="col-md-2">
                  <label for="">Seleccione:</label>
                  <select class="form-control" name="valor34">
                    <option value="0">No aplica</option>
                    <option value="1">Pesimo</option>
                    <option value="2">Malo</option>
                    <option value="3">Regular</option>
                    <option value="4">Bueno</option>
                    <option value="5">Excelente</option>
                  </select>
                </article>
    </section>
    <section class="panel-body">
     <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
     <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
     <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
   </section>
 		</section>
  </form>
