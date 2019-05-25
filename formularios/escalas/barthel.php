
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
        <h3>Comer	</h3>
        <select class="form-control" required name="dato1_puntaje">
          <option value=""></option>
          <option value="0">Dependiente</option>
          <option value="5">Necesita ayuda para cortar, extender mantequilla, usar condimentos, etc.</option>
          <option value="10">Independiente (capaz de usar cualquier instrumento)</option>
        </select>
      </article>


      <article class="col-md-6">
        <h3>Trasladarse entre la silla y la cama	</h3>
        <select class="form-control" required name="dato2_puntaje">
          <option value=""></option>
          <option value="0">Dependiente, no se mantiene sentado</option>
          <option value="5">Necesita ayuda importante (1 persona entrenada o 2 personas), puede estar sentado </option>
          <option value="10">Necesita algo de ayuda (una pequeña ayuda física o ayuda verbal)</option>
          <option value="15">Independiente</option>
        </select>
      </article>
    </section>
    <section class="panel-body">

      <article class="col-md-6">
        <h3>Aseo personal</h3>
        <select class="form-control" required name="dato3_puntaje">
          <option value=""></option>
          <option value="0">Dependiente</option>
          <option value="5">Independiente para lavarse la cara, las manos y los dientes, peinarse y afeitarse</option>
        </select>
      </article>


      <article class="col-md-6">
        <h3>Uso del retrete</h3>
        <select class="form-control" required name="dato4_puntaje">
          <option value=""></option>
          <option value="0">Dependiente</option>
          <option value="5">Necesita alguna ayuda, pero puede hacer algo solo</option>
          <option value="10">Independiente (entrar y salir, limpiarse y vestirse)</option>
        </select>
      </article>
    </section>
    <section class="panel-body">

      <article class="col-md-6">
        <h3>Bañarse o Ducharse</h3>
        <select class="form-control" required name="dato5_puntaje">
          <option value=""></option>
          <option value="0">Dependiente</option>
          <option value="5">Independiente para bañarse o ducharse </option>
        </select>
      </article>


      <article class="col-md-6">
        <h3>Desplazarse</h3>
        <select class="form-control" required name="dato6_puntaje">
          <option value=""></option>
          <option value="0">Inmóvil</option>
          <option value="5">Independiente en silla de ruedas en 50 m </option>
          <option value="10">Anda con pequeña ayuda de una persona (física o verbal)</option>
          <option value="15">Independiente al menos 50 m, con cualquier tipo de muleta, excepto andador</option>
        </select>
      </article>
    </section>

    <section class="panel-body">

      <article class="col-md-6">
        <h3>Subir y bajar escaleras</h3>
        <select class="form-control" required name="dato7_puntaje">
          <option value=""></option>
          <option value="0">Dependiente</option>
          <option value="5">Necesita ayuda física o verbal, puede llevar cualquier tipo de muleta</option>
          <option value="10">Independiente para subir y bajar</option>
        </select>
      </article>


      <article class="col-md-6">
        <h3>Vestirse y desvestirse</h3>
        <select class="form-control" required name="dato8_puntaje">
          <option value=""></option>
          <option value="0">Dependiente</option>
          <option value="5">Necesita ayuda, pero puede hacer la mitad aproximadamente, sin ayuda</option>
          <option value="10">Independiente, incluyendo botones, cremalleras, cordones, etc.</option>
        </select>
      </article>
    </section>
    <section class="panel-body">

      <article class="col-md-6">
        <h3>Control de heces</h3>
        <select class="form-control" required name="dato9_puntaje">
          <option value=""></option>
          <option value="0">Incontinente (o necesita que le suministren enema)</option>
          <option value="5">Accidente excepcional (uno/semana) </option>
          <option value="10">Continente</option>
        </select>
      </article>


      <article class="col-md-6">
        <h3>Control de orina</h3>
        <select class="form-control" required name="dato10_puntaje">
          <option value=""></option>
          <option value="0">Incontinente, o sondado incapaz de cambiarse la bolsa</option>
          <option value="5">Accidente excepcional (máximo uno/24 horas) </option>
          <option value="10">Continente, durante al menos 7 días</option>
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
