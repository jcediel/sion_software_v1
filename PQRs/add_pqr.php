<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
          $("#codigo").autocomplete({
              source: "configuraciones/bus_pac.php",
              minLength: 2,
              select: function(event, ui) {
        event.preventDefault();
                  $('#codigo').val(ui.item.codigo);
        $('#descripcion').val(ui.item.descripcion);
        $('#documento').val(ui.item.documento);

         }
          });
  });
</script>
<form action="<?php echo PROGRAMA.'?opcion=103';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading">
      <h3><?php echo $subtitulo;?></h3>
    </section>
    <section class="panel-body">
      <form>
        <article class="col-md-4">
          <label for="">Busqueda Paciente:</label>
          <input type="text" required="" class="form-control" name="idpac" id="codigo" placeholder="Digite numero de documento" value="">
        </article>
        <article class="col-md-4">
          <label for="">Paciente seleccionado:</label>
          <input type="text" required="" class="form-control" name="nompac" id="descripcion"  required=""value="" <?php echo $atributo1;?>>
        </article>
        <article class="col-md-9">
          <label for="">Datos de contacto del cliente:</label>
          <textarea name="contacto_cliente" class="form-control" rows="5" cols="80" placeholder="Describa en este espacio los datos adicionales de contacto del paciente"></textarea>
        </article>
        <article class="col-md-3">
          <label for="">Seleccione Linea Negocio:</label>
          <select name="linea_negocio" class="form-control"  required="" <?php echo $atributo3; ?>>
            <option value=""></option>
            <?php
            $sql="SELECT id_serv,nomserv from tipo_servicio ORDER BY id_serv ASC";
            if($tabla=$bd1->sub_tuplas($sql)){
              foreach ($tabla as $fila2) {
                if ($fila["id_serv"]==$fila2["id_serv"]){
                  $sw=' selected="selected"';
                }else{
                  $sw="";
                }

              echo '<option value="'.$fila2["id_serv"].'"'.$sw.'>'.$fila2["nomserv"].'</option>';
              }
            }
            ?>
            <option class="text-info" value="14"><strong>Enfermeria Domiciliarios</strong></option>
            <option class="text-info" value="15"><strong>Terapias Domiciliarios</strong></option>
          </select>
        </article>
      </form>
    </section>
    <section class="panel-body">
      <article class="col-md-3">
        <label for="">Email Rta 1:</label>
        <input type="email" class="form-control" name="email_rta" id="codigo"  value="">
      </article>
      <article class="col-md-3">
        <label for="">Email Rta 2:</label>
        <input type="email" class="form-control" name="email_rta1" id="codigo"  value="">
      </article>
      <article class="col-md-3">
        <label for="">Email Rta 3:</label>
        <input type="email" class="form-control" name="email_rta2" id="codigo"  value="">
      </article>
      <article class="col-md-3">
        <label for="">Email Rta 4:</label>
        <input type="email" class="form-control" name="email_rta3" id="codigo"  value="">
      </article>
    </section>
    <section class="panel-body">
      <article class="col-md-3">
        <label for="">Seleccione Sede:</label>
        <select name="sede" class="form-control"  required="" <?php echo $atributo3; ?>>
          <option value=""></option>
          <?php
          $sql="SELECT id_sedes_ips,nom_sedes from sedes_ips WHERE estado_sedes='Activo' and id_sedes_ips in (1,2,3,4,5,8,9,10) ORDER BY id_sedes_ips ASC";
          if($tabla=$bd1->sub_tuplas($sql)){
            foreach ($tabla as $fila2) {
              if ($fila["id_sedes_ips"]==$fila2["id_sedes_ips"]){
                $sw=' selected="selected"';
              }else{
                $sw="";
              }
            echo '<option value="'.$fila2["id_sedes_ips"].'"'.$sw.'>'.$fila2["nom_sedes"].'</option>';
            }
          }
          ?>
        </select>
      </article>
      <article class="col-md-3">
        <label for="">Seleccione EPS:</label>
        <select name="eps" class="form-control"  <?php echo atributo3; ?>>
          <option value=""></option>
          <option value="Ninguna">Ninguna</option>
          <?php
          $sql="SELECT id_eps,nom_eps from eps WHERE estado_eps='Activo' ORDER BY id_eps ASC";
          if($tabla=$bd1->sub_tuplas($sql)){
            foreach ($tabla as $fila2) {
              if ($fila["id_eps"]==$fila2["id_eps"]){
                $sw=' selected="selected"';
              }else{
                $sw="";
              }
            echo '<option value="'.$fila2["id_eps"].'"'.$sw.'>'.$fila2["nom_eps"].'</option>';
            }
          }
          ?>
        </select>
      </article>
      <article class="col-md-2">
        <label for="">Medio registro:</label>
        <select class="form-control" name="medio_registro" required="">
          <option value=""></option>
          <option value="Telefonica">Telefonica</option>
          <option value="Escrita">Escrita</option>
          <option value="E-mail">E-mail</option>
          <option value="buzon">Buzon</option>
        </select>
      </article>
      <article class="col-md-2">
        <label for="">Tipo cliente:</label>
        <select class="form-control" name="tipo_cliente" required="">
          <option value=""></option>
          <option value="Usuario">Usuario</option>
          <option value="EPS">EPS</option>
          <option value="Juzgado">Juzgado</option>
          <option value="Interno">Interno</option>
        </select>
      </article>
      <article class="col-md-2">
        <label for="">Tipo de solicitud:</label>
        <select class="form-control" name="tipo_solicitud" required="">
          <option value=""></option>
          <option value="Peticion">Peticion</option>
          <option value="Quejas">Quejas</option>
          <option value="Reclamo">Reclamo</option>
          <option value="Sugerencia">Sugerencia</option>
          <option value="Felicitacion">Felicitacion</option>
        </select>
      </article>
      <article class="col-md-12">
        <label for="">Seleccione Causa:</label>
        <select name="causa" class="form-control" required <?php echo atributo3; ?>>
          <option value=""></option>
            <option value="Insatisfacción con el manejo  de partencias de los usuarios">Insatisfacción con el manejo  de partencias de los usuarios</option>
            <option value="Dificultades de  comunicación">Dificultades de  comunicación</option>
            <option value="Fallas frente a el Suministro de Medicamentos">Fallas frente a el Suministro de Medicamentos</option>
            <option value="Dificultades en el ingreso para visitas">Dificultades en el ingreso para visitas</option>
            <option value="Oportunidad en la asignación de Citas">Oportunidad en la asignación de Citas</option>
            <option value="Insatisfacción del usuario con el proceso administrativo">Insatisfacción del usuario con el proceso administrativo</option>
            <option value="Deficiencia en la efectividad de la atención de salud">Deficiencia en la efectividad de la atención de salud</option>
            <option value="Falta de disponibilidad de recurso humano físico para la atención">Falta de disponibilidad de recurso humano físico para la atención</option>
            <option value="Restricción en el acceso a los servicios de salud">Restricción en el acceso a los servicios de salud</option>
            <option value="OTRA ">OTRA </option>
        </select>
      </article>
    </section>
    <section class="panel-body">
      <article class="col-md-4">
        <label for="">Fecha Radicado</label>
        <input type="date" class="form-control" required="" name="fecha_radicado" value="<?php echo date('Y-m-d') ?>">
      </article>
      <article class="col-md-4">
        <label for="">Hora Radicado</label>
        <input type="time" class="form-control" required="" name="hora_radicado">
      </article>
      <article class="col-md-4">
        <label for=""># Radicado</label>
        <input type="text" class="form-control" required="" name="radicado_eps">
      </article>
      <article class="col-md-8">
        <label for="">Descripción PQRS</label>
        <textarea name="descripcion_pqrs" rows="8" cols="80" class="form-control" placeholder="---Aquí describa la PQRS o pegue el texto del correo"></textarea>
      </article>
      <div class="col-md-4">
          <p><label>Soporte PQRS:</label>
          <?php echo $fila["soporte_pqr"];?><br>
          <input type="file" class="form-control" name="soporte_pqr" <?php echo $atributo3; ?>/><p>
          <p></p>
      </div>
    </section>
    <section class="panel-body">
      <article class="col-md-6">
        <p class="alert alert-success">Recuerde realizar la clasificación de la PQRS para el calculo de tiempos.</p>
      </article>
      <article class="col-md-6">
        <label for="">Clasificación:</label>
        <select class="form-control" name="clasificacion" required="">
          <option value=""></option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
        </select>
      </article>
      <br>
    </section>
    <section class="panel-body">
      <div class="row text-center">
        <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
        <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
        <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
      </div>
    </section>
  </section>
</form>
