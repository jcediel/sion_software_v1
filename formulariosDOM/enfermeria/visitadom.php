<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio='.$servicio.'&buscar=Buscar&opcion='.$option;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading">
     <h2><?php echo $subtitulo; ?></h2>
    </section>
    <section class="panel-body">
      <article class="col-md-6">
        <label>Fecha registro:</label>
        <input type="text" class="form-control" name="freg" value="<?php echo date('Y-m-d') ?>"<?php echo $atributo1?>>
        <input type="hidden" class="form-control" name="idadmhosp" value="<?php echo $_REQUEST['idadm'] ?>"<?php echo $atributo1?>>
      </article>
    </section>

    <section class="panel-body">
      <article class="col-md-6 text-left">
        <label>Verificacion de datos del paciente y cuidador</label>
        <input type="hidden" class="form-control" name="pregunta1" value="Verificacion de datos del paciente y cuidador"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="criterio1">
          <option value="0">No aplica</option>
          <option value="1">SI</option>
          <option value="2">NO</option>
        </select>
      </article>
      <article class="col-md-6 text-left">
        <label>Verificacion de servicios autorizados </label>
        <input type="hidden" class="form-control" name="pregunta1" value="Verificacion de servicios autorizados "<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="criterio2">
          <option value="0">No aplica</option>
          <option value="1">SI</option>
          <option value="2">NO</option>
        </select>
      </article>
      <article class="col-md-6 text-left">
        <label>Socializacion de derechos y deberes del usuario y la familia</label>
        <input type="hidden" class="form-control" name="pregunta1" value="socializacion de derechos y deberes del usuario y la familia"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="criterio3">
          <option value="0">No aplica</option>
          <option value="1">SI</option>
          <option value="2">NO</option>
        </select>
      </article>
      <article class="col-md-6 text-left">
        <label>Revision de criterios de inclusion y exclusion</label>
        <input type="hidden" class="form-control" name="pregunta1" value="revision de criterios de inclusion y exclusion"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="criterio4">
          <option value="0">No aplica</option>
          <option value="1">SI</option>
          <option value="2">NO</option>
        </select>
      </article>
      <article class="col-md-6 text-left">
        <label>Socializacion del consentimiento informado de servicios domiciliarios</label>
        <input type="hidden" class="form-control" name="pregunta1" value="socializacion del consentimiento informado de servicios domiciliarios"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="criterio5">
          <option value="0">No aplica</option>
          <option value="1">SI</option>
          <option value="2">NO</option>
        </select>
      </article>
      <article class="col-md-6 text-left">
        <label>Socializacion de las funciones del Auxiliar de enfermeria</label>
        <input type="hidden" class="form-control" name="pregunta1" value="socializacion de las funciones del Auxiliar de enfermeria"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="criterio6">
          <option value="0">No aplica</option>
          <option value="1">SI</option>
          <option value="2">NO</option>
        </select>
      </article>
      <article class="col-md-6 text-left">
        <label>Valoracion cefalocaudal del paciente y aplicacion  de escalas de valoracion</label>
        <input type="hidden" class="form-control" name="pregunta1" value="Valoracion cefalocaudal del paciente y aplicacion  de escalas de valoracion"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="criterio7">
          <option value="0">No aplica</option>
          <option value="1">SI</option>
          <option value="2">NO</option>
        </select>
      </article>
      <article class="col-md-6 text-left">
        <label>Diligenciamiento de la ronda de seguridad</label>
        <input type="hidden" class="form-control" name="pregunta1" value="diligenciamiento de la ronda de seguridad"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="criterio8">
          <option value="0">No aplica</option>
          <option value="1">SI</option>
          <option value="2">NO</option>
        </select>
      </article>
      <article class="col-md-6 text-left">
        <label>Aplicacion de encuesta de satisfaccion</label>
        <input type="hidden" class="form-control" name="pregunta1" value="aplicacion de encuesta de satisfaccion"<?php echo $atributo1?>>
      </article>
      <article class="col-md-2">
        <label for="">Seleccione:</label>
        <select class="form-control" name="criterio9">
          <option value="0">No aplica</option>
          <option value="1">SI</option>
          <option value="2">NO</option>
        </select>
      </article>
      <article class="col-md-12 text-left">
        <label>Observación</label>
        <textarea name="obs_visita" class="form-control" rows="5"></textarea>
      </article>
    </section>

    <section class="panel-body">
     <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
     <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
     <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
   </section>
 		</section>
  </form>
