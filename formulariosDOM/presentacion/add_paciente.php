<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
          $("#codigo").autocomplete({
              source: "formulariosDOM/bus_barrio.php",
              minLength: 1,
              select: function(event, ui) {
        event.preventDefault();
                  $('#codigo').val(ui.item.codigo);
        $('#descripcion').val(ui.item.descripcion);
        $('#precio').val(ui.item.precio);
        $('#id_producto').val(ui.item.id_producto);
         }
          });
  });
</script>
<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion='.$opcion.'';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading">
      <h2><?php echo $subtitulo ?></h2>
    </section>
      <section class="panel-body">
        <article class="col-xs-1">
         <label for="">ID:</label>
         <input type="text"  name="idpaci" class="form-control" value="<?php echo $fila["id_paciente"];?>"<?php echo $atributo1;?>/>
       </article>
       <article class="col-xs-3">
         <label for="">Tipo documento:</label>
         <select name="tdocpac" class="form-control" <?php echo atributo3; ?> required="">
           <option value="<?php echo $fila['tdoc_pac']; ?>"><?php echo $fila['tdoc_pac']; ?></option>
           <?php
           $sql="SELECT tipo,descri_tipo from tdocumentos ORDER BY tipo DESC";
           if($tabla=$bd1->sub_tuplas($sql)){
             foreach ($tabla as $fila2) {
               if ($fila["tipo"]==$fila2["tipo"]){
                 $sw=' selected="selected"';
               }else{
                 $sw="";
               }
             echo '<option value="'.$fila2["tipo"].'"'.$sw.'>'.$fila2["descri_tipo"].'</option>';
             }
           }
           ?>
       </select>
       </article>
       <article class="col-xs-5">
         <label for="">Identificación Paciente:<span class="fa fa-info-circle" data-toggle="popover" title="Digite el número de identificación sin puntos" data-content=""></span></label>
         <input type="text" name="docpac" value="<?php echo $_REQUEST['docc']?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" value="<?php echo $fila["doc_pac"];?>"<?php echo $atributo2;?> required=""/>
       </article>
      </section>
      <section class="panel-body">
        <article class="col-xs-2">
          <label for="">Primer Nombre:</label>
          <input type="text" value="<?php echo $fila["nom1"];?>" name="nom1" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required=""  value="<?php echo $fila["num_interno"];?>"<?php echo $atributo2;?>/>
        </article>
        <article class="col-xs-2">
          <label for="">Segundo Nombre:</label>
          <input type="text" value="<?php echo $fila["nom2"];?>" name="nom2"  class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  value="<?php echo $fila["modelo"];?>"<?php echo $atributo2;?>/>
        </article>
        <article class="col-xs-2">
          <label for="">Primer Apellido:</label>
          <input type="text" value="<?php echo $fila["ape1"];?>" name="ape1"  class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required="" value="<?php echo $fila["capacidad_pasajeros"];?>"<?php echo $atributo2;?>/>
        </article>
        <article class="col-xs-2">
          <label for="">Segundo Apellido:</label>
          <input type="text" value="<?php echo $fila["ape2"];?>" name="ape2" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"   value="<?php echo $fila["num_interno"];?>"<?php echo $atributo2;?>/>
        </article>
        <article class="col-xs-3">
   			 <label for="">Dirección Paciente:</label>
   			 <input type="text" name="dirpac"  class="form-control" value="<?php echo $fila["dir_pac"];?>"<?php echo $atributo2;?> required=""/>
   		  </article>
      </section>
      <section class="panel-body">
   		 <article class="col-xs-3">
   			 <label for="">Teléfono Paciente:</label>
   			 <input type="text" name="telpac"  class="form-control" value="<?php echo $fila["tel_pac"];?>"<?php echo $atributo2;?> required=""/>
   		 </article>
       <article class="col-xs-3">
          <label for="">Email Paciente:</label>
          <input type="email" name="email"  class="form-control" value="<?php echo $fila["email_pac"];?>"<?php echo $atributo2;?>/>
        </article>
       <article class="col-xs-2">
   			<label for="">Genero:</label>
   			<select name="genero" value="<?php echo $fila["genero"];?>" class="form-control" <?php echo atributo3; ?> required="">
  				<option value="<?php echo $fila['genero']; ?>"><?php echo $fila['genero']; ?></option>
   				<?php
   				$sql="SELECT codsexo,descrisexo from sexo ORDER BY descrisexo ASC";
   				if($tabla=$bd1->sub_tuplas($sql)){
   					foreach ($tabla as $fila2) {
   						if ($fila["descrisexo"]==$fila2["descrisexo"]){
   							$sw=' selected="selected"';
   						}else{
   							$sw="";
   						}
   					echo '<option value="'.$fila2["descrisexo"].'"'.$sw.'>'.$fila2["descrisexo"].'</option>';
   					}
   				}
   				?>
   			</select>
   		</article>
      <article class="col-xs-3">
       <label for="">Fecha Nacimiento:</label>
       <input type="date" class="form-control" required name="fnacimiento" value="<?php echo $fila["fnacimiento"];?>">
     </article>
     <article class="col-xs-3">
      <label for="">Latitud:</label>
      <input type="text" class="form-control"  name="lat" value="<?php echo $fila['lat'] ?>">
    </article>
    <article class="col-xs-3">
     <label for="">Longitud:</label>
     <input type="text" class="form-control"  name="lo" value="<?php echo $fila['lo'] ?>">
   </article>
      </section>
      <div class="row text-center">
  		  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
  			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
  			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
  		</div>

  </section>
</form>
