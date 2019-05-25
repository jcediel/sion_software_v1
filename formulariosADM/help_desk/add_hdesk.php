
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nombre.value == ""){
          alert("NO PODEMOS CREAR EL USUARIO SIN UN NOMBRE");
					document.forms[0].nombre.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].username.value == ""){
					alert("NO PODEMOS CREAR EL USUARIO SIN UNA CUENTA");
					document.forms[0].username.focus();				// Ubicar el cursor
					return(false);
				}

				if (document.forms[0].clave1.value == document.forms[0].clave2.value ){
					if (document.forms[0].clave1.value != ""){
						document.forms[0].clave1.value = CryptoJS.SHA3(document.forms[0].clave1.value);
						document.forms[0].clave2.value = document.forms[0].clave1.value;
					}
				}else{
					alert("Error en confirmacion de la clave!");
					document.forms[0].clave1.value = "";
					document.forms[0].clave2.value = "";
					document.forms[0].clave1.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
		<form action="<?php echo PROGRAMA.'?opcion=199';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
			<section class="card">
				<section class="card-header">
					<h3><?php echo $subtitulo; ?></h3>
				</section>
				<section class="row card-body">
					<section class="col-md-12">
            <section class="row">
              <article class="col-md-4">
                <label for="">Seleccione tipo de soporte: <strong class="text-danger">*</strong></label>
                <select class="form-control" name="tipo_soporte">
                  <option value=""></option>
                  <option value="1">SION</option>
                  <option value="2">Equipos</option>
                </select>
              </article>
              <article class="col-md-4">
                <label class="text-center">Fecha: </label><br>
                <input type="text" class="form-control text-center" required name="freg_hdesk" value="<?php echo date('Y-m-d');?>"<?php echo $atributo1;?>/>
              </article>
              <article class="col-md-4">
                <label class="text-center">Hora:<strong class="text-danger">*</strong></label><br>
                <input type="text" class="form-control text-center" required name="hreg_hdesk" value="<?php echo date('H:i');?>"<?php echo $atributo1;?>/>
              </article>
            </section>
            <section class="row card-body">
              <article class="col-md-12">
                <label class="text-center">Descripcion del problema: <strong class="text-danger">*</strong></label><br>
          			<textarea name="descripcion" class="form-control" rows="8" cols="80"></textarea>
              </article>
            </section>

							<br>
						<div class="panel-body text-center">
							<input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
							<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
							<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
						</div>
					</section>
				</section>
			</section>
		</form>
