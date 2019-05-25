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
<form action="<?php echo PROGRAMA.'?opcion='.$return;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-body">
      <article class="col-xs-2">
  	  	<label for="">Tipo documento:</label>
  	  	<select name="tdocpac" class="form-control" <?php echo atributo3; ?>>
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
      <article class="col-xs-2">
  	  	<label for="">Documento::</label>
  	  	<input type="text" value="<?php echo $fila['doc_pac'];?>" name="docpac" class="form-control"<?php echo $atributo2;?>/>
  	  </article>
      <article class="col-xs-2">
  	  	<label for="">Primer Nombre:</label>
  	  	<input type="text" value="<?php echo $fila["nom1"];?>" name="nom1" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  value="<?php echo $fila["num_interno"];?>"<?php echo $atributo2;?>/>
  	  </article>
  	  <article class="col-xs-2">
  	  	<label for="">Segundo Nombre:</label>
  	  	<input type="text" value="<?php echo $fila["nom2"];?>" name="nom2"  class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $fila["modelo"];?>"<?php echo $atributo2;?>/>
  	  </article>
  	  <article class="col-xs-2">
  	  	<label for="">Primer Apellido:</label>
  	  	<input type="text" value="<?php echo $fila["ape1"];?>" name="ape1"  class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $fila["capacidad_pasajeros"];?>"<?php echo $atributo2;?>/>
  	  </article>
  	  <article class="col-xs-2">
  	  	<label for="">Segundo Apellido:</label>
  	  	<input type="text" value="<?php echo $fila["ape2"];?>" name="ape2" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  value="<?php echo $fila["num_interno"];?>"<?php echo $atributo2;?>/>
  	  </article>
    </section>
    <section class="panle-body">
      <article class="col-xs-3">
  	  	<label for="">Dirección Paciente:</label>
  	  	<input type="text" name="dirpac"  class="form-control" value="<?php echo $fila["dir_pac"];?>"<?php echo $atributo2;?>/>
  	  </article>
      <article class="col-xs-3">
        <label for="">Seleccione barrio de ubicación:</label>
        <input type="text" class="form-control" name="search" id="codigo" value="">
        <input type="hidden" name="zonificacion" id="id_producto">
      </article>
      <article class="col-xs-3">
        <label for="">Barrio seleccionado:</label>
        <input type="text" class="form-control" name="nom_barrio" id="descripcion" value="" <?php echo $atributo1;?>>
      </article>

    </section>
  </section>
  <div class="row text-center">
    <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
    <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
    <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
  </div>
</form>
