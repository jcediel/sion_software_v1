<form action="<?php echo PROGRAMA.'?&opcion=89';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
		<section>
			<marquee class="fuente1">
				<?php echo $subtitulo;?>
			</marquee>
		</section>
		<section class="panel panel-body">
			<article class="col-xs-1">
		  	<label  for="">ID:</label>
		  	<input type="text"  name="id_bodega" class="form-control" value="<?php echo $fila["id_bodega"];?>"<?php echo $atributo1;?>/>
		  </article>
			<article class="col-xs-3">
				<label class="text-center">Nombre de la bodega:</label><br>
				<input type="text" class="form-control text-center" name="nom_bodega" value="<?php echo $fila["nom_bodega"];?>"<?php echo $atributo2;?>/>
			</article>
			<article class="col-xs-3">
				<label>Selecccionar Sede:</label><br>
				<select name="id_sedes" class="form-control" <?php echo atributo3; ?>>
					<?php
					$sql="SELECT id_sedes_ips,nom_sedes from sedes_ips where estado_sedes='Activo' ORDER BY nom_sedes ASC";
					if($tabla=$bd1->sub_tuplas($sql)){
						foreach ($tabla as $fila2) {
							if ($fila["id_sedes_ips"]==$fila2["id_sedes_ips"]){
								$sw=' selected="selected"';
							}else{
								$sw="";
							}
						echo '<option value="'.$fila2["id_sedes_ips"].'"'.$sw.'>'.$fila2["nom_sedes"].'</option>';
						}
					}
					?>
				</select>
			</article>
			<article class="col-xs-3">
				<label for="">Tipo de bodega</label>
				<select class="form-control" name="tipo_bodega" required="">
					<option value=""></option>
					<option value="Farmacia">Farmacia</option>
					<option value="Carro de paro">Carro de paro</option>
					<option value="Carro de medicamentos">Carro de medicamentos</option>
					<option value="Bodega Paciente">Bodega Paciente</option>
				</select>
			</article>
			<?php echo $estado;?>
		</section>
	</section>

	<div class="row text-center">
	  	<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />

		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
