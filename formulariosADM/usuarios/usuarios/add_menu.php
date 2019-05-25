
		<form action="<?php echo PROGRAMA.'?ident='.$doc.'&buscar=Consultar&opcion=1';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
			<section class="card">
				<section class="card-header">
					<h3><?php echo $subtitulo; ?></h3>
				</section>
				<section class="row card-body">
					<section class="col-md-12">
            <section class="row">
              <article class="col-md-12">
                <label class="text-center">Seleccione Menú: <strong class="text-danger">*</strong></label><br>
                <input type="hidden" name="idu" value="<?php echo $fila['id_user']?>">
                <select name="menu" class="form-control" <?php echo atributo3; ?>>
          				<option value=""></option>
          				<?php
          				$sql="SELECT id_menu,titulo from menu ORDER BY id_menu ASC";
          				if($tabla=$bd1->sub_tuplas($sql)){
          					foreach ($tabla as $fila2) {
          						if ($fila["id_menu"]==$fila2["id_menu"]){
          							$sw=' selected="selected"';
          						}else{
          							$sw="";
          						}
          					echo '<option value="'.$fila2["id_menu"].'"'.$sw.'>'.$fila2["titulo"].'</option>';
          					}
          				}
          				?>
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
