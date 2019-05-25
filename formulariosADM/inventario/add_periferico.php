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
				<input type="hidden" name="id_equipo" value="<?php echo $_GET["id"] ?>">
					<section class="row">
						<article class="col-md-3">
						<label class="text-center">Categoria: <strong class="text-danger">*</strong> </label><br>
						<select class="form-control" name="categoria_periferico">
							<option value="Teclado">Teclado</option>
							<option value="Mouse">Mouse</option>
							<option value="Monitor">Monitor</option>
							<option value="Base refigerante">Base refigerante</option>
							<option value="Diadema de audio">Diadema de audio</option>
						</select>
					 </article>
 						<article class="col-md-2">
 							<label class="text-center">activo fijo: <strong class="text-danger">*</strong> </label><br>
 							<input type="text" id=username class="form-control text-center" required name="activo_fijo" value="<?php echo $fila["activo_fijo"];?>"<?php echo $atributo2;?>/>
							<div id="Info"></div>
 						</article>
					 <article class="col-md-2">
					 <label class="text-center">Estado Equipo: <strong class="text-danger">*</strong> </label><br>
					 <select class="form-control" name="estado_periferico">
						 <option value="1"></option>
						 <option value="1">Activo</option>
						 <option value="2">Inactivo</option>
					 </select>
					</article>
				 </section><br>
						<section class="row">
						</section>
						<section class="row">
							<article class="col-md-3">
							 <label class="text-center">Marca: <strong class="text-danger">*</strong> </label><br>
							 <input type="text" class="form-control text-center" required name="marca_periferico" value="<?php echo $fila["marca_periferico"];?>"<?php echo $atributo2;?>/>
							</article>
		            <article class="col-md-3">
		              <label class="text-center">Modelo: <strong class="text-danger">*</strong> </label><br>
		              <input type="text" class="form-control text-center" required name="modelo_periferico" value="<?php echo $fila["modelo_periferico"];?>"<?php echo $atributo2;?>/>
		            </article>
		            <article class="col-md-3">
		              <label class="text-center">serial: <strong class="text-danger">*</strong> </label><br>
		              <input type="text" class="form-control text-center" required name="serial_periferico" value="<?php echo $fila["serial_periferico"];?>"<?php echo $atributo2;?>/>
		            </article>
		        </section><br>
						<section class="row">
							<article class=" col-md-6">
	              <label class="text-center">Observaciones<strong class="text-danger">*</strong></label><br>
	              <input type="text" class="form-control text-center" required name="observaciones" value="<?php echo $fila["observaciones"];?>"<?php echo $atributo2;?>/>
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
