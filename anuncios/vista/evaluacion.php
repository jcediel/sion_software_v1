
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].vencimiento_cuestionario.value < document.forms[0].hoy.value){
          alert("LA FECHA NO PUEDE SER MENOR A LA FECHA ACTUAL");
					document.forms[0].vencimiento_cuestionario.focus();				// Ubicar el cursor
					return(false);
				}

			}
		</script>
		<form action="<?php echo PROGRAMA.'?opcion=196';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
			<section class="panel panel-default">
				<section class="panel-heading">
					<h3><?php echo $subtitulo.'<i>'.$_GET['titu'].'</i>'; ?></h3>
				</section>
				<section class="panel-body">
					<section class="panel-body">
						<section class="col-md-12">
							<label for="">Redacte pregunta 1:</label>
							<input type="text" class="form-control" name="pregunta1" required value="">
							<input type="hidden" class="form-control" name="id_anuncio" required value="<?php echo $_GET['ida'] ?>">
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 1.1:</label>
								<input type="text" class="form-control" name="rta11" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado11">
					        <option value="0">NO</option>
					        <option value="1">SI</option>
					      </select>
							</article>
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 1.2:</label>
								<input type="text" class="form-control" name="rta12" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado12">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 1.3:</label>
								<input type="text" class="form-control" name="rta13" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado13">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 1.4:</label>
								<input type="text" class="form-control" name="rta14" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado14">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
					</section>
					<section class="panel-body">
						<section class="col-md-12">
							<label for="">Redacte pregunta 2:</label>
							<input type="text" class="form-control" name="pregunta2" required value="">
							<input type="hidden" class="form-control" name="id_anuncio" required value="<?php echo $_GET['ida'] ?>">
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 2.1:</label>
								<input type="text" class="form-control" name="rta21" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado21">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 2.2:</label>
								<input type="text" class="form-control" name="rta22" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado22">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 2.3:</label>
								<input type="text" class="form-control" name="rta23" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado23">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 2.4:</label>
								<input type="text" class="form-control" name="rta24" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado24">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
					</section>
					<section class="panel-body">
						<section class="col-md-12">
							<label for="">Redacte pregunta 3:</label>
							<input type="text" class="form-control" name="pregunta3" required value="">
							<input type="hidden" class="form-control" name="id_anuncio" required value="<?php echo $_GET['ida'] ?>">
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 3.1:</label>
								<input type="text" class="form-control" name="rta31" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado31">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 3.2:</label>
								<input type="text" class="form-control" name="rta32" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado32">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 3.3:</label>
								<input type="text" class="form-control" name="rta33" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado33">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 3.4:</label>
								<input type="text" class="form-control" name="rta34" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado34">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
					</section>
					<section class="panel-body">
						<section class="col-md-12">
							<label for="">Redacte pregunta 4:</label>
							<input type="text" class="form-control" name="pregunta4" required value="">
							<input type="hidden" class="form-control" name="id_anuncio" required value="<?php echo $_GET['ida'] ?>">
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 4.1:</label>
								<input type="text" class="form-control" name="rta41" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado41">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 4.2:</label>
								<input type="text" class="form-control" name="rta42" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado42">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 4.3:</label>
								<input type="text" class="form-control" name="rta43" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado43">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 4.4:</label>
								<input type="text" class="form-control" name="rta44" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado44">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
					</section>
					<section class="panel-body">
						<section class="col-md-12">
							<label for="">Redacte pregunta 5:</label>
							<input type="text" class="form-control" name="pregunta5" required value="">
							<input type="hidden" class="form-control" name="id_anuncio" required value="<?php echo $_GET['ida'] ?>">
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 5.1:</label>
								<input type="text" class="form-control" name="rta51" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado51">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 3.2:</label>
								<input type="text" class="form-control" name="rta52" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado52">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 4.3:</label>
								<input type="text" class="form-control" name="rta53" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado53">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
						<section class="col-md-6">
							<article class="col-md-6">
								<label for="">Redacte respuesta 5.4:</label>
								<input type="text" class="form-control" name="rta54" value="">
							</article>
							<article class="col-md-6">
								<label for="">Estado evaluativo:</label>
								<select class="form-control" name="estado54">
									<option value="0">NO</option>
									<option value="1">SI</option>
								</select>
							</article>
						</section>
					</section>
          <section class="panel-body">
              <article class="col-md-12 alert alert-danger">
                <label for="">Tiempo limite para contestar el cuestionario:</label>
                <input type="date" class="form-control" name="vencimiento_cuestionario" required value="">
                <input type="hidden" class="form-control" name="hoy" required value="<?php echo date('Y-m-d') ?>">
              </article>
          </section>

					<div class="row panel-body">
							<input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
							<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
							<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
					</div>
				</section>
			</section>
		</form>
