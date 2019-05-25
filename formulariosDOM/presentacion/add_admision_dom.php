<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
          $("#codigo").autocomplete({
              source: "admision/bus_eps.php",
              minLength: 4,
              select: function(event, ui) {
        event.preventDefault();
                  $('#codigo').val(ui.item.codigo);
        $('#descripcion').val(ui.item.descripcion);

         }
          });
          $("#id").autocomplete({
              source: "admision/bus_sede.php",
              minLength: 4,
              select: function(event, ui) {
        event.preventDefault();
                  $('#id').val(ui.item.id);
        $('#sede').val(ui.item.sede);

         }
          });
  });
</script>
<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Buscar&opcion='.$opcion;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
 	 <section class="panel-heading">
 	 	<h2><?php echo $subtitulo; ?></h2>
 	 </section>
   <section class="panel-body">
     <section class="col-xs-4">
       <article class="col-xs-12">
         <label for="">Paciente:</label>
         <h3><?php echo $fila['nom_completo']; ?></h3>
         <h4><?php echo $fila['tdoc_pac'].': '.$fila['doc_pac']; ?></h4>
         <h4><?php echo '<strong>Dirección: </strong>'.$fila['dir_pac']; ?></h4>
         <h4><?php echo '<strong>Teléfono: </strong>'.$fila['tel_pac']; ?></h4>
         <h4><?php echo '<strong>RH: </strong>'.$fila['rh']; ?></h4>
       </article>
     </section>
     <section class="col-xs-8">
       <article class="col-xs-4">
         <label for="">Seleccione EPS:</label>
         <input type="text" required="" class="form-control" name="id_eps" id="codigo"  required=""value="">
         <input type="hidden" required="" class="form-control" name="id_paciente"  required="" value="<?php echo $fila['id_paciente']?>">
       </article>
       <article class="col-xs-8">
         <label for="">EPS seleccionada:</label>
         <input type="text" required="" class="form-control" name="eps" id="descripcion"  required=""value="" <?php echo $atributo1;?>>
       </article>
       <article class="col-xs-4">
         <label for="">Seleccione SEDE:</label>
         <select name="id_sedes_ips" class="form-control" required="" >
           <option value=""></option>
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
     </section>
   </section>
   <section class="panel-body">
     <article class="col-xs-3">
       <label for="">Fecha Ingreso:</label>
       <input type="date" name="fingreso_hosp" class="form-control" value="<?php echo date('Y-m-d');?>"<?php echo $atributo1;?>/>
     </article>
     <article class="col-xs-2">
       <label for="">Hora Ingreso:</label>
       <input type="time" name="hingreso_hosp" class="form-control" value="<?php echo date('H:m:s');?>"<?php echo $atributo1;?>/>
     </article>
     <article class="col-xs-3">
       <label for="">Tipo Usuario:</label>
       <select name="tipo_usuario" class="form-control" required="" <?php echo atributo3; ?>>
         <option value=""></option>
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
     <article class="col-xs-3">
       <label for="">Tipo Afiliación:</label>
       <select name="tipo_afiliacion" class="form-control" required="" <?php echo atributo3; ?>>
         <option value=""></option>
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
     <article class=" col-xs-3">
       <label for="">Seleccione Departamento:</label>
       <select name="dep_residencia" class="form-control" id="dep" onchange="mostrardep()" <?php echo $atributo2;?>>
         <option value="0"></option>
         <?php
           $sql_pais = "SELECT * FROM departamento";
           $resultado = $conex->query($sql_pais);
           if($conex->errno) die($conex->error);
           while ($fila = $resultado ->fetch_assoc()){
         ?>
           <option value="<?php echo $fila['coddep'] ?>"><?php echo $fila['descripdep']; ?></option>
         <?php
           }
         ?>
       </select>
     </article>
     <article class="col-xs-3">
       <label for="">Seleccione Municipio:</label>
       <select id="municipio" class="form-control" name="mun_residencia">
           <option value="0">Elige una opción...</option>
       </select>
     </article>
     <article class="col-xs-6">
       <label for="">Ocupación:</label>
       <select name="ocupacion" class="form-control" <?php echo atributo3; ?>>
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
       <select name="zona_residencia" class="form-control" <?php echo atributo3; ?>>
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
   </section>
   <div class="row text-center">
  	 <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />

  	 <input type="submit" class="btn btn-danger" name="aceptar" Value="Descartar"/>
  	 <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
  	 <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
   </div>
  </section>
</form>
