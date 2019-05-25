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
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].f_correo.value > document.forms[0].hoyF.value){
					alert("No no no, usted no puede adelantar fechas");
					document.forms[0].f_correo.focus();				// Ubicar el cursor
					return(false);
				}
        if (document.forms[0].h_correo.value > document.forms[0].hoyH.value){
					alert("No no no, usted no puede adelantar el tiempo");
					document.forms[0].h_correo.focus();				// Ubicar el cursor
					return(false);
				}
			}
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
         <h3><?php echo $fila['nom1'].' '.$fila['nom2'].' '.$fila['ape1'].' '.$fila['ape2']; ?></h3>
         <h4><?php echo $fila['tdoc_pac'].': '.$fila['doc_pac']; ?></h4>
         <h4><?php echo '<strong>Dirección: </strong>'.$fila['dir_pac']; ?></h4>
         <h4><?php echo '<strong>Teléfono: </strong>'.$fila['tel_pac']; ?></h4>
         <h4><?php echo '<strong>Genero: </strong>'.$fila['genero']; ?></h4>
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
       <article class="col-xs-12">
         <label for="">Asignar medico:</label>
         <select name="medico_asignado" class="form-control" required="" <?php echo atributo3; ?>>
           <option value=""></option>
           <?php
           $sql="SELECT id_user,nombre,especialidad FROM user WHERE id_perfil in (3,1,4) and estado = 'Activo' ORDER BY especialidad ASC";
           if($tabla=$bd1->sub_tuplas($sql)){
             foreach ($tabla as $fila2) {
               if ($fila["id_user"]==$fila2["id_user"]){
                 $sw=' selected="selected"';
               }else{
                 $sw="";
               }
             echo '<option value="'.$fila2["id_user"].'"'.$sw.'>'.$fila2["nombre"].'--'.$fila2["especialidad"].'</option>';
             }
           }
           ?>
       </select>
       </article>
     </section>
   </section>
   <section class="panel-body">
     <article class="col-xs-3">
       <label for="">Fecha Mail:</label>
       <input type="hidden" name="hoyF" value="<?php echo date('Y-m-d')?>">
       <input type="date" name="f_correo" class="form-control" value="<?php echo date('Y-m-d');?>"<?php echo $atributo2;?>/>
     </article>
     <article class="col-xs-2">
       <label for="">Hora Mail:</label>
       <input type="hidden" name="hoyH" value="<?php echo date('H:i')?>">
       <input type="time" name="h_correo" class="form-control" value="<?php echo date('H:i');?>"<?php echo $atributo2;?>/>
     </article>
     <article class="col-xs-12">
       <label for="">Solicitud:</label>
       <textarea required name="cuerpo_referencia" class="form-control" rows="5"></textarea>
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
