
<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio=Domiciliarios&buscar=Buscar&opcion='.$opcion;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel-heading">
    <h3><?php echo $titulo; ?></h3>
  </section>
  <section class="panel-body">
    <section class="panel-body">
      <section class="col-md-12">
        <article class="col-md-6">
          <label for="">Fecha de Registro:</label>
          <input type="date" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1;?> >
          <input type="hidden" name="idadmhosp" value="<?php echo $_GET["idadmhosp"] ;?>" class="form-control" <?php echo $atributo3;?> >
        </article>
        <article class="col-md-6">
          <label for="">Hora de Registro:</label>
          <input type="time" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1;?>>
          <input type="hidden" name="turno" value="<?php echo $_REQUEST['turno'] ;?>" class="form-control" <?php echo $atributo3;?>>
        </article>
      </section>
    </section>
    <section class="panel-body">
      <h3>Caidas previas	</h3>
      <article class="col-md-12">
        <label for="">Seleccione Criterio:</label>
        <select class="form-control" required name="calificacion1">
          <option value=""></option>
          <option value="0">NO</option>
          <option value="1">SI</option>
        </select>
      </article>
    </section>
    <section class="panel-body">
      <h3>Medicamentos	</h3>
      <article class="col-md-6">
        <label for="">Tranquilizantes o sedantes (midazolam, diazepam):</label>
        <input type="hidden" name="med1" value="Tranquilizantes o sedantes (midazolam, diazepam)">
        <select class="form-control" required name="med1_c">
          <option value=""></option>
          <option value="0">NO</option>
          <option value="1">SI</option>
        </select>
      </article>
      <article class="col-md-6">
        <label for="">Diureticos (furosemida, espironolctona,hidrodorotiazida):</label>
        <input type="hidden" name="med2" value="Diureticos (furosemida, espironolctona,hidrodorotiazida)">
        <select class="form-control" required name="med2_c">
          <option value=""></option>
          <option value="0">NO</option>
          <option value="1">SI</option>
        </select>
      </article>
      <article class="col-md-6">
        <label for="">Hipotensores no diureticos:</label>
        <input type="hidden" name="med3" value="Hipotensores no diureticos">
        <select class="form-control" required name="med3_c">
          <option value=""></option>
          <option value="0">NO</option>
          <option value="1">SI</option>
        </select>
      </article>
      <article class="col-md-6">
        <label for="">Antiparkinsonianos:</label>
        <input type="hidden" name="med4" value="Antiparkinsonianos">
        <select class="form-control" required name="med4_c">
          <option value=""></option>
          <option value="0">NO</option>
          <option value="1">SI</option>
        </select>
      </article>
      <article class="col-md-6">
        <label for="">Antidepresivos (fluoxetina,amitriptilina):</label>
        <input type="hidden" name="med5" value="Antidepresivos (fluoxetina,amitriptilina)">
        <select class="form-control" required name="med5_c">
          <option value=""></option>
          <option value="0">NO</option>
          <option value="1">SI</option>
        </select>
      </article>
      <article class="col-md-6">
        <label for="">Otros medicamentos:</label>
        <input type="hidden" name="med6" value="Otros medicamentos">
        <select class="form-control" required name="med6_c">
          <option value=""></option>
          <option value="0">NO</option>
          <option value="1">SI</option>
        </select>
      </article>
      <article class="col-md-6">
        <label for="">Ninguno:</label>
        <input type="hidden" name="med7" value="Ninguno">
        <select class="form-control" required name="med7_c">
          <option value=""></option>
          <option value="0">NO</option>
          <option value="1">SI</option>
        </select>
      </article>
    </section>
    <section class="panel-body">
      <h3>Deficiencias Sensoriales	</h3>
      <article class="col-md-6">
        <label for="">Alteraciones Visuales :</label>
        <input type="hidden" name="ds1" value="Alteraciones Visuales ">
        <select class="form-control" required name="ds1_c">
          <option value=""></option>
          <option value="0">NO</option>
          <option value="1">SI</option>
        </select>
      </article>
      <article class="col-md-6">
        <label for="">Alteraciones Auditivas, vertigo, utiliza audifonos:</label>
        <input type="hidden" name="ds2" value="Alteraciones Auditivas, vertigo, utiliza audifonos">
        <select class="form-control" required name="ds2_c">
          <option value=""></option>
          <option value="0">NO</option>
          <option value="1">SI</option>
        </select>
      </article>
      <article class="col-md-6">
        <label for="">Extremidades (ictus,dificultad para caminar, utiliza aparatos ortopedicos, etc.):</label>
        <input type="hidden" name="ds3" value="Extremidades (ictus,dificultad para caminar, utiliza aparatos ortopedicos, etc.)">
        <select class="form-control" required name="ds3_c">
          <option value=""></option>
          <option value="0">NO</option>
          <option value="1">SI</option>
        </select>
      </article>
      <article class="col-md-6">
        <label for="">Ninguno:</label>
        <input type="hidden" name="ds4" value="Ninguno">
        <select class="form-control" required name="ds4_c">
          <option value=""></option>
          <option value="0">NO</option>
          <option value="1">SI</option>
        </select>
      </article>
    </section>
    <section class="panel-body">

      <article class="col-md-6">
        <h3>Estado Mental (Observación Directa)</h3>
        <label for="">Seleccione Criterio:</label>
        <select class="form-control" required name="em1_c">
          <option value=""></option>
          <option value="0">Orientado</option>
          <option value="1">Confuso</option>
        </select>
      </article>
      <article class="col-md-6">
        <h3>Deambulación (observar al paciente)	</h3>
        <label for="">Seleccione Criterio:</label>
        <select class="form-control" required name="deambulacion">
          <option value=""></option>
          <option value="0">Normal</option>
          <option value="1">Segura con ayuda</option>
          <option value="1">Imposible (discapacitado,etc)</option>
          <option value="1">Insegura con ayuda/sin ayuda</option>
        </select>
      </article>
      <article class="col-md-12">
        <label for="">Observación:</label>
        <textarea name="sugerencia" class="form-control" rows="5" ></textarea>
      </article>
    </section>

    <section class="panel-body">
      <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?> " />
      <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
      <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
    </section>
  </section>
</form>
