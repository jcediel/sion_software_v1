
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
								<textarea name="name" class="form-control text-info animated zoomIn" rows="2" cols="80" <?php echo $atributo1 ?>><?php echo $fila['descripcion'] ?></textarea>
							</article>
							<article class="col-md-6">
								<label for="">respuesta 1:</label>
								<textarea name="name" class="form-control text-info animated zoomIn" rows="2" cols="80" <?php echo $atributo1 ?>><?php echo $fila['rta_hdesk1'] ?></textarea>
							</article>
							<article class="col-md-6">
								<label for="">respuesta 2:</label>
								<textarea name="name" class="form-control text-info animated zoomIn" rows="2" cols="80" <?php echo $atributo1 ?>><?php echo $fila['rta_hdesk2'] ?></textarea>
							</article>
						</section>
				<section class="row card-body">
					<section class="col-md-12">
            <section class="row card-body">
						</section>
							<br>
						<div class="panel-body text-center">
							<input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
							<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
							<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
							<input type="hidden" class="btn btn-primary" name="id_hdesk" value="<?php echo $id ?>">
							<input type="hidden" class="btn btn-primary" name="estado_soporte" value="4">
						</div>
					</section>
				</section>
			</section>
		</form>
