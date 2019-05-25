
		<form action="<?php echo PROGRAMA.'?opcion=1';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
			<section class="card">
				<section class="card-header">
					<h3><?php echo $subtitulo; ?></h3>
				</section>
				<section class="row card-body">
					<section class="col-md-12">
            <section class="row">
              <article class="col-md-4">
                <label for="">Id perfil:</label>
                <input type="text" class="form-control" name="id_perfil" value="<?php echo $fila['id_perfil']; ?>">
              </article>
              <article class="col-md-4">
                <label class="text-center">Nombre: <strong class="text-danger">*</strong></label><br>
                <input type="text" class="form-control text-center" required name="nombre_perfil" value="<?php echo $fila['nombre_perfil'];?>"/>
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
