
<form action="<?php echo PROGRAMA.'';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel panel-default">
  <section class="panel-heading">
    <h4><?php echo $subtitulo ?></h4>
  </section>
  <section class="panel-body">
    <?php include("PQRs/consul_pacPQRS.php");?>
  </section>
  <section class="panel-body">
    <article class="col-md-12">
      <label for="">Descripción PQRS</label>
      <textarea name="name" class="form-control" rows="5"  <?php echo $atributo1 ?>><?php echo $fila['descripcion_pqrs'] ?></textarea>
    </article>
    <article class="col-md-6">
      <label for="">Email RTA</label>
      <input type="text" class="form-control" name="e1" value="<?php echo $fila['email_rta'] ?>"<?php echo $atributo1 ?>>
    </article>
    <article class="col-md-6">
      <label for="">Email RTA1</label>
      <input type="text" class="form-control" name="e2" value="<?php echo $fila['email_rta1'] ?>"<?php echo $atributo1 ?>>
    </article>
    <article class="col-md-6">
      <label for="">Email RTA2</label>
      <input type="text" class="form-control" name="e3" value="<?php echo $fila['email_rta2'] ?>"<?php echo $atributo1 ?>>
    </article>
    <article class="col-md-6">
      <label for="">Email RTA3</label>
      <input type="text" class="form-control" name="e4" value="<?php echo $fila['email_rta3'] ?>"<?php echo $atributo1 ?>>
    </article>
  </section>
  <section class="panel-body"> <!--evolucion to-->
    <article class="col-xs-3">
      <label for="">Fecha de Respuesta:</label>
      <input type="hidden" name="id_pqr" value="<?php echo $_GET['idp']?>">
      <input type="hidden" name="email_rta" value="<?php echo $fila['email_rta']?>">
      <input type="hidden" name="nom_completo" value="<?php echo $fila['nom_completo']?>">
      <input type="hidden" name="tdoc_pac" value="<?php echo $fila['tdoc_pac']?>">
      <input type="hidden" name="doc_pac" value="<?php echo $fila['doc_pac']?>">
      <input type="date" name="fecha_rta" class="form-control" value="<?php echo date('Y-m-d');?>" <?php echo $atributo1; ?>>
    </article>
    <article class="col-xs-3">
      <label for="">Hora de Respuesta:</label>
      <input type="time" name="hora_rta" class="form-control" value="<?php echo date('H:i');?>" <?php echo $atributo1; ?>>
    </article>
    <article class="col-xs-3">
      <label for="">Radicado EPS:</label>
      <input type="text" name="radicado_eps" class="form-control" value="<?php echo $fila['radicado_eps'];?>" <?php echo $atributo1; ?>>
    </article>

    <article class="col-xs-9">
      <label for="">Describa la respuesta :</label>
      <textarea name="respuesta" class="form-control" rows="5"></textarea>
    </article>
    <article class="col-xs-3">
      <label for="">Seleccione servicio :</label>
      <select class="form-control" name="servicio" required="">
        <option value=""></option>
        <option value="Fonoaudiologia">Fonoaudiologia</option>
        <option value="Fisioterapia">Fisioterapia</option>
        <option value="Psicologia Cognitiva">Psicologia Cognitiva</option>
        <option value="Psicologia">Psicologia</option>
        <option value="Terapia Ocupacional">Terapia Ocupacional</option>
        <option value="Equinoterapia">Equinoterapia</option>
        <option value="Terapia Asistida Perros">Terapia Asistida Perros</option>
        <option value="Hidroterapia">Hidroterapia</option>
        <option value="Musicoterapia">Musicoterapia</option>
        <option value="Enfermeria">Enfermeria</option>
        <option value="Medicina Fisica y Rahabilitacion">Medicina Fisica y Rahabilitacion</option>
        <option value="Psiquiatria">Psiquiatria</option>
        <option value="Neuropediatria">Neuropediatria</option>
        <option value="Rutas">Rutas</option>
        <option value="Administrativos">Administrativos</option>
        <option value="Ortopedia y Traumotalogia">Ortopedia y Traumotalogia</option>
        <option value="Medicina del Trabajo y Medicina Laboral">Medicina del Trabajo y Medicina Laboral</option>
        <option value="Trabajo Social">Trabajo Social</option>
        <option value="Terapia Respiratoria">Terapia Respiratoria</option>
        <option value="Motorizados">Motorizados</option>
        <option value="Recoleccion Residuos">Recoleccion Residuos</option>
        <option value="Medicina General">Medicina General</option>
        <option value="Farmacia">Farmacia</option>
        <option value="Casino Alimentos">Casino Alimentos</option>
        <option value="Otros">Otros</option>
      </select>
    </article>
    <article class="col-md-12">
      <?php
      $soporte=$fila['soporte_pqr'];
      if ($soporte=='') {
        echo'<p class="text-danger">No hay archivo adjunto</p>';
      }else {
        echo '<a href="'.$fila['soporte_pqr'].'"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-file-pdf-o"></span> soporte de PQRs</button></a>';
      }

       ?>
    </article>
    <article class="col-md-12">
      <?php
      $resp_respuesta=$_SESSION['AUT']['id_user'];
      $sql_user="SELECT nombre, especialidad, firma
                 FROM user WHERE id_user=$resp_respuesta";
      if ($tabla_user=$bd1->sub_tuplas($sql_user)){
 		    foreach ($tabla_user as $fila_user) {
          echo'<p>
          <input type="hidden" name="profesional" class="form-control" value="'.$fila_user['nombre'].'">
          </p>';
          echo'<p>
          <input type="hidden" name="especialidad" class="form-control" value="'.$fila_user['especialidad'].'">
          </p>';
          echo'<p>
          <input type="hidden" name="firma" class="form-control" value="'.$fila_user['firma'].'">
          </p>';
        }
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
