
<form action="<?php echo PROGRAMA.'';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel panel-default">
  <section class="panel-heading">
    <h4><?php echo $subtitulo ?></h4>
  </section>
  <section class="panel-body">
    <?php include("PQRs/consul_pacPQRS.php");?>
  </section>
  <section class="panel-body">
    <article class="col-md-3">
      <label for="">Categoria: </label>
      <input type="text" name="clasificacion" class="form-control" value="<?php echo $fila['clasificacion'] ?>">
    </article>
    <article class="col-md-3">
      <label for="">Tipo solicitud: </label>
      <input type="text" name="solicitud" class="form-control" value="<?php echo $fila['tipo_solicitud'] ?>">
    </article>
    <article class="col-md-12">
      <label for="">Descripción PQRS</label>
      <textarea name="name" class="form-control" rows="5" ><?php echo $fila['descripcion_pqrs'] ?></textarea>
    </article>
  </section>
  <section class="panel-body"> <!--evolucion to-->
    <article class="col-xs-3">
      <label for="">Fecha de Respuesta:</label>
      <input type="hidden" name="id_pqr" value="<?php echo $_GET['idp']?>">
      <input type="hidden" name="email_rta" value="<?php echo $fila['email_rta']?>">
      <input type="hidden" name="nom_completo" value="<?php echo $fila['nom_completo']?>">
      <input type="date" name="fecha_rta" class="form-control" value="<?php echo date('Y-m-d');?>" <?php echo $atributo1; ?>>
    </article>
    <article class="col-xs-3">
      <label for="">Nivel Satisfaccion:</label>
      <select class="form-control" name="nivel_satisfaccion" required="">
        <option value=""></option>
        <option value="Bueno">Bueno</option>
        <option value="Regular">Regular</option>
        <option value="Malo">Malo</option>
      </select>
    </article>
    <article class="col-xs-3">
      <label for="">Seleccion Atributo:</label>
      <select class="form-control" name="atributo_pqrs" required="">
        <option value=""></option>
        <option value="ACCESIBILIDAD">ACCESIBILIDAD</option>
        <option value="OPORTUNIDAD">OPORTUNIDAD</option>
        <option value="CONTINUIDAD">CONTINUIDAD</option>
        <option value="PERTINENCIA">PERTINENCIA</option>
        <option value="SEGURIDAD">SEGURIDAD</option>
        <option value="SATISFACCION DEL USUARIO">SATISFACCION DEL USUARIO</option>
      </select>
    </article>
    <article class="col-md-12">
      <label for="">Observación atributo</label>
      <textarea name="obs_clasificacion_pqrs" class="form-control" rows="5" ></textarea>
    </article>
  </section>
    <article class="col-md-12">
      <?php
      $soporte=$fila['soporte_pqr'];
      if ($soporte=='') {
        echo'<p class="text-danger">No hay archivo adjunto</p>';
      }else {
        echo '<a href="pqrsoportes/'.$fila['soporte_pqr'].'"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> soporte de PQRs</button></a>';
      }

       ?>
    </article>
    <br>
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
