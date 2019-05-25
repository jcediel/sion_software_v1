
<form action="<?php echo PROGRAMA.'?opcion=103';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel-body">
	  <?php
	    include("consulta_paciente.php");
	  ?>
	</section>
  <article>
		<h4 id="th-estilot">Registro de PQRS</h4>
	  <section class="panel-body"> <!--evolucion to-->

			<article class="col-xs-3">
				<label for="">Seleccione Sede:</label>
        <input type="hidden" name="idpac" value="<?php echo $_GET['idpaciente']?>">
        <select name="sede" class="form-control"  required="" <?php echo $atributo3; ?>>
          <option value="<?php echo $fila['id_sedes_ips'];?>"><?php echo $fila['id_sedes_ips'];?></option>
          <?php
          $sql="SELECT id_sedes_ips,nom_sedes from sedes_ips ORDER BY id_sedes_ips ASC";
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
      <article class="col-xs-3">
				<label for="">Seleccione EPS:</label>
        <select name="eps" class="form-control"  <?php echo atributo3; ?>>
          <option value=""></option>
          <?php
          $sql="SELECT id_eps,nom_eps from eps ORDER BY id_eps ASC";
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
			<article class="col-xs-3">
				<label for="">Numero Radicado EPS:</label>
				<input type="text" name="num_radocado_eps" value="<?php echo $fila['num_radicado_eps'] ?>" class="form-control">
			</article>
      <article class="col-xs-3">
				<label for="">Linea de negocio:</label>
				<select class="form-control" name="linea_negocio" required="">
				  <option value=""></option>
          <option value="Rehabilitacion Infantil">Rehabilitacion Infantil</option>
          <option value="Consulta Externa">Consulta Externa</option>
          <option value="Servicio Domiciliario">Servicio Domiciliario</option>
          <option value="Salud Mental">Salud Mental</option>
          <option value="ARL">ARL</option>
				</select>
			</article>
      <article class="col-xs-3">
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
      <article class="col-xs-2">
				<label for="">Categoria:</label>
				<select class="form-control" name="categoria" required="">
				  <option value=""></option>
          <option value="A">A</option>
          <option value="B">B</option>
				</select>
			</article>
      <article class="col-xs-2">
				<label for="">Medio registro:</label>
				<select class="form-control" name="medio_registro" required="">
				  <option value=""></option>
          <option value="Telefonica">Telefonica</option>
          <option value="Escrita">Escrita</option>
          <option value="E-mail">E-mail</option>
          <option value="De forma directa ">De forma directa </option>
          <option value="Buzon">Buzon</option>
          <option value="Web">Web</option>
				</select>
			</article>
      <article class="col-xs-2">
				<label for="">Tipo cliente:</label>
				<select class="form-control" name="tipo_cliente" required="">
				  <option value=""></option>
          <option value="Usuario">Usuario</option>
          <option value="EPS">EPS</option>
          <option value="Cliente interno">Cliente interno</option>
          <option value="Proveedor">Proveedor</option>
          <option value="Prepagada">Prepagada</option>
          <option value="Acudiente">Acudiente</option>
          <option value="EPSS">EPSS</option>
				</select>
			</article>
		</section>
    <section class="panel-body">
      <article class="col-xs-3">
        <label for="">Fecha Radicado:</label>
        <input type="date" name="fradicado" value="<?php echo date('Y-m-d'); ?>" class="form-control" <?php echo $atributo1 ?>>
      </article>
      <article class="col-xs-3">
        <label for="">Seleccione Responsable:</label>
        <select name="resp_respuesta" class="form-control"  <?php echo atributo3; ?>>
          <option value=""></option>
          <?php
          $sql="SELECT id_perfil,nombre_perfil from perfil where id_perfil in (47,51,52,53,54) ";
          if($tabla=$bd1->sub_tuplas($sql)){
            foreach ($tabla as $fila2) {
              if ($fila["id_perfil"]==$fila2["id_perfil"]){
                $sw=' selected="selected"';
              }else{
                $sw="";
              }
            echo '<option value="'.$fila2["id_perfil"].'"'.$sw.'>'.$fila2["nombre_perfil"].'</option>';
            }
          }
          ?>
        </select>
      </article>
      <article class="col-xs-9">
        <label for="">Descripcion de PQRS</label>
        <textarea name="descripcion_pqr" class="form-control" rows="4"></textarea>
      </article>
      <article class="col-xs-3">
  			<label>Soporte PQRS:</label>
  			Archivo: <?php echo $fila["soporte_pqr"];?><br>
  			<input type="file" class="form-control" name="soporte_pqr" <?php echo $atributo3; ?>/>
  		</article>
    </section>
	<div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
