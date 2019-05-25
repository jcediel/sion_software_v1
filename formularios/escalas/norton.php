
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

      <article class="col-md-6">
        <h3>Condición física	</h3>
        <select class="form-control" required name="dato1">
          <option value=""></option>
          <option value="4">Buena</option>
          <option value="3">Regular</option>
          <option value="2">Pobre</option>
          <option value="1">Muy mala</option>
        </select>
      </article>

      <article class="col-md-6">
        <h3>Estado mental</h3>
        <select class="form-control" required name="dato2">
          <option value=""></option>
          <option value="4">Orientado</option>
          <option value="3">Apático</option>
          <option value="2">Confuso</option>
          <option value="1">Inconsciente</option>
        </select>
      </article>
    </section>
    <section class="panel-body">

      <article class="col-md-6">
        <h3>Actividad	</h3>
        <select class="form-control" required name="dato3">
          <option value=""></option>
          <option value="4">Deambula</option>
          <option value="3">Deambula con ayuda</option>
          <option value="2">Cama / silla</option>
          <option value="1">Encamado</option>
        </select>
      </article>
      <article class="col-md-6">
        <h3>Movilidad	</h3>
        <select class="form-control" required name="dato4">
          <option value=""></option>
          <option value="4">Total</option>
          <option value="3">Disminuida</option>
          <option value="2">Muy limitada</option>
          <option value="1">Inmóvil</option>
        </select>
      </article>
    </section>
    <section class="panel-body">

      <article class="col-md-6">
        <h3>Incontinencia</h3>
        <select class="form-control" required name="dato5">
          <option value=""></option>
          <option value="4">Control</option>
          <option value="3">Ocasional</option>
          <option value="2">Urinaria o Fecal</option>
          <option value="1">Urinaria y Fecal</option>
        </select>
      </article>

    </section>
    <section class="panel-body">
      <article class="col-md-12">
        <label for="">Observación:</label>
        <textarea name="observacion" class="form-control" rows="5" ></textarea>
      </article>
    </section>
  </section>

    <section class="panel-body">
      <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?> " />
      <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
      <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
    </section>
  </section>
</form>
