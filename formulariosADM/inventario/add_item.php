<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#username').blur(function(){

        $('#Info').html('<span class="fa fa-spinner	fa-spin"></span>').fadeOut(1000);

        var username = $(this).val();
        var dataString = 'username='+username;

        $.ajax({
            type: "POST",
            url: "formulariosADM/inventario/comprobar_af.php",
            data: dataString,
            success: function(data) {
                $('#Info').fadeIn(1000).html(data);
            }
        });
    });
});
</script>
	<section class="panel panel-default">
		<section class="panel-heading">
			<h2><?php echo $subtitulo ?></h2>
		</section>
		<section class="panel-body">
      <form action="<?php echo PROGRAMA.'?opcion=201';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
          <section class="panel-body">
            <section class="col-md-8">
              <article class="col-md-3">
                <label class="text-center">Dependencia: <strong class="text-danger">*</strong></label><br>
                <select name="tdependencia" class="form-control" <?php echo atributo3; ?>>
                  <option value="<?php echo $fila["tdependencia"];?>"><?php echo $fila["tdependencia"];?></option>
                  <?php
                  $sql="SELECT id_dependencia, nombre_dependencia from dependencia ORDER BY nombre_dependencia ASC";
                  if($tabla=$bd1->sub_tuplas($sql)){
                    foreach ($tabla as $fila2) {
                      if ($fila["id_dependencia"]==$fila2["id_dependencia"]){
                        $sw=' selected="selected"';
                      }else{
                        $sw="";
                      }
                    echo '<option value="'.$fila2["id_dependencia"].'"'.$sw.'>'.$fila2["nombre_dependencia"].'</option>';
                    }
                  }
                  ?>
                </select>
              </article>
              <article class="col-md-3">
                <label class="text-center">Categoria: <strong class="text-danger">*</strong> </label>
                <select class="form-control" name="categoria_equipo">
                  <option value=""></option>
                  <option value="1">Equipos de computo</option>
                  <option value="2">Equipos biomedicos</option>
                  <option value="3">Equi po de redes</option>
                  <option value="4">Impresoras</option>
                  <option value="5">CCTV</option>
                  <option value="6">Telefonia</option>
                  <option value="7">Muebles</option>
                </select>
              </article>
              <article class="col-md-2">
                <label class="text-center">activo fijo: <strong class="text-danger">*</strong> </label><br>
                <input type="text" id="username" class="form-control text-center" required name="activo_fijo" value="<?php echo $fila["activo_fijo"];?>"<?php echo $atributo2;?>/>
                <div id="Info"></div>
              </article>
            </section>
            <section class="col-md-4">

            </section>
          </section>
          <section class="panel-body">
            <article class="col-md-2">
              <label class="text-center">No. Factura: <strong class="text-danger">*</strong> </label><br>
              <input type="text" class="form-control text-center" required name="numero_factura" value="<?php echo $fila["numero_factura"];?>"<?php echo $atributo2;?>/>
            </article>
            <article class="col-md-2">
              <label class="text-center">Estado Equipo: <strong class="text-danger">*</strong> </label><br>
              <select class="form-control" name="estado_equipo">
                <option value="1"></option>
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
              </select>
            </article>
            <article class="col-md-3">
              <label class="text-center">Fecha de compra: <strong class="text-danger">*</strong> </label><br>
              <input type="date" class="form-control text-center" required name="freg_compra" value="<?php echo $fila["freg_compra"];?>"<?php echo $atributo2;?>/>
            </article>
          </section>
            <section class="panel-body">
              <article class="col-md-3">
               <label class="text-center">Marca: <strong class="text-danger">*</strong> </label><br>
               <input type="text" class="form-control text-center" required name="marca_equipo" value="<?php echo $fila["marca_equipo"];?>"<?php echo $atributo2;?>/>
              </article>
                <article class="col-md-3">
                  <label class="text-center">Modelo: <strong class="text-danger">*</strong> </label><br>
                  <input type="text" class="form-control text-center" required name="modelo_equipo" value="<?php echo $fila["modelo_equipo"];?>"<?php echo $atributo2;?>/>
                </article>
                <article class="col-md-3">
                  <label class="text-center">serial: <strong class="text-danger">*</strong> </label><br>
                  <input type="text" class="form-control text-center" required name="serial_equipo" value="<?php echo $fila["serial_equipo"];?>"<?php echo $atributo2;?>/>
                </article>
            </section>
          </section>
          <div class="panel-body text-center">
            <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
            <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
            <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
          </div>
        </form>
		</section>
	</section>
