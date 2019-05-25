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
<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Buscar&opcion=169';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
 	 <section class="panel-heading">
 	 	<h2><?php echo $subtitulo; ?></h2>
 	 </section>
   <section class="panel-body">
     <section class="col-xs-7">
       <article class="col-xs-12">
         <label for="">Paciente:</label>
         <h3><?php echo $fila['nom_completo']; ?></h3>
         <h4><?php echo $fila['tdoc_pac'].': '.$fila['doc_pac']; ?></h4>
         <h4><?php echo '<strong>Dirección: </strong>'.$fila['dir_pac']; ?></h4>
         <h4><?php echo '<strong>Teléfono: </strong>'.$fila['tel_pac']; ?></h4>
         <h4><?php echo '<strong>RH: </strong>'.$fila['rh']; ?></h4>
       </article>
     </section>
     <section class="col-xs-5">
       <article class="col-xs-12">
         <label for="">Seleccione EPS:</label>
         <select name="id_eps" class="form-control" required="" <?php echo atributo3; ?>>
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

       <article class="col-xs-12">
         <label for="">Seleccione SEDE:</label>
         <select name="id_sedes_ips" class="form-control" required="" <?php echo atributo3; ?>>
           <option value=""></option>
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
       <article class="col-xs-12">
 		  	<label for="">Seleccione Convenio:</label>
 				<select name="convenio" class="form-control" required="" <?php echo atributo3; ?>>
          <option value=""></option>
 					<?php
 					$sql="SELECT id_convenios,nom_convenio from convenios ORDER BY id_convenios ASC";
 					if($tabla=$bd1->sub_tuplas($sql)){
 						foreach ($tabla as $fila2) {
 							if ($fila["id_convenios"]==$fila2["id_convenios"]){
 								$sw=' selected="selected"';
 							}else{
 								$sw="";
 							}
 						echo '<option value="'.$fila2["id_convenios"].'"'.$sw.'>'.$fila2["nom_convenio"].'</option>';
 						}
 					}
 					?>
 			</select>
      <input type="hidden" name="id_adm_hosp" value="<?php echo $fila['id_adm_hosp'];?>">
 		  </article>
      <article class="col-xs-4">
        <label for="">Tipo Servicio:</label>
        <select name="tipo_servicio" class="form-control" <?php echo atributo3; ?>>
          <option value="<?php echo $fila['tipo_servicio']?>"><?php echo $fila['tipo_servicio']?></option>
          <?php
          $sql="SELECT id_serv,nomserv from tipo_servicio ORDER BY id_serv ASC";
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
      <article class="col-xs-8 alert alert-info">
        <span class="fa fa-warning animated shake"> Recuerde que esta casilla se refiere al servicio al cual será admisionado el paciente.</span>
      </article>
     </section>
   </section>
   <section class="panel-body">
     <article class="col-xs-2">
       <label for="">Fecha Ingreso:</label>
       <input type="date" name="fingreso_hosp" class="form-control" value="<?php echo $fila['fingreso_hosp'];?>"<?php echo $atributo2;?>/>
     </article>
     <article class="col-xs-2">
       <label for="">Hora Ingreso:</label>
       <input type="time" name="hingreso_hosp" class="form-control" value="<?php echo $fila['hingreso_hosp'];?>"<?php echo $atributo2;?>/>
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
     <article class="col-xs-2">
       <label for="">Nivel / CATEGORIA:</label>
       <select class="form-control" name="nivel" required="">
         <option value="<?php echo $fila['nivel']?>"><?php echo $fila['nivel']?></option>
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
       <select name="via_ingreso" class="form-control" <?php echo atributo3; ?>>
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
   </section>

   <section class="panel-body">
     <article class="col-xs-2">
       <label for="">Fecha Egreso:</label>
       <input type="date" name="fegreso_hosp" class="form-control" value="<?php echo $fila['fegreso_hosp'];?>" <?php echo $atributo2;?>/>
     </article>
     <article class="col-xs-2">
       <label for="">Hora Egreso:</label>
       <input type="time" name="hegreso_hosp" class="form-control" value="<?php echo $fila['hegreso_hosp'];?>" <?php echo $atributo2;?>/>
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
