
<form action="<?php echo PROGRAMA.'';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel panel-default">
  <section class="panel-heading">
    <h4><?php echo $subtitulo ?></h4>
  </section>
  <section class="panel-body">
    <?php include("PQRs/consul_pacPQRS.php");?>
  </section>
  <section class="panel-body">
    <article class="col-md-6">
      <label for="">Descripción PQRS</label>
      <textarea name="name" class="form-control" rows="4"><?php echo $fila['descripcion_pqrs'] ?></textarea>
    </article>
  </section>
  <section class="panel-body">
    <article class="col-md-6">
      <label for="">Respuesta:</label>
      <textarea name="respuesta" class="form-control" rows="5"><?php echo $fila['descripcion_rta_pqr'] ?></textarea>
    </article>
    <article class="col-md-6">
      <label for="">Fecha de Respuesta:</label>
      <input type="hidden" name="id_pqr" value="<?php echo $_GET['idp']?>">
      <input type="hidden" name="email_rta" value="<?php echo $fila['email_rta']?>">
      <input type="hidden" name="nom_completo" value="<?php echo $fila['nom_completo']?>">
      <input type="date" name="fecha_rta" class="form-control" value="<?php echo $fila['fecha_rta'];?>" <?php echo $atributo1; ?>>
    </article>
    <article class="col-md-6">
      <label for="">Hora de Respuesta:</label>
      <input type="time" name="hora_rta" class="form-control" value="<?php echo $fila['hora_rta'];?>" <?php echo $atributo1; ?>>
    </article>

    <br>
  </section>
  <section class="panel-body">
    <article class="col-md-6">
      <label for="">Qué:</label>
      <textarea name="que" class="form-control" rows="5"></textarea>
    </article>
    <article class="col-md-6">
      <label for="">Cómo:</label>
      <textarea name="como" class="form-control" rows="5"></textarea>
    </article>
    <article class="col-md-6">
      <label for="">Inicio:</label>
      <input type="date" name="inicio" class="form-control" value="<?php echo date('Y-m-d') ?>">
    </article>
    <article class="col-md-6">
      <label for="">Final:</label>
      <input type="date" name="final" class="form-control" value="<?php echo date('Y-m-d') ?>">
    </article>
    <article class="col-md-6">
      <label for="">Quien:</label>
      <textarea name="como" class="form-control" rows="5"></textarea>
    </article>
    <article class="col-md-6">
      <label for="">Donde:</label>
      <textarea name="como" class="form-control" rows="5"></textarea>
    </article>
    <article class="col-md-6">
      <label for="">Por qué:</label>
      <textarea name="como" class="form-control" rows="5"></textarea>
    </article>
    <article class="col-md-6">
      <label for="">Seguimiento:</label>
      <input type="date" name="f_seguimiento" class="form-control" value="">
    </article>

  </section>
  <section  class="panel-body">
    <div class="col-md-12 text-center">
  	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
  		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
  		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
  	</div>
  </section>
</section>

</form>
