
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
				<section class="panel-body">
					<article class="col-md-12">
						<label for="">Problema:</label>
						<textarea name="name" class="form-control text-info animated zoomIn" rows="3" cols="80" <?php echo $atributo1 ?>><?php echo $fila['descripcion'] ?></textarea>
					</article>
				</section>
				<section class="row card-body">
					<section class="col-md-12">
            <section class="row">
              <article class="col-md-4">
                <label class="text-center">Fecha: <strong class="text-danger">*</strong></label><br>
                <input type="text" class="form-control text-center" required name="frta1" value="<?php echo date('Y-m-d');?>"<?php echo $atributo1;?>/>
								<input type="hidden" name="id_hdesk" value="<?php echo $fila['id_hdesk'] ?>">
              </article>
              <article class="col-md-4">
                <label class="text-center">Hora:<strong class="text-danger">*</strong></label><br>
                <input type="text" class="form-control text-center" required name="hrta1" value="<?php echo date('H:i');?>"<?php echo $atributo1;?>/>
              </article>
            </section>
            <section class="row card-body">
              <article class="col-md-12">
								<label class="text-center">Respuesta: <strong class="text-danger">*</strong></label><br>
          			<textarea name="rta_hdesk1" class="form-control" rows="4" cols="80"></textarea>
              </article>
							<article class="col-md-12">
                <label class="text-center">Observación: <strong class="text-danger">*</strong></label><br>
          			<textarea name="observacion_hdesk1" class="form-control" rows="4" cols="80"></textarea>
              </article>

							<p><article class="col-md-6">
								<select class="form-control" name="estado_soporte">
										<option value="3">Resuelto</option>
										<option value="2">Pendiente</option>
									</p>
								</select>
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
