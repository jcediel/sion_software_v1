<form action="<?php echo PROGRAMA.'?&opcion=91';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<article>
		<h4 id="th-estilot">Registro de inventario Medicamentos</h4>
<section class="panel panel-default">
	<section class="panel-body text-center">
			<article class="col-xs-3 form-group">
				<label for="">Descripcion del producto:</label>
				<input type="text" name="nomgenerico" class="form-control text-center" value="<?php echo $fila["nom_generico"];?>"<?php echo $atributo1;?>/>
				<input type="hidden" name="id_gen" class="form-control text-center" value="<?php echo $fila["id_generico_med"];?>"<?php echo $atributo1;?>/>
			</article>
			<article class="col-xs-3 col-md-3 form-group">
				<label for="">Seleccione Bodega:</label>
				<select name="id_bodega" class="form-control" id="bodega" onchange="mostrarprov()" <?php echo $atributo2;?>>
					<option value="0"><?php echo $fila["nom_generico"];?></option>
					<?php
						$sql_pais = "SELECT * FROM bodega";
						$resultado = $conex->query($sql_pais);
						if($conex->errno) die($conex->error);

						while ($fila = $resultado ->fetch_assoc()){
					?>
						<option value="<?php echo $fila['id_bodega'] ?>"><?php echo $fila['nom_bodega']; ?></option>
					<?php
						}
					?>
				</select>
			</article>
			<article class="col-xs-6 col-md-4 form-group">
				<label for="">Seleccione proveedor:</label>
				<select name="id_proveedor" class="form-control" id="proveedores" <?php echo $atributo1;?>>

				</select>
			</article>
			<article class="col-xs-2 col-md-2 form-group">
				<label for="">Numero de factura:</label>
				<input type="text" name="factura" class="form-control" value="<?php echo $atributo1;?>" required="">
			</article>
			<article class="col-xs-2 form-group">
				<label for="">Precio compra:</label>
				<input type="text" class="form-control" name="precio_compra" value="<?php echo $atributo1;?>" required="">
			</article>
			<article class="col-xs-2 form-group">
				<label for="">Cantidad total:</label>
				<input type="number" class="form-control" name="cantidad" value="<?php echo $atributo1;?>" required="">
			</article>
	</section>
<section class="panel panel-body"> <!--evolucion to-->
		<article class="col-xs-3 col-md-2 form-group">
			<label for="">Codigo ATC:</label>
			<input type="text" name="atc" value="" class="form-control" required="">
		</article>
		<article class="col-xs-5 form-group">
			<label for="">Principio Activo:</label>
			<input type="text" name="nom_med" class="form-control" value="">
		</article>
		<article class="col-md-2 col-xs-3 form-group">
			<label for="">Concentracion:</label>
			<input type="text" name="concentracion" value="" class="form-control" required="">
		</article>
		<article class="col-md-2 col-xs-3 form-group">
			<label for="">Forma farmaceutica:</label>
			<select class="form-control" name="ffarma" required="">
				<option value=""></option>
				<option value="Capsulas">Capsulas</option>
				<option value="Tabletas">Tabletas</option>
				<option value="Grageas">Grageas</option>
				<option value="Solucion Inyectable">Solucion Inyectable</option>
				<option value="Solucion Oral">Solucion Oral</option>
				<option value="Suspension">Suspension</option>
				<option value="Liofilizacion para reconstruir">Liofilizacion para reconstruir</option>
				<option value="Crema">Crema</option>
				<option value="Gel">Gel</option>
				<option value="unguento">unguento</option>
				<option value="unguento oftalmico">unguento oftalmico</option>
				<option value="Solucion perfusion">Solucion perfusion</option>
				<option value="Jarabe">Jarabe</option>
				<option value="Aerosol">Aerosol</option>
			</select>
		</article>
		<article class="col-md-2 col-xs-3 form-group">
			<label for="">Lote:</label>
			<input type="text" class="form-control" name="lote" value="" required="">
		</article>
		<article class="col-md-2 col-xs-2 form-group">
			<label for="">Fecha de fabricacion:</label>
			<input type="date" class="form-control" name="ffabricacion" value="" required="">
		</article>
		<article class="col-xs-2 form-group">
			<label for="">Fecha de vencimiento:</label>
			<input type="date" class="form-control" name="fvencimiento" value="" required="">
		</article>
		<article class="col-md-2 col-xs-3 form-group">
			<label for="">Presentacion Comercial:</label>
			<select class="form-control" name="presentacion" required="">
				<option value=""></option>
				<option value="Tableta">Tableta</option>
				<option value="Ampolla">Ampolla</option>
				<option value="Ampoulepack">Ampoulepack</option>
				<option value="Frasco gotero">Frasco gotero</option>
				<option value="Frasco multidosis">Frasco multidosis</option>
				<option value="Parche">Parche</option>
				<option value="Tubo">Tubo</option>
				<option value="Bolsa">Bolsa</option>
			</select>
		</article>
		<article class="col-md-4 col-xs-3 form-group">
			<?php include("fabbusqueda.php");?>
		</article>
		<article class="col-md-2 col-xs-3 form-group">
			<label for="">Registro INVIMA:</label>
			<input type="text" class="form-control" name="reg_invima" value="" required="">
		</article>
		<article class="col-xs-3 form-group">
			<label for="">CUM:</label>
			<input type="text" class="form-control" name="cum" value="" required="">
		</article>
		<article class="col-xs-3 form-group">
			<label for="">Codigo de barras:</label>
			<input type="text" name="codbarra" class="form-control" value="" required="">
		</article>
	</section>
	<section class="panel-body">
		<article class="col-md-2 col-xs-1 form-group">
			<label for="">POS/NO POS:</label>
			<select class="form-control" name="clase_pos" required="">
				<option value=""></option>
				<option value="POS">POS</option>
				<option value="NO POS">NO POS</option>
			</select>
		</article>
		<article class="col-md-2 col-xs-1 form-group">
			<label for="">Controlado:</label>
			<select class="form-control" name="clase_regulado" required="">
				<option value=""></option>
				<option value="SI">SI</option>
				<option value="NO">NO</option>
			</select>
		</article>
		<article class="col-md-2 col-xs-1 form-group">
			<label for="">Psiquiatrico:</label>
			<select class="form-control" name="clase_psiquiatrico" required="">
				<option value=""></option>
				<option value="SI">SI</option>
				<option value="NO">NO</option>
			</select>
		</article>
	</section>
</section>

	<div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
