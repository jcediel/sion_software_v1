<div class="botonhc"id="th-estilo1">
    <a data-toggle="collapse" class="ac" data-target="#datpac" >Datos de la bodega</a> <span class="glyphicon glyphicon-arrow-down"></span>
</div>
  <section class="collapse" id="datpac">
    <section class="panel-body"><!--section de eps-->
      <article class="col-xs-4 text-center">
        <label for="">Nombre Bodega:</label>
        <input type="text" name="nompac" class="form-control text-center" value="<?php echo $fila["nom_bodega"];?>" <?php echo $atributo3;?>/>
      </article>
      <article class="col-xs-3">
        <label for="">Tipo bodega:</label>
        <input type="text" name="identificacion" class="form-control text-center" value="<?php echo $fila["tipo_bodega"];?>"<?php echo $atributo3;?>/>
      </article>
      <article class="col-xs-7">
        <label for="">Sede a la que pertenece la bodega:</label>
        <input type="text" name="edad" class="form-control text-center" value="<?php echo $fila["nom_sedes"];?>"<?php echo $atributo3;?>/>
      </article>
    </section>
  </section>
