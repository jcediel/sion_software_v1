<form action="<?php echo PROGRAMA.'?opcion='.$return;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">

  <section class="panel-body">
    <article class="col-xs-2">
      <label for="">ID:</label>
      <input type="text" class="form-control" name="idpaci" value="<?php echo $_REQUEST['idpac'];?>">
      <input type="text" class="form-control" name="ideps" value="<?php echo $_REQUEST['ideps'];?>">
    </article>
    <article class="col-xs-4">
      <label for="">Seleccione Sedes:</label>
      <select name="sedes" class="form-control" <?php echo atributo3; ?>>
        <?php
        $sql="SELECT id_sedes_ips,nom_sedes from sedes_ips where id_sedes_ips in (9,10) ORDER BY id_sedes_ips ASC";
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
    <article class="col-xs-2">
      <label for="">Fecha Ingreso:</label>
      <input type="date" name="fingreso" class="form-control" value="<?php echo date('Y-m-d');?>"<?php echo $atributo1;?>/>
    </article>
    <article class="col-xs-2">
      <label for="">Hora Ingreso:</label>
      <input type="time" name="hingreso" class="form-control" value="<?php echo date('H:s');?>"<?php echo $atributo1;?>/>
    </article>
    <article class="col-xs-3">
      <label for="">Tipo Usuario:</label>
      <select name="tusuario" class="form-control" <?php echo atributo3; ?>>
        <option values=""></option>
        <option values="Pendiente">Pendiente diligenciamiento</option>
        <?php
        $sql="SELECT codtusuario,descritusuario from tusuario ORDER BY codtusuario ASC";
        if($tabla=$bd1->sub_tuplas($sql)){
          foreach ($tabla as $fila2) {
            if ($fila["codtusuario"]==$fila2["codtusuario"]){
              $sw=' selected="selected"';
            }else{
              $sw="";
            }
          echo '<option value="'.$fila2["codtusuario"].'"'.$sw.'>'.$fila2["descritusuario"].'</option>';
          }
        }
        ?>
      </select>
    </article>
    <article class="col-xs-6">
      <label for="">Ocupación:</label>
      <select name="ocupacion" class="form-control" <?php echo atributo3; ?>>
        <option values=""></option>
        <option values="Pendiente">Pendiente diligenciamiento</option>
        <?php
        $sql="SELECT codocu,descriocu from ocupacion ORDER BY codocu DESC";
        if($tabla=$bd1->sub_tuplas($sql)){
          foreach ($tabla as $fila2) {
            if ($fila["codocu"]==$fila2["codocu"]){
              $sw=' selected="selected"';
            }else{
              $sw="";
            }
          echo '<option value="'.$fila2["codocu"].'"'.$sw.'>'.$fila2["descriocu"].'</option>';
          }
        }
        ?>
    </select>
    </article>
    <article class="col-xs-3">
      <label for="">Zona Residencia:</label>
      <select name="zona" class="form-control" <?php echo atributo3; ?>>
        <?php
        $sql="SELECT codzona,zona from zona ORDER BY codzona DESC";
        if($tabla=$bd1->sub_tuplas($sql)){
          foreach ($tabla as $fila2) {
            if ($fila["codzona"]==$fila2["codzona"]){
              $sw=' selected="selected"';
            }else{
              $sw="";
            }
          echo '<option value="'.$fila2["codzona"].'"'.$sw.'>'.$fila2["zona"].'</option>';
          }
        }
        ?>
    </select>
    </article>
    <article class="col-xs-3">
      <label for="">Tipo Afiliación:</label>
      <select name="tafiliacion" class="form-control" <?php echo atributo3; ?>>
        <option values=""></option>
        <option values="Pendiente">Pendiente diligenciamiento</option>
        <?php
        $sql="SELECT codafiliado,descriafiliado from tafiliado ORDER BY codafiliado DESC";
        if($tabla=$bd1->sub_tuplas($sql)){
          foreach ($tabla as $fila2) {
            if ($fila["codafiliado"]==$fila2["codafiliado"]){
              $sw=' selected="selected"';
            }else{
              $sw="";
            }
          echo '<option value="'.$fila2["codafiliado"].'"'.$sw.'>'.$fila2["descriafiliado"].'</option>';
          }
        }
        ?>
    </select>
    </article>
    <article class="col-xs-2">
      <label for="">Nivel / CATEGORIA:</label>
      <select class="form-control" name="nivel">
        <option values=""></option>
        <option values="Pendiente">Pendiente diligenciamiento</option>
        <option value="A"> A</option>
        <option value="B"> B</option>
        <option value="C"> C</option>
        <option value="Nivel 1"> Nivel 1</option>
        <option value="Nivel 2"> Nivel 2</option>
        <option value="Nivel 3"> Nivel 3</option>
        <option value="Nivel 4"> Nivel 4</option>
        <option value="Nivel 5"> Nivel 5</option>
        <option value="Nivel 6"> Nivel 6</option>
      </select>
    </article>

    <article class="col-xs-3">
      <label for="">Vía Ingreso:</label>
      <select name="viaingreso" class="form-control" <?php echo atributo3; ?>>
        <?php
        $sql="SELECT codvia,descrivia from viaingreso ORDER BY codvia DESC";
        if($tabla=$bd1->sub_tuplas($sql)){
          foreach ($tabla as $fila2) {
            if ($fila["codvia"]==$fila2["codvia"]){
              $sw=' selected="selected"';
            }else{
              $sw="";
            }
          echo '<option value="'.$fila2["codvia"].'"'.$sw.'>'.$fila2["descrivia"].'</option>';
          }
        }
        ?>
    </select>
    </article>
    <article class="col-xs-3">
      <label for="">Tipo Servicio:</label>
      <select name="tservicio" class="form-control" <?php echo atributo3; ?>>
        <?php
        $sql="SELECT id_serv,nomserv from tipo_servicio where id_serv=4 ORDER BY id_serv ASC";
        if($tabla=$bd1->sub_tuplas($sql)){
          foreach ($tabla as $fila2) {
            if ($fila["nomserv"]==$fila2["nomserv"]){
              $sw=' selected="selected"';
            }else{
              $sw="";
            }
          echo '<option value="'.$fila2["nomserv"].'"'.$sw.'>'.$fila2["nomserv"].'</option>';
          }
        }
        ?>
    </select>
    </article>
    <article class="col-xs-3">
      <input type="hidden" class="form-control" name="estadoadmhosp" value="Activo" <?php echo atributo3; ?>>
    </article>
  </section>
  <div class="col-xs-12 panel-body text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
</form>
