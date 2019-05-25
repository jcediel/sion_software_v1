
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
		<form action="<?php echo PROGRAMA.'?opcion=196';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
			<section class="panel panel-default">
				<section class="panel-heading">
					<h3><?php echo $subtitulo; ?></h3>
				</section>
				<section class="row panel-body">
					<section class="col-md-12">
            <section class="row">
              <article class="col-md-12">
                <label class="text-center">Titulo del anuncio: <strong class="text-danger">*</strong></label><br>
                <input type="hidden" name="idu" value="<?php echo $fila['id_user']?>">
								<input type="hidden" name="freg" value="<?php echo date('Y-m-d')?>">
								<input type="hidden" name="hreg" value="<?php echo date('H:i')?>">
                <input type="text" class="form-control text-center" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required name="titulo" value="<?php echo $fila["titulo"];?>"<?php echo $atributo2;?>/>
              </article>
              <article class="col-md-12">
                <label for="">Descripción anuncio: <strong class="text-danger">*</strong></label>
                <textarea name="anuncio" class="form-control" rows="4"><?php echo $fila["anuncio"];?></textarea>
              </article>
              <article class="col-md-6 col-sm-12">
                <label for="">Seleccione su servicio: <strong class="text-danger">*</strong></label>
                <select class="form-control" name="servicio" required="">
                  <option value=""></option>
                  <?php
                  $sql="SELECT id_serv,nomserv from tipo_servicio  ORDER BY id_serv ASC";
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
              <article class="col-md-6 col-sm-12">
                <label for="">Que tipo de anuncio es?: <strong class="text-danger">*</strong></label>
                <select class="form-control" name="tipo_anuncio" required="">
                  <option value=""></option>
                  <option value="1">Anuncio General</option>
                  <option value="3">Capacitaciones</option>
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
